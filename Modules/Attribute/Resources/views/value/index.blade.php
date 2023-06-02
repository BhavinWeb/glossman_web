@extends('attribute::layouts.tab')

@section('title')
    {{ __('variant_edit') }}
@endsection
@section('tab-nav')
    <a href="{{ route('module.attributes.edit', $attribute->id) }}" class="nav-link">{{ __('general') }}</a>
    <a href="{{ route('module.attribute.value.index', $attribute->id) }}"
        class="nav-link bg-primary text-white">{{ __('variant_value') }}</a>
@endsection

@section('tab-content')
    <div class="card card-primary mb-5">
        <div class="card-header">
            {{ __('variant_value') }}
        </div>
        <div class="card-body">
            @if ($attributeValue)
                <form class="form-horizontal" action="{{ route('module.attribute.value.update', $attributeValue->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                    <div class="form-group row">
                        <label class="">{{ __('value') }}</label>
                        <input name="value" value="{{ $attributeValue->value }}" type="text"
                            class="form-control @error('value') is-invalid @enderror"
                            placeholder="{{ __('value') }}">
                        @error('value')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mr-2"><i class="fas fa-sync"></i>
                            {{ __('update_value') }} </button>
                        <a href="{{ route('module.attribute.value.index', $attribute->id) }}"
                            class="btn btn-secondary"><i class="fas fa-times"></i> {{ __('cancel_edit') }} </a>
                    </div>
                </form>
            @else
                <form class="form-horizontal" action="{{ route('module.attribute.value.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                    <div class="form-group row">
                        <label class="">{{ __('value') }}</label>
                        <input name="value" value="{{ old('value') }}" type="text"
                            class="form-control @error('value') is-invalid @enderror"
                            placeholder="{{ __('value') }}">
                        @error('value')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                            {{ __('save_value') }} </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="card card-primary mb-3">
        <div class="card-header">
            {{ __('option_values') }}
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> {{ __('value') }} </th>
                        <th> {{ __('action') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($values as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->value }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('module.attribute.value.edit', $value->id) }}"
                                        class="btn btn-primary mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('module.attribute.value.destroy', $value->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                            class="btn btn-danger" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
