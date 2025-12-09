<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => '<h2>1. Acceptance of Terms</h2>
<p>By accessing and using this platform, you accept and agree to be bound by the terms and provision of this agreement.</p>

<h2>2. Use License</h2>
<p>Permission is granted to temporarily use this platform for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.</p>

<h2>3. User Responsibilities</h2>
<p>Users are responsible for maintaining the confidentiality of their account and password. You agree to accept responsibility for all activities that occur under your account.</p>

<h2>4. Prohibited Uses</h2>
<p>You may not use the platform for any purpose that is unlawful, harmful, or otherwise objectionable. This includes but is not limited to: spreading malware, harassment, impersonation, or violating intellectual property rights.</p>

<h2>5. Service Modifications</h2>
<p>We reserve the right to modify or discontinue, temporarily or permanently, the service with or without notice.</p>

<h2>6. Limitation of Liability</h2>
<p>In no event shall we be liable for any indirect, incidental, special, consequential or punitive damages resulting from your use of the platform.</p>

<h2>7. Changes to Terms</h2>
<p>We reserve the right to update these terms at any time. Continued use of the platform after changes constitutes acceptance of the new terms.</p>',
                'meta_description' => 'Terms of Service for using our platform',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>1. Information We Collect</h2>
<p>We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.</p>

<h2>2. How We Use Information</h2>
<p>We use the information we collect to provide, maintain, and improve our services, process transactions, send notifications, and respond to your requests.</p>

<h2>3. Information Sharing</h2>
<p>We do not sell, trade, or otherwise transfer your personal information to outside parties. This does not include trusted third parties who assist us in operating our platform.</p>

<h2>4. Data Security</h2>
<p>We implement a variety of security measures to maintain the safety of your personal information. All sensitive information is transmitted via Secure Socket Layer (SSL) technology.</p>

<h2>5. Cookies</h2>
<p>We use cookies to enhance your experience, gather general visitor information, and track visits to our platform. You can choose to disable cookies through your browser settings.</p>

<h2>6. Third-Party Links</h2>
<p>Occasionally, at our discretion, we may include or offer third-party products or services. These third-party sites have separate and independent privacy policies.</p>

<h2>7. Your Rights</h2>
<p>You have the right to access, correct, or delete your personal data. Contact us to exercise these rights.</p>

<h2>8. Changes to This Policy</h2>
<p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>',
                'meta_description' => 'Privacy Policy explaining how we handle your data',
                'is_published' => true,
                'order' => 2,
            ],
            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'content' => '<h2>1. Digital Services</h2>
<p>Due to the nature of digital services, all sales are final. However, we may consider refunds on a case-by-case basis.</p>

<h2>2. Eligibility</h2>
<p>Refund requests must be submitted within 7 days of purchase. To be eligible, you must provide a valid reason for the refund request.</p>

<h2>3. Process</h2>
<p>To request a refund, please contact our support team through the ticket system. Include your order number and reason for the refund.</p>

<h2>4. Timeline</h2>
<p>Approved refunds will be processed within 5-10 business days. The refund will be credited to your original payment method.</p>

<h2>5. Exceptions</h2>
<p>Refunds will not be issued for accounts that have been suspended or banned due to violation of our terms of service.</p>',
                'meta_description' => 'Our refund policy for digital services',
                'is_published' => true,
                'order' => 3,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'content' => '<h2>Who We Are</h2>
<p>We are a team of passionate developers and entrepreneurs dedicated to providing the best SaaS platform for businesses of all sizes. Our mission is to help you build, scale, and manage your digital business with ease.</p>

<h2>Our Story</h2>
<p>Founded in 2024, we started with a simple idea: make powerful business tools accessible to everyone. What began as a small project has grown into a comprehensive platform serving thousands of users worldwide.</p>

<h2>Our Values</h2>
<ul>
<li><strong>Innovation:</strong> We constantly push the boundaries of what\'s possible.</li>
<li><strong>Reliability:</strong> Our platform is built for 99.9% uptime.</li>
<li><strong>Customer First:</strong> Your success is our success.</li>
<li><strong>Transparency:</strong> We believe in open and honest communication.</li>
</ul>

<h2>Our Team</h2>
<p>Our diverse team brings together expertise from various fields including software development, design, marketing, and customer success. Together, we work tirelessly to deliver the best experience for our users.</p>

<h2>Join Us</h2>
<p>We\'re always looking for talented individuals to join our team. If you\'re passionate about technology and want to make a difference, check out our careers page.</p>',
                'meta_description' => 'Learn more about our company, mission, and team',
                'is_published' => true,
                'order' => 4,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'content' => '<h2>Get in Touch</h2>
<p>We\'d love to hear from you! Whether you have a question about our services, need technical support, or want to explore partnership opportunities, we\'re here to help.</p>

<h2>Support</h2>
<p>For technical support and account-related inquiries, please use our ticket system in your dashboard. Our support team typically responds within 24 hours.</p>

<h2>Business Inquiries</h2>
<p>For business partnerships, enterprise solutions, or media inquiries, please email us at <strong>business@example.com</strong></p>

<h2>Office Location</h2>
<p>123 Tech Street<br>
Innovation District<br>
Jakarta, Indonesia 12345</p>

<h2>Business Hours</h2>
<p>Monday - Friday: 9:00 AM - 6:00 PM (GMT+7)<br>
Saturday - Sunday: Closed</p>

<h2>Social Media</h2>
<p>Follow us on social media for the latest updates and announcements. You can find us on Twitter, Instagram, and LinkedIn.</p>',
                'meta_description' => 'Contact us for support, business inquiries, or general questions',
                'is_published' => true,
                'order' => 5,
            ],
            [
                'title' => 'Disclaimer',
                'slug' => 'disclaimer',
                'content' => '<h2>General Disclaimer</h2>
<p>The information provided on this platform is for general informational purposes only. While we strive to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability of the platform or the information, products, services, or related graphics contained on the platform.</p>

<h2>External Links</h2>
<p>Through this platform, you may be able to link to other websites which are not under our control. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorsement of the views expressed within them.</p>

<h2>Service Availability</h2>
<p>Every effort is made to keep the platform running smoothly. However, we take no responsibility for, and will not be liable for, the platform being temporarily unavailable due to technical issues beyond our control.</p>

<h2>Financial Disclaimer</h2>
<p>Any financial information provided on this platform is for informational purposes only and should not be considered as financial advice. Please consult with a qualified financial advisor before making any financial decisions.</p>

<h2>Results Disclaimer</h2>
<p>Individual results may vary. We do not guarantee any specific results from using our platform or services. Success depends on various factors including but not limited to individual effort, market conditions, and other variables.</p>',
                'meta_description' => 'Important disclaimers and legal notices for our platform',
                'is_published' => true,
                'order' => 6,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
