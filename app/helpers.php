<?php

use Carbon\Carbon;
use App\Models\cms;
use App\Models\Seo;
use App\Models\Cookies;
use App\Models\Setting;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Currency\Entities\Currency;
use Modules\Language\Entities\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

// ========================================================
// ===================Response Function====================
// ========================================================

/**
 * Response success data collection
 *
 * @param object $data
 * @param string $responseName
 * @return \Illuminate\Http\Response
 */
function responseData(?object $data, string $responseName = 'data')
{
    return response()->json([
        'success' => true,
        $responseName => $data,
    ], 200);
}

/**
 * Response success data collection
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function responseSuccess(string $msg = "Success")
{
    return response()->json([
        'success' => true,
        'message' => $msg,
    ], 200);
}

/**
 * Response error data collection
 *
 * @param string $msg
 * @param int $code
 * @return \Illuminate\Http\Response
 */
function responseError(string $msg = 'Something went wrong, please try again', int $code = 404)
{
    return response()->json([
        'success' => false,
        'message' => $msg,
    ], $code);
}

/**
 * Response success flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashSuccess(string $msg)
{
    session()->flash('success', $msg);
}

/**
 * Response error flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashError(string $message = null)
{
    if (config('app.debug')) {
        return session()->flash('error', $message);
    } else {
        return session()->flash('error', 'Something went wrong, please try again');
    }
}

/**
 * Response warning flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashWarning(string $message)
{
    if (config('app.debug')) {
        return session()->flash('warning', $message);
    } else {
        return session()->flash('warning', 'please try again');
    }
}

// =====================================================
// ===================Image Function====================
// =====================================================

/**
 * image upload
 *
 * @param object $file
 * @param string $path
 * @return string
 */
function uploadImage(?object $file, string $path): string
{
    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('/uploads/' . $path . '/'), $fileName);

    return "uploads/$path/" . $fileName;
}

function deleteImage(?string $image)
{
    $imageExists = file_exists($image);

    if ($imageExists) {
        @unlink($image);
    }
}


/**
 * image delete
 *
 * @param string $image
 * @return void
 */
function deleteFile(?string $image)
{
    $imageExists = file_exists($image);

    if ($imageExists) {
        if ($imageExists != 'backend/image/default.png') {
            @unlink($image);
        }
    }
}

/**
 * @param UploadedFile $file
 * @param null $folder
 * @param string $disk
 * @param null $filename
 * @return false|string
 */
function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
{
    $name = !is_null($filename) ? $filename : uniqid('FILE_') . dechex(time());

    return $file->storeAs(
        $folder,
        $name . "." . $file->getClientOriginalExtension(),
        $disk
    );
}

/**
 * @param null $path
 * @param string $disk
 */
function deleteOne($path = null, $disk = 'public')
{
    Storage::disk($disk)->delete($path);
}

function uploadFileToStorage($file, string $path)
{
    $file_name = $file->hashName();
    Storage::putFileAs($path, $file,  $file_name);
    return $path . '/' .  $file_name;
}

function uploadFileToPublic($file, string $path)
{
    if ($file && $path) {
        $url = $file->move('uploads/' . $path, $file->hashName());
    } else {
        $url = null;
    }

    return $url;
}

// =====================================================
// ===================Env Function====================
// =====================================================

function envReplace($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name),
            $name . '=' . $value,
            file_get_contents($path)
        ));
    }
}

function setEnv($key, $value)
{
    if ($key && $value) {
        $env = new Env();
        $env->setValue($key, $value);
    }

    if (file_exists(App::getCachedConfigPath())) {
        Artisan::call("config:cache");
    }
}

function checkSetEnv($key, $value)
{
    if ((env($key) != $value)) {
        setEnv($key, $value);
    }
}

function setting($fields = null, $append = false)
{
    if ($fields) {
        $type = gettype($fields);

        if ($type == 'string') {
            $data = $append ? Setting::first($fields) : Setting::value($fields);
        } elseif ($type == 'array') {
            $data = Setting::first($fields);
        }
    } else {
        $data = Setting::first();
    }

    if ($append) {
        $data = $data->makeHidden(['logo_image_url', 'logo_image2_url', 'favicon_image_url']);
    }

    return $data;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function userCan($permission)
{
    return auth('admin')->user()->can($permission);
}

function error($name, $class = null)
{
    $classes = "is-invalid border-danger " . $class;
    $errors = session()->get('errors', app(ViewErrorBag::class));

    return $errors->has($name) ? $classes : '';
}

function errorHas($name, $classes = null)
{
    $errors = session()->get('errors', app(ViewErrorBag::class));

    return $errors->has($name) ? $classes : '';
}

function defaultCurrencySymbol()
{
    return config('zakirsoft.currency_symbol');
}

function currentLanguage()
{
    if (session()->has('admin_lang')) {
        $lang = Language::where('code', session('admin_lang'))->first();
    } else {
        $lang = Language::where('code', env('APP_DEFAULT_LANGUAGE', 'en'))->first();
    }

    return $lang;
}

function allowLaguageChanage()
{
    $status = Setting::first()->pluck('language_changing');
    if ($status == '[1]') {
        return true;
    } else {
        return false;
    }
}

// return first cookies data
function cookies()
{
    return Cookies::first();
}

function autoTransLation($lang, $text)
{
    $tr = new GoogleTranslate($lang);
    $afterTrans = $tr->translate($text);
    return $afterTrans;
}


function Notifications()
{
    return auth()->user()->notifications()->take(10)->get();
}

function unNotifications()
{
    return auth()->user()->unreadNotifications()->count();
}

function multiCurrency($price)
{
    if (config('zakirsoft.currency_symbol_position') == 'right') {
        return $price . ' ' . defaultCurrencySymbol();
    } else {
        return defaultCurrencySymbol() . ' ' . $price;
    }
    return $price;
}

function currencies()
{
    return Currency::all();
}

function formatDate($date, $format = 'F d, Y')
{
    return Carbon::parse($date)->format($format);
}

function formatStrTime($date)
{
    return date('Y-m-d', strtotime($date));
}
function inspireMe()
{
    Artisan::call('inspire');
    return Artisan::output();
}

function getUnsplashImage()
{
    $url = "https://source.unsplash.com/random/1920x1280/?park,mountain,ocean,sunset,travel";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $a = curl_exec($ch); // $a will contain all headers

    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    return $url;
}

function str_slug($title)
{
    return Str::slug($title);
}

function cms()
{
    return cms::first();
}


function checkMailConfig()
{
    $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

    return $status ? 1 : 0;
}

function socialMediaShareLinks(string $path, string $provider)
{
    switch ($provider) {
        case 'facebook':
            $share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $path;
            break;
        case 'twitter':
            $share_link = 'https://twitter.com/intent/tweet?text=' . $path;
            break;
        case 'pinterest':
            $share_link = 'http://pinterest.com/pin/create/button/?url=' . $path;
            break;
    }
    return $share_link;
}

function metaData($page)
{
    return Seo::where('page_slug', $page)->first();
}


/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
function adjustBrightness($hexCode, $adjustPercent)
{
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as &$color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}
