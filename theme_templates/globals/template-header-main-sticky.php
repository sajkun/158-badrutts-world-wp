 <?php $detect = new Mobile_Detect();
if (!$detect->is_mobile() || $detect->is_tablet() && $main_menu):
  ?>
<header class="home-header-sticky tablet-hide">

    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-5">
          <div <?php echo 'style="height:5px"'; ?>></div>
          <span class="weather"> </span>

          <div class="spacer-h-10"></div>
        </div>
        <div class="col-lg-2">
          <div class="sticky-logo">
             <?php echo $logo; ?>
          </div>
        </div>
        <div class="col-lg-5 text-right">
          <?php echo $secondary_menu; ?>
        </div>
      </div>
    </div>
  <div class="container tablet-hide">
    <?php echo $main_menu ?>
  </div>
</header>
  <?php endif ?>