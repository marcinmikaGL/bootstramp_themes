<?php 
include('dictionary.php');


$GLOBALS['logo_width']  = 40;
$GLOBALS['logo_height'] = 40; 


function themes_setup() {
    
    load_theme_textdomain( 'weblider' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support(
        'custom-background', array(
	'default-color' => $GLOBALS['gackground_color'] ,
		)
    );

   
    add_theme_support(
	'custom-logo', array(
	 'height'      => $GLOBALS['logo_height'],
	 'width'       => $GLOBALS['logo_width'],
	 'flex-height' => true,
	 'flex-width'  => true,
	 )
    );
    add_theme_support(
	'html5',
	array(
            'search-form',
	    'comment-form',
	    'comment-list',
	    'gallery',
            'caption',
            'script',
            'style',
	)
    );
}


add_action( 'after_setup_theme', 'themes_setup' );


if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/lib/admin/options-framework/' );
	require_once dirname( __FILE__ ) . '/lib/admin/options-framework/options-framework.php';

	define( 'USE_FACEBOOK_COMMENTS', of_get_option('use_facebook_comments'));
}


add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}


add_filter( 'the_generator', create_function('$a', "return null;") );


function custom_logo() { ?> 
    <style type="text/css">
        h1 a { background-image: url(' <?php get_bloginfo('template_directory'); ?>/img/logo-login.gif') !important; }
       
             
    </style>
<?php }


function themes_logo_setup() {
    $defaults = array(
        'height'      => $GLOBALS['logo_height'],
        'width'       => $GLOBALS['logo_width'],
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}


add_action('login_head', 'custom_logo');

if( !is_admin()){
   wp_deregister_script('jquery'); 
   wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"), false, '3.4.1'); 
   wp_enqueue_script('jquery');

   wp_register_script('bootstrap', (get_bloginfo('template_directory') .'/js/bootstrap.min.js'), false, '2.0'); 
   wp_enqueue_script('bootstrap');
}


if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Sidebar',
	'before_widget' => '<li class="widget">',
	'after_widget' => '</li>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h3>',
));

add_action( 'after_setup_theme', 'themename_weblider_logo_setup' );


function theme_addmenus() {
	register_nav_menus(
		array(
			'primary-menu' => 'Main Navigation Menu',
		)
	);
}
add_action( 'init', 'theme_addmenus' );

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'functions.php' == basename($_SERVER['SCRIPT_FILENAME'])) 
	die ($GLOBALS['folder_error']);


function footer_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Footer Wiget', 'smallenvelop' ),
        'id' => 'footer-sidebar',
        'before_widget' => '<div class="footer_wiget">',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
}

function  theme_gallery($attr) {
   

    $post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	
	$output = apply_filters( 'post_gallery', '', $attr, $instance );

	if ( ! empty( $output ) ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts  = shortcode_atts(
		array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure' : 'dl',
			'icontag'    => $html5 ? 'div' : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
			'link'       => '',
		),
		$attr,
		'gallery'
	);

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts(
			array(
				'include'        => $atts['include'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'exclude'        => $atts['exclude'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	} else {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag    = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag    = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns   = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
	$float     = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';


	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';

		$gallery_style = "
		<style{$type_attr}>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
	}

	$size_class  = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";


	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;

	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';

		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
                
                $image_output = str_replace('<a','<a data-lightbox="id'.get_the_ID().'" ',$image_output);
                        
		$image_meta = wp_get_attachment_metadata( $id );

		$orientation = '';

		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";

		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</{$captiontag}>";
		}

		$output .= "</{$itemtag}>";

		if ( ! $html5 && $columns > 0 && ++$i % $columns === 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
    
}



remove_shortcode('gallery');
add_shortcode('gallery', 'theme_gallery');

add_action( 'widgets_init', 'footer_widgets_init' );

add_theme_support( 'post-thumbnails' );