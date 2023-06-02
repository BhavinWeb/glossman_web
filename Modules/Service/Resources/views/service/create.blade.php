@extends('admin.layouts.app')
@section('title')
    {{ __('service_category') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('service') }}
                        </h3>
                        <a href="{{ route('module.service.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.service.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-15 d-none">
                                    <label class="col-sm-3 form-label">{{ __('category') }}</label>
                                    <div class="col-sm-9">
                                        <select name="parent_id"
                                            class="form-control @error('parent_id') is-invalid @enderror w-100-p">
                                            <option value="">{{ __('root_category') }}</option>
                                            @foreach ($categories as $category)
                                                {{-- root --}}
                                                @if ($category->parent_id == null)
                                                    <option {{ $parent_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endif
                                                @php
                                                    $categoryid = $category->id;
                                                @endphp
                                                @foreach ($category->subcategories as $subcategory)
                                                    {{-- sub category --}}
                                                    @if ($categoryid == $subcategory->parent_id)
                                                        <option {{ $parent_id == $subcategory->id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">- {{ $subcategory->name }}
                                                        </option>
                                                    @endif
                                                    @php
                                                        $subcategoryid = $subcategory->id;
                                                    @endphp
                                                    @foreach ($subcategory->subcategories as $subsubcategory)
                                                        {{-- sub sub category --}}
                                                        @if ($subcategoryid == $subsubcategory->parent_id)
                                                            <option
                                                                {{ $parent_id == $subsubcategory->id ? 'selected' : '' }}
                                                                value="{{ $subsubcategory->id }}">--
                                                                {{ $subsubcategory->name }}
                                                            </option>
                                                        @endif
                                                        @php
                                                            $subsubcategoryid = $subsubcategory->id;
                                                        @endphp
                                                        @foreach ($subsubcategory->subcategories as $subsubsubcategory)
                                                            {{-- sub sub sub category --}}
                                                            @if ($subsubcategoryid == $subsubsubcategory->parent_id)
                                                                <option
                                                                    {{ $parent_id == $subsubsubcategory->id ? 'selected' : '' }}
                                                                    value="{{ $subsubsubcategory->id }}">---
                                                                    {{ $subsubsubcategory->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-forms.label name="image" required="true" labelclass="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <input name="image" type="file" accept="image/png, image/jpg, image/jpeg"
                                            class="form-control dropify @error('image') is-invalid @enderror"
                                            data-max-file-size="3M" data-show-errors="true"
                                            data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                        @error('image')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-forms.label name="Time" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <input value="{{ old('date') }}" name="time" type="text"
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
                                        <select name="currency" id="currency">
                                            <option value="U$">USD</option>
                                            <option value="C$">CAD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="price" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <input value="{{ old('price') }}" name="price" type="number"
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
                                                placeholder="{{ __('aboutservice') }}">{{ old('aboutservice') }}</textarea>
                                        @error('date')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('create') }}</button>
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
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
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
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap-Iconpicker Bundle -->
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
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


