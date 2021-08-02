<?php

add_action('vc_before_init', 'vc_before_init_gallery_v_3_item');

function vc_before_init_gallery_v_3_item(){
  vc_map( array(
    "name" => __("Carousel v3", "theme_translations"),
    "base" => "gallery_v_3",
    "as_parent" => array('only' => 'gallery_v_3_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => false,
    'category' => __( 'Theme Shortcodes' ),
    'description' =>__("A carousel with 2 elements in row, borderless version", "theme-translations"),
    'icon' => THEME_URL.'/assets/images/icons/carousel_room_1.png',
    "params" => array(
    // add params same as with any other content element
        array(
          "type" => "textfield",
          "heading" => __("Title", "theme-translations"),
          "param_name" => "title",
         ),
        array(
          "type" => "textarea",
          "heading" => __("Description", "theme-translations"),
          "param_name" => "text",
         ),
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
    "base" => "gallery_v_3_item",
    "content_element" => true,
    "as_child" => array('only' => 'gallery_v_3'),
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
          "type" => "textfield",
          "heading" => __("Category", "theme-translations"),
          "param_name" => "category",
         ),
        array(
          "type" => "textfield",
          "heading" => __("Title", "theme-translations"),
          "param_name" => "title",
         ),
        array(
          "type" => "textarea",
          "heading" => __("Description", "theme-translations"),
          "param_name" => "text",
         ),
        array(
          "type" => "vc_link",
          "heading" => __("Url", "theme-translations"),
          "param_name" => "url",
         ),
        array(
          "type" => "textfield",
          "heading" => __("Button Title", "theme-translations"),
          "param_name" => "button_title",
         ),
        array(
          'type' => 'attach_image',
          "heading" => __('Featured Image', 'theme-translation'), // translated
          // "description" =>
          'param_name' => 'image_id',
        ),
      )
    ) );

}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_gallery_v_3 extends WPBakeryShortCodesContainer {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title' => false,
        'text' => false,
        'hide_controls' => false,
      ), $atts ) );

      ob_start();
      ?>
      <div class="container container-xxl no-paddings">
        <?php if ($title): ?>
        <h2 class="section-title text-center"><?php echo $title ?></h2>
        <?php endif ?>

        <?php if ($text): ?>
        <p class="section-comment text-center"><?php echo $text ?></p>
        <?php endif ?>

        <div class="spacer-h-40 spacer-h-md-60 spacer-h-lg-100"></div>
        <div class="carousel-global">

          <?php if (!$hide_controls): ?>
          <div class="carousel-ctrl bottom"><span class="prev"></span><span class="next"></span></div>
          <?php endif ?>
          <div class="owl-carousel items-2">
            <?php echo do_shortcode($content); ?>
          </div>
        </div>
      </div>
      <div class="spacer-h-50"></div>

      <?php
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    }
  }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_gallery_v_3_item extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title'        => false,
        'text'         => false,
        'button_title' => false,
        'url'          => false,
        'image_id'     => false,
        'category'     => false,
      ), $atts ) );

      $link = vc_build_link($url);

      $args =array(
        'category'        => $category,
        'title'        => $title,
        'title_tag'        => 'h3',
        'link_data'    => $link,
        'text'         => $text,
        'button_title' => $button_title,
        'button_url'          => $link['url'],
        'image_url'       =>  wp_get_attachment_image_src($image_id, 'gallery_2_image')[0],
      );

      ob_start();
      echo print_theme_template_part('hotel-item-below', 'wpbackery', $args);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
  }
}