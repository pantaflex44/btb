<div class="column column13">
    <div class="column-title">Nos auteurs</div>
	<article class="news">
		<div class="news-content">
			<ul class="wp-tag-cloud" role="list" style="text-align: center;">
				<?php
					custom_wp_list_authors( array(
						'orderby'			=> 'name',
						'order'				=> 'ASC',
						'optioncount'		=> false,
						'exclude_admin'		=> false,
						'show_fullname'		=> false,
						'hide_empty'		=> false,
						'echo'				=> true,
						'style'				=> 'list',
						'html'				=> true
					) );
				?>
			</ul>
		</div>
	</article>
</div>