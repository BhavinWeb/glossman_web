@extends('admin.layouts.app')

@section('title')
    {{ __('driver_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('Driver List') }}</h3>
                         @if (userCan('driver.create'))
                            <a href="{{route('driver.create')}}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp; {{ __('create') }}</a>
                      @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('id') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('phone') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th width="10%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($driver as $category)
                                    <tr data-id="{{ $category->id }}">
                                    <td class="text-center">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="text-center">
                                          
                                                {{ $category->name }}
                                            
                                        </td>
                                        <td class="text-center">
                                            {{ $category->email }}
                                        </td>
                                        <td class="text-center">
                                            {{ $category->phone }}
                                        </td>
                                        
                                        @if (userCan('category.update'))
                                            <td class="text-center">
                                                <div>
                                                    <label class="switch ">
                                                        <input data-id="{{ $category->id }}" type="checkbox"
                                                            class="success toggle-switch"
                                                            {{ $category->status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>

                                            </td>
                                        @endif
                                        @if (userCan('category.update') || userCan('category.delete'))
                                            <td class="text-center">
                                                @if (userCan('category.update'))
                                                    
                                                    <a title="{{ __('edit') }}"
                                                        href="{{ route('driver.edit', $category->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('category.delete'))
                                                    <form action="{{ route('driver.destroy', $category->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger mr-1"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-admin.not-found word="Service" route="module.driver.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                   @if ($driver->total() > $driver->count())
                    <div class="card-footer ">
                        <div class="d-flex justify-content-center">
                            {{ $driver->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/popper/umd/popper.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

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
                    url: "#",
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

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('driver.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        })
    </script>
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