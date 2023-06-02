<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use App\Models\BrowsingHistory;
use Google\Service\Vision\Symbol;
use Modules\Order\Entities\Order;
use Modules\Location\Entities\City;
use Modules\Order\Entities\Address;
use Modules\Review\Entities\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Location\Entities\State;
use App\Http\Traits\HasBrowseHistory;
use Modules\Product\Entities\Product;
use Modules\Location\Entities\Country;
use App\Http\Traits\HasCustomerSetting;
use Illuminate\Support\Facades\Session;
use Modules\Order\Entities\OrderProduct;

class DashboardController extends Controller
{
    use HasCustomerSetting, HasBrowseHistory;

    public function dashboard()
    {
        $data['orders'] = auth()->user()->orders()->withCount('orderProducts')->latest()->limit(3)->get();
        $data['products'] = OrderProduct::where('user_id', auth()->id())->latest()->with('product')->limit(6)->get();
        $data['billing_address'] = auth()->user()->billingAddress;
        $data['total_orders'] = auth()->user()->orders()->count();
        $data['pending_orders'] = auth()->user()->orders()->where('order_status', 'pending')->count();
        $data['completed_orders'] = auth()->user()->orders()->where('order_status', 'delivered')->count();

        return view('website.pages.customer.dashboard', $data);
    }

    public function orderHistory()
    {
        $orders = auth()->user()->orders()->latest()->withCount('orderProducts')->paginate(10);

        return view('website.pages.customer.order-history', compact('orders'));
    }

    public function address()
    {
        $billing_address = auth()->user()->billingAddress;
        $shipping_address = auth()->user()->shippingAddress;

        return view('website.pages.customer.address', compact('billing_address', 'shipping_address'));
    }

    public function browsingHistory(Request $request)
    {

        $query = $this->getBrowseHistory($request);

        $browse_products = $query->where('device_ip', substr(request()->ip(), 0, 7))
            ->latest()->with('product')->get()->groupBy(function ($item) {
                return $item->created_at->format('d-M-y');
            });

        return view('website.pages.customer.browsing-history', compact('browse_products'));
    }

    public function orderDetails(Request $request)
    {
        $order = Order::where('order_no', $request->order)->withCount('orderProducts')
            ->with('orderProducts.product.category','orderProducts.attributes')
            ->first();

        $billing_address = Address::where('addressable_type', 'Modules\Order\Entities\Order')
            ->where('addressable_id', $order->id)
            ->where('type', 'billing')
            ->first();
        $shipping_address = Address::where('addressable_type', 'Modules\Order\Entities\Order')
            ->where('addressable_id', $order->id)
            ->where('type', 'shipping')
            ->first();

        if ($order) {

            $activities = $order->notifications;
            return view('website.pages.customer.order-details', compact('order', 'billing_address', 'shipping_address', 'activities'));
        } else {

            return redirect()->back()->with('warning', 'No Order Found !');
        }
    }

    public function productReview(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'stars' => 'required',
        ]);

        $review_exists = Review::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$review_exists) {
            $review = Review::create([
                'order_id' => $request->order_id,
                'product_id' => $request->product_id,
                'user_id' =>  auth()->id(),
                'stars' => $request->stars,
                'comment' => $request->comment,
            ]);
            $review->product->increment('total_rated', 1);
            $review->product->increment('total_stars', $request->stars);

            return redirect()->back()->with('success', 'Review Submitted Successfully');
        } else {
            $review_exists->update([
                'stars' => $request->stars,
                'comment' => $request->comment,
            ]);

            return redirect()->back()->with('success', 'Review Updated Successfully');
        }
    }

    public function getProductReview(Request $request)
    {

        $review = Review::FindOrFail($request->data);
        return response()->json($review);
    }

    public function setting()
    {
        $countries = Country::all();
        $states = State::where('country_id', auth()->user()->country_id)->get();
        $cities = City::where('state_id', auth()->user()->state_id)->get();
        $billing_address = auth()->user()->billingAddress;
        $shipping_address = auth()->user()->shippingAddress;
        $billing_states = State::where('country_id', $billing_address ? $billing_address->country_id : '')->get();
        $shipping_states = State::where('country_id', $shipping_address ? $shipping_address->country_id : '')->get();
        $billing_cities = City::where('state_id', $billing_address ? $billing_address->state_id : '')->get();
        $shipping_cities = City::where('state_id', $shipping_address ? $shipping_address->state_id : '')->get();

        return view('website.pages.customer.setting', compact('countries', 'cities', 'states', 'billing_address', 'billing_states', 'billing_cities', 'shipping_address', 'shipping_states', 'shipping_cities'));
    }

    public function settingUpdate(Request $request)
    {
        $request->validate([
            'country' => 'required',
        ]);

        $this->customerProfileUpdate($request);

        flashSuccess('Data Updated !');
        return redirect()->back();
    }

    public function passwordUpdate(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
        ]);

        $user = User::FindOrFail(auth()->id());
        $old_pass = $user->password;

        if (Hash::check($request->current_password, $old_pass)) {
            $user->update([
                'password' => $request->password,
            ]);
            auth()->logout();
            flashSuccess('Password updated, Please login again.');
            return redirect()->back();
        } else {

            return redirect()->back()->with('current_password', 'Your old password does not match !');
        }
    }

    public function billingAddressUpdate(Request $request)
    {
        $value =  $this->customerBillingUpdate($request);
        if ($value == 'updated') {

            $value =  $this->customerBillingUpdate($request);
            if ($value == 'updated') {

                flashSuccess('Billing data updated');
                return redirect()->back();
            } else {

                flashSuccess('Billing address saved');
                return redirect()->back();
            }
        }
    }

    public function shippingAddressUpdate(Request $request)
    {

        $value = $this->customerShippingUpdate($request);

        if ($value == 'updated') {
            flashSuccess('Billing data updated');
            return redirect()->back();
        } else {
            flashSuccess('Billing address saved');
            return redirect()->back();
        }
    }


    public function toggleFavorite(Product $product)
    {

        $value = $product->favorites()->toggle(auth()->id());

        if ($value['attached'] == [1]) {
            $data = true;
        } else {
            $data = false;
        }
        $wishlists = auth()->user()->wishlists()->count();
        return response()->json(['data' => $data, 'wishlists' => $wishlists]);
    }

    public function wishlist()
    {
        $wishlists = auth()->user()->wishlists;

        return view('website.pages.shop.wishlist', compact('wishlists'));
    }

    public function getStates(Request $request)
    {

        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {

        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    public function removeFromHistory($product)
    {

        $product = BrowsingHistory::where('device_ip', substr(request()->ip(), 0, 7))->where('product_id', $product)->first();
        if ($product) {
            $product->delete();
        }
        return response()->json(true);
    }

    public function saveBrowseHistory(Request $request)
    {

        if ($request->save_browse_history) {

            Session::put('browse_history_save', true);
            flashSuccess('Your Browsing History Save On');
            return redirect()->back();
        } else {
            Session::forget('browse_history_save');
            flashSuccess('Your Browsing History Save Off');
            return redirect()->back();
        }
    }

    public function orderDownload(Order $order)
    {
        $order->load('shippingMethod', 'billingAddress', 'shippingAddress', 'orderProducts.product', 'customer');
        $view = view('order::generate.invoice', compact('order'));
        $html = $view->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false);

        return $pdf->download("invoice_" . $order->order_no . ".pdf");
    }
}
