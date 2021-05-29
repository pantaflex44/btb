<?php

/*******************************************************************************
 * GET A BREADCRUMB
 ******************************************************************************/
function the_breadcrumb() {
	echo '<div id="breadcrumbs-container"><ul id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';

	$index = 1;

	if( is_home() || !is_home() ) { echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_option( 'home' ) . '"><span itemprop="name">' . __( 'Accueil', 'BTB' ) . '</span></a><meta itemprop="position" content="' . $index . '" /></li>'; }
	if( is_home() ) { echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . __( 'Toutes les publications', 'BTB' ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>'; }
	if( is_page() ) { echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>'; }
	if( is_search() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . sprintf( '%s: %s', __( 'Recherche', 'BTB' ), esc_html( get_query_var( 's' ) ) ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
	}
	if( is_single() ) {
		$postTypeSlug = get_post_type();
		$postType = get_post_type_object( $postTypeSlug );
		if( $postType ) {
			$name = esc_html( $postType->labels->singular_name );
			$link = get_post_type_archive_link( $postTypeSlug );
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" ' . ( $link ? 'href="' . esc_attr( $link ) . '"' : '' ) . '><span itemprop="name">' . $name . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
		}
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
	}
	if( is_tag() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . sprintf( '%s: %s', __( 'Sur le sujet', 'BTB' ), single_tag_title( '', false ) ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
	}
	if( is_category() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . sprintf( '%s: %s', __( 'Dans la catégorie', 'BTB' ), single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
	}
	if( is_author() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_attr( get_permalink( get_page_by_path( 'authors' ) ) ) . '"><span itemprop="name">' . __( 'Les membres du site', 'BTB' ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
		$author = get_queried_object();
		if ( $author ) {
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . $author->display_name . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
		} else {
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . __( 'Auteur', 'BTB' ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
		}
	}
	if( is_post_type_archive() ) {
		$postTypeSlug = get_post_type();
		$postType = get_post_type_object( $postTypeSlug );
		if( $postType ) {
			$name = esc_html( $postType->labels->singular_name );
			$link = get_post_type_archive_link( $postTypeSlug );
			if( $link ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_attr( $link ) . '"><span itemprop="name">' . $name . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
			}
		}
	}
	if( is_date() ) {
		$t = get_the_date();
		$year = get_query_var( 'year' );
		$monthnum = get_query_var( 'monthnum' );
		$day = get_query_var( 'day' );
		if( !$monthnum && !$day && $year )
			$t = $year;
		if( $monthnum && !$day && !$year )
			$t = single_month_title( ' ', false );
		if( $monthnum && $year && !$day)
			$t = single_month_title( ' ', false );

		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item"><span itemprop="name">' . sprintf( '%s: %s', __( 'Archive en date', 'BTB' ), $t ) . '</span></a><meta itemprop="position" content="' . ++$index . '" /></li>';
	}

	echo '</ul></div>';
}

/*******************************************************************************
 * GET ALL TAGS
 ******************************************************************************/
function get_all_tags() {
	$tags = wp_tag_cloud( array(
			'smallest'		=> 0.8,
			'largest'		=> 2.0,
			'unit'			=> 'em',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'link'			=> 'view',
			'format'		=> 'array',
			'taxonomy'		=> 'post_tag',
			'show_count'	=> 0,
			'echo'			=> 0
		)
	);

	if( !is_array( $tags ) )
		return null;

	$t = [];
	foreach( $tags as $tag ) {
		$name = strip_tags( $tag );
		$link = '';
		$title = '';
		$style = '';

		$pattern = '/(\w+)=[\'"]([^\'"]*)/';
		preg_match_all( $pattern, $tag, $matches, PREG_SET_ORDER );

		foreach( $matches as $match ) {
			if( is_array( $match ) && count( $match ) >= 3 ) {
				$tag = strtolower( trim( $match[1] ) );
				$value = trim( $match[2] );

				switch( $tag ) {
					case 'href':
						$link = $value;
						break;
					case 'title':
					case 'label':
					case 'aria-label':
						$title = $value;
						break;
					case 'style':
						$style = $value;
						break;
				}
			}
		}

		if( $link != '' )
			$t[] = array( 'name' => $name, 'link' => $link, 'title' => $title, 'style' => $style );

	}

	return $t;
}

/*******************************************************************************
 * GET ALL CATEGORIES
 ******************************************************************************/
function get_all_categories() {
	$tags = wp_tag_cloud( array(
			'smallest'		=> 0.8,
			'largest'		=> 2.0,
			'unit'			=> 'em',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'link'			=> 'view',
			'format'		=> 'array',
			'taxonomy'		=> 'category',
			'show_count'	=> 0,
			'echo'			=> 0
		)
	);
	if( !is_array( $tags ) )
		return null;

	$t = [];
	foreach( $tags as $tag ) {
		$name = strip_tags( $tag );
		$link = '';
		$title = '';
		$style = '';

		$pattern = '/(\w+)=[\'"]([^\'"]*)/';
		preg_match_all( $pattern, $tag, $matches, PREG_SET_ORDER );

		foreach( $matches as $match ) {
			if( is_array( $match ) && count( $match ) >= 3 ) {
				$tag = strtolower( trim( $match[1] ) );
				$value = trim( $match[2] );

				switch( $tag ) {
					case 'href':
						$link = $value;
						break;
					case 'title':
					case 'label':
					case 'aria-label':
						$title = $value;
						break;
					case 'style':
						$style = $value;
						break;
				}
			}
		}

		if( $link != '' )
			$t[] = array( 'name' => $name, 'link' => $link, 'title' => $title, 'style' => $style );

	}

	return $t;
}

/*******************************************************************************
 * CUSTOM WP_LIST_AUTHORS FUNCTION
 ******************************************************************************/
function get_roles() {
	$wp_roles = new WP_Roles();
	$roles = $wp_roles->get_names();
	$roles = array_map( 'translate_user_role', $roles );

	return $roles;
}

/*******************************************************************************
 * CUSTOM WP_LIST_AUTHORS FUNCTION
 ******************************************************************************/
function custom_wp_list_authors( $args = '' ) {
	global $wpdb;

	$defaults = array(
		'orderby' => 'name', 'order' => 'ASC', 'number' => '',
		'optioncount' => false, 'exclude_admin' => true,
		'show_fullname' => false, 'hide_empty' => true,
		'feed' => '', 'feed_image' => '', 'feed_type' => '', 'echo' => true,
		'style' => 'list', 'html' => true
	);

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	$return = '';

	$query_args = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'number' ) );
	$query_args['fields'] = 'ids';
	$authors = get_users( $query_args );

		$custom_post_types = get_post_types( array( '_builtin' => false ) );
		if( !empty( $custom_post_types ) ) {
			$temp = implode ( "','", $custom_post_types );
			$custom_post_types = "'";
			$custom_post_types .= $temp;
			$custom_post_types .= "','post'";
		} else {
			$custom_post_types .= "'post'";
		}

	$author_count = array();
	foreach( (array) $wpdb->get_results( "SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type in ( $custom_post_types )  AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
		$author_count[$row->post_author] = $row->count;

	foreach( $authors as $author_id ) {
		$author = get_userdata( $author_id );

		if( $exclude_admin && 'admin' == $author->display_name )
			continue;

		$posts = isset( $author_count[$author->ID] ) ? $author_count[$author->ID] : 0;

		if( !$posts && $hide_empty )
			continue;

		$link = '';

		if( $show_fullname && $author->first_name && $author->last_name )
			$name = "$author->first_name $author->last_name";
		else
			$name = $author->display_name;

		if( !$html ) {
			$return .= $name . ', ';

			continue; // No need to go further to process HTML.
		}

		if( 'list' == $style )
			$return .= '<li>';

		$link = '<a href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '" title="' . esc_attr( sprintf(__("%s"), $author->display_name) ) . '">' . $name . '</a>';

		if( !empty( $feed_image ) || !empty( $feed ) ) {
			$link .= ' ';
			if( empty( $feed_image ) )
				$link .= '(';

			$link .= '<a href="' . get_author_feed_link( $author->ID ) . '"';

			$alt = $title = '';
			if( !empty( $feed ) ) {
				$title = ' title="' . esc_attr( $feed ) . '"';
				$alt = ' alt="' . esc_attr( $feed ) . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if( !empty( $feed_image ) )
				$link .= '<img src="' . esc_url( $feed_image ) . '" style="border: none;"' . $alt . $title . ' />';
			else
				$link .= $name;

			$link .= '</a>';

			if( empty( $feed_image ) )
				$link .= ')';

		}

		if( $optioncount )
			$link .= ' ('. $posts . ')';

		$return .= $link;
		$return .= ( 'list' == $style ) ? '</li>' : ', ';
	}

	$return = rtrim( $return, ', ' );

	if( !$echo )
		return $return;

	echo $return;
}

/*******************************************************************************
 * GET RANDOM BOOK
 ******************************************************************************/
function get_random_book( $thumbnail_size = 'normal' ) { // normal | extra-small | small | large
	$book = false;

	$args = array(
		'post_type'		=> 'book',
		'post_per_page'	=> 1,
		'orderby'		=> 'rand'
	);
	$query = new WP_Query( $args );
	while( $query->have_posts() ) {
		$query->the_post();

		$id = get_the_ID();
		$book = array(
			'ID'				=> $id,
			'permalink'			=> get_the_permalink(),
			'post_title'		=> get_the_title(),
			'thumbnail'			=> get_the_post_thumbnail( $id, $thumbnail_size . '-book-cover', array( 'class' => 'book-cover-img2' ) ),
			'content'			=> get_the_content(),
			'title'				=> get_post_meta( $id, 'book_title', true ),
			'editor'			=> get_post_meta( $id, 'book_editor', true ),
			'author'			=> get_post_meta( $id, 'book_author', true ),
			'date'				=> get_post_meta( $id, 'book_date', true ),
			'pagecount'			=> intval( get_post_meta( $id, 'book_pagecount', true ) ),
			'isbn10'			=> get_post_meta( $id, 'book_isbn10', true ),
			'isbn13'			=> get_post_meta( $id, 'book_isbn13', true ),
			'asin'				=> get_post_meta( $id, 'book_asin', true ),
			'lalibrairie_link'	=> get_post_meta( $id, 'book_lalibrairie_link', true ),
			'rakuten_link'		=> get_post_meta( $id, 'book_rakuten_link', true ),
			'excerpt'			=> get_post_meta( $id, 'book_excerpt', true ),
			'editor_text'		=> get_post_meta( $id, 'book_editor_text', true ),
			'author_bio'		=> get_post_meta( $id, 'book_author_bio', true )
		);
	}
	wp_reset_query();

	return $book;
}

/*******************************************************************************
 * GET RANDOM BOOK AUTHOR
 ******************************************************************************/
function get_random_book_author() {
	$author = false;

	$args = array(
		'post_type'		=> 'book',
		'post_per_page'	=> 1,
		'orderby'		=> 'rand'
	);
	$query = new WP_Query( $args );
	while( $query->have_posts() ) {
		$query->the_post();

		$id = get_the_ID();
		$author = array(
			'author'			=> get_post_meta( $id, 'book_author', true ),
			'author_bio'		=> get_post_meta( $id, 'book_author_bio', true )
		);
	}
	wp_reset_query();

	return $author;
}

/*******************************************************************************
 * GET ALL CATEGORIES USED BY A SPECIFIC POST TYPE
 ******************************************************************************/
function get_cpt_categories_sorter( Array &$cats, Array &$into, $parentId = 0 ) {
	foreach( $cats as $i => $cat ) {
		if ( $cat->parent == $parentId ) {
			$into[$cat->ID] = $cat;
			unset( $cats[$i] );
		}
	}
	foreach( $into as $topCat ) {
		$topCat->children = array();
		get_cpt_categories_sorter( $cats, $topCat->children, $topCat->ID );
	}
}
function get_cpt_categories( $post_type, $hide_empty = true, $sort_hierarchical = true ) {
	$categories = array();

	$args = array(
		'post_type'		=> $post_type,
		'post_per_page'	=> -1
	);
	$query = new WP_Query( $args );
	while( $query->have_posts() ) {
		$query->the_post();

		$cats = get_the_category();
		foreach( $cats as $cat ) {
			if( $cat->taxonomy == 'category' ) {
				if( !array_key_exists( $cat->cat_ID, $categories )
					&& ( !$hide_empty || ( $hide_empty && $cat->category_count > 0 ) ) ){
					$category = (object) array(
						'ID'			=> $cat->cat_ID,
						'count'			=> $cat->category_count,
						'description'	=> $cat->category_description,
						'name'			=> $cat->cat_name,
						'nicename'		=> $cat->category_nicename,
						'parent'		=> $cat->category_parent,
						'children'		=> array()
					);

					$categories[$cat->cat_ID] = $category;
				}
			}
		}
	}
	wp_reset_query();

	if( $sort_hierarchical ) {
		$categories_sorted = array();
		get_cpt_categories_sorter( $categories, $categories_sorted );

		return $categories_sorted;
	}

	return $categories;
}

/*******************************************************************************
 * CPT CATEGORIES TO UL HTML TAG
 ******************************************************************************/
function cpt_categories_tree_view( $categories, $level = 0, $ul_class = 'cpt-cat-children', $li_class = 'cpt-cat' ) {
	if( !is_array( $categories ) || count( $categories ) < 1 )
		return;

	global $wp_query;
	$q_by = 'date-desc';
	if( isset( $wp_query->query_vars['by'] ) )
		$q_by = strtolower( trim( strip_tags( $wp_query->query_vars['by'] ) ) );
	$q_category = '';
	if( isset( $wp_query->query_vars['category'] ) )
		$q_category = trim( strip_tags( $wp_query->query_vars['category'] ) );
	$fcid_cat = get_term_by( 'slug', $q_category, 'category' );
	$fcid = 0;
	if( $fcid_cat ) {
		_make_cat_compat( $fcid_cat );
		$fcid = $fcid_cat->cat_ID;
	}

	if( $level == 0)
		echo '<ul class="cpt-cat-root level-0">';

	foreach( $categories as $id => $cat ) {

		echo sprintf( '<li class="%s"><span class="cat-content"><a %s href="%s" title="%s"><span>%s</span></a></span>',
			join( ' ', array( esc_attr( $li_class ), 'cat-id-' . $cat->ID, 'level-' . $level ) ),
			( $fcid == $cat->ID ? 'class="current-cat"' : '' ),
			get_permalink( get_page_by_path( 'books' ) ) . $q_by . '/' . $cat->nicename . '/',
			esc_attr( $cat->name ),
			esc_html( $cat->name ) . ' <span class="cat-counter">(' . $cat->count . ')</span>'
		);

		if( is_array( $cat->children ) && count( $cat->children ) > 0) {
			echo sprintf( '<ul class="%s">',
				join( ' ', array( esc_attr( $ul_class ), 'parent-cat-id-' . $cat->ID, 'level-' . $level ) )
			);

			cpt_categories_tree_view( $cat->children, $level + 1, $ul_class, $li_class );

			echo '</ul>';
		}

		echo '</li>';
	}

	if( $level == 0 )
		echo '</ul>';
}

/*******************************************************************************
 * GET TOC OF POST
 ******************************************************************************/
function get_toc( $post_id ) {

	$post = get_post( $post_id );
	if( !$post )
		return '';

	$permalink_structure = get_option( 'permalink_structure' );
	$permalink = get_permalink( $post_id );

	$pages = explode( '<!--nextpage-->', $post->post_content );

	$out = '<ul itemscope itemtype="http://www.schema.org/SiteNavigationElement" class="toc">';
	for( $current_page = 1; $current_page <= count( $pages ); $current_page++ ) {
		$current_page_text = '';
		switch( $current_page ) {
			case 1: $current_page_text = __( 'Première %spage', 'BTB' ); break;
			case 2: $current_page_text = __( 'Deuxième %spage', 'BTB' ); break;
			case 3: $current_page_text = __( 'Troisième %spage', 'BTB' ); break;
			case 4: $current_page_text = __( 'Quatrième %spage', 'BTB' ); break;
			case 5: $current_page_text = __( 'Cinquième %spage', 'BTB' ); break;
			case 6: $current_page_text = __( 'Sixième %spage', 'BTB' ); break;
			case 7: $current_page_text = __( 'Septième %spage', 'BTB' ); break;
			case 8: $current_page_text = __( 'Huitième %spage', 'BTB' ); break;
			case 9: $current_page_text = __( 'Neuvième %spage', 'BTB' ); break;
			case 10: $current_page_text = __( 'Dixième %spage', 'BTB' ); break;
			default: $current_page_text = sprintf( __( 'Page %s', 'BTB' ), $current_page ); break;
		}
		$current_page_text = sprintf( $current_page_text, ( $current_page == count( $pages ) ? __( 'et dernière ', 'BTB' ) : '' ) );

		$out .= '<li class="group"><span>' . $current_page_text . '</span>';
		$out .= '<ul itemscope itemtype="http://www.schema.org/SiteNavigationElement">';

		$content = $pages[$current_page - 1];
		$content = preg_replace_callback( '#<(h[1-7])(.*?)>(.*?)</\1>#si', function( $matches ) use ( &$out, &$index, $current_page, $post_id, $permalink_structure, $permalink ) {
			$tag = $matches[1];
			$title = strip_tags( $matches[3] );
			$hasId = preg_match( '/id=(["\'])(.*?)\1[\s>]/si', $matches[2], $matchedIds );
			$id = $hasId ? $matchedIds[2] : sanitize_title( $title );

			$level = intval( str_replace( 'h', '', strtolower( $tag ) ) ) - 2;
			if( $level < 0 ) $level = 0;

			$url = $_SERVER['REQUEST_URI'];
			$fragment = parse_url( $url, PHP_URL_FRAGMENT );

			$p = $permalink;
			if( empty( $permalink_structure ) ) {
				$p .= '&paged=' . $current_page;
			} else {
				if( substr( $p, strlen( $p ) - 1, 1 ) != '/' )
					$p .= '/';
				if( $current_page > 1 )
					$p .= $current_page . '/';
			}
			$p .= '#' . $id;

			$out .= '<li itemprop="name" class="item-' . $tag . '"><a itemprop="url" href="' . $p . '" title="' . esc_attr( $title ) . '">' . esc_html( $title ) . '</a></li>';
			if( $hasId ) {
				return $matches[0];
			}
			return sprintf( '<%s%s id="%s">%s</%s>', $tag, $matches[2], $id, $matches[3], $tag );
		}, $content);

		$out .= '</ul>';
		$out .= '</li>';
	}
	$out .= '</ul>';

	return $out;
}


/*******************************************************************************
 * ADD LAZY LOADING
 ******************************************************************************/
function add_lazyload( $content ) {
    $content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );
    $dom = new DOMDocument();
    @$dom->loadHTML( $content );

	// Images
	if( get_theme_mod( 'images_lazy_loading', true ) ) {
		$images = [];
		foreach ( $dom->getElementsByTagName( 'img' ) as $node ) { $images[] = $node; }
		foreach ( $images as $node ) {
			$fallback = $node->cloneNode( true );

			$oldsrc = $node->getAttribute( 'src' );
			$node->setAttribute( 'data-src', $oldsrc );
			$newsrc = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
			$node->setAttribute( 'src', $newsrc );

			$oldsrcset = $node->getAttribute( 'srcset' );
			$node->setAttribute( 'data-srcset', $oldsrcset );
			$newsrcset = '';
			$node->setAttribute( 'srcset', $newsrcset );

			$classes = $node->getAttribute( 'class' );
			$newclasses = $classes . ' lazy lazy-hidden';
			$node->setAttribute('class', $newclasses);

			$noscript = $dom->createElement( 'noscript', '' );
			$node->parentNode->insertBefore( $noscript, $node );
			$noscript->appendChild( $fallback );
		}
	}

    // Vidéos
	if( get_theme_mod( 'videos_lazy_loading', true ) ) {
		$videos = [];
		foreach ($dom->getElementsByTagName('iframe') as $node) { $videos[] = $node; }
		foreach ($videos as $node) {
			$fallback = $node->cloneNode(true);

			$oldsrc = $node->getAttribute('src');
			$node->setAttribute('data-src', $oldsrc );
			$newsrc = '';
			$node->setAttribute('src', $newsrc);

			$classes = $node->getAttribute('class');
			$newclasses = $classes . ' lazy lazy-hidden';
			$node->setAttribute('class', $newclasses);

			$noscript = $dom->createElement('noscript', '');
			$node->parentNode->insertBefore($noscript, $node);
			$noscript->appendChild($fallback);
		}
	}

    $newHtml = trim( preg_replace('/^<!DOCTYPE.+?>/', "", str_replace( array('<html>', '</html>', '<body>', '</body>'), array("", "", "", ""), $dom->saveHTML())) );
    return $newHtml;
}
add_filter( 'the_content', 'add_lazyload' );
add_filter( 'post_thumbnail_html', 'add_lazyload' );

?>