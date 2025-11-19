@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Trainer's Feedback</h5>
            </div>
            <div class="card-body">
                @if($trainerResponse)

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead>
                            <tr>
                                <th scope="col">Question</th>
                                <th scope="col">Trainer's Response</th>
                                <th scope="col">Trainer's Feedback</th>
                                <th scope="col">Grade</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                // Custom function to handle alphanumeric sorting
                                uksort($trainerResponse, function ($a, $b) {
                                    // Split the question number and the letter (e.g., '1a' => 1, 'a')
                                    $aNumber = (int) filter_var($a, FILTER_SANITIZE_NUMBER_INT);
                                    $bNumber = (int) filter_var($b, FILTER_SANITIZE_NUMBER_INT);

                                    // If both have the same numeric part, compare the letters (e.g., 'a', 'b')
                                    if ($aNumber === $bNumber) {
                                        $aLetter = preg_replace('/[0-9]/', '', $a); // Extract the letter part
                                        $bLetter = preg_replace('/[0-9]/', '', $b);
                                        return strcmp($aLetter, $bLetter); // Compare the letter part
                                    }

                                    return $aNumber <=> $bNumber; // Compare the numeric part
                                });
                            @endphp
                            @foreach($trainerResponse as $questionId => $response)
                                @php
                                    $formattedQuestionId = preg_match('/^[0-9]+[a-z]?$/', $questionId) ? $questionId : $questionId;
                                @endphp
                                <tr>
                                    <td>Question {{ $formattedQuestionId }}</td>
                                    <td>
                                        @switch($response['answer'] ?? "")
                                            @case('correct')
                                                <span class="badge"
                                                      style="background-color: #92d36e; color: black; padding: 0.5em 1em; font-size: 0.8em;">Correct</span>
                                                @break
                                            @case('incorrect')
                                                <span class="badge"
                                                      style="background-color: #ff3823; color: black; padding: 0.5em 1em; font-size: 0.8em;">Incorrect</span>
                                                @break
                                            @default
                                                <span class="badge"
                                                      style="background-color: #ff5d55; color: black; padding: 0.5em 1em; font-size: 0.8em;">-</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $response['feedback'] ?? 'No feedback provided' }}</td>
                                    <td>{{ $response['grade'] ?? 'No grades found' }}</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No trainer response available.</p>
                @endif
            </div>
        </div>


        @if(isset($high_field_response))
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Highfield Unit Mapping</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="unitMapping">
                                <p>The following mapping reference provides a guide for assessors on suggested coverage
                                    of
                                    unit criteria within this kit. Where indicated on the ‘Unit Kit Question’ column
                                    with a
                                    ‘QXX’, this refers to a question within the kit that could provide coverage for the
                                    identified criteria.</p>
                                <p>However, it should be noted that it is still the responsibility of the assessor to
                                    ensure
                                    the answer provided by the learner is of the appropriate standard to meet the
                                    criteria
                                    in full.</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Learner Name <span>*</span></label>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="learner_name"
                                   value="{{ $high_field_response['learner_name'] ?? "" }}">
                            <small>First Name</small>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="last_name"
                                   value="{{ $high_field_response['last_name'] ?? "" }}">
                            <small>Last Name</small>
                        </div>
                        <div class="col-12  mt-3">
                            <label>Centre Name</label>
                            <input type="text" class="form-control" name="center_name"
                                   value="{{ $high_field_response['center_name'] ?? "" }}">
                        </div>
                        <div class="col-12">
                            <h4 class="mt-3">Unit 2: Principles of Minimising Personal Risk for Security Officers in the
                                Private Security Industry</h4>

                            <div class="table-responsive my-3">
                                <table class="table table-striped table-hover">
                                    <thead class="table-light">
                                    <tr class="bg-gray">
                                        <th width="15%">Unit criteria</th>
                                        <th width="25%">Unit kit question</th>
                                        <th width="60%">Additional evidence</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @php

                                        $additionalEvidence = $high_field_response['additional_evidence'] ?? [];


                                        $keys = array_keys($additionalEvidence);
                                        natsort($keys);

                                        // Rebuild the array in the sorted order
                                        $sortedAdditionalEvidence = [];
                                        foreach ($keys as $key) {
                                            $sortedAdditionalEvidence[$key] = $additionalEvidence[$key];
                                        }

                                        //dd($sortedAdditionalEvidence);


                                        $a = 1;
                                    @endphp

                                    @foreach ($sortedAdditionalEvidence as $key => $value)
                                        <tr>
                                            <td><strong>1.{{ $a }}</strong></td>
                                            <td>Question {{ $key }}</td>
                                            <td>
                                                <input type="text"
                                                       name="high_field_response[additional_evidence][{{ $key }}]"
                                                       class="form-control"
                                                       value="{{ old('high_field_response.additional_evidence.' . $key, $value) }}">
                                            </td>
                                        </tr>
                                        @php $a++; @endphp
                                    @endforeach



                                    </tbody>
                                </table>
                            </div>
                            <div class="my-3 border rounded">
                                <h4 class="bgHeading my-3 mx-3">Training Provider/Assessment Confirmation</h4>
                                <div class="m-3">
                                    <h5><strong>Further Evidence</strong></h5>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="high_field_response[evidence1]"
                                            {{ $high_field_response['evidence1'] == "Further assessment evidence guidance is required" ? 'checked' : '' }}
                                            value="Further assessment evidence guidance is required">
                                            <label class="form-check-label">Further assessment evidence guidance is
                                                required.</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="high_field_response[evidence1]"
                                                   {{ $high_field_response['evidence1'] == "No further assessment evidence guidance is required" ? 'checked' : '' }}
                                                   value="No further assessment evidence guidance is required">
                                            <label class="form-check-label">No further assessment evidence guidance is
                                                required, as all criteria within this unit are linked to the questions
                                                within the workbook. If assessors wish to supplement this learner
                                                evidence
                                                further, they may do so and map this in the ‘Additional evidence’ column
                                                above.</label>
                                        </div>
                                    </div>
                                    <p class="m-0"><label>Assessor's Name</label></p>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="high_field_response[assessor_first_name]"
                                                   class="w-100 form-control"
                                                   value="{{ $high_field_response['assessor_first_name'] ?? "" }}">
                                            <small>First Name</small>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="high_field_response[assessor_last_name]"
                                                   class="w-100 form-control"
                                                   value="{{ $high_field_response['assessor_last_name'] ?? "" }}">
                                            <small>Last Name</small>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3">
                                        <div class="col-6">
                                            <p class="m-0"><label>Assessor's Signature</label></p>
                                            <div>
                                                <h5>Signature:</h5>
                                                <img src="{{ $high_field_response['Assessors_signature'] ?? "" }}"
                                                     alt="Assessors Signature"
                                                     style="max-width: 200px;">
                                            </div>


                                        </div>
                                        <div class="col-6">
                                            <p class="m-0"><label>Date, Time {{ $high_field_response['date_time'] }}</label></p>
                                            <input type="text" name="high_field_response[date_time]"
                                                   class="w-100 form-control"
                                                   value="{{ $high_field_response['date_time'] ?? "" }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection
