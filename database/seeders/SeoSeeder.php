<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'robots' => 'no index, no follow',

        $seos = [
            [
                'slug' => route('home.index'),
                'meta_title' => 'SIA Training Course Birmingham - Training 4 Employment',
                'meta_description' => 'Join our SIA Training Course Birmingham with Training 4 Employment. Gain essential security skills and certification for career advancement.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url('examination-requirements'),
                'meta_title' => 'SIA Examination Requirements',
                'meta_description' => 'Find key essential SIA examination requirements for training courses, covering guidelines, prerequisites, and assessment details for success.',
                'meta_keywords' => 'examination requirements,examination,SIA requirement,SIA Examination',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('expert.resources'),
                'meta_title' => 'Discover Free, Expert Resources',
                'meta_description' => 'Discover free, expert resources for SIA security training and construction safety certifications. Access comprehensive guides, eBooks, and toolkits designed to help you stay up to date with industry regulations and prepare for career advancement. Download high-quality materials today and build the skills you need for success.',
                'meta_keywords' => 'resources,Security career preparation,Construction safety guides,Employment training resources,Discover free expert resources',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('contact'),
                'meta_title' => 'Contact - Training4Employment',
                'meta_description' => 'Get in touch with Training 4 Employment for all your training needs. Contact us for course details, enrollment, and support. We are here to help!',
                'meta_keywords' => 'Contact,training4employment contact',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('courses.index'),
                'meta_title' => 'SIA Courses',
                'meta_description' => 'Join Training4Employment for comprehensive SIA courses. Get expert-led security training and certification to elevate your career. Enroll now!',
                'meta_keywords' => 'SIA Courses,first aid training,sia door supervisor,door supervisor refresher,door supervisor refresher course',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('elearning.index'),
                'meta_title' => 'E-learning',
                'meta_description' => 'Explore Training4Employment e-learning for food safety courses, food safety training, and customer services training. Flexible, expert-led learning.',
                'meta_keywords' => 'e-learning,customer service course,food safety course,food safety training',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url('category/construction'),
                'meta_title' => 'Construction Courses - Training4Employment',
                'meta_description' => 'In-house or on-site Construction Courses available at Training4Employment. Choose from Site Safety Plus, EUSR, CSCS or short courses.',
                'meta_keywords' => 'construction courses,construction environment course,Site supervision safety training course,Site management safety training course,Site Supervision Safety Training course refresher',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url('category/sia-security-training'),
                'meta_title' => 'Security Courses - Training4Employment',
                'meta_description' => 'Affordable SIA security courses: Door Supervisor, CCTV, Close Protection, and Top-Up training. In-house/off-site options. Book online now.',
                'meta_keywords' => 'Security courses,Security training,Professional security training,get licensed,SIA security training courses',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url('category/alcohol'),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url('category/e-learning-and-bite-size-courses'),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("category/fire-safety-for-fire-wardens"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("category/first-aid-training"),
                'meta_title' => 'First Aid Training Courses',
                'meta_description' => 'Join our 3-day SIA First Aid Training Course &amp; 1-day First Aid training from £59. Free parking &amp; resist, group discounts available. Book online today!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("category/traffic-marshall-training"),
                'meta_title' => 'Training4Employment Traffic Marshall and Banksman Training',
                'meta_description' => 'Book a half-day Traffic Marshall course in Birmingham for only £59.99 and get trained by experts at Training for Employment - Book Online Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('checkout.thankyou'),
                'meta_title' => 'thankyou',
                'meta_description' => 'Training4Employment is reviewing your quote request for tailored solutions. Explore our training programs and success stories while you wait.',
                'meta_keywords' => 'Training4Employment,Request for a quote,Business support,Career advancement,Workforce training',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('locations.show', 'leicester'),
                'meta_title' => 'SIA Security Training Courses in Leicester - Training4Employment',
                'meta_description' => 'Kickstart your career in security, safety, and traffic management with accredited training courses from Training for Employment in Leicester. Enrol today!',
                'meta_keywords' => 'Leicester,SIA Security Training in Leicester,door supervisor course,first aid certification,cscs green card',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('locations.show', 'nottingham'),
                'meta_title' => 'SIA Security Training Courses in Nottingham - Training4Employment',
                'meta_description' => 'Your journey toward a rewarding career in the safety and security fields begins here at Training for Employment. We offer top-quality, accredited training',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('locations.show', 'manchester'),
                'meta_title' => 'SIA Security Training Courses in Manchester - Training4Employment',
                'meta_description' => 'This is the first step on your route to a rewarding career in the security and safety industries. Training for Employment offers top-notch, licensed training',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('locations.show', 'birmingham'),
                'meta_title' => 'SIA Security Training Courses in Birmingham - Training4Employment',
                'meta_description' => 'Here at Training for Employment, you can start your path to a fulfilling career in the safety and security industries. We provide excellent, authorised',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => route('locations.show', 'london'),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/first-aid-training-at-work"),
                'meta_title' => 'First Aid at Work Training - E-learning Course',
                'meta_description' => 'This course gives learners the opportunity to undertake online first-aid training and go on to achieve the level 3 Award in First Aid at Work (RQF).',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/paediatric-first-aid"),
                'meta_title' => 'Paediatric First Aid Training - Online',
                'meta_description' => 'Paediatric first aid e-learning course is ideal for anyone looking after infants and children such as carers, childminders and schools.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/principles-of-the-role-of-a-fire-marshal"),
                'meta_title' => 'Principles of the Role of a Fire Marshal - Online Training',
                'meta_description' => 'Learn to mitigate against the risk of fire in the workplace - an interactive 2-3 hours e-learning course. Book Online!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/introduction-to-fire-safety-at-workplace"),
                'meta_title' => 'Introduction to Fire Safety at Workplace Training - Online',
                'meta_description' => 'The Fire Safety in the Workplace online course educates employees on understanding the risks of fire and implementing steps to mitigate those risks.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/awareness-of-modern-slavery"),
                'meta_title' => 'Awareness of Modern Slavery Training - E-learning Course',
                'meta_description' => 'Discover the harsh realities of modern-day slavery through this comprehensive e-learning course. Start learning online now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/equality-and-diversity"),
                'meta_title' => 'Equality and Diversity - E-learning Course',
                'meta_description' => 'Highfield bite-size e-learning course in Equality &amp; Diversity is ideal for all levels of employee within a business. Enrol Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/general-data-protection-regulation-gdpr"),
                'meta_title' => 'General Data Protection Regulation (GDPR) Training - E-learning Course',
                'meta_description' => 'Unravel the complexities of the GDPR in just 30 minutes. The course covers all the essential information on how GDPR affects your business.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/manual-handling"),
                'meta_title' => 'Manual Handling Training - E-learning Course',
                'meta_description' => 'This course gives learners the opportunity to undertake online first-aid training and go on to achieve the level 3 Award in First Aid at Work (RQF).',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/food-safety-in-manufacturing"),
                'meta_title' => 'Food Safety in Manufacturing Training - E-learning Course',
                'meta_description' => 'This course gives learners the opportunity to undertake online first-aid training and go on to achieve the level 3 Award in First Aid at Work (RQF).',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/food-safety-level-3"),
                'meta_title' => 'Food Safety Level 3 - Online',
                'meta_description' => 'The Food Safety Level 3 online course for supervisors &amp; managers working in a food business. CPD accredited.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/food-safety-level-2"),
                'meta_title' => 'Food Safety Level 2 Training - E-learning Course',
                'meta_description' => 'This course gives learners the opportunity to undertake online first-aid training and go on to achieve the level 3 Award in First Aid at Work (RQF).',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/an-awareness-of-warehousing-and-storage"),
                'meta_title' => 'An Awareness of Warehousing and Storage - E-learning',
                'meta_description' => 'Enhance your understanding of safe warehouse practices and gain essential knowledge with Highfield’s e-learning course.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/customer-service"),
                'meta_title' => 'Customer Service - E-learning',
                'meta_description' => 'Unlock the power of superior customer service with our Highfield Level 2 Customer Service e-learning course. Ideal for staff and managers.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/introduction-to-working-at-height"),
                'meta_title' => 'Introduction to Working at Height - Online Training',
                'meta_description' => 'Introduction to Working at Height online course for new starter inductions, where a basic understanding of work at height is required',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("e-learning/asbestos-awareness"),
                'meta_title' => 'Asbestos Awareness - E-learning Course',
                'meta_description' => 'Discover Highfield&#039;s comprehensive Asbestos Awareness e-learning course, designed to equip you with vital knowledge on asbestos safety. Enroll today!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/sia-door-supervisor"),
                'meta_title' => 'SIA Door Supervisor course - Birmingham, West Midlands',
                'meta_description' => 'Complete your SIA Door Supervisor training and gain essential skills, including conflict management and physical intervention, with exam resits included.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/door-supervisor-refresher"),
                'meta_title' => 'Door Supervisor Refresher Course - Training4Employment',
                'meta_description' => 'Renew your door supervisor licence with the new SIA approved Door Supervisor Refresher course. Free resits! Birmingham | Leicester | Nottingham | Manchester. Book Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/sia-cctv-operator"),
                'meta_title' => 'SIA CCTV Operator Public Surveillance Course - Training4Employment"',
                'meta_description' => 'Get SIA CCTV licence. Book 3 day CCTV Operator course with Training4Employment - £179. Book Online or Call Us on 0121 630 2115 - Free Resits',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/security-guard-refresher"),
                'meta_title' => 'SIA CCTV Operator Public Surveillance Course - Training4Employment',
                'meta_description' => 'Get SIA CCTV licence. Book 3 day CCTV Operator course with Training4Employment - £179. Book Online or Call Us on 0121 630 2115 - Free Resits',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/level-1-health-and-safety-awareness-within-construction-environment"),
                'meta_title' => 'Level 1 Health and Safety within a Construction Environment Online Course',
                'meta_description' => 'This online Level 1 Health and Safety within a Construction Environment online course is the first step in obtaining the CSCS Labourer Green Card. Book Online.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/health-and-safety-awareness-hsa"),
                'meta_title' => 'CSCS Labourer (Green Card) training - Health and Safety Awareness (HSA)',
                'meta_description' => 'CITB accredited CSCS Labourer (Green Card) training - Health and Safety Awareness (HSA) course in Birmingham. Book Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/sssts-site-supervision-safety"),
                'meta_title' => 'SSSTS - Site supervision safety training scheme - Training4Employment',
                'meta_description' => 'This two-day Site Safety Plus course is endorsed by Build UK as the standard training for all supervisors working on Build UK sites - BOOK NOW',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/sssts-refresher"),
                'meta_title' => 'SSSTS-R - Site Supervision Safety Training Scheme - Refresher - Training4Employment',
                'meta_description' => 'This 1-day CITB Site Supervision Safety SSSTS-R refresher course will allow you to renew your SSSTS certificate- Call Now',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/smsts-site-management-safety"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/smsts-refresher"),
                'meta_title' => 'SMSTS-R - Site management safety training scheme-Refresher - Training4Employment',
                'meta_description' => 'This 2-day Site Management Safety SMSTS-R refresher course is ideal for you if you need to renew your SMTS licence. Call Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/first-aid-at-work"),
                'meta_title' => '',
                'meta_description' => 'First Aid at Work - 3 days',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/emergency-first-aid-at-work"),
                'meta_title' => 'Emergency First Aid at Work - in Birmingham &amp; Nottingham',
                'meta_description' => 'Emergency First Aid at Work course in Birmingham, Leicester, Nottingham and Mancheste. Become certified with a practical assessment. Book now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/paediatric-first-aid-training-course"),
                'meta_title' => 'Paediatric First Aid Training Course - 3 days',
                'meta_description' => 'Equip yourself with essential paediatric first aid skills. Join our accredited paediatric first aid training course. Learn CPR, choking relief, and more. Request Quote Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/traffic-marshall-trainining"),
                'meta_title' => 'Training4Employment Traffic Marshall and Banksman Training',
                'meta_description' => 'Book a half-day Traffic Marshall course in Birmingham for only £59.99 and get trained by experts at Training for Employment - Book Online Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/fire-safety-for-fire-wardens"),
                'meta_title' => 'Principles of Fire Safety Level 2 for Fire Wardens/Marshals',
                'meta_description' => 'Anyone who manages fire safety, fire wardens/marshals, will benefit from the Fire Safety Level 2 course. Whether you need delivery on-site or off-site, we can help. Get a Quote!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses/aphl-persolanal-licence"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("products"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/first-aid-handbook"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/cctv-course-book"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/door-supervisor-course-book"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/clip-on-uniform-tie"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/badge-holders"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("product/hand-tally-counter"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("about-us"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("faq"),
                'meta_title' => 'FAQ - Training4Employment',
                'meta_description' => 'No, the licence fee is a separate price. Payment for the license is £190.00 which is payable to the SIA (Security Industry Authority) this can be paid online',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("refer-a-friend"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("corporate-training-solutions"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("help-center"),
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("booking-terms-and-conditions"),
                'meta_title' => 'Booking Terms and Conditions - Training4Employment',
                'meta_description' => 'Our aim is to make it as easy as possible to learn and relate subjects with Training 4 Employment Ltd.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("privacy-policy"),
                'meta_title' => 'Privacy Policy - Training4Employment',
                'meta_description' => 'This website is owned and updated by Training for Employment Ltd (T4E), whose registered office is 89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles"),
                'meta_title' => 'Advanced Security Training Package | Get Certified',
                'meta_description' => 'Advanced Security Training Package &amp; training bundles, SIA Door Supervisor, CSCS certifications. Boost your career with UK online courses.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-refresher-cctv-bundle"),
                'meta_title' => 'Door Supervisor Refresher &amp; CCTV Bundle - Training4Employment',
                'meta_description' => 'By bundling the Door Supervisor Top Up and CCTV courses together,you can renew your door supervisor license and qualify for a CCTVlicense while saving time',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-cctv-bundle"),
                'meta_title' => 'Door Supervisor and CCTV Bundle - Complete Package',
                'meta_description' => 'Get certified! Check out our Door Supervisor &amp; CCTV Bundle or the best prices on Door Supervisor and CCTV courses. Book Now!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-health-and-safety-awareness-hsa-bundle"),
                'meta_title' => 'All Door Supervisor, Health and Safety Awareness HSA Courses',
                'meta_description' => 'Boost your security career growth with our budget-friendly Door Supervisor and HSA courses at Training for Employment.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-cctv-health-and-safety-awareness-hsa-bundle"),
                'meta_title' => 'Door Supervisor CCTV Health and Safety Awareness HSA Package',
                'meta_description' => 'Find competitive prices for Door Supervisor CCTV Courses at Training for Employment. Book your training today!',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-traffic-marshal-vehicle-banksman-bundle"),
                'meta_title' => 'Door Supervisor | Traffic Marshal | Complete Training Course',
                'meta_description' => 'Start your security career with our Door Supervisor and Traffic Marshal training courses. Best prices at Training for Employment.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/door-supervisor-refresher-traffic-marshal-vehicle-banksman-bundle"),
                'meta_title' => 'Door Supervisor Top Up | Traffic Marshal | Training Courses',
                'meta_description' => 'Discover competitive prices for Door Supervisor Top Up and Traffic Marshal Courses at Training for Employment. Upgrade your skills today.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'slug' => url("courses-bundles/health-and-safety-awareness-hsa-traffic-marshal-vehicle-banksman-bundle"),
                'meta_title' => 'HSA | Traffic Marshal | Complete Training Course Packages',
                'meta_description' => 'Discover affordable Health Safety and Awareness (HSA) and complete Traffic Marshal Training Courses at Training for Employment at low prices.',
                'meta_keywords' => '',
                'robots' => 'no index, no follow',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach ($seos as &$seo) {
            $seo['seo_score'] = calculateSeoScore(
                $seo['meta_title'],
                $seo['meta_description'],
                $seo['meta_keywords']
            );
            $seo['created_at'] = Carbon::now();
            $seo['updated_at'] = Carbon::now();
        }

        // Insert into DB
        DB::table('seos')->insert($seos);
    }
}
