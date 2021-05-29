<?php
	get_header();
?>

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
			        	<div class="wide-no-thumbnail"></div>
		            <?php } ?>
		            <div class="article-content">
		                <div class="boxed boxedmerge">
		                    <a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
								<h1 style="font-size:3.0em;">
									<?php esc_html( the_title() ); ?>
								</h1>
							</a>
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
							<?php
								}
							?>
		                    <div style="height:48px;"></div>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
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
	comments_template();

	get_footer();
?>