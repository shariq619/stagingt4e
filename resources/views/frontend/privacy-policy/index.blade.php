@extends('layouts.frontend')
@section('title', 'Privacy Policy')

@section('main')
    <div class="privacyPolicyPage">
        <div class="pageTitleTop pyxl-5">
            <div class="container">
                <h1 class="text-center">Privacy Policy</h1>
            </div>
        </div>

        <section class="pyxl-5">
            <div class="container">

                <p class="mb-1"><strong>Effective Date:</strong> {{ now()->format('d F Y') }}</p>
                <p class="mb-5">This Privacy Policy explains what information we collect, why we collect it, how we use it, and the choices you have regarding your personal data under the UK GDPR and the Data Protection Act 2018.</p>

                <h2 class="mt-4">1) Introduction</h2>
                <p>Welcome to Training4Employment.co.uk (“T4E”, “we”, “our”, or “us”). We are committed to protecting your privacy and ensuring your personal information is handled in accordance with the UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018. By using our website or mobile app, you agree to this policy. If you do not agree, please discontinue use immediately.</p>

                <h2 class="mt-5">2) Who We Are</h2>
                <p>
                    <strong>Training 4 Employment Ltd</strong><br>
                    Registered Office: 89-91 Hatchett Street, Birmingham, B19 3NY<br>
                    Website: <a href="https://training4employment.co.uk" target="_blank" rel="noopener">training4employment.co.uk</a><br>
                    Email: <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a><br>
                    Phone: 0808 280 8098
                </p>
                <p>We are a UK-based training provider offering SIA and vocational training courses, online learning, and learner support through our digital platforms.</p>

                <h2 class="mt-5">3) Information We Collect</h2>
                <h5 class="mt-3">a. Personal Information</h5>
                <ul>
                    <li>Full name, date of birth, email address, phone number, postal address</li>
                    <li>National Insurance number (if required for qualification registration)</li>
                    <li>Identification details (e.g., ID verification documents)</li>
                </ul>
                <h5 class="mt-3">b. Course and Learning Information</h5>
                <ul>
                    <li>Course bookings and attendance records</li>
                    <li>Assessment results and progress data</li>
                    <li>Certificates and accreditation records</li>
                    <li>Feedback and learner support requests</li>
                </ul>
                <h5 class="mt-3">c. Payment Information</h5>
                <ul>
                    <li>Billing address and transaction details (we do not store full card numbers; payments are processed securely via third-party providers such as Stripe or PayPal)</li>
                </ul>
                <h5 class="mt-3">d. Technical Information</h5>
                <ul>
                    <li>IP address, browser type, operating system, device identifiers</li>
                    <li>App usage logs and crash reports</li>
                    <li>Cookies or similar technologies for analytics and performance</li>
                </ul>
                <h5 class="mt-3">e. Communication Data</h5>
                <ul>
                    <li>Emails, messages, or calls with support/admin teams</li>
                    <li>Notifications and communication preferences</li>
                </ul>

                <h2 class="mt-5">4) How We Use Your Information</h2>
                <ul>
                    <li>Register and manage learner accounts</li>
                    <li>Process course bookings and payments</li>
                    <li>Deliver online and in-person training; provide access to learning materials via the T4E Learner Hub</li>
                    <li>Verify identity and eligibility for accredited courses</li>
                    <li>Issue certificates and maintain qualification records</li>
                    <li>Communicate about courses, updates, or support</li>
                    <li>Improve services, content, and app performance</li>
                    <li>Comply with legal, regulatory, and awarding-body requirements</li>
                </ul>

                <h2 class="mt-5">5) Legal Basis for Processing</h2>
                <ul>
                    <li><strong>Contractual necessity</strong> – to deliver our training services and fulfil enrolments</li>
                    <li><strong>Legal obligation</strong> – to comply with awarding bodies or statutory regulations</li>
                    <li><strong>Legitimate interests</strong> – to improve our platform, prevent fraud, communicate relevant updates</li>
                    <li><strong>Consent</strong> – for marketing/communications you opt into (you may withdraw consent anytime by emailing <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a>)</li>
                </ul>

                <h2 class="mt-5">6) How We Share Your Information</h2>
                <p>We share personal data only where necessary and lawful, including with:</p>
                <ul>
                    <li>Awarding organisations (e.g., Highfield Qualifications, Ofqual-regulated bodies)</li>
                    <li>Payment processors (e.g., Stripe, PayPal)</li>
                    <li>Technology providers (hosting, analytics, app maintenance)</li>
                    <li>Regulatory authorities or law enforcement (when legally required)</li>
                </ul>
                <p class="mb-0"><strong>We never sell or rent your personal data.</strong></p>

                <h2 class="mt-5">7) Data Storage and Retention</h2>
                <p>Personal data is stored on secure servers in the UK or EEA. We retain data only as long as necessary for the purposes outlined in this policy, including legal or accreditation record-keeping (typically up to 3 years after course completion).</p>

                <h2 class="mt-5">8) Security</h2>
                <ul>
                    <li>Encrypted data transmission (SSL/TLS)</li>
                    <li>Secure cloud storage and firewalls</li>
                    <li>Access control and staff confidentiality agreements</li>
                </ul>
                <p>Despite these measures, no system is 100% secure and users share data at their own risk.</p>

                <h2 class="mt-5">9) Your Rights</h2>
                <p>Under the UK GDPR, you have rights to access, rectification, erasure, restriction, data portability, and objection (including to direct marketing). To exercise these rights, contact <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a>. We aim to respond within 30 days.</p>

                <h2 class="mt-5">10) Cookies and Tracking</h2>
                <p>We use cookies to enhance user experience, analyse traffic, and support functionality. You can manage or disable cookies through your browser settings. The app may use analytics tools (e.g., Google Firebase, MS Clarity) to track performance and improve usability.</p>

                <h2 class="mt-5">11) Third-Party Links</h2>
                <p>Our website or app may contain links to third-party websites. We are not responsible for their privacy practices or content. Please review their privacy policies before providing personal information.</p>

                <h2 class="mt-5">12) Children’s Privacy</h2>
                <p>Our services are generally intended for individuals aged 18 and above, with exceptions for learners aged 14+ where specific course entry requirements permit. We do not knowingly collect data from individuals under 14 without verified parental or guardian consent.</p>

                <h2 class="mt-5">13) Updates to This Policy</h2>
                <p>We may update this policy from time to time to reflect legal changes or our practices. Updates will be posted on our website/app with a revised “Effective Date.”</p>

                <h2 class="mt-5">14) Contact Us</h2>
                <p>
                    Data Protection Officer<br>
                    Training 4 Employment Ltd<br>
                    89-91 Hatchett Street, Birmingham, B19 3NY<br>
                    Email: <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a><br>
                    Phone: 0808 280 8098
                </p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h3 class="m-0">Privacy Policy (PDF)</h3>
                    <a href="{{ asset('docs/privacy-policy.pdf') }}" class="btn btn-primary" target="_blank" rel="noopener">
                        Download PDF
                    </a>
                </div>

{{--                <div class="mt-4 border rounded overflow-hidden" style="min-height:600px;">--}}
{{--                    <object data="{{ asset('docs/privacy-policy.pdf') }}" type="application/pdf" width="100%" height="800">--}}
{{--                        <iframe src="{{ asset('docs/privacy-policy.pdf') }}" width="100%" height="800" style="border:0;"></iframe>--}}
{{--                    </object>--}}
{{--                </div>--}}
            </div>
        </section>
    </div>
@endsection
