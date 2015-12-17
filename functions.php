<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Thetford China' );
define( 'CHILD_THEME_URL', 'http://www.thetford.cn/' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'sample_viewport_meta_tag' );
function sample_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=1024"/>';
}

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

/** Reposition the secondary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

function footerbar() {
   echo '<div class="footerbar"></div>';
}

add_action( 'genesis_after', 'footerbar' );  

//REMOVE PAGE TITLE
add_action('get_header', 'child_remove_page_titles');
function child_remove_page_titles() {
if (is_page('13')) {
remove_action('genesis_post_title', 'genesis_do_post_title');
}
}

/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
if ( !is_page() ) {
    $post_info = '[post_date]';
    return $post_info;
}}

// Remove post meta
remove_action('genesis_after_post_content', 'genesis_post_meta');

// Add div inside of body
function backgroundimg() {
    echo '<div class="pagebg"></div>';
}
add_action('genesis_before', 'backgroundimg');

function bottombg() {
    echo '<div class="bottombg"></div>';
}
add_action('genesis_after_content_sidebar_wrap', 'bottombg');

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'auc_do_footer' );
function auc_do_footer() {
/*  $footernav = wp_nav_menu( array('menu' => 'Footer menu' ));
  echo $footernav;
*/
genesis_do_sidebar_alt(); 
  }

  // Changing excerpt more - only works where excerpt IS hand-crafted
add_filter('get_the_excerpt', 'manual_excerpt_more');
function manual_excerpt_more($excerpt) {
	$excerpt_more = '';
	if( has_excerpt() ) {
    	$excerpt_more = ' <br/><a href="'.get_permalink().'" rel="nofollow" class="button">Read more</a>';
	}
	return $excerpt . $excerpt_more;
}

// Changing excerpt more - only works where excerpt is NOT hand-crafted
add_filter('excerpt_more', 'auto_excerpt_more');
function auto_excerpt_more($more) {
    return '<br/><a href="'.get_permalink().'" rel="nofollow" class="button">Read more</a>';
}

// Enable qTranslate for WordPress SEO & previous/next post
	function qtranslate_filter($text){
		return __($text);
	}
	add_filter('wpseo_title', 'qtranslate_filter', 10, 1);
	add_filter('wpseo_metadesc', 'qtranslate_filter', 10, 1);
	add_filter('wpseo_metakey', 'qtranslate_filter', 10, 1);
	
	
add_action( 'genesis_after', 'my_genesis_script' );
function my_genesis_script()
{
    if ( is_page('31') && qtrans_getLanguage()=='zh' || is_page('583') && qtrans_getLanguage()=='zh' || is_page('413') && qtrans_getLanguage()=='zh' || is_page('278') && qtrans_getLanguage()=='zh' || is_page('316') && qtrans_getLanguage()=='zh' || is_page('61') && qtrans_getLanguage()=='zh') {	?>
		<script type="text/javascript"> var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://"); document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F492175fd2a5bdd0707636bd2dc0dddaf' type='text/javascript'%3E%3C/script%3E"));</script>
	<?php 	}
    else {}
}

function jqueryui(){
	if ( is_page('208') ) {
		wp_enqueue_script( 'jQueryUI', 'http://code.jquery.com/ui/1.10.4/jquery-ui.js', array(), '1.10.4', true );
		wp_enqueue_style( 'jQueryUICSS', 'http://code.jquery.com/ui/1.10.4/themes/blitzer/jquery-ui.css' );
		
	?>
	<script>
		jQuery( document ).ready(function( $ ) {
			$( ".accordion" ).accordion({
				active: 	false,
				collapsible: 	true,
				heightStyle: 	"content"
			});
		});
	</script>
	<?php
	}
}

add_action('wp_head','jqueryui');



