@extends('layouts.frontend')

@section('title', 'Page Not Found')

@push('css')
    <style>
        /*.not-found-page {*/
        /*    text-align: center;*/
        /*    padding: 40px 0;*/
        /*}*/
        section.py-5.text-center {
    background: #69568124;
}
        .not-found-page h2 {
    font-size: 40px;
    text-transform: uppercase;
    padding: 20px 0px;
}
       .not-found-page h1 {
    font-size: 120px;
    font-weight: bold;
}
.not-found-page p {
    font-size: 20px;
}
.not-found-page a.btn.btn-primary {
    background: #1b72a7;
    border: none;
    width: 250px;
    margin-top:20px;
    padding: 10px;
}
.not-found-page a.btn:hover {
    background: #020202;
    transition:0.8s;
    letter-spacing:2px;
}
    </style>
@endpush

@section('main')
    <div class="not-found-page">
        <section class="py-5 text-center">
            <div class="container text-center py-5">
                <h1 class="text-danger display-1">404</h1>
                <h2 class="mb-3">Oops! This page isn’t quite making the grade.</h2>
                <p class="mb-3">
                    Looks like the resource you're trying to reach either doesn’t exist or we’re having a bit of a moment<br> behind the scenes. It might be:
                </p>
                <!-- Force left alignment only for this section -->
                <div class="mb-4 text-start mx-auto" style="max-width: 500px;">
                    <ul class="list-unstyled">
                        <li style="text-align: left;">🔹 Moved or deleted</li>
                        <li style="text-align: left;">🔹 Temporarily unavailable</li>
                        <li style="text-align: left;">🔹 Never existed in the first place (spooky, right?)</li>
                    </ul>
                </div>
                <p class="mb-4">But don’t worry, we’ve got your back. You’ll be redirected to your dashboard in a few seconds.</p>

                @php
                    $redirectUrl = url('/'); // default

                    if (auth()->check()) {
                        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('SEO') ) {
                            $redirectUrl = route('backend.dashboard.index');
                        } elseif (auth()->user()->hasRole('Learner')) {
                            $redirectUrl = route('backend.learner.dashboard');
                        } elseif (auth()->user()->hasRole('Trainer')) {
                            $redirectUrl = route('backend.trainer.dashboard');
                        } elseif (auth()->user()->hasRole('Corporate Client')) {
                            $redirectUrl = route('backend.client.dashboard');
                        }
                    }
                @endphp

                @auth
                    <a href="{{ $redirectUrl }}" class="btn btn-primary">Return to My Dashboard</a>
                @endauth

                @guest
                    <a href="{{ $redirectUrl }}" class="btn btn-primary">Go Back Home</a>
                @endguest
            </div>

        </section>
    </div>
@endsection

@push('js')
 <script>
     setTimeout(function () {
         window.location.href = "{{ $redirectUrl }}";
     }, 5000);
 </script>
@endpush
