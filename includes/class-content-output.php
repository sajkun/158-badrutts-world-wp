<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * The main output class
 *
 * @package theme/output
 *
 * @since v1.0
 */
class theme_content_output{

  /**
  * prints header
  *
  * @hookedto do_theme_header 10 @see class-page-constructor.php
  */
  public static function print_header(){
    // get saved data from WordPress
    $obj            = get_queried_object();
    $locale = function_exists('pll_current_language')? pll_current_language() : 'en';

    $winter_site_id = get_home_page_id('winter',  $locale );
    $summer_site_id = get_home_page_id('summer',  $locale );

    // if current page has splash_page shortcode exit
    if($obj && $obj->post_content && strpos($obj->post_content, 'splash_page')){
      return;
    }

    // detect home url, depending on season
    $home = HOME_URL;

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    $custom_logo_url = ($custom_logo_url)? $custom_logo_url : THEME_URL.'/assets/images/logo.svg';

    $logo = (!is_front_page())? sprintf('<a href="%1$s" class="header-logo hide-tablet"><img src="%2$s" alt="%3$s" title="%3$s"></a>', $home , $custom_logo_url, get_option('blogname')) : sprintf('<span class="header-logo hide-tablet"><img src="%1$s" alt="%2$s" title="%2$s"></span>', $custom_logo_url, get_option('blogname')) ;

    $custom_logo_url_mob = get_option('theme_header_logo_mob')? get_option('theme_header_logo_mob'): THEME_URL.'/assets/images/mobile_logo.svg';;

    $logo_mobile = (!is_front_page())? sprintf('<a href="%1$s" class="header-logo show-tablet"><img src="%2$s" alt="%3$s" title="%3$s"></a>',  $home , $custom_logo_url_mob, get_option('blogname')) : sprintf('<span class="header-logo show-tablet"><img src="%1$s" alt="%2$s" title="%2$s"></span>', $custom_logo_url_mob, get_option('blogname')) ;


    $main_menu = wp_nav_menu( array(
      'theme_location'  => 'main_menu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'main-menu-holder',
      'container_id'    => '',
      'menu_class'      => 'main-menu',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 2,
    ) );

    $main_menu_sticky = wp_nav_menu( array(
      'theme_location'  => 'main_menu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'main-menu-holder',
      'container_id'    => '',
      'menu_class'      => 'main-menu',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 1,
    ) );



    $addon = sprintf('<li class="menu-item"><a href="%s">%s</a></li>', $home, __('Home','theme-translations'));

    ob_start();
    theme_print_lang_switcher('desktop');
    $lang_switcher = ob_get_contents();
    ob_get_clean();

    $addon .= ($lang_switcher) ? sprintf('<li class="menu-item">%s</li>', $lang_switcher) : '';

    $secondary_menu =  wp_nav_menu( array(
      'theme_location'  => 'header_sub_menu',
      'menu'            => '',
      'container'       => '',
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => 'header-submenu',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul class="%2$s">'.$addon.'%3$s</ul>',
      'depth'           => 1,
    ) );

    $secondary_menu = (  $secondary_menu )?   $secondary_menu : sprintf('<ul class="header-submenu">%s </ul>',$addon);

    $args = array(
      'logo'            => $logo,
      'logo_mobile'     => $logo_mobile,
      'main_menu'       => $main_menu,
      'secondary_menu'  => $secondary_menu,
      'class'     => is_front_page()? 'site-header fix-header' : 'site-header',
      'spacer'     => is_front_page()? true : false,
    );

    // print_theme_template_part('header-main-sticky', 'globals', $args);

    print_theme_template_part('header', 'globals', $args);
  }


  public static function print_header_tower(){
    ob_start();
    theme_print_lang_switcher('desktop');
    $lang_switcher = ob_get_contents();
    ob_get_clean();

    $switcher .= ($lang_switcher) ? sprintf('<ul class="header-submenu"><li class="menu-item">%s</li></ul>', $lang_switcher) : '';

    $custom_logo_url = THEME_URL. '/assets/images/tower_logo.svg';

    $home = 'javascript:void(0)';

    $logo = (!is_front_page())? sprintf('<a href="%1$s" class="header-logo-tower"><img src="%2$s" alt="%3$s" title="%3$s"></a>', $home , $custom_logo_url, get_option('blogname')) : sprintf('<span class="header-logo-tower"><img src="%1$s" alt="%2$s" title="%2$s"></span>', $custom_logo_url, get_option('blogname')) ;


    $main_menu = wp_nav_menu( array(
      'theme_location'  => 'main_menu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'main-menu-holder',
      'container_id'    => '',
      'menu_class'      => 'main-menu',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 2,
    ) );

    $args = array(
      'switcher' => $switcher,
      'logo' => $logo,
      'main_menu' => $main_menu,
    );

    print_theme_template_part('header-tower', 'globals', $args);
  }

  /**
  * Prints footer
  *
  * @hookedto do_theme_footer 10 @see class-page-constructor.php
  */
  public static function print_footer(){

    $custom_logo_url = get_option('theme_footer_logo')? get_option('theme_footer_logo'): THEME_URL.'/assets/images/footer_logo.svg';

    $logo = (!is_front_page())? sprintf('<a href="%s" class="footer-logo"><img src="%s" alt="%s"></a>', home_url() , $custom_logo_url, get_option('blogname')) : sprintf('<h1 class="footer-logo"><img src="%s" alt="%s"></h1>', $custom_logo_url, get_option('blogname')) ;


    ob_start();
    $copyrights = "";
     if(is_active_sidebar('copyrights')){
       dynamic_sidebar('copyrights');
     }

    $copyrights = ob_get_contents();
    ob_get_clean();
    $date = new DateTime('now');
    $copyrights = str_replace('{year}', $date->format('Y'), $copyrights );



    $disclaimer_id = (function_exists('get_lang_post_id'))? get_lang_post_id(get_option('theme_footer_disclaimer')) : get_option('theme_footer_disclaimer');

    $terms_id = (function_exists('get_lang_post_id'))? get_lang_post_id(get_option('theme_footer_terms')) : get_option('theme_footer_terms');

    $o = get_option('theme_contacts');


    $args = array(
      'socials'     => get_option('theme_socials'),
      'partners'    => get_option('theme_partners'),
      'copyrights'  => $copyrights,
      'logo'        => $logo,
      'email'        => $o['email'],
      'disclaimer_url' =>(  $disclaimer_id)? get_permalink($disclaimer_id) : false,
      'terms_url'      => $terms_id ? get_permalink($terms_id) : false,
    );

    print_theme_template_part('footer', 'globals', $args);
  }

  /**
  * Prints footer
  *
  * @hookedto do_theme_footer 10 @see class-page-constructor.php
  */
  public static function print_footer_tower(){

    $menu = wp_nav_menu( array(
      'theme_location'  => 'tower_footer',
      'menu'            => '',
      'container'       => '',
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => 'tower-footer-menu',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 1,
    ) );

    $args = array(
      'menu' => $menu,
      'text' => get_option('tower_footer_text'),
    );

     print_theme_template_part('footer-tower', 'globals', $args);
  }

  /**
  * prints mobile menu
  *
  * @hookedto do_theme_after_footer 10 @see class-page-constructor.php
  */
  public static function print_menu_mobile(){
    $obj = get_queried_object();

    $main_menu = wp_nav_menu( array(
      'theme_location'  => 'main_menu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'menu-mobile col-12',
      'container_id'    => '',
      'menu_class'      => 'menu-mobile__list',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 1,
    ) );

    $secondary_menu = wp_nav_menu( array(
      'theme_location'  => 'mobile_submenu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'menu-mobile col-12',
      'container_id'    => '',
      'menu_class'      => 'menu-mobile__list',
      'menu_id'         => '',
      'echo'            => false,
      'fallback_cb'     => '',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 1,
    ) );




    ob_start();
    theme_print_lang_switcher('mobile');
    $lang_switcher = ob_get_contents();
    ob_get_clean();

    $addon = ($lang_switcher) ? sprintf('<li class="menu-item">%s</li>', $lang_switcher) : '';

    $top_menu = sprintf('<ul class="header-submenu">%s </ul>',$addon);

    $args = array(
      'main_menu'       => $main_menu,
      'secondary_menu'  => $secondary_menu,
      'top_menu'        => $top_menu,
      'book_url'        => $book_url,
      'socials'         => get_option('theme_socials'),
    );

    print_theme_template_part('menu-mobile', 'globals', $args);
  }

  /**
  * Prints content of a page
  *
  * @hookedto do_theme_content 10 @see class-page-constructor.php
  */
  public static function print_content_page(){
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
       echo '<div class="container container-xxl">';
        the_content();
       echo'</div>';
      endwhile;
    endif;
  }

  /**
  * Prints notification about cookies
  *
  * @hookedto do_theme_after_footer 10 @see class-page-constructor.php
  */
  public static function print_cookie_text(){

    if(isset($_COOKIE['cookie_policy']) && $_COOKIE['cookie_policy'] =='yes'){
      return;
    }

    $legal_id = 28;

    $legal_id  = pll_get_post( $legal_id );


    echo '<div class="cookie-policy">';
    echo '<div class="container text-center">';
      _e('By continuing to browse or by clicking Accept you agree to first- and third-party cookies on your device to enhance site navigation, analyze site usage and assist in our marketing efforts.', 'theme-translations');

      echo ' <a href="'.get_permalink($legal_id ).'" class="">'.__('Read our legal disclaimer','theme-translations').'</a> ';
      echo '<div class="clearfix"></div><br>';
      echo ' <a href="javascript:void(0)" class="accept-cookie">'.__('Accept','theme-translations').'</a> ';

    echo '</div>';
    echo '</div>';

  }


  /**
  * Prints list of post's previews
  *
  * @hookedto do_theme_content 10 @see class-page-constructor.php
  */
  public static function print_blog_list(){
    global $posts;

    $current_page = !empty( $_GET['blog-post'] ) ? $_GET['blog-post'] : 1;

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => get_option('posts_per_page'),
      'paged'   => $current_page,
    );

    $query = new WP_Query( $args );
    unset($args);

    $args = array(
      'query' => $query,
      'current_page' => $current_page,
      'base' => get_permalink(get_option('page_for_posts')),
    );


    print_theme_template_part('blog', 'globals', $args);
  }


  /**
  * Prints single post content
  *
  * @hookedto do_theme_content 10 @see class-page-constructor.php
  */
  public static function print_blog_post(){
    global $post;
    $image_id = get_post_thumbnail_id( $post->ID );
    $image_url = wp_get_attachment_image_url( $image_id, 'full');

    $args = array(
      'image_url'=> $image_url,
    );

    print_theme_template_part('blog-post', 'globals', $args);
  }


  /**
  * prints help section
  *
  * @hookedto do_theme_content 10 @see class-page-constructor.php
  */
  public static function print_messages(){
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    $custom_logo_url =  THEME_URL.'/assets/images/footer_logo.svg';
    $site_type      = detect_season();
    $winter_site_id = get_home_page_id('winter');
    $summer_site_id = get_home_page_id('summer');

    $home = ($site_type === 'summer')? get_permalink( $summer_site_id  ) : get_permalink( $winter_site_id  );

    $logo = (!is_front_page())? sprintf('<a href="%1$s" hide-tablet"><img src="%2$s" alt="%3$s" title="%3$s"></a>', $home , $custom_logo_url, get_option('blogname')) : sprintf('<span class=""><img src="%1$s" alt="%2$s" title="%2$s"></span>', $custom_logo_url, get_option('blogname')) ;

    $args = array(
      'logo' => $logo,
      'theme_contacts' => get_option('theme_contacts'),
    );

    print_theme_template_part('messages', 'globals', $args);
  }



  public static function print_tower_revue(){
    echo '<iframe id="trframe" src="https://towerrevue.com" frameborder="0"></iframe>';

    echo "<style>
    #trframe{
      width: 100vw;
      height: calc(100vh - 63px);
    }
    .admin-bar #trframe{
      height: calc(100vh - 99px);
    }
    </style>";
  }
}








