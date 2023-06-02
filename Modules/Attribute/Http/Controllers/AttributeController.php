<?php

namespace Modules\Attribute\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Attribute\Entities\Attribute;
use Illuminate\Contracts\Support\Renderable;
use Modules\Attribute\Actions\EditAttribute;
use Modules\Attribute\Actions\CreateAttribute;
use Modules\Attribute\Actions\DeleteAttribute;
use Modules\Attribute\Actions\UpdateAttribute;
use Modules\Attribute\Http\Requests\AttributeFormRequest;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('variant.view'), 403);

        $attributes = Attribute::with('values')->latest()->paginate(20);

        return view('attribute::attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('variant.create'), 403);

        return view('attribute::attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AttributeFormRequest $request
     * @return Renderable
     */
    public function store(AttributeFormRequest $request)
    {
        abort_if(!userCan('variant.create'), 403);

        $attribute = CreateAttribute::create($request);

        if ($attribute) {
            flashSuccess('Variant Added Successfully.Please add values for this variant');
            return redirect()->route('module.attributes.edit', $attribute->id);
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Attribute $attribute)
    {
        return view('attribute::attribute.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Attribute $attribute)
    {
        abort_if(!userCan('variant.update'), 403);

        $values = EditAttribute::edit($attribute);

        return view('attribute::attribute.edit', compact(['attribute', 'values']));
    }

    /**
     * Update the specified resource in storage.
     * @param AttributeFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(AttributeFormRequest $request, Attribute $attribute)
    {
        abort_if(!userCan('variant.update'), 403);

        $attribute = UpdateAttribute::update($request, $attribute);

        if ($attribute) {
            flashSuccess('Attribute Updated Successfully!');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Attribute $attribute)
    {
        abort_if(!userCan('variant.delete'), 403);

        $attribute = DeleteAttribute::destroy($attribute);

        if ($attribute) {
            flashSuccess('Attribute Deleted Successfully!');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}
