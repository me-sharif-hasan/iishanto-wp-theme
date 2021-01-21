
					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

							</div><!-- post-info -->
							<div class="post-thumb">
								<img src="%post_thumb_url%" alt="%thumb_alt%">
							</div>
							<h3><?php //the_subtitle(); ?></h3>
							<h1 class="title"><b>%post_title%</b></h1>
							<div class="middle-area">
									<h6 class="date">%post_date%</h6>
								</div>

							%post_content%

							<ul class="tags">
								%post_tags_html%
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
								<li><a href=""><i class="ion-heart"></i>57</a></li>
								<li><a href="#comments"><i class="ion-chatbubble"></i>%post_comments%</a></li>
								<li><a><i class="ion-eye"></i>%post_views%</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="https://www.facebook.com/sharer.php?u=%post_url%"><i class="ion-social-facebook"></i></a></li>
								<li><a href="https://twitter.com/intent/tweet?text=%post_title%&url=%post_url%/"><i class="ion-social-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=%post_url%&title=%post_title%"><i class="ion-social-linkedin"></i></a></li>
							</ul>
						</div>

						<div class="post-footer post-info" style="display: none;">

							<div class="left-area">
								<a class="avatar" href="#"><img src="" alt="Profile Image"></a>
							</div>

							<div class="middle-area">
								<a class="name" href="#"><b>Sharif Hasan</b></a>
								<h6 class="date">%post_date%</h6>
							</div>

						</div><!-- post-info -->
					</div><!-- main-post -->