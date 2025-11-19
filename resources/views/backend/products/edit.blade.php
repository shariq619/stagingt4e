@extends('layouts.main')

@section('title', 'Products')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Change Products') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Products') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.products.update', $slug->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">@include('backend.products._form')</div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('backend.products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                    <hr>
                    @can('delete product')
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCat">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('Delete product') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @can('delete product')
        <div class="modal fade" id="deleteCat" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete product') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('backend.products.destroy', $slug->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                {{ __('delete product?') }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt mr-2"></i>
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@push('css')
    <style>
        .custom-file-input~.custom-file-label::after {
            content: "Browse";
        }

        .gallery-image {
            width: 10%;
            margin-right: 10px;
            position: relative;
        }

        .gallery-image .delete-image {
            position: absolute;
            z-index: 1;
            right: 2px;
            top: 2px;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 0;
            font-family: monospace;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            // Append new images to the gallery
            $('#gallery').on('change', function() {
                const files = $(this)[0].files;
                const galleryImages = $('.gallery-images');
                let galleryImage = '';

                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        galleryImage += `
                    <div class="gallery-image">
                        <img src="${e.target.result}" alt="Gallery Image"
                            class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        <a class="btn btn-danger btn-sm delete-image" data-image="${e.target.result}">x</a>
                    </div>
                `;
                        galleryImages.append(galleryImage);
                        galleryImage = '';
                    };

                    reader.readAsDataURL(files[i]);
                }
            });

            $(document).on('click', '.delete-image', function() {
                const image = $(this).data('image');
                const deletedImagesInput = $('#deleted_images');
                const galleryImages = $('.gallery-images');
                let deletedImages = JSON.parse(deletedImagesInput.val()) || [];

                if (confirm('Are you sure you want to delete this image?')) {
                    deletedImages.push(image);
                    deletedImagesInput.val(JSON.stringify(deletedImages));
                    $(this).closest('.gallery-image').remove();
                }
            });
        });

        tinymce.init({
            selector: 'textarea#description',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        tinymce.init({
            selector: 'textarea#description_two',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#description_three',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#description_four',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        tinymce.init({
            selector: 'textarea#excerpt',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endpush
