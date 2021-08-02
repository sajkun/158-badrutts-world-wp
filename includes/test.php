<?php

if(!THEME_DEBUG){
  return false;
}

add_filter('wp_link_query_args', 'test_wp_link_query_args', PHP_INT_MAX);

function test_wp_link_query_args($query){
  $query['post_type'] = array('theme_room', 'theme_restaurants');
  $query['posts_per_page'] = 10;
  print_theme_log( $query );

  if(isset($query['s']) && !empty($query['s'])){

    if(strpos($query['s'], 'room')!==false){
      $query['post_type'] = array('theme_room');
      $query['s'] = trim(str_replace('room', '' ,$query['s'] ));
    }

    if(strpos($query['s'], 'restaurant')!==false){
      $query['post_type'] = array('theme_restaurants');
      $query['s'] = trim(str_replace('restaurant', '' ,$query['s'] ));
    }

    if(strpos($query['s'], 'page')!==false){
      $query['post_type'] = array('page');
      $query['s'] = trim(str_replace('page', '' ,$query['s'] ));
    }

    if(strpos($query['s'], 'post')!==false){
      $query['post_type'] = array('post');
      $query['s'] = trim(str_replace('post', '' ,$query['s'] ));
    }
  }

  return $query ;
}

add_filter('wp_link_query', 'test_wp_link_query', PHP_INT_MAX, 2);

function test_wp_link_query( $results, $query ){

  return $results;
}