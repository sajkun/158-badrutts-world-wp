<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>
<div class="hotel-item row no-gutters">
  <div class="col-12">
    <?php if ($image_url): ?>
    <div class="hotel-item__image">
      <?php if ($button_url): ?>
      <a href="<?php echo $button_url ?>"
        <?php if (isset($link_data)):
         foreach ($link_data as $attr => $value):
          if(!$value || $attr == 'url'){continue;}
           printf(' %s="%s" ', $attr, trim($value));
          endforeach;
         endif ?>
         >
      <?php endif ?>
        <img src="<?php echo $image_url; ?>" alt="<?php echo $title ?>">
      <?php if ($button_url): ?>
      </a>
      <?php endif ?>
    </div>
    <?php endif ?>
  </div>
  <div class="col-12 text-center">
    <?php if ($category || $title || $button_title): ?>
    <div class="hotel-item__content">
      <div class="hotel-item__content-inner">
      <div class="spacer-h-30"></div>
        <?php if ($category): ?>
         <p class="hotel-item__categories"><?php echo $category ?></p>
        <?php endif ?>
        <?php if ($title): ?>
          <<?php echo $title_tag ?> class="hotel-item__title"><?php echo $title ?></<?php echo $title_tag ?>>
          <div class="spacer-h-40"></div>
        <?php endif ?>
        <?php if ($text): ?>
          <div class="hotel-item__text"><?php echo $text ?></div>
        <?php endif ?>

        <?php if ($button_title || $button_title2): ?>
          <div class="spacer-h-40"></div>
        <?php endif ?>

        <?php if ($button_title): ?>
          <a href="<?php echo $button_url ?>"

           <?php echo $button_params; ?>

           <?php if ($second_anchor): ?>
            data-anchor="<?php echo ($second_anchor); ?>"
           <?php endif ?>

            <?php if (isset($link_data)):
             foreach ($link_data as $attr => $value):
              if(!$value || $attr == 'url'){continue;}
               printf(' %s="%s" ', $attr, trim($value));
              endforeach;
             endif ?>
            class="hotel-item__button"><?php echo $button_title ?></a>
        <?php endif ?>
        <?php if ($button_title2): ?>
          <a href="<?php echo $button_url2 ?>"
            <?php if (isset($link_data2)):
             foreach ($link_data2 as $attr => $value):
              if(!$value || $attr == 'url'){continue;}
               printf(' %s="%s" ', $attr, trim($value));
              endforeach;
             endif ?>
           class="hotel-item__button"><?php echo $button_title2 ?></a>
        <?php endif ?>
        <?php if ($button_title || $button_title2): ?>
          <div class="spacer-h-40"></div>
        <?php endif ?>
      </div>
    </div>
        <?php endif ?>
  </div>
</div><!-- hotel-item -->
