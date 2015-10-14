<?php
add_action( 'widgets_init', 'hennyj_comments_avatar_widget' );
function hennyj_comments_avatar_widget() {
	register_widget( 'hennyj_comments_avatar' );
}
class hennyj_comments_avatar extends WP_Widget {

	function hennyj_comments_avatar() {
		$widget_ops = array( 'classname' => 'comments-avatar' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'comments_avatar-widget' );
		parent::__construct( 'comments_avatar-widget', __('HennyJ - Recent Comments with avatar', 'hennyj'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = null; $no_of_comments = null; $avatar_size = null;
		
		if (! empty( $instance['title'] ) ) { $title = apply_filters('widget_title', $instance['title'] ); }
        if (! empty( $instance['no_of_comments'] ) ) { $no_of_comments = $instance['no_of_comments']; }
        if (! empty( $instance['avatar_size'] ) ) { $avatar_size = $instance['avatar_size']; }

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo esc_html($title) ; ?>
		<?php echo $after_title; ?>
			<ul>	
		<?php hennyj_most_commented( $no_of_comments , $avatar_size); ?>
		</ul>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_comments'] = strip_tags( $new_instance['no_of_comments'] );
		$instance['avatar_size'] = strip_tags( $new_instance['avatar_size'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Recent Comments' , 'hennyj'), 'no_of_comments' => '5' , 'avatar_size' => '50' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'hennyj'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar_size' ); ?>"><?php _e('Avatar Size :', 'hennyj'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'avatar_size' ); ?>" name="<?php echo $this->get_field_name( 'avatar_size' ); ?>" value="<?php echo esc_attr( $instance['avatar_size'] );  ?>"  type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_comments' ); ?>"><?php _e('Number of comments to show:', 'hennyj'); ?>  </label>
			<input id="<?php echo $this->get_field_id( 'no_of_comments' ); ?>" name="<?php echo $this->get_field_name( 'no_of_comments' ); ?>" value="<?php echo esc_attr( $instance['no_of_comments'] ); ?>" type="text" size="3" />
		</p>


	<?php
	}
}
?>