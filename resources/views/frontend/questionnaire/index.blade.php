@extends('layouts.frontend')
@section('title', 'Questionnaire')

@section('main')
    <section class="pageHeaderMain">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <form action="/questionnaire" method="POST">
                        @csrf
                        @for ($i = 1; $i <= 6; $i++)
                            <label>Question {{ $i }}</label><br>
                            @foreach(['A', 'B', 'C'] as $option)
                                <input type="radio" name="question_{{ $i }}" value="{{ $option }}" required> {{ $option }}
                            @endforeach
                            <br><br>
                        @endfor
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        .archivo {
            font-family: "Archivo", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous"
          referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            $(window).on('load', function() {
                AOS.refresh();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    </script>
@endpush
