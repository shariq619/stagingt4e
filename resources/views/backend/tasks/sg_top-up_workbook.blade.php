@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">
            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm" enctype="multipart/form-data"
                style="width:100%;">
                @csrf
                <input type="hidden" name="task_name" value="{{ $task->name }}" />
                <input type="hidden" name="task_id" value="{{ $task->id }}" />
                <input type="hidden" name="course_id" value="{{ $course_id }}" />
                <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                @php
                    $username = auth()->user()->name;
                @endphp

                <h1 class="floatingpdftitle">Security Guard Top-Up Workbook</h1>
                <div class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right" >
                    <div href="{{ asset('resources/SGtop-up-textbook.pdf') }}" class="popup-pdf"><i
                            class="fas fa-file-pdf"></i></div>
                </div>

                <p>Principles of Using Equipment as a Door Supervisor in the Private Security IndustryT/618/6844</p>

                <div class="learnerInformation">
                    <h4 class="bgStrip">Learner Information</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>First Name<span>*</span></label>
                                <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                    value="{{ auth()->user()->name ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>Last Name<span>*</span></label>
                                <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                    value="{{ auth()->user()->last_name ?? '' }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email Address<span>*</span></label>
                                <input type="email" name="data[email_address]" class="form-control"
                                    value="{{ auth()->user()->email ?? '' }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Course Start Date</label>
                                <input type="date" name="data[course_start_date]" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Training Provider </label>
                                <input type="text" name="data[training_provider]" class="form-control"
                                    value="Training4Employment" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Course End Date </label>
                                <input type="date" name="data[course_end_date]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="introduction">
                    <h4 class="bgStrip">Introduction</h4>
                    <p>This online form has been created based on the Security Guard Self-Study (Top-Up) Workbook from
                        Highfield Products.</p>
                    <p>This workbook has been developed to support you in achieving the requirements of the self-study
                        learning outcomes and assessment criteria from the Highfield Level 2 Award for Security Officers in
                        the Private Security Industry (Top Up) Unit 2: Principles of Minimising Personal Risk for Security
                        Officers in the Private Security Industry.</p>
                    <div class="alertNotification">
                        <img src="{{ asset('images/notificationimg.png') }}" class="img-fluid" alt="">
                        <span>This workbook must be completed and submitted to Training4Employment before any further
                            face-to-face training.</span>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <h4 class="bgStrip">Knowledge Questions</h4>
                    <h4 class="bgGray">LO1 Know how to minimise risk to personal safety at work.</h4>
                    <div class="questions">

                        <label><strong>AC1.1 Identify responsibilities for personal safety at work.</strong></label>
                        <p>All employees and employers have basic responsibilities that they must follow to help ensure
                            personal safety is maintained at work.</p>
                        <p><strong>Question 1 a:</strong> Identify <strong>SIX</strong> employee responsibilities for
                            personal safety at work when working as a security officer.</p>
                        <div class="form-group">
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 1 a][]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <p><strong>Question 1 b:</strong> Identify <strong>SEVEN</strong> employer responsibilities.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text" name="data[Question 1 b][]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.2 Identify situations that might compromise personal safety.</label>
                    <p>As a security officer, you should always be aware of situations that could compromise your safety.
                    </p>
                    <div class="form-group">
                        <p><strong>Question 2:</strong> Identify <strong>FOUR</strong> of the most common situations that
                            might compromise your personal safety.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.2 Identify situations that might compromise personal safety.</label>
                    <p>As a security officer, you should always be aware of situations that could compromise your safety.
                    </p>
                    <div class="form-group">
                        <p><strong>Question 2:</strong> Identify <strong>FOUR</strong> of the most common situations that
                            might compromise your personal safety.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 2][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.3 Identify the risks of ignoring personal safety in conflict situations.</label>
                    <p>Whenever you are dealing with conflict situations, there is an increased level of risk and potential
                        for escalation.</p>
                    <div class="form-group">
                        <p><strong>Question 3:</strong> Identify <strong>THREE</strong> risks of ignoring personal safety in
                            conflict situations.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 3][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 3][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 3][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.4 State the personal safety benefits of undertaking dynamic risk assessments.</label>
                    <p>A dynamic risk assessment is a systematic way of assessing the risk of the potential for violence
                        before approaching or responding to a situation.</p>
                    <div class="form-group">
                        <p><strong>Question 4:</strong> State the personal safety benefits of undertaking dynamic risk
                            assessments.</p>
                        <textarea name="data[Question 4]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.5 List ways to minimise risk to personal safety.</label>
                    <p>It is important that you can minimise risks to your personal safety when working as a security
                        officer.</p>
                    <div class="form-group">
                        <p><strong>Question 5:</strong> List <strong>SIX</strong> ways to minimise risk to personal safety.
                        </p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text" name="data[Question 5][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.6 Recognise the different types of personal protective equipment relevant to the role of a
                        security officer.</label>
                    <p>Personal protective equipment (PPE) is used to help protect you from harm when carrying out your job
                        role.</p>
                    <div class="form-group">
                        <p><strong>Question 6 a:</strong> Identify <strong>EIGHT</strong> different types of personal
                            protective equipment that you may wear as a security officer.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">7.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">8.</label>
                            <input type="text" name="data[Question 6 a][]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <p><strong>Question 6 b:</strong> Identify <strong>SIX</strong> different types of personal
                            protective equipment that can be used to help maintain your safety when working as a security
                            officer.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text" name="data[Question 6 b][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.7 State the purpose of using body-worn cameras (BWC).</label>
                    <p>Body-worn cameras (BWC) have many benefits and as such are becoming more popular within the private
                        security industry and well as within law enforcement.</p>
                    <div class="form-group">
                        <p><strong>Question 7:</strong> State the purpose of body-worn cameras.</p>
                        <textarea name="data[Question 7]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.8 Identify strategies that can assist personal safety in conflict situations.</label>
                    <p>There are several problem-solving strategies that may help de-escalate a situation.</p>
                    <div class="form-group">
                        <p><strong>Question 8:</strong> Identify <strong>EIGHT</strong> strategies that can assist personal
                            safety in conflict situations.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">7.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">8.</label>
                            <input type="text" name="data[Question 8][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.9 Describe limits of own responsibility in physical intervention situations.</label>
                    <p>Physical intervention is a non-pain compliant method of escorting an individual to the destination of
                        your choice.</p>
                    <div class="alertNotification notLight">
                        <img src="http://127.0.0.1:8000/images/notificationlight.png" class="img-fluid" alt="">
                        <span><strong>KEY POINT</strong><br> You must be trained in how to correctly apply holds prior to
                            using them.</span>
                    </div>
                    <div class="form-group">
                        <p><strong>Question 9:</strong> Describe the limits of your responsibility in physical intervention
                            situations..</p>
                        <textarea name="data[Question 9]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.10 Identify types of harm that can occur during physical interventions.</label>
                    <p>Any forceful restraint can lead to medical complications.</p>
                    <div class="form-group">
                        <p><strong>Question 10:</strong> Identify <strong>SIX</strong> types of harm that can occur during
                            physical interventions.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text" name="data[Question 10][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.11 Identify types of harm that can occur during physical interventions.</label>
                    <p>Mental alertness is vital while working as a security officer. There are many advantages to ensuring
                        you look after your mental well-being.</p>
                    <div class="form-group">
                        <p><strong>Question 11:</strong> Identify <strong>FIVE</strong> personal advantages of mental
                            alertness at work.</p>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Question 11][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Question 11][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Question 11][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Question 11][]" class="form-control">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Question 11][]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="knowledge_questions mt-5 borderBottom">
                    <label>AC1.12 State the benefits of reflecting on personal safety experiences.</label>
                    <p>Reflection is a useful tool to enable you and your colleagues to learn from past experiences.</p>
                    <div class="form-group">
                        <p><strong>Question 12:</strong> State the benefits of reflecting on personal safety experiences.
                        </p>
                        <textarea name="data[Question 12]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <h4 class="bgGray my-4">LO2 Know what actions to take in relation to global (or critical) incidents.
                    </h4>
                    <label>AC2.1 Know government guidance in relation to global (or critical) incidents.</label>
                    <p>As a security officer, it is important to know what actions you should take and where you can find
                        additional information and guidance when dealing with global or critical incidents.</p>
                    <div class="form-group">
                        <p><strong>Question 13:</strong> Describe the government guidance in relation to global (or
                            critical) incidents.</p>
                        <textarea name="data[Question 13]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <label>Learner' Name</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group requiredRole">
                                <input type="text" name="data[first_name]" class="form-control"
                                    value="{{ auth()->user()->name ?? '' }}" readonly>
                                <small>First Name</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group requiredRole">
                                <input type="text" name="data[last_name]" class="form-control"
                                    value="{{ auth()->user()->last_name ?? '' }}" readonly>
                                <small>Last Name</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Learner Signature<span>*</span></label>
                                <div id="signature-pad" class="signature-pad">
                                    <div id="signature-pad" class="signature-pad">
                                        <div class="signature-pad-body">
                                            <canvas id="signature-canvas"
                                                style="background: rgb(255, 255, 255); border: 2px solid rgba(204, 204, 204, 0.8); margin-bottom: 30px; touch-action: none;"></canvas>
                                        </div>
                                        <div class="signature-pad-footer">
                                            <button type="button" class="btn btn-danger" id="clear-signature">
                                                Clear
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="signature" id="signature-input-paf">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Date, Time</label>
                                <input type="text" name="data[assessment_date]" class="form-control"
                                    value="2024-08-23 17:03" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <button class="btn btn-primary" id="previewButton" data-toggle="modal" data-target="#deletePreviewApp">
                    <i class="fas fa-eye mr-2"></i>
                    {{ __('Save and Preview') }}
                </button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deletePreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleLabel">{{ __('Preview Application') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">
                    <div id="loadingSpinner" style="display: none; text-align: center;">
                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                    </div>
                    <iframe id="pdfPreview" width="100%" height="600"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit
                    </button>
                    <button type="submit" id="modalFormHandler" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Save & Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        div#loadingSpinner {
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            bottom: 0;
            z-index: 9999;
            background: #00000036;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#loadingSpinner i {
            color: #007bff;
        }

        #deletePreviewApp .modal-dialog {
            min-width: 70% !important;
        }

        .alertNotification.notLight {
            border: solid 1px #3e8acc;
            background: #d9edf7;
        }

        .alertNotification.notLight span strong {
            color: #3e8acc;
        }

        .alertNotification.notLight {
            margin-bottom: 25px;
        }

        .borderBottom {
            border-bottom: solid 1px #ccc;
        }

        .bgGray {
            background: #c0c0c0;
            padding: 15px 15px;
            border-radius: 8px;
            border: solid 1px #777;
        }

        .alertNotification {
            width: 70%;
            margin: auto;
            background: #fad2e0;
            height: 100%;
            display: block;
            overflow: overlay;
            border: solid 1px #ff3823;
            border-radius: 5px;
            padding: 5px 20px;
        }

        .alertNotification img {
            float: left;
        }

        .alertNotification img {
            width: 59px;
            margin-right: 14px;
        }

        .alertNotification span {
            margin-top: 8px !important;
            display: block;
        }

        .clear-fix {
            clear: both;
        }

        .imageRow .col-6 {
            text-align: center;
        }

        .imageRow .col-6 img {
            display: block;
            margin: auto;
        }

        .imageRow button.btnImage {
            background: #3b1d8f;
            color: #fff;
            transform: translate(0px, -10px);
        }

        .imageRow button.btnImage i {
            margin-left: 6px;
        }

        .darkBox {
            background: #606060;
            display: inline-block;
            color: #fff;
            padding: 25px 25px;
            border-radius: 7px;
        }

        .darkBox h5 {
            font-size: 29px;
        }

        .sectionBorder>h4.bgHeadLight {
            background: #428bca;
            color: #fff;
            border-radius: 8px;
            padding: 15px 15px;
            font-weight: 600;
        }

        .bgLightTxt {
            background: #d9edf7;
            padding: 15px 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .bgLightTxt p>strong small {
            font-weight: bold !important;
        }

        .formWrapper textarea {
            width: 100%;
            resize: none;
            border-radius: 10px;
            padding: 15px;
        }

        .content-wrapper {
            background: #fff;
        }

        .formWrapper {
            padding: 15px;
            border: solid 1px #cccc;
            border-radius: 10px;
        }

        .formWrapper .headerDetail h1 {
            color: #3b1d8f;
            font-weight: 600;
        }

        .formWrapper h2 {
            font-weight: 600;
        }

        h4.bgStrip {
            background: #3b1d8f;
            color: #fff;
            padding: 15px 15px;
            border-radius: 8px;
        }

        .sectionBorder {
            border: solid 1px #cccc;
            border-radius: 10px;
            padding: 20px;
        }

        .bgBoxGray {
            background: #f7f6f6;
            border: solid 1px #00000070;
            padding: 20px;
            border-radius: 10px;
        }

        .bgBoxGray>label {
            color: #3b1d8f;
        }

        .bgBoxGray>label>span {
            font-weight: 400;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        $(document).ready(function() {
            const canvas = document.getElementById('signature-canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('submitForm').addEventListener('submit', function(event) {
                if (signaturePad.isEmpty()) {
                    event.preventDefault();
                } else {
                    const signatureDataUrl = signaturePad.toDataURL();
                    console.log("Captured Signature:", signatureDataUrl);
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });

            $(document).on('click', '#previewButton', function(e) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;

                    $('.requiredRole input, .requiredRole textarea').each(function() {
                        if ($(this).val().trim() === '') {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            $(this).next('.invalid-feedback').remove(); // Remove existing feedback
                            $(this).after(
                                '<div class="invalid-feedback">This field is required.</div>');
                        } else {
                            $(this).removeClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                        }
                    });

                    $('.validList').each(function() {
                        let groupIsValid = true;

                        $(this).find('input').each(function() {
                            if ($(this).val().trim() === '') {
                                groupIsValid = false;
                                $(this).addClass('is-invalid');
                                $(this).next('.invalid-feedback')
                                    .remove();
                                $(this).after(
                                    '<div class="invalid-feedback">This field is required.</div>'
                                );
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).next('.invalid-feedback').remove();
                            }
                        });

                        if (!groupIsValid) {
                            isValid = false;
                        }
                    });


                    return isValid;
                }

                if (!validateForm('.requiredRole input, .requiredRole textarea', '.validList input')) {
                    $('#deletePreviewApp').modal('hide');
                    return;
                }

                const signatureDataUrl = signaturePad.toDataURL();
                document.getElementById('signature-input-paf').value = signatureDataUrl;

                const form = document.getElementById('submitForm');
                const formData = new FormData(form);
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                $.ajax({
                    method: "POST",
                    url: "{{ route('backend.task.preview') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(data) {
                        if (data.html) {
                            var iframe = document.getElementById('pdfPreview');
                            iframe.contentWindow.document.open();
                            iframe.contentWindow.document.write(data.html);
                            iframe.contentWindow.document.close();
                            $('#pdfPreview').show();
                        }
                        $('#deletePreviewApp').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#modalFormHandler', function() {
                const form = $('#submitForm');
                const url = form.attr('action');
                const token = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData(form[0]);
                const button = $(this);

                button.prop('disabled', true);
                $('#loadingSpinner').show();

                $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(function(response) {
                        // console.log(response.message);
                        button.prop('disabled', false);
                        form[0].reset();
                        $('#deletePreviewApp').modal('hide');
                        $('#loadingSpinner').hide();
                        window.location = "{{ route('backend.learner.dashboard') }}";
                    })
                    .catch(function(err) {
                        $('#loadingSpinner').hide();
                        console.error(err);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
@endpush
