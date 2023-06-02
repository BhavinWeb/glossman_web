<?php

namespace Modules\Packages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use DB;
use Validator;
use App\Models\Package;
use App\Models\Package_service;


class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $packages = DB::table('packages')->paginate(10);
        
        return view('packages::packages.index',['packages'=>$packages]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
    	 $services = DB::table("services")->get();
        return view('packages::packages.create',['services'=> $services]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                "description" => "required",
                "title" => "required",
                "price" => "required",
                "currency"=>"required",
                "duration" => "required",
            ]);
            
       $packages = new Package();
       $packages->description = $request->post('description');
       $packages->title = $request->post('title');
       $packages->currency = $request->post('currency');
       $packages->price = $request->post('price');
       $packages->duration = $request->post('duration');
       $packages->status = 1;
       $packages->save();
         
         foreach($request->post('service') as $service_data){
         		
		 $name = DB::table("services")->where('id',$service_data['id'])->first();
		 
		 $package_service = new Package_service();
		 $package_service->package_id = $packages->id;
		 $package_service->service_id = $service_data['id'];
		 $package_service->service_count = $service_data['count'];
		 $package_service->service_name = $name->name;
		 $package_service->discription =$name->about_service;
		 $package_service->save();
          }
         
        
        return redirect(route('module.package.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('packages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data =  DB::table('packages')->where('id',$id)->first();
         $services = DB::table("services")->get();
         $services_id =Package_service::where('package_id',$data->id)->get();
        
        return view('packages::packages.edit',['data'=>$data,'services'=> $services,'selected_services'=>$services_id]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
       $packages = Package::find($id);
       $packages->description = $request->post('description');
       $packages->title = $request->post('title');
        $packages->currency = $request->post('currency');
       $packages->price = $request->post('price');
       $packages->duration = $request->post('duration');
       $packages->status = 1;
       $packages->save();
       
      DB::table("package_services")->where('package_id',$id)->delete();
       
       
         foreach($request->post('service') as $service_data){
         		
		 $name = DB::table("services")->where('id',$service_data['id'])->first();
		 
        //  dd($name);
		 $package_service = new Package_service();
		 $package_service->package_id = $packages->id;
		 $package_service->service_id = $service_data['id'];
		 $package_service->service_count = $service_data['count'];
		 $package_service->service_name = $name->name;
		 $package_service->discription =$name->about_service;
		 $package_service->save();
          }
        return redirect(route('module.package.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::table('packages')->where('id',$id)->delete();
        
        return redirect(route('module.package.index'));
    }

    public function status_change(Request $request){
        $product = DB::table('packages')->where('id',$request->id)->update(['status'=>$request->status]);
        

        if ($request->status == 1) {
            return response()->json(['message' => 'Package Activated Successfully']);
        } else {
            return response()->json(['message' => 'Package Inactivated Successfully']);
        }
    }
}

