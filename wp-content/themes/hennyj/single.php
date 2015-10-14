<?php
/**
 * The template for displaying all single posts.
 *
 * @package hennyj
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>
			
	<!-- Author Information -->
	<div class="author-information">
	
	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('email'), '78' ); ?>
		<h5><?php the_author_posts_link(); ?></h5>
	</div>
	
	<div class="author-content">
		
		<p><?php the_author_meta('description'); ?></p>
		<?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-social" href="http://facebook.com/<?php echo esc_url(the_author_meta('facebook')); ?>"><span class="genericon genericon-facebook"></span></a><?php endif; ?>
		<?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-social" href="http://twitter.com/<?php echo esc_url(the_author_meta('twitter')); ?>"><span class="genericon genericon-twitter"></span></a><?php endif; ?>
		<?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-social" href="http://instagram.com/<?php echo esc_url(the_author_meta('instagram')); ?>"><span class="genericon genericon-instagram"></span></a><?php endif; ?>
		<?php if(get_the_author_meta('youtube')) : ?><a target="_blank" class="author-social" href="http://youtube.com/user/<?php echo esc_url(the_author_meta('youtube')); ?>"><span class="genericon genericon-youtube"></span></a><?php endif; ?>
		<?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-social" href="http://pinterest.com/<?php echo esc_url(the_author_meta('pinterest')); ?>"><span class="genericon genericon-pinterest"></span></a><?php endif; ?>
		<?php if(get_the_author_meta('dribbble')) : ?><a target="_blank" class="author-social" href="http://dribbble.com/<?php echo esc_url(the_author_meta('dribbble')); ?>"><span class="genericon genericon-dribbble"></span></a><?php endif; ?>
	</div>
	
	<div class="clearfix"></div>
	</div> 
	<!-- End. Author Information -->
	
	<!-- Related Posts -->
	
	<?php get_template_part('inc/related_posts'); ?>
	
	
		
			<div class="navigation-post">
			<p class="previous-post"><?php previous_post_link( '%link',  __( 'Previous Post &rarr;', 'hennyj' ) ); ?></p>
			<p class="next-post"><?php next_post_link( '%link', __( '&larr; Next Post', 'hennyj' ) ); ?></p>
			<div class="clearfix"></div>
			</div>
		
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
