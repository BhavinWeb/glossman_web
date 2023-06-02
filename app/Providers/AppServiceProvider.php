<?php

namespace App\Providers;

use App\Models\cms;
use App\Models\Setting;
use App\Models\HomePageContent;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Language\Entities\Language;
use Modules\Product\Entities\ProductTag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (!app()->runningInConsole()) {
            $setting = Setting::first();
            $cms = Cms::first();
            $tags = ProductTag::join('product_tag', 'product_tag.tag_id', '=', 'product_tags.id')
                ->groupBy('product_tags.id')
                ->select(['product_tags.id', 'product_tags.name', 'product_tags.slug', DB::raw('COUNT(*) as tag_count')])
                ->orderBy('tag_count', 'desc')
                ->get(['id', 'name', 'tag_count'])
                ->take(10);

            view()->share('setting', $setting);
            view()->share('cms', $cms);
            view()->share('top_header_content', HomePageContent::with('campaignOffer.campaign')->first());
            view()->share('hcategories', Category::active()->parentCategory()->with('subcategories')->oldest('order')->get()->append('featured_products'));
            view()->share('languages', Language::all(['id', 'name', 'code', 'icon']));
            view()->share('tags', $tags);
            session()->put('comingsoon_mode', $setting->comingsoon_mode);
            $partners = Partner::all();
            view()->share('partners', $partners);
        }

        Blade::directive('formatDate', function ($datetime) {
            return "<?php echo ($datetime)->format('jS F, Y') ?>";
        });
    }
}
