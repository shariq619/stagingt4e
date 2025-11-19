@extends('layouts.main')

@section('title', 'Risk Assessment Form')

@push('css')
    <style>
        .formWrapper {
            padding: 20px;
            border: solid 1px #cccc;
            border-radius: 10px;
            background: #fff;
        }
        .formWrapper h1 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        table.table-bordered td,
        table.table-bordered th {
            vertical-align: middle;
            font-size: 14px;
        }
    </style>
@endpush

@section('main')


    <div class="formWrapper mb-5">


        <div class="row">
            <div class="col-md-12">
                <div class="row headerDetail">
                    <div class="col-12">
                        <img height="200" width="200" alt="Logo" class="img-fluid" src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" />
{{--                        <div class="companyInfo">--}}
{{--                            <p class="m-0"><strong>{{ $cohort->course->name ?? "" }}</strong></p>--}}
{{--                            <span>{!! formatCourseCalDate($cohort) !!}</span><br/>--}}
{{--                            <span>{{ $cohort->venue->venue_name ?? "" }}</span><br/>--}}
{{--                            <span>{{ $cohort->trainer->name ?? "" }}</span><br/>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="formWrapper">




        <h1>
            MAYBO/NFPS SAFER/ Mc Cormack/Elite/NGTC Level 2 Physical Intervention <br>
            T4E Risk Assessment for Training Room
        </h1>

        <form method="POST" action="{{ route('backend.risk.assessment.store') }}" id="riskForm">
            @csrf
            <input type="hidden" name="cohort_id" value="{{ $cohort->id }}"/>
            <input type="hidden" name="tutor_signature" id="signature-input-paf">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Course:</label>
                    <input type="text" class="form-control" name="course" value="{{ $cohort->course->name ?? "" }}"  readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>Date:</label>
                    <input type="date" class="form-control" name="date"
                           value="{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('Y-m-d') }}" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label>Times:</label>
                    <input type="time" class="form-control" name="times"
                           value="{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('H:i') }}" readonly>
                </div>

            </div>

            <div class="form-group">
                <label>Tutor(s):</label>
                <input type="text" class="form-control" name="tutors" value="{{ $cohort->trainer->name ?? "" }}" readonly>
            </div>

            <div class="form-group">
                <label>Training Venue:</label>
                <input type="text" class="form-control" name="training_venue" value="{{ $cohort->venue->venue_name ?? "" }}" readonly>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tutor assessing</label>
                    <input type="text" class="form-control" name="tutor_assessing">
                </div>
                <div class="form-group col-md-6">
                    <label>Location assessed</label>
                    <input type="text" class="form-control" name="location_assessed">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Number of delegates</label>
                    <input type="number" class="form-control" name="delegates">
                </div>
                <div class="form-group col-md-6">
                    <label>Dimensions of training area</label>
                    <input type="text" class="form-control" name="dimensions">
                </div>
            </div>

            <!-- Checklist Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Checklist</th>
                        <th>Suitable Safe</th>
                        <th>Unsuitable/unsafe</th>
                        <th>Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $checklist = [
                            'emergency_contact' => 'Emergency contact',
                            'fire_safety' => 'Fire Safety-Evacuation and Assembly Point',
                            'first_aid' => 'Access to first aid equipment',
                            'floor_clean' => 'Floor surface clean, free from obstruction',
                            'floor_surface' => 'Floor Surface-defects/lifting surface',
                            'walls' => 'Walls-no projections/hanging objects',
                            'pillars' => 'Pillars/corners',
                            'sockets' => 'Electrical Sockets',
                            'doors' => 'Doors/windows/glass',
                            'furniture' => 'Furniture removed or stacked',
                            'trainer_equipment' => 'Trainer/student/property/equipment',
                            'observers' => 'Observers/non delegates present',
                            'ceiling' => 'Ceiling-defects/hanging objects',
                            'heating' => 'Heating/ventilation units',
                            'drinking_fluids' => 'Access to drinking fluids',
                            'other' => 'Other'
                        ];
                    @endphp

                    @foreach($checklist as $key => $item)
                        <tr>
                            <td>{{ $item }}</td>
                            <td class="text-center">
                                <input type="radio" name="checklist[{{ $key }}]" value="safe">
                            </td>
                            <td class="text-center">
                                <input type="radio" name="checklist[{{ $key }}]" value="unsafe">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="comments[{{ $key }}]">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Hazards -->
            <div class="form-group">
                <label>Hazards Identified:</label>
                <textarea class="form-control" rows="3" name="hazards"></textarea>
            </div>

            <!-- Control measures -->
            <div class="form-group">
                <label>Implemented control measures/briefing to delegates:</label>
                <textarea class="form-control" rows="3" name="control_measures"></textarea>
            </div>

            <!-- Signature -->
            <div class="form-row">

                <div class="form-group col-md-8">
                    <label>{{ __('Tutor Signature(s):') }}<span>*</span></label>
                    <div id="signature-pad" class="signature-pad">
                        <div id="signature-pad" class="signature-pad">
                            <div class="signature-pad-body">
                                <canvas id="signature-canvas"
                                        style="background: #fff; border: solid 2px #cccc; margin-bottom: 30px;"></canvas>
                            </div>
                            <div class="signature-pad-footer">
                                <button type="button" class="btn btn-danger"
                                        id="clear-signature">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label>Date:</label>
                    <input type="date" class="form-control" name="sign_date">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
@endsection





@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            const canvas = document.getElementById('signature-canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            // Clear button
            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Submit handler on correct form
            document.getElementById('riskForm').addEventListener('submit', function(event) {
                if (!signaturePad.isEmpty()) {
                    const signatureDataUrl = signaturePad.toDataURL();
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });
        });
    </script>
@endpush
