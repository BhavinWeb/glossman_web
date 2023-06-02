<?php

namespace App\Http\Controllers\Admin;

use App\Models\cms;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\CampaignOffer;
use App\Models\HomePageContent;
use Illuminate\Support\Facades\DB;
use Modules\Slider\Entities\Slider;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class WebsiteSettingController extends Controller
{
    public function homepageContents()
    {
        abort_if(!userCan('setting.update'), 403);

        $homepage_contents = HomePageContent::with('campaignOffer.campaign')->oldest('order')->get();
        $data['contents'] = $homepage_contents->where('id', '!=', 1);
        $data['banners'] = Slider::all();
        $data['categories'] = Category::all();
        $data['campaigns'] = Campaign::all();
        $data['top_header_content'] = $homepage_contents[0];
        $data['cms'] = cms::select('shop_feature_step1_image', 'shop_feature_step1_title', 'shop_feature_step1_subtitle', 'shop_feature_step2_image', 'shop_feature_step2_title', 'shop_feature_step2_subtitle', 'shop_feature_step3_image', 'shop_feature_step3_title', 'shop_feature_step3_subtitle', 'shop_feature_step4_image', 'shop_feature_step4_title', 'shop_feature_step4_subtitle')->first();

        $data['todays_deals_products'] = DB::table('todays_deal_products')
            ->join('products', 'products.id', '=', 'todays_deal_products.product_id')
            ->where('status', 1)
            ->get();

        $data['products'] = Product::active()->get();

        return view('admin.settings.pages.website.homepage_contents', $data);
    }

    public function homepageContentsStatusUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        HomePageContent::whereSlug($request->slug)->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function homepageContentsOrderUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $contents = HomePageContent::all();
        foreach ($contents as $content) {
            $content->timestamps = false;
            $id = $content->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $content->update(['order' => $order['position']]);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Home page sorted successfully']);
    }

    public function homepageContentsShopCategory(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'categories.*' => 'required',
        ]);

        $categories = Category::all();

        foreach ($categories as $category) {
            $category->timestamps = false;
            if ($request->categories && in_array($category->id, $request->categories)) {
                $category->update(['show_on_homepage_shop_categories' => 1]);
            } else {
                $category->update(['show_on_homepage_shop_categories' => 0]);
            }
        }

        flashSuccess('Home page categories updated successfully');
        return back();
    }

    public function homepageContentsCustomCategory(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'category' => 'required',
        ]);

        $categories = Category::all();

        foreach ($categories as $category) {
            $category->timestamps = false;
            if ($category->id == $request->category) {
                $category->update(['show_on_homepage_custom_category' => 1]);
            } else {
                $category->update(['show_on_homepage_custom_category' => 0]);
            }
        }

        CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->update([
            'campaign_id' => $request->campaign
        ]);

        flashSuccess('Home page categories updated successfully');
        return back();
    }

    public function homepageContentsTodaysDealProduct(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'products' => 'required',
        ]);

        DB::table('todays_deal_products')->truncate();

        foreach ($request->products as $product) {
            DB::table('todays_deal_products')->insert([
                'product_id' => $product,
                'updated_at' => now()
            ]);
        }

        flashSuccess('Home page todays deal updated successfully');
        return back();
    }
}
