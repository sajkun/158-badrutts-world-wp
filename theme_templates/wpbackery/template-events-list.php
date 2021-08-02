<div>
  <div class="container container-xxl no-paddings">

    <?php if (count($events) == 0): ?>

    <div class="text-center" >
      <p class="section-comment"> <?php _e('No events scheduled in this month', 'theme-translations'); ?></p>
      <div class="spacer-h-30"></div>
    </div>

    <?php
     return '';
     endif ?>
    <?php
      $class = '';
    foreach ($events as $key => $e):
      clog($e->meta->date_n_time->comments_about_date_and_time);
      // continue;
      ?>
    <div class="hotel-item row no-gutters">
      <div class="col-12 col-md-6 <?php echo $class ?>">
        <div class="hotel-item__image">
          <img src="<?php echo $e->image_url; ?>" alt="">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="hotel-item__content">
          <div class="hotel-item__content-inner">
            <?php if ( $e->meta->category_display ): ?>
           <p class="hotel-item__categories" v-if="event.meta.category_display">
            <?php echo $e->meta->category_display; ?></p>
            <?php endif ?>

            <?php if ($e->post_title): ?>
            <h3 class="hotel-item__title"><?php echo $e->post_title; ?></h3>
            <div class="spacer-h-40"></div>
            <?php endif ?>
            <?php if ($e->post_content): ?>
            <p class="hotel-item__text" v-if="event.post_content"> <?php echo $e->post_content; ?> </p>
            <div class="spacer-h-20"></div>
            <?php endif ?>

            <?php if (
               $e->meta->date_n_time->date_start_formatted ||
               $e->meta->date_n_time->date_end_formatted  ||
               $e->meta->date_n_time->comments_about_date_and_time
            ): ?>


            <div class="row no-gutters text-left">
              <div class="col-3 col-md-2 col-xl-2 text-center text-center-lg">
                  <svg class="svg-icon-clock"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-clock"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                <span class="hotel-item__sub-text2"><?php _e('DATE & TIME', 'theme-translations'); ?></span>
                  <p class="hotel-item__text"><?php echo  $e->meta->date_n_time->date_start_formatted; ?>

                  <?php if ($e->meta->date_n_time->date_start_formatted && $e->meta->date_n_time->date_end_formatted): ?>
                    -
                  <?php endif ?>

                    <?php echo $e->meta->date_n_time->date_end_formatted?>

                  <?php if ($e->meta->date_n_time->date_start_formatted && $e->meta->date_n_time->date_end_formatted): ?>
                    <br>
                  <?php endif ?>

                  <?php echo  $e->meta->date_n_time->comments_about_date_and_time ?></p>
              </div>
            </div>
            <div class="spacer-h-10"></div>
            <?php endif ?>

            <?php if (
               $e->meta->location
            ): ?>
            <div class="row no-gutters text-left">
              <div class="col-3 col-md-2 col-xl-2 text-center  text-center-lg">
                <svg class="svg-icon-geo"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-geo"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                  <span class="hotel-item__sub-text2"><?php _e('Location', 'theme-translations')?></span>
                  <p class="hotel-item__text"><span><?php echo   $e->meta->location;?></span></p>
              </div>
            </div>
            <div class="spacer-h-10"></div>
            <?php endif ?>


             <?php if (
               $e->meta->reservation->phone ||
               $e->meta->reservation->email
            ): ?>

            <div class="row no-gutters text-left">
              <div class="col-3 col-md-2 col-xl-2 text-center  text-center-lg">
                <svg class="svg-icon-call2"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-call2"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                <span class="hotel-item__sub-text2"><?php _e('Reservation', 'theme-translations')?></span>
                  <p class="hotel-item__text">
                 <?php if ($e->meta->reservation->phone ): ?>
                    <a href="tel:<?php echo  $e->meta->reservation->phone;?>"><?php echo  $e->meta->reservation->phone;?></a>
                    <br>
                  <?php endif ?>
                   <?php if ( $e->meta->reservation->email ): ?>
                    <a href="mailto:<?php echo  $e->meta->reservation->email;?>"><?php echo  $e->meta->reservation->email ;?></a>
                  <?php endif ?>
                  </p>
              </div>
            </div>
            <?php endif ?>

             <?php if ($e->meta->external_link ): ?>
            <div class="spacer-h-30"></div>
            <a href="<?php echo  $e->meta->external_link;?>" target="_blank" class="featured__item-button"><?php echo  $e->meta->external_link_title;?></a>
            <?php endif ?>
          </div><!-- hotel-item__content-inner -->
        </div>
      </div>
    </div><!-- hotel-item -->

    <?php $class = $class == ''? 'order-md-2' : '' ?>


    <?php endforeach; ?>
  </div>


</div>