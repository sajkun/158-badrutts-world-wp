<?php
/**
 * Adds options to the customizer for theme.
 *
 * @package theme
 */
// defined( 'ABSPATH' ) || exit;

class velesh_theme_customizer{
    /**
   * Constructor.
   */
  public function __construct() {
    add_action( 'customize_register', array( $this, 'add_sections' ) );

    // add_action( 'customize_controls_enqueue_scripts', array( $this, 'add_scripts' ), 999 );
  }



  /**
   * Add settings to the customizer.
   *
   * @param WP_Customize_Manager $wp_customize Theme Customizer object.
   */
  public function add_sections( $wp_customize ) {
    // $this->add_site_header( $wp_customize );
    $this->add_site_footer( $wp_customize );
    $this->add_site_socials( $wp_customize );
    $this->add_site_partners( $wp_customize );
    $this->add_site_contacts( $wp_customize );
  }


  /**
   * Scripts to improve our form.
   */
  public function add_scripts() {
      wp_enqueue_script('velesh_theme_customizer', THEME_URL .'/script/customizer.js', array( 'jquery','customize-preview' ), '', true );
  }

  /**
   * Store site header section.
   *
   * @param WP_Customize_Manager $wp_customize Theme Customizer object.
   */
  public function add_site_header( $wp_customize ){
    $wp_customize->add_setting(
        'theme_header_logo_mob',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
      new WP_Customize_Image_Control(
        $wp_customize,
        'theme_header_logo_mob',
        array(
          'label' => __('Logo for Mobiles', 'theme-translations'), //translated
          'section' => 'title_tagline',
          'settings' => 'theme_header_logo_mob',
          'priority' => 8 )
      )
    );


    $wp_customize->selective_refresh->add_partial( 'theme_header_logo_mob', array(
        'selector' => '.header-logo.show-tablet',
    ) );


      $wp_customize->add_section(
          'theme_header_section',
          array(
              'title'       => __('Theme Header', 'theme-translations'), //translated
              'priority'    => 300,
          )
      );


    $wp_customize->add_setting(
        'header_camera_url',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
        'header_camera_url',
        array(
          'label' => __('Url for camera', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_camera_url',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );


    $wp_customize->selective_refresh->add_partial( 'header_camera_url', array(
        'selector' => array('header .camera-link')
    ) );

    $wp_customize->add_setting(
        'header_camera_url_de',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
        'header_camera_url_de',
        array(
          'label' => __('Url for camera German', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_camera_url_de',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );
    $wp_customize->add_setting(
        'header_camera_url_ru',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
        'header_camera_url_ru',
        array(
          'label' => __('Url for camera Russian', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_camera_url_ru',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );
    $wp_customize->add_setting(
        'header_camera_url_it',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
        'header_camera_url_it',
        array(
          'label' => __('Url for camera Italian', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_camera_url_it',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );
    $wp_customize->add_setting(
        'header_camera_url_fr',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
        'header_camera_url_fr',
        array(
          'label' => __('Url for camera French', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_camera_url_fr',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );


    $wp_customize->add_setting(
        'header_book_btn_url',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );


    $wp_customize->add_control(
        'header_book_btn_url',
        array(
          'label' => __('Url for book button in header English', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_book_btn_url',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );


    $wp_customize->selective_refresh->add_partial( 'header_book_btn_url', array(
        'selector' => array('header .book-btn', '.mobile-menu-holder .book-btn') ,
    ) );


    $wp_customize->add_setting(
        'header_book_btn_url_de',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );


    $wp_customize->add_control(
        'header_book_btn_url_de',
        array(
          'label' => __('Url for book button in header German', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_book_btn_url_de',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );


    $wp_customize->selective_refresh->add_partial( 'header_book_btn_url_de', array(
        'selector' => array('header .book-btn', '.mobile-menu-holder .book-btn') ,
    ) );



    $wp_customize->add_setting(
        'header_book_btn_url_ru',
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );


    $wp_customize->add_control(
        'header_book_btn_url_ru',
        array(
          'label' => __('Url for book button in header Russian', 'theme-translations'), //translated
          'section' => 'theme_header_section',
          'type'      => 'text',
          'settings' => 'header_book_btn_url_ru',
          'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        ) );


    $wp_customize->selective_refresh->add_partial( 'header_book_btn_url_ru', array(
        'selector' => array('header .book-btn', '.mobile-menu-holder .book-btn') ,
    ) );

    // $pages = get_posts(array(
    //   'post_type' => 'page',
    //   'posts_per_page' => -1,
    // ));

    // $choices = array();

    // foreach ($pages as $key => $page) {
    //   $choices[$page->ID] = $page->post_title;
    // }

    // $wp_customize->add_setting(
    //     'winter_site_id',
    //     array(
    //         'default'    =>  '',
    //         'transport'  =>  'postMessage',
    //         'type'       => 'option',
    //     )
    // );

    // $wp_customize->add_control(
    //     'winter_site_id',
    //     array(
    //       'label' => __('Home page winter', 'theme-translations'), //translated
    //       'section' => 'theme_header_section',
    //       'type'      => 'select',
    //       'settings' => 'winter_site_id',
    //       'priority' => 2,
    //       'choices' => $choices,
    //     ) );


    // $wp_customize->selective_refresh->add_partial( 'winter_site_id', array(
    //     'selector' => array('header .book-btn', '.mobile-menu-holder .book-btn') ,
    // ) );

    // $wp_customize->add_setting(
    //     'summer_site_id',
    //     array(
    //         'default'    =>  '',
    //         'transport'  =>  'postMessage',
    //         'type'       => 'option',
    //     )
    // );

    // $wp_customize->add_control(
    //     'summer_site_id',
    //     array(
    //       'label' => __('Home page winter', 'theme-translations'), //translated
    //       'section' => 'theme_header_section',
    //       'type'      => 'select',
    //       'settings' => 'summer_site_id',
    //       'priority' => 2,
    //       'choices' => $choices,
    //     ) );


    // $wp_customize->selective_refresh->add_partial( 'summer_site_id', array(
    //     'selector' => array('header .book-btn', '.mobile-menu-holder .book-btn') ,
    // ) );
  }

  /**
  * customizer section with social links
  */
  public function add_site_socials( $wp_customize ){

    $socials = array(
      'instagram'   => 'Instagram',
      'twitter'     => 'Twitter',
      'facebook'    => 'Facebook',
      'youtube'     => 'Youtube',
      'google_plus' => 'Google+',
      'linkedin' => 'Linked In',
    );

    $wp_customize->add_section(
        'theme_social_section',
        array(
            'title'       => __('Theme Socials', 'theme-translations'), //translated
            'description' => __('Social links for mobile menu and footer', 'theme-translations'), //translated
            'priority' => 320
        )
    );

    foreach ($socials as $id => $title) {

      $name = "theme_socials[$id]";



      $wp_customize->add_setting(
          $name,
          array(
              'default'    =>  '',
              'transport'  =>  'postMessage',
              'type'       => 'option',
          )
      );

      $wp_customize->add_control(
          $name,
          array(
            'label'   => $title,
            'section' => 'theme_social_section',
            'type'      => 'text',
            'settings' => $name,
            // 'priority' => 2,
            'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
          ) );

        $wp_customize->selective_refresh->add_partial( $name, array(
            'selector' => '.menu-item.social-'.$id,
        ) );
    }
  }


  /**
  * customizer section with social links
  */
  public function add_site_partners( $wp_customize ){

    $wp_customize->add_section(
        'theme_site_partners',
        array(
            'title'       => __('Partners', 'theme-translations'), //translated
            'priority' => 330
        )
    );

    for ($id = 0;  $id < 5; $id++) {

      $title_img = "theme_partners[$id][img]";
      $title_url = "theme_partners[$id][url]";
      $title_url_de = "theme_partners[$id][url_de]";


    $wp_customize->add_setting(
        $title_img,
        array(
            'default'    =>  '',
            'transport'  =>  'postMessage',
            'type'       => 'option',
        )
    );

    $wp_customize->add_control(
      new WP_Customize_Image_Control(
        $wp_customize,
        $title_img,
        array(
          'label'   => __("Partner",'theme-translation').' #'.((int)$id + 1) . ' '. __('banner','theme-translations'),
          'section' => 'theme_site_partners',
          'settings' => $title_img,
          )
      )
    );

      $wp_customize->add_setting(
          $title_url,
          array(
              'default'    =>  '',
              'transport'  =>  'postMessage',
              'type'       => 'option',
          )
      );

      $wp_customize->add_control(
          $title_url,
          array(
            'label'   => __("Partner",'theme-translation').' #'.((int)$id + 1) . ' '. __('url','theme-translations'),
            'section' => 'theme_site_partners',
            'type'      => 'text',
            'settings' => $title_url,
            // 'priority' => 2,
            'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
          ) );


        $wp_customize->selective_refresh->add_partial( $title_url, array(
            'selector' => '.partner-'.$id,
        ) );

        $wp_customize->selective_refresh->add_partial( $title_img, array(
            'selector' => '.partner-'.$id .' img',
        ) );
    }
  }


  public function add_site_contacts( $wp_customize ){
    $contacts = array(
      'phone_call'   => __('Phone for Calls','theme-translations'),
      'whatsup'      => __('Phone For Whats Up' , 'theme-translations'),
      'facebook'     => __('Facebook m.me link', 'theme-translations'),
      'wechat'       => __('WeChat Id', 'theme-translations'),
      'email'        => __('Email', 'theme-translations'),
      'address'      => __('Address','theme-translations'),
    );

    foreach ($contacts as $key => $title) {
    $wp_customize->add_section(
        'theme_contacts_section',
        array(
            'title'       => __('Theme Contacts', 'theme-translations'), //translated
            'description' => __('Contact data for help popup window', 'theme-translations'), //translated
            'priority' => 320
        )
    );

      $name = "theme_contacts[$key]";

      $wp_customize->add_setting(
          $name,
          array(
              'default'    =>  '',
              'transport'  =>  'postMessage',
              'type'       => 'option',
          )
      );

      $args = array(
          'label'   => $title,
          'section' => 'theme_contacts_section',
          'settings' => $name,
          // 'priority' => 2,
          'description' =>__('Keep empty to hide this item', 'theme-translations'), //translated
        );

     $args['type'] = ($key === 'address')? 'textarea' : 'text';

      $wp_customize->add_control($name, $args);
    }
  }

  /**
   * Store site footer section.
   *
   * @param WP_Customize_Manager $wp_customize Theme Customizer object.
   */
  public function add_site_footer( $wp_customize ){

    /*footer settings*/

      $wp_customize->add_section(
          'theme_footer_section',
          array(
              'title'       => __('Theme Footer', 'theme-translations'), //translated
              'description' => __('This section is designed to change displaying of footer settings', 'theme-translations'),  //translated
              'priority' => 310
          )
      );


      /*footer logo setting*/

        $wp_customize->add_setting(
            'tower_footer_text',
            array(
                'default'    =>  '',
                'transport'  =>  'postMessage',
                'type'       => 'option',
            )
        );

        $wp_customize->add_control(
            'tower_footer_text',
            array(
             'label'   => 'Text in footer for tower page',
             'type'      => 'textarea',
             'multiline' => true,
             'section' => 'theme_footer_section',
             'settings' => 'tower_footer_text',
             'priority' => 8 )
        );

        $wp_customize->selective_refresh->add_partial( 'tower_footer_text', array(
            'selector' => '.footer-tower-text',
        ) );


      /*footer logo setting*/

        $wp_customize->add_setting(
            'theme_footer_logo',
            array(
                'default'    =>  '',
                'transport'  =>  'postMessage',
                'type'       => 'option',
            )
        );

        $wp_customize->add_control(
          new WP_Customize_Image_Control(
            $wp_customize,
            'theme_footer_logo',
            array(
              'label' => __('Logo in Footer', 'theme-translations'), //translated
              'section' => 'theme_footer_section',
              'settings' => 'theme_footer_logo',
              'priority' => 8 )
          )
        );

        $wp_customize->selective_refresh->add_partial( 'theme_footer_logo', array(
            'selector' => '.footer-logo',
        ) );


      /*legal disclaimer setting*/

        $wp_customize->add_setting(
            'theme_footer_disclaimer',
            array(
                'default'    => '',
                'transport'  => 'postMessage',
                'type'       => 'option'
            )
        );
        $wp_customize->add_setting(
            'theme_footer_terms',
            array(
                'default'    => '',
                'transport'  => 'postMessage',
                'type'       => 'option'
            )
        );

      $pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
      ));

       $choices = array();

        foreach ($pages as $key => $page) {
          $choices[$page->ID] = $page->post_title;
        }


        $wp_customize->add_control(
          'theme_footer_disclaimer',
          array(
              'section'   => 'theme_footer_section',
              'label'     => __('Legal Disclaimer Page', 'theme-translations'), //translated
              'type'      => 'select',
              'choices' => $choices,
              'settings'  => 'theme_footer_disclaimer',
          )
        );

        $wp_customize->selective_refresh->add_partial( 'theme_footer_disclaimer', array(
            'selector' => '.site-footer .disclaimer-item',
        ) );

        $wp_customize->add_control(
          'theme_footer_terms',
          array(
              'section'   => 'theme_footer_section',
              'label'     => __('Terms & Conditions Page', 'theme-translations'), //translated
              'type'      => 'select',
              'choices' => $choices,
              'settings'  => 'theme_footer_terms',
          )
        );

        $wp_customize->selective_refresh->add_partial( 'theme_footer_terms', array(
            'selector' => '.site-footer .terms-item',
        ) );


        // $wp_customize->add_setting(
        //     'theme_footer_copyrights',
        //     array(
        //         'default'    => '',
        //         'transport'  => 'postMessage',
        //         'type'       => 'option'
        //     )
        // );

        // $wp_customize->add_control(
        //   'theme_footer_copyrights',
        //   array(
        //       'section'   => 'theme_footer_section',
        //       'label'     => __('Legal Disclaimer', 'theme-translations'), //translated
        //       'type'      => 'textarea',
        //       'settings'  => 'theme_footer_copyrights',
        //   )
        // );

        // $wp_customize->selective_refresh->add_partial( 'theme_footer_copyrights', array(
        //     'selector' => '.site-footer .copyrights-item',
        // ) );

    /**/
  }

}

new velesh_theme_customizer();
