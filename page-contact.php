<?php

	$form = array(
		'author' => array( 'value' => '', 'error' => '' ),
		'email' => array( 'value' => '', 'error' => '' ),
		'message' => array( 'value' => '', 'error' => '' ),
		'error'	=> false,
		'captcha' => true,
		'success' => false
	);
	if( isset( $_POST['formtype'] ) && $_POST['formtype'] == 'contact' ) {

		$form['captcha'] = apply_filters( 'google_invre_is_valid_request_filter', true );
		$form['author']['value'] = htmlspecialchars( stripslashes( trim( $_POST['author'] ) ) );
		$form['email']['value'] = htmlspecialchars( stripslashes( trim( $_POST['email'] ) ) );
		$form['message']['value'] = htmlspecialchars( stripslashes( trim( $_POST['message'] ) ) );

		if( empty( $form['author']['value'] ) )
			$form['author']['error'] = __( 'Votre nom est requis!', 'BTB' );
		if( !preg_match( "/^[A-Za-z .'-]+$/", $form['author']['value'] ) )
			$form['author']['error'] = __( 'Nom incorrect.', 'BTB' );

		if( empty( $form['email']['value'] ) )
			$form['email']['error'] = __( 'Votre adresse email est requise!', 'BTB' );
		if( !filter_var( $form['email']['value'], FILTER_VALIDATE_EMAIL ) )
			$form['email']['error'] = __( 'Adresse email incorrecte.', 'BTB' );

		if( empty( $form['message']['value'] ) )
			$form['message']['error'] = __( 'Votre message est requis! C\'est le but non?', 'BTB' );

		$form['error'] = ( !$form['captcha']
							|| !empty( $form['author']['error'] )
							|| !empty( $form['email']['error'] )
							|| !empty( $form['message']['error'] ) );

		if( !$form['error'] ) {
			$to = get_bloginfo( 'admin_email' );
			$subject = sprintf( '[%s] %s',
								get_bloginfo( 'name' ),
								__( 'Un lecteur vous a contacté par le formulaire du site.', 'BTB' )
						);
			$message = sprintf( '<b>%s</b>: %s<br /><b>%s</b>: %s<br /><br /><b>%s</b>: %s<br /><br /><b>%s</b>: %s<br /><b>%s</b>: %s<br />',
							__( 'Identité du lecteur', 'BTB'), $form['author']['value'],
							__( 'Adresse email du lecteur', 'BTB'), $form['email']['value'],
							__( 'Message', 'BTB'), $form['message']['value'],
							__( 'Adresse IP', 'BTB'), get_the_user_ip(),
							__( 'Date et heure GMT', 'BTB'), date_i18n( DATE_RFC3339, current_datetime( 'timestamp', 1 ) )
						);

			function set_html_content_type() { return 'text/html'; }
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );

			$form['success'] = wp_mail( $to, $subject, $message, array('Content-Type: text/html; charset=UTF-8') );
			if( $form['success'] ) {
				$form['captcha'] = true;
				$form['error'] = false;
				$form['author'] = array( 'value' => '', 'error' => '' );
				$form['email'] = array( 'value' => '', 'error' => '' );
				$form['message'] = array( 'value' => '', 'error' => '' );
			} else {
				$form['error'] = true;
			}

			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
		}
	}

	get_header();

	$page = get_page_by_path( 'contact', 'OBJECT', 'page' );
	$page_title = get_the_title( $page->ID );
?>

<div class="boxed">

    <div class="article-list-header bottom-separator" style="margin-top:1.0em;">

        <div class="article-list-title">
            <h1>
            	<?php echo $page_title; ?>
            </h1>
		</div>

        <div class="article-list-numbers">
        	<?php echo __( "Un besoin, une envie de nous parler ? Un désir d’expression, ou un partage d’opinion ?", 'BTB' ); ?>
		</div>

    </div>

</div>

<?php
    if (have_posts()) :
        while (have_posts()) : the_post();
?>

	<div class="wide">
		<article>
			<?php if( has_post_thumbnail() ) { ?>
				<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
					<div class="thumbnail-box">
						<?php the_post_thumbnail( 'top-wide' ); ?>
					</div>
				</a>
			<?php } else { ?>
				<div class="thumbnail-box">
					<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width: 100%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-contact.jpg" />
				</div>
			<?php } ?>
			<div class="article-content">
				<div class="boxed boxedmerge">
					<?php
						global $page, $numpages, $multipage, $more;
						if( $multipage ) {
					?>
					<div class="article-pagination">
						<?php
							echo sprintf(
								'%s %s <span style="font-size:small;">/ %s</span>',
								__( 'page', 'BTB' ),
								$page,
								$numpages
							);
						?>
					</div>
					<div style="height:48px;"></div>
					<?php
						}
					?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<div id="contact" class="comment-respond">
						<h3 id="reply-title" class="comment-reply-title"><?php echo __( 'Utilisez le formulaire ci-dessous et nous vous recontacterons rapidement !', 'BTB' ); ?></h3>
						<form action="<?php echo wp_get_referer(); ?>" method="post" id="contactform" class="comment-form">

								<?php if( $form['error'] && ( !$form['captcha'] || !empty( $form['author']['error'] ) || !empty( $form['email']['error'] ) || !empty( $form['message']['error'] ) ) ) : ?>
									<p class="form-error"><?php echo __( 'Le formulaire contient une erreur! Veuillez vérifier vos informations.', 'BTB' ); ?></p>
								<?php endif; ?>
								<?php if( $form['error'] && $form['captcha'] && empty( $form['author']['error'] ) && empty( $form['email']['error'] ) && empty( $form['message']['error'] ) ) : ?>
									<p class="form-error"><?php echo __( 'Une erreur s\'est produite. Votre message n\'a pas été envoyé!', 'BTB' ); ?></p>
								<?php endif; ?>
								<?php if( !$form['captcha'] ) : ?>
									<p class="form-error"><?php echo __( 'Google reCaptcha incorrect!', 'BTB' ); ?></p>
								<?php endif; ?>
								<?php if( $form['success'] ) : ?>
									<p class="form-success"><?php echo __( 'Votre message a bien été envoyé! Nous vous répondrons au plus vite.', 'BTB' ); ?></p>
								<?php endif; ?>

								<div class="columns" style="margin:0;padding:0;margin-top:2.0em;justify-content:space-between;">
									<div class="column column50" style="margin:0;padding:0;">
										<p class="comment-form-author">
											<label for="author"><?php echo __( 'Votre nom et prénom', 'BTB' ); ?> <span class="required">*</span></label>
											<input id="author" name="author" type="text" value="<?php echo $form['author']['value']; ?>" size="30" maxlength="245" required='required' />
										</p>
										<?php if( !empty( $form['author']['error'] ) ) : ?>
											<p class="form-error"><?php echo $form['author']['error']; ?></p>
										<?php endif; ?>
									</div>
									<div class="column column50" style="margin:0;padding:0;">
										<p class="comment-form-email">
											<label for="email"><?php echo __( 'Adresse de messagerie', 'BTB' ); ?> <span class="required">*</span></label>
											<input id="email" name="email" type="email" value="<?php echo $form['email']['value']; ?>" size="30" maxlength="100" required='required' />
										</p>
										<?php if( !empty( $form['email']['error'] ) ) : ?>
											<p class="form-error"><?php echo $form['email']['error']; ?></p>
										<?php endif; ?>
									</div>
								</div>

							<p class="comment-form-message">
								<label for="comment"><?php echo __( 'Votre message', 'BTB' ); ?> <span class="required">*</span></label>
								<textarea id="comment" name="message" cols="45" rows="8" maxlength="65525" required="required"><?php echo $form['message']['value']; ?></textarea>
							</p>
							<span class="comment-note"><?php echo __( 'Balises HTML ou autres non acceptées.', 'BTB' ); ?></span>
							<?php if( !empty( $form['message']['error'] ) ) : ?>
								<p class="form-error"><?php echo $form['message']['error']; ?></p>
							<?php endif; ?>

							<p class="form-submit">
								<input name="submit" type="submit" id="submit" class="submit" value="<?php echo __( 'Envoyer le message', 'BTB' ); ?>" />
							</p>

							<input type="hidden" name="formtype" value="contact" />

							<div class="inv-recaptcha-holder"></div>
						</form>
					</div>

				</div>
			</div>
		</article>
	</div> <!-- fin section wide -->

<?php
        endwhile;
	endif;

	if( $multipage ) {
		echo '<div class="boxed">';
		wp_link_pages();
		echo '</div>';
	}

?>

<?php
	get_footer();
?>