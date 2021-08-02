<?php

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}
?>

<div class="carousel-mount__item">
  <div class="border-1"></div>
  <div class="border-2"></div>
  <div class="border-3"></div>
  <div class="border-4"></div>
  <?php if ( $more_url ): ?>
  <a href="<?php echo $more_url ?>" class="carousel-mount__item-image">
    <?php else: ?>
  <div class="carousel-mount__item-image">
  <?php endif ?>
    <img src="<?php echo $image_url ?>" alt="">
  <?php if ( $more_url ): ?>
  </a>
  <?php else: ?>
  </div>
  <?php endif ?>
  <div class="carousel-mount__item-content">
    <h3 class="carousel-mount__item-title text-center"><?php echo $title ?></h3>
    <p class="carousel-mount__item-text text-center"><?php echo $text ?></p>
    <div class="row valign-center justify-content-center">
      <?php if ( $more_url ): ?>
      <div class="col-12 col-sm-5 text-center <?php if($book_url ): ?> text-left-sm <?php endif; ?>">
        <a href="<?php echo $more_url ?>"
         <?php
         foreach ($more_data as $attr => $value):
          if(!$value || $attr == 'url'){continue;}
           printf(' %s="%s" ', $attr, $value);
          endforeach; ?>
          class="carousel-mount__item-button no-float">
          <?php _e('Discover Now','theme-translations'); ?></a>
      </div>
      <?php endif ?>
      <?php if ( $more_url &&  $book_url ): ?>
      <div class="col-1 text-center"><p>or</p><div class="spacer-h-10"></div></div>
      <?php endif ?>

      <?php if ( $book_url ): ?>
      <div class="col-12 col-sm-5 text-center <?php if($book_target ): ?> text-right-sm <?php endif; ?>">
        <a href="<?php echo $book_url ?>"
         <?php
         foreach ($book_data as $attr => $value):
          if(!$value || $attr == 'url'){continue;}
           printf(' %s="%s" ', $attr, $value);
          endforeach; ?>
         class="carousel-mount__item-button no-float">
          <?php _e('Book Now','theme-translations'); ?></a>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>