<?php
add_action('vc_before_init', 'vc_before_init_theme_events');

function vc_before_init_theme_events(){

  $args = array(
      'taxonomy' => 'event_tax',
      'hide_empty' => false,
    );

  $terms = get_terms($args);

  $values = array();

  foreach ($terms as $key => $value) {
    $values[$value->name] = $value->term_id;
  }

  $date = new DateTime;
  $current_year = (int)$date->format('Y');

  $years = array();

  for($i= 0; $i< 10; $i++){

    $years[$current_year] = $current_year;
    $current_year++;
  }


  vc_map( array(
      'base' => 'theme_events',
      'name' => __( 'Events', 'theme-translation' ), // translated
      'class' => '',
      'category' => __( 'Theme Shortcodes' ),
      'icon' => THEME_URL.'/assets/images/icons/calendar.jpg',

      'description' => __('Displays events page', 'theme-translation', 'theme-translations'), // translated

      'show_settings_on_create' => true,

      'params' => array(
        array(
          'type' => 'dropdown_multi',
          "heading" => __('Select categories', 'theme-translation'),
          'param_name' => 'terms',
          'value' => $values,
        ),

        array(
          'type' => 'dropdown',
          "heading" => __('Season', 'theme-translation'),
          'param_name' => 'season',
          'value' => array(
            __('Summer','theme_translations') => 's',
            __('Winter','theme_translations') => 'w'
          ),
        ),

        array(
          'type' => 'dropdown',
          "heading" => __('Maximum year limit', 'theme-translation'),
          'param_name' => 'max_year',
          'value' => $years,
        ),

        array(
          'type' => 'textfield',
          "heading" => __('Additional classes', 'theme-translation'),// translate
          'param_name' => 'class',
        ),
        array(
          'type' => 'checkbox',
          "heading" => __('Hide categories tabs', 'theme-translation'),// translate
          'param_name' => 'hide_categories',
        ),
      ),
  ));
}



class WPBakeryShortCode_theme_events extends WPBakeryShortCode {
   protected function content( $atts, $content = null ) {
    global $theme_init;
    $date = new DateTime;
    $current_year = (int)$date->format('Y');

    extract( shortcode_atts( array(
      'class'     => -1,
      'hide_categories' => false,
      'terms'     => false,
      'season'     => 's',
      'max_year'     => $current_year,
    ), $atts ) );

    $max_year = Max($current_year, $max_year);


    $terms_ids = $terms? explode(',', $terms) : $terms;

    $args = array(
      'posts_per_page' => -1,
      'post_type'      => 'theme_events',
    );

    if ($terms) {
     $args['tax_query'] = array(
        array(
          'taxonomy' => 'event_tax',
          'field'    => 'id',
          'terms'    => $terms_ids
        ));
    }

    $events = get_posts($args);

    $terms_args =  array(
      'taxonomy' => 'event_tax',
      'hide_empty' => true,
    );

    if ($terms_ids) {
      $terms_args['include'] = $terms_ids;
    }


    $detect = new Mobile_Detect();

    $image_size = ($detect->is_mobile() && !$detect->is_tablet())? 'item_details_featured_sm' : 'item_details_featured';

    foreach ($events as $key => $e) {

      if(function_exists('pll_get_post')){
       $event_id =  pll_get_post($e->ID);
       $event = get_post( $event_id );
      }else{
        $event = $e;
      }

      $image_id = get_post_thumbnail_id($event->ID);
      $event->image_url = wp_get_attachment_image_url( (int)$image_id, $image_size  , false );
      $event->post_content = strip_tags(  $event->post_content );

      if(function_exists('get_field')){
        $date_n_time = get_field('date_n_time', $event->ID);

        $date_end =  ($date_n_time['date_end'])? new DateTime($date_n_time['date_end']) : '' ;
        $date_start = ($date_n_time['date_start'])? new DateTime($date_n_time['date_start']): '';

        $event->meta = array(
          'reservation'         => get_field('reservation', $event->ID),
          'external_link'       => get_field('external_link', $event->ID),
          'external_link_title' => get_field('external_link_title', $event->ID)?: __('Read More', 'theme-translations'),
          'date_n_time'         => $date_n_time,
          'location'            => get_field('location', $event->ID),
          'category_display'    => get_field('category', $event->ID),
          'categories'          => wp_get_post_terms( $event->ID, 'event_tax', array('fields'=>'ids') ),
        );

        $event->meta['date_n_time']['date_start_formatted'] =  ($date_n_time['date_start'])? __( $date_start->format('F'),'theme-translations') . $date_start->format(' d, Y') : '';
        $event->meta['date_n_time']['date_end_formatted'] = ($date_n_time['date_end'])?  __($date_end->format('F'),'theme-translations') . $date_end->format(' d, Y'): '';

      }else{
        $event->meta = array(
        'reservation'         => false,
        'external_link'       => false,
        'external_link_title' => false,
        'date_n_time'         => false,
        'location'            => false,
        'category_display'    => false,
        'categories'          => false
        );
      }
      $events[$key] = $event;
    }

    wp_localize_script($theme_init->main_script_slug, 'theme_events', $events);
    wp_localize_script($theme_init->main_script_slug, 'max_year', array($max_year));

    $terms = get_terms($terms_args);

    $date = new DateTime();

    $year = $date->format('Y');

    $months1 = array( 'June',"July",'August','September');
    $_start_date = in_array($date->format('F'), $months1)? $date : new DateTime($year.'-06-01');

    $months2 = array('December',"January", 'February','March','April');
    $_start_date = in_array($date->format('F'), $months2)? $date : new DateTime($year.'-12-01');

    // switch ($season) {
    //   case 's':
    //     break;
    //   case 'w':
    //     break;
    // }

    $args = array(
      'terms'  => $terms,
      'events' => $events,
      'date'   => $_start_date,
      'season' => $season,
      'hide_categories' => $hide_categories,
    );

    ob_start();

    echo print_theme_template_part('events', 'wpbackery', $args);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
}