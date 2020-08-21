<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_setup' ) ) {

	function nayncuration_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Custom background
		add_theme_support( 'custom-background' );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		add_image_size( 'post-image', 766, 9999 );
		
		// Title tag
		add_theme_support( 'title-tag' );

		// Set content width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 766;

		// Custom header (logo)
		$custom_header_args = array( 'width' => 200, 'height' => 200, 'header-text' => false );
		add_theme_support( 'custom-header', $custom_header_args );
		
		// Add nav menu
		register_nav_menu( 'primary', 'Primary Menu' );
		
		// Make the theme translation ready
		load_theme_textdomain('nayncuration', get_template_directory() . '/languages');
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable($locale_file) )
		require_once($locale_file);
		
	}
	add_action( 'after_setup_theme', 'nayncuration_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_load_javascript_files' ) ) {

	function nayncuration_load_javascript_files() {

		if ( ! is_admin() ) {
			wp_enqueue_script( 'nayncuration_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true  );
			wp_enqueue_script( 'nayncuration_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true );
			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'nayncuration_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_load_style' ) ) {

	function nayncuration_load_style() {
		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'nayncuration' );

			if ( 'off' !== $google_fonts ) {

				// Register Google Fonts
				wp_register_style( 'nayncuration_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400' );
				$dependencies[] = 'nayncuration_google_fonts';

			}

			wp_enqueue_style( 'nayncuration_style', get_stylesheet_uri(), $dependencies );
		}
	}
	add_action( 'wp_print_styles', 'nayncuration_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_add_editor_styles' ) ) {

	function nayncuration_add_editor_styles() {
		add_editor_style( 'nayncuration-editor-styles.css' );
		$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400';
		add_editor_style( str_replace( ',', '%2C', $font_url ) );
	}
	add_action( 'init', 'nayncuration_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   ADD FOOTER WIDGET AREAS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_sidebar_registration' ) ) {

	function nayncuration_sidebar_registration() {

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Widgets in this area will be shown in the first column in the footer.', 'nayncuration' ),
			'id' 			=> 'footer-a',
			'name' 			=> __( 'Footer A', 'nayncuration' ),
		) );

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Widgets in this area will be shown in the second column in the footer.', 'nayncuration' ),
			'id' 			=> 'footer-b',
			'name' 			=> __( 'Footer B', 'nayncuration' ),
		) );

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Widgets in this area will be shown in the third column in the footer.', 'nayncuration' ),
			'id' 			=> 'footer-c',
			'name' 			=> __( 'Footer C', 'nayncuration' ),
		) );

	}
	add_action( 'widgets_init', 'nayncuration_sidebar_registration' ); 

}
	

/* ---------------------------------------------------------------------------------------------
   INCLUDE THEME WIDGETS
   --------------------------------------------------------------------------------------------- */



/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_html_js_class' ) ) {

	function nayncuration_html_js_class() {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'nayncuration_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO PAGINATION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_posts_link_attributes_1' ) ) {

	function nayncuration_posts_link_attributes_1() {
		return 'class="post-nav-older"';
	}
	add_filter( 'next_posts_link_attributes', 'nayncuration_posts_link_attributes_1' );

}

if ( ! function_exists( 'nayncuration_posts_link_attributes_2' ) ) {

	function nayncuration_posts_link_attributes_2() {
		return 'class="post-nav-newer"';
	}
	add_filter( 'previous_posts_link_attributes', 'nayncuration_posts_link_attributes_2' );

}


/* ---------------------------------------------------------------------------------------------
   MENU WALKER ADDING HAS-CHILDREN
   --------------------------------------------------------------------------------------------- */


class nayncuration_nav_walker extends Walker_Nav_Menu {

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		$id_field = $this->db_fields['id'];
		
        if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'has-children';
		}
		
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	
}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'nayncuration_body_classes' ) ) {

	function nayncuration_body_classes( $classes ) {

		// When there's a post thumbnail
		if ( has_post_thumbnail() ) { 
			$classes[] = 'has-featured-image';
		}

		return $classes;
	}
	add_action( 'body_class', 'nayncuration_body_classes' );

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'nayncuration_custom_more_link' ) ) {

	function nayncuration_custom_more_link( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, __( 'Continue reading', 'nayncuration' ), $more_link );
	}
	add_filter( 'the_content_more_link', 'nayncuration_custom_more_link', 10, 2 );

}


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER OUTPUT FOR IMAGE GALLERY FORMAT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_flexslider' ) ) {

	function nayncuration_flexslider( $size = 'thumbnail' ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'orderby'        	=> 'menu_order',
			'order'          	=> 'ASC',
			'post_mime_type' 	=> 'image',
			'post_parent'    	=> $attachment_parent,
			'post_status'    	=> null,
			'post_type'      	=> 'attachment',
			'posts_per_page'    => -1,
		) );

		if ( $images ) : ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach( $images as $image ) { 

						$attimg = wp_get_attachment_image( $image->ID, $size ); 
						
						?>
						
						<li>
							<?php echo $attimg; ?>
							<?php if ( ! empty( $image->post_excerpt ) ) : ?>
								<div class="media-caption-container">
									<p class="media-caption"><?php echo $image->post_excerpt; ?></p>
								</div>
							<?php endif; ?>
						</li>
						
						<?php 
					} ?>
			
				</ul>
				
			</div><!-- .flexslider -->
			
			<?php
			
		endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   META FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_meta' ) ) {

	function nayncuration_meta() { ?>
		
		<div class="post-meta">
		
			<span class="post-date"><a href="<?php the_permalink(); ?>" title="<?php the_time( get_option( 'time_format' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?> <?php the_time( get_option( 'time_format' ) ); ?></a></span>
			
			
			<?php if ( is_sticky() && ! has_post_thumbnail() ) : ?> 
			
				<span class="date-sep"> / </span>
			
				<?php _e( 'Sticky', 'nayncuration' ); ?>
			
			<?php endif; ?>
			
									
		</div><!-- .post-meta -->
		<?php	
	}

}


/* ---------------------------------------------------------------------------------------------
   STYLE THE ADMIN AREA
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_admin_style' ) ) {

	function nayncuration_admin_style() {
	echo '<style type="text/css">
	
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}

		</style>';
	}
	add_action( 'admin_head', 'nayncuration_admin_style' );

}


/* ---------------------------------------------------------------------------------------------
   nayncuration COMMENT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_comment' ) ) {
	
	function nayncuration_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'nayncuration' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'nayncuration' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
			
				<div class="comment-meta comment-author vcard">
								
					<?php echo get_avatar( $comment, 120 ); ?>

					<div class="comment-meta-content">
												
						<?php printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '(Post author)', 'nayncuration' ) . '</span>' : ''
						); ?>
						
						<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' &mdash; ' . get_comment_time() ?></a></p>
						
					</div><!-- .comment-meta-content -->
					
					<div class="comment-actions">
					
						<?php edit_comment_link( __( 'Edit', 'nayncuration' ), '', '' ); ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'nayncuration' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
										
					</div><!-- .comment-actions -->
					
					<div class="clear"></div>
					
				</div><!-- .comment-meta -->

				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'nayncuration' ); ?></p>
						
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
					<div class="comment-actions">
					
						<?php edit_comment_link( __( 'Edit', 'nayncuration' ), '', '' ); ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'nayncuration' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						
						<div class="clear"></div>
					
					</div><!-- .comment-actions -->
					
				</div><!-- .comment-content -->

			</div><!-- .comment-## -->
		<?php
			break;
		endswitch;
	}
}


/* ---------------------------------------------------------------------------------------------
   nayncuration THEME OPTIONS
   --------------------------------------------------------------------------------------------- */


class nayncuration_customize {

	public static function nayncuration_register( $wp_customize ) {

		// Add our nayncuration options section
		$wp_customize->add_section( 'nayncuration_options', array(
			'capability' 	=> 'edit_theme_options', 
			'description' 	=> __( 'Allows you to customize theme settings for nayncuration.', 'nayncuration' ), 
			'priority' 		=> 35, 
			'title' 		=> __( 'Options for nayncuration', 'nayncuration' ), 
		) );

		// Add a setting for accent color
		$wp_customize->add_setting( 'accent_color', array(
			'default' 			=> '#FF706C', 
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' 		=> 'postMessage', 
			'type' 				=> 'theme_mod', 
		) );

		// And one for the logo
		$wp_customize->add_setting( 'nayncuration_logo', array( 
			'sanitize_callback' => 'esc_url_raw'
		) );

		// Add a control to go along with the accent color setting
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nayncuration_accent_color', array(
			'label' 	=> __( 'Accent Color', 'nayncuration' ), 
			'priority' 	=> 10,
			'section' 	=> 'colors', 
			'settings' 	=> 'accent_color', 
		) ) );

		// Set the bloginfo values to be updated via postMessage (live JS preview)
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	// Function handling our header output of styles
	public static function nayncuration_header_output() {

		echo '<style type="text/css">';

		self::nayncuration_generate_css( 'body a', 'color', 'accent_color' );
		self::nayncuration_generate_css( 'body a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.header', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.post-bubbles a:hover', 'background-color', 'accent_color' );
		self::nayncuration_generate_css( '.post-nav a:hover', 'background-color', 'accent_color' );
		self::nayncuration_generate_css( '.comment-meta-content cite a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.comment-meta-content p a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.comment-actions a:hover', 'background-color', 'accent_color' );
		self::nayncuration_generate_css( '.widget-content .textwidget a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_archive li a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_categories li a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_meta li a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_nav_menu li a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '#wp-calendar thead', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.widget_tag_cloud a:hover', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.search-button:hover .genericon', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.flexslider:hover .flex-next:active', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.flexslider:hover .flex-prev:active', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.post-title a:hover', 'color', 'accent_color' );

		self::nayncuration_generate_css( '.post-content a', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.post-content a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.post-content a:hover', 'border-bottom-color', 'accent_color' );
		self::nayncuration_generate_css( '.post-content fieldset legend', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' );
		self::nayncuration_generate_css( '.post-content .has-accent-color', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.post-content .has-accent-background-color', 'background-color', 'accent_color' );

		self::nayncuration_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' );
		self::nayncuration_generate_css( '.form-submit #submit:hover', 'background-color', 'accent_color' );

		echo '</style>';

	}

	// Enqueue javascript for the live preview, with the customize preview as a dependency
	public static function nayncuration_live_preview() {
		wp_enqueue_script( 'nayncuration-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '', true );
	}

	// Function for spitting out CSS code
	public static function nayncuration_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix );
			if ( $echo ) echo $return;
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'nayncuration_customize' , 'nayncuration_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'nayncuration_customize' , 'nayncuration_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'nayncuration_customize' , 'nayncuration_live_preview' ) );


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'nayncuration_add_gutenberg_features' ) ) :

	function nayncuration_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' ) ? get_theme_mod( 'accent_color' ) : '#FF706C';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Darkest gray', 'Name of the darkest gray color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'darkest-gray',
				'color' => '#444',
			),
			array(
				'name' 	=> _x( 'Dark gray', 'Name of the dark gray color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'dark-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Gray', 'Name of the gray color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'gray',
				'color' => '#666',
			),
			array(
				'name' 	=> _x( 'Light gray', 'Name of the light gray color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'light-gray',
				'color' => '#EEE',
			),
			array(
				'name' 	=> _x( 'Lightest gray', 'Name of the lightest gray color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'lightest-gray',
				'color' => '#F1F1F1',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'nayncuration' ),
				'slug' 	=> 'white',
				'color' => '#FFF',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'nayncuration' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'nayncuration' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Regular', 'Name of the regular font size in Gutenberg', 'nayncuration' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'nayncuration' ),
				'size' 		=> 19,
				'slug' 		=> 'regular',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'nayncuration' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'nayncuration' ),
				'size' 		=> 23,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'nayncuration' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'nayncuration' ),
				'size' 		=> 30,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'nayncuration_add_gutenberg_features' );

endif;


/* ---------------------------------------------------------------------------------------------
   GUTENBERG EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'nayncuration_block_editor_styles' ) ) :

	function nayncuration_block_editor_styles() {

		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'nayncuration' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'nayncuration-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400', false, 1.0, 'all' );
			$dependencies[] = 'nayncuration-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'nayncuration-block-editor-styles', get_theme_file_uri( '/nayncuration-gutenberg-editor-style.css' ), $dependencies, '1.0', 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'nayncuration_block_editor_styles', 1 );

endif;


?>

<?php
/**
 *  Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'nayncuration_options' ) ) {

	class nayncuration_options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'nayncuration_options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'nayncuration_options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Settings', 'text-domain' ),
				esc_html__( 'Theme Settings', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'nayncuration_options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'nayncuration_options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Theme Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">

						<?php // Checkbox example ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Checkbox Example', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'checkbox_example' ); ?>
								<input type="checkbox" name="theme_options[checkbox_example]" <?php checked( $value, 'on' ); ?>> <?php esc_html_e( 'Checkbox example description.', 'text-domain' ); ?>
							</td>
						</tr>

						<?php // Text input example ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Input Example', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'input_example' ); ?>
								<input type="text" name="theme_options[input_example]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Select example ?>
						<tr valign="top" class="wpex-custom-admin-screen-background-section">
							<th scope="row"><?php esc_html_e( 'Select Example', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'select_example' ); ?>
								<select name="theme_options[select_example]">
									<?php
									$options = array(
										'1' => esc_html__( 'Option 1', 'text-domain' ),
										'2' => esc_html__( 'Option 2', 'text-domain' ),
										'3' => esc_html__( 'Option 3', 'text-domain' ),
									);
									foreach ( $options as $id => $label ) { ?>
										<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
											<?php echo strip_tags( $label ); ?>
										</option>
									<?php } ?>
								</select>
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}
}
new nayncuration_options();

// Helper function to use in your theme to return a theme option value
function myprefix_get_theme_option( $id = '' ) {
	return nayncuration_options::get_theme_option( $id );
}

function hide_admin_bar(){ return false; }
add_filter( 'show_admin_bar', 'hide_admin_bar' );