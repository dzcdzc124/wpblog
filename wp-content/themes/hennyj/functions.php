<?php
/**
 * hennyj functions and definitions
 *
 * @package hennyj
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'hennyj_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hennyj_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hennyj, use a find and replace
	 * to change 'hennyj' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hennyj', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hennyj' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hennyj_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() . '/img/symphony.png',
	) ) );
	
	// Add Image Theme Support
	add_theme_support( 'post-thumbnails' );
		add_image_size( 'featured-thumb', 750, 450, true );
}
endif; // hennyj_setup
add_action( 'after_setup_theme', 'hennyj_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hennyj_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'hennyj' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'hennyj' ),
		'id'            => 'sidebar-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'hennyj' ),
		'id'            => 'sidebar-middle',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'hennyj' ),
		'id'            => 'sidebar-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'hennyj_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hennyj_scripts() {

	wp_enqueue_style( 'hennyj-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'hennyj-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	
	wp_enqueue_style( 'hennyj-genericons', get_template_directory_uri() . '/css/genericons/genericons.css' );
	
	wp_enqueue_style( 'hennyj-flexslider-style', get_template_directory_uri() . '/css/flexslider.css' );
	
	wp_enqueue_style( 'hennyj-custom-style', get_template_directory_uri() . '/css/custom.css' );

	wp_enqueue_script( 'hennyj-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hennyj-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'hennyj-custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '20150311', true );

	wp_enqueue_script( 'hennyj-flexslider-script', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '20150311', true );
	
	wp_enqueue_script( 'hennyj-tilesgallery-script', get_template_directory_uri() . '/js/jquery.tiles-gallery.js', array('jquery'), '20150411', true );
	
	wp_enqueue_script( 'hennyj-owl-slider', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '20150511', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hennyj_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Widget
 */
require get_template_directory() . '/inc/widgets/widget-post.php';
require get_template_directory() . '/inc/widgets/widget-comment.php';

/*-----------------------------------------------------------------------------------*/
# Get Last Post
/*-----------------------------------------------------------------------------------*/
function hennyj_wp_last_posts($numberOfPosts = 5){
	global $post;
	$orig_post = $post;
	
	$lastPosts = get_posts('numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li>

		<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail-post">
					<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php printf( __( 'Permalink to %s', 'hennyj' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-thumb' ); ; ?></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<span><?php the_time('F j, Y'); ?></span>
		
		<div class="clearfix"></div>
</li>
<?php endforeach; 
	$post = $orig_post;
}

/*-----------------------------------------------------------------------------------*/
# Get Most commented posts 
/*-----------------------------------------------------------------------------------*/
function hennyj_most_commented($comment_posts = 5 , $avatar_size = 50){
$comments = get_comments('status=approve&number='.$comment_posts);
foreach ($comments as $comment) { ?>
	<li>
		<div class="post-thumbnail-comment">
			<?php echo get_avatar( $comment, $avatar_size ); ?>
		</div>
		<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
		<span><?php echo strip_tags($comment->comment_author); ?></span> </a>: <?php echo wp_html_excerpt( $comment->comment_content, 60 ); ?>...
		<div class="clearfix"></div>
	</li>
<?php } 
}

/**
 *
 */
function henny_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = __('Twitter Username', 'hennyj');
	$contactmethods['facebook']  = __('Facebook Username', 'hennyj');
	$contactmethods['youtube']    = __('Youtube Username', 'hennyj');
	$contactmethods['dribbble']    = __('Dribbble Username', 'hennyj');
	$contactmethods['instagram'] = __('Instagram Username', 'hennyj');
	$contactmethods['pinterest'] = __('Pinterest Username', 'hennyj');

	return $contactmethods;
}
add_filter('user_contactmethods','hennyj_contactmethods',10,1);

	/* Tagcloud, change the font size */
	function hennyj_custom_tag_cloud_widget($args) {
		$args['largest'] = 14; //largest tag
		$args['smallest'] = 14; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'hennyj_custom_tag_cloud_widget' );