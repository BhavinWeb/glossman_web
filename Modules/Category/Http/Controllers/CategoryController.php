<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Response;
use Modules\Category\Actions\UpdateCategory;
use Modules\Category\Actions\SortingCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Actions\CreateCategory;
use Modules\Category\Actions\CreateSubCategory;
use Modules\Category\Http\Requests\CategoryFormRequest;
use Modules\Category\Repositories\CategoryRepositories;

class CategoryController extends Controller
{
    use ValidatesRequests;

    protected $category;

    public function __construct(CategoryRepositories $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the categories.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('category.view'), 403);

        $categories = Category::whereNull('parent_id')->withCount('subcategories')->oldest('order')->paginate(10);
        return view('category::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = null)
    {
        abort_if(!userCan('category.create'), 403);

        $categories = Category::whereNull('parent_id')->with('subcategories.subcategories.subcategories.subcategories')->get();
        return view('category::category.create', compact('categories', 'parent_id'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        abort_if(!userCan('category.create'), 403);

        if ($request->has('parent_id') && $request->parent_id !== null) {
            $subcategory = CreateSubCategory::create($request);
            $subcategory ? flashSuccess('SubCategory Added Successfully') : flashError();
        } else {
            $category = CreateCategory::create($request);
            $category ? flashSuccess('Category Added Successfully') : flashError();
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(!userCan('category.update'), 403);

        $categories = Category::whereNull('parent_id')->with('subcategories.subcategories.subcategories.subcategories')->get();
        return view('category::category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        abort_if(!userCan('category.update'), 403);

        if ($request->parent_id == $category->id) {
            flashError();
            return back();
        }

        $category->update($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($category->image);
            $url = $request->image->move('uploads/category', $request->image->hashName());
            $category->update(['image' => $url]);
        }

        if ($request->has('parent_id') && $request->parent_id !== null) {
            flashSuccess('Subcategory Updated Successfully');
            return redirect(route('module.category.index'));
        } else {
            flashSuccess('Category Updated Successfully');
            return redirect(route('module.category.index'));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!userCan('category.delete'), 403);

        try {
            $this->category->destroy($category);
            flashSuccess('Category Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        abort_if(!userCan('category.update'), 403);

        try {
            SortingCategory::sort($request);
            return response()->json(['message' => 'Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    public function show($category)
    {
        $category = Category::whereSlug($category)->with('subcategories')->withCount('subcategories')->first();

        return view('category::category.show', compact('category'));
    }

    public function status_change(Request $request)
    {
        abort_if(!userCan('category.update'), 403);

        $product = Category::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['message' => 'Category Activated Successfully']);
        } else {
            return response()->json(['message' => 'Category Inactivated Successfully']);
        }
    }
}
