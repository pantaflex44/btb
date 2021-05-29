<?php
	get_header();

	$page = get_page_by_path( 'authors', 'OBJECT', 'page' );
	$page_title = get_the_title( $page->ID );
?>

<div class="boxed">

    <div class="article-list-header bottom-separator" style="margin-top:1.0em;">

        <div class="article-list-title">
            <h1>
            	<?php echo $page_title; ?>
            </h1>
		</div>

        <div class="article-list-numbers">
        	<?php echo __( "Retrouvez, par ordre alphabétique, tous les membres actifs sur Born To Be Media.", 'BTB' ); ?>
		</div>

    </div>

</div>

<?php
    if (have_posts()) :
        while (have_posts()) : the_post();
?>

	<div class="wide">
		<article>
			<?php if( has_post_thumbnail() ) { ?>
				<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
					<div class="thumbnail-box">
						<?php the_post_thumbnail( 'top-wide' ); ?>
					</div>
				</a>
			<?php } else { ?>
				<div class="thumbnail-box">
					<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width: 100%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-authors.jpg" />
				</div>
			<?php } ?>
			<div class="article-content">
				<div class="boxed boxedmerge">
					<?php
						global $page, $numpages, $multipage, $more;
						if( $multipage ) {
					?>
					<div class="article-pagination">
						<?php
							echo sprintf(
								'%s %s <span style="font-size:small;">/ %s</span>',
								__( 'page', 'BTB' ),
								$page,
								$numpages
							);
						?>
					</div>
					<div style="height:48px;"></div>
					<?php
						}
					?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<?php
						$users_nsorted = get_users( array(
							'orderby'	=> 'display_name',
							'order'		=> 'ASC'
						) );

						$users_sorted = [];
						foreach( $users_nsorted as $u ) {

							$letter = strtolower( substr( trim( esc_html( $u->display_name ) ), 0, 1 ) );

							if( !isset( $users_sorted[$letter] ) )
								$users_sorted[$letter] = [];

							$users_sorted[$letter][] = $u;

						}
						$users = $users_nsorted;
						unset( $users_nsorted );

						// décommenter la ligne ci-dessous pour classer par ordre alphabétique
						//foreach( $users_sorted as $letter => $users ) {

							echo '<div class="article-list-header">' . "\n";

							// Affichage des lettre
							// décommenter la ligne ci-dessous pour classer par ordre alphabétique
							//echo "\t\t" . '<div style="display:block;font-size:3em;text-align:right;color:#ddd;margin-bottom:1.0em;padding-right:0.5em;border-bottom:6px dotted #ddd;">' . sprintf( '#_%s', strtoupper( $letter ) ) . '</div>' . "\n";

							$counter = 0;
							$author_counter = 0;
							$author_prefix = strlen( strval( count( $users ) ) );
							$author_prefix = ( $author_prefix >= 2) ? $author_prefix : 2;
							foreach( $users as $user ) {
								if( !in_array( 'administrator', $user->roles )
									&& !in_array( 'editor', $user->roles )
									&& !in_array( 'author', $user->roles ) )
									continue;

								$counter++;
								$author_counter++;

								if( $counter > 3 )
									$counter = 1;

								$posts_count = count_user_posts( $user->ID, array( 'actu', 'news', 'post' ), false );

								$avatar = '<div class="avatar-container">' . get_avatar(
									$user->ID,
									300,
									get_template_directory_uri() . '/assets/img/default_avatar.png',
									esc_attr( esc_html( $user->display_name ) ),
									array( 'class' => 'avatar' )
								) . '</div>' . "\n";

								if( $counter == 1 )
									echo "\t\t" . '<div class="columns columns-author">' . "\n";


					?>

							<div class="column column13 author" style="<?php echo ( $posts_count > 0 ? 'opacity:1.0;pointer-events:auto;' : 'opacity:1.0;pointer-events:none;' ); ?>">
								<div class="article-list-title" style="text-align:center;">
								<?php if( $posts_count > 0 ) { ?>
								<a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="<?php echo $user->display_name; ?>">
								<?php } ?>
									<div style="position:relative;">
										<?php echo $avatar; ?>

										<?php if ( in_array( 'administrator', $user->roles ) ) { ?>
											<i class="fas fa-user-tie" title="<?php echo __( 'Administrateur', 'BTB' ); ?>" style="font-size:1.4em;position:absolute;top:0px;right:0px;color:#777;"></i>
										<?php } elseif ( in_array( 'editor', $user->roles ) ) { ?>
											<i class="fas fa-book-reader" title="<?php echo __( 'Editeur', 'BTB' ); ?>" style="font-size:1.4em;position:absolute;top:0px;right:0px;color:#777;"></i>
										<?php } elseif ( in_array( 'author', $user->roles ) ) { ?>
											<i class="fas fa-pen-nib" title="<?php echo __( 'Auteur', 'BTB' ); ?>" style="font-size:1.4em;position:absolute;top:0px;right:0px;color:#777;"></i>
										<?php } ?>

									</div>
									<h4 style="color: var( --main-color, #739B11 );">
										<?php echo ucwords( $user->display_name ); ?>
									</h4>
								<?php if( $posts_count > 0 ) { ?>
								</a>
								<?php } ?>
								</div>
								<div class="article-list-numbers" style="text-align: justify;margin:0.5em;z-index:1;">
									<?php echo wp_trim_words( $user->description, 30, '...' ); ?>
								</div>
								<div style="line-height:1.7em;font-size:1.2em;position:absolute;width:100%;bottom:3.5em;left:50%;-webkit-transform: translateX(-50%);transform: translateX(-50%);margin-left:0.3em;">
									<a style="margin-right:1.0em;" href="<?php echo $user->facebook; ?>" target="_blank" title="Facebook" <?php echo ( $user->facebook == '' ? 'disabled' : '' ); ?>><i class="fab fa-facebook-f zoom-effect"></i></a>
									<a style="margin-right:1.0em;" href="<?php echo $user->twitter; ?>" target="_blank" title="Twitter" <?php echo ( $user->twitter == '' ? 'disabled' : '' ); ?>><i class="fab fa-twitter zoom-effect"></i></a>
									<a style="margin-right:1.0em;" href="<?php echo $user->instagram; ?>" target="_blank" title="Instagram" <?php echo ( $user->instagram == '' ? 'disabled' : '' ); ?>><i class="fab fa-instagram zoom-effect"></i></a>
									<a style="margin-right:1.0em;" href="<?php echo $user->youtube; ?>" target="_blank" title="YouTube" <?php echo ( $user->youtube == '' ? 'disabled' : '' ); ?>><i class="fab fa-youtube zoom-effect"></i></a>
									<a style="margin-right:1.0em;" href="<?php echo $user->linkedin; ?>" target="_blank" title="LinkedIn" <?php echo ( $user->linkedin == '' ? 'disabled' : '' ); ?>><i class="fab fa-linkedin zoom-effect"></i></a>
									<a style="margin-right:1.0em;" href="<?php echo $user->user_url; ?>" target="_blank" title="Site Internet" <?php echo ( $user->user_url == '' ? 'disabled' : '' ); ?>><i class="fas fa-globe-europe zoom-effect"></i></a>
								</div>
								<div class="article-list-numbers" style="font-size:small;text-align:left;position:absolute;left:0;bottom:0;margin:1.0em 2.0em;">
									<?php
										echo sprintf(
											__( 'Membre depuis le %s', 'BTB' ),
											date_i18n( get_option( 'date_format' ), strtotime( $user->user_registered ) )
										);
									?>
									<br />
									<?php echo sprintf(
											__( 'Publications: <b>%s</b>', 'BTB' ),
											$posts_count
										);
									?>
								</div>
							</div>

					<?php
								if( $counter == 3 || $counter >= count( $users ) )
									echo "\t\t" . '</div>' . "\n";

							}

							echo "\t" . '</div>' . "\n";
						// décommenter la ligne ci-dessous pour classer par ordre alphabétique
						//}
					?>

				</div>
			</div>
		</article>
	</div> <!-- fin section wide -->

<?php
        endwhile;
	endif;

	if( $multipage ) {
		echo '<div class="boxed">';
		wp_link_pages();
		echo '</div>';
	}

?>

<?php
	get_footer();
?>