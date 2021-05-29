<div class="column column13">
    <div class="column-title">Les 12 derniers mois</div>
	<article class="news">
		<div class="news-content">
			<ul class="wp-tag-cloud" role="list" style="text-align: center;">
				<?php
					wp_get_archives( array(
						'type'				=> 'monthly',
						'limit'				=> 12,
						'format'			=> 'html',
						'show_post_count'	=> false,
						'echo'				=> true,
						'order'				=> 'DESC'
					) );
				?>
			</ul>
		</div>
	</article>
</div>