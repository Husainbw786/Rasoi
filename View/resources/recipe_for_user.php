<section class="my-4" id="recipe_for_user">
	<!--Secion heading-->
	<div class="row mt-5 mb-4">
		<div class="col-md-12">
			<div class="divider-new">
				<h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">Just For You</h3>
			</div>
		</div>
		<div class="col-md-12">
			<!-- <div id="mdb-lightbox-ui"></div> -->
			<div class="row">
				<?php
				for ($i=0; $i <6 ; $i++) {
				echo '<figure class="col-md-4">
						<input type="hidden" name="id">
						<img  style="cursor:pointer" data-toggle="tooltip" title="" src="" class="img-fluid z-depth-1-half">
					</figure>';
				}
				?>
			</div>
		</div>
		<div class="text-center mt-5 col-md-12">
            <a class="refresh"><i class="fas fa-forward fa-2x"></i></a>
          </div>
	</div>
</section>