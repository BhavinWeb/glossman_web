@extends('admin.settings.setting-layout')
@section('title')
    {{ __('home_page_builder') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class="card-title line-height-36">
                    {{ __('top_header') }}
                </h2>
                <div class="form-group row cursor-unset">
                    <input {{ $top_header_content->status ? 'checked' : '' }} type="checkbox"
                        name="{{ $top_header_content->slug }}" data-bootstrap-switch value="1">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('campaign.homepage.topHeader') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $top_header_content->id }}" name="home_page_content_id">
                <label for="">{{ __('call_to_action') }} ({{ __('campaign') }})</label>
                <div class="row justify-content-center">
                    <select id="country" name="campaign"
                        class="form-control  @error('campaign') is-invalid @enderror w-100-p">
                        @foreach ($campaigns as $campaign)
                            <option
                                {{ isset($top_header_content->campaignOffer[0]) && $top_header_content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                value="{{ $campaign->id }}">
                                {{ $campaign->title }}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.error name="categories" />
                    <div class="w-full mt-3 mb-4 ml-2">
                        <button type="submit" class="btn btn-success">
                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="sortable">
        @foreach ($contents as $content)
            <div class="card cursor-scroll" data-id="{{ $content->id }}">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title line-height-36">
                            <i class="fas fa-bars mr-2 handle"></i>
                            {{ $content->name }}
                        </h2>
                        <div class="form-group row cursor-unset">
                            <input {{ $content->status ? 'checked' : '' }} type="checkbox" name="{{ $content->slug }}"
                                data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if ($content->status && $content->show_body)
                    <div class="card-body">

                        @if ($content->slug == 'banner')
                            <form action="{{ route('campaign.banner.update') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <label for="">{{ __('call_to_action') }}
                                            ({{ __('campaign') }})
                                        </label>
                                        <select id="country" name="banner_campaign"
                                            class="form-control  @error('banner_campaign') is-invalid @enderror w-100-p">
                                            @foreach ($campaigns as $campaign)
                                                <option
                                                    {{ isset($content->campaignOffer[0]) && $content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="banner_campaign" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">{{ __('call_to_action') }} 2
                                            ({{ __('campaign') }})</label>
                                        <select id="country" name="banner_campaign_2"
                                            class="form-control  @error('banner_campaign_2') is-invalid @enderror w-100-p">
                                            @foreach ($campaigns as $campaign)
                                                <option
                                                    {{ isset($content->campaignOffer[1]) && $content->campaignOffer[1]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="banner_campaign_2" />
                                    </div>
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'todays-deals')
                            <form action="{{ route('settings.website.homepage.todaysDealProduct.update') }}"
                                method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <label for="">{{ __('products') }}</label>
                                        <select id="country" name="products[]" multiple
                                            class="form-control product-select @error('products') is-invalid @enderror w-100-p">
                                            @foreach ($products as $product)
                                                <option
                                                    {{ in_array($product->id, $todays_deals_products->pluck('product_id')->toArray()) ? 'selected' : '' }}
                                                    value="{{ $product->id }}">
                                                    {{ $product->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="products" />
                                    </div>
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'application-feature')
                            <form action="{{ route('settings.cms.update') }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" value="steps" name="type">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="shop_feature_step1_title">{{ __('step1_title') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step1_title', $cms->shop_feature_step1_title) }}"
                                                name="shop_feature_step1_title" type="text"
                                                class="form-control @error('shop_feature_step1_title') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step1_title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="shop_feature_step1_subtitle">{{ __('step1_subtitle') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step1_subtitle', $cms->shop_feature_step1_subtitle) }}"
                                                name="shop_feature_step1_subtitle" type="text"
                                                class="form-control @error('shop_feature_step1_subtitle') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step1_subtitle" />
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="step1_image" />
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->shop_feature_step1_image) }}"
                                                name="shop_feature_step1_image"
                                                data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                                accept="image/png, image/jpg,image/svg image/jpeg"
                                                data-max-file-size="1M">
                                            <x-forms.error name="shop_feature_step1_image" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="shop_feature_step2_title">{{ __('step2_title') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step2_title', $cms->shop_feature_step2_title) }}"
                                                name="shop_feature_step2_title" type="text"
                                                class="form-control @error('shop_feature_step2_title') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step2_title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="shop_feature_step2_subtitle">{{ __('step2_subtitle') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step2_subtitle', $cms->shop_feature_step2_subtitle) }}"
                                                name="shop_feature_step2_subtitle" type="text"
                                                class="form-control @error('shop_feature_step2_subtitle') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step2_subtitle" />
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="step2_image" />
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->shop_feature_step2_image) }}"
                                                name="shop_feature_step2_image"
                                                data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                                accept="image/png, image/jpg,image/svg image/jpeg"
                                                data-max-file-size="1M">
                                            <x-forms.error name="shop_feature_step2_image" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="shop_feature_step3_title">{{ __('step3_title') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step3_title', $cms->shop_feature_step3_title) }}"
                                                name="shop_feature_step3_title" type="text"
                                                class="form-control @error('shop_feature_step3_title') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step3_title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="shop_feature_step3_subtitle">{{ __('step3_subtitle') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step3_subtitle', $cms->shop_feature_step3_subtitle) }}"
                                                name="shop_feature_step3_subtitle" type="text"
                                                class="form-control @error('shop_feature_step3_subtitle') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step3_subtitle" />
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="step3_image" />
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->shop_feature_step3_image) }}"
                                                name="shop_feature_step3_image"
                                                data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                                accept="image/png, image/jpg,image/svg image/jpeg"
                                                data-max-file-size="1M">
                                            <x-forms.error name="shop_feature_step3_image" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="shop_feature_step4_title">{{ __('step4_title') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step4_title', $cms->shop_feature_step4_title) }}"
                                                name="shop_feature_step4_title" type="text"
                                                class="form-control @error('shop_feature_step4_title') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step4_title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="shop_feature_step4_subtitle">{{ __('step4_subtitle') }}</label>
                                            <input
                                                value="{{ old('shop_feature_step4_subtitle', $cms->shop_feature_step4_subtitle) }}"
                                                name="shop_feature_step4_subtitle" type="text"
                                                class="form-control @error('shop_feature_step4_subtitle') is-invalid @enderror">
                                            <x-forms.error name="shop_feature_step4_subtitle" />
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="step4_image" />
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms->shop_feature_step4_image) }}"
                                                name="shop_feature_step4_image"
                                                data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                                accept="image/png, image/jpg,image/svg image/jpeg"
                                                data-max-file-size="1M">
                                            <x-forms.error name="shop_feature_step4_image" />
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'featured-products')
                            <form action="{{ route('campaign.featuredProduct') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <label for="">{{ __('call_to_action') }} ({{ __('campaign') }})</label>
                                <div class="row justify-content-center">
                                    <select id="country" name="campaign"
                                        class="form-control  @error('campaign') is-invalid @enderror w-100-p">
                                        @foreach ($campaigns as $campaign)
                                            <option
                                                {{ isset($content->campaignOffer[0]) && $content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                value="{{ $campaign->id }}">
                                                {{ $campaign->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="categories" />
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'offer-ads')
                            <form action="{{ route('campaign.homepage.offer') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <label for="">{{ __('call_to_action') }}
                                            ({{ __('campaign') }})</label>
                                        <select id="country" name="campaign"
                                            class="form-control  @error('campaign') is-invalid @enderror w-100-p">
                                            @foreach ($campaigns as $campaign)
                                                <option
                                                    {{ isset($content->campaignOffer[0]) && $content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="campaign" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">{{ __('call_to_action') }} 2
                                            ({{ __('campaign') }})</label>
                                        <select id="country" name="campaign_2"
                                            class="form-control  @error('campaign_2') is-invalid @enderror w-100-p">
                                            @foreach ($campaigns as $campaign)
                                                <option
                                                    {{ isset($content->campaignOffer[1]) && $content->campaignOffer[1]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="banner_campaign_2" />
                                    </div>
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i> {{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'offer-ads-2')
                            <form action="{{ route('campaign.homepage.offer2') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <label for="">{{ __('call_to_action') }} ({{ __('campaign') }})</label>
                                <div class="row justify-content-center">
                                    <select id="country" name="campaign"
                                        class="form-control  @error('campaign') is-invalid @enderror w-100-p">
                                        @foreach ($campaigns as $campaign)
                                            <option
                                                {{ isset($content->campaignOffer[0]) && $content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                value="{{ $campaign->id }}">
                                                {{ $campaign->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="categories" />
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i> {{ __('update') }} </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'shop-with-categories')
                            <form action="{{ route('settings.website.homepage.shopCategory') }}" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <select id="country" name="categories[]" multiple="multiple"
                                        class="form-control cateory-select @error('categories') is-invalid @enderror w-100-p">
                                        @foreach ($categories as $category)
                                            @if ($category->show_on_homepage_shop_categories)
                                                <option selected value="{{ $category->id }}">{{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-forms.error name="categories" />
                                    <div class="w-full mt-3 mb-4 ml-2">
                                        <button type="submit" class="btn btn-success">
                                            <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if ($content->slug == 'custom-category')
                            <form action="{{ route('settings.website.homepage.customCategory') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $content->id }}" name="home_page_content_id">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <label for="">{{ __('custom_category_selection') }}</label>
                                        <select id="country" name="category"
                                            class="form-control @error('category') is-invalid @enderror w-100-p">
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ $category->show_on_homepage_custom_category ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="category" />
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">{{ __('call_to_action') }}
                                            ({{ __('campaign') }})</label>
                                        <select id="country" name="campaign"
                                            class="form-control @error('campaign') is-invalid @enderror w-100-p">
                                            @foreach ($campaigns as $campaign)
                                                <option
                                                    {{ isset($content->campaignOffer[0]) && $content->campaignOffer[0]->campaign_id == $campaign->id ? 'selected' : '' }}
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-forms.error name="campaign" />
                                    </div>
                                    @if (userCan('setting.view'))
                                        <div class="w-full mt-3 mb-4 ml-2">
                                            <button type="submit" class="btn btn-success">
                                                <span><i class="fas fa-sync"></i>{{ __('update') }}</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection


@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>

    <script>
        $('.dropify').dropify();
        $(function() {
            $("#sortable").sortable({
                items: '.card',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable .card');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('settings.website.homepage.order') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });



        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {
            let slug = $(this).attr('name');
            let status = state ? 1 : 0;
            $("input[name=" + slug + "]").val(status);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('settings.website.homepage.status') }}",
                data: {
                    'slug': slug,
                    'status': status
                },
                success: function(response) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                    toastr.success(response.message, 'Success');
                }
            });
        });

        $('.cateory-select').select2({
            theme: 'bootstrap4'
        })
        $('.product-select').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}">
    <style>
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
@endsection
