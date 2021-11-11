<?php
$post_number = get_field('post_number');
if (!$post_number) $post_number = 9;
$post_type = get_post_type();
$post_tags = get_the_tags();
?>

<?php
$args = array(
  'post_status' => 'publish',
  'post_type' => array('post', 'story'),
  'posts_per_page' => 4,
  'orderby'      => 'date',
  'order'        => 'DESC',
  'paged'          => get_query_var('page'),
  // 'meta_query'  => array(
  //   array(
  //     'key'     => 'archived',
  //     'value'      => 1,
  //     'compare'   => '=',
  //   )
  // )
);
$posts = null;
$posts = new WP_Query($args);

if ($posts->have_posts()) {
?>
  <section class="section">
    <div class="section_in">
      <div class="preview">
        <?php while ($posts->have_posts()) {
          $posts->the_post(); ?>
          <div class="preview_item">
            <div class="preview_item_in">
              <div class="preview_item_img_w">
                <?php the_post_thumbnail('full', array(
                  'class' => 'preview_item_img'
                )); ?>
              </div>
              <div class="preview_item_content">
                <h3 class="section_title offset_mod">
                  <a href="<?php the_permalink(); ?>" class="title_link"><?php the_title() ?></a>
                </h3>
                <ul class="preview_item_info">
                  <?php $author = ecomet_get_the_post_author($post->ID); ?>
                  <?php if ($author) { ?>
                    <li class="preview_item_info_text"><?php echo $author; ?></li>
                  <?php } ?>
                  <li class="preview_item_info_text"><?php echo get_the_date(); ?></li>
                  <li class="preview_item_info_text"><?php echo ecomet_get_read_time(get_the_content()) ?></li>
                </ul>
                <div class="preview_item_descr"><?php the_excerpt(); ?></div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php wp_reset_postdata(); ?>
        <div class="pagination_list">
          <?php
          echo paginate_links([
            'current' => max(1, get_query_var('page')),
            'total'   => $posts->max_num_pages,
            'prev_text'    => __('Previous'),
            'next_text'    => __('Next'),
            'show_all'     => true,
          ]);
          ?>
        </div>
      </div>
    </div>
  </section>
<?php }
