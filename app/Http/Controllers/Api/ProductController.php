<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Favourite_product;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\Address;
use Modules\Product\Entities\Product;
use App\Models\ReviewRating;
use App\Http\Traits\HasProduct;
use App\Http\Traits\PaymentTrait;
use App\Models\ManualPayment;
use App\Models\product_cart;
use App\Models\User;
use Modules\Order\Entities\OrderProduct;
use Modules\Order\Entities\Transaction;
use Modules\Coupon\Entities\Coupon;
use Modules\Wishlist\Entities\Wishlist;
use App\Models\service_carts;
//use App\Models\product_cart;
use Carbon\Carbon;
use App\Models\Cards;
use Validator;
use DB;
use URL;

class ProductController extends Controller
{
    use HasProduct, PaymentTrait;
    public function error_msg($errors)
    {
        $msg = $errors;
        $ii = 0;
        $i = [];
        foreach ($msg->all() as $ermsg) {
            $i[$ii] = $ermsg;
            $ii++;
        }
        return $i;
    }

    public function Add_address(Request $request)
    {
        try {
            $user = auth("sanctum")->user();

            $user_id = $user->id;

            $validator = Validator::make($request->all(), [
                'billing_first_name' => 'required',
                'billing_last_name' => 'required',
                'billing_email' => 'required|email',
                'billing_phone' => 'required',
                'billing_address' => 'required',
                'billing_area' => 'required',
                'address_type' => 'required',
                'country_code' => 'required',
                
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

                    $address = DB::table('addresses')
                        ->where('user_id', $user_id)
                        ->first();
                    $type = $request->address_type;
                    if ($address) {
                        DB::table('addresses')
                            ->where('user_id', $user_id)
                            ->update([
                                'first_name' => $request['billing_first_name'],
                                'last_name' => $request['billing_last_name'],
                                'company_name' => $request['billing_company_name'],
                                'country_id' => 38,
                                 // 'state_id' => $request['billing_state'],
                                // 'city_id' => $request['billing_city'],
                                'email' => $request['billing_email'],
                                'phone' => $request['billing_phone'],
                                'address' => $request['billing_address'],
                                'area' => $request['billing_area'],
                                // 'zip_code' => $request['zip_code'],
                                'type' => $type,
                                'user_id' => $user_id,
                                'country_code' => $request['country_code'],
                                'shipping_charge' => Setting::select('Delivery_charges')->first()->Delivery_charges,
                            ]);

                        $msg = "Address has been updated!";
                    } else {
                        DB::table('addresses')->insert([
                            'first_name' => $request['billing_first_name'],
                            'last_name' => $request['billing_last_name'],
                            'company_name' => $request['billing_company_name'],
                            'country_id' => 38,
                            // 'state_id' => $request['billing_state'],
                            // 'city_id' => $request['billing_city'],
                            'email' => $request['billing_email'],
                            'phone' => $request['billing_phone'],
                            'address' => $request['billing_address'],
                            'area' => $request['billing_area'],
                            // 'zip_code' => $request['zip_code'],
                            'type' => $type,
                            'user_id' => $user_id,
                            'country_code' => $request['country_code'],
                            'shipping_charge' => Setting::select('Delivery_charges')->first()->Delivery_charges,
                        ]);

                        $msg = "Address has been added!";
                    }

                    $data = [];

                    return response()->json(['success' => true, 'message' => $msg, 'data' => $data], 200);
                    //return $this->sendResponse($data, "Address has been added!");
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Something went wrong!"], 404);
        }
    }

    public function get_address(Request $request)
    {
        try {
            $user = auth("sanctum")->user();

            $user_id = $user->id;

            $address = DB::table('addresses')
                ->where('user_id', $user_id)
                ->get();
            if ($address) {
                $data['address'] = $address;
                return response()->json(['success' => true, 'message' => "User address data", 'data' => $data], 200);
            } else {
                $data['address'] = [];

                return response()->json(['success' => true, 'message' => "User address data!", 'data' => $data], 200);
            }

            //return $this->sendResponse($data, "Address data!");
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Something went wrong!"], 404);
        }
    }

    public function apply_coupons(Request $request)
    {
     
            $dc = Setting::select('Delivery_charges')->first();

            $user = auth("sanctum")->user();

            $user_id = $user->id;
            $address = DB::table('addresses')
                ->where('user_id', $user_id)
                ->first();
               
            $validator = Validator::make($request->all(), [
                'coupon' => 'required',
            ]);

            if ($validator->fails()) {
                //$error =  $this->error_msg($validator->errors());
                // return $this->sendError($error,'');
                return response()->json(['success' => true, 'message' =>  "Please enter coupon code" ], 200);
            }

            $coupon = $request->coupon;

            $ap = DB::table('used_coupons')
                ->where('user_id', $user_id)
                ->where('coupon', $coupon)
                ->where('status', 1)
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
                        'products.currency as currency',
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
                    $data['total_amount'] = - $total_cart_product->SUM('total_price') - $coupon_data->discount;
                    
                    $data['coupon_status'] = $coupon_apply_status;
                    $datas[] = $data;
                  	$insert_used_coupn = DB::table('used_coupons')->insert(['user_id' => $user_id, 'coupon' => $request->coupon, 'amount' => $coupon_data->discount]);
                   
                  if ($coupon_apply_status == "yes") {
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

    public function delete_coupon()
    {
        $user = auth("sanctum")->user();
        $user_id = $user->id;

        DB::table('used_coupons')
        ->where('user_id', $user_id)
        ->delete();

        return response()->json(['success' => true, 'message' => "Coupon Deleted!", 'data' => '' ], 200);
    }

    public function orderPlacing(Request $request)
    {
        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $dc = Setting::select('Delivery_charges')->first();

        $address = DB::table('addresses')
            ->where('user_id', $user_id)
            ->first();

        $validator = Validator::make($request->all(), [
            'source_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

        $user = auth("sanctum")->user();

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
                $single_product = Product::where("id", $value->product_id)
                    ->where("status", 1)
                    ->first();
                if ($single_product) {
                    $total_price += $single_product->sale_price * $value->quantity;
                    $product_list[$i]['product_id'] = $single_product->id;
                    $product_list[$i]['product_price'] = $single_product->sale_price * $value->quantity;
                    $product_list[$i]['product_name'] = $single_product->title;
                    $product_list[$i]['product_quantity'] = $value->quantity;
                    $i++;
                }
            }

            $coupon = DB::table('used_coupons')
                ->where('user_id', $user_id)
               	->where('status', 0)
                ->first();

            if ($coupon) {
                $total_price = $total_price - $coupon->amount;
               
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

            $payment_method = "Credit card";
            $uniqu_order_id = strtoupper(uniqid());

            if ($coupon) {
                $order_discount = $coupon->amount;
                $order_discount_coupon = $coupon->coupon;
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
            //dd($result_payment);
            if (isset($result_payment['errors'])) {
                $success_data = [];
                return response()->json(['success' => true, 'message' => "payment cancel!", 'data' => $success_data], 200);
            } else {
                if ($result_payment['payment']['status'] == "COMPLETED") {
                    $shipment_no = 0;
                    //$address = DB::table('addresses')->where('user_id',$user_id)->first();

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
                        'shipping_price' => round($address->shipping_charge),
                        'shipping_method_id' => 1,
                        'shipping_pickup_point_id' => 0,
                        'guest_email' => $address->email,
                        'guest_name' => $address->first_name . " " . $address->last_name,
                        'order_status' => 'Processing',
                        'shipment_number' => $shipment_no,
                        'transaction_id' => $request->transaction_id,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

                    $order_address = DB::table('order_address')->insert([
                        'order_id' => $order->id,
                        'first_name' => $address->first_name,
                        'last_name' => $address->last_name,
                        'company_name' => $address->company_name,
                        'country_id' => $address->country_id,
                        'state_id' => $address->state_id,
                        'city_id' => $address->city_id,
                        'email' => $address->email,
                        'phone' => $address->country_code . "" . $address->phone,
                        'address' => $address->address,
                        'zip_code' => $address->zip_code,
                        'type' => $address->type,
                        'user_id' => $address->user_id,
                        'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		                 'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

                    date_default_timezone_set('Asia/Kolkata');
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

                    $status_update = DB::table('status_record')->insert(
                        [
                            'order_id' =>  $order->id,
                            'status' => 'Processing',
                            'type' => 1,
                            'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                            'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                          
                        ]
                    );

                   // $status_update = DB::table('status_record')->insert(['order_id' => $order->id, 'type' => 1, 'status' => 'Processing']);

                    // Create Order Products
                    foreach ($cart_items as $content) {
                        $order_product = OrderProduct::create([
                            'order_id' => $order->id,
                            'user_id' => $user_id,
                            'product_id' => $content['product_id'],
                            'price' => $content['product_price'],
                            'quantity' => $content['product_quantity'],
                        ]);

                        // // Order Product Attributes
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

                    // Transaction
                    Transaction::create([
                        'payment_method' => $payment_method,
                        'order_id' => $order->id,
                        'user_id' => auth('user')->check() ? auth('user')->id() : null,
                        'amount' => $order_total,
                    ]);
                    //dd($total_price);

                    //DB::table('used_coupons')
                      //  ->where('user_id', $user_id)
                       // ->delete();
                  
                  $ap = DB::table('used_coupons')->where('user_id', $user_id)->update(['status' => '1']);
				
                  $success_data['amount'] = round($total_price + $dc->Delivery_charges);
                   
                    // dd( $success_data['amount']);

                    $success_data['message'] =
                        "Congratulation, " .
                        $address->first_name .
                        " " .
                        $address->last_name .
                        " ,your order has been placed with Glossman. You will shortly receive email on  " .
                        $address->email .
                        " and also confirmation on your mobile " .
                        $address->phone .
                        ". You have made the payment by using credit card of $" .
                        $success_data['amount'];
                    $success_data['order_id'] = $uniqu_order_id;
                    $success_data['payment_type'] = $payment_method;
                    $success_data['Transection_time'] = Carbon::now()->format('M d,Y H:i A');
                    $success_data['name'] = $address->first_name . " " . $address->last_name;
                    $success_data['email'] = $address->email;
                    $success_data['mobile'] = $address->phone;
                    $total_cart_product = product_cart::where("user_id", $user_id)->delete();
                    
                    return response()->json(['success' => true, 'message' => "Your Order has been placed!", 'data' => $success_data], 200);
                } else {
                    $success_data = [];
                    return response()->json(['success' => false, 'message' => "payment failed!"], 200);
                }
                //return $this->sendResponse($success_data, "Your Order has been placed!");

                // } catch (\Exception $e) {
                //    die("Xcvxcv");
                // }
            }
        } else {
            $data = [];

            return response()->json(['success' => true, 'message' => "Your cart is empty!", 'data' => $data], 200);
            //return $this->sendResponse($data, "Your cart is empty!");
        }
    }

    public function Order_list(Request $request)
    {
        
            // die("XCvxcv");
            $user = auth("sanctum")->user();
            $user_id = $user->id;
            $page = 1;

            if (isset($request->page)) {
                $page = $request->page;
            }

            $product_data = order::leftJoin('review_ratings AS c', function($join){
                $join->on('c.item_id', '=', 'orders.id')
                ->where('c.type', '=', 1);
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

            // // dd($product_data);

            // $order_list = [];

            // $i = 0;

            // foreach($product_data as $product_detail){
            //     $order_list[$i]['id'] = $product_detail->id;
            //     $order_list[$i]['name'] =  $product_detail->guest_name;
            //     $order_list[$i]['order_no'] = "#".$product_detail->order_no;
            //     // $order_list['date_time'] = $product_detail->created_at->toDateTimeString();
            //     $order_list[$i]['date_time'] =date('d-m-Y', strtotime($user->from_date));
            //     $order_list[$i]['status'] = $product_detail->order_status;
            //    $i++;
            // }
            // if ($product_data->currentpage() >= $product_data->lastpage()) {
            //     $data["is_last"] = 1;
            // } else {
            //     $data["is_last"] = 0;
            // }

            $data['orders'] = $product_data;
            // return $this->sendResponse($data, "Order List!");

            return response()->json(['success' => true, 'message' => "Order List!", 'data' => $data], 200);
        
    }

    public function Order_details(Request $request)
    {
        
            //$order = Order::select('orders.*',DB::raw('DATE_FORMAT(orders.created_at, "%b %d,%Y  %h:%i %p") as date'),DB::raw("(CASE WHEN orders.order_status='Pending' THEN 'Pending' WHEN orders.order_status='processing' THEN 'Processing' WHEN orders.order_status='on_the_way' THEN 'Shipped' WHEN orders.order_status='Delivered' THEN 'Delivered' ELSE 'Cancelled' END) as order_status"))->where('id', $request->order_id)->withCount('orderProducts')
            //->with('orderProducts.product.category','orderProducts.attributes')
            // ->first();

            $order = Order::select('orders.*', DB::raw('DATE_FORMAT(orders.created_at, "%b %d,%Y  %h:%i %p") as date', 'orders.order_status as order_status'))
                ->where('id', $request->order_id)
                ->withCount('orderProducts')
                ->with('orderProducts.product.category', 'orderProducts.attributes')
                ->first();
            $order->delivery_date = DATE_FORMAT($order->created_at->addDays(5), "M d,Y");

            $billing_address = Address::where('addressable_type', 'Modules\Order\Entities\Order')
                ->where('addressable_id', $order->id)
                ->where('type', $order->address_type)
                ->first();

            $shipping_address = Address::where('addressable_type', 'Modules\Order\Entities\Order')
                ->where('addressable_id', $order->id)
                ->where('type', 'shipping')
                ->first();

            $order_address = DB::table('order_address')
                ->where('order_id', $request->order_id)
                ->first();

            $data['order_details'] = $order;
            $data['order_address'] = $order_address;
            // $data['order_track'] = DB::table('status_record')
            //     ->where('order_id', $request->order_id)
            //     ->where('type', 1)
            //     ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))
            //     ->get();


            $success['proccess'] = DB::table('status_record')->Where('status_record.status','Processing')
            ->where('order_id', $request->order_id)
            ->where('type', 1)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();

            $success['on_the_way'] = DB::table('status_record')->Where('status_record.status', 'like', '%' . "on_the_way" . '%')
            ->where('order_id', $request->order_id)
            ->where('type', 1)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();

            $success['delivered'] = DB::table('status_record')->Where('status_record.status', 'like', '%' . "delivered" . '%')
            ->where('order_id', $request->order_id)
            ->where('type', 1)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();
           

            $data['order_track']= $success;
           
            if ($order) {
                //return $this->sendResponse($data, "Order details");
                return response()->json(['success' => true, 'message' => "Order details!", 'data' => $data], 200);
            } else {
                $data = [];

                return response()->json(['success' => true, 'message' => "Order details!", 'data' => $data], 200);
            }
       
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function product_category_list(Request $request)
    {
        $result = DB::table("categories")
            ->where("status", 1)
            ->get();
        if ($result->count() > 0) {
            foreach ($result as $data_1) {
                $data_1->image = URL::to("/") . "/" . $data_1->image;
            }
            $data["Product_category"] = $result;
            return $this->sendResponse($data, "Product Category List!");
        } else {
            return $this->sendResponse($data, "Product category  found");
        }
    }

    public function get_product_list(Request $request)
    {
        try {
            $user = auth("sanctum")->user();

            $base_url = URL::to('/');
            $total_products = Product::where('category_id', $request->product_category_id)->get();
            //$data['total_products'] =  $total_products;
            //$data["max_price"] = $total_products->max('sale_price');
            //$data["min_price"] = $total_products->min('sale_price');;
            //$result = Product::groupBy('products.id')->select('products.id as product_id','products.image as image',DB::raw('ROUND(avg(review_ratings.star)) as product_rating'),'products.title as product_name','products.price as price','products.sale_price as sale_price')->where('category_id',$request->product_category_id);
            $result = Product::groupBy('products.id')
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
                ->where('category_id', $request->product_category_id)
                ->where('status', 1);

            if (isset($request->brand_id)) {
                $str_arr = preg_split("/\,/", $request->brand_id);
                $result = $result->whereIn("brand_id", $str_arr);
            }
            if (isset($request->search)) {
                $result = $result->where('products.title', 'LIKE', "%{$request->search}%");
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

            //f(count($data['products'] == 0)){

            //$data = [];
            //  return $this->sendError($data, "Product List Not found!");

            //}
            if (count($result) == 0) {
                $data = [];
                return response()->json(['success' => false, 'message' => "Empty Product List"], 200);
            }

            return response()->json(['success' => true, 'message' => "Product List!", 'data' => $data], 200);
            //return $this->sendResponse($data, "Product List!");
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Something went wrong!"], 404);
        }
    }

    public function search_product(Request $request)
    {
        $searchTerm = $request->search;

        if ($searchTerm != "") {
            $result = Product::groupBy('products.id')
                ->select('products.id as product_id', 'products.image as image', DB::raw('ROUND(avg(review_ratings.star)) as product_rating'), 'products.title as product_name', 'products.price as price', 'products.sale_price as sale_price')
                ->where('title', 'LIKE', "%{$searchTerm}%")
                ->withCount([
                    'favorites as liked' => function ($q) {
                        $q->where('user_id', auth()->id());
                    },
                ])
                ->with('reviews')
                ->leftjoin('review_ratings', 'products.id', '=', 'review_ratings.item_id')
                ->withCasts(['liked' => 'boolean'])
                ->paginate(10);

            $data['products'] = $result;
        } else {
            $data['products'] = [];
        }

        return $this->sendResponse($data, "Search Product List!");
    }

    public function product_details(Request $request)
    {
        try {
            $base_url = URL::to('/');
            $user = auth("sanctum")->user();

            $product = Product::find($request->product_id);

            $product_q = product_cart::where('user_id', $user->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($product_q) {
                $product_quantity = $product_q->quantity;
            } else {
                $product_quantity = 1;
            }
            if ($product) {
                $liked = Wishlist::where('user_id', $user->id)
                    ->where('product_id', $request->product_id)
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
                $product_d['currency'] = $product->currency;
                $product_d['price'] = $product->sale_price;
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

                $reviewRating = ReviewRating::select(
                    'review_ratings.comment as comment',
                    'review_ratings.star as star',
                    DB::raw('DATE_FORMAT(review_ratings.created_at, "%d-%b-%Y") as date'),
                    DB::raw("CONCAT('$base_url','/uploads/user_image/',users.image) AS image"),
                    'users.name as user_name'
                )
                    ->join('users', 'users.id', '=', 'review_ratings.user_id')
                    ->where("type", 1)
                    ->where("item_id", $request->product_id)
                    ->paginate(3);

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

                $product_d["review_rating"] = $reviewRating;

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
                    ->select(
                        'products.id as product_id',
                        'products.image as image',
                        DB::raw('ROUND(avg(review_ratings.star)) as product_rating'),
                        'products.title as product_name',
                        'products.price as price',
                        'products.currency as currency',
                        'products.sale_price as sale_price'
                    )
                    ->where('category_id', $product_details->category_id)
                     ->where('status', 1)
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
                // $data['similer_product'] = $product_d;
            } else {
                return response()->json(['success' => false, 'message' => "Product Details!"], 200);
            }

            return response()->json(['success' => true, 'message' => "Product Details!", 'data' => $data], 200);

            //return $this->sendResponse($data, "Product Details!");
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Something went wrong!"], 404);
        }
    }

    public function cancel_order(Request $request)
    {
        $Order = Order::where('id', $request->order_id)->update(['order_status' => "cancelled"]);

        return $this->sendResponse([], "Cancel Order successfully!");
    }

    public function repeat_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'repeat_order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

        $user = auth("sanctum")->user();
        $user_id = $user->id;

        $update_cart = product_cart::where("user_id", $user_id)->delete();
        DB::table('used_coupons')
            ->where('user_id', $user_id)
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

        return response()->json(['success' => true, 'message' => "Update cart with repeat orders!", 'data' => []], 200);
    }

    public function order_success(Request $request)
    {
        $user = auth("sanctum")->user();
        $user_id = $user->id;

        $address = DB::table('addresses')
            ->where('user_id', $user_id)
            ->first();

        $result = Order::where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->take(1)
            ->update(['payment_status' => 'paid']);

        $results = Order::where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->first();

        $success_data['amount'] = $results->total_price;
        $success_data['message'] =
            "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio alias officiis labore consequuntur ullam incidunt minima minus eligendi. Alias deleniti tempora, molestias quas dolore illo ipsam blanditiis animi aspernatur! Reiciendis?";
        $success_data['order_id'] = $results->order_no;
        $success_data['payment_type'] = "Credit Card";
        $success_data['Transection_time'] = Carbon::now()->format('d-M-y');
        $success_data['name'] = $address->first_name . " " . $address->last_name;
        $success_data['email'] = $address->email;
        $success_data['mobile'] = $address->phone;

        return response()->json(['success' => true, 'message' => "payment success", 'data' => $success_data], 200);
    }
}
