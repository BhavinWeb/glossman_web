@extends('admin.layouts.app')
@section('title')
    {{ __('coupon_list') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">{{ __('coupon_list') }}</h3>
                    <a href="{{ route('coupon.create') }}"
                        class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                            class="fas fa-plus"></i>&nbsp; {{ __('create') }}</a>
                </div>
                <div class="card-body m-0 p-0">
                    <table id="example1" class="table text-center table-bordered dataTable dtr-inline m-0" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row" class="text-center">
                                <th>{{ __('code') }} ( {{ __('total_uses') }} )</th>
                                <th>{{ __('max_use') }}</th>
                                <th>{{ __('discount') }}</th>
                                <th>{{ __('expire_date') }}</th>
                                <th>{{ __('type') }}</th>
                                @if (userCan('coupon.update'))
                                    <th>{{ __('status') }}</th>
                                @endif
                                @if (userCan('coupon.update') || userCan('coupon.delete'))
                                    <th> {{ __('action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupons as $coupon)
                                <tr role="row" class="odd">
                                    <td class="coupon-copy" onclick="copy(this,'{{ $coupon->id }}')"
                                        data-toggle="tooltip" data-placement="top" title="Copy to clipboard"
                                        id="counpon{{ $coupon->id }}" class="effect-shine">
                                        {{ $coupon->code }}
                                        <span class="badge bg-info">
                                            {{ $coupon->total_uses }}
                                        </span>
                                    </td>
                                    <td>{{ $coupon->max_use }}
                                    </td>
                                    <td>
                                        {{ $coupon->type != 'Percentage' ? '$' : '' }}{{ $coupon->discount }}{{ $coupon->type == 'Percentage' ? '%' : '' }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($coupon->expire_date)->format('d M, Y') }}
                                    </td>
                                    <td>{{ $coupon->type }}
                                    </td>
                                    @if (userCan('coupon.update'))
                                        <td class="text-center">
                                            <div>
                                                <label class="switch ">
                                                    <input data-id="{{ $coupon->id }}" type="checkbox"
                                                        class="success toggle-switch"
                                                        {{ $coupon->status == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                    @endif
                                    @if (userCan('coupon.update') || userCan('coupon.delete'))
                                        <td>
                                            <a data-toggle="tooltip" data-placement="top" title="{{ __('edit') }}"
                                                href="{{ route('coupon.edit', $coupon->id) }}" class="btn bg-info"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('coupon.delete', $coupon->id) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('delete') }}"
                                                    onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                    class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">
                                        <x-admin.not-found word="coupon" route="coupon.create" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (request('perpage') != 'all' && $coupons->total() > $coupons->count())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $coupons->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
            /* width: 60px;
                                                                                                                                                                                                                        height: 34px; */
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

        /* effect-shine */
        .effect-shine:hover {
            -webkit-mask-image: linear-gradient(-75deg, rgba(0, 0, 0, .6) 30%, #000 50%, rgba(0, 0, 0, .6) 70%);
            -webkit-mask-size: 200%;
            animation: shine 2s infinite;
        }

        .coupon-copy {
            cursor: copy !important;
        }

    </style>
@endsection

@section('script')
    <script>
        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('coupon.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });

        function copy(that, id) {
            var inp = document.createElement('input');
            document.body.appendChild(inp)
            inp.value = that.textContent
            inp.select();
            document.execCommand('copy', false);
            inp.remove();
            $('.odd > td').attr('data-original-title', "Copy to clipboard !");
            $('#counpon' + id).attr('data-original-title', "Copied !").tooltip('show');
        };
    </script>
@endsection
