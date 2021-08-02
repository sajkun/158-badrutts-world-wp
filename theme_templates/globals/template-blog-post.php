<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
  global $post;
  $date = new DateTime($post->post_date);
?>
<div class="container">
  <div class="spacer-h-30 spacer-h-md-80"></div>
  <div class="text-center badrutts-image">
    <img src="<?php echo THEME_URL;?>/assets/images/svg/title2.svg" alt="">
  </div>

  <div class="spacer-h-20"></div>

  <div class="text-center">
    <h2 class="section-title"><?php _e('News', 'theme-translations'); ?></h2>
  </div>

  <div class="spacer-h-30 spacer-h-md-60"></div>

  <div class="blog-post">
    <div class="blog-post__image">
      <img src="<?php echo $image_url; ?>" alt="">
    </div>

    <div class="spacer-h-30 spacer-h-md-50"></div>

    <div class="row">
      <div class="col-md-2 hide-mobile">
        <a href="javascript:void(0)" onclick="history.back()" class="blog-post__back">< Back</a>
      </div>
      <div class="col-12 col-md-8">
        <p class="blog-post__date">
          <?php echo $date->format("d F Y") ?>
        </p>
        <h2 class="blog-post__title">
          <?php echo $post->post_title; ?>
        </h2>

        <div class="blog-post__content">
          <?php the_content();?>
        </div>

        <div class="spacer-h-50"></div>
      </div>
    </div>
  </div>
</div>