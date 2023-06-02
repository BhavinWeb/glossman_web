<?php

namespace Modules\Category\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Actions\DeleteSubCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Modules\Category\Actions\CreateSubCategory;
use Modules\Category\Actions\DeleteCategory;
use Modules\Category\Http\Requests\SubCategoryFormRequest;
use Modules\Category\Actions\MultipleDeleteSubCategory;
use Modules\Category\Actions\UpdateSubCategory;

class SubCategoryController extends Controller
{
    use ValidatesRequests;

    public $user;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($slug)
    {
        $category_id =  Category::whereSlug($slug)->pluck('id')->first();
        $sub_categories = Category::where('parent_id', $category_id)->with('categories')->withCount('subcategories')->oldest('order')->paginate(10);
        return view('category::subcategory.index', compact('sub_categories', 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('subcategories.subcategories.subcategories.subcategories.subcategories.subcategories.subcategories')->get();
        return view('category::subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryFormRequest $request
     * @return Renderable
     */
    public function store(SubCategoryFormRequest $request)
    {
        $subcategory = CreateSubCategory::create($request);

        $subcategory ? flashSuccess('SubCategory Added Successfully') : flashError();
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($subcategory)
    {
        $subcategory = Category::whereSlug($subcategory)->with('categories')->first();

        return view('category::subcategory.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Category $subcategory)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('category::subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SubCategoryFormRequest $request, Category $subcategory)
    {
        $subcategory = UpdateSubCategory::update($request, $subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Updated Successfully');
            return redirect(route('module.subcategory.index'));
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
    public function destroy(Category $subcategory)
    {
        $category = DeleteCategory::delete($subcategory);

        if ($category) {
            flashSuccess('SubCategory Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}
