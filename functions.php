<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

define('STYLESHEET_VERSION', '1.0');
define('JAVASCRIPT_VERSION', '1.0');


if (!isset($content_width)) {
    $content_width = 900;
}

add_image_size('huge', 1998, '', false); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
add_image_size('case-study-image', 1600, '', false); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 335, '', false); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}


/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav($menu) {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => $menu, 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}


// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
    if (!is_admin()) {
    
      wp_register_script('myfonts', get_template_directory_uri() . '/js/myfonts.js', array(), JAVASCRIPT_VERSION); // Custom scripts
      wp_enqueue_script('myfonts');

    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery');
    	
    	wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0'); // Conditionizr
      wp_enqueue_script('conditionizr');
      
      wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
      wp_enqueue_script('modernizr');
      
      wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), JAVASCRIPT_VERSION); // Custom scripts
      wp_enqueue_script('plugins');

      wp_register_script('javascripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'plugins'), JAVASCRIPT_VERSION); // Custom scripts
      wp_enqueue_script('javascripts');
    }
}


// Load HTML5 Blank conditional scripts
/* function html5blank_conditional_scripts() {
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname');
    }
} */


// Load HTML5 Blank styles
function html5blank_styles() {
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');
    
    wp_register_style('reset_css', get_template_directory_uri() . '/css/lib/reset.min.css', array(), '1.0', 'all');
    wp_enqueue_style('reset_css');

    wp_register_style('typography', get_template_directory_uri() . '/css/app/typography.css', array(), '1.0', 'all');
    wp_enqueue_style('typography');

    wp_register_style('march_parent', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('march_parent');

    wp_register_style('march_main', get_template_directory_uri() . '/css/app/main.css', array(), '1.0', 'all');
    wp_enqueue_style('march_main');

    wp_register_style('march_header', get_template_directory_uri() . '/css/app/header.css', array(), '1.0', 'all');
    wp_enqueue_style('march_header');
    
    wp_register_style('march_footer', get_template_directory_uri() . '/css/app/footer.css', array(), '1.0', 'all');
    wp_enqueue_style('march_footer');
    
    wp_register_style('march_home', get_template_directory_uri() . '/css/app/home.css', array(), '1.0', 'all');
    wp_enqueue_style('march_home');

    wp_register_style('march_interior', get_template_directory_uri() . '/css/app/interior.css', array(), '1.0', 'all');
    wp_enqueue_style('march_interior');
    
    wp_register_style('march_overlay', get_template_directory_uri() . '/css/app/overlay.css', array(), '1.0', 'all');
    wp_enqueue_style('march_overlay');

    wp_register_style('march_thumbnail_grid', get_template_directory_uri() . '/css/app/thumbnail_grid.css', array(), '1.0', 'all');
    wp_enqueue_style('march_thumbnail_grid');

}


// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}


// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}


// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}


// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}


// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}


// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}


// Custom Excerpts
function html5wp_index($length) { // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
    return 20;
}


// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
    return 40;
}


// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}


// Custom View Article link to Post
function html5_blank_view_article($more) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}


// Remove Admin bar
function remove_admin_bar() {
    return false;
}


// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}


// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}


// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}


// Custom Comments Callback
function html5blankcomments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
//add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_case_studies'); // Add our Featured Project Type
add_action('init', 'create_post_type_slogan'); // Add our Case Study Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

add_action('init', 'create_post_type_featured_projects');
add_action('init', 'create_post_type_archi_imaging');    
add_action('init', 'create_post_type_dev_marketing');    
add_action('init', 'create_post_type_case_study');       


function create_post_type_featured_projects() {
    register_post_type('conceptdesign', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Concept Design Images', 'concept_design'), // Rename these to suit
            'singular_name' => __('Concept Design Image', 'concept_design'),
            'add_new' => __('Add New', 'concept_design'),
            'add_new_item' => __('Add New Concept Design Image', 'concept_design'),
            'edit' => __('Edit', 'concept_design'),
            'edit_item' => __('Edit Concept Design Image', 'concept_design'),
            'new_item' => __('New Concept Design Image', 'concept_design'),
            'view' => __('View Concept Design Images', 'concept_design'),
            'view_item' => __('View Concept Design Image', 'concept_design'),
            'search_items' => __('Search Concept Design Images', 'concept_design'),
            'not_found' => __('No Concept Design Images found', 'concept_design'),
            'not_found_in_trash' => __('No Concept Design Images found in Trash', 'concept_design')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'can_export' => true,
    ));
}


function create_post_type_archi_imaging() {
    register_post_type('architecturalimaging', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Architectural Imaging Images', 'arch_imaging'), // Rename these to suit
            'singular_name' => __('Architectural Imaging Image', 'arch_imaging'),
            'add_new' => __('Add New', 'arch_imaging'),
            'add_new_item' => __('Add New Architectural Imaging Image', 'arch_imaging'),
            'edit' => __('Edit', 'arch_imaging'),
            'edit_item' => __('Edit Architectural Imaging Image', 'arch_imaging'),
            'new_item' => __('New Architectural Imaging Image', 'arch_imaging'),
            'view' => __('View Architectural Imaging Images', 'arch_imaging'),
            'view_item' => __('View Architectural Imaging Image', 'arch_imaging'),
            'search_items' => __('Search Architectural Imaging Images', 'arch_imaging'),
            'not_found' => __('No Architectural Imaging Images found', 'arch_imaging'),
            'not_found_in_trash' => __('No Architectural Imaging Images found in Trash', 'arch_imaging')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'can_export' => true,
    ));
}


function create_post_type_dev_marketing() {
    register_post_type('developmentmarketing', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Development Marketing Images', 're_marketing'), // Rename these to suit
            'singular_name' => __('Development Marketing Image', 're_marketing'),
            'add_new' => __('Add New', 're_marketing'),
            'add_new_item' => __('Add New Development Marketing Image', 're_marketing'),
            'edit' => __('Edit', 're_marketing'),
            'edit_item' => __('Edit Development Marketing Image', 're_marketing'),
            'new_item' => __('New Development Marketing Image', 're_marketing'),
            'view' => __('View Development Marketing Images', 're_marketing'),
            'view_item' => __('View Development Marketing Image', 're_marketing'),
            'search_items' => __('Search Development Marketing Images', 're_marketing'),
            'not_found' => __('No Development Marketing Images found', 're_marketing'),
            'not_found_in_trash' => __('No Development Marketing Images found in Trash', 're_marketing')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'can_export' => true,
    ));
}


function create_post_type_case_study() {
    register_post_type('casestudy', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Case Studies', 'casestudy'), // Rename these to suit
            'singular_name' => __('Case Study', 'casestudy'),
            'add_new' => __('Add New', 'casestudy'),
            'add_new_item' => __('Add New Case Study', 'casestudy'),
            'edit' => __('Edit', 'casestudy'),
            'edit_item' => __('Edit Case Study', 'casestudy'),
            'new_item' => __('New Case Study', 'casestudy'),
            'view' => __('View Case Studies', 'casestudy'),
            'view_item' => __('View Case Study', 'casestudy'),
            'search_items' => __('Search Case Studies', 'casestudy'),
            'not_found' => __('No Case Studies found', 'casestudy'),
            'not_found_in_trash' => __('No Case Studies found in Trash', 'casestudy')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'can_export' => true,
        'taxonomies' => array('category')
    ));
}


function create_post_type_slogan() {
    register_post_type('slogan', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Slogans', 'slogan'), // Rename these to suit
            'singular_name' => __('Slogan', 'slogan'),
            'add_new' => __('Add New', 'slogan'),
            'add_new_item' => __('Add New Slogan', 'slogan'),
            'edit' => __('Edit', 'slogan'),
            'edit_item' => __('Edit Slogan', 'slogan'),
            'new_item' => __('New Slogan', 'slogan'),
            'view' => __('View Slogans', 'slogan'),
            'view_item' => __('View Slogan', 'slogan'),
            'search_items' => __('Search Slogans', 'slogan'),
            'not_found' => __('No Slogans found', 'slogan'),
            'not_found_in_trash' => __('No Slogans found in Trash', 'slogan')
        ),
        'public' => true,
        'supports' => array(
            'title',
        ),
        'can_export' => false,
    ));
}






/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}


// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}







// high compression for huge images
add_filter( 'jpeg_quality', 'adjust_image_quality' );
add_filter( 'wp_editor_set_quality', 'adjust_image_quality' );
function adjust_image_quality( $quality ) {
    return 50;
}








function add_image_attachment_fields_to_edit($form_fields, $post) {
  $checked = (get_post_meta($post->ID, 'grid_image', true)) ? 'checked' : null;
  $form_fields["grid_image"] = array(
    "label" => __("Thumbnail?"),
    "input" => "html", // this is default if "input" is omitted
    'html' => "<input type='checkbox' name='attachments[{$post->ID}][grid_image]' id='attachments[{$post->ID}][grid_image]' value='1' {$checked} >",
    "value" => get_post_meta($post->ID, "grid_image", true)
  );
  return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

function add_image_attachment_fields_to_save($post, $attachment) {
  if( isset($attachment['grid_image']) )
    update_post_meta($post['ID'], 'grid_image', (int)$attachment['grid_image']);
  else
    update_post_meta($post['ID'], 'grid_image', 0);
  return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);

