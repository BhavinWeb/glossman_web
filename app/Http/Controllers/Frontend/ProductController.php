<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Category\Entities\Category;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Modules\Product\Entities\Product;
use Modules\Location\Entities\City;
use App\Models\Favourite_product;
use App\Models\product_cart;
use App\Http\Traits\HasProduct;
use App\Http\Traits\PaymentTrait;
use App\Models\ReviewRating;
use App\Models\Setting;
use App\Models\Review_detail;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\Address;
use Modules\Coupon\Entities\Coupon;
use Modules\Order\Entities\Transaction;
use Modules\Order\Entities\OrderProduct;
use Redirect;
use Validator;
use DB;
use View;
use URL;
use Auth;
use Carbon\Carbon;
use App\Models\Cards;

class ProductController extends Controller
{
    use HasProduct, PaymentTrait;

    public function product_track(Request $request)
    {
        $data['order_status'] = DB::table('status_record')
            ->where('order_id', $request->id)
            ->get();

        $data['address'] = DB::table('order_address')
            ->where('order_id', $request->id)
            ->first();

        $data['station_address'] = Setting::select('service_station_address')->first();

        return view('frontend.product.product_track', ['data' => $data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $products_cat = Category::where('status',1)->get();
        $data['category'] = $products_cat;
        $data['category_id'] = $id;
        $data['brand'] = Brand::get();

        if ($request->ajax()) {
            die("zxczxc");
        }

        return view('frontend.product.index', $data);
    }

    public function Shopping_cart()
    {
        $user = auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        if (isset($request->repeat_order_id) && $request->repeat_order_id != "") {
            $total_cart_product = DB::table('order_products')
                ->where('repeat_order_id', $request->order_id)
                ->get();
        } else {
            $total_cart_product = product_cart::where("user_id", $user_id)
                ->join('products', 'products.id', '=', 'product_carts.product_id')
                ->groupBy('products.id')
                ->select(
                    DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),
                    'products.stock as max_quantity',
                    'product_carts.quantity as product_quantity',
                    'products.id as product_id',
                    'products.title as product_name',
                    'products.sale_price as sale_price',
                    'products.price as price',
              		'products.currency as currency',
                    'products.id as  product_id',
                    'product_carts.id as id',
                    DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price')
                )
                ->get();
        }

        $discount = DB::table('used_coupons')
            ->where('user_id', $user_id)
            ->where('status',0)
            ->first();

        if ($discount) {
            $apply_coupon_discount = $discount->amount;
        } else {
            $apply_coupon_discount = 0;
        }

        if ($total_cart_product->count() > 0) {
            $dc = Setting::select('Delivery_charges')->first();
            $data['sub_total'] = $total_cart_product->SUM('total_price');
            // $data['shipping_charge'] = round($address->shipping_charge);
            $data['discount'] = $apply_coupon_discount;
            // $data['total'] =round(($total_cart_product->SUM('total_price') - $total_cart_product->SUM('total_price') *($apply_coupon_discount->discount/100)));
            $data['total'] = $total_cart_product->SUM('total_price') - $apply_coupon_discount;
            $data['delivery_charges'] = $dc->Delivery_charges;
            $data['product_list'] = $total_cart_product;
        } else {
            $dc = Setting::select('Delivery_charges')->first();
            $data['sub_total'] = 0;
            $data['delivery_charges'] = 0;
            $data['total'] = 0;
            $data['product_list'] = [];
        }

        $discount = DB::table('used_coupons')
            ->where('user_id', $user_id)
          	->where('status',0)
            ->first();

        if ($discount) {
            $apply_coupon_discount = $discount->amount;
        } else {
            $apply_coupon_discount = 0;
        }

        $data['country'] = DB::table('countries')->get();
        $data['discount'] = $apply_coupon_discount;

        return view('frontend.product.shopping_cart', ['data' => $data]);
    }

    function remove_coupon()
    {
        $user = auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;
        $total_cart_product = product_cart::where("user_id", $user_id)
            ->join('products', 'products.id', '=', 'product_carts.product_id')
            ->groupBy('products.id')
            ->select(
                DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),
                'products.stock as max_quantity',
                'product_carts.quantity as product_quantity',
                'products.id as product_id',
                'products.title as product_name',
                'products.sale_price as sale_price',
                'products.price as price',
                'products.id as  product_id',
                DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price')
            )
            ->get();

        $discount = DB::table('used_coupons')
            ->where('user_id', $user_id)
          	->where('status',0)
            ->delete();

        $discount = DB::table('used_coupons')
            ->where('user_id', $user_id)
            ->where('status',0)
            ->first();

        if ($discount) {
            $apply_coupon_discount = $discount->amount;
        } else {
            $apply_coupon_discount = 0;
        }

        if ($total_cart_product->count() > 0) {
            $dc = Setting::select('Delivery_charges')->first();

            $data['discount'] = "$" . $apply_coupon_discount;

            $data['sub_total'] = "$" . $total_cart_product->SUM('total_price');

            $data['delivery_charges'] = "$" . $dc->Delivery_charges;

            $data['total'] = "$" . $total_cart_product->SUM('total_price');
        } else {
            $dc = Setting::select('Delivery_charges')->first();

            $data['sub_total'] = 0;

            $data['delivery_charges'] = 0;

            $data['total'] = 0;
        }

        return response()->json(['success' => true, 'message' => "remove card", 'data' => $data], 200);
    }

    public function get_product_data(Request $request)
    {
        $user = Auth::user();
        $base_url = URL::to('/');

        $total_products = Product::where('category_id', $request->category_id)->get();
        $result = Product::groupBy('products.id')->where('status',1)
            ->select(
                'products.stock as max_quantity',
                'product_carts.quantity as product_quantity',
                'products.id as product_id',
                'products.image as image',
                DB::raw('ROUND(avg(review_ratings.star)) as product_rating'),
                'products.title as product_name',
                'products.price as price',
          'products.currency as currency',
                'products.sale_price as sale_price'
            )
            ->leftjoin('product_carts', function ($join) use ($user) {
                $join->on('product_carts.product_id', '=', 'products.id');
                $join->where('product_carts.user_id', '=', $user->id);
            })
            ->where('category_id', $request->category_id);

        if (!empty($request->brand_id)) {
            $result = $result->whereIn("brand_id", $request->brand_id);
        }
        if (isset($request->search)) {
            $result = $result->where('title', 'LIKE', "%{$request->search}%");
        }
        if (isset($request->max_price) && isset($request->min_price)) {
            $result = $result->where("sale_price", '>=', $request->min_price);
            $result = $result->where("sale_price", '<=', $request->max_price);
        }
        if (isset($request->sort_by)) {
            if ($request->sort_by == 1) {
                $result = $result->orderBy("total_views", "DESC");
            } elseif ($request->sort_by == 2) {
                $result = $result->orderBy("sale_price", "ASC");
            } elseif ($request->sort_by == 3) {
                $result = $result->orderBy("sale_price", "DESC");
            }
        } else {
            $result = $result->orderBy("total_views", "ASC");
        }

        $result = $result
            ->withCount([
                'favorites as liked' => function ($q) {
                    $q->where('user_id', auth()->id());
                },
            ])
            ->with('reviews')
            ->leftjoin('review_ratings', 'products.id', '=', 'review_ratings.item_id')
            ->withCasts(['liked' => 'boolean']);

        $total_p = $result->count();
        $min_p = $result->max('sale_price');
        $max_p = $result->min('sale_price');
        $result = $result->paginate(10);

        $data['products'] = $result;
        $data['total_products'] = $result->total();
        $data["max_price"] = $total_products->max('sale_price');
        $data["min_price"] = $total_products->min('sale_price');

        $view = view::make('frontend.product.product_list', ['items' => $result, 'current_page' => $request->page])->render();
        return response()->json(['html' => $view, 'last_page' => $result->lastpage(), 'max_price' => $total_products->max('sale_price'), 'min_price' => $total_products->min('sale_price')]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Product_details(Request $request, $id)
    {
        $base_url = URL::to('/');

        $user = Auth::user();

        $product = Product::find($id);

        $product_q = product_cart::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        if ($product_q) {
            $product_quantity = $product_q->quantity;
        } else {
            $product_quantity = 0;
        }

        $liked = Wishlist::where('user_id', $user->id)
            ->where('product_id', $id)
            ->count();

        $product_details = $this->getProductDetails($product);
        $product_d['product_id'] = $product_details->id;
        $product_d['title'] = $product_details->title;
        if ($liked > 0) {
            $product_d['liked'] = true;
        } else {
            $product_d['liked'] = false;
        }
        $product_d['wishlisted'] = 0;
        $product_d['price'] = $product->sale_price;
	 $product_d['currency'] = $product_details->currency;
        $product_d['max_quantity'] = $product_details->stock;
        $product_d['product_quantity'] = $product_quantity;
        $product_d['details'] = $product_details->short_description;

        if ($product_q) {
            $product_id['product_quantity'] = $product_q->quantity;
        }

        $product_id['product_quantity'] = 0;
        if ($product_details->stock > 0) {
            $product_d['in_stock'] = 1;
        } else {
            $product_d['in_stock'] = 0;
        }

        $product_d['features'] = $product_details->long_description;

        // $product_d['main_image'] = $product_details->image_url;

        //$img_list = $product_details->galleries;
        //$img_list[1]['image_url'] =  $product_details->image_url;
        //$img_list[1]['image'] =  $product_details->image;
        //$img_list[1]['product_id'] =  $product_details->product_id;

        $img_list = $product_details->galleries;

        if ($img_list->count() > 0) {
            $img_list[0]['image_url'] = $product_details->image_url;
            $img_list[0]['image'] = $product_details->image;
            $img_list[0]['product_id'] = $product_details->product_id;
        } else {
            $img_list = [];
            $img_list[0]['image_url'] = $product_details->image_url;
            $img_list[0]['image'] = $product_details->image;
            $img_list[0]['product_id'] = $product_details->product_id;
        }

        // $img_list[4]['id'] =  $product_details->image_url;

        $product_d['galleries'] = $img_list;

        $ReviewRating = ReviewRating::where('item_id', $product_details->id)->get();

        $one = 0;
        $two = 0;
        $three = 0;
        $four = 0;
        $five = 0;

        foreach ($ReviewRating as $data) {
            if ($data->star == 1) {
                $one++;
            }
            if ($data->star == 2) {
                $two++;
            }
            if ($data->star == 3) {
                $three++;
            }
            if ($data->star == 4) {
                $four++;
            }
            if ($data->star == 5) {
                $five++;
            }
        }
        $product_d["total_ratings"] = $one + $two + $three + $four + $five;
        $product_d["star_1"] = $one;
        $product_d["star_2"] = $two;
        $product_d["star_3"] = $three;
        $product_d["star_4"] = $four;
        $product_d["star_5"] = $five;

        $product_d['avg_rating'] = $product_d["total_ratings"] / 5;
        // echo  $product_details->product_id;
        // die;

        if ($request->ajax()) {
            $user['product_id'] = $id;
            $reviewRating = ReviewRating::select(
                'review_ratings.id as id',
                'review_ratings.helpful as helpful',
                'review_ratings.unhelpful as unhelpful',
                'review_ratings.comment as comment',
                'review_ratings.star as star',
                'review_ratings.created_at as date',
                DB::raw('DATE_FORMAT(review_ratings.created_at, "%d-%b-%Y") as date'),
                DB::raw("CONCAT('$base_url','/uploads/user_image/',users.image) AS image"),
                'users.name as user_name',
                'review_ratings.id as review_id'
            )
                ->join('users', 'users.id', '=', 'review_ratings.user_id')
                ->where("review_ratings.type", 1)
                ->where("review_ratings.item_id", $request->product_id);

            if ($request->filters == 5) {
                $reviewRating = $reviewRating->where("star", ">=", 3);
            }

            if ($request->filters == 4) {
                $reviewRating = $reviewRating->where("star", "<=", 3);
            }

            if ($request->filters == 2) {
                $reviewRating = $reviewRating->where("helpful", ">=", 3);
            }

            if ($request->filters == 3) {
                $reviewRating = $reviewRating->where("unhelpful", "<=", 3);
            }

            if ($request->filters == 1) {
                $reviewRating = $reviewRating->orderBy('star', 'DESC');
            }

            $reviewRating = $reviewRating->paginate(3);

            $view = view::make('frontend.product.comment_list', ['items' => $reviewRating, 'current_page' => $request->page, 'type' => 1])->render();
            return response()->json(['html' => $view, 'last_page' => $reviewRating->lastpage()]);
        }

        // $re_ratings = [];

        // foreach ($reviewRating as $review_data) {

        //     $user_data = User::find($review_data->user_id);

        //     $set_data = [
        //         "image" =>
        //             URL::to("/") . "/uploads/user_image/" . $user_data->image,
        //         "user_name" => $user_data->name,
        //         "date" => $user_data->created_at->format("d M Y"),
        //         "star" => $review_data->star,
        //         "comment" => $review_data->comment,
        //     ];

        //     $re_ratings[] = $set_data;
        // }

        // $product_d["review_rating"] = $reviewRating;

        $data['product'] = $product_d;

        // $data['review_rating'] = $re_ratings;
        $fav_product = Favourite_product::where("user_id", $user->id)
            ->pluck("product_id")
            ->toArray();

        // $sim_product = Product::active()->latest('total_views')->take(5)->get();
        // $filterd_data = [];
        // foreach ($sim_product as $data_1) {

        //     if (in_array($data_1->id, $fav_product)) {
        //         $data_1->is_favourite = 1;
        //     } else {
        //         $data_1->is_favourite = 0;
        //     }
        //     $data_1->product_rating = 4;
        //     $data_1->image = URL::to("/") . "/" . $data_1->image;

        //     $filterd_data_one = [
        //     "product_id" => $data_1->id,
        //         "image" => $data_1->image,
        //         "product_rating" => 4,
        //         "product_name" => $data_1->title,
        //         "price" => $data_1->price,
        //         "sale_price" => $data_1->sale_price,
        //         "is_favourite" => 1,
        //     ];
        //     $filterd_data[] = $filterd_data_one;
        // }

        $result = Product::groupBy('products.id')
            ->select('products.id as product_id','products.currency as currency', 'products.status as status', 'products.image as image', DB::raw('ROUND(avg(review_ratings.star)) as product_rating'), 'products.title as product_name', 'products.price as price', 'products.sale_price as sale_price')
            ->where('category_id', $product_details->category_id)
            ->where('products.id', "!=", $product_details->id)
            ->where('products.status', "=", "1")
            ->withCount([
                'favorites as liked' => function ($q) {
                    $q->where('user_id', auth()->id());
                },
            ])
            ->with('reviews')
            ->leftjoin('review_ratings', 'products.id', '=', 'review_ratings.item_id')
            ->withCasts(['liked' => 'boolean'])
            ->take(10)
            ->get();

        $data['similar_products'] = $result;
        //echo "<pre>";
        //print_r($data['similar_products']);
        //die;
        // $data['similer_product'] = $product_d;

        return view('frontend.product.product_details', ['similar_products' => $result, 'product_details' => $product_d]);
    }

    public function Checkout(Request $request)
    {
        $user = auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        $dc = Setting::select('Delivery_charges')->first();

        if (isset($request->repeat_order_id) && $request->repeat_order_id != "") {
            $total_cart_product = DB::table('order_products')
                ->where('repeat_order_id', $request->order_id)
                ->get();
        } else {
            $total_cart_product = product_cart::where("user_id", $user_id)
                ->join('products', 'products.id', '=', 'product_carts.product_id')
                ->groupBy('products.id')
                ->select(
                    DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),
                    'products.stock as max_quantity',
                    'product_carts.quantity as product_quantity',
                    'products.id as product_id',
                    'products.title as product_name',
                    'products.sale_price as sale_price',
                    'products.price as price',
              'products.currency as currency',
                    'products.id as  product_id',
                    DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price')
                )
                ->get();
        }

        if ($total_cart_product->count() == 0) {
            return Redirect::to("/")->with('verification_success', 'your message,here');
        }

        $discount = DB::table('used_coupons')
            ->where('user_id', $user_id)
          	->where('status',0)
            ->first();

        if ($discount) {
            $apply_coupon_discount = $discount->amount;
        } else {
            $apply_coupon_discount = 0;
        }

        if ($total_cart_product->count() > 0) {
            $dc = Setting::select('Delivery_charges')->first();

            $data['discount'] = $apply_coupon_discount;

            $data['sub_total'] = $total_cart_product->SUM('total_price');

            $data['delivery_charges'] = $dc->Delivery_charges;

            $data['total'] =$total_cart_product->SUM('total_price') - $data['discount'] + $dc->Delivery_charges;

            $data['product_list'] = $total_cart_product;
        } else {
            $dc = $request->session()->get('shhiping_charge');

            $data['sub_total'] = 0;

            $data['delivery_charges'] = 0;

            $data['total'] = 0;

            $data['product_list'] = [];

            $data['discount'] = 0;
        }

        $data['shipping_address'] = $request->session()->get('shipping_address');
        $data['shipping_post_code'] = $request->session()->get('shipping_post_code');

        $data['city'] = DB::table('countries')->get();
        $data['address'] = DB::table('addresses')
            ->where('user_id', $user_id)
            ->first();

        return view('frontend.product.checkout', ['data' => $data]);
    }

    public function Confirmation(Request $request, $id)
    {
        $order = Order::select('orders.*', DB::raw('DATE_FORMAT(orders.created_at, "%b %d,%Y  %h:%i %p") as date', 'orders.order_status as order_status'))
            ->where('id', $id)
            ->withCount('orderProducts')
            ->with('orderProducts.product.category', 'orderProducts.attributes')
            ->first();
        $order->delivery_date = DATE_FORMAT($order->created_at->addDays(5), "M d,Y");

        $order_address = DB::table('order_address')
            ->where('order_id', $order->id)
            ->first();

        $data['order_details'] = $order;
        $data['order_address'] = $order_address;

        return view('frontend.product.confirm', ['data' => $data]);
    }

    public function place_order(Request $request)
    {
        $order_id = 1;
        $dc = Setting::select('Delivery_charges')->first();
        $user = auth::user();

        $user_id = $user->id;

        if (isset($request->repeat_order_id) && $request->repeat_order_id != "") {
            $total_cart_product = DB::table('order_products')
                ->where('order_id', $request->repeat_order_id)
                ->get();
            // $total_cart_product = product_cart::where("user_id",$user_id)->get();
        } else {
            $total_cart_product = product_cart::where("user_id", $user_id)->get();
        }

        if ($total_cart_product->count() > 0) {
            $product_list = [];

            $i = 0;

            $total_price = 0;

            foreach ($total_cart_product as $value) {
                $single_product = Product::where("id", $value->product_id)->first();
                $total_price += $single_product->sale_price * $value->quantity;
                $product_list[$i]['product_id'] = $single_product->id;
                $product_list[$i]['product_price'] = $single_product->sale_price * $value->quantity;
                $product_list[$i]['product_name'] = $single_product->title;
                $product_list[$i]['product_quantity'] = $value->quantity;
                $i++;
            }

            $coupon = DB::table('used_coupons')
                ->where('user_id', $user_id)
              	->where('status',0)
                ->first();

            if ($coupon != null) {
                $total_price = $total_price - $coupon->amount;
                // DB::table('used_coupons')
                //     ->where('user_id', $user_id)
                //     ->delete();
            } else {
                $total_price = $total_price;
            }

            $data['product_list'] = $product_list;

            $subtotal = $total_price;

            $order_total = $total_price + $dc->Delivery_charges;
            $cart_items = $product_list;

            $payment_type = "Credit card";

            $same_address = 1;

            // Create Order
            $shipping_method = 1;
            $pickup_point_id = null;

            // Get manual payment
            if ($payment_type == 'offline') {
                $manual_payment = ManualPayment::where('name', $request['payment_method'])->first() ?? '';
            }

            $payment_method = "card";
            $uniqu_order_id = strtoupper(uniqid());

             if ($coupon) {
                $order_discount = $coupon->amount;
                $order_discount_coupon = $coupon->coupon;
                $order_discount = $coupon->amount;
            } else {
                $order_discount = null;
                $order_discount_coupon = null;
            }

            $source_id = $request->source_id;

            $seed = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789-='); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $rand = '';
            foreach (array_rand($seed, 25) as $k) {
                $rand .= $seed[$k];
            }

            $random_id = $rand . "-" . $user_id;

            $payment_data = [
                'idempotency_key' => $random_id,
                'amount_money' => [
                    'amount' => $order_total,
                    'currency' => 'USD',
                ],
                'source_id' => $source_id,
            ];

            $payment_json_data = json_encode($payment_data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer EAAAECmaiOY69xKEPhTkMYbjum-sTLg57idXiHctuxyPsJO817dQb_UiclLuHtJv']);
            curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_json_data);
            $result_payment = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            $result_payment = json_decode($result_payment, true);

            if (isset($result_payment['errors'])) {
                $success_data = [];
                return response()->json(['success' => false, 'message' => "payment cancel!", 'data' => $success_data], 200);
            } else {
                if ($result_payment['payment']['status'] == "COMPLETED") {
                    $ad_data = [
                        'user_id' => Auth::user()->id,
                        "first_name" => $request->first_name,
                        "last_name" => $request->last_name,
                        "email" => $request->email,
                        'address' => $request->session()->get('shipping_address'),
                        'area' => $request->area,
                        'country_id' => $request->country_id,
                        'state_id' => $request->state_id,
                        'city_id' => $request->city_id,
                        'zip_code' => $request->session()->get('shipping_post_code'),
                        'phone' => $request->phone,
                        'type' => $request->type,
                    ];
                    $address = DB::table('addresses')
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    if ($address) {
                        $address = DB::table('addresses')
                            ->where('user_id', Auth::user()->id)
                            ->update($ad_data);
                    } else {
                        DB::table('addresses')->insert($ad_data);
                    }

                    //shipping code

                    //end shipping code

                    $address = DB::table('addresses')
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    date_default_timezone_set('Asia/Kolkata');
                    $order = Order::create([
                        'order_no' => $uniqu_order_id,
                        'user_id' => $user_id,
                        'address_type' => $request->address_type,
                        'total_price' => $order_total,
                        'payment_status' => 'paid',
                        'payment_method' => "Card",
                        'manual_payment_id' => $manual_payment->id ?? '',
                        'coupon_type' => $order_discount_coupon,
                        'coupon_discount_amount' => $order_discount,
                        'discount_price' => $order_discount,
                        'subtotal_price' => $subtotal,
                        'notes' => "order place",
                        'shipping_method_id' => 1,
                        'shipping_pickup_point_id' => 0,
                       	'shipping_price' => $dc->Delivery_charges,
                        'guest_email' => $address->email,
                        'guest_name' => $address->first_name . " " . $address->last_name,
                        'order_status' => 'Processing',
                        'transaction_id' => $request->transaction_id,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

                    $order_id = $order->id;

                    $order_address = DB::table('order_address')->insert([
                        'order_id' => $order->id,
                        'first_name' => $address->first_name,
                        'last_name' => $address->last_name,
                        'company_name' => "adsd",
                        'country_id' => 100,
                        'state_id' => 50,
                        'city_id' => $address->city_id,
                        'email' => $address->email,
                        'phone' => $address->phone,
                        'address' => $address->address,
                        'zip_code' => $request->pincode,
                        'type' => $address->type,
                        'user_id' => $address->user_id,
                    ]);

                    $status_update = DB::table('status_record')->insert([
                        'order_id' => $order->id,
                        'type' => 1,
                        'status' => 'Processing',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

                    // Create Order Products
                    foreach ($cart_items as $content) {
                        $order_product = OrderProduct::create([
                            'order_id' => $order->id,
                            'user_id' => $user_id,
                            'product_id' => $content['product_id'],
                            'price' => $content['product_price'],
                            'quantity' => $content['product_quantity'],
                        ]);

                        // Order Product Attributes
                        // if ($content->attributesattribute && count($content->attributes->attribute)) {
                        //     foreach ($content->attributes->attribute as $attribute) {
                        //         OrderProductAttribute::create([
                        //             'order_product_id' => $order_product->id,
                        //             'attribute' => $attribute['attribute'],
                        //             'value' => $attribute['value']
                        //         ]);
                        //     }
                        // }

                        // Decrease product quantity && increase sold product quantity
                        $product = Product::find($content['product_id']);
                        $product->stock = $product->stock - $content['product_quantity'];
                        $product->total_orders = $product->total_orders + $content['product_quantity'];
                        $product->save();
                    }

                    $ms = "Your Order #" . $order->order_no . " has been Placed!";
                    $order_address = DB::table('notifications')->insert([
                        'user_id' => $user_id,
                        'type' => "App\Notifications\Frontend\OrderTrackNotification",
                        'notifiable_type' => "aasdsad",
                        'notifiable_id' => "adasdad",
                        'data' => $ms,
                        'read_at' => 1,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

                    // Transaction
                    Transaction::create([
                        'payment_method' => $payment_method,
                        'order_id' => $order->id,
                        'user_id' => auth('user')->check() ? auth('user')->id() : null,
                        'amount' => $order_total,
                    ]);

                    // DB::table('used_coupons')
                      //  ->where('user_id', $user_id)
                       // ->delete();
                  DB::table('used_coupons')
                   ->where('user_id', $user_id)
                   ->update(['status' => '1']);

                    $success_data['amount'] = $total_price + $dc->Delivery_charges;
                    $success_data['message'] =
                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio alias officiis labore consequuntur ullam incidunt minima minus eligendi. Alias deleniti tempora, molestias quas dolore illo ipsam blanditiis animi aspernatur! Reiciendis?";
                    $success_data['order_id'] = $uniqu_order_id;
                    $success_data['payment_type'] = 'card';
                    $success_data['Transection_time'] = Carbon::now()->format('d-M-y');
                    $success_data['name'] = $address->first_name . " " . $address->last_name;
                    $success_data['email'] = $address->email;
                    $success_data['mobile'] = $address->phone;
                    $total_cart_product = product_cart::where("user_id", $user_id)->delete();
                }

                return response()->json(['success' => true, 'message' => "success!", 'data' => $order->id], 200);
            }
        }

        return response()->json(['success' => true, 'message' => "success!", 'data' => $order_id], 200);
        // return redirect('/order-confirmation/'.$order->id);
    }

    public function My_order(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if ($request->ajax()) {
            $product_data = order::leftJoin('review_ratings AS c', function ($join) {
                $join->on('c.item_id', '=', 'orders.id')->where('c.type', '=', 1);
            })
                // leftjoin('review_ratings', 'review_ratings.item_id', '=', 'service_bookings.id','type', '=', 2)
                ->groupBy('orders.id')
                ->select(
                    DB::Raw("CONCAT('#','', orders.order_no) AS order_no"),
                    DB::raw('DATE_FORMAT(orders.created_at, "%b %d,%Y  %h:%i %p") as date'),
                    'orders.guest_name as name',
                    'orders.id as id',
                    'orders.total_price as total_price',
                    'orders.order_status as order_status',
                    'orders.order_no as order_id',
                    DB::raw("count(c.id) as review_rating_count")
                )
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->where("orders.user_id", $user_id)
                ->orderBy('orders.id', 'DESC')
                ->paginate(10);

            $view = view::make('frontend.product.order_data', ['items' => $product_data, 'current_page' => $request->page])->render();
            return response()->json(['html' => $view, 'last_page' => $product_data->lastpage()]);
        }

        return view('frontend.product.orderlist');
    }

    public function Order_detail(Request $request, $id)
    {
        $order = Order::select('orders.*', DB::raw('DATE_FORMAT(orders.created_at, "%b %d,%Y  %h:%i %p") as date', 'orders.order_status as order_status'))
            ->where('order_no', $id)
            ->withCount('orderProducts')
            ->with('orderProducts.product.category', 'orderProducts.attributes')
            ->first();
        $order->delivery_date = DATE_FORMAT($order->created_at->addDays(5), "M d,Y");
        $order->delivery_charge = Setting::select('Delivery_charges')->first()->Delivery_charges;

        $order_address = DB::table('order_address')
            ->where('order_id', $order->id)
            ->first();

        $data['order_details'] = $order;
        $data['order_address'] = $order_address;
        $data['product_list'] = $order->orderProducts;
        $data['order_status'] = DB::table('status_record')
            ->where('order_id', $order->id)
            ->get();
        // dd($data['order_status'][0]->id);

        return view('frontend.product.order_detail', ['data' => $data]);
    }

    public function applay_coupon(Request $request)
    {
        $dc = Setting::select('Delivery_charges')->first();
        $user_id = Auth::user()->id;

        $address = DB::table('addresses')
            ->where('user_id', $user_id)

            ->first();

        $validator = Validator::make($request->all(), [
            'coupon' => 'required',
        ]);

        if ($validator->fails()) {
            //$error =  $this->error_msg($validator->errors());
            // return $this->sendError($error,'');
            return response()->json(['success' => true, 'message' => $error, 'data' => $empty_data], 200);
        }

        $coupon = $request->coupon;
		
        $ap = DB::table('used_coupons')
            ->where('user_id', $user_id)
            ->where('coupon', $coupon)
            ->where('status',1)
            ->first();
		
        if ($ap) {
            $empty_data['discount'] = $ap->amount;
            return response()->json(['success' => true, 'message' => "Coupon already used!", 'data' => $empty_data], 200);
        } else {
            $coupon_data = Coupon::where('code', $coupon)->first();

            if ($coupon_data) {
                if ($coupon_data->total_uses >= $coupon_data->max_use) {
                    //$error =  ['Coupon limit expired!'];
                    //return $this->sendError($error,'');
                    $empty_data = [];
                    return response()->json(['success' => true, 'message' => "Coupon limit expired!", 'data' => $empty_data], 200);
                }
                $date_now = date("Y-m-d");
                if ($coupon_data->expire_date < $date_now) {
                    //$error =  ['Coupon  expired!'];
                    //return $this->sendError($error,'');
                    $empty_data = [];
                    return response()->json(['success' => true, 'message' => "Coupon  expired!", 'data' => $empty_data], 200);
                }

                if (isset($request->repeat_order_id) && $request->repeat_order_id != "") {
                    $total_cart_product = DB::table('order_products')
                        ->where('order_id', $request->repeat_order_id)
                        ->get();
                    // $total_cart_product = product_cart::where("user_id",$user_id)->get();
                } else {
                    $total_cart_product = product_cart::where("user_id", $user_id)->get();
                }

                // $dis_price = $coupon_data->discount;

                $i = 0;
                $coupon_apply_status = "yes";
                $total_price = 0;
                $discount = 0;
                $orig_price = 0;

                $total_cart_product = product_cart::where("user_id", $user_id)
                    ->join('products', 'products.id', '=', 'product_carts.product_id')
                    ->groupBy('products.id')
                    ->select(
                        'products.stock as max_quantity',
                        'product_carts.quantity as product_quantity',
                        'products.id as product_id',
                        'products.sale_price as sale_price',
                        DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price')
                    )
                    ->where("products.status", 1)
                    ->get();

                $coupon_data = Coupon::where('code', $coupon)->first();

                // $subtotal = $total_price;

                $data['sub_total'] = $total_cart_product->SUM('total_price');
                // $data['shipping_charge'] = round($address->shipping_charge);
                $data['discount'] = $coupon_data->discount;
                $data['total_amount'] = $total_cart_product->SUM('total_price') - $coupon_data->discount;

                $data['coupon_status'] = $coupon_apply_status;
                $datas[] = $data;
                if ($coupon_apply_status == "yes") {
                    DB::table('used_coupons')->insert(['user_id' => $user_id, 'coupon' => $request->coupon, 'amount' => $data['discount']]);
                    return response()->json(['success' => true, 'message' => "Coupon has been added!", 'data' => $datas], 200);
                    //return $this->sendResponse($data, "Coupon has been added!");
                } else {
                    return response()->json(['success' => true, 'message' => "This Order has no discount!", 'data' => $datas], 200);
                    //return $this->sendResponse($data, "this product has no discount!");
                }
            } else {
                $data = [];
                return response()->json(['success' => true, 'message' => "Coupon Not Found!", 'data' => $data], 200);
            }
        }
    }

    function Review_action(Request $request)
    {
        $get_user = Review_detail::where('user_id', Auth::user()->id)
            ->where('item_id', $request->product_id)
            ->where('review_id', $request->review_id)
            ->first();

        $reviewRating = ReviewRating::where('id', $request->review_id)->first();

        $Review_detail = new Review_detail();
        $Review_detail->item_id = $request->product_id;
        $Review_detail->user_id = Auth::user()->id;
        $Review_detail->type = $request->review_type;
        $Review_detail->review_id = $request->review_id;
        $Review_detail->save();

        $update_r = ReviewRating::where('id', $request->review_id)->first();
        if ($request->review_type == 1) {
            $count = $reviewRating->helpful + 1;
            $update_r->helpful = $count;
        } else {
            $count = $reviewRating->helpful + 1;
            $update_r->unhelpful = $count;
        }

        $update_r->save();

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addreview(Request $request)
    {
        if (isset($request->type)) {
            $type = $request->type;
        } else {
            $type = 1;
        }

        if (isset($request->review_title)) {
            $review_title = $request->review_title;
        } else {
            $review_title = "";
        }
        $rating = new ReviewRating();
        $rating->item_id = $request->product_id;
        $rating->user_id = Auth::user()->id;
        $rating->type = $type;
        $rating->title = $review_title;
        $rating->star = $request->rating;
        $rating->comment = $request->comment;
        $rating->save();

        return true;
    }

    public function delete_cart(Request $request)
    {
        $product_q = product_cart::where('id', $request->id)->delete();
        return true;
    }

    public function helpAction(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        $order->order_status = "cancelled";
        $order->save();
        return true;
    }

    public function get_shipping_rate(Request $request)
    {
        $dc = Setting::select('Delivery_charges')->first();
        $user_id = Auth::user()->id;

        $ap = DB::table('used_coupons')
            ->where('user_id', $user_id)
          	->where('status', 0)
            ->first();
        if ($ap != null) {
            $coupon_data = Coupon::where('code', $ap->coupon)->first();
        }

        $request->session()->put('shipping_address', "" . $request->address . "");
        $request->session()->put('shipping_post_code', "" . $request->post_code . "");
        $request->session()->put('shipping_city', "" . $request->city_id . "");
        $request->session()->put('shipping_country', "" . $request->country_id . "");
        $request->session()->put('shipping_state', "" . $request->state_id . "");

        $total_cart_product = product_cart::where("user_id", Auth::user()->id)
            ->join('products', 'products.id', '=', 'product_carts.product_id')
            ->groupBy('products.id')
            ->select(
                'products.stock as max_quantity',
                'product_carts.quantity as product_quantity',
                'products.id as product_id',
                'products.title as product_name',
                'products.sale_price as sale_price',
                'products.price as price',
                'products.id as  product_id',
                DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price')
            )
            ->get();

        if ($ap != null) {
		
            return  $total_cart_product->SUM('total_price') - $coupon_data->discount + $dc->Delivery_charges;
            // $total_cart_product->SUM('total_price')+ $dc->Delivery_charges -round($coupon/100);
        } else {
            return $total_cart_product->SUM('total_price') + $dc->Delivery_charges;
        }
    }
  
  	
  	  public function repeat_order(Request $request){

        $user = Auth::user();
      
        $user_id = $user->id;

        $update_cart = product_cart::where("user_id", $user_id)->delete();
        DB::table('used_coupons')
            ->where('user_id', $user_id)
          	->where('status', 0)
            ->delete();

        $repeat_order_id = $request->repeat_order_id;

        $total_cart_product = DB::table('order_products')
            ->where('order_id', $request->repeat_order_id)
            ->get();

        foreach ($total_cart_product as $cart_data) {
            $add_car = new product_cart();

            $add_car->user_id = $user_id;

            $add_car->product_id = $cart_data->product_id;

            $add_car->quantity = $cart_data->quantity;

            $add_car->save();
        }
        
        return $total_cart_product->count();
    }
}

