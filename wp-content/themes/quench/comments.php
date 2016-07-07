<div class="comments clearfix box">

	<h5 id="comments-title"><span><?php echo count($comments); ?> 吐槽</span></h5>
	<div class="commentshow">
		<ol class="comments-list">
			<?php wp_list_comments('type=comment&callback=comment&max_depth=1000&style=ol'); ?>
		</ol>
		<nav class="commentnav" data-postid="<?php echo $post->ID?>"><?php paginate_comments_links('prev_text=«&next_text=»');?></nav>
	</div>

	<div id="respond" class="comment-respond">
		<h5 id="replytitle" class="comment-reply-title">欢迎吐槽丢砖~点赞也行<small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></small></h5>
		<form action="#" method="post" id="commentform" class="clearfix">
			<?php if ( $user_ID ) { ?>
			<p style="margin-bottom:10px"><!-- 当前登陆 --><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">退出 &raquo;</a></p>
			<?php } else { ?>
			<p class="input-row"><input type="text" name="author" class="text_input" id="author" size="22" tabindex="1" placeholder="<?php _e('NAME', 'quench');?> *"/>
			</p>
			
			<p class="input-row"><input type="text" name="email" class="text_input" id="email" size="22" tabindex="2" placeholder="<?php _e('E-MAIL', 'quench');?> *"/>
			</p>
			
			<p class="input-row"><input type="text" name="url" class="text_input" id="url" size="22" tabindex="3"  placeholder="<?php _e('WEBSITE', 'quench');?>"/>
			</p>
			
			<?php }?>
			
			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
		
	
		
			<p class="input-row message-row">
 				<textarea class="text_area" rows="3" cols="80" name="comment" id="comment" tabindex="4"  placeholder="<?php _e('CONTENT...', 'quench');?>"></textarea>
			</p>
			<input type="submit" name="submit" class="button" id="submit" tabindex="5" value="吐 槽"/>
		
		</form>
	</div>

</div>