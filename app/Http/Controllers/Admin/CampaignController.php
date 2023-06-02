<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\CampaignOffer;
use App\Models\CampaignProduct;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;

class CampaignController extends Controller
{
    public function campaignList()
    {
        $campaigns = Campaign::all();
        return view('website.pages.campaign.campaign-list', compact('campaigns'));
    }

    public function campaignDetails(Campaign $campaign)
    {
        $campaign->load('campaignProducts.product');
        return view('website.pages.campaign.campaign-details', compact('campaign'));
    }

    public function index(Request $request)
    {
        abort_if(!userCan('campaign.view'), 403);

        $query = Campaign::query();

        if ($request->has('title') && $request->title != null) {
            $query->where('title', 'LIKE', "%$request->title%");
        }

        if ($request->has('status') && $request->status != null) {
            $query->where('status', $request->status);
        }

        $campaigns = $query->latest()->paginate(20);
        $campaigns->appends($request->all());

        return view('admin.campaign.index', compact('campaigns'));
    }

    public function create()
    {
        $products = Product::active()->get(['id', 'title', 'slug']);
        return view('admin.campaign.create', compact('products'));
    }

    public function store(Request $request)
    {
        abort_if(!userCan('campaign.create'), 403);

        $request->validate([
            'title' => 'required|unique:campaigns,title',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_type' => 'required',
            'discount_amount' => 'required|integer',
            'products' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $campaign = Campaign::create([
            'title' => $request->title,
            'start_date' => formatDate($request->start_date, 'Y-m-d H:i:s'),
            'end_date' => formatDate($request->end_date, 'Y-m-d H:i:s'),
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_amount,
            'status' => $request->status ? true : false
        ]);

        if ($campaign) {
            if ($request->has('image')) {

                $image =  uploadImage($request->image, 'campaign/image');
                $campaign->update([
                    'image' => $image,
                ]);
            }

            foreach ($request->products as $id) {
                CampaignProduct::create([
                    'campaign_id' => $campaign->id,
                    'product_id' => $id,
                ]);
                if ($campaign->status) {
                    $product = Product::FindOrFail($id);
                    $price = $product->sale_price == null ? $product->price : $product->sale_price;

                    if ($request->discount_type === 'amount') {
                        $last_price = $price - $request->discount_amount;
                    } else {
                        $discount = $request->discount_amount / 100 * $price;
                        $last_price = $price - $discount;
                    }
                    $product->update([
                        'sale_price' => $price,
                        'price' => $last_price,
                    ]);
                }
            };
        };

        flashSuccess('Campaign created !');
        return redirect()->route('campaigns.index');
    }

    public function edit(Campaign $campaign)
    {
        abort_if(!userCan('campaign.update'), 403);

        $campaign->load('campaignProducts');
        $products = Product::active()->get(['id', 'title', 'slug']);
        return view('admin.campaign.edit', compact('campaign', 'products'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        abort_if(!userCan('campaign.update'), 403);

        $request->validate([
            'title' => 'required|unique:campaigns,title,' . $campaign->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_type' => 'required',
            'discount_amount' => 'required|integer',
            'products' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $campaign->update([
            'title' => $request->title,
            'start_date' => formatDate($request->start_date, 'Y-m-d H:i:s'),
            'end_date' => formatDate($request->end_date, 'Y-m-d H:i:s'),
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_amount,
            'status' => $request->status ? true : false
        ]);

        if ($request->has('image')) {

            deleteImage($campaign->image);
            $image =  uploadImage($request->image, '/campaign/image');
            $campaign->update([
                'image' => $image,
            ]);
        }

        $products = CampaignProduct::where('campaign_id', $campaign->id)->get();
        $removedProduct = $products->whereNotIn('product_id', $request->products);
        // reset removed products
        foreach ($removedProduct as $removedCamProduct) {
            $product = Product::FindOrFail($removedCamProduct->product_id);
            $product->update([
                'sale_price' => null,
                'price' => $product->sale_price,
            ]);
        };

        foreach ($products as $product) {
            $product->delete();
        };
        foreach ($request->products as $id) {
            // create campaign product list
            CampaignProduct::create([
                'campaign_id' => $campaign->id,
                'product_id' => $id,
            ]);
            if ($campaign->status) {
                // find product
                $product = Product::FindOrFail($id);
                // if not available sale_price then price will be sale_price
                $price = $product->sale_price == null ? $product->price : $product->sale_price;
                // then - discount amount or percentage from price
                // ==== if discount amount =====
                if ($request->discount_type === 'amount') {
                    $last_price = $price - $request->discount_amount;
                } else { //==== for percentage =====
                    $discount = $request->discount_amount / 100 * $price;
                    $last_price = $price - $discount;
                }
                $product->update([
                    'sale_price' => $price,
                    'price' => $last_price,
                ]);
            }
        };
        flashSuccess('Campaign updated !');
        return redirect()->route('campaigns.index');
    }

    public function show(Campaign $campaign)
    {
        abort_if(!userCan('campaign.view'), 403);

        $products = $campaign->campaignProducts()->with('product:id,title,sale_price,price')->get();
        return view('admin.campaign.show', compact('campaign', 'products'));
    }

    public function destroy(Campaign $campaign)
    {
        abort_if(!userCan('campaign.delete'), 403);

        $products = CampaignProduct::where('campaign_id', $campaign->id)->get();

        foreach ($products as $campaign_product) {
            // find product
            $product = Product::FindOrFail($campaign_product->product_id);
            $product->update([
                'sale_price' => null,
                'price' => $product->sale_price,
            ]);
        };

        $campaign->delete();

        flashSuccess('Campaign deleted !');
        return redirect()->back();
    }

    public function updateStatus(Request $request, Campaign $campaign)
    {
        abort_if(!userCan('campaign.update'), 403);

        $products = CampaignProduct::where('campaign_id', $campaign->id)->get();

        if ($request->status) {
            foreach ($products as $campaign_product) {
                // find product
                $product = Product::FindOrFail($campaign_product->product_id);
                // if not available sale_price then price will be sale_price
                $price = $product->sale_price == null ? $product->price : $product->sale_price;
                // then - discount amount or percentage from price
                // ==== if discount amount =====
                if ($campaign->discount_type === 'amount') {
                    $last_price = $price - $campaign->discount_amount;
                } else { //==== for percentage =====
                    $discount = $campaign->discount_amount / 100 * $price;
                    $last_price = $price - $discount;
                }
                $product->update([
                    'sale_price' => $price,
                    'price' => $last_price,
                ]);
            };
        } else {
            foreach ($products as $campaign_product) {
                // find product
                $product = Product::FindOrFail($campaign_product->product_id);
                $product->update([
                    'sale_price' => null,
                    'price' => $product->sale_price,
                ]);
            };
        }

        $campaign->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Succuss !']);
    }

    public function homePageBannerUpdate(Request $request)
    {
        $campaign_offer = CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->get();

        if ($campaign_offer && count($campaign_offer) == 2) {
            $campaign_offer[0]->update(['campaign_id' => $request->banner_campaign]);
            $campaign_offer[1]->update(['campaign_id' => $request->banner_campaign_2]);
        } else {
            if ($campaign_offer && count($campaign_offer) == 1) {
                $campaign_offer->delete();
            }

            if ($request->banner_campaign) {
                $campaign_offer = CampaignOffer::create([
                    'home_page_content_id' => $request->home_page_content_id,
                    'campaign_id' => $request->banner_campaign,
                ]);
            }

            if ($request->banner_campaign_2) {
                $campaign_offer = CampaignOffer::create([
                    'home_page_content_id' => $request->home_page_content_id,
                    'campaign_id' => $request->banner_campaign_2,
                ]);
            }
        }

        flashSuccess('Home page banner campaign updated successfully');
        return back();
    }

    public function homePageFeaturedProductUpdate(Request $request)
    {
        $camapign_offer = CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->first();

        if ($camapign_offer) {
            $camapign_offer->update([
                'campaign_id' => $request->campaign,
            ]);
        } else {
            CampaignOffer::create([
                'home_page_content_id' => $request->home_page_content_id,
                'campaign_id' => $request->campaign,
            ]);
        }

        flashSuccess('Home page featured product campaign updated successfully');
        return back();
    }

    public function homePageOfferUpdate(Request $request)
    {
        $campaign_offer = CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->get();

        if ($campaign_offer && count($campaign_offer) == 2) {
            $campaign_offer[0]->update(['campaign_id' => $request->campaign]);
            $campaign_offer[1]->update(['campaign_id' => $request->campaign_2]);
        } else {
            if ($campaign_offer && count($campaign_offer) == 1) {
                $campaign_offer->delete();
            }

            if ($request->campaign) {
                $campaign_offer = CampaignOffer::create([
                    'home_page_content_id' => $request->home_page_content_id,
                    'campaign_id' => $request->campaign,
                ]);
            }

            if ($request->campaign_2) {
                $campaign_offer = CampaignOffer::create([
                    'home_page_content_id' => $request->home_page_content_id,
                    'campaign_id' => $request->campaign_2,
                ]);
            }
        }

        flashSuccess('Home page campaign updated successfully');
        return back();
    }

    public function homePageOffer2Update(Request $request)
    {
        $camapign_offer = CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->first();

        if ($camapign_offer) {
            $camapign_offer->update([
                'campaign_id' => $request->campaign,
            ]);
        } else {
            CampaignOffer::create([
                'home_page_content_id' => $request->home_page_content_id,
                'campaign_id' => $request->campaign,
            ]);
        }

        flashSuccess('Home page campaign updated successfully');
        return back();
    }

    public function homePageTopHeaderUpdate(Request $request)
    {
        $camapign_offer = CampaignOffer::where('home_page_content_id', $request->home_page_content_id)->first();

        if ($camapign_offer) {
            $camapign_offer->update([
                'campaign_id' => $request->campaign,
            ]);
        } else {
            CampaignOffer::create([
                'home_page_content_id' => $request->home_page_content_id,
                'campaign_id' => $request->campaign,
            ]);
        }

        flashSuccess('Home page top header campaign updated successfully');
        return back();
    }
}
