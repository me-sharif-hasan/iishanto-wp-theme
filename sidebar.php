<div class="single-post info-area">
	<?php 
		if(is_single()){
			get_dynamic_sidebar('iishanto_single_post_right_sidebar');
		}else{
			get_dynamic_sidebar('iishanto_right_sidebar');
		}
	 ?>

</div>