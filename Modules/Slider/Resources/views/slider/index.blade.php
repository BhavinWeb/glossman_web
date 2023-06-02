@extends('admin.layouts.app')
@section('title')
    {{ __('slider_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('slider_list') }}</h3>
                        @if (userCan('slider.create'))
                            <a href="{{ route('module.slider.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp;{{ __('create') }}</a>
                        @endif

                        @if (userCan('slider.delete'))
                            <button onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                id="selected_item_delete"
                                class="btn btn-danger mr-3 float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-trash"></i>&nbsp;{{ __('delete_selected_item') }}</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th class="multiple-delete-checkbox" width="3%"><input id="slider_checkall"
                                                        name="multiple_slider" type="checkbox"></th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="15%">{{ __('image') }}</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="">{{ __('title') }}</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="">{{ __('sub_title') }}</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="">{{ __('details') }}</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending"
                                                    aria-sort="descending" width="">{{ __('price') }}</th>
                                                @if (userCan('slider.update') || userCan('slider.delete'))
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending"
                                                        width="22%">{{ __('action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="sortable">
                                            @foreach ($sliders as $slider)
                                                <tr data-id="{{ $slider->id }}" id="slider_id{{ $slider->id }}"
                                                    role="row" class="odd bg-transparent">
                                                    <td><input onchange="checked_count()" id="single_checkbox_slider"
                                                            name="single_slider_checkbox" value="{{ $slider->id }}"
                                                            type="checkbox"></td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        <img width="65px" height="65px" src="{{ asset($slider->image) }}"
                                                            alt="">
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">{{ $slider->title }}
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ $slider->sub_title }}</td>
                                                    <td class="sorting_1 text-center" tabindex="0">{{ $slider->details }}
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ multiCurrency($slider->price) }}</td>
                                                    @if (userCan('slider.update') || userCan('slider.delete'))
                                                        <td class="sorting_1 text-center" tabindex="0">
                                                            @if (userCan('slider.update'))
                                                                <a data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit') }}"
                                                                    href="{{ route('module.slider.edit', $slider->id) }}"
                                                                    class="btn bg-info"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if (userCan('slider.delete'))
                                                                <form
                                                                    action="{{ route('module.slider.destroy', $slider->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete') }}"
                                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                        class="btn bg-danger"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                            <div class="handle btn btn-success"><i
                                                                    class="fas fa-bars"></i></div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
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
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .multiple-delete-checkbox {
            position: unset;
            padding-right: 10px;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $("#selected_item_delete").attr("disabled", true);
        $("#slider_checkall").on("click", function() {
            if ($("input:checkbox").prop("checked")) {
                $("input:checkbox[name='single_slider_checkbox']").prop("checked", true);
                $("#selected_item_delete").attr("disabled", false);
            } else {
                $("input:checkbox[name='single_slider_checkbox']").prop("checked", false);
                $("#selected_item_delete").attr("disabled", true);
            }
        });

        function checked_count() {
            var checked_length = $(":checkbox:checked").length
            if (checked_length != 0) {
                $("#selected_item_delete").attr("disabled", false);

                $('#selected_item_delete').on('click', function(e) {
                    e.preventDefault();
                    var ids = [];
                    $('input:checked[name="single_slider_checkbox"]:checked').each(function() {
                        ids.push($(this).val());
                    });

                    $.ajax({
                        url: '{{ route('module.slider.multiple.destroy') }}',
                        type: 'DELETE',
                        data: {
                            id: ids,
                        },
                        success: function(response) {
                            $.each(ids, function(key, val) {
                                $('#slider_id' + val).remove();
                            })
                            toastr.success(response.message, 'Success');
                        }
                    })
                });
            } else {
                $("#selected_item_delete").attr("disabled", true);
            }
        }

        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                handle: '.handle',
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
                    url: "{{ route('module.slider.sort') }}",
                    data: {
                        order: order,
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });
    </script>
@endsection
