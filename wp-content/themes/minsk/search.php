<?php get_header(); ?>
		<!--slider-->   
        <div class="container-fluid">
            <div class="row">
               <?php layerslider(1) ?>
            </div>
        </div>
	    <!--slider end-->
		<div class="container">
			<div class="row mt mb">
				<div class="posts col-md-12">
						<?php
						$bs_clearfix = 0;
							if (have_posts()) :  while (have_posts()) : the_post(); 
						    $clearfix = bootstrap_clearfix( $bs_clearfix, array( 'xs' => 12, 'sm' => 6, 'md' => 3, 'lg' => 3 ) );
						    echo $clearfix;
						    $bs_clearfix ++;
						    ?>
						        <div class="posts-block col-md-3 col-sm-6">
									<div class="posts-block-items">
										<div class="posts-meta"><a href="<?php the_permalink(); ?>">
											<?php 
										    $sep = '';
										    foreach ((get_the_category()) as $cat) {
										        echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
										        $sep = ', ';
										    }
											?></a>
										</div>
										<div class="posts-thumb">
											<div class="posts-thumb-image">
												<a href="<?php the_permalink(); ?>" class="img-responsive">
												<?php 
												if( has_post_thumbnail() ) {
														the_post_thumbnail('post-block');
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
										<div class="posts-excerpt">
											<p><a class="" href="<?php the_permalink(); ?>">
													<?php 
													add_filter('the_excerpt', function ($excerpt) {
													    return substr($excerpt,0,strpos($excerpt,'.')+1);
													  }
													);
											the_excerpt(); ?></a><a class="read-more" href="<?php the_permalink(); ?>">Read more</a></p>
										</div>
									</div>
								</div>
						<?php endwhile; wp_reset_query(); ?>
					</div>
				</div>
			</div>	
<?php get_footer(); ?>	
		<?php else: ?>
		<h3 class="text-center">По вашему запросу ничего не найдено...</h3>
		</div>
	</div>


<?php endif; ?>	

	</body>
</html>