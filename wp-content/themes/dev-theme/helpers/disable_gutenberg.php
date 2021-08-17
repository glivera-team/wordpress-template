<?php
//-----------------------------disable gutenberg
add_filter('use_block_editor_for_post', 'my_disable_gutenberg', 10, 2);

function my_disable_gutenberg()
{
	return false;
}