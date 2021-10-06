<?php
$image = get_field('hero_image') ?: 'Your title here...';
$title = get_field('hero_title') ?: 'Your subtitle here...';
$subtitle = get_field('hero_subtitle') ?: 'Your text here...';
$text = get_field('hero_text');
?>

<section class="section decor_mod offset_2_top">
	<div class="section_in">
		<div class="hero">
			<div class="hero_col">
				<?php if ( $image ) { ?>
					<div class="hero_img_w v2_mod">
						<img class="hero_img section_bg"
								 src="<?php echo esc_url( $image['url'] ); ?>"
								 alt="<?php echo esc_attr( $image['alt'] ); ?>">
					</div>
				<?php } ?>
			</div>

			<div class="hero_col">
				<div class="hero_text">
					<h2 class="section_title left_lvl_mod offset_v2_mod"><?php echo $title; ?></h2>
					<h3 class="section_subtitle offset_mod"><?php echo $subtitle; ?></h3>
					<div class="section_descr font_mod"><?php echo $text; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<?php //}