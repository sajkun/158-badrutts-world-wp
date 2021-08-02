<?php
get_header();
?>
<div class="site-container <?php echo apply_filters('theme_site_container_styles', $data); ?>" id="site-body">
  <?php
    do_action('do_theme_before_header');
    do_action('do_theme_header');
    do_action('do_theme_after_header');
?>
    <main class="site-inner">
<?php
  ?>
    <div class="error-page">
       <div class="container">
          <div class="spacer-h-40 spacer-h-lg-120"></div>
          <h1 class="section-title text-center">404 <?php _e('Page Not Found','themes-translations');?></h1>

          <h2 class="section-comment text-center"><?php _e('It looks like you are lost','themes-translations'); ?>...<?php _e('let us help you find your way','themes-translations'); ?>...</h2>

          <p class="regular-text text-center">
            <?php _e('The page you requested no longer exists or has never existed under this address','themes-translations'); ?>
            <?php _e('If you tried to access this page through bookmarks, please remove or correct the corresponding entry','themes-translations'); ?>

            <span class="spacer-h-30"></span>
          </p>

          <div class="text-center">
            <a href="<?php echo HOME_URL; ?>" class="regular-link"> <b>></b> <?php _e('Homepage','themes-translations');?></a>
          </div>
          <div class="spacer-h-40 spacer-h-lg-120"></div>
        </div>
    </div>

  </main>
<?php

    do_action('do_theme_before_footer');
    do_action('do_theme_footer');
    do_action('do_theme_after_footer');
  ?>
</div>

<?php
 ?>

<?php get_footer(); ?>

