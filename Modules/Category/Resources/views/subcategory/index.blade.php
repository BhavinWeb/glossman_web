@php
$user = auth()->user();
@endphp

@extends('admin.layouts.app')

@section('title')
    {{ __('subcategory') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('subcategory') }}</h3>
                        <a href="{{ route('module.subcategory.create', $category_id) }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-plus"></i>&nbsp;{{ __('create') }}</a>
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover text-nowrap table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="10%">{{ __('image') }}</th>
                                                <th>{{ __('name') }}</th>
                                                <th>{{ __('category') }}</th>
                                                <th>{{ __('subcategory') }}</th>
                                                <th width="10%">{{ __('status') }}</th>
                                                <th width="10%">{{ __('action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable">
                                            @forelse ($sub_categories as $subcategory)
                                                <tr data-id="{{ $subcategory->id }}">
                                                    <td class="text-center">
                                                        <img width="50px" height="50px"
                                                            src="{{ $subcategory->image_url }}" alt="subcategory image">
                                                    </td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('module.category.show', $subcategory->slug) }}">
                                                            {{ $subcategory->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('module.category.show', $subcategory->categories->slug) }}">
                                                            {{ $subcategory->categories->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('module.subcategory.catshow', $subcategory->slug) }}">
                                                            {{ $subcategory->subcategories_count ?? '0' }}
                                                            {{ __('subcategory') }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            <label class="switch ">
                                                                <input data-id="{{ $subcategory->id }}" type="checkbox"
                                                                    class="success toggle-switch"
                                                                    {{ $subcategory->status == 1 ? 'checked' : '' }}>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('edit') }}"
                                                            href="{{ route('module.category.edit', $subcategory->id) }}"
                                                            class="btn bg-info"><i class="fas fa-edit"></i></a>
                                                        <form
                                                            action="{{ route('module.category.destroy', $subcategory->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                class="btn bg-danger"><i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">
                                                        <x-admin.not-found word="subCategory"
                                                            route="module.category.create" />
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

    </style>
@endsection
@section('script')
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
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
                    url: "{{ route('module.category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('Subcategory order updated', 'Success');
                    }
                });
            }
        });

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('module.category.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success('Subcategory status updated', 'Success');
                }
            });
        })
    </script>
@endsection
