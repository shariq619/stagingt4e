@extends('layouts.frontend')
@section('title', 'Examination Requirements')

@section('main')
    <div class="examinationPage">
        <div class="pageTitleTop pyxl-5">
            <div class="container">
                <h1 class="text-center">Examination Requirements</h1>
            </div>
        </div>
        <section class="referFriendFaqs pyxl-5">
            <div class="container">
                <h2 class="mb-5">WHAT YOU MUST BRING?</h2>
                <p>TWO passport-sized good quality colour photographs <strong><i>as normally specified for
                            passports</i></strong>. There should be no headgear (except that worn for religious reasons) or
                    sunglasses.</p>
                <h2 class="my-5">ITEMS OF IDENTIFICATION</h2>
                <ul class="pl-3">
                    <li>2 Items from <strong>Group A</strong> (At least one document must show your current address and one
                        showing your date of birth) <strong></strong></li>
                </ul>
                <p>OR<br>
                </p>
                <ul class="pl-3">
                    <li>1 item from <strong>group A </strong>; and 2 from <strong>Group B</strong></li>
                </ul>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>Group A</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#accordionFaqs">
                                        <ul class="pb-0 mb-0">
                                            <li>Signed valid passport of any nationality</li>
                                            <li>Signed valid UK photo driving license (both parts of the full or provisional
                                                license are required)</li>
                                            <li>UK original birth certificate issued within 12 months of birth</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card active">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>Group B</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse show" aria-labelledby="acc2"
                                        data-parent="#accordionFaqs">
                                        <ul class="pb-0 mb-0">
                                            <li>UK adoption certificate</li>
                                            <li>Valid EU photo ID card</li>
                                            <li>Valid UK firearms license with photo</li>
                                            <li>Signed valid UK paper driving license</li>
                                            <li>Marriage certificate or Civil Partnership certificate, with translation if
                                                not in English</li>
                                            <li>UK birth certificate issued more than 12 months after date of birth, but not
                                                a photocopy</li>
                                            <li>Non-UK birth certificate, with translation if not in English</li>
                                            <li>P45 statement of income for tax purposes on leaving a job issued in the last
                                                12 months</li>
                                            <li>P60 annual statement of income for tax purposes issued in the last 12
                                                months. Bank or building society statement issued to your current address,
                                                less than three old. You can use more than more than one statement as long
                                                as each is issued by a different bank or a building society.</li>
                                            <li>2nd Bank or building society statement issued to your current address, less
                                                than three months old from a different provider to 13</li>
                                            <li>Mortgage statement issued in the last 12 months</li>
                                            <li>Utility bill (gas, electric, telephone, water, satellite, cable,) issued to
                                                your current address within the last three months. You can only use one
                                                utility bill in support of your application (mobile phone contracts are NOT
                                                accepted)</li>
                                            <li>Pension, endowment or ISA statement issued in last 12 months</li>
                                            <li>British work permit or visa issued in last 12 months</li>
                                            <li>Letter from H.M. Revenue &amp; Customs, Department of Work and Pensions,
                                                employment service, or local authority issued within the last three months.
                                                You can use more than one letter as long as each is issued by a different
                                                Government department or a different local authority</li>
                                            <li>2nd letter from different provider to 21</li>
                                            <li>A credit card statement sent to your current address within the last three
                                                months. You can use more than one statement as long as each is issued by a
                                                different issuer</li>
                                            <li>2nd credit card statement from different provider to 23</li>
                                            <li>Council Tax statement issued in the last 12 months</li>
                                            <li>Child benefit book issued in last 12 months</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pyxxl-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="noted">
                            <h3>Please Note:</h3>
                            <p style="font-size:22px;">Failure to bring valid original, correct identification and
                                photographs as specified will result in delegate being removed from the relevant course and
                                no examination!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pyxl-5 pb-0">
            <div class="container">
                <h2 class="text-center mb-5 fs2">Popular Courses</h2>
                <div class="row">
                    @forelse ($courses as $courses)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="relatedProducts productGridSingle mb-5">
                                <div class="relatedProduct">
                                    <div class="bundlesAll d-flex flex-column justify-content-between h-100">
                                        <div class="relatedThumbnail">
                                            <a href="{{ route('course.show', $courses->slug) }}">
                                                <img src="{{ asset($courses->course_image ? $courses->course_image : 'frontend/img/thumbnail.webp') ?? '' }}"
                                                    class="img-fluid" alt="{{ $courses->name ?? '' }}">
                                                <h3 class="mt-4">{{ $courses->name ?? '' }}</h3>
                                            </a>
                                        </div>
                                        <div class="relatedContent">
                                            <p class="price">£{{ $courses->price ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Bundle Found!</p>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="pyxl-5">
            <div class="container">
                <h2 class="mb-5 fs2 text-center">What Customers Are Saying</h2>
                <script defer async src='https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0'></script>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        .examinationPage .relatedProducts .relatedProduct {
            box-shadow: #0000002e 0px 0px 10px 0px;
            padding: 10px 10px;
        }
        .examinationPage .relatedContent p.price{
            font-weight:500;
        }

        .examinationPage .relatedProducts .relatedProduct h3 {
            font-size: 20px;
            color: #000;
        }

        .relatedProducts {
            height: 100%;
        }

        .examinationPage .relatedProducts .relatedProduct .bundlesAll {
            min-height: 400px !important;
        }

        .noted {
            background: #c7002e;
            color: #fff;
            text-align: center;
            padding: 2rem;
        }
    </style>
@endpush
