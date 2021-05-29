<div class="column column13">
    <div class="column-title">Les 7 dernières en date</div>
	<article class="news">
		<div class="news-content">
			<ul class="wp-postbypost" role="list" style="text-align: left;">
				<?php
					wp_get_archives( array(
						'type'				=> 'postbypost',
						'limit'				=> 7,
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