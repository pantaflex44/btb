<div class="column column50">
    <div class="column-title">Nous en avons parlé</div>
	<article class="news">
		<div class="news-content" style="text-align: center;">

				<?php
					wp_tag_cloud( array(
							'smallest'		=> 0.8,
							'largest'		=> 1.4,
							'unit'			=> 'em',
							'orderby'		=> 'name',
							'order'			=> 'ASC',
							'link'			=> 'view',
							'format'		=> 'list',
							'taxonomy'		=> 'post_tag',
							'show_count'	=> 0,
							'echo'			=> 1
					 	)
					);
				?>

		</div>
	</article>
</div>