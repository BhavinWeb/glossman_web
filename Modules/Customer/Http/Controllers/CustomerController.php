<?php

namespace Modules\Customer\Http\Controllers;

use Mail;
use App\Mail\SendMail;
use App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Http\Requests\CustomerFormRequest;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\State;
use Illuminate\Support\Str;
use DB;
use Hash;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!userCan('customer.view'), 403);

        $query = User::withCount('orders')->with('billingAddress');

        // keyword search
        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('first_name', "LIKE", "%$keyword%")
                ->orWhere('last_name', "LIKE", "%$keyword%")
                ->orWhere('email', "LIKE", "%$keyword%");
        }

        // sorting
        if (request()->has('sort_by') && request()->sort_by != null) {
            switch (request()->sort_by) {
                case 'latest':
                    $query->orderBy('id', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('id', 'asc');
                    break;
                default:
                    return $query->latest();
                    break;
            }
        }

        // perpage
        if (request()->has('perpage') && request()->perpage != null) {
            switch (request()->perpage) {
                case '10':
                    $customers = $query->paginate(10);
                    break;
                case '25':
                    $customers = $query->paginate(25);
                    break;
                case '50':
                    $customers = $query->paginate(50);
                    break;
                case '100':
                    $customers = $query->paginate(100);
                    break;
                case 'all':
                    $customers = $query->get();
                    break;
            }
        } else {
            $customers = $query->paginate(10);
        }

        if (request()->perpage != 'all') {
            $customers = $customers->withQueryString();
        }

        return view('customer::index', compact('customers'));
    }

    public function create()
    {
        abort_if(!userCan('customer.create'), 403);

        $countries = Country::all();
        return view('customer::create', compact('countries'));
    }

    public function store(CustomerFormRequest $request)
    {
        abort_if(!userCan('customer.create'), 403);

        if (!userCan('customer.create')) {
            return abort(403);
        }
        $customer = User::create($request->except(['_token']));
         $customer->name = $request->first_name." ".$request->last_name;
          $customer->password = Hash::make($request['password']);
        // image
       if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = date("YmdHi") . ".png";
            $url = $request->file('image')->move('uploads/user_image', $filename);
            $customer->update(['image' => $filename]);
        }

        $customer ? flashSuccess('Customer created successfully') : flashError();
        return back();
    }

    public function show($id)
    {
        abort_if(!userCan('customer.view'), 403);

        $customer = User::findOrFail($id)->load(['wishlists', 'shippingAddress', 'billingAddress', 'country', 'state', 'city', 'orders' => function ($query) {
            $query->paginate(10);
        }]);
        
        $address = DB::table('addresses')->where('user_id',$id)->first();
	if($address){
		$address = $address;
	}else{
		$address = [];
	}
        return view('customer::show', compact('customer','address'));
    }

    public function edit($id)
    {
        abort_if(!userCan('customer.update'), 403);

        $customer = User::findOrFail($id);
        
        return view('customer::edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        abort_if(!userCan('customer.update'), 403);
	
        $customer = User::findOrFail($id);
        $customer->name = $request->first_name." ".$request->last_name;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->password = $request->password;
        $customer->address = $request->address;
        
        // image
        
        if ($request->hasFile('image')) {
        
           $file = $request->file("image");
           $filename = date("YmdHi") . ".png";
           $file->move(public_path("uploads/user_image"), $filename);
		          
            $customer->image =$filename;
        }
	$customer->save();
       flashSuccess('Customer info updated successfully');
        return back();
    }

    public function destroy($id)
    {
        abort_if(!userCan('customer.delete'), 403);

        $customer = User::findOrFail($id);

        if (file_exists($customer->image)) {
            deleteImage($customer->image);
        }

        $customer->delete();

        $customer ? flashSuccess('Customer Deleted Successfully') : flashError();
        return back();
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    public function statusChange(Request $request)
    {
        abort_if(!userCan('customer.update'), 403);

        try {
            $customer = User::findOrFail($request->id);
            if ($request->status == 0) {
                $customer->banned_till = $request->status;
            } else {
                $customer->banned_till = null;
            }
            $customer->save();

            if ($request->status == 1) {
                return responseSuccess('Customer Activated Successfully');
            } else {
                return responseSuccess('Customer Banned Successfully');
            }
        } catch (\Throwable $th) {
            return responseError();
        }
    }
    
     public function update_note(Request $request){
    
    	 $customer = User::findOrFail($request->user_id);
    	
    	$customer->note = $request->note;
    	$customer->save();
    
    	return true;
    	
    }
    
     public function send_mail(Request $request){
    
        $testMailData = [
            'title' => 'Glossman',
            'body' => $request->message,
        ];

        Mail::to($request->email)->send(new SendMail($testMailData));

       return true;
       
   }
    
    
}

