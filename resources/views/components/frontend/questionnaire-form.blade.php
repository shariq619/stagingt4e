<div class="position-relative">
    <div class="progress-wrapper">
        <div id="progressBarFill"></div>
    </div>
    <ul id="progressbar">
        <li class="active" data-step="1"></li>
        <li data-step="2"></li>
        <li data-step="3"></li>
        <li data-step="4"></li>
        <li data-step="5"></li>
        <li data-step="6"></li>
        <li data-step="7"></li>
    </ul>
    <!-- Add this new element for question counter -->
    <div id="questionCounter" class="text-center mb-3">Question 1 out of 6</div>

    <div class="questionnaireForm" id="multiStepForm">
        <form action="{{ route('questionnaire.store') }}" method="POST" id="questionnaireSubmit">
            @csrf
            <div class="step active">
                <div class="form-group formBorderBottom">
                    <label>{{ __('How comfortable are you with face-to-face interaction in challenging situations?') }}
                        <i class="fa-solid fa-asterisk text-danger"></i> </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_1" data-result="A"
                                   value="A. Very comfortable">
                            {{ __('A. Very comfortable') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_1"
                                   data-result="B" value="B. Somewhat comfortable">
                            {{ __('B. Somewhat comfortable') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_1"
                                   data-result="C" value="C. I prefer minimal interaction">
                            {{ __('C. I prefer minimal interaction') }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="form-group formBorderBottom">
                    <label>{{ __('Which working environment appeals to you more?') }} <i
                            class="fa-solid fa-asterisk text-danger"></i> </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_2"
                                   data-result="A" value="A. Busy venues like clubs, events, or bars">
                            {{ __('A. Busy venues like clubs, events, or bars') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_2"
                                   data-result="B" value="B. Quiet control rooms with cameras and monitors">
                            {{ __('B. Quiet control rooms with cameras and monitors') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_2" data-result="C"
                                   value="C. A mix of both">
                            {{ __('C. A mix of both') }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="prev btn">Previous</button>
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="form-group formBorderBottom">
                    <label>{{ __('How do you handle physical activity or long periods of standing?') }} <i
                            class="fa-solid fa-asterisk text-danger"></i> </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_3"
                                   data-result="A" value="A. I’m physically active and don’t mind standing">
                            {{ __('A. I’m physically active and don’t mind standing') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_3"
                                   data-result="B" value="B. I prefer sitting or low-activity roles">
                            {{ __('B. I prefer sitting or low-activity roles') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_3"
                                   data-result="C" value="C. I can manage both if needed">
                            {{ __('C. I can manage both if needed') }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="prev btn">Previous</button>
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="form-group formBorderBottom">
                    <label>{{ __('Are you interested in conflict management and maintaining public order?') }} <i
                            class="fa-solid fa-asterisk text-danger"></i> </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_4"
                                   data-result="A" value="A. Yes, I’m confident in handling conflict">
                            {{ __('A. Yes, I’m confident in handling conflict') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_4"
                                   data-result="B" value="B. Only if it’s necessary">
                            {{ __('B. Only if it’s necessary') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_4"
                                   data-result="C" value="C. I prefer observing and reporting instead">
                            {{ __('C. I prefer observing and reporting instead') }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="prev btn">Previous</button>
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="form-group formBorderBottom">
                    <label>{{ __('How tech-savvy are you?') }} <i class="fa-solid fa-asterisk text-danger"></i>
                    </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_5"
                                   data-result="A" value="A. Basic tech knowledge is enough for me">
                            {{ __('A. Basic tech knowledge is enough for me') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_5"
                                   data-result="B" value="B. I’m comfortable with technology and systems">
                            {{ __('B. I’m comfortable with technology and systems') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_5"
                                   data-result="C" value="C. I enjoy using technology and learning new systems">
                            {{ __('C. I enjoy using technology and learning new systems') }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="prev btn">Previous</button>
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="form-group formBorderBottom">
                    <label>{{ __('What is your ideal shift pattern?') }} <i
                            class="fa-solid fa-asterisk text-danger"></i>
                    </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_6"
                                   data-result="A" value="A. What is your ideal shift pattern?">
                            {{ __('A. What is your ideal shift pattern?') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_6"
                                   data-result="B" value="B. Rotational or fixed shifts in a secure control room">
                            {{ __('B. Rotational or fixed shifts in a secure control room') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="question_6"
                                   data-result="C" value="C. Flexible as long as it's safe">
                            {{ __("C. Flexible as long as it's safe") }}
                        </label>
                    </div>
                </div>
                <div class="error-message-radio alert alert-danger" style="display: none;"></div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="prev btn">Previous</button>
                    <button type="button" class="next btn">Next</button>
                </div>
            </div>
            <div class="step">
                <div class="row lastStep">
                    <div class="col-12 inputCol">
                        <div class="form-group">
                            {{-- <label>{{ __('Name') }} <i class="fa-solid fa-asterisk text-danger"></i></label> --}}
                            <input type="text" name="name" class="form-control" placeholder="Name">
                            <div class="error-message alert alert-danger" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 inputCol">
                        <div class="form-group">
                            {{-- <label>{{ __('Email') }} <i class="fa-solid fa-asterisk text-danger"></i></label> --}}
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="error-message alert alert-danger" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 inputCol">
                        <div class="form-group">
                            {{-- <label>{{ __('Phone') }} <i class="fa-solid fa-asterisk text-danger"></i></label> --}}
                            <input type="tel" name="phone" class="form-control" placeholder="Phone">
                            <div class="error-message alert alert-danger" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="col-12 btnCol">
                        <div class="recaptcha-form" id="recaptcha-form-4">
                            @if(app()->isProduction())
                                {!! NoCaptcha::display() !!}
                            @endif
                        </div>
                        <div id="recaptchaError"></div>

                        <br>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn">Reveal My Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
{{--        @if(app()->isProduction())--}}
{{--            {!! NoCaptcha::renderJs() !!}--}}
{{--        @endif--}}
    </div>
</div>
