@extends('admin.layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- category details --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('category_details') }}</h3>
                    </div>

                    <div class="row m-2 justify-content-center">
                        <div class="col-md-4">
                            <img src="{{ $category->image_url }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                        </div>
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">
                                            {{ $category->name }}
                                        </td>
                                    </tr>
                                    @if ($category->subcategories_count)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('subcategories_count') }}</th>
                                            <td width="80%">
                                                {{ $category->subcategories_count }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">
                                            {{ date('M d, Y', strtotime($category->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">
                                            {{ $category->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- category subcategories --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">'{{ $category->name }}'
                            {{ __('category_wise') }}
                            {{ __('subcategory') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th width="20%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category->subcategories as $key => $subcategory)
                                    <tr>
                                        <td class="text-center" tabindex="0">{{ $key + 1 }}</td>
                                        <td class="text-center" tabindex="0"><a
                                                href="{{ route('module.category.show', $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                        </td>
                                        <td class="text-center" tabindex="0">
                                            <a data-toggle="tooltip" data-placement="top" title="{{ __('edit') }}"
                                                href="{{ route('module.subcategory.edit', $subcategory->id) }}"
                                                class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('module.subcategory.destroy', $subcategory->id) }}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('delete') }}"
                                                    onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                    class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="subcategory" />
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
@endsection
