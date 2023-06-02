<?php

namespace Modules\Category\Http\Controllers\Api;

use App\Actions\SubCategory\CreateSubCategory;
use App\Actions\SubCategory\DeleteSubCategory;
use App\Actions\SubCategory\MultipleDeleteSubCategory;
use App\Actions\SubCategory\UpdateSubCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Support\Str;
use Modules\Category\Http\Requests\SubCategoryFormRequest;

class SubCategoryController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sub_categories = SubCategory::latest()->get();

        if ($sub_categories) {
            return responseSuccess($sub_categories);
        }else{
            return responseError();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryFormRequest $request
     * @return Renderable
     */
    public function store(SubCategoryFormRequest $request)
    {
        $subcategory = CreateSubCategory::create($request);

        if ($subcategory) {
            return responseSuccess($subcategory);
        }else{
            return responseError();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();

        if ($subcategory) {
            return responseSuccess($subcategory);
        }else{
            return responseError();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SubCategoryFormRequest $request, SubCategory $subcategory)
    {
        $subcategory = UpdateSubCategory::update($request, $subcategory);

        if ($subcategory) {
            return responseSuccess($subcategory);
        }else{
            return responseError();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory = DeleteSubCategory::delete($subcategory);

        if ($subcategory) {
            return responseSuccess($subcategory);
        }else{
            return responseError();
        }
    }

    public function multipleDestroy(Request $request){
        $subcategory = MultipleDeleteSubCategory::delete($request);

        if ($subcategory) {
            return responseSuccess($subcategory);
        }else{
            return responseError();
        }
    }
}
