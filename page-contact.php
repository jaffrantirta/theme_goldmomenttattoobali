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

// ── Contact Details ───────────────────────────────────────────
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

// ── Map & WhatsApp ────────────────────────────────────────────
$map_url     = get_theme_mod( 'map_embed_url',       '' );
$wa_btn_text = get_theme_mod( 'contact_page_wa_btn', 'Chat on WhatsApp' );
?>

<style>
/* ── Contact Page Hero ────────────────────────────────────── */
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
    padding: 80px 0 0;
    background: var(--dark);
}

/* ── Info Cards ───────────────────────────────────────────── */
.contact-info-card {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    padding: 20px 22px;
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    margin-bottom: 12px;
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

/* Hours */
.contact-hours-title {
    font-family: var(--font-heading);
    font-size: 0.8rem;
    color: var(--gold);
    letter-spacing: 0.2em;
    text-transform: uppercase;
    margin-bottom: 12px;
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
.contact-hours-day  { color: #888; }
.contact-hours-time { color: var(--white); font-family: var(--font-heading); font-size: 0.8rem; }
.contact-hours-time.closed { color: var(--gold); }

/* ── Map Column ───────────────────────────────────────────── */
.contact-map-col {
    display: flex;
    flex-direction: column;
}
.contact-map-frame {
    flex: 1;
    min-height: 500px;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(201,168,76,0.12);
}
.contact-map-frame iframe {
    width: 100%;
    height: 100%;
    min-height: 500px;
    border: none;
    display: block;
    filter: grayscale(25%) contrast(1.05);
}
.contact-map-placeholder {
    width: 100%;
    min-height: 500px;
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    color: var(--gray);
    font-size: 0.875rem;
    text-align: center;
    padding: 40px;
}
.contact-map-placeholder i { font-size: 48px; color: rgba(201,168,76,0.2); }

@media (max-width: 991px) {
    .contact-map-frame,
    .contact-map-frame iframe,
    .contact-map-placeholder { min-height: 380px; }
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
     CONTACT — INFO + MAP
============================================================ -->
<section class="contact-main-section" aria-label="Contact information and map">
    <div class="container pb-5">
        <div class="row g-5 align-items-stretch">

            <!-- ── Left: Contact Info ─────────────────────────── -->
            <div class="col-lg-5">

                <?php if ( $address ) : ?>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode( $address ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-info-card">
                    <div class="contact-info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div class="contact-info-label">Studio Address</div>
                        <div class="contact-info-value"><?php echo nl2br( esc_html( $address ) ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ( $phone ) :
                    $phone_clean = preg_replace( '/[^+0-9]/', '', $phone );
                ?>
                <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="contact-info-card">
                    <div class="contact-info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <div class="contact-info-label">Phone</div>
                        <div class="contact-info-value"><?php echo esc_html( $phone ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ( $email ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-info-card">
                    <div class="contact-info-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div class="contact-info-label">Email</div>
                        <div class="contact-info-value"><?php echo esc_html( $email ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ( $instagram ) : ?>
                <a href="<?php echo esc_url( $ig_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-info-card">
                    <div class="contact-info-icon"><i class="fa-brands fa-instagram"></i></div>
                    <div>
                        <div class="contact-info-label">Instagram</div>
                        <div class="contact-info-value"><?php echo esc_html( $instagram ); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ( $wa_url ) : ?>
                <a href="<?php echo esc_url( $wa_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-wa-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                    <?php echo esc_html( $wa_btn_text ); ?>
                </a>
                <?php endif; ?>

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

            </div><!-- /left col -->

            <!-- ── Right: Map ────────────────────────────────── -->
            <div class="col-lg-7 contact-map-col">
                <?php if ( $map_url ) : ?>
                <div class="contact-map-frame">
                    <iframe
                        src="<?php echo esc_url( $map_url ); ?>"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Gold Moment Tattoo Bali — Studio Location">
                    </iframe>
                </div>
                <?php else : ?>
                <div class="contact-map-placeholder">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>
                        Add your Google Maps embed URL in<br>
                        <strong>Appearance → Customize → ⑦ Find Us Section → Google Map Embed</strong>
                    </p>
                </div>
                <?php endif; ?>
            </div><!-- /map col -->

        </div>
    </div>
</section>

<?php get_footer(); ?>
