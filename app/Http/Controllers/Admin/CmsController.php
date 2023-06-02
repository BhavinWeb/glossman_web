<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cms;
use App\Models\Partner;
use Illuminate\Http\Request;
use File;

use function PHPUnit\Framework\returnSelf;

class CmsController extends Controller
{
    public function index()
    {
        abort_if(!userCan('setting.view'), 403);

        $cms = Cms::first();
        $partners = Partner::latest()->get();

        return view('admin.settings.pages.cms', compact('cms', 'partners'));
    }

    public function cmsUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $cms = cms::first();
        if ($request->type == 'header') {
            $cms->welcome_message = $request->welcome_message;
            $cms->social_facebook = $request->social_facebook;
            $cms->social_twitter = $request->social_twitter;
            $cms->social_pinterest = $request->social_pinterest;
            $cms->social_reddit = $request->social_reddit;
            $cms->social_youtube = $request->social_youtube;
            $cms->social_instagram = $request->social_instagram;
        }

        if ($request->type == 'footer') {
            $cms->footer_title = $request->footer_title;
            $cms->footer_contact_number = $request->footer_contact_number;
            $cms->footer_email = $request->footer_email;
            $cms->footer_address = $request->footer_address;
            $cms->android_app_link = $request->android_app_link;
            $cms->ios_app_link = $request->ios_app_link;
            $cms->privary_page = $request->privary_page;
            $cms->terms_page = $request->terms_page;
            $cms->refund_policy_page = $request->refund_policy_page;
        }

        if ($request->type == 'about') {
            $cms->about_title = $request->about_title;
            $cms->about_sub_title = $request->about_sub_title;
            $cms->about_description = $request->about_description;
            if ($request->file('about_brand_logo')) {
                deleteImage($cms->about_brand_logo);
                $url = uploadImage($request->about_brand_logo, 'about');
                $cms->about_brand_logo = $url;
            }
        }
        if ($request->type == 'privacy') {
            $cms->privary_page = $request->privary_page;
        }
        if ($request->type == 'terms') {
            $cms->terms_page = $request->terms_page;
        }
        if ($request->type == 'refund') {
            $cms->refund_policy_page = $request->refund_policy_page;
        }

        if ($request->type == 'steps') {
            $request->validate([
                "shop_feature_step1_title" => "required",
                "shop_feature_step1_subtitle" => "required",
                "shop_feature_step2_title" => "required",
                "shop_feature_step2_subtitle" => "required",
                "shop_feature_step3_title" => "required",
                "shop_feature_step3_subtitle" => "required",
                "shop_feature_step4_title" => "required",
                "shop_feature_step4_subtitle" => "required",
                'shop_feature_step1_image' => ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:512'],
                'shop_feature_step2_image' => ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:512'],
                'shop_feature_step3_image' => ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:512'],
                'shop_feature_step4_image' => ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:512'],
            ]);

            $cms->shop_feature_step1_title = $request->shop_feature_step1_title;
            $cms->shop_feature_step1_subtitle = $request->shop_feature_step1_subtitle;
            $cms->shop_feature_step2_title = $request->shop_feature_step2_title;
            $cms->shop_feature_step2_subtitle = $request->shop_feature_step2_subtitle;
            $cms->shop_feature_step3_title = $request->shop_feature_step3_title;
            $cms->shop_feature_step3_subtitle = $request->shop_feature_step3_subtitle;
            $cms->shop_feature_step4_title = $request->shop_feature_step4_title;
            $cms->shop_feature_step4_subtitle = $request->shop_feature_step4_subtitle;

            if ($request->file('shop_feature_step1_image')) {
                if ($cms->shop_feature_step1_image !== 'frontend/image/features/package.png') {
                    deleteImage($cms->shop_feature_step1_image);
                }
                $url = uploadImage($request->shop_feature_step1_image, 'feature');
                $cms->shop_feature_step1_image = $url;
            }

            if ($request->file('shop_feature_step2_image')) {
                if ($cms->shop_feature_step2_image !== 'frontend/image/features/trophy.png') {
                    deleteImage($cms->shop_feature_step2_image);
                }
                $url = uploadImage($request->shop_feature_step2_image, 'feature');
                $cms->shop_feature_step2_image = $url;
            }

            if ($request->file('shop_feature_step3_image')) {
                if ($cms->shop_feature_step3_image !== 'frontend/image/features/creditcard.png') {
                    deleteImage($cms->shop_feature_step3_image);
                }
                $url = uploadImage($request->shop_feature_step3_image, 'feature');
                $cms->shop_feature_step3_image = $url;
            }

            if ($request->file('shop_feature_step4_image')) {
                if ($cms->shop_feature_step4_image !== 'frontend/image/features/headphones.png') {
                    deleteImage($cms->shop_feature_step4_image);
                }
                $url = uploadImage($request->shop_feature_step4_image, 'feature');
                $cms->shop_feature_step4_image = $url;
            }

            $cms->save();
            return back()->with('success', 'Application Feature Steps updated successfully!');
        }

        if ($request->hasFile('payment_methods_logo')) {

            $request->validate(
                [
                    'payment_methods_logo' => 'image|mimes:png,jpg,gif,pdf|dimensions:min_width=312,min_height=40'
                ],
                [
                    'dimensions' => 'The image size must be less than than 312x40'
                ]
            );

            if ($cms->payment_methods_logo !== '/frontend/image/payment-method.png') {
                deleteImage($cms->payment_methods_logo);
            }
            $url = uploadImage($request->payment_methods_logo, 'payment/methods');
            $cms->payment_methods_logo = $url;
        }

        if ($request->type == "403") {
            $cms->page403_title = $request->page403_title;
            $cms->page403_subtitle = $request->page403_subtitle;

            if ($request->hasFile('page403_image')) {
                deleteImage($cms->page403_image);
                $url = uploadImage($request->page403_image, '403');
                $cms->page403_image = $url;
            }
        }

        if ($request->type == "404") {
            $cms->page404_title = $request->page404_title;
            $cms->page404_subtitle = $request->page404_subtitle;

            if ($request->hasFile('page404_image')) {
                deleteImage($cms->page404_image);
                $url = uploadImage($request->page404_image, '404');
                $cms->page404_image = $url;
            }
        }

        if ($request->type == "500") {
            $cms->page500_title = $request->page500_title;
            $cms->page500_subtitle = $request->page500_subtitle;

            if ($request->hasFile('page500_image')) {
                deleteImage($cms->page500_image);
                $url = uploadImage($request->page500_image, '500');
                $cms->page500_image = $url;
            }
        }

        if ($request->type == "503") {
            $cms->page503_title = $request->page503_title;
            $cms->page503_subtitle = $request->page503_subtitle;

            if ($request->hasFile('page503_image')) {
                deleteImage($cms->page503_image);
                $url = uploadImage($request->page503_image, '503');
                $cms->page503_image = $url;
            }
        }

        if ($request->type == 'comingsoon') {
            $cms->comingsoon_title = $request->comingsoon_title;
            $cms->comingsoon_subtitle = $request->comingsoon_subtitle;
        }

        if ($request->type == 'maintenance_mode') {
            $cms->maintenance_title = $request->maintenance_title;
            $cms->maintenance_subtitle = $request->maintenance_subtitle;
        }

        $cms->save();

        return back()->with('success', 'Website setting updated successfully!');
    }

    public function partnersStore(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        foreach ($request->file as $image) {
            if ($image) {
                $url = uploadImage($image, 'cms/partners/');
                $name = $image->getClientOriginalName();
                Partner::create([
                    'name' => $name,
                    'logo' => $url,
                ]);
            }
        }

        return response()->json([
            'message' => 'Partners Saved Successfully',
            'url' => route('settings.cms')
        ]);
    }

    public function partnersDelete($id)
    {
        abort_if(!userCan('setting.update'), 403);

        $partner = Partner::findOrFail($id);
        deleteImage($partner->logo);
        $partner->delete();
        return redirect()->route('settings.cms')->with('success', 'Partner deleted successfully!');
    }

    //page404 Page
    public function updateErrorPages(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $cms = Cms::first();

        if ($request->type == "403") {
            $cms->page403_title = $request->page403_title;
            $cms->page403_subtitle = $request->page403_subtitle;

            if ($request->hasFile('page403_image')) {
                deleteImage($cms->page403_image);
                $url = uploadImage($request->page403_image, '403');
                $cms->page403_image = $url;
            }
        }

        if ($request->type == "404") {
            $cms->page404_title = $request->page404_title;
            $cms->page404_subtitle = $request->page404_subtitle;

            if ($request->hasFile('page404_image')) {
                deleteImage($cms->page404_image);
                $url = uploadImage($request->page404_image, '404');
                $cms->page404_image = $url;
            }
        }

        if ($request->type == "500") {
            $cms->page500_title = $request->page500_title;
            $cms->page500_subtitle = $request->page500_subtitle;

            if ($request->hasFile('page500_image')) {
                deleteImage($cms->page500_image);
                $url = uploadImage($request->page500_image, '500');
                $cms->page500_image = $url;
            }
        }

        if ($request->type == "503") {
            $cms->page503_title = $request->page503_title;
            $cms->page503_subtitle = $request->page503_subtitle;

            if ($request->hasFile('page503_image')) {
                deleteImage($cms->page503_image);
                $url = uploadImage($request->page503_image, '503');
                $cms->page503_image = $url;
            }
        }

        $cms->save();
        return back()->with('success', 'Error Page Upadate Successfully!');
    }
}
