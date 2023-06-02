@extends('admin.layouts.app')
@section('title')
    {{ __('edit_service_category') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit service') }}</h3>
                        <a href="{{ route('module.service.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                   
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.service.update', $category->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $category->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="image" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input name="image" type="file" accept="image/png, image/jpg, image/jpeg"
                                            class="form-control dropify  @error('image') is-invalid @enderror"
                                            data-default-file="{{ $category->image_url }}" data-max-file-size="3M"
                                            data-show-errors="true" data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                        @error('image')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <x-forms.label name="Time" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <input  name="time" value="{{ $category->time}}" type="text"
                                                class="form-control @error('date') is-invalid @enderror"
                                                placeholder="{{ __('time') }}">
                                        @error('date')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <x-forms.label name="Time Type" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <select name="parent_id"
                                            class="form-control @error('parent_id') is-invalid @enderror w-100-p">
                                            <option value="m">{{ __('minute') }}</option>
                                             <option value="h">{{ __('hours') }}</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="currency" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="currency" value="{{ $category->currency }}"
                                                class="form-control @error('currency') is-invalid @enderror w-100-p">
                                      
                                                <option value="U$"  {{ $category->currency == 'U$' ? 'selected' : '' }}>USD</option>
                                            <option value="C$"  {{ $category->currency == 'C$' ? 'selected' : '' }}>CAD</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="price" required="true" value="{{ $category->price}}" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <input  name="price" type="number" value="{{ $category->price}}"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="{{ __('price') }}">
                                        @error('date')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-forms.label name="{{ __('aboutservice') }}" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <textarea id="editor1" type="text" class="form-control" name="about_service" rows="5"
                                                placeholder="{{ __('aboutservice') }}">{{$category->about_service}}</textarea>
                                        @error('date')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}
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
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css">
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script>
        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: '{{ $category->icon }}',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });

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


