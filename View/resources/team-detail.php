<!--First column-->
<div class="col-md-4 mb-4 wow fadeIn" data-wow-delay="0.4s">
  <div class="testimonial">
  <!--Avatar-->
    <div class="avatar mx-auto mb-4">
      <img src="<?php echo $img; ?>" class="rounded-circle img-fluid z-depth-1-half">
    </div>
  <!--Content-->
    <h4 class="font-weight-bold">
      <?php echo $name; ?>
    </h4>
    <p>
      <i class="fas fa-quote-left "></i>
      <strong> 
        <?php echo $txt; ?>
      </strong>
    </p>
  </div>
  <!-- Grid column -->
  <div class="mb-5 text-center align-content-center">
    <!-- Facebook -->
    <?php echo $fb; ?>
    <!-- Twitter -->
     <?php echo $twitter; ?>
    <!--Linkedin -->
     <?php echo $linkdin;?>
    <!--Instagram-->
    <?php echo $insta; ?>
  </div>
</div>
<!--/First column-->

  <!-- Grid column -->