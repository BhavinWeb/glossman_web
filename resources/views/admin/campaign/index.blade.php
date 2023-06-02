@extends('admin.layouts.app')

@section('title')
    {{ __('campaign_list') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('campaign') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('campaign') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12 col-md-2">
                        <h3 class="card-title line-height-36">
                            {{ __('campaign_list') }}
                            <span class="badge bg-primary">
                                {{ $campaigns->total() }}
                            </span>
                        </h3>
                    </div>
                    <form class="" id="filterForm" action="{{ route('campaigns.index') }}" method="GET">
                        <div class="row d-flex justify-content-end">
                            <div class="col-sm-12 col-md-2 p-1">
                                <input name="title" type="text" class="form-control" value="{{ request('title') }}"
                                    placeholder="{{ __('title') }} ...">
                            </div>
                            <div class="col-sm-12 col-md-2 p-1">
                                <select name="status" class="form-control select2bs4 w-100-p">
                                    <option selected value="">{{ __('all_campaign') }}</option>
                                    <option {{ request('status') == '1' ? 'selected' : '' }} value="1">
                                        {{ __('active') }}
                                    </option>
                                    <option {{ request('status') == '0' ? 'selected' : '' }} value="0">
                                        {{ __('inactivate') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-1 p-1" type="submit">
                                <button type="submit" class="btn btn-info">{{ __('search') }}
                                </button>
                            </div>
                            @if (userCan('campaign.create'))
                                <div class="col-sm-12 col-md-1 p-1 text-md-right mt-sm-1 mt-md-0">
                                    <a href="{{ route('campaigns.create') }}"
                                        class="btn btn-primary">{{ __('create') }}</a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="card-body text-center table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered text-center">
                        <thead>
                            <tr>
                                <th width="10%">{{ __('image') }}</th>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('date') }}</th>
                                <th>{{ __('discount') }}</th>
                                @if (userCan('campaign.update'))
                                    <th>{{ __('status') }}</th>
                                @endif
                                @if (userCan('campaign.update') || userCan('campaign.delete'))
                                    <th width="10%">{{ __('action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <img class="img-fluid" width="82px" height="46px"
                                            src="{{ $campaign->image }}" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('campaigns.show', $campaign->id) }}">
                                            {{ Str::limit($campaign->title, 30, '...') }}
                                        </a>
                                    </td>
                                    <td>
                                        <span>
                                            {{ formatDate($campaign->start_date, 'd M, Y') }} -
                                            {{ formatDate($campaign->end_date, 'd M, Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            @if ($campaign->discount_type == 'percentage')
                                                {{ $campaign->discount_value }}%
                                            @else
                                                {{ multicurrency($campaign->discount_value) }}
                                            @endif
                                        </span>
                                    </td>
                                    @if (userCan('campaign.update'))
                                        <td class="text-center">
                                            <div>
                                                <label class="switch">
                                                    <input data-id="{{ $campaign->id }}" type="checkbox"
                                                        class="success toggle-switch"
                                                        {{ $campaign->status == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                    @endif
                                    @if (userCan('campaign.update') || userCan('campaign.delete'))
                                        <td>
                                            <a href="{{ route('campaigns.show', $campaign->id) }}"
                                                class="d-inline">
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('details') }}" class="btn bg-success">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            @if (userCan('campaign.update'))
                                                <a href="{{ route('campaigns.edit', $campaign->id) }}"
                                                    class="d-inline">
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('edit') }}" class="btn bg-info">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                            @endif
                                            @if (userCan('campaign.delete'))
                                                <form action="{{ route('campaigns.destroy', $campaign->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top" title="Delete"
                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">
                                        <x-admin.not-found word="customer" route="campaigns.create" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($campaigns->total() > $campaigns->count())
                    <div class="mt-3 d-flex justify-content-center">{{ $campaigns->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('.toggle-switch').change(function() {

            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            var url = "{{ route('campaigns.update.status', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: url,
                data: {
                    'status': status,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                },
                error: function(e) {}
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
