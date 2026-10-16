<?php
/*
Template Name: Services
*/
get_header();

$services   = get_field( 'services' );
$cta_button = get_field( 'cta_button' );
?>

<main id="main-content">

  <section class="hero-services" aria-label="Services Overview Hero">
    <div class="container">
      <div class="services-hero-content">
        <span class="eyebrow"><?php echo esc_html( get_field( 'hero_eyebrow' ) ); ?></span>
        <h1><?php echo esc_html( get_field( 'hero_heading' ) ); ?></h1>
        <p><?php echo esc_html( get_field( 'hero_text' ) ); ?></p>
      </div>
    </div>
  </section>

  <?php if ( $services ) : ?>
  <section class="section" aria-label="Services Detailed Disciplines">
    <div class="container">

      <?php foreach ( $services as $i => $row ) :
        $tags   = preg_split( '/\R/', (string) $row['tags'], -1, PREG_SPLIT_NO_EMPTY );
        $button = $row['button'];
        $image  = $row['image'];
        $btn_class = ( $i % 2 === 0 ) ? 'btn-primary' : 'btn-secondary';
      ?>
      <article id="<?php echo esc_attr( $row['anchor_id'] ); ?>" class="service-discipline-item">
        <div class="service-discipline-grid">

          <div class="service-discipline-text">
            <span class="eyebrow">SERVICE <?php echo str_pad( $i + 1, 2, '0', STR_PAD_LEFT ); ?></span>
            <h2><?php echo esc_html( $row['title'] ); ?></h2>
            <p><?php echo esc_html( $row['description'] ); ?></p>

            <?php if ( $tags ) : ?>
            <div class="service-areas-group">
              <div class="service-areas-title"><?php echo esc_html( $row['tags_heading'] ); ?></div>
              <div class="service-tags-list">
                <?php foreach ( $tags as $tag ) : ?>
                  <span class="service-tag"><?php echo esc_html( trim( $tag ) ); ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <?php if ( $button ) : ?>
            <div>
              <a href="<?php echo esc_url( $button['url'] ); ?>"
                 class="btn <?php echo $btn_class; ?>"
                 <?php if ( $button['target'] ) : ?>target="<?php echo esc_attr( $button['target'] ); ?>" rel="noopener"<?php endif; ?>>
                <?php echo esc_html( $button['title'] ); ?>
              </a>
            </div>
            <?php endif; ?>
          </div>

          <?php if ( $image ) : ?>
          <div class="service-discipline-media tilt-card">
            <div class="tilt-inner">
              <img src="<?php echo esc_url( $image['url'] ); ?>"
                   alt="<?php echo esc_attr( $image['alt'] ); ?>"
                   loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>">
            </div>
          </div>
          <?php endif; ?>

        </div>
      </article>
      <?php endforeach; ?>

    </div>
  </section>
  <?php endif; ?>

  <section class="services-cta-section" aria-labelledby="services-cta-heading">
    <div class="container">
      <div class="services-cta-inner">
        <span class="eyebrow"><?php echo esc_html( get_field( 'cta_eyebrow' ) ); ?></span>
        <h2 id="services-cta-heading"><?php echo esc_html( get_field( 'cta_heading' ) ); ?></h2>
        <p><?php echo esc_html( get_field( 'cta_text' ) ); ?></p>
        <?php if ( $cta_button ) : ?>
          <a href="<?php echo esc_url( $cta_button['url'] ); ?>" class="btn btn-primary">
            <?php echo esc_html( $cta_button['title'] ); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>