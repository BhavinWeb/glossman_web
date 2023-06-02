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
                        <a href="{{ route('module.faq.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.faq.update', $faq->id) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('question') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('question', $faq->question) }}" name="question" type="text"
                                            class="form-control @error('question') is-invalid @enderror"
                                            placeholder="{{ __('question') }}">
                                        @error('question')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('answer') }}<small
                                            class="text-danger">*</small></label>
                                            <div class="col-sm-9">
                                            <textarea id="editor1" type="text" class="form-control" name="answer" rows="5"
                                                placeholder="{{ __('answer') }}">{{ old('answer', $faq->answer) }}</textarea>
                                                @error('answer')
                                            <span class="text-danger font-size-13">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}</button>
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
    <style>
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
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
       

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endsection
