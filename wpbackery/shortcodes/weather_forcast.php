<?php
class WPBakeryShortCode_weather_forcast extends WPBakeryShortCode {
   protected function content( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'class' => -1,
      'widget_id' => 'form-widget-1',
    ), $atts ) );

    ob_start();

    $weather_data = wp_safe_remote_get('http://contentpool.estm.ch/wetter_en_neu.xml');

     $xml = new SimpleXMLElement( $weather_data['body']  );

     $today = new DateTime();

     $today->modify('+1 day');

     $days = array();

     for($i = 0; $i < 5 ; $i++){
       $today->modify('+1 day');
       $days[] = $today->format('l');
     }


    $elements = array(
      'today_morning'  => array(
        'title' => __('Today morning', 'theme-translations'),
        'temperature' => 'min. '. $xml->engadin->temperatures->today_min.'°C / max. '. $xml->engadin->temperatures->today_max.'°C ',
        'image'       => $xml->engadin->icons->today_morning,
      ),

      'today_afternoon'  => array(
        'title' => __('Today afternoon', 'theme-translations'),
        'temperature' => 'min. '. $xml->engadin->temperatures->today_min.'°C / max. '. $xml->engadin->temperatures->today_max.'°C ',
        'image'       => $xml->engadin->icons->today_afternoon,
      ),
      'tomorrow_morning'  => array(
        'title' => __('Tomorrow morning', 'theme-translations'),
        'temperature' => 'min. '. $xml->engadin->temperatures->tomorrow_min.'°C / max. '. $xml->engadin->temperatures->tomorrow_max.'°C ',
        'image'       => $xml->engadin->icons->tomorrow_morning,
      ),
      'tomorrow_afternoon'  => array(
        'title' => __('Tomorrow afternoon', 'theme-translations'),
        'temperature' => 'min. '. $xml->engadin->temperatures->tomorrow_min.'°C / max. '. $xml->engadin->temperatures->tomorrow_max.'°C ',
        'image'       => $xml->engadin->icons->tomorrow_afternoon,
      ),
      'day_1'  => array(
        'title' => __($days[0], 'theme-translations'),
        'temperature' => 'min. '. $xml->weather_stations->station[0]->forecast->day_1->temp_min.'°C / max. '. $xml->weather_stations->station[0]->forecast->day_1->temp_max.'°C ',
        'image'       => $xml->engadin->icons->forecast->day_1,
      ),
      'day_2'  => array(
        'title' => __($days[1], 'theme-translations'),
        'temperature' => 'min. '. $xml->weather_stations->station[0]->forecast->day_2->temp_min.'°C / max. '. $xml->weather_stations->station[0]->forecast->day_2->temp_max.'°C ',
        'image'       => $xml->engadin->icons->forecast->day_2,
      ),
      'day_3'  => array(
        'title' => __($days[2], 'theme-translations'),
       'temperature' => 'min. '. $xml->weather_stations->station[0]->forecast->day_3->temp_min.'°C / max. '. $xml->weather_stations->station[0]->forecast->day_3->temp_max.'°C ',
        'image'       => $xml->engadin->icons->forecast->day_3,
      ),
      'day_4'  => array(
        'title' => __($days[3], 'theme-translations'),
        'temperature' => 'min. '. $xml->weather_stations->station[0]->forecast->day_4->temp_min.'°C / max. '. $xml->weather_stations->station[0]->forecast->day_4->temp_max.'°C ',
        'image'       => $xml->engadin->icons->forecast->day_4,
      ),
      // 'day_5'  => array(
      //   'title' => __($days[4], 'theme-translation'),
      //   'temperature' => 'min. '. $xml->weather_stations->station[0]->forecast->day_5->temp_min.'°C / max. '. $xml->weather_stations->station[0]->forecast->day_5->temp_max.'°C ',
      //   'image'       => $xml->engadin->icons->forecast->day_5,
      // ),
    );


    echo '<div class="weather-carousel-wrapper">';
    echo '<div class="weather-carousel-ctrl"><span class="prev"></span><span class="next"></span></div>';
    echo '<div class="weather-carousel owl-carousel">';

      foreach ($elements as $key => $e) {
       printf('<div class="weather-item"><p class="weather-item__title">%1$s</p><img src="%2$s" alt=""><p class="weather-item__temp">%3$s</p></div>', $e['title'], $e['image'], $e['temperature']);
      }

    echo '</div>';
    echo '</div>';



    $output = ob_get_contents();

    ob_end_clean();
    return $output;
   }
}



add_action('vc_before_init', 'vc_before_init_weather_forcast');

function vc_before_init_weather_forcast(){
  vc_map( array(
      'base' => 'weather_forcast',
      'name' => __( 'Wheather Forecast', 'theme-translation' ), // translated
      'class' => '',
      'category' => __( 'Theme Shortcodes' ),
      'icon' => THEME_URL.'/assets/images/icons/weather.png',

      // 'description' => __('Displays booking widget for rooms. Uses https://be.synxis.com/', 'theme-translation', 'theme-translations'), // translated
      'show_settings_on_create' => false,
      'params' => array(
      ),
  ));
}