<?php
add_action( 'widgets_init', 'hennyj_posts_list_widget' );
function hennyj_posts_list_widget() {
	register_widget( 'hennyj_posts_list' );
}
class hennyj_posts_list extends WP_Widget {

	function hennyj_posts_list() {
		$widget_ops = array( 'classname' => 'posts-list'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-list-widget' );
		parent::__construct( 'posts-list-widget', __('HennyJ - Recent Post', 'hennyj'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = null; $no_of_posts = null;
		
		if (! empty( $instance['title'] ) ) { $title = apply_filters('widget_title', $instance['title'] ); }
        if (! empty( $instance['no_of_posts'] ) ) { $no_of_posts = $instance['no_of_posts']; }

		echo $before_widget;
			echo $before_title;
			echo esc_html($title) ; ?>
		<?php echo $after_title; ?>
				<ul>
					<?php
						hennyj_wp_last_posts($no_of_posts)?>	
				</ul>
		
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['posts_list_title'] = strip_tags( $new_instance['posts_list_title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'posts_list_title' =>__('Recent Posts' , 'hennyj') , 'no_of_posts' => '8'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_list_title' ); ?>"><?php _e('Title :', 'hennyj');?> </label>
			<input id="<?php echo $this->get_field_id( 'posts_list_title' ); ?>" name="<?php echo $this->get_field_name( 'posts_list_title' ); ?>" value="<?php echo esc_attr( $instance['posts_list_title'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e('Number of posts to show:', 'hennyj'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo esc_attr($instance['no_of_posts'] ); ?>" type="text" size="3" />
		</p>



	<?php
	}
}
?>