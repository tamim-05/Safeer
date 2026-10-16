<?php
/**
 * 404 template.
 * The header, mobile drawer, footer and scripts come from header.php,
 * footer.php and functions.php.
 */
get_header();

$url_home     = esc_url(home_url('/'));
$url_services = esc_url(home_url('/services/'));
$url_contact  = esc_url(home_url('/contact/'));

// The address the visitor tried to open (path only, escaped).
$requested_path = '';
if (!empty($_SERVER['REQUEST_URI'])) {
  $path = wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH);
  if ($path) {
    $requested_path = esc_html(urldecode($path));
  }
}
?>

  <!-- Main Content -->
  <main id="main-content">
    <section class="error-page-section" aria-label="Error 404 Page Not Found">
      <div class="container">
        <div class="error-layout-grid">
          <div class="error-content-box">
            <div class="error-num-watermark" aria-hidden="true">404</div>
            <span class="eyebrow">404 &bull; PAGE NOT FOUND</span>
            <h1>This Space Doesn't Exist.</h1>
            <p>
              The page you are looking for may have moved, changed, or never existed. Let's take you back to a place that does.
            </p>

            <?php if ($requested_path) : ?>
              <p class="error-requested">
                Requested address: <code><?php echo $requested_path; ?></code>
              </p>
            <?php endif; ?>

            <div class="error-btn-group">
              <a href="<?php echo $url_home; ?>" class="btn btn-primary">Back to Home</a>
              <a href="<?php echo $url_services; ?>" class="btn btn-secondary">Explore Services</a>
            </div>
          </div>

          <div class="error-media-box tilt-card">
            <div class="tilt-inner">
              <img
                src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=1200"
                alt="Architectural corridor and spatial void"
                loading="eager">
              <div class="error-media-badge">Spatial Geometry &bull; Unmapped</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>