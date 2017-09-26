<?php get_header(); ?>
	<?php if (have_posts()) :  while(have_posts()) : the_post(); ?>
	<div class="container">
		<div class="row">
			<div class="left col-md-3 col-sm-12">
				<?php get_sidebar(2); ?>
			</div>
			<div class="col-md-9 col-sm-12">
				<div class="posts-thumb">
											<div class="posts-thumb-image">
												<a href="<?php the_permalink(); ?>" class="img-responsive">
												<?php 
												if( has_post_thumbnail() ) {
														the_post_thumbnail('');
												?></a>
												<a href="<?php the_permalink(); ?>"><div class="gradient"></div></a>
												<div class="posts-thumb-image-caption">
													<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												</div>
												
												<?php }	else {
												?>
												<div class="posts-thumb-image-caption2">
													<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												</div>
												<?php } ?>
											</div>
				</div>
				<?php the_content(); ?>
			</div>							
		</div>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>		
<?php wp_footer(); ?>
	</body>
</html>