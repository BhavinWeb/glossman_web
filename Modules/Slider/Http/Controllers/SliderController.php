<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('slider.view'), 403);

        $sliders = Slider::latest()->get();
        return view('slider::slider.index', compact('sliders'));
    }

    public function getSliders()
    {
        $data = Slider::latest()->get();
        return \responseOk($data, 'Data Retrieve Successfully!');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('slider.create'), 403);

        return view('slider::slider.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SliderRequest $request)
    {
        abort_if(!userCan('slider.create'), 403);

        $slider = Slider::create($request->except(['image']));
        $image = $request->image;
        if ($image) {
            $url = uploadImage($image, 'slider');
            $slider->update(['image' => $url]);
        }

        $slider ? flashSuccess('Slider Created Successfully') : flashError();
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Slider $slider)
    {
        abort_if(!userCan('slider.update'), 403);

        return view('slider::slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        abort_if(!userCan('slider.update'), 403);

        $slider->update($request->except(['image']));
        $image = $request->image;

        if ($image) {
            deleteImage($slider->image);
            $url = uploadImage($image, 'slider');
            $slider->update(['image' => $url]);
        }

        $slider ? flashSuccess('Slider Updated Successfully') : flashError();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Slider $slider)
    {
        abort_if(!userCan('slider.delete'), 403);

        $image = file_exists($slider->image);
        if ($image) {
            deleteImage($slider->image);
        }
        $slider->delete();
        $slider ? flashSuccess('Slider Deleted Successfully') : flashError();
        return back();
    }

    public function multipleDestroy(Request $request)
    {
        abort_if(!userCan('slider.delete'), 403);

        $ids = $request->id;
        Slider::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Selected Slider Items Deleted Successfully!']);
    }
}
