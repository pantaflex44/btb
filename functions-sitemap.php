<?php

$sitemap_generator_allowed_types = array(
	'page',
	'post',
	'news',
	'actu',
	'book'
);

/*******************************************************************************
 * SITEMAP SAVER
 ******************************************************************************/
function sitemap_saver( $filename, $content ) {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	global $wp_filesystem;
	return $wp_filesystem->put_contents(
		trailingslashit( $wp_filesystem->abspath() ) . $filename,
		$content,
		FS_CHMOD_FILE
	);
}

/*******************************************************************************
 * GET SITEMAP HEADS
 ******************************************************************************/
function get_sitemap_heads() {
	$home_url = trailingslashit( home_url() );

	$sitemap = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
	$sitemap .= '<?xml-stylesheet type="text/xsl" href="' . get_template_directory_uri() . '/assets/css/sitemap.xsl"?>' . "\n";
	$sitemap .= '<!-- sitemap-generator-url="' . $home_url . '" sitemap-generator-version="1.0.0" -->' . "\n";
	$sitemap .= '<!-- generated-on="' . current_time( 'c', true ) . '" -->' . "\n";

	return $sitemap;
}

/*******************************************************************************
 * GET NEWS SITEMAP HEADS
 ******************************************************************************/
function get_news_sitemap_heads() {
	$home_url = trailingslashit( home_url() );

	$sitemap = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
	$sitemap .= '<!-- sitemap-generator-url="' . $home_url . '" sitemap-generator-version="1.0.0" -->' . "\n";
	$sitemap .= '<!-- generated-on="' . current_time( 'c', true ) . '" -->' . "\n";

	return $sitemap;
}

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap structure
 ******************************************************************************/
function sitemap_generator_sitemap_struct( $home_url, $file, $file_date ) {
	$sitemap = "\t" . '<!-- ' . $file . ' -->' . "\n";
	$sitemap .= "\t" . '<sitemap>' . "\n";
	$sitemap .= "\t\t" . '<loc>' . $home_url . $file . '</loc>' . "\n";
	$sitemap .= "\t\t" . '<lastmod>' . $file_date . '</lastmod>' . "\n";
	$sitemap .= "\t" . '</sitemap>' . "\n";

	return $sitemap;
}

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap file
 ******************************************************************************/
function sitemap_generator_sitemap_file( $home_url, $file_path, $file ) {
	if( file_exists( $file_path . $file ) ) {
		$file_date = date( 'c', filemtime( $file_path . $file ) );
		return sitemap_generator_sitemap_struct( $home_url, $file, $file_date );
	}

	return '';
}

/*******************************************************************************
 * SITEMAP GENERATOR - update
 ******************************************************************************/
function sitemap_generator_update() {
	global $sitemap_generator_allowed_types;

	sitemap_generator_main( false );

	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	global $wp_filesystem;
	$home_url = trailingslashit( home_url() );
	$file_path = trailingslashit( $wp_filesystem->abspath() );

	$sitemap = get_sitemap_heads();
	$sitemap .= '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
	$news_sitemap = $sitemap;

	$types = array_merge( $sitemap_generator_allowed_types, array( 'main', 'tags', 'categories' ) );

	foreach( $types as $s ) {
		$sitemap .= sitemap_generator_sitemap_file( $home_url, $file_path, 'sitemap-' . $s . '.xml' );
		$news_sitemap .= sitemap_generator_sitemap_file( $home_url, $file_path, 'news-sitemap-' . $s . '.xml' );
	}
	$sitemap .= '</sitemapindex>' . "\n";
	$news_sitemap .= '</sitemapindex>' . "\n";

	if( get_theme_mod( 'auto_sitemap', true ) )
		sitemap_saver( 'sitemap.xml', $sitemap );
	else
		@unlink( $file_path . 'sitemap.xml');

	if( get_theme_mod( 'auto_news_sitemap', true ) )
		sitemap_saver( 'news-sitemap.xml', $news_sitemap );
	else
		@unlink( $file_path . 'news-sitemap.xml');

}

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap-main.xml
 ******************************************************************************/
function sitemap_generator_main( $update = true ) {
	$home_url = trailingslashit( home_url() );

	$sitemap = get_sitemap_heads();
	$sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	$sitemap .= "\t" . '<!-- Homepage -->' . "\n";
	$sitemap .= "\t" . '<url>' . "\n";
	$sitemap .= "\t\t" . '<loc>' . $home_url . '</loc>' . "\n";
	$sitemap .= "\t\t" . '<lastmod>' . current_time( 'c', true ) . '</lastmod>' . "\n";
	$sitemap .= "\t\t" . '<changefreq>' . get_theme_mod( 'section_main_changefreq', 'daily' ) . '</changefreq>' . "\n";
	$sitemap .= "\t\t" . '<priority>' . get_theme_mod( 'section_main_priority', '1.0' ) . '</priority>' . "\n";
	$sitemap .= "\t" . '</url>' . "\n";

	$sitemap .= '</urlset>' . "\n";
	if( get_theme_mod( 'auto_sitemap', true ) ) {
		if( sitemap_saver( 'sitemap-main.xml', $sitemap ) && $update )
			sitemap_generator_update();
	} else {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$file_path = trailingslashit( $wp_filesystem->abspath() );
		@unlink( $file_path . 'sitemap-main.xml');
	}
}

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap-tags.xml
 ******************************************************************************/
function sitemap_generator_tags( $update = true ) {
	$home_url = trailingslashit( home_url() );

	$sitemap = get_sitemap_heads();
	$sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	$counter = 0;
	$tags = get_tags( array( 'get' => 'all' ) );
	if( $tags ) {
		foreach( $tags as $tag ) {
			$counter++;
			$sitemap .= "\t" . '<!-- ' . esc_html( $tag->name ) . ' -->' . "\n";
			$sitemap .= "\t" . '<url>' . "\n";
			$sitemap .= "\t\t" . '<loc>' . esc_url( get_term_link( $tag ) ) . '</loc>' . "\n";
			$sitemap .= "\t\t" . '<lastmod>' . current_time( 'c', true ) . '</lastmod>' . "\n";
			$sitemap .= "\t\t" . '<changefreq>' . get_theme_mod( 'section_tags_changefreq', 'weekly' ) . '</changefreq>' . "\n";
			$sitemap .= "\t\t" . '<priority>' . get_theme_mod( 'section_tags_priority', '0.3' ) . '</priority>' . "\n";
			$sitemap .= "\t" . '</url>' . "\n";
		}
	}

	$sitemap .= '</urlset><!-- ' . $counter . ' tags -->' . "\n";
	if( get_theme_mod( 'auto_sitemap', true ) ) {
		if( sitemap_saver( 'sitemap-tags.xml', $sitemap ) && $update )
			sitemap_generator_update();
	} else {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$file_path = trailingslashit( $wp_filesystem->abspath() );
		@unlink( $file_path . 'sitemap-tags.xml');
	}
}
add_action( 'created_term', 'sitemap_generator_tags', 10, 3 );
add_action( 'edited_term', 'sitemap_generator_tags', 10, 3 );
add_action( 'delete_term', 'sitemap_generator_tags', 10, 5 );

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap-categories.xml
 ******************************************************************************/
function sitemap_generator_categories( $update = true ) {
	$home_url = trailingslashit( home_url() );

	$sitemap = get_sitemap_heads();
	$sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	$counter = 0;
	$tags = get_categories( array( 'get' => 'all' ) );
	if( $tags ) {
		foreach( $tags as $tag ) {
			$counter++;
			$sitemap .= "\t" . '<!-- ' . esc_html( $tag->name ) . ' -->' . "\n";
			$sitemap .= "\t" . '<url>' . "\n";
			$sitemap .= "\t\t" . '<loc>' . esc_url( get_category_link( $tag->term_id ) ) . '</loc>' . "\n";
			$sitemap .= "\t\t" . '<lastmod>' . current_time( 'c', true ) . '</lastmod>' . "\n";
			$sitemap .= "\t\t" . '<changefreq>' . get_theme_mod( 'section_categories_changefreq', 'weekly' ) . '</changefreq>' . "\n";
			$sitemap .= "\t\t" . '<priority>' . get_theme_mod( 'section_categories_priority', '0.3' ) . '</priority>' . "\n";
			$sitemap .= "\t" . '</url>' . "\n";
		}
	}

	$sitemap .= '</urlset><!-- ' . $counter . ' categories -->' . "\n";
	if( get_theme_mod( 'auto_sitemap', true ) ) {
		if( sitemap_saver( 'sitemap-categories.xml', $sitemap ) && $update )
			sitemap_generator_update();
	} else {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$file_path = trailingslashit( $wp_filesystem->abspath() );
		@unlink( $file_path . 'sitemap-categories.xml');
	}
}
add_action( 'created_{$taxonomy}', 'sitemap_generator_categories', 10, 3 );
add_action( 'edited_category', 'sitemap_generator_categories', 10, 3 );
add_action( 'delete_category', 'sitemap_generator_categories', 10, 5 );

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap-{$type}.xml
 ******************************************************************************/
function sitemap_generator_posts_type( $type, $update = true ) {
	$sitemap = get_sitemap_heads();
	$sitemap .= '<!-- Posts type: ' . $type . ' -->' . "\n";
	$sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	$changefreq = 'weekly';
	$priority = '0.5';
	switch( $type ) {
		case 'page':
			$changefreq = get_theme_mod( 'section_pages_changefreq', 'weekly' );
			$priority = get_theme_mod( 'section_pages_priority', '0.5' );
			break;
		case 'book':
			$changefreq = get_theme_mod( 'section_books_changefreq', 'weekly' );
			$priority = get_theme_mod( 'section_books_priority', '0.5' );
			break;
		default:
			$changefreq = get_theme_mod( 'section_posts_changefreq', 'weekly' );
			$priority = get_theme_mod( 'section_posts_priority', '0.8' );
			break;
	}

	$counter = 0;
	$posts = get_posts( array( 'get' => 'all', 'post_type' => $type, 'post_status' => 'publish', 'numberposts' => 50000, 'posts_per_page' => -1 ) );
	if( $posts ) {
		foreach( $posts as $post ) {
			$counter++;
			$sitemap .= "\t" . '<!-- ' . esc_html( $post->post_title ) . ' -->' . "\n";
			$sitemap .= "\t" . '<url>' . "\n";
			$sitemap .= "\t\t" . '<loc>' . esc_url( get_permalink( $post->ID ) ) . '</loc>' . "\n";
			$sitemap .= "\t\t" . '<lastmod>' . date( 'c', strtotime( $post->post_modified_gmt ) ) . '</lastmod>' . "\n";
			$sitemap .= "\t\t" . '<changefreq>' . $changefreq . '</changefreq>' . "\n";
			$sitemap .= "\t\t" . '<priority>' . $priority . '</priority>' . "\n";
			$sitemap .= "\t" . '</url>' . "\n";
		}
	}

	$sitemap .= '</urlset><!-- ' . $counter . ' ' . $type . ' -->' . "\n";
	if( get_theme_mod( 'auto_sitemap', true ) ) {
		$result = sitemap_saver( 'sitemap-' . $type . '.xml', $sitemap );
		if( $result	&& $update )
			sitemap_generator_update();
	} else {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$file_path = trailingslashit( $wp_filesystem->abspath() );
		@unlink( $file_path . 'sitemap-' . $type . '.xml' );
	}
}

/*******************************************************************************
 * SITEMAP GENERATOR - news-sitemap-{$type}.xml
 ******************************************************************************/
function sitemap_generator_posts_type_news( $type, $update = true ) {
	if( $type == 'page' || $type == 'book' )
		return;

	$sitemap = get_news_sitemap_heads();
	$sitemap .= '<!-- Posts type: ' . $type . ' -->' . "\n";
	$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-news/0.9 http://www.google.com/schemas/sitemap-news/0.9/sitemap-news.xsd">' . "\n";

	$counter = 0;
	$posts = get_posts( array( 'get' => 'all', 'post_type' => $type, 'post_status' => 'publish', 'numberposts' => 50000, 'posts_per_page' => -1 ) );
	if( $posts ) {
		foreach( $posts as $post ) {
			$counter++;

			$terms_list = array();

			$terms_categories = get_the_terms( $post->ID, 'category' );
			if( $terms_categories )
				foreach( $terms_categories as $term )
					$terms_list[] = esc_html( $term->name );

			$terms_tags = get_the_terms( $post->ID, 'post_tag' );
			if( $terms_tags )
				foreach( $terms_tags as $term )
					$terms_list[] = esc_html( $term->name );

			$sitemap .= "\t" . '<!-- ' . esc_html( $post->post_title ) . ' -->' . "\n";
			$sitemap .= "\t" . '<url>' . "\n";
			$sitemap .= "\t\t" . '<loc>' . esc_url( get_permalink( $post->ID ) ) . '</loc>' . "\n";
			if( $type != 'page' && $type != 'book' ) {
				$sitemap .= "\t\t" . '<news:news>' . "\n";
				$sitemap .= "\t\t\t" . '<news:publication>' . "\n";
				$sitemap .= "\t\t\t\t" . '<news:name>' . esc_html( get_bloginfo( 'name' ) ) . '</news:name>' . "\n";
				$sitemap .= "\t\t\t\t" . '<news:language>' . substr( get_bloginfo ( 'language' ), 0, 2 ) . '</news:language>' . "\n";
				$sitemap .= "\t\t\t" . '</news:publication>' . "\n";
				$sitemap .= "\t\t\t" . '<news:publication_date>' . date( 'c', strtotime( $post->post_date_gmt ) ) . '</news:publication_date>' . "\n";
				$sitemap .= "\t\t\t" . '<news:title>' . esc_html( $post->post_title ) . '</news:title>' . "\n";
				$sitemap .= "\t\t\t" . '<news:keywords>' . implode( ', ', $terms_list ) . '</news:keywords>' . "\n";
				$sitemap .= "\t\t" . '</news:news>' . "\n";
			}
			$sitemap .= "\t" . '</url>' . "\n";
		}
	}

	$sitemap .= '</urlset><!-- ' . $counter . ' ' . $type . ' -->' . "\n";
	if( get_theme_mod( 'auto_news_sitemap', true ) ) {
		$result = sitemap_saver( 'news-sitemap-' . $type . '.xml', $sitemap );
		if( $result	&& $update )
			sitemap_generator_update();
	} else {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$file_path = trailingslashit( $wp_filesystem->abspath() );
		@unlink( $file_path . 'news-sitemap-' . $type . '.xml' );
	}
}

/*******************************************************************************
 * SITEMAP GENERATOR - sitemap-{$type}.xml
 ******************************************************************************/
function sitemap_generator_pages_posts( $post_id = -1, $after = false, $before = false, $update = true ) {
	global $sitemap_generator_allowed_types;

	$home_url = trailingslashit( home_url() );

	$type = '';
	if( isset( $after ) && $after ) {
		$type = get_post_type( $after );
		if( !$type || !is_string( $type ) )
			$type = '';
		$type = trim( strtolower( $type ) );
	}

	if( $type == '' ) {
		foreach( $sitemap_generator_allowed_types as $t ) {
			sitemap_generator_posts_type( $t, $update );
			sitemap_generator_posts_type_news( $t, $update );
		}
	} else {
		if( in_array( $type, $sitemap_generator_allowed_types ) ) {
			sitemap_generator_posts_type( $type, $update );
			sitemap_generator_posts_type_news( $type, $update );
		}
	}

}
add_action( 'deleted_post', 'sitemap_generator_pages_posts', 10, 5 );
add_action( 'save_post', 'sitemap_generator_pages_posts', 10, 3 );

/*******************************************************************************
 * SITEMAP GENERATOR - robots.txt exists
 ******************************************************************************/
function sitemap_generator_robots_exists( $file ) {
	if( file_exists( $file ) )
		return $file;

	$lowerfile = strtolower( $file );
	foreach( glob( dirname( $file ) . '/*' ) as $f )
		if( strtolower( $f ) == $lowerfile )
			return $f;

	return false;
}

/*******************************************************************************
 * SITEMAP GENERATOR - verify or create robots.txt
 ******************************************************************************/
function sitemap_generator_robots_verify() {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	global $wp_filesystem;

	$content = '';

	$file = sitemap_generator_robots_exists( trailingslashit( $wp_filesystem->abspath() ) . 'robots.txt' );
	$file = is_string( $file ) ? trim( $file ) : $file;
	if( !$file || empty( $file ) ) {

		$file = trailingslashit( $wp_filesystem->abspath() ) . 'robots.txt';
		$content = 'User-agent : *' . "\n";
		$content .= 'Disallow: /wp-login.php' . "\n";
		$content .= "\n";

	} else {

		$lines = explode( "\n", $wp_filesystem->get_contents( $file ) );
		foreach( $lines as $line ) {
			$found = stripos( $line, 'sitemap', 0 );
			if( $found === false ) {
				$line = trim( $line );
				if( $line != ''
					|| ( $line == ''
						 && substr( $content, strlen( $content ) - 2, 2 ) != "\n\n" )
						 && strlen( $content ) > 0 )
					$content .= $line . "\n";
			}
		}

	}

	if( file_exists( trailingslashit( $wp_filesystem->abspath() ) . 'sitemap.xml' ) )
		$content .= 'Sitemap: ' . trailingslashit( home_url() ) . 'sitemap.xml' . "\n";

	if( file_exists( trailingslashit( $wp_filesystem->abspath() ) . 'news-sitemap.xml' ) )
		$content .= 'Sitemap: ' . trailingslashit( home_url() ) . 'news-sitemap.xml' . "\n";

	if( function_exists( 'iconv' )
		&& function_exists( 'mb_detect_encoding' )
		&& function_exists( 'mb_detect_order' ) )
		$content = iconv( mb_detect_encoding( $content, mb_detect_order(), true ), "UTF-8", $content );

	$wp_filesystem->put_contents(
		$file,
		$content,
		FS_CHMOD_FILE
	);
}

/*******************************************************************************
 * SITEMAP GENERATOR
 ******************************************************************************/
function sitemap_generator() {
	sitemap_generator_tags( false );
	sitemap_generator_categories( false );
	sitemap_generator_pages_posts( -1, false, false, false );

	sitemap_generator_update();

	sitemap_generator_robots_verify();
}
add_action( 'after_switch_theme', 'sitemap_generator' );
add_action( 'customize_save_after', 'sitemap_generator' );

?>