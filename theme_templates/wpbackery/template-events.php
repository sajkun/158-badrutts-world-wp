<?php

?>

<?php if (!$hide_categories): ?>
  <div class="tabs">
    <div class="">
      <ul class="tabs__list">
        <li class="active tabs__item event_term" data-term='all'><label><?php _e('All','theme-translations') ?></label></li>
        <?php foreach ($terms as $key => $term): ?>
        <li class="separator"><span></span></li>
        <li class="tabs__item event_term" data-term="<?php echo $term->term_id; ?>"><label><?php echo get_term_meta($term->term_id, 'display_name', true)?  get_term_meta($term->term_id, 'display_name', true) : $term->name; ?></label></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
<?php endif ?>

  <div class="spacer-h-30 spacer-h-md-70"></div>
    <div class="date-selector">
      <span class="prev visaullyhidden">
        <svg class="svg-icon-next"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-next"></use>
      </span>
      <span class="date-selector__value">
        <?php $month = $date->format('F');

        echo _e($month,'theme-translations'); ?>
        <?php echo $date->format('Y'); ?>
      </span>
      <span class="next">
        <svg class="svg-icon-next"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-next"></use>
      </span>
    </div>
  <div class="spacer-h-30 spacer-h-md-70"></div>

<div id="events">
  <input type="hidden" ref="season" value="<?php echo $season; ?>">
  <div class="container container-xxl no-paddings hidden" id="events-body">
    <div class="text-center" v-if="events_filtered.length == 0">
      <p class="section-comment"> <?php _e('No events scheduled in this month', 'theme-translations'); ?></p>
      <div class="spacer-h-30"></div>
    </div>
    <div class="hotel-item row no-gutters"  v-for="(event, key) in events_filtered"  :key="event.ID">
      <div class="col-12 col-md-6" v-bind:class="{'order-md-2': key % 2 > 0}">
        <div class="hotel-item__image">
          <img v-bind:src="event.image_url" alt="">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="hotel-item__content">
          <div class="hotel-item__content-inner">
           <p class="hotel-item__categories" v-if="event.meta.category_display">{{event.meta.category_display}}</p>
            <h3 class="hotel-item__title">{{event.post_title}}</h3>
            <div class="spacer-h-40"></div>
            <p class="hotel-item__text" v-if="event.post_content">
              {{event.post_content}} </p>
            <div class="spacer-h-20"></div>

            <div class="row no-gutters text-left"  v-if="event.meta.date_n_time.date_start_formatted || event.meta.date_n_time.date_end_formatted || event.meta.date_n_time.comments_about_date_and_time">
              <div class="col-3 col-md-2 col-xl-1 text-left">
                  <svg class="svg-icon-clock"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-clock"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                <span class="hotel-item__sub-text2"><?php _e('DATE & TIME', 'theme-translations'); ?></span>
                  <p class="hotel-item__text">{{event.meta.date_n_time.date_start_formatted}} <span v-if="event.meta.date_n_time.date_start_formatted && event.meta.date_n_time.date_end_formatted">-</span> {{event.meta.date_n_time.date_end_formatted}} <br>{{event.meta.date_n_time.comments_about_date_and_time}}</p>
              </div>
            </div>
            <div class="spacer-h-10" v-if="event.meta.date_n_time.date_start_formatted || event.meta.date_n_time.date_end_formatted || event.meta.date_n_time.comments_about_date_and_time"></div>

            <div class="row no-gutters text-left" v-if="event.meta.location">
              <div class="col-3 col-md-2 col-xl-1 text-left">
                <svg class="svg-icon-geo"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-geo"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                  <span class="hotel-item__sub-text2"><?php _e('Location', 'theme-translations')?></span>
                  <p class="hotel-item__text"><span>{{event.meta.location }}</span></p>
              </div>
            </div>
            <div class="spacer-h-10" v-if="event.meta.location"></div>

            <div class="row no-gutters text-left" v-if="event.meta.reservation.phone || event.meta.reservation.email ">
              <div class="col-3 col-md-2 col-xl-1 text-left">
                <svg class="svg-icon-call2"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-call2"></use>
              </div>
              <div class="col-9 col-md-9 offset-md-05">
                <span class="hotel-item__sub-text2"><?php _e('Reservation', 'theme-translations')?></span>
                  <p class="hotel-item__text">
                    <a :href="'tel:' + event.meta.reservation.phone " v-if="event.meta.reservation.phone">{{event.meta.reservation.phone }}</a> <br v-if="event.meta.reservation.phone">
                    <a :href="'mailto:' + event.meta.reservation.email " v-if="event.meta.reservation.email">{{event.meta.reservation.email }}</a>
                  </p>
              </div>
            </div>

            <div class="spacer-h-30" v-if="event.meta.external_link"></div>

            <a :href="event.meta.external_link" target="_blank" v-if="event.meta.external_link"  class="featured__item-button">{{event.meta.external_link_title}}</a>
          </div><!-- hotel-item__content-inner -->
        </div>
      </div>
    </div><!-- hotel-item -->
  </div>

  <div class="text-center" v-if="counter > show">
    <a href="javascript:void(0)" class="button" v-on:click="show = 99999"><?php _e('Load More', 'theme-translations')?></a>
  </div>
  <div class="spacer-h-30"></div>
  <div class="spacer-h-30"></div>
</div>