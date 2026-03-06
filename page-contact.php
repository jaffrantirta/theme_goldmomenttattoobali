<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * Gold Moment Tattoo Bali — Contact Page
 * Assign via Page Attributes → Template → "Contact Us"
 */

get_header();

// ── Page Header ───────────────────────────────────────────────
$ct_badge     = get_theme_mod( 'contact_page_badge',     'Get In Touch' );
$ct_title     = get_theme_mod( 'contact_page_title',     'Let\'s Create' );
$ct_highlight = get_theme_mod( 'contact_page_highlight', 'Something Together' );
$ct_subtitle  = get_theme_mod( 'contact_page_subtitle',  'Have a tattoo idea in mind? Reach out and our team will guide you through every step — from first sketch to final ink.' );

// ── Form Section ─────────────────────────────────────────────
$form_title    = get_theme_mod( 'contact_page_form_title',    'Send Us a Message' );
$form_subtitle = get_theme_mod( 'contact_page_form_subtitle', 'We reply within 24 hours. For faster response, chat with us on WhatsApp.' );
$form_success  = get_theme_mod( 'contact_page_success_msg',   'Thank you! Your message has been sent. We\'ll get back to you within 24 hours.' );

// ── Contact Details (reused from Find Us / Book Now panels) ──
$address   = get_theme_mod( 'contact_address',   "Jl. Kayu Aya No. 88\nSeminyak, Kuta, Bali 80361" );
$phone     = get_theme_mod( 'contact_phone',     '+62 812 3456 7890' );
$wa_url    = get_theme_mod( 'contact_wa_url',    'https://wa.me/6281234567890' );
$email     = get_theme_mod( 'contact_email',     'hello@goldmomenttattoo.com' );
$instagram = get_theme_mod( 'contact_instagram', '@goldmomenttattoo.bali' );
$ig_url    = get_theme_mod( 'contact_ig_url',    'https://www.instagram.com/goldmomenttattoo.bali' );

// ── Business Hours ────────────────────────────────────────────
$hours_weekday  = get_theme_mod( 'hours_weekday',  '10:00 – 20:00' );
$hours_saturday = get_theme_mod( 'hours_saturday', '09:00 – 21:00' );
$hours_sunday   = get_theme_mod( 'hours_sunday',   'By Appointment Only' );

// ── Map ───────────────────────────────────────────────────────
$map_url = get_theme_mod( 'map_embed_url', '' );

// ── WhatsApp Button ───────────────────────────────────────────
$wa_btn_text = get_theme_mod( 'contact_page_wa_btn', 'Chat on WhatsApp' );
?>

<style>
/* ── Contact Page ─────────────────────────────────────────── */
.contact-page-hero {
    position: relative;
    padding: 120px 0 70px;
    background: linear-gradient(180deg, #111 0%, var(--dark) 100%);
    text-align: center;
    overflow: hidden;
}
.contact-page-hero::before {
    content: '';
    position: absolute;
    top: -160px; left: 50%; transform: translateX(-50%);
    width: 700px; height: 700px;
    background: radial-gradient(ellipse, rgba(201,168,76,0.07) 0%, transparent 68%);
    pointer-events: none;
}
.contact-page-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* ── Main Section ─────────────────────────────────────────── */
.contact-main-section {
    padding: 80px 0 100px;
    background: var(--dark);
}

/* ── Info Column ──────────────────────────────────────────── */
.contact-info-card {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    padding: 22px 24px;
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    margin-bottom: 14px;
    transition: border-color 0.3s ease, transform 0.3s ease;
    text-decoration: none;
}
.contact-info-card:hover {
    border-color: rgba(201,168,76,0.35);
    transform: translateX(4px);
    color: inherit;
}
.contact-info-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    background: rgba(201,168,76,0.1);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 16px;
}
.contact-info-label {
    font-family: var(--font-body);
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 4px;
}
.contact-info-value {
    font-family: var(--font-heading);
    font-size: 0.9rem;
    color: var(--white);
    line-height: 1.5;
    word-break: break-word;
}

/* WhatsApp CTA */
.contact-wa-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 16px 24px;
    background: linear-gradient(135deg, #128c47, #25d366);
    border: none;
    border-radius: var(--radius);
    color: #fff;
    font-family: var(--font-heading);
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-decoration: none;
    cursor: pointer;
    margin: 20px 0 28px;
    transition: all 0.35s ease;
    box-shadow: 0 4px 24px rgba(37,211,102,0.25);
}
.contact-wa-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(37,211,102,0.4);
    color: #fff;
}
.contact-wa-btn i { font-size: 22px; }

/* Hours table */
.contact-hours-title {
    font-family: var(--font-heading);
    font-size: 0.85rem;
    color: var(--gold);
    letter-spacing: 0.18em;
    text-transform: uppercase;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.contact-hours-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    font-size: 0.85rem;
}
.contact-hours-row:last-child { border-bottom: none; }
.contact-hours-day { color: #888; }
.contact-hours-time { color: var(--white); font-family: var(--font-heading); font-size: 0.8rem; }
.contact-hours-time.closed { color: var(--gold); }

/* ── Form Column ──────────────────────────────────────────── */
.contact-form-wrap {
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.12);
    border-radius: var(--radius);
    padding: 40px;
}
@media (max-width: 575px) { .contact-form-wrap { padding: 24px; } }

.contact-form-title {
    font-family: var(--font-display);
    font-size: clamp(1.3rem, 3vw, 1.7rem);
    color: var(--white);
    margin-bottom: 8px;
}
.contact-form-title span { color: var(--gold); }
.contact-form-subtitle {
    font-size: 0.85rem;
    color: var(--gray);
    margin-bottom: 30px;
    line-height: 1.6;
}

.contact-form-group { margin-bottom: 18px; }
.contact-form-label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gray);
    margin-bottom: 7px;
}
.contact-form-label .req { color: var(--gold); margin-left: 2px; }
.contact-form-input,
.contact-form-textarea,
.contact-form-select {
    width: 100%;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(201,168,76,0.15);
    border-radius: var(--radius);
    padding: 12px 16px;
    color: var(--white);
    font-family: var(--font-body);
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.3s ease, background 0.3s ease;
    appearance: none;
}
.contact-form-input::placeholder,
.contact-form-textarea::placeholder { color: #444; }
.contact-form-input:focus,
.contact-form-textarea:focus,
.contact-form-select:focus {
    border-color: rgba(201,168,76,0.5);
    background: rgba(255,255,255,0.05);
}
.contact-form-textarea { min-height: 130px; resize: vertical; }
.contact-form-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23C9A84C' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 40px;
    cursor: pointer;
}
.contact-form-select option { background: var(--dark-2); color: var(--white); }

.contact-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
@media (max-width: 575px) { .contact-form-row { grid-template-columns: 1fr; gap: 0; } }

/* Submit button */
.contact-submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 16px 32px;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    border: none;
    border-radius: var(--radius);
    color: var(--black);
    font-family: var(--font-heading);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.35s ease;
    margin-top: 6px;
}
.contact-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(201,168,76,0.35);
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
}
.contact-submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Form feedback */
.contact-feedback {
    display: none;
    padding: 14px 18px;
    border-radius: var(--radius);
    font-size: 0.875rem;
    margin-top: 16px;
    line-height: 1.5;
}
.contact-feedback.success {
    background: rgba(37,211,102,0.1);
    border: 1px solid rgba(37,211,102,0.3);
    color: #4ade80;
}
.contact-feedback.error {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.25);
    color: #f87171;
}

/* ── Map Section ──────────────────────────────────────────── */
.contact-map-section {
    background: var(--black);
    border-top: 1px solid rgba(201,168,76,0.08);
}
.contact-map-section iframe {
    width: 100%;
    height: 420px;
    border: none;
    display: block;
    filter: grayscale(30%) contrast(1.05);
}
</style>


<!-- ============================================================
     CONTACT — PAGE HERO
============================================================ -->
<section class="contact-page-hero" aria-label="Contact page header">
    <div class="container position-relative">
        <span class="section-badge"><?php echo esc_html( $ct_badge ); ?></span>
        <h1 class="section-title mt-2 mb-0">
            <?php echo esc_html( $ct_title ); ?>
            <span><?php echo esc_html( $ct_highlight ); ?></span>
        </h1>
        <div class="gold-divider"></div>
        <p class="section-subtitle mx-auto" style="max-width:560px;">
            <?php echo esc_html( $ct_subtitle ); ?>
        </p>
    </div>
</section>


<!-- ============================================================
     CONTACT — MAIN SECTION
============================================================ -->
<section class="contact-main-section" aria-label="Contact information and form">
    <div class="container">
        <div class="row g-5">

            <!-- ── Left Column: Info ──────────────────────────── -->
            <div class="col-lg-5">

                <!-- Address -->
                <?php if ( $address ) : ?>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode( $address ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Studio Address</div>
                        <div class="contact-info-value"><?php echo nl2br( esc_html( $address ) ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <!-- Phone -->
                <?php if ( $phone ) :
                    $phone_clean = preg_replace( '/[^+0-9]/', '', $phone );
                ?>
                <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Phone</div>
                        <div class="contact-info-value"><?php echo esc_html( $phone ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <!-- Email -->
                <?php if ( $email ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Email</div>
                        <div class="contact-info-value"><?php echo esc_html( $email ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <!-- Instagram -->
                <?php if ( $instagram ) : ?>
                <a href="<?php echo esc_url( $ig_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Instagram</div>
                        <div class="contact-info-value"><?php echo esc_html( $instagram ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <!-- WhatsApp CTA -->
                <?php if ( $wa_url ) : ?>
                <a href="<?php echo esc_url( $wa_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-wa-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                    <?php echo esc_html( $wa_btn_text ); ?>
                </a>
                <?php endif; ?>

                <!-- Business Hours -->
                <div class="contact-hours-title">
                    <i class="fa-regular fa-clock"></i> Studio Hours
                </div>
                <div>
                    <div class="contact-hours-row">
                        <span class="contact-hours-day">Monday – Friday</span>
                        <span class="contact-hours-time"><?php echo esc_html( $hours_weekday ); ?></span>
                    </div>
                    <div class="contact-hours-row">
                        <span class="contact-hours-day">Saturday</span>
                        <span class="contact-hours-time"><?php echo esc_html( $hours_saturday ); ?></span>
                    </div>
                    <div class="contact-hours-row">
                        <span class="contact-hours-day">Sunday</span>
                        <span class="contact-hours-time closed"><?php echo esc_html( $hours_sunday ); ?></span>
                    </div>
                </div>

            </div><!-- /col -->

            <!-- ── Right Column: Form ─────────────────────────── -->
            <div class="col-lg-7">
                <div class="contact-form-wrap">

                    <h2 class="contact-form-title">
                        <?php
                        $parts = explode( ' ', $form_title, -1 );
                        $last  = explode( ' ', $form_title );
                        $last_word = array_pop( $last );
                        echo esc_html( implode( ' ', $last ) ) . ' <span>' . esc_html( $last_word ) . '</span>';
                        ?>
                    </h2>
                    <p class="contact-form-subtitle"><?php echo esc_html( $form_subtitle ); ?></p>

                    <form id="contactForm" novalidate>
                        <?php wp_nonce_field( 'goldmoment_contact', 'contact_nonce' ); ?>
                        <input type="hidden" name="action" value="goldmoment_contact">

                        <div class="contact-form-row">
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="ct_name">
                                    Full Name <span class="req">*</span>
                                </label>
                                <input type="text"
                                       id="ct_name"
                                       name="ct_name"
                                       class="contact-form-input"
                                       placeholder="Your full name"
                                       required
                                       autocomplete="name">
                            </div>
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="ct_email">
                                    Email Address <span class="req">*</span>
                                </label>
                                <input type="email"
                                       id="ct_email"
                                       name="ct_email"
                                       class="contact-form-input"
                                       placeholder="your@email.com"
                                       required
                                       autocomplete="email">
                            </div>
                        </div>

                        <div class="contact-form-row">
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="ct_phone">Phone / WhatsApp</label>
                                <input type="tel"
                                       id="ct_phone"
                                       name="ct_phone"
                                       class="contact-form-input"
                                       placeholder="+62 8xx xxxx xxxx"
                                       autocomplete="tel">
                            </div>
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="ct_subject">Topic</label>
                                <select id="ct_subject" name="ct_subject" class="contact-form-select">
                                    <option value="">— Select a topic —</option>
                                    <option value="Booking Inquiry">Booking Inquiry</option>
                                    <option value="Custom Design">Custom Design</option>
                                    <option value="Pricing">Pricing</option>
                                    <option value="Aftercare">Aftercare</option>
                                    <option value="Touch-up">Touch-up / Fix</option>
                                    <option value="General Question">General Question</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="contact-form-group">
                            <label class="contact-form-label" for="ct_message">
                                Message <span class="req">*</span>
                            </label>
                            <textarea id="ct_message"
                                      name="ct_message"
                                      class="contact-form-textarea"
                                      placeholder="Tell us about your tattoo idea, questions, or anything else..."
                                      required></textarea>
                        </div>

                        <button type="submit" class="contact-submit-btn" id="contactSubmitBtn">
                            <i class="fa-solid fa-paper-plane"></i>
                            Send Message
                        </button>

                        <div class="contact-feedback" id="contactFeedback"></div>

                    </form>

                </div>
            </div><!-- /col -->

        </div>
    </div>
</section>


<!-- ============================================================
     CONTACT — GOOGLE MAP
============================================================ -->
<?php if ( $map_url ) : ?>
<section class="contact-map-section" aria-label="Studio location map">
    <iframe
        src="<?php echo esc_url( $map_url ); ?>"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Gold Moment Tattoo Bali — Location Map">
    </iframe>
</section>
<?php endif; ?>


<!-- ============================================================
     CONTACT FORM — JAVASCRIPT
============================================================ -->
<script>
(function () {
    var form      = document.getElementById('contactForm');
    var submitBtn = document.getElementById('contactSubmitBtn');
    var feedback  = document.getElementById('contactFeedback');

    if (!form) return;

    function showFeedback(type, msg) {
        feedback.className  = 'contact-feedback ' + type;
        feedback.textContent = msg;
        feedback.style.display = 'block';
        feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var name    = form.querySelector('#ct_name').value.trim();
        var email   = form.querySelector('#ct_email').value.trim();
        var message = form.querySelector('#ct_message').value.trim();

        if (!name || !email || !message) {
            showFeedback('error', 'Please fill in your name, email and message.');
            return;
        }

        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRe.test(email)) {
            showFeedback('error', 'Please enter a valid email address.');
            return;
        }

        submitBtn.disabled   = true;
        submitBtn.innerHTML  = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
        feedback.style.display = 'none';

        var data = new FormData(form);

        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body:   data,
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                showFeedback('success', res.data.message || '<?php echo esc_js( $form_success ); ?>');
                form.reset();
            } else {
                showFeedback('error', res.data.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(function () {
            showFeedback('error', 'Network error. Please try again or contact us directly.');
        })
        .finally(function () {
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Message';
        });
    });
}());
</script>

<?php get_footer(); ?>
