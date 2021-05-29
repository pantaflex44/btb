<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0; padding: 0;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo sprintf( __( "%s - La lettre d'information - %s", 'BTB' ), get_bloginfo( 'name' ), $prev_month_year_name ); ?></title>
	</head>
	<body style="margin: 0; padding: 0; font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: normal; font-weight: normal; background-color: #fff;">

		<table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; padding: 0; margin: 0 auto;">
			<tr>
				<td style="padding: 1.0em; background: #e0e0e9; border-top-left-radius: 8px; border-top-right-radius: 8px; text-align: left;">
					<a style="font-size: 24px; font-weight: bold; color: #483613; text-decoration: none;" href="<?php echo esc_url( get_home_url() ); ?>" target="_blank"><?php echo sprintf( "%s - %s", esc_html( get_bloginfo( 'name' ) ), $prev_month_year_name ); ?></a>
				</td>
			</tr>
			<tr>
				<td style="">
					<?php
						$default_img = 'newsletter-default.jpg';
						$dir = '/assets/img/newsletter/';
						$img = 'newsletter-1-' . $prev_year . '-' . $prev_month_number . '.jpg';
						if( !file_exists( get_template_directory() . $dir . $img ) )
							$img = $default_img;
					?>
					<a href="https://www.facebook.com/FabLou0/" target="_blank" title="Crédits : Fab Lou Photography" style="text-decoration: none; color: #999;">
						<img style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; width: 100%; height: auto; max-height: 240px; object-fit: cover;" src="<?php echo get_template_directory_uri() . $dir . $img; ?>" alt="Fab Lou Photography" title="Fab Lou Photography" />
					</a>
				</td>
			</tr>
			<tr>
				<td style="text-align: center; font-size: 0.7em; color: #999;">
					<a href="https://www.facebook.com/FabLou0/" target="_blank" title="Crédits : Fab Lou Photography" style="text-decoration: none; color: #999;">Crédits : Fab Lou Photography</a>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>

			<!-- articles -->
			<?php
				$posts = $get_prev_month_posts( 'post' );
				if( $posts && count( $posts ) > 0 ) {
			?>
			<tr>
				<td style="text-align: center; font-weight: bold; font-size: normal; background: #483613; color: #fff; border-radius: 8px; padding: 0.5em;">
					<?php echo __( "Articles, Analyses et Réflexions", 'BTB' ); ?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<?php foreach( $posts as $post ) { ?>
			<tr><td style="font-size: 0.8em; text-align: left; padding-bottom: 1.5em; padding-left: 0.5em; padding-right: 0.5em;">
				<a style="text-decoration: none;" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" target="_blank" title="<?php echo esc_html( $post->post_title ); ?>">
					<h3 style="color: #483613; margin: 0; padding: 0;"><?php echo esc_html( $post->post_title ); ?></h3>
					<p style="text-align: justify; padding-left: 0.5em; padding-right: 0.5em; color: #333;">
						<?php
							$thumbnail = get_the_post_thumbnail_url( $post->ID, 'medium' );
							if( $thumbnail !== false ) {
								echo '<img src="' . esc_url( $thumbnail ) . '" style="display: block; float: right; margin-left: 1.0em; margin-bottom: 0.5em; width: 40%; height: auto; border-radius: 8px;" alt="' . esc_attr( $post->post_title ) . '" title="' . esc_attr( $post->post_title ) . '" />';
							}
						?>
						<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
					</p>
					<p style="font-size: smaller; color: #777; text-align: right; clear: right; padding-top: 0.5em; padding-bottom: 0.5em;">
						<?php echo sprintf( __( "le %s, par <b>%s</b>", 'BTB' ), date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>
					</p>
				</a>
			</td></tr>
			<?php } ?>
			<?php } ?>

			<!-- citations -->
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td style="border-top: 3px solid #483613; border-bottom: 3px solid #483613; background: #E7F3F3; padding: 1.0em;">
					<?php
						switch( intval( $prev_month_number ) ) {
							case 1: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>L'obéissance au devoir est une résistance à soi-même.</p><footer style=\"font-size: smaller;\">- Henri Bergson, <cite>Artiste, écrivain, Philosophe (1859 - 1941)</cite></footer></blockquote>"; break;
							case 2: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>La croyance que rien ne change provient soit d'une mauvaise vue, soit d'une mauvaise foi. La première se corrige, la seconde se combat.</p><footer style=\"font-size: smaller;\">- Friedrich Nietzsche, <cite>Artiste, écrivain, Philosophe (1844 - 1900)</cite></footer></blockquote>"; break;
							case 3: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Un crime contre l'humanité est pardonnable ? Pas un crime contre une Société générale ou une BNP ?</p><footer style=\"font-size: smaller;\">- Jacques Mesrine, <cite>Criminel, Gangster, Hors-la-loi (1936 - 1979)</cite></footer></blockquote>"; break;
							case 4: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>La société est bien foutue. Ils mettent des uniformes aux connards pour qu'on puisse les reconnaître.</p><footer style=\"font-size: smaller;\">- Albert Dupontel, <cite>Acteur, Artiste, Cinéaste, Comique (1964 - )</cite></footer></blockquote>"; break;
							case 5: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Les politiciens, il y en a, pour briller en société, ils mangeraient du cirage.</p><footer style=\"font-size: smaller;\">- Coluche, <cite>Artiste, Comique (1944 - 1986)</cite></footer></blockquote>"; break;
							case 6: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Carte de crédit : chacun des petits rectangles de plastique, dont l'ensemble constitue un jeu de société de consommation, aussi appelé jeu de cash-cash.</p><footer style=\"font-size: smaller;\">- Albert Brie, <cite>Artiste, écrivain, Scientifique, Sociologue (1925 - )</cite></footer></blockquote>"; break;
							case 9: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Le bonheur n'est pas le droit de chacun, c'est un combat de tous les jours.</p><footer style=\"font-size: smaller;\">- Orson Welles, <cite>Acteur, Artiste, Cinéaste, Homme d'affaire, Producteur (1915 - 1985)</cite></footer></blockquote>"; break;
							case 8: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>L'histoire de toute société jusqu'à nos jours n'a été que l'histoire de luttes de classes.</p><footer style=\"font-size: smaller;\">- Karl Marx, <cite>Artiste, Communiste, économiste, écrivain, Essayiste, Homme politique, Journaliste, Philosophe, Scientifique, Socialiste, Sociologue (1818 - 1883)</cite></footer></blockquote>"; break;
							case 9: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>La société de consommation a privilégié l'avoir au détriment de l'être.</p><footer style=\"font-size: smaller;\">- Jacques Delors, <cite>Homme d'état, Homme politique, Ministre, Socialiste (1925 - )</cite></footer></blockquote>"; break;
							case 10: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Dans une société fondée sur le pouvoir de l'argent, tandis que quelques poignées de riches ne savent être que des parasites, il ne peut y avoir de \"liberté\", réelle et véritable.</p><footer style=\"font-size: smaller;\">- Lénine, <cite>Communiste, Homme d'état, Homme politique, Révolutionnaire (1870 - 1924)</cite></footer></blockquote>"; break;
							case 11: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Le mental intuitif est un don sacré et le mental rationnel est un serviteur fidèle. Nous avons créé une société qui honore le serviteur et a oublié le don.</p><footer style=\"font-size: smaller;\">- Albert Einstein, <cite>Mathématicien, Physicien, Scientifique (1879 - 1955)</cite></footer></blockquote>"; break;
							case 12: echo "<blockquote style=\"font-family: 'Times New Roman', Times, serif;\"><p>Une société qui survit en créant des besoins artificiels pour produire efficacement des biens de consommation inutiles ne paraît pas susceptible de répondre à long terme aux défis posés par la dégradation de notre environnement.</p><footer style=\"font-size: smaller;\">- Pierre Joliot-Curie, <cite>Biologiste, Scientifique (1932 - )</cite></footer></blockquote>"; break;
						}
					?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>

			<!-- actu -->
			<?php
				$posts = $get_prev_month_posts( 'actu' );
				if( $posts && count( $posts ) > 0 ) {
			?>
			<tr>
				<td style="text-align: center; font-weight: bold; font-size: normal; background: #483613; color: #fff; border-radius: 8px; padding: 0.5em;">
					<?php echo __( "Nous avions un peu souligné l'actu...", 'BTB' ); ?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<?php foreach( $posts as $post ) { ?>
			<tr><td style="font-size: 0.8em; text-align: left; padding-bottom: 1.5em; padding-left: 0.5em; padding-right: 0.5em;">
				<a style="text-decoration: none;" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" target="_blank" title="<?php echo esc_html( $post->post_title ); ?>">
					<h3 style="color: #483613; margin: 0; padding: 0;"><?php echo esc_html( $post->post_title ); ?></h3>
					<p style="text-align: justify; padding-left: 0.5em; padding-right: 0.5em; color: #333;">
						<?php
							$thumbnail = get_the_post_thumbnail_url( $post->ID, 'medium' );
							if( $thumbnail !== false ) {
								echo '<img src="' . esc_url( $thumbnail ) . '" style="display: block; float: right; margin-left: 1.0em; margin-bottom: 0.5em; width: 40%; height: auto; border-radius: 8px;" alt="' . esc_attr( $post->post_title ) . '" title="' . esc_attr( $post->post_title ) . '" />';
							}
						?>
						<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
					</p>
					<p style="font-size: smaller; color: #777; text-align: right; clear: right; padding-top: 0.5em; padding-bottom: 0.5em;">
						<?php echo sprintf( __( "le %s, par <b>%s</b>", 'BTB' ), date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>
					</p>
				</a>
			</td></tr>
			<?php } ?>
			<?php } ?>

			<!-- caricature -->
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td style="text-align: center;" align="center">
					<?php
						$default_img = 'dessin-default.jpg';
						$dir = '/assets/img/newsletter/';
						$img = 'dessin-1-' . $prev_year . '-' . $prev_month_number . '.jpg';
						if( !file_exists( get_template_directory() . $dir . $img ) )
							$img = $default_img;
					?>
					<img style="max-width: 100%; height: auto; object-fit: cover;" src="<?php echo get_template_directory_uri() . $dir . $img; ?>" alt="Fab Lou Photography" title="Fab Lou Photography" />
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>

			<!-- en bref -->
			<?php
				$posts = $get_prev_month_posts( 'news' );
				if( $posts && count( $posts ) > 0 ) {
			?>
			<tr>
				<td style="text-align: center; font-weight: bold; font-size: normal; background: #483613; color: #fff; border-radius: 8px; padding: 0.5em;">
					<?php echo __( "Il faut oser en parler! En bref...", 'BTB' ); ?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<?php foreach( $posts as $post ) { ?>
			<tr><td style="font-size: 0.8em; text-align: left; padding-bottom: 1.5em; padding-left: 0.5em; padding-right: 0.5em;">
				<a style="text-decoration: none;" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" target="_blank" title="<?php echo esc_html( $post->post_title ); ?>">
					<h3 style="color: #483613; margin: 0; padding: 0;"><?php echo esc_html( $post->post_title ); ?></h3>
					<p style="text-align: justify; padding-left: 0.5em; padding-right: 0.5em; color: #333;">
						<?php
							$thumbnail = get_the_post_thumbnail_url( $post->ID, 'medium' );
							if( $thumbnail !== false ) {
								echo '<img src="' . esc_url( $thumbnail ) . '" style="display: block; float: right; margin-left: 1.0em; margin-bottom: 0.5em; width: 40%; height: auto; border-radius: 8px;" alt="' . esc_attr( $post->post_title ) . '" title="' . esc_attr( $post->post_title ) . '" />';
							}
						?>
						<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
					</p>
					<p style="font-size: smaller; color: #777; text-align: right; clear: right; padding-top: 0.5em; padding-bottom: 0.5em;">
						<?php echo sprintf( __( "le %s, par <b>%s</b>", 'BTB' ), date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>
					</p>
				</a>
			</td></tr>
			<?php } ?>
			<?php } ?>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>




			<tr><td>
				<?php echo sprintf( __( "<p><strong>Et voila, c'est terminé pour ce mois-ci!</strong></p><p>Retrouvez l'intégralité des publications sur le site <a href='%s' target='_blank'>%s</a> et sur nos différents réseaux sociaux!</p>", 'BTB' ), esc_url( get_home_url() ), esc_url( get_home_url() ) ); ?>
			</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>






			<tr><td>&nbsp;</td></tr>
			<tr>
				<td style="background: #483613; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 1.0em; padding-top: 2.0em; padding-bottom: 0em; text-align: center;">
					<?php echo __( "Nous retrouver sur:", 'BTB' ); ?>
				</td>
			</tr>
			<tr>
				<td style="background: #483613; padding: 1.0em; text-align: center;">
					<?php if( get_theme_mod( 'facebook_url', '' ) != '' ) { ?>
					<a style="margin: 0em 0.5em;" href="<?php echo esc_url( get_theme_mod( 'facebook_url', '' ) ); ?>" target="_blank" title="<?php echo __( 'Notre page Facebook', 'BTB' ); ?>"><img width="32" height="32" alt="Facebook" src="<?php echo get_template_directory_uri() . '/assets/img/facebook-color-32.png'; ?>" style="border: 0; margin: 0; padding: 0;" /></a>
					<?php } ?>
					<?php if( get_theme_mod( 'twitter_url', '' ) != '' ) { ?>
					<a style="margin: 0em 0.5em;" href="<?php echo esc_url( get_theme_mod( 'twitter_url', '' ) ); ?>" target="_blank" title="<?php echo __( 'Notre compte Twitter', 'BTB' ); ?>"><img width="32" height="32" alt="Twitter" src="<?php echo get_template_directory_uri() . '/assets/img/twitter-color-32.png'; ?>" style="border: 0; margin: 0; padding: 0;" /></a>
					<?php } ?>
					<?php if( get_theme_mod( 'instagram_url', '' ) != '' ) { ?>
					<a style="margin: 0em 0.5em;" href="<?php echo esc_url( get_theme_mod( 'instagram_url', '' ) ); ?>" target="_blank" title="<?php echo __( 'Notre espace Instagram', 'BTB' ); ?>"><img width="32" height="32" alt="Instagram" src="<?php echo get_template_directory_uri() . '/assets/img/instagram-color-32.png'; ?>" style="border: 0; margin: 0; padding: 0;" /></a>
					<?php } ?>
					<?php if( get_theme_mod( 'youtube_url', '' ) != '' ) { ?>
					<a style="margin: 0em 0.5em;" href="<?php echo esc_url( get_theme_mod( 'youtube_url', '' ) ); ?>" target="_blank" title="<?php echo __( 'Notre chaine YouTube', 'BTB' ); ?>"><img width="32" height="32" alt="YouTube" src="<?php echo get_template_directory_uri() . '/assets/img/youtube-color-32.png'; ?>" style="border: 0; margin: 0; padding: 0;" /></a>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td style="background: #483613; color: #fff; font-size: smaller; padding: 1.0em; word-break: break-all; -ms-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;">
					<a href="<?php echo esc_url( trailingslashit( get_home_url() ) . '?unsubscribe=' . esc_attr( $account->address ) . '&id=' . $account->id . '&type=newsletter' ); ?>" style="display: block; text-align: center; width: 150px; margin: 1.0em; padding: 0.5em 1.0em; color: #fff; background-color: #f0f0f9; border: 1px solid #483613; border-radius: 8px; font-weight: bold; margin: 0 auto; width: 200px; background: #483613; border: 1px solid #ccc; color: #ddd;" target="_blank"><?php echo __( "ME DESINSCRIRE DE<br />LA LETTRE D'INFORMATIONS", 'BTB' ); ?></a>
				</td>
			</tr>
			<tr>
				<td style="text-align: center; background: #483613; color: #fff; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; font-size: smaller; padding: 1.0em; word-break: break-all; -ms-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;">
					<?php echo esc_html( get_theme_mod( 'copyright', '' ) ); ?>&nbsp;|&nbsp;<a style="color: #ddd; text-decoration: none;" href="<?php echo esc_url( get_theme_mod( 'licence_url', '' ) ); ?>" target="_blank"><?php echo esc_html( get_theme_mod( 'licence', '' ) ); ?></a>
				</td>
			</tr>
		</table>
	</body>
</html>