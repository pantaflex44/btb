<?php

/*******************************************************************************
 * Source form template
 ******************************************************************************/
function sources_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );

	$source1_title = get_post_meta( $post->ID, 'source1_title', true );
	$source2_title = get_post_meta( $post->ID, 'source2_title', true );
	$source3_title = get_post_meta( $post->ID, 'source3_title', true );
	$source4_title = get_post_meta( $post->ID, 'source4_title', true );
	$source5_title = get_post_meta( $post->ID, 'source5_title', true );
	$source6_title = get_post_meta( $post->ID, 'source6_title', true );
	$source7_title = get_post_meta( $post->ID, 'source7_title', true );
	$source8_title = get_post_meta( $post->ID, 'source8_title', true );
	$source9_title = get_post_meta( $post->ID, 'source9_title', true );
	$source10_title = get_post_meta( $post->ID, 'source10_title', true );
	$source11_title = get_post_meta( $post->ID, 'source11_title', true );
	$source12_title = get_post_meta( $post->ID, 'source12_title', true );
	$source13_title = get_post_meta( $post->ID, 'source13_title', true );
	$source14_title = get_post_meta( $post->ID, 'source14_title', true );
	$source15_title = get_post_meta( $post->ID, 'source15_title', true );
	$source16_title = get_post_meta( $post->ID, 'source16_title', true );

	$source1_url = get_post_meta( $post->ID, 'source1_url', true );
	$source2_url = get_post_meta( $post->ID, 'source2_url', true );
	$source3_url = get_post_meta( $post->ID, 'source3_url', true );
	$source4_url = get_post_meta( $post->ID, 'source4_url', true );
	$source5_url = get_post_meta( $post->ID, 'source5_url', true );
	$source6_url = get_post_meta( $post->ID, 'source6_url', true );
	$source7_url = get_post_meta( $post->ID, 'source7_url', true );
	$source8_url = get_post_meta( $post->ID, 'source8_url', true );
	$source9_url = get_post_meta( $post->ID, 'source9_url', true );
	$source10_url = get_post_meta( $post->ID, 'source10_url', true );
	$source11_url = get_post_meta( $post->ID, 'source11_url', true );
	$source12_url = get_post_meta( $post->ID, 'source12_url', true );
	$source13_url = get_post_meta( $post->ID, 'source13_url', true );
	$source14_url = get_post_meta( $post->ID, 'source14_url', true );
	$source15_url = get_post_meta( $post->ID, 'source15_url', true );
	$source16_url = get_post_meta( $post->ID, 'source16_url', true );

	echo '<div style="display:flex;flex-direction:column;">';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source1_title">' . __( 'Source 1', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source1_title" id="source1_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source1_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source1_url" id="source1_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source1_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source2_title">' . __( 'Source 2', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source2_title" id="source2_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source2_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source2_url" id="source2_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source2_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source3_title">' . __( 'Source 3', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source3_title" id="source3_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source3_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source3_url" id="source3_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source3_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source4_title">' . __( 'Source 4', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source4_title" id="source4_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source4_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source4_url" id="source4_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source4_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source5_title">' . __( 'Source 5', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source5_title" id="source5_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source5_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source5_url" id="source5_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source5_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source6_title">' . __( 'Source 6', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source6_title" id="source6_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source6_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source6_url" id="source6_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source6_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source7_title">' . __( 'Source 7', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source7_title" id="source7_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source7_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source7_url" id="source7_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source7_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source8_title">' . __( 'Source 8', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source8_title" id="source8_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source8_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source8_url" id="source8_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source8_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source9_title">' . __( 'Source 9', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source9_title" id="source9_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source9_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source9_url" id="source9_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source9_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source10_title">' . __( 'Source 10', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source10_title" id="source10_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source10_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source10_url" id="source10_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source10_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source11_title">' . __( 'Source 11', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source11_title" id="source11_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source11_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source11_url" id="source11_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source11_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source12_title">' . __( 'Source 12', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source12_title" id="source12_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source12_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source12_url" id="source12_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source12_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source13_title">' . __( 'Source 13', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source13_title" id="source13_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source13_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source13_url" id="source13_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source13_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source14_title">' . __( 'Source 14', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source14_title" id="source14_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source14_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source14_url" id="source14_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source14_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

		echo '<div style="display:flex;flex-direction:row;margin-bottom:1.0em;">';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source15_title">' . __( 'Source 15', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source15_title" id="source15_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source15_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source15_url" id="source15_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source15_url )  . '" class="widefat"><br />';
			echo '</div>';
			echo '<div style="width:50%;padding:0em 0.5em;">';
				echo '<label for="source16_title">' . __( 'Source 16', '' ) . '</label><br />';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source16_title" id="source16_title" placeholder="' . __( 'titre', 'BTB' ) . '" value="' . esc_textarea( $source16_title )  . '" class="widefat">';
				echo '<input autocomplete="off" class="width:50%;margin-right:1.0em;" type="text" name="source16_url" id="source16_url" placeholder="' . __( 'url', 'BTB' ) . '" value="' . esc_textarea( $source16_url )  . '" class="widefat"><br />';
			echo '</div>';
		echo '</div>';

	echo '<div />';
}

/*******************************************************************************
 * Books form template
 ******************************************************************************/
function books_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );

	$book_title = get_post_meta( $post->ID, 'book_title', true );
	$book_editor = get_post_meta( $post->ID, 'book_editor', true );
	$book_author = get_post_meta( $post->ID, 'book_author', true );
	$book_date = get_post_meta( $post->ID, 'book_date', true );
	$book_pagecount = get_post_meta( $post->ID, 'book_pagecount', true );
	$book_isbn10 = get_post_meta( $post->ID, 'book_isbn10', true );
	$book_isbn13 = get_post_meta( $post->ID, 'book_isbn13', true );
	$book_asin = get_post_meta( $post->ID, 'book_asin', true );
	$book_lalibrairie_link = get_post_meta( $post->ID, 'book_lalibrairie_link', true );
	$book_rakuten_link = get_post_meta( $post->ID, 'book_rakuten_link', true );

	echo '<label for="book_title">' . __( 'Titre', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_title" id="book_title" type="text" value="' . esc_textarea( $book_title )  . '" class="widefat" /><br />';

	echo '<label for="book_author">' . __( 'Auteur', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_author" id="book_author" type="text" value="' . esc_textarea( $book_author )  . '" class="widefat" /><br />';

	echo '<label for="book_editor">' . __( 'Editeur', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_editor" id="book_editor" type="text" value="' . esc_textarea( $book_editor )  . '" class="widefat" /><br />';

	echo '<label for="book_date">' . __( 'Date de sortie', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_date" id="book_date" type="date" value="' . esc_textarea( $book_date )  . '" class="widefat" /><br />';

	echo '<label for="book_pagecount">' . __( 'Nombre de pages', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_pagecount" id="book_pagecount" type="number" min="0" value="' . esc_textarea( $book_pagecount )  . '" class="widefat" /><br />';

	echo '<label for="book_isbn10">' . __( 'ISBN-10', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_isbn10" id="book_isbn10" type="text" maxlength="10" size="10" value="' . esc_textarea( $book_isbn10 )  . '" class="widefat" /><br />';

	echo '<label for="book_isbn13">' . __( 'ISBN-13', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_isbn13" id="book_isbn13" type="text" maxlength="13" size="13" value="' . esc_textarea( $book_isbn13 )  . '" class="widefat" /><br />';

	echo '<label for="book_asin">' . __( 'ASIN', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_asin" id="book_asin" type="text" value="' . esc_textarea( $book_asin )  . '" class="widefat" /><br />';

	echo '<label for="book_lalibrairie_link">' . __( 'Lien LaLibrairie.com', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_lalibrairie_link" id="book_lalibrairie_link" type="url" value="' . esc_textarea( $book_lalibrairie_link )  . '" class="widefat" /><br />';

	echo '<label for="book_rakuten_link">' . __( 'Lien Rakuten', 'BTB' ) . '</label>';
	echo '<input autocomplete="off" name="book_rakuten_link" id="book_rakuten_link" type="url" value="' . esc_textarea( $book_rakuten_link )  . '" class="widefat" /><br />';
}

/*******************************************************************************
 * Books form template
 ******************************************************************************/
function books_text_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );

	$book_excerpt = get_post_meta( $post->ID, 'book_excerpt', true );
	$book_editor_text = get_post_meta( $post->ID, 'book_editor_text', true );
	$book_author_bio = get_post_meta( $post->ID, 'book_author_bio', true );

	echo '<div>';
	echo '<label for="book_excerpt">' . __( 'Résumé', 'BTB' ) . '</label><br />';
	echo '<textarea autocomplete="off" style="width:100%;height:12em;" row="10" name="book_excerpt" id="book_excerpt">' . esc_textarea( $book_excerpt )  . '</textarea><br /><br />';
	echo '<label for="book_editor_text">' . __( 'Le mot de l\'éditeur', 'BTB' ) . '</label><br />';
	echo '<textarea autocomplete="off" style="width:100%;height:12em;" row="10" name="book_editor_text" id="book_editor_text">' . esc_textarea( $book_editor_text )  . '</textarea><br /><br />';
	echo '<label for="book_author_bio">' . __( 'Biographie de l\'auteur', 'BTB' ) . '</label><br />';
	echo '<textarea autocomplete="off" style="width:100%;height:12em;" row="10" name="book_author_bio" id="book_author_bio">' . esc_textarea( $book_author_bio )  . '</textarea><br />';
	echo '</div>';
}

/*******************************************************************************
 * 301 redirect form template
 ******************************************************************************/
function all_rewrite_301_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );

	$rewrite301_text = get_post_meta( $post->ID, 'rewrite301_text', true );

	echo '<div>';
	echo '<label for="rewrite301_text">' . home_url() . '/ ....</label><br />';
	echo '<input autocomplete="off" style="width:100%;" type="text" name="rewrite301_text" id="rewrite301_text" value="' . esc_attr( $rewrite301_text )  . '" /><br /><br />';
	echo '<label for="rewrite301_new_text">' . __( 'Nouvelle adresse:', 'BTB' ) .'</label><br />';
	echo '<input autocomplete="off" readonly="readonly" style="width:100%;" type="text" name="rewrite301_new_text" id="rewrite301_new_text" value="' . esc_attr( get_permalink( $post->ID ) )  . '" /><br /><br />';
	echo '</div>';
}

/*******************************************************************************
 * Other settings form template
 ******************************************************************************/
function other_settings_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );

	$view_toc_checkbox = get_post_meta( $post->ID, 'view_toc_checkbox', true );

	echo '<div>';
	echo '<label style="vertical-align: middle;" for="view_toc_checkbox">' . __( 'Afficher le sommaire automatique', 'BTB' ) . '</label><br />';
	echo '<select autocomplete="off" name="view_toc_checkbox" id="view_toc_checkbox">';
	echo '<option value="no" ' . ( $view_toc_checkbox != 'yes' ? 'selected="selected"' : '' ) . '>' . __( 'Ne pas afficher', 'BTB' ) . '</option>';
	echo '<option value="yes" ' . ( $view_toc_checkbox == 'yes' ? 'selected="selected"' : '' ) . '>' . __( 'Afficher', 'BTB' ) . '</option>';
	echo '</select>';
	echo '<br /><br />';
	echo '</div>';
}

/*******************************************************************************
 * Add custom metboxes to posts admin panels
 ******************************************************************************/
function add_custom_metaboxes() {
	add_meta_box(
		'sources_callback',
		'Liste des sources utilisées pour la publication',
		'sources_callback',
		array( 'post', 'news', 'actu' ),
		'normal',
		'high'
	);

	add_meta_box(
		'books_callback',
		'Meta données du livre présenté',
		'books_callback',
		'book',
		'side',
		'high'
	);

	add_meta_box(
		'books_text_callback',
		'Présentation du livre',
		'books_text_callback',
		'book',
		'normal',
		'high'
	);

	add_meta_box(
		'other_settings_callback',
		'Options supplémentaires',
		'other_settings_callback',
		array( 'post', 'news', 'actu' ),
		'side',
		'high'
	);

	add_meta_box(
		'all_rewrite_301_callback',
		'Ancienne adresse de cette publication (redirection 301)',
		'all_rewrite_301_callback',
		array( 'post', 'news', 'actu', 'book' ),
		'side',
		'high'
	);

}
add_action( 'add_meta_boxes', 'add_custom_metaboxes' );

/*******************************************************************************
 * Verify and get the metabox value in modified
 ******************************************************************************/
function check_and_store_custom_meta( $name, &$events_meta ) {
	$value = isset( $_POST[$name] ) ? esc_textarea( $_POST[$name] ) : '';
	if( get_post_meta( $post->ID, $name, true ) != $value ) {
		$events_meta[$name] = $value;
		return true;
	}
	return false;
}

/*******************************************************************************
 * Save all modified metaboxes
 ******************************************************************************/
function save_custom_metaboxes( $post_id, $post ) {
	if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	if ( !isset( $_POST['event_fields'] ) || !wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) )
		return $post_id;

	$events_meta = array();

	check_and_store_custom_meta( 'source1_title', $events_meta );
	check_and_store_custom_meta( 'source2_title', $events_meta );
	check_and_store_custom_meta( 'source3_title', $events_meta );
	check_and_store_custom_meta( 'source4_title', $events_meta );
	check_and_store_custom_meta( 'source5_title', $events_meta );
	check_and_store_custom_meta( 'source6_title', $events_meta );
	check_and_store_custom_meta( 'source7_title', $events_meta );
	check_and_store_custom_meta( 'source8_title', $events_meta );
	check_and_store_custom_meta( 'source9_title', $events_meta );
	check_and_store_custom_meta( 'source10_title', $events_meta );
	check_and_store_custom_meta( 'source11_title', $events_meta );
	check_and_store_custom_meta( 'source12_title', $events_meta );
	check_and_store_custom_meta( 'source13_title', $events_meta );
	check_and_store_custom_meta( 'source14_title', $events_meta );
	check_and_store_custom_meta( 'source15_title', $events_meta );
	check_and_store_custom_meta( 'source16_title', $events_meta );
	check_and_store_custom_meta( 'source1_url', $events_meta );
	check_and_store_custom_meta( 'source2_url', $events_meta );
	check_and_store_custom_meta( 'source3_url', $events_meta );
	check_and_store_custom_meta( 'source4_url', $events_meta );
	check_and_store_custom_meta( 'source5_url', $events_meta );
	check_and_store_custom_meta( 'source6_url', $events_meta );
	check_and_store_custom_meta( 'source7_url', $events_meta );
	check_and_store_custom_meta( 'source8_url', $events_meta );
	check_and_store_custom_meta( 'source9_url', $events_meta );
	check_and_store_custom_meta( 'source10_url', $events_meta );
	check_and_store_custom_meta( 'source11_url', $events_meta );
	check_and_store_custom_meta( 'source12_url', $events_meta );
	check_and_store_custom_meta( 'source13_url', $events_meta );
	check_and_store_custom_meta( 'source14_url', $events_meta );
	check_and_store_custom_meta( 'source15_url', $events_meta );
	check_and_store_custom_meta( 'source16_url', $events_meta );

	check_and_store_custom_meta( 'book_title', $events_meta );
	check_and_store_custom_meta( 'book_author', $events_meta );
	check_and_store_custom_meta( 'book_editor', $events_meta );
	check_and_store_custom_meta( 'book_date', $events_meta );
	check_and_store_custom_meta( 'book_pagecount', $events_meta );
	check_and_store_custom_meta( 'book_isbn10', $events_meta );
	check_and_store_custom_meta( 'book_isbn13', $events_meta );
	check_and_store_custom_meta( 'book_asin', $events_meta );
	check_and_store_custom_meta( 'book_lalibrairie_link', $events_meta );
	check_and_store_custom_meta( 'book_rakuten_link', $events_meta );

	check_and_store_custom_meta( 'book_excerpt', $events_meta );
	check_and_store_custom_meta( 'book_editor_text', $events_meta );
	check_and_store_custom_meta( 'book_author_bio', $events_meta );

	check_and_store_custom_meta( 'view_toc_checkbox', $events_meta );

	check_and_store_custom_meta( 'rewrite301_text', $events_meta );

	if( isset( $events_meta['rewrite301_text'] ) ) {
		if( strlen( $events_meta['rewrite301_text'] ) > 0
			&& substr( $events_meta['rewrite301_text'], 0, 1 ) != '/' ) {
			$events_meta['rewrite301_text'] = '/' . $events_meta['rewrite301_text'];
		}
		$before = '';
		$after = esc_url( str_replace( home_url(), '', get_permalink( $post_id ) ) );
		if( $events_meta['rewrite301_text'] != '' ) {
			$before = esc_url( strtolower( $events_meta['rewrite301_text'] ) );
		}
		if( file_exists( get_template_directory() . '/parts/rewrite301-rules.php' ) ) {
			include_once( get_template_directory() . '/parts/rewrite301-rules.php' );
		} else {
			$rewite301_rules = array();
		}
		foreach( $rewite301_rules as $old_url => $post ) {
			if( $post['id'] == $post_id ) {
				unset( $rewite301_rules[$old_url] );
				break;
			}
		}
		if( $before != '' ) {
			$rewite301_rules[$before] = array( 'id' => $post_id, 'url' => $after );
		}
		if( is_writable( get_template_directory() . '/parts/' ) ) {
			file_put_contents( get_template_directory() . '/parts/rewrite301-rules.php', "<?php\n\n$" . 'rewite301_rules' . " = " . var_export( $rewite301_rules, true ) . ";\n\n?>" );
		}
	}









	foreach ( $events_meta as $key => $value ) :
		if ( 'revision' === $post->post_type )
			return;

		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value);
		}
		if ( !$value )
			delete_post_meta( $post_id, $key );

	endforeach;
}
add_action( 'save_post', 'save_custom_metaboxes', 1, 2 );




?>