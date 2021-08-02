<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}



class WPBakeryShortCode_hotel_item extends WPBakeryShortCode {
   protected function content( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'display_type' => 'right',
      'category' => false,
      'title' => false,
      'title_tag' => 'h2',
      'text' => false,
      'button_title' => false,
      'button_url' => false,
      'button_title2' => false,
      'second_anchor' => false,
      'button_url2' => false,
      'button_params' => '',
      'image_id' => -1,
    ), $atts ) );


    $image_size = ('fullwidth' == $display_type)? 'full' : 'item_details_featured';

    $detect = new Mobile_Detect();

    $image_size = ($detect->is_mobile() && !$detect->is_tablet())? 'item_details_featured_sm' : $image_size;

    $button = vc_build_link($button_url);
    $button2 = vc_build_link($button_url2);

    $args = array(
      'text' => $text,
      'category' => $category,
      'title' => $title,
      'title_tag' => $title_tag,
      'link_data' => $button,
      'link_data2' => $button2,
      'second_anchor' => $second_anchor,
      'button_params' => $button_params,

      'button_title' => $button_title,
      'button_url' => $button['url'],
      'button_title2' => $button_title2,
      'button_url2' => $button2['url'],
      'image_url' => wp_get_attachment_image_url( (int)$image_id, $image_size  , false ),
    );

    ob_start();
    echo print_theme_template_part('hotel-item-'.$display_type, 'wpbackery', $args);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

  }
}
add_action('vc_before_init', 'vc_before_init_hotel_item');

function vc_before_init_hotel_item(){

  $args =  array(

      'base' => 'hotel_item',
      'name' => __( 'Main Hotel Item', 'theme-translation' ), // translated
      // 'description' => __('Data','theme-translation'),
      'class' => '',
      'category' => __( 'Theme Shortcodes' ),
      'icon' => THEME_URL.'/assets/images/logo.svg',
      'custom_markup' =>
           '<h4 class="wpb_element_title">

             <span class="no_image_image_id vc_element-icon icon-image_id"></span>

              '.__( 'Main Hotel Item', 'theme-translation' ).
              '
             </h4>

             <div style="height: 10px"></div>
             <span class="vc_admin_label admin_label_category" style="display: inline;">
               <label>'.__('Category','theme-translations').' </label>
              </span>
              <span class="vc_admin_label admin_label_title" style="display: inline;">
                <label>'.__('Title','theme-translations').' </label>
              </span>
              <span class="vc_admin_label admin_label_text" style="display: block;">
              </span>
              ',


      'show_settings_on_create' => true,

      'params' => array(
        array(
          'type' => 'attach_image',
          "heading" => __('Featured Image', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'image_id',
        ),
        array(
          'type' => 'dropdown',
          "heading" => __('Display type', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'display_type',
          'value' => array(
              __('Select value', 'theme-translation')    => '',
              __('Fullwidth image', 'theme-translation')    => 'fullwidth',
              __('Text aligned left', 'theme-translation')  => 'left',
              __('Text aligned right', 'theme-translation') => 'right',
              __('Text below image', 'theme-translation')   => 'below',
          ),
        ),
        array(
          'type' => 'textfield',
          "heading" => __('Category', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'category',
        ),
        array(
          'type' => 'dropdown',
          "heading" => __('Title Tag', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'title_tag',
          'value' => array(
            'h2' => 'h2',
            'h3' => 'h3',
            'h4' => 'h4',
            'h5' => 'h5',
            'h6' => 'h6',
            'p'  => 'p',
          ),
        ),
        array(
          'type' => 'textfield',
          "heading" => __('Title', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'title',
        ),
        array(
          'type' => 'textarea',
          "heading" => __('Text', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'text',
        ),

        array(
          'type' => 'textfield',
          "heading" => __('Button title', 'theme-translation'), // translated
          "description" => __('Leave this field empty to hide button', 'theme-translation'),
          'param_name' => 'button_title',
        ),

        array(
          'type' => 'vc_link',
          "heading" => __('Button url', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'button_url',
        ),

        array(
          'type' => 'textfield',
          "heading" => __('Button additional params', 'theme-translation'), // translated
          'param_name' => 'button_params',
        ),


        array(
          'type' => 'textfield',
          "heading" => __('Second anchor', 'theme-translation'), // translated
          "description" => __('Will be triggered with delay. Use to avoid tabs issue', 'theme-translation'),
          'param_name' => 'second_anchor',
        ),

        array(
          'type' => 'textfield',
          "heading" => __('Button title', 'theme-translation'), // translated
          "description" => __('Works only for fullsize Item', 'theme-translation'),
          'param_name' => 'button_title2',
        ),

        array(
          'type' => 'vc_link',
          "heading" => __('Button url', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'button_url2',
        ),
      ),
  );

  vc_map($args);

}