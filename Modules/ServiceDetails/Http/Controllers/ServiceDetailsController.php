<?php

namespace Modules\ServiceDetails\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Service;
use DB;

class ServiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = DB::table('service_products')->join('services','services.id','=','service_products.service_category_id')->get();
        //dd($categories);
        return view('servicedetails::servicedetails.index',['categories'=>$categories]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $service = Service::get();
        
        return view('servicedetails::servicedetails.create',['service'=>$service]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = ["service_category_id"=>$request->post("service_category_id"),"price"=>$request->post("price"),"time"=>$request->post("time"),"about_service"=>$request->post("about_service")];
        DB::table('service_products')->insert($data);
        return redirect(route('module.service_p.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('servicedetails::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       
        $service = Service::get();
        $service_p = DB::table('service_products')->where('id',$id)->first();
        return view('servicedetails::servicedetails.edit',['service'=>$service,"service_p"=>$service_p]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // die($id);
        $data = ["service_category_id"=>$request->post("service_category_id"),"price"=>$request->post("price"),"time"=>$request->post("time"),"about_service"=>$request->post("about_service")];
        DB::table('service_products')->where('id',$id)->update($data);
        return redirect(route('module.service_p.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
