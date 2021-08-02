<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

//remove style and shape from a tab

function change_tabs_params(){
  vc_remove_param( 'vc_tta_tabs', 'style');
  vc_remove_param( 'vc_tta_tabs', 'shape');
}


add_action('vc_after_init', 'change_tabs_params');


// add separator to tabs
function modify_tabs_selector($html, $atts, $content, $object){
  foreach ($html as $key => $part) {
    if(strpos($part, '</li>') >= 0){
      $html[$key] = str_replace('</li>' , '</li><li class="separator"><span></span></li>',$html[$key]);
    }
  }
  return $html;
}

add_filter('vc-tta-get-params-tabs-list', 'modify_tabs_selector', 10, 4);