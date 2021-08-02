<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>

<div class="carousel-posts ">
  <div class="carousel-posts__inner owl-carousel">
    <?php foreach ($posts as $key => $post): ?>
      <div class="carousel-posts__item text-center" <?php echo 'style="background-image:url('.$post['image_url'].')"'?>>
        <a href="<?php echo $post['url']; ?>" class="container">
          <div class="spacer-h-100 spacer-h-lg-150"></div>
          <div class="spacer-h-lg-40"></div>
          <div class="badrutts-image">
            <img src="<?php echo THEME_URL?>/assets/images/svg/title2.svg" alt="">
          </div>
          <div class="spacer-h-40"></div>
          <h2 class="carousel-posts__item-title"><?php echo $post['title']; ?></h2>
          <div class="spacer-h-lg-150 spacer-h-100"></div>
          <div class="spacer-h-50"></div>
        </a>
      </div>
    <?php endforeach ?>
  </div>
  <div class="carousel-posts__ctrl visuallyhidden">
    <div class="prev"></div>
    <div class="next"></div>
  </div>
</div>