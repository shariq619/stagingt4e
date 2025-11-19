<?php

return [
    'document_upload_form' => [
        'page_title' => 'Document Upload Settings',
        'sections' => [
            'group1' => [
                'type' => 'radio',
                'options' => [
                    'passport' => [
                        'label' => 'Passport'
                    ],
                    'dvlaLicence' => [
                        'Driving licence issued by the Driver and Vehicle Licensing Agency (DVLA) in the UK or the Driver and Vehicle Agency (DVA) in Northern Ireland'
                    ],
                    'birthCertificate' => [
                        'label' => 'A UK original birth certificate'
                    ]
                ]
            ],
            'group2' => [
                'type' => 'checkbox',
                'options' => [
                    'bankStatement' => [
                        'label' => 'A bank or building society statement from the last 3 months (we will accept 2 statements, but only if they are from different banks or building societies)',
                    ],
                    'utilityBill' => [
                        'label' => 'A utility bill from the last 3 months (we will accept gas, electric, telephone landline, water, satellite TV or cable TV bills but not mobile phone bills)',
                    ],
                    'creditCardStatement' => [
                        'label' => 'A credit card statement from the last 3 months (we will accept 2 statements, but only if they are from different credit-card providers)',
                    ],
                    'councilTaxStatement' => [
                        'label' => 'A council tax statement from the last 12 months',
                    ],
                    'mortgageStatement' => [
                        'label' => 'A mortgage statement from the last 12 months'
                    ],
                    'officialLetter' => [
                        'label' => 'A letter from the last 3 months from any of the following:',
                        'options' => [
                            0 => 'HM Revenue and Customs',
                            1 => 'The Department of Work and Pensions',
                            2 => 'A Jobcentre Plus – or any other employment service',
                            3 => 'A local authority'
                        ],
                    ],
                    'taxStatement' => [
                        'label' => 'A P45 or P60 tax statement from the last 12 months'
                    ]
                ],
            ],
        ]
    ],

    'home_banner' => [
        '1' => [
            'img' => env('APP_URL') . '/mobile_app/banner_images/Logo-logosu.png',
            'slug' => null
        ],
        '2' => [
            'img' => env('APP_URL') . '/mobile_app/banner_images/Chigai_kuginuki.svg.png',
            'slug' => null
        ],
        '3' => [
            'img' => env('APP_URL') . '/mobile_app/banner_images/Logo-logosu.png',
            'slug' => null
        ],
    ],

    'hear_about_us_data' => [
        '1' => 'Social Media (Facebook, Instagram, LinkedIn, X, TikTok, YouTube, etc.)',
        '2' => 'Search Engine (Google, Yahoo, etc)',
        '3' => 'Paid Google Advertisement',
        '4' => 'Paid Bing Advertisement',
        '5' => 'Word of Mouth',
        '6' => 'Email',
        '7' => 'Referred by a Trainer',
        '8' => 'Referred by a Friend',
        '9' => 'Third Party (Hurak, Get Licenced, etc)',
        '10' => 'Other',
    ],

    'english' => [
        [
            [
                'id' => 1,
                'question' => "Q1. What is the main purpose of Text A?",
                'desc' => "Please select one answer. (1 Point)",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "To describe", 'value' => "To describe"],
                    ['label' => "To explain",  'value' => "To explain"],
                    ['label' => "To persuade", 'value' => "To persuade"],
                ],
            ],
            [
                'id' => 2,
                'question' => "Q2. According to Text A, how long will the roadworks take?",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "As long as it takes", 'value' => "As long as it takes"],
                    ['label' => "9 days",             'value' => "2 weeks"],
                    ['label' => "2 weeks",            'value' => "9 days"],
                    ['label' => "Long periods",       'value' => "Long periods"],
                ],
            ],
            [
                'id' => 3,
                'question' => "Q3. According to Text A, how does the council plan to reduce congestion?",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "By keeping local businesses open", 'value' => "By keeping local businesses open"],
                    ['label' => "By using temporary traffic lights", 'value' => "By resurfacing the road"],
                    ['label' => "By resurfacing the road", 'value' => "By using temporary traffic lights"],
                    ['label' => "By using heavy machinery",         'value' => "By using heavy machinery"],
                ],
            ],
            [
                'id' => 4,
                'question' => "Q4. According to Text A, who can use the park-and-ride service at a reduced cost?",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "People living on Main Street", 'value' => "People living on Main Street"],
                    ['label' => "Council employees",            'value' => "Dee Rose"],
                    ['label' => "Dee Rose",                     'value' => "Council employees"],
                    ['label' => "Businesses on Main Street",    'value' => "Businesses on Main Street"],
                ],
            ],
            [
                'id' => 5,
                'question' =>
                "Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?",
                'desc' => "Please write a paragraph which consists of approximately 3-4 sentences.",
                'type' => "PARAGRAPH_CHECK_BOX",
                'options' => [
                    ['label' => "Fact", 'value' => "Fact"],
                    ['label' => "Opinion", 'value' => "Opinion"],
                ],
                'placeholder' => "Type your answer here...",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 6,
                'question' =>
                "Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street",
                'type' => "MULTI_PARAGRAPH",
                'fields' => [
                    [
                        'id' => "example_1",
                        'label' => "Example 1",
                        'placeholder' => "Type Example 1 here...",
                    ],
                    [
                        'id' => "example_2",
                        'label' => "Example 2",
                        'placeholder' => "Type Example 2 here...",
                    ],
                ],
                'layout' => "vertical",
                'mainHeading' => "Question 2b",
                'rules' => [
                    'required' => "Please provide answers for all fields",
                ],
            ],
            [
                'id' => 7,
                'question' => "Q7. Is Text A formal or informal? Give a reason for your answer",
                'desc' => "Please write a paragraph which consists of approximately 3-4 sentences.",
                'type' => "PARAGRAPH_CHECK_BOX",
                'options' => [
                    ['label' => "Formal", 'value' => "Formal"],
                    ['label' => "Informal", 'value' => "Informal"],
                ],
                'placeholder' => "Type your answer here...",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 8,
                'question' => "Q8. What is the meaning of the term added bonus as used in Text B?",
                'desc' => "Please select one answer. (1 Point)",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "A student loan",     'value' => "A student loan"],
                    ['label' => "A benefit",          'value' => "A disadvantage"],
                    ['label' => "A disadvantage",     'value' => "A benefit"],
                    ['label' => "An extra payment",   'value' => "An extra payment"],
                ],
            ],
            [
                'id' => 9,
                'question' => "Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Paragraphs",   'value' => "Paragraphs"],
                    ['label' => "Subheadings",  'value' => "Heading"],
                    ['label' => "Heading",      'value' => "Subheadings"],
                    ['label' => "Bullet points", 'value' => "Bullet points"],
                ],
            ],
            [
                'id' => 10,
                'question' => "Q10. Using Text B, which of these statements is incorrect?",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Apprentices earn a salary",                 'value' => "Apprentices earn a salary"],
                    ['label' => "Job centres have more details",             'value' => "National Apprenticeship Week is in the summer"],
                    ['label' => "National Apprenticeship Week is in summer", 'value' => "Job centres have more details"],
                    ['label' => "Apprenticeships are only for teenagers",    'value' => "Apprenticeship are only available to teenagers"],
                ],
            ],
            [
                'id' => 11,
                'question' => "Q11. According to Text B, most of the training takes place",
                'desc' => "Please select one answer. (1 Point).",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "at the job centre", 'value' => "At the job centre"],
                    ['label' => "at university",     'value' => "In the workplace"],
                    ['label' => "in the workplace",  'value' => "At university"],
                    ['label' => "at college",        'value' => "At college"],
                ],
            ],
            [
                'id' => 12,
                'question' => "12. What does the image in Text B suggest about how the apprentices are feeling about their course?",
                'desc' => "(Please write a paragraph of 3-4 sentences.)",
                'type' => "PARAGRAPH_INPUT",
                'placeholder' => "Type your answer here...",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 13,
                'question' => "Q13. Explain why the author has used exclamation marks in Text B",
                'desc' => "(Please write a paragraph of 3-4 sentences.)",
                'type' => "PARAGRAPH_INPUT",
                'placeholder' => "Type your answer here...",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 14,
                'question' => "Q14. How does the information about roadworks in Text B compare with that given in Text A?",
                'type' => "MULTI_PARAGRAPH",
                'fields' => [
                    [
                        'id' => "example_1",
                        'label' => "Example 1",
                        'placeholder' => "Type Example 1 here...",
                    ],
                    [
                        'id' => "example_2",
                        'label' => "Example 2",
                        'placeholder' => "Type Example 2 here...",
                    ],
                ],
                'layout' => "vertical",
                'mainHeading' => "Question 2b",
                'rules' => [
                    'required' => "Please provide answers for all fields",
                ],
            ],
        ],

        [
            [
                'id' => 0,
                'image' => [env('APP_URL') . '/mobile_app/task/banner4.jpg'],
                'question' => "Please read Text A and answer questions 1-7.",
                'description' => "You receive the following document from Training for Employment:",
                'start' => 0,
                'end'   => 7,
            ],
            [
                'id' => 1,
                'image' => [env('APP_URL') . '/mobile_app/task/construction.jpeg'],
                'question' => "Please read Text B and answer questions 8-13.",
                'description' => "You receive the following document from Training for Employment:",
                'start' => 7,
                'end'   => 13,
            ],
            [
                'id' => 3,
                'image' => [env('APP_URL') . '/mobile_app/task/dummyImage.jpg', env('APP_URL') . '/mobile_app/task/construction.jpg'],
                'question' => "Please read Text B and answer questions 8-13.",
                'description' => "You receive the following document from Training for Employment:",
                'start' => 13,
                'end'   => 14,
            ],
        ],

    ],

    'ds_refresher_workbook' => [
        'sections' => [
            [
                "id" => 1,
                "title" => "Personal Information",
                "stepType" => "form",
                "questions" => [],
            ],
            [
                "id" => 2,
                "title" => "Assessment Questions - LO1",
                "stepType" => "questions",
                "startIndex" => 0,
                "endIndex" => 7,
                "sectionData" => "REFRESHER_SECTION",
            ],
            [
                "id" => 3,
                "title" => "Assessment Questions - LO2",
                "stepType" => "questions",
                "startIndex" => 8,
                "endIndex" => 15,
                "sectionData" => "REFRESHER_SECTION",
            ],
            [
                "id" => 4,
                "title" => "Assessment Questions - LO3",
                "stepType" => "questions",
                "startIndex" => 16,
                "endIndex" => 23,
                "sectionData" => "REFRESHER_SECTION",
            ],
            [
                "id" => 5,
                "title" => "Assessment Questions - LO4",
                "stepType" => "questions",
                "startIndex" => 24,
                "endIndex" => 31,
                "sectionData" => "REFRESHER_SECTION",
            ],
            "assessmentType" => "DS_REFRESHER_WORKBOOK_UNIT_1",
            "requiresSignature" => true,
            "signatureStep" => 1,
        ],

        'questions' => [
            [
                'id' => 1,
                'question' => "Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 3,
                'helperText' => "As a door supervisor, you will be required to carry out different types of searches.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.2 Explain what is meant by the term 'arrest'",
            ],
            [
                'id' => 2,
                'question' => "Q2a. Identify THREE occasions when a door supervisor has the right to search",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 3,
                'helperText' => "Door supervisors have specific powers related to their duties, but your right to search individuals is limited.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.2 Identify a door supervisor's right to search",
            ],
            [
                'id' => 3,
                'question' => "Explain the search process required when carrying out:",
                'type' => 'MULTI_PARAGRAPH',
                'fields' => [
                    [
                        'id' => 'single_sex',
                        'label' => 'Q2b Single sex',
                        'placeholder' => 'Explain the search process for single sex searches...',
                    ],
                    [
                        'id' => 'transgender',
                        'label' => 'Q2b Transgender individuals',
                        'placeholder' => 'Explain the search process for transgender individuals...',
                    ]
                ],
                'layout' => 'vertical',
                'mainHeading' => 'Question 2b',
                'rules' => [
                    'required' => 'Please provide answers for all fields',
                ],
            ],
            [
                'id' => 4,
                'question' => "Q3. Identify SEVEN different types of equipment that can be used to assist with searches",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 7,
                'helperText' => "As a door supervisor, you may be required to search staff, visitors or customers at a site before allowing entry.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.3 Identify the different types of searching equipment",
            ],
            [
                'id' => 5,
                'question' => "Q4. Identify SEVEN hazards you may encounter when conducting searches",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 7,
                'helperText' => "Door supervisors may encounter various potential hazards when conducting searches.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.4 Recognise possible hazards when conducting a search",
            ],
            [
                'id' => 6,
                'question' => "Q5. State NINE precautions that you can take when carrying out a search",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 9,
                'helperText' => "It is important that as a door supervisor you take care of yourself when conducting searches.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.5 State the precautions to take when carrying out a search",
            ],
            [
                'id' => 7,
                'question' => "Q6. State the actions to take if an incident or an accident occurs.",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "From time to time, incidents or accidents may occur; it is important to always follow the venue's policy or assignment instructions.",
                'mainHeading' => "AC1.6 State the actions to take if an incident or an accident occurs",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 8,
                'question' => "Q7. Identify FIVE reasons for carrying out a premises search",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'helperText' => "As well as searching people, you may be required to carry out a premises search.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.8 Identify the reasons for carrying out a premises search",
            ],
            [
                'id' => 9,
                'question' => "Q8. State FOUR actions to take in the event of a search refusal",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 4,
                'helperText' => "Individuals may refuse to be searched or to have their belongings searched. Any refusals should be handled according to the venue's policy or assignment instructions.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.9 Recognise actions to take in the event of a search refusal",
            ],
            [
                'id' => 10,
                'question' => "Q9. Identify FOUR reasons for completing search documentation",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 4,
                'helperText' => "Venues that require the security team to search people or their property must provide a suitable method of recording searches.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.10 Identify reasons for completing search documentation.",
            ],
            [
                'id' => 11,
                'question' => "Q10. actions to take if a prohibited or restricted item is found during a search",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 4,
                'helperText' => "Any stolen, illegal or unauthorised items found during a search must be delt with correctly.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.11 Identify actions to take if a prohibited or restricted item is found during a search",
            ],
            [
                'id' => 12,
                'question' => "Q11a. Explain what is meant by duty of care",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor you have a duty of care to vulnerable people that enter the premises.",
                'mainHeading' => "AC2.1 Recognise duty of care with regard to vulnerable people",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 13,
                'question' => "Q11b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'mainHeading' => "Question 11b",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 14,
                'question' => "Q12a. Identify FIVE factors that could make someone vulnerable or more at risk than others",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, you need to be aware of individuals who may be considered vulnerable due to various factors.",
                'mainHeading' => "AC2.2 Identify factors that could make someone vulnerable",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 14,
                'question' => "Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'mainHeading' => "Question 12b",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 15,
                'question' => "Q13. Identify FIVE actions that you should take towards vulnerable individuals",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "In your professional judgement, if a person appears to be vulnerable, you need to consider what help they might need",
                'mainHeading' => "AC2.3 Identify actions that the security operative should take towards vulnerable individuals",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 15,
                'question' => "Q14. Identify FOUR behaviours that may be exhibited by sexual predators",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 4,
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, you must be able to identify behaviours that may be exhibited by sexual predators.",
                'mainHeading' => "AC2.4 Identify behaviours that may be exhibited by sexual predators",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 16,
                'question' => "Q15. Identify FOUR indicators of abuse",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 4,
                'placeholder' => "Type your answer here...",
                'helperText' => "There are several identifying indicators of abuse that a door supervisor can look out for.",
                'mainHeading' => "AC2.5 Identify indicators of abuse",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 17,
                'question' => "Q16. State how to deal with allegations of sexual assault",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "Door supervisors regularly wear uniforms. Some people find this reassuring and may choose to tell the operative about the abuse they have been subjected to. This is called disclosure.",
                'mainHeading' => "AC2.6 State how to deal with allegations of sexual assault",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 18,
                'question' => "Q18. Identify the FIVE different threat levels",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, you should always maintain a positive and productive attitude when dealing with members of the public who are demonstrating anti-social behaviour.",
                'mainHeading' => "AC2.7 State how to deal with anti-social behaviour",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 19,
                'question' => "Q19. What are the most common terror attack methods?",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "Threat levels are designed to give a broad indication of the likelihood of a terrorist attack.",
                'mainHeading' => "AC3.1 Identify the different threat levels",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 20,
                'question' => "Q20. Explain the actions you should take in the event of a terror threat at the venue or site",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "It is important to be aware of the common methods used in terror attacks.",
                'mainHeading' => "AC3.2 Recognise the common terror attack methods",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 21,
                'question' => "Q21. Identify the procedures for dealing with suspicious items",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "The role of a door supervisor during a terror attack will be outlined in the venue or site's policies and procedures.",
                'mainHeading' => "AC3.3 Recognise the actions to take in the event of a terror threat",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 22,
                'question' => "Q22. Identify SIX behaviours that could indicate suspicious activity",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, you need to be aware of suspicious packages and the procedures to follow if one is identified.",
                'mainHeading' => "AC3.4 Identify the procedures for dealing with suspicious items",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 23,
                'question' => "Q23. Identify how you should respond to suspicious behaviour",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "Suspicious activity is any observed behaviour that could indicate terrorism or terrorism-related crime.",
                'mainHeading' => "AC3.5 Identify behaviours that could indicate suspicious activity",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 24,
                'question' => "Q24. State FIVE methods of spiking",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, you shouldn't be afraid of responding when you suspect suspicious behaviour.",
                'mainHeading' => "AC3.6 Identify how to respond to suspicious behaviour",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'value' => 10,
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 25,
                'question' => "Q25. State the law in relation to spiking",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, it is important to understand what spiking is and how to recognise it and prevent incidents from occurring.",
                'mainHeading' => "AC4.1 State methods of spiking",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 26,
                'question' => "Q26. State FIVE indicators that suggests a drink has been spiked",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "It is important that you understand the laws in relation to spiking when working as a door supervisor.",
                'mainHeading' => "AC4.2 State the law in relation to spiking",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 27,
                'question' => "Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "There are visual indicators that may suggest a person's drink has been spiked.",
                'mainHeading' => "AC4.3 State indicators that drinks have been spiked",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 28,
                'question' => "Q28. Identify THREE situations when an individual might be at high risk of spiking",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "As a door supervisor, there are behavioural signs that may indicate a person is attempting to spike a drink.",
                'mainHeading' => "AC4.4 Identify behavioural signs of an individual attempting to spike drinks",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 29,
                'question' => "Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "There are several situations where an individual might be at high risk of spiking.",
                'mainHeading' => "AC4.5 Identify situations when an individual might be at high risk of spiking",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 30,
                'question' => "Q30. Describe the indicators that suggest an individual may have been spiked",
                'type' => 'MULTI_LINE_INPUT',
                'numberOfLines' => 5,
                'placeholder' => "Type your answer here...",
                'helperText' => "There are several actions you and the venue can take to prevent incidents of spiking.",
                'mainHeading' => "AC4.6 State actions door supervisors and/or venues may take to prevent incidents of spiking",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ],
            [
                'id' => 31,
                'question' => "Q31. State how to manage a spiking incident",
                'type' => 'PARAGRAPH_INPUT',
                'placeholder' => "Type your answer here...",
                'helperText' => "There are signs a door supervisor can look for that may indicate an individual has been spiked.",
                'mainHeading' => "AC4.7 Recognise indicators that suggest an individual may have been spiked",
                'rules' => [
                    'required' => "Please provide an answer",
                    'minLength' => [
                        'message' => "Answer must be at least 10 characters long",
                    ],
                ],
            ]
        ]
    ],

    'ds_refresher_workbook_2' => [
        'sections' => [
            [
                'id' => 1,
                'title' => "Personal Information",
                'stepType' => "form",
            ],
            [
                'id' => 2,
                'title' => "Assessment Questions - LO1",
                'stepType' => "questions",
                'startIndex' => 0,
                'endIndex' => 3,
                'sectionData' => [
                    'id' => 0,
                    'LOC' => "LO1 Know the implications of physical interventions and their use",
                    'start' => 0,
                    'end' => 3,
                ],
            ],
            [
                'id' => 3,
                'title' => "Assessment Questions - LO2",
                'stepType' => "questions",
                'startIndex' => 4,
                'endIndex' => 7,
                'sectionData' => [
                    'id' => 1,
                    'LOC' => "LO2 Know the risks associated with using physical intervention",

                    'start' => 4,
                    'end' => 7,
                ],
            ],
            [
                'id' => 4,
                'title' => "Assessment Questions - LO3",
                'stepType' => "questions",
                'startIndex' => 7,
                'endIndex' => 12,
                'sectionData' => [
                    'id' => 2,
                    'LOC' => "LO3 Know how to reduce the risks associated with physical intervention",

                    'start' => 7,
                    'end' => 12,
                ],
            ],
        ],
        'assessmentType' => "DS_REFRESHER_WORKBOOK_UNIT_2",
        'requiresSignature' => true,
        'signatureStep' => 1,

        'questions' => [
            [
                'id' => 1,
                'question' => "Q1. State the legal implications of using physical intervention",
                'type' => "PARAGRAPH_INPUT",
                'helperText' => "Using physical intervention carries important legal considerations that must be understood to ensure actions re-main within the bounds of the law. Failure to comply with legal standards can result in serious consequences for all parties involved.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.1 State the legal implications of using physical intervention",
            ],
            [
                'id' => 2,
                'question' => "Q2. Identify FIVE professional implications of using physical intervention",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 3,
                'helperText' => "Using physical intervention in a professional setting can have significant consequences for both individuals and organisations. It is important to understand how such actions can affect one’s career, reputation and compliance with industry standards.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.2 State the professional implications of using physical intervention",
            ],
            [
                'id' => 3,
                'question' => "Q3. Identify positive alternatives to physical intervention",
                'type' => "PARAGRAPH_INPUT",
                'helperText' => "In situations where conflict or aggression arises, it is essential to consider alternatives to physical intervention that can help de-escalate tensions and resolve issues peacefully.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.3 Identify positive alternatives to physical intervention",
            ],
            [
                'id' => 4,
                'question' => "Q4. Identify the TWO key differences between defensive physical skills and physical interventions",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 2,

                'helperText' =>
                "There is a distinction between defensive physical skills and physical interventions, as a door supervisor it is important that you are able to identify the differences.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC1.4 Identify the differences between defensive physical skills and physical interventions",
            ],
            [
                'id' => 5,
                'question' => "Q5. Identify the risk factors involved with the use of physical intervention.",
                'type' => "PARAGRAPH_INPUT",
                'helperText' => "When using physical intervention, there are various risk factors that can impact the safety and well-being of both the individual being restrained and the person applying the intervention. Understanding these risks is crucial for minimising harm.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC2.1 Identify the risk factors involved with the use of physical intervention",
            ],
            [
                'id' => 6,
                "question" => "Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis",
                "type" => "PARAGRAPH_INPUT",
                "helperText" => "When working as a door supervisor, it is crucial to understand and identify certain medical and psychological conditions that may affect individuals’ behaviour. Being able to recognise these conditions can help ensure the safety of everyone involved.",
                "rules" => ["required" => "Please fill this field"],
                "mainHeading" => "AC2.2 Recognise the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis",
            ],
            [
                "id" => 7,
                "question" => "Q7. State the specific risks associated with prolonged physical interventions",
                "type" => "PARAGRAPH_INPUT",
                "helperText" => "Prolonged physical interventions carry significant risks for both the individual and the person applying the intervention.",
                "rules" => ["required" => "Please fill this field"],
                "mainHeading" => "AC2.4 State the specific risks associated with prolonged physical interventions",
            ],
            [
                "id" => 8,
                "question" => "Q8. State the specific risks of dealing with physical intervention incidents on the ground",
                "type" => "PARAGRAPH_INPUT",
                "helperText" =>
                "When physical interventions occur on the ground, they can present additional hazards that increase the risk of harm to both the individual and the door supervisor involved.",
                "rules" => ["required" => "Please fill this field"],
                "mainHeading" =>
                "AC3.1 State the specific risks of dealing with physical intervention incidents on the ground",
            ],
            [
                "id" => 9,
                "question" => "Q9. ways of reducing the risk of harm during physical interventions",
                "type" => "MULTI_LINE_INPUT",
                "helperText" => "Minimising harm during physical interventions is essential for maintaining safety. Using appropriate techniques can significantly reduce the associated risks.",
                "rules" => ["required" => "Please complete all fields"],
                "mainHeading" => "AC3.3 Identify ways of reducing the risk of harm during physical interventions",
            ],
            [
                "id" => 10,
                "question" => "Q10. State how to manage and monitor a persons safety during physical intervention",
                "type" => "PARAGRAPH_INPUT",
                "helperText" =>
                "It is crucial to manage and monitor the safety of the individual involved in a physical intervention to prevent harm and reduce risk.",
                "rules" => ["required" => "Please fill this field"],
                "mainHeading" =>
                "AC3.4 State how to manage and monitor a person's safety during physical intervention",
            ],
            [
                "id" => 11,
                "question" => "Q11. Identify FIVE responsibilities of all involved during a physical intervention",
                "type" => "MULTI_LINE_INPUT",
                "numberOfLines" => 5,
                "helperText" =>
                "Everyone involved must understand their specific roles and responsibilities to ensure the safety and well-being of all parties.",
                "rules" => ["required" => "Please complete all fields"],
                "mainHeading" =>
                "AC3.6 State the responsibilities of all involved during a physical intervention",
            ],
            [
                "id" => 12,
                "question" => "Q12. Identify SIX responsibilities immediately following a physical intervention",
                "type" => "MULTI_LINE_INPUT",
                "numberOfLines" => 6,
                "helperText" =>
                "After a physical intervention, specific procedures must be followed to meet legal and professional requirements and ensure the safety of all involved.",
                "rules" => ["required" => "Please complete all fields"],
                "mainHeading" =>
                "AC3.7 State the responsibilities immediately following a physical intervention",
            ],
            [
                "id" => 13,
                "question" => "Q13. State why it is important to maintain physical intervention knowledge and skills",
                "type" => "PARAGRAPH_INPUT",
                "helperText" =>
                "Keeping your knowledge and skills up to date ensures your actions are safe, effective, and legally compliant.",
                "rules" => ["required" => "Please fill this field"],
                "mainHeading" =>
                "AC3.8 State why it is important to maintain physical intervention knowledge and skills",
            ],
        ]
    ],

    'sg_refresher_questions' => [
        'sections' => [
            [
                'id' => 1,
                'title' => "Personal Information",
                'stepType' => "form",
                'questions' => [],
            ],
            [
                'id' => 2,
                'title' => "Assessment Questions - LO1",
                'stepType' => "questions",

                'startIndex' => 0,
                'endIndex' => 11,
                'sectionData' => [
                    'id' => 0,
                    'LOC' => "LO1 Know how to conduct effective search procedures",
                    'question' => "More information can be found at:",
                    'description' =>
                    "Guidance on conducting a search is available on paragraphs13.57-13.60 on pages 197 to 198 of the Equality and Human Rights Commission guidance at:",
                    'pdf' => "'https' =>//www.equalityhumanrights.com/sites/default/files/servicescode_0.pdf",
                    'start' => 0,
                    'end' => 3,
                ],
            ],
            [
                'id' => 3,
                'title' => "Assessment Questions - LO2",
                'stepType' => "questions",

                'startIndex' => 12,
                'endIndex' => 21,
                'sectionData' => [
                    'id' => 1,
                    'LOC' => "LO2 Understand how to keep vulnerable people safe",
                    'start' => 4,
                    'end' => 7,
                ],
            ],
            [
                'id' => 4,
                'title' => "Assessment Questions - LO3",
                'stepType' => "questions",

                'startIndex' => 22,
                'endIndex' => 27,
                'sectionData' => [
                    'id' => 2,
                    'LOC' => "LO3 Understand terror threats and the role of the security operative in the event of a threat",
                    'start' => 7,
                    'end' => 12,
                ],
            ],
        ],

        'questions' => [
            [
                'id' => 1,
                'question' =>
                "Q1. State the THREE different types of searches that are carried out by a security officer",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 3,
                'helperText' =>
                "As a security officer you will be required to carry out different types of searches.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC1.1 State the different type of searches carried out by a security officer",
            ],
            [
                'id' => 2,
                'question' =>
                "Q2a. Identify THREE occasions when a security officer has the right to search",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 3,
                'helperText' =>
                "Security officers have specific powers related to their duties, but your right to search individuals is limited.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.2 Identify a security officer’s right to search",
            ],
            [
                'id' => 3,
                'question' => "Explain the search process required when carrying out:",
                'type' => "MULTI_PARAGRAPH",
                'fields' => [
                    [
                        'id' => "Q2b. Single sex",
                        'label' => "Single sex",
                        'placeholder' => "Explain the search process for single sex searches...",
                    ],
                    [
                        'id' => "transgender",
                        'label' => "Q2b. Transgender individuals",
                        'placeholder' =>
                        "Explain the search process for transgender individuals...",
                    ],
                ],
                'layout' => "vertical",
                'mainHeading' => "Question 2b",
                'rules' => [
                    'required' => "Please provide answers for all fields",
                ],
            ],
            [
                'id' => 4,
                'question' =>
                "Q3. Identify SEVEN different types of equipment that can be used to assist with searches",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 7,
                'helperText' =>
                "As a security officer you may be required to search staff, visitors or customers at a site before allowing entry.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.3 Identify the different types of searching equipment",
            ],
            [
                'id' => 5,
                'question' =>
                "Q4. Identify SEVEN hazards you may encounter when conducting searches",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 7,
                'helperText' =>
                "As a security officer you may be required to search staff, visitors or customers at a site before allowing entry.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC1.4 Recognise possible hazards when conducting a search",
            ],
            [
                'id' => 6,
                'mainHeading' =>
                "AC1.5 State the precautions to take when carrying out a search",
                'question' =>
                "5. State FIVE precautions that you can take when carrying out a search",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "It is important that as a security officer you take care of yourself when conducting searches.",
            ],
            [
                'id' => 7,
                'mainHeading' =>
                "AC1.6 State the actions to take if an incident or an accident occurs",
                'question' => "Q6. State the actions to take if an incident or an accident occurs",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "From time to time, incidents or accidents may occur; it is important to always follow the venue’s policy or assignment instructions.",
            ],
            [
                'id' => 8,
                'question' => "State typical areas of vehicles to be searched.",
                'type' => "MULTI_PARAGRAPH",
                'fields' => [
                    [
                        'id' => "Q7. Cycles",
                        'label' => "Q7. Cycles",
                    ],
                    [
                        'id' => "Q7. Motorcycles",
                        'label' => "Q7. Motorcycles",
                    ],
                    [
                        'id' => "Q7. Cars",
                        'label' => "Q7. Cars",
                    ],
                    [
                        'id' => "Q7. Vans",
                        'label' => "Q7. Vans",
                    ],
                    [
                        'id' => "Q7. Heavy goods vehicles",
                        'label' => "Q7. Heavy goods vehicles",
                    ],
                ],
                'layout' => "vertical",
                'mainHeading' => "Question 2b",
                'rules' => [
                    'required' => "Please provide answers for all fields",
                ],
            ],
            [
                'id' => 9,
                'mainHeading' =>
                "AC1.9 Identify the reasons for carrying out a premises search",
                'question' => "Q8. Identify FIVE reasons for carrying out a premises search",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "As well as searching people, you may be required to carry out a premises search.",
            ],
            [
                'id' => 10,
                'mainHeading' =>
                "AC1.10 Recognise actions to take in the event of a search refusal",
                'question' => "Q9. State FOUR actions to take in the event of a search refusal",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 4,
                'helperText' =>
                "Individuals may refuse to be searched or to have their belongings searched. Any refusals should be handled according to the venue’s policy or assignment instructions.",
            ],
            [
                'id' => 11,
                'mainHeading' => "AC1.11 Identify reasons for completing search documentation",
                'question' => "Q10. Identify FOUR reasons for completing search documentation",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 4,
                'helperText' =>
                "Venues that require the security team to search people or their property must provide a suitable method of recording searches.",
            ],
            [
                'id' => 12,
                'mainHeading' =>
                "AC1.12 Identify actions to take if a prohibited or restricted item is found during a search",
                'question' =>
                "Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 6,
                'helperText' =>
                "Any stolen, illegal or unauthorised items found during a search must be delt with correctly.",
            ],
            [
                'id' => 13,
                'question' => "Q2a. Explain what is meant by duty of care",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "As a security officer, you have a legal and moral responsibility to ensure the safety and well-being of others, especially vulnerable people.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC2.1 Recognise duty of care with regard to vulnerable people",
            ],
            [
                'id' => 14,
                'question' =>
                "Q2b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Not all vulnerabilities are visible. Providing equal care ensures that all individuals are protected and reduces the risk of harm.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC2.1 Recognise duty of care with regard to vulnerable people",
            ],
            [
                'id' => 15,
                'question' =>
                "Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "Be aware of the different circumstances that can increase a person's vulnerability. These may relate to age, disability, intoxication, and more.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' => "AC2.2 Identify factors that could make someone vulnerable",
            ],
            [
                'id' => 16,
                'question' =>
                "Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "Each identified factor contributes to vulnerability in different ways. Explain how each increases risk.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' => "AC2.2 Identify factors that could make someone vulnerable",
            ],
            [
                'id' => 17,
                'question' =>
                "Q14. Identify FIVE actions that you should take towards vulnerable individuals",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "Taking the correct actions helps protect vulnerable individuals and ensures they receive appropriate support.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' =>
                "AC2.3 Identify actions that the security operative should take towards vulnerable individuals",
            ],
            [
                'id' => 18,
                'question' =>
                "IQ15. Identify FOUR behaviours that may be exhibited by sexual predators",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 4,
                'helperText' =>
                "Security officers should be alert to warning signs that someone may be acting with harmful intent toward others.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' =>
                "AC2.4 Identify behaviours that may be exhibited by sexual predators",
            ],
            [
                'id' => 19,
                'question' => "Q16. Identify FOUR indicators of abuse",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 4,
                'helperText' =>
                "Knowing the signs of abuse can help you take action to protect individuals who may be at risk.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' => "AC2.5 Identify indicators of abuse",
            ],
            [
                'id' => 20,
                'question' => "Q17. State how to deal with allegations of sexual assault",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Victims may confide in you. It's important to respond appropriately, ensuring their safety and reporting the incident correctly.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC2.6 State how to deal with allegations of sexual assault",
            ],
            [
                'id' => 21,
                'question' => "Q18. State how to deal with anti-social behaviour",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Always maintain professionalism and de-escalate situations safely and respectfully when dealing with anti-social behaviour.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC2.7 State how to deal with anti-social behaviour",
            ],
            [
                'id' => 22,
                'question' => "Q19. Identify the FIVE different threat levels",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 5,
                'helperText' =>
                "Threat levels give a broad indication of the likelihood of a terrorist attack, ranging from low to critical.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' => "AC3.1 Identify the different threat levels",
            ],
            [
                'id' => 23,
                'question' => "Q20. What are the most common terror attack methods?",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Understanding common terror attack methods helps in identifying and preventing threats.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC3.2 Recognise the common terror attack methods",
            ],
            [
                'id' => 24,
                'question' =>
                "Q21. Explain the actions you should take in the event of a terror threat at the venue or site",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Know what to do in a terror situation to protect yourself and others, in line with site-specific policies.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC3.3 Recognise the actions to take in the event of a terror threat",
            ],
            [
                'id' => 25,
                'question' => "Q22. Identify the procedures for dealing with suspicious items",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Suspicious items must be handled according to set procedures to ensure safety and avoid unnecessary panic.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' =>
                "AC3.4 Identify the procedures for dealing with suspicious items",
            ],
            [
                'id' => 26,
                'question' =>
                "Q23. Identify SIX behaviours that could indicate suspicious activity",
                'type' => "MULTI_LINE_INPUT",
                'numberOfLines' => 6,
                'helperText' =>
                "Be observant of behaviours that may suggest involvement in terrorism or criminal activity.",
                'rules' => ['required' => "Please complete all fields"],
                'mainHeading' =>
                "AC3.5 Identify behaviours that could indicate suspicious activity",
            ],
            [
                'id' => 27,
                'question' => "Q24. Identify how you should respond to suspicious behaviour",
                'type' => "PARAGRAPH_INPUT",
                'helperText' =>
                "Responding appropriately to suspicious behaviour is key to preventing potential threats.",
                'rules' => ['required' => "Please fill this field"],
                'mainHeading' => "AC3.6 Identify how to respond to suspicious behaviour",
            ],
        ],
    ],

    'cctv_activity_section' => [
        [
            'id' => 1,
            'question' => "Q1. What is the purpose of security industry?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 2,
            'question' => "Q2. List 3 ways in which security is provided",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 3,
            'question' => "Q3. Describe the 3 main aims of the SIA",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 4,
            'question' => "Q4. List any 5 examples of community safety initiatives",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 5,
            'question' => "Q5. List 3 benefits of using CCTV",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 6,
            'question' => "Q6. List any 5 qualities that a security operative should have",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 7,
            'question' => "Q7. What are the legal implications of using CCTV?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 8,
            'question' => "Q8. Explain what is meant by the term ARREST",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 9,
            'question' =>
            "Q9. Provide 6 examples of offences for which a security operative can make an arrest",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "1.\n2.\n3.\n4.\n5.\n6.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 10,
            'question' =>
            "Q10. Explain the procedures a security operative should follow after an arrest",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 11,
            'question' => "Q11. Please describe internal customers",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 12,
            'question' => "Q12. List different types of communication",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 13,
            'question' =>
            "Q13. Give 3 examples of good customer care and 3 examples of bad customer care",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "Good:\n1.\n2.\n3.\nBad:\n1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 14,
            'question' => "Q14. What are protected characteristics?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 15,
            'question' => "Q15. What are the 3 consideration when forces applied?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 16,
            'question' => "Q16. Give 3 reasons why venue might be evacuated",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 17,
            'question' => "Q17. What are the components of the fire triangle?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 18,
            'question' =>
            "Q18. What are the priorities that you need to observe during evacuation from a venue?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 19,
            'question' => "Q19. How many Data protection principles are there?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 20,
            'question' => "Q21. Name 6 different safety signs",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "1.\n2.\n3.\n4.\n5.\n6.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 21,
            'question' => "Q22. Classify the fire and give one example of each one",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 22,
            'question' => "Q23. What are internal fire doors used for?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 23,
            'question' => "Q24. What is an emergency?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 24,
            'question' => "Q25. What are the 4 aims of first aid?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "1.\n2.\n3.\n4.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 25,
            'question' =>
            "Q26. What are the risks of lone working within the private security industry",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 26,
            'question' => "Q27. List FIVE examples of workplace hazards",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 27,
            'question' => "Q28. Explain the principles of evacuation and invacuation",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 28,
            'question' => "Q29. Give 3 examples of child sexual exploitation",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 29,
            'question' => "Q30. What is terrorism?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 30,
            'question' => "Q31. What type of threat level is substational?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
    ],

    'door_supervisor_activity_section' => [
        [
            'id' => 1,
            'question' => "Q1. What is the purpose of security industry?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 2,
            'question' => "Q2. List 3 ways in which security is provided",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 3,
            'question' => "Q3. Describe the 3 main aims of the SIA",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 4,
            'question' => "Q4. List any 5 examples of community safety initiatives",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 5,
            'question' => "Q5. List 3 benefits of using CCTV",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 6,
            'question' => "Q6. List any 5 qualities that a security operative should have",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 7,
            'question' => "Q7. What are the legal implications of using CCTV?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 8,
            'question' => "Q8. Explain what is meant by the term ARREST",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 9,
            'question' =>
            "Q9. Provide 6 examples of offences for which a security operative can make an arrest",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "1.\n2.\n3.\n4.\n5.\n6.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 10,
            'question' =>
            "Q10. Explain the procedures a security operative should follow after an arrest",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 11,
            'question' => "Q11. Please describe internal customers",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 12,
            'question' => "Q12. List different types of communication",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 13,
            'question' =>
            "Q13. Give 3 examples of good customer care and 3 examples of bad customer care",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "Good:\n1.\n2.\n3.\nBad:\n1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 14,
            'question' => "Q14. What are protected characteristics?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 15,
            'question' => "Q15. What are the 3 consideration when forces applied?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 16,
            'question' => "Q16. Give 3 reasons why venue might be evacuated",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 17,
            'question' => "Q17. What are the components of the fire triangle?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 18,
            'question' =>
            "Q18. What are the priorities that you need to observe during evacuation from a venue?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 19,
            'question' => "Q19. How many Data protection principles are there?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 20,
            'question' => "Q21. Name 6 different safety signs",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 6,
            'placeholder' => "1.\n2.\n3.\n4.\n5.\n6.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 21,
            'question' => "Q21. Classify the fire and give one example of each one",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 22,
            'question' => "Q23. What are internal fire doors used for?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 23,
            'question' => "Q24. What is an emergency?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 24,
            'question' => "Q25. What are the 4 aims of first aid?",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 4,
            'placeholder' => "1.\n2.\n3.\n4.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 25,
            'question' =>
            "Q26. What are the risks of lone working within the private security industry",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 26,
            'question' => "Q27. List FIVE examples of workplace hazards",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 5,
            'placeholder' => "1.\n2.\n3.\n4.\n5.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 27,
            'question' => "Q28. Explain the principles of evacuation and invacuation",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please provide an answer"],
        ],
        [
            'id' => 28,
            'question' => "Q29. Give 3 examples of child sexual exploitation",
            'type' => "MULTI_LINE_INPUT",
            'numberOfLines' => 3,
            'placeholder' => "1.\n2.\n3.",
            'rules' => ['required' => "Please fill this field"],
        ],
        [
            'id' => 29,
            'question' => "Q30. What is terrorism?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => [
                'required' => "Please provide an answer",
                'minLength' => [
                    'value' => 10,
                    'message' => "Answer must be at least 10 characters long",
                ],
            ],
        ],
        [
            'id' => 30,
            'question' => "Q31. What type of threat level is substational?",
            'type' => "PARAGRAPH_INPUT",
            'placeholder' => "Type your answer here...",
            'rules' => ['required' => "Please fill this field"],
        ],
    ],

    'pi_health_questionnaire_section' => [
        'intro' => [
            'title' => "Pi Health Questionnaire",
            'description' => "Before starting your training, we need a quick health questionnaire. This helps 'us' =>",
            'instructions' => [
                "Ensure your safety during physical activities",
                "Understand any existing conditions or injuries",
                "Provide the right support on the day",
            ],
        ],
        'questions' => [
            [
                'id' => 1,
                'question' => "Have you been exercise inactive for the past 12 months?",
                'type' => "CHECK_BOX",
                'options' => [
                    [
                        'label' => "Yes, I have been exercise inactive due to ongoing health issues",
                        'value' => "yes",
                    ],
                    [
                        'label' => "No, for past 12 months keep physically active",
                        'value' => "No, for past 12 months keep physically active",
                    ],
                ],
                'rules' => ['required' => "Please select an option"],
            ],

            [
                'id' => 3,
                'question' => "Do you have a heart condition?",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Yes", 'value' => "Yes"],
                    ['label' => "No", 'value' => "No"],
                ],
                'rules' => ['required' => "Please select an option"],
            ],
            [
                'id' => 4,
                'question' => "Have you ever experienced chest pains when exercising?",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Yes", 'value' => "Yes"],
                    ['label' => "No", 'value' => "No"],
                ],
                'rules' => ['required' => "Please select an option"],
            ],
            [
                'id' => 5,
                'question' => "Do you suffer from any joint problems?",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Yes", 'value' => "Yes"],
                    ['label' => "No", 'value' => "No"],
                ],
                'rules' => ['required' => "Please select an option"],
            ],
            [
                'id' => 6,
                'question' => "Do you have any ongoing injuries or are you currently taking medication or receiving treatment?",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Yes", 'value' => "Yes"],
                    ['label' => "No", 'value' => "No"],
                ],
                'rules' => ['required' => "Please select an option"],
            ],
            [
                'id' => 7,
                'question' => "Please provide details",
                'type' => "PARAGRAPH_INPUT",
                'placeholder' => "Please describe your ongoing injuries, medications, or treatments...",
                'conditionalOn' => ['questionId' => 6, 'value' => "yes"],
                'rules' => [
                    'required' => "Please provide details about your ongoing injuries, medications, or treatments",
                ],
            ],
            [
                'id' => 8,
                'question' => "Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?",
                'type' => "CHECK_BOX",
                'options' => [
                    ['label' => "Yes", 'value' => "Yes"],
                    ['label' => "No", 'value' => "No"],
                ],
                'rules' => ['required' => "Please select an option"],
            ],
        ],
        'declaration' => [
            'title' => "Health Information Declaration",
            'content' => "I declare that the information provided in this health questionnaire is true and complete to the best of my knowledge. I understand that any false or misleading information may result in the rejection of my application or termination of employment. I consent to the use of this information for the purposes of assessing my suitability for the role and making any necessary workplace adjustments.",
            'checkboxText' => "I agree to the above declaration",
            'signatureRequired' => true,
        ],
    ]
];
