{{-- @extends('layouts.main')

@section('title', 'Posts')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Posts') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Posts') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Posts') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.post.index') }}" method="GET" class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Posts..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add post')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.post.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Posts') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30%">{{ __('Post Name') }}</th>
                                    <th width="10%">{{ __('Image') }}</th>
                                    <th width="10%">{{ __('Category') }}</th>
                                    <th width="25%">{{ __('Excerpt') }}</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title ?? '' }}</td>
                                        <td>
                                            <img src="{{ $post->image ? asset($post->image) : asset('images/placeholder.webp') }}"
                                                width="70" height="70">
                                        </td>
                                        <td><span class="b badge-btn badge-success">{{ucfirst($post->category->name ?? '') }}</span></td>
                                        <td>{{ Str::limit($post->excerpt ?? '', 100, '...') }}</td>
                                        <td>
                                            <a href="{{ route('backend.post.edit', $post) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit mr-2"></i>
                                                Update
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No Post found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
