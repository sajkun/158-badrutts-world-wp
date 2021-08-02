<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

?>
<div class="container">
  <div class="spacer-h-30 spacer-h-md-80"></div>
  <div class="text-center badrutts-image">
    <img src="<?php echo THEME_URL;?>/assets/images/svg/title2.svg" alt="">
  </div>

  <div class="spacer-h-20"></div>

  <div class="text-center">
    <h2 class="section-title"><?php _e('News', 'theme-translations'); ?></h2>
  </div>

  <div class="spacer-h-30 spacer-h-md-60"></div>

  <div class="row">
  <?php foreach( $query->posts as $post ) :

    $image_id = get_post_thumbnail_id( $post->ID );
    $image_url = wp_get_attachment_image_url( $image_id, 'post_preview');
   ?>
    <div class="col-12 col-md-6 col-lg-4">
      <article class="post-preview">
        <a href="<?php echo get_permalink( $post->ID ); ?>" class="post-preview__image">
          <img src="<?php echo $image_url; ?>" alt="">
        </a>

        <h2 class="post-preview__title"><?php echo $post->post_title; ?></h2>

        <?php if ($post->post_excerpt): ?>
          <p class="post-preview__excerpt"><?php echo $post->post_excerpt; ?></p>
        <?php endif ?>

        <a href="<?php echo get_permalink( $post->ID ); ?>" class="post-preview__readmore"><?php _e('Read More', 'theme-translations'); ?></a>
      </article>
      <div class="spacer-h-50 spacer-h-80"></div>
    </div>

  <?php endforeach; ?>
  </div>


  <div class="text-center">

    <?php
    $args = [
      'base'         => $base.'%_%',
      'format'       => '?blog-post=%#%',
      'total'        => $query->max_num_pages,
      'current'      => $current_page,
      'show_all'     => False,
      'end_size'     => 2,
      'mid_size'     => 0,
      'prev_next'    => true,
      'prev_text'    => '<',
      'next_text'    => '>',
      'type'         => 'list',
      'add_args'     => False,
      'add_fragment' => '',
      'before_page_number' => '',
      'after_page_number'  => ''
    ];
    echo paginate_links( $args ); ?>
  </div>
  <div class="spacer-h-50 spacer-h-md-90"></div>
</div>
