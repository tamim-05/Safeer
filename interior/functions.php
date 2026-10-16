<?php
/**
 * Safeer Interior - theme functions.
 *
 * All site-wide data lives in safeer_site() below. Edit it here:
 * header.php and footer.php only loop over it and never need editing.
 */

if (!defined('ABSPATH')) exit;

/* ------------------------------------------------------------------
 * 1. SITE DATA (edit here)
 * ---------------------------------------------------------------- */
function safeer_site() {
  return array(
    'name'          => 'Safeer Interior Work Riyadh',
    'brand_main'    => 'Safeer',
    'brand_accent'  => 'Interior Work',
    'descriptor'    => 'Riyadh &bull; Interior Design &amp; Fit-Out',
    'footer_tagline'=> 'Luxury Residential &amp; Commercial Interior Design shaped by architecture, materiality, and light.',

    'phone_display' => '+966 55 887 9028',
    'phone_tel'     => '+966558879028',
    'address_full'  => 'All Kuds, King Abdulaziz Rd, Al Ghadir, Riyadh 11461, Saudi Arabia',
    'address_short' => 'King Abdulaziz Rd, Al Ghadir, Riyadh 11461, Saudi Arabia',
    'street'        => 'All Kuds, King Abdulaziz Rd, Al Ghadir',
    'city'          => 'Riyadh',
    'postal_code'   => '11461',
    'country'       => 'SA',
    'lat'           => 24.7742,
    'lng'           => 46.6631,
    'map_url'       => 'https://maps.app.goo.gl/HfMTL4CUYY3UnVju6',
    'rating'        => '4.0',
    'price_range'   => '$$$$',

    // Titles and descriptions
    'title_home'      => 'Safeer Interior Work Riyadh | Luxury Interior Design in Riyadh',
    'title_404'       => 'Page Not Found | Safeer Interior Work Riyadh',
    'description'     => 'Safeer Interior Work Riyadh creates luxury residential and commercial interiors, villa interiors, office fit-outs, bespoke furniture, and interior concepts in Riyadh, Saudi Arabia.',
    'description_404' => "The page you are looking for doesn't exist. Return to Safeer Interior Work Riyadh.",
    'og_title_home'   => 'Safeer Interior Work Riyadh — Spaces Designed to Be Remembered.',
    'og_description'  => 'Luxury residential and commercial interior design in Riyadh, Saudi Arabia.',
    'og_image'        => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&q=80&w=1600',

    // Main navigation. slug '' = homepage. Used by header, drawer and footer.
    'nav' => array(
      array('slug' => '',         'label' => 'Home',     'footer_label' => 'Home'),
      array('slug' => 'about',    'label' => 'About',    'footer_label' => 'About Safeer'),
      array('slug' => 'services', 'label' => 'Services', 'footer_label' => 'Services'),
      array('slug' => 'contact',  'label' => 'Contact',  'footer_label' => 'Contact'),
    ),
    'cta_slug'  => 'contact',
    'cta_label' => 'Start a Project',

    // Footer "Services" column (all link to the services page)
    'services_slug'  => 'services',
    'services_links' => array(
      'Villa Interiors',
      'Office Fit-Outs',
      'Bespoke Furniture',
      'Concept &amp; Visualization',
    ),
  );
}

/* ------------------------------------------------------------------
 * 2. HELPERS (used by header.php and footer.php)
 * ---------------------------------------------------------------- */
function safeer_url($slug = '') {
  $slug = trim($slug, '/');
  return esc_url(home_url($slug === '' ? '/' : '/' . $slug . '/'));
}

function safeer_is_current($slug) {
  return $slug === '' ? is_front_page() : is_page($slug);
}

// Returns " is-active" when the given nav slug is the current page.
function safeer_active($slug) {
  return safeer_is_current($slug) ? ' is-active' : '';
}

// Rating badge, footer CTA and floating call button. Hidden on the 404 page.
// Override anywhere with: add_filter('safeer_show_footer_extras', '__return_false');
function safeer_show_footer_extras() {
  return (bool) apply_filters('safeer_show_footer_extras', !is_404());
}

function safeer_meta_description() {
  $site = safeer_site();
  if (is_404()) {
    return $site['description_404'];
  }
  // Any page with an excerpt gets its own description automatically.
  if (is_singular() && has_excerpt()) {
    return wp_strip_all_tags(get_the_excerpt());
  }
  return $site['description'];
}

/* ------------------------------------------------------------------
 * 3. THEME SETUP
 * ---------------------------------------------------------------- */
function safeer_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_post_type_support('page', 'excerpt'); // page excerpt = meta description
}
add_action('after_setup_theme', 'safeer_setup');

/* ------------------------------------------------------------------
 * 4. STYLES & SCRIPTS
 * ---------------------------------------------------------------- */
function safeer_assets() {
  $dir = get_template_directory();
  $uri = get_template_directory_uri();

  // Fonts used by the design (remove this line if header.php already loads them).
  wp_enqueue_style(
    'safeer-fonts',
    'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Manrope:wght@400;500;600&display=swap',
    array(),
    null
  );

  // Theme stylesheet (style.css in the theme root).
  wp_enqueue_style('safeer-style', get_stylesheet_uri(), array('safeer-fonts'), filemtime($dir . '/style.css'));

  // Homepage hero animation library (front page only).
  $deps = array();
  if (is_front_page()) {
    wp_enqueue_script('animejs', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array(), '3.2.1', true);
    $deps[] = 'animejs';
  }

  // global.js: finds the file in the usual places.
  foreach (array('/js/global.js', '/assets/js/global.js', '/global.js') as $path) {
    if (file_exists($dir . $path)) {
      wp_enqueue_script('safeer-global', $uri . $path, $deps, filemtime($dir . $path), true);
      break;
    }
  }
}
add_action('wp_enqueue_scripts', 'safeer_assets');