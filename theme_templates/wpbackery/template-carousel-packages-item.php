
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
  <a href="<?php echo $more_url; ?>"
    <?php foreach ($more_data as $attr => $value):
        if(!$value || $attr =='url'){continue;}
          printf('%s="%s"', $attr, $value);
        endforeach; ?>
     class="carousel-mount__item-image">
    <img src="<?php echo $image_url; ?>" alt="">
  </a>
  <div class="carousel-mount__item-content">
    <?php if ($book_url): ?>
    <a href="<?php echo $book_url; ?>"
     <?php
     foreach ($book_data as $attr => $value):
      if(!$value || $attr == 'url'){continue;}
       printf(' %s="%s" ', $attr, $value);
      endforeach; ?>
     class="carousel-mount__item-button desktop"><?php _e('Book Now', 'theme-translations'); ?></a>
    <?php endif ?>

    <p class="carousel-mount__item-title"><?php echo $title; ?></p>

    <?php if ($book_url): ?>

    <a href="<?php echo $book_url; ?>"
       <?php echo $book_target ?>
       <?php foreach($book_data as $attr => $value):
        if(!$value || $attr == 'url'){continue;}
          printf('%s="%s"', $attr, $value);
        endforeach; ?>
        class="carousel-mount__item-button mobile"
     > <?php _e('Book Now', 'theme-translations'); ?></a>
    <?php endif ?>

    <?php if ($more_url): ?>
    <a class="carousel-mount__item-more" href="<?php echo $more_url; ?>"
       <?php foreach ($more_data as $attr => $value):
        if(!$value || $attr == 'url'){continue;}
          printf('%s="%s"', $attr, $value);
        endforeach; ?>
    > <?php _e('Learn More', 'theme-translations'); ?> ></a>
    <?php endif ?>
  </div>
</div>