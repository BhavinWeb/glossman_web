@extends('admin.layouts.app')
@section('title')
    {{ $campaign->title }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36"> {{ __('campaign') }}
                            {{ __('details') }}</h3>
                        <div class="align-items-center  ml-auto">
                            <a href="{{ route('campaigns.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-arrow-left"></i>
                                &nbsp; {{ __('back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="row m-2">
                            <div class="col-md-4 col-sm-3">
                                <img src="{{ $campaign->image }}" alt="image" class="image-fluid mr-2" height="340px"
                                    width="340px">
                            </div>
                            <div class="col-md-8">
                                <table id="datatable-responsive"
                                    class="ml-1 table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <tbody>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('start_date') }}</th>
                                            <td width="80%">{{ $campaign->start_date }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('end_date') }}</th>
                                            <td width="80%">{{ $campaign->end_date }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('discount_amount') }}</th>
                                            <td width="80%">
                                                {{ $campaign->discount_value }}{{ $campaign->discount_type == 'amount' ? defaultCurrencySymbol() : '%' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{ __('campaign_products') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="ml-1 table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <tr class="text-center">
                                <tr role="row" class="text-center">
                                    <th>{{ __('sl') }}</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th width="10%">{{ __('discount_amount') }}</th>
                                </tr>
                                </tr>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center">{{ $product->product->id }}</td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                <img width="60px" height="60px" src="{{ $product->product->image_url }}"
                                                    class="rounded" alt="Product Image">
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                {{ Str::limit($product->product->title, 30, '...') }}
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                @if ($product->product->sale_price)
                                                    <del>{{ multiCurrency($product->product->sale_price) }}</del>
                                                @endif
                                                &nbsp; &nbsp;
                                                {{ multiCurrency($product->product->price) }}
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                <span>
                                                    {{ $campaign->discount_value }}{{ $campaign->discount_type == 'amount' ? defaultCurrencySymbol() : '%' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="empty py-5">
                                                    <div class="empty-img">
                                                        <img src="{{ asset('backend/image') }}/not-found.svg"
                                                            height="128" alt="">
                                                    </div>
                                                    <h5 class="mt-4">{{ __('no_results_found') }}</h5>
                                                    <p class="empty-subtitle text-muted">
                                                        {{ __('there_is_no') }} {{ __('found_in_this_page') }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('product.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endsection
