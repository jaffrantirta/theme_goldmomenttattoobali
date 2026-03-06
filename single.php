<?php
/**
 * Gold Moment Tattoo Bali — Single Post / Article Template
 */

get_header();

while ( have_posts() ) :
    the_post();

    $cats      = get_the_category();
    $read_time = max( 1, ceil( str_word_count( get_the_content() ) / 200 ) );
?>

<!-- ============================================================
     SINGLE POST — ARTICLE HEADER
============================================================ -->
<header class="single-post-header" aria-label="Article Header">
    <div class="single-header-overlay"></div>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-header-bg"
         style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>');">
    </div>
    <?php endif; ?>

    <div class="container position-relative">

        <!-- Breadcrumb -->
        <nav class="single-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a>
            <?php if ( $cats ) : ?>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
                <?php echo esc_html( $cats[0]->name ); ?>
            </a>
            <?php endif; ?>
        </nav>

        <!-- Category & Read Time -->
        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
            <?php if ( $cats ) : ?>
            <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
               class="section-badge" style="margin-bottom:0;">
                <?php echo esc_html( $cats[0]->name ); ?>
            </a>
            <?php endif; ?>
            <span style="font-size:12px; color:var(--gray);">
                <i class="fa-regular fa-clock me-1 text-gold"></i>
                <?php echo esc_html( $read_time ); ?> min read
            </span>
        </div>

        <!-- Title -->
        <h1 class="single-post-title"><?php the_title(); ?></h1>

        <!-- Meta -->
        <div class="single-post-meta">
            <div class="single-post-date">
                <i class="fa-regular fa-calendar me-1 text-gold"></i>
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                    <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                </time>
                <?php if ( get_the_modified_date() !== get_the_date() ) : ?>
                <span style="color:#555;"> &middot; Updated <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ); ?></span>
                <?php endif; ?>
            </div>
        </div>

    </div>
</header>


<!-- ============================================================
     SINGLE POST — CONTENT
============================================================ -->
<section class="single-post-content-section" aria-label="Article Content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Featured Image (if no header bg) -->
                <?php if ( ! has_post_thumbnail() ) : ?>
                <div class="single-no-thumb-spacer"></div>
                <?php else : ?>
                <div class="single-featured-img reveal">
                    <?php the_post_thumbnail( 'full', [
                        'alt'     => get_the_title(),
                        'loading' => 'eager',
                    ] ); ?>
                </div>
                <?php endif; ?>

                <!-- Article Body -->
                <article class="single-article-body reveal delay-1">
                    <?php the_content(); ?>
                </article>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                ?>
                <div class="single-tags reveal delay-1">
                    <i class="fa-solid fa-tags text-gold me-2"></i>
                    <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="single-tag">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <nav class="single-post-nav reveal delay-2" aria-label="Post Navigation">
                    <div class="single-nav-prev">
                        <?php
                        $prev = get_previous_post();
                        if ( $prev ) :
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
                            <span class="single-nav-label"><i class="fa-solid fa-chevron-left"></i> Previous</span>
                            <span class="single-nav-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="single-nav-next">
                        <?php
                        $next = get_next_post();
                        if ( $next ) :
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $next ) ); ?>">
                            <span class="single-nav-label">Next <i class="fa-solid fa-chevron-right"></i></span>
                            <span class="single-nav-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </nav>


                <!-- Comments -->
                <?php if ( comments_open() || get_comments_number() ) : ?>
                <div class="single-comments reveal delay-3">
                    <?php comments_template(); ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     SINGLE POST — RELATED POSTS
============================================================ -->
<?php
$related = new WP_Query( [
    'category__in'   => wp_get_post_categories( get_the_ID() ),
    'post__not_in'   => [ get_the_ID() ],
    'posts_per_page' => 3,
    'orderby'        => 'rand',
] );

if ( $related->have_posts() ) :
?>
<section class="section-padding-sm" aria-label="Related Articles">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">More Stories</span>
            <h2 class="section-title mt-2">Related <span>Articles</span></h2>
            <div class="gold-divider"></div>
        </div>

        <div class="row g-4">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <div class="col-md-4">
                <article class="blog-card">
                    <a href="<?php the_permalink(); ?>"
                       class="blog-card-cover-link"
                       aria-label="Read: <?php echo esc_attr( get_the_title() ); ?>"></a>
                    <div class="blog-card-img">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'tattoo-gallery', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1568515045052-f9a854d70bfd?w=600&q=80"
                                 alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                        <?php endif; ?>
                        <?php
                        $rcats = get_the_category();
                        if ( $rcats ) echo '<span class="blog-card-cat">' . esc_html( $rcats[0]->name ) . '</span>';
                        ?>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-meta">
                            <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html( get_the_date() ); ?></span>
                        </div>
                        <h3 class="blog-card-title"><?php the_title(); ?></h3>
                        <p class="blog-card-excerpt">
                            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
                        </p>
                        <div class="blog-card-footer">
                            <span class="blog-read-more">
                                Read Article <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

    </div>
</section>
<?php endif; ?>


<!-- ============================================================
     CTA — Book Now
============================================================ -->
<section class="py-5" style="background: var(--dark); border-top: 1px solid rgba(201,168,76,0.08);">
    <div class="container text-center reveal">
        <p class="mb-3" style="color:var(--gray); font-size:1rem;">
            Ready to turn your vision into a permanent masterpiece?
        </p>
        <a href="<?php echo esc_url( home_url( '/#book-now' ) ); ?>" class="btn-gold">
            <i class="fa-solid fa-calendar-plus"></i>
            Book Your Appointment
        </a>
    </div>
</section>


<!-- Single Post Styles -->
<style>
/* ── Single Post Header ────────────────────────────────── */
.single-post-header {
    position: relative;
    padding: 130px 0 70px;
    background: var(--black);
    overflow: hidden;
}
.single-header-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.12;
    filter: blur(2px);
}
.single-header-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg,
        rgba(13,13,13,0.7) 0%,
        rgba(13,13,13,0.92) 60%,
        rgba(13,13,13,1) 100%);
    pointer-events: none;
}

/* Breadcrumb */
.single-breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    font-size: 11px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gray);
    margin-bottom: 20px;
}
.single-breadcrumb a { color: var(--gray); }
.single-breadcrumb a:hover { color: var(--gold); }
.single-breadcrumb i { font-size: 8px; color: #555; }

/* Title */
.single-post-title {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 4vw, 2.6rem);
    color: var(--white);
    line-height: 1.3;
    letter-spacing: 0.04em;
    margin-bottom: 24px;
    max-width: 780px;
}

/* Meta */
.single-post-meta {
    display: flex;
    align-items: center;
}
.single-post-date {
    font-size: 12px;
    color: var(--gray);
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ── Content Section ────────────────────────────────────── */
.single-post-content-section {
    padding: 60px 0 80px;
}
.single-no-thumb-spacer { height: 20px; }
.single-featured-img {
    margin-bottom: 40px;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(201,168,76,0.12);
}
.single-featured-img img { width: 100%; height: auto; display: block; }

/* Article Body Typography */
.single-article-body {
    margin-bottom: 40px;
    font-size: 1rem;
    line-height: 1.85;
    color: #c0c0c0;
}
.single-article-body h2,
.single-article-body h3,
.single-article-body h4 {
    font-family: var(--font-heading);
    color: var(--white);
    margin: 2em 0 0.75em;
    letter-spacing: 0.04em;
}
.single-article-body h2 { font-size: 1.6rem; }
.single-article-body h3 { font-size: 1.3rem; }
.single-article-body h4 { font-size: 1.1rem; }
.single-article-body p { margin-bottom: 1.25em; color: #b0b0b0; }
.single-article-body a { color: var(--gold); }
.single-article-body a:hover { color: var(--gold-light); }
.single-article-body blockquote {
    border-left: 3px solid var(--gold);
    padding: 16px 24px;
    margin: 2em 0;
    background: var(--dark);
    border-radius: 0 var(--radius) var(--radius) 0;
    font-style: italic;
    color: #aaa;
}
.single-article-body img {
    border-radius: var(--radius);
    margin: 1.5em 0;
    border: 1px solid rgba(201,168,76,0.1);
}
.single-article-body ul,
.single-article-body ol {
    padding-left: 1.5em;
    margin-bottom: 1.25em;
    color: #b0b0b0;
}
.single-article-body li { margin-bottom: 0.4em; }
.single-article-body hr {
    border: none;
    border-top: 1px solid rgba(201,168,76,0.15);
    margin: 2.5em 0;
}
.single-article-body pre,
.single-article-body code {
    background: var(--dark-2);
    border-radius: 3px;
    font-family: monospace;
    font-size: 0.875em;
}
.single-article-body pre {
    padding: 16px;
    overflow-x: auto;
    border: 1px solid rgba(201,168,76,0.1);
}
.single-article-body code { padding: 2px 6px; }

/* Tags */
.single-tags {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    margin-bottom: 40px;
    padding-top: 24px;
    border-top: 1px solid rgba(255,255,255,0.05);
}
.single-tag {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 5px 14px;
    border: 1px solid rgba(201,168,76,0.25);
    border-radius: 20px;
    color: var(--gray);
    transition: var(--transition);
}
.single-tag:hover {
    border-color: var(--gold);
    color: var(--gold);
}

/* ── Post Navigation ────────────────────────────────────── */
.single-post-nav {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.single-nav-prev,
.single-nav-next {
    flex: 1;
    min-width: 0;
}
.single-nav-next { text-align: right; }
.single-nav-prev a,
.single-nav-next a {
    display: block;
    padding: 18px 20px;
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.12);
    border-radius: var(--radius);
    transition: var(--transition);
    text-decoration: none;
}
.single-nav-prev a:hover,
.single-nav-next a:hover {
    border-color: rgba(201,168,76,0.4);
    background: var(--dark-2);
}
.single-nav-label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 6px;
}
.single-nav-title {
    display: block;
    font-family: var(--font-heading);
    font-size: 0.875rem;
    color: var(--white);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ── Comments ───────────────────────────────────────────── */
.single-comments { margin-top: 20px; }
.single-comments .comment-list,
.single-comments ol { list-style: none; padding: 0; }
.single-comments .comment-body {
    padding: 20px;
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.08);
    border-radius: var(--radius);
    margin-bottom: 16px;
}
.single-comments .comment-author .fn {
    font-family: var(--font-heading);
    font-size: 0.9rem;
    color: var(--white);
}
.single-comments .comment-meta,
.single-comments .comment-metadata a {
    font-size: 11px;
    color: var(--gray);
}
.single-comments .comment-content p { color: #b0b0b0; font-size: 0.9rem; }
.single-comments .reply a { font-size: 11px; color: var(--gold); font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; }
.single-comments .comment-respond {
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    padding: 28px;
    margin-top: 32px;
}
.single-comments .comment-reply-title {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    color: var(--white);
    margin-bottom: 20px;
    letter-spacing: 0.06em;
}
.single-comments .comment-form label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--gray);
    margin-bottom: 6px;
}
.single-comments .comment-form input[type="text"],
.single-comments .comment-form input[type="email"],
.single-comments .comment-form input[type="url"],
.single-comments .comment-form textarea {
    width: 100%;
    background: var(--dark-2);
    border: 1px solid rgba(201,168,76,0.15);
    border-radius: var(--radius);
    padding: 10px 14px;
    color: var(--white);
    font-family: var(--font-body);
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.3s;
    margin-bottom: 16px;
}
.single-comments .comment-form input:focus,
.single-comments .comment-form textarea:focus {
    border-color: var(--gold);
}
.single-comments .comment-form textarea { min-height: 120px; resize: vertical; }
.single-comments .comment-form input[type="submit"] {
    background: var(--gold);
    color: var(--black);
    border: none;
    padding: 12px 28px;
    font-family: var(--font-heading);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    border-radius: var(--radius);
    cursor: pointer;
    transition: var(--transition);
    margin-bottom: 0;
    width: auto;
}
.single-comments .comment-form input[type="submit"]:hover {
    background: var(--gold-light);
}

/* ── Blog card styles (reuse from archive.php) ─────────── */
.blog-card {
    position: relative;
    background: var(--dark);
    border: 1px solid rgba(201,168,76,0.1);
    border-radius: var(--radius);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: var(--transition);
    height: 100%;
    cursor: pointer;
}
.blog-card:hover {
    border-color: rgba(201,168,76,0.35);
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
}
.blog-card-cover-link {
    position: absolute;
    inset: 0;
    z-index: 1;
    display: block;
}
.blog-card-img { position: relative; overflow: hidden; height: 200px; }
.blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
.blog-card:hover .blog-card-img img { transform: scale(1.05); }
.blog-card-cat {
    position: absolute; top: 12px; left: 12px;
    background: var(--gold); color: var(--black);
    font-size: 9px; font-weight: 700; letter-spacing: 0.2em;
    text-transform: uppercase; padding: 3px 10px; border-radius: 2px;
}
.blog-card-body { padding: 20px; display: flex; flex-direction: column; flex: 1; }
.blog-card-meta { display: flex; gap: 14px; margin-bottom: 10px; font-size: 11px; color: var(--gray); flex-wrap: wrap; }
.blog-card-meta i { margin-right: 4px; color: var(--gold); }
.blog-card-title { font-family: var(--font-heading); font-size: 1rem; font-weight: 600; letter-spacing: 0.04em; line-height: 1.4; margin-bottom: 8px; color: var(--white); transition: var(--transition); }
.blog-card:hover .blog-card-title { color: var(--gold); }
.blog-card-excerpt { font-size: 0.85rem; color: var(--gray); line-height: 1.65; flex: 1; margin-bottom: 16px; }
.blog-card-footer { padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.05); }
.blog-read-more { display: inline-flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold); }
.blog-read-more i { transition: transform 0.3s; }
.blog-card:hover .blog-read-more i { transform: translateX(4px); }
</style>

<?php endwhile; ?>

<?php get_footer(); ?>
