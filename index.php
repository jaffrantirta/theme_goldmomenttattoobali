<?php
/**
 * Gold Moment Tattoo Bali — Main Landing Page Template
 * All content is pulled from WordPress Customizer via get_theme_mod().
 */

get_header();

/* ================================================================
   PULL ALL CUSTOMIZER VALUES
   (defaults mirror what was hardcoded before)
================================================================ */

// ── Hero ──────────────────────────────────────────────────────
$hero_eyebrow    = get_theme_mod( 'hero_eyebrow_text',     'Est. 2018 — Bali, Indonesia' );
$hero_title1     = get_theme_mod( 'hero_title_line1',      'Wear Your' );
$hero_highlight  = get_theme_mod( 'hero_title_highlight',  'Story' );
$hero_title3     = get_theme_mod( 'hero_title_line3',      'in Gold Ink' );
$hero_location   = get_theme_mod( 'hero_location',         'Seminyak, Bali — Indonesia' );
$hero_desc       = get_theme_mod( 'hero_description',      'Every mark tells a story. At Gold Moment Tattoo Bali, our master artists transform your vision into breathtaking, permanent art — crafted with precision, passion, and the finest inks.' );
$hero_bg         = get_theme_mod( 'hero_bg_image',         'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=1920&q=85' );
$hero_side_img   = get_theme_mod( 'hero_side_image',       'https://images.unsplash.com/photo-1562962230-2895f8a82b44?w=800&q=85' );
$hero_badge_t    = get_theme_mod( 'hero_side_badge_title', 'Master Artist' );
$hero_badge_s    = get_theme_mod( 'hero_side_badge_sub',   '10+ Years Experience' );
$hero_cta1_text  = get_theme_mod( 'hero_cta1_text',        'Book Appointment' );
$hero_cta1_url   = get_theme_mod( 'hero_cta1_url',         '#book-now' );
$hero_cta2_text  = get_theme_mod( 'hero_cta2_text',        'View Gallery' );
$hero_cta2_url   = get_theme_mod( 'hero_cta2_url',         '#gallery' );

$hero_stats = [
    [ 'number' => get_theme_mod( 'hero_stat_1_number', '500' ), 'label' => get_theme_mod( 'hero_stat_1_label', 'Tattoos Done'   ) ],
    [ 'number' => get_theme_mod( 'hero_stat_2_number', '7'   ), 'label' => get_theme_mod( 'hero_stat_2_label', 'Years of Art'   ) ],
    [ 'number' => get_theme_mod( 'hero_stat_3_number', '12'  ), 'label' => get_theme_mod( 'hero_stat_3_label', 'Art Styles'     ) ],
    [ 'number' => get_theme_mod( 'hero_stat_4_number', '98'  ), 'label' => get_theme_mod( 'hero_stat_4_label', '% Satisfaction' ) ],
];

// ── Carousel ──────────────────────────────────────────────────
$carousel_badge     = get_theme_mod( 'carousel_badge',           'Our Portfolio' );
$carousel_title     = get_theme_mod( 'carousel_title',           'Ink That' );
$carousel_highlight = get_theme_mod( 'carousel_title_highlight', 'Speaks' );
$carousel_subtitle  = get_theme_mod( 'carousel_subtitle',        'Browse through our diverse portfolio of custom tattoo designs. Each piece is uniquely crafted to reflect your personal story and style.' );

$carousel_defaults = [
    // ── Pre-filled items 1–8 ──────────────────────────────────
    1  => [ 'https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=500&q=80',    'Japanese',        'Dragon Koi',      'by Ari Santoso', 'Traditional Japanese',   'A powerful koi dragon sleeve full of symbolism'    ],
    2  => [ 'https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=500&q=80', 'Blackwork',       'Sacred Geometry', 'by Maya Dewi',   'Blackwork Geometric',    'Intricate mandala patterns with bold black lines'  ],
    3  => [ 'https://images.unsplash.com/photo-1559059699-d4a0b5c1b935?w=500&q=80',    'Realism',         'Portrait Art',    'by Dewa Putra',  'Photo Realism',          'Hyper-realistic portraits captured in ink forever' ],
    4  => [ 'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=500&q=80', 'Fine Line',       'Floral Minimal',  'by Sari Putri',  'Fine Line Botanical',    'Delicate florals drawn with hair-thin precision'   ],
    5  => [ 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?w=500&q=80', 'Neo-Traditional', 'Tiger Spirit',    'by Bima Arya',   'Neo-Traditional',        'Bold neo-trad tiger with vibrant gold highlights'  ],
    6  => [ 'https://images.unsplash.com/photo-1590246814883-57c511e76523?w=500&q=80', 'Watercolor',      'Ocean Dream',     'by Maya Dewi',   'Watercolor Abstract',    'Flowing colors that bleed like watercolor paint'   ],
    7  => [ 'https://images.unsplash.com/photo-1552074284-5e84b8e7b7e8?w=500&q=80',    'Geometric',       'Cosmic Web',      'by Ari Santoso', 'Dotwork Geometric',      'Sacred geometry meets celestial dotwork artistry'  ],
    8  => [ 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=500&q=80', 'Japanese',        'Bali Lotus',      'by Dewa Putra',  'Balinese Japanese',      'Fusion of Balinese art and Japanese tattooing'     ],
    // ── Extra slots 9–15 — set image via Customizer to activate ─
    9  => [ '', 'Japanese',        'Portfolio #9',  'by Artist',  'Japanese',        '' ],
    10 => [ '', 'Blackwork',       'Portfolio #10', 'by Artist',  'Blackwork',       '' ],
    11 => [ '', 'Realism',         'Portfolio #11', 'by Artist',  'Realism',         '' ],
    12 => [ '', 'Fine Line',       'Portfolio #12', 'by Artist',  'Fine Line',       '' ],
    13 => [ '', 'Neo-Traditional', 'Portfolio #13', 'by Artist',  'Neo-Traditional', '' ],
    14 => [ '', 'Watercolor',      'Portfolio #14', 'by Artist',  'Watercolor',      '' ],
    15 => [ '', 'Geometric',       'Portfolio #15', 'by Artist',  'Geometric',       '' ],
];

$tattoos = [];
foreach ( $carousel_defaults as $n => $def ) {
    $img = get_theme_mod( "tattoo_{$n}_img", $def[0] );
    if ( empty( trim( $img ) ) ) continue; // skip if no image set
    $tattoos[] = [
        'img'    => $img,
        'tag'    => get_theme_mod( "tattoo_{$n}_tag",    $def[1] ),
        'name'   => get_theme_mod( "tattoo_{$n}_name",   $def[2] ),
        'artist' => get_theme_mod( "tattoo_{$n}_artist", $def[3] ),
        'style'  => get_theme_mod( "tattoo_{$n}_style",  $def[4] ),
        'desc'   => get_theme_mod( "tattoo_{$n}_desc",   $def[5] ),
    ];
}

// ── Why Us ────────────────────────────────────────────────────
$why_badge     = get_theme_mod( 'why_badge',           'Why Gold Moment' );
$why_title     = get_theme_mod( 'why_title',           'The Art of' );
$why_highlight = get_theme_mod( 'why_title_highlight', 'Excellence' );
$why_subtitle  = get_theme_mod( 'why_subtitle',        'We don\'t just tattoo — we create wearable masterpieces. Here\'s what sets us apart from the rest.' );
$why_cta_text  = get_theme_mod( 'why_cta_text',        'Ready to wear your story? Let\'s create something unforgettable.' );
$why_cta_btn   = get_theme_mod( 'why_cta_btn',         'Start Your Journey' );
$why_cta_url   = get_theme_mod( 'why_cta_url',         '#book-now' );

$why_defaults = [
    1 => [ 'fa-solid fa-palette',       'Master-Level Artists',     'Our team of internationally trained tattoo artists brings over a decade of combined experience across all major tattoo styles. Every piece is a signature work of art.'        ],
    2 => [ 'fa-solid fa-shield-halved',  'Sterilization Guaranteed', 'Your safety is our top priority. We use hospital-grade sterilization, single-use needles, and premium hypoallergenic inks — every single session, no exceptions.'            ],
    3 => [ 'fa-solid fa-pen-nib',        '100% Custom Designs',      'No flash sheets, no copy-paste. Each design is crafted exclusively for you — we sit down, listen to your vision, and sketch a unique piece that is entirely yours.'          ],
    4 => [ 'fa-solid fa-award',          'Award-Winning Studio',     'Recognized at Bali Tattoo Expos and international competitions, our studio has earned a reputation for pushing boundaries and delivering world-class results.'                 ],
    5 => [ 'fa-solid fa-heart-pulse',    'Aftercare & Follow-Up',    'We provide premium aftercare kits, detailed healing guides, and complimentary touch-up sessions. Our relationship doesn\'t end when you walk out the door.'                   ],
    6 => [ 'fa-solid fa-leaf',           'Eco-Friendly Practice',    'We source vegan-friendly, cruelty-free inks and maintain sustainable studio practices — because great art should be kind to the earth too.'                                   ],
];

$reasons = [];
foreach ( $why_defaults as $n => $def ) {
    $reasons[] = [
        'num'   => str_pad( $n, 2, '0', STR_PAD_LEFT ),
        'icon'  => get_theme_mod( "why_card_{$n}_icon",  $def[0] ),
        'title' => get_theme_mod( "why_card_{$n}_title", $def[1] ),
        'text'  => get_theme_mod( "why_card_{$n}_text",  $def[2] ),
    ];
}

// ── Gallery ───────────────────────────────────────────────────
$gallery_badge     = get_theme_mod( 'gallery_badge',           'Gallery' );
$gallery_title     = get_theme_mod( 'gallery_title',           'Ink in' );
$gallery_highlight = get_theme_mod( 'gallery_title_highlight', 'Motion' );
$gallery_subtitle  = get_theme_mod( 'gallery_subtitle',        'A curated selection of our finest works — from intricate Japanese sleeves to whisper-thin fine line florals.' );
$gallery_ig_url    = get_theme_mod( 'gallery_instagram_url',   'https://www.instagram.com/goldmomenttattoo.bali' );
$gallery_ig_btn    = get_theme_mod( 'gallery_instagram_btn',   'More on Instagram' );

$gallery_defaults = [
    1 => [ 'https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=800&q=85',    'Japanese Sleeve'       ],
    2 => [ 'https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=600&q=80', 'Geometric Mandala'     ],
    3 => [ 'https://images.unsplash.com/photo-1559059699-d4a0b5c1b935?w=600&q=80',    'Portrait Realism'      ],
    4 => [ 'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?w=600&q=80', 'Fine Line Floral'      ],
    5 => [ 'https://images.unsplash.com/photo-1590246814883-57c511e76523?w=600&q=80', 'Watercolor Splash'     ],
    6 => [ 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?w=800&q=85', 'Neo-Traditional Tiger' ],
    7 => [ 'https://images.unsplash.com/photo-1552074284-5e84b8e7b7e8?w=600&q=80',    'Dotwork Cosmic'        ],
    8 => [ 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=600&q=80', 'Bali Lotus'            ],
];

$gallery_items = [];
foreach ( $gallery_defaults as $n => $def ) {
    $gallery_items[] = [
        'img'   => get_theme_mod( "gallery_item_{$n}_img",   $def[0] ),
        'label' => get_theme_mod( "gallery_item_{$n}_label", $def[1] ),
    ];
}

// ── How It Works ──────────────────────────────────────────────
$how_badge     = get_theme_mod( 'how_badge',           'The Process' );
$how_title     = get_theme_mod( 'how_title',           'Your Tattoo' );
$how_highlight = get_theme_mod( 'how_title_highlight', 'Journey' );
$how_subtitle  = get_theme_mod( 'how_subtitle',        'From first consultation to forever ink — here\'s what your Gold Moment experience looks like, step by step.' );

$step_defaults = [
    1 => [ 'Book & Consult',   'Fill out our booking form or DM us on Instagram. We\'ll schedule a free consultation to discuss your vision, placement, size, and style.'        ],
    2 => [ 'Custom Design',    'Our artist creates a unique design tailored exactly to you. We share the draft and refine it until it\'s perfect — your approval comes first.'   ],
    3 => [ 'Tattoo Session',   'Relax in our comfortable, private studio while your artist brings the design to life. Premium inks, music of your choice, and great vibes.'     ],
    4 => [ 'Healed & Perfect', 'We send you home with a premium aftercare kit and detailed instructions. Return for your complimentary touch-up once fully healed.'              ],
];

$steps = [];
foreach ( $step_defaults as $n => $def ) {
    $steps[] = [
        'num'   => str_pad( $n, 2, '0', STR_PAD_LEFT ),
        'icon'  => [ 'fa-solid fa-comments', 'fa-solid fa-pen-ruler', 'fa-solid fa-droplet', 'fa-solid fa-star' ][ $n - 1 ],
        'title' => get_theme_mod( "step_{$n}_title", $def[0] ),
        'text'  => get_theme_mod( "step_{$n}_text",  $def[1] ),
    ];
}

// ── Book Now ───────────────────────────────────────────────────
$book_badge     = get_theme_mod( 'book_badge',           'Book Now' );
$book_title     = get_theme_mod( 'book_title',           'Reserve Your' );
$book_highlight = get_theme_mod( 'book_title_highlight', 'Gold Moment' );
$book_subtitle  = get_theme_mod( 'book_subtitle',        'Ready to wear your story? Chat with us on WhatsApp and our team will help you plan your perfect tattoo.' );
$book_wa_text   = get_theme_mod( 'book_wa_btn_text',     'Chat on WhatsApp' );
$book_wa_sub    = get_theme_mod( 'book_wa_btn_sub',      'Usually replies within 1 hour · Free consultation' );

// ── Find Us ────────────────────────────────────────────────────
$findus_badge     = get_theme_mod( 'findus_badge',           'Find Us' );
$findus_title     = get_theme_mod( 'findus_title',           'Visit Our' );
$findus_highlight = get_theme_mod( 'findus_title_highlight', 'Studio' );
$findus_subtitle  = get_theme_mod( 'findus_subtitle',        'We\'re located in the heart of Seminyak, Bali. Come visit us or reach out through any channel below.' );

$contact_address   = get_theme_mod( 'contact_address',   "Jl. Kayu Aya No. 88\nSeminyak, Kuta, Bali 80361" );
$contact_phone     = get_theme_mod( 'contact_phone',     '+62 812 3456 7890' );
$contact_wa_url    = get_theme_mod( 'contact_wa_url',    'https://wa.me/6281234567890' );
$contact_instagram = get_theme_mod( 'contact_instagram', '@goldmomenttattoo.bali' );
$contact_ig_url    = get_theme_mod( 'contact_ig_url',    'https://www.instagram.com/goldmomenttattoo.bali' );
$contact_email     = get_theme_mod( 'contact_email',     'hello@goldmomenttattoo.com' );

$hours_weekday = get_theme_mod( 'hours_weekday',  '10:00 – 20:00' );
$hours_sat     = get_theme_mod( 'hours_saturday', '09:00 – 21:00' );
$hours_sun     = get_theme_mod( 'hours_sunday',   'By Appointment Only' );

$map_url = get_theme_mod( 'map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5623!2d115.1625!3d-8.6895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDEnMjIuMiJTIDExNcKwMDknNDUuMCJF!5e0!3m2!1sen!2sid!4v1234567890' );

// Social
$social_ig  = get_theme_mod( 'social_instagram', 'https://www.instagram.com/goldmomenttattoo.bali' );
$social_wa  = get_theme_mod( 'social_whatsapp',  'https://wa.me/6281234567890' );
$social_tt  = get_theme_mod( 'social_tiktok',    'https://www.tiktok.com/@goldmomenttattoo' );
$social_fb  = get_theme_mod( 'social_facebook',  'https://www.facebook.com/goldmomenttattoo' );
?>

<!-- ============================================================
     SECTION 1 — HERO
============================================================ -->
<section id="hero" aria-label="Hero Section">

    <div class="hero-bg" id="heroBg"
         style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
    </div>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="row align-items-center min-vh-100 py-5">

            <!-- Left: Content -->
            <div class="col-lg-7 col-xl-6 hero-content pt-5 pt-lg-0">

                <div class="hero-eyebrow reveal">
                    <?php echo esc_html( $hero_eyebrow ); ?>
                </div>

                <h1 class="hero-title reveal delay-1">
                    <?php echo esc_html( $hero_title1 ); ?>
                    <span class="highlight"><?php echo esc_html( $hero_highlight ); ?></span>
                    <?php echo esc_html( $hero_title3 ); ?>
                </h1>

                <p class="hero-location reveal delay-2">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    <?php echo esc_html( $hero_location ); ?>
                </p>

                <p class="hero-desc reveal delay-2">
                    <?php echo esc_html( $hero_desc ); ?>
                </p>

                <div class="hero-cta-group reveal delay-3">
                    <a href="<?php echo esc_url( $hero_cta1_url ); ?>" class="btn-gold">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <?php echo esc_html( $hero_cta1_text ); ?>
                    </a>
                    <a href="<?php echo esc_url( $hero_cta2_url ); ?>" class="btn-gold-outline">
                        <i class="fa-regular fa-images"></i>
                        <?php echo esc_html( $hero_cta2_text ); ?>
                    </a>
                </div>

                <!-- Stats -->
                <div class="hero-stats reveal delay-4">
                    <?php foreach ( $hero_stats as $stat ) : ?>
                    <div class="hero-stat-item">
                        <div class="hero-stat-number" data-count="<?php echo esc_attr( $stat['number'] ); ?>">0</div>
                        <div class="hero-stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Right: Image Card (desktop only) -->
            <div class="col-lg-5 col-xl-5 offset-xl-1 hero-image-card reveal-right delay-3">
                <div class="hero-img-frame">
                    <img src="<?php echo esc_url( $hero_side_img ); ?>"
                         alt="Tattoo artist working on a custom design"
                         loading="eager">
                    <div class="hero-img-badge">
                        <span class="badge-title"><?php echo esc_html( $hero_badge_t ); ?></span>
                        <span class="badge-sub"><?php echo esc_html( $hero_badge_s ); ?></span>
                    </div>
                </div>
                <div class="hero-frame-deco"></div>
            </div>

        </div>
    </div>

    <div class="hero-scroll-indicator">
        <div class="scroll-mouse"></div>
        <span>Scroll Down</span>
    </div>

</section>


<!-- ============================================================
     SECTION 2 — TATTOO CAROUSEL
============================================================ -->
<section id="tattoo-carousel" class="section-padding" aria-label="Tattoo Portfolio Carousel">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge"><?php echo esc_html( $carousel_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $carousel_title ); ?> <span><?php echo esc_html( $carousel_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle"><?php echo esc_html( $carousel_subtitle ); ?></p>
        </div>

        <!-- Style filter tabs — auto-generated from the Style Tag of each active card -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4 reveal delay-1">
            <?php
            // Build unique tabs from the actual tags on active cards (always in sync)
            $unique_tags = array_unique( array_map( 'trim', array_column( $tattoos, 'tag' ) ) );
            sort( $unique_tags );
            $tab_list = array_merge( [ 'All' ], $unique_tags );

            foreach ( $tab_list as $i => $style ) :
            ?>
            <button class="gallery-filter-btn <?php echo $i === 0 ? 'active' : ''; ?>"
                    data-filter="<?php echo esc_attr( strtolower( $style ) ); ?>">
                <?php echo esc_html( $style ); ?>
            </button>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Swiper -->
    <div class="container-fluid px-4 reveal delay-2">
        <div class="swiper tattoo-swiper" id="tattooSwiper">
            <div class="swiper-wrapper">

                <?php foreach ( $tattoos as $tattoo ) : ?>
                <div class="swiper-slide" style="width: 280px;"
                     data-style="<?php echo esc_attr( strtolower( $tattoo['tag'] ) ); ?>">
                    <div class="tattoo-card">
                        <div class="tattoo-card-img">
                            <img src="<?php echo esc_url( $tattoo['img'] ); ?>"
                                 alt="<?php echo esc_attr( $tattoo['name'] ); ?> tattoo"
                                 loading="lazy">
                            <div class="tattoo-card-overlay">
                                <div class="tattoo-card-style"><?php echo esc_html( $tattoo['style'] ); ?></div>
                                <p class="tattoo-card-desc"><?php echo esc_html( $tattoo['desc'] ); ?></p>
                            </div>
                        </div>
                        <div class="tattoo-card-body">
                            <span class="tattoo-card-tag"><?php echo esc_html( $tattoo['tag'] ); ?></span>
                            <div class="tattoo-card-name"><?php echo esc_html( $tattoo['name'] ); ?></div>
                            <div class="tattoo-card-artist"><?php echo esc_html( $tattoo['artist'] ); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
            <div class="swiper-pagination mt-4"></div>
        </div>

        <div class="swiper-nav-container mt-2">
            <button class="swiper-btn-prev" id="tattooPrev" aria-label="Previous slide">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="swiper-btn-next" id="tattooNext" aria-label="Next slide">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>

</section>


<!-- ============================================================
     SECTION 3 — WHY US
============================================================ -->
<section id="why-us" class="section-padding" aria-label="Why Choose Us">
    <div class="bg-deco"></div>
    <div class="container position-relative">

        <div class="text-center mb-5 reveal">
            <span class="section-badge"><?php echo esc_html( $why_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $why_title ); ?> <span><?php echo esc_html( $why_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle"><?php echo esc_html( $why_subtitle ); ?></p>
        </div>

        <div class="row g-4">
            <?php foreach ( $reasons as $i => $reason ) :
                $delay = 'delay-' . ( ( $i % 3 ) + 1 );
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="why-card reveal <?php echo esc_attr( $delay ); ?>">
                    <div class="why-card-number"><?php echo esc_html( $reason['num'] ); ?></div>
                    <div class="why-card-icon">
                        <i class="<?php echo esc_attr( $reason['icon'] ); ?>"></i>
                    </div>
                    <h3 class="why-card-title"><?php echo esc_html( $reason['title'] ); ?></h3>
                    <p class="why-card-text"><?php echo esc_html( $reason['text'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Bottom CTA Banner -->
        <div class="text-center mt-5 reveal delay-2">
            <div class="d-inline-block p-4 px-5 rounded-3"
                 style="background: var(--dark); border: 1px solid rgba(201,168,76,0.15);">
                <p class="mb-3" style="font-size: 1.1rem; color: var(--white);">
                    <?php echo esc_html( $why_cta_text ); ?>
                </p>
                <a href="<?php echo esc_url( $why_cta_url ); ?>" class="btn-gold">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <?php echo esc_html( $why_cta_btn ); ?>
                </a>
            </div>
        </div>

    </div>
</section>


<!-- ============================================================
     SECTION 4 — GALLERY
============================================================ -->
<section id="gallery" class="section-padding" aria-label="Tattoo Gallery">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge"><?php echo esc_html( $gallery_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $gallery_title ); ?> <span><?php echo esc_html( $gallery_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle"><?php echo esc_html( $gallery_subtitle ); ?></p>
        </div>

        <div class="gallery-grid reveal delay-1">
            <?php foreach ( $gallery_items as $item ) : ?>
            <div class="gallery-item" data-img="<?php echo esc_url( $item['img'] ); ?>">
                <img src="<?php echo esc_url( $item['img'] ); ?>"
                     alt="<?php echo esc_attr( $item['label'] ); ?> tattoo by Gold Moment Tattoo Bali"
                     loading="lazy">
                <div class="gallery-item-overlay">
                    <button class="gallery-zoom-btn" aria-label="View <?php echo esc_attr( $item['label'] ); ?>">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </button>
                </div>
                <span class="gallery-item-label"><?php echo esc_html( $item['label'] ); ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5 reveal delay-2">
            <a href="<?php echo esc_url( $gallery_ig_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-gold-outline">
                <i class="fa-brands fa-instagram"></i>
                <?php echo esc_html( $gallery_ig_btn ); ?>
            </a>
        </div>

    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
    <button class="lightbox-close" id="lightboxClose" aria-label="Close lightbox">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <img src="" alt="Tattoo detail view" class="lightbox-img" id="lightboxImg">
</div>


<!-- ============================================================
     SECTION 5 — HOW IT WORKS
============================================================ -->
<section id="how-it-works" class="section-padding" aria-label="How It Works">
    <div class="how-bg-deco">GOLD</div>
    <div class="container position-relative">

        <div class="text-center mb-5 reveal">
            <span class="section-badge"><?php echo esc_html( $how_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $how_title ); ?> <span><?php echo esc_html( $how_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle"><?php echo esc_html( $how_subtitle ); ?></p>
        </div>

        <div class="steps-grid">
            <?php foreach ( $steps as $i => $step ) :
                $delay = 'delay-' . ( $i + 1 );
            ?>
            <div class="reveal <?php echo esc_attr( $delay ); ?>">
                <div class="step-card">
                    <div class="step-number-wrap">
                        <div class="step-circle"><?php echo esc_html( $step['num'] ); ?></div>
                        <div class="step-icon-bg"></div>
                    </div>
                    <h3 class="step-title"><?php echo esc_html( $step['title'] ); ?></h3>
                    <p class="step-text"><?php echo esc_html( $step['text'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Trust Bar -->
        <div class="row mt-5 g-3 justify-content-center reveal delay-3">
            <?php
            $trust = [
                [ 'fa-solid fa-certificate', 'Licensed Studio'   ],
                [ 'fa-solid fa-syringe',     'Sterile Equipment' ],
                [ 'fa-solid fa-heart',        'Vegan Inks'        ],
                [ 'fa-brands fa-instagram',   '10K+ Followers'    ],
                [ 'fa-solid fa-star',          '5-Star Reviews'   ],
            ];
            foreach ( $trust as $t ) :
            ?>
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2 px-4 py-2 rounded-pill"
                     style="background: var(--dark); border: 1px solid rgba(201,168,76,0.12);">
                    <i class="<?php echo esc_attr( $t[0] ); ?> text-gold" style="font-size:13px;"></i>
                    <span style="font-size:12px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:#aaa;">
                        <?php echo esc_html( $t[1] ); ?>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ============================================================
     SECTION 6 — BOOK NOW (WhatsApp CTA)
============================================================ -->
<section id="book-now" class="section-padding book-now-section" aria-label="Book Appointment">
    <div class="book-bg-deco"></div>
    <div class="container position-relative text-center">

        <div class="reveal">
            <span class="section-badge"><?php echo esc_html( $book_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $book_title ); ?> <span><?php echo esc_html( $book_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle mb-5"><?php echo esc_html( $book_subtitle ); ?></p>
        </div>

        <!-- WhatsApp CTA -->
        <div class="book-wa-wrap reveal delay-1">
            <a href="<?php echo esc_url( $contact_wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="book-wa-btn">
                <span class="book-wa-icon-wrap">
                    <i class="fa-brands fa-whatsapp"></i>
                </span>
                <span class="book-wa-label"><?php echo esc_html( $book_wa_text ); ?></span>
            </a>
            <p class="book-wa-sub"><?php echo esc_html( $book_wa_sub ); ?></p>
        </div>

        <!-- Trust Badges -->
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-5 reveal delay-2">
            <?php
            $badges = [
                [ 'fa-solid fa-shield-halved', 'Safe & Sterile'      ],
                [ 'fa-solid fa-pen-nib',        'Custom Designs'      ],
                [ 'fa-solid fa-star',            'Award-Winning'       ],
                [ 'fa-solid fa-heart',           'Free Consultation'   ],
            ];
            foreach ( $badges as $b ) : ?>
            <div class="book-trust-badge">
                <i class="<?php echo esc_attr( $b[0] ); ?>"></i>
                <?php echo esc_html( $b[1] ); ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ============================================================
     SECTION 7 — FIND US
============================================================ -->
<section id="find-us" class="find-us-section" aria-label="Find Us">

    <!-- Map (full-width) -->
    <div class="find-us-map reveal">
        <iframe
            src="<?php echo esc_url( $map_url ); ?>"
            width="100%"
            height="420"
            style="border:0; display:block; filter:grayscale(80%) contrast(1.1);"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Gold Moment Tattoo Bali location map">
        </iframe>
        <div class="find-us-map-overlay"></div>
    </div>

    <!-- Info Grid -->
    <div class="container">

        <div class="text-center pt-5 pb-4 reveal">
            <span class="section-badge"><?php echo esc_html( $findus_badge ); ?></span>
            <h2 class="section-title mt-2">
                <?php echo esc_html( $findus_title ); ?> <span><?php echo esc_html( $findus_highlight ); ?></span>
            </h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle"><?php echo esc_html( $findus_subtitle ); ?></p>
        </div>

        <div class="find-us-grid reveal delay-1">

            <!-- Address -->
            <div class="find-us-card">
                <div class="find-us-card-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="find-us-card-label">Studio Address</div>
                <div class="find-us-card-value"><?php echo nl2br( esc_html( $contact_address ) ); ?></div>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode( $contact_address ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="find-us-card-link">
                    Get Directions <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </div>

            <!-- Instagram -->
            <div class="find-us-card">
                <div class="find-us-card-icon">
                    <i class="fa-brands fa-instagram"></i>
                </div>
                <div class="find-us-card-label">Instagram</div>
                <div class="find-us-card-value"><?php echo esc_html( $contact_instagram ); ?></div>
                <a href="<?php echo esc_url( $contact_ig_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="find-us-card-link">
                    Follow Us <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </div>

            <!-- Email -->
            <div class="find-us-card">
                <div class="find-us-card-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="find-us-card-label">Email Us</div>
                <div class="find-us-card-value"><?php echo esc_html( $contact_email ); ?></div>
                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"
                   class="find-us-card-link">
                    Send Email <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </div>

            <!-- Business Hours -->
            <div class="find-us-card">
                <div class="find-us-card-icon">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="find-us-card-label">Business Hours</div>
                <div class="find-us-card-value find-us-hours">
                    <div class="find-us-hour-row">
                        <span>Mon – Fri</span>
                        <span class="text-gold"><?php echo esc_html( $hours_weekday ); ?></span>
                    </div>
                    <div class="find-us-hour-row">
                        <span>Saturday</span>
                        <span class="text-gold"><?php echo esc_html( $hours_sat ); ?></span>
                    </div>
                    <div class="find-us-hour-row">
                        <span>Sunday</span>
                        <span style="color:#555;"><?php echo esc_html( $hours_sun ); ?></span>
                    </div>
                </div>
            </div>

        </div>

        <!-- WhatsApp shortcut at bottom -->
        <div class="text-center pb-5 mt-4 reveal delay-2">
            <a href="<?php echo esc_url( $contact_wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-gold">
                <i class="fa-brands fa-whatsapp"></i>
                <?php echo esc_html( $book_wa_text ); ?>
            </a>
        </div>

    </div>
</section>

<!-- Book Now & Find Us Styles -->
<style>
/* ── Book Now ───────────────────────────────────────────── */
.book-now-section { background: var(--black); position: relative; overflow: hidden; }
.book-now-section::before {
    content: '';
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 70%);
    top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    pointer-events: none;
}

/* WA Button */
.book-wa-wrap { display: flex; flex-direction: column; align-items: center; }
.book-wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    background: #25D366;
    color: #fff !important;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.06em;
    padding: 18px 44px;
    border-radius: 60px;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 8px 32px rgba(37,211,102,0.3);
    position: relative;
}
.book-wa-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 48px rgba(37,211,102,0.45);
    color: #fff !important;
}
.book-wa-btn::before {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 63px;
    background: linear-gradient(135deg, rgba(37,211,102,0.4), rgba(37,211,102,0));
    filter: blur(10px);
    z-index: -1;
}
.book-wa-icon-wrap {
    display: flex; align-items: center; justify-content: center;
    width: 42px; height: 42px;
    background: rgba(255,255,255,0.15);
    border-radius: 50%;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.book-wa-label { font-size: 1rem; }
.book-wa-sub {
    margin-top: 14px;
    font-size: 12px;
    color: #555;
    letter-spacing: 0.05em;
}
.book-trust-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #666;
    padding: 8px 18px;
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: 30px;
}
.book-trust-badge i { color: var(--gold); font-size: 12px; }

/* ── Find Us ────────────────────────────────────────────── */
.find-us-section { background: var(--black); }

/* Map */
.find-us-map { position: relative; overflow: hidden; }
.find-us-map-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 120px;
    background: linear-gradient(to top, var(--black), transparent);
    pointer-events: none;
}

/* Info Grid */
.find-us-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 0;
}
@media (max-width: 991px) { .find-us-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px)  { .find-us-grid { grid-template-columns: 1fr; } }

.find-us-card {
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    padding: 28px 24px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    transition: border-color 0.3s, transform 0.3s;
}
.find-us-card:hover {
    border-color: rgba(201,168,76,0.3);
    transform: translateY(-3px);
}
.find-us-card-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: rgba(201,168,76,0.1);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    font-size: 1.1rem;
    margin-bottom: 4px;
}
.find-us-card-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--gold);
}
.find-us-card-value {
    font-size: 0.875rem;
    color: #bbb;
    line-height: 1.65;
    flex: 1;
}
.find-us-card-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--gold);
    margin-top: 4px;
    transition: gap 0.25s ease;
}
.find-us-card:hover .find-us-card-link { gap: 8px; }
.find-us-card-link i { font-size: 9px; }

/* Hours table */
.find-us-hours { display: flex; flex-direction: column; gap: 6px; }
.find-us-hour-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    gap: 8px;
}
.find-us-hour-row span:first-child { color: #666; }
</style>

<?php get_footer(); ?>
