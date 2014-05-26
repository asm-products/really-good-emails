<?php ob_start(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /><?php } ?>

	<!-- Title -->
	<title><?php if (is_front_page()){ bloginfo('name'); echo " - "; bloginfo('description'); } else { wp_title(''); echo " - "; bloginfo('name'); } ?></title>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?> data-gutter="<?php echo get_option('vk_content_gutter'); ?>" data-gutter-single="<?php echo get_option('vk_content_gutter_single'); ?>">
	
	<?php vk_messages(); ?>

	<div id="globalWrap" class="<?php echo get_option('vk_sidebar_function'); ?>">


		<!-- Mobile Menu -->
		<div id="mobileNav" class="closed">

			<div class="mobileSwitch"><span class="icon-menu"></span></div>

			<div class="clear"></div>

			<div class="mobileMenu">

				<?php wp_nav_menu( array( 'theme_location' => 'main_navagation', 'fallback_cb' => 'default_menu', 'container' => false, ) ); ?>

				<div class="clear"></div>

			</div><!-- end .mobileMenu -->

			<div class="clear"></div>

		</div><!-- end #mobileNav -->



		<!-- Left Container -->
		<div class="leftContainer">
			
			<!-- Left Content -->
			<div class="leftContent">

				<!-- Logo & Tagline -->
				<div id="mainLogo" class="mainBox first">

					<div class="logo">

						<?php

						// retina logo image width
						$imageid = vk_get_attachment_id_from_src( get_option('vk_logo_image') );
						
						// attachment attrs
						$imagesrc = wp_get_attachment_image_src( $imageid, 'fullsize' );

						// image width
						$imagewidth = $imagesrc[1];

						?>

						<!-- image logo -->
						<div class="image">

							<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">

								<img class="x1" src="<?php echo get_option('vk_logo_image'); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
								
								<img class="x2" src="<?php echo get_option('vk_logo_image_retina'); ?>" style="max-width:<?php echo $imagewidth; ?>px;" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>"/>

							</a>

						</div>

						<!-- text logo -->
						<div class="text">

							<h3><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h3>

						</div>

					</div><!-- end .logo -->
				
					<div class="tagline">

						<h3><span><?php echo get_bloginfo('description'); ?></span></h3>

					</div><!-- end #tagline -->

				</div><!-- end .mainBox -->


				<!-- Main Menu -->
				<?php if(get_option('vk_sidebar_menu_style')=='sideStyleWidget') { ?>

					<div id="mainNav" class="mainBox widget">

				<?php } else { ?>

					<div id="mainNav" class="mainBox">

				<?php } ?>

					<?php wp_nav_menu( array( 'theme_location' => 'main_navagation', 'fallback_cb' => 'default_menu', 'container' => false, ) ); ?>

					<div class="clear"></div>
				
				</div><!-- end #mainNav -->


				<!-- Main Sidebar -->
				<div id="mainWidgets" class="leftInner mainSidebar">

					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-nav-sidebar') ) : endif; ?>

				</div><!-- end #mainWidgets -->

			</div><!-- end .leftContent -->

		</div><!-- end .leftContainer -->

		<div class="leftContainerGap"></div>


		<!-- sidebar slide button -->
		<div id="slideButton"><span class="icon-menu"></span></div>


		<!-- Right Container -->
		<div class="rightContainer">

				<!-- Right Header -->
				<div class="rightHeader textcenter">

					<!-- logo -->
					<div class="logo">

						<!-- image logo -->
						<div class="image">

							<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">

								<img class="x1" src="<?php echo get_option('vk_logo_image'); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
								
								<img class="x2" src="<?php echo get_option('vk_logo_image_retina'); ?>" style="max-width:<?php echo $imagewidth; ?>px;" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>"/>

							</a>

						</div>

						<!-- text logo -->
						<div class="text">

							<h3><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h3>

						</div>

						<div class="clear"></div>

						<!-- tagline -->
						<div class="tagline">

							<h3><span><?php echo get_bloginfo('description'); ?></span></h3>

							<div class="clear"></div>

						</div><!-- end #tagline -->

					</div><!-- end .logo -->

					<!-- main nav -->
					<div id="headerNav">

						<?php wp_nav_menu( array( 'theme_location' => 'main_navagation', 'fallback_cb' => 'default_menu', 'container' => false, 'container_id' => 'header-menu') ); ?>

						<div class="clear"></div>

					</div>

				</div><!-- end .rightHeader -->

		<?php // Sidebar and Masonry Check

		// Check which sidebars are active
		$blgtmp=get_option('vk_blog_template'); // Used at the bottom of the header.php as well
		$srchtmp=get_option('vk_search_template'); // Used at the bottom of the header.php as well

		// If sidebars are active
		if(
			   is_single() && (is_active_sidebar('post-1-sidebar') || is_active_sidebar('post-2-sidebar'))
			|| (is_page() && !is_page_template()) && (is_active_sidebar('page-1-sidebar') || is_active_sidebar('page-2-sidebar'))
			|| is_page_template('page-contact.php') && is_active_sidebar('contact-sidebar')
			|| is_page_template('page-blog1col.php') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
			|| is_page_template('page-blog2col.php') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
			|| is_home() && ($blgtmp=='blg1col' || $blgtmp=='blg2col') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
			|| is_search() && ($srchtmp=='blg1col' || $blgtmp=='blg2col') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
			|| is_archive() && ($srchtmp=='blg1col' || $srchtmp=='blg2col') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
			|| is_404() && ($srchtmp=='blg1col' || $srchtmp=='blg2col') && (is_active_sidebar('blog-1-sidebar') || is_active_sidebar('blog-2-sidebar'))
		){

			$sidebars='sidebarOn'; /* Sidebar is active */

		} else {

			$sidebars='sidebarOff'; /* Sidebar is not active */

		}

		// Oversized Masonry
		if(    is_page_template('page-masonry_oversize.php')
			|| is_home() && $blgtmp=='msnryOver'
			|| is_search() && $srchtmp=='msnryOver'
			|| is_archive() && $srchtmp=='msnryOver'
			|| is_404() && $blgtmp=='msnryOver'
		){

			$masonryType='oversize';
			$sidebars='sidebarNone'; /* Turn the sidebar off */

		// Fixed Fullwidth Masonry
		} elseif(
			   is_page_template('page-masonry_fixedfull.php')
			|| is_home() && $blgtmp=='msnryFixedfull'
			|| is_search() && $srchtmp=='msnryFixedfull'
			|| is_archive() && $srchtmp=='msnryFixedfull'
			|| is_404() && $blgtmp=='msnryFixedfull'
		){

			$masonryType='fixedfull';
			$sidebars='sidebarNone'; /* Turn the sidebar off */

		// Standard Masonry
		} elseif(
			   is_page_template('page-masonry.php')
			|| is_page_template('page-fullwidth.php')
			|| is_page_template('page-archive.php')
			|| is_home() && $blgtmp=='msnryFixed'
			|| is_search() && $srchtmp=='msnryFixed'
			|| is_archive() && $srchtmp=='msnryFixed'
			|| is_404() && $blgtmp=='msnryFixed'
		){

			$masonryType='fixed';
			$sidebars='sidebarNone'; /* Turn the sidebar off */

		} else {

			$masonryType='masonryNone'; /* turn the masonry off */

		}

		?>

			<!-- Right Padding -->
			<div class="rightPadding <?php echo $masonryType; ?> <?php echo $sidebars; ?>">

				<!-- Landing Page -->
				<?php if( is_front_page() && !isset( $_COOKIE['landingpage']) ) {  echo landingPage(); } ?>

				<!-- Right Content -->
				<div class="rightContent">