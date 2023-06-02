@extends('admin.layouts.app')
@section('title')
    {{ __('brand_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('brand_list') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('sl') }} </th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('created_date') }} </th>
                                    @if (userCan('brand.update') || userCan('brand.delete'))
                                        <th width="10%">{{ __('action') }} </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $brand->name }}
                                        </td>
                                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                                        @if (userCan('brand.update') || userCan('brand.delete'))
                                            <td class="text-center">
                                                @if (userCan('brand.update'))
                                                    <a title="{{ __('edit') }} "
                                                        href="{{ route('module.brand.edit', $brand->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('brand.delete'))
                                                    <form action="{{ route('module.brand.destroy', $brand->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete') }} "
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-admin.not-found word="brand" route="module.brand.index" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($brands->total() > $brands->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $brands->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Create & Edit section -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">
                            @if (request()->routeIs('module.brand.edit'))
                                <span>{{ __('edit') }}</span>
                            @else
                                <span>{{ __('create') }}</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if (request()->routeIs('module.brand.edit') ? userCan('brand.update') : userCan('brand.create'))
                            <form class="form-horizontal"
                                action="{{ request()->routeIs('module.brand.edit') ? route('module.brand.update', $brandd->id) : route('module.brand.store') }}"
                                method="POST">
                                @csrf
                                @if (request()->routeIs('module.brand.edit'))
                                    @method('PUT')
                                @endif
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input
                                            value="{{ request()->routeIs('module.brand.edit') ? $brandd->name : old('name') }}"
                                            name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            @if (request()->routeIs('module.brand.edit'))
                                                @lang('update_brand')
                                            @else
                                                @lang('add_brand')
                                            @endif
                                        </button>
                                        @if (request()->routeIs('module.brand.edit'))
                                            <a href="{{ route('module.brand.index') }}" class="ml-1 btn btn-danger"><i
                                                    class="fas fa-times"></i>&nbsp;
                                                {{ __('cancel') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Create & Edit section -->
        </div>
    </div>
@endsection

@section('style')
    <style>
        .page-link.page-navigation__link.active {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
    </style>
@endsection
