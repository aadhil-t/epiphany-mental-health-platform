<?php
/*------- Theme Supports ---------*/
add_action('after_setup_theme', 'res_theme_support');
function res_theme_support()
{
    add_theme_support('wp-block-styles');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_post_type_support('page', 'excerpt');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    // Woocommerce Support
    add_theme_support('woocommerce');
    //Woocommerce gallery support
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    /*** end ***/
}
@ini_set('upload_max_size', '1G');
@ini_set('post_max_size', '1G');
@ini_set('max_execution_time', '3000');
/* Flush rewrite rules for custom post types. */
add_action('after_switch_theme', 'awpr_flush_rewrite_rules');
function awpr_flush_rewrite_rules()
{
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

/*------------- Disallow Backend Editting ----------------*/
define('DISALLOW_FILE_EDIT', true);

/*-------------- Disable XMLRPC ---------------------*/
add_filter('xmlrpc_enabled', '__return_false');

/*------------- Hide Wordpress Version Generator ---------------*/
add_filter('the_generator', 'version');
function version()
{
    return '';
}

/*----------- Remove WP-Embed script ---------------*/
function disable_embeds_init()
{
    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'disable_embeds_init', 9999);

/*------- Remove emoji script and css ------*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/*---------------acf Settings ----------*/
include_once('includes/acf-pro/acf.php');

add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path)
{
    // update path
    $path = get_bloginfo('stylesheet_directory') . '/includes/acf-pro/';
    // return
    return $path;
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir)
{
    $dir = get_stylesheet_directory_uri() . '/includes/acf-pro/';

    return $dir;
}

/**
 * acf options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'  => 'Theme General Settings',
        'menu_title'  => 'Theme Options',
        'menu_slug'   => 'theme-general-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Sticky Links',
        'menu_title'  => 'Sticky Links',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Social Media',
        'menu_title'  => 'Social Media',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Miscellaneous',
        'menu_title'  => 'Miscellaneous',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Footer',
        'menu_title'  => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Gallery',
        'menu_title'  => 'Gallery',
        'parent_slug' => 'theme-general-settings',
    ));
}

/**
 * Remove acf sttings from backend
 */
//add_filter( 'acf/settings/show_admin', '__return_false' );

/*------- Excerpt -------*/
function new_excerpt_length($length)
{
    return 200;  // length used for media press release
}
add_filter('excerpt_length', 'new_excerpt_length');

function trim_excerpt($more)
{
    return '...';
}
add_filter('excerpt_more', 'trim_excerpt');
/*** end ***/

/* ------------Shorten text without cutting words in half-------------------*/
function trim_text($input, $length, $ellipses = true, $strip_html = true)
{
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= ' ...';
    }

    return $trimmed_text;
}


/*----- svg support -----*/
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*----- custom post archive -----*/
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query)
{
    if (is_category() || is_tag() || is_month() || is_day() || is_year()) {
        $post_type = get_query_var('post_type');
        if ($post_type)
            $post_type = $post_type;
        else
            $post_type = get_post_types();
        $query->set('post_type', $post_type);
        return $query;
    }
}




// *----- Wp Login Page Logo Link ------*/
add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url($url)
{
    return get_home_url();
}
/*-----------------------------Admin login logo-------------------------------*/
function my_login_logo()
{
   $header = get_field('header', 'option');

        if (!empty($header['logo_image'])) {
            $logo_url = esc_url($header['logo_image']['url']);
        } ?>
    <style type="text/css">
        body.login {
            box-sizing: border-box;
            background:rgb(243 225 215);
            font-size: 14px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            
        }

        body.login *,
        body.login *:before,
        body.login *:after {
            box-sizing: inherit;
        }

        body.login.login-action-lostpassword #login {
            padding: 0;
        }

        .login h1 {
            margin: 0 0 0px;
        }

        #login {
            width: 75% !important;
            max-width: 400px !important;
            padding: 180px 0 !important;
        }

        #login #nav {
            font-weight: 600;
            padding-left: 0;
        }

        .login h1 a {
            background-image: url(<?php echo $logo_url; ?>) !important;
            width: 300px !important;
            background-size: contain !important;
            outline: none !important;
            margin: 0 auto !important;
        }

        .login .message {
            border-left: 4px solid #a28346 !important;
        }

        body.login .button-primary {
            border: 1px solid #c47a1b; !important;
            position: relative;
            display: inline-block;
            text-transform: uppercase;
            font-weight: 500;
            white-space: nowrap;
            line-height: 1.8em !important;
            width: 140px !important;
            max-width: 100% !important;
            text-align: center;
            transition: all .2s linear;
            padding: 10px 20px !important;
            text-shadow: none !important;
            box-shadow: none !important;
            height: auto !important;
            font-size: 15px;
            border-radius: 33px;
            font-weight: 400;
            background-color: #c47a1b;
            border: 0;
            color: #fff;
        }

        body.login .button-primary:hover,
        body.login .button-primary:focus,
        body.login .button-primary:active {
            background: #fff !important;
            color:#c47a1b; !important;
            font-weight: bold;
            opacity: 1;
            border: 1px solid #c47a1b; !important;
        }

        #login form {
            padding: 50px !important;
            margin: auto;
            background: #fff;
            margin: 0 auto !important;
           
            border-radius: .25rem;
            position: relative;
            text-align: left;
        }

        .login .password-input-wrapper {
            width: 100%;
        }

        #login .message,
        #login #login_error,
        #login form,
        #login #backtoblog {
            margin: 20px auto;
            max-width: 620px;
            padding-left: 15px;
        }

        .login #login_error,
        .login .message,
        .login .success {
            padding: 15px 20px !important;
            text-align: left;
        }

        body.login.login-action-lostpassword #login a {
            color: #010101;
        }

        body.login.login-action-lostpassword #login input[type=text] {
            margin: 5px 0 15px;
            border: 0;
            background: #fff;
            box-shadow: none;
            border-bottom: 1px solid #ddd;
            padding: 5px 0;
        }

        body.login p#backtoblog,
        .privacy-policy-link {
            display: none;
        }

        .login #backtoblog a:hover,
        .login #nav a:hover,
        .login h1 a:hover {
            color: #AE005E !important;
        }

        .login .privacy-policy-page-link {
            opacity: 0.7;
        }

        .login form .forgetmenot {
            margin-top: 12px;
        }
    </style>
<?php
}
add_action('login_enqueue_scripts', 'my_login_logo');
function put_my_url()
{
    return (site_url('/login'));
}


/*------- Removing p tag --------*/
add_filter('wpcf7_autop_or_not', '__return_false');


/*------- Enqueue Scripts & Styles --------*/
add_action('wp_enqueue_scripts', 'theme_scripts_styles');
function theme_scripts_styles()
{
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js');
    wp_register_script('jquery-migrate', get_template_directory_uri() . '/js/migrate.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');

    //Custom
    wp_register_script('swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), '', true);
    wp_register_script('sticky', get_template_directory_uri() . '/js/sticky.js', array('jquery'), '', true);
    wp_register_script('common_scripts', get_template_directory_uri() . '/js/common.js', array('jquery'), '', true);
    wp_register_script('magnificPopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
    wp_register_script('validate', get_template_directory_uri() . '/js/validate.js', array('jquery'), '', true);
    wp_register_script('aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), '', true);

    wp_enqueue_script('Swiper');
    wp_enqueue_script('common_scripts');
    wp_enqueue_script('magnificPopup');
    wp_enqueue_script('aos');
}

/*------ Remove script attributes -------*/
add_filter('style_loader_tag', 'mtheme_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'mtheme_remove_type_attr', 10, 2);
function mtheme_remove_type_attr($tag, $handle)
{
    return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}

/**
 * Adding Defer attribute to scripts
 */
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
function add_defer_attribute($tag, $handle)
{
    // add script handles to the array below
    $scripts_to_defer = array('google_map');

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}

/*------- remove css and js versions --------*/
function vc_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver=' . get_bloginfo('version')))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

/*-------- Move header scripts to footer ------*/
function remove_head_scripts()
{
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'remove_head_scripts');

/*------ Register Navigation Menu -------*/
register_nav_menus(
    array(
        'header_menu' => 'Header Menu',
        'top_menu' => 'Top Menu',
        'footer_menu1' => 'Footer Menu1',
        'footer_resources_menu' => 'Footer Resources Menu',
        'footer_legal_menu'     => 'Footer Legal Menu',
        'footer_policy_menu' => 'Footer Policy Menu',

        
    )
);





// Remove category archives
// add_action('template_redirect', 'jltwp_adminify_remove_archives_category');
function jltwp_adminify_remove_archives_category()
{
    if (is_category()) {
        $target = get_option('siteurl');
        $status = '301';
        wp_redirect($target, 301);
        die();
    }
}

// Register Custom Post Type

function custom_post_type()

{

    
     //Event post creation
    register_post_type('event', array(
        'label' => 'Event',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'query_var' => true,
        'exclude_from_search' => false,
        'publicly_queryable'    => true,
        'menu_icon' => 'dashicons-sticky',
        'has_archive'           => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'page-attributes'),
        'labels' => array(
            'name' => 'Event',
            'singular_name' => 'Event',
            'featured_image' => __('Featured Image'),
            'menu_name' => 'Event',
            'add_new' => 'Add New Event',
            'add_new_item' => 'Add New Event',
            'edit' => 'Edit Event',
            'edit_item' => 'Edit Event',
            'new_item' => 'New Event',
            'view' => 'View Event',
            'view_item' => 'View Event',
            'search_items' => 'Search Event',
            'not_found' => 'No Event Found',
            'not_found_in_trash' => 'No Event Found in Trash',
            'parent' => 'Parent Event'
        )
    ));
     //Service post creation
    register_post_type('service', array(
        'label' => 'Service',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'query_var' => true,
        'exclude_from_search' => false,
        'publicly_queryable'    => true,
        'menu_icon' => 'dashicons-admin-generic',
        'has_archive'           => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'page-attributes'),
        'labels' => array(
            'name' => 'Service',
            'singular_name' => 'Service',
            'featured_image' => __('Featured Image'),
            'menu_name' => 'Service',
            'add_new' => 'Add New Service',
            'add_new_item' => 'Add New Service',
            'edit' => 'Edit Service',
            'edit_item' => 'Edit Service',
            'new_item' => 'New Service',
            'view' => 'View Service',
            'view_item' => 'View Service',
            'search_items' => 'Search Service',
            'not_found' => 'No Service Found',
            'not_found_in_trash' => 'No Service Found in Trash',
            'parent' => 'Parent Service'
        )
    ));

     //therapist post creation
    register_post_type('therapist', array(
        'label' => 'Therapist',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'query_var' => true,
        'exclude_from_search' => false,
        'publicly_queryable'    => true,
        'menu_icon' => 'dashicons-admin-generic',
        'has_archive'           => false,
        'show_in_rest' => true,
        'rewrite' => array(
        'slug' => 'team',  
        'with_front' => false
        ),
        'supports' => array('title', 'editor', 'page-attributes'),
        'labels' => array(
            'name' => 'Therapist',
            'singular_name' => 'Therapist',
            'featured_image' => __('Featured Image'),
            'menu_name' => 'Therapist',
            'add_new' => 'Add New Therapist',
            'add_new_item' => 'Add New Therapist',
            'edit' => 'Edit Therapist',
            'edit_item' => 'Edit Therapist',
            'new_item' => 'New Therapist',
            'view' => 'View Therapist',
            'view_item' => 'View Therapist',
            'search_items' => 'Search Therapist',
            'not_found' => 'No Therapist Found',
            'not_found_in_trash' => 'No Therapist Found in Trash',
            'parent' => 'Parent Therapist'
        )
    ));
    
}

add_action('init', 'custom_post_type', 0);


/*------------------------ Register taxonomies --------------------------*/
function add_custom_taxonomies()
{
    register_taxonomy('genre', array('department'), array(
        'hierarchical' => true,
        'has_archive' => false,
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => _x('Genre', 'taxonomy general name'),
            'singular_name' => _x('Genre', 'taxonomy singular name'),
            'search_items' => __('Search Genre'),
            'all_items' => __('All Genre'),
            'parent_item' => __('Parent Genre'),
            'parent_item_colon' => __('Parent Genre:'),
            'edit_item' => __('Edit Genre'),
            'update_item' => __('Update Genre'),
            'add_new_item' => __('Add New Genre'),
            'new_item_name' => __('New Genre Name'),
            'menu_name' => __('Genre'),
        ),
        'rewrite' => array(
            'with_front'   => false,
            'hierarchical' => true,
            'ep_mask'      => EP_NONE
        )
    ));
}




// Ultimate FAQs prints questions as <h4> straight after the page <h1>; expose them as level 2 for screen readers (no visual change)
add_filter('the_content', function ($content) {
    return preg_replace('/(ewd-ufaq-faq-title-text[\'"]>\s*)<h4(?=[\s>])/i', '$1<h4 aria-level="2"', $content);
}, 20);
