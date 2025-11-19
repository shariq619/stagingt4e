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
    <div class="formWrapper">
        @php
            $radioImgSimplePath = public_path('images/header-pdf.png');
            $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
            $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
        @endphp
        {{-- <div>
            <img src="{{ $radioImgSimpleSrc }}" style="width:100%;" alt="">
        </div> --}}
        <h1>CCTV Operator, Public Surveillance Activity Sheet</h1>
        <div class="row">
            <div class="bgStrip">Learner Details</div>
            <div class="col-12">
                <div class="form-group">
                    <label>First Name<span>*</span></label>
                    <div class="inputField">{{ $formData['data']['first_name'] }}</div>
                </div>
                <div class="form-group">
                    <label>Last Name<span>*</span></label>
                    <div class="inputField">{{ $formData['data']['last_name'] }}</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                    <div class="form-group">
                        <label>Email Address<span>*</span></label>
                        <div class="inputField">{{ $formData['data']['email'] }}</div>
                    </div>
                </div>
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Course Start Date</label>
                        <div class="inputField">{{ $formData['data']['course_start_date'] }}</div>
                    </div>
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">Assessment</div>
            <div class="form-group">
                <label>Q1. What is the purpose of security industry?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q1. What is the purpose of security industry?'] }}</div>
            </div>
            <div class="form-group">
                <label>Q2. List 3 ways in which security is provided<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q2. List 3 ways in which security is provided'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q2. List 3 ways in which security is provided'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q2. List 3 ways in which security is provided'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q3. Describe the 3 main aims of the SIA<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q3. Describe the 3 main aims of the SIA'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q3. Describe the 3 main aims of the SIA'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q3. Describe the 3 main aims of the SIA'][2] }}
                </div>
            </div><br><br><br><br>
            <div class="form-group">
                <label>Q4. List any 5 examples of community safety initiatives<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q4. List any 5 examples of community safety initiatives'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q4. List any 5 examples of community safety initiatives'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q4. List any 5 examples of community safety initiatives'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q4. List any 5 examples of community safety initiatives'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q4. List any 5 examples of community safety initiatives'][4] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q5. List 3 benefits of using CCTV<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q5. List 3 benefits of using CCTV'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q5. List 3 benefits of using CCTV'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q5. List 3 benefits of using CCTV'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q6. List any 5 qualities that a security operative should have<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q6. List any 5 qualities that a security operative should have'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q6. List any 5 qualities that a security operative should have'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q6. List any 5 qualities that a security operative should have'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q6. List any 5 qualities that a security operative should have'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q6. List any 5 qualities that a security operative should have'][4] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q7. What are the legal implications of using CCTV?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q7. What are the legal implications of using CCTV?'] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q8. Explain what is meant by the term ARREST<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q8. Explain what is meant by the term ARREST'] }}</div>
            </div>
            <div class="form-group">
                <label>Q9. Provide 6 examples of offences for which a security operative can make an
                    arrest<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong>
                    {{ $formData['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'][5] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q10. Explain the procedures a security operative should follow after an
                    arrest<span>*</span></label>
                <div class="inputField">
                    {{ $formData['data']['Q10. Explain the procedures a security operative should follow after an arrest'] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q11. Please describe internal customers.<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q11. Please describe internal customers'] }}</div>
            </div>
            <div class="form-group">
                <label>Q12. List different types of communication.<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q12. List different types of communication'] }}</div>
            </div>
            <div class="form-group">
                <label>Q13. Give 3 examples of good customer care and 3 examples of bad customer
                    care<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q13. Give 3 examples of good customer care and 3 examples of bad customer care'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q13. Give 3 examples of good customer care and 3 examples of bad customer care'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q13. Give 3 examples of good customer care and 3 examples of bad customer care'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q14. What are protected characteristics?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q14. What are protected characteristics?'] }}</div>
            </div>
            <div class="form-group">
                <label>Q15. What are the 3 consideration when forces applied?<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q15. What are the 3 consideration when forces applied?'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q15. What are the 3 consideration when forces applied?'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q15. What are the 3 consideration when forces applied?'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q16. Give 3 reasons why venue might be evacuated<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q16. Give 3 reasons why venue might be evacuated'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q16. Give 3 reasons why venue might be evacuated'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q16. Give 3 reasons why venue might be evacuated'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q17. What are the components of the fire triangle?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q17. What are the components of the fire triangle?'] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q18. What are the priorities that you need to observe during evacuation from a
                    venue?<span>*</span></label>
                <div class="inputField">
                    {{ $formData['data']['Q18. What are the priorities that you need to observe during evacuation from a venue?'] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q19. How many Data protection principles are there?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q19. How many Data protection principles are there?'] }}
                </div>
            </div>
{{--            <div class="form-group">--}}
{{--                <label>Q20. How many Data protection principles are there?<span>*</span></label>--}}
{{--                <div class="inputField">{{ $formData['data']['Q20. How many Data protection principles are there?'] }}--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group">
                <label>Q20. Name 6 different safety signs<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][4] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>6. </strong> {{ $formData['data']['Q21. Name 6 different safety signs'][5] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q21. Classify the fire and give one example of each one<span>*</span></label>
                <div class="inputField">
                    {{ $formData['data']['Q22. Classify the fire and give one example of each one'] }}</div>
            </div>
            <div class="form-group">
                <label>Q22. What are internal fire doors used for?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q23. What are internal fire doors used for?'] }}</div>
            </div>
            <div class="form-group">
                <label>Q23. What is an emergency?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q24. What is an emergency?'] }}</div>
            </div>
            <div class="form-group">
                <label>Q24. What are the 4 aims of first aid?<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q25. What are the 4 aims of first aid?'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q25. What are the 4 aims of first aid?'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q25. What are the 4 aims of first aid?'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong> {{ $formData['data']['Q25. What are the 4 aims of first aid?'][3] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q25. What are the risks of lone working within the private security
                    industry<span>*</span></label>
                <div class="inputField">
                    {{ $formData['data']['Q26. What are the risks of lone working within the private security industry'] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q26. List FIVE examples of workplace hazards<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong> {{ $formData['data']['Q27. List FIVE examples of workplace hazards'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong> {{ $formData['data']['Q27. List FIVE examples of workplace hazards'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong> {{ $formData['data']['Q27. List FIVE examples of workplace hazards'][2] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>4. </strong> {{ $formData['data']['Q27. List FIVE examples of workplace hazards'][3] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>5. </strong> {{ $formData['data']['Q27. List FIVE examples of workplace hazards'][4] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q27. Explain the principles of evacuation and invacuation<span>*</span></label>
                <div class="inputField">
                    {{ $formData['data']['Q28. Explain the principles of evacuation and invacuation'] }}</div>
            </div>
            <div class="form-group">
                <label>Q28. Give 3 examples of child sexual exploitation<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>1. </strong>
                    {{ $formData['data']['Q29. Give 3 examples of child sexual exploitation'][0] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>2. </strong>
                    {{ $formData['data']['Q29. Give 3 examples of child sexual exploitation'][1] }}
                </div>
                <div class="inputField" style="margin-bottom:5px;">
                    <strong>3. </strong>
                    {{ $formData['data']['Q29. Give 3 examples of child sexual exploitation'][2] }}
                </div>
            </div>
            <div class="form-group">
                <label>Q29. What is terrorism?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q30. What is terrorism?'] }}</div>
            </div>
            <div class="form-group">
                <label>Q30. What type of threat level is substational?<span>*</span></label>
                <div class="inputField">{{ $formData['data']['Q31. What type of threat level is substational?'] }}
                </div>
            </div>
            <div class="bgStrip" style="clear: both;margin:10px 0px;">Learner Details</div>
            <div class="form-group">
                <label>First Name<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    {{ $formData['data']['detail_first_name'] }}
                </div>
                <label>Last Name<span>*</span></label>
                <div class="inputField" style="margin-bottom:5px;">
                    {{ $formData['data']['detail_last_name'] }}
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
</body>

</html>
