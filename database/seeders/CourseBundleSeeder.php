<?php

namespace Database\Seeders;

use Illuminate\Models\CourseBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('course_bundles')->insert([
            [
                'slug' => Str::slug('Emergency First Aid at Work + Door Supervisor Refresher & CCTV Operator'),
                'bundle_image' => 'bundle_image/bundle1.jpeg',
                'name' => 'Emergency First Aid at Work + Door Supervisor Refresher & CCTV Operator',
                'products' => json_encode(["2","3","12"]),
                'short_description' => '<p>Ideal for individuals seeking to renew their SIA door supervisor license and obtain SIA CCTV license.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Online Learning + Self Study + 5.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>By bundling the Door Supervisor Refresher and CCTV courses together, you can renew your door supervisor license and qualify for a CCTV license while saving time and money.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 382.95,
                'vat' => 42.55,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor Refresher</td>
                <td style="text-align: center;">CCTV Operator, Public Surveillance</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 18+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">1.5 Days</td>
                <td style="text-align: center;">3 Days</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">2 Free Resits</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door Supervisor & CCTV Bundle'),
                'bundle_image' => 'bundle_image/bundle2.webp',
                'name' => 'Door Supervisor & CCTV Bundle',
                'products' => json_encode(["1","3","12"]),
                'short_description' => '<p>Ideal for individuals seeking SIA door supervisor and CCTV licences to kickstart a career in security.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Online Learning + Self Study + 9.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>If you’re interested in getting both a Door Supervisor and CCTV license, you can now save time and money by bundling these two courses together. Additionally, this bundle includes a qualification in Emergency First Aid at Work, which is mandatory for anyone applying for a door supervisor licence through the SIA.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 477.45,
                'vat' => 53.05,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor</td>
                <td style="text-align: center;">CCTV Operator, Public Surveillance</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 18+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">6 Days</td>
                <td style="text-align: center;">3 Days</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">2 Free Resits</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door Supervisor & Health and Safety Awareness (HSA) Bundle'),
                'bundle_image' => 'bundle_image/bundle3.webp',
                'name' => 'Door Supervisor & Health and Safety Awareness (HSA) Bundle',
                'products' => json_encode(["1","6","12"]),
                'short_description' => '<p>Ideal for individuals who want to start a career in security in the construction industry and obtain the SIA door supervisor license and CSCS green card.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Online Learning + Self Study + 7.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>If you are interested in pursuing a career in security and working as a door supervisor within the construction industry, our Door Supervisor and Health and Safety course bundle is the right choice for you. By choosing this bundle, you can save both time and money while also qualifying for a Door Supervisor and CSCS Green Labourer card. Furthermore, this bundle includes a qualification inEmergency First Aid at Work, which is mandatory for anyone applying for a door supervisor license through the SIA.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 428.85,
                'vat' => 47.65,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor</td>
                <td style="text-align: center;">CCTV Operator, Public Surveillance</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 16+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">6 Days</td>
                <td style="text-align: center;">3 Days</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">1 Free Resits</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 5 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door Supervisor, CCTV & Health and Safety Awareness (HSA) Bundle'),
                'bundle_image' => 'bundle_image/bundle4.webp',
                'name' => 'Door Supervisor, CCTV & Health and Safety Awareness (HSA) Bundle',
                'products' => json_encode(["1","3","6","12"]),
                'short_description' => '<p>Ideal for individuals looking to begin a career in construction industry security and obtain SIA door supervisor and CCTV licenses, as well as a CSCS green card.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Online Learning + Self Study + 10.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>If you’re interested in a career in security and working as a door supervisor and CCTV operator in the construction industry, our Door Supervisor, CCTV and Health and Safety course bundle is the perfect choice for you. Opting for this bundle will help you save both time and money while also making you eligible for a Door Supervisor and CCTV licences as well as a CSCS Green Labourer card. Additionally, this bundle also includes a qualification in Emergency First Aid at Work, which is mandatory for anyone applying for a door supervisor license through the SIA.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 610.20,
                'vat' => 67.80,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 188.208px;" border="1"><colgroup><col style="width: 19.9559%;"><col style="width: 19.9559%;"><col style="width: 19.9559%;"><col style="width: 19.9559%;"><col style="width: 19.9559%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor</td>
                <td style="text-align: center;">CCTV Operator, Public Surveillance</td>
                <td style="text-align: center;">Health and |safety Awareness (HSA)</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 16+</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">Face-to-face</td>
                <td style="text-align: center;">Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">6 Days</td>
                <td style="text-align: center;">3 Days</td>
                <td style="text-align: center;">1 Day</td>
                </tr>
                <tr>
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                <td style="text-align: center;">E-Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment</td>
                </tr>
                <tr>
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr>
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">1 Free Resits</td>
                </tr>
                <tr>
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 5 years</td>
                </tr>
                </tbody>
                </table>
                <p>&nbsp;</p>
                <p>* If a delegate fails to achieve 25 marks out of 30 (83%) in the multiple-choice examination, it means that they have failed the exam.<br>However, the delegate may retake the exam for free. They can either retake the exam on the same day or attend another course within<br>90 days (without the obligation to retake the day’s course).<br>In case the delegate scores below 18 marks out of 30 (60%) in the examination, they must book and attend the entire HSA course again<br>before they are allowed to retake the examination. The standard course fee applies in this case.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door Supervisor & Traffic Marshal, Vehicle Banksman Bundle'),
                'bundle_image' => 'bundle_image/bundle5.webp',
                'name' => 'Door Supervisor & Traffic Marshal, Vehicle Banksman Bundle',
                'products' => json_encode(["1","12","14"]),
                'short_description' => '<p>Ideal for individuals seeking SIA door supervisor licenses and skills essential for safely guiding large vehicles around a site.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Online Learning + Self Study + 6.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>If you are interested in working as a door supervisor and pursuing a career in security, it would be beneficial to obtain a traffic marshal or vehicle banksman card. This will enable you to work as a reversing assistant or banksman and help prevent large goods vehicle reversing accidents, making you stand out from other security operatives.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 356.85,
                'vat' => 39.65,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor</td>
                <td style="text-align: center;">Traffic Marshal, Vehicle Banksman</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 18+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">6 Days</td>
                <td style="text-align: center;">2 hours</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">Free</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door supervisor Refresher & Traffic Marshal, Vehicle Banksman Bundle'),
                'bundle_image' => 'bundle_image/bundle6.jpeg',
                'name' => 'Door supervisor Refresher & Traffic Marshal, Vehicle Banksman Bundle',
                'products' => json_encode(["2","12","14"]),
                'short_description' => '<p>Ideal for individuals looking to begin a career in construction industry security and obtain SIA door supervisor and CCTV licenses, as well as a CSCS green card.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>4.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>If you are renewing your door supervisor licence you might be interested in also gaining a traffic marshal, vehicle banksman card. This will enable you to work as a reversing assistant or banksman and help prevent large goods vehicle reversing accidents, making you stand out from other security operatives.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 261.90,
                'vat' => 29.10,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Door Supervisor Refresher</td>
                <td style="text-align: center;">Traffic Marshal, Vehicle Banksman</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 18+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">1.5 Days</td>
                <td style="text-align: center;">2 hours</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">Free</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Health and Safety Awareness (HSA) & Traffic Marshal, Vehicle Banksman Bundle'),
                'bundle_image' => 'bundle_image/bundle7.webp',
                'name' => 'Health and Safety Awareness (HSA) & Traffic Marshal, Vehicle Banksman Bundle',
                'products' => json_encode(["6","14"]),
                'short_description' => '<p>Ideal for individuals seeking to renew their SIA door supervisor license and gain skills essential for safely guiding large vehicles around a site.</p>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-check"></i> <strong>Various Start Dates</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Unlimited Tutor Support</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>Same Day Results</strong></li>
                    <li><i class="fa-solid fa-check"></i> <strong>1.5 Days Face-to-Face Training</strong></li>
                </ul>',
                'excerpt' => '<p>Looking to kickstart your career in the construction industry? Our course bundle can help you qualify for a CSCS green labourer card and gain certification in traffic marshal and vehicle banksman skills. Additionally, this bundle includes an Emergency First Aid at Work qualification.</p>',
                'long_description' => '<h2>Why Choose Training for Employment?</h2>
                <p>With a reputation for excellence and industry relevance, our training programs are designed to equip you with the knowledge and skills needed to succeed in today’s security landscape.</p>
                <strong>Industry-Recognized Certifications:</strong>
                <p>Our training programs prepare you for industry-recognized certifications accredited by Highfield Qualifications, giving you a competitive edge in the job market.</p>
                <strong>Expert Instructors: </strong>
                <p>Learn from seasoned industry professionals who bring real-world experience and expertise to the classroom. Our instructors are dedicated to providing practical insights, valuable tips, and personalised guidance to help you excel in your security career.</p>
                <strong>Flexible Learning Options:</strong>
                <p>We understand that balancing work, family, and education can be challenging. That’s why our courses are delivered via blended learning combining the flexibility of online modules with the support of in-person classes. By offering this hybrid approach, we aim to provide you with the convenience you need to pursue your educational goals while still managing your other responsibilities. Our goal is to support you every step of the way, ensuring that you have the resources and assistance necessary to succeed in your academic journey. With our blended learning model, we hope to make education more accessible and achievable for everyone, no matter how busy life may get.</p>',
                'regular_price' => 193.50,
                'vat' => 21.50,
                'courses_included' => '<table style="border-collapse: collapse; width: 100.037%; height: 331.625px;" border="1"><colgroup><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"><col style="width: 25.0276%;"></colgroup>
                <tbody>
                <tr style="height: 58.25px;">
                <td>&nbsp;</td>
                <td style="text-align: center;">Emergency First Aid at Work</td>
                <td style="text-align: center;">Health and Safety Awareness (HSA)</td>
                <td style="text-align: center;">Traffic Marshal, Vehicle Banksman</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Entry Requirement</strong></td>
                <td style="text-align: center;">Age 16+</td>
                <td style="text-align: center;">Age 18+</td>
                <td style="text-align: center;">Age 18+</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Delivery Mode</strong></td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">E-learning + Face-to-face</td>
                <td style="text-align: center;">Face-to-face</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Duration</strong></td>
                <td style="text-align: center;">4 hours</td>
                <td style="text-align: center;">1 Day</td>
                <td style="text-align: center;">2 hours</td>
                </tr>
                <tr style="height: 58.25px;">
                <td><strong>Assessment</strong></td>
                <td style="text-align: center;">MCQ Assessment + Practical-to-face</td>
                <td style="text-align: center;">MCQ Assessment</td>
                <td style="text-align: center;">MCQ Assessment</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Exam Results</strong></td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                <td style="text-align: center;">Same Day</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Resits</strong></td>
                <td style="text-align: center;">Free</td>
                <td style="text-align: center;">2 Free Resits</td>
                <td style="text-align: center;">Free Resits</td>
                </tr>
                <tr style="height: 35.8542px;">
                <td><strong>Certification</strong></td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                <td style="text-align: center;">Valid for 3 years</td>
                </tr>
                </tbody>
                </table>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
