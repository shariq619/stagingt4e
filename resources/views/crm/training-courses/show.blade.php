@extends('crm.layout.main')

@section('main')
    <div class="container-fluid px-3 py-3">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('crm.training-courses.tabs')
                            @php
                                $routeName = request()->route()->getName();
                                $tab       = request()->get('tab');
                                $isShow    = $routeName === 'crm.training-courses.show';
                            @endphp

                            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                @if ($isShow && !$tab)
                                    @include('crm.training-courses.tabs.cohort_detail')
                                @elseif ($tab === 'audit')
                                    @include('crm.training-courses.tabs.audit_history')
                                @elseif ($tab === 'profit')
                                    @include('crm.training-courses.tabs.profit_margins')
                                @elseif ($tab === 'misc')
                                    @include('crm.training-courses.tabs.miscellaneous_cost')
                                @else
                                    @include('crm.training-courses.tabs.cohort_detail')
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('crm.training-courses.scripts')
