<?php get_header(); ?>
<?php
add_styles(get_template_directory_uri()."/single-post-1/css/styles.css",'single-post-1');
add_styles(get_template_directory_uri()."/single-post-1/css/responsive.css",'single-post-responsive');
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
<style type="text/css">
	.post-footer{
		display: none;
	}
</style>


	<?php get_footer(); ?>

</body>
</html>