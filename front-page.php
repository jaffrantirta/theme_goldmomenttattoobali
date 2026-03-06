<?php
/**
 * Gold Moment Tattoo Bali — Front Page Template
 *
 * WordPress uses this file for the site root (/) when a static front page
 * is configured under Settings → Reading → "A static page".
 *
 * Setup required (one-time, in WP Admin):
 *   Settings → Reading → Your homepage displays → A static page
 *     Homepage:   select any page (e.g. a blank page called "Home")
 *     Posts page: select your blog page (e.g. "Updates")
 */

// Load the main landing page content from index.php
require get_template_directory() . '/index.php';
