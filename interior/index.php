<?php
/**
 * Front page (Home)
 */
get_header();

$f = get_fields() ?: [];

$t    = fn($k) => esc_html($f[$k] ?? '');
$img  = fn($id, $size = 'large', $attr = []) => $id ? wp_get_attachment_image($id, $size, false, $attr) : '';
$link = fn($l, $class) => !empty($l['url'])
	? sprintf(
		'<a href="%s" class="%s"%s>%s</a>',
		esc_url($l['url']),
		esc_attr($class),
		!empty($l['target']) ? ' target="_blank" rel="noopener noreferrer"' : '',
		esc_html($l['title'])
	)
	: '';

$cats = [
	'villas'      => ['Villas', 'Villa Interior'],
	'commercial'  => ['Commercial', 'Office Fit-Out'],
	'residential' => ['Residential', 'Residential Interior'],
	'bespoke'     => ['Bespoke Furniture', 'Bespoke Furniture'],
];

$site = safeer_site();
?>

<main id="main-content">

	<!-- 01 Hero -->
	<section class="hero-home" aria-label="Hero Section">
		<div class="hero-background-wrap" aria-hidden="true">
			<?= $img($f['hero_image'] ?? 0, 'full', ['class' => 'hero-bg-img', 'loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => '100vw']) ?>
			<div class="hero-overlay"></div>
		</div>

		<div class="container hero-content">
			<div class="eyebrow hero-eyebrow"><?= $t('hero_eyebrow') ?></div>

			<div class="hero-headline-wrap">
				<h1 class="hero-headline"><?= $t('hero_headline') ?></h1>
			</div>

			<p class="hero-subtext"><?= $t('hero_subtext') ?></p>

			<div class="hero-cta-group">
				<?= $link($f['hero_primary_button'] ?? null, 'btn btn-primary') ?>
				<?= $link($f['hero_secondary_button'] ?? null, 'btn btn-secondary') ?>
			</div>

			<div class="hero-rule" aria-hidden="true"></div>

			<div class="hero-microcopy">
				<span><?= $t('hero_microcopy') ?></span>
			</div>
		</div>
	</section>

	<!-- 02 Approach -->
	<section class="section" aria-labelledby="approach-heading">
		<div class="container">
			<div class="approach-grid">
				<div class="approach-text">
					<span class="eyebrow"><?= $t('approach_eyebrow') ?></span>
					<h2 id="approach-heading"><?= $t('approach_heading') ?></h2>
					<p><?= $t('approach_text') ?></p>
					<?= $link($f['approach_button'] ?? null, 'btn btn-primary') ?>
				</div>

				<div class="approach-media tilt-card">
					<div class="tilt-inner">
						<?= $img($f['approach_image'] ?? 0) ?>
						<div class="approach-badge"><?= $t('approach_badge') ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 03 Featured services -->
	<section class="section section--alt" aria-labelledby="services-heading">
		<div class="container">
			<div class="section-header">
				<span class="eyebrow"><?= $t('services_eyebrow') ?></span>
				<h2 id="services-heading"><?= $t('services_heading') ?></h2>
			</div>

			<div class="services-trio-grid">
				<?php foreach ($f['featured_services'] ?? [] as $i => $s) : ?>
					<div class="spotlight-card service-card">
						<div class="service-card-top">
							<div class="service-card-num"><?= sprintf('%02d', $i + 1) ?></div>
							<h3><?= esc_html($s['title']) ?></h3>
							<p><?= esc_html($s['text']) ?></p>
						</div>
						<?php if (!empty($s['link']['url'])) : ?>
							<div class="service-card-bottom">
								<a href="<?= esc_url($s['link']['url']) ?>" class="service-link-arrow">
									<span><?= esc_html($s['link']['title']) ?></span>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 04 Portfolio -->
	<section class="section" aria-labelledby="portfolio-heading">
		<div class="container">
			<div class="section-header section-header--wide">
				<span class="eyebrow"><?= $t('portfolio_eyebrow') ?></span>
				<h2 id="portfolio-heading"><?= $t('portfolio_heading') ?></h2>
				<p class="portfolio-intro"><?= $t('portfolio_text') ?></p>
			</div>

			<div class="portfolio-filter-bar" role="toolbar" aria-label="Portfolio category filter">
				<button class="filter-btn is-active" data-filter="all">All Disciplines</button>
				<?php foreach ($cats as $key => $c) : ?>
					<button class="filter-btn" data-filter="<?= esc_attr($key) ?>"><?= esc_html($c[0]) ?></button>
				<?php endforeach; ?>
			</div>

			<div class="portfolio-grid">
				<?php foreach ($f['portfolio_items'] ?? [] as $i => $p) :
					$c = $cats[$p['category']] ?? ['', '']; ?>
					<article class="portfolio-item"
						data-category="<?= esc_attr($p['category']) ?>"
						data-scope="<?= esc_attr($p['scope']) ?>"
						data-location="<?= esc_attr($p['location']) ?>"
						data-typology="<?= esc_attr($p['typology']) ?>"
						data-status="<?= esc_attr($p['status']) ?>"
						data-desc="<?= esc_attr($p['description']) ?>">
						<div class="portfolio-thumb-wrap">
							<?= $img($p['image']) ?>
						</div>
						<div class="portfolio-caption">
							<div class="portfolio-title-group">
								<span class="portfolio-category"><?= sprintf('%02d', $i + 1) ?> &bull; <?= esc_html($c[1]) ?></span>
								<h4><?= esc_html($p['title']) ?></h4>
							</div>
							<div class="portfolio-item-icon" aria-hidden="true">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="7" y1="17" x2="17" y2="7"></line>
									<polyline points="7 7 17 7 17 17"></polyline>
								</svg>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 05 Philosophy + before/after slider -->
	<section class="section section--alt" aria-labelledby="philosophy-heading">
		<div class="container">
			<div class="philosophy-grid">
				<div class="philosophy-text">
					<span class="eyebrow"><?= $t('philosophy_eyebrow') ?></span>
					<h2 id="philosophy-heading"><?= $t('philosophy_heading') ?></h2>
					<p><?= $t('philosophy_text') ?></p>
					<div class="philosophy-quote-box">&ldquo;<?= $t('philosophy_quote') ?>&rdquo;</div>
				</div>

				<div class="philosophy-media">
					<div id="comparison-slider" class="comparison-container" aria-label="Before and after interior transformation slider">
						<div class="comparison-before">
							<?= $img($f['before_image'] ?? 0) ?>
							<span class="comparison-badge comparison-badge--before">Initial Space</span>
						</div>
						<div class="comparison-after">
							<?= $img($f['after_image'] ?? 0) ?>
							<span class="comparison-badge comparison-badge--after">Completed Interior</span>
						</div>
						<div id="comparison-handle" class="comparison-handle" role="slider" tabindex="0"
							aria-label="Drag or use arrow keys to compare before and after interior transformation"
							aria-valuemin="0" aria-valuemax="100" aria-valuenow="50">
							<div class="comparison-handle-knob">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<polyline points="15 18 9 12 15 6"></polyline>
								</svg>
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<polyline points="9 18 15 12 9 6"></polyline>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 06 Riyadh positioning -->
	<section class="section riyadh-section" aria-labelledby="riyadh-heading">
		<div class="container">
			<div class="riyadh-banner-card">
				<div class="riyadh-content">
					<span class="eyebrow"><?= $t('riyadh_eyebrow') ?></span>
					<h2 id="riyadh-heading"><?= $t('riyadh_heading') ?></h2>
					<p><?= $t('riyadh_text') ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 07 Process -->
	<section class="section" aria-labelledby="process-heading">
		<div class="container">
			<div class="section-header">
				<span class="eyebrow"><?= $t('process_eyebrow') ?></span>
				<h2 id="process-heading"><?= $t('process_heading') ?></h2>
			</div>

			<div class="process-grid">
				<?php foreach ($f['process_steps'] ?? [] as $i => $step) : ?>
					<div class="process-step-card">
						<div class="step-num"><?= sprintf('%02d', $i + 1) ?></div>
						<h3><?= esc_html($step['title']) ?></h3>
						<p><?= esc_html($step['text']) ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 08 Client feedback -->
	<section class="section section--alt" aria-labelledby="feedback-heading">
		<div class="container">
			<div class="section-header">
				<span class="eyebrow"><?= $t('feedback_eyebrow') ?></span>
				<h2 id="feedback-heading"><?= $t('feedback_heading') ?></h2>
			</div>

			<div class="trust-grid">
				<?php foreach ($f['testimonials'] ?? [] as $r) : ?>
					<div class="testimonial-card">
						<blockquote class="testimonial-quote">&ldquo;<?= esc_html($r['quote']) ?>&rdquo;</blockquote>
						<div class="testimonial-author">&mdash; <?= esc_html($r['author']) ?></div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="trust-rating-card">
				<div class="trust-rating-left">
					<div class="trust-score-circle"><?= esc_html($site['rating']) ?></div>
					<div>
						<div class="trust-rating-title">Google Rating: <?= esc_html($site['rating']) ?> &starf;</div>
						<div class="trust-rating-desc">Based on the client's provided Google listing information.</div>
					</div>
				</div>
				<div>
					<a href="<?= esc_url($site['map_url']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">View on Google Maps</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 09 Final CTA -->
	<section class="final-cta-section" aria-labelledby="cta-heading">
		<div class="container">
			<div class="final-cta-inner">
				<span class="eyebrow eyebrow--gold"><?= $t('cta_eyebrow') ?></span>
				<h2 id="cta-heading"><?= $t('cta_heading') ?></h2>
				<p><?= $t('cta_text') ?></p>
				<div class="final-cta-buttons">
					<?= $link($f['cta_primary_btn'] ?? null, 'btn btn-primary') ?>
					<a href="tel:<?= esc_attr($site['phone_tel']) ?>" class="btn btn-secondary">Call <?= esc_html($site['phone_display']) ?></a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>