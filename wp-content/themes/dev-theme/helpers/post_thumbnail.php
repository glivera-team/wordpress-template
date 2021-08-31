<?php 
//---Выводит html код картинки-миниатюры текущего поста.
//---получить
get_the_post_thumbnail()

//--использование
the_post_thumbnail( $size, $attr );

the_post_thumbnail('full', array(
                'src'   => $src,
                'class' => 'section_img',
                'alt'   => 'background'
              ));