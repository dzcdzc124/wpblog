<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package hennyj
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<a id="resp-menu" class="responsive-menu" href="#"><?php _e("Menu", "hennyj"); ?></a> 
	<nav id="site-navigation" class="main-navigation" role="navigation">
			   
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class'=>'nav-menu', 'container_class' => 'menu-container' ) ); ?>
			<?php //get_search_form(); ?>
			
			
				<div class="search-icon">
					<a href="#search"><span class="genericon genericon-search"></span></a>
				</div>
			
			


			<div class="social-icon">
				<?php if(get_theme_mod('sp_facebook')) : ?><a href="http://facebook.com/<?php echo esc_url(the_author_meta('facebook')); ?>" target="_blank"><span class="genericon genericon-facebook"></span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_twitter')) : ?><a href="http://twitter.com/<?php echo esc_url(the_author_meta('twitter')); ?>" target="_blank"><span class="genericon genericon-twitter"></span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_instagram')) : ?><a href="http://instagram.com/<?php echo esc_url(the_author_meta('instagram')); ?>" target="_blank"><span class="genericon genericon-instagram"></span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_pinterest')) : ?><a href="http://pinterest.com/<?php echo esc_url(the_author_meta('pinterest')); ?>" target="_blank"><span class="genericon genericon-pinterest"></span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_youtube')) : ?><a href="http://youtube.com/user/<?php echo esc_url(the_author_meta('youtube')); ?>" target="_blank"><span class="genericon genericon-youtube"></span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_dribbble')) : ?><a href="http://dribbble.com/<?php echo esc_url(the_author_meta('dribbble')); ?>" target="_blank"><span class="genericon genericon-dribbble"></span></a><?php endif; ?>
			</div>

	
	</nav><!-- #site-navigation -->

<div id="page" class="hfeed site container">
<div class="row">

	<header id="masthead" class="site-header col-md-12 text-center" role="banner">
						<h1><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<h3><?php bloginfo( 'description' ); ?></h3>
	</header>
	
<div id="search">
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" name="s" value="" placeholder="<?php _e("type keyword(s) and enter", "hennyj"); ?>" />
    </form>
</div>	
	
	<div id="content" class="site-content">
