<?php
/**
 * Gold Moment Tattoo Bali — Blog Archive with Category Filter Tabs
 */

get_header();

// ── Fetch all categories that have at least one post ──────
$blog_cats = get_categories( [
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
] );

// ── Fetch all posts (for client-side filtering) ───────────
$all_posts = new WP_Query( [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 60,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

// Detect active category from URL (if browsing a category archive)
$active_cat_slug = is_category() ? get_queried_object()->slug : 'all';
?>

<!-- ============================================================
     BLOG — PAGE HEADER
============================================================ -->
<section class="blog-page-header" aria-label="Blog Header">
    <div class="blog-header-bg-text">JOURNAL</div>
    <div class="blog-header-glow"></div>
    <div class="container position-relative text-center">

        <span class="section-badge">Our Blog</span>

        <h1 class="section-title mt-3">
            Tattoo <span>Journal</span>
        </h1>

        <div class="gold-divider"></div>

        <p class="section-subtitle">
            Stories, inspiration, care tips and insights from the artists of Gold Moment Tattoo Bali.
        </p>

        <!-- Search bar -->
        <div class="blog-search-wrap mt-4">
            <div class="blog-search-box">
                <i class="fa-solid fa-magnifying-glass blog-search-icon"></i>
                <input type="text"
                       id="blogSearch"
                       class="blog-search-input"
                       placeholder="Search articles..."
                       aria-label="Search articles">
                <button class="blog-search-clear" id="blogSearchClear" aria-label="Clear search" style="display:none;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

    </div>
</section>


<!-- ============================================================
     BLOG — CATEGORY TABS + POST GRID
============================================================ -->
<section class="blog-main-section" aria-label="Blog Posts">
    <div class="container">

        <!-- ── Category Filter Tabs ─────────────────────── -->
        <?php if ( $blog_cats ) : ?>
        <div class="blog-filter-bar" role="tablist" aria-label="Filter by category">

            <button class="blog-filter-tab active"
                    data-cat="all"
                    role="tab"
                    aria-selected="true">
                All
                <span class="blog-tab-count"><?php echo esc_html( $all_posts->found_posts ); ?></span>
            </button>

            <?php foreach ( $blog_cats as $cat ) : ?>
            <button class="blog-filter-tab <?php echo $active_cat_slug === $cat->slug ? 'active' : ''; ?>"
                    data-cat="<?php echo esc_attr( $cat->slug ); ?>"
                    role="tab"
                    aria-selected="<?php echo $active_cat_slug === $cat->slug ? 'true' : 'false'; ?>">
                <?php echo esc_html( $cat->name ); ?>
                <span class="blog-tab-count"><?php echo esc_html( $cat->count ); ?></span>
            </button>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>

        <!-- ── Post Grid ────────────────────────────────── -->
        <?php if ( $all_posts->have_posts() ) : ?>

        <div class="blog-grid" id="blogGrid" role="tabpanel">

            <?php while ( $all_posts->have_posts() ) : $all_posts->the_post(); ?>

            <?php
            $post_cats  = get_the_category();
            $cat_slugs  = $post_cats ? implode( ' ', wp_list_pluck( $post_cats, 'slug' ) ) : '';
            $cat_name   = $post_cats ? $post_cats[0]->name : '';
            $read_time  = max( 1, ceil( str_word_count( get_the_content() ) / 200 ) );
            ?>

            <article id="post-<?php the_ID(); ?>"
                     <?php post_class( 'blog-card' ); ?>
                     data-cats="<?php echo esc_attr( $cat_slugs ); ?>"
                     data-title="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>">

                <!-- Full-card clickable link -->
                <a href="<?php the_permalink(); ?>"
                   class="blog-card-cover-link"
                   aria-label="Read: <?php echo esc_attr( get_the_title() ); ?>"></a>

                <!-- Thumbnail -->
                <div class="blog-card-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'tattoo-gallery', [
                            'alt'     => get_the_title(),
                            'loading' => 'lazy',
                        ] ); ?>
                    <?php else : ?>
                        <img src="https://images.unsplash.com/photo-1542856391-010fb87dcfed?w=600&q=80"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             loading="lazy">
                    <?php endif; ?>

                    <?php if ( $cat_name ) : ?>
                    <span class="blog-card-cat"><?php echo esc_html( $cat_name ); ?></span>
                    <?php endif; ?>

                    <div class="blog-card-img-overlay">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="blog-card-body">

                    <div class="blog-card-meta">
                        <span>
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                            </time>
                        </span>
                        <span>
                            <i class="fa-regular fa-clock" aria-hidden="true"></i>
                            <?php echo esc_html( $read_time ); ?> min
                        </span>
                    </div>

                    <h2 class="blog-card-title"><?php the_title(); ?></h2>

                    <p class="blog-card-excerpt">
                        <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
                    </p>

                    <div class="blog-card-footer">
                        <span class="blog-read-more">
                            Read Article <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </div>

                </div>
            </article>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

        <!-- No results (shown by JS when filter finds nothing) -->
        <div class="blog-no-results" id="blogNoResults" style="display:none;">
            <i class="fa-solid fa-pen-nib text-gold"></i>
            <h3>No articles found</h3>
            <p>Try a different category or clear the search.</p>
        </div>

        <!-- Results counter -->
        <p class="blog-results-count" id="blogResultsCount"></p>

        <?php else : ?>

        <!-- No Posts at all -->
        <div class="text-center py-5">
            <i class="fa-solid fa-pen-nib text-gold" style="font-size:3rem;display:block;margin-bottom:1.5rem;"></i>
            <h2 class="section-title">No Articles <span>Yet</span></h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle mb-4">Check back soon — our artists are busy writing!</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-gold">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>

        <?php endif; ?>

    </div>
</section>


<!-- ============================================================
     STYLES
============================================================ -->
<style>
/* ── Page Header ───────────────────────────────────────── */
.blog-page-header {
    position: relative;
    padding: 140px 0 70px;
    background: var(--black);
    overflow: hidden;
}
.blog-header-bg-text {
    position: absolute;
    font-family: var(--font-display);
    font-size: clamp(7rem, 18vw, 16rem);
    font-weight: 900;
    color: rgba(201,168,76,0.04);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    white-space: nowrap;
    pointer-events: none;
    user-select: none;
    letter-spacing: 0.1em;
}
.blog-header-glow {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(201,168,76,0.07) 0%, transparent 70%);
    pointer-events: none;
}

/* Search bar */
.blog-search-wrap {
    display: flex;
    justify-content: center;
}
.blog-search-box {
    position: relative;
    width: 100%;
    max-width: 480px;
}
.blog-search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gold);
    font-size: 13px;
    pointer-events: none;
}
.blog-search-input {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 30px;
    padding: 12px 44px 12px 42px;
    color: var(--white);
    font-family: var(--font-body);
    font-size: 13px;
    outline: none;
    transition: border-color 0.3s, background 0.3s;
}
.blog-search-input::placeholder { color: #555; }
.blog-search-input:focus {
    border-color: rgba(201,168,76,0.5);
    background: rgba(255,255,255,0.06);
}
.blog-search-clear {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray);
    cursor: pointer;
    font-size: 13px;
    padding: 4px;
    transition: color 0.2s;
}
.blog-search-clear:hover { color: var(--gold); }

/* ── Main Section ──────────────────────────────────────── */
.blog-main-section {
    padding: 60px 0 100px;
}

/* ── Category Filter Tabs ──────────────────────────────── */
.blog-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 40px;
    padding-bottom: 24px;
    border-bottom: 1px solid rgba(201,168,76,0.1);
}
.blog-filter-tab {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1px solid rgba(201,168,76,0.18);
    border-radius: 30px;
    padding: 8px 20px;
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--gray);
    cursor: pointer;
    transition: all 0.25s ease;
    white-space: nowrap;
}
.blog-filter-tab:hover {
    border-color: rgba(201,168,76,0.5);
    color: var(--white);
}
.blog-filter-tab.active {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--black);
}
.blog-tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 20px;
    height: 20px;
    padding: 0 5px;
    background: rgba(0,0,0,0.2);
    border-radius: 10px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0;
}
.blog-filter-tab.active .blog-tab-count {
    background: rgba(0,0,0,0.25);
    color: var(--black);
}

/* ── Post Grid ─────────────────────────────────────────── */
.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
@media (max-width: 991px) { .blog-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; } }
@media (max-width: 575px)  { .blog-grid { grid-template-columns: 1fr; gap: 16px; } }

/* ── Blog Card ─────────────────────────────────────────── */
.blog-card {
    position: relative;
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    transition: border-color 0.35s ease, transform 0.35s ease, box-shadow 0.35s ease, opacity 0.3s ease;
}
.blog-card:hover {
    border-color: rgba(201,168,76,0.4);
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.5);
}
/* Filter hide/show states */
.blog-card.is-hidden {
    display: none;
}
.blog-card.is-filtered-in {
    animation: cardFadeIn 0.35s ease forwards;
}
@keyframes cardFadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Cover link */
.blog-card-cover-link {
    position: absolute;
    inset: 0;
    z-index: 1;
    display: block;
}

/* Thumbnail */
.blog-card-img {
    position: relative;
    overflow: hidden;
    height: 240px;
    flex-shrink: 0;
}
.blog-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.blog-card:hover .blog-card-img img { transform: scale(1.06); }

/* Category badge */
.blog-card-cat {
    position: absolute;
    top: 14px;
    left: 14px;
    background: var(--gold);
    color: var(--black);
    font-family: var(--font-body);
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    padding: 4px 11px;
    border-radius: 2px;
    z-index: 2;
}

/* Hover overlay icon */
.blog-card-img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(201,168,76,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.35s ease;
}
.blog-card-img-overlay i {
    font-size: 1.6rem;
    color: var(--gold);
    filter: drop-shadow(0 0 12px rgba(201,168,76,0.6));
}
.blog-card:hover .blog-card-img-overlay { opacity: 1; }

/* Body */
.blog-card-body {
    padding: 22px 24px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.blog-card-meta {
    display: flex;
    gap: 14px;
    margin-bottom: 10px;
    font-size: 11px;
    color: #666;
    flex-wrap: wrap;
}
.blog-card-meta i { margin-right: 4px; color: var(--gold); }
.blog-card-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    line-height: 1.45;
    margin-bottom: 10px;
    color: var(--white);
    transition: color 0.3s;
}
.blog-card:hover .blog-card-title { color: var(--gold); }
.blog-card-excerpt {
    font-size: 0.85rem;
    color: #777;
    line-height: 1.7;
    flex: 1;
    margin-bottom: 18px;
}
.blog-card-footer {
    padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,0.05);
}
.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--gold);
}
.blog-read-more i { transition: transform 0.3s ease; }
.blog-card:hover .blog-read-more i { transform: translateX(5px); }

/* ── No Results ────────────────────────────────────────── */
.blog-no-results {
    text-align: center;
    padding: 60px 20px;
}
.blog-no-results i {
    font-size: 2.5rem;
    margin-bottom: 20px;
    display: block;
}
.blog-no-results h3 {
    font-family: var(--font-heading);
    font-size: 1.4rem;
    color: var(--white);
    margin-bottom: 10px;
}
.blog-no-results p { color: var(--gray); font-size: 0.9rem; }

/* Results counter */
.blog-results-count {
    font-size: 11px;
    color: #555;
    letter-spacing: 0.1em;
    text-align: center;
    margin-top: 32px;
}
</style>


<!-- ============================================================
     JAVASCRIPT — Category Filter + Search
============================================================ -->
<script>
(function () {
    var tabs     = document.querySelectorAll('.blog-filter-tab');
    var cards    = document.querySelectorAll('#blogGrid .blog-card');
    var noResult = document.getElementById('blogNoResults');
    var counter  = document.getElementById('blogResultsCount');
    var searchEl = document.getElementById('blogSearch');
    var clearBtn = document.getElementById('blogSearchClear');

    var activeCat    = 'all';
    var searchQuery  = '';

    function applyFilters() {
        var visible = 0;

        cards.forEach(function (card, i) {
            var cats  = card.getAttribute('data-cats') || '';
            var title = card.getAttribute('data-title') || '';

            var catMatch    = activeCat === 'all' || cats.split(' ').indexOf(activeCat) !== -1;
            var searchMatch = searchQuery === '' || title.indexOf(searchQuery) !== -1;

            if (catMatch && searchMatch) {
                card.classList.remove('is-hidden');
                card.classList.add('is-filtered-in');
                // stagger animation
                card.style.animationDelay = (visible * 0.04) + 's';
                visible++;
            } else {
                card.classList.add('is-hidden');
                card.classList.remove('is-filtered-in');
            }
        });

        if (noResult) {
            noResult.style.display = visible === 0 ? 'block' : 'none';
        }
        if (counter) {
            counter.textContent = visible > 0
                ? 'Showing ' + visible + ' article' + (visible !== 1 ? 's' : '')
                : '';
        }
    }

    // Tab clicks
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');
            activeCat = tab.getAttribute('data-cat');
            applyFilters();
        });
    });

    // Search input
    if (searchEl) {
        searchEl.addEventListener('input', function () {
            searchQuery = searchEl.value.trim().toLowerCase();
            clearBtn.style.display = searchQuery ? 'block' : 'none';
            applyFilters();
        });
    }
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchEl.value  = '';
            searchQuery     = '';
            clearBtn.style.display = 'none';
            applyFilters();
        });
    }

    // Set initial active state from PHP if browsing a category URL
    var initCat = '<?php echo esc_js( $active_cat_slug ); ?>';
    if (initCat !== 'all') {
        tabs.forEach(function (tab) {
            if (tab.getAttribute('data-cat') === initCat) {
                tab.click();
            }
        });
    }
}());
</script>

<?php get_footer(); ?>
