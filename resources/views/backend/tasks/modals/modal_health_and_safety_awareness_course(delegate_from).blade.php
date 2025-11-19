<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .bgStrip {
            background: #00386b;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            margin-bottom: 10px;
            padding: 8px 0px 8px 10px;
        }

        .form-group {
            background: #f7f6f6;
            border: solid 1px #777;
            border-radius: 5px;
            padding: 8px;
            margin-top: 7px;
            margin-bottom: 7px;
        }

        .inputField {
            font-size: 14px;
        }

        .inputFieldBg {
            padding: 5px 10px;
            border: solid 1px #777777 !important;
            border-radius: 5px;
            resize: none;
            background-color: #fff !important;
        }

        label {
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
    </style>
</head>

<body>
<div class="formWrapper">


    @php
        $logoImgPath = public_path('images/CITB-logo.jpg');
        $logoImg = base64_encode(file_get_contents($logoImgPath));
        $logoImgSrc = 'data:' . mime_content_type($logoImgPath) . ';base64,' . $logoImg;
    @endphp
    <div class="col-12" style="width:100%;text-align:right;margin-bottom:10px;">
        <img src="{{ $logoImgSrc }}" style="height:65px;object-fit:cover;">
    </div>


    <div class="bgStrip text-center w-100" style="text-align: center"><u>Site Safety Plus Delegate Information Form</u>
    </div>
    <div style="display: flex;margin-bottom: 10px;width:100%;">
        <div class="col-6" style="width:50%;float:left;">
            <label>Training Provider No</label>
            <div class="form-group" style="margin-right:5px;">
                <div class="inputField">22643</div>
            </div>
        </div>
        <div class="col-6" style="width:50%;float:left;">
            <label>Training Provider Name</label>
            <div class="form-group" style="margin-left:5px;">
                <div class="inputField">Training4Employment</div>
            </div>
        </div>
    </div>
    <div style="display: flex;margin-bottom: 10px;width:100%;">
        <div class="col-6" style="width:100%;">
            <label>Course Type: Health and Safety Awareness Course (HSA)</label>
            <div class="form-group">
                <div class="inputField">Course Type: Health and Safety Awareness Course (HSA)</div>
            </div>
        </div>
    </div>


    <br><br>

    <div class="bgStrip text-center w-100"><u>Section A: Delegate Details</u> <small>(Please complete all fields
            where information is known.)</small></div>

    <div style="display: flex;margin-bottom: 10px;width:100%;clear:both;">
        <div class="col-6" style="width:33.333%;float:left;">
            <label>CITB registration No</label>
            <div class="form-group">
                <div class="inputField">{{ $formData['data']['registration'] }}</div>
            </div>
        </div>
        <div class="col-6" style="width:33.333%;float:left;">
            <label>Title</label>
            <div class="form-group" style="margin-right:10px;margin-left:10px;">
                <div class="inputField">{{ $formData['data']['title'] }}</div>
            </div>
        </div>
        <div class="col-6" style="width:33.333%;float:left;">
            <label>DOB</label>
            <div class="form-group">
                <div class="inputField">{{ $formData['data']['dob'] }}</div>
            </div>
        </div>
    </div>

    <div style="display: flex;margin-bottom: 10px;width:100%;clear:both;">
        <div class="col-6" style="width:50%;float:left;">
            <label>Forename(s)</label>
            <div class="form-group" style="margin-right:5px;">
                <div class="inputField">{{ $formData['data']['Forename'] }}</div>
            </div>
        </div>
        <div class="col-6" style="width:50%;float:left;">
            <label>Surname (family name)</label>
            <div class="form-group" style="margin-left:5px;">
                <div class="inputField">{{ $formData['data']['surname'] }}</div>
            </div>
        </div>
    </div>

    <div style="display: flex;margin-bottom: 10px;width:100%;clear:both;">
        <div class="col-6" style="width:100%;">
            <label>Home Address</label>
            <div class="form-group">
                <div class="inputField">{{ $formData['data']['home_address'] }}</div>
            </div>
        </div>
    </div>

    <div style="display: flex;margin-bottom: 10px;width:100%;clear:both;">
        <div class="col-6" style="width:50%;float:left;">
            <label>Postcode</label>
            <div class="form-group" style="margin-right:5px;">
                <div class="inputField">{{ $formData['data']['postcode'] }}</div>
            </div>
        </div>
        <div class="col-6" style="width:50%;float:left;">
            <label>Telephone No (mobile)</label>
            <div class="form-group" style="margin-left:5px;">
                <div class="inputField">{{ $formData['data']['telephone'] }}</div>
            </div>
        </div>
    </div>

    <div style="display: flex;margin-bottom: 10px;width:100%;clear:both;">
        <div class="col-6" style="width:50%;float:left;">
            <label>National Insurance No</label>
            <div class="form-group" style="margin-right:5px;">
                <div class="inputField">{{ $formData['data']['national_insurance'] }}</div>
            </div>
        </div>
        <div class="col-6" style="width:50%;float:left;">
            <label>Email Address</label>
            <div class="form-group" style="margin-left:5px;">
                <div class="inputField">{{ $formData['data']['email_address'] }}</div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 10px;">
        <h4 style="font-size:22px;font-weight:700;">Delegate Declaration: <span
                style="font-size: 15px;font-weight:500;">(Must be read and
                    signed by the delegate) Signing this form confirms that you have
                    successfully booked onto a
                    Site Safety Plus Course with your chosen training provider. Your certificate will be
                    produced with the details provided on this form. If you wish to
                    change your name please enclose copies of your legal name change e.g. birth
                    certificate, divorce certificate, deed poll name change certificate.</span></h4>


        <br><br><br><br><br><br><br><br><br>

        <h4 style="font-size:22px;font-weight:700;">Data Protection Statement: <span
                style="font-size: 15px;font-weight:500;">The
                    information you provide to us will be used for administering the Site Safety Plus
                    Scheme and for
                    purposes connected with our role as an Industrial Training Board in accordance with
                    the Industrial Training Act 1982.</span></h4>
        <p>Your data will be held securely and treated confidentially and will not be disclosed to
            external parties other than as required for the purposes
            described above, which may include sharing your information on a construction training
            register as well as with employers, awarding organisations
            or training providers. </p>
        <p>For information explaining your legal rights and how we use your information, please view
            our Privacy Notice online at <a
                href="https://www.citb.co.uk/utility-links/privacy-policy-cookies/">www.citb.co.uk/privacy.</a>
        </p>
    </div>

    <div style="margin-bottom: 20px;">
        <div class="form-group">
            <label>Signature<span>*</span></label>
            <div class="inputField" style="margin-bottom:5px;">
                <img src="{{ $signatureData }}" alt="">
            </div>
        </div>
    </div>

    <div style="margin-bottom: 10px;">
        <div class="bgStrip"><u>Section B: Employer Details for Grant Claiming Purposes</u></div>
        <p>Please provide the delegate’s employer's seven-digit CITB Levy & Grant registration number and
            employer's name if the employer wishes to claim
            grant. Failure to do so will result in Grant being unclaimed. Employers should call the Levy &
            Grant Customer Services Team to resolve this.
            Please note: Levy numbers cannot be added after this form has been submitted to Site Safety
            Plus.
        </p>
    </div>

    <div style="display: flex;margin-bottom: 10px;">
        <div class="col-6" style="width:50%;float:left;margin-right:5px;">
            <label>Employer Name</label>
            @if(isset($formData['data']['employer_name']))
                <div class="form-group">
                    <div class="inputField">{{ $formData['data']['employer_name'] }}</div>
                </div>
            @else
                <p></p>
            @endif
        </div>
        <div class="col-6" style="width:50%;float:left;margin-left:5px;">
            <label>Levy Number</label>
            @if(isset($formData['data']['levy_number']))
                <div class="form-group">
                    <div class="inputField">{{ $formData['data']['levy_number'] }}</div>
                </div>
            @else
                <p></p>
            @endif
        </div>
    </div>
</div>
</body>

</html>
