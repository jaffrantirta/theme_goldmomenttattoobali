<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 *
 * Gold Moment Tattoo Bali — Full Gallery Page
 * Assign this template to any page via Page Attributes → Template.
 */

get_header();

// ── Customizer Values ─────────────────────────────────────────
$gp_badge     = get_theme_mod( 'gallery_page_badge',     'Our Portfolio' );
$gp_title     = get_theme_mod( 'gallery_page_title',     'Ink in' );
$gp_highlight = get_theme_mod( 'gallery_page_highlight', 'Every Detail' );
$gp_subtitle  = get_theme_mod( 'gallery_page_subtitle',  'Browse our complete collection of custom tattoo artwork — each piece crafted exclusively for its wearer.' );
$gp_ig_url    = get_theme_mod( 'gallery_page_ig_url',    'https://www.instagram.com/goldmomenttattoo.bali' );
$gp_ig_btn    = get_theme_mod( 'gallery_page_ig_btn',    'Follow on Instagram' );
$gp_wa_url    = get_theme_mod( 'contact_wa_url',         'https://wa.me/6281234567890' );

// ── Collect Gallery Items (up to 24) ──────────────────────────
$gallery_items = [];
for ( $i = 1; $i <= 24; $i++ ) {
    $img   = get_theme_mod( "gallery_page_item_{$i}_img",   '' );
    $label = get_theme_mod( "gallery_page_item_{$i}_label", '' );
    $style = get_theme_mod( "gallery_page_item_{$i}_style", '' );
    if ( $img ) {
        $gallery_items[] = [
            'img'   => esc_url( $img ),
            'label' => esc_html( $label ),
            'style' => sanitize_title( $style ),
            'raw_style' => esc_html( $style ),
        ];
    }
}

// ── Collect unique style tabs from items ──────────────────────
$styles = [];
foreach ( $gallery_items as $item ) {
    if ( $item['style'] && ! in_array( $item['style'], array_column( $styles, 'slug' ), true ) ) {
        $styles[] = [
            'slug'  => $item['style'],
            'label' => $item['raw_style'],
        ];
    }
}
?>

<style>
/* ── Gallery Page — Page-Specific Styles ──────────────────── */
.gallery-page-hero {
    background: linear-gradient(180deg, #111111 0%, var(--dark) 100%);
    padding: 120px 0 70px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.gallery-page-hero::before {
    content: '';
    position: absolute;
    top: -200px;
    left: 50%;
    transform: translateX(-50%);
    width: 600px;
    height: 600px;
    background: radial-gradient(ellipse, rgba(201,168,76,0.06) 0%, transparent 70%);
    pointer-events: none;
}

.gallery-page-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* ── Gallery Page Grid ───────────────────────────────────────── */
.gallery-page-section {
    background-color: var(--dark);
    padding: 70px 0 100px;
}

.gallery-page-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

/* Bento accent: every 9th item spans 2 cols */
.gallery-page-item {
    position: relative;
    overflow: hidden;
    border-radius: 6px;
    cursor: pointer;
    border: 1px solid rgba(201,168,76,0.08);
    aspect-ratio: 1 / 1;
    background: var(--dark-2);
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.gallery-page-item.span-2 {
    grid-column: span 2;
    aspect-ratio: 2 / 1;
}

.gallery-page-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
    display: block;
}

.gallery-page-item:hover img { transform: scale(1.08); }

.gallery-page-item .gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,13,13,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.35s ease;
}

.gallery-page-item:hover .gallery-item-overlay { opacity: 1; }

.gallery-page-item .gallery-item-label {
    font-family: var(--font-heading);
    font-size: 13px;
    color: var(--gold);
    position: absolute;
    bottom: 14px;
    left: 14px;
    opacity: 0;
    transform: translateY(8px);
    transition: var(--transition);
}

.gallery-page-item:hover .gallery-item-label {
    opacity: 1;
    transform: translateY(0);
}

.gallery-page-item .gp-style-tag {
    font-family: var(--font-body);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--black);
    background: var(--gold);
    padding: 3px 10px;
    border-radius: 20px;
}

/* Hidden / filtered state */
.gallery-page-item.gp-hidden {
    display: none;
}

/* ── Lightbox with Prev/Next ─────────────────────────────────── */
#gp-lightbox {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.96);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

#gp-lightbox.active { display: flex; }

#gp-lightbox .gp-lb-img {
    max-width: 88vw;
    max-height: 88vh;
    object-fit: contain;
    border-radius: 4px;
    box-shadow: 0 0 60px rgba(0,0,0,0.8);
}

.gp-lb-close {
    position: absolute;
    top: 20px;
    right: 24px;
    width: 44px;
    height: 44px;
    background: transparent;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    color: var(--white);
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 1;
}

.gp-lb-close:hover { border-color: var(--gold); color: var(--gold); transform: rotate(90deg); }

.gp-lb-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(201,168,76,0.3);
    border-radius: 50%;
    color: var(--gold);
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 1;
}

.gp-lb-nav:hover { background: var(--gold); color: var(--black); border-color: var(--gold); }

.gp-lb-prev { left: 20px; }
.gp-lb-next { right: 20px; }

.gp-lb-counter {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    font-family: var(--font-body);
    font-size: 12px;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.15em;
}

/* ── Empty State ─────────────────────────────────────────────── */
.gp-empty {
    display: none;
    text-align: center;
    padding: 60px 20px;
    color: var(--gray);
    font-family: var(--font-body);
}

.gp-empty i { font-size: 48px; color: rgba(201,168,76,0.2); margin-bottom: 16px; }

/* ── Instagram CTA ───────────────────────────────────────────── */
.gallery-page-cta {
    text-align: center;
    padding: 60px 0 0;
}

/* ── Responsive ──────────────────────────────────────────────── */
@media (max-width: 991px) {
    .gallery-page-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    .gallery-page-item.span-2 {
        grid-column: span 2;
    }
}

@media (max-width: 575px) {
    .gallery-page-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .gallery-page-item.span-2 {
        grid-column: span 2;
        aspect-ratio: 2 / 1;
    }
    .gp-lb-nav { display: none; }
}
</style>

<!-- ============================================================
     GALLERY PAGE — HERO HEADER
============================================================ -->
<section class="gallery-page-hero" aria-label="Gallery page header">
    <div class="container">
        <span class="section-badge"><?php echo esc_html( $gp_badge ); ?></span>
        <h1 class="section-title mt-2 mb-0">
            <?php echo esc_html( $gp_title ); ?>
            <span><?php echo esc_html( $gp_highlight ); ?></span>
        </h1>
        <div class="gold-divider"></div>
        <p class="section-subtitle mx-auto" style="max-width:560px;">
            <?php echo esc_html( $gp_subtitle ); ?>
        </p>
    </div>
</section>
<!-- /GALLERY PAGE HERO -->

<!-- ============================================================
     GALLERY PAGE — MAIN GALLERY
============================================================ -->
<section class="gallery-page-section" aria-label="Full gallery">
    <div class="container-fluid" style="max-width:1400px;">

        <?php if ( ! empty( $gallery_items ) ) : ?>

        <!-- Filter Tabs -->
        <?php if ( ! empty( $styles ) ) : ?>
        <div class="gallery-filter mb-5" role="tablist" aria-label="Filter gallery by style">
            <button class="gallery-filter-btn active" data-filter="all" role="tab" aria-selected="true">
                All
                <span class="ms-1" style="opacity:.6;font-size:10px;">(<?php echo count( $gallery_items ); ?>)</span>
            </button>
            <?php foreach ( $styles as $s ) : ?>
            <button class="gallery-filter-btn" data-filter="<?php echo esc_attr( $s['slug'] ); ?>" role="tab" aria-selected="false">
                <?php echo esc_html( $s['label'] ); ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Gallery Grid -->
        <div class="gallery-page-grid" id="galleryPageGrid">
            <?php foreach ( $gallery_items as $idx => $item ) :
                // Make every 9th item (0-indexed: 8, 17) span 2 columns for visual variety
                $is_wide = ( $idx % 9 === 0 && $idx > 0 );
                $span_class = $is_wide ? 'gallery-page-item span-2' : 'gallery-page-item';
            ?>
            <div class="<?php echo esc_attr( $span_class ); ?>"
                 data-style="<?php echo esc_attr( $item['style'] ); ?>"
                 data-img="<?php echo esc_url( $item['img'] ); ?>"
                 data-label="<?php echo esc_attr( $item['label'] ); ?>"
                 data-idx="<?php echo esc_attr( $idx ); ?>"
                 role="button"
                 tabindex="0"
                 aria-label="View <?php echo esc_attr( $item['label'] ?: 'tattoo image ' . ( $idx + 1 ) ); ?>">

                <img src="<?php echo esc_url( $item['img'] ); ?>"
                     alt="<?php echo esc_attr( $item['label'] ?: 'Tattoo artwork' ); ?>"
                     loading="<?php echo $idx < 8 ? 'eager' : 'lazy'; ?>">

                <div class="gallery-item-overlay">
                    <?php if ( $item['raw_style'] ) : ?>
                    <span class="gp-style-tag"><?php echo esc_html( $item['raw_style'] ); ?></span>
                    <?php endif; ?>
                    <div class="gallery-zoom-btn" aria-hidden="true">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <?php if ( $item['label'] ) : ?>
                <div class="gallery-item-label"><?php echo esc_html( $item['label'] ); ?></div>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty State -->
        <div class="gp-empty" id="gpEmpty">
            <i class="fa-solid fa-image-slash d-block"></i>
            <p class="mt-2">No artwork found for this style.</p>
        </div>

        <!-- Instagram CTA -->
        <div class="gallery-page-cta">
            <?php if ( $gp_ig_url ) : ?>
            <a href="<?php echo esc_url( $gp_ig_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-gold"
               style="display:inline-flex;align-items:center;gap:10px;">
                <i class="fa-brands fa-instagram"></i>
                <?php echo esc_html( $gp_ig_btn ); ?>
            </a>
            <?php endif; ?>

            <?php if ( $gp_wa_url ) : ?>
            <a href="<?php echo esc_url( $gp_wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-gold ms-3"
               style="display:inline-flex;align-items:center;gap:10px;background:transparent;border-color:rgba(255,255,255,0.15);color:var(--white);">
                <i class="fa-brands fa-whatsapp"></i>
                Book This Style
            </a>
            <?php endif; ?>
        </div>

        <?php else : ?>
        <!-- No items configured yet -->
        <div class="text-center py-5">
            <i class="fa-solid fa-images" style="font-size:64px;color:rgba(201,168,76,0.15);"></i>
            <p class="mt-4" style="color:var(--gray);">
                No gallery images yet.<br>
                Add images in <strong>Appearance → Customize → Gallery Page</strong>.
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>
<!-- /GALLERY PAGE SECTION -->


<!-- ============================================================
     LIGHTBOX (with Prev / Next)
============================================================ -->
<div id="gp-lightbox" role="dialog" aria-modal="true" aria-label="Image lightbox">
    <button class="gp-lb-close" id="gpLbClose" aria-label="Close lightbox">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <button class="gp-lb-nav gp-lb-prev" id="gpLbPrev" aria-label="Previous image">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <img class="gp-lb-img" id="gpLbImg" src="" alt="">
    <button class="gp-lb-nav gp-lb-next" id="gpLbNext" aria-label="Next image">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
    <div class="gp-lb-counter" id="gpLbCounter"></div>
</div>
<!-- /LIGHTBOX -->


<script>
(function () {
    'use strict';

    var grid      = document.getElementById('galleryPageGrid');
    var lightbox  = document.getElementById('gp-lightbox');
    var lbImg     = document.getElementById('gpLbImg');
    var lbClose   = document.getElementById('gpLbClose');
    var lbPrev    = document.getElementById('gpLbPrev');
    var lbNext    = document.getElementById('gpLbNext');
    var lbCounter = document.getElementById('gpLbCounter');
    var emptyEl   = document.getElementById('gpEmpty');
    var filterBtns = document.querySelectorAll('.gallery-filter-btn');

    if (!grid) return;

    var allItems = Array.from(grid.querySelectorAll('.gallery-page-item'));
    var visibleItems = allItems.slice(); // initially all visible
    var currentIdx   = 0;

    /* ── Lightbox ─────────────────────────────────────────────── */
    function openLightbox(idx) {
        currentIdx = idx;
        var item = visibleItems[currentIdx];
        if (!item) return;

        var src = item.getAttribute('data-img') || '';
        var alt = item.getAttribute('data-label') || 'Tattoo artwork';
        lbImg.src = src;
        lbImg.alt = alt;
        lbCounter.textContent = (currentIdx + 1) + ' / ' + visibleItems.length;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Nav arrows visibility
        lbPrev.style.display = visibleItems.length > 1 ? 'flex' : 'none';
        lbNext.style.display = visibleItems.length > 1 ? 'flex' : 'none';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    function showPrev() {
        currentIdx = (currentIdx - 1 + visibleItems.length) % visibleItems.length;
        openLightbox(currentIdx);
    }

    function showNext() {
        currentIdx = (currentIdx + 1) % visibleItems.length;
        openLightbox(currentIdx);
    }

    // Click on grid items
    allItems.forEach(function (item) {
        item.addEventListener('click', function () {
            var idx = visibleItems.indexOf(item);
            if (idx !== -1) openLightbox(idx);
        });
        item.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                var idx = visibleItems.indexOf(item);
                if (idx !== -1) openLightbox(idx);
            }
        });
    });

    if (lbClose)  lbClose.addEventListener('click', closeLightbox);
    if (lbPrev)   lbPrev.addEventListener('click',  showPrev);
    if (lbNext)   lbNext.addEventListener('click',  showNext);

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape')       closeLightbox();
        if (e.key === 'ArrowLeft')    showPrev();
        if (e.key === 'ArrowRight')   showNext();
    });

    /* ── Filter ───────────────────────────────────────────────── */
    function applyFilter(filter) {
        visibleItems = [];

        allItems.forEach(function (item) {
            var style = item.getAttribute('data-style') || '';
            var show  = filter === 'all' || style === filter;
            item.classList.toggle('gp-hidden', !show);
            if (show) visibleItems.push(item);
        });

        // Update count badges on "All" button
        filterBtns.forEach(function (btn) {
            if (btn.getAttribute('data-filter') === 'all') {
                var countSpan = btn.querySelector('span');
                if (countSpan) countSpan.textContent = '(' + visibleItems.length + ')';
            }
        });

        // Show empty state if nothing matches
        if (emptyEl) {
            emptyEl.style.display = visibleItems.length === 0 ? 'block' : 'none';
        }
    }

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');
            applyFilter(btn.getAttribute('data-filter'));
        });
    });

    // Initialise with all visible
    applyFilter('all');

})();
</script>

<?php get_footer(); ?>
