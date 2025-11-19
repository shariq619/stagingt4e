@extends('layouts.frontend')
@section('title', 'Products')

@section('main')

    <style>
        section#banner {
            /* background-image: linear-gradient(275deg, #090039 0%, #085e92 83%); */
            background: url(https://training4employment.co.uk/wp-content/uploads/2021/04/Title-Page-2.jpg);
            background-size: cover;
            border-bottom: 10px solid;
            border-right: 20px solid;
            width: 90%;
        }

        .bannerWrapper h1 {
            color: #000000;
            font-size: 55px;
            line-height: 55px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .bannerInfo {
            padding: 40px;
        }

        .bannerWrapper h1 {
            color: #000000;
            font-size: 55px;
            line-height: 55px;
        }

        .bannerWrapper p {
            color: #000000;
            font-size: 20px;
            line-height: 30px;
        }
    </style>
    <div class="productBookPage produdctIndexPage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-5">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                            <div class="bannerInfo">
                                <h1 class="mb-5">Products</h1>
                                <p>We are excited to announce that we are now offering products available for you to
                                    purchase. You can also purchase these at our training centre during your course!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="courseBundles productpage py-5">
            <div class="container py-5">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-5">
                            <div class="productGrid">
                                <div class="productGridInner">
                                    <div class="productGridThumbnail position-relative">
                                        <div class="productGridImg">
                                            <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/placeholderimage.jpg') }}"
                                                class="img-fluid w-100" alt="{{ $product->name }}">
                                        </div>
                                        <div class="productGridOverlay"
                                            style="background:url({{ $product->product_image ? asset($product->product_image) : asset('images/placeholderimage.jpg') }}) no-repeat center/cover;">
                                        </div>
                                    </div>
                                    <div class="productGridContent">
                                        <h3 class="h5">{{ $product->name }}</h3>
                                        <p>{!! Str::limit($product->short_description, 100, '...') !!}</p>
                                        <p class="bookPrice">£{{ $product->price }}</p>

                                    </div>
                                    <div class="productGridbutton">
                                        <a href="{{ route('frontend.product.show', $product->slug) }}" class="gridBtn">Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Product Found!</p>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>
@endsection

@push('head_schema')
    <script type="application/ld+json">
        {
        "@context": "https://schema.org/",
        "@graph": [
            @foreach ($products as $product)
                {
                "@type": "Product",
                "name": "{{ $product->name }}",
                "image": "{{asset($product->product_image)}}",
                "description": "{!! $product->short_description !!}",
                "brand": {
                    "@type": "Brand",
                    "name": "Training4Employment"
                },
                "offers": {
                    "@type": "Offer",
                    "url": "{{ route('frontend.product.show', $product->slug) }}",
                    "priceCurrency": "GBP",
                    "price": "{{ $product->price }}",
                    "availability": "https://schema.org/InStock",
                    "itemCondition": "https://schema.org/NewCondition"
                }
                }@if (!$loop->last),@endif
                
            @endforeach
        ]
        }
    </script>
@endpush
