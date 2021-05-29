<?php
	get_header();
?>

	<div class="wide">
		<article>
			<div class="thumbnail-box">
				<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width: 100%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-404.jpg" />
			</div>
			<div class="article-content">
				<div class="boxed boxedmerge">
					<a href="<?php echo home_url(); ?>" title="<?php echo __( 'Oups, page introuvable!', 'BTB' ); ?>">
						<h1 style="font-size:3.0em;">
							<?php echo __( 'Oups, page introuvable!', 'BTB' ); ?>
						</h1>
					</a>
					<div style="height:48px;"></div>
					<div class="entry-content" style="text-align: center;">
						<h3>
						<?php
							echo __( "La page que vous souhaitez voir n'est pas ou plus disponible sur notre site!", 'BTB' );
						?>
						</h3>
						<hr />
						<p style="color: var( --main-color, #739B11 );">Par contre d'autres contenus sont disponibles à la consultation</p>
						<p style="font-size: 4.0em; color: var( --main-color, #739B11 ); margin-top: 0.5em;"><i class="fas fa-level-down-alt"></i></p>
					</div>
				</div>
			</div>
		</article>
	</div> <!-- fin section wide -->

<?php
	get_footer();
?>