<?php
add_action('vc_before_init', 'vc_before_init_carousel_packages');

function vc_before_init_carousel_packages(){
  vc_map( array(
    "name" => __("Carousel of Packages", "theme_translations"),
    "base" => "carousel_packages",
    "as_parent" => array('only' => 'carousel_packages_item,carousel_culinary_item'),
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => false,
    'category' => __( 'Theme Shortcodes' ),
    'description' =>__("A carousel designed to show packages. Each element decorated with white border", "theme-translations"),
    'icon' => THEME_URL.'/assets/images/icons/carousel_room_1.png',
    "params" => array(
    // add params same as with any other content element
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
          "type" => "textfield",
          "heading" => __("Additional Styles", "theme-translations"),
          "param_name" => "style",
         ),
      ),
      "js_view" => 'VcColumnView'
    ) );

  vc_map( array(
    "name" => __("Carousel Item (Package)", "theme-translation"),
    "base" => "carousel_packages_item",
    "content_element" => true,
    "as_child" => array('only' => 'carousel_packages'),
    'category' => __( 'Theme Shortcodes' ),
    'custom_markup' =>
         '<h4 class="wpb_element_title">

           <span class="no_image_image_id vc_element-icon icon-image_id"></span>

            '.__( 'Carousel Item (Package)', 'theme-translation' ).
            '
           </h4>

           <div style="height: 10px"></div>
           <span class="vc_admin_label admin_label_title" style="display: inline; font-size: 14px;">
             <label>'.__('title','theme-translations').' </label>
            </span> <br>
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
          "heading" => __("Title", "theme-translations"),// translate
          "param_name" => "title",
         ),
        array(
          "type" => "vc_link",
          "heading" => __("Read more URL", "theme-translations"),// translated
          "param_name" => "more_url",
         ),
        array(
          "type" => "vc_link",
          "heading" => __("Book Url", "theme-translations"),// translated
          "param_name" => "book_url",
         ),
      )
  ) );

  vc_map( array(
    "name" => __("Carousel Item (Culinary)", "theme-translation"),
    "base" => "carousel_culinary_item",
    "content_element" => true,
    "as_child" => array('only' => 'carousel_packages'),
    'category' => __( 'Theme Shortcodes' ),
    'custom_markup' =>
         '<h4 class="wpb_element_title">

           <span class="no_image_image_id vc_element-icon icon-image_id"></span>

            '.__( 'Carousel Item (Culinary)', 'theme-translation' ).
            '
           </h4>

           <div style="height: 10px"></div>
           <span class="vc_admin_label admin_label_title" style="display: inline; font-size: 14px;">
             <label>'.__('title','theme-translations').' </label>
            </span> <br>
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
          "heading" => __("Title", "theme-translations"),// translate
          "param_name" => "title",
         ),
        array(
          "type" => "textarea",
          "heading" => __("Description", "theme-translations"),// translate
          "param_name" => "text",
         ),
        array(
          "type" => "vc_link",
          "heading" => __("Discover now", "theme-translations"),// translated
          "param_name" => "more_url",
         ),
        array(
          "type" => "vc_link",
          "heading" => __("Book Url", "theme-translations"),// translated
          "param_name" => "book_url",
         ),
      )
  ) );
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_carousel_packages extends WPBakeryShortCodesContainer {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title' => false,
        'text' => false,
        'style' => false,
        'category' => false,
      ), $atts ) );

      ob_start();
    ?>
    <?php if ($style): ?>
    <section class="<?php echo $style ?>">
      <div class="container text-center no-paddings">
        <div class="spacer-h-50 spacer-h-md-90"></div>
    <?php endif ?>
        <?php if ($category): ?>
        <h2 class="section-category"><?php echo $category ?></h2>
        <?php endif ?>
        <?php if ($title): ?>
        <h2 class="section-title"><?php echo $title ?></h2>
        <?php endif ?>
        <?php if ($text): ?>
        <p class="section-comment"><?php echo $text ?></p>
        <?php endif ?>
      </div>

      <div class="spacer-h-30"></div>

      <div class="carousel-mount">
        <div class="carousel-mount__ctrl">
          <div class="prev"></div>
          <div class="next"></div>
        </div>
        <div class="carousel-mount__content owl-carousel">
          <?php echo do_shortcode($content); ?>

        </div>

        <div class="carousel-mount__dots"></div>
    <?php if ($style): ?>
      </div>
    </section>
    <?php endif ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    }
  }
}


if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_carousel_packages_item extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title'    => false,
        'book_url' => false,
        'more_url' => false,
        'image_id' => false,
      ), $atts ) );

      $book_data = vc_build_link($book_url);
      $more_data = vc_build_link($more_url);

      $image_url = wp_get_attachment_image_url((int)$image_id, 'gallery_package_image', DUMMY);

      $args =array(
        'title'       => $title,
        'book_data'       => $book_data,
        'more_data'       => $more_data,
        'more_url'    => $more_data['url'],
        'more_target' => $more_data['target'],
        'book_url'    => $book_data['url'],
        'book_target' => $book_data['target']? 'target="'.$book_data['target'].'"' : '',
        'image_url'   => $image_url,
      );

      ob_start();

      echo print_theme_template_part('carousel-packages-item', 'wpbackery', $args);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
  }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_carousel_culinary_item extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'title'    => false,
        'text'    => false,
        'book_url' => false,
        'more_url' => false,
        'image_id' => false,
      ), $atts ) );

      $book_data = vc_build_link($book_url);
      $more_data = vc_build_link($more_url);

      $args =array(
        'title'       => $title,
        'book_data'       => $book_data,
        'more_data'       => $more_data,
        'text'        => $text,
        'more_url'    => $more_data['url'],
        'more_target' => $more_data['target'],
        'book_url'    => $book_data['url'],
        'book_target' => $book_data['target'],
        'image_url'   => wp_get_attachment_image_url($image_id, 'gallery_package_image', DUMMY),
      );

      ob_start();

      echo print_theme_template_part('carousel-culinary-item', 'wpbackery', $args);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
  }
}