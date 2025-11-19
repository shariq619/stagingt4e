@extends('layouts.frontend')
@section('title', 'Help Center')
@section('main')
    <div class="helpCenter">
        <section class="bannerHelp">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-8" data-aos="fade-down">
                        <div class="bannerText text-center">
                            <h1>How can we help you?</h1>
                            <p><strong>Our crew of superheroes are standing by for Help & Support!</strong></p>
                            <form class="d-flex formSearchHelp mb-5">
                                <input class="form-control" type="search" placeholder="Search help topics" aria-label="Search help topics">
                                <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                            <ul class="listHelp list-unstyled p-0 m-0 d-flex justify-content-center">
                                <li class="mr-2">Popular sections:</li>
                                <li class="mr-2">Shop with an expert</li>
                                <li class="mr-2">Help with password</li>
                                <li class="mr-2">Tracking your item</li>
                            </lu>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="boxesDetailHelp mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/shopping-bag.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Orders & Purchases">
                            <h3 class="h5 my-4">Orders & Purchases</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">Store pickup</a></li>
                                <li><a href="javascript:;">Cancel an order</a></li>
                                <li><a href="javascript:;">Track a package</a></li>
                                <li><a href="javascript:;">In-Store Consultation</a></li>
                                <li><a href="javascript:;">Shop with an expert</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/budget.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Account">
                            <h3 class="h5 my-4">Account</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">Manage payment methods</a></li>
                                <li><a href="javascript:;">Manage Your Rewards</a></li>
                                <li><a href="javascript:;">Manage your account</a></li>
                                <li><a href="javascript:;">Account Settings</a></li>
                                <li><a href="javascript:;">Help with password</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/return-box.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Returns & Refunds">
                            <h3 class="h5 my-4">Returns & Refunds</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">I would like to return my order</a></li>
                                <li><a href="javascript:;">What if my order is damaged?</a></li>
                                <li><a href="javascript:;">How do I cancel an order?</a></li>
                                <li><a href="javascript:;">I've received a faulty/damaged item</a></li>
                                <li><a href="javascript:;">How will I be refunded?</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/tracking.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Shipping & Tracking">
                            <h3 class="h5 my-4">Shipping & Tracking</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">Buying with local pickup</a></li>
                                <li><a href="javascript:;">Saving through combined shipping</a></li>
                                <li><a href="javascript:;">Delivery date options for buyers</a></li>
                                <li><a href="javascript:;">Shipping rates for buyers</a></li>
                                <li><a href="javascript:;">Tracking your item</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/bill-payment.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Fees & billing">
                            <h3 class="h5 my-4">Fees & billing</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">Refunds and Disputes</a></li>
                                <li><a href="javascript:;">Getting Paid</a></li>
                                <li><a href="javascript:;">Fees and Reporting</a></li>
                                <li><a href="javascript:;">Getting Started</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="boxesDetailInner">
                            <img src="{{asset('frontend/img/other.png')}}" width="40" height="40" class="mb-3 img-fluid" alt="Other">
                            <h3 class="h5 my-4">Other</h3>
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="javascript:;">Trade-In</a></li>
                                <li><a href="javascript:;">Gift Cards</a></li>
                                <li><a href="javascript:;">Getting Receipt Copies</a></li>
                                <li><a href="javascript:;">In-Store Consultation</a></li>
                            </ul>
                            <a href="javascript:;" class="d-inline-block text-capitalize btnBoxDetail">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            $(window).on('load', function() {
                AOS.refresh();
            });
        });
    </script>
@endpush
