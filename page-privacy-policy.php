<?php
/**
 * Template Name: Privacy Policy
 * Template Post Type: page
 *
 * Gold Moment Tattoo Bali — Privacy Policy Page
 * Assign via Page Attributes → Template → "Privacy Policy"
 */

get_header();

$site_name  = get_bloginfo( 'name' ) ?: 'Gold Moment Tattoo Bali';
$email      = get_theme_mod( 'contact_email', 'hello@goldmomenttattoo.com' );
$address    = get_theme_mod( 'contact_address', 'Jl. Kayu Aya No. 88, Seminyak, Kuta, Bali 80361' );
$last_updated = 'April 16, 2026';
?>

<style>
/* ── Privacy Policy Hero ──────────────────────────────────── */
.policy-hero {
    position: relative;
    padding: 120px 0 70px;
    background: linear-gradient(180deg, #111 0%, var(--dark) 100%);
    text-align: center;
    overflow: hidden;
}
.policy-hero::before {
    content: '';
    position: absolute;
    top: -160px; left: 50%; transform: translateX(-50%);
    width: 700px; height: 700px;
    background: radial-gradient(ellipse, rgba(201,168,76,0.07) 0%, transparent 68%);
    pointer-events: none;
}
.policy-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* ── Policy Content ───────────────────────────────────────── */
.policy-section {
    padding: 80px 0 100px;
    background: var(--dark);
}
.policy-card {
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    padding: 40px 44px;
    margin-bottom: 20px;
}
@media (max-width: 575px) {
    .policy-card { padding: 28px 22px; }
}
.policy-card-icon {
    width: 48px; height: 48px;
    background: rgba(201,168,76,0.1);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    font-size: 17px;
    margin-bottom: 18px;
    flex-shrink: 0;
}
.policy-card-title {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    color: var(--gold);
    text-transform: uppercase;
    margin-bottom: 14px;
}
.policy-card p,
.policy-card li {
    font-size: 0.9rem;
    color: #aaa;
    line-height: 1.8;
    margin-bottom: 10px;
}
.policy-card ul,
.policy-card ol {
    padding-left: 20px;
    margin-bottom: 10px;
}
.policy-card li { margin-bottom: 6px; }
.policy-card a {
    color: var(--gold);
    text-decoration: none;
}
.policy-card a:hover {
    text-decoration: underline;
}
.policy-last-updated {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(201,168,76,0.06);
    border: 1px solid rgba(201,168,76,0.15);
    border-radius: 4px;
    padding: 8px 16px;
    font-size: 11px;
    color: #888;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 40px;
}
.policy-last-updated i { color: var(--gold); }
.policy-toc {
    background: rgba(201,168,76,0.04);
    border-left: 2px solid var(--gold);
    border-radius: 0 var(--radius) var(--radius) 0;
    padding: 22px 28px;
    margin-bottom: 36px;
}
.policy-toc-title {
    font-family: var(--font-heading);
    font-size: 0.75rem;
    letter-spacing: 0.2em;
    color: var(--gold);
    text-transform: uppercase;
    margin-bottom: 12px;
}
.policy-toc ol {
    padding-left: 18px;
    margin: 0;
}
.policy-toc li {
    font-size: 0.85rem;
    color: #888;
    line-height: 1.9;
}
.policy-toc a {
    color: #888;
    text-decoration: none;
    transition: color 0.2s;
}
.policy-toc a:hover { color: var(--gold); }
</style>


<!-- ============================================================
     PRIVACY POLICY — HERO
============================================================ -->
<section class="policy-hero" aria-label="Privacy Policy header">
    <div class="container position-relative">
        <span class="section-badge">Legal</span>
        <h1 class="section-title mt-2 mb-0">
            Privacy
            <span>Policy</span>
        </h1>
        <div class="gold-divider"></div>
        <p class="section-subtitle mx-auto" style="max-width:560px;">
            We respect your privacy. This policy explains what information we collect, how we use it,
            and the choices you have regarding your personal data.
        </p>
    </div>
</section>


<!-- ============================================================
     PRIVACY POLICY — CONTENT
============================================================ -->
<section class="policy-section" aria-label="Privacy Policy content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">

                <!-- Last Updated -->
                <div class="policy-last-updated">
                    <i class="fa-regular fa-calendar-check"></i>
                    Last Updated: <?php echo esc_html( $last_updated ); ?>
                </div>

                <!-- Table of Contents -->
                <div class="policy-toc">
                    <div class="policy-toc-title"><i class="fa-solid fa-list me-2"></i>Contents</div>
                    <ol>
                        <li><a href="#pp-who-we-are">Who We Are</a></li>
                        <li><a href="#pp-data-collect">Information We Collect</a></li>
                        <li><a href="#pp-how-we-use">How We Use Your Information</a></li>
                        <li><a href="#pp-cookies">Cookies &amp; Tracking</a></li>
                        <li><a href="#pp-sharing">Sharing Your Information</a></li>
                        <li><a href="#pp-retention">Data Retention</a></li>
                        <li><a href="#pp-rights">Your Rights</a></li>
                        <li><a href="#pp-security">Data Security</a></li>
                        <li><a href="#pp-third-party">Third-Party Links</a></li>
                        <li><a href="#pp-children">Children's Privacy</a></li>
                        <li><a href="#pp-changes">Changes to This Policy</a></li>
                        <li><a href="#pp-contact">Contact Us</a></li>
                    </ol>
                </div>

                <!-- 1. Who We Are -->
                <div class="policy-card" id="pp-who-we-are">
                    <div class="policy-card-icon"><i class="fa-solid fa-store"></i></div>
                    <div class="policy-card-title">1. Who We Are</div>
                    <p>
                        <strong style="color:var(--white);"><?php echo esc_html( $site_name ); ?></strong>
                        (&quot;we&quot;, &quot;our&quot;, or &quot;us&quot;) operates the website
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( home_url( '/' ) ); ?></a>
                        and the associated booking and contact services.
                    </p>
                    <p>
                        Our studio is located at <?php echo esc_html( $address ); ?>.
                        This Privacy Policy explains how we collect, use, disclose, and safeguard
                        your information when you visit our website or interact with our services.
                    </p>
                </div>

                <!-- 2. Information We Collect -->
                <div class="policy-card" id="pp-data-collect">
                    <div class="policy-card-icon"><i class="fa-solid fa-database"></i></div>
                    <div class="policy-card-title">2. Information We Collect</div>
                    <p>We may collect the following types of information:</p>
                    <p><strong style="color:var(--white);">Information you provide directly:</strong></p>
                    <ul>
                        <li>Full name, email address, and phone number submitted through contact or booking forms.</li>
                        <li>Tattoo design preferences, placement, size, and any reference images you share.</li>
                        <li>Messages you send us via WhatsApp, email, Instagram DM, or our website contact form.</li>
                        <li>Newsletter subscription email address.</li>
                    </ul>
                    <p><strong style="color:var(--white);">Information collected automatically:</strong></p>
                    <ul>
                        <li>IP address, browser type, device type, and operating system.</li>
                        <li>Pages visited, time spent on pages, and referring URLs.</li>
                        <li>Cookie identifiers and similar tracking technologies (see Section 4).</li>
                    </ul>
                </div>

                <!-- 3. How We Use Your Information -->
                <div class="policy-card" id="pp-how-we-use">
                    <div class="policy-card-icon"><i class="fa-solid fa-gears"></i></div>
                    <div class="policy-card-title">3. How We Use Your Information</div>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Process and confirm tattoo appointments and bookings.</li>
                        <li>Respond to your inquiries and provide customer support.</li>
                        <li>Send appointment reminders and aftercare instructions.</li>
                        <li>Send promotional emails, flash-deal alerts, and studio news (only if you have opted in).</li>
                        <li>Improve our website experience, content, and services.</li>
                        <li>Analyze website traffic and user behaviour via analytics tools.</li>
                        <li>Comply with applicable laws and prevent fraud or abuse.</li>
                    </ul>
                    <p>
                        We will never sell your personal information to third parties.
                    </p>
                </div>

                <!-- 4. Cookies -->
                <div class="policy-card" id="pp-cookies">
                    <div class="policy-card-icon"><i class="fa-solid fa-cookie-bite"></i></div>
                    <div class="policy-card-title">4. Cookies &amp; Tracking</div>
                    <p>
                        Our website uses cookies — small text files placed on your device — to enhance
                        your browsing experience and gather analytics data. Types of cookies we use:
                    </p>
                    <ul>
                        <li><strong style="color:var(--white);">Essential cookies:</strong> Required for core site functionality (e.g., form session tokens).</li>
                        <li><strong style="color:var(--white);">Analytics cookies:</strong> Tools such as Google Analytics help us understand how visitors interact with the site.</li>
                        <li><strong style="color:var(--white);">Marketing cookies:</strong> Used by platforms like Google Ads or Meta Pixel, if applicable, to measure ad performance.</li>
                    </ul>
                    <p>
                        You may disable cookies through your browser settings. Note that disabling certain cookies
                        may affect the functionality of our site.
                    </p>
                </div>

                <!-- 5. Sharing -->
                <div class="policy-card" id="pp-sharing">
                    <div class="policy-card-icon"><i class="fa-solid fa-share-nodes"></i></div>
                    <div class="policy-card-title">5. Sharing Your Information</div>
                    <p>We may share your information with:</p>
                    <ul>
                        <li>
                            <strong style="color:var(--white);">Service providers:</strong> Trusted third parties who assist in operating our website or conducting
                            our business (e.g., email platforms, booking software, payment processors),
                            subject to confidentiality agreements.
                        </li>
                        <li>
                            <strong style="color:var(--white);">Legal obligations:</strong> When required by law, court order, or governmental authority.
                        </li>
                        <li>
                            <strong style="color:var(--white);">Business transfers:</strong> In connection with a merger, acquisition, or sale of assets, your data may
                            be transferred with appropriate notice.
                        </li>
                    </ul>
                    <p>We do not sell, rent, or trade your personal information to any third party for marketing purposes.</p>
                </div>

                <!-- 6. Data Retention -->
                <div class="policy-card" id="pp-retention">
                    <div class="policy-card-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="policy-card-title">6. Data Retention</div>
                    <p>
                        We retain your personal data only as long as necessary to fulfil the purposes
                        outlined in this policy, or as required by law. Booking records are retained
                        for a minimum of 2 years for business and tax purposes. You may request deletion
                        at any time (see Section 7).
                    </p>
                </div>

                <!-- 7. Your Rights -->
                <div class="policy-card" id="pp-rights">
                    <div class="policy-card-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <div class="policy-card-title">7. Your Rights</div>
                    <p>Depending on your jurisdiction, you may have the right to:</p>
                    <ul>
                        <li><strong style="color:var(--white);">Access:</strong> Request a copy of the personal data we hold about you.</li>
                        <li><strong style="color:var(--white);">Rectification:</strong> Request correction of inaccurate or incomplete data.</li>
                        <li><strong style="color:var(--white);">Erasure:</strong> Request deletion of your personal data (&quot;right to be forgotten&quot;).</li>
                        <li><strong style="color:var(--white);">Restriction:</strong> Request that we limit how we process your data.</li>
                        <li><strong style="color:var(--white);">Portability:</strong> Request transfer of your data to another service.</li>
                        <li><strong style="color:var(--white);">Objection:</strong> Object to processing based on legitimate interest or for direct marketing.</li>
                        <li><strong style="color:var(--white);">Withdraw consent:</strong> Unsubscribe from marketing emails at any time via the unsubscribe link or by contacting us.</li>
                    </ul>
                    <p>
                        To exercise any of these rights, please contact us at
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>.
                        We will respond within 30 days.
                    </p>
                </div>

                <!-- 8. Security -->
                <div class="policy-card" id="pp-security">
                    <div class="policy-card-icon"><i class="fa-solid fa-lock"></i></div>
                    <div class="policy-card-title">8. Data Security</div>
                    <p>
                        We implement appropriate technical and organizational measures to protect your
                        personal information against unauthorized access, loss, or disclosure. This includes
                        SSL encryption, secure hosting, and access controls.
                    </p>
                    <p>
                        However, no method of transmission over the internet is 100% secure.
                        While we strive to protect your data, we cannot guarantee absolute security.
                    </p>
                </div>

                <!-- 9. Third-Party Links -->
                <div class="policy-card" id="pp-third-party">
                    <div class="policy-card-icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></div>
                    <div class="policy-card-title">9. Third-Party Links</div>
                    <p>
                        Our website may contain links to external sites such as Instagram, TikTok, Google Maps,
                        or WhatsApp. We are not responsible for the privacy practices of those websites.
                        We encourage you to review their privacy policies when you leave our site.
                    </p>
                </div>

                <!-- 10. Children's Privacy -->
                <div class="policy-card" id="pp-children">
                    <div class="policy-card-icon"><i class="fa-solid fa-child-reaching"></i></div>
                    <div class="policy-card-title">10. Children's Privacy</div>
                    <p>
                        Our services are intended for individuals aged 18 and over. We do not knowingly
                        collect personal information from minors. If we discover that a child under 18
                        has provided us with personal information, we will delete it promptly.
                        If you believe a minor has submitted information to us, please contact us immediately.
                    </p>
                </div>

                <!-- 11. Changes -->
                <div class="policy-card" id="pp-changes">
                    <div class="policy-card-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                    <div class="policy-card-title">11. Changes to This Policy</div>
                    <p>
                        We may update this Privacy Policy from time to time. Any changes will be posted
                        on this page with an updated &quot;Last Updated&quot; date. We encourage you to review
                        this policy periodically. Continued use of our website after changes constitutes
                        your acceptance of the updated policy.
                    </p>
                </div>

                <!-- 12. Contact -->
                <div class="policy-card" id="pp-contact">
                    <div class="policy-card-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="policy-card-title">12. Contact Us</div>
                    <p>If you have any questions or concerns about this Privacy Policy, please reach out:</p>
                    <ul>
                        <li>
                            <strong style="color:var(--white);">Business:</strong>
                            <?php echo esc_html( $site_name ); ?>
                        </li>
                        <li>
                            <strong style="color:var(--white);">Address:</strong>
                            <?php echo esc_html( $address ); ?>
                        </li>
                        <li>
                            <strong style="color:var(--white);">Email:</strong>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                        </li>
                        <li>
                            <strong style="color:var(--white);">Contact page:</strong>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">goldmomenttattoo.com/contact</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
