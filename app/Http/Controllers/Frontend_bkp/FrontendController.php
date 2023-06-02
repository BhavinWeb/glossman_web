<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\cms;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use App\Http\Traits\HasProduct;
use App\Models\BrowsingHistory;
use App\Models\HomePageContent;
use Modules\Blog\Entities\Post;
use App\Http\Traits\PaymentTrait;
use Modules\Brand\Entities\Brand;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\City;
use Modules\Slider\Entities\Slider;
use App\Http\Controllers\Controller;
use App\Models\ManualPayment;
use Darryldecode\Cart\CartCondition;
use Modules\Location\Entities\State;
use Modules\Product\Entities\Product;
use Modules\Blog\Entities\PostComment;
use Modules\Location\Entities\Country;
use Illuminate\Support\Facades\Session;
use Modules\Blog\Entities\PostCategory;
use Modules\Category\Entities\Category;
use Modules\Currency\Entities\Currency;
use Modules\Product\Entities\ProductTag;
use Modules\Attribute\Entities\Attribute;
use Modules\Product\Entities\ProductAttribute;
use Modules\ShippingMethod\Entities\PickupPoint;
use Modules\ShippingMethod\Entities\ShippingMethod;
use Modules\Wishlist\Entities\Wishlist;

class FrontendController extends Controller
{
    use HasProduct, PaymentTrait;

    public function index()
    {
        $data['todays_deals_products'] = DB::table('todays_deal_products')
            ->join('products', 'products.id', '=', 'todays_deal_products.product_id')
            ->where('status', 1)
            ->take(9)
            ->get();
        $data['todays_deals'] = $data['todays_deals_products']
            ->map(function ($item) {
                $item->image_url = $item->image ? asset($item->image) : asset('backend/image/default.png');
                $item->on_sale = $item->sale_price && $item->sale_price < $item->price ? true : false;
                $item->wishlisted = Wishlist::where('product_id', $item->product_id)->where('user_id', auth('user')->id())->count() ? 1 : 0;
                return $item;
            });

        $data['home_page_contents'] = HomePageContent::with('campaignOffer.campaign')->whereStatus(1)->oldest('order')->get();
        $data['trending_products'] = Product::active()->latest('total_views')->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['latest_products'] = Product::active()->latest()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['top_rated_products'] = Product::active()->topRated()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['best_sale_products'] = Product::active()->bestSale()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['categories'] = Category::active()->parentCategory()->select('id', 'name', 'slug', 'image')->get();
        $data['sliders'] = Slider::take(3)->latest()->get();
        $data['latest_news'] = Post::with('author')->latest()->take(3)->get();
        $data['featured_products'] = Product::latest()->active()->featured()->limit(8)->get();
        $data['cms'] = cms::first();


        $data['custom_category_products'] = [];
        $data['custom_category'] = $this->customCategoryProducts();

        if ($data['custom_category'] && $data['custom_category']->subcategories && count($data['custom_category']->subcategories)) {
            $subcategories =  $data['custom_category']->subcategories;

            foreach ($subcategories as $subcategory) {
                foreach ($subcategory->products as $product) {
                    $data['custom_category_products'][] = $product;
                }
            }
        }

        return view('website.pages.index', $data);
    }

    public function products(Request $request)
    {
        $query = Product::active()
            ->withCount(['favorites as liked' => function ($q) {
                $q->where('user_id', auth()->id());
            }])
            ->withCasts(['liked' => 'boolean']);

        // Keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        // Category filter
        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // mobile Category filter
        if ($request->has('category_m') && $request->category_m != null) {
            $category = $request->category_m;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // Brand filter
        if ($request->has('brand') && $request->brand != null) {
            $brand = $request->brand;

            $query->whereHas('brand', function ($q) use ($brand) {
                $q->whereIn('slug', $brand);
            });
        }

        // Salery filter
        if ($request->has('price') && $request->price != null) {
            switch ($request->price) {
                case '0':
                    $query->where('price', '>', 0)->where('price', '<', 25);
                    break;
                case '25':
                    $query->where('price', '>=', 25)->where('price', '<=', 100);
                    break;
                case '100':
                    $query->where('price', '>=', 100)->where('price', '<=', 300);
                    break;
                case '300':
                    $query->where('price', '>=', 300)->where('price', '<=', 500);
                    break;
                case '500':
                    $query->where('price', '>=', 500)->where('price', '<=', 1000);
                    break;
                case '1000':
                    $query->where('price', '>=', 1000);
                    break;
            }
        }

        // mobile Salery filter
        if ($request->has('price_m') && $request->price_m != null) {
            $request->price_min == null;
            $request->price_max == null;
            switch ($request->price_m) {
                case '0':
                    $query->where('price', '>', 0)->where('price', '<', 25);
                    break;
                case '25':
                    $query->where('price', '>=', 25)->where('price', '<=', 100);
                    break;
                case '100':
                    $query->where('price', '>=', 100)->where('price', '<=', 300);
                    break;
                case '300':
                    $query->where('price', '>=', 300)->where('price', '<=', 500);
                    break;
                case '500':
                    $query->where('price', '>=', 500)->where('price', '<=', 1000);
                    break;
                case '1000':
                    $query->where('price', '>=', 1000);
                    break;
            }
        }

        //min & max price filter
        if ($request->has('price_min') && $request->price_min != null) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max != null) {
            $query->where('price', '<=', $request->price_max);
        }

        // Tag filter
        if ($request->has('tag') && $request->tag != null) {
            $tag = $request->tag;

            $query->whereHas('productTags', function ($q) use ($tag) {
                $q->where('slug', $tag);
            });
        }

        // sortBy search
        if ($request->has('sortBy') && $request->sortBy != null) {
            if ($request->sortBy == 'oldest') {
                $query->oldest();
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }
        $products = $query->paginate(20);

        $products->appends($request->all());

        $categories = Category::active()->parentCategory()->get();
        $brands =  Brand::all();
        $maxPrice = Product::active()->select('price')->max('price');

        return view('website.pages.shop.products', compact('products', 'categories', 'brands', 'maxPrice'));
    }

    public function productDetails(Product $product)
    {
        $data['product_attributes'] = ProductAttribute::with('attribute')->where('product_id', $product->id)->get()->groupBy('attribute.name');

        $data['item_quantity'] = 1;

        if (!\Cart::isEmpty() && \Cart::get($product->id)) {
            $data['item_quantity'] = \Cart::get($product->id)->quantity;
        }

        $data['rating'] = $this->getProductRating($product);
        $data['product'] = $this->getProductDetails($product);
        $data['trending_products'] = Product::active()->latest('total_views')->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['latest_products'] = Product::active()->latest()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['top_rated_products'] = Product::active()->topRated()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['best_sale_products'] = Product::active()->bestSale()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);

        //<!--✯✯✯✯✯ ADD PRODUCT BROWSE HISTORY ✯✯✯✯✯-->
        $browse_save_session = Session::get('browse_history_save');
        if ($browse_save_session) {

            $browse = BrowsingHistory::where('device_ip', substr(request()->ip(), 0, 7))
                ->where('product_id', $product->id)
                ->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->first();

            if (empty($browse)) {

                BrowsingHistory::create([
                    'device_ip' => substr(request()->ip(), 0, 7),
                    'product_id' => $product->id
                ]);
            }
        }

        // return $data['product'];

        return view('website.pages.shop.product-details', $data);
    }

    public function quickProductDetail(Product $product)
    {
        $data = $product->load(['category:id,name', 'brand:id,name', 'galleries:id,product_id,image']);

        return response()->json($data);
    }

    public function posts(Request $request)
    {
        $blog_categories = PostCategory::latest()->get();
        $latest_posts = Post::latest()->take(5)->get();
        $query = Post::with('category', 'author', 'comments.replies');

        // Keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        // sortBy search
        if ($request->has('sortBy') && $request->sortBy) {
            if ($request->sortBy == 'latest') {
                $query->latest();
            } else {
                $query->oldest();
            }
        } else {
            $query->latest();
        }


        // Category filter
        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        $posts = $query->paginate(12);

        if ($request->perpage != 'all') {
            $posts = $posts->withQueryString();
        }

        return view('website.pages.blog.posts', compact('blog_categories', 'latest_posts', 'posts'));
    }


    public function postDetails($post)
    {
        $blog_categories = PostCategory::latest()->get();
        $latest_posts = Post::latest()->take(5)->get();
        $postDetails =  Post::whereSlug($post)->with([
            'category',
            'author:id,first_name,last_name',
            'comments.user:id,first_name,last_name',
            'comments.replies.user:id,first_name,last_name'
        ])->first();
        return view('website.pages.blog.post-details', compact('blog_categories', 'latest_posts', 'postDetails'));
    }

    public function postComment(Request $request, $postid)
    {
        $request->validate(['body' => 'required']);

        $userid = auth()->user()->id;

        $request->validate([
            'body' => 'required'
        ]);

        $added = $this->createComment($request, $userid, $postid);
        $added ? flashSuccess('Comment added!') : flashError();
        return back();
    }

    public function createComment($request, $userid, $postid)
    {
        $comment = new PostComment;
        $comment->author_id = $userid;
        $comment->post_id = $postid;
        if ($request->has('parent_id') && $request->parent_id !== null) {
            $comment->parent_id = $request->parent_id;
        }
        $comment->body = $request->body;
        $added = $comment->save();
        return $added ? true : false;
    }

    public function postCommentReply(Request $request, $postid)
    {
        $userid = auth()->user()->id;

        $request->validate([
            'body' => 'required',
            'parent_id' => 'required'
        ]);

        $added = $this->createComment($request, $userid, $postid);
        $added ? flashSuccess('Reply added!') : flashError();
        return back();
    }

    public function checkout()
    {
        // if (!auth('user')->check()) {
        //     flashWarning('Please login to checkout');
        //     return redirect()->route('login');
        // }

        if (\Cart::getTotalQuantity() == 0) {
            flashWarning('Your cart is empty. Please add some products to checkout');
            return redirect()->route('website.product');
        }

        $data['shipping_methods'] = ShippingMethod::whereStatus(1)->get();
        $data['pickup_points'] = PickupPoint::all();
        $data['countries'] = Country::all(['id', 'name']);
        $data['billing_address'] = auth('user')->check() ? auth()->user()->billingAddress: '';
        $data['shipping_address'] = auth('user')->check() ? auth()->user()->shippingAddress: '';
        $data['billing_states'] = State::where('country_id', $data['billing_address'] ? $data['billing_address']->country_id : '')->get();
        $data['shipping_states'] = State::where('country_id', $data['shipping_address'] ? $data['shipping_address']->country_id : '')->get();
        $data['billing_cities'] = City::where('state_id', $data['billing_address'] ? $data['billing_address']->state_id : '')->get();
        $data['shipping_cities'] = City::where('state_id', $data['shipping_address'] ? $data['shipping_address']->state_id : '')->get();

        $data['total'] = \Cart::getTotal();
        $data['subtotal'] = \Cart::getSubTotal();
        $data['address'] = auth('user')->check() ? auth('user')->user()->load('billingAddress', 'shippingAddress'):'';
        $data['cart_items'] = \Cart::getContent();
        $data['coupon_condition'] = \Cart::getCondition('Coupon') ?? '';

        $data['manual_payments'] = ManualPayment::whereStatus(1)->get();

        return view('website.pages.shop.checkout', $data);
    }

    public function checkoutDataStore(Request $request)
    {
        if ($request->payment_type == 'offline') {
            $same_address = $request->is_same_address ? 0 : 1;
        } else {
            $same_address = $request->is_same_address ?? false;
        }

        if (!auth('user')->check()) {
            $request->validate([
                'guest_email' => 'required|unique:users,email',
            ]);
        }

        if ($same_address) {
            $request->validate([
                'billing_first_name' => 'required',
                'billing_last_name' => 'required',
                'billing_email' => 'required|email',
                'billing_phone' => 'required',
                'billing_address' => 'required',
                'billing_state' => 'required',
                'billing_country' => 'required',
                'billing_zip' => 'required',
                'payment_method' => 'required',
                'notes' => 'sometimes',
                'shipping_method' => 'required',
                'pickup_point_id' => 'sometimes',
            ]);
        } else {
            $request->validate([
                'billing_first_name' => 'required',
                'billing_last_name' => 'required',
                'billing_email' => 'required|email',
                'billing_phone' => 'required',
                'billing_address' => 'required',
                'billing_state' => 'required',
                'billing_country' => 'required',
                'billing_zip' => 'required',
                'shipping_first_name' => 'required',
                'shipping_last_name' => 'required',
                'shipping_email' => 'required|email',
                'shipping_phone' => 'required',
                'shipping_address' => 'required',
                'shipping_state' => 'required',
                'shipping_country' => 'required',
                'shipping_zip' => 'required',
                'payment_method' => 'required',
                'notes' => 'sometimes',
                'shipping_method' => 'required',
                'pickup_point_id' => 'sometimes',
            ]);
        }


        if ($request->payment_type == 'offline') {
            $this->orderPlacing($request->all());
            return redirect()->route('website.checkout.success');
        } else {
            session()->forget('order_request');
            session(['order_request' => $request->all()]);

            return true;
        }
    }

    public function checkoutSuccess()
    {
        $order_no = session('current_order_no');

        if (!$order_no) {
            abort(404);
        }

        return view('website.pages.shop.checkout-success', compact('order_no'));
    }

    public function about()
    {
        $data['latest_products'] = Product::active()->latest()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['top_rated_products'] = Product::active()->topRated()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);
        $data['best_sale_products'] = Product::active()->bestSale()->take(3)->get(['id', 'title', 'slug', 'price', 'sale_price', 'image']);

        return view('website.pages.others.about', $data);
    }

    public function privacy()
    {
        $cms = Cms::first();

        return view('website.pages.others.privacy-policy', compact('cms'));
    }

    public function terms()
    {
        $cms = Cms::first();

        return view('website.pages.others.terms-conditions', compact('cms'));
    }

    public function refund()
    {
        $cms = Cms::first();
        return view('website.pages.others.refund-policy', compact('cms'));
    }

    public function trackOrder()
    {
        return view('website.pages.others.track-order');
    }

    public function compare()
    {
        $compares = session()->get('compares') ? session()->get('compares') : [];
        $products = Product::whereIn('id', $compares)
            ->withCount(['favorites as liked' => function ($q) {
                $q->where('user_id', auth()->id());
            }])
            ->with('attributes')
            ->withCasts(['liked' => 'boolean'])
            ->get();
        $allattributes = Attribute::all();
        // return $products;
        return view('website.pages.shop.compare', compact('products', 'allattributes'));
    }

    public function addToCompare($product)
    {
        $compares = session()->get('compares') ? session()->get('compares') : [];
        if (($key = array_search($product, $compares)) !== false) {
            unset($compares[$key]);
            session()->put('compares', $compares);
            flashSuccess('Product removed from compare list.');
            return response()->json(false);
        } else {
            Session::push('compares', $product);
            flashSuccess('Product added to compare list.');
            return response()->json(true);
        }
    }

    public function orderDetails(Request $request)
    {
        $request->validate([
            'order' => 'required'
        ]);

        $order = Order::where('order_no', $request->order)->withCount('orderProducts')->first();
        if ($order) {

            $activities = $order->notifications;
            return view('website.pages.others.order-details', compact('order', 'activities'));
        } else {

            return redirect()->back()->with('warning', 'No Order Found !');
        }
    }

    public function faq()
    {
        $faq = Faq::all();
        return view('website.pages.others.faq', compact('faq'));
    }

    public function support()
    {
        return view('website.pages.others.support');
    }

    public function dashboard()
    {
        return view('home');
    }

    public function defaultCurrency(Request $request)
    {
        $currency = Currency::findOrFail($request->currency);

        envReplace('APP_CURRENCY', $currency->code);
        envReplace('APP_CURRENCY_SYMBOL', $currency->symbol);
        envReplace('APP_CURRENCY_SYMBOL_POSITION', $currency->symbol_position);

        flashSuccess('Currency Changed Successfully');
        return back();
    }

    public function productAttributes(Product $product)
    {
        $attributes = ProductAttribute::with('attribute')
            ->where('product_id', $product->id)
            ->get()
            ->groupBy('attribute.name');

        if ($attributes->count() > 0) {
            return response()->json([
                'success' => true,
                'data' => $attributes,
                'message' => 'Attributes Found !'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Attributes Found !'
            ]);
        }
    }
}
