<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
 global $wp_registered_sidebars, $wp_registered_widgets;

    $social_names = array(
      'instagram'   => 'Instagram',
      'twitter'     => 'Twitter',
      'facebook'    => 'Facebook',
      'youtube'     => 'Youtube',
      'google_plus' => 'Google+',
      'linkedin' => 'LinkedIn',
    );

$locality = 'EN';
?>

<footer class="site-footer">
    <div class="container-lg">
      <div class="clearfix text-center">
        <?php echo $logo; ?>
      </div>

      <div class="spacer-h-30 spacer-h-lg-60"></div>
      <?php if ($socials): ?>
        <div class="clearfix text-center">
          <p class="widget-title"><?php _e('Follow us','theme-translations'); //translated?></p>
          <ul class="social-menu">
              <?php
                foreach ($socials as $id => $url):
                  if(empty(trim($url))) {continue;}
               ?>
                <li class="menu-item social-<?php echo $id ?>">
                  <a href="<?php echo $url ?>"title="<?php echo $social_names[$id] ?>" target="_blank">
                      <svg class="svg-icon-<?php echo $id?>">
                          <use xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="#svg-icon-<?php echo $id?>"></use>
                      </svg>
                  </a>
                </li>
              <?php endforeach ?>
          </ul>
      </div>
     <?php endif ?>


    <div class="spacer-md-h-60 spacer-h-30"></div>
    </div><!-- container -->

    <div class="site-footer__bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md valign-center-md order-1 order-md-0">
                    <ul class="copyrights">
                        <li class="copyrights-item"><?php echo $copyrights; ?></li>
                        <?php if ($disclaimer_url): ?>
                        <li class="disclaimer-item"><a
                                href="<?php echo esc_url($disclaimer_url) ?>"><?php _e('Legal Disclaimer', 'theme-translations')?></a>
                        </li>
                        <?php endif ?>
                        <?php if ($terms_url): ?>
                        <li class="terms-item"><a
                                href="<?php echo esc_url($terms_url) ?>"><?php _e('Terms & Conditions', 'theme-translations')?></a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>

                <?php if ($email): ?>
                <div class="col-12 col-md valign-center-md hide-mobile text-center email-footer">
                    <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
                </div>
                <?php endif ?>

                <div class="col-12 col-md order-0 order-md-1">
                    <?php if ($partners): ?>
                    <div class="spacer-h-20 spacer-h-md-0" ></div>
                    <div class="partners text-right-md">
                        <?php foreach ($partners as $id => $p):
                            if(!$p['url'] || !$p['img']) continue;
                         ?>
                            <?php
                                if (function_exists('pll_current_language')) {
                                    switch (pll_current_language('slug')) {
                                        case 'de':
                                            $may_be_url = $p['url_de'];
                                            break;
                                    }
                                    $url = ($may_be_url) ?: $p['url'];
                                }else{
                                    $url = $p['url'];
                                }
                             ?>
                        <a href="<?php echo   $url ? esc_url( $url ): 'javascript:void(0)' ?>"
                            class="partner-<?php echo $id;?>" target="_blank"><img
                                src="<?php echo esc_url($p['img']) ?>" alt=""></a>
                        <?php endforeach ?>
                    </div>
                    <?php endif ?>
                </div>
            </div><!-- row -->
            <div class="spacer-h-30 spacer-h-md-0"></div>
        </div><!-- container -->
    </div><!-- site-footer__bottom -->
</footer>

