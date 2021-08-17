<?php wp_enqueue_script('main');
	    wp_localize_script( 'main', 'themeUrl', get_template_directory_uri() );

      // В итоге, непосредственно перед вставкой файла main.js, функция добавит следующий код

      // var themeUrl = {"путь к теме"};