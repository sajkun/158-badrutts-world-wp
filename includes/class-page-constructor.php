<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
//***
/**
  * Page Construct Class
  *
  * Constructs page
  *
  * @package theme/helper
  *
  * @since v1.0
  */
class theme_construct_page{

  /**
  * Adds hooks for wordpress template
  * Used templates: index.php
  *
  * @return void
  */
  public static function init(){

    if (self::is_page_type('tower_revenue')) {
      add_action('do_theme_header', array('theme_content_output', 'print_header_tower'));
      // add_action('do_theme_footer', array('theme_content_output', 'print_footer_tower'));
      add_action('do_theme_content', array('theme_content_output', 'print_tower_revue'));
    }else{
      add_action('do_theme_header', array('theme_content_output', 'print_header'));
      add_action('do_theme_footer', array('theme_content_output', 'print_footer'));
      add_action('do_theme_after_footer', array('theme_content_output', 'print_menu_mobile'));
      add_action('do_theme_after_footer', array('theme_content_output', 'print_cookie_text'));
      add_action('do_theme_after_footer', array('theme_content_output', 'print_messages'));

      if (self::is_page_type('blog')) {
        add_action('do_theme_content', array('theme_content_output', 'print_blog_list'));
      }else if(self::is_page_type('blog-post')){
        add_action('do_theme_content', array('theme_content_output', 'print_blog_post'));

      }else{
        add_action('do_theme_content', array('theme_content_output', 'print_content_page'));
      }
    }


  }


  /**
  * Detects what page is currently loaded
  *
  * @return bool
  */
  public static function is_page_type( $type ){
    $obj = get_queried_object();

    switch ($type){
      case 'blog':
        return is_home();
        break;
      case 'fronted-page':
        return is_front_page();
        break;
      case 'blog-category':
        return is_category();
        break;
      case 'blog-post':
        return (is_single() && ('post' === $obj->post_type));
        break;
      case 'theme_room':
        return (is_single() && ('theme_room' === $obj->post_type));
        break;
      case 'post-tag':
        return is_tag();
        break;
      case 'tower_revenue':

        $tower_page_id = (int)get_option('theme_page_tower_revenue');

        return ('page' === $obj->post_type && ($obj->ID ==  $tower_page_id || $obj->ID == pll_get_post( $tower_page_id)));
        break;
    }
  }
}