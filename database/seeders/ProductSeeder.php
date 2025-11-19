<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gallery = [
            "images/placeholder.webp",
            "images/placeholder.webp",
            "images/placeholder.webp",
            "images/placeholder.webp"
        ];

        DB::table('products')->insert([
            [
                'slug' => Str::slug('First Aid Handbook'),
                'product_image' => 'ProductImages/First Aid Handbook.jpg',
                'name' => 'First Aid Handbook',
                'user_id' => 1,
                'short_description' => '<p>Looking to enhance your first aid knowledge? The First Aid Handbook is the perfect companion for learners aiming to achieve their Level 3  Emergency First Aid at Work qualification.</p>',
                'excerpt' => 'Looking to enhance your first aid knowledge? The First Aid Handbook is the perfect companion for learners aiming to achieve their Level 3 Emergency First Aid at Work qualification.',
                'description' => '<p>Designed with simplicity and engagement in mind, this comprehensive resource is packed with:</p>
<ul>
<li>Up-to-date information to ensure you are learning the latest first aid practices</li>
<li>Vivid illustrations and real-life images that bring first aid scenarios to life, making learning more relatable and effective</li>
</ul>
<p><strong>Key Topics Covered:</strong></p>
<ul>
<li>The Role and Responsibilities of the First Aider</li>
<li>Assessing an Incident</li>
<li>Managing an Unresponsive Casualty</li>
<li>Understanding the Respiratory System</li>
<li>Treating Wounds and Bleeding</li>
<li>Responding to Shock and Seizures</li>
<li>Handling Minor and Other Types of Injuries</li>
</ul>
<p>&nbsp;</p>',
                'description_two' => '<h2 class="mt-5">Who Should Use This Book?</h2>
<p>Not only does the <strong>First Aid Handbook</strong> cover all the essential content required for the Level 3 Emergency First Aid at Work qualification, but it is also an excellent resource for in-house first aid training sessions.</p>
<p>Available now at Training for Employment training centres or online.</p>
<p>Equip yourself with the knowledge and confidence to make a difference in emergency situations!</p>',
                'description_three' => '',
                'description_four' => '',
                'price' => 5,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('CCTV Course book'),
                'product_image' => 'ProductImages/CCTV Course Book.jpg',
                'name' => 'CCTV Course book',
                'user_id' => 1,
                'excerpt' => 'The CCTV Course Book is tailored to meet industry standards. Written by Highfield Qualifications experts this course book has been carefully crafted to equip you with the knowledge and skills needed to excel in surveillance operations.',
                'short_description' => 'The CCTV Course Book is tailored to meet industry standards. Written by Highfield Qualifications experts this course book has been carefully crafted to equip you with the knowledge and skills needed to excel in surveillance operations. Whether you are new to the field or refreshing your expertise, this book is your trusted companion on the journey to certification and career advancement.',
                'description' => '<h2 class="mt-5">What&rsquo;s Inside the CCTV Course Book?</h2>
<p><strong>Module 1: Principles of working in the private security industry</strong></p>
<ul>
<li>The main characteristics and purposes of the private security industry</li>
<li>Awareness of the law in the private security industry</li>
<li>Arrest procedures relevant to security operatives</li>
<li>The importance of safe working practices</li>
<li>Fire procedures in the workplace</li>
<li>Emergencies and the importance of emergency procedures</li>
<li>How to communicate effectively as a security operative</li>
<li>Record-keeping relevant to the role of the security operative</li>
<li>Terror threats and the role of the security operative in the event of a threat</li>
</ul>
<p><strong>Module 2: Principles and practices of working as a CCTV operator within the private security industry</strong></p>
<ul>
<li>The purpose of a surveillance (CCTV) system and the roles and responsibilities of control room team and other stakeholders</li>
<li>How legislation impacts on public space surveillance (CCTV) operations</li>
<li>The importance of operational (CCTV) operations</li>
<li>How public space surveillance (CCTV) system equipment operates</li>
<li>Different types of incidents and how to respond to them Crime and non-crime incidents</li>
<li>Health and safety in the CCTV environment</li>
<li>Demonstrating operational use of CCTV equipment</li>
<li>Producing evidential documentation</li>
</ul>',
                'description_two' => '<h2 class="mt-5">Who Should Use This Book?</h2>
<p>Not only does the <strong>CCTV Course Book</strong> cover all the essential content required for those who are currently pursuing a Highfield-regulated CCTV qualification, but it is also an excellent resource for current professionals and in-house first aid training sessions.</p>
<p>Available now at Training for Employment training centres or online.</p>',
                'description_three' => '<h2 class="mt-5">Benefits of the CCTV Course Book</h2>
<ul>
<li>Tailored to Highfield-regulated qualifications.</li>
<li>Aligns with the latest industry standards.</li>
<li>Perfect for independent learners and training institutions alike.</li>
</ul>',
                'description_four' => '',
                'price' => 15,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Door Supervisor Course book'),
                'product_image' => 'ProductImages/Door Supervisor Course Book.jpg',
                'name' => 'Door Supervisor Course book',
                'user_id' => 1,
                'excerpt' => 'The Door Supervisor Course Book has been designed to meet the latest industry requirements. Authored by experts from Highfield Qualifications, this comprehensive guide provides you with the essential knowledge and practical skills needed to excel in security and surveillance roles.',
                'short_description' => 'The Door Supervisor Course Book has been designed to meet the latest industry requirements. Authored by experts from Highfield Qualifications, this comprehensive guide provides you with the essential knowledge and practical skills needed to excel in security and surveillance roles. Whether you are new to the profession or seeking to update your expertise, this book is an invaluable resource to support your journey towards certification and career growth.',
                'description' => '<h2 class="mt-5">What Does the Door Supervisor Course Book Cover?</h2>
<p><strong>Module 1: Introduction to the Private Security Industry</strong></p>
<ul>
<li>Overview of the private security sector</li>
<li>Key legislation and legal responsibilities</li>
<li>Health and safety protocols</li>
<li>Fire safety procedures</li>
<li>Emergency response strategies</li>
<li>Effective communication and customer service techniques</li>
</ul>
<p><strong>Module 2: The Role of a Door Supervisor</strong></p>
<ul>
<li>Responsibilities and duties of door supervisors</li>
<li>Understanding civil and criminal law</li>
<li>The Criminal Law Act 1967 explained</li>
<li>Conducting searches professionally</li>
<li>Drug awareness and related legal considerations</li>
</ul>
<p><strong>Module 3: Conflict Management in the Security Industry</strong></p>
<ul>
<li>Core principles of conflict resolution</li>
<li>Identifying, evaluating, and mitigating risks</li>
<li>Communication techniques for de-escalation</li>
<li>Problem-solving approaches in challenging situations</li>
<li>Best practices for post-incident reflection and reporting</li>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                'description_two' => '<h2 class="mt-5">Who Is This Book For?</h2>
<p>This course book is perfect for individuals undertaking the Highfield-regulated Door Supervisor qualification. It also serves as a valuable reference for current security professionals and can be utilised in internal training sessions, including first aid refreshers.</p>',
                'description_three' => '<h2 class="mt-5">Why Choose the Door Supervisor Course Book?</h2>
<ul>
<li>Specifically designed to complement Highfield-regulated qualifications</li>
<li>Fully aligned with current industry practices and standards</li>
<li>Suitable for self-study, training providers, and corporate training programmes</li>
</ul>
<p>Available now at Training for Employment centres or through our online platform.</p>',
                'description_four' => '',
                'price' => 15,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Clip-On Uniform Tie'),
                'product_image' => 'ProductImages/Clip-On Uniform Tie.jpg',
                'name' => 'Clip-On Uniform Tie',
                'user_id' => 1,
                'excerpt' => 'Upgrade your uniform with our Clip-On Uniform Tie, designed for professionals who need to maintain a sharp appearance without the hassle of traditional ties.',
                'short_description' => '<p>Upgrade your uniform with our <strong>Clip-On Uniform Tie</strong>, designed for professionals who need to maintain a sharp appearance without the hassle of traditional ties. Whether you are in law enforcement, security, hospitality, or any industry that demands a polished look, this tie offers the perfect blend of style, safety, and ease.</p>',
                'description' => '<h3 class="mt-5">Key Features:</h3>
                    <ul>
                    <li><strong>Quick &amp; Easy</strong>: No need to worry about tying knots. Simply clip it on, and you are ready to go in seconds.</li>
                    <li><strong>Consistent Appearance</strong>: Maintains a perfectly neat, symmetrical knot every time.</li>
                    <li><strong>Safety First</strong>: Designed with a breakaway clip for added safety, especially in high-risk environments.</li>
                    <li><strong>Durable Material</strong>: Made from high-quality polyester for a sleek finish that resists wrinkles and stains.</li>
                    </ul>
                    <h3 class="mt-5">Ideal For:</h3>
                    <ul>
                    <li>Security Personnel</li>
                    <li>Emergency Services</li>
                    <li>Hospitality &amp; Service Staff</li>
                    <li>School &amp; Corporate Uniform</li>
                    </ul>
                    <p>Available now at Training for Employment centres or through our online platform.</p>',
                'description_two' => '',
                'description_three' => '',
                'description_four' => '',
                'price' => 5,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Badge Holders'),
                'product_image' => 'ProductImages/Badge Holder.jpg',
                'name' => 'Badge Holders',
                'user_id' => 1,
                'excerpt' => 'Secure, Durable, and Professional Display <br> Keep your identification safe and easily accessible with our high-quality Badge Holders.',
                'short_description' => '<p><strong>Secure, Durable, and Professional Display</strong></p>
                    <p>Keep your identification safe and easily accessible with our high-quality <strong>Badge Holders</strong>. Designed for security professional, our badge holders offer both functionality and a polished appearance, making them the perfect accessory for daily use.</p>',
                'description' => '<h3 class="mt-5">Key Features:</h3>
                    <ul>
                    <li><strong>Secure Fit</strong>: Holds ID cards, badges, and access cards securely in place.</li>
                    <li><strong>Clear Visibility</strong>: Transparent design ensures easy scanning and clear identification without removing the card.</li>
                    <li><strong>Durable Material</strong>: Made from premium plastic or vinyl for long-lasting use, resistant to wear and tear.</li>
                    <li><strong>Water-Resistant</strong>: Protects your ID from moisture, dust, and daily wear.</li>
                    </ul>
                    <h3 class="mt-5">Ideal For:</h3>
                    <ul>
                    <li>Door Supervisors</li>
                    <li>Security Guards</li>
                    <li>Supervisors</li>
                    <li>Event Stewards</li>
                    </ul>
                    <p>Available now at Training for Employment centres or through our online platform.</p>',
                'description_two' => '',
                'description_three' => '',
                'description_four' => '',
                'price' => 7,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('Hand Tally Counter'),
                'product_image' => 'ProductImages/Hand Tally Counter.jpg',
                'name' => 'Hand Tally Counter',
                'user_id' => 1,
                'excerpt' => 'Keep track of counts with precision using our reliable Hand Tally Counter. Perfect for professionals who need to monitor attendance, inventory, or any repetitive counting task, this device ensures accuracy and ease of use in every situation.',
                'short_description' => '<p><strong>Accurate Counting, Effortless Control</strong></p>
                    <p>Keep track of counts with precision using our reliable Hand Tally Counter. Perfect for professionals who need to monitor attendance, inventory, or any repetitive counting task, this device ensures accuracy and ease of use in every situation.</p>
                    <p>Designed for durability and efficiency, the Hand Tally Counter provides dependable performance in any environment. Its compact size and easy functionality make it an essential tool for accurate counting on the go.</p>',
                'description' => '<h3 class="mt-5">Key Features:</h3>
                    <ul>
                    <li><strong>Simple Operation:</strong> Easy-to-press button allows for quick, effortless counting with each click.</li>
                    <li><strong>High Accuracy:</strong> Counts up to 9,999 with a clear, easy-to-read display.</li>
                    <li><strong>Durable Build:</strong> Crafted from sturdy metal for long-lasting performance.</li>
                    <li><strong>Ergonomic Design:</strong> Comfortable grip fits perfectly in hand, reducing fatigue during extended use.</li>
                    <li><strong>Reset Knob:</strong> Convenient reset knob to quickly return the count to zero.</li>
                    </ul>
                    <h3 class="mt-5">Ideal For:</h3>
                    <ul>
                    <li>Event Attendance Tracking</li>
                    <li>Inventory Management</li>
                    <li>Sports and Fitness Training</li>
                    <li>Traffic and Pedestrian Monitoring</li>
                    <li>Laboratory and Research Data Collection</li>
                    </ul>
                    <p>Available now at Training for Employment centres or through our online platform.</p>
                    <p><strong>Order Now</strong> to streamline your counting tasks with precision and ease!</p>',
                'description_two' => '',
                'description_three' => '',
                'description_four' => '',
                'price' => 5,
                'gallery' => json_encode($gallery),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
