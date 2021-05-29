	        </div>
	        <!-- fin section content -->
	        <?php if( is_home() || is_front_page() || is_single() ) { ?>
	        <div class="newsletter" id="newsletter">
	        	<a id="newsletterShowHideLink" href="javascript: void(0);" onclick="newsletterToggle();" title="<?php echo __( 'Afficher / Réduire', 'BTB' ); ?>">
		        	<div class="title">
		        		<?php echo sprintf( __( '%s, au plus près de vous.', 'BTB' ), get_bloginfo( 'name' ) ); ?>
		        		<span><?php echo __( 'Restez informé!', 'BTB' ); ?></span>
		        	</div>
		        	<div class="button">
	        			<i class="fas fa-arrow-alt-circle-down"></i><span><?php echo __( 'Afficher / Réduire', 'BTB' ); ?></span>
		        	</div>
	        	</a>
	        	<div class="columns">
	        		<div class="column column50">
	        			<div class="column-title home"><?php echo __( 'Être notifié à chaque nouvelle publication', 'BTB' ); ?></div>
	        			<div class="subtitle">
	        				<?php echo __( "Surfer sur la toile prend beaucoup de temps et nous passons souvent à coté d'informations qui nous interresseraient, c'est pourquoi nous vous proposons d'envoyer une notification directement dans votre boite mail à chaque nouvelle publication!", 'BTB' );  ?>
	        			</div>
	        			<div class="response" id="notification-response"></div>
	        			<div class="content" id="notification-content">
	        				<form action="" method="post" name="notification-form">
	        					<input type="email" name="email-notification-form" placeholder="<?php echo __( 'votre adresse email', 'BTB' ); ?>" autocomplete="off" required />
	        					<input type="hidden" name="action" value="submit_notification" style="display: none; visibility: hidden; opacity: 0;" />
	        					<input type="submit" value="<?php echo __( 'je veux', 'BTB' ); ?>" />
	        				</form>
	        			</div>
	        		</div>
	        		<div class="column column50">
	        			<div class="column-title home"><?php echo __( 'Recevoir la newsletter mensuelle', 'BTB' ); ?></div>
	        			<div class="subtitle">
	        				<?php echo __( "Mensuellement, nous vous offrons la liste des publications du mois passé sous forme d'une newsletter directement dans votre boite mail. Si vous êtes interressés, entrez votre adresse mail dans la zone de texte si dessous.", 'BTB' );  ?>
	        			</div>
	        			<div class="response" id="newsletter-response"></div>
	        			<div class="content" id="newsletter-content">
	        				<form action="" method="post" name="newsletter-form">
	        					<input type="email" name="email-newsletter-form" placeholder="<?php echo __( 'votre adresse email', 'BTB' ); ?>" autocomplete="off" required />
								<input type="hidden" name="action" value="submit_newsletter" style="display: none; visibility: hidden; opacity: 0;" />
								<input type="submit" value="<?php echo __( 'je veux', 'BTB' ); ?>" />
	        				</form>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	        <?php } ?>
	    </main>

        <footer>

            <hr class="space" />
            <div class="boxed" style="background: transparent; font-size: 0.9em;">
                <div class="article-list-header">
                    <div class="article-list-title" style="margin-top: 0; margin-bottom: 0; padding: 0;">
                        <h2 style="margin-top: 0; margin-bottom: 0; padding: 0;"><?php echo __( 'Les meilleures publications du moment', 'BTB' ); ?></h2>
                    </div>
                    <div class="article-list-numbers">
                    	<?php echo __( 'Elles vous ont attirées, marquées et fait réagir', 'BTB' ); ?>
                    </div>
                </div>
                <?php get_template_part( 'parts/best-posts-3-columns' ); ?>
                <?php get_template_part( 'parts/taxomany-2-columns' ); ?>
                <?php get_template_part( 'parts/archive-by-3-columns' ); ?>
            </div>
            <hr class="space" />

            <div class="footer-box">

				<div class="site-style">
					<b><?php echo __( 'Et si le site vous ressemblait? Choisissez votre couleur!', 'BTB' ); ?></b><br />
					<?php for( $color_no = 1; $color_no <= 7; $color_no++) { $theme = get_custom_theme( $color_no ); ?>
						<a href="<?php echo esc_url( add_query_arg( 'sc', strval( $color_no ), home_url() . '/' ) ); ?>" title="<?php echo $theme['name']; ?>" style="<?php echo sprintf( 'background: %s;', $theme['main_color'] ); ?>">&nbsp;</a>
					<?php } ?>
				</div>

				<hr class="space" />
				<hr />
				<hr class="space" />

                <div class="site-title">
                    <a href="<?php bloginfo( 'url' ); ?>" title="<?php echo __( 'Accueil du site', 'BTB' ); ?>"><?php bloginfo( 'name' ); ?></a>
                </div>

				<div class="site-social">
					<a href="<?php echo trailingslashit( home_url( 'feed' ) ); ?>" target="_blank" title="<?php echo __( 'Articles et analyses en RSS', 'BTB' ); ?>"><i class="fas fa-rss zoom-effect"></i><span style="font-size:small;"><?php echo __( 'Articles', 'BTB' ); ?></span></a>
                    <a href="<?php echo trailingslashit( home_url( 'actu/feed' ) ); ?>" target="_blank" title="<?php echo __( 'Notre regard sur l\'actu en RSS', 'BTB' ); ?>"><i class="fas fa-rss zoom-effect"></i><span style="font-size:small;"><?php echo __( 'Actu', 'BTB' ); ?></span></a>
                    <a href="<?php echo trailingslashit( home_url( 'news/feed' ) ); ?>" target="_blank" title="<?php echo __( 'En bref et en RSS', 'BTB' ); ?>"><i class="fas fa-rss zoom-effect"></i><span style="font-size:small;"><?php echo __( 'En bref', 'BTB' ); ?></span></a>
                    <a href="<?php echo trailingslashit( home_url( 'comments/feed' ) ); ?>" target="_blank" title="<?php echo __( 'Tous les commentaires au même endroit', 'BTB' ); ?>"><i class="fas fa-rss zoom-effect"></i><span style="font-size:small;"><?php echo __( 'Commentaires', 'BTB' ); ?></span></a>
				</div>

                <div class="site-social">

                    <?php if( get_theme_mod( 'facebook_url' ) ) : ?>
                        <a href="<?php echo get_theme_mod( 'facebook_url' ); ?>" target="_blank" title="<?php echo get_theme_mod( 'facebook_label' ); ?>"><i class="fab fa-facebook-f zoom-effect"></i></a>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'twitter_url' ) ) : ?>
                        <a href="<?php echo get_theme_mod( 'twitter_url' ); ?>" target="_blank" title="<?php echo get_theme_mod( 'twitter_label' ); ?>"><i class="fab fa-twitter zoom-effect"></i></a>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'instagram_url' ) ) : ?>
                        <a href="<?php echo get_theme_mod( 'instagram_url' ); ?>" target="_blank" title="<?php echo get_theme_mod( 'instagram_label' ); ?>"><i class="fab fa-instagram zoom-effect"></i></a>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'youtube_url' ) ) : ?>
                        <a href="<?php echo get_theme_mod( 'youtube_url' ); ?>" target="_blank" title="<?php echo get_theme_mod( 'youtube_label' ); ?>"><i class="fab fa-youtube zoom-effect"></i></a>
                    <?php endif; ?>

                </div>

                <div class="site-slogan"><?php bloginfo( 'description' ); ?></div>

                <div class="footer-copyright">
                	<?php echo get_theme_mod( 'copyright' ); ?> - <a href="<?php echo get_theme_mod( 'licence_url' ); ?>" target="_blank" title="<?php echo get_theme_mod( 'licence' ); ?>"><?php echo get_theme_mod( 'licence' ); ?></a> - <a href="<?php echo get_privacy_policy_url(); ?>" title="<?php echo __( 'Mentions légales', 'BTB' ); ?>" target="_blank"><?php echo __( 'Mentions légales', 'BTB' ); ?></a>
                	<div style="width:100%;text-align:center;  margin-top: 1.0em;">
                		<?php echo sprintf( '%s %s', __( 'Page affichée en', 'BTB' ), '<span id="chargement">...</span>' ); ?>
                	</div>
                </div>

            </div>

        </footer>

        <?php wp_footer(); ?>

        <script type="text/javascript">
			window.onload = timediff;
		</script>





		<link rel="preload stylesheet" as="style" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
		<script>
			window.cookieconsent.initialise({
			  "palette": {
				"popup": {
				  "background": "var( --main-color, #739B11 )"
				},
				"button": {
				  "background": "#f1d600"
				}
			  },
			  "theme": "edgeless",
			  "position": "bottom-right",
			  "type": "opt-out",
			  "content": {
				"message": "Ce site Internet utilise les Cookies pour améliorer votre confort de naviguation. Ils permettent de mémoriser ses informations pour les futurs commentaires mais aussi de mémoriser vos choix ergonomiques quand à l'apparence du site web.",
				"dismiss": "Tout accepter",
				"deny": "Refuser",
				"link": "En savoir plus",
				"href": "<?php echo get_privacy_policy_url(); ?>"
			  }
			});
		</script>

    </body>
</html>