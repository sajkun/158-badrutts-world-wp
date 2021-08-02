<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}



add_action('vc_before_init', 'vc_before_init_vimeo_bg');

class WPBakeryShortCode_theme_vimeo_bg extends WPBakeryShortCode {
   protected function content( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'video_url' => false,
    ), $atts ) );

      if (!$video_url) {
        return;
      }

      if(wp_is_mobile()){
        return;
      }

      $block_id = md5($video_url);
    ?>
      <div class="video-vimeo" id="<?php echo $block_id?>" data-video="<?php echo $video_url?>"></div>

      <style id="iframe-styling">
        iframe{
          display:none !important
        }
        iframe.show{
          display: block!important;
        }
      </style>
      <script src="https://player.vimeo.com/api/player.js"></script>
      <script>
        jQuery(document).ready(function(){
          jQuery('#<?php echo $block_id ?>').closest('section').append('<div class="vimeo-iframe"><iframe class="_vimeo-iframe" src="<?php echo $video_url; ?>?background=1&autoplay=1&controls=0&loop=1&quality=1080p" frameborder="0" allow="autoplay" ></iframe></div>');
            var iframe = jQuery(document.body).find('._vimeo-iframe');
            var player = new Vimeo.Player(iframe[0]);

            iframe.on('loaded', function(){
              console.log('show');
              iframe.addClass('show')
            });

            player.on('progress', function(data) {
              jQuery('#iframe-styling').remove();
            });
        })
      </script>
    <?php
  }
}

function vc_before_init_vimeo_bg(){
  $values = [];

  foreach (wp_get_nav_menus( array() ) as $key => $menu) {
    $values[$menu->name] = $menu->term_id;
  }

  $args =  array(
    'base' => 'theme_vimeo_bg',
    'name' => __( 'Vimeo background for sections', 'theme-translation' ), // translated
    'class' => '',
    'category' => __( 'Theme Shortcodes' ),
    'icon' => THEME_URL.'/assets/images/icons/vimeo.png',
    'show_settings_on_create' => true,
    'params' => array(
        array(
          'type' => 'textfield',
          "heading" => __('Vimeo Link', 'theme-translation'), // translated
          "description" => 'Url of a video should have view: https://player.vimeo.com/video/{video_id}',
          'param_name' => 'video_url',
        ),
    ),
  );

  vc_map($args);
}
