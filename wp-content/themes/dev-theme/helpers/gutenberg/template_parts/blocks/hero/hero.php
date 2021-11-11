<?php if (isset($block['data']['preview_img'])) { ?>
  <?php echo MTDBlocks::get_block_preview($block); ?>
<?php } else { ?>
  <?php
  $title_second_part = get_field('title_second_part');
  $descr = get_field('descr');
  $btn_link = get_field('btn_link');
  $circle_text_link = get_field('circle_text_link');
  ?>
  <section class="section hero_mod">
    <div class="section_in">
      <h2 class="section_title lg_mod offset_v12_mod v1_mod offset_side_mod"><span class="splitTitle"> <?php the_field('title_first_part'); ?> </span>
        <?php if ($title_second_part) { ?>
          <span class="section_title_lines">
            <?php foreach ($title_second_part as $item) { ?>
              <div class="section_title_lines_in titleLine"> <?php echo $item['text_item']; ?> </div>
            <?php }; ?>
          </span>
        <?php }; ?>
        <div class="title_decor scaleEl"></div>
      </h2>
      <div class="hero_block fadeEl">

        <div class="hero_col sm_mod">
          <a class="hero_round_link" href="<?php echo $circle_text_link; ?>">
            <div class="hero_round_title"><?php the_field('circle_text_title'); ?></div>
            <div class="hero_round_text"><?php the_field('circle_text_descr'); ?></div>
          </a>
        </div>

        <div class="hero_col">

          <div class="section_descr sm_mod offset_3_mod">
            <?php echo $descr; ?>
          </div>

          <div class="hero_started_w">
            <div class="hero_started_subtitle"><?php the_field('btn_subtitle'); ?></div>
            <a class="hero_started_link btn_base_1 color_mod" href="<?php echo $btn_link; ?>">
              <div class="hero_started_link_bg magneticLink">
                <div class="hero_started_link_text"><?php the_field('btn_title'); ?></div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>