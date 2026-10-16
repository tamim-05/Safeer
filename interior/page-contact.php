<?php
/**
 * Safeer Interior - Contact page (applies automatically to the page with slug "contact").
 *
 * Phone, address and map link come from safeer_site() in functions.php.
 * Everything else comes from the "Contact Page Content" SCF group, with the
 * design's original text as the fallback.
 */

if (!defined('ABSPATH')) exit;

$site = safeer_site();

$f = function ($key, $default = '') {
  $value = function_exists('get_field') ? get_field($key) : '';
  return ($value !== '' && $value !== null) ? $value : $default;
};

$icon_phone = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>';

$map_src = 'https://maps.google.com/maps?q=' . rawurlencode($site['address_full']) . '&z=14&output=embed';

get_header();
?>

<main id="main-content">

  <!-- Hero -->
  <section class="hero-contact" aria-label="Contact Studio Hero">
    <div class="container">
      <div class="contact-hero-content">
        <span class="eyebrow">CONTACT SAFEER</span>
        <h1><?php echo esc_html($f('hero_heading', "Let's Begin With Your Space.")); ?></h1>
        <p><?php echo esc_html($f('hero_text', 'Whether you are planning a villa, renovating a residence, or developing a commercial interior, tell us what you have in mind.')); ?></p>
      </div>
    </div>
  </section>

  <!-- Contact info + enquiry form -->
  <section class="section" aria-label="Contact Information and Project Form">
    <div class="container">
      <div class="contact-layout-grid">

        <div class="contact-info-panel">

          <div class="contact-info-card">
            <span class="eyebrow">STUDIO DETAILS</span>
            <h2><?php echo esc_html($f('studio_heading', $site['name'])); ?></h2>

            <div class="contact-meta-row">
              <div class="contact-icon-box" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              </div>
              <div>
                <div class="contact-meta-label">Studio Address</div>
                <div class="contact-meta-val"><?php echo esc_html($site['address_full']); ?></div>
              </div>
            </div>

            <div class="contact-meta-row">
              <div class="contact-icon-box" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
              </div>
              <div>
                <div class="contact-meta-label">Direct Telephone</div>
                <div class="contact-meta-val">
                  <a href="tel:<?php echo esc_attr($site['phone_tel']); ?>" class="contact-phone-link"><?php echo esc_html($site['phone_display']); ?></a>
                </div>
              </div>
            </div>

            <div class="contact-meta-row">
              <div class="contact-icon-box" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
              </div>
              <div>
                <div class="contact-meta-label">Plus Code</div>
                <div class="contact-meta-val"><?php echo esc_html($f('plus_code', 'QMM6+X7 Al Ghadir, Riyadh, Saudi Arabia')); ?></div>
              </div>
            </div>

            <div class="contact-card-action">
              <a href="<?php echo esc_url($site['map_url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">Open in Google Maps</a>
            </div>
          </div>

          <div class="direct-call-block">
            <span class="eyebrow">DIRECT CONVERSATION</span>
            <h3><?php echo esc_html($f('call_heading', 'Prefer a Direct Conversation?')); ?></h3>
            <p><?php echo esc_html($f('call_text', 'Call Safeer Interior Work Riyadh to discuss your interior project directly with our principal team.')); ?></p>
            <a href="tel:<?php echo esc_attr($site['phone_tel']); ?>" class="btn btn-primary">
              <?php echo $icon_phone; ?>
              <span>Call <?php echo esc_html($site['phone_display']); ?></span>
            </a>
          </div>

        </div>

        <div class="contact-form-card">
          <span class="eyebrow">PROJECT INQUIRY</span>
          <h2><?php echo esc_html($f('form_heading', 'Tell Us About Your Project')); ?></h2>

          <?php
          $form = $f('form_shortcode');
          if ($form) {
            echo do_shortcode(wp_kses_post($form));
          } elseif (current_user_can('edit_pages')) {
            echo '<p>Paste the Fluent Forms shortcode into the "Form Shortcode" field of this page.</p>';
          }
          ?>
        </div>

      </div>
    </div>
  </section>

  <!-- Map -->
  <section class="section contact-map-section" aria-label="Studio Location Map">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">MAP VIEW</span>
        <h2><?php echo esc_html($f('map_heading', 'Find Our Riyadh Studio')); ?></h2>
      </div>

      <div class="map-wrapper">
        <iframe
          src="<?php echo esc_url($map_src); ?>"
          title="View <?php echo esc_attr($site['name']); ?> on Google Maps"
          loading="lazy"
          allowfullscreen></iframe>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>