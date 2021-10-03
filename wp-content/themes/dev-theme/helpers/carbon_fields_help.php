<?php
echo '<pre>';
print_r(carbon_get_post_meta(get_the_ID(), 'slug'));
exit;

get_post_meta(get_the_ID(), '_slug', true);
carbon_get_post_meta(get_the_ID(), 'slug');
$address_lines = carbon_get_theme_option( 'crb_addresses' );

echo wp_get_attachment_image(651, 'full', false, array(
  'src'   => $src,
  'class' => 'section_img',
  'alt'   => 'background'
));
//(thumbnail, medium, large или full)
?>
<picture>
  <?php $img_webp = $item['img_webp'];
  if ($img_webp) {
  ?>
    <source srcset="<?php echo $img_webp; ?>" type="image/webp">
  <?php }; ?>
  <?php
  echo wp_get_attachment_image($item['img'], 'full', false, array(
    'class' => 'advantages_item_img',
  ));
  ?>
</picture>

<?php
$slider_slides = carbon_get_post_meta(get_the_ID(), 'hero_slider');
if ($slider_slides) {
?>

  <?php foreach ($slider_slides as $key => $slide) { ?>
    <div class="hero_item">
      <a class="hero_item_in" href="<?php echo $slide['link']; ?>">
        <div class="hero_bg_w">
          <picture>
            <?php
            $img_webp = $item['img_webp'];
            if ($img_webp = $slide['img_webp']) {
            ?>
              <source srcset="<?php echo $img_webp; ?>" type="image/webp">
            <?php }; ?>
            <?php
            echo wp_get_attachment_image($slide['img'], 'full', false, array(
              'class' => 'hero_bg',
            ));
            ?>
          </picture>
        </div>
        <div class="hero_content">
          <div class="hero_title"><?php echo $slide['title']; ?></div>
          <div class="hero_price">
            <div class="hero_price_value"><?php echo $slide['price_value']; ?></div>
            <div class="hero_price_span"><?php echo $slide['price_span']; ?></div>
          </div>
        </div>
      </a>
    </div>

  <?php } ?>
<?php }; ?>
<?php





?>