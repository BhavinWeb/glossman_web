<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use DB;
use Validator;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::latest()->paginate(10);

        return view('admin/driver/index', compact('driver'));
    }

    public function create()
    {
        return view('admin/driver/create');
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "password"=>"required",
        ]);
      $checkEmail = Driver::where('email', $request->email)->first();
      $checkPhone = Driver::where('phone', $request->phone)->first();
             
       if($checkEmail){
            return back()->with('error', 'Email Address Already Registered!');
       }elseif($checkPhone){
            return back()->with('error', 'Phone Number Already Registered!');
       }else{
            $driver = new Driver();
            $driver->name = $request->post('name');
            $driver->email = $request->post('email');
            $driver->phone = $request->post('phone');
            $driver->password = $request->post('password');
            $driver->status = 1;
            $driver->save();
           return redirect(route('admin.driver'));
        }
    }


    public function edit($id)
    {
        $res['data'] =  DB::table('drivers')->where('id',$id)->first();
        return view('admin/driver/edit', $res);
    }

    public function update(Request $request)
    {
       $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "password"=>"required",
        ]);
      
             $driver = Driver::find($request->id);
             $driver->name = $request->name;
             $driver->email = $request->email;
             $driver->phone = $request->phone;
             $driver->password = $request->password;
             $driver->status = 1;
             $driver->save();
             return redirect(route('admin.driver'));
    }

    public function destroy($id)
    {
        DB::table('drivers')->where('id',$id)->delete();
        
        return redirect(route('admin.driver'));
      
    }


    public function status_change(Request $request){
        $product = DB::table('drivers')->where('id',$request->id)->update(['status'=>$request->status]);
    
        if ($request->status == 1) {
            return response()->json(['message' => 'Driver Activated Successfully']);
        } else {
            return response()->json(['message' => 'Driver Inactivated Successfully']);
        }
    }
}
