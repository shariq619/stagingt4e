@extends('layouts.frontend')

@section('title', 'Thank You')

@section('main')
    <div class="thankYouPage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 text-center py-5">
                        <div class="bannerCol px-3">
                            <div class="bannerInfo">
                                <h1 class="mb-4">Thank You!</h1>
                                <p class="h4 mb-4">Your submission has been received successfully.</p>
                                <p class="mb-3">We appreciate your interest. Our team will review your details and get back to you shortly.</p>
                                <p class="mb-3">If you have any questions, feel free to <a href="{{ route('contact') }}">contact us</a>.</p>
                                <a href="{{ route('home.index') }}" class="btn btn-primary mt-4">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
