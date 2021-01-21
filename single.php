<?php get_header(); ?>
<?php
add_styles(get_template_directory_uri()."/single-post-1/css/styles.css",'single-post-1');
add_styles(get_template_directory_uri()."/single-post-1/css/responsive.css",'single-post-responsive');
add_styles(get_template_directory_uri()."/single-post-1/css/jannah.min.css",'single-post-responsive');
?>
	<div class="slider" style="display: none;">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>DESIGN</b></h1>
		</div>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">
					<?php post_render(true) ?>
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<?php get_sidebar(); ?>

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">



<?php 
$popularpost = new WP_Query( array( 'posts_per_page' => 3, 'meta_key' => 'iishanto_post_views', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
post_render(false,$popularpost);
 
?>

			</div><!-- row -->

		</div><!-- container -->
	</section>

					<?php 
					 if ( comments_open() || get_comments_number() ){
     					comments_template();
     				}
					 ?>

					<!--<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>-->

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<?php get_footer(); ?>

</body>
</html>