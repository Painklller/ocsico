<?php get_header(); ?>
	<!--slider-->   
        <div class="container-fluid">
            <div class="row">
               <?php layerslider(1) ?>
            </div>
        </div>
    <!--slider end-->
		<div class="container">
			<div class="row mt">
				<div class="featured">
			<?php // adding query for Db
		        $args = array(
		            'posts_per_page' => 3,
		            'tag' => 'featured'
		        );

		        $query = new WP_Query( $args );
		        // carusel
		        if ( $query->have_posts() ) {
		            while ( $query->have_posts() ) {
		                $query->the_post();
		            }
		        } else {
		        }
		        wp_reset_postdata();?>

		    <?php
		        //Set the initial count outside of the loop.
		        $count = (int)1;
		        //Start the post loop
		        while ($query->have_posts()) : $query->the_post();
		    ?>
		    	<div class="featured-items">
		        <?php
		            //Set the span to our default span12
		            $span = 'block1 col-md-7 col-sm-12';
		            $image = 'grid-slider-b-large'; //adding size
		            //If the count is 2 or 3 change span to be span3
		            if($count == 2 || $count == 3){
		            $span = 'block2 col-md-5 col-sm-6 col-xs-6 col-xxs-12';
		            $image = 'grid-slider-b-med'; //adding size
		            }
		            //If the count is equal to 3 or higher (which it should not be) then reset the count to 0
		            if($count >= 3){
		            $count = 0;
		            }
		            //If its not 3 or higher, increase the count
		            else{
		            $count++;
		            }
		        ?>

		            <div class="<?php echo $span; ?>">
		                <a class="link img-responsive" href="<?php the_permalink(); ?>">
		                <?php the_post_thumbnail($image);?>
		                </a>
		                <div class="caption">
		                    <span class="meta">
		                    				<?php 
										    $sep = '';
										    foreach ((get_the_category()) as $cat) {
										        echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
										        $sep = ', ';
										    }
											?></a></span>
		                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  
		                </div>
		            </div>

		            <?php
		             //End the post loop
		             endwhile; 
		            ?>
		       		</div>
		     	</div>
		    </div>
		</div>
		</div>
		<div class="row mt">
			<div class="sidebar-1 col-md-3">
					<?php get_sidebar(1); ?>
			</div>
			<div class="memories col-md-6">
				<h4 >Memories</h4>
			</div>
			<div class="filter col-md-3">
				<div class="filter-items pull-right">
					<?php
						http_build_query(array('tag__not_in'=> 8,"8"=>null));
						if($_REQUEST['sort'] == 'oldest' )
						$order = "&orderby=date&order=ASC&tag__not_in=8"; 
						else 
						$order ="orderby=date&order=DESC&tag__not_in=8";
						?>
						<form method="post" id="order">
						<div class="select-style">
						<select name="sort" id="sortbox" onchange='this.form.submit()'>
						<option value="newest" <?php if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 'newest' ){ ?> selected="selected" <?php } ?> >Lates added</option> 
						<option value="oldest" <?php if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 'oldest' ){ ?> selected="selected" <?php } ?> >Old added</option>
						</select>
						</div>
						</form>
						
					</div>	
			</div>
		</div>		
			<div class="row">
				<div class="sidebar-2 mb col-md-3 col-sm-12">
					<?php get_sidebar(2); ?>
				</div>
				<div class="posts col-md-9 col-sm-12">
						<?php
						wp_reset_query(); $posts = query_posts($query_string . $order );
						$bs_clearfix = 0;
							while( have_posts() ) : the_post();
						    $clearfix = bootstrap_clearfix( $bs_clearfix, array( 'xs' => 12, 'sm' => 6, 'md' => 4, 'lg' => 4 ) );
						    echo $clearfix;
						    $bs_clearfix ++;
						    ?>
						        <div class="posts-block col-md-4 col-sm-6">
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
				<div class="row">
					<div class="col-md-9 col-md-offset-3">
					<?php if (function_exists("pagination")) {
					    pagination($additional_loop->max_num_pages);
					} ?>		
					</div>
				</div>
		</div>
<?php get_footer(); ?>