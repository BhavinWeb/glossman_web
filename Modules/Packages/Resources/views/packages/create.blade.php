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
                        <h3 class="card-title line-height-36">{{ __('Package Create') }}
                        </h3>
                        <a href="{{ route('module.package.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.package.store') }}" onsubmit="return validateForm()"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group row">
                                    <x-forms.label name="title" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('title') }}" name="title" type="text"
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
                                        <input value="{{ old('duration') }}" name="duration" type="number"
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
                                   
                                   </div>
                                   </div>
                                </div>
                                
                                <div class="form-group row">
                                    <x-forms.label name="discription" required="true" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                    <textarea id="editor1" type="text" class="form-control" name="discription" rows="5"
                                                placeholder="{{ __('aboutservice') }}">{{ old('aboutservice') }}</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="1">

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" value="submit" class="btn btn-success"><i
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
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
	
	var delete_service = 0;
	
	function addService(){
	var html = ' <div class="parent mt-3" id="remove_service'+delete_service+'">';
	html +='<select name="service['+delete_service+'][id]"class="form-control Services pull-right mr-3">';
	html +=' <option value="0">select your service</option>';
	html +=' @foreach ($services as $service_data)';
	html +=' <option value="{{ $service_data->id }}">{{ $service_data->name }}</option>';
	html +='  @endforeach';
	html +='  </select>';
	html +='   <input type="number" name="service['+delete_service+'][count]"  value="0" class="form-control pull-left mr-3 Services_count">';
	html +='   <button class="btn btn-danger" type="button"  onclick="remove_service('+delete_service+')">D</button>';
	html +="</div>";
                                         delete_service++;
		$(".service_list").append(html);
	}
	
	function remove_service(id){
		$("#remove_service"+id).remove();
	}

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
<script>
        
        function validateForm() {
    var Services = 0;
     var error = 0;
      var count_dt = 0;
      var Services_count = 1;
    $(".Services").each(function () {
       Services++;
        if ( $(this).val() != 0) {
         	Services_count++;
            
        }
        
    });
    if(Services == 0){
    	alert("please add service!");
        error = 1;
        
    }
	
	
    if (Services_count == 1 && Services !=0) {
        alert("please select service!");
        error = 1;
        
    }else{
    
    	$(".Services_count").each(function () {
           
            if ($(this).val() == 0) {
             count_dt++;
                error = 1;
                
            }
        });
    	
    
      if (Services !=0 && count_dt != 0) {
            alert("please add atleast one service!");
            error = 1;
            
        }
    }

 

    if (error == 1) {
        return false;
    }
}

</script>
             
@endsection
