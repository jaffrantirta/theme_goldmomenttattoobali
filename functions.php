<?php
/**
 * Gold Moment Tattoo Bali — Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Customizer ──────────────────────────────────────────── */
require get_template_directory() . '/inc/customizer.php';

/* ── Theme Support ───────────────────────────────────────── */
function goldmoment_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ] );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'goldmoment-tattoo' ),
        'footer'  => __( 'Footer Navigation',  'goldmoment-tattoo' ),
    ] );
}
add_action( 'after_setup_theme', 'goldmoment_setup' );

/* ── Enqueue Scripts & Styles ────────────────────────────── */
function goldmoment_enqueue_assets() {
    $ver = wp_get_theme()->get( 'Version' );

    // Google Fonts
    wp_enqueue_style(
        'goldmoment-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;600;700;900&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap',
        [],
        null
    );

    // Bootstrap 5.3
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        [],
        '5.3.2'
    );

    // Font Awesome 6
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11'
    );

    // Theme stylesheet (style.css imports custom.css)
    wp_enqueue_style(
        'goldmoment-style',
        get_stylesheet_uri(),
        [ 'bootstrap', 'font-awesome', 'swiper', 'goldmoment-fonts' ],
        $ver
    );

    // Bootstrap 5 JS bundle
    wp_enqueue_script(
        'bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.2',
        true
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11',
        true
    );

    // Theme main JS
    wp_enqueue_script(
        'goldmoment-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [ 'bootstrap-bundle', 'swiper-js' ],
        $ver,
        true
    );

    // Pass AJAX URL and nonce to JS
    wp_localize_script( 'goldmoment-main', 'goldmomentData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'goldmoment_booking' ),
    ] );
}
add_action( 'wp_enqueue_scripts', 'goldmoment_enqueue_assets' );

/* ── AJAX Booking Handler ────────────────────────────────── */
function goldmoment_handle_booking() {
    check_ajax_referer( 'goldmoment_booking', 'nonce' );

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $email   = sanitize_email(      $_POST['email']   ?? '' );
    $phone   = sanitize_text_field( $_POST['phone']   ?? '' );
    $style   = sanitize_text_field( $_POST['style']   ?? '' );
    $date    = sanitize_text_field( $_POST['date']    ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) ) {
        wp_send_json_error( [ 'message' => 'Please fill in required fields.' ] );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Please enter a valid email address.' ] );
    }

    $admin_email = get_option( 'admin_email' );
    $subject     = 'New Tattoo Booking — ' . $name;
    $body        = sprintf(
        "New booking request from Gold Moment Tattoo Bali website:\n\nName: %s\nEmail: %s\nPhone: %s\nStyle: %s\nPreferred Date: %s\n\nMessage:\n%s",
        $name, $email, $phone, $style, $date, $message
    );

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
    ];

    $sent = wp_mail( $admin_email, $subject, $body, $headers );

    if ( $sent ) {
        // Auto-reply to client
        wp_mail(
            $email,
            'Booking Confirmation — Gold Moment Tattoo Bali',
            "Hi {$name},\n\nThank you for reaching out to Gold Moment Tattoo Bali!\n\nWe have received your booking request and our team will contact you within 24 hours to confirm your appointment.\n\nDetails received:\nStyle: {$style}\nPreferred Date: {$date}\n\nFor urgent inquiries, reach us on Instagram: @goldmomenttattoo.bali\n\nWith love & ink,\nGold Moment Tattoo Bali Team",
            [ 'Content-Type: text/plain; charset=UTF-8' ]
        );

        wp_send_json_success( [ 'message' => 'Booking request sent successfully! We\'ll contact you within 24 hours.' ] );
    } else {
        wp_send_json_error( [ 'message' => 'Something went wrong. Please try again or contact us directly.' ] );
    }
}
add_action( 'wp_ajax_goldmoment_booking',        'goldmoment_handle_booking' );
add_action( 'wp_ajax_nopriv_goldmoment_booking', 'goldmoment_handle_booking' );

/* ── AJAX Contact Form Handler ───────────────────────────── */
function goldmoment_handle_contact() {
    check_ajax_referer( 'goldmoment_contact', 'contact_nonce' );

    $name    = sanitize_text_field(     $_POST['ct_name']    ?? '' );
    $email   = sanitize_email(          $_POST['ct_email']   ?? '' );
    $phone   = sanitize_text_field(     $_POST['ct_phone']   ?? '' );
    $subject = sanitize_text_field(     $_POST['ct_subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['ct_message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( [ 'message' => 'Please fill in your name, email and message.' ] );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Please enter a valid email address.' ] );
    }

    $admin_email  = get_option( 'admin_email' );
    $subject_line = 'Contact Form — ' . ( $subject ?: 'General Inquiry' ) . ' from ' . $name;
    $body         = sprintf(
        "New contact form submission:\n\nName: %s\nEmail: %s\nPhone: %s\nTopic: %s\n\nMessage:\n%s",
        $name, $email, $phone ?: '—', $subject ?: '—', $message
    );
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
    ];

    $sent = wp_mail( $admin_email, $subject_line, $body, $headers );

    if ( $sent ) {
        wp_mail(
            $email,
            'We received your message — Gold Moment Tattoo Bali',
            "Hi {$name},\n\nThank you for contacting Gold Moment Tattoo Bali!\n\nWe have received your message and will get back to you within 24 hours.\n\nFor urgent inquiries reach us on Instagram: @goldmomenttattoo.bali\n\nWith love & ink,\nGold Moment Tattoo Bali Team",
            [ 'Content-Type: text/plain; charset=UTF-8' ]
        );
        wp_send_json_success( [ 'message' => 'Thank you! Your message has been sent. We\'ll get back to you within 24 hours.' ] );
    } else {
        wp_send_json_error( [ 'message' => 'Something went wrong. Please try again or contact us directly.' ] );
    }
}
add_action( 'wp_ajax_goldmoment_contact',        'goldmoment_handle_contact' );
add_action( 'wp_ajax_nopriv_goldmoment_contact', 'goldmoment_handle_contact' );

/* ── Bootstrap Nav Walker ────────────────────────────────── */
class Goldmoment_Walker_Nav_Menu extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'nav-item';

        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $output     .= '<li class="' . esc_attr( $class_names ) . '">';

        $atts          = [];
        $atts['href']  = ! empty( $item->url ) ? $item->url : '#';
        $atts['class'] = 'nav-link';

        if ( $item->current || $item->current_item_ancestor ) {
            $atts['class']        .= ' active';
            $atts['aria-current']  = 'page';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attrs = '';
        foreach ( $atts as $attr => $val ) {
            if ( '' !== $val ) {
                $val    = 'href' === $attr ? esc_url( $val ) : esc_attr( $val );
                $attrs .= ' ' . $attr . '="' . $val . '"';
            }
        }

        $title   = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<a' . $attrs . '>' . $title . '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

/* ── Excerpt ─────────────────────────────────────────────── */
function goldmoment_excerpt_length( $_length ) { return 25; }
add_filter( 'excerpt_length', 'goldmoment_excerpt_length' );

/* ── Remove WordPress version ────────────────────────────── */
remove_action( 'wp_head', 'wp_generator' );

/* ── Custom image sizes ──────────────────────────────────── */
add_image_size( 'tattoo-portrait', 400, 530, true );
add_image_size( 'tattoo-gallery',  600, 600, true );
