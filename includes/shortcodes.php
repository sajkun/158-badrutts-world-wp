<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

add_shortcode('splash_page', 'splash_page_cb');

function splash_page_cb(){

  // $theme_locale = $_COOKIE['theme_locale'];

  // if($theme_locale){
  //   $date = new DateTime();
  //   $season = (int)$date->format('n')  > 5 && (int)$date->format('n')  < 10? 'summer' : 'winter' ;
  //   $home_page_id = get_home_page_id( $season , substr($theme_locale, 0 , 2) );
  //   $url = get_permalink($home_page_id);
  // }


  $id = get_queried_object_id();

  remove_action('do_theme_header', array('theme_content_output', 'print_header'));
  remove_action('do_theme_footer', array('theme_content_output', 'print_footer'));

  $disclaimer_id = get_lang_post_id(get_option('theme_footer_disclaimer'));
  ob_start();
  $copyrights = "";
   if(is_active_sidebar('copyrights')){
     dynamic_sidebar('copyrights');
   }

  $copyrights = ob_get_contents();
  ob_get_clean();
  $date = new DateTime('now');
  $copyrights = str_replace('{year}', $date->format('Y'), $copyrights );

  $career_id = get_lang_post_id(get_field('careers_url', $id));

  $args = array(
    'text'               => get_field('page_text', $id),
    'summer_text'        => get_field('summer_text', $id),
    'summer_url'         => get_field('summer_url', $id),
    'winter_text'        => get_field('winter_text', $id),
    'winter_url'         => get_field('winter_url', $id),
    'career_text'        => get_field('careers_text', $id),
    'opening_times'        => get_field('opening_times', $id),
    'career_url'         =>get_field('careers_url', $id)? get_permalink( $career_id ) : false,
    'copyrights'         =>  $copyrights ,
    'disclaimer_url'     => get_permalink(get_lang_post_id($disclaimer_id)),
    'show_lang_switcher' => function_exists('pll_languages_list') && count( pll_languages_list() ) > 1,
  );

  ob_start();
  echo($url );
  print_theme_template_part('splash', 'globals', $args);

  $output = ob_get_contents();
  ob_get_clean();

  return $output;
}