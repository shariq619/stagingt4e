@php
    use App\Libraries\ScormCloud_Php_Sample;
    use App\Models\ProfilePhoto;
    use RusticiSoftware\Cloud\V2 as ScormCloud;
@endphp
@extends('layouts.main')
@section('title', 'Learner Dashboard')
@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
          integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{  asset('css/dflip.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/themify-icons.min.css') }}">
    <style>
        #flipbook {
            width: 800px;
            height: 600px;
            margin: auto;
        }

        .page {
            background: #fff;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        .table-responsive.elearning tr td span {
            font-size: 20px;
            margin-bottom: 20px !important;
            display: block;
        }

        .table-responsive.myUlpoads {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
            margin-bottom: 50px;
        }

        .table-responsive.elearning {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
        }

        .table-responsive.elearning tr {
            border: none !important;
        }

        .table-responsive.elearning tr:hover {
            background: transparent;
        }

        .table-responsive.elearning tr img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .table-responsive.elearning tr {
            border: solid 1px #ccc !important;
            margin-bottom: 30px !important;
            display: block;
            border-radius: 10px;
        }

        .table-responsive.elearning tr td {
            border: none;
            display: block;
        }

    </style>
@endpush
@section('main')
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-secondary card-tabs">
                <div class="card-body">
                            <div class="_df_book"  webgl="true"
                                 backgroundcolor="transparent"
                                 source="{{ asset($task->task_code) }}"
                                 id="df_manual_book"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{  asset('js/dflip.min.js') }}"></script>
@endpush
