<?php
  $tabs = get_field('wonders_tabs');
?>

<div class="wonders desktop_mod">
  <div class="wonders_tabs_menu_wrap">
    <ul class="wonders_tabs_list">
      <?php foreach ($tabs as $key=>$tab) { ?>
        <li class="wonders_tabs_item">
          <span class="wonders_tabs_link wondersTabSwtichButton <?php if ($key == 0) { ?>active_tab<?php } ?>" data-tab="<?php echo $key; ?>">
            <span><?php echo $tab['tab_nav_title']; ?></span>
          </span>
        </li>
      <?php } ?>
    </ul>
  </div>
  <div class="wonders_tabs_content_wrap">
    <?php foreach ($tabs as $key=>$tab) { ?>
      <?php
        $title = $tab['tab_title'];
        $subtabs = $tab['tab_subtabs'];
        $single_content = $tab['single_content'];
        $display = $tab['content_display'];
      ?>
      <div class="wonders_tabs_content wondersMainTab<?php if ($key == 0) { ?> active_tab<?php } ?>" data-tab="<?php echo $key; ?>">
        <div class="wonders_head">
          <div class="section_title size_mod color_gr_mod center_mod "><?php echo $title; ?></div>
        </div>
        <div class="wonders_subtab_content_w">
          <?php if ($subtabs && $display == "Sub tabs") { ?>
            <?php foreach ($subtabs as $key=>$subtab) { ?>
              <?php
                $subbg = $subtab['image'];
                $bg = $subbg['image_img'];
                $bg_webp = $subbg['image_img_webp'];
              ?>
              <?php if ($bg) { ?>
                <div class="wonders_subtab_bg wonders_subtabs_content<?php if ($key == 0) { ?> active_tab<?php } ?>" data-tab="<?php echo $key; ?>">
                  <?php picture($bg, $bg_webp, 'contain_img', 'cover_img'); ?>
                </div>
              <?php } ?>
            <?php } ?>
            <div class="wonders_subtabs_menu_wrap">
              <ul class="wonders_subtabs_list">
                <?php foreach ($subtabs as $key=>$subtab) { ?>
                  <?php
                    $subnav = $subtab['subtab_nav'];
                  ?>
                  <li class="wonders_subtabs_item">
                    <span class="wonders_subtabs_link wondersInnerTabSwtichButton <?php if ($key == 0) { ?>active_tab<?php } ?>" data-tab="<?php echo $key; ?>">
                      <span><?php echo $subnav; ?></span>
                    </span>
                  </li>
                <?php } ?>
              </ul>
            </div>

            <?php foreach ($subtabs as $key=>$subtab) { ?>
              <?php
                $subdescr = $subtab['description'];
                $subbtn = $subtab['btn'];
                $subimg_w = $subtab['bg'];
                $subimg = $subimg_w['bg_img'];
                $subimg_webp = $subimg_w['bg_img_webp'];
              ?>
              <div class="wonders_subtabs_content <?php if ($key == 0) { ?>active_tab<?php } ?>" data-tab="<?php echo $key; ?>">
                <?php picture($subimg, $subimg_webp, 'cover_img', 'wonders_picture'); ?>
                <div class="wonders_subtabs_content_descr_w">
                  <div class="swonders_subtabs_descr"><?php echo $subdescr; ?></div>
                </div>
                <a class="wonders_subtabs_content_btn_w" href='<?php echo $subbtn['link']; ?>'>
                  <div class="btn_base"><?php echo $subbtn['text']; ?></div>
                </a>
              </div>
            <?php } ?>
          <?php } ?>
          <?php if ($single_content && $display == 'Single content') { ?>
            <?php
              $single_title = $single_content['title'];
              $descr = $single_content['descr'];
              $bg = $single_content['bg'];
              $image = $bg['image'];
              $image_webp = $bg['image_webp'];
              $btn = $single_content['btn'];
              $btn_text = $btn['text'];
              $btn_link = $btn['link'];
            ?>
            <?php picture($image, $image_webp, 'cover_img', 'wonders_picture'); ?>
            <div class="wonders_subtabs_single_content">
              <div class="wonders_subtabs_content_title_w">
                <div class="wonders_subtabs_title"><?php echo $single_title; ?></div>
              </div>
              <div class="wonders_subtabs_content_descr_w">
                <div class="swonders_subtabs_descr"><?php echo $descr; ?></div>
              </div>
              <div class="wonders_subtabs_content_btn_w" href='<?php echo $btn_link; ?>'>
                <div class="btn_base"><?php echo $btn_text; ?></div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>