@extends('admin.layouts.app')

@section('title')
    {{ __('product_gallery') }}
@endsection

@section('content')
    <div class="container-fluid mb-50">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark d-flex justify-content-between align-items-center">
                        <h6 class="d-inline mb-2"> {{ __('product_gallery_add') }}</h6>
                    </div>
                    <div class="card-body">
                        <form id="dropzoneForm" method="post" action="{{ route('module.product.gallery.store', $id) }}"
                            enctype="multipart/form-data" class="dropzone">
                            @csrf
                        </form>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-success" id="submit-all"><i class="fas fa-sync"></i>
                                {{ __('upload_gallery') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-dark line-height-36">{{ __('product_gallery_list') }}</h3>
                        <a href="{{ route('module.product.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="card-body m-0 p-0">
                        <table class="table table-bordered  text-center">
                            <thead class="text-dark">
                                <tr>
                                    <th width="5%">{{ __('sl') }}</th>
                                    <th width="15%">{{ __('product_name') }}</th>
                                    <th width="10%">{{ __('gallery_image') }}</th>
                                    @if (userCan('product.delete'))
                                        <th width="15%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($product_galleries as $product_gallery)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $product_gallery->product->title }}</td>
                                        <td class="text-center">
                                            @if ($product_gallery->image)
                                                <img width="60px" height="60px"
                                                    src="{{ asset($product_gallery->image) }}" alt="">
                                            @else
                                                <img width="60px" height="60px"
                                                    src="{{ asset('admin/img/no-image.png') }}" alt="">
                                            @endif
                                        </td>
                                        @if (userCan('product.delete'))
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('module.product.gallery.destroy', $product_gallery->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button title="{{ __('delete') }}"
                                                        onclick="return confirm('Are you sure you want to delete this item');"
                                                        class="btn bg-danger"><i
                                                            class="fas fa-trash text-light"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="20">
                                            <x-admin.not-found word="gallery" />
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

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropzone.min.css">

    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 805px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/js/dropzone.js"></script>

    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            addRemoveLinks: true,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                myDropzone = this;
                $('#submit-all').on('click', function() {
                    myDropzone.processQueue();
                });

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                });
            },
            success: function(file, response) {
                window.location.href = response.url;
                toastr.success(response.message, 'Success');
            },
        };
    </script>
@endsection
