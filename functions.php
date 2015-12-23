<?php
/**
 * BootstrapWP Theme Functions
 *
 * @author Rachel Baker <rachel@rachelbaker.me>
 * @package WordPress
 * @subpackage BootstrapWP
 */

/**
 * Maximum allowed width of content within the theme.
 */
if (!isset($content_width)) {
    $content_width = 770;
}

/**
 * Setup Theme Functions
 *
 */
if (!function_exists('bootstrapwp_theme_setup')):
    function bootstrapwp_theme_setup() {

        load_theme_textdomain('bootstrapwp', get_template_directory() . '/lang');

        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat' ));

        register_nav_menus(
            array(
                'main-menu' => __('Main Menu', 'bootstrapwp'),
            ));
        // load custom walker menu class file
        require 'includes/class-bootstrapwp_walker_nav_menu.php';
    }
endif;
add_action('after_setup_theme', 'bootstrapwp_theme_setup');

/**
 * Define post thumbnail size.
 * Add two additional image sizes.
 *
 */
function bootstrapwp_images() {

    set_post_thumbnail_size(260, 180); // 260px wide x 180px high
    add_image_size('bootstrap-small', 300, 200); // 300px wide x 200px high
    add_image_size('bootstrap-medium', 360, 270); // 360px wide by 270px high
}

/**
 * Load CSS styles for theme.
 *
 */
function bootstrapwp_styles_loader() {

    wp_enqueue_style('bootstrap3-wp-style', get_template_directory_uri() . '/assets/css/bootstrap.css', false, '1.0', 'all');
    wp_enqueue_style('buddypress-style', get_template_directory_uri() . '/assets/css/buddypress.css', false, '1.0', 'all');
    wp_enqueue_style('bootstrap3-wp-default', get_stylesheet_uri());


}
add_action('wp_enqueue_scripts', 'bootstrapwp_styles_loader');

/** Disable adminbar **/

    add_filter('show_admin_bar', '__return_false');  

/**
 * Load JavaScript and jQuery files for theme.
 *
 */

//Load Jquery from Google CDN
function jquery_cdn() {
   if (!is_admin()) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
      wp_enqueue_script('jquery');
      }
   }
add_action('init', 'jquery_cdn');

function bootstrapwp_scripts_loader() {

    if (is_singular() && comments_open() && get_option('thread_comments')) {

        wp_enqueue_script('comment-reply');

    }

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('demo-js', get_template_directory_uri() . '/assets/js/bootstrapwp.demo.js', array('bootstrap-js'),'1.0',true);

}
add_action('wp_enqueue_scripts', 'bootstrapwp_scripts_loader');

/**
 * Define theme's widget areas.
 *
 */
function bootstrapwp_widgets_init() {

    register_sidebar(
        array(
            'name'          => __('Page Sidebar', 'bootstrapwp'),
            'id'            => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Posts Sidebar', 'bootstrapwp'),
            'id'            => 'sidebar-posts',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Left', 'bootstrapwp'),
            'id'            => 'home-left',
            'description'   => __('Left textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Middle', 'bootstrapwp'),
            'id'            => 'home-middle',
            'description'   => __('Middle textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Right', 'bootstrapwp'),
            'id'            => 'home-right',
            'description'   => __('Right textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('OSPK-left', 'bootstrapwp'),
            'id'            => 'ospk-left',
            'description'   => __('Left textbox on ospk homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('OSPK-right', 'bootstrapwp'),
            'id'            => 'ospk-right',
            'description'   => __('Left textbox on ospk homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer Content', 'bootstrapwp'),
            'id'            => 'footer-content',
            'description'   => __('Footer text or acknowledgements', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s col-md-3">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        )
    );

}
add_action('init', 'bootstrapwp_widgets_init');


/**
 * Display page next/previous navigation links.
 *
 */
if (!function_exists('bootstrapwp_content_nav')):
    function bootstrapwp_content_nav($nav_id) {

        global $wp_query, $post;

        if ($wp_query->max_num_pages > 1) : ?>

        <nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
            <h3 class="sr-only"><?php _e('Post navigation', 'bootstrapwp'); ?></h3>
            <div class="nav-previous pull-left"><?php next_posts_link(
                __('<span class="meta-nav">&larr;</span> Older posts', 'bootstrapwp')
            ); ?></div>
            <div class="nav-next pull-right"><?php previous_posts_link(
                __('Newer posts <span class="meta-nav">&rarr;</span>', 'bootstrapwp')
            ); ?></div>
        </nav><!-- #<?php echo $nav_id; ?> .navigation -->

        <?php endif;
    }
endif;

/**
 * Display template for comments and pingbacks.
 *
 */
if (!function_exists('bootstrapwp_comment')) :
    function bootstrapwp_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>

                <li class="comment media" id="comment-<?php comment_ID(); ?>">
                    <div class="media-body">
                        <p>
                            <?php _e('Pingback:', 'bootstrapwp'); ?> <?php comment_author_link(); ?>
                        </p>
                    </div><!--/.media-body -->
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post; ?>

                <li class="comment media" id="li-comment-<?php comment_ID(); ?>">
                        <a href="<?php echo $comment->comment_author_url;?>" class="pull-left">
                            <?php echo get_avatar($comment, 64); ?>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading comment-author vcard">
                                <?php
                                printf('<cite class="fn">%1$s %2$s</cite>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
                                        'Post author',
                                        'bootstrapwp'
                                    ) . '</span> ' : ''); ?>
                            </h4>

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    'bootstrapwp'
                                ); ?></p>
                            <?php endif; ?>

                            <?php comment_text(); ?>
                            <p class="meta">
                                <?php printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                            esc_url(get_comment_link($comment->comment_ID)),
                                            get_comment_time('c'),
                                            sprintf(
                                                __('%1$s at %2$s', 'bootstrapwp'),
                                                get_comment_date(),
                                                get_comment_time()
                                            )
                                        ); ?>
                            </p>
                            <p class="reply">
                                <?php comment_reply_link( array_merge($args, array(
                                            'reply_text' => __('Reply <span>&darr;</span>', 'bootstrapwp'),
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )); ?>
                            </p>
                        </div>
                        <!--/.media-body -->
                <?php
                break;
        endswitch;
    }
endif;


/**
 * Display template for post meta information.
 *
 */
if (!function_exists('bootstrapwp_posted_on')) :
    function bootstrapwp_posted_on()
    {
        printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>','bootstrapwp'),
            esc_url(get_permalink()),
            esc_attr(get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_attr(sprintf(__('View all posts by %s', 'bootstrapwp'), get_the_author())),
            esc_html(get_the_author())
        );
    }
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 */
function bootstrapwp_body_classes($classes)
{
    if (!is_multi_author()) {
        $classes[] = 'single-author';
    }
    return $classes;
}
add_filter('body_class', 'bootstrapwp_body_classes');


/**
 * Add post ID attribute to image attachment pages prev/next navigation.
 *
 */
function bootstrapwp_enhanced_image_navigation($url)
{
    global $post;
    if (wp_attachment_is_image($post->ID)) {
        $url = $url . '#main';
    }
    return $url;
}
add_filter('attachment_link', 'bootstrapwp_enhanced_image_navigation');


/**
 * Checks if a post thumbnails is already defined.
 *
 */
function bootstrapwp_is_post_thumbnail_set()
{
    global $post;
    if (get_the_post_thumbnail()) {
        return true;
    } else {
        return false;
    }
}


/**
 * Set post thumbnail as first image from post, if not already defined.
 *
 */
function bootstrapwp_autoset_featured_img()
{
    global $post;

    $post_thumbnail = bootstrapwp_is_post_thumbnail_set();
    if ($post_thumbnail == true) {
        return get_the_post_thumbnail();
    }
    $image_args     = array(
        'post_type'      => 'attachment',
        'numberposts'    => 1,
        'post_mime_type' => 'image',
        'post_parent'    => $post->ID,
        'order'          => 'desc'
    );
    $attached_images = get_children($image_args, ARRAY_A);
    $first_image = reset($attached_images);
    if (!$first_image) {
        return false;
    }

    return get_the_post_thumbnail($post->ID, $first_image['ID']);

}


/**
 * Define default page titles.
 *
 */
function bootstrapwp_wp_title($title, $sep)
{
    global $paged, $page;
    if (is_feed()) {
        return $title;
    }
    // Add the site name.
    $title .= get_bloginfo('name');
    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }
    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'bootstrapwp'), max($paged, $page));
    }
    return $title;
}
add_filter('wp_title', 'bootstrapwp_wp_title', 10, 2);

/**
 * Display template for breadcrumbs.
 *
 */
function bootstrapwp_breadcrumbs()
{
    $home      = 'Home'; // text for the 'Home' link
    $before    = '<li class="active">'; // tag before the current crumb
    $sep       = '<span class="divider"></span>';
    $after     = '</li>'; // tag after the current crumb

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<ul class="breadcrumb">';

        global $post;
        $homeLink = home_url();
            echo '<li><a href="' . $homeLink . '">' . $home . '</a> '.$sep. '</li> ';
            if (is_category()) {
                global $wp_query;
                $cat_obj   = $wp_query->get_queried_object();
                $thisCat   = $cat_obj->term_id;
                $thisCat   = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo get_category_parents($parentCat, true, $sep);
                }
                echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_day()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a></li> ';
                echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                    'F'
                ) . '</a></li> ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a></li> ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug      = $post_type->rewrite;
                    echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
                    echo $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo '<li>'.get_category_parents($cat, true, $sep).'</li>';
                    echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat    = get_the_category($parent->ID);
                $cat    = $cat[0];
                echo get_category_parents($cat, true, $sep);
                echo '<li><a href="' . get_permalink(
                    $parent
                ) . '">' . $parent->post_title . '</a></li> ';
                echo $before . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {
                echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id   = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page          = get_page($parent_id);
                    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title(
                        $page->ID
                    ) . '</a>' . $sep . '</li>';
                    $parent_id     = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $crumb;
                }
                echo $before . get_the_title() . $after;
            } elseif (is_search()) {
                echo $before . 'Search results for "' . get_search_query() . '"' . $after;
            } elseif (is_tag()) {
                echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Articles posted by ' . $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }
            // if (get_query_var('paged')) {
            //     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            //     ) {
            //         echo ' (';
            //     }
            //     echo __('Page', 'bootstrapwp') . $sep . get_query_var('paged');
            //     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            //     ) {
            //         echo ')';
            //     }
            // }

        echo '</ul>';

    }
}

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a bootstrap.
 */

//CUSTOM FUNCTIONS***************************************************************************************

function admin_bar_view() {
  if ( is_user_logged_in() ) {
	if (current_user_can( "activate_plugins" )) {
	  return true;
	}
  }
  return false;
}

add_filter('show_admin_bar', 'admin_bar_view');

// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_admin_css() {
   echo '<style type="text/css">
			.mfp-wrap {z-index: 14503;}
			.avatar {max-width:30px!important; max-height:30px!important;}
         </style>';
}

add_action('admin_head', 'custom_admin_css');

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => 'Headlines',
		'singular_name'       => 'Headline',
		'menu_name'           => 'Top news',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Items',
		'view_item'           => 'View Item',
		'add_new_item'        => 'Add New Item',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Item',
		'update_item'         => 'Update Item',
		'search_items'        => 'Search Item',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'               => 'headline',
		'description'         => 'News headlines',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'headline', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );


/*FAIL2BAN
function fail2ban_login_failed_401() {
    status_header( 401 );
}
add_action( 'wp_login_failed', 'fail2ban_login_failed_401' );*/

function current_page_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}

function fb_header() {
  
  if (is_single()) {
	global $post;
	$a_post = get_post($post);
	$post_id = $a_post->ID;
	$slug = $a_post->post_name;
	$author_id=$a_post->post_author;
	$xerpt = htmlspecialchars(substr(strip_tags($a_post->post_content),0,200));
	$description = $xerpt;
  }
  
  $title = get_the_title();
  $link = current_page_url();
  $thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
  $author_url = get_the_author_meta('user_url', $author_id);
  $fb_page = "https://www.facebook.com/dailypakistan.en";
  
  if (!is_single()) {
	$title = "Daily Pakistan Global" . single_term_title(" - ",FALSE);
	$thumbnail = "http://en.dailypakistan.com.pk/wp-content/uploads/2015/02/fb-head.jpg";
	$xerpt = "Pakistan’s Leading Online News Portal";
	$description = "Local newspaper with a global outlook. Daily Pakistan is a leading newspaper that brings news from Pakistan and around the world.";
  }
  
  //if (in_category(160) && get_the_author_meta('c5_term_meta_user_facebook', $author_id)!="") {
	//$author_url = "https://www.facebook.com/". get_the_author_meta('c5_term_meta_user_facebook', $author_id);
  //}
  
  echo "<meta name='description' content='".$description."'/>
  <meta property='og:title' content='".$title."' />
  <meta property='og:site_name' content='Daily Pakistan Global'/>
  <meta property='og:url' content='".$link."' />
  <meta property='og:description' content='".$xerpt."' />
  <meta property='og:image' content='".$thumbnail."' />
  <meta property='fb:app_id' content='388666161164782' />
  <meta property='og:type' content='article' />
  <meta property='og:locale' content='en_US' />
  <meta property='article:author' content='".$author_url."' />
  <meta property='article:publisher' content='".$fb_page."' />
  <meta name='twitter:card' content='summary_large_image'/>
  <meta name='twitter:site' content='@dailypakistangl'>
  <meta name='twitter:description' content='".$description."'/>
  <meta name='twitter:title' content='".$title."'/>
  <meta name='twitter:image' content='".$thumbnail."'/>
  <script type='application/ld+json'>{ '@context': 'http://schema.org', '@type': 'WebSite', 'url': 'http://en.dailypakistan.com.pk/', 'potentialAction': { '@type': 'SearchAction', 'target': 'http://en.dailypakistan.com.pk/?s={search_term}', 'query-input': 'required name=search_term' } }</script>";
}

add_action('wp_head', 'fb_header',0);

//Author bio in Opinion
function authorbio($content) {
  if(!is_feed() && in_category(160)) {
	$twitter_user = get_the_author_meta('c5_term_meta_user_twitter');
	$content.="<pre class='ft-author'>";
	$content.="<span class='ft-avatar'><a href='".get_author_posts_url( get_the_author_meta('ID'))."'>".get_avatar( get_the_author_meta('ID'), 32)."</a></span>";
	$content.="<span class='h6 ft-desc'>".get_the_author_meta( 'description' );
	if ($twitter_user!='') {
	  $content.="<br><span class='ft-twitter'><a href='https://twitter.com/intent/tweet?screen_name=".$twitter_user."' class='twitter-mention-button' data-related='dailypakistangl'>Tweet to @".$twitter_user."</a></span>";
	  $content.="<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
	}
	$content.="</span><br></pre>";
	if ($twitter_user=='') {$content.="<style>pre.ft-author {padding: 0.7em 1em 0.9em 1em;}</style>";}
  }
  return $content;
}
add_filter ('the_content', 'authorbio', -10);

//Add text at the end of opinion posts
function opinionfootertext($content) {
        if(!is_feed() && in_category(160)) {
                $content.= "<div class='opinion-footer'>";
                $content.= "<h6>Opinions expressed by the author do not represent the opinions of the publication</h6>";
		  		$content.= "<h6 class='p'>To contribute, email your submissions to  <a href='mailto:waqas@dailypakistan.com.pk'>waqas@dailypakistan.com.pk</a></h6>";
                $content.= "</div>";
        }
        return $content;
}
add_filter ('the_content', 'opinionfootertext');