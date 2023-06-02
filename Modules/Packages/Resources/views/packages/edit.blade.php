@extends('admin.layouts.app')
@section('title')
    {{ __('service_category') }}
@endsection
<style>
	.parent {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
}
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('Package Edit') }}
                        </h3>
                        <a href="{{ route('module.package.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.package.update',$data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group row">
                                    <x-forms.label name="title" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{$data->title}}" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{ __('title') }}" required>
                                        @error('title')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="currency" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="currency" value="{{ $data->currency }}"
                                                class="form-control @error('currency') is-invalid @enderror w-100-p">
                                      
                                                <option value="U$"  {{ $data->currency == 'U$' ? 'selected' : '' }}>USD</option>
                                            <option value="C$"  {{ $data->currency == 'C$' ? 'selected' : '' }}>CAD</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="price" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{$data->price}}" name="price" type="number"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="{{ __('price') }}" required>
                                        @error('price')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="duration" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{$data->duration}}" name="duration" type="number"
                                            class="form-control @error('duration') is-invalid @enderror"
                                            placeholder="{{ __('duration') }}" required>
                                        @error('duration')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <x-forms.label name="Services" required="true" labelclass="col-sm-3" />
                                   <div class="col-sm-9">
                                   <button class="btn btn-primary pull-right" type="button" onclick="addService();">Add Services</button>
                                   <div class="service_list mt-4">
                                   	@foreach($selected_services as $key=>$ssd)
                                   		<div class="parent mt-3" id="remove_service{{$key}}">
							<select name="service[{{$key}}][id]"class="form-control pull-right mr-3">
							@foreach ($services as $service_data)
							@php
								if($service_data->id == $ssd->service_id){
									$selected = "selected";
								}else{
									$selected = "";
								}
							@endphp
							<option value="{{ $service_data->id }}" {{$selected}}>{{ $service_data->name }}</option>
							@endforeach
							</select>
							<input type="number" name="service[{{$key}}][count]" value="{{$ssd->service_count}}" class="form-control pull-left mr-3">
							<button class="btn btn-danger" type="button"  onclick="remove_service({{$key}})">D</button>
						</div>
                                   	@endforeach
                                   </div>
                                   </div>
                                </div>
                               

                                <div class="form-group row">
                                    <x-forms.label name="description" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <textarea id="editor1" type="text" class="form-control" name="description" rows="5"
                                                placeholder="{{ __('aboutservice') }}">{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="status" value="1">

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('update') }}</button>
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
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
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
    
    var delete_service = {{count($selected_services)}};
	
	function addService(){
	var html = ' <div class="parent mt-3" id="remove_service'+delete_service+'">';
	html +='<select name="service['+delete_service+'][id]"class="form-control pull-right mr-3">';
	html +=' <option value="">{{ __("service") }}</option>';
	html +=' @foreach ($services as $service_data)';
	html +=' <option value="{{ $service_data->id }}">{{ $service_data->name }}</option>';
	html +='  @endforeach';
	html +='  </select>';
	html +='   <input type="number" name="service['+delete_service+'][count]" value="0" class="form-control pull-left mr-3">';
	html +='   <button class="btn btn-danger" type="button"  onclick="remove_service('+delete_service+')">D</button>';
	html +="</div>";
                                         delete_service++;
		$(".service_list").append(html);
	}
	
	function remove_service(id){
		$("#remove_service"+id).remove();
	}

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
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
