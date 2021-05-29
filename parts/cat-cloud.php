<div class="column column50">
    <div class="column-title">Les catégories</div>
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
							'taxonomy'		=> 'category',
							'show_count'	=> 0,
							'echo'			=> 1
					 	)
					);
				?>

		</div>
	</article>
</div>