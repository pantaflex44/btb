<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0; padding: 0;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo sprintf( __( "%s - Nouvelle(s) publication(s) disponible(s)!", 'BTB' ), get_bloginfo( 'name' ) ); ?></title>
	</head>
	<body style="margin: 0; padding: 0; font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: normal; font-weight: normal; background-color: #fff;">

		<table style="width: 100%; max-width: 600px; padding: 0; margin: 0 auto;  border: 0;">
			<tr style="margin: 0; border: 0;">
				<td style="border: 1px solid #134847; margin: 0; background: #134847; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
					<h1 style="padding: 0em 1.0em; padding-top: 0.75em;"><a style="color: #ddd; text-decoration: none;" href="<?php echo get_home_url(); ?>" target="_blank"><?php echo get_bloginfo( 'name' ); ?></a></h1>
					<h5 style="padding: 0em 3.0em; opacity: 0.5;"><?php echo sprintf( __( "Notification du %s", 'BTB' ), date_i18n( get_option( 'date_format' ), time() ) ); ?></h5>
				</td>
			</tr>
			<tr style="margin: 0; border: 0;">
				<td style="border: 1px solid #f0f0f9; margin: 0; line-height: 2.0em; background: #f0f0f9 ; color: #333; padding: 0.5em 1.0em; text-align: center; font-size: smaller; font-weight: bold; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; -ms-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;">
					<a style="color: #777; text-decoration: underline; margin: 0em 0.5em; line-height: 2.0em;" href="<?php echo esc_url( get_home_url() ); ?>" target="_blank">Le site Internet</a><br/>
					<?php if( get_theme_mod( 'facebook_url', '' ) != '' ) { ?>
					<a style="color: #777; text-decoration: underline; margin: 0em 0.5em; line-height: 2.0em;" href="<?php echo esc_url( get_theme_mod( 'facebook_url', '' ) ); ?>" target="_blank">Facebook</a>
					<?php } ?>
					<?php if( get_theme_mod( 'twitter_url', '' ) != '' ) { ?>
					<a style="color: #777; text-decoration: underline; margin: 0em 0.5em; line-height: 2.0em;" href="<?php echo esc_url( get_theme_mod( 'twitter_url', '' ) ); ?>" target="_blank">Twitter</a>
					<?php } ?>
					<?php if( get_theme_mod( 'instagram_url', '' ) != '' ) { ?>
					<a style="color: #777; text-decoration: underline; margin: 0em 0.5em; line-height: 2.0em;" href="<?php echo esc_url( get_theme_mod( 'instagram_url', '' ) ); ?>" target="_blank">Instagram</a>
					<?php } ?>
					<?php if( get_theme_mod( 'youtube_url', '' ) != '' ) { ?>
					<a style="color: #777; text-decoration: underline; margin: 0em 0.5em; line-height: 2.0em;" href="<?php echo esc_url( get_theme_mod( 'youtube_url', '' ) ); ?>" target="_blank">YouTube</a>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td style="font-size: large; color: #134847; opacity: 0.5; text-align: center; padding: 1.0em 0em; word-break: break-all; -ms-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;">
					<?php echo __( "pour ne rien manquer de nos publications", 'BTB' ); ?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					<table>
					<?php
						$counter = 0;
						foreach( $notifications_posts as $post ) {
							$counter++;
					?>
						<?php
							if( $counter == 1 ) {
								$thumbnail = get_the_post_thumbnail_url( $post->ID, 'medium_large' );
								if( $thumbnail !== false ) {
									echo '<tr><td style="padding-bottom: 1.0em;">';
									echo '<img src="' . esc_url( $thumbnail ) . '" style="display: block; width: 100%; height: auto; margin: 0 auto; border-radius: 8px;" />';
									echo '</td></tr>';
								}
							}
						?>
						<tr>
							<td style="">
								<h2><a style="color: #134847 ; text-decoration: none;" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" target="_blank"><?php echo esc_html( $post->post_title ); ?></a></h2>
							</td>
						</tr>
						<tr>
							<td style="text-align: justify;">
								<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
							</td>
						</tr>
						<tr>
							<td style="font-size: smaller; padding: 0.5em 0em; padding-top: 1.0em; text-align: right;">
								<?php echo sprintf( __( "le %s, par <b>%s</b>", 'BTB' ), date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>
							</td>
						</tr>
						<tr>
							<td style="padding-bottom: 3.0em;">
								<a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" style="display: block; text-align: center; width: 150px; margin: 1.0em; padding: 0.5em 1.0em; color: #fff; background-color: #f0f0f9; border: 1px solid #134847; border-radius: 8px; font-weight: bold; margin: 0 auto; width: auto; border: 0; margin-top: 1.0em; color: #134847 ;" target="_blank"><?php echo __( "Lire la suite", 'BTB' ); ?></a>
							</td>
						</tr>
					<?php
						}
					?>
					</table>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td style="background: #134847; color: #fff; border-radius: 8px; font-size: smaller; padding: 1.0em; word-break: break-all; -ms-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;">
					<a href="<?php echo esc_url( trailingslashit( get_home_url() ) . '?unsubscribe=' . esc_attr( $account->address ) . '&id=' . $account->id . '&type=notification' ); ?>" style="display: block; text-align: center; width: 150px; margin: 1.0em; padding: 0.5em 1.0em; color: #fff; background-color: #f0f0f9; border: 1px solid #134847; border-radius: 8px; font-weight: bold; margin: 0 auto; width: 150px; background: #134847; border: 1px solid #ccc; margin-top: 1.0em; margin-bottom: 3.0em; color: #ddd;" target="_blank"><?php echo __( "ME DESINSCRIRE<br />DES NOTIFICATIONS", 'BTB' ); ?></a>
					<div style="text-align: center;"><?php echo esc_html( get_theme_mod( 'copyright', '' ) ); ?>&nbsp;|&nbsp;<a style="color: #ddd; text-decoration: none;" href="<?php echo esc_url( get_theme_mod( 'licence_url', '' ) ); ?>" target="_blank"><?php echo esc_html( get_theme_mod( 'licence', '' ) ); ?></a></div>
				</td>
			</tr>
		</table>









	</body>
</html>