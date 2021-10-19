<?php
$title = get_field('edge_title');
$descr = get_field('edge_descr');
$link = get_field('edge_link');
$circles_text = get_field('edge_circles_text');
?>

<section class="section bg_2_mod offset_2_mod sectionAnimEl" data-section-name="connectedData">
  <div class="connected_data_decor_image">
    <img class="cover_img" src="<?php bloginfo('template_url') ?>/imgs/connected_data_decor.svg" alt="">
  </div>
  <div class="section_col_w">
    <div class="section_col offset_2_mod">
      <div class="section_content">
        <?php if ($title) { ?>
          <h2 class="section_title offset_1_mod"><?php echo $title; ?></h2>
        <?php }; ?>
        <?php if ($descr) { ?>
          <div class="section_descr offset_1_mod">
            <?php echo $descr; ?>
          </div>
        <?php }; ?>
        <?php if ($link) {
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
          <a class="base_link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><span class="base_link_title"><?php echo esc_html($link_title); ?></span></a>
        <?php }; ?>
      </div>
    </div>
    <?php if ($circles_text) { ?>
      <div class="section_col width_2_mod">
        <div class="connected_data_image_w">
          <div class="connected_data_image">
            <img class="connected_data_image_in" src="<?php bloginfo('template_url') ?>/imgs/data_logo.svg" alt="">
          </div>
          <div class="connected_data_text_w">
            <?php foreach ($circles_text as $key => $circles_text_item) {
              $index = $key + 1;
            ?>
              <div class="connected_data_text v<?php echo $index; ?>_mod">
                <span class="connected_data_text_in">
                  <?php echo $circles_text_item['circles_text_item']; ?>
                </span>
              </div>
            <?php }; ?>
          </div>
        </div>
      </div>
    <?php }; ?>
  </div>
</section>