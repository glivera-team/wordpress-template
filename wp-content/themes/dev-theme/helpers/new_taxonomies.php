<?php

/*Создание произвольного типа записи start*/
add_action('init', 'true_register_post_type_init'); // Использовать функцию только внутри хука init

function true_register_post_type_init()
{
    $labels = array(
        'name' => 'Работа',
        'singular_name' => 'Работа', // админ панель Добавить->Функцию
        'add_new' => 'Добавить работу',
        'add_new_item' => 'Добавить работу', // заголовок тега <title>
        'edit_item' => 'Редактировать работу',
        'new_item' => 'Новая работа',
        'all_items' => 'Все работы',
        'view_item' => 'Просмотр работ на сайте',
        'search_items' => 'Искать работы',
        'not_found' =>  'Работ не найдено.',
        'not_found_in_trash' => 'В корзине нет работ.',

        'menu_name' => 'Работы' // ссылка в меню в админке

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'menu_position' => 4, // порядок в меню
        //'supports' => array('title', 'editor', 'comments', 'author', 'thumbnail')
        'supports' => array('title', 'editor'),
        // 'taxonomies' => array('gallery')
    );
    register_post_type('work', $args);
}


/*Создание произвольного типа записи end*/

/* Произвольная таксономия "Галерея" START*/
function add_new_taxonomies()
{
    register_taxonomy(
        'gallery',
        array('work'),
        array(
            'hierarchical' => false,
            'labels' => array(
                'name' => 'Галерея',
                // 'singular_name' => 'Разработчик',
                // 'search_items' =>  'Найти разработчика',
                // 'popular_items' => 'Популярные разработчики',
                // 'all_items' => 'Все разработчики',
                'parent_item' => null,
                'parent_item_colon' => null,
                // 'edit_item' => 'Изменить разработчика',
                // 'update_item' => 'Обновить разработчика',
                // 'add_new_item' => 'Добавить нового разработчика',
                // 'new_item_name' => 'Название нового разработчика',
                // 'separate_items_with_commas' => 'Разделяйте разработчиков запятыми',
                // 'add_or_remove_items' => 'Добавить или удалить разработчика',
                // 'choose_from_most_used' => 'Выбрать из наиболее часто используемых разработчиков',
                'menu_name' => 'Галерея'
            ),
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => true,
        )
    );
}
add_action('init', 'add_new_taxonomies', 0);

/* Произвольная таксономия "Галерея" END*/

/* Произвольная таксономия "Товары" START*/
function add_new_taxonomies_goods()
{
    register_taxonomy(
        'goods',
        array('post'),
        array(
            'hierarchical' => false,
            'labels' => array(
                'name' => 'Товары',
                'parent_item' => null,
                'parent_item_colon' => null,
                'menu_name' => 'Товары'
            ),
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => true,
        )
    );
}
add_action('init', 'add_new_taxonomies_goods', 0);

/* Произвольная таксономия "Товары" END*/