<?php

namespace Modules\ShippingMethod\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\State;
use Modules\ShippingMethod\Entities\PickupPoint;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $addresses = PickupPoint::latest()->with(['state', 'city'])->paginate(20);

        return view('shippingmethod::pickup-point.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $states = State::orderBy('name', 'asc')->get();
        return view('shippingmethod::pickup-point.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|unique:pickup_points,name',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        PickupPoint::create($request->all());

        return redirect()->route('module.pickup-point.index')->with('success', 'Pickup Point created successfully.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $pickupPoint = PickupPoint::findOrFail($id);

        return view('shippingmethod::pickup-point.show', compact('pickupPoint'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pickupPoint = PickupPoint::findOrFail($id);
        $states = State::orderBy('name', 'asc')->get();

        return view('shippingmethod::pickup-point.edit', compact(['pickupPoint', 'states']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|unique:pickup_points,name,$id",
            'country_id' => 'required',
            'state_id' => 'nullable',
            'address' => 'required',
        ]);

        PickupPoint::findOrFail($id)->update($request->all());

        return redirect()->route('module.pickup-point.index')->with('success', 'Pickup Point updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $pickupPoint = PickupPoint::findOrFail($id);

        $pickupPoint->delete();
        return redirect()->route('module.pickup-point.index')->with('success', 'Pickup Point deleted successfully.');
    }
}
