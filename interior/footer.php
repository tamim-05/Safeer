<?php
/**
 * Footer. Data comes from safeer_site() in functions.php. Do not edit per page.
 */
$site   = safeer_site();
$extras = safeer_show_footer_extras(); // false on the 404 page
?>

  <!-- GLOBAL FOOTER -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-top-grid">
        <!-- Brand Column -->
        <div class="footer-brand-col">
          <a href="<?php echo safeer_url(); ?>" class="brand-link" aria-label="<?php echo esc_attr($site['name']); ?> Home">
            <span class="brand-title"><?php echo esc_html($site['brand_main']); ?> <span><?php echo esc_html($site['brand_accent']); ?></span></span>
            <span class="brand-descriptor"><?php echo wp_kses_post($site['descriptor']); ?></span>
          </a>
          <p class="footer-tagline">
            <?php echo wp_kses_post($site['footer_tagline']); ?>
          </p>
          <?php if ($extras) : ?>
          <div class="footer-rating-badge">
            <span class="rating-stars">&starf;&starf;&starf;&starf;&star;</span>
            <span class="rating-score"><?php echo esc_html($site['rating']); ?> &starf;</span>
            <span class="rating-source">Google Listing</span>
          </div>
          <?php endif; ?>
        </div>

        <!-- Navigation Links -->
        <div>
          <div class="footer-heading">Navigation</div>
          <ul class="footer-nav-list">
            <?php foreach ($site['nav'] as $item) : ?>
              <li><a href="<?php echo safeer_url($item['slug']); ?>"><?php echo esc_html($item['footer_label']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Services Links -->
        <div>
          <div class="footer-heading">Services</div>
          <ul class="footer-nav-list">
            <?php foreach ($site['services_links'] as $label) : ?>
              <li><a href="<?php echo safeer_url($site['services_slug']); ?>"><?php echo wp_kses_post($label); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Location & Contact -->
        <div>
          <div class="footer-heading">Studio Location</div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <div>
              <?php echo esc_html($site['address_full']); ?>
            </div>
          </div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <a href="tel:<?php echo esc_attr($site['phone_tel']); ?>" style="color: var(--text-hi); font-weight: 500;"><?php echo esc_html($site['phone_display']); ?></a>
          </div>
          <?php if ($extras) : ?>
          <div style="margin-top: 16px;">
            <a href="<?php echo safeer_url($site['cta_slug']); ?>" class="btn btn-primary" style="min-height: 44px; padding-inline: 20px; font-size: 0.7rem;"><?php echo esc_html($site['cta_label']); ?></a>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-bottom">
        <div>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($site['name']); ?>. All rights reserved.</div>
        <button type="button" class="back-to-top-btn" aria-label="Back to top of page">
          <span>Back to Top</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="18 15 12 9 6 15"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </footer>

  <?php if ($extras) : ?>
  <!-- Floating Call CTA -->
  <aside class="floating-contact-cta" aria-label="Quick contact">
    <div class="floating-cta-tooltip">Speak with our Riyadh Studio</div>
    <a href="tel:<?php echo esc_attr($site['phone_tel']); ?>" class="floating-cta-circle" aria-label="Call <?php echo esc_attr($site['name']); ?> at <?php echo esc_attr($site['phone_display']); ?>">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
      </svg>
    </a>
  </aside>
  <?php endif; ?>

  <?php wp_footer(); ?>
</body>
</html>