<?php
if ($logo) { ?>
	<?php if (is_front_page() || is_home()) { ?>
		<div class="header_logo_w">
			<img class="header_logo" src="<?php echo $logo; ?>" alt="logo" />
		</div>
	<?php } else { ?>
		<a class="header_logo_w" href="<?php echo home_url(); ?>">
			<img class="header_logo" src="<?php echo $logo; ?>" alt="logo" />
		</a>
	<?php }; ?>
<?php }; ?>