<?php
$currentlang = get_bloginfo('language');

if ($currentlang == "uk") {
  echo do_shortcode('[contact-form-7 id="285" title="Callback popup Uk"]');
} else {
  echo do_shortcode('[contact-form-7 id="241" title="Callback popup"]');
}


$langs_array = pll_the_languages(array('raw' => 1));

if ($langs_array) { ?>
  <div class="header_lang">
    <?php foreach ($langs_array as $lang) { ?>
      <?php $lang_title = $lang['slug'] == 'ru' ? 'РУС' : 'УКР' ?>
      <?php if ($lang['current_lang']) { ?>
        <div class="header_lang_item current_mod"><?php echo $lang_title; ?></div>
      <?php } else { ?>
        <a class="header_lang_item" href="<?php echo $lang['url']; ?>"><?php echo $lang_title; ?></a>
      <?php } ?>
    <?php } ?>
  </div>
<?php } ?>