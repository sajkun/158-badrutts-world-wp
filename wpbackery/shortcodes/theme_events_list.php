<?php
add_action('vc_before_init', 'vc_before_init_theme_events_list');

function vc_before_init_theme_events_list(){
  vc_map( array(
      'base' => 'theme_events_list',
      'name' => __( 'List of all events', 'theme-translation' ), // translated
      'class' => '',
      'category' => __( 'Theme Shortcodes' ),
      'icon' => THEME_URL.'/assets/images/icons/calendar.jpg',

      'description' => __('Displays events page', 'theme-translation', 'theme-translations'), // translated

      'show_settings_on_create' => false,

      'params' => array(
      ),
  ));
}

class WPBakeryShortCode_theme_events_list extends WPBakeryShortCode {
  protected function content( $atts, $content = null ) {
    // $today = new DateTime();

    // $args = array(
    //   'posts_per_page' => -1,
    //   'post_type'      => 'theme_events',
    // );

    // $events = get_posts($args);

    // foreach ($events as $key => $e) {

    //   if(function_exists('pll_get_post')){
    //     $event_id =  pll_get_post($e->ID);

    //     if($event_id){
    //       $event = get_post( $event_id );
    //     }else{
    //       $event = $e;
    //     }
    //   }else{
    //     $event = $e;
    //   }

    //   $image_id = get_post_thumbnail_id($event->ID);
    //   $event->image_url = wp_get_attachment_image_url( (int)$image_id, $image_size  , false );
    //   $event->post_content = strip_tags(  $event->post_content );

    //   if(function_exists('get_field')){
    //     $date_n_time = get_field('date_n_time', $event->ID);


    //     if($date_n_time['date_start']){

    //       $event_start = new DateTime($date_n_time['date_start']);

    //       if($event_start < $today){
    //         unset( $events[$key]);
    //         continue;
    //       }
    //     }

    //     $date_end =  ($date_n_time['date_end'])? new DateTime($date_n_time['date_end']) : '' ;
    //     $date_start = ($date_n_time['date_start'])? new DateTime($date_n_time['date_start']): '';

    //     $event->meta = array(
    //       'reservation'         => get_field('reservation', $event->ID),
    //       'external_link'       => get_field('external_link', $event->ID),
    //       'external_link_title' => get_field('external_link_title', $event->ID)?: __('Read More', 'theme-translations'),
    //       'date_n_time'         => $date_n_time,
    //       'location'            => get_field('location', $event->ID),
    //       'category_display'    => get_field('category', $event->ID),
    //       'categories'          => wp_get_post_terms( $event->ID, 'event_tax', array('fields'=>'ids') ),
    //     );

    //     $event->meta['date_n_time']['date_start_formatted'] =  ($date_n_time['date_start'])? __( $date_start->format('F'),'theme-translations') . $date_start->format(' d, Y') : '';
    //     $event->meta['date_n_time']['date_end_formatted'] = ($date_n_time['date_end'])?  __($date_end->format('F'),'theme-translations') . $date_end->format(' d, Y'): '';
    //   }

    //   $events[$key] = $event;
    // }

    $responce = wp_remote_post('https://badruttspalace.com/wp-admin/admin-ajax.php?action=get_events_data');

    $data = json_decode($responce['body']);

    clog(array_values((array)$data->events));

    $args = array(
      'events' => array_values((array)$data->events),
    );

    // clog($args);

    // clog(json_decode($responce['body']));

    ob_start();

    echo print_theme_template_part('events-list', 'wpbackery', $args);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

  }
}