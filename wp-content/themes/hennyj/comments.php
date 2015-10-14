<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package hennyj
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-wrapper col-sm-12">
			<div class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'hennyj' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
			</div>
		</h5>

		<ol class="comment-list col-sm-12">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 72,
					'reply_text'  => __('Reply', 'hennyj')
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		
		<div class="navigation-post">
			<p class="previous-post"><?php previous_comments_link( __( 'Older Comments &rarr;', 'hennyj' ) ); ?></p>
			<p class="next-post"><?php next_comments_link( __( '&larr; Newer Comments', 'hennyj' ) ); ?></p>
			<div class="clearfix"></div>
		</div>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'hennyj' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array(
		'comment_notes_after' => ''
	)); ?>

</div><!-- #comments -->
