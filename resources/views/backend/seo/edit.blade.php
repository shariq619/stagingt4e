@extends('layouts.main')

@section('title', 'Seo')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Change Seo') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Seo') }}</li>
        <li class="breadcrumb-item active">{{ __('Update') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card carFormWrapper">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.seo.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.seo.update', $seo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">@include('backend.seo._form')</div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('backend.seo.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete seo')
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCat">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('Delete seo') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete seo')
<div class="modal fade" id="deleteCat" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete seo') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.seo.destroy', $seo) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('delete seo?') }}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.0/tagify.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.0/tagify.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            const meta_keywords = document.querySelector('#meta_keywords');
            new Tagify(meta_keywords);
        });
    </script>
    <script>
        function calculateSeoScore(text, min, max) {
            let length = text.length;
            if (length < min) return 25;  // Poor
            if (length > max) return 50;  // Average
            return 100;  // Good
        }

        function updateSeoScore() {
            let title = document.getElementById("meta_title").value;
            let description = document.getElementById("meta_description").value;
            let keywords = document.getElementById("meta_keywords").value;

            let titleScore = calculateSeoScore(title, 40, 60);
            let descriptionScore = calculateSeoScore(description, 140, 160);
            let keywordScore = keywords.length > 0 ? 100 : 0; // Keywords should not be empty

            updateScoreDisplay("titleScore", titleScore);
            updateScoreDisplay("descriptionScore", descriptionScore);
            updateScoreDisplay("keywordScore", keywordScore);
        }

        function updateScoreDisplay(id, score) {
            let element = document.getElementById(id);
            element.innerText = `Score: ${score}/100`;

            // Change color based on score
            element.classList.remove("score-red", "score-orange", "score-green");
            if (score <= 25) {
                element.classList.add("score-red");
            } else if (score <= 50) {
                element.classList.add("score-orange");
            } else {
                element.classList.add("score-green");
            }
        }

        // Run on page load
        document.addEventListener("DOMContentLoaded", updateSeoScore);
    </script>
@endpush
