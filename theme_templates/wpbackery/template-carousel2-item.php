<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>

<div class="tower-item">
  <div class="border-1"></div>
  <div class="border-2"></div>
  <div class="border-3"></div>
  <div class="border-4"></div>
    <div class="tower-item__image">
       <?php if ( $url ): ?>
       <a href="<?php echo $url ?>">
        <?php endif ?>
        <img src="<?php echo $image ?>" alt="<?php echo $title ?>">
       <?php if ( $url ): ?>
      </a>
      <?php endif ?>
    </div>

    <div class="tower-item__content  <?php echo $position ?>">
      <p class="tower-item__title text-center"><?php echo $title ?>
        </p>
      <p class="tower-item__spacer"></p>
      <div class="tower-item__text">
          <?php echo $text ?>
      </div>

      <?php if ($button_pos == 'in'): ?>
        <a href="<?php echo $url ?>" class="tower-item__button <?php echo $button_pos ?>"
         <?php
         foreach ($link_data as $attr => $value):
          if(!$value || $attr == 'url'){continue;}
           printf(' %s="%s" ', $attr, $value);
          endforeach; ?>
          ><?php echo $button_title ?></a>
      <?php endif ?>
    </div>
    <?php if ($button_pos == 'out'): ?>
    <a href="<?php echo $url ?>" class="tower-item__button <?php echo $button_pos ?>"
     <?php
     foreach ($link_data as $attr => $value):
      if(!$value || $attr == 'url'){continue;}
       printf(' %s="%s" ', $attr, $value);
      endforeach; ?>
      ><?php echo $button_title ?></a>
    <?php endif ?>
</div>