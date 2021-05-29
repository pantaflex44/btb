<?php
	global $first_news_actu_id;
	$args = array(
        'post_type'         => array( 'news' ),
        'post_status'       => 'publish',
        'posts_per_page'    => 5,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post__not_in'		=> array( $first_news_actu_id )
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();

?>

		<article class="news home" style="margin-top: 1.0em; padding-top: 1.5em;">
			<?php if( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" class="" title="<?php esc_attr( the_title() ); ?>">
					<?php the_post_thumbnail( '268p', [ 'class' => 'minh' ] ); ?>
				</a>
			<?php endif; ?>
			<div class="news-content">
				<div class="boxed merge" style="margin-bottom: 0; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;">
					<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<div class="meta-box">
						<span class="meta-author menu" style="margin-left:0;padding-left:0;">
							<?php
								echo sprintf( __( 'Publié le %s</span>', 'BTB' ),
									sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b> à <b>%s</b></a>', 'BTB' ),
										get_current_post_archive_date_link(),
										get_the_date(),
										get_the_date(),
										get_the_time()
									)
								);
							?>
						</span>
					</div>
				</div>
			</div>
		</article>



<?php
		endwhile;
		wp_reset_postdata();
	endif;
?>