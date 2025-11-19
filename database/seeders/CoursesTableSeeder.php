<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseExam;
use App\Models\Exam;
use App\Models\License;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookingTermsUrl = url('/booking-terms-and-conditions');
        $courses = [
            [
                'name' => 'SIA Door Supervisor',
                'course_image' => 'CourseThumbnail/siadoorsupervisor.webp',
                'banner_image' => 'CourseHeaderimages/SIA Door Supervisor.png',
                'color_code' => '#164b82',
                'category_id' => 1,
                'qualification' => '1',
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 6 days</li>
                    <li><strong>Location</strong>: Birmingham, B19 3NY</li>
                    <li><strong>Delivery Mode</strong>: Blended learning</li>
                    <li><strong>Price</strong>: from&nbsp;<strong>£261.50</strong></li>
                    <li><strong>Assessment</strong>: e-assessment – multiple-choice examinations</li>
                    <li><strong>Award</strong>: Highfield Level 2 Award</li>
                    <li><strong>SIA Licence Fee</strong>: £184</li>
                    <li><strong>SIA Licence valid for</strong>: 3 years</li>
                    <li><strong>How much you can earn?&nbsp;</strong>£10 – £15 per hour</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Accelerate your Career in Private Security with our</div><h1>SIA Approved Door Supervisor Training</h1><p>Qualify for your SIA Licence and earn up to £15 per hour in security roles within retail, corporate, hospitality, construction and other sectors.</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Qualify for your SIA Licence and earn up to £15 per hour in security roles within retail, corporate, hospitality, construction and other sectors.',
                'long_desc' => '<h2 class=mt-5>About the Door Supervisor course</h2><p>This Door Supervisor course is ideal for anyone wishing to get SIA Licence and work in the security industry as a door supervisor or security guard. The course is based on the relevant SIA specification for learning and qualifications and is supported by Skills for Security, the standards setting body for the security industry and the SIA, which regulates the private security industry.<p>The Level 2 Door Supervisor course is based on the relevant SIA specification for learning and qualifications and is supported by Skills for Security, the standards setting body for the security industry and the SIA, who regulate the private security industry.<h2 class=mt-5>Who is this course for?</h2><p>Obtaining the Level 2 Door Supervisor qualification is the first step towards getting an <a href=https://www.gov.uk/door-supervisor-licence rel="noopener noreferrer"target=_blank><strong>SIA Door Supervisor Licence</strong></a>.<p>With a valid SIA Door Supervisor Licence, you are permitted to work in a wide variety of environments, such as:<ul><li>Door Supervisor for nightclubs, bars, and restaurants,<li>Event Security,<li>Corporate Security Officer,<li>Retail Security,<li>Loss Prevention Officer,<li>and more!</ul><h2 class=mt-5>What will I learn on the course?</h2><p>The course is divided into four units and covers everything from the legal aspects of security to the latest physical intervention techniques:<details class=detailBorder><summary>Unit 1: Principles of working in the private security industry</summary><ul><li>Know the main characteristics and purposes of the Private Security Industry<li>Understand legislation as it applies to a security operative<li>Understand arrest procedures relevant to security operatives<li>Understand the importance of safe working practice<li>Understand fire procedures in the workplace<li>Understand emergencies and the importance of emergency procedures<li>Understand how to communicate effectively as a security operative<li>Understand record keeping relevant to the role of the security operative<li>Understand terror threats and the role of the security operative in the event of a threat<li>Understand how to keep vulnerable people safe<li>Understand good practice for post incident management</ul></details><details class=detailBorder><summary>Unit 2: Principles of working as a door supervisor in the private security industry</summary><ul><li>Understand crimes relevant to door supervision<li>Know how to conduct effective search procedures<li>Understand drug-misuse legislation, issues and procedures relevant to the role of a door supervisor<li>Understand preservation of evidence relevant to the role of a door supervisor<li>Understand licensing law relevant to the role of a door supervisor<li>Understand queue management and venue capacity responsibilities relevant to a door supervisor<li>Know how to use equipment relevant to a door supervisor</ul></details><details class=detailBorder><summary>Unit 3: Application of conflict management in the private security industry</summary><ul><li>Understand the principles of conflict management appropriate to the role<li>Understand how to recognise, assess and reduce risk in conflict situations<li>Understand the use of problem-solving techniques when resolving conflict<li>Be able to communicate to de-escalate conflict</ul></details><details class=detailBorder><summary>Unit 4: Application of physical intervention skills in the private security industry</summary><ul><li>Understand Physical Intervention and the legal and professional implications of their use<li>Understand the risks associated with using physical intervention<li>Understand how to reduce the risks associated with physical intervention<li>Be able to use physical skills to protect yourself and others<li>Be able to use non-pain compliant standing, holding and escorting techniques</ul></details><h2 class=mt-5>Assessment and examination</h2><p>To pass the SIA Door Supervisor course you will have to sit four multiple choice question e-assessments.<details class=detailBorder><summary>For Unit 1: Principles of working in the private security industry</summary><p>You will be expected to answer <strong>72</strong> multiple choice questions with a duration of <strong>1 hour 50 minutes</strong> and a <strong>pass mark of 51 questions</strong>.</details><details class=detailBorder><summary>For Unit 2: Principles of working as a door supervisor in the private security industry</summary><p>You will be expected to answer <strong>50</strong> multiple choice questions with a duration of <strong>1 hour 15 minutes</strong> and a <strong>pass mark of 35 questions</strong>.</details><details class=detailBorder><summary>For Unit 3: Application of conflict management in the private security industry</summary><p>You will be expected to answer <strong>20</strong> multiple choice questions with a duration of <strong>30 minutes</strong> and a <strong>pass mark of 14 questions</strong>.</details><details class=detailBorder><summary>For Unit 4: Application of physical intervention skills in the private security industry</summary><p>You will be expected to answer<strong> 30</strong> multiple choice questions with a duration of <strong>45 minutes</strong> and a pass mark of <strong>24 questions</strong>.</details><h2 class=mt-5>Examination resits</h2><p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over <strong>95%</strong>.<p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.<p><strong>Exam results</strong> will be made available on the same day.<h2 class=mt-5>Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.<p>Bookings may be made by e-mail, via the T4E website, or by telephone.<p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.<p>Placement in the course will be confirmed via E-mail by the T4E staff.<p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.<p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a><h2 class=mt-5>Door Supervisor Licence</h2><p>You must apply for a licence from the Security Industry Authority (SIA) if your job involves guarding a licensed premises.A licensed premise is any premises that is open to the public which sells alcohol or provides regulated entertainment.You do not need a door supervisor licence if your job only involves the use of CCTV equipment.<p><strong>To get your licence you:</strong><ul><li>must be at least 18 years of age<li>must pass an identity check<li>must pass a criminal record check<li>must obtain relevant emergency first aid or first aid and door supervisor qualifications</ul><strong>Integration with other licences</strong><p>People who have a door supervisor licence can also carry out other activities, for example work as security guards and keyholders.<p>You can complete you SIA licence application online or through the post. You must supply the supporting relevant documentation and pay a fee. The licence application costs £184 and is non-refundable.<p>Granted licences last for 3 years. If you pay your own licence fee, you can claim tax relief – worth £49 for basic rate tax payers.<p>If you are an employer paying an employee’s licence fee, there will be no tax or National Insurance liability. If you need more than one licence for your activities, you may be eligible for a 50% discount for the second application fee.<p><strong>Conditions</strong><p>The SIA can attach to the licence any conditions they believe to be reasonable. You must renew your licence before it expires to continue working. You can apply to renew your licence up to 4 months before your current licence expires. The SIA may authorise a person to enter your place of business or place of work (where your licensed action is undertaken) to assess your compliance with any ongoing obligations. You may also have to provide any relevant documents or information to show your compliance with any licence obligations. Learn more…',
                'vat' => '',
                'price' => 261.50,
                'duration' => '6 days',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{"1":{"answer":"The SIA Door Supervisor Course at Training for Employment is six days. This duration is structured to provide comprehensive coverage of all necessary topics, ensuring participants are well-prepared for the licensing exam and real-world applications. ","question":"What is the duration of the SIA Door Supervisor Course?"},"2":{"answer":"<p><strong>Door supervisors:</strong><br>Those who carry out security duties in or at licensed premises, like pubs and nightclubs, preventing crime and disorder and keeping staff and customers safe</p><p><strong>Security officers (guarding)</strong>:</p><p>Those who guard premises against unauthorised access or occupation, outbreaks of disorder, theft or damage</p>","question":"What is the difference between Door Supervisor and Security Guard?"},"3":{"answer":"The Training for Employment offers SIA door supervisor training in Birmingham, which only costs £261.50. This fee covers all training materials, instruction, and assessments required for completion. Considering the breadth of knowledge and practical skills imparted during the course, its a competitive price.","question":"What is the cost of the course?"},"4":{"answer":"The course covers various topics essential for door supervisors, including conflict management, physical intervention techniques, and understanding the legal framework within which door supervisors operate. It also includes practical scenarios to prepare students for real-life situations. For those looking for door supervisor courses in Birmingham, this course offers a comprehensive curriculum designed to equip participants with the necessary skills and knowledge.","question":"What topics are covered in the course?"},"5":{"answer":"No, Door Supervisor course does not include first aid training. First Aid or at least Emergency First Aid qualification should be completed before commencing with the Door Supervisor training.","question":"Is first aid training included in the course?"},"6":{"answer":"Participants must be at least 18 and possess good English language skills. It ensures that all participants can effectively communicate and comprehend the course material, which is essential for the training and subsequent professional duties. Also, all participants must hold a valid first aid qualification.","question":"What are the course prerequisites?"},"7":{"answer":"Our door supervisor course combines theoretical and practical learning methods. It includes practical scenarios, mock tests, and video recordings to enhance understanding and application of the concepts. This blend of teaching methods aims to ensure a thorough grasp of knowledge and practical skills. ","question":"What is the format of the course?"},"8":{"answer":"Certificates are usually sent to your email 3 days after successfully passed the examination .Please note, you don’t need a certificate to apply for your SIA Licence.","question":"When will I receive my certificate?"},"9":{"answer":"<p>No, the licence fee is a separate price. Payment for the license is £184.00 which is payable to the SIA (Security Industry Authority) this can be paid online on their website or at the Post Office.</p><p>Yes, our members of staff are more than happy to help you apply for your SIA badge, call to book an appointment and there will be a £20 fee.</p>","question":"Is the cost of an SIA licence included in the price of the course? And can you help me apply?"},"10":{"answer":"Three years. Once a qualification is achieved, it is then valid to use to apply for the licence for three years.","question":"How long does Door Supervisor Certificate last?"}}',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 6-day Training</h4><p>Attend a 6-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Sit and pass four multiple-choice exams and practical, scenario-based assessments.</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 18+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Qualifications:</strong> You will need to show that you hold a current and valid First Aid or Emergency First Aid certificate that meets the requirements of the Health and Safety (First Aid) Regulations 1981.The certificate certificate must be valid for at least 12 months from the course start date.</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Door Supervisor Refresher',
                'course_image' => 'CourseThumbnail/doorsupervisorrefresher.webp',
                'banner_image' => 'CourseHeaderimages/Door Supervisor Refresher.png',
                'color_code' => '#164b82',
                'category_id' => 1,
                'qualification' => 13,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 1.5 days</li>
                    <li><strong>Delivery Mode</strong>: Blended delivery</li>
                    <li><strong>Price</strong>: <strong>£156.50</strong></li>
                    <li><strong>Group discounts</strong>: available</li>
                    <li><strong>Experience</strong>: Must hold a <strong>valid SIA Door Supervisor licence&nbsp;</strong>and qualified in Emergency First Aid</li>
                    <li><strong>Assessment</strong>: Multiple-choice exams and practical demonstrations</li>
                    <li><strong>Certification</strong>: Successful candidates will receive a Highfield qualification, fully recognised by the SIA</li>
                    <li><strong>Mandatory requirement when applying for your SIA Licence</strong></li>
                    <li><strong>Award</strong>: Highfield Qualifications</li>
                    <li><strong>SIA Licence Cost:</strong> £184</li>
                    <li><strong>SIA Licence valid:</strong> for 3 years</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Door Supervisor Refresher Course Training</h1><p>As of<strong> 1st April 2025</strong>, this <strong>Refresher Course has become mandatory</strong> for all door supervisors wishing to renew their SIA licences.</p><p>Ensure you meet the new regulations by completing this course before your licence renewal.</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'As of 1st April 2025, this Refresher Course has become mandatory for all door supervisors wishing to renew their SIA licences. Ensure you meet the new regulations by completing this course before',
                'long_desc' => '<h2 class="mt-5">About the SIA Door Supervisor Refresher Course</h2>
                    <p>At Training for Employment, we provide the Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Refresher) course. This is an essential program for individuals holding a current SIA Door Supervisor licence, helping them stay up-to-date with the latest standards and requirements in the private security industry.</p>
                    <p>The refresher course covers the essential knowledge and skills needed by door supervisors in line with the latest <a href="https://www.gov.uk/guidance/find-out-if-you-need-an-sia-licence" target="_blank" rel="noopener">Security Industry Authority (SIA) requirements</a>. It includes both theoretical and practical components, ensuring that participants are fully equipped to perform their duties effectively and safely.</p>
                    <h2 class="mt-5">Who is this course for?</h2>
                    <ul>
                    <li>Current Door Supervisors who need to refresh their skills and comply with SIA updates.</li>
                    <li>Professionals seeking to ensure their knowledge is in line with new industry standards.</li>
                    </ul>
                    <h2 class="mt-5">Door Supervisor Refresher Course Contents</h2>
                    <p>This refresher course covers the following critical units:</p>
                    <p><strong>Principles of Working as a Door Supervisor in the Private Security Industry (Refresher)</strong></p>
                    <ul>
                    <li>Updated legal regulations and professional responsibilities</li>
                    <li>Effective search procedures</li>
                    <li>Safeguarding vulnerable individuals</li>
                    <li>Counterterrorism awareness (including ACT e-learning)</li>
                    <li>Tackling incidents like drink spiking</li>
                    </ul>
                    <p><strong>Application of Physical Intervention Skills in the Private Security Industry (Refresher):</strong></p>
                    <ul>
                    <li>Physical intervention techniques</li>
                    <li>Managing risk during interventions</li>
                    <li>Conflict management and handling aggressive situations safely</li>
                    <li>Health and safety best practices</li>
                    </ul>
                    <h2 class="mt-5">Assessment &amp; Examination</h2>
                    <p><strong>Theory</strong> &ndash; Multiple-choice Question (MCQ) Examination</p>
                    <ul>
                    <li>The theoretical knowledge of this course is assessed through an MCQ exam consisting of 35<strong>&nbsp;questions </strong>to be completed in <strong>55&nbsp;minutes</strong>.</li>
                    <li>The exam is conducted under exam conditions and supervised by experienced invigilators to ensure fairness and security.</li>
                    <li>To pass, <strong>learners must score at least 32 out of 40 </strong>(71%).</li>
                    </ul>
                    <p><strong>Practical &ndash; </strong>Candidates must demonstrate proficiency in physical intervention and handling conflicts.</p>
                    <p>Both the theory and practical components need to be passed to receive the certification.</p>
                    <h2 class="mt-5">Examination Resits</h2>
                    <p>We have a policy of <strong>NO PASS &ndash; NO RETAKE FEE</strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over <strong>95%.</strong></p>
                    <p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p>
                    <p>Exam results will be made available on the same day.</p>
                    <h2 class="mt-5">Booking Procedure</h2>
                    <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                    <ol>
                    <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                    <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                    <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                    <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must&hellip;&hellip;.. <a title="Booking Terms &amp; Conditions" href="' . $bookingTermsUrl . '" target="_blank" rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></li>
                    </ol>
                    <h2 class="mt-5">SIA Licence Renewal</h2>
                    <p>Your SIA licence will not renew automatically. You must renew your licence from the <a href="https://www.gov.uk/government/organisations/security-industry-authority"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</strong></a>&nbsp;if you want to keep working in the same role when your current licence expires.</p>
                    <p>You are not guaranteed a licence just because you already have one. This is because:</p>
                    <ul>
                    <li>something you have done might mean that you may no longer meet the &nbsp;<a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>) </strong></a>&nbsp;licensing requirements (for example, if you have been convicted of a relevant offence)</li>
                    <li><a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</strong></a> may have changed their licensing criteria since you have been granted your current licence</li>
                    </ul>
                    <p>You cannot renew a licence unless you have a current licence in that sector. If your licence has already expired, you must&nbsp; apply for a new licence.</p>
                    <p><strong>Background checks</strong></p>
                    <p><a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</strong></a> will carry out the same checks on new applications and renewals. This means that you will still need to prove your identity, even though you already hold a licence and have already been through the application process. You will need to confirm your identity every time you apply so that the <strong><a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener">Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</a></strong>&nbsp;can conduct relevant criminal record checks.</p>
                    <p>You may be asked to go to a UK Post Office as part of your renewal application. You can use the&nbsp; Post Office branch finder&nbsp;to find a Post Office near to you. Check that it handles SIA licence applications before you go.</p>
                    <p><strong>Renew your licence as soon as you can</strong></p>
                    <p>You can apply to renew your licence four (4) months before your current licence expires. You should submit your renewal application as soon as you can. Applying early gives us more time to process your application, which reduces the risk of you being unlicensed and unable to work.</p>
                    <p>You will not lose time on your new licence by renewing early. <a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</strong></a>&nbsp;will add any time left on your current licence onto your new one. Your new licence will be valid from the day it&rsquo;s granted.</p>
                    <p><strong>How to apply</strong></p>
                    <p>You can complete you <abbr title="Security Industry Authority">SIA</abbr> licence application for renewal online. You must supply the supporting relevant documentation and pay a fee. The licence application costs <strong>&pound;184</strong>&nbsp;and is non-refundable.</p>
                    <p>You should check with your employer before you renew your licence. They may pay your application fee on your behalf, or even submit your renewal application for you.</p>
                    <p>You will need to link your&nbsp; SIA online account&nbsp;with theirs before they can do this. They will send you an email with a request to link with their account. You do not have to agree, but they will not be able to pay for or submit your application unless you do.</p>
                    <p>The application fee for a renewal is the same as for a new licence: &pound;190.</p>
                    <p><a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank" rel="noopener"><strong>Security Industry Authority (<abbr title="Security Industry Authority">SIA</abbr>)</strong></a> may discount the application fee by 50% if all of the following are true:</p>
                    <ul>
                    <li>you already hold another licence for a different licensable activity</li>
                    <li>you paid the full application fee for that licence (so, it was not discounted)</li>
                    <li>that licence has more than 4 months left to run</li>
                    </ul>
                    <h2 class="mt-5">Why Choose Training for Employment?</h2>
                    <ul>
                    <li><strong>Expert Trainers</strong>: Our instructors are experienced professionals with extensive knowledge of the private security sector.</li>
                    <li><strong>Up-to-Date Curriculum</strong>: We ensure that our course content reflects the latest SIA guidelines, including modern e-learning options.</li>
                    <li><strong>Comprehensive Support</strong>: We provide all the resources and guidance needed to help you to successfully complete the course.</li>
                    </ul>',
                'vat' => '',
                'price' => 156.50,
                'duration' => '1.5 days',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{"1":{"answer":"The Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Refresher) course is a mandatory training program designed to refresh the skills and knowledge of licensed door supervisors. It ensures that they stay compliant with the latest industry regulations, including legal updates, conflict management, and physical intervention skills.","question":"What is the Door Supervisor Refresher Course?"},"2":{"answer":"As of 1st April 2025, the Security Industry Authority (SIA) requires all door supervisors to complete the refresher course to renew their SIA licence. This ensures you are updated with current practices, including critical areas like counterterrorism awareness, first aid, and safeguarding vulnerable individuals.","question":"Why do I need to take this refresher course?"},"3":{"answer":"Yes, this course has become mandatory for renewing your SIA Door Supervisor licence from 1st April 2025. If you are renewing your licence this refresher training must be completed.","question":"Is this course mandatory for all door supervisors?"},"4":{"answer":"The main change is the requirement for all door supervisors to complete the refresher course before renewing their licence. Without completing this course, your licence will not be renewed after 1st April 2025. The course ensures that you are compliant with updated industry standards, including new regulations on physical intervention and public safety.","question":"What are the key changes to the SIA licence renewal process?"},"5":{"answer":"<p>The course covers two key units:</p><ul><li><strong>Principles of Working as a Door Supervisor</strong>: Includes updated legal regulations, search procedures, safeguarding vulnerable individuals, counterterrorism awareness, and dealing with incidents like drink spiking.</li><li><strong>Application of Physical Intervention Skills</strong>: Practical training on handling conflicts, using physical intervention techniques, and managing risks during potentially aggressive situations.</li></ul>","question":"What topics are covered in the refresher course?"},"6":{"answer":"<p>The course duration is 1.5 days, which includes both theoretical and practical components. Assessments are conducted through:</p><ul><li>Multiple-choice exams covering theoretical knowledge.</li><li>Practical demonstrations where you must showcase your skills in physical intervention and conflict management.</li></ul>","question":"How long is the course and what are the assessments like?"},"7":{"answer":"Yes, you are required to have a valid first aid certificate, such as Emergency First Aid at Work. This certificate must be valid for at least 12 months from the start of your course.","question":"Do I need a valid first aid certificate to take the course?"},"8":{"answer":"If you wish to downgrade your licence from Door Supervisor to Security Officer, you can enrol onto the Security Guard Refresher course. The Security Guard Refresher course is only half a day and also cheaper than the Door Supervisor refresher course.","question":"What happens if I want to downgrade my licence to a Security Officer?"},"9":{"answer":"Yes, certain parts of the course, such as counterterrorism awareness (using the ACT e-learning platform) and other elements of theoretical knowledge you will be required to complete through self-study  and online modules. However, physical intervention skills must be assessed in person.","question":"Can I do any part of the training online?"}}',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 6-day Training</h4><p>Attend a 6-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Multiple-choice exams and practical demonstrations</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 18+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Qualifications:</strong> A current first aid qualification is required. Learners must provide a valid first aid certificate, such as Emergency First Aid at Work, valid for at least 12 months from the start date.</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'SIA CCTV Operator',
                'course_image' => 'CourseThumbnail/siacctvoperator.webp',
                'banner_image' => 'CourseHeaderimages/SIA CCTV Operator.png',
                'color_code' => '#164b82',
                'category_id' => 1,
                'qualification' => 2,
                'key_information' => '<ul>
                    <li><strong>Course Fee</strong>: From £201.50</li>
                    <li><strong>Duration</strong>: 3 days</li>
                    <li><strong>Delivery Mode</strong>: Blended learning</li>
                    <li><strong>Award</strong>: Highfield Level 2 Award</li>
                    <li><strong>SIA CCTV Licence Fee</strong>: £184</li>
                    <li><strong>SIA CCTV Licence valid for</strong>: 3 years</li>
                </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Become a Certified CCTV Operator with</div><h1>SIA Approved CCTV Operator, Public Surveillance Training</h1><p>Start Your Path to Success with an SIA Licence for CCTV and earn up to £15 per hour! Register to the course today and get your CCTV Operator Qualification!</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Free Resits</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Start Your Path to Success with an SIA Licence for CCTV and earn up to £15 per hour! Register to the course today and get your CCTV Operator Qualification!',
                'long_desc' => '<h2 class="mt-5">About the CCTV Operator, Public Surveillance course</h2><p>This CCTV Operator (Public Surveillance) course is tailored for those who wish to obtain a licence from the Security Industry Authority (SIA) to work as CCTV operators in public space surveillance.</p><p>The Course is based on the relevant SIA specification for learning and qualifications and is supported by Skills for Security, the standards setting body for the security industry and the SIA, who regulate the private security industry. Achieving the Level 2 CCTV Training qualification is the first step to acquiring an SIA Licence. If you want to become a CCTV operator, this Course is designed for you.</p><p>What You’ll Learn: Understanding the roles and responsibilities of a CCTV operator Operating CCTV equipment legal and regulatory requirements</p><h3>Who is this course for?</h3><p>Obtaining the Level 2 CCTV Operator qualification is the first step towards getting a <a href="https://www.gov.uk/door-supervisor-licence" target="_blank" rel="noopener noreferrer"><strong>Sia CCTV Licence</strong></a>.</p><p>With a valid SIA CCTV Operator Licence, you are permitted to work in a CCTV Control Room.</p>
                </ul><h2 class="mt-5">What will I learn on the course?</h2><p>The course is divided into two units as follows:</p><details class="detailBorder"><summary>Unit 1: Principles of working in the private security industry</summary><ul><li>Know the main characteristics and purposes of the Private Security Industry</li><li>Understand legislation as it applies to a security operative</li><li>Understand arrest procedures relevant to security operatives</li><li>Understand the importance of safe working practice</li><li>Understand fire procedures in the workplace</li><li>Understand emergencies and the importance of emergency procedures</li><li>Understand how to communicate effectively as a security operative</li><li>Understand record keeping relevant to the role of the security operative</li><li>Understand terror threats and the role of the security operative in the event of a threat</li><li>Understand how to keep vulnerable people safe</li><li>Understand good practice for post incident management</li></ul></details><details class="detailBorder"><summary>Unit 2: Principles and Practices of Working as a CCTV Operator in the Private Security Industry</summary><ul><li>Understand the purpose of surveillance (CCTV) systems and the roles and responsibilities of the control room team and other stakeholders.</li><li>Understand the different types of legislation and how they impact Public Space Surveillance (CCTV) operations.</li><li>Understand the importance of operational procedures in public space surveillance (CCTV) operations.</li><li>Understand how public space surveillance (CCTV) systems and equipment operate.</li><li>Understand surveillance techniques</li><li>Understand different types of incidents and how to respond to them.</li><li>Understand health and safety in the CCTV environment.</li><li>Demonstrate operational use of CCTV equipment.</li><li>Produce evidential documentation</li></ul></details><h2 class="mt-5">Assessment and examination</h2><p>The final exam for the CCTV Operative, Public Surveillance course will take place online at our Training Centre in Birmingham. To pass the CCTV course you will have to sit two multiple choice question examinations.</p><details class="detailBorder"><summary>For Unit 1: Principles of working in the private security industry</summary><p>You will be expected to answer <strong>72 multiple choice questions</strong> with a duration of <strong>1 hour 50 minutes</strong> and a <strong>pass mark of 51 questions</strong> .</p></details><details class="detailBorder"><summary>For Unit 2: Principles and Practices of Working as a CCTV Operator in the Private Security Industry</summary><p>You will be expected to answer <strong>40 multiple choice questions</strong> with a duration of <strong>1 hour</strong> and a <strong>pass mark of 28 questions</strong> .</p></details><h2 class="mt-5">Examination resits</h2><p>We have a policy of&nbsp; <strong>NO PASS &ndash; NO RETAKE FEE</strong> , so if you do not pass there is no charge for 2 re-takes. Our pass rate is over&nbsp; <strong>95%</strong> .</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p> <strong>Exam results</strong> will be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p><p>Bookings may be made by e-mail, via the T4E website, or by telephone.</p><p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.</p><p>Placement in the course will be confirmed via E-mail by the T4E staff.</p><p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</p><p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must read full <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer"> Booking Terms &amp; Conditions</a></p><h2 class="mt-5">SIA CCTV Licence</h2><p>You must apply for a licence from the Security Industry Authority (SIA) if you work as an operative (or supply operatives under a contract for services) who uses closed circuit television CCTV equipment to:</p><ul><li>Monitor the activities of a member of the public in a public or private place</li><li>Identify a particular person</li></ul><p>This includes the use of CCTV to record images that are viewed on non-CCTV equipment, but excludes the use of CCTV solely to identify a trespasser or protect property.</p><h4>There are 2 types of SIA licence:</h4><ul><li>a front line licence for operatives carrying out surveillance</li><li>a non-front line licence for managers, supervisors and other staff who do not carry out front line duties</li></ul><h4>To get your licence you:</h4><ul><li>must be at least 18 years of age</li><li>must pass an identity check</li><li>must pass a criminal record check</li></ul><p>For front line roles you must also hold the appropriate SIA-approved qualification.</p><h4>How to apply</h4><p>You can complete you SIA licence application online or through the post. You must supply the supporting relevant documentation and pay a fee. The licence application costs &pound;184 and is non-refundable.</p><p>Granted licences last for 3 years. If you pay your own licence fee, you can claim tax relief &ndash; worth &pound;49 for basic rate tax payers.</p><p>If you are an employer paying an employee&rsquo;s licence fee, there will be no tax or National Insurance liability. If you need more than one licence for your activities, you may be eligible for a 50% discount for the second application fee.</p><h4>Conditions</h4><p>The SIA can attach to the licence any conditions they believe to be reasonable.</p><p>You must renew your licence before it expires to continue working. You can apply to renew your licence up to 4 months before your current licence expires.</p><p>The SIA may authorise a person to enter your place of business or place of work (where your licensed action is undertaken) to assess your compliance with any ongoing obligations. You may also have to provide any relevant documents or information to show your compliance with any licence obligations.</p>',
                'vat' => '',
                'price' => 201.50,
                'duration' => '3 days',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "The CCTV Operator Training Course prepares individuals to become licensed CCTV operators, covering monitoring and operating equipment, roles and responsibilities, and legal compliance.", "question": "What is the CCTV Operator Training Course?" }, "2": { "answer": "The Course includes self-study, classroom-based and practical experience working with CCTV systems, followed by an examination.", "question": "What is included in the Course?" }, "3": { "answer": "Successful candidates will receive a High Field Level 2 CCTV Award.", "question": "What qualification will I receive upon completion?" }, "4": { "answer": "The duration of this Course is three days.", "question": "How long is the Course?" }, "5": { "answer": "Anyone +18 years old interested in becoming a licensed CCTV operator can Register, provided they meet the essential eligibility criteria set by the SIA. It is a great starting point if you’re looking for a CCTV operator course.", "question": "Who is eligible to take the Course?" }, "6": { "answer": "The CCTV Operator Public Surveillance Course includes an online self-paced e-learning component. However, it also requires three days of classroom training to complete.", "question": "Can the CCTV course be completed online?" }, "7": { "answer": "The course fee starts at £201.50, with an additional SIA licence fee of £184.", "question": "What are the costs of gaining the SIA CCTV licence?" } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 3-day Training</h4><p>Attend a 3-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Sit and pass two multiple-choice exams and practical, scenario-based assessments.</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 18+ years</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Security Guard Refresher',
                'course_image' => 'CourseThumbnail/securityguardrefresher.webp',
                'banner_image' => 'CourseHeaderimages/SIA CCTV Operator-1.png',
                'color_code' => '#164b82',
                'category_id' => 1,
                'qualification' => 14,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 3.5 hours </li>
                    <li><strong>Delivery Mode</strong>: Blended learning </li>
                    <li><strong>Award</strong>: Highfield Level 3 Award </li>
                    <li><strong>Mandatory Requirement for </strong>: SIA Licence </li>
                    <li><strong>Course Fee </strong>: from £101.50</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Ensure Your SIA Licence Stays Valid with our</div><h1>SIA Security Guard Refresher Training</h1><p>Don’t let your SIA Licence lapse—our Security Guard Refresher Course is your solution for a successful licence renewal. Take the next step in maintaining your professional status and ensuring continued employment in the security sector.</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Don’t let your SIA Licence lapse—our Security Guard Refresher Course is your solution for a successful licence renewal. Take the next step in maintaining your professional status and ensuring continued employment in the security sector.',
                'long_desc' => '<h2 class="mt-5">About the SIA Security Guard Refresher course</h2><p>From <strong>1st April 2025</strong> , this Refresher Course has <strong>become mandatory for all security officers wishing to renew their SIA licences</strong> . It is also required for those looking to downgrade their licence from a Door Supervisor to a Security Officer. Make sure you meet the new regulations by completing this course before your licence renewal.</p><p>At Training for Employment, we offer the Highfield Level 2 Award for Security Guards in the Private Security Industry (Refresher) course. This program is essential for those holding a current SIA Security Officer licence, ensuring they remain compliant with the latest industry standards and practices. The refresher course covers the critical skills and knowledge required by security officers, following the latest Security Industry Authority (SIA) regulations. It includes both theory and practical elements, ensuring that participants are fully prepared to carry out their roles effectively and safely.</p><h2 class="mt-5">Who is this course for?</h2><p>To work legally in the security industry in the UK, you must hold a valid&nbsp;SIA Licence. If your&nbsp;SIA Licence&nbsp;is about to expire, it&rsquo;s essential to renew it before it lapses. Our&nbsp;Security Guard Refresher Course&nbsp;is specifically designed to help you meet the&nbsp;SIA Licence renewal requirements, ensuring you stay compliant and continue working in the security sector without interruption.</p><p>Obtaining the Level 2 Security Guard Refresher qualification is the first step towards renewing an&nbsp;<a href="https://www.gov.uk/door-supervisor-licence">SIA Security Guard Licence&nbsp;or&nbsp;downgrading&nbsp;from&nbsp;SIA Door Supervisor licence</a>.</p><ul><li><p>Current Security Officers needing to refresh their skills and comply with SIA updates.</p></li><li><p>Door Supervisors who wish to downgrade to a Security Officer licence.</p></li><li><p>Security professionals aiming to ensure their knowledge aligns with updated industry standards.</p></li></ul><h2 class="mt-5">What will I learn on the Refresher course?</h2><p>This Security Guard Refresher course focuses on key areas essential for security officers:</p><p>Principles of Working as a Security Officer in the Private Security Industry (Refresher):</p><ul><li><p>Understanding updated legal responsibilities</p></li><li><p>Effective search procedures and documentation</p></li><li><p>Safeguarding vulnerable individuals</p></li><li><p>Counterterrorism awareness (including ACT e-learning)</p></li><li><p>Dealing with incidents, such as suspicious items and spiking</p></li></ul><p> <strong>Practical Assessment of Security Skills:</strong> </p><ul><li><p>Demonstrating search techniques for people and their property</p></li><li><p>Communication and conflict resolution strategies</p></li><li><p>Ensuring safety during physical interventions</p></li><li><p>Best practices for handling security incidents</p></li></ul><h2 class="mt-5">Assessment and examination</h2><p>To pass the SIA Security Guard Refresher course you will have to pass one multiple-choice question e-assessment and undergo a practical assessment:</p><p> <strong>Theory &ndash; Multiple-choice Question (MCQ) Examination</strong> </p><p>The theoretical knowledge of this course is assessed through an MCQ exam consisting of <strong>28 questions</strong> to be completed in <strong>45 minutes</strong> .</p><p>The exam is conducted under exam conditions and supervised by experienced invigilators to ensure fairness and security. <strong>Pass mark is 71%</strong> .</p><p> <strong>Practical Assessment</strong> </p><p>Candidates must demonstrate proficiency in conducting searches and applying safety procedures</p><p> <strong>Examination resits</strong> </p><p>We have a policy of <strong>NO PASS &ndash; NO RETAKE FEE</strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over 95%.</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p>Exam results will be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p><p>Bookings may be made by e-mail, via the T4E website, or by telephone.</p><p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.</p><p>Placement in the course will be confirmed via E-mail by the T4E staff.</p><p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</p><p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must read full <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer"> Booking Terms &amp; Conditions</a></p><h2 class="mt-5">SIA Security Licence Renewal</h2><p>According to&nbsp;<a href="https://www.gov.uk/guidance/renew-your-sia-licence">GOV.UK</a>, when you renew your SIA Licence, you must meet specific requirements to ensure your continued compliance with industry standards:</p><p> <strong>Application Process:</strong> You can apply to renew your licence up to 4 months before it expires. Ensure you apply on time to avoid any gaps in your ability to work.</p><p> <strong>Required Training:</strong> Security guards must complete a refresher course to ensure they are up-to-date with the latest regulations and practices. Our Security Guard Refresher Course fulfills this requirement and is designed to align with SIA guidelines.</p><p> <strong>Criminal Convictions:</strong> &nbsp;If you have a criminal conviction, your application for renewal may be delayed or denied. It&rsquo;s important to disclose any changes in your criminal record when renewing your licence.</p><p> <strong>Re-assessment of Competence:</strong> The SIA may assess whether you continue to meet the competence requirements based on your training and experience. By completing our SIA Security Guard Refresher Course, you ensure your skills remain relevant and meet the current standards.</p><h2 class="mt-5">How to Renew Your SIA Licence</h2><p>Here&rsquo;s how you can renew your SIA Licence through our Security Guard Refresher Course:</p><ol><li><p>Complete the Refresher Training: Enrol in our course, which covers all required elements for SIA licence renewal.</p></li><li><p>Apply Online: After successfully completing the refresher training, visit the&nbsp;SIA website&nbsp;to apply for your licence renewal. You&rsquo;ll need to submit your personal details, details of your refresher training, and any supporting documentation required.</p></li><li><p>Pay the Fee: A fee applies to renew your SIA Licence. Be sure to check the latest fee structure on the&nbsp;SIA website.</p></li><li><p>Receive Your New Licence: Once your renewal is approved, your updated SIA licence will be sent to you, allowing you to continue your work legally.</p></li></ol>',
                'vat' => '',
                'price' => 101.50,
                'duration' => '3.5 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "The Highfield Level 2 Award for Security Officers in the Private Security Industry (Refresher) course is a specialised training program aimed at updating the skills and knowledge of licensed security guards. It ensures compliance with the latest industry standards, including updates on legal responsibilities, effective search procedures, and safeguarding practices.", "question": "What is the Security Guard Refresher Course?" }, "2": { "answer": "As of 1st April 2025, the Security Industry Authority (SIA) requires all security officers to complete this refresher course to renew their SIA licence. This course ensures you remain updated with the latest industry standards, including critical areas like counterterrorism awareness, safeguarding, and responding to emergencies.", "question": "Why do I need to take the Security Guard Refresher course?" }, "3": { "answer": "Yes, this course has become mandatory for renewing your SIA Security Officer licence from 1st April 2025. It is also required if you wish to downgrade from a Door Supervisor licence to a Security Guard licence. ", "question": "Is this course mandatory for all security officers?" }, "4": { "answer": "The major change is that all security officers must complete a refresher course before renewing their licence. Without completing this course, your licence will not be renewed after 1st April 2025. The course ensures compliance with updated industry standards, including changes in legal responsibilities and practical skills.", "question": "What are the key changes to the SIA licence renewal process?" }, "5": { "answer": "<p>The course covers key areas including:</p><p> <strong>Principles of Working as a Security Officer</strong> : Updated legal knowledge, effective search procedures, safeguarding vulnerable individuals, and counterterrorism awareness.</p><p> <strong>Practical Skills Assessment</strong> : Hands-on training in search techniques, conflict management, and communication skills.</p>", "question": "What topics are covered in the Security Guard Refresher course?" }, "6": { "answer": "<p>The course includes 7 guided learning hours (3.5 hours – e-learning and 3.5 hours – face-to-face), which include self-study, ACT e-learning and in-person assessments.</p><p> <strong>The assessments consist of</strong> to test your theoretical knowledge.</p><p> <strong>Practical demonstrations&nbsp;</strong> to assess your ability to conduct searches and manage safety.</p>", "question": "How long is the course and what are the assessments like?" }, "7": { "answer": "Yes, you are required to have a valid first aid certificate, such as Emergency First Aid at Work. This certificate must be valid for at least 12 months from the start of your course.", "question": "Do I need a valid first aid certificate to take the course?" }, "8": { "answer": "If you wish to downgrade from a Door Supervisor licence to a Security Officer licence, you must complete this Security Guard Refresher course. This ensures that your knowledge and skills are updated to meet the current requirements of a Security Officer role.", "question": "What happens if I want to downgrade my licence to a Security Officer?" }, "9": { "answer": "Yes, certain parts of the course, such as counterterrorism awareness (using the ACT e-learning platform) and other elements of theoretical knowledge you will be required to complete through self-study and online modules. However, practical skills such as search techniques must be assessed in person.", "question": "Can I do any part of the training online?" } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 6-day Training</h4><p>Attend a 6-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Sit and pass four multiple-choice exams and practical, scenario-based assessments.</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 14+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Qualifications:</strong> To complete the e-learning, delegates will need internet, tablet, PC, or laptop access.</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Level 1 Health and Safety Awareness within Construction Environment',
                'course_image' => 'CourseThumbnail/level1healthandsafetyawarenesswithinconstructionenvironment.webp',
                'banner_image' => 'CourseHeaderimages/Level 1 Health and Safety Awareness within Construction Environment.png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 9,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 1 hour </li>
                    <li><strong>Delivery Mode</strong>: Online </li>
                    <li><strong>Award</strong>: Highfield Level 1 Award </li>
                    <li><strong>Course Fee </strong>: from £101.50</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Get a CSCS Green Labourer Card in no time</div><h1>Level 1 Health and Safety within a Construction Environment</h1><p>Our&nbsp; <strong>CSCS Green Labourer Card training</strong> &nbsp;is&nbsp;now offered&nbsp; <strong>online&nbsp;</strong> as a&nbsp; <strong>Level 1 Health and Safety within a Construction Environment</strong> &nbsp;online course.</p><p>Equip yourself with the essential health and safety knowledge required to work safely on construction sites. This course is specifically designed to meet the requirements for obtaining the CSCS Green Labourer Card, ensuring compliance and enhancing employability within the construction industry.</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning </li><li>Flexible, self-paced online learning</li><li>Face-to-face examination</li><li>Instant results</li></ul></div>',
                'description' => 'Our  CSCS Green Labourer Card training  is now offered  online  as a  Level 1 Health and Safety within a Construction Environment  online course.',
                'long_desc' => '<h2 class="mt-5">About the Level 1 Health and Safety within a Construction Environment Course</h2><p>The Level 1 Health and Safety within a Construction Environment course provides a comprehensive introduction to health and safety practices within construction. This Highfield-accredited course is essential for those seeking to demonstrate their knowledge and gain the CSCS Green Labourer Card. Participants will receive a Highfield Level 1 Award in Health and Safety within a Construction Environment (RQF), valid for application to the CSCS Green Labourer Card.</p><p>This course is an essential step towards obtaining your CSCS Green Labourer Card, a widely recognised certification that demonstrates your competence to work safely on construction sites.</p>
                <p>The CSCS Green Labourer Card shows that you have the necessary knowledge and skills to:</p><ul><li><p>Work safely and responsibly on a construction site.</p></li><li><p>Prove your relevant qualifications and experience for construction-related tasks.</p></li></ul><p>While the CSCS Green Labourer Card is not a legal requirement, many large contractors, as well as an increasing number of small and medium-sized contractors, require it as part of their due diligence process. Without the CSCS Green Card, you may be prevented from working on most construction sites.</p><h2 class="mt-5">Who is this Course For?</h2><p> <strong>Designated Premises Supervisors (DPS)</strong> : This course is ideal for:</p><ul><li><p><strong>Construction Workers</strong>: Ensures safety compliance on-site.</p></li><li><p><strong>Labourers</strong>: Gain the CSCS Green Labourer Card.</p></li><li><p><strong>Site Supervisors and Managers</strong>: Enhance team safety knowledge.</p></li></ul><h2 class="mt-5">What will I learn on the course?</h2><p>This course ensures a strong foundation in construction site safety, including:</p><ul><li><p>Understanding health and safety responsibilities</p></li><li><p>Identifying and managing workplace hazards</p></li><li><p>Conducting risk assessments</p></li><li><p>Using Personal Protective Equipment (PPE) effectively</p></li><li><p>Best practices for working at heights</p></li><li><p>Fire safety and emergency procedures</p></li><li><p>Safe manual handling techniques</p></li><li><p>Understanding hazardous substances (COSHH)</p></li></ul><p>The course is delivered online with a flexible, self-paced structure, culminating in a face-to-face examination.</p><h2 class="mt-5">Interactive Learning Features</h2><ul><li><p>Interactive Exercises: Keep learners and employees engaged with hands-on activities.</p></li><li><p>Expertly Written Content: Developed by industry and subject matter professionals.</p></li><li><p>Compelling Imagery: Visual references enhance understanding and retention.</p></li><li><p>Bite-Sized Modules: Delivered in manageable chunks to suit all learners.</p></li><li><p>Quizzes and Assessments: Knowledge checks throughout the course help learners stay on track.</p></li></ul><h2 class="mt-5">Assessment and examination</h2><ul><li><p>Assessment: 40 multiple-choice questions in a 60-minute exam</p></li><li><p>Certification: Highfield Level 1 Award in Health and Safety within a Construction Environment (RQF)</p></li></ul><p>To achieve the Level 1 Award in Health and Safety within a Construction Environment (RQF) qualification (required to obtain a CSCS card), candidates must attend the face-to-face examination to complete their certification after completing the e-learning. This exam is not included with this online training and must be arranged separately.</p><h2 class="mt-5">Examination resits</h2><p>If you do not pass on your first attempt, resits are available <strong>every Thursday at 11 am</strong> . A <strong>resit fee of &pound;50</strong> applies.</p><p>Exam resit results will be made available on the same day.</p><h2 class="mt-5">Certification</h2><p>Upon successfully passing the online learniing and face-to-face examination, learners will be awarded a <strong>Highfield Level 1 Award in Health and Safety within a Construction Environment (RQF)</strong> , which is required to apply for the <strong>CSCS Green</strong>  <strong>Labourer Card</strong> . This certification proves that you meet the necessary health and safety standards expected by employers and contractors.</p><h2 class="mt-5">Refund</h2><p>Our courses are designed to make your learning process straightforward. Refund policies include:</p><ul><li><p>Full refund for cancellations within 24 hours of booking.</p></li><li><p>Non-refundable after 24 hours unless cancellation is due to exceptional circumstances.</p></li></ul><p>Late attendance or failure to complete the course may result in loss of fees and course placement ... <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></p><h2 class="mt-5">Steps to Obtain CSCS Green Labourer’s Card</h2><p><span style="text-decoration: underline;"><strong>Step 1: Complete the Required Training</strong></span></p><ul><li><p>Enrol in and complete the Level 1 Health and Safety within a Construction Environment course.</p></li><li><p>This course provides the necessary health and safety knowledge for working on construction sites.</p></li><li><p>Ensure you pass the required assessment to earn your Highfield Level 1 Award in Health and Safety within a Construction Environment (RQF).</p></li></ul><p><span style="text-decoration: underline;"><strong>Step 2: Pass the CITB Health, Safety, and Environment Test</strong></span></p><p>Book the <strong>CITB Health, Safety, and Environment Test (HS&amp;E)</strong> for operatives.</p><ul><li><p>The test assesses your understanding of health and safety practices relevant to construction work.</p></li><li><p>You can book the test online via the <strong>CITB website</strong> or by calling their customer services.</p></li></ul><p>Attend the test at your chosen test center and pass.</p><p><span style="text-decoration: underline;"><strong>Step 3: Apply for the CSCS Green Labourer Card</strong></span></p><p>Visit the CSCS official website to apply for the Green Labourer Card.</p><p>Prepare the following documents:</p><ul><li><p>Proof of your <strong>Highfield Level 1 Award</strong> .</p></li><li><p>A valid <strong>CITB Health, Safety, and Environment Test pass certificate</strong> (dated within the last 2 years).</p></li><li><p>Personal identification (e.g., passport or driving license).</p></li></ul><p>Pay the required application fee (typically around &pound;36).</p><p><span style="text-decoration: underline;"><strong>Step 4: Receive Your Card</strong></span></p><p>After submitting your application, your CSCS Green Labourer Card will be processed and delivered to your address within a few weeks.</p>',
                'vat' => '',
                'price' => 101.50,
                'duration' => '1 hour',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "Yes, the course is certified by Highfield Qualifications.", "question": "Is the Level 1 Health and Safety within a Construction Environment course accredited?" }, "2": { "answer": "The e-learning module requires 4-6 hours, followed by a 1 hour face-to-face exam at our training centre.", "question": "What is the duration of the course?" }, "3": { "answer": "There are no formal entry requirements for the Health and Safety Awareness Online Course. It is suitable for anyone new to the construction industry or those seeking the CSCS Green Labourer Card.", "question": "What qualifications do I need before taking this course? " }, "4": { "answer": "Unfortunately, no. Only the e-learning can be completed at home. The e-learning module requires 4-6 hours. You can access the materials 24/7 and study at your own pace. Once you have passed the e-learning module, you then book your exam at our centre. This assessment is a multiple-choice exam with 40 questions, to be completed in 60 minutes. It takes place under exam conditions at our training centre, supervised by experienced invigilators and you will be notified immediately of your results.", "question": "Can I complete the course entirely online?" }, "5": { "answer": "The certification is valid indefinitely for the purpose of applying for the CSCS Green Labourer Card.", "question": "How long is the certificate valid for?" }, "6": { "answer": "If you don’t pass the exam on your first attempt, resits are available every Thursday at 11 am (must be booked in advance) . A resit fee of £50 applies.", "question": "What happens if I don’t pass the exam?" }, "7": { "answer": "Certificates are issued within 3-7 working days of completing the exam.", "question": "How soon will I receive my certificate?" } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Online Learning</h4><p>Complete e-learning modules at your own pace to build foundational knowledge.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Face-to-Face Examination</h4><p>Attend a scheduled exam session to validate your understanding.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Certification</h4><p>Receive your Highfield Level 1 Award and become eligible for the CSCS Green Labourer Card.</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                    <p class="m-0"><strong>Age Requirement:</strong> 16+ years</p>
                </li>
                <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                    <p class="m-0"><strong>Qualifications:</strong> Internet access for online learning</p>
                </li>
            </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Health and Safety Awareness - HSA',
                'course_image' => 'CourseThumbnail/healthandsafetyawarenesshsa.webp',
                'banner_image' => 'CourseHeaderimages/Health and Safety Awareness (HSA).png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 15,
                'key_information' => '
                    <ul>
                    <li><strong>Duration</strong>: 1 day</li>
                    <li><strong>Location</strong>: Birmingham, B19 3NY</li>
                    <li><strong>Delivery Mode</strong>: Face-to-face</li>
                    <li><strong>Price</strong>: <strong>£147.50 </strong>the price includes Revision Book (including app)</li>
                    <li><strong>Group discounts</strong>: available</li>
                    <li><strong>Experience</strong>: Any experience</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Mandatory requirement when applying for your CSCS Labourer Card </strong></li>
                    <li><strong>Award</strong>: CITB Certificate</li>
                    <li><strong>Additional Costs </strong>: <a href="https://www.citb.co.uk/courses-and-qualifications/health-safety-and-environment-hse-test-and-cards/book-a-test/" target="_blank" rel="noopener">CSCS Touch screen test – £22.50</a>, CSCS Labourer Card – £36</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>CSCS Labourer (Green Card) training – Health and Safety Awareness (HSA)</h1><p>CSCS Labourer (Green Card) training – Health and Safety Awareness (HSA) is ideal for individuals who wish to qualify for CSCS Green Labourer card.</p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'CSCS Labourer (Green Card) training – Health and Safety Awareness (HSA) is ideal for individuals who wish to qualify for CSCS Green Labourer card.',
                'long_desc' => '<p>The CSCS Green Labourer Card is a sign of recognition that you have the necessary knowledge and skills to work safely and responsibly on a construction site. It also shows that you have the relevant qualifications and experience to do the job.</p>
                    <p>It is not a legal requirement to hold a CSCS Green Labourer card, but most large contractors and an increasing percentage of small and medium contractors require it for due diligence. Without it, you won’t be allowed to perform work on the construction site.</p>
                    <h2 class="mt-5">Course Delivery Methods</h2>
                    <p>This one-day Health and Safety Awareness (HSA) course is delivered face to face or via Virtual clarroom.</p>
                    <p><strong>Face to face Delivery</strong></p>
                    <p>The face to face course delivery method is a traditional one. The contact between the instructor and learners is in a physical classroom at our training center in Birmingham, Newtown.</p>
                    <p><strong>Training at the Client’s Site</strong></p>
                    <p>We also offer on-site training, bringing our courses directly to your location.</p>
                    <h2 class="mt-5">About the CSCS Labourer (Green Card) training - Health and Safety Awareness (HSA) Course</h2>
                    <p>This one-day Health and Safety Awareness (HSA) course highlights potential hazards when working on site and provides practical advice on keeping yourself and your colleagues safe. It covers your individual and employer’s responsibilities, including what you can do if you think anyone’s health and safety is being put at risk.
                    This course provides health and safety awareness and is endorsed by Build UK as standard training for all operatives on site.</p>
                    <p>The course is essential for those wishing to obtain an industry Green site card and is equivalent to QCF Level 1 Award in Health and Safety in a Construction Environment course.</p>
                    <p>This is a one-day course. Delegates are required to complete the full day to be eligible for certification.</p>
                    <h2 class="mt-5">Topics Covered</h2>
                    <ul>
                    <li>The need to prevent accidents</li>
                    <li>Health and Safety law</li>
                    <li>How your role fits into the control and management of the site</li>
                    <li>Risk assessments and method statements</li>
                    <li>How your role fits into the control and management of the site</li>
                    <li>Performing safely and asking for advice</li>
                    <li>How to report unsafe acts to prevent an accident</li>
                    </ul>
                    <h2 class="mt-5">Assessment & Examination</h2>
                    <p>Assessment will be by an end of the course examination. The delegate must pass the exam in order to achieve certification for this course.</p>
                    <p><strong>Examination</strong></p>
                    <p>The question paper consists of <strong>25 multiple-choice questions</strong>: 20 questions are worth one mark each and 5 questions are worth two marks each.</p>
                    <p>The delegates must obtain 25 marks out of 30 (<strong>83%</strong>) or more in order to pass the examination.</p>
                    <p><strong>The examination lasts 30 minutes and must be completed within this time</strong>.</p>
                    <p>This is a closed book exam.</p>
                    <h2 class="mt-5">Examination Resits</h2>
                    <p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over <strong>95%</strong>.</p>
                    <p>If a delegate is unsuccessful in achieving 25 marks out of 30 (83%) it results in a fail.</p>
                    <p>The delegate may re-sit the multiple-choice examination free of charge.</p>
                    <p>The examination can either be retaken on the same day or the delegate can attend another course within a 90 day period (the delegate is not obliged to re-sit the day’s course).</p>
                    <p><span style=color:#930><strong>However, when a delegate scores 18 marks out of 30 (60%) or less in the examination, the delegate must book and attend the entire HSA course again before they are allowed to re-sit the examination. The standard course fee applies.</strong></span></p>
                    <h2 class="mt-5">Certification</h2>
                    <p>Certification for this course is valid for <strong>5 years</strong>. To remain certified in this area, you will need to retake the course before the expiry date.</p>
                    <h2 class="mt-5">Booking Procedure</h2>
                    <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                    <ol>
                    <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                    <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                    <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                    <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></li>
                    </ol>
                    <h2 class="mt-5">Enrolment and Finance Options Available</h2>
                    <p>If you’re funding your studies yourself then we have three payment options available, detailed below:</p>
                    <ol>
                    <li>Payment in Full: If your budget allows, you can make your payment in full and start your studies knowing the cost of your course is complete. The course fee £<span>147.50 </span>includes examination fees, full instruction, and exam resit.</li>
                    <li>Deposit Payment: To reserve and guarantee your place on the course you will need to pay a deposit fee of £80 and the remaining balance of £67.50.</li>
                    </ol>
                    <h2 class="mt-5">CITB Health, safety and environment (HS&E)</h2>
                    <p>In addition to the above, you will need to complete a <a href="https://wsr.pearsonvue.com/testtaker/signin/SignInPage/CITB" target="_blank" rel="noopener noreferrer"><strong>CITB Health, Safety and Environment</strong>&nbsp;<strong>touch screen test (known as the CSCS Test)</strong></a>. The test takes 45 mins, it is multiple choice. With the two certificates, you can then apply for your card.</p>
                    <p>The <strong>CITB Health, safety and environment (HS&amp;E)</strong> test is an important way for construction workers to show that they can be safe on the job. It’s also a way for them to know that their fellow workers are as safe on the site and not put them at risk of injury.</p>
                    <p>The Operatives test ensures workers have a minimum level of health, safety and environmental awareness before going on site. This test covers the five core knowledge areas.</p>
                    <p>The HS&amp;E test is made up of 50 questions covering five core knowledge areas:</p>
                    <ul>
                    <li>legal and management</li>
                    <li>health and welfare</li>
                    <li>general safety</li>
                    <li>high risk activities</li>
                    <li>environment</li>
                    </ul>
                    <p>The pass mark for the Operatives test is 90%. To pass, you need to answer at least 45 out of 50 questions correctly.</p>
                    <p>You can <strong><a class="external" title="Book a test" href="https://www.citb.co.uk/courses-and-qualifications/health-safety-and-environment-hse-test-and-cards/book-a-test/" target="_blank" rel="noopener">book and pay for the test online</a></strong> or over the phone</p>',
                'vat' => '',
                'price' => 147.50,
                'duration' => '1 Day',
                'awarding_bodies' => '2',
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{
                    "1": {
                        "answer": "<p><a href=\"https://www.cscs.uk.com/card-type/labourer/\" target=\"_blank\" rel=\"noopener\"><strong>The Labourer Card</strong></a> is designed for construction workers who have been employed to carry out various manual labour jobs on construction sites. It allows the workers to perform entry-level tasks on construction sites.</p>",
                        "question": "Who needs a Labourer/CSCS green card?"
                    },
                    "2": {
                        "answer": "<p><a href=\"https://www.cscs.uk.com/card-type/labourer/\" target=\"_blank\" rel=\"noopener\"><strong>The Labourer Card</strong></a> confirms that the cardholder possesses the minimum required qualifications to work on the construction site and is competent with basic health and safety. While CSCS Cards are not legally required on all construction sites, the vast majority of employers do require them in order to allow workers on site.</p>",
                        "question": "What does a Labourer card do?"
                    },
                    "3": {
                        "answer": "<p>In order to apply for your green <a href=\"https://www.cscs.uk.com/card-type/labourer/\" target=\"_blank\" rel=\"noopener\"><strong>Labourer Card</strong></a> you must be 16+ years old and have certain qualifications:</p><ul><li>You must have passed the <a href=\"https://www.citb.co.uk/courses-and-qualifications/hse-test-and-cards/\" target=\"_blank\" rel=\"noopener\"><strong>CITB Health, Safety and Environment test</strong></a> within the past two years.</li><li>Complete the <strong><a href=\"https://training4employment.co.uk/courses/health-and-safety-awareness-course\" target=\"_blank\" rel=\"noopener\">CSCS Labourer (Green Card) training – Health and Safety Awareness (HSA)</a></strong> or an alternative qualification that CSCS accept. Also, you will need to attend a refresher course every 3 or 5 years.</li></ul>",
                        "question": "What are the green CSCS card requirements?"
                    },
                    "4": {
                        "answer": "Unfortunately, the course fee does not cover the expenses of the Touchscreen test and CSCS card.",
                        "question": "Is the cost of CSCS Card included into the course fee?"
                    },
                    "5": {
                        "answer": "<p>If you wish to apply for your CSCS card, we recommend using the <a href=\"http://www.cscsonline.uk.com/login\" target=\"_blank\" rel=\"noopener\">online service</a>. It’s quick, easy and available when you need it.</p><p>If you do not have an online account, then please contact CSCS on 0344 994 4777 (8am to 6pm, Monday to Friday).</p>",
                        "question": "How to Apply for CSCS Card?"
                    }
                    }',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'SSSTS – Site Supervision Safety',
                'course_image' => 'CourseThumbnail/ssstssitesupervisionsafety.webp',
                'banner_image' => 'CourseHeaderimages/SSSTS – Site Supervision Safety.png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 16,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 2 days</li>
                    <li><strong>Location</strong>: Nationwide</li>
                    <li><strong>Delivery Mode</strong>: On-Site</li>
                    <li><strong>Group Size</strong>: 8 – 12 people</li>
                    <li><strong>Experience</strong>: Any experience</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Award</strong>: CITB Certificate</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">CITB Site Safety Plus Training Scheme</div><h1>SSSTS – Site supervision safety training scheme</h1><p>This two-day Site Supervision Safety Training Scheme (SSSTS) course covers all relevant legislation and other aspects which affect safe working in the building, construction and civil engineering industries. It highlights the need for risk assessment in the workplace, the implementation of the necessary control measures, and adequate communication to sustain a health and safety culture among the workforce.</p></div>',
                'description' => 'This two-day Site Supervision Safety Training Scheme (SSSTS) course covers all relevant legislation and other aspects which affect safe working in the building, construction and civil engineering industries. It highlights the need for risk assessment in the workplace, the implementation of the necessary control measures, and adequate communication to sustain a health and safety culture among the workforce.',
                'long_desc' => '<h2 class="mt-5">About the Course</h2>
                    <p>This two-day Site Supervision Safety Training Scheme (SSSTS) course covers all relevant legislation and other aspects which affect safe working in the building, construction and civil engineering industries. It highlights the need for risk assessment in the workplace, the implementation of the necessary control measures, and adequate communication to sustain a health and safety culture among the workforce.</p>
                    <p>The SSSTS course is endorsed by Build UK and exceeds the standard set by CITB for construction supervisors training.</p>
                    <p><strong>Aims</strong></p>
                    <p>The aim of the SSSTS Course is to help site supervisors to:</p>
                    <ul>
                        <li>Supervise health and safety on site in accordance with current legal provisions and within the context of their role</li>
                        <li>Develop an understanding of responsibility and accountability for site health, safety and welfare of workers on site</li>
                        <li>Recognise that a safe site is efficient, economical, productive and environmentally friendly.</li>
                        <li>To ensure the individual health and safety responsibilities of the worker are understood</li>.
                    </ul>

                    <h2 class="mt-5">Who is this qualification for?</h2>

                    <p>The Site Supervision Safety Training Scheme (SSSTS) course is designed for those who have, or are about to acquire, supervisory responsibilities. The key takeaway from this classroom based course is that safety is an integral part of effective site supervision.</p>

                    <h2 class="mt-5">Course Structure and Content</h2>

                    <p>The SSSTS Course Covers the following areas:</p>
                    <p><strong>Module 1:</strong></p>
                    <ul>
                    <li>Health and safety law and how it applies to supervisors</li>
                    <li>Construction (Design and Management) Regulations 2015 (CDM)</li>
                    <li>Health and safety management systems</li>
                    <li>Risk assessments and method statements</li>
                    <li>Statutory inspections and checks</li>
                    <li>Reporting accidents, injuries and ill health</li>
                    <li>Leadership and worker engagement</li>
                    </ul>

                    <p><strong>Module 2:</strong></p>
                    <ul>
                    <li>Health and welfare of the workforce</li>
                    <li>First aid and emergency procedures</li>
                    <li>Hazardous substances</li>
                    <li>Asbestos</li>
                    <li>Dust and fumes</li>
                    <li>Noise and vibration</li>
                    <li>Manual handling</li>
                    </ul>

                    <p><strong>Module 3:</strong></p>
                    <ul>
                    <li>Site set up and security</li>
                    <li>Fire prevention and control</li>
                    <li>Electricity</li>
                    <li>Plant and work equipment</li>
                    <li>Lifting operations and lifting equipment</li>
                    </ul>

                    <p><strong>Module 4:</strong></p>
                    <ul>
                    <li>Working at height</li>
                    <li>Excavations</li>
                    <li>Underground and overhead services</li>
                    <li>Confined spaces</li>
                    <li>Temporary works</li>
                    </ul>

                    <p><strong>Module 5:</strong></p>
                    <ul>
                    <li>Environmental awareness</li>
                    <li>Pollution</li>
                    <li>Waste materials</li>
                    <li>Nuisance</li>
                    </ul>
                    <p>There will be an assessment at the end of course and the trainer review.</p>

                    <p>All delegates must pass the exam and pass all three elements of the trainer review:</p>
                    <ol>
                    <li>Candidate performance in group exercises</li>
                    <li>Candidate engagement – providing answers/suggestions during the course.</li>
                    <li>Toolbox talk completion – the candidate must prepare and deliver a 5-minute toolbox talk.</li>
                    </ol>

                    <h2 class="mt-5">Examination</h2>

                    <p>The examination paper is compulsory and consists of <strong>25 questions</strong>, selected by CITB, covering all aspects of the course.</p>
                    <p>The examination pass mark is <strong>80%</strong> (24 out of 30).</p>
                    <p>The paper consists of 22 multiple choice questions and three short written questions. There are four safety critical questions in each exam paper. The delegate must answer all four of these questions correctly to pass the exam. The multiple-choice questions are worth 1 point each, whereas written questions can score between 1-3 marks.</p>
                    <p>The exam paper forms part of the overall assessment of whether a delegate has successfully achieved a satisfactory level of understanding to be awarded the Site supervision safety training scheme (SSSTS) certificate.</p>
                    <p><strong>The examination lasts for 30 minutes and must be completed within this time</strong>.</p>
                    <p>Delegates are permitted to use the Construction site supervision (GE706) publication for the last ten minutes of the examination period.</p>

                    <h2 class="mt-5">Certification</h2>

                    <p>Certification for this course is valid for <strong>5 years</strong>. To remain certified in this area, you will need to retake the course before the expiry date.</p>

                    <h2 class="mt-5">Resits</h2>

                    <p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over <strong>95%</strong>.</p>
                    <p>Where a delegate has passed the trainer’s review and gained between <strong>70%–77%</strong> (21, 22 or 23 out of 30) in the examination or has achieved the <strong>80%</strong> pass rate but failed the safety critical questions, the delegate may re-sit the examination.</p>
                    <p>This can either be on the same day or by resitting the exam by attending another course on the final day within a 90-day period (the delegate is not obliged to re-do the day’s course).</p>
                    <p>Should a delegate fail the re-sit, they will be offered to take the SSSTS course again.<br>When a delegate scores less than <strong>67%</strong> (20 correct answers out of 30) in the final examination,</p>
                    <p><strong>Exam results</strong> will be made available within 7 to 14 working days.</p>

                    <h2 class="mt-5">Booking Procedure</h2>

                    <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                    <ol>
                    <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                    <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                    <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                    <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a href="<?php echo $bookingTerms; ?>" target="_blank" rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></li>
                    </ol>

                    <h2 class="mt-5">Enrolment and Finance Options Available</h2>

                    <p>If you’re funding your studies yourself then we have three payment options available, detailed below:</p>
                    <p><strong>Payment in Full</strong>: If your budget allows, you can make your payment in full and start your studies knowing the cost of your course is complete. The course fee includes examination fees, full instruction, and exam resit.</p>
                    <p><strong>Deposit Payment</strong>: To reserve and guarantee your place on the course you will need to pay a deposit fee of £50 and the remaining balance prior the course start date.</p>',
                'vat' => '',
                'price' => 0,
                'duration' => '2 days',
                'awarding_bodies' => 2,
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'SSSTS Refresher',
                'course_image' => 'CourseThumbnail/ssstsrefresher.webp',
                'banner_image' => 'CourseHeaderimages/SSSTS Refresher.png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 17,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 1 day</li>
                    <li><strong>Location</strong>: Nationwide</li>
                    <li><strong>Delivery Mode</strong>: On-site</li>
                    <li><strong>Group Size</strong>: 8 – 12 people</li>
                    <li><strong>Experience</strong>: A valid SSSTS certificate gained in the last five years. You must take this course before your certificate expires</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Award</strong>: CITB Certificate</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">CITB Site Safety Plus Training Scheme</div><h1>SSSTS-R – Site Supervision Safety Training Scheme – Refresher</h1></div>',
                'description' => 'Accredited by the Construction Industry Training Board (CITB), this one day SSSTS Refresher course enables site supervisors to refresh their skills, update their knowledge, and keep their professional qualifications valid. The SSSTS refresher course provides candidates with an updated understanding of the relevant health, safety, welfare, environmental, and legal issues, including any legislation changes that affect their role and workplace.',
                'long_desc' => '<h2 class="mt-5">About the Course</h2>
                    <p>Accredited by the Construction Industry Training Board (CITB), this one day SSSTS Refresher course enables site supervisors to refresh their skills, update their knowledge, and keep their professional qualifications valid. The SSSTS refresher course provides candidates with an updated understanding of the relevant health, safety, welfare, environmental, and legal issues, including any legislation changes that affect their role and workplace.</p>
                    <p>The CITB SSSTS refresher course is suitable for site managers, agents, and other construction industry professionals who have gained&nbsp;<span><a href="https://www.phoenixhsc.co.uk/construction-courses/site-supervisors-safety-training-scheme-sssts" target="_blank" rel="noopener">SSSTS accreditation</a></span>&nbsp;in the past five years.</p>
                    <h2 class="mt-5">Who is this qualification for?</h2>
                    <p>The SSSTS refresher course is only for delegates who have previously passed the <a href="'.route('course.show', 'sssts-site-supervision-safety').'" target="_blank" rel="noopener noreferrer">two-day Site Supervision Safety training scheme (SSSTS) course</a> and can provide proof of successful attendance and a copy of their certificate. If an individual cannot be located on the system and no evidence of their certificate can be found, they will have to attend the full <a href="'.route('course.show', 'sssts-site-supervision-safety').'" target="_blank" rel="noopener noreferrer">Site Supervision Safety training scheme (SSSTS) course</a>.</p>
                    <h2 class="mt-5">Course Structure and Content</h2>
                    <p>At the end of the course, you will have an understanding of:</p>
                    <ul>
                    <li>Health and safety law and how it applies to supervisors</li>
                    <li>The Health and Safety at Work Act and HSE regulations</li>
                    <li>Control measures and risk assessments</li>
                    <li>Legal responsibilities of site supervisors</li>
                    <li>Specific site issues that challenge supervisors daily</li>
                    <li>Effective toolbox talks (a short presentation on a specific area of health and safety, presented by the candidates)</li>
                    <li>Supervision of occupational health</li>
                    <li>Behavioural safety</li>
                    <li>Enhanced awareness of site health and safety issues</li>
                    <li>Improved knowledge of any recent construction legislation developments — plus health, safety, welfare and environmental issues</li>
                    <li>Identify measures that will assist in the practical implementation of their responsibilities, as established by new legislation and changing working practices</li>
                    <li>Gain a better understanding of health and safety risks</li>
                    <li>Demonstrate and apply the principles of safe workplace practices</li>
                    <li>Understand the principles behind a risk assessment</li>
                    <li>Conduct a thorough risk assessment</li>
                    </ul>
                    <p>The refresher course includes two assessments:</p>
                    <ul>
                    <li>A multiple-choice examination paper</li>
                    <li>Continuous assessment during exercises</li>
                    </ul>
                    <h2 class="mt-5">Examination</h2>
                    <p>The examination paper is compulsory and consists of <strong>25 questions</strong>, selected by CITB, covering all aspects of the course.</p>
                    <p>The examination pass mark is <strong>80%</strong> (24 out of 30). The paper consists of 22 multiple choice questions and three short written questions. There are four safety critical questions in each exam paper.</p>
                    <p>The delegate <strong>must answer all four</strong> of these questions correctly to pass the exam. The multiple choice questions are worth 1 point each, whereas written questions can score between 1-3 marks.</p>
                    <p>The exam paper forms the basis of assessment of whether or not a delegate has successfully achieved a satisfactory level of understanding to be awarded the Site supervision safety training scheme refresher (SSSTS-R) certificate.</p>
                    <p><strong>The examination lasts for 30 minutes and must be completed within this time.</strong></p>
                    <p>Delegates are permitted to use the Construction site supervision (GE706) publication for the last ten minutes of the examination period.</p>
                    <h2 class="mt-5">Certification</h2>
                    <p>Certification for this course is valid for <strong>5 years</strong>. To remain certified in this area, you will need to retake the course before the expiry date.</p>
                    <h2 class="mt-5">Resits</h2>
                    <p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over <strong>95%</strong>.</p>
                    <p>Where a delegate has achieved between 70%–77% (21, 22 or 23 out of 30) in the examination or has achieved the 80% pass rate but failed the safety critical questions, the delegate may re-sit the examination. This can either be on the same day or by resitting the exam by attending another course on the final day within a 90 day period (the delegate is not obliged to re-do the day’s course).</p>
                    <p><span><strong>Exam results</strong></span> will be made available within 7 to 14 working days.</p>
                    <h2 class="mt-5">Booking Procedure</h2>
                    <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                    <ol>
                    <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                    <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                    <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                    <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a href="' . $bookingTermsUrl . '" target="_blank" rel="noopener noreferrer" title="Booking Terms &amp; Conditions">read full Booking Terms &amp; Conditions</a></li>
                    </ol>
                    <h2 class="mt-5">Enrolment and Finance Options Available</h2>
                    <p>If you’re funding your studies yourself then we have three payment options available, detailed below:</p>
                    <p><strong>Payment in Full</strong>: If your budget allows, you can make your payment in full and start your studies knowing the cost of your course is complete. The course fee includes examination fees, full instruction, and exam resit.</p>
                    <p><strong>Deposit Payment</strong>: To reserve and guarantee your place on the course you will need to pay a deposit fee of £50 and the remaining balance prior the course start date.</p>',
                'vat' => '',
                'price' => 0,
                'duration' => '1 days',
                'awarding_bodies' => 2,
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'SMSTS – Site Management Safety',
                'course_image' => 'CourseThumbnail/smstssitemanagementsafety.webp',
                'banner_image' => 'CourseHeaderimages/SMSTS – Site Management Safety.png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 18,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 5 days</li>
                    <li><strong>Location</strong>: Nationwide</li>
                    <li><strong>Delivery Mode</strong>: On-site</li>
                    <li><strong>Group Size: </strong>8-12 people</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Award</strong>: CITB Certificate</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">CITB Site Safety Plus Training Scheme</div><h1>SMSTS – Site management safety training scheme</h1></div>',
                'description' => 'This five-day site management course covers the core health and safety issues involved in construction. It aims to provide candidates with a comprehensive understanding of how to identify and manage workplace hazards. Many candidates take the SMSTS course to build upon their existing knowledge and advance their careers in construction.',
                'long_desc' => '<h2 class="mt-5">About the Course</h2>
                        <p>This five-day site management course covers the core health and safety issues involved in construction. It aims to provide candidates with a comprehensive understanding of how to identify and manage workplace hazards. Many candidates take the SMSTS course to build upon their existing knowledge and advance their careers in construction.</p>
                        <p><strong>At the end of the course you will have an understanding of:</strong></p>
                        <ul>
                        <li>The Health and Safety at Work Act and CDM Regulations 2015</li>
                        <li>Site set-up</li>
                        <li>Risk assessments and method statements</li>
                        <li>Working at height</li>
                        <li>The health and safety implications of working with scaffolding, electricity, excavations, demolition, and confined spaces</li>
                        <li>Any recent changes in accepted working practices and behavioural safety</li>
                        <li>Changes in accepted working practices</li>
                        </ul>
                        <h2 class="mt-5">Who is this qualification for?</h2>
                        <p>The Site Managers’ Safety Training Scheme (SMSTS) course is ideal for anyone currently responsible for planning, organizing, controlling, monitoring and administering groups of workers on construction sites. If you are preparing to move into such a role, the course also acts as a great starting point.</p>
                        <h2 class="mt-5">Course Structure and Content</h2>
                        <p>The SMSTS course contents and divided into 4 modules that will cover the following areas:</p>
                        <ul>
                        <li>Managing on-site safety in accordance with the law</li>
                        <li>Managing on-site safety in the context of your management or supervisory role</li>
                        <li>Developing an understanding of your responsibilities for site health, safety, and welfare</li>
                        <li>Recognising that a safe site is efficient, economical, and productive</li>
                        </ul>
                        <p>At the end of the training programme, you will able to:</p>
                        <ul>
                        <li>Understand all health, safety, welfare, and environmental legislation that affects your daily work</li>
                        <li>Implement new guidance and industry best practices</li>
                        <li>State your duties and responsibilities with regards to health, safety, welfare, and the environment</li>
                        </ul>
                        <h2 class="mt-5">Examination</h2>
                        <p>The paper consists of <strong>25 questions</strong>, covering all aspects of the course.</p>
                        <p>The exam must be taken at the end of the course.</p>
                        <p>Each exam paper has:</p>
                        <ul>
                        <li>18 multiple choice questions (each worth one mark)</li>
                        <li>7 questions in multi-response or short written answer format (each worth two marks).&nbsp;The two mark questions all relate to the seven health and safety focus areas.</li>
                        </ul>
                        <p>The higher marks recognise and reward the increased complexity of the question and response required.</p>
                        <p>The exam pass mark is <strong>81%</strong> (26 out of 32).</p>
                        <p>The exam lasts for 35 minutes and must be completed within this time under exam conditions.</p>
                        <p>Delegates are permitted to use the Construction site safety – The comprehensive guide (GE700) publication and the Construction site management delegate workbook (XA6) for the last 15 minutes of the exam.</p>
                        <h2 class="mt-5">Certification</h2>
                        <p>SMSTS training certificates are valid for <strong>5 years</strong>. However, due to changes in technology, the law, environmental management, and cultural behaviour, it is recommended that you take the SMSTS Refresher Course within <strong>three years</strong>.</p>
                        <h2 class="mt-5">Resits</h2>
                        <p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over <strong>95%</strong>.</p>
                        <p>If a delegate has:</p>
                        <ul>
                        <li>completed the four core exercises, and</li>
                        <li>passed the trainer’s review, and</li>
                        <li>gained between 72%–78% (23, 24 or 25 out of 32) in the exam,</li>
                        </ul>
                        <p>then they may re-sit the examination one further time.</p>
                        <p>The re-sit may take place on the same day or by attending the final day of another course within a 90-day period (the delegate is not obliged to re-do the whole course).</p>
                        <h2 class="mt-5">Booking Procedure</h2>
                        <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                        <ol>
                        <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                        <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                        <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                        <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a href="' . $bookingTermsUrl . '" target="_blank" rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></li>
                        </ol>
                        <h2 class="mt-5">Enrolment and Finance Options Available</h2>
                        <p>If you’re funding your studies yourself then we have three payment options available, detailed below:</p>
                        <p><strong>Payment in Full</strong>: If your budget allows, you can make your payment in full and start your studies knowing the cost of your course is complete. The course fee includes examination fees, full instruction, and exam resit.</p>
                        <p><strong>Deposit Payment</strong>: To reserve and guarantee your place on the course you will need to pay a deposit fee of £50 and the remaining balance prior the course start date.</p>',
                'vat' => '',
                'price' => 0,
                'duration' => '5 days',
                'awarding_bodies' => 2,
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'SMSTS Refresher',
                'course_image' => 'CourseThumbnail/smstsrefresher.webp',
                'banner_image' => 'CourseHeaderimages/SMSTS Refresher.png',
                'color_code' => '#ccb55f',
                'category_id' => 3,
                'qualification' => 19,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 3 days</li>
                    <li><strong>Location</strong>: Nationwide</li>
                    <li><strong>Delivery Mode</strong>: On-site</li>
                    <li><strong>Group Size: </strong>8 – 12 people</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Award</strong>: CITB Certificate</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">CITB Site Safety Plus Training Scheme</div><h1>SMSTS-R – Site management safety training scheme-Refresher</h1></div>',
                'description' => 'This two-day site management refresher course reminds candidates of their responsibilities in relation to site safety and health and welfare. The SMSTS refresher course also provides a good understanding of current legislation relating to health and safety issues.',
                'long_desc' => '<h2 class="mt-5">About the Course</h2>
                    <p>This two-day site management refresher course reminds candidates of their responsibilities in relation to site safety and health and welfare. The SMSTS refresher course also provides a good understanding of current legislation relating to health and safety issues.</p>
                    <p><strong>At the end of the course you will have an understanding of:</strong></p>
                    <ul>
                    <li>Current focus of HSE’s attention</li>
                    <li>Risk assessment and method statements</li>
                    <li>CDM Regulations 2007</li>
                    <li>Construction Health, Safety and Welfare</li>
                    <li>Roles and responsibilities of key duty holders under CDM 2007 Reporting of Injuries</li>
                    <li>Diseases and Dangerous Occurrences Regulations (RIDDOR) 1995</li>
                    </ul>
                    <h2 class="mt-5">Who is this qualification for?</h2>
                    <p>The SMSTS-R course is designed for delegates who have previously passed the full <a href="'.route('course.show', 'smsts-site-management-safety').'" target="_blank" rel="noopener">Site Management Safety Training Scheme (SMSTS)</a> course or subsequent refresher course, and can provide proof of attendance.</p>
                    <h2 class="mt-5">Course Structure and Content</h2>
                    <p><strong>Course Structure</strong></p>
                    <ul>
                    <li>A multiple-choice examination paper</li>
                    <li>Continuous assessment during exercises</li>
                    </ul>
                    <p>You cannot receive a certificate without full attendance. Anyone unable to complete the course due to sickness or other circumstances must enrol on a new course and attend both days again.</p>
                    <p><strong>Course Content</strong></p>
                    <p>The SMSTS course contents and divided into 4 modules that will cover the following areas:</p>
                    <ul>
                    <li>Managing on-site safety in accordance with the law</li>
                    <li>Managing on-site safety in the context of your management or supervisory role</li>
                    <li>Developing an understanding of your responsibilities for site health, safety, and welfare</li>
                    <li>Recognising that a safe site is efficient, economical, and productive</li>
                    </ul>
                    <p>At the end of the training programme, you will able to:</p>
                    <ul>
                    <li>Understand all health, safety, welfare, and environmental legislation that affects your daily work</li>
                    <li>Implement new guidance and industry best practices</li>
                    <li>State your duties and responsibilities with regards to health, safety, welfare, and the environment</li>
                    </ul>
                    <h2 class="mt-5">Examination</h2>
                    <p>The paper consists of <strong>25 questions</strong>, covering all aspects of the course.</p>
                    <p>The exam paper must be taken at the end of the course.</p>
                    <p>Each assessment paper has:</p>
                    <ul>
                    <li>18 multiple choice questions (each worth one mark)</li>
                    <li>7 questions in multi-response or short written answer format (each worth two marks).</li>
                    </ul>
                    <p>The two mark questions all relate to the seven health and safety focus areas. The higher marks recognise and reward the increased complexity of the question and response required.</p>
                    <p>The exam pass mark is 81% (26 out of 32). The exam lasts for 35 minutes and must be completed within this time under exam conditions. Delegates are permitted to use the Construction site safety – The comprehensive guide (GE700) publication for the last 15 minutes of the exam.</p>
                    <h2 class="mt-5">Certification</h2>
                    <p>SMSTS training certificates are valid for <strong>5 years</strong>. However, due to changes in technology, the law, environmental management, and cultural behaviour, it is recommended that you take the SMSTS Refresher Course within three years.</p>
                    <h2 class="mt-5">Resits</h2>
                    <p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over <strong>95%</strong>.</p>
                    <p>If a delegate has <strong>gained between 72%–78%</strong> (23, 24 or 25 out of 32) in the exam, then they <strong>may re-sit</strong> the examination one further time.</p>
                    <p>The re-sit may take place on the same day or by attending the final day of another course within a 90-day period (the delegate is not obliged to re-do the whole course).</p>
                    <p><strong>If a delegate fails the re-sit, they must take the full SMSTS course again</strong>.</p>
                    <p><strong>When a delegate scores less than 69% (22 correct answers out of 32) in the final exam, the delegate must attend the full SMSTS course again before they are permitted to re-sit the exam.</strong></p>',
                'vat' => '',
                'price' => 0,
                'duration' => '3 days',
                'awarding_bodies' => 2,
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],

            [
                'name' => 'First Aid at Work',
                'course_image' => 'CourseThumbnail/firstaidatwork.webp',
                'banner_image' => 'CourseHeaderimages/First Aid at Work.png',
                'color_code' => '#81ac90',
                'category_id' => 2,
                'qualification' => 5,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 3 Days </li>
                    <li><strong>Delivery Mode</strong>: Face-to-face </li>
                    <li><strong>Award</strong>: Highfield Level 3 Award </li>
                    <li><strong>Course Fee </strong>: from £181.50 </li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Get Certified in Essential First Aid Skills </div><h1>First Aid at Work Course</h1><p>Join our accredited  <strong>First Aid at Work</strong>  course and develop the skills to handle workplace emergencies effectively. Over three days of face-to-face training, you’ll gain hands-on experience and a  <strong>Level 3 certification</strong> , equipping you to respond confidently to a range of medical situations. </p><ul class="list-unstyled p-0 m-0"><li>Experienced Trainers </li><li>Instant Results </li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Join our accredited First Aid at Work course and develop the skills to handle workplace emergencies effectively. Over three days of face-to-face training, you’ll gain hands-on experience and a Level 3 certification , equipping you to respond confidently to a range of medical situations.',
                'long_desc' => '<h2 class="mt-5">About the First Aid at Work course</h2><p>The First Aid at Work course equips participants with vital skills to handle emergencies confidently. Designed to comply with Health and Safety (First Aid) Regulations 1981 and 1982, this course is ideal for anyone aiming to be a certified workplace first-aider. Graduates receive a Level 3 certification valid for three years, ensuring competence and compliance in workplace safety.</p><h2 class="mt-5">Who is the First Aid at Work Course For?</h2><p>This course is ideal for:</p><ul><li> <strong>Employers and Employees</strong> : Ensure compliance with Health and Safety regulations.</li><li> <strong>Office Workers</strong> : Be prepared for emergencies in a corporate setting.</li><li> <strong>Factory and Construction Staff</strong> : Essential training for high-risk industries.</li><li> <strong>Retail and Hospitality Teams</strong> : Equip your staff to handle customer emergencies.</li></ul><h2 class="mt-5">What will I learn on the course?</h2><p>This comprehensive course covers:</p><ul><li> <strong>Roles and Responsibilities of a First-Aider</strong> : Understand your duties and how to act effectively in emergencies.</li><li> <strong>Assessing an Emergency Situation Safely</strong> : Learn to evaluate situations quickly and minimize risks.</li><li> <strong>CPR and AED Use</strong> : Master life-saving techniques and proper defibrillator usage.</li><li> <strong>Administering First Aid to a Choking Casualty</strong> : Handle choking incidents with confidence.</li><li> <strong>Dealing with Shock, Burns, Scalds, Bleeds, and Minor Injuries</strong> : Provide immediate care to stabilize and treat patients.</li><li> <strong>Managing Fractures and Spinal, Head, or Chest Injuries</strong> : Address serious injuries with precision and care.</li><li> <strong>Responding to Heart Attacks, Strokes, and Other Major Illnesses</strong> : Act decisively during critical medical conditions.</li></ul><h2 class="mt-5">Assessment and examination</h2><ul><li> <strong>Theoretical Assessment</strong> : Written and multiple-choice exams.</li><li> <strong>Practical Assessment</strong> : Scenario-based tests.</li><li> <strong>Certification</strong> : Level 3 certificate issued within 3&ndash;7 working days.</li></ul><p> <strong>No Pass &ndash; No Retake Fee</strong> policy ensures you have the support to succeed.</p><h2 class="mt-5">Examination resits</h2><p>We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over 95%.</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p>Exam results will be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p><p>Bookings may be made by e-mail, via the T4E website, or by telephone.</p><p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.</p><p>Placement in the course will be confirmed via E-mail by the T4E staff.</p><p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</p><p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></p>',
                'vat' => '',
                'price' => 181.50,
                'duration' => '3 Days',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "Yes, it provides a <strong>Level 3 certification valid for three years</strong> .", "question": "Is the course accredited? " }, "2": { "answer": "The course spans <strong>3 days of classroom training.</strong> ", "question": "What is the course duration? " }, "3": { "answer": "There are no prerequisites. The course is suitable for all levels. ", "question": "What are the prerequisites? " }, "4": { "answer": "Yes, it can be tailored to suit specific workplace needs.", "question": "Can the course be customized for my industry? " }, "5": { "answer": "Participants are evaluated through practical demonstrations and multiple-choice exams. ", "question": "How is the course assessed? " }, "6": { "answer": "We offer <strong>free retakes</strong> with a <strong>95%+ pass rate.</strong> ", "question": "What happens if I fail the assessment? " } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Day 1</h4><p>Roles and responsibilities of a first-aider, assessing emergencies, and practical CPR and AED training.</p></div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Day 2</h4><p>Managing burns, bleeds, choking incidents, and minor injuries.</p></div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Day 3</h4><p>Handling fractures, spinal injuries, and major illnesses such as heart attacks and strokes, followed by final assessments.</p></div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 14+ years</p>
                    </li></ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Emergency First Aid at Work',
                'course_image' => 'CourseThumbnail/emergencyfirstaidatwork.webp',
                'banner_image' => 'CourseHeaderimages/First Aid at Work-1.png',
                'color_code' => '#81ac90',
                'category_id' => 2,
                'qualification' => 6,
                'key_information' => '<ul>
                    <li><strong>Duration</strong> 4 hours </li>
                    <li><strong>Delivery Mode</strong> Blended learning </li>
                    <li><strong>Award</strong> Highfield Level 3 Award </li>
                    <li><strong>Mandatory Requirement for </strong> SIA Licence </li>
                    <li><strong>Course Fee </strong> from £67.50 </li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Mastering Workplace Safety with the </div><h1>Emergency First Aid at Work Course </h1><p>Join our Emergency First Aid at Work course and get certified in essential first aid skills. Learn CPR, AED use, wound treatment, and more in this accredited, 1-day course. E-learning modules available. Level 3 certificate included. </p><ul class="list-unstyled p-0 m-0"><li>Instant Access to E-learning</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Join our Emergency First Aid at Work course and get certified in essential first aid skills. Learn CPR, AED use, wound treatment, and more in this accredited, 1-day course. E-learning modules available. Level 3 certificate included.',
                'long_desc' => '<h2 class="mt-5">About the Emergency First Aid at Work course</h2><p>The Emergency First Aid at Work course is ideal for anyone aiming to become a certified workplace first aider. This one-day course covers critical life-saving skills such as CPR, AED use, treating wounds, controlling bleeding, and managing medical emergencies like heart attacks and strokes. Meeting the Health and Safety (First Aid) Regulations 1981 and 1982, this training ensures compliance and enhances safety in low-risk workplaces. Graduates receive a Level 3 certification, valid for three years, proving competence in workplace first aid.</p><p>Imagine being someone who can calmly assess an incident, perform life-saving CPR, and expertly use an AED. Picture yourself managing choking incidents, treating wounds, controlling bleeding, and providing crucial care during heart attacks, strokes, and seizures. This course covers it all, from minor injuries like cuts and bruises to severe conditions that require immediate attention. You&rsquo;ll walk away with a certification valid for three years, a testament to your readiness to tackle emergencies and a valuable asset for any organisation.</p><h2 class="mt-5">Who is the Emergency First Aid at Work Course For?</h2><p> <strong>Employers and Employees</strong> : To meet Health and Safety regulations and ensure a safe workplace.</p><p> <strong>Office Workers</strong> : Be prepared for emergencies in an office setting.</p><p> <strong>Factory and Construction Workers</strong> : Essential for high-risk environments.</p><p> <strong>Retail and Hospitality Staff</strong> : Equip staff to handle customer emergencies.</p><h2 class="mt-5">What will I learn on the course?</h2><p>Not only does this course meet the stringent requirements of the Health and Safety (First Aid) Regulations 1981 and the Health and Safety (First Aid) Regulations (Northern Ireland) 1982, but it also ensures your workplace is fully compliant with legal safety standards. You&rsquo;ll walk away with a certification valid for three years, a testament to your readiness to tackle emergencies and a valuable asset for any organisation.</p><p>Participants will engage in hands-on practice, learning to:</p><ul><li>Conduct a primary survey and assess incidents quickly</li><li>Perform effective CPR and use an automated external defibrillator (AED)</li><li>Manage choking, wounds, and bleeding</li><li>Treat burns, scalds, and shock</li><li>Respond to severe conditions like heart attacks, strokes, and seizures</li></ul><p>This course isn&rsquo;t just about ticking a box; it&rsquo;s about becoming the hero your workplace needs. Whether you&rsquo;re in an office, a factory, a retail environment, or anywhere else, the Emergency First Aid at Work course prepares you to act swiftly and effectively, ensuring the safety and well-being of your colleagues.</p><p>So, are you ready to make a difference? Enrol in the Emergency First Aid at Work course and be someone everyone can rely on in an emergency.</p><h2 class="mt-5">Assessment and examination</h2><p>This emergency first aid at work qualification is assessed through the following assessment:</p><ul><li>Theoretical Assessment &ndash; E-assessment</li><li>Practical Assessment</li></ul><h2 class="mt-5">Examination resits</h2><p>We have a policy of <strong>NO PASS – NO RETAKE FEE. </strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over 95%.</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p>Exam results will be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd. Bookings may be made by e-mail, via the T4E website, or by telephone.</p><p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.</p><p>Placement in the course will be confirmed via E-mail by the T4E staff.</p><p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</p><p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must read full <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer"> Booking Terms &amp; Conditions</a></p>',
                'vat' => '',
                'price' => 67.50,
                'duration' => '4 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "You will learn essential first aid skills such as CPR, wound treatment, using an AED, and handling medical emergencies. ", "question": "What will I learn in the Emergency First Aid at Work course? " }, "2": { "answer": "Yes, upon completion, you will receive a Level 3 certification, valid for three years. ", "question": "Is the course accredited? " }, "3": { "answer": "The course is approximately 4 hours. ", "question": "How long does the course last? " }, "4": { "answer": "Yes, the course includes e-learning modules to enhance your learning experience. ", "question": "Is e-learning available? " }, "5": { "answer": "The price starts from £67.50. ", "question": "What is the course cost?" }, "6": { "answer": "There are no prerequisites. This course is suitable for beginners and those with some first aid knowledge.", "question": "What are the prerequisites for the course? " }, "7": { "answer": "The course is assessed through a practical demonstration and a multiple-choice exam at the end.", "question": "How is the course assessed?" }, "8": { "answer": "You should bring Proof of ID and wear comfortable clothing, as some activities may involve practical exercises on the floor.", "question": "What should I bring to the course? " }, "9": { "answer": "Yes, the course includes hands-on training in CPR, AED use, and wound management.", "question": "Does the course include practical training? " }, "10": { "answer": "You will typically receive your e-certificate within 3–7 working days after successful completion.", "question": "How soon will I receive my certificate?" }, "11": { "answer": "Yes, it can be adapted to suit particular industry needs, especially for low-risk environments. ", "question": "Can the course be tailored for a specific industry? " }, "12": { "answer": "If you don’t pass the assessment, you may be given a chance to retake it. ", "question": "What happens if I don’t pass the assessment? " }, "13": { "answer": "Yes, it helps your business comply with Health and Safety (First Aid) Regulations 1981, ensuring you have adequate first aid provision. ", "question": "Will this course help my company meet legal requirements?" } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date. </p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 6-day Training</h4><p>Attend a 6-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers. </p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Sit and pass four multiple-choice exams and practical, scenario-based assessments. </p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 14+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Qualifications:</strong> To complete the e-learning, delegates will need internet, tablet, PC, or laptop access.</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Paediatric First Aid Training Course',
                'course_image' => 'CourseThumbnail/paediatricfirstaidtrainingcourse.webp',
                'banner_image' => 'CourseThumbnail/Paediatric First Aid.png',
                'color_code' => '#81ac90',
                'category_id' => 2,
                'qualification' => 7,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 2 days </li>
                    <li><strong>Delivery Mode</strong>: Blended learning </li>
                    <li><strong>Award</strong>: Highfield Level 3 Award </li>
                    <li><strong>Course Fee </strong>: from £95.50</li>
                </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Mastering Child Safety with the </div><h1>Paediatric First Aid </h1><p>Equip yourself with essential skills to handle emergencies involving infants and children. The Paediatric First Aid course ensures you’re prepared to respond confidently to various medical scenarios. This accredited course meets the requirements set by the Early Years Foundation Stage (EYFS) framework, ensuring safety and compliance in childcare environments.</p><ul class="list-unstyled p-0 m-0"><li>Experienced Trainers </li><li>Instant Results </li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Equip yourself with essential skills to handle emergencies involving infants and children. The Paediatric First Aid course ensures you’re prepared to respond confidently to various medical scenarios. This accredited course meets the requirements set by the Early Years Foundation Stage (EYFS) framework, ensuring safety and compliance in childcare environments.',
                'long_desc' => '<h2 class="mt-5">About the Paediatric First Aid Course</h2><p>The Paediatric First Aid Course is ideal for childcare professionals, parents, and guardians responsible for the welfare of children. This comprehensive course provides hands-on training and theoretical knowledge, equipping you to manage injuries, illnesses, and emergencies in childcare settings.</p><p>Participants will earn a <strong>Level 3 certification</strong> , valid for three years, proving their capability in providing paediatric first aid.</p><h2 class="mt-5">Who is the Emergency First Aid at Work Course For?</h2><p>This course is tailored for:</p><ul><li><p><strong>Childcare Professionals</strong>: Nursery workers, teachers, and childminders.</p></li><li><p><strong>Parents and Guardians</strong>: Learn how to safeguard your child&rsquo;s health in emergencies.</p></li><li><p><strong>Youth Workers and Volunteers</strong>: Essential for those supervising infants and children.</p></li></ul><h2 class="mt-5">What will I learn on the course?</h2><p>Taking the Paediatric First Aid course at Training for Employment ensures comprehensive training in vital skills such as CPR, AED usage, and managing medical emergencies, delivered by experienced instructors.&nbsp;</p><p>Gain critical skills to:</p><ul><li><p>Conduct a <strong>primary survey</strong> and assess emergencies quickly.</p></li><li><p>Perform <strong>CPR </strong>on infants and children, and use an <strong>AED</strong> effectively.</p></li><li><p>Administer first aid for <strong>choking, bleeding, fractures, and burns</strong>.</p></li><li><p>Manage acute illnesses like <strong>asthma attacks, anaphylaxis, meningitis, and seizures</strong>.</p></li><li><p>Treat <strong>shock, scalds, poisoning,</strong> and minor injuries.</p></li></ul><p>The course combines flexible e-learning with face-to-face sessions, providing accredited Level 3 certification valid for three years. With same-day results, nationwide availability, and a focus on meeting EYFS and Ofsted requirements, this program enhances employability, ensures legal compliance, and builds confidence to handle emergencies effectively, making it a valuable investment for childcare professionals and parents alike.</p><h2 class="mt-5">Assessment and examination</h2><p>The course is assessed through:</p><ul><li><p><strong>Practical Assessments</strong>: Demonstrating paediatric first aid techniques.</p></li><li><p><strong>Multiple-Choice Examination</strong>: Testing your theoretical knowledge.</p></li><li><p>With a <strong>95% pass rate</strong>, we offer <strong>NO PASS &ndash; NO RETAKE FEE</strong> for up to two retakes.</p></li></ul><h2 class="mt-5">Examination resits</h2><p>We have a policy of <strong>NO PASS – NO RETAKE FEE. </strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over 95%.</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p>Exam results will be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our aim is to make it is as easy as possible to book courses with Training for Employment Ltd.</p><p>Bookings may be made by e-mail, via the Training for Employment website, or by telephone.</p><p>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.</p><p>Placement in the course will be confirmed via E-mail by the Training for Employment staff.</p><p>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</p><p>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must read full <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer"> Booking Terms &amp; Conditions</a></p>',
                'vat' => '',
                'price' => 0,
                'duration' => '2 days',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Blended Learning',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "Yes, it is certified by Highfield Qualifications and regulated by OFQUAL. ", "question": "Is the course accredited?" }, "2": { "answer": "12 contact hours, typically delivered over 2 days. ", "question": "What is the course duration? " }, "3": { "answer": "The theory component can be completed online via e-learning modules. Practical assessments must be face-to-face.", "question": "Can I take the course online? " }, "4": { "answer": "Three years, with annual refreshers recommended.", "question": "How long is the certification valid?" }, "5": { "answer": "This course is essential for childcare, education, and any role involving infant and child safety.", "question": "What industries is this course suitable for?" }, "6": { "answer": "There are no prerequisites. This course is suitable for beginners and those with some first aid knowledge.", "question": "What are the prerequisites for the course?" }, "7": { "answer": "The course is assessed through a practical demonstration and a multiple-choice exam at the end.", "question": "How is the course assessed?" }, "8": { "answer": "You should bring Proof of ID and wear comfortable clothing, as some activities may involve practical exercises on the floor.", "question": "What should I bring to the course?" }, "9": { "answer": "Yes, the course includes hands-on training in CPR, AED use, and wound management.", "question": "Does the course include practical training?" }, "10": { "answer": "You will typically receive your e-certificate within 3–7 working days after successful completion.", "question": "How soon will I receive my certificate?" }, "11": { "answer": "Yes, it can be adapted to suit particular industry needs, especially for low-risk environments.", "question": "Can the course be tailored for a specific industry?" }, "12": { "answer": "If you don’t pass the assessment, you may be given a chance to retake it.", "question": "What happens if I don’t pass the assessment?" }, "13": { "answer": "Yes, it helps your business comply with Health and Safety (First Aid) Regulations 1981, ensuring you have adequate first aid provision.", "question": "Will this course help my company meet legal requirements?" } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Complete E-learning</h4><p>Get FREE access to e-learning and self study course materials immediately upon booking. Ensure that you complete distance learning before the course start date.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 2-day Training</h4><p>Attend a 2-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers.</p></div><div class="boxesDate">Step 2</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Sit and pass four multiple-choice exams and practical, scenario-based assessments.</p></div><div class="boxesDate">Step 3</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 16+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Qualifications:</strong> To complete the e-learning, delegates will need internet, tablet, PC, or laptop access.</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Traffic Marshall Training',
                'course_image' => 'CourseThumbnail/trafficmarshalltrainining.webp',
                'banner_image' => 'CourseHeaderimages/Traffic Marshal, Vehicle Banksman Course.png',
                'color_code' => '#00C8F8',
                'category_id' => 4,
                'qualification' => 20,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: 2 hours</li>
                    <li><strong>Delivery Mode</strong>: Fac-to-face</li>
                    <li><strong>Certification</strong>: Certificate of Completion and Photo Id Card</li>
                    <li><strong>Course Fee </strong>: from £67.50</li>
                </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Mastering Workplace Safety with the</div><h1>Traffic Marshal, Vehicle Banksman Course Training</h1><p>Ensure workplace safety with our Traffic Marshal & Vehicle Banksman Course! Learn essential skills to manage vehicle movements safely, prevent accidents, and comply with workplace regulations. Perfect for construction sites, warehouses, and high-traffic areas.</p><ul class="list-unstyled p-0 m-0"><li>Free Photo ID Card</li><li>Same Day Results</li><li>Nationwide Delivery</li></ul></div>',
                'description' => 'Ensure workplace safety with our Traffic Marshal & Vehicle Banksman Course! Learn essential skills to manage vehicle movements safely, prevent accidents, and comply with workplace regulations. Perfect for construction sites, warehouses, and high-traffic areas.',
                'long_desc' => '<h2 class="mt-5">About the Traffic Marshal, Vehicle Banksman course</h2>
                    <p>
                    The Traffic Marshall and Vehicle Banksman course is designed to equip participants with the skills and knowledge needed to manage vehicle movements and pedestrian safety on various worksites. This comprehensive training covers essential topics such as:
                    </p>
                    <ul>
                    <li>
                    <strong>Legal Obligations</strong>: Understand the Health and Safety at Work Act 1974 and other relevant regulations.
                    </li>
                    <li>
                    <strong>Risk Assessment</strong>: Learn how to conduct risk assessments to identify and mitigate hazards.
                    </li>
                    <li>
                    <strong>PPE Requirements</strong>: Understand the importance of wearing appropriate personal protective equipment.
                    </li>
                    <li>
                    <strong>Role Distinction</strong>: Learn the difference between Traffic Banksmen and Slinger Banksmen and their responsibilities.
                    </li>
                    <li>
                    <strong>Communication Skills</strong>: Develop effective communication skills crucial for safely directing vehicle movements.
                    </li>
                    <li>
                    <strong>Customer Service</strong>: Gain practical tips for managing customer interactions and avoiding poor communication.
                    </li>
                    <li>
                    <strong>Hands-On Practice</strong>: Participants will engage in practical training to master standard hand signals and direct vehicles safely.
                    </li>
                    </ul>
                    <p>
                    By the end of the course, Traffic Marshals will be fully prepared to ensure the safety of both workers and the public in vehicle-heavy environments.
                    </p>
                    <h2 class="mt-5">Who is the Course For?</h2>
                    <p>
                    Traffic Marshals and Banksmen play an essential role in ensuring site safety and operational efficiency. This training goes beyond compliance; it equips individuals with skills that have a real-world impact on safety, productivity, and career growth.
                    </p>
                    <p>This course is ideal for:</p>
                    <ul>
                    <li>
                    <strong>Site Managers & Supervisors:</strong> Ensure safe and efficient vehicle operations.
                    </li>
                    <li>
                    <strong>Vehicle Operators:</strong> Essential for those involved in managing vehicle movements.
                    </li>
                    <li><strong>Construction Workers:</strong> Enhance safety skills on-site.</li>
                    <li>
                    <strong>Logistics Professionals:</strong> Improve safety protocols in high-traffic environments.
                    </li>
                    <li>
                    <strong>Career Advancers:</strong> Boost qualifications in the construction and logistics sectors.
                    </li>
                    <li>
                    <strong>Newcomers:</strong> Start your role with foundational safety knowledge.
                    </li>
                    <li>
                    <strong>Experienced Workers:</strong> Refresh and update your safety practices.
                    </li>
                    <li>
                    <strong>Safety Officers:</strong> Maintain and enforce vehicle-related safety protocols.
                    </li>
                    </ul>
                    <h2 class="mt-5">What will I learn on the course?</h2>
                    <p>
                    The Traffic Marshall and Vehicle Banksman course covers the following key topics:
                    </p>
                    <ul>
                    <li>Health and Safety Regulations</li>
                    <li>Construction Law Related to Traffic Management</li>
                    <li>Site Access Control</li>
                    <li>First Aid for Choking Casualties</li>
                    <li>Vehicle Access and Safety Management</li>
                    <li>Hazard Analysis and Risk Management for Directing Vehicles</li>
                    <li>Identifying Dangerous Manoeuvres (e.g., reversing vehicles)</li>
                    <li>Safeguarding Pedestrians and</li>
                    <li>Staff in Reversing Zones</li>
                    <li>Hand Signals as Recommended by the HSE</li>
                    <li>Employer and Employee Legal Obligations</li>
                    <li>Safety Signage and Accident Prevention</li>
                    <li>Planning Vehicle Operations Effectively</li>
                    </ul>
                    <h2 class="mt-5">Assessment and examination</h2>
                    <p>
                    The course is assessed through two parts:</p>
                    <div class=detailBorder>
                    <h3>Theoretical Assessment</h3>
                    <p>
                    <strong>Theoretical Assessment:</strong> Complete a multiple-choice exam based on course content, including current legislation, safety signs, and signals regulations.
                    </p>
                    <p>Assessment results are provided on the same day.</p>
                    </div>
                    <div class=detailBorder>
                    <h3>Practical Assessment</h3>
                    <p>Demonstrate correct techniques for safely directing vehicles.</p>
                    </div>
                    <h2 class="mt-5">Examination resits</h2>
                    <p>
                    We have a policy of <strong>NO PASS – NO RETAKE FEE</strong>, so if you do not pass there is no charge for re-takes. Our pass rate is over
                    <strong>95%</strong>.
                    </p>
                    <p>
                    Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.
                    </p>
                    <p><strong>Re-sit results</strong> will be made available on the same day.</p>
                    <h2 class="mt-5">Booking Procedure</h2>
                    <p>
                    Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.
                    </p>
                    <p>Bookings may be made by e-mail, via the T4E website, or by telephone.</p>
                    <p>
                    Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received.
                    </p>
                    <p>Placement in the course will be confirmed via E-mail by the T4E staff.</p>
                    <p>
                    Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.
                    </p>
                    <p>
                    If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a>
                    </p>',
                'vat' => '',
                'price' => 67.50,
                'duration' => '2 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{"1":{"answer":"A Traffic Marshall, also known as a Vehicle Banksman, is responsible for safely directing vehicle movements on construction sites, warehouses, and other work environments. They ensure the safety of pedestrians and workers by managing traffic flow and preventing accidents.","question":"What is a Traffic Marshall/Vehicle Banksman?"},"2":{"answer":"No prior experience is required to take the Traffic Marshall and Vehicle Banksman course. It’s designed for both newcomers and experienced workers who want to refresh their skills.","question":"Do I need previous experience to take this course?"},"3":{"answer":"Upon successful completion, you will receive a Certificate of Completion and a Traffic Marshall/Vehicle Banksman ID Card. This will certify you to direct vehicle movements on various sites.","question":"What qualifications will I receive after completing the course?"},"4":{"answer":"The course lasts approximately 2 hours, including both theoretical instruction and practical assessments.","question":"How long is the course?"},"5":{"answer":"If you don’t pass, there’s no need to worry. We offer free resits under our No Pass, No Fee policy, so you can retake the assessment at no additional cost.","question":"What happens if I fail the assessment?"},"6":{"answer":"Results are provided on the same day of the training, so you’ll know immediately if you’ve passed.","question":"When will I get my results?"},"7":{"answer":"Please bring a valid form of photo ID (passport, driver’s license, or national ID) to verify your identity.","question":"What should I bring to the course?"},"8":{"answer":"<p>The course is delivered in a <strong>classroom-based</strong> setting, allowing for hands-on practice and interactive learning with an instructor.</p>","question":"Is the course classroom-based or online?"},"9":{"answer":"While you’ll learn about the importance of PPE during the course, it’s not required to bring any PPE to the training itself. However, proper PPE will be necessary for real work environments post-training.","question":"What personal protective equipment (PPE) is required?"}}',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 2-hour Training</h4><p>Participate in a 2-hour interactive classroom training session designed to provide foundational knowledge and practical skills.</p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Pass Assessments</h4><p>Successfully complete four assessments, including multiple-choice questions and practical, scenario-based exercises to demonstrate your understanding and skills.</p></div><div class="boxesDate">Step 2</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Age Requirement:</strong> 14+ years</p>
                    </li>
                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                        <p class="m-0"><strong>Experience:</strong> No prior experience is required</p>
                    </li>
                </ul>',
                'user_id' => 1
            ],
            [
                'name' => 'Fire Safety For Fire Wardens',
                'course_image' => 'CourseThumbnail/firesafetyforfirewardens.webp',
                'banner_image' => 'CourseHeaderimages/FIRE SAFETY FOR FIRE WARDENS.png',
                'color_code' => '#00C8F8',
                'category_id' => 5,
                'qualification' => 11,
                'key_information' => '<ul>
                    <li><strong>Duration</strong>: minimum 7 hours</li>
                    <li><strong>Location</strong>: Birmingham, B19 3NY</li>
                    <li><strong>Delivery Mode</strong>: Classroom based (open class)</li>
                    <li><strong>Individual price</strong>: <strong>£150.80&nbsp;</strong></li>
                    <li><strong>Group training:</strong> Available upon request – group size 8 – 16 people</li>
                    <li><strong>Experience</strong>: Any experience</li>
                    <li><strong>Assessment</strong>: Multiple Choice Question Examination</li>
                    <li><strong>Award</strong>: Highfield Level 2 Award</li>
                    </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Principles of Fire Safety for fire wardens/marshals</div><h1>Fire Safety Level 2</h1><p>If you own or manage a business or other non-domestic premises, you’re responsible for fire safety. You’re responsible for fire safety in business or other non-domestic premises if you’re:</p></div>',
                'description' => 'If you own or manage a business or other non-domestic premises, you’re responsible for fire safety. You’re responsible for fire safety in business or other non-domestic premises if you’re.',
                'long_desc' => '<ul><li>An employer</li><li>The owner</li><li>The landlord</li><li>An occupier</li><li>Anyone else with control of the premises, for example, a facilities manager, building manager, managing agent or risk assessor</li></ul><p>You are referred to as ‘the responsible person’.</p>
                    <p>In every workplace, it is crucial to have fire safety measures in place regardless of the size of the business. In addition to installing fire alarms and conducting fire drills, employees could be trained in fire safety.</p>
                    <p>Fire wardens/marshals are expected to assist the person with overall responsibility for fire safety. And they might be trained in emergency firefighting, helping with evacuations and carrying out fire checks and inspections.</p>

                    <h2 class="mt-5">Course Delivery Methods</h2>

                    <p><strong>Face to face Delivery</strong></p>
                    <p><span>The face to face course delivery method is a traditional one. The contact between the instructor and learners is in a physical classroom at out training centre in Birmingham, Newtown.</span></p>

                    <p><strong>Training at the Client’s Site</strong></p>
                    <p>We can also bring our courses to you, providing </span><span>the required training at your premises shaped to the precise needs of your employees.</p>

                    <h2 class="mt-5">About the Course</h2>
                    <p>Any individual involved in the management of fire safety – fire wardens/marshals in any area where there is a potential fire risk should have this Level 2 Principles in Fire Safety qualification.</p>
                    <p>By earning this qualification, learners will recognize fire causes, common hazards, how to conduct a fire risk assessment, and how to reduce fire risk. They will also know the steps in a fire risk assessment and how to reduce the probability of fire.</p>

                    <h2 class="mt-5">Who is this qualification for?</h2>

                    <p>Under the <a href="https://www.gov.uk/government/consultations/the-regulatory-reform-fire-safety-order-2005-call-for-evidence/outcome/the-regulatory-reform-fire-safety-order-2005-summary-of-responses-accessible-version#:~:text=The%20Regulatory%20Reform%20(Fire%20Safety)%20Order%202005%20%E2%80%93%20the%20Fire,common%20in%20England%20and%20Wales." target="_blank" rel="noopener">2005 Fire Safety Order</a>, companies with at least one employee are required to provide fire safety training.</p>
                    <p>Fire safety managers will benefit from the Level 2 Principles in Fire Safety qualification, but young learners who are preparing for employment or moving on to further education may also find it useful.</p>
                    <p>Whether you’re a new recruit or an existing employee, this Level 2 Principles of Fire Safety course is perfect for you.</p>

                    <h2 class="mt-5">Course Structure an Content</h2>

                    <p><strong>Course Structure:</strong></p>
                    <ul>
                    <li>A training session enhanced with visual material, practical exercises, and teaching aids.&nbsp;Delegates are encouraged to actively participate in discussions and group activities.</li>
                    <li>Multiple choice question examination.</li>
                    </ul>
                    <p>The Level 2 Principles of Fire Safety course covers the following topics:</p>
                    <p><span style="color: #993300;"><strong><em>Fire prevention, and company regulations</em></strong></span> – general fire safety compliance points. Business-specific issues, such as the safe storage and disposal of chemicals. Company smoking policy.</p>
                    <p><span style="color: #993300;"><strong><em>What to do in the event of a fire</em></strong></span> – what will happen should a fire break out. Where the fire exits and assembly point(s) are. Who the appointed fire marshal is, and their role in the event of a fire (roll call).</p>
                    <p><span style="color: #993300;"><strong><em>Equipment use and care</em></strong> </span>– what fire safety equipment you have on premises. How it should be used and by whom. Who is responsible for its upkeep. And what to do if potential faults are spotted.</p>
                    <p><span style="color: #993300;"><strong><em>Fire alarms</em></strong></span> – where your alarms are. How they operate. Fire alarm testing information – and who is responsible for conducting testing.</p>
                    <p><span style="color: #993300;"><strong><em>Emergency exits</em></strong></span> – how to open all emergency exit doors.</p>

                    <h2 class="mt-5">Examination Resits</h2>
                    <p>We have a policy of <strong>NO PASS – NO RETAKE FEE. </strong>Delegates are allowed 1 free resit with the cost incurred to us.</p>
                    <p>Our pass rate is over <strong>95%</strong>.</p>

                    <h2 class="mt-5">Certification</h2>

                    <p><strong>Certification – Highfield Level 2 Award </strong>is valid for 3 years.</p>

                    <h2 class="mt-5">Booking Procedure</h2>

                    <p>Our aim is to make it is as easy as possible to book courses with Training 4 Employment Ltd.</p>
                    <ol>
                    <li>Bookings may be made by e-mail, via the T4E website, or by telephone.</li>
                    <li>Registration for the course is not guaranteed until a completed registration form and payment (deposit) has been received. Placement in the course will be confirmed via E-mail by the T4E staff.</li>
                    <li>Deposit and payments. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.</li>
                    <li>If you fail to attend without notice or arrive late for the course, the tutor will refuse your place on the course due to the amount of content missed, you will not be entitled to a refund. 100% attendance is a must <a href="' . $bookingTermsUrl . '" target="_blank" rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></li>
                    </ol>

                    <h2 class="mt-5">Enrolment and Finance Options Available</h2>

                    <p>If you’re funding your studies yourself then we have three payment options available, detailed below:</p>

                    <ol>
                    <li>Payment in Full: If your budget allows, you can make your payment in full and start your studies knowing the cost of your course is complete. The course fee £142.55 includes examination fees, full instruction, and exam resit.</li>
                    <li>Deposit Payment: To reserve and guarantee your place on the course you will need to pay a deposit fee of £50 and the remaining balance of £92.55.</li>
                    </ol>

                    <h2 class="mt-5">We Can Also Bring Our Courses to You!</h2>
                    <p>Training for Employment can provide the required training at your premises shaped to the precise needs of your employees.<br>Save time, reduce travel costs, and reduce downtime.  Request a quote now  to receive information on Fire Safety Level 2 for fire wardens./marshals tailored to your business  needs.Group size between 8 and 12 per trainer.</p>',
                'vat' => '',
                'price' => 0,
                'duration' => 'Minimum 7 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'APHL Personal Licence',
                'course_image' => 'CourseThumbnail/aphlpersolanallicence.webp',
                'banner_image' => 'CourseHeaderimages/APHL Persolanal Licence.png',
                'color_code' => '#00C8F8',
                'category_id' => 6,
                'qualification' => 10,
                'key_information' => '<ul>
                    <li><strong>Delivery Mode</strong>: Face-to-face </li>
                    <li><strong>Award</strong>: Highfield Level 2 Award</li>
                    <li><strong>Legal requirement for licence holders</strong> </li>
                    <li><strong>Course Fee </strong>: from £125</li>
                </ul>',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><div class="bannerSubTitle">Secure Your APHL Licence Today! </div><h1>Unlock Career Opportunities with the APHL Personal Licence Course </h1><p>Become a certified personal licence holder and unlock new career opportunities in the hospitality and retail industries. Ensure compliance with UK licensing laws and gain the qualification required to sell or authorize the sale of alcohol. </p><ul class="list-unstyled p-0 m-0"><li>Same-Day Assessment Results </li><li>Instant Certification Processing </li><li>Nationwide Training Availability</li></ul></div>',
                'description' => 'Become a certified personal licence holder and unlock new career opportunities in the hospitality and retail industries. Ensure compliance with UK licensing laws and gain the qualification required to sell or authorize the sale of alcohol.',
                'long_desc' => '<h2 class="mt-5">About the APLH Personal Licence Course</h2><p>A personal licence is essential for supervising the retail sale of alcohol on licensed premises. To apply for this licence, you must complete the <strong>Level 2 Award for Personal Licence Holders (APLH)</strong> . This accredited course equips you with the knowledge and skills required under the <strong>Licensing Act 2003</strong> .</p><p>Imagine confidently managing alcohol sales, ensuring compliance with licensing objectives, and promoting safe alcohol consumption. The APLH course prepares you to handle these responsibilities while enhancing your career prospects.&nbsp;</p><h2 class="mt-5">Who Needs a Personal Licence?</h2><p> <strong>Designated Premises Supervisors (DPS)</strong> : Manage licensed venues with confidence.</p><p> <strong>Hospitality Professionals</strong> : Required for roles in pubs, restaurants, and hotels.</p><p> <strong>Retailers</strong> : Essential for off-licences and supermarkets.</p><p> <strong>Event Organizers</strong> : Crucial for selling alcohol at events.&nbsp;</p><h2 class="mt-5">What will I learn on the course?</h2><p>The APLH Personal Licence course covers:</p><ul><li><p>The <strong>Licensing Act 2003</strong> and its implications.</p></li></ul><ul><li><p>Legal responsibilities of personal licence holders.</p></li></ul><ul><li><p>Protecting children on licensed premises.</p></li></ul><ul><li><p>Roles of licensing authorities and police powers.</p></li></ul><ul><li><p>Alcohol&rsquo;s effects on customers and best practices for safe consumption.</p></li></ul><h2 class="mt-5">Assessment and examination</h2><p>The <strong>Level 2 APLH course</strong> is assessed through:</p><ul><li><p> <strong>Multiple-Choice Examination</strong> : 1-hour test with a 70% pass mark.</p></li></ul><h2 class="mt-5">Examination resits</h2><p>We have a policy of <strong>NO PASS – NO RETAKE FEE. </strong>, so if you do not pass there is no charge for 2 re-takes. Our pass rate is over 95%.</p><p>Everything you need to know for the exams is covered in the course and our experienced trainers will fully prepare you for success in the tests.</p><p>Exam resit results will also be made available on the same day.</p><h2 class="mt-5">Booking Procedure</h2><p>Our courses are designed to make your learning process straightforward. Refund policies include:</p><ul><li><p>Full refund for cancellations within 24 hours of booking.</p></li></ul><ul><li><p>Non-refundable after 24 hours unless cancellation is due to exceptional circumstances.</p></li></ul><p>Late attendance or failure to complete the course may result in loss of fees and course placement ... <a title="Booking Terms &amp; Conditions" href=' . $bookingTermsUrl . ' target=_blank rel="noopener noreferrer">read full Booking Terms &amp; Conditions</a></p><h2 class="mt-5">Steps to Obtain Your APLH Personal Licence</h2><details class="detailBorder"><summary>Step 1: Meet Eligibility Requirements</summary><ul><li> <strong>Age</strong> : Applicants must be at least 18 years old.</li><li> <strong>Criminal Record</strong> : Have no unspent convictions for relevant offences.</li><li> <strong>Right to Work</strong> : Provide proof of eligibility to work in the UK.</li></ul></details><details class="detailBorder"><summary>Step 2: Complete Accredited Training</summary><p>Achieve the <strong>Highfield Level 2 Award for Personal Licence Holders (RQF)</strong> qualification. This course provides:</p><ul><li>Knowledge of licensing law and responsibilities.</li><li>Guidance on protecting children on licensed premises.</li><li>Training on alcohol safety and promoting licensing objectives.</li></ul></details><details class="detailBorder"><summary>Step 3: Obtain a DBS Certificate</summary><p>Submit an Enhanced Disclosure and Barring Service (DBS) check issued within the last 28 days.</p></details><details class="detailBorder"><summary>Step 4: Prepare Your Application</summary><p>Compile the following documents for submission to your local Licensing Authority:</p><ul><li>Completed application form.</li><li>APLH qualification certificate.</li><li>Recent DBS certificate.</li><li>Two passport-style photographs (one certified).</li><li>Proof of right to work in the UK.</li><li>Application fee (approximately &pound;37).</li></ul></details><details class="detailBorder"><summary>Step 5: Submit and Await Approval</summary><p>Once your application is submitted, the Licensing Authority will review and consult with police or immigration authorities if necessary. Upon approval, you will receive your personal licence, including:</p><ul><li>A personal licence card.</li><li>A certificate of authorisation.</li></ul></details>',
                'vat' => '',
                'price' => 0,
                'duration' => '8 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Classroom Based',
                'course_type' => 'OpenCourse',
                'faqs' => '{ "1": { "answer": "The APLH course is an accredited training program that prepares individuals to apply for a personal licence. ", "question": "What is the APLH course?" }, "2": { "answer": "You will learn about licensing laws, legal responsibilities, and how to promote licensing objectives effectively. ", "question": "What will I learn in the APLH course? " }, "3": { "answer": "Yes, the APLH course is accredited by Highfield Qualifications and recognised across the UK. ", "question": "Is the course accredited? " }, "4": { "answer": "Training and DBS certification can take a few weeks, followed by Licensing Authority processing. ", "question": "How long does the process take? " }, "5": { "answer": "Yes, training can be customised for industry-specific requirements.", "question": "Can the training be tailored to my needs? " }, "6": { "answer": "Personal licences are now valid indefinitely unless revoked. ", "question": "How long is the licence valid? " }, "7": { "answer": "If you don’t pass the assessment, you may resit the exam at no additional cost.", "question": "What happens if I don’t pass the assessment? " } }',
                'course_structure' => '<div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Attend 6-day Training</h4><p>Attend a 6-day interactive classroom training to gain in-depth theoretical knowledge and master practical skills from our expert trainers. </p></div><div class="boxesDate">Step 1</div></div><div class="courseStructureBoxes d-flex mt-3"><div class="boxesContent"><h4>Step 2: Pass Assessments </h4><p>Sit and pass four multiple-choice exam. </p></div><div class="boxesDate">Step 2</div></div>',
                'requirements' => '<ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                    <p class="m-0"><strong>Age Requirement:</strong> 18+ years</p>
                </li>
            </ul>',
                'user_id' => 1
            ],

            [
                'name' => 'First Aid Training At Work',
                'course_image' => 'E-learningThumbnail/First Aid Training At Work.jpg',
                'banner_image' => 'Elearning Banners/First Aid Training At Work.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>First Aid at Work</h1><p>Welcome to  the Highfield’s first aid e-learning course, designed to provide you with comprehensive life-saving skills from the comfort of your home or office.</p><p>Highfield’s First Aid at Work e-learning course gives learners the opportunity to undertake online first-aid training and go on to achieve the level 3 award in first aid at work.</p></div>',
                'description' => 'Welcome to  the Highfield’s first aid e-learning course, designed to provide you with comprehensive life-saving skills from the comfort of your home or office.',
                'long_desc' => '<h2 class="mt-5">Why Choose the Highfield&rsquo;s First Aid E-Learning Course?</h2>
                    <p> <strong>Legal Compliance:</strong> The Health and Safety (First-Aid) Regulations 1981 mandate that employers must provide adequate first aid equipment, facilities, and personnel to ensure the immediate attention of employees in case of injury or illness
                        at work. The Highfield&rsquo;s e-learning course equips employers and employees with the necessary knowledge to meet these legal obligations.</p>
                    <p> <strong>Highfield Certification:</strong> the course is certified by Highfield, a globally recognized leader in accredited qualifications and certifications.</p>
                    <p> <strong>Flexible Learning:</strong> Access the course anytime, anywhere, and on almost any device with internet connectivity. Fit learning around your schedule and ensure all employees receive the necessary training to respond effectively to workplace
                        emergencies.</p>
                    <p> <strong>Comprehensive Curriculum:</strong> the e-learning modules cover essential first aid techniques, including CPR, AED usage, basic life support (BLS), wound care, and emergency response procedures. Employees will gain the skills and confidence needed
                        to handle medical emergencies with competence and efficiency.</p>
                    <div class="detailBorder">
                        <div>
                            <h2 class="mt-5">Contents</h2>
                        </div>
                        <ul>
                            <li>Interactive exercises/gaming</li>
                            <li>Media-rich content</li>
                            <li>Interactive 3D scenarios</li>
                            <li>Content provided by sector-leading experts</li>
                            <li>Relevant photography and illustrations</li>
                            <li>Multi-generational content and style&ZeroWidthSpace;</li>
                        </ul>
                            <h2 class="mt-5">Areas covered:</h2>
                        <ul>
                            <li>Understanding the role and responsibilities of a first-aider</li>
                            <li>Assessing an incident</li>
                            <li>Managing an unresponsive casualty</li>
                            <li>Recognising and assisting a choking casualty</li>
                            <li>Managing a casualty – external bleeding and shock</li>
                            <li>Managing a casualty – minor injury</li>
                            <li>Conducting a secondary survey</li>
                            <li>Administering first aid to a casualty with injuries<br>(bones, head and spinal injuries, suspected chest<br>injuries, burns or eye injuries, sudden poisoning or<br>anaphylaxis, or a suspected major illness)</li>
                        </ul>
                    </div>
                    <div class="detailBorder">
                        <h2 class="mt-5">Who Is It Aimed At?</h2>
                        <p>Highfield First Aid&nbsp; e-learning course is ideal for:</p>
                        <ul>
                            <li>Employers seeking to comply with the Health and Safety (First-Aid) Regulations 1981 and ensure the safety and well-being of their workforce.</li>
                            <li>Individuals responsible for first aid provision in the workplace, including designated first aiders and health and safety officers.</li>
                        </ul>
                    </div>
                        <h2 class="mt-5">Course Prerequisites</h2>
                        <p>No prior knowledge is required.</p>
                    <div class="detailBorder">
                        <div>
                            <h2 class="mt-5">Assessment</h2>
                        </div>
                        <p>Learners are assessed at the end of the course by multiple-choice questions.</p>
                    </div>
                    <div class="detailBorder">
                        <div>
                            <h2 class="mt-5">Certification</h2>
                        </div>
                        <p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>
                    </div>
                    <div class="detailBorder">
                        <h2 class="mt-5">Technical Requirements</h2>
                        <p><span>The e-learning courses are</span> available to use on multiple platforms such as tablets, PCs and laptops, except smart phones. All you need is a Laptop/Tablet or PC and an internet connection.</p>
                        <h2 class="mt-5">How it Works?</h2>
                        <p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p>
                        <p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p>
                        <p>At the end of the course, there will be multiple-choice questions assessment.</p>
                        <h2 class="mt-5">Certification</h2>
                        <p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>
                    </div>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '4 - 5 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Paediatric First Aid',
                'course_image' => 'E-learningThumbnail/Paediatric First Aid.jpg',
                'banner_image' => 'Elearning Banners/Paediatric First Aid.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Paediatric First Aid</h1><p>Schools and nurseries in the UK are required to have staff members who hold a valid paediatric first aid certificate. This certificate ensures that the staff members are trained in basic first aid skills specific to infants and children, allowing them to respond appropriately to medical emergencies that may arise in the educational setting.</p></div>',
                'description' => 'Schools and nurseries in the UK are required to have staff members who hold a valid paediatric first aid certificate. This certificate ensures that the staff members are trained in basic first aid skills specific to infants and children, allowing them to respond appropriately to medical emergencies that may arise in the educational setting.',
                'long_desc' => '<p>The specific requirements for paediatric first aid in schools and nurseries may vary slightly depending on the governing body or local authority. However, the general standards outlined by the Department for Education (DfE) state that at least one staff member with a valid paediatric first aid certificate should be on the premises at all times when children are present.</p><p>DfE recommends that the paediatric first aid training includes topics such as performing CPR on infants and children, dealing with choking incidents, treating common injuries and illnesses in children, understanding and responding to allergies and anaphylactic shock, and recognizing and managing medical conditions such as asthma and diabetes.</p><p>The Level 3 Paediatric First Aid e-learning course can form part of blended learning if at least 6 hours of the training is face to face.</p><div class="detailBorder"><h2 class="mt-5">This Course at a Glance</h2><ul><li>Roles and responsibilities of a paediatric first-aider</li><li>Assessing an emergency situation</li><li>Providing first aid to an infant or child who is unresponsive, choking or has external bleeding</li><li>Providing first aid to an infant or a child with a suspected bone fracture or dislocation; head, neck or back injury</li><li>An infant or a child with a condition that affects the ears, eyes and nose; burns or scalds; an acute medical condition or sudden illness; a minor injury; shock</li><li>An infant or a child experiencing the effects of extreme heat or cold</li><li>An infant or child who has sustained an electric shock or been poisoned</li><li>Providing first aid to an infant or child with anaphylaxis</li></ul></div><div class="detailBorder"><h2 class="mt-5">Who Is It Aimed At?</h2><p>Designed for anyone looking after infants and children such as carers, childminders and schools.</p></div><div class="detailBorder"><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p></div><div class="detailBorder"><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p></div><div class="detailBorder"><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p></div><div class="detailBorder"><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p></div><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '6 - 8 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Principles of the Role of a Fire Marshal',
                'course_image' => 'E-learningThumbnail/Principles of the Role of a Fire Marshal.jpg',
                'banner_image' => 'Elearning Banners/Principles of the Role of a Fire Marshal.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Principles of the Role of a Fire Marshal</h1><p>In the UK, the role of a Fire Marshal (also known as a Fire Warden) is crucial in ensuring the safety of people and property in the event of a fire. The responsibilities of a Fire Marshal in the workplace are outlined in various regulations and guidelines. Here are the key responsibilities of a Fire Marshal in the UK:</p></div>',
                'description' => 'In the UK, the role of a Fire Marshal (also known as a Fire Warden) is crucial in ensuring the safety of people and property in the event of a fire. The responsibilities of a Fire Marshal in the workplace are outlined in various regulations and guidelines. Here are the key responsibilities of a Fire Marshal in the UK',
                'long_desc' => '<ul><li>Emergency Response</li><li>Fire Prevention:</li><li>Training and Awareness</li><li>Equipment Checks</li><li>Reporting and Record Keeping:</li><li>Coordination with Emergency Services:</li><li>First Aid and Assistance</li></ul><p>The specific duties and requirements may vary depending on the size and nature of the workplace, so it&rsquo;s advisable to consult the relevant fire safety regulations and guidelines applicable to your specific industry and location.</p><p>It&rsquo;s important for Fire Marshals to undergo appropriate training to fulfill their responsibilities effectively.</p><div class="detailBorder"><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style&ZeroWidthSpace;</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>Introduction to fire safety</li><li>The characteristics of fire</li><li>Fire safety legislation</li><li>Assessing and managing risk</li></ul></div><div class="detailBorder"><h2 class="mt-5">Who Is It Aimed At?</h2><p>This online training is specifically designed to benefit managers, supervisors, fire marshals, and all personnel engaged in roles where there’s a fire hazard potential within the business. It’s also well-suited for individuals pursuing a Level 2 fire safety certification.</p></div><div class="detailBorder"><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p></div><div class="detailBorder"><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p></div><div class="detailBorder"><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p></div><div class="detailBorder"><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p></div><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '2 - 3 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Introduction to Fire Safety at Workplace',
                'course_image' => 'E-learningThumbnail/Introduction to Fire Safety at Workplace.jpg',
                'banner_image' => 'Elearning Banners/Introduction to Fire Safety at Workplace.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Introduction to Fire Safety at Workplace</h1><p>According to government statistics, there are 15,000 fires in workplaces and places where people gather in England every year. That’s 40 fires a day.</p><p>Workplaces and public spaces must prioritize fire safety due to the significant impact fires can have on both physical and human aspects. </p></div>',
                'description' => 'According to government statistics, there are 15,000 fires in workplaces and places where people gather in England every year. That’s 40 fires a day.',
                'long_desc' => '<h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>The fire triangle&nbsp;</li><li>Causes of fire&nbsp;</li><li>Hazards associated with fire&nbsp;</li><li>How fire spreads&nbsp;</li><li>Fire protection&nbsp;</li><li>Fire classification&nbsp;</li><li>Fire extinguishers&nbsp;</li><li>The Regulatory Reform (Fire Safety) Order&nbsp;</li><li>Fire safety briefings&nbsp;</li><li>Employees&rsquo; responsibilities</li><li>Fire risk assessment&nbsp;</li><li>Actions in the event of fire</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>Any employee or manager where there is a requirement to understand fire safety, their roles and responsibilities and the risks associated with fire.</p><p>This course can be used as a stand-alone module or included in an induction programme.</p><h2 class="mt-5">Course Prerequisites</h2><ul><li>No prior knowledge is required.</li></ul><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><p> <strong>Certification</strong> </p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 35.00,
                'duration' => '20 - 40 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Awareness of Modern Slavery',
                'course_image' => 'E-learningThumbnail/Awareness of Modern Slavery.jpg',
                'banner_image' => 'Elearning Banners/Awareness of Modern Slavery.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Awareness of Modern Slavery</h1><p>Everyone should be aware of modern-day slavery. It’s a global issue that affects millions of people, often hidden in plain sight. Awareness and education are crucial in combating this pervasive problem and advocating for the rights and dignity of those affected.</p><p>Empower yourself or your employees with essential knowledge about modern-day slavery through this online bite size training course. Whether it’s part of new starter inductions or employee refresher programs, this course is designed to equip all employees with the awareness needed to recognize and address modern slavery in the workplace. Ideal for those seeking a basic introduction or wishing to extend their understanding, our course aims to raise awareness and promote proactive engagement with this critical subject matter.</p></div>',
                'description' => 'Everyone should be aware of modern-day slavery. It’s a global issue that affects millions of people, often hidden in plain sight. Awareness and education are crucial in combating this pervasive problem and advocating for the rights and dignity of those affected.',
                'long_desc' => '<h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style&ZeroWidthSpace;</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>What is modern slavery</li><li>Methods of modern slavery</li><li>What does the law say</li><li>Why is modern slavery under reported</li><li>Types of modern slavery – who are the victims</li><li>Modern slavery statement, policy and reporting</li><li>Understanding what you can do</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>Designed to cater to all employees, including new starters and those seeking refresher training, our online course on modern slavery awareness is essential for fostering a comprehensive understanding within your workforce. Whether it’s integrating new team members or reinforcing existing knowledge, this course equips individuals with the necessary awareness to recognize and respond to modern slavery effectively.</p><h2 class="mt-5">Course Prerequisites</h2><ul><li>No prior knowledge is required.</li></ul><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 25.00,
                'duration' => '30 - 40 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Equality and Diversity',
                'course_image' => 'E-learningThumbnail/Equality and Diversity.jpg',
                'banner_image' => 'Elearning Banners/Equality and Diversity.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Equality and Diversity</h1><p class="h4">Why Equality and Diversity Matter in the Workplace</p><p>In today’s competitive landscape, embracing equality and diversity isn’t just a moral imperative—it’s a strategic advantage. Learn how prioritizing inclusivity fosters collaboration, attracts top talent, and ensures legal compliance.</p></div>',
                'description' => 'In today’s competitive landscape, embracing equality and diversity isn’t just a moral imperative—it’s a strategic advantage. Learn how prioritizing inclusivity fosters collaboration, attracts top talent, and ensures legal compliance.',
                'long_desc' => '<h2 class="mt-5">Benefits of Embracing Equality and Diversity</h2><p>From boosting creativity to enhancing decision-making, discover the myriad benefits of building a diverse workforce. Explore how embracing different perspectives drives innovation and enhances customer satisfaction.</p><h2 class="mt-5">Navigating Legal and Ethical Obligations</h2><p>Stay ahead of the curve by understanding the legal and ethical considerations surrounding equality and diversity. The Highfield bite size e-learning course equips you with the knowledge to navigate regulations, prevent discrimination, and maintain a positive reputation.</p><h2 class="mt-5">Creating an Inclusive Culture</h2><p>Uncover strategies for fostering an inclusive culture where every voice is heard and valued. Dive into techniques for reducing bias, challenging stereotypes, and promoting equal opportunities for all employees.</p><h2 class="mt-5">Driving Organizational Success</h2><p>Equip your team with the skills to excel in today’s diverse marketplace. The Highfield bite size e-learning course empowers individuals to embrace diversity, drive innovation, and propel organizational success.</p><h2 class="mt-5">Enrol Now and Transform Your Workplace</h2><p>Ready to unlock the full potential of your organization? Book the course today and embark on a journey towards building a more inclusive, innovative, and successful workplace.</p><div class="detailBorder"><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>What is meant by the term equality and diversity?</li><li>Consequences of inequality</li><li>Human rights</li><li>The Equality Act</li><li>Inclusive and exclusive models&nbsp;of society</li><li>Promoting inclusion</li><li>Creating fairer workplaces</li></ul></div><div class="detailBorder"><h2 class="mt-5">Who Is It Aimed At?</h2><p>Highfield e-learning’s bite size online course in Equality & Diversity caters to employees at all levels, making it an ideal choice for businesses seeking comprehensive training. It serves as a valuable component of the induction process for new hires, ensuring they understand and embrace equality and diversity principles from day one.</p><p>Moreover, this course aligns perfectly with the on-programme element of new apprenticeship standards. By incorporating it into apprenticeship training, organizations can equip apprentices with the essential knowledge, skills, and behaviors needed to seamlessly integrate into the workplace. This holistic approach not only fosters a culture of inclusivity but also enhances apprentices’ readiness to contribute effectively to the organisation’s success.</p></div><div class="detailBorder"><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p></div><div class="detailBorder"><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p></div><div class="detailBorder"><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p></div><div class="detailBorder"><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p></div><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 25.00,
                'duration' => '20 - 40 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'General Data Protection Regulation (GDPR)',
                'course_image' => 'E-learningThumbnail/General Data Protection Regulation (GDPR).jpg',
                'banner_image' => 'Elearning Banners/General Data Protection Regulation (GDPR).jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>General Data Protection Regulation (GDPR)</h1><p>The General Data Protection Regulation (GDPR) came into effect on 25 May 2018. It strengthens existing legislation on how businesses store and process data. Ensuring that your organisation is up to speed with the GDPR is essential, not only to protect your clients’ data, but also to protect your business from fines, penalties and reputational damage.</p></div>',
                'description' => 'he General Data Protection Regulation (GDPR) came into effect on 25 May 2018. It strengthens existing legislation on how businesses store and process data. Ensuring that your organisation is up to speed with the GDPR is essential, not only to protect your clients’ data, but also to protect your business from fines, penalties and reputational damage.',
                'long_desc' => '<p>GDPR e-learning Short Course is designed to help your organisation navigate the introduction of the GDPR. It covers all the essential information on how GDPR affects your business. It is ideal for employees in busy workplaces who need to get up to speed quickly with the requirements of the GDPR.</p><div class="detailBorder"><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>What the GDPR is, and how it affects how your business collects data</li><li>The principles behind how you should&nbsp;process client data</li><li>The rights of individuals over their data,&nbsp;including subject access requests&nbsp;and the right to be forgotten</li><li>The GDPR requirements for your organisation</li><li>What data and personal data is</li><li>Data breaches and penalties</li></ul></div><div class="detailBorder"><h2 class="mt-5">Who Is It Aimed At?</h2><p>Any employee responsible for handling data, as well as their managers. The e-learning course is particularly useful for employees responsible for managing or accessing databases.</p></div><div class="detailBorder"><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p></div><div class="detailBorder"><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p></div><div class="detailBorder"><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p></div><div class="detailBorder"><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p></div><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 25.00,
                'duration' => '20 - 40 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Manual Handling',
                'course_image' => 'E-learningThumbnail/Manual Handling.jpg',
                'banner_image' => 'Elearning Banners/Manual Handling.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Manual Handling</h1><p>Come on, put your back in to it! In most jobs, in almost all sectors, there are elements of manual handling. And with the moving of objects there is often questionable advice from well-meaning friends and colleagues.</p></div>',
                'description' => 'Come on, put your back in to it! In most jobs, in almost all sectors, there are elements of manual handling. And with the moving of objects there is often questionable advice from well-meaning friends and colleagues.',
                'long_desc' => '<p>Injuries as a result of manual handling equate to over one-third of all workplace injuries. This course provides the knowledge and skills to avoid you becoming a part of that statistic.</p><p>This e-learning course offers a comprehensive guide to best practices when it comes to manual handling. Ideal as part of staff induction, as refresher training for existing staff or for those looking to go on to achieve a recognised manual handling qualification.</p><div class="leftContentArea" id="content"><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>The definition of manual handling</li><li>The LITE stairway to safety</li><li>Safe lifting techniques</li><li>Correcting lifting techniques</li><li>Lifting with more than one person</li><li>Examples of manual handling</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>Ideal for employee inductions, refresher training or anyone who will be involved in manual handling as part of their job role.</p><p>The course can also be used as part of the on-programme element of the new apprenticeship standards, supporting the knowledge, skills and behaviours apprentices need to effectively integrate into the workplace.</p><h2 class="mt-5">Course Prerequisites</h2><ul><li>No prior knowledge is required.</li></ul><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course</p><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p></div>',
                'vat' => '',
                'price' => 35.00,
                'duration' => '30 - 40 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Food Safety in Manufacturing',
                'course_image' => 'E-learningThumbnail/Food Safety in Manufacturing.jpg',
                'banner_image' => 'Elearning Banners/Food Safety in Manufacturing.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Food Safety in Manufacturing</h1><p>By law, all food manufacturing businesses must have an effective food safety management system in place. Food safety is a constant concern for the public. It’s important your employees understand their roles and responsibilities.</p><p>In this comprehensive Level 2 Food Safety for Manufacturing e-learning course you’ll delve into critical topics such as hygiene practices, contamination control, and regulatory compliance, all tailored to meet industry standards and regulatory requirements.</p></div>',
                'description' => 'By law, all food manufacturing businesses must have an effective food safety management system in place. Food safety is a constant concern for the public. It’s important your employees understand their roles and responsibilities.',
                'long_desc' => '<p>The course modules will introduce learners to the Hazard Analysis and Critical Control Points management system and help you to understand how to comply with the law, how to work safely and efficiently, and what each crucial step of the HACCP implementation process from delivery to service entails.Our interactive modules, rich multimedia content, and practical assessments guarantee an engaging and effective learning experience.</p><p>Whether you’re a food industry professional seeking compliance or an organization committed to upskilling your workforce, our course provides the flexibility and convenience of online learning without compromising on quality or depth of knowledge.</p><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style&ZeroWidthSpace;</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>Introduction to food safety</li><li>Understand microbiological hazards and how to manage and reduce them</li><li>Get to grips with how food poising occurs, and the measures needed to avoid it</li><li>Learn the essentials on contamination control and how to implement preventative measures</li><li>HACCP from delivery to service – learn the management system that analyses and controls food safety hazards</li><li>Address personal hygiene</li><li>Food premises and equipment</li><li>Handle cleaning and disinfection</li><li>Control pests</li><li>Food Safety Enforcement</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>Designed for people working in a food manufacturing role this course, written by food safety expert Richard Sprenger, meets all legal and mandatory training requirements.</p><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p><span>The e-learning courses are</span>available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '4 - 6 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Food Safety Level 3',
                'course_image' => 'E-learningThumbnail/Food Safety Level 3.jpg',
                'banner_image' => 'Elearning Banners/Food Safety Level 5.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Food Safety Level 3</h1><p>Food safety is a constant concern for the public. It’s important your employees understand their roles and responsibilities.</p><p>Highfield’s Level 3 Food Safety e-learning course is the perfect choice for individuals involved in handling, preparing, or serving food. Whether you’re a seasoned kitchen professional or a budding supervisor, this course is designed to enhance your understanding and practice of food safety principles.</p></div>',
                'description' => 'Food safety is a constant concern for the public. It’s important your employees understand their roles and responsibilities.',
                'long_desc' => '<p>Ideal for kitchen staff seeking to elevate their food preparation practices, supervisors aiming to ensure the safe operation of food handling premises, and anyone in the food industry requiring comprehensive allergen awareness, our Level 3 course builds upon the foundational knowledge provided in our Level 2 course.</p><p>This course caters to a wide spectrum of professionals in the catering sector, including restaurants, cafes, hotels, bars, fast-food outlets, takeaways, mobile food trucks, kitchens, hospitals, schools, and colleges. No matter your role or workplace setting, this Level 3 Food Safety course equips you with the essential skills and insights to uphold the highest standards of food safety and hygiene.</p><p>Enrol today and take your food handling practices to the next level!</p><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li> <strong></strong> Improve your food safety</li><li>Combat microbiological hazards</li><li>Avoid food poisoning</li><li>Control contamination hazards</li><li>Address personal hygiene</li><li>Handle cleaning and disinfection</li><li>Control pests</li><li>Safely handle and store food</li><li>Food safety management systems</li><li>Utilise food premises and equipment</li><li>Understand supervisory management</li><li>Learn food safety legislation and enforcement</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>This Level 3 Foodd Safety online course is designed for supervisors &amp; managers working in a food business this online course meets all mandatory training requirements and is CPD accredited.</p><h2 class="mt-5">Course Prerequisites</h2><p>No prior knowledge is required.</p><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p><span>The e-learning courses are</span>available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 200.00,
                'duration' => '9 - 14 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Food Safety Level 2',
                'course_image' => 'E-learningThumbnail/Food Safety Level 2.jpg',
                'banner_image' => 'Elearning Banners/Food Safety Level 4.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Food Safety Level 2</h1><p>Absolutely, ensuring that your staff are well-trained in food safety is crucial for maintaining the health and satisfaction of your customers, as well as protecting your company’s reputation. Highfield’s Level 2 Food Safety e-learning course is designed to equip your employees with the knowledge and skills they need to handle food safely and hygienically.</p><p>The course covers all the essential aspects of food safety, including personal hygiene, food handling practices, cleaning and sanitation procedures, and food safety regulations.</p></div>',
                'description' => 'Absolutely, ensuring that your staff are well-trained in food safety is crucial for maintaining the health and satisfaction of your customers, as well as protecting your company’s reputation. Highfield’s Level 2 Food Safety e-learning course is designed to equip your employees with the knowledge and skills they need to handle food safely and hygienically.',
                'long_desc' => '<p>Being an e-learning course, it offers flexibility in terms of when and where your employees can complete the training. They can learn at their own pace, fitting the training around their work schedules.</p><p>By investing in the Highfield Food Safety Level 2 e-learning course for your staff, you’re not only fulfilling your legal obligations but also taking proactive steps to ensure the safety and satisfaction of your customers. It’s an investment in the long-term success and reputation of your business.</p><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>Introduction to food safety</li><li>Combat microbiological hazards</li><li>Avoid food poisoning</li><li>Control contamination hazards</li><li>Address personal hygiene</li><li>Handle cleaning and disinfection</li><li>Control pests</li><li>Safely handle and store food</li><li>Food safety management systems – HACCP</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>This course is ideal for those who work in a catering environment. This may include restaurants, cafes, hotels, bars, fast-food outlets, takeaways, mobile food trucks, kitchens, hospitals, schools and colleges.</p><h2 class="mt-5">Course Prerequisites</h2><ul><li>No prior knowledge is required.</li></ul><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p><span>The e-learning courses are</span>available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 40.00,
                'duration' => '4 - 6 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Food Safety Level 1',
                'course_image' => 'E-learningThumbnail/Food Safety Level 2.jpg',
                'banner_image' => 'Elearning Banners/Food Safety Level 4.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Food Safety Level 1</h1><p>Food businesses must, by law, ensure that all staff have received the appropriate level of safety and hygiene training commensurate with their role and risk.</p><p>This Level 1 online course can be used as useful induction programme for those undertaking work-experience in a food business, and for anyone with a keen interest in learning more about the basic principles of food safety and hygiene.</p></div>',
                'description' => 'Food businesses must, by law, ensure that all staff have received the appropriate level of safety and hygiene training commensurate with their role and risk.',
                'long_desc' => '<ul>
                    <li>Meets the UK&rsquo;s mandatory training requirement for food handlers</li>
                    <li>Covers the key syllabus of RQF level 1 food safety qualifications</li>
                    <li>CPD-accredited training</li>
                    <li>Self-paced study hosted online</li>
                    <li>Compatible with desktop, laptop and tablet devices</li>
                    <li>Accessible with features including audio voiceover and transcript</li>
                    <li>PDF certificate available immediately on completion</li>
                    <li>Accredited by Highfield Qualifications, the UK&rsquo;s leading provider of regulated food safety qualifications</li>
                    </ul>
                    <h2 class="mt-5">This Course at a Glance</h2>
                    <ul>
                    <li>Interactive exercises/gaming</li>
                    <li>Media-rich content</li>
                    <li>Interactive 3D scenarios</li>
                    <li>Content provided by sector-leading experts</li>
                    <li>Relevant photography and illustrations</li>
                    <li>Multi-generational content and style&ZeroWidthSpace;</li>
                    </ul>
                    <p><strong>Areas covered:</strong></p>
                    <ul>
                    <li>Introduction to food safety</li>
                    <li>Microbiological hazards</li>
                    <li>Food poisoning and its control</li>
                    <li>Contamination hazards and controls</li>
                    <li>Safe handling and the storage of food</li>
                    <li>Personal hygiene</li>
                    <li>Food pests and pest control</li>
                    <li>Cleaning and disinfection</li>
                    </ul>
                    <h2 class="mt-5">Who Is It Aimed At?</h2>
                    <p><span>Designed for individuals employed in catering environments where direct involvement in high-risk food preparation or handling is not required, this online course is also suitable for those working in settings where food is handled externally or dealing primarily with low-risk food items. </span></p>
                    <p><span>Additionally, it serves as an excellent resource for individuals handling pre-packaged or wrapped food products.</span></p>
                    <h2 class="mt-5">Course Prerequisites</h2>
                    <ul>
                    <li>No prior knowledge is required.</li>
                    </ul>
                    <h2 class="mt-5">Assessment</h2>
                    <p>Learners are assessed at the end of the course by multiple-choice questions.</p>
                    <h2 class="mt-5">Certification</h2>
                    <p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>
                    <h2 class="mt-5">Technical Requirements</h2>
                    <p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p>
                    <h2 class="mt-5">How it Works?</h2>
                    <p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p>
                    <p>Simply log on to the <a href="https://training4employment.highfieldelearning.com/" target="_blank" rel="noopener noreferrer">Training4Employment Learner Management System (LMS)</a> and work your way through the course, along with the scenarios that will provide you with real-life context.</p>
                    <p>At the end of the course, there will be multiple-choice questions assessment.</p>
                    <h2 class="mt-5">Certification</h2>
                    <p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 35.00,
                'duration' => '2 - 3 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'An Awareness of Warehousing and Storage',
                'course_image' => 'E-learningThumbnail/An Awareness of Warehousing and Storage.jpg',
                'banner_image' => 'Elearning Banners/An Awareness of Warehousing and Storage.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>An Awareness of Warehousing and Storage</h1><p>With over 2 million individuals employed in the warehousing, storage, and logistics sector in the UK, contributing an estimated £93 billion to the nation’s economy, it’s clear this industry is a significant driver of growth.</p><p>This Highfield Level 2 An Awareness of Warehousing and Storage e-learning course serves as a valuable resource for individuals seeking to deepen their understanding of safe and efficient practices within warehouse and storage environments.</p></div>',
                'description' => 'With over 2 million individuals employed in the warehousing, storage, and logistics sector in the UK, contributing an estimated £93 billion to the nation’s economy, it’s clear this industry is a significant driver of growth.',
                'long_desc' => '<p>It’s important to note that while this e-learning course enhances knowledge and skills, it does not confer a formal qualification. Learners must undertake training and assessment through an approved provider to obtain certification.</p><h2 class="mt-5">This Course at a Glance</h2><ul><li>Interactive exercises/gaming</li><li>Media-rich content</li><li>Interactive 3D scenarios</li><li>Content provided by sector-leading experts</li><li>Relevant photography and illustrations</li><li>Multi-generational content and style&ZeroWidthSpace;</li></ul><p> <strong>Areas covered:</strong> </p><ul><li>Working safely</li><li>Health and Safety at Work etc. Act 1974 and COSHH</li><li>First aid</li><li>Workplace safety monitoring</li><li>Manual handling</li><li>Working relationships</li><li>Job descriptions</li><li>Organisational policies and procedures</li><li>Misunderstandings and difficulties</li><li>Food safety enforcement</li><li>Health and safety and security</li><li>Environmental factors</li><li>Legal requirements</li><li>Operating requirements</li><li>Personal protective equipment</li><li>Personal health and hygiene standards</li><li>Replenishment</li><li>Waste disposal</li></ul><h2 class="mt-5">Who Is It Aimed At?</h2><p>The course is ideal for learners undertaking the level 2 certificate in warehousing and storage (RQF) or staff working within a warehouse or storage facility who wish to further their knowledge.</p><h2 class="mt-5">Course Prerequisites</h2><ul><li>No prior knowledge is required.</li></ul><h2 class="mt-5">Assessment</h2><p>Learners are assessed at the end of the course by multiple-choice questions.</p><h2 class="mt-5">Certification</h2><p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p><h2 class="mt-5">Technical Requirements</h2><p>The e-learning courses are available to use on multiple platforms such as tablets, PCs and laptops, except smart phones. All you need is a Laptop/Tablet or PC and an internet connection.</p><h2 class="mt-5">How it Works?</h2><p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p><p>Simply log on to theTraining4Employment Learner Management System (LMS)and work your way through the course, along with the scenarios that will provide you with real-life context.</p><p>At the end of the course, there will be multiple-choice questions assessment.</p><h2 class="mt-5">Certification</h2><p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 145.00,
                'duration' => '2 - 3 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Customer Service',
                'course_image' => 'E-learningThumbnail/Customer Service.jpg',
                'banner_image' => 'Elearning Banners/Customer Service.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><p class="h5">Discover the Impact of Superior Customer Service on Your Business.</p><h1>Customer Service</h1><p>Recent studies indicate a significant shift in consumer behavior: by 2020, the primary factor influencing purchasing decisions will no longer be solely product quality or pricing, but rather the caliber of service and overall customer experience.</p><p>Elevate your business’s customer service standards with the Level 2 comprehensive online training course offered by Highfield e-learning.</p></div>',
                'description' => 'Recent studies indicate a significant shift in consumer behavior: by 2020, the primary factor influencing purchasing decisions will no longer be solely product quality or pricing, but rather the caliber of service and overall customer experience.',
                'long_desc' => '<p>Whether utilized as part of a Level 2 customer service qualification training or independently for your staff and managers, the Highfield Level 2 Customer   Service e-learning course equips learners with the essential skills to excel in delivering exceptional customer service within your organization.</p>
                    <p>Covering fundamental principles and strategies for understanding and
                    preempting customer needs, this course is designed to deliver information in
                    accessible, interactive modules.</p>
                    <h2 class="mt-5">This Course at a Glance</h2>
                    <ul>
                    <li>Interactive exercises/gaming</li>
                    <li>Media-rich content</li>
                    <li>Interactive 3D scenarios</li>
                    <li>Content provided by sector-leading experts</li>
                    <li>Relevant photography and illustrations</li>
                    <li>Multi-generational content and style</li>
                    </ul>
                    <p> <strong>Areas covered:</strong> </p>
                    <ul>
                    <li>Customer service principles</li>
                    <li>Customers’ needs and expectations</li>
                    <li>Behaviour and interpersonal skills</li>
                    <li>Responding to problems or complaints</li>
                    </ul>
                    <h2 class="mt-5">Who Is It Aimed At?</h2>
                    <p>
                    The course is useful for staff, managers and apprentices working within any
                    business. It may be useful for any learner looking to gain a recognised level
                    2 qualification in customer service.
                    </p>
                    <h2 class="mt-5">Course Prerequisites</h2>
                    <ul>
                    <li>No prior knowledge is required.</li>
                    </ul>
                    <h2 class="mt-5">Assessment</h2>
                    <p>
                    Learners are assessed at the end of the course by multiple-choice questions.
                    </p>
                    <h2 class="mt-5">Certification</h2>
                    <p>
                    Learners will receive a Highfield e-learning completion certificate, which is
                    downloadable upon successfully finishing the course.
                    </p>
                    <h2 class="mt-5">Technical Requirements</h2>
                    <p>
                    The e-learning courses are available to use on multiple platforms such as
                    tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet
                    or PC and an internet connection.
                    </p>
                    <h2 class="mt-5">How it Works?</h2>
                    <p>
                    E-learning courses are available to use on multiple platforms such as tablets,
                    PCs and laptops.
                    </p>
                    <p>
                    Simply log on to the
                    <a
                    href="https://training4employment.highfieldelearning.com/"
                    target="_blank"
                    rel="noopener noreferrer">Training4Employment Learner Management System (LMS)</a> and work your way through the course, along with the scenarios that will provide you with real-life context.
                    </p>
                    <p>At the end of the course, there will be multiple-choice questions assessment.</p>
                    <h2 class="mt-5">Certification</h2>
                    <p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '1 - 2 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Introduction to Working at Height',
                'course_image' => 'E-learningThumbnail/Introduction to Working at Height.jpg',
                'banner_image' => 'Elearning Banners/Introduction to Working at Height.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Introduction to Working at Height</h1><p>The introduction to working at height for new employees in the UK is essential for ensuring a safe working environment, legal compliance, and the overall well-being of employees. It equips them with the knowledge and skills necessary to perform their tasks at height safely and contributes to a culture of safety within the organization.</p><p>Falls from height are not limited to a specific industry; they can occur across a wide range of sectors. Construction, agriculture, manufacturing, telecommunications, and maintenance are just a few examples where employees face the risk of falling while performing their duties.</p></div>',
                'description' => 'The introduction to working at height for new employees in the UK is essential for ensuring a safe working environment, legal compliance, and the overall well-being of employees. It equips them with the knowledge and skills necessary to perform their tasks at height safely and contributes to a culture of safety within the organization.',
                'long_desc' => '<p>By providing employees, especially new starters, with this foundational knowledge, employers can promote a culture of safety and ensure that everyone understands their responsibilities when working at heights. Additionally, offering this training online allows for flexibility and accessibility, making it easier for employees to complete the course at their own pace, regardless of their location or schedule.</p><h2 class="mt-5">This Course at a Glance</h2>
                <ul>
                <li>Interactive exercises/gaming</li>
                <li>Media-rich content</li>
                <li>Interactive 3D scenarios</li>
                <li>Content provided by sector-leading experts</li>
                <li>Relevant photography and illustrations</li>
                <li>Multi-generational content and style</li>
                </ul>
                <p> <strong>Areas covered:</strong> </p>
                <ul>
                <li>Food Safety Enforcement</li>
                <li>Learn what working at height is</li>
                <li>Planning work at height&nbsp; – what should be considered?</li>
                <li>The work at height hierarcy of control</li>
                <li>Safe systems for working at height</li>
                <li>Equipment for working at height</li>
                <li>Rooftops and fragile surfaces</li>
                <li>Voids and holes</li>
                <li>Situational awareness</li>
                <li>Risk assessments</li>
                <li>Learn the importance of a risk assessment and knowing when to cease work</li>
                </ul>
                <h2 class="mt-5">Who Is It Aimed At?</h2>
                <p><span>An online training course on working at heights is a valuable resource, especially for new employees who may not have prior experience or knowledge in this area. Understanding the basics of working at heights is crucial for ensuring safety in the workplace and preventing accidents or injuries.</span></p>
                <h2 class="mt-5">Course Prerequisites</h2>
                <ul>
                <li>No prior knowledge is required.</li>
                </ul>
                <h2 class="mt-5">Assessment</h2>
                <p>Learners are assessed at the end of the course by multiple-choice questions.</p>
                <h2 class="mt-5">Certification</h2>
                <p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>
                <h2 class="mt-5">Technical Requirements</h2>
                <p><span>The e-learning courses are</span> available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p>
                <h2 class="mt-5">How it Works?</h2>
                <p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p>
                <p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p>
                <p>At the end of the course, there will be multiple-choice questions assessment.</p>
                <h2 class="mt-5">Certification</h2>
                <p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 55.00,
                'duration' => '40 - 90 min',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
            [
                'name' => 'Asbestos Awareness',
                'course_image' => 'E-learningThumbnail/Asbestos Awareness.jpg',
                'banner_image' => 'Elearning Banners/Asbestos Awareness.jpg',
                'color_code' => '#05acba',
                'category_id' => 7,
                'qualification' => '1',
                'key_information' => '',
                'banner_description' => '<div class="bannerInfo banerBulletIcon"><h1>Asbestos Awareness</h1><p>If you’re occupying a building constructed before 2000, chances are it contains asbestos, a material linked to approximately 5,000 deaths annually due to its severe health risks.</p><p>Employers bear the responsibility of ensuring that individuals potentially encountering asbestos during their routine tasks comprehend its nature and how to handle it safely, minimising risks to themselves and others.</p></div>',
                'description' => 'If you’re occupying a building constructed before 2000, chances are it contains asbestos, a material linked to approximately 5,000 deaths annually due to its severe health risks.',
                'long_desc' => '<p>Highfield’s Asbestos Awareness e-learning course exclusively covers Category A training. It’s tailored to equip individuals who may encounter asbestos with essential knowledge on its identification, locations, associated hazards, and preventive measures against accidental exposure.</p><p>By completing this course, learners will acquire the necessary expertise to handle asbestos safely, ensuring their own and others’ safety in the process.</p><h2 class="mt-5">This Course at a Glance</h2>
                <ul>
                <li>Interactive exercises/gaming</li>
                <li>Media-rich content</li>
                <li>Interactive 3D scenarios</li>
                <li>Content provided by sector-leading experts</li>
                <li>Relevant photography and illustrations</li>
                <li>Multi-generational content and style&ZeroWidthSpace;</li>
                </ul>
                <p> <strong>Areas covered:</strong> </p>
                <ul>
                <li>What asbestos is</li>
                <li>Where it can be found</li>
                <li>Asbestos-related death</li>
                <li>Health implications of asbestos exposure</li>
                <li>Working with asbestos</li>
                <li>Preventing accidental asbestos exposure</li>
                </ul>
                <h2 class="mt-5">Who Is It Aimed At?</h2>
                <p>Highfield Asbestos Awareness e-learning course is aimed at anyone who could disturb asbestos while carrying out their everyday work.</p>
                <h2 class="mt-5">Course Prerequisites</h2>
                <ul>
                <li>No prior knowledge is required.</li>
                </ul>
                <h2 class="mt-5">Assessment</h2>
                <p>Learners are assessed at the end of the course by multiple-choice questions.</p>
                <h2 class="mt-5">Certification</h2>
                <p>Learners will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>
                <h2 class="mt-5">Technical Requirements</h2>
                <p><span>The e-learning courses are</span> available to use on multiple platforms such as tablets, PCs and laptops, except smartphones. All you need is a Laptop/Tablet or PC and an internet connection.</p>
                <h2 class="mt-5">How it Works?</h2>
                <p>E-learning courses are available to use on multiple platforms such as tablets, PCs and laptops.</p>
                <p>Simply log on to the Training4Employment Learner Management System (LMS) and work your way through the course, along with the scenarios that will provide you with real-life context.</p>
                <p>At the end of the course, there will be multiple-choice questions assessment.</p>
                <h2 class="mt-5">How it Works?</h2>
                <p>You will receive a Highfield e-learning completion certificate, which is downloadable upon successfully finishing the course.</p>',
                'vat' => '',
                'price' => 45.00,
                'duration' => '1 - 2 hours',
                'awarding_bodies' => '1',
                'delivery_mode' => 'Elearning',
                'course_type' => 'OpenCourse',
                'faqs' => '{}',
                'course_structure' => '',
                'requirements' => '',
                'user_id' => 1
            ],
        ];

        foreach ($courses as $course) {
            $course = Course::create([
                'name' => $course['name'],
                'course_image' => $course['course_image'],
                'banner_image' => $course['banner_image'],
                'slug' => Str::slug($course['name']),
                'color_code' => $course['color_code'],
                'category_id' => $course['category_id'],
                'qualification' => $course['qualification'],
                'key_information' => $course['key_information'],
                'banner_description' => $course['banner_description'],
                'description' => $course['description'],
                'long_desc' => $course['long_desc'],
                'course_structure' => $course['course_structure'],
                'price' => $course['price'],
                'duration' => $course['duration'],
                'requirements' => $course['requirements'],
                'awarding_bodies' => $course['awarding_bodies'],
                'delivery_mode' => $course['delivery_mode'],
                'course_type' => $course['course_type'],
                'faqs' => $course['faqs'],
                'user_id' => $course['user_id'],
                'certification' => 'External',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            // Check if the course is "SIA Door Supervisor"
            if ($course->name == "SIA Door Supervisor") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "PI Health Questioner",
                    "DS Activity Sheet",
                    "DS Distance Learning Booklet",
                    "PI Techniques Questionnaire",
                    "Course Evaluation Form",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];
                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(J/617/9686) Principles of working in the private security industry – MCQ",
                    "(J/617/9686) Principles of working in the private security industry – Practical",
                    "(L/617/9687) Principles of working as a door supervisor in the private security industry – MCQ",
                    "(L/617/9687) Principles of working as a door supervisor in the private security industry – Practical",
                    "(Y/617/9689) Application of physical intervention skills in the private security industry – MCQ",
                    "(Y/617/9689) Application of physical intervention skills in the private security industry – Practical",
                    "(R/617/9688) Application of conflict management in the private security industry – MCQ",
                    "(R/617/9688) Application of conflict management in the private security industry – Practical",
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "ACT Awareness",
                    "ACT Security"
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }


            // "Door Supervisor Refresher"
            if ($course->name == "Door Supervisor Refresher") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "PI Health Questioner",
                    "DS Refresher Coursebook",
                    "DS Refresher WorkBook Unit 1",
                    "DS Refresher WorkBook Unit 2",
                    "Course Evaluation Form",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – MCQ",
                    "(D/651/3643) Principles of Working as a Door Supervisor in the Private Security Industry (Refresher) - Practical",
                    "(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – MCQ",
                    "(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – Practical"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "ACT Awareness",
                    "ACT Security"
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }


            // "SIA CCTV Operator"
            if ($course->name == "SIA CCTV Operator") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "CCTV Activity Sheet",
                    "CCTV Distance Learning Booklet",
                    "Course Evaluation Form",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – MCQ",
                    "(J/617/9686) Principles of working in the private security industry – Practical",
                    "(R/617/9691) Principles and Practices of Working as a CCTV Operator in the Private Security Industry – MCQ",
                    "(R/617/9691) Principles and Practices of Working as a CCTV Operator in the Private Security Industry – Practical",
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "ACT Awareness",
                    "ACT Security"
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }


            // "Security Guard Refresher"
            if ($course->name == "Security Guard Refresher") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "PI Health Questioner",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – MCQ",
                    "(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – Practical"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "ACT Awareness",
                    "ACT Security"
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }

            // "First Aid at Work"
            if ($course->name == "First Aid at Work") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "A/650/2021 Emergency First Aid in the Workplace and D/650/2022 Recognition and Management of Illness and Injury in the Workplace – MCQ",
                    "A/650/2021 Emergency First Aid in the Workplace and D/650/2022 Recognition and Management of Illness and Injury in the Workplace – Practical"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "Paediatric First Aid Training Course"
            if ($course->name == "Paediatric First Aid Training Course") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(F/650/2023) Emergency Paediatric First Aid - MCQ",
                    "(H/650/2024) Emergency Paediatric First Aid - Practical"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "Paediatric First Aid",
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }

            // "Emergency First Aid at Work"
            if ($course->name == "Emergency First Aid at Work") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "A/650/2021 Emergency First Aid in the Workplace – MCQ",
                    "A/650/2021 Emergency First Aid in the Workplace – Practical"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // License
                $licenseNames = [
                    "Emergency First Aid at Work",
                ];
                // Fetch task IDs from the database
                $licenseIds = License::whereIn('name', $licenseNames)->pluck('id')->toArray();
                $course->licenses()->attach($licenseIds);

            }

            // "Health and Safety Awareness - HSA"
            if ($course->name == "Health and Safety Awareness - HSA") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "Health and Safety Awareness (HSA)"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "Level 1 Health and Safety Awareness within Construction Environment"
            if ($course->name == "Level 1 Health and Safety Awareness within Construction Environment") {

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

                // Exams
                $examNames = [
                    "(M/616/4115) Health and safety in a construction environment – MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "SSSTS – Site Supervision Safety"
            if ($course->name == "SSSTS – Site Supervision Safety") {

                // Exams
                $examNames = [
                    "Site supervision safety training scheme - MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "SSSTS Refresher"
            if ($course->name == "SSSTS Refresher") {

                // Exams
                $examNames = [
                    "Site supervision safety training scheme - Refresher"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "SMSTS – Site Management Safety"
            if ($course->name == "SMSTS – Site Management Safety") {

                // Exams
                $examNames = [
                    "Site supervision safety training scheme - MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "SMSTS Refresher"
            if ($course->name == "SMSTS Refresher") {

                // Exams
                $examNames = [
                    "Site management safety training scheme - Refresher  - MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

            }

            // "APHL Persolanal Licence"
            if ($course->name == "APHL Persolanal Licence") {

                // Exams
                $examNames = [
                    "(L/616/6762) Personal Licence Holders (APLH) - MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);

            }

            // "FIRE SAFETY FOR FIRE WARDENS"
            if ($course->name == "FIRE SAFETY FOR FIRE WARDENS") {

                // Exams
                $examNames = [
                    "(Y/615/7451) Principles of Fire Safety Awareness - MCQ"
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);

                // Tasks
                $taskNames = [
                    "English Assessment",
                    "Course Start Date Reminder",
                    "Outstanding Tasks Reminder",
                    "Qualification Expire Reminder",
                ];

                $taskIds = Task::whereIn('name', $taskNames)->pluck('id')->toArray();
                $course->tasks()->attach($taskIds);
            }


            // "TRAFFIC MARSHALL TRAININING"
            if ($course->name == "TRAFFIC MARSHALL TRAININING") {
                // Exams
                $examNames = [
                    "Traffic Marshal, Vehicle Banksman - MCQ",
                    "Traffic Marshal, Vehicle Banksman - Practical",
                ];
                $examIds = Exam::whereIn('name', $examNames)->pluck('id')->toArray();
                $course->exams()->attach($examIds);
            }






        }

    }
}
