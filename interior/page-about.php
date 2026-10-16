<?php
/**
 * Template Name: About
 *
 * Content comes from the "About Page Content" SCF field group.
 */
get_header();

// Field value (empty if SCF is inactive), and an escaped text version of it.
$f = function ($key) {
  return function_exists('get_field') ? get_field($key) : '';
};
$t = function ($key) use ($f) {
  return esc_html((string) $f($key));
};

$img        = $f('story_image');
$principles = $f('principles');
$metrics    = $f('metrics');

// CTA button: Link field "cta_link", falling back to the contact page.
$cta        = $f('cta_link');
$cta_url    = (is_array($cta) && !empty($cta['url']))    ? esc_url($cta['url']) : esc_url(home_url('/contact/'));
$cta_label  = (is_array($cta) && !empty($cta['title']))  ? $cta['title']        : $f('cta_button');
$cta_target = (is_array($cta) && !empty($cta['target'])) ? ' target="' . esc_attr($cta['target']) . '" rel="noopener"' : '';
?>

  <main id="main-content">

    <!-- HERO -->
    <section class="hero-about" aria-label="About Safeer Hero">
      <div class="container">
        <div class="about-hero-content">
          <span class="eyebrow"><?php echo $t('about_hero_eyebrow'); ?></span>
          <h1><?php echo $t('about_hero_title'); ?></h1>
          <p><?php echo $t('about_hero_text'); ?></p>
        </div>
      </div>
    </section>

    <!-- OUR STORY -->
    <section class="section" aria-labelledby="story-heading">
      <div class="container">
        <div class="story-grid">
          <div class="story-text">
            <span class="eyebrow"><?php echo $t('story_eyebrow'); ?></span>
            <h2 id="story-heading"><?php echo $t('story_title'); ?></h2>
            <p><?php echo $t('story_text_1'); ?></p>
            <p><?php echo $t('story_text_2'); ?></p>
          </div>

          <?php if (is_array($img) && !empty($img['url'])) : ?>
            <div class="story-media tilt-card">
              <div class="tilt-inner">
                <img
                  src="<?php echo esc_url(!empty($img['sizes']['large']) ? $img['sizes']['large'] : $img['url']); ?>"
                  alt="<?php echo esc_attr(isset($img['alt']) ? $img['alt'] : ''); ?>"
                  loading="eager">
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- PHILOSOPHY -->
    <section class="section section--alt" aria-labelledby="philosophy-heading">
      <div class="container">
        <div class="section-header" style="max-width: 680px;">
          <span class="eyebrow"><?php echo $t('philosophy_eyebrow'); ?></span>
          <h2 id="philosophy-heading"><?php echo $t('philosophy_title'); ?></h2>
          <p style="margin-top: 12px;"><?php echo $t('philosophy_intro'); ?></p>
        </div>

        <?php if (!empty($principles) && is_array($principles)) : ?>
          <div class="principles-grid">
            <?php foreach ($principles as $n => $p) : ?>
              <div class="spotlight-card principle-card">
                <div class="principle-num"><?php echo esc_html(sprintf('%02d', $n + 1)); ?></div>
                <h3><?php echo esc_html(isset($p['title']) ? $p['title'] : ''); ?></h3>
                <p><?php echo esc_html(isset($p['text']) ? $p['text'] : ''); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- LOCAL PRESENCE -->
    <section class="section" aria-labelledby="presence-heading">
      <div class="container">
        <div class="riyadh-presence-box">
          <div class="riyadh-presence-inner">
            <span class="eyebrow"><?php echo $t('presence_eyebrow'); ?></span>
            <h2 id="presence-heading"><?php echo $t('presence_title'); ?></h2>
            <p><?php echo $t('presence_text'); ?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- METRICS -->
    <section class="section section--alt" aria-label="Studio Performance Metrics">
      <div class="container">
        <div class="section-header">
          <span class="eyebrow"><?php echo $t('metrics_eyebrow'); ?></span>
          <h2><?php echo $t('metrics_title'); ?></h2>
        </div>

        <?php if (!empty($metrics) && is_array($metrics)) : ?>
          <div class="backlit-grid">
            <?php foreach ($metrics as $m) :
              $value  = isset($m['value']) ? (int) $m['value'] : 0;
              $suffix = isset($m['suffix']) ? trim((string) $m['suffix']) : '';
              // A word suffix ("wks") needs a space before it: "8 wks". Symbols ("+", "%") do not.
              if ($suffix !== '' && preg_match('/^\p{L}/u', $suffix)) {
                $suffix = ' ' . $suffix;
              }
            ?>
              <div class="backlit-panel">
                <div class="backlight-glow"></div>
                <span class="eyebrow" style="color: var(--gold-400);"><?php echo esc_html(isset($m['label']) ? $m['label'] : ''); ?></span>
                <div class="metric-value" data-counter="<?php echo esc_attr($value); ?>" data-suffix="<?php echo esc_attr($suffix); ?>"><?php echo esc_html($value . $suffix); ?></div>
                <div class="metric-delta">&blacktriangle; <?php echo esc_html(isset($m['note']) ? $m['note'] : ''); ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- CTA -->
    <section class="section" aria-labelledby="about-cta-heading">
      <div class="container">
        <div class="about-cta-card">
          <span class="eyebrow"><?php echo $t('cta_eyebrow'); ?></span>
          <h2 id="about-cta-heading"><?php echo $t('cta_title'); ?></h2>
          <p><?php echo $t('cta_text'); ?></p>
          <?php if (!empty($cta_label)) : ?>
            <a href="<?php echo $cta_url; ?>" class="btn btn-primary"<?php echo $cta_target; ?>><?php echo esc_html($cta_label); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </main>

<?php get_footer(); ?>