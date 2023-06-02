<?php

namespace Modules\Driver\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Driver;
use DB;
use Validator;

class DriverController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $drivers = DB::table('drivers')->paginate(10);
        return view('driver::driver.index',['drivers'=>$drivers]);
    }

    
    public function create()
    {
    	 $services = DB::table("drivers")->get();
        return view('driver::driver.create',['services'=> $services]);
    }


    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "password"=>"required",
            ]);
            
       $driver = new Driver();
       $driver->name = $request->post('name');
       $driver->email = $request->post('email');
       $driver->phone = $request->post('phone');
       $driver->password = $request->post('password');
       $driver->status = 1;
       $driver->save();
      return redirect(route('module.driver.index'));
    }


    public function edit($id)
    {
        $data =  DB::table('drivers')->where('id',$id)->first();
        return view('driver::driver.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
       $driver = Driver::find($id);
       $driver->name = $request->post('name');
       $driver->email = $request->post('email');
       $driver->phone = $request->post('phone');
       $driver->password = $request->post('password');
       $driver->status = 1;
       $driver->save();
       return redirect(route('module.driver.index'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::table('drivers')->where('id',$id)->delete();
        
        return redirect(route('module.driver.index'));
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
