<?php


add_action('vc_before_init', 'vc_before_init_gallery_v_1_item');

function vc_before_init_gallery_v_1_item(){
  vc_map( array(
    "name" => __("Carousel v1", "theme_translations"),
    "base" => "gallery_v_1",
    "as_parent" => array('only' => 'gallery_v_1_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => false,
    'category' => __( 'Theme Shortcodes' ),
    'description' =>__("A carousel with book links 3 elements in row.", "theme-translations"),
    'icon' => THEME_URL.'/assets/images/icons/carousel_room_1.png',
    "params" => array(
    // add params same as with any other content element
        array(
          "type" => "checkbox",
          "heading" => __("Hide Controls", "theme-translations"),
          "param_name" => "hide_controls",
         ),
      ),
      "js_view" => 'VcColumnView',
    ) );


  vc_map( array(
    "name" => __("Carousel Item", "theme-translations"), // translated
    "base" => "gallery_v_1_item",
    "content_element" => true,
    "as_child" => array('only' => 'gallery_v_1'),
    'category' => __( 'Theme Shortcodes' ),
    'custom_markup' =>
         '<h4 class="wpb_element_title">

           <span class="no_image_image_id vc_element-icon icon-image_id"></span>

            '.__( 'Carousel Item', 'theme-translation' ).
            '
           </h4>

           <div style="height: 10px"></div>
           <span class="vc_admin_label admin_label_title" style="display: inline;">
             <label>'.__('title','theme-translations').' </label>
            </span> <br>
            <span class="vc_admin_label admin_label_text" style="display: inline;">
              <label>'.__('text','theme-translations').' </label>
            </span><br>
            ',

    "params" => array(
        array(
          'type' => 'attach_image',
          "heading" => __('Featured Image', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'image_id',
        ),
        array(
          "type" => "textfield",
          "heading" => __("Title", "theme-translations"),
          "param_name" => "title",
         ),

        array(
          "type" => "vc_link",
          "heading" => __("Url", "theme-translations"),
          "param_name" => "url",
         ),
      )
    ) );
}


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_gallery_v_1 extends WPBakeryShortCodesContainer {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title' => false,
        'text' => false,
        'hide_controls' => false,
      ), $atts ) );


      ob_start();
      ?>
      <div class="container container-xxl no-paddings">
        <div class="carousel-global">

          <?php if (!$hide_controls): ?>
          <div class="carousel-ctrl visuallyhidden"><span class="prev"></span><span class="next"></span></div>
          <?php endif ?>
          <div class="owl-carousel order-links-carousel">
            <?php echo do_shortcode($content); ?>
          </div>
        </div>
      </div>

      <?php
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    }
  }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_gallery_v_1_item extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title'        => false,
        'url'          => false,
        'image_id'     => false,
      ), $atts ) );

      $link = vc_build_link($url);

      $args =array(
        'title'        => $title,
        'link_data'    => $link,
        'url'          => $link['url'],
        'image'        =>  wp_get_attachment_image_url($image_id, 'medium'),
      );
      ob_start();

      echo print_theme_template_part('carousel1-item', 'wpbackery', $args);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
  }
}