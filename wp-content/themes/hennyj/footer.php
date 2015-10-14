<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package hennyj
 */
?>

</div><!-- #content -->

</div><!-- .row -->
</div><!-- #page -->

<div class="footer-widget">
<div class="container">
<div class="row">

	
	
	<div class="col-md-4" role="complementary">
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</div>

	<div class="col-md-4" role="complementary">
		<?php dynamic_sidebar( 'sidebar-middle' ); ?>
	</div>

			<div class="col-md-4" role="complementary">
				<?php dynamic_sidebar( 'sidebar-right' ); ?>
			</div>
	</div>		
	</div>		
	<div class="clearfix"></div>
</div>

	<footer id="colophon" class="site-footer" role="contentinfo">	
		<div class="site-info">
			<?php _e("Made by Malvouz with WordPress", "hennyj"); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>
