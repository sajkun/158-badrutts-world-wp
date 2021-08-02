<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */

$obj     = get_queried_object_id();
$json_ld = get_post_meta($obj, 'json_ld', true);
do_action('start_page');
?>
<head>
  <?php
    do_action('theme_start_page_header');
    wp_head();
   ?>
  <title><?php wp_title(' | ', 'echo', 'right'); ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="dns-prefetch" href="//ajax.googleapis.com">
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="dns-prefetch" href="//www.google-analytics.com">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-24164708-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-24164708-1');
    </script>

    <?php if (trim($json_ld) ):
      ?>
      <script type="application/ld+json">
        <?php // echo trim($json_ld); ?>
      </script>
    <?php endif ?>

  <?php
    global $wp;
   ?>

  <link rel="alternate" media="handheld" href="<?php echo home_url( $wp->request ); ?>" />

  <?php
   do_action('do_theme_after_head'); ?>

   <script defer async crossorigin="anonymous" type="text/javascript"
src="https://onboard.triptease.io/bootstrap.js?integrationId=01EV9F6JXS0C43QSGETFQ3ZJJK">
</script>
</head>

<?php

  add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'page' ) );
  } );

?>
<body  <?php body_class(); ?>>



