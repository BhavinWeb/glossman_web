<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SocialiteController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\DriverController;


Route::prefix('admin')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {
        // reset password
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
            Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::post('password/reset', 'reset')->name('admin.password.update');
            Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
        });
    });


    Route::middleware(['auth:admin'])->group(function () {
        //Dashboard Route
        Route::controller(AdminController::class)->group(function () {
            Route::get('/',  'dashboard');
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
            Route::post('/admin/search', 'search')->name('admin.search');
            Route::post('/admin/notification/read', 'notificationRead')->name('admin.notification.read');
            Route::get('/admin/all/notifications', 'allNotifications')->name('admin.all.notification');
        });
		
      
      // DRIVER ROUTES 
            Route::get('/driver', [DriverController::class, 'index'])->name('admin.driver');
            Route::get('/driver-create', [DriverController::class, 'create'])->name('driver.create');
            Route::post('/driver-store', [DriverController::class, 'store'])->name('driver.store');
            Route::get('/driver-edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
            Route::post('/driver-update', [DriverController::class, 'update'])->name('driver.update');
            Route::any('/driver-destroy/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');
            Route::get('/driver-status/change', [DriverController::class, 'status_change'])->name('driver.status.change');

        //Profile Route
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile/settings', 'setting')->name('profile.setting');
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/profile', 'profile_update')->name('profile.update');
        });

        //Roles Route
        Route::resource('role', RolesController::class);

        //Users Route
        Route::resource('user', UserController::class);
        Route::resource('campaigns', CampaignController::class);
        Route::post('campaigns/status/change/{campaign}', [CampaignController::class, 'updateStatus'])->name('campaigns.update.status');

        // ========================================================
        // ====================Setting=============================
        // ========================================================
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('general', 'general')->name('general');
            Route::put('general', 'generalUpdate')->name('general.update');
            Route::put('social-update', 'social_links')->name('general.social_links');
            Route::put('payment-update', 'paymentUpdate')->name('general.payment.update');
            Route::put('aboutus', 'static_Update')->name('general.static');
            Route::get('layout', 'layout')->name('layout');
            Route::put('layout', 'layoutUpdate')->name('layout.update');
            Route::put('mode', 'modeUpdate')->name('mode.update');
            Route::get('theme', 'theme')->name('theme');
            Route::put('theme', 'colorUpdate')->name('theme.update');
            Route::get('custom', 'custom')->name('custom');
            Route::put('custom', 'custumCSSJSUpdate')->name('custom.update');
            Route::get('email', 'email')->name('email');
            Route::put('email', 'emailUpdate')->name('email.update');
            Route::post('test-email', 'testEmailSent')->name('email.test');

            // sytem update
            Route::get('system', 'system')->name('system');
            Route::put('system/update', 'systemUpdate')->name('system.update');

            // website setting end
            Route::put('webiste/preference/update', 'websitePreferenceUpdate')->name('website.preference.update');
            Route::put('mode/commingsoon', 'modeCommingsoon')->name('mode.commingsoon');
            Route::put('mode/maintaince', 'modeMaintaince')->name('mode.maintaince');
            Route::put('search/indexing', 'searchIndexing')->name('search.indexing');
            Route::put('google-analytics', 'googleAnalytics')->name('google.analytics');
            Route::put('facebook-pixel', 'facebookPixel')->name('facebook.pixel');
            Route::put('allowLangChanging', 'allowLaguageChanage')->name('allow.langChange');
            Route::put('change/timezone', 'timezone')->name('change.timezone');

            // cookies routes
            Route::get('cookies', 'cookies')->name('cookies');
            Route::put('cookies/update', 'cookiesUpdate')->name('cookies.update');

            // seo
            Route::get('seo/index', 'seoIndex')->name('seo.index');
            Route::get('seo/edit/{page}', 'seoEdit')->name('seo.edit');
            Route::put('seo/update/{page}', 'seoUpdate')->name('seo.update');

            // databse backup
            Route::get('database/backup/index', 'backupIndex')->name('database.backup.index');
            Route::post('database/backup/store', 'backupStore')->name('database.backup.store');
            Route::delete('database/backup/destroy/{file}', 'backupDestroy')->name('database.backup.destroy');
            Route::get('database/backup/download/{file}', 'backupDownload')->name('database.backup.download');

            // recaptcha Update
            Route::put('recaptcha/update', 'recaptchaUpdate')->name('recaptcha.update');
            Route::post('recaptcha/update/status', 'recaptchaUpdateStatus')->name('recaptcha.status.update');
        });

        Route::controller(SocialiteController::class)->group(function () {
            Route::get('settings/social-login', 'index')->name('settings.social.login');
            Route::put('settings/social-login', 'update')->name('settings.social.login.update');
            Route::post('settings/social-login/status', 'updateStatus')->name('settings.social.login.status.update');
        });

        Route::controller(PaymentController::class)->group(function () {
        });

        Route::controller(PaymentController::class)->prefix('settings/payment')->name('settings.')->group(function () {
            // Automatic Payment
            Route::get('settings/payment', 'index')->name('payment');
            Route::put('settings/payment', 'update')->name('payment.update');
            Route::post('settings/payment/status', 'updateStatus')->name('payment.status.update');

            // Manual Payment
            Route::get('/manual', 'manualPayment')->name('payment.manual');
            Route::post('/manual/store', 'manualPaymentStore')->name('payment.manual.store');
            Route::get('/manual/{manual_payment}/edit', 'manualPaymentEdit')->name('payment.manual.edit');
            Route::put('/manual/{manual_payment}/update', 'manualPaymentUpdate')->name('payment.manual.update');
            Route::delete('/manual/{manual_payment}/delete', 'manualPaymentDelete')->name('payment.manual.delete');
            Route::get('/manual/status/change', 'manualPaymentStatus')->name('payment.manual.status');
        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('settings/payment', 'index')->name('settings.payment');
            Route::put('settings/payment', 'update')->name('settings.payment.update');
            Route::post('settings/payment/status', 'updateStatus')->name('settings.payment.status.update');
        });

        Route::controller(CmsController::class)->group(function () {
            Route::get('settings/cms', 'index')->name('settings.cms');
            Route::put('settings/cms', 'cmsUpdate')->name('settings.cms.update');
            // Route::put('settings/payment', 'update')->name('settings.payment.update');
            // Route::post('settings/payment/status', 'updateStatus')->name('settings.payment.status.update');
            Route::post('settings/partners/add', 'partnersStore')->name('settings.website.partner.store');
            Route::delete('settings/partner/delete/{id}', 'partnersDelete')->name('settings.website.partner.delete');
        });

        Route::controller(WebsiteSettingController::class)->prefix('settings/website')->name('settings.website.homepage.')->group(function () {
            Route::get('homepage/contents', 'homepageContents')->name('contents');
            Route::post('homepage/contents/status', 'homepageContentsStatusUpdate')->name('status');
            Route::post('homepage/contents/order', 'homepageContentsOrderUpdate')->name('order');
            Route::post('homepage/contents/shopCategory', 'homepageContentsShopCategory')->name('shopCategory');
            Route::post('homepage/contents/customCategory', 'homepageContentsCustomCategory')->name('customCategory');
            Route::post('homepage/contents/todaysDealProduct', 'homepageContentsTodaysDealProduct')->name('todaysDealProduct.update');
        });

        Route::controller(CampaignController::class)->group(function () {
            Route::post('campaign/homepage/banner', 'homePageBannerUpdate')->name('campaign.banner.update');
            Route::post('campaign/homepage/featured', 'homePageFeaturedProductUpdate')->name('campaign.featuredProduct');
            Route::post('campaign/homepage/offer', 'homePageOfferUpdate')->name('campaign.homepage.offer');
            Route::post('campaign/homepage/offer2', 'homePageOffer2Update')->name('campaign.homepage.offer2');
            Route::post('campaign/homepage/topheader', 'homePageTopHeaderUpdate')->name('campaign.homepage.topHeader');
        });
    });
});
