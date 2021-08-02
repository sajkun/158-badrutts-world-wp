<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
add_action('vc_before_init', 'vc_before_init_posts_carousel');

function vc_before_init_posts_carousel(){
  $posts = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
  ));

  foreach ($posts as $key => $post) {
    $values[$post->post_title] = $post->ID;
  }


  vc_map( array(
    "name" => __("Carousel of Posts", "theme_translations"),
    "base" => "posts_carousel",
    'category' => __( 'Theme Shortcodes' ),
    'description' =>__("A carousel with selected posts. Fullscreen view", "theme-translations"),
    'icon' => THEME_URL.'/assets/images/icons/carousel_room_1.png',
    "params" => array(
        array(
          'type' => 'dropdown_multi',
          "heading" => __('Select categories', 'theme-translation'),
          'param_name' => 'post_ids',
          'value' => $values,
        ),
      ),
    ) );

}

if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_posts_carousel extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'post_ids'        => '',
      ), $atts ) );

      $post_ids = explode(',', $post_ids);

      $args = array(
        'posts_per_page' => -1,
        'post_type' => 'post',
        'post__in' => $post_ids,
      );

      $posts = get_posts($args);


      $posts = array_map(function($post){
        $image_id = get_post_thumbnail_id( $post->ID );
        $image_url = wp_get_attachment_image_url( $image_id, 'full');

        return array(
          'image_url' => $image_url,
          'url' => get_permalink($post),
          'title' => $post->post_title,
        );

      }, $posts);

      clog($posts);

      $args = array(
        'posts' => $posts,
      );

      ob_start();

      echo print_theme_template_part('carousel-posts', 'wpbackery', $args);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
  }
}