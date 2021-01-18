
<?php get_header();
add_styles(get_bloginfo( 'template_url' )."/layout-1/css/responsive.css","iishanto_index_responsive");
?>

	<?php if(is_category()): ?>
	<div class="slider">
		<div class="display-table  center-text" style="padding: 20px;">
		<h1 class="title"><b><?php single_term_title(); ?></b></h1>
		<?php echo term_description(); ?>
		</div>
	</div><!-- slider -->
	<?php endif; ?>


<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">
<?php post_render() ?>

					</div><!-- row -->
					<div class="page-navi">
			<?php iishanto_number_pagination(); ?>
		</div>

				</div><!-- col-lg-8 col-md-12 -->

				







				<div class="col-lg-4 col-md-12 no-left-padding">

					<?php get_sidebar() ?>
				</div>


			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->


	<?php get_footer() ?>

</body>
</html>