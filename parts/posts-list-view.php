<?php
	global $page, $page_title, $paged, $post_per_page, $the_query;

    $startpost = 1;
    $startpost = $post_per_page * ( $paged - 1 ) + 1;
    $endpost = ( $post_per_page * $paged < $the_query->found_posts ? $post_per_page * $paged : $the_query->found_posts );

    $article_counter = $startpost;
    $article_prefix = strlen( strval( intval( $the_query->found_posts ) ) );
    $article_prefix = ( $article_prefix >= 2) ? $article_prefix : 2;

    $search_text = esc_html( trim( get_search_query() ) );
?>
<div class="boxed">

    <div class="article-list-header bottom-separator">

	    <?php
	    	$author_infos = [];
		    if( is_author() && $the_query->have_posts() ) {
			    $author = get_queried_object();
			    if( $author ) {
			    	$author_infos['id'] = $author->ID;
			    	$author_infos['description'] = get_user_meta( $author_infos['id'], 'description', true );
				    $author_infos['registered'] = date_i18n( get_option( 'date_format' ), strtotime( $author->user_registered ) );
				    $author_infos['avatar'] = get_avatar( $author_infos['id'], 256 );
				}
			}
		?>

        <div class="article-list-title">
        	<?php
	        	if( is_author() && isset( $author_infos['avatar'] ) && $author_infos['avatar'] != '' ) {
					echo $author_infos['avatar'];
	        	}
        	?>
            <h1>
            	<?php echo $page_title; ?>
            </h1>
        </div>

        <div class="article-list-numbers">
            <?php

			    if( is_author() && isset( $author_infos['registered'] ) && $author_infos['registered'] != '' ) {

			    	echo sprintf(
			    		__( 'Membre depuis le %s', 'BTB' ),
			    		$author_infos['registered']
			    	) . '<br />';

			    	//echo '<div class="author-description">' . $author_infos['description'] . '</div>';

			    }

				if( is_search() ) {
					echo sprintf(
	                    _n(
	                        __( 'Votre recherche retourne <b>%s résultat</b>.', 'BTB' ),
	                        __( 'Votre recherche retourne <b>%s résultats</b>.', 'BTB' ),
	                        $the_query->found_posts,
	                        'BTB'
	                    ),
	                    $the_query->found_posts
	                );
				} else {
					echo sprintf(
	                    _n(
	                        __( '%s publication', 'BTB' ),
	                        __( '%s publications', 'BTB' ),
	                        $the_query->found_posts,
	                        'BTB'
	                    ),
	                    $the_query->found_posts
	                );
	            }

            ?>
        </div>

        <?php
        	if( is_search() ) {
        ?>
        <div class="page-search-box">
			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>" >
				<i class="fas fa-search"></i>
				<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo __( 'votre recherche ici', 'BTB' ) ?>" />
        	</form>
        </div>
        <?php
        	}
        ?>

    </div>

</div>

    <?php
        if( $the_query->have_posts() ) :

        	while ( $the_query->have_posts() ) :
        		$the_query->the_post();

				$article_idstring = '#'.str_pad( $article_counter, $article_prefix, '0', STR_PAD_LEFT );

    ?>

<?php if( ( $article_counter == 1 ) && ( !is_search() && !is_author() ) ) { ?>

	<div class="wide">
		<article id="post-<?php the_ID(); ?>">
			<?php if( has_post_thumbnail() ) { ?>
				<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
					<div class="thumbnail-box">
						<?php the_post_thumbnail( 'top-wide' ); ?>
					</div>
				</a>
			<?php } else { ?>
				<div class="wide-no-thumbnail"></div>
			<?php } ?>
			<div class="article-content">
				<div class="boxed boxedmerge">
					<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
						<h2 style="font-size:2.5em;">
							<?php esc_html( the_title() ); ?>
						</h2>
					</a>

					<div class="meta-box">
                    	<span class="meta-plus">
                        	<?php
                        		$postTypeSlug = get_post_type();
                            	$postType = get_post_type_object( $postTypeSlug );
								if( $postType ) {
									$name = esc_html( $postType->labels->singular_name );
									$link = get_post_type_archive_link( $postTypeSlug );
									if( $link ) {
										echo '<a href="'.$link.'" title="'.$name.'">'.$name.'</a>';
									} else {
										echo $name;
									}
								}
                        	?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Temps de lecture:</b> %s', 'BTB' ),
                                    get_reading_time_in_minutes()
                                );
                            ?>
                        </span>
                        <?php if( get_theme_mod( 'display_views_counter_on_post_list', false ) ) { ?>
                        <span class="meta-plus">
                            <?php
                            	$views = get_post_visits( get_the_ID() );
                                echo sprintf(
                                	_n(
                                		__( '<b>Vue:</b> %s', 'BTB' ),
                                		__( '<b>Vues:</b> %s', 'BTB' ),
                                		$views,
                                		'BTB'
                                	),
                                    $views
                                );
                            ?>
                        </span>
                        <?php } ?>
                        <span class="meta-plus">
                            <?php
                                comments_number(
                                    __( '<b>Commentaire:</b> aucun', 'BTB' ),
                                    __( '<b>Commentaire:</b> 1', 'BTB' ),
                                    __( '<b>Commentaires:</b> %', 'BTB' )
                                );
                            ?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Note:</b> %s', 'BTB' ), get_rating_star_font( true, get_the_ID() ) );
                            ?>
                        </span>
                        <br />
                        <br />
                    </div>

                    <p class="chapo">
                    	<?php
                    		echo wp_strip_all_tags( get_the_excerpt(), true );
                    	?>
                    </p>

                    <p>&nbsp;</p>

                    <div class="meta-box">
                        <?php
                            foreach( get_the_category() as $cat )
                                echo '<span class="meta-categorie"><a href="'.get_category_link( $cat->cat_ID ).'" title="'.$cat->cat_name.'">'.$cat->cat_name.'</a></span>';
                        ?>

                        <span class="meta-author">
                            <?php
                            	$author_id = get_the_author_meta( 'ID' );
                            	$author_name = get_the_author_meta( 'display_name' , $author_id );
                            	$author_link = get_author_posts_url( $author_id );

                                echo sprintf( __( 'Publiée le %s par %s</span>', 'BTB' ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b> à <b>%s</b></a>', 'BTB' ),
                                        get_current_post_archive_date_link(),
                                        get_the_date(),
                                        get_the_date(),
                                        get_the_time()
                                    ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b></a>', 'BTB' ),
                                        $author_link,
                                        $author_name,
                                        $author_name
                                    )
                                );
                            ?>
                        </span>
                    </div>

				</div>
			</div>
		</article>
	</div>

<?php } else { ?>

	<div class="boxed">
        <article id="post-<?php the_ID(); ?>" class="list">

			<?php if( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                    <span style="display:block;font-size:3em;text-align:right;color:#ddd;margin-bottom:0.5em;"><?php echo $article_idstring; ?></span>
                    <?php the_post_thumbnail( 'large' ); ?>

                </a>
            <?php endif; ?>

            <div class="article-content article">
                <div class="boxed">

                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                        <h2>
                        	<?php
                        		$t = get_the_title();
                        		if( is_search() ) {
                        			$t = str_ireplace( $search_text, '<span class="query-search">' . $search_text . '</span>', $t );
                        		}
                        		echo $t;
                        	?>
                        </h2>
                    </a>

                    <div class="meta-box">
                    	<span class="meta-plus">
                        	<?php
                        		$postTypeSlug = get_post_type();
                            	$postType = get_post_type_object( $postTypeSlug );
								if( $postType ) {
									$name = esc_html( $postType->labels->singular_name );
									$link = get_post_type_archive_link( $postTypeSlug );
									if( $link ) {
										echo '<a href="'.$link.'" title="'.$name.'">'.$name.'</a>';
									} else {
										echo $name;
									}
								}
                        	?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Temps de lecture:</b> %s', 'BTB' ),
                                    get_reading_time_in_minutes( get_the_content() )
                                );
                            ?>
                        </span>
                        <?php if( get_theme_mod( 'display_views_counter_on_post_list', false ) ) { ?>
                        <span class="meta-plus">
                            <?php
                            	$views = get_post_visits();
                                echo sprintf(
                                	_n(
                                		__( '<b>Vue:</b> %s', 'BTB' ),
                                		__( '<b>Vues:</b> %s', 'BTB' ),
                                		$views,
                                		'BTB'
                                	),
                                    $views
                                );
                            ?>
                        </span>
                        <?php } ?>
                        <span class="meta-plus">
                            <?php
                                comments_number(
                                    __( '<b>Commentaire:</b> aucun', 'BTB' ),
                                    __( '<b>Commentaire:</b> 1', 'BTB' ),
                                    __( '<b>Commentaires:</b> %', 'BTB' )
                                );
                            ?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Note:</b> %s', 'BTB' ), get_rating_star_font( true, get_the_ID() ) );
                            ?>
                        </span>
                        <br />
                        <br />
                    </div>

                    <p class="chapo">
                    	<?php
                    		$t = wp_strip_all_tags( get_the_excerpt(), true );
                    		if( is_search() ) {
                    			$t = str_ireplace( $search_text, '<span class="query-search">' . $search_text . '</span>', $t );
                    		}
                    		echo $t;
                    	?>
                    </p>
                    <?php
                    	if( is_search() ) {
                    		$in_excerpt = substr_count( strtolower( get_the_excerpt() ), strtolower( $search_text ) );
                    		$in_content = substr_count( strtolower( get_the_content() ), strtolower( $search_text ) );
                    		if( $in_excerpt > 0 || $in_content > 0 ) {
                    ?>
                    <p>&nbsp;</p>
                    <p class="chapo" style="font-size:small;">
                    	<?php
                    		echo sprintf( __( '<b>%s à été trouvé dans le résumé et le contenu de l\'article %s fois.</b>', 'BTB' ),
                    			'<span class="query-search">' . $search_text . '</span>',
                    			$in_excerpt + $in_content
                    		);
                    	?>
                    </p>
                    <?php
                    		}
                    	}
                    ?>
                    <p>&nbsp;</p>

                    <div class="meta-box">
                        <?php
                            foreach( get_the_category() as $cat )
                                echo '<span class="meta-categorie"><a href="'.get_category_link( $cat->cat_ID ).'" title="'.$cat->cat_name.'">'.$cat->cat_name.'</a></span>';
                        ?>

                        <span class="meta-author">
                            <?php
                            	$author_id = get_the_author_meta( 'ID' );
                            	$author_name = get_the_author_meta( 'display_name' , $author_id );
                            	$author_link = get_author_posts_url( $author_id );

                                echo sprintf( __( 'Publié le %s par %s</span>', 'BTB' ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b> à <b>%s</b></a>', 'BTB' ),
                                        get_current_post_archive_date_link(),
                                        get_the_date(),
                                        get_the_date(),
                                        get_the_time()
                                    ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b></a>', 'BTB' ),
                                        $author_link,
                                        $author_name,
                                        $author_name
                                    )
                                );
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php } ?>

    <?php

    			$article_counter++;

            endwhile;
            wp_reset_postdata();
        else :
            echo '<div style="font-size: 1.0em; width: 100%; text-align: center;">' . __( 'Aucune publication de ce type n\'a été trouvée.', 'BTB' ) . '</div>';
        endif;
    ?>

<div class="boxed">
    <div class="pagination">
        <?php numeric_posts_nav( $the_query, $startpost, $endpost ); ?>
    </div>
</div>
<!-- fin boxed section - liste des articles -->