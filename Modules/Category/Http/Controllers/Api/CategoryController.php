<?php

namespace Modules\Category\Http\Controllers\Api;

use App\Actions\Category\CreateCategory;
use App\Actions\Category\DeleteCategory;
use App\Actions\Category\SortingCategory;
use App\Actions\Category\UpdateCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Modules\Category\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::oldest('order')->get();

        if ($categories) {
            return responseSuccess($categories);
        }else{
            return responseError();
        }
    }

  /**
     * Store a newly created resource in storage.
     * @param CategoryFormRequest $request
     * @return Renderable
     */
    public function store(CategoryFormRequest $request)
    {
        $category = CreateCategory::create($request);

        if ($category) {
            return responseSuccess($category);
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
    public function edit(Category $category)
    {
        if ($category) {
            return responseSuccess($category);
        }else{
            return responseError();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryFormRequest $request,Category $category)
    {
        $category = UpdateCategory::update($request, $category);

        if ($category) {
            return responseSuccess($category);
        }else{
            return responseError();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        $category = DeleteCategory::delete($category);

        if ($category) {
            return responseSuccess($category);
        }else{
            return responseError();
        }
    }

    public function updateOrder(Request $request)
    {
        $category = SortingCategory::sort($request);

        if ($category) {
            return responseSuccess($category);
        }else{
            return responseError();
        }
    }
}
