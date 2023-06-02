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
                        <a href="{{ route('module.slider.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.slider.update', $slider->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('title') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->title }}" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{ __('title') }}">
                                        @error('title')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('sub_title') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->sub_title }}" name="sub_title" type="text"
                                            class="form-control @error('sub_title') is-invalid @enderror"
                                            placeholder="{{ __('sub_title') }}">
                                        @error('sub_title')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('details') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->details }}" name="details" type="text"
                                            class="form-control @error('details') is-invalid @enderror"
                                            placeholder="{{ __('details') }}">
                                        @error('details')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('price') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->price }}" name="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="{{ __('price') }}">
                                        @error('price')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('button_text') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->button_text }}" name="button_text" type="text"
                                            class="form-control @error('button_text') is-invalid @enderror"
                                            placeholder="{{ __('button_text') }}">
                                        @error('button_text')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('button_url') }}</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->button_url }}" name="button_url" type="text"
                                            class="form-control @error('button_url') is-invalid @enderror"
                                            placeholder="{{ __('button_url') }}">
                                        @error('button_url')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('image') }}</label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" accept="image/png, image/jpg, image/jpeg"
                                            class="form-control dropify  @error('image') is-invalid @enderror"
                                            data-default-file="{{ $slider->image_url }}"
                                            data-max-file-size="3M"
                                            data-show-errors="true" data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                        @error('image')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>&nbsp;{{ __('update') }}</button>
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
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}">
@endsection
@section('script')
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        // dropify
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
    </script>
@endsection
