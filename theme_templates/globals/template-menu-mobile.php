<div class="mobile-menu-holder show-tablet">
  <div class="mobile-grey">
    <div class="spacer-h-10"></div>
    <div class="row no-gutters">
      <div class="col-6 text-left">
          <?php echo $top_menu; ?>
      </div>
      <div class="col-6 text-right">
        <span class="weather"></span>
      </div>
    </div>
    <div class="spacer-h-10"></div>
  </div>

  <div class="row no-gutters">

    <?php echo $main_menu; ?>
    <?php echo $secondary_menu; ?>

    <?php if ($socials): ?>
    <nav class="menu-mobile col-12">
      <ul class="social-menu">
        <?php foreach ($socials as $id => $url):
          if(!$url) {continue;}
          ?>
          <li class="menu-item social-<?php echo $id ?>"><a href="<?php echo $url ?>" target="_blank"><svg class="svg-icon-<?php echo $id?>"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-<?php echo $id?>"></use></a></li>
        <?php endforeach ?>
      </ul>
    </nav>
    <?php endif ?>
  </div>

  <div class="spacer-h-30"></div>
</div>