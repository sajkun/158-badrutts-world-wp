<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
/**
* Class that used to add different filters to theme
*
* @package theme/helpers
*/

class theme_filter_class{

  public function __construct(){
    add_filter( 'yoast_seo_development_mode', '__return_true' );
    add_filter( 'wpseo_json_ld_output', '__return_false' );
    add_filter('display_post_states', array($this, 'show_contact_page_state'), 10, 2);
  }

  /**
  * Adds mark to page on pages' list in admin section
  *
  * @param $states - array
  * @param $post - WP_Post object
  *
  * @return array
  */
  public static function show_contact_page_state( $states, $post ) {
      if ( 'page' == get_post_type( $post->ID )){
        switch ($post->ID) {
          case get_option('theme_page_tower_revenue'):
              $states[] = __('Tower Revenue');
            break;
        }
      }
      return $states;
    }
}

new theme_filter_class();