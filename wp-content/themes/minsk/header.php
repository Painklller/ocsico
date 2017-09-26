<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php bloginfo(); ?><?php wp_title(" | "); ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content=""  />
	<?php wp_head(); ?>
	</head>

	<body>
	<div class="container-fluid">
		<div class="row top-line">
				<div class="color"></div>
				<div class="color"></div>
				<div class="color"></div>
				<div class="color"></div>
				<div class="color"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
				<nav class="navbar navbar-top hidden-xs" role="navigation">
					<?php
				       wp_nav_menu( array(
				        'menu'              => 'top',
				        'theme_location'    => 'top main menu',
				        'depth'             => 0,
				        'container'         => 'false',
				        'container_class'   => 'collapse navbar-collapse',
				        'container_id'      => 'bs-example-navbar-collapse-1',
				        'menu_class'        => 'nav navbar-nav items first',
				        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				        'walker'            => new wp_bootstrap_navwalker())
				        );        
				    ?>		     
				 </nav>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
				<div class="line hidden-xs"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="head-menu-main">
				<nav class="navbar navbar-default navbar-main" role="navigation">
					<div class="navbar-header">
						<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/minsk_logo.png" alt="logo" class="img-responsive"></a>
			                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			                    <span class="sr-only">Toggle navigation</span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                  </button>
			        </div>
			        <?php
			            wp_nav_menu( array(
			                'menu'              => 'menu',
			                'theme_location'    => 'Menu',
			                'depth'             => 0,
			                'container'         => 'div',
			                'container_class'   => 'collapse navbar-collapse',
			                'container_id'      => 'bs-example-navbar-collapse-1',
			                'menu_class'        => 'nav navbar-nav navbar-right items',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new wp_bootstrap_navwalker())
			            );
			        ?>
					</div>
				</nav>
			</div>
		</div>
	</div>