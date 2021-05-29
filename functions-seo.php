<?php

/*******************************************************************************
 * Get site name
 ******************************************************************************/
function seo_get_sitename() {
	$name = trim( strip_tags( get_bloginfo( 'name' ) ) );

	return $name;
}

/*******************************************************************************
 * Get site langage
 ******************************************************************************/
function seo_get_sitelang() {
	$lang = trim( strip_tags( get_bloginfo( 'language' ) ) );

	return $lang;
}

/*******************************************************************************
 * Get object date (post, page, current object in memory)
 ******************************************************************************/
function seo_get_date() {
	$date = get_the_date( 'c' );

	return $date;
}

/*******************************************************************************
 * Get object modified date (post, page, current object in memory)
 ******************************************************************************/
function seo_get_datemodified() {
	$date = get_the_modified_date( 'c' );

	return $date;
}

/*******************************************************************************
 * Get the xml rpc url
 ******************************************************************************/
function seo_get_rpclink() {
	$link = trailingslashit( home_url() ) . 'xmlrpc.php';

	return $link;
}

/*******************************************************************************
 * Get page title
 ******************************************************************************/
function seo_get_title() {
	$title = ( ( is_front_page() )
		? get_theme_mod( 'seo_site_title', '' )
		: ( ( is_single() )
			? get_the_title()
			: wp_title( '', false ) ) );
	$title = trim( strip_tags( $title ) );

	if( !$title || empty( $title ) )
		$title = seo_get_sitename();

	if( strlen( $title) > 60 )
		$title = substr( $title, 0, 55 ) . '...';

	return $title;
}

/*******************************************************************************
 * Get page description
 ******************************************************************************/
function seo_get_description() {
	$mod_desc = trim( strip_tags( get_theme_mod( 'seo_site_description', '' ) ) );

	$description = ( (is_front_page() || is_home() )
				   ? $mod_desc
				   : ( ( is_author() )
						? get_user_meta( get_queried_object()->ID, 'description', true )
						: ( ( is_tag() )
							? tag_description()
							: ( ( is_category() )
								? category_description()
								: ( ( is_single() || is_page() )
									? get_the_excerpt()
									: ( ( is_search() )
										? get_search_query()
										: '' ) ) ) ) ) );

	if( is_string( $description ) )
		$description = trim( strip_tags( $description ) );

	if( !$description || empty( $description ) )
		$description = !empty( $mod_desc ) ? $mod_desc : trim( strip_tags( get_bloginfo( 'description' ) ) );

	if( strlen( $description) > 160 )
		$description = substr( $description, 0, 155 ) . '...';

	return $description;
}

/*******************************************************************************
 * Get site custom logo
 ******************************************************************************/
function seo_get_logo() {
	$logo = ( ( has_custom_logo() )
				? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]
				: '' );

	return $logo;
}

/*******************************************************************************
 * Get page thumbnail
 ******************************************************************************/
function seo_get_image() {
	$image = ( ( ( is_front_page() || is_home() ) && has_custom_logo() )
			 ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]
			 : ( ( is_author() )
				? get_avatar_url( get_queried_object()->ID, array( 'size' => 256 ) )
				: ( ( has_post_thumbnail() )
					? get_the_post_thumbnail_url( get_the_ID(), 'full' )
					: '' ) ) );

	if( trim( $image ) == '' && is_page() ) {
		global $template;
		$image_file = '/assets/img/' . str_replace( '.php', '', basename( $template ) ). '.jpg';
		if( file_exists( get_template_directory() . $image_file ) )
			$image = get_template_directory_uri() . $image_file;
	}

	return $image;
}

/*******************************************************************************
 * Get page true url
 ******************************************************************************/
function seo_get_url() {
	global $wp;

	$url = ( ( is_front_page() )
		   ? trailingslashit( home_url() )
		   : ( ( is_single() )
				? get_the_permalink()
				: trailingslashit( home_url( $wp->request ) ) ) );

	return $url;
}

/*******************************************************************************
 * Get all SEO Html headers
 ******************************************************************************/
function seo_get_heads( $echo = true ) {
	$heads = '';

	$s = array();
	$s['name'] = seo_get_sitename();
	$s['lang'] = seo_get_sitelang();
	$s['title'] = seo_get_title();
	$s['description'] = seo_get_description();
	$s['image'] = seo_get_image();
	$s['url'] = seo_get_url();
	$s['date'] = seo_get_date();
	$s['modified'] = seo_get_datemodified();
	$s['rpc'] = seo_get_rpclink();
	$s['googleverif'] = trim( strip_tags( get_theme_mod( 'googleverif', '' ) ) );
	$s['googleanalytics'] = trim( strip_tags( get_theme_mod( 'googleanalytics', '' ) ) );
	$s['yandexverif'] = trim( strip_tags( get_theme_mod( 'yandexverif', '' ) ) );
	$s['bingverif'] = trim( strip_tags( get_theme_mod( 'bingverif', '' ) ) );
	$s['facebookurl'] = trim( strip_tags( get_theme_mod( 'facebook_url', '' ) ) );
	$s['twitterusername'] = trim( strip_tags( get_theme_mod( 'twitter_username', '' ) ) );
	$s['email'] = trim( strip_tags( get_bloginfo( 'admin_email' ) ) );

	$heads .= '<meta name="title" content="' . esc_attr( $s['title'] ) . '" />';
	$heads .= '<meta name="description" content="' . esc_attr( $s['description'] ) . '" />';
	$heads .= '<meta name="author" content="' . esc_attr( $s['name'] ) . '" />';
	$heads .= '<link rel="pingback" href="' . esc_url( $s['rpc'] ) . '" />';
	$heads .= '<meta name="last-modified" content="' . esc_attr( $s['modified'] ) . '" />';
	$heads .= '<meta name="contact" content="' . esc_attr( $s['name'] ) . ' <' . esc_attr( $s['email'] ) . '>" />';
	$heads .= '<meta name="designer" content="Born To Be Média (https://btbmedia.org)" />';

	$heads .= '<meta name="DC.Creator" content="' . esc_attr( $s['name'] ) . '" />';
	$heads .= '<meta name="DC.Description" content="' . esc_attr( $s['description'] ) . '" />';
	$heads .= '<meta name="DC.Title" content="' . esc_attr( $s['title'] ) . '" />';
	$heads .= '<meta name="DC.Date" content="' . esc_attr( $s['date'] ) . '" />';
	$heads .= '<meta name="DC.Format" content="text/html" />';
	$heads .= '<meta name="DC.Language" content="' . esc_attr( $s['lang'] ) . '" />';
	$heads .= '<meta name="DC.Source" content="' . esc_url( $s['url'] ) . '" />';

	if( get_theme_mod( 'facebook_tags', true ) ) {
		$heads .= '<meta property="og:title" content="' . esc_attr( $s['title'] ) . '" />';
		$heads .= '<meta property="og:description" content="' . esc_attr( $s['description'] ) . '" />';
		$heads .= '<meta property="og:image" content="' . esc_url( $s['image'] ) . '" />';
		$heads .= '<meta property="og:url" content="' . esc_url( $s['url'] ) . '" />';
		$heads .= '<meta property="og:locale" content="' . esc_attr( $s['lang'] ) . '" />';
		$heads .= '<meta property="og:site_name" content="' . esc_attr( $s['name'] ) . '" />';
		$heads .= '<meta property="og:type" content="website" />';
		if( !empty( $s['facebookurl'] ) )
			$heads .= '<meta name="article:publisher" content="' . esc_url( $s['facebookurl'] ) . '" />';
	}

	if( get_theme_mod( 'twitter_tags', true ) ) {
		$heads .= '<meta name="twitter:card" content="summary_large_image" />';
		$heads .= '<meta name="twitter:title" content="' . esc_attr( $s['title'] ) . '" />';
		$heads .= '<meta name="twitter:description" content="' . esc_attr( $s['description'] ) . '" />';
		$heads .= '<meta name="twitter:image" content="' . esc_url( $s['image'] ) . '" />';
		$heads .= '<meta name="twitter:image:src" content="' . esc_url( $s['image'] ) . '" />';
		$heads .= '<meta name="twitter:site" content="@' . esc_attr( $s['twitterusername'] ) . '" />';
		$heads .= '<meta name="twitter:creator" content="@' . esc_attr( $s['twitterusername'] ) . '" />';
		$heads .= '<meta name="twitter:url" content="' . esc_url( $s['url'] ) . '" />';
	}

	if( !empty( $s['googleverif'] ) )
		$heads .= '<meta name="google-site-verification" content="' . esc_attr( $s['googleverif'] ) . '" />';
	if( !empty( $s['yandexverif'] ) )
		$heads .= '<meta name="yandex-verification" content="' . esc_attr( $s['yandexverif'] ) . '" />';
	if( !empty( $s['bingverif'] ) )
		$heads .= '<meta name="msvalidate.01" content="' . esc_attr( $s['bingverif'] ) . '" />';

	if( !empty( $s['googleanalytics'] ) ) {
		$heads .= '<!-- Global site tag (gtag.js) - Google Analytics -->';
		$heads .= '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $s['googleanalytics'] . '"></script>';
		$heads .= '<script>';
		$heads .= 'window.dataLayer = window.dataLayer || [];';
		$heads .= 'function gtag(){dataLayer.push(arguments);}';
		$heads .= 'gtag("js", new Date());';
		$heads .= 'gtag("config", "' . $s['googleanalytics'] . '");';
		$heads .= '</script>';
	}

	unset( $s );

	if( $echo )
		echo $heads;
	else
		return $heads;
}

/*******************************************************************************
 * Get LD+JSON Google Search Organisation card
 ******************************************************************************/
function seo_get_organizationcard_metadatas( $echo = true ) {
	if( !get_theme_mod( 'google_card_tags', true ) )
		return '';

	$card = '<script type="application/ld+json">';
	$card .= '{ "@context" : "http://schema.org", ';
	$card .= '"@type" : "Organization", ';
	$card .= '"name" : "' . esc_attr( get_bloginfo( 'name' ) ) . '", ';
	$card .= '"legalName" : "' . esc_attr( get_bloginfo( 'name' ) ) . '", ';
	$card .= '"url" : "' . esc_url( trailingslashit( home_url() ) ) . '", ';
	$card .= '"contactPoint" : [{ ';
	$card .= '"@type" : "ContactPoint", ';
	$card .= '"email" : "' . esc_attr( get_bloginfo( 'admin_email' ) ) . '", ';
	$card .= '"telephone" : "", ';
	$card .= '"contactType" : "contact" }], ';
	$card .= '"logo" : "' . esc_url( seo_get_logo() ) . '", ';

	$card .= '"sameAs" : [ ';
	$sameAs = array();
	if( !empty( trim( get_theme_mod( 'facebook_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'facebook_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'twitter_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'twitter_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'instagram_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'instagram_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'youtube_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'youtube_url', '' ) ) ) ) . '"';
	$card .= implode( ', ', $sameAs ) . ' ';
	$card .= '] ';
	$card .= '}';
	$card .= '</script>';

	if( $echo )
		echo $card;
	else
		return $card;
}

/*******************************************************************************
 * Get LD+JSON Google Search Website card
 ******************************************************************************/
function seo_get_sitesearch_metadatas( $echo = true ) {
	if( !get_theme_mod( 'google_search_tags', true ) )
		return '';

	$search = '<script type="application/ld+json">';
	$search .= '{ ';
	$search .= '"@context" : "http://schema.org", ';
	$search .= '"@type" : "WebSite", ';
	$search .= '"name" : "' . esc_attr( get_bloginfo( 'name' ) ) . '", ';
	$search .= '"url" : "' . esc_url( trailingslashit( home_url() ) ) . '", ';
	$search .= '"sameAs" : [ ';
	$sameAs = array();
	if( !empty( trim( get_theme_mod( 'facebook_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'facebook_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'twitter_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'twitter_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'instagram_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'instagram_url', '' ) ) ) ) . '"';
	if( !empty( trim( get_theme_mod( 'youtube_url', '' ) ) ) )
		$sameAs[] = '"' . esc_url( trim( strip_tags( get_theme_mod( 'youtube_url', '' ) ) ) ) . '"';
	$search .= implode( ', ', $sameAs ) . ' ';
	$search .= '], ';
	$search .= '"potentialAction" : { ';
	$search .= '"@type" : "SearchAction", ';
	$search .= '"target" : "' . esc_url( trailingslashit( home_url() ) ) . '?s={search_term}", ';
	$search .= '"query-input" : "required name=search_term" ';
	$search .= '} }';
	$search .= '</script>';

	if( $echo )
		echo $search;
	else
		return $search;
}

/*******************************************************************************
 * Get LD+JSON Google Search Article card
 ******************************************************************************/
function seo_get_article_metadatas( $echo = true ) {
	if( !get_theme_mod( 'article_metadatas', true )
		|| !is_single() )
		return '';

	$article = '<script type="application/ld+json">';
    $article .= '{ ';
    $article .= '"@context" : "http://schema.org", ';
    $article .= '"@type" : "Article", ';
	$article .= '"url" : "' . esc_url( seo_get_url() ) . '", ';
    $article .= '"publisher" : { ';
    $article .= '"@type" : "Organization", ';
    $article .= '"name" : "' . esc_attr( seo_get_sitename() ) . '", ';
    $article .= '"logo" : { ';
    $article .= '"@type" : "ImageObject", ';
    $article .= '"url" : "' . esc_url( seo_get_logo() ) . '" } }, ';
	$article .= '"datePublished" : "' . esc_attr( seo_get_date() ) . '", ';
	$article .= '"dateModified" : "' . esc_attr( seo_get_datemodified() ) . '", ';
	$article .= '"headline" : "' . esc_attr( seo_get_title() ) . '", ';
	$article .= '"image" : { "@list" : [{ ';
	$article .= '"@type" : "ImageObject", ';
	$article .= '"url" : "' . seo_get_image() . '" ';
	$article .= '}] }, ';
	$article .= '"author" : "' . esc_attr( trim( strip_tags( get_the_author() ) ) ) . '", ';
	$article .= '"mainEntityOfPage" : "' . esc_url( seo_get_url() ) . '" ';
	$article .= '}';
    $article .= '</script>';

    if( $echo )
		echo $article;
	else
		return $article;
}



?>
