@extends('admin.settings.setting-layout')
@section('title')
    {{ __('website_settings') }}
@endsection
@section('website-settings')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active tab-header" data-id="header" data-toggle="pill"
                        href="#header">{{ __('header_settings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-footer" data-id="footer" data-toggle="pill"
                        href="#footer">{{ __('footer_settings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-about" data-id="about" data-toggle="pill" href="#about">{{ __('about_us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-privacy" data-id="privacy" data-toggle="pill"
                        href="#privacy">{{ __('privacy_policy') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-terms" data-id="terms" data-toggle="pill"
                        href="#terms">{{ __('terms_condition') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-refund" data-id="refund" data-toggle="pill"
                        href="#refund">{{ __('refund_policy') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-payment_methods_logo" data-id="payment_methods_logo" data-toggle="pill"
                        href="#payment_methods_logo">{{ __('payment_methods_logo') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-partners" data-id="partners" data-toggle="pill"
                        href="#partners">{{ __('partners') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-errorpage" data-id="errorpage" data-toggle="pill"
                        href="#errorpage">{{ __('error_pages') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-comingsoon" data-id="comingsoon" data-toggle="pill"
                        href="#comingsoon">{{ __('comingsoon') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-maintenance_mode" data-id="maintenance_mode" data-toggle="pill"
                        href="#maintenance_mode">{{ __('maintenance_mode') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            {{-- header settings --}}
            <div id="header" class="container tab-pane active">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="header">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('header_fields') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="welcome_message">{{ __('welcome_message') }}</label>
                                        <input type="text" class="form-control pl-2" name="welcome_message"
                                            value="{{ old('welcome_message', $cms->welcome_message) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">{{ __('social_links') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_facebook">{{ __('facebook_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_facebook"
                                            placeholder="Enter Link"
                                            value="{{ old('social_facebook', $cms->social_facebook) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_twitter">{{ __('twitter_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_twitter"
                                            placeholder="Enter Link"
                                            value="{{ old('social_twitter', $cms->social_twitter) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_pinterest">{{ __('pinterest_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_pinterest"
                                            placeholder="Enter Link"
                                            value="{{ old('social_pinterest', $cms->social_pinterest) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_reddit">{{ __('reddit_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_reddit"
                                            placeholder="Enter Link"
                                            value="{{ old('social_reddit', $cms->social_reddit) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_youtube">{{ __('youtube_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_youtube"
                                            placeholder="Enter Link"
                                            value="{{ old('social_youtube', $cms->social_youtube) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="social_instagram">{{ __('instagram_link') }}</label>
                                        <input type="text" class="form-control pl-2" name="social_instagram"
                                            placeholder="Enter Link"
                                            value="{{ old('social_instagram', $cms->social_instagram) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- footer settings --}}
            <div id="footer" class="container tab-pane">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('footer_fields') }}</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="type" value="footer">
                            <div class="row ">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="" for="app_name"> {{ __('footer_title') }} </label>
                                        <input value="{{ $cms->footer_title }}" name="footer_title" type="text"
                                            class="form-control " placeholder="{{ __('footer_title') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="" for="owner_name"> {{ __('footer_contact_number') }}
                                        </label>
                                        <input value="{{ $cms->footer_contact_number }}" name="footer_contact_number"
                                            type="text" class="form-control "
                                            placeholder="{{ __('footer_contact_number') }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="" for="owner_email"> {{ __('footer_address') }}
                                        </label>
                                        <input class="form-control" name="footer_address"
                                            value="{{ old('footer_address', $cms->footer_address) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="" for="owner_email"> {{ __('footer_email') }}
                                        </label>
                                        <input value="{{ $cms->footer_email }}" name="footer_email" type="email"
                                            class="form-control " placeholder="{{ __('footer_email') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class=""> {{ __('android_app_link') }}
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Remove the links to hide app links on website">
                                                <x-svg.info />
                                            </span>
                                        </label>
                                        <input value="{{ $cms->android_app_link }}" name="android_app_link" type="text"
                                            class="form-control " placeholder="{{ __('android_app_link') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class=""> {{ __('ios_app_link') }}
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Remove the links to hide app links on website">
                                                <x-svg.info />
                                            </span>
                                        </label>
                                        <input value="{{ $cms->ios_app_link }}" name="ios_app_link" type="text"
                                            class="form-control " placeholder="{{ __('ios_app_link') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- aboutus settings --}}
            <div id="about" class="container tab-pane">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('about_us_page') }}</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="type" value="about">
                            <div class="row mt-2">
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="about_title" :required="false" />
                                    <input value="{{ $cms->about_title }}" name="about_title" type="text"
                                        class="form-control " placeholder="{{ __('about_title') }}">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="about_sub_title" :required="false" />
                                    <input value="{{ $cms->about_sub_title }}" name="about_sub_title" type="text"
                                        class="form-control " placeholder="{{ __('about_sub_title') }}">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="about_description" labelclass="pt-2"
                                        :required="false" />
                                    <textarea id="editor4" type="text" class="form-control" name="about_description"
                                        placeholder="{{ __('about_description') }}">{{ $cms->about_description }}</textarea>
                                    @error('about_description')
                                        <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-lebel pt-2">{{ __('about_brand_logo') }}</label>
                                    <input name="about_brand_logo" type="file" accept="image/png, image/jpg, image/jpeg"
                                        class="form-control dropify  @error('image') is-invalid @enderror"
                                        data-default-file="{{ asset($cms->about_brand_logo) }}" data-max-file-size="3M"
                                        data-show-errors="true" data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                    @error('about_brand_logo')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- privacy settings --}}
            <div id="privacy" class="container tab-pane">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="privacy">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('privacy_policy_page') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <x-forms.label :required="false" name="privary_policy_page_content"
                                        class="" />
                                    <textarea id="editor1" type="text" class="form-control" name="privary_page"
                                        placeholder="{{ __('privary_policy_page') }}">{{ $cms->privary_page }}</textarea>
                                    @error('privary_page')
                                        <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- terms settings --}}
            <div id="terms" class="container tab-pane">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="terms">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('terms_condition_page') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <x-forms.label name="terms_conditons_page_content" class=""
                                        :required="false" />
                                    <textarea id="editor2" type="text" class="form-control" name="terms_page"
                                        placeholder="{{ __('terms_conditons_page_content') }}">{{ $cms->terms_page }}</textarea>
                                    @error('terms_page')
                                        <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- refund settings --}}
            <div id="refund" class="container tab-pane">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="refund">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('refund_policy_page') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <x-forms.label name="refund_policy_page_content" class=""
                                        :required="false" />
                                    <textarea id="editor3" type="text" class="form-control" name="refund_policy_page"
                                        placeholder="{{ __('refund_policy_page_content') }}">{{ $cms->refund_policy_page }}</textarea>
                                    @error('refund_policy_page')
                                        <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            <!-- Payment Method Logo -->
            <div id="payment_methods_logo" class="container tab-pane mb-4">
                <form class="form-horizontal" action="{{ route('settings.cms.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="payment_methods_logo">
                    <div class="mt-3">
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <x-forms.label name="payment_methods_logo" for="payment_logo" class=""
                                    :required="false" />
                                <input type="file" class="form-control dropify border-none"
                                    data-default-file="{{ $cms->payment_methods_logo }}" id="payment_logo"
                                    name="payment_methods_logo">
                                @error('payment_methods_logo')
                                    <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="form-group row mt-4 text-center">
                            <div class="offset-sm-12 col-sm-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            {{-- partners settings --}}
            <div id="partners" class="container tab-pane">
                <div class="container-fluid mb-50 pt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-dark d-flex justify-content-between align-items-center">
                                    <h6 class="d-inline mb-2"> {{ __('add_partner') }}</h6>
                                </div>
                                <div class="card-body">
                                    <form id="dropzoneForm" method="post"
                                        action="{{ route('settings.website.partner.store') }}"
                                        enctype="multipart/form-data" class="dropzone">
                                        @csrf
                                    </form>
                                    <div class="text-center mt-3">
                                        <button type="button" class="btn btn-success" id="submit-all"><i
                                                class="fas fa-sync"></i> {{ __('update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-dark line-height-36">{{ __('partner_list') }}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered  text-center mb-3">
                                        <thead class="text-dark">
                                            <tr>
                                                <th width="5%">{{ __('sl') }}</th>
                                                <th width="15%">{{ __('name') }}</th>
                                                <th width="10%">{{ __('logo') }}</th>
                                                <th width="15%">{{ __('action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($partners) != 0)
                                                @foreach ($partners as $partner)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $partner->name }}</td>
                                                        <td class="text-center">
                                                            @if ($partner->logo)
                                                                <img width="auto" height="24px"
                                                                    src="{{ asset($partner->logo) }}" alt=""
                                                                    class="bg-primary">
                                                            @else
                                                                <img width="72px" height="24px"
                                                                    src="{{ asset('admin/img/no-image.png') }}" alt="">
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <form
                                                                action="{{ route('settings.website.partner.delete', $partner->id) }}"
                                                                method="POST" class="d-inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button title="Delete Product"
                                                                    onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                    class="btn bg-danger"><i
                                                                        class="fas fa-trash text-light"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10" class="text-center">{{ __('nothing_found') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Error page --}}
            <div id="errorpage" class="container tab-pane pt-3">
                <div class="row">
                    {{-- 403 --}}
                    <div class="col-sm-12 col-md-6">
                        <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="403">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">403 {{ __('page') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page403_title"
                                                    value="{{ old('page403_title', $cms->page403_title) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_sub_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page403_subtitle"
                                                    value="{{ old('page403_subtitle', $cms->page403_subtitle) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>{{ __('error_image') }}:</label>
                                            <input name="page403_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->page403_image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="row my-3 justify-content-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                    {{-- 404 --}}
                    <div class="col-sm-12 col-md-6">
                        <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="404">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">404 {{ __('page') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page404_title"
                                                    value="{{ old('page404_title', $cms->page404_title) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_sub_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page404_subtitle"
                                                    value="{{ old('page404_subtitle', $cms->page404_subtitle) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>{{ __('error_image') }}:</label>
                                            <input name="page404_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->page404_image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="row my-3 justify-content-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                    {{-- 500 --}}
                    <div class="col-sm-12 col-md-6">
                        <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="500">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">500 {{ __('page') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page500_title"
                                                    value="{{ old('page500_title', $cms->page500_title) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_sub_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page500_subtitle"
                                                    value="{{ old('page500_subtitle', $cms->page500_subtitle) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>{{ __('error_image') }}:</label>
                                            <input name="page500_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->page500_image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="row my-3 justify-content-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                    {{-- 503 --}}
                    <div class="col-sm-12 col-md-6">
                        <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="503">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">503 {{ __('page') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page503_title"
                                                    value="{{ old('page503_title', $cms->page503_title) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('error_sub_title') }}:</label>
                                                <input type="text" class="form-control p-2" name="page503_subtitle"
                                                    value="{{ old('page503_subtitle', $cms->page503_subtitle) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>{{ __('error_image') }}:</label>
                                            <input name="page503_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->page503_image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="row my-3 justify-content-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            {{-- coming soon --}}
            <div id="comingsoon" class="container tab-pane pt-3">
                <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="type" value="comingsoon">
                    <div class="card">
                        <div class="card-header">{{ __('comingsoon_page') }}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('comingsoon_title') }}:</label>
                                        <input type="text" class="form-control p-2" name="comingsoon_title"
                                            value="{{ old('comingsoon_title', $cms->comingsoon_title) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('comingsoon_sub_title') }}:</label>
                                        <input type="text" class="form-control p-2" name="comingsoon_subtitle"
                                            value="{{ old('comingsoon_subtitle', $cms->comingsoon_subtitle) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row my-3 justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            {{-- maintenance_mode --}}
            <div id="maintenance_mode" class="container tab-pane pt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal" action="{{ route('settings.cms.update', $cms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="type" value="maintenance_mode">
                            <div class="row">
                                <div class="col-md-6 offset-3">
                                    <div class="form-group">
                                        <label for="maintenance_title"> {{ __('maintenance_title') }}
                                        </label>
                                        <input value="{{ old('maintenance_title', $cms->maintenance_title) }}"
                                            name="maintenance_title" type="text"
                                            class="form-control @error('maintenance_title') is-invalid @enderror"
                                            placeholder="{{ __('maintenance_title') }}" id="maintenance_title">
                                        @error('maintenance_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('maintenance_subtitle') }} :
                                        </label>
                                        <input class="form-control p-2 @error('maintenance_subtitle') is-invalid @enderror"
                                            name="maintenance_subtitle" placeholder="{{ __('maintenance_subtitle') }}"
                                            value="{{ $cms->maintenance_subtitle }}" />
                                        @error('maintenance_subtitle')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mx-auto d-flex justify-content-center mb-4">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- tab content ends here --}}
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropzone.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>

    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 805px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script src="{{ asset('backend') }}/js/dropzone.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });

        var tab = localStorage.getItem("setting-tab");
        if (tab) {
            if (
                tab == "header" ||
                tab == "footer" ||
                tab == "about" ||
                tab == "privacy" ||
                tab == "terms" ||
                tab == "refund" ||
                tab == "payment_methods_logo" ||
                tab == "partners" ||
                tab == "errorpage" ||
                tab == "comingsoon" ||
                tab == "maintenance_mode"
            ) {
                $('.tab-header').removeClass('active');
                $('#header').removeClass('active');
                $('#' + tab).addClass('active');
                $('.tab-' + tab).addClass('active');
            } else {
                if (
                    tab !== "header" ||
                    tab !== "footer" ||
                    tab !== "about" ||
                    tab !== "privacy" ||
                    tab !== "terms" ||
                    tab !== "refund" ||
                    tab !== "payment_methods_logo" ||
                    tab !== "partners" ||
                    tab !== "errorpage" ||
                    tab !== "comingsoon" ||
                    tab !== "maintenance_mode"
                ) {
                    $('.tab-header').addClass('active');
                    $('#header').addClass('active');
                }
            }
        } else {
            if (
                tab !== "header" ||
                tab !== "footer" ||
                tab !== "about" ||
                tab !== "privacy" ||
                tab !== "terms" ||
                tab !== "refund" ||
                tab !== "payment_methods_logo" ||
                tab !== "partners" ||
                tab !== "errorpage" ||
                tab !== "comingsoon" ||
                tab !== "maintenance_mode"
            ) {
                $('.tab-header').addClass('active');
                $('#header').addClass('active');
            }
        }

        $('.nav-link').on('click', function() {
            localStorage.setItem("setting-tab", $(this).attr('data-id'));
        })
    </script>

    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            addRemoveLinks: true,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                myDropzone = this;
                $('#submit-all').on('click', function() {
                    myDropzone.processQueue();
                });

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                });
            },
            success: function(file, response) {
                window.location.href = response.url;
                toastr.success(response.message, 'Success');
            }
        };
    </script>
@endsection
