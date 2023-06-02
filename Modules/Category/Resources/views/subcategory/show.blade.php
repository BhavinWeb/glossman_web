@extends('admin.layouts.app')

@section('title')
    '{{ $subcategory->name }}' {{ __('subcategory_wise') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- subcategory details --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('subcategory_details') }}
                        </h3>
                    </div>

                    <div class="row m-2 justify-content-center">
                        <div class="col-md-4">
                            <img src="{{ $subcategory->image_url }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                        </div>
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">
                                            {{ $subcategory->name }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">
                                            {{ $subcategory->categories->name }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">
                                            {{ date('M d, Y', strtotime($subcategory->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">
                                            {{ $subcategory->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
