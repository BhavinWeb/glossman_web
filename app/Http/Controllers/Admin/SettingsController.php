<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Cookies;
use App\Models\Setting;
use App\Models\Timezone;
use App\Traits\UploadAble;
use App\Mail\SmtpTestEmail;
use msztorc\LaravelEnv\Env;
use Illuminate\Http\Request;
use App\Models\DatabaseBackup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Entities\Currency;
use Modules\Currency\Http\Controllers\CurrencyController;
use Modules\Language\Entities\Language;
use Modules\Language\Http\Controllers\TranslationController;
use Modules\SetupGuide\Entities\SetupGuide;

class SettingsController extends Controller
{
    use UploadAble;

    public function __construct()
    {
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function general()
    {
        abort_if(!userCan('setting.view'), 403);

        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();
        return view('admin.settings.pages.general', compact('timezones', 'setting', 'currencies'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function theme()
    {
        abort_if(!userCan('setting.view'), 403);

        return view('admin.settings.pages.theme');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function custom()
    {
        abort_if(!userCan('setting.view'), 403);

        return view('admin.settings.pages.custom');
    }

    /**
     * Website Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function generalUpdate(Request $request)
    {
   
        abort_if(!userCan('setting.update'), 403);
        
        if($request->type == 1){
        	
        

        $request->validate([
            'app_name'      =>  ['required'],
            'logo_image'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'logo_image2'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'favicon_image'      =>  ['nullable', 'mimes:png,ico', 'max:1024'],
            'owner_email'      =>  ['nullable', 'email'],
        ]);

        $setting = Setting::first();
        $setting->owner_email = $request->owner_email;

        if ($request->app_name && $request->app_name != config('app.name')) {
            setEnv('APP_NAME', $request->app_name);
        }

        if ($request->service_station_address) {
            $setting['service_station_address'] = $request->service_station_address;
        }

        if ($request->service_station_lat) {
            $setting['service_station_lat'] = $request->service_station_lat;
        }

        if ($request->service_station_long) {
            $setting['service_station_long'] = $request->service_station_long;
        }

        if ($request->hasFile('logo_image')) {
            deleteFile($setting->logo_image);
            $setting['logo_image'] = uploadFileToPublic($request->logo_image, 'app/logo');
        }

        if ($request->hasFile('logo_image2')) {
            deleteFile($setting->logo_image2);
            $setting['logo_image2'] = uploadFileToPublic($request->logo_image2, 'app/logo');
        }

        if ($request->hasFile('favicon_image')) {
            deleteFile($setting->favicon_image);
            $setting['favicon_image'] = uploadFileToPublic($request->favicon_image, 'app/logo');
        }

        $setting->save();
        SetupGuide::where('task_name', 'app_setting')->update(['status' => 1]);
        
        }else{
        	$setting = Setting::first();
        	$setting->square_appid = $request->square_appid;
        	$setting->square_accesstoken = $request->square_accesstoken;
        	$setting->accountSid = $request->accountSid;
        	$setting->serviceSid = $request->serviceSid;
        	$setting->authtoken = $request->authToken;

        	$setting->save();
        }

        return back()->with('success', 'Website setting updated successfully!');
    }


    public function social_links(Request $request)
    {
   
        abort_if(!userCan('setting.update'), 403);
        
        if($request->type == 1){

        $setting = Setting::first();
        $setting->facebook = $request->facebook;
        $setting->youtube = $request->youtube;
        $setting->twitter = $request->twitter;
        $setting->google = $request->google;
        $setting->instagram = $request->instagram;
        $setting->save();

        return back()->with('success', 'Website setting updated successfully!');
        }
    }

    public function static_Update(Request $request){

        $setting = Setting::first();

        if(isset($request->about_us)){
            $setting->about_us = $request->about_us;
        }

        if(isset($request->privacy_policy)){
            $setting->privacy_policy = $request->privacy_policy;
        }

        if(isset($request->terms_condition)){
            $setting->terms_condition = $request->terms_condition;
        }

        $setting->save();
        
        return back()->with('success', 'updated successfully!');

    }
    
  
    /**
     * Update website layout
     *
     * @return void
     */
    public function layoutUpdate()
    {
        abort_if(!userCan('setting.update'), 403);

        Setting::first()->update(request()->only('default_layout'));

        return back()->with('success', 'Website layout updated successfully!');
    }

    /**
     * color Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function colorUpdate()
    {
        abort_if(!userCan('setting.update'), 403);

        Setting::first()->update(request()->only(['sidebar_color', 'nav_color', 'sidebar_txt_color', 'nav_txt_color', 'main_color', 'accent_color', 'frontend_primary_color', 'frontend_secondary_color', 'frontend_navbar_bg_color', 'frontend_navbar_txt_color']));

        SetupGuide::where('task_name', 'theme_setting')->update(['status' => 1]);

        return back()->with('success', 'Color setting updated successfully!');
    }

    /**
     * custom js and css Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function custumCSSJSUpdate()
    {
        abort_if(!userCan('setting.update'), 403);

        Setting::first()->update(request()->only(['header_css', 'header_script', 'body_script']));

        return back()->with('success', 'Custom css/js updated successfully!');
    }

    /**
     * Mode Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function modeUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $dark_mode = $request->only(['dark_mode']);
        Setting::first()->update($dark_mode);

        return back()->with('success', 'Theme updated successfully!');
    }

    public function email()
    {
        return view('admin.settings.pages.mail');
    }

    /**
     * Update mail configuration settings on .env file
     *
     * @param Request $request
     * @return void
     */
    public function emailUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'mail_host'     =>  ['required',],
            'mail_port'     =>  ['required', 'numeric'],
            'mail_username'     =>  ['required',],
            'mail_password'     =>  ['required',],
            'mail_encryption'     =>  ['required',],
            'mail_from_name'     =>  ['required',],
            'mail_from_address'     =>  ['required', 'email'],
        ]);

        $data = $request->only(['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_name', 'mail_from_address']);

        foreach ($data as $key => $value) {
            $env = new Env();
            $env->setValue(strtoupper($key), $value);
        }
        SetupGuide::where('task_name', 'smtp_setting')->update(['status' => 1]);

        return back()->with('success', 'Mail configuration update successfully');
    }


    /**
     * Send a test email for check mail configuration credentials
     *
     * @return void
     */
    public function testEmailSent()
    {
        request()->validate(['test_email' => ['required', 'email']]);
        try {
            Mail::to(request()->test_email)->send(new SmtpTestEmail);

            return back()->with('success', 'Test email sent successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid email configuration. Mail send failed.');
        }
    }



    /**
     * View Website mode page
     *
     * @return void
     */
    public function system()
    {
        abort_if(!userCan('setting.view'), 403);

        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();

        return view('admin.settings.pages.preference', compact('timezones', 'setting', 'currencies'));
    }

    public function systemUpdate(Request $request)
    {
        $request->validate(['app_url' => ['required', 'url']]);

        abort_if(!userCan('setting.update'), 403);

        if ($request->has('timezone')) {
            $this->timezone($request);
        }

        if ($request->has('app_url')) {
            setEnv('APP_URL', $request->app_url);
        }

        if ($request->has('code')) {
            (new TranslationController())->setDefaultLanguage($request);
        }

        if ($request->app_debug == 1) {
            setEnv('APP_DEBUG', 'true');
            // Artisan::call('env:set APP_DEBUG=true');
        } else {
            setEnv('APP_DEBUG', 'false');
            // Artisan::call('env:set APP_DEBUG=false');
        }

        if ($request->has('language_changing')) {
            $this->allowLanguageChange($request);
        }

        if ($request->has('currency')) {
            (new CurrencyController())->defaultCurrency($request);
        }

        flashSuccess('App Configuration Updated!');
        return redirect()->back();
    }

    public function websitePreferenceUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $setting = Setting::first();

        if ($request->comingsoon_mode) {
            setEnv('APP_MODE', 'comingsoon');
            return back()->with('success', 'App is in coming soon mode!');
        } elseif ($request->maintenance_mode) {
            setEnv('APP_MODE', 'maintenance');
            return back()->with('success', 'App is in maintenance mode!');
        } else {
            setEnv('APP_MODE', 'live');
            return back()->with('success', 'App is now live');
        }

        flashSuccess('Website Configuration Updated!');
        return redirect()->back();
    }


    /**
     * Commingsoon mode enable/disable
     *
     * @return void
     */
    public function modeCommingsoon($request)
    {
        abort_if(!userCan('setting.update'), 403);

        if ($request->comingsoon_mode == 1) {
            Setting::first()->update(['comingsoon_mode' => true]);
        } else {
            Setting::first()->update(['comingsoon_mode' => false]);
        }

        session()->put('comingsoon_mode', true);

        return back()->with('success', 'Comming soon mode enable successfully!');
    }


    /**
     * Maintance mode enable
     *
     * @return void
     */
    public function modeMaintaince()
    {
        abort_if(!userCan('setting.update'), 403);

        if (request()->has('maintenance_mode') && \request('maintenance_mode') == 1) {
            Artisan::call('down');

            return back()->with('success', 'Maintenance mode enable successfully!');
        }

        return back();
    }

    /**
     * Update search engine indexing setting
     *
     * @return void
     */
    public function searchIndexing($request)
    {
        abort_if(!userCan('setting.update'), 403);

        try {
            if ($request->has('search_engine_indexing') && $request->search_engine_indexing == 1) {
                $data = "User-agent: *\nDisallow:";
            } else {
                $data = "User-agent: *\nDisallow: /";
            }
            file_put_contents(\public_path('robots.txt'), $data);

            if ($request->search_engine_indexing == 1) {

                Setting::first()->update(['search_engine_indexing' => true]);
            } else {
                Setting::first()->update(['search_engine_indexing' => false]);
            }

            return back()->with('success', 'Search Engine Indexing update successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Search Engine Indexing update failed.');
        }
    }


    /**
     * Update google analytics setting
     *
     * @return void
     */
    public function googleAnalytics($request)
    {
        abort_if(!userCan('setting.update'), 403);

        if ($request->google_analytics == 1) {
            Setting::first()->update(['google_analytics' => true]);
        } else {
            Setting::first()->update(['google_analytics' => false]);
        }

        $env = new Env();
        $env->setValue(strtoupper('GOOGLE_ANALYTICS_ID'), request('google_analytics_id', ''));

        session()->put('google_analytics', request('google_analytics', 0));

        return back()->with('success', 'Google Analytics update successfully!');
    }


    /**
     * Update facebook pixel setting
     *
     * @return void
     */
    public function facebookPixel($request)
    {
        abort_if(!userCan('setting.update'), 403);

        $env = new Env();
        $env->setValue(strtoupper('FACEBOOK_PIXEL_ID'), request('facebook_pixel_id', ''));

        if ($request->facebook_pixel == 1) {

            Setting::first()->update([
                'facebook_pixel' => true,
            ]);
        } else {

            Setting::first()->update([
                'facebook_pixel' => false,
            ]);
        }

        session()->put('facebook_pixel', request('facebook_pixel', 0));

        return back()->with('success', 'Facebook Pixel update successfully!');
    }

    public function allowLanguageChange($request)
    {
        Setting::first()->update([
            'language_changing' => request('language_changing', 0)
        ]);

        flashSuccess('Language changing status changed!');
    }

    public function timezone($request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'timezone' => "required"
        ]);

        $timezone = $request->timezone;

        if ($timezone && $timezone != config('app.timezone')) {
            envReplace('APP_TIMEZONE', $timezone);

            flashSuccess('Timezone Updated Successfully!');
        }

        flashError('Timezone update failed!');
    }

    public function cookies()
    {
        abort_if(!userCan('setting.view'), 403);

        $cookie = Cookies::firstOrFail();

        return view('admin.settings.pages.cookies', compact('cookie'));
    }

    public function cookiesUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        // validating request data
        $request->validate([
            'cookie_name' => 'required|max:50|string',
            'cookie_expiration' => 'required|numeric|max:365',
            'title' => 'required',
            'description' => 'required',
            'approve_button_text' => 'required|string|max:30',
            'decline_button_text' => 'required|string|max:30',
        ]);
        // updating data to database
        $cookies = Cookies::first();
        $cookies->allow_cookies = request('allow_cookies', 0);
        $cookies->cookie_name = $request->cookie_name;
        $cookies->cookie_expiration = $request->cookie_expiration;
        $cookies->force_consent = request('force_consent', 0);
        $cookies->darkmode = request('darkmode', 0);
        $cookies->title = $request->title;
        $cookies->approve_button_text = $request->approve_button_text;
        $cookies->decline_button_text = $request->decline_button_text;
        $cookies->description = $request->description;
        $cookies->save();
        // flashing success message and redirecting back
        flashSuccess('Cookies settings successfully updated!');
        return back();
    }

    public function seoIndex()
    {
        abort_if(!userCan('setting.view'), 403);

        $seos = Seo::all();
        return view('admin.settings.pages.seo.index', compact('seos'));
    }

    public function seoEdit($page)
    {
        abort_if(!userCan('setting.update'), 403);

        $seo = Seo::FindOrFail($page);
        return view('admin.settings.pages.seo.edit', compact('seo'));
    }

    public function seoUpdate(Request $request, $page)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $page = Seo::where('page_slug', $page)->first();
        $page->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->image != null && $request->hasFile('image')) {

            deleteFile($page->image);

            $path = 'images/seo';
            $image = uploadImage($request->image, $path);

            $page->update([
                'image' => $image,
            ]);
        }

        flashSuccess('Page Meta Data Edited');

        return redirect()->route('settings.seo.index');
    }

    public function backupIndex()
    {
        abort_if(!userCan('setting.view'), 403);

        $backups = DatabaseBackup::latest()->paginate(20);
        return view('admin.settings.pages.database-backup', compact('backups'));
    }

    public function backupDownload(DatabaseBackup $file)
    {

        $path = $file->file_path;
        $fileName = $file->name;

        return response()->download($path, $fileName);
    }

    public function backupStore(Request $request)
    {

        Artisan::call('database:backup');

        flashSuccess('New backup is ready');
        return redirect()->back();
    }

    public function storeBackup($name, $path)
    {

        DatabaseBackup::create([
            'name' => $name,
            'file_path' => $path,
        ]);
    }

    public function backupDestroy(DatabaseBackup $file)
    {
        abort_if(!userCan('setting.update'), 403);

        $backup = $file->file_path;
        if (file_exists($backup)) {
            unlink($backup);
        }

        $file->delete();

        flashSuccess('Backup Deleted');
        return redirect()->back();
    }

    public function recaptchaUpdate(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $request->validate([
            'nocaptcha_key' => 'required',
            'nocaptcha_secret' => 'required',
        ]);

        checkSetEnv('NOCAPTCHA_SITEKEY', $request->nocaptcha_key);
        checkSetEnv('NOCAPTCHA_SECRET', $request->nocaptcha_secret);

        flashSuccess('Recaptcha Configuration updated!');
        return back();
    }

    public function recaptchaUpdateStatus(Request $request)
    {
        abort_if(!userCan('setting.update'), 403);

        $status = $request->status;

        setEnv('NOCAPTCHA_ACTIVE', $status ? 'true' : 'false');

        return response()->json(['success' => true]);
    }
}

