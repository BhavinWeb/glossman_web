<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Http\Requests\ProductFormRequest;
use Modules\Product\Repositories\ProductRepositories;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProductController extends Controller
{
    use ValidatesRequests;

    protected $product;
    public function __construct(ProductRepositories $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('product.view'), 403);

        $allProducts = Product::all(); //Product::all();
        $total = $allProducts->count();
        $outOfStock = $allProducts->where('stock', 0)->count();
        $featured = $allProducts->where('featured', true)->count();
        $inActive = $allProducts->where('status', false)->count();
        $active = $allProducts->where('status', true)->count();
        $categories = Category::all();
        $brands = Brand::all();

        $stats = [
            'total' => $total,
            'outOfStock' => $outOfStock,
            'featured' => $featured,
            'inActive' => $inActive,
            'active' => $active,
        ];

        $query = Product::query();

        // category filter
        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // brand filter
        if ($request->has('brand') && $request->brand != null) {
            $brand = $request->brand;

            $query->whereHas('brand', function ($q) use ($brand) {
                $q->where('slug', $brand);
            });
        }

        // title filter
        if ($request->has('title') && $request->title != null) {
            $query->where('title', 'LIKE', "%$request->title%");
        }

        // status filter
        if ($request->has('status') && $request->status != null) {
            if ($request->status == 'active') {
                $query->active();
            } else {
                $query->inactive();
            }
        }

        // sortby
        $query->latest();
        // perpage
        $products = $query->paginate(10)->onEachSide(0);

        if ($request->perpage != 'all') {
            $products = $products->withQueryString();
        }

        // return $products;

        return view('product::product.index', compact('products', 'stats', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('product.create'), 403);

        $categories = Category::all();
        $brands = Brand::all();
        $tags = ProductTag::all();

        return view('product::product.create', compact('categories', 'brands', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        if (!userCan('product.create')) {
            return abort(403);
        }

        try {
            $product =  $this->product->store($request);

            flashSuccess('Product Added Successfully');
            return redirect()->route('module.product.gallery.index', $product->id);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Show the specified resource.
     *
     * @return string
     */
    public function show(Product $product)
    {
        abort_if(!userCan('product.view'), 403);

        $data['product'] = $product->load('galleries', 'category', 'brand');

        $data['attributes'] = ProductAttribute::with('attribute')->where('product_id', $product->id)->get()->groupBy('attribute.name');

        return view('product::product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit(Product $product)
    {
        abort_if(!userCan('product.update'), 403);

        $categories = Category::all();
        $brands = Brand::all();
        $tags = ProductTag::all();
        $productTags = $product->productTags;

        // return $product;

        return view('product::product.edit', compact('categories', 'brands', 'product', 'tags', 'productTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductFormRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $product)
    {
    
    
        abort_if(!userCan('product.update'), 403);

        try {
            $this->product->update($request, $product);

            flashSuccess('Product Updated Successfully');
            return redirect(route('module.product.index'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        abort_if(!userCan('product.delete'), 403);

        try {
            $this->product->destroy($product);

            flashSuccess('Product Deleted Successfully');
            return redirect(route('module.product.index'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    public function highlight(Request $request)
    {
        abort_if(!userCan('product.update'), 403);

        $product = Product::FindOrFail($request->productId);
        $product->update([
            'featured' => $request->featured ? true : false,
            'hot' => $request->hot ? true : false,
        ]);

        flashSuccess('Product HightLight Updated !');
        return redirect()->back();
    }

    /**
     * Get category wise product from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function categoryWiseProduct(Category $category)
    {
        try {
            $products = $this->product->categoryWiseProduct($category);

            return view('product::product.categoriesProduct', compact('products', 'category'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Get subcategory list from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function subcategory_list(Request $request)
    {
        try {
            $subcategories = $this->product->subcategory_list($request);

            return responseData($subcategories, 'subcategories');
        } catch (\Throwable $th) {
            return responseError();
        }
    }

    /**
     * Status change list from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function status_change(Request $request)
    {
        abort_if(!userCan('product.update'), 403);

        try {
            $this->product->status_change($request);

            if ($request->status == 1) {
                return responseSuccess('Product Activated Successfully');
            } else {
                return responseSuccess('Product Inactivated Successfully');
            }
        } catch (\Throwable $th) {
            return responseError();
        }
    }
}
