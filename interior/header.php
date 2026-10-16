<?php
/**
 * Header. Data comes from safeer_site() in functions.php. Do not edit per page.
 */
$site = safeer_site();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Accessibility Skip Link -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Global Header -->
  <header class="site-header" role="banner">
    <div class="container header-container">
      <a href="<?php echo safeer_url(); ?>" class="brand-link" aria-label="<?php echo esc_attr($site['name']); ?> Home">
        <span class="brand-title"><?php echo esc_html($site['brand_main']); ?> <span><?php echo esc_html($site['brand_accent']); ?></span></span>
        <span class="brand-descriptor"><?php echo wp_kses_post($site['descriptor']); ?></span>
      </a>

      <!-- Primary Desktop Nav -->
      <nav class="site-nav" aria-label="Primary Navigation">
        <?php foreach ($site['nav'] as $item) : ?>
          <a href="<?php echo safeer_url($item['slug']); ?>" class="nav-link<?php echo safeer_active($item['slug']); ?>"><?php echo esc_html($item['label']); ?></a>
        <?php endforeach; ?>
      </nav>

      <div class="header-actions">
        <a href="<?php echo safeer_url($site['cta_slug']); ?>" class="btn btn-primary header-cta-btn"><?php echo esc_html($site['cta_label']); ?></a>

        <button id="menu-trigger" class="menu-trigger" aria-expanded="false" aria-label="Open mobile menu" aria-controls="mobile-drawer">
          <span class="menu-trigger-line"></span>
          <span class="menu-trigger-line"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Navigation Drawer -->
  <div id="mobile-drawer" class="mobile-drawer" role="dialog" aria-modal="true" aria-hidden="true" aria-label="Mobile Navigation Menu">
    <nav class="drawer-nav" aria-label="Mobile Links">
      <?php foreach ($site['nav'] as $i => $item) : ?>
        <div class="drawer-link-item">
          <span class="drawer-num"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
          <a href="<?php echo safeer_url($item['slug']); ?>" class="drawer-link<?php echo safeer_active($item['slug']); ?>"><?php echo esc_html($item['label']); ?></a>
        </div>
      <?php endforeach; ?>
    </nav>

    <div class="drawer-footer">
      <div class="drawer-meta-location">
        <?php echo esc_html($site['address_short']); ?>
      </div>
      <a href="tel:<?php echo esc_attr($site['phone_tel']); ?>" class="drawer-phone-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
        <span><?php echo esc_html($site['phone_display']); ?></span>
      </a>
      <a href="<?php echo safeer_url($site['cta_slug']); ?>" class="btn btn-primary" style="width: 100%;"><?php echo esc_html($site['cta_label']); ?></a>
    </div>
  </div>