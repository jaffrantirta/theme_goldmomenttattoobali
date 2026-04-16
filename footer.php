<?php
/**
 * Gold Moment Tattoo Bali — Footer Template
 * All content pulled from Customizer via get_theme_mod().
 */

// ── Footer Customizer Values ──────────────────────────────────
$footer_brand    = get_theme_mod( 'footer_brand_name',  'Gold Moment' );
$footer_sub      = get_theme_mod( 'footer_brand_sub',   'Tattoo Bali' );
$footer_desc     = get_theme_mod( 'footer_description', 'Premium tattoo studio nestled in the heart of Seminyak, Bali. Where artistry meets permanence, and every moment becomes gold.' );
$footer_rating   = get_theme_mod( 'footer_rating_text', '4.9 / 5.0 — 200+ Reviews' );
$footer_copy     = get_theme_mod( 'footer_copyright',   'Gold Moment Tattoo Bali. All rights reserved. Crafted with ♥ in Bali.' );

$social_ig  = get_theme_mod( 'social_instagram', 'https://www.instagram.com/goldmomenttattoo.bali' );
$social_wa  = get_theme_mod( 'social_whatsapp',  'https://wa.me/6281234567890' );
$social_tt  = get_theme_mod( 'social_tiktok',    'https://www.tiktok.com/@goldmomenttattoo' );
$social_fb  = get_theme_mod( 'social_facebook',  'https://www.facebook.com/goldmomenttattoo' );
$social_pin = get_theme_mod( 'social_pinterest', 'https://www.pinterest.com/goldmomenttattoo' );

$hours_weekday = get_theme_mod( 'hours_weekday',  '10:00 – 20:00' );
$hours_sat     = get_theme_mod( 'hours_saturday', '09:00 – 21:00' );
$hours_sun     = get_theme_mod( 'hours_sunday',   'By Appointment Only' );
?>

<!-- ============================================================
     SECTION 7 — FOOTER
============================================================ -->
<footer id="main-footer" role="contentinfo" aria-label="Site Footer">
    <div class="container">
        <div class="row g-5">

            <!-- Col 1: Brand -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand-name"><?php echo esc_html( $footer_brand ); ?></div>
                <div class="footer-brand-sub"><?php echo esc_html( $footer_sub ); ?></div>
                <p class="footer-brand-desc"><?php echo esc_html( $footer_desc ); ?></p>

                <!-- Social Links -->
                <div class="footer-social mt-4">
                    <?php if ( $social_ig ) : ?>
                    <a href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-link" aria-label="Follow on Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_wa ) : ?>
                    <a href="<?php echo esc_url( $social_wa ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-link" aria-label="Chat on WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_tt ) : ?>
                    <a href="<?php echo esc_url( $social_tt ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-link" aria-label="Follow on TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_fb ) : ?>
                    <a href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-link" aria-label="Follow on Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_pin ) : ?>
                    <a href="<?php echo esc_url( $social_pin ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-link" aria-label="Follow on Pinterest">
                        <i class="fa-brands fa-pinterest-p"></i>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Rating Badge -->
                <div class="d-flex align-items-center gap-3 mt-4 p-3 rounded-3"
                     style="background:var(--dark-2);border:1px solid rgba(201,168,76,0.1);display:inline-flex !important;">
                    <div>
                        <div style="color:var(--gold);font-size:14px;letter-spacing:2px;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <div style="font-size:11px;color:var(--gray);"><?php echo esc_html( $footer_rating ); ?></div>
                    </div>
                    <div style="width:1px;height:36px;background:rgba(255,255,255,0.08);"></div>
                    <div>
                        <div style="font-family:var(--font-heading);font-size:13px;color:var(--white);">Google</div>
                        <div style="font-size:11px;color:var(--gray);">Verified Reviews</div>
                    </div>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-sm-6">
                <h4 class="footer-heading">Navigate</h4>
                <ul class="footer-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#tattoo-carousel">Portfolio</a></li>
                    <li><a href="#why-us">About Us</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#how-it-works">The Process</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>">Blog</a></li>
                    <li><a href="#book-now">Book Now</a></li>
                </ul>
            </div>

            <!-- Col 3: Styles -->
            <div class="col-lg-3 col-sm-6">
                <h4 class="footer-heading">Our Styles</h4>
                <ul class="footer-links">
                    <li><a href="#book-now">Japanese / Irezumi</a></li>
                    <li><a href="#book-now">Blackwork &amp; Dotwork</a></li>
                    <li><a href="#book-now">Realism &amp; Portrait</a></li>
                    <li><a href="#book-now">Fine Line</a></li>
                    <li><a href="#book-now">Geometric</a></li>
                    <li><a href="#book-now">Watercolor</a></li>
                    <li><a href="#book-now">Neo-Traditional</a></li>
                    <li><a href="#book-now">Tribal / Balinese</a></li>
                </ul>
            </div>

            <!-- Col 4: Hours + Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Studio Hours</h4>
                <div class="mb-4">
                    <div class="footer-hours-item">
                        <span class="day">Monday – Friday</span>
                        <span class="time"><?php echo esc_html( $hours_weekday ); ?></span>
                    </div>
                    <div class="footer-hours-item">
                        <span class="day">Saturday</span>
                        <span class="time"><?php echo esc_html( $hours_sat ); ?></span>
                    </div>
                    <div class="footer-hours-item">
                        <span class="day">Sunday</span>
                        <span class="time closed"><?php echo esc_html( $hours_sun ); ?></span>
                    </div>
                </div>

                <h4 class="footer-heading mt-4">Stay Updated</h4>
                <p style="font-size:12px;color:#555;margin-bottom:10px;">
                    Get flash deal alerts, new design drops &amp; studio news.
                </p>
                <div class="newsletter-input-group">
                    <input type="email" class="newsletter-input"
                           placeholder="your@email.com"
                           aria-label="Email for newsletter">
                    <button class="newsletter-btn" aria-label="Subscribe to newsletter">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>

        </div>

        <hr class="footer-divider">

        <!-- Bottom Bar -->
        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-3">

            <p class="footer-copy">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php echo esc_html( $footer_copy ); ?>
                </a>
            </p>

            <div class="d-flex gap-3 flex-wrap">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" style="font-size:11px;color:#444;letter-spacing:0.1em;text-transform:uppercase;"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='#444'">Privacy Policy</a>
                <a href="#" style="font-size:11px;color:#444;letter-spacing:0.1em;text-transform:uppercase;"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='#444'">Terms of Service</a>
                <a href="#" style="font-size:11px;color:#444;letter-spacing:0.1em;text-transform:uppercase;"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='#444'">Sitemap</a>
            </div>

        </div>
    </div>
</footer>
<!-- /FOOTER -->

<!-- Back to Top -->
<button id="backToTop" aria-label="Back to top"
        style="position:fixed;bottom:30px;right:30px;width:46px;height:46px;border-radius:50%;background:var(--gold);color:var(--black);border:none;cursor:pointer;font-size:16px;display:none;align-items:center;justify-content:center;z-index:999;box-shadow:0 4px 20px rgba(201,168,76,0.4);transition:all 0.3s ease;">
    <i class="fa-solid fa-chevron-up"></i>
</button>

<?php wp_footer(); ?>
</body>
</html>
