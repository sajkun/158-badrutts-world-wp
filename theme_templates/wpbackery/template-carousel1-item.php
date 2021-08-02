<?php

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}
?>

<div class="carousel-book-item">
  <div class="carousel-book-item__header">
    <a
      <?php if (isset($link_data)):
       foreach ($link_data as $attr => $value):
        if(!$value || $attr == 'url'){continue;}
         printf(' %s="%s" ', $attr, trim($value));
        endforeach;
       endif ?>
    href="<?php echo $url;?>"><?php echo $title;?></a>
  </div>
  <div class="carousel-book-item__image">
    <a
     <?php if (isset($link_data)):
       foreach ($link_data as $attr => $value):
        if(!$value || $attr == 'url'){continue;}
         printf(' %s="%s" ', $attr, trim($value));
        endforeach;
       endif ?>
     href="<?php echo $url;?>">
      <img src="<?php echo $image;?>" alt="<?php echo $title;?>">
    </a>
  </div>
</div>