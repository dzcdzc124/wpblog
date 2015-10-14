<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package hennyj
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h4 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'hennyj' ); ?></h4>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
