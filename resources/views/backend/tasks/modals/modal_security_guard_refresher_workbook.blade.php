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
                        <label>training provider<span>*</span></label>
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
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO1 Know how to conduct effective search
                procedures</div>
            <div class="form-group">
                <div>
                    <label>AC1.1 State the different type of searches carried out by a security officer</label>
                    <p>As a security officer you will be required to carry out different types of searches.</p>
                    <label>Question 1:</label> State the <label>THREE</label>
                    different types of searches that are carried out by a security officer.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q1. State the THREE different types of searches that are carried out by a security officer'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q1. State the THREE different types of searches that are carried out by a security officer'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q1. State the THREE different types of searches that are carried out by a security officer'][2] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.2 Identify a security officer’s right to search</label>
                    <p>Security officers have specific powers related to their duties, but your right to search
                        individuals is limited.</p>
                    <label>Question 2a:</label> State the <label>THREE</label>
                    occasions when a security officer has the right to search.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q2a. Identify THREE occasions when a security officer has the right to search'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q2a. Identify THREE occasions when a security officer has the right to search'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q2a. Identify THREE occasions when a security officer has the right to search'][2] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <p><strong>Question 2b</strong></p>
                    <p>Explain the search process required when carrying out:</p>
                    <ul>
                        <li>single sex searches</li>
                        <li>transgender individuals’ searches</li>
                    </ul>
                </div>
                <p><strong>Single sex</strong></p>
                <div class="inputField" style="margin-bottom:5px;">{{ $formData['data']['Q2b. Single sex'] }}</div>
                <p><strong>Transgender individuals</strong></p>
                <div class="inputField" style="margin-bottom:5px;">
                    {{ $formData['data']['Q2b. Transgender individuals'] }}</div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.3 Identify the different types of searching equipment</label>
                    <p>As a security officer, you may be required to search staff, visitors or customers at
                        a site before allowing entry.</p>
                    <label>Question 3:</label> Identify <label>SEVEN</label>
                    different types of equipment that can be used to assist with searches.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][5] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>7. </strong>
                    {{ $formData['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'][6] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.4 Recognise possible hazards when conducting a search</label>
                    <p>Security officers may encounter various potential hazards when conducting searches.</p>
                    <label>Question 4:</label> Identify <label>SEVEN</label>
                    hazards you may encounter when conducting searches.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][5] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>7. </strong>
                    {{ $formData['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'][6] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.5 State the precautions to take when carrying out a search</label>
                    <p>It is important that as a security officer you take care of yourself when conducting
                        searches.</p>
                    <label>Question 5:</label> State <label>FIVE</label>
                    precautions that you can take when carrying out a search.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q5. State FIVE precautions that you can take when carrying out a search'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q5. State FIVE precautions that you can take when carrying out a search'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q5. State FIVE precautions that you can take when carrying out a search'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q5. State FIVE precautions that you can take when carrying out a search'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q5. State FIVE precautions that you can take when carrying out a search'][4] }}
                </div>
            </div>
            <div class="form-group textarea">
                <label>AC1.6 State the actions to take if an incident or an accident occurs</label>
                <p>From time to time, incidents or accidents may occur; it is important to always follow
                    the venue’s policy or
                    assignment instructions.</p>
                <label>Question 6:</label>
                <p>State the actions to take if an incident or an accident occurs.</p>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q6. State the actions to take if an incident or an accident occurs'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.8 State typical areas of vehicles to be searched</label>
                    <p>Some sites require vehicles to be searched, including:</p>
                    <ul>
                        <li>cycles</li>
                        <li>motorcycles</li>
                        <li>cars</li>
                        <li>vans</li>
                        <li>heavy goods vehicles</li>
                    </ul>
                    <label>Question 7:</label>
                    <p>State typical areas of vehicles to be searched.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <p><strong>Cycles</strong></p>
                    {{ $formData['data']['Q7. Cycles'] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <p><strong>Motorcycles</strong></p>
                    {{ $formData['data']['Q7. Motorcycles'] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <p><strong>Cars</strong></p>
                    {{ $formData['data']['Q7. Cars'] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <p><strong>Vans</strong></p>
                    {{ $formData['data']['Q7. Vans'] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <p><strong>Heavy goods vehicles</strong></p>
                    {{ $formData['data']['Q7. Heavy goods vehicles'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.9 Identify the reasons for carrying out a premises search</label>
                    <p>As well as searching people, you may be required to carry out a premises search</p>
                    <label>Question 8:</label> Identify <label>FIVE</label>
                    reasons for carrying out a premises search.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q8. Identify FIVE reasons for carrying out a premises search'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q8. Identify FIVE reasons for carrying out a premises search'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q8. Identify FIVE reasons for carrying out a premises search'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q8. Identify FIVE reasons for carrying out a premises search'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q8. Identify FIVE reasons for carrying out a premises search'][4] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.10 Recognise actions to take in the event of a search refusal</label>
                    <p>Individuals may refuse to be searched or to have their belongings searched. Any
                        refusals should be handled
                        according to the venue’s policy or assignment instructions.</p>
                    <label>Question 9:</label> State <label>FOUR</label>
                    actions to take in the event of a search refusal.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q9. State FOUR actions to take in the event of a search refusal'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q9. State FOUR actions to take in the event of a search refusal'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q9. State FOUR actions to take in the event of a search refusal'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q9. State FOUR actions to take in the event of a search refusal'][3] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.11 Identify reasons for completing search documentation</label>
                    <p>Venues that require the security team to search people or their property must provide
                        a suitable method of
                        recording searches.</p>
                    <label>Question 10:</label> Identify <label>FOUR</label>
                    reasons for completing search documentation.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q10. Identify FOUR reasons for completing search documentation'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q10. Identify FOUR reasons for completing search documentation'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q10. Identify FOUR reasons for completing search documentation'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q10. Identify FOUR reasons for completing search documentation'][3] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC1.12 Identify actions to take if a prohibited or restricted item is found during a
                        search</label>
                    <p>Any stolen, illegal or unauthorised items found during a search must be delt with
                        correctly. </p>
                    <label>Question 11:</label> Identify <label>SIX</label>
                    actions to take if a prohibited or restricted item is found during a search.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'][5] }}
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO2 Understand how to keep vulnerable people
                safe</div>
            <div class="form-group textarea">
                <div>
                    <label>AC2.1 Recognise duty of care with regard to vulnerable people</label>
                    <p>As a security officer you have a duty of care to vulnerable people that enter the
                        premises. </p>
                    <label>Question 12a:</label>
                    <p>Explain what is meant by duty of care.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q2a. Explain what is meant by duty of care'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>Question 12b:</label>
                    <p>Explain why it is important to have a duty of care for everyone, even if they do not
                        appear to be vulnerable. </p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q2b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC 2.2 Identify factors that could make someone vulnerable</label>
                    <p>As a security officer, you need to be aware of individuals who may be considered
                        vulnerable due to various factors.</p>
                    <label>Question 13a:</label> Identify <label>FIVE</label>
                    factors that could make someone vulnerable or more at risk than others.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'][4] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>Question 13b:</label> Explain why the
                    <label>FIVE</label>
                    factors you identified in question 13a could make someone vulnerable.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'][4] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC2.3 Identify actions that the security operative should take towards vulnerable
                        individuals</label>
                    <p>In your professional judgement, if a person appears to be vulnerable, you need to
                        consider what help they might
                        need. </p>
                    <label>Question 14:</label> Identify <label>FIVE</label>
                    actions that you should take towards vulnerable individuals.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'][4] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC2.4 Identify behaviours that may be exhibited by sexual predators</label>
                    <p>As a security officer, you must be able to identify behaviours that may be exhibited
                        by sexual predators. </p>
                    <label>Question 15:</label> Identify <label>FOUR</label>
                    behaviours that may be exhibited by sexual predators.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'][3] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC2.5 Identify indicators of abuse</label>
                    <p>There are several identifying indicators of abuse that a security officer can look
                        out for. </p>
                    <label>Question 16:</label> Identify <label>FOUR</label>
                    indicators of abuse.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q16. Identify FOUR indicators of abuse'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q16. Identify FOUR indicators of abuse'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q16. Identify FOUR indicators of abuse'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q16. Identify FOUR indicators of abuse'][3] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC2.6 State how to deal with allegations of sexual assault</label>
                    <p>Security officers regularly wear uniforms. Some people find this reassuring and may
                        choose to tell the operative
                        about the abuse they have been subjected to. This is called disclosure. </p>
                    <label>Question 17:</label>
                    <p>State how to deal with allegations of sexual assault.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q17. State how to deal with allegations of sexual assault'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC2.7 State how to deal with anti-social behaviour</label>
                    <p>As a security officer, you should always maintain a positive and productive attitude
                        when dealing with members
                        of the public who are demonstrating anti-social behaviour.</p>
                    <label>Question 18:</label>
                    <p>State how to deal with anti-social behaviour.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q18. State how to deal with anti-social behaviour'] }}
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">LO3 Understand terror threats and the role of
                the security operative in the event of a threat</div>
            <div class="form-group">
                <div>
                    <label>AC3.1 Identify the different threat levels</label>
                    <p>Threat levels are designed to give a broad indication of the likelihood of a
                        terrorist attack. </p>
                    <label>Question 19:</label> Identify the
                    <label>FIVE</label>
                    different threat levels.
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q19. Identify the FIVE different threat levels'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q19. Identify the FIVE different threat levels'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q19. Identify the FIVE different threat levels'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q19. Identify the FIVE different threat levels'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q19. Identify the FIVE different threat levels'][4] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC3.2 Recognise the common terror attack methods</label>
                    <p>It is important to be aware of the common methods used in terror attacks.</p>
                    <label>Question 20:</label>
                    <p>What are the most common terror attack methods?</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q20. What are the most common terror attack methods?'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC3.3 Recognise the actions to take in the event of a terror threat</label>
                    <p>The role of a security officer during a terror attack will be outlined in the venue or site’s
                        policies and procedures.</p>
                    <label>Question 21:</label>
                    <p>Explain the actions you should take in the event of a terror threat at the venue or site.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q21. Explain the actions you should take in the event of a terror threat at the venue or site'] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC3.4 Identify the procedures for dealing with suspicious items</label>
                    <p>As a security officer, you need to be aware of suspicious packages and the procedures to follow
                        if one is identified.</p>
                    <label>Question 22:</label>
                    <p>Identify the procedures for dealing with suspicious items.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q22. Identify the procedures for dealing with suspicious items'] }}
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label>AC3.5 Identify behaviours that could indicate suspicious activity</label>
                    <p>Suspicious activity is any observed behaviour that could indicate terrorism or terrorism-related
                        crime.</p>
                    <label>Question 23:</label>
                    <label>Identify <strong>SIX </strong> behaviours that could indicate suspicious activity.</label>
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong>
                    {{ $formData['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'][5] }}
                </div>
            </div>
            <div class="form-group textarea">
                <div>
                    <label>AC3.6 Identify how to respond to suspicious behaviour</label>
                    <p>As a security officer, you shouldn’t be afraid of responding when you suspect suspicious
                        behaviour.</p>
                    <label>Question 24:</label>
                    <p>Identify how you should respond to suspicious behaviour.</p>
                </div>
                <div class="inputField" style="margin-bottom:5px;height:70px;">
                    {{ $formData['data']['Q24. Identify how you should respond to suspicious behaviour'] }}
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
