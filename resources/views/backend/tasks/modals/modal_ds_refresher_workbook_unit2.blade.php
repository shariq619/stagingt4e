<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .content {
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .bgStrip {
            background: #919191;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            padding: 6px 0px 6px 10px;
        }

        .form-group {
            background: #f7f6f6;
            border: solid 1px #777;
            border-radius: 5px;
            padding: 15px;
            margin-top: 7px;
            margin-bottom: 7px;
        }

        .inputField {
            border: solid 1px #777777 !important;
            border-radius: 5px;
            resize: none;
            background-color: #fff !important;
            font-size: 14px;
            padding: 5px 10px;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    @php
        $radioImgSimplePath = public_path('images/blacklogo.png');
        $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
        $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
    @endphp
    <div class="formWrapper">
        <div style="display: block;clear: both;overflow: overlay;padding-bottom: 15px;">
            <div class="col-6" style="width:47%;float:left;margin-right:5px;">
                @php
                    $radioImgSimplePath = public_path('images/blacklogo.png');
                    $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
                    $radioImgSimpleSrc =
                        'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
                @endphp
                <img src="{{ $radioImgSimpleSrc }}" class="img-fluid" alt="">
            </div>
            <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                <div class="companyInfo" style="text-align:right;">
                    <p style="margin:0;"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="bgStrip">Learner Details</div>
            <div class="col-12">
                <div class="form-group">
                    <label>Name<span>*</span></label>
                    <div class="inputField">{{ $formData['data']['learner_name'] }}</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                    <div class="form-group">
                        <label>training_provider<span>*</span></label>
                        <div class="inputField">{{ $formData['data']['training_provider'] }}</div>
                    </div>
                </div>
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Course Start Date</label>
                        <div class="inputField">{{ $formData['data']['info_course_start_date'] }}</div>
                    </div>
                </div>
            </div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Course Start Date</label>
                        <div class="inputField">{{ $formData['data']['info_course_end_date'] }}</div>
                    </div>
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">Knowledge questions</div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO1 Know the implications of physical
                interventions and their use</div>
            <div class="form-group textarea">
                <div>
                    <label>AC1.1 State the legal implications of using physical intervention</label>
                    <p>Using physical intervention carries important legal considerations that must be
                        understood to ensure actions remain within the bounds of the law. Failure to comply
                        with legal standards can result in serious consequences for all
                        parties involved.</p>
                    <label>Question 1:</label>
                    <p>State the legal implications of using physical intervention.</p>
                    </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q1. State the legal implications of using physical intervention'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.2 State the professional implications of using physical intervention</label>
                    <p>Using physical intervention in a professional setting can have significant
                        consequences for both individuals and
                        organisations. It is important to understand how such actions can affect one’s
                        career, reputation and compliance
                        with industry standards.</p>
                    <label>Question 2:</label> Identify <label>FIVE</label>
                    professional implications of using physical intervention.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q2. Identify FIVE professional implications of using physical intervention'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q2. Identify FIVE professional implications of using physical intervention'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q2. Identify FIVE professional implications of using physical intervention'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q2. Identify FIVE professional implications of using physical intervention'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q2. Identify FIVE professional implications of using physical intervention'][4] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC1.3 Identify positive alternatives to physical intervention</label>
                    <p>In situations where conflict or aggression arises, it is essential to consider
                        alternatives to physical intervention that
                        can help de-escalate tensions and resolve issues peacefully.</p>
                    <label>Question 3:</label>
                    <p>Identify positive alternatives to physical intervention.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q3. Identify positive alternatives to physical intervention'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC1.4 Identify the differences between defensive physical skills and physical
                        interventions</label>
                    <p>There is a distinction between defensive physical skills and physical interventions,
                        as a door supervisor it is important that you are able to identify the differences.
                    </p>
                    <label>Question 4:</label>
                    <p>Identify the <strong>TWO</strong> key differences between defensive physical skills
                        and physical interventions.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q4. Identify the TWO key differences between defensive physical skills and physical interventions'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q4. Identify the TWO key differences between defensive physical skills and physical interventions'][1] }}
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO2 Know the risks associated with using physical
                intervention</div>
            <div class="form-group textarea">
                <div>
                    <label>AC2.1 Identify the risk factors involved with the use of physical intervention</label>
                    <p>When using physical intervention, there are various risk factors that can impact the safety and
                        well-being of both
                        the individual being restrained and the person applying the intervention. Understanding these
                        risks is crucial for
                        minimising harm.</p>
                    <label>Question 5:</label>
                    <p>Identify the risk factors involved with the use of physical intervention. </p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q5. Identify the risk factors involved with the use of physical intervention'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label><strong>AC2.2 Recognise the signs and symptoms associated with acute behavioural disturbance
                            (ABD)
                            and psychosis</strong></label>
                    <p>When working as a door supervisor, it is crucial to understand and identify certain medical and
                        psychological
                        conditions that may affect individuals’ behaviour. Being able to recognise these conditions can
                        help ensure the
                        safety of everyone involved.</p>
                    <label>Question 6:</label>
                    <p>Describe the signs and symptoms associated with <strong>acute behavioural disturbance
                            (ABD)</strong> and psychosis. </p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label><strong>AC2.4 State the specific risks associated with prolonged physical
                            interventions</strong></label>
                    <p>Prolonged physical interventions carry significant risks for both the individual and the person
                        applying the
                        intervention.</p>
                    <label>Question 7:</label>
                    <p>State the specific risks associated with prolonged physical interventions.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q7. State the specific risks associated with prolonged physical interventions'] }}
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO3 Know how to reduce the risks associated with
                physical intervention</div>
            <div class="form-group textarea">
                <div>
                    <label><strong>AC3.1 State the specific risks of dealing with physical intervention incidents on the
                            ground</strong></label>
                    <p>When physical interventions occur on the ground, they can present additional hazards that
                        increase the risk of
                        harm to both the individual and the door supervisor involved. Understanding these risks is
                        essential for ensuring
                        safety during such situations.</p>
                    <label>Question 8:</label>
                    <p>State the specific risks of dealing with physical intervention incidents on the ground.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q8. State the specific risks of dealing with physical intervention incidents on the ground'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>{{ __('AC3.3 Identify ways of reducing the risk of harm during physical interventions') }}</label>
                    <p>Minimising harm during physical interventions is a critical part of maintaining safety for
                        everyone involved. By
                        using appropriate techniques and strategies, the risks associated with these situations can be
                        significantly reduced.</p>
                    <label>{{ __('Question 9:') }}</label> Identify <label>{{ __('THREE') }}</label>
                    ways of reducing the risk of harm during physical interventions.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q9. ways of reducing the risk of harm during physical interventions'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q9. ways of reducing the risk of harm during physical interventions'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q9. ways of reducing the risk of harm during physical interventions'][2] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label><strong>AC3.4 State how to manage and monitor a person’s safety during physical
                            intervention</strong></label>
                    <p>During a physical intervention, it is crucial to ensure the safety of the individual involved.
                        Proper management
                        and continuous monitoring are key to preventing harm and minimising risk throughout the process.
                    </p>
                    <label>Question 10:</label>
                    <p>State how to manage and monitor a person’s safety during physical intervention.</p>
                    <p>State the specific risks of dealing with physical intervention incidents on the ground.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q10. State how to manage and monitor a persons safety during physical intervention'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC3.6 State the responsibilities of all involved during a physical intervention</label>
                    <p>In any physical intervention, it is important that everyone involved understands their specific
                        roles and
                        responsibilities to ensure the safety and well-being of all parties. Clear communication and
                        coordination are
                        essential for a successful outcome.</p>
                    <label>Question 11:</label> Identify <label>FIVE</label>
                    responsibilities of all involved during a physical intervention.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q11. Identify FIVE responsibilities of all involved during a physical intervention'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q11. Identify FIVE responsibilities of all involved during a physical intervention'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q11. Identify FIVE responsibilities of all involved during a physical intervention'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q11. Identify FIVE responsibilities of all involved during a physical intervention'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q11. Identify FIVE responsibilities of all involved during a physical intervention'][4] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC 3.7 State the responsibilities immediately following a physical intervention</label>
                    <p>After a physical intervention, it is essential to follow specific procedures to ensure the safety
                        and well-being of
                        everyone involved, as well as to meet legal and professional requirements.</p>
                    <label>Question 12:</label> Identify <label>SIX</label>
                    responsibilities immediately following a physical intervention.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong>
                    {{ $formData['data']['Q12. Identify SIX responsibilities immediately following a physical intervention'][5] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label><strong>AC 3.8 State why it is important to maintain physical intervention knowledge and
                            skills</strong></label>
                    <p>Keeping physical intervention knowledge and skills up to date is essential for ensuring safe and
                        effective actions
                        while meeting legal and professional standards.</p>
                    <label>Question 13:</label>
                    <p>State why it is important to maintain physical intervention knowledge and skills.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q13. State why it is important to maintain physical intervention knowledge and skills'] }}
                </div>
            </div>

            <div class="learnerDeclaration" style="margin-top:40px;">

                <div class="form-group" style="margin-top:40px;">
                    <label>First Name<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['first_name'] }}
                    </div>
                    <label>Last Name<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['last_name'] }}
                    </div>
                    <label>Date, Time Assessment Completed<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['assessment_date'] }}
                    </div>
                    <label>Signature<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        <img src="{{ $signatureData }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
