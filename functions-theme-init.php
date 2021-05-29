<?php

/*******************************************************************************
 * ADD THEME SUPPORTS
 ******************************************************************************/
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
// Définir la taille des images mises en avant
set_post_thumbnail_size( 1920, 1080, true );
// Définir d'autres tailles d'images
add_image_size( '480p', 720, 480 );
add_image_size( '720p', 1280, 720 );
add_image_size( '1080p', 1920, 1080 );
add_image_size( '268p', 402, 268 );
add_image_size( '446p', 669, 446 );
add_image_size( 'top-wide', 1600, 500, true );
add_image_size( 'normal-book-cover', 309, 499 );
add_image_size( 'large-book-cover', 337, 531 );
add_image_size( 'small-book-cover', 183, 300 );
add_image_size( 'extra-small-book-cover', 92, 150 );
// Rewrite rules
add_filter('init', function() {
	global $wp_rewrite;

	add_rewrite_tag('%by%','([^&]+)');
	add_rewrite_tag('%category%','([^&]+)');

	$wp_rewrite->add_rule(
		'books/([^/]*)/([^/]*)/?',
		'index.php?pagename=books&by=$matches[1]&category=$matches[2]',
		'top'
	);
	$wp_rewrite->add_rule(
		'books/([^/]*)/?',
		'index.php?pagename=books&by=$matches[1]',
		'top'
	);

	$wp_rewrite->flush_rules();
});

/*******************************************************************************
 * REDIRECTS POSTS FROM OLD TO NEW PERMALINK
 ******************************************************************************/
function redirects_callback() {
	if( is_404() ) {
		if( file_exists( get_template_directory() . '/parts/rewrite301-rules.php' ) ) {
			include_once( get_template_directory() . '/parts/rewrite301-rules.php' );

			global $wp;
			$current_slug = esc_url( strtolower( '/' . trailingslashit( add_query_arg( array(), $wp->request ) ) ) );
			if( isset( $rewite301_rules[$current_slug] ) ) {
				//wp_redirect( home_url( $rewite301_rules[$current_slug]['url'] ), 301 );
				header( "Status: 301 Moved Permanently", false, 301 );
				header( "Location: " . home_url( $rewite301_rules[$current_slug]['url'] ) );
				exit();
			}
		}
	}
}
add_action( 'template_redirect', 'redirects_callback' );

/*******************************************************************************
 * REGISTER ASSETS
 ******************************************************************************/
function register_assets() {

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.css', array(), '1.0' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.04' );

	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/theme.js?ver=1.2', array(), '1.3', true );
	wp_enqueue_script( 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'register_assets' );

function add_rel_preload( $html, $handle, $href, $media ) {
    if( is_admin() || wp_is_mobile() || !get_theme_mod( 'preload_styles', true ) )
        return $html;

     $html = <<<EOT
<link rel='preload stylesheet' as='style' onload="this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
EOT;
    return $html;
}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

/*function hook_css() {
}
add_action( 'wp_head', 'hook_css' );*/

/*******************************************************************************
 * CHECK AND CREATE ALL NEEDED PAGES AND MENUS
 ******************************************************************************/
register_nav_menus( array( 'main' => __( 'Menu Principal', 'BTB' ) ) );
function theme_setup() {

	/* PAGES */
	if( get_option( 'show_on_front' ) == 'posts' )
		update_option( 'show_on_front', 'page' );

	$check_page_exist = get_page_by_path( 'home', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "Bienvenue sur Born To Be", 'BTB'),
				'post_name'      => 'home',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
		update_option( 'page_on_front', $page_id );
	}

	$check_page_exist = get_page_by_path( 'blog', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "Toutes les publications", 'BTB'),
				'post_name'      => 'blog',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
		update_option( 'page_for_posts', $page_id );
	}

	$check_page_exist = get_page_by_path( 'privacy', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "Mentions légales", 'BTB'),
				'post_name'      => 'privacy',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
		update_option( 'wp_page_for_privacy_policy', $page_id );
	}

	$check_page_exist = get_page_by_path( 'articles', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "Les articles", 'BTB'),
				'post_name'      => 'articles',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
	}

	$check_page_exist = get_page_by_path( 'authors', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "L'équipe Born To Be", 'BTB'),
				'post_name'      => 'authors',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
	}

	$check_page_exist = get_page_by_path( 'contact', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "Nous contacter", 'BTB'),
				'post_name'      => 'contact',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
	}

	$check_page_exist = get_page_by_path( 'books', 'OBJECT', 'page' );
	if( empty( $check_page_exist ) ) {
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => __( "La bibliothèque", 'BTB'),
				'post_name'      => 'books',
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
				'post_parent'    => 0
			)
		);
	}

	/* MENUS */
	if( isset( get_nav_menu_locations()['main'] ) ) {
		$menu_name = 'BTB Theme default menu';
		$menu_id = wp_create_nav_menu( $menu_name );
		$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
		$menu_id = $menu->term_id;


		$nav_menu = wp_get_nav_menu_items( $menu_id );
		if( !$nav_menu )
			$nav_menu = array();

		$exists = array();
		foreach( $nav_menu as $m ) {
			if( !in_array( $m->post_title, $exists ) )
				$exists[] = $m->post_title;
		}

		$name = __( 'Accueil', 'BTB' );
		if( !in_array( $name, $exists ) ) {
			$id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => $name,
				'menu-item-parent-id' => 0,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/' ) );
		}

		$name = __( 'Le blog', 'BTB' );
		if( !in_array( $name, $exists ) ) {
			$id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => $name,
				'menu-item-parent-id' => 0,
				'menu-item-status' => 'publish',
				'menu-item-url' => '' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'Toutes les publications', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/blog/' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'L\'actu passée au crible', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/actu/' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'En bref', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/news/' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'Articles, Analyses et Réflexions', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/articles/' ) );
		}

		$name = __( 'La bibliothèque', 'BTB' );
		if( !in_array( $name, $exists ) ) {
			$id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => $name,
				'menu-item-parent-id' => 0,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/books/' ) );
		}

		$name = __( 'A propos', 'BTB' );
		if( !in_array( $name, $exists ) ) {
			$id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => $name,
				'menu-item-parent-id' => 0,
				'menu-item-status' => 'publish',
				'menu-item-url' => '' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'L\'équipe Born To Be', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/authors/' ) );
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => __( 'Mentions légales', 'BTB' ),
				'menu-item-parent-id' => $id,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/privacy/' ) );
		}

		$name = __( 'Nous contacter', 'BTB' );
		if( !in_array( $name, $exists ) ) {
			$id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => $name,
				'menu-item-parent-id' => 0,
				'menu-item-status' => 'publish',
				'menu-item-url' => '/contact/' ) );
		}


		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['main'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}



}
add_action( 'after_switch_theme', 'theme_setup' );


/*******************************************************************************
 * UPDATE THEME URL AUTOMATICALY
 ******************************************************************************/
function theme_redirect_menus( $items, $args ) {
    foreach( $items as $key => $item ) {
        if( $item->object == 'custom' && $item->url == '#' ) {
            $item->url = trailingslashit( get_home_url() );
        } else if( $item->object == 'custom' && substr( $item->url, 0, 1 ) == '/' ) {
			$item->url = get_home_url() . $item->url;
		}
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'theme_redirect_menus', 10, 2 );


/*******************************************************************************
 * ADMIN CUSTOM POST TYPE SETUP
 ******************************************************************************/
function cpt_setup() {
	$labels = array(
		'name'                => _x( 'En bref', 'Post Type General Name'),
		'singular_name'       => _x( 'En bref', 'Post Type Singular Name'),
		'menu_name'           => __( 'Brèves'),
		'all_items'           => __( 'Toutes les brèves'),
		'view_item'           => __( 'Voir les brèves'),
		'add_new_item'        => __( 'Ajouter une nouvelle brève'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la brève'),
		'update_item'         => __( 'Modifier la brève'),
		'search_items'        => __( 'Rechercher une brève'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille')
	);
	$args = array(
		'label'               => __( 'Brèves'),
		'description'         => __( 'Les brèves'),
		'menu_icon'			  => 'dashicons-slides',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'show_in_rest' 		  => true,
		'menu_position' 	  => 4,
		'show_in_nav_menus'   => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'news' ),
		'capability_type'	  => 'post',
		'taxonomies' 		  => array( 'category', 'post_tag' )
	);
	register_post_type( 'news', $args );

	$labels_actu = array(
		'name'                => _x( 'L\'actu passée au crible', 'Post Type General Name'),
		'singular_name'       => _x( 'Actu', 'Post Type Singular Name'),
		'menu_name'           => __( 'Analyses de l\'actualité'),
		'all_items'           => __( 'Toutes l\'actu'),
		'view_item'           => __( 'Voir l\'actualité'),
		'add_new_item'        => __( 'Ajouter une nouvelle actu'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer cette actualité'),
		'update_item'         => __( 'Modifier cette actualité'),
		'search_items'        => __( 'Rechercher dans l\'actualité'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille')
	);
	$args_actu = array(
		'label'               => __( 'Analyses de l\'actualité'),
		'description'         => __( 'Les analyses'),
		'menu_icon'			  => 'dashicons-admin-site-alt2',
		'labels'              => $labels_actu,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'show_in_rest' 		  => true,
		'menu_position' 	  => 5,
		'show_in_nav_menus'   => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'actu' ),
		'capability_type'	  => 'post',
		'taxonomies' 		  => array( 'category', 'post_tag' )
	);
	register_post_type( 'actu', $args_actu );

	$labels_books = array(
		'name'                => _x( 'Littérature', 'Post Type General Name'),
		'singular_name'       => _x( 'Littérature', 'Post Type Singular Name'),
		'menu_name'           => __( 'Littérature'),
		'all_items'           => __( 'Littérature'),
		'view_item'           => __( 'Voir tous les livres'),
		'add_new_item'        => __( 'Ajouter un nouveau livre'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer ce livre'),
		'update_item'         => __( 'Modifier ce livre'),
		'search_items'        => __( 'Rechercher dans les livres'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille')
	);
	$args_books = array(
		'label'               => __( 'Littérature'),
		'description'         => __( 'Tous les livres'),
		'menu_icon'			  => 'dashicons-book-alt',
		'labels'              => $labels_books,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'show_in_rest' 		  => true,
		'menu_position' 	  => 6,
		'show_in_nav_menus'   => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
		'rewrite'			  => array( 'slug' => 'book' ),
		'capability_type'	  => 'post',
		'taxonomies' 		  => array( 'category', 'post_tag' )
	);
	register_post_type( 'book', $args_books );

	flush_rewrite_rules( true );
}
add_action( 'init', 'cpt_setup' );





?>