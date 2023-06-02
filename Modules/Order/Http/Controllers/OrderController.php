<?php

namespace Modules\Order\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\GuestOrderTrackMail;
use Modules\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\OrderProduct;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Notification;
use Modules\Order\Entities\OrderProductAttribute;
use App\Notifications\Frontend\OrderTrackNotification;
use App\Notifications\Frontend\Customer\OrderStatusNotification;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        abort_if(!userCan('order.view'), 403);

        $allOrders = Order::select('order_status')->get();
        $stats = $allOrders->groupBy('order_status')->map->count();
        $stats['total'] = $allOrders->count();

        $query = Order::query();

        // ==============
        // |    Filter  |
        // ==============

        // <!-- for payment status -->
        if ($request->has('payment_status') && $request->payment_status != null) {
            if ($request->payment_status == 'unpaid') {

                $query->where('payment_status', 'unpaid');
            } else {
                $query->where('payment_status', 'paid');
            }
        }
        // <!-- for delivery status -->
        if ($request->has('delivery_status') && $request->delivery_status != null) {

            $query->where('order_status', $request->delivery_status);
        }
        // <!-- for keyword -->
        if ($request->has('keyword') && $request->keyword != null) {

            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('first_name', $request->keyword)
                    ->orWhere('last_name', $request->keyword);
            })->orWhere('order_no', $request->keyword);
        }

        $orders = $query->with('customer:id,first_name,last_name,email,image', 'manualPayment:id,name')->latest()->paginate(16);
        $orders->appends($request->all());

        return view('order::index', compact('orders', 'stats'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Order $order)
    {
        abort_if(!userCan('order.details'), 403);

        $order->load('shippingMethod', 'customer:id,first_name,last_name,email,image', 'billingAddress', 'shippingAddress', 'orderProducts.product', 'orderProducts.attributes', 'manualPayment:id,name');
        $order_address = DB::table('order_address')->where('order_id', $order->id)->first();
        
        if($order_address){
		$order_address = $order_address;
	}else{
		$order_address = [];
	}
        return view('order::show', compact('order','order_address'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function generate(Order $order)
    {
        abort_if(!userCan('order.download'), 403);

        $order->load('shippingMethod', 'billingAddress', 'shippingAddress', 'orderProducts.product', 'customer');
         $order_address = DB::table('order_address')->where('order_id', $order->id)->first();
        // return $order;
        $view = view('order::generate.invoice', compact('order','order_address'));
        $html = $view->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false);

        // return $pdf->stream();

        return $pdf->download("invoice_" . $order->order_no . ".pdf");
    }

    public function statusChange(Order $order, Request $request)
    {
        abort_if(!userCan('order.statusUpdate'), 403);
        
        $old_status = Order::select('order_status')->where('id',$order->id)->first();

        $order->update([
            'order_status' => $request->status,
        ]);
        

        //<!-- ❀❀❀❀❀❀❀❀❀❀ Make Notification To Order From Admin About Order Status Change ❀❀❀❀❀❀❀❀❀❀ -->
        $title = '';
        if ($request->status == 'pending') {
            $title = 'Your order is pending.';
        } elseif ($request->status == 'processing') {
            $title = 'Your order is now processing.';
        } elseif ($request->status == 'delivered') {
        
            if($old_status->order_status == 'processing'){
                DB::table('status_record')->insert(
                    [
                        'order_id' =>  $order->id,
                        'status' => "on_the_way",
                        'type' => 1,
                        'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                      
                    ]
                );
            }
            $title = 'Your order has been delivered. Thank you for shopping with ' . config('app.name') . '!';
        } elseif ($request->status == 'on_the_way') {
            $title = 'Your order is now in on the way.';
        } else {
            $title = 'Your order has been cancelled.';
        }
        
        
        		date_default_timezone_set('Asia/Kolkata');
		        $ms = "Your Order #".$order->order_no." has been".$request->status. " !";
		        $order_address = DB::table('notifications')->insert(
           		['user_id' =>$order->user_id,
           		'type' =>"App\Notifications\Frontend\OrderTrackNotification",
		        'notifiable_type' => "aasdsad",
		        'notifiable_id' => "adasdad",
		        'data' => $ms,
		        'read_at' =>1,
		        'created_at'=> Carbon::now()->setTimezone('Asia/Kolkata'),
		        'updated_at'=> Carbon::now()->setTimezone('Asia/Kolkata')]);
        
        //Notification::send($order, new OrderTrackNotification($title, $order));

        //<!-- ❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀ Make Notification To Customer For Track Order Status ❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀ -->
        if ($order->guest_email) {
            Mail::to($order->guest_email)->send(new GuestOrderTrackMail($order));
        }else{
            if ($order->user_id){
                $user = User::FindOrFail($order->user_id);
                Notification::route('mail', $user->email)->notify(new OrderStatusNotification($user, $order));
            }
        }
        
              DB::table('status_record')->insert(
		    [
		        'order_id' =>  $order->id,
		        'status' => $request->status,
		        'type' => 1,
		        'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		        'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		      
		    ]
		);
      
         //DB::table('status_record')->insert(['type'=>1,'order_id'=>$order->id,'status'=>$request->status]);

        flashSuccess('Order status change success !');
        return redirect()->back();
    }
    
    
    public function update_note(Request $request){
    
    	$Orders = Order::where('id',$request->order_id)->first();
    	$Orders->note = $request->note;
    	$Orders->save();
    
    	return true;
    }
    
    
}
