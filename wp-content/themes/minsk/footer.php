		<div class="container-fluid footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<div class="footer-menu">
						<nav class="navbar navbar-footer1" role="navigation">
						<?php
			            wp_nav_menu( array(
			                'menu'              => 'bottom',
			                'theme_location'    => 'Footer menu',
			                'depth'             => 0,
			                'container'         => 'false',
			                'container_class'   => 'collapse navbar-collapse',
			                'container_id'      => 'bs-example-navbar-collapse-1',
			                'menu_class'        => 'nav navbar-nav items',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new wp_bootstrap_navwalker())
			            );
			        	?>
			        	</nav>
			        	<span class="line1 hidden-sm hidden-xs"></span>
						<nav class="navbar navbar-footer2" role="navigation">
							<?php
				            wp_nav_menu( array(
				                'menu'              => 'top',
				                'theme_location'    => 'top main menu',
				                'depth'             => 0,
				                'container'         => 'false',
				                'container_class'   => 'collapse navbar-collapse',
				                'container_id'      => 'bs-example-navbar-collapse-1',
				                'menu_class'        => 'nav navbar-nav items',
				                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                'walker'            => new wp_bootstrap_navwalker())
				            );
				        	?>
				        </nav>
					    <div class="social">
					    	<a href="#" class="fa fa-facebook"></a>
					    	<a href="#" class="fa fa-twitter"></a>
					    	<a href="#" class="fa fa-google"></a>
					    	<a href="#" class="fa fa-pinterest"></a>
					    	<a href="#" class="fa fa-instagram"></a>
					    	<a href="#" class="fa fa-youtube"></a>
					    	<a href="#" class="fa fa-rss"></a>
					    	<a href="#" class="fa fa-envelope"></a>
					    </div>	
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="line"></div>
					</div>
				</div>
				<div class="row mt text-center">
					<div class="col-sm-12">
						<p>Copyright © 2017 Minsk Memory. All rights reserved.</p>
					</div>
				</div>
			</div>
		</div>
<?php wp_footer(); ?>		
	</body>
</html>