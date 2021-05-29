<?php
	get_header();
?>

	<div class="wide">
		<?php get_template_part( 'parts/last-news-actu-wide' ); ?>
	</div>
	<div class="boxed">
		<div class="columns" style="align-items: stretch;">
			<div class="column column23 home" style="position: relative; padding-bottom: 5em;">
				<div class="column-title home"><?php echo __( 'Soulignons l\'actualité', 'BTB' ); ?></div>
				<?php get_template_part( 'parts/last-actu-boxed' ); ?>
				<div class="more" style="position: absolute; bottom: 0; left: 0;"><a href="<?php echo get_home_url() . '/actu/'; ?>"><?php echo __( 'L\'actu passée au crible', 'BTB' ); ?></a></div>
			</div>
			<div class="column column13 home" style="position: relative; padding-bottom: 5em;">
				<div class="column-title home"><?php echo __( 'Parlons peu, parlons bien', 'BTB' ); ?></div>
				<?php get_template_part( 'parts/last-news-boxed' ); ?>
				<div class="more" style="position: absolute; bottom: 0; left: 0;"><a href="<?php echo get_home_url() . '/news/'; ?>"><?php echo __( 'En bref, la suite', 'BTB' ); ?></a></div>
			</div>
		</div>
	</div>

	<div class="separator-title">
		<?php echo __( 'Articles, Analyses et Réflexions', 'BTB' ); ?>
	</div>
	<?php get_template_part( 'parts/last-articles-hero-boxed' ); ?>
	<div class="boxed">
		<div class="more"><a href="<?php echo get_permalink( get_page_by_path( 'articles' ) ); ?>"><?php echo __( 'Lire plus d\'articles', 'BTB' ); ?></a></div>
	</div>



<?php
	get_footer();
?>