<div class="column column13">
    <div class="column-title">La mieux notée</div>
    <?php
		$args = array(
			'author__in'		=> array( $author_infos['id'] ),
	        'post_status'       => 'publish',
	        'posts_per_page'    => 1,
	        'meta_key'			=> 'post_rating',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC',
			'post_type'			=> array( 'post', 'news', 'actu' )
	    );
	    $mv_query = new WP_Query( $args );

		if( $mv_query->have_posts() ) :
	       	while ( $mv_query->have_posts() ) :
	       		$mv_query->the_post();
	?>
    <article class="news" style="margin-left: 0.5em; margin-right: 0.5em;">
	    <?php if( has_post_thumbnail() ) : ?>
	        <a href="<?php the_permalink(); ?>" class="hide-responsive" title="<?php esc_attr( the_title() ); ?>">
	            <?php the_post_thumbnail( 'large', [ 'class' => 'minh' ] ); ?>
	        </a>
	    <?php endif; ?>
        <div class="news-content">
            <div class="boxed merge">
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
</div>