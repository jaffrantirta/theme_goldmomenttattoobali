<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Gold Moment Tattoo Bali — Premium tattoo studio in Bali. Custom designs, Japanese, Blackwork, Realism, Geometric styles. Book your appointment today.">
    <meta name="keywords" content="tattoo bali, tato bali, tattoo studio bali, custom tattoo, gold moment tattoo">
    <meta property="og:title" content="Gold Moment Tattoo Bali">
    <meta property="og:description" content="Premium tattoo studio in the heart of Bali. Book your unique tattoo experience.">
    <meta property="og:type" content="website">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class('goldmoment-body'); ?>>
<?php wp_body_open(); ?>

<!-- ============================================================
     NAVIGATION
============================================================ -->
<nav id="main-navbar" class="navbar navbar-expand-lg" role="navigation" aria-label="Main navigation">
    <div class="container">

        <!-- Brand Logo -->
        <a class="navbar-brand navbar-brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Gold Moment Tattoo Bali">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                Gold Moment
                <span>Tattoo Bali</span>
            <?php endif; ?>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center gap-lg-1">

                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu'           => 'primary', // also match by menu name if location not assigned
                    'menu_class'     => 'navbar-nav d-flex flex-column flex-lg-row align-items-lg-center gap-lg-1',
                    'container'      => false,
                    'walker'         => new Goldmoment_Walker_Nav_Menu(),
                    'fallback_cb'    => '__return_false',
                ] );
                ?>

                <!-- Book Now CTA — always visible regardless of menu -->
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn-gold btn-gold-sm" href="#book-now" style="font-size:11px; padding:10px 22px; border-radius:3px;">
                        <i class="fa-solid fa-calendar-check me-1"></i> Book Now
                    </a>
                </div>

            </div>
        </div>
    </div>
</nav>
<!-- /NAVIGATION -->
