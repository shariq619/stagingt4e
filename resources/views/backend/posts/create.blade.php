{{-- @extends('layouts.main')

@section('title', 'Post')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Post') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Post') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.post.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">@include('backend.posts._form')</div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.post.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        $(document).ready(function() {
            $('.title').on('keyup', function() {
                const title = $(this).val();
                const slug = title.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-').replace(
                    /--+/g, '-');
                $('.slug').val(slug);
            });
        });
    </script>
@endpush --}}
