@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                        <a href="{{ route('module.product.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-10 offset-md-1">
                            <form enctype="multipart/form-data" method="POST"
                                action="{{ route('module.product.update', $product->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('title') }} <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $product->title }}" name="title" type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ __('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">{{ __('current_image') }}</label><br>
                                        <img width="70px" height="70px" src="{{ asset($product->image) }}"
                                            alt="{{ __('current_image') }}">
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('image') }} <span
                                                    class="text-danger">*</span></label>
                                            <input name="image" type="file"
                                                class="form-control border-0 @error('image') is-invalid @enderror"
                                                accept="image/png, image/jpeg, image/jpg">
                                            @error('image')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('category') }}</label>
                                            <select id="category_id" name="category_id"
                                                class="select2ds4 @error('category_id') is-invalid @enderror w-100-p">
                                                @foreach ($categories as $category)
                                                    <option
                                                        {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                      <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('currency') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="currency" value="{{ $product->currency }}"
                                                class="form-control @error('currency') is-invalid @enderror w-100-p">
                                      
                                                <option value="U$"  {{ $product->currency == 'U$' ? 'selected' : '' }}>USD</option>
                                            <option value="C$"  {{ $product->currency == 'C$' ? 'selected' : '' }}>CAD</option>
                                            </select>
                                            @error('currency')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('price') }} <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $product->price }}" name="price" type="number"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Price">
                                            @error('price')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('sale_price') }}</label>
                                            <input value="{{ $product->sale_price }}" name="sale_price" type="number"
                                                class="form-control @error('sale_price') is-invalid @enderror"
                                                placeholder="{{ __('sale_price') }}">
                                            @error('sale_price')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('brand') }}</label>
                                            <select name="brand_id"
                                                class="select2ds4 @error('brand_id') is-invalid @enderror w-100-p">
                                                @foreach ($brands as $brand)
                                                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('sku') }} <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $product->sku }}" name="sku" type="number"
                                                class="form-control @error('sku') is-invalid @enderror"
                                                placeholder="{{ __('sku') }}" value="{{ $product->sku }}">
                                            @error('sku')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('tags') }}</label>
                                            <select name="tags[]" multiple
                                                class="select2ds4 @error('tags') is-invalid @enderror w-100-p">
                                                @foreach ($tags as $tag)
                                                    <option
                                                        {{ in_array($tag->id, $productTags->pluck('id')->toArray()) ? 'selected' : '' }}
                                                        value="{{ $tag->id }}">{{ Str::ucfirst($tag->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tags')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('stock') }}</label>
                                            <input value="{{ $product->stock }}" name="stock" type="number"
                                                class="form-control @error('stock') is-invalid @enderror"
                                                placeholder="{{ __('stock') }}">
                                            @error('stock')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('short_description') }}</label>
                                            <textarea id="editor1" type="text" class="form-control" name="short_description" rows="5"
                                                placeholder="{{ __('short_description') }}">{{ $product->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('long_description') }}</label>
                                            <textarea id="editor2" type="text" class="form-control" name="long_description" rows="5"
                                                placeholder="{{ __('long_description') }}">{{ $product->long_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('additional_information') }}</label>
                                            <textarea id="editor3" type="text" class="form-control" name="additional_information" rows="5"
                                                placeholder="{{ __('additional_information') }}">{!! $product->additional_information !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('specification') }}</label>
                                            <textarea id="editor4" type="text" class="form-control" name="specification" rows="5"
                                                placeholder="{{ __('specification') }}">{!! $product->specification !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-3">
                                        <div class="text-lg">
                                            {{ __('status') }}
                                        </div>
                                        <div class="">
                                            <x-forms.switch-input button="button1" oldvalue="oldalue" name="status"
                                                onText="{{ __('on') }}" offText="{{ __('off') }}" value="1"
                                                :checked="$product->status" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-lg">
                                            {{ __('featured') }}
                                        </div>
                                        <div class="">
                                            <x-forms.switch-input button="button1" oldvalue="oldalue" name="featured"
                                                onText="{{ __('yes') }}" offText="{{ __('no') }}" value="1"
                                                :checked="$product->featured" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-lg">
                                            {{ __('hot') }}
                                        </div>
                                        <div class="">
                                            <x-forms.switch-input button="button1" oldvalue="oldalue" name="hot"
                                                onText="{{ __('yes') }}" offText="{{ __('no') }}" value="1"
                                                :checked="$product->hot" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 offset-3 text-center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i> {{ __('update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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

        .ck-editor__editable_inline {
            min-height: 170px;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor4'))
            .catch(error => {
                console.error(error);
            });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endsection
