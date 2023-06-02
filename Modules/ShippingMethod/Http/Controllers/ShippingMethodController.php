<?php

namespace Modules\ShippingMethod\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ShippingMethod\Entities\ShippingMethod;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $methods = ShippingMethod::latest()->get();

        return view('shippingmethod::index', compact('methods'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $method = ShippingMethod::findOrFail($id);
        return view('shippingmethod::edit', compact('method'));
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
            'amount' => 'required|numeric',
            'name' => 'required|string',
        ]);

        $method = ShippingMethod::findOrFail($id);
        $method->name = $request->name;
        $method->amount = $request->amount;
        $method->status = $request->status == 'on' ? 1 : 0;
        $method->save();

        session()->flash('success', 'Shipping method updated successfully');
        return redirect()->route('module.shippingmethod.index');
    }
}
