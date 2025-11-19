@extends('layouts.frontend')

@section('title', ucfirst($slug->name))

@section('main')

    <style>
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tabs {
            display: flex;
            gap: 10px;
        }

        .tab-button {
            padding: 10px;
            cursor: pointer;
            background: #007bff00;
            color: #000;
            border: none;
            border-radius: 5px;
        }

        .tab-button:hover {
            background: #085e92;
            color: #fff;
        }

        .prouctinfo .tabs {
            display: flex;
            justify-content: center;
            background: #f4f7f9;
            padding: 40px;
            margin-bottom: 50px;
        }

        .prouctinfo .tabs button.tab-button {
            width: 200px;
            padding: 30px;
            font-size: 24px;
        }

        .tab-button.active {
            background: #085e92;
            border-top: 6px solid #ea7000;
            color: #fff;
        }


        @media (max-width: 479px) {
            .prouctinfo .tabs button.tab-button {
                width: 100%;
                padding: 30px;
                font-size: 24px;
            }

            .prouctinfo .tabs {
                display: flex;
                justify-content: center;
                background: #f4f7f9;
                padding: 40px;
                margin-bottom: 50px;
                flex-direction: column;
            }
        }
    </style>
    <div class="courseBundleDetailPage">
        <section class="detailTopSection pt-5">
            <div class="container">
                <div class="row pb-5 mb-5">
                    <div class="col-12 col-md-6">
                        <nav class="dtpBreadcrumb mb-5 d-block d-md-none d-lg-none d-xl-none" aria-label="Breadcrumb">
                            <a href="/">Home</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <a href="{{ route('frontend.product.index') }}">Products</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <span>{{ $slug->name }}</span>
                        </nav>
                        @php $images = json_decode($slug->gallery); @endphp
                        <div class="ProdutImageSlider">
                            @if (!$images)
                                <div class="singleImage">
                                    <a href="{{ asset($slug->product_image ? $slug->product_image : 'frontend/img/thumbnail.webp') }}"
                                       data-fancybox="gallery">
                                        <img
                                            src="{{ asset($slug->product_image ? $slug->product_image : 'frontend/img/thumbnail.webp') }}"
                                            class="img-fluid w-100" alt="{{ Str::title($slug->name) }}">
                                    </a>
                                </div>
                            @else
                                <div class="singleImage">
                                    <a href="{{ asset($slug->product_image ? $slug->product_image : 'frontend/img/thumbnail.webp') }}"
                                       data-fancybox="gallery">
                                        <img
                                            src="{{ asset($slug->product_image ? $slug->product_image : 'frontend/img/thumbnail.webp') }}"
                                            class="img-fluid w-100" alt="{{ Str::title($slug->name) }}">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="booknow">
                        <nav class="dtpBreadcrumb mb-5 d-none d-md-block d-lg-block d-xl-block" aria-label="Breadcrumb">
                            <a href="/">Home</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <a href="{{ route('frontend.product.index') }}">Products</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <span>{{ $slug->name }}</span>
                        </nav>
                        <div class="dtpInfo">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf

                                <h1 class="mb-4">{{ $slug->name }}</h1>
                                <p class="h4">£{{ $slug->price }}</p>
                                <div class="dtpShortDesc my-4">
                                    {!! $slug->short_description !!}


                                    @if($slug->slug == "badge-holders")
                                        <div class="form-group">
                                            <label>Select Color:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color_option" id="fluorescent" value="Fluorescent" required>
                                                <label class="form-check-label" for="fluorescent">Fluorescent</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color_option" id="plain_black" value="Plain Black" required>
                                                <label class="form-check-label" for="plain_black">Plain Black</label>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="dtpFinalTotal mt-2">
                                    <p class="h6">Final total</p>
                                    <p class="h6">£{{ $slug->price }}</p>


                                    <input type="hidden" name="is_bundle" value="2">
                                    <input type="hidden" name="product_id" value="{{ $slug->id }}">
                                    <input type="hidden" name="product_name" value="{{ $slug->name }}">
                                    <input type="hidden" name="product_price" value="{{ $slug->price }}">
                                    <div class="dtpAddToCart mt-5">
                                        <button class="btn btnCart" type="submit">Add to basket</button>
                                    </div>

                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="prouctinfo">

                    <div class="tabs">
                        @if($slug->description)
                            <button class="tab-button active" onclick="showTab('tab1', this)">Product Details</button>
                        @endif
                        @if($slug->description_two)
                            <button class="tab-button" onclick="showTab('tab2', this)">Who Should Use</button>
                        @endif
                        @if($slug->description_three)
                            <button class="tab-button" onclick="showTab('tab3', this)">Benefits</button>
                        @endif
                        @if($slug->description_four)
                            <button class="tab-button" onclick="showTab('tab4', this)">Tab 4</button>
                        @endif
                    </div>

                    @if($slug->description)
                        <div id="tab1" class="tab-content active">
                            <div class="pb-4 singledec"> {!!   $slug->description ?? "" !!}</div>
                        </div>
                    @endif

                    @if($slug->description)
                        <div id="tab2" class="tab-content">
                            <div class="pb-4 singledec"> {!!   $slug->description_two ?? "" !!}</div>
                        </div>
                    @endif

                    @if($slug->description)
                        <div id="tab3" class="tab-content">
                            <div class="pb-4 singledec">{!!   $slug->description_three ?? "" !!}</div>
                        </div>
                    @endif

                    @if($slug->description)
                        <div id="tab4" class="tab-content">
                            <div class="pb-4 singledec">{!!   $slug->description_four ?? "" !!}</div>
                        </div>
                    @endif

                </div>


                <h2 class="fs2 mt-5">Related Products</h2>
                <div class="relatedProducts productGridSingle mt-5 my-5">
                    @forelse ($products as $product)
                        @if ($product->id != $slug->id)
                            @php
                                $formId = 'product_booking_' . $product->id; // Unique form ID
                            @endphp
                            <div class="relatedProduct">
                                <div class="bundlesAll d-flex flex-column justify-content-between h-100">
                                    <div class="relatedThumbnail">
                                        <a href="{{ route('frontend.product.show', $product->slug) }}">
                                            <img
                                                src="{{ asset($product->product_image ? $product->product_image : 'frontend/img/thumbnail.webp') }}"
                                                class="img-fluid" alt="{{ Str::title($product->name) }}">
                                        </a>
                                        <h3 class="mt-4">{{ $product->name ?? '' }}</h3>
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" id="{{ $formId }}">
                                        @csrf
                                        <input type="hidden" name="is_bundle" value="2">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                                        <div class="relatedContent">
                                            <p class="price">£{{ $product->price ?? '' }}</p>
                                            <div class="dtpAddToCart d-inline-block mt-1">
                                                <a href="#" class="btn btnCart"
                                                   onclick="document.getElementById('{{ $formId }}').submit(); return false;">Add
                                                    to basket</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endif
                    @empty
                        <p>No Products Found!</p>
                    @endforelse
                </div>

        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@push('js')
    <script>
        function showTab(tabId, button) {
            let contents = document.querySelectorAll('.tab-content');
            let buttons = document.querySelectorAll('.tab-button');

            contents.forEach(content => content.classList.remove('active'));
            buttons.forEach(btn => btn.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
            button.classList.add('active');
        }

        // Hide all tabs initially except the first one
        document.addEventListener("DOMContentLoaded", function () {
            let contents = document.querySelectorAll('.tab-content');
            contents.forEach((content, index) => {
                if (index !== 0) content.classList.remove('active');
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $('.gallerySlider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                autoplaySpeed: 2000,
                autoplay: true,
            });

            $('.relatedProducts').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                dots: true,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            Toolbar: {
                display: [{
                    id: "counter",
                    // position: "center"
                },
                    // "zoom",
                    // "fullscreen",
                    "close",
                ],
            },
            Thumbs: {
                autoStart: true,
            },
        });
    </script>
@endpush
