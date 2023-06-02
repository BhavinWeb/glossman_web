<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminSearch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }


    public function dashboard(Request $request)
    {
        abort_if(!userCan('dashboard.view'), 403);

        // <!-- OverView -->
        $data['ordersAmount'] = Order::count();
        $data['productsAmount'] = Product::active()->count();
        $data['usersAmount'] = User::count();
        $data['brandsAmount'] = Brand::count();
        $data['categoriesAmount'] = Category::count();
        $data['totalEarnings'] = Order::where('order_status', 'delivered')->sum('total_price');

        // <!-- Table -->
        $data['recentOrders'] = Order::latest()->with('customer')->withCount('orderProducts')->take(10)->get();

        $products = Product::query();
        if ($request->has('filter') && $request->filter == 'trending') {
            $products->latest('total_views');
        }
        if ($request->has('filter') && $request->filter == 'best_rated') {
            $products->topRated();
        }
        if ($request->has('filter') && $request->filter == 'top_selling') {
            $products->bestSale();
        }
        $data['recentProducts'] = $products->latest()->active()->with('category')->take(10)->get();

        // <!-- Statistics -->

        // for order status
        $orders_status = Order::orderBy('order_status')->get()->groupBy(function ($item) {
            return $item->order_status;
        });

        $orders_status_key = [];
        $orders_status_data = [];

        foreach ($orders_status as $key => $value) {

            $orders_status_key[] = str_ireplace(array('_'), ' ', Str::ucfirst($key));
            $orders_status_data[] = $value->count();
        }
        $data['orders_status_key'] = json_encode($orders_status_key);
        $data['orders_status_data'] = json_encode($orders_status_data);

        // for category wise product sell
        $categories = Category::active()->parentCategory()->get();
        $categories_name = [];
        $sell_data = [];

        foreach ($categories as $category) {
            $categories_name[] = Str::ucfirst($category->name);
            $sell_data[] = $category->products->sum('total_orders');
        }
        $data['categories_name'] = json_encode($categories_name);
        $data['sell_data'] = json_encode($sell_data);

        // monthly earning status
        $earningsByMonth = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $earningsByMonth[$i] = (int)Order::select('total_price')
                ->where('order_status', 'delivered')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('total_price');
        }

        $data['earningsByMonth'] = $earningsByMonth;

        // <!-- Statistics End -->

        return view('admin.index', $data);
    }

    public function search(Request $request)
    {

        $pages = AdminSearch::where('page_title', 'LIKE', "%$request->data%")->limit(10)->get();

        return response()->json(['pages' => $pages]);
    }

    public function notificationRead()
    {

        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(true);
    }

    public function allNotifications()
    {

        $notifications = auth()->user()->notifications()->paginate(20);

        return view('admin.notifications', compact('notifications'));
    }
}
