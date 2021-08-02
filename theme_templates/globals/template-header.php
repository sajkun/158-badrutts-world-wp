<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>
<header class="<?php echo $class?>">
  <div class="mobile-grey hidden">
    <div class="container z10">
      <div class="row">
        <div class="col-6">
          <div class="lang-switcher lang-switcher_mobile">
            <?php theme_print_lang_switcher('mobile') ?>
          </div>
        </div>

          <div class="col-6 text-right">

            <span class="weather">
         </span>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-white">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-5 tablet-hide">
          <span class="weather"> </span>
        </div>

        <div class="col-12 col-lg-2">
          <?php echo $logo; ?>
          <?php echo $logo_mobile ?>
         <span class="mobile-menu-toggle equis">
           <span class="mobile-switcher__inner"></span>
         </span>
        </div>
        <div class="col-12 col-lg-5 text-right-sm tablet-hide">
          <?php echo $secondary_menu; ?>
        </div>
      </div>
    </div><!-- container -->
  </div><!-- mobile-white -->
  <div class="spacer-h-30 tablet-hide"></div>
     <?php $detect = new Mobile_Detect();
    if (!$detect->is_mobile() || $detect->is_tablet() && $main_menu):
      ?>
  <div class="container tablet-hide">
    <?php echo $main_menu ?>
  </div>
  <?php endif ?>
</header>

<?php if ($spacer): ?>
  <div class="spacer-header"></div>
<?php endif ?>