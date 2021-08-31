<?php
	$favicon = get_field( 'favicon', 'option' );
	if ( $favicon ) : ?>
		<link rel="icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
	<?php endif; ?>