<?php
/**
 * Gold Moment Tattoo Bali — WordPress Customizer
 *
 * Panels → Sections → Settings → Controls
 * Every text visible on the landing page is editable here.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ================================================================
   HELPER FUNCTIONS  (reduce repetition)
================================================================ */

/** Text input */
function gm_text( $c, $id, $label, $section, $default = '', $priority = 10, $desc = '' ) {
    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $c->add_control( $id, [
        'label'       => $label,
        'description' => $desc,
        'section'     => $section,
        'type'        => 'text',
        'priority'    => $priority,
    ] );
}

/** Textarea input */
function gm_textarea( $c, $id, $label, $section, $default = '', $priority = 10, $desc = '' ) {
    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ] );
    $c->add_control( $id, [
        'label'       => $label,
        'description' => $desc,
        'section'     => $section,
        'type'        => 'textarea',
        'priority'    => $priority,
    ] );
}

/** URL input */
function gm_url( $c, $id, $label, $section, $default = '', $priority = 10, $desc = '' ) {
    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $c->add_control( $id, [
        'label'       => $label,
        'description' => $desc,
        'section'     => $section,
        'type'        => 'url',
        'priority'    => $priority,
    ] );
}

/** Image picker (uses WP media library) */
function gm_image( $c, $id, $label, $section, $default = '', $priority = 10, $desc = '' ) {
    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $c->add_control( new WP_Customize_Image_Control( $c, $id, [
        'label'       => $label,
        'description' => $desc,
        'section'     => $section,
        'priority'    => $priority,
    ] ) );
}

/** Color picker */
function gm_color( $c, $id, $label, $section, $default = '#C9A84C', $priority = 10 ) {
    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $c->add_control( new WP_Customize_Color_Control( $c, $id, [
        'label'    => $label,
        'section'  => $section,
        'priority' => $priority,
    ] ) );
}

/** Section heading (fake control used as a divider/label) */
function gm_heading( $c, $id, $label, $section, $priority = 10 ) {
    $c->add_control( new WP_Customize_Control( $c, 'heading_' . $id, [
        'label'    => '— ' . $label . ' —',
        'section'  => $section,
        'type'     => 'hidden',
        'priority' => $priority,
    ] ) );
}


/* ================================================================
   MAIN CUSTOMIZER REGISTRATION
================================================================ */
function goldmoment_customizer_register( WP_Customize_Manager $wp_customize ) {

    /* ──────────────────────────────────────────────────────────
       SECTION — NAVBAR CTA BUTTON
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_navbar_cta', [
        'title'       => '🔘 Navbar CTA Button',
        'description' => 'Customize the "Book Now" button shown in the top navigation bar.',
        'priority'    => 25,
    ] );

    gm_text( $wp_customize, 'navbar_cta_text', 'Button Label',          'gm_sec_navbar_cta', 'Book Now',                    10 );
    gm_url(  $wp_customize, 'navbar_cta_url',  'Button Link URL',       'gm_sec_navbar_cta', '#book-now',                   20 );
    gm_text( $wp_customize, 'navbar_cta_icon', 'Icon (Font Awesome class)', 'gm_sec_navbar_cta', 'fa-solid fa-calendar-check',
        30, 'e.g. fa-solid fa-calendar-check — leave blank to hide icon' );

    // Show / hide the button
    $wp_customize->add_setting( 'navbar_cta_show', [
        'default'           => '1',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'navbar_cta_show', [
        'label'   => 'Show CTA Button',
        'section' => 'gm_sec_navbar_cta',
        'type'    => 'checkbox',
        'priority' => 5,
    ] );


    /* ──────────────────────────────────────────────────────────
       PANEL 0 — THEME COLORS
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_colors', [
        'title'       => '🎨 Theme Colors',
        'description' => 'Adjust the primary color palette.',
        'priority'    => 30,
    ] );

    $wp_customize->add_section( 'gm_sec_colors', [
        'title'  => 'Color Settings',
        'panel'  => 'gm_panel_colors',
    ] );

    gm_color( $wp_customize, 'gm_color_gold',       'Primary Gold',          'gm_sec_colors', '#C9A84C', 10 );
    gm_color( $wp_customize, 'gm_color_gold_light',  'Gold — Light Variant',  'gm_sec_colors', '#e8c96a', 20 );
    gm_color( $wp_customize, 'gm_color_gold_dark',   'Gold — Dark Variant',   'gm_sec_colors', '#8B6914', 30 );
    gm_color( $wp_customize, 'gm_color_black',       'Site Background',       'gm_sec_colors', '#0d0d0d', 40 );
    gm_color( $wp_customize, 'gm_color_dark',        'Card Background',       'gm_sec_colors', '#1a1a1a', 50 );


    /* ──────────────────────────────────────────────────────────
       PANEL 1 — HERO SECTION
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_hero', [
        'title'    => '① Hero Section',
        'priority' => 31,
    ] );

    /* 1-A: Hero Content ─────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_hero_content', [
        'title' => 'Hero — Content',
        'panel' => 'gm_panel_hero',
    ] );

    gm_text(
        $wp_customize, 'hero_eyebrow_text',
        'Eyebrow Text', 'gm_sec_hero_content',
        'Est. 2018 — Bali, Indonesia', 10
    );
    gm_text(
        $wp_customize, 'hero_title_line1',
        'Title — Line 1 (above highlight)', 'gm_sec_hero_content',
        'Wear Your', 20
    );
    gm_text(
        $wp_customize, 'hero_title_highlight',
        'Title — Highlighted Word (gold)', 'gm_sec_hero_content',
        'Story', 30
    );
    gm_text(
        $wp_customize, 'hero_title_line3',
        'Title — Line 3 (below highlight)', 'gm_sec_hero_content',
        'in Gold Ink', 40
    );
    gm_text(
        $wp_customize, 'hero_location',
        'Location Line', 'gm_sec_hero_content',
        'Seminyak, Bali — Indonesia', 50
    );
    gm_textarea(
        $wp_customize, 'hero_description',
        'Hero Description Paragraph', 'gm_sec_hero_content',
        'Every mark tells a story. At Gold Moment Tattoo Bali, our master artists transform your vision into breathtaking, permanent art — crafted with precision, passion, and the finest inks.', 60
    );

    /* 1-B: Hero Background ──────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_hero_bg', [
        'title' => 'Hero — Background Image',
        'panel' => 'gm_panel_hero',
    ] );

    gm_image(
        $wp_customize, 'hero_bg_image',
        'Hero Background Image', 'gm_sec_hero_bg',
        'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=1920&q=85', 10,
        'Recommended: 1920×1080px dark/moody tattoo image'
    );
    gm_image(
        $wp_customize, 'hero_side_image',
        'Hero Side Card Image (desktop)', 'gm_sec_hero_bg',
        'https://images.unsplash.com/photo-1562962230-2895f8a82b44?w=800&q=85', 20,
        'Portrait-style image shown on the right side on desktop'
    );
    gm_text(
        $wp_customize, 'hero_side_badge_title',
        'Side Card — Badge Title', 'gm_sec_hero_bg',
        'Master Artist', 30
    );
    gm_text(
        $wp_customize, 'hero_side_badge_sub',
        'Side Card — Badge Subtitle', 'gm_sec_hero_bg',
        '10+ Years Experience', 40
    );

    /* 1-C: Hero CTA Buttons ─────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_hero_cta', [
        'title' => 'Hero — CTA Buttons',
        'panel' => 'gm_panel_hero',
    ] );

    gm_text( $wp_customize, 'hero_cta1_text', 'Button 1 — Label',        'gm_sec_hero_cta', 'Book Appointment', 10 );
    gm_url(  $wp_customize, 'hero_cta1_url',  'Button 1 — Link URL',      'gm_sec_hero_cta', '#book-now',        20 );
    gm_text( $wp_customize, 'hero_cta2_text', 'Button 2 — Label',        'gm_sec_hero_cta', 'View Gallery',     30 );
    gm_url(  $wp_customize, 'hero_cta2_url',  'Button 2 — Link URL',      'gm_sec_hero_cta', '#gallery',         40 );

    /* 1-D: Hero Statistics ──────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_hero_stats', [
        'title'       => 'Hero — Statistics Counters',
        'panel'       => 'gm_panel_hero',
        'description' => 'The four animated numbers shown in the hero section.',
    ] );

    $stat_defaults = [
        1 => [ '500', 'Tattoos Done'   ],
        2 => [ '7',   'Years of Art'   ],
        3 => [ '12',  'Art Styles'     ],
        4 => [ '98',  '% Satisfaction' ],
    ];
    foreach ( $stat_defaults as $n => $def ) {
        gm_text( $wp_customize, "hero_stat_{$n}_number", "Stat {$n} — Number", 'gm_sec_hero_stats', $def[0], $n * 10 );
        gm_text( $wp_customize, "hero_stat_{$n}_label",  "Stat {$n} — Label",  'gm_sec_hero_stats', $def[1], $n * 10 + 5 );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 2 — TATTOO CAROUSEL / PORTFOLIO
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_carousel', [
        'title'    => '② Portfolio Carousel',
        'priority' => 32,
    ] );

    /* 2-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_carousel_header', [
        'title' => 'Carousel — Section Header',
        'panel' => 'gm_panel_carousel',
    ] );

    gm_text( $wp_customize, 'carousel_badge',           'Badge Text',          'gm_sec_carousel_header', 'Our Portfolio',   10 );
    gm_text( $wp_customize, 'carousel_title',           'Title — Normal Part', 'gm_sec_carousel_header', 'Ink That',        20 );
    gm_text( $wp_customize, 'carousel_title_highlight', 'Title — Gold Part',   'gm_sec_carousel_header', 'Speaks',          30 );
    gm_textarea( $wp_customize, 'carousel_subtitle',    'Subtitle Paragraph',  'gm_sec_carousel_header',
        'Browse through our diverse portfolio of custom tattoo designs. Each piece is uniquely crafted to reflect your personal story and style.', 40 );

    /* 2-B: Tattoo Cards ─────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_carousel_items', [
        'title'       => 'Carousel — Portfolio Cards',
        'panel'       => 'gm_panel_carousel',
        'description' => 'Edit the 8 portfolio cards shown in the carousel.',
    ] );

    $carousel_defaults = [
        1 => [ 'https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=500&q=80', 'Japanese',       'Dragon Koi',      'by Ari Santoso',  'Traditional Japanese',   'A powerful koi dragon sleeve full of symbolism'    ],
        2 => [ 'https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=500&q=80', 'Blackwork',   'Sacred Geometry', 'by Maya Dewi',    'Blackwork Geometric',    'Intricate mandala patterns with bold black lines'  ],
        3 => [ 'https://images.unsplash.com/photo-1559059699-d4a0b5c1b935?w=500&q=80', 'Realism',        'Portrait Art',    'by Dewa Putra',   'Photo Realism',          'Hyper-realistic portraits captured in ink forever' ],
        4 => [ 'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=500&q=80', 'Fine Line',   'Floral Minimal',  'by Sari Putri',   'Fine Line Botanical',    'Delicate florals drawn with hair-thin precision'   ],
        5 => [ 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?w=500&q=80', 'Neo-Traditional', 'Tiger Spirit', 'by Bima Arya',   'Neo-Traditional',        'Bold neo-trad tiger with vibrant gold highlights'  ],
        6 => [ 'https://images.unsplash.com/photo-1590246814883-57c511e76523?w=500&q=80', 'Watercolor',  'Ocean Dream',     'by Maya Dewi',    'Watercolor Abstract',    'Flowing colors that bleed like watercolor paint'   ],
        7 => [ 'https://images.unsplash.com/photo-1552074284-5e84b8e7b7e8?w=500&q=80', 'Geometric',      'Cosmic Web',      'by Ari Santoso',  'Dotwork Geometric',      'Sacred geometry meets celestial dotwork artistry'  ],
        8 => [ 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=500&q=80', 'Japanese',    'Bali Lotus',      'by Dewa Putra',   'Balinese Japanese',      'Fusion of Balinese art and Japanese tattooing'     ],
    ];

    foreach ( $carousel_defaults as $n => $def ) {
        $p = $n * 10;
        gm_image(    $wp_customize, "tattoo_{$n}_img",    "Card {$n} — Image",          'gm_sec_carousel_items', $def[0], $p,      "Portfolio card {$n} image" );
        gm_text(     $wp_customize, "tattoo_{$n}_tag",    "Card {$n} — Style Tag",      'gm_sec_carousel_items', $def[1], $p + 1 );
        gm_text(     $wp_customize, "tattoo_{$n}_name",   "Card {$n} — Piece Name",     'gm_sec_carousel_items', $def[2], $p + 2 );
        gm_text(     $wp_customize, "tattoo_{$n}_artist", "Card {$n} — Artist",         'gm_sec_carousel_items', $def[3], $p + 3 );
        gm_text(     $wp_customize, "tattoo_{$n}_style",  "Card {$n} — Style (hover)",  'gm_sec_carousel_items', $def[4], $p + 4 );
        gm_textarea( $wp_customize, "tattoo_{$n}_desc",   "Card {$n} — Description",    'gm_sec_carousel_items', $def[5], $p + 5 );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 3 — WHY US
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_why', [
        'title'    => '③ Why Us Section',
        'priority' => 33,
    ] );

    /* 3-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_why_header', [
        'title' => 'Why Us — Section Header',
        'panel' => 'gm_panel_why',
    ] );

    gm_text( $wp_customize, 'why_badge',           'Badge Text',          'gm_sec_why_header', 'Why Gold Moment',   10 );
    gm_text( $wp_customize, 'why_title',           'Title — Normal Part', 'gm_sec_why_header', 'The Art of',        20 );
    gm_text( $wp_customize, 'why_title_highlight', 'Title — Gold Part',   'gm_sec_why_header', 'Excellence',        30 );
    gm_textarea( $wp_customize, 'why_subtitle',    'Subtitle Paragraph',  'gm_sec_why_header',
        'We don\'t just tattoo — we create wearable masterpieces. Here\'s what sets us apart from the rest.', 40 );

    /* 3-B: Bottom CTA Banner ────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_why_cta', [
        'title' => 'Why Us — Bottom Banner',
        'panel' => 'gm_panel_why',
    ] );

    gm_text( $wp_customize, 'why_cta_text',       'Banner Text',            'gm_sec_why_cta', 'Ready to wear your story? Let\'s create something unforgettable.', 10 );
    gm_text( $wp_customize, 'why_cta_btn',        'Banner Button Label',    'gm_sec_why_cta', 'Start Your Journey', 20 );
    gm_url(  $wp_customize, 'why_cta_url',        'Banner Button Link',     'gm_sec_why_cta', '#book-now',          30 );

    /* 3-C: Feature Cards ────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_why_cards', [
        'title'       => 'Why Us — Feature Cards',
        'panel'       => 'gm_panel_why',
        'description' => 'Edit the 6 feature cards. Icon field accepts Font Awesome class, e.g. fa-solid fa-palette',
    ] );

    $why_defaults = [
        1 => [ 'fa-solid fa-palette',       'Master-Level Artists',     'Our team of internationally trained tattoo artists brings over a decade of combined experience across all major tattoo styles. Every piece is a signature work of art.'        ],
        2 => [ 'fa-solid fa-shield-halved',  'Sterilization Guaranteed', 'Your safety is our top priority. We use hospital-grade sterilization, single-use needles, and premium hypoallergenic inks — every single session, no exceptions.'            ],
        3 => [ 'fa-solid fa-pen-nib',        '100% Custom Designs',      'No flash sheets, no copy-paste. Each design is crafted exclusively for you — we sit down, listen to your vision, and sketch a unique piece that is entirely yours.'          ],
        4 => [ 'fa-solid fa-award',          'Award-Winning Studio',     'Recognized at Bali Tattoo Expos and international competitions, our studio has earned a reputation for pushing boundaries and delivering world-class results.'                 ],
        5 => [ 'fa-solid fa-heart-pulse',    'Aftercare & Follow-Up',    'We provide premium aftercare kits, detailed healing guides, and complimentary touch-up sessions. Our relationship doesn\'t end when you walk out the door.'                   ],
        6 => [ 'fa-solid fa-leaf',           'Eco-Friendly Practice',    'We source vegan-friendly, cruelty-free inks and maintain sustainable studio practices — because great art should be kind to the earth too.'                                   ],
    ];

    foreach ( $why_defaults as $n => $def ) {
        $p = $n * 10;
        gm_text(     $wp_customize, "why_card_{$n}_icon",  "Card {$n} — Icon Class (FA)", 'gm_sec_why_cards', $def[0], $p,     'e.g. fa-solid fa-palette' );
        gm_text(     $wp_customize, "why_card_{$n}_title", "Card {$n} — Title",           'gm_sec_why_cards', $def[1], $p + 1 );
        gm_textarea( $wp_customize, "why_card_{$n}_text",  "Card {$n} — Description",     'gm_sec_why_cards', $def[2], $p + 2 );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 4 — GALLERY
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_gallery', [
        'title'    => '④ Gallery Section',
        'priority' => 34,
    ] );

    /* 4-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_gallery_header', [
        'title' => 'Gallery — Section Header',
        'panel' => 'gm_panel_gallery',
    ] );

    gm_text( $wp_customize, 'gallery_badge',           'Badge Text',            'gm_sec_gallery_header', 'Gallery',          10 );
    gm_text( $wp_customize, 'gallery_title',           'Title — Normal Part',   'gm_sec_gallery_header', 'Ink in',           20 );
    gm_text( $wp_customize, 'gallery_title_highlight', 'Title — Gold Part',     'gm_sec_gallery_header', 'Motion',           30 );
    gm_textarea( $wp_customize, 'gallery_subtitle',    'Subtitle Paragraph',    'gm_sec_gallery_header',
        'A curated selection of our finest works — from intricate Japanese sleeves to whisper-thin fine line florals.', 40 );
    gm_url( $wp_customize, 'gallery_instagram_url',    'Instagram Profile URL', 'gm_sec_gallery_header',
        'https://www.instagram.com/goldmomenttattoo.bali', 50, 'The "More on Instagram" button link' );
    gm_text( $wp_customize, 'gallery_instagram_btn',   '"More" Button Label',   'gm_sec_gallery_header', 'More on Instagram', 60 );

    /* 4-B: Gallery Items ────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_gallery_items', [
        'title'       => 'Gallery — Items',
        'panel'       => 'gm_panel_gallery',
        'description' => 'Edit the 8 gallery images and their hover labels.',
    ] );

    $gallery_defaults = [
        1 => [ 'https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=800&q=85', 'Japanese Sleeve'      ],
        2 => [ 'https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=600&q=80', 'Geometric Mandala'  ],
        3 => [ 'https://images.unsplash.com/photo-1559059699-d4a0b5c1b935?w=600&q=80', 'Portrait Realism'     ],
        4 => [ 'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=600&q=80', 'Fine Line Floral'   ],
        5 => [ 'https://images.unsplash.com/photo-1590246814883-57c511e76523?w=600&q=80', 'Watercolor Splash'  ],
        6 => [ 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?w=800&q=85', 'Neo-Traditional Tiger' ],
        7 => [ 'https://images.unsplash.com/photo-1552074284-5e84b8e7b7e8?w=600&q=80', 'Dotwork Cosmic'       ],
        8 => [ 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=600&q=80', 'Bali Lotus'         ],
    ];

    foreach ( $gallery_defaults as $n => $def ) {
        gm_image( $wp_customize, "gallery_item_{$n}_img",   "Image {$n} — Photo",       'gm_sec_gallery_items', $def[0], $n * 10     );
        gm_text(  $wp_customize, "gallery_item_{$n}_label", "Image {$n} — Hover Label", 'gm_sec_gallery_items', $def[1], $n * 10 + 5 );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 5 — HOW IT WORKS
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_how', [
        'title'    => '⑤ How It Works Section',
        'priority' => 35,
    ] );

    /* 5-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_how_header', [
        'title' => 'How It Works — Header',
        'panel' => 'gm_panel_how',
    ] );

    gm_text( $wp_customize, 'how_badge',           'Badge Text',          'gm_sec_how_header', 'The Process',        10 );
    gm_text( $wp_customize, 'how_title',           'Title — Normal Part', 'gm_sec_how_header', 'Your Tattoo',        20 );
    gm_text( $wp_customize, 'how_title_highlight', 'Title — Gold Part',   'gm_sec_how_header', 'Journey',            30 );
    gm_textarea( $wp_customize, 'how_subtitle',    'Subtitle Paragraph',  'gm_sec_how_header',
        'From first consultation to forever ink — here\'s what your Gold Moment experience looks like, step by step.', 40 );

    /* 5-B: Process Steps ────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_how_steps', [
        'title'       => 'How It Works — Steps',
        'panel'       => 'gm_panel_how',
        'description' => 'Edit the 4 process steps.',
    ] );

    $step_defaults = [
        1 => [ 'Book & Consult',  'Fill out our booking form or DM us on Instagram. We\'ll schedule a free consultation to discuss your vision, placement, size, and style.'          ],
        2 => [ 'Custom Design',   'Our artist creates a unique design tailored exactly to you. We share the draft and refine it until it\'s perfect — your approval comes first.'    ],
        3 => [ 'Tattoo Session',  'Relax in our comfortable, private studio while your artist brings the design to life. Premium inks, music of your choice, and great vibes.'      ],
        4 => [ 'Healed & Perfect','We send you home with a premium aftercare kit and detailed instructions. Return for your complimentary touch-up once fully healed.'               ],
    ];

    foreach ( $step_defaults as $n => $def ) {
        gm_text(     $wp_customize, "step_{$n}_title", "Step {$n} — Title",       'gm_sec_how_steps', $def[0], $n * 10     );
        gm_textarea( $wp_customize, "step_{$n}_text",  "Step {$n} — Description", 'gm_sec_how_steps', $def[1], $n * 10 + 5 );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 6 — BOOK NOW (WhatsApp CTA)
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_book', [
        'title'    => '⑥ Book Now',
        'priority' => 36,
    ] );

    /* 6-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_book_header', [
        'title' => 'Book Now — Section Header',
        'panel' => 'gm_panel_book',
    ] );

    gm_text(     $wp_customize, 'book_badge',           'Badge Text',          'gm_sec_book_header', 'Book Now',       10 );
    gm_text(     $wp_customize, 'book_title',           'Title — Normal Part', 'gm_sec_book_header', 'Reserve Your',   20 );
    gm_text(     $wp_customize, 'book_title_highlight', 'Title — Gold Part',   'gm_sec_book_header', 'Gold Moment',    30 );
    gm_textarea( $wp_customize, 'book_subtitle',        'Subtitle Paragraph',  'gm_sec_book_header',
        'Ready to wear your story? Chat with us on WhatsApp and our team will help you plan your perfect tattoo.', 40 );

    /* 6-B: WhatsApp CTA Button ──────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_book_wa', [
        'title'       => 'Book Now — WhatsApp Button',
        'panel'       => 'gm_panel_book',
        'description' => 'Customize the large WhatsApp CTA button.',
    ] );

    gm_text( $wp_customize, 'book_wa_btn_text', 'Button Label',          'gm_sec_book_wa', 'Chat on WhatsApp',                          10 );
    gm_text( $wp_customize, 'book_wa_btn_sub',  'Sub-text below button', 'gm_sec_book_wa', 'Usually replies within 1 hour · Free consultation', 20 );
    gm_url(  $wp_customize, 'contact_wa_url',   'WhatsApp Link (wa.me)', 'gm_sec_book_wa', 'https://wa.me/6281234567890',                30,
        'Format: https://wa.me/628xxxxxxxxxx' );
    gm_text( $wp_customize, 'contact_phone',    'Phone Number (display)','gm_sec_book_wa', '+62 812 3456 7890',                         40 );


    /* ──────────────────────────────────────────────────────────
       PANEL 7 — FIND US
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_findus', [
        'title'    => '⑦ Find Us Section',
        'priority' => 37,
    ] );

    /* 7-A: Section Header ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_findus_header', [
        'title' => 'Find Us — Section Header',
        'panel' => 'gm_panel_findus',
    ] );

    gm_text(     $wp_customize, 'findus_badge',           'Badge Text',          'gm_sec_findus_header', 'Find Us',         10 );
    gm_text(     $wp_customize, 'findus_title',           'Title — Normal Part', 'gm_sec_findus_header', 'Visit Our',       20 );
    gm_text(     $wp_customize, 'findus_title_highlight', 'Title — Gold Part',   'gm_sec_findus_header', 'Studio',          30 );
    gm_textarea( $wp_customize, 'findus_subtitle',        'Subtitle Paragraph',  'gm_sec_findus_header',
        'We\'re located in the heart of Seminyak, Bali. Come visit us or reach out through any channel below.', 40 );

    /* 7-B: Contact Details ──────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_findus_contact', [
        'title' => 'Find Us — Contact Details',
        'panel' => 'gm_panel_findus',
    ] );

    gm_textarea( $wp_customize, 'contact_address',   'Studio Address',        'gm_sec_findus_contact', "Jl. Kayu Aya No. 88\nSeminyak, Kuta, Bali 80361", 10 );
    gm_text(     $wp_customize, 'contact_instagram', 'Instagram Handle',      'gm_sec_findus_contact', '@goldmomenttattoo.bali',                             20 );
    gm_url(      $wp_customize, 'contact_ig_url',    'Instagram Profile URL', 'gm_sec_findus_contact', 'https://www.instagram.com/goldmomenttattoo.bali',    30 );
    gm_text(     $wp_customize, 'contact_email',     'Email Address',         'gm_sec_findus_contact', 'hello@goldmomenttattoo.com',                         40 );

    /* 7-C: Business Hours ───────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_findus_hours', [
        'title' => 'Find Us — Business Hours',
        'panel' => 'gm_panel_findus',
    ] );

    gm_text( $wp_customize, 'hours_weekday',  'Monday – Friday Hours', 'gm_sec_findus_hours', '10:00 – 20:00',       10 );
    gm_text( $wp_customize, 'hours_saturday', 'Saturday Hours',        'gm_sec_findus_hours', '09:00 – 21:00',       20 );
    gm_text( $wp_customize, 'hours_sunday',   'Sunday Hours',          'gm_sec_findus_hours', 'By Appointment Only', 30 );

    /* 7-D: Google Map ───────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_findus_map', [
        'title'       => 'Find Us — Google Map Embed',
        'panel'       => 'gm_panel_findus',
        'description' => 'Go to Google Maps → your location → Share → Embed a map → copy the src="..." URL and paste it here.',
    ] );

    gm_url( $wp_customize, 'map_embed_url', 'Google Maps Embed URL', 'gm_sec_findus_map',
        'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5623!2d115.1625!3d-8.6895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDEnMjIuMiJTIDExNcKwMDknNDUuMCJF!5e0!3m2!1sen!2sid!4v1234567890',
        10, 'Paste the full embed src URL from Google Maps'
    );


    /* ──────────────────────────────────────────────────────────
       PANEL 8 — GALLERY PAGE (page-gallery.php template)
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_gallery_page', [
        'title'       => '⑧ Gallery Page',
        'description' => 'Settings for the dedicated Gallery page (Template Name: Gallery). Assign the "Gallery" template to a page via Page Attributes.',
        'priority'    => 38,
    ] );

    /* 8-A: Page Header ──────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_gp_header', [
        'title' => 'Gallery Page — Header',
        'panel' => 'gm_panel_gallery_page',
    ] );

    gm_text(     $wp_customize, 'gallery_page_badge',     'Badge Text',          'gm_sec_gp_header', 'Our Portfolio',   10 );
    gm_text(     $wp_customize, 'gallery_page_title',     'Title — Normal Part', 'gm_sec_gp_header', 'Ink in',          20 );
    gm_text(     $wp_customize, 'gallery_page_highlight', 'Title — Gold Part',   'gm_sec_gp_header', 'Every Detail',    30 );
    gm_textarea( $wp_customize, 'gallery_page_subtitle',  'Subtitle Paragraph',  'gm_sec_gp_header',
        'Browse our complete collection of custom tattoo artwork — each piece crafted exclusively for its wearer.', 40 );
    gm_url(  $wp_customize, 'gallery_page_ig_url', 'Instagram Profile URL', 'gm_sec_gp_header',
        'https://www.instagram.com/goldmomenttattoo.bali', 50, 'Link for the Instagram button below the gallery' );
    gm_text( $wp_customize, 'gallery_page_ig_btn', '"Instagram" Button Label', 'gm_sec_gp_header', 'Follow on Instagram', 60 );

    /* 8-B: Gallery Items (1–24) ─────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_gp_items', [
        'title'       => 'Gallery Page — Images (1–24)',
        'panel'       => 'gm_panel_gallery_page',
        'description' => 'Upload up to 24 images. Each item needs at least an image to appear. The Style field is used for the filter tabs (e.g. Japanese, Blackwork, Realism, Fine Line, Geometric, Watercolor, Neo-Traditional, Tribal).',
    ] );

    $gp_item_defaults = [
        1  => [ 'https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=800&q=85',   'Japanese Sleeve',      'Japanese'       ],
        2  => [ 'https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=600&q=80', 'Geometric Mandala',    'Geometric'      ],
        3  => [ 'https://images.unsplash.com/photo-1559059699-d4a0b5c1b935?w=600&q=80',   'Portrait Realism',     'Realism'        ],
        4  => [ 'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=600&q=80', 'Fine Line Floral',     'Fine Line'      ],
        5  => [ 'https://images.unsplash.com/photo-1590246814883-57c511e76523?w=600&q=80', 'Watercolor Splash',    'Watercolor'     ],
        6  => [ 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?w=800&q=85', 'Neo-Traditional Tiger','Neo-Traditional'],
        7  => [ 'https://images.unsplash.com/photo-1552074284-5e84b8e7b7e8?w=600&q=80',   'Dotwork Cosmic',       'Geometric'      ],
        8  => [ 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=600&q=80', 'Bali Lotus',           'Japanese'       ],
        9  => [ '', '', '' ],
        10 => [ '', '', '' ],
        11 => [ '', '', '' ],
        12 => [ '', '', '' ],
        13 => [ '', '', '' ],
        14 => [ '', '', '' ],
        15 => [ '', '', '' ],
        16 => [ '', '', '' ],
        17 => [ '', '', '' ],
        18 => [ '', '', '' ],
        19 => [ '', '', '' ],
        20 => [ '', '', '' ],
        21 => [ '', '', '' ],
        22 => [ '', '', '' ],
        23 => [ '', '', '' ],
        24 => [ '', '', '' ],
    ];

    foreach ( $gp_item_defaults as $n => $def ) {
        $p = $n * 15;
        gm_image( $wp_customize, "gallery_page_item_{$n}_img",   "Item {$n} — Image",      'gm_sec_gp_items', $def[0], $p,     "Gallery page item {$n} photo" );
        gm_text(  $wp_customize, "gallery_page_item_{$n}_label", "Item {$n} — Label",      'gm_sec_gp_items', $def[1], $p + 5, 'Shown on hover (e.g. Japanese Sleeve)' );
        gm_text(  $wp_customize, "gallery_page_item_{$n}_style", "Item {$n} — Style (filter tab)", 'gm_sec_gp_items', $def[2], $p + 10,
            'Exact style name used for filter tabs (e.g. Japanese, Blackwork, Realism, Fine Line, Geometric, Watercolor, Neo-Traditional, Tribal)' );
    }


    /* ──────────────────────────────────────────────────────────
       PANEL 9 — CONTACT PAGE (page-contact.php template)
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_contact_page', [
        'title'       => '⑨ Contact Page',
        'description' => 'Settings for the Contact Us page (Template Name: Contact Us). Assign the "Contact Us" template to a page via Page Attributes. Contact details and hours are shared with the Find Us section on the homepage.',
        'priority'    => 39,
    ] );

    /* 9-A: Page Header ──────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_ct_header', [
        'title' => 'Contact Page — Header',
        'panel' => 'gm_panel_contact_page',
    ] );

    gm_text(     $wp_customize, 'contact_page_badge',     'Badge Text',          'gm_sec_ct_header', 'Get In Touch',              10 );
    gm_text(     $wp_customize, 'contact_page_title',     'Title — Normal Part', 'gm_sec_ct_header', 'Let\'s Create',             20 );
    gm_text(     $wp_customize, 'contact_page_highlight', 'Title — Gold Part',   'gm_sec_ct_header', 'Something Together',        30 );
    gm_textarea( $wp_customize, 'contact_page_subtitle',  'Subtitle Paragraph',  'gm_sec_ct_header',
        'Have a tattoo idea in mind? Reach out and our team will guide you through every step — from first sketch to final ink.', 40 );

    /* 9-B: WhatsApp Button ──────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_ct_wa', [
        'title' => 'Contact Page — WhatsApp Button',
        'panel' => 'gm_panel_contact_page',
    ] );

    gm_text( $wp_customize, 'contact_page_wa_btn', 'WhatsApp Button Label', 'gm_sec_ct_wa', 'Chat on WhatsApp', 10 );

    /* 9-C: Note about shared fields ─────────────────────────── */
    $wp_customize->add_section( 'gm_sec_ct_note', [
        'title'       => 'Contact Page — Address & Hours',
        'panel'       => 'gm_panel_contact_page',
        'description' => 'The address, phone, email, Instagram, WhatsApp URL, business hours, and Google Map shown on this page are shared with the homepage "Find Us" section. Edit them under: ⑦ Find Us Section → Contact Details / Business Hours / Google Map Embed, and ⑥ Book Now → WhatsApp Button → WhatsApp Link & Phone.',
    ] );


    /* ──────────────────────────────────────────────────────────
       PANEL 10 — FOOTER
    ────────────────────────────────────────────────────────── */
    $wp_customize->add_panel( 'gm_panel_footer', [
        'title'    => '⑩ Footer Section',
        'priority' => 40,
    ] );

    /* 7-A: Brand Block ──────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_footer_brand', [
        'title' => 'Footer — Brand Block',
        'panel' => 'gm_panel_footer',
    ] );

    gm_text(     $wp_customize, 'footer_brand_name',  'Brand Name (line 1)', 'gm_sec_footer_brand', 'Gold Moment',                                                                                          10 );
    gm_text(     $wp_customize, 'footer_brand_sub',   'Brand Name (line 2)', 'gm_sec_footer_brand', 'Tattoo Bali',                                                                                           20 );
    gm_textarea( $wp_customize, 'footer_description', 'Brand Description',   'gm_sec_footer_brand', 'Premium tattoo studio nestled in the heart of Seminyak, Bali. Where artistry meets permanence, and every moment becomes gold.', 30 );
    gm_text(     $wp_customize, 'footer_rating_text', 'Rating Badge Text',   'gm_sec_footer_brand', '4.9 / 5.0 — 200+ Reviews',                                                                             40 );

    /* 7-B: Social Links ─────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_footer_social', [
        'title' => 'Footer — Social Media Links',
        'panel' => 'gm_panel_footer',
    ] );

    gm_url( $wp_customize, 'social_instagram', 'Instagram URL', 'gm_sec_footer_social', 'https://www.instagram.com/goldmomenttattoo.bali', 10 );
    gm_url( $wp_customize, 'social_whatsapp',  'WhatsApp URL',  'gm_sec_footer_social', 'https://wa.me/6281234567890',                     20 );
    gm_url( $wp_customize, 'social_tiktok',    'TikTok URL',    'gm_sec_footer_social', 'https://www.tiktok.com/@goldmomenttattoo',         30 );
    gm_url( $wp_customize, 'social_facebook',  'Facebook URL',  'gm_sec_footer_social', 'https://www.facebook.com/goldmomenttattoo',        40 );
    gm_url( $wp_customize, 'social_pinterest', 'Pinterest URL', 'gm_sec_footer_social', 'https://www.pinterest.com/goldmomenttattoo',       50 );

    /* 7-C: Copyright ────────────────────────────────────────── */
    $wp_customize->add_section( 'gm_sec_footer_copy', [
        'title' => 'Footer — Copyright',
        'panel' => 'gm_panel_footer',
    ] );

    gm_text( $wp_customize, 'footer_copyright', 'Copyright Text (© year auto-added)', 'gm_sec_footer_copy',
        'Gold Moment Tattoo Bali. All rights reserved. Crafted with ♥ in Bali.', 10 );
}
add_action( 'customize_register', 'goldmoment_customizer_register' );


/* ================================================================
   LIVE CSS INJECTION — apply color customizations
================================================================ */
function goldmoment_customizer_css() {
    $gold        = get_theme_mod( 'gm_color_gold',       '#C9A84C' );
    $gold_light  = get_theme_mod( 'gm_color_gold_light', '#e8c96a' );
    $gold_dark   = get_theme_mod( 'gm_color_gold_dark',  '#8B6914' );
    $bg          = get_theme_mod( 'gm_color_black',      '#0d0d0d' );
    $card_bg     = get_theme_mod( 'gm_color_dark',       '#1a1a1a' );

    $css = "
    :root {
        --gold:        {$gold};
        --gold-light:  {$gold_light};
        --gold-dark:   {$gold_dark};
        --black:       {$bg};
        --dark:        {$card_bg};
    }
    ";

    wp_add_inline_style( 'goldmoment-style', $css );
}
add_action( 'wp_enqueue_scripts', 'goldmoment_customizer_css', 99 );


/* ================================================================
   SANITIZATION CALLBACK for boolean / select fields
================================================================ */
function goldmoment_sanitize_select( $input, $setting ) {
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return array_key_exists( $input, $choices ) ? $input : $setting->default;
}
