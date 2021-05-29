<?php

if( !defined( 'NEWSLETTER_FROM_EMAIL' ) )
	define( 'NEWSLETTER_FROM_EMAIL', sprintf( __( "%s - La lettre d'information <%s>", 'BTB' ), get_bloginfo( 'name' ), get_bloginfo( 'admin_email' ) ) );

if( !defined( 'SMTP_INTERVAL_LIMIT' ) )
	define( 'SMTP_INTERVAL_LIMIT', 300 ); // toutes les 5 minutes

if( !defined( 'SMTP_MAX_MAILS_INTERVAL' ) )
	define( 'SMTP_MAX_MAILS_INTERVAL', 30 ); // maximum 30 mails dans l'interval

if( !defined( 'NEWSLETTER_MONTH_DAY' ) )
	define( 'NEWSLETTER_MONTH_DAY', '01' ); // numéro du jour de départ de l'envoie de la newsletter sur 2 chiffres

if( !defined( 'NEWSLETTER_MONTH_TIME' ) )
	define( 'NEWSLETTER_MONTH_TIME', '01:00:00' ); // heure de départ de l'envoie de la newsletter (hh:mm:ss)


/*******************************************************************************
 * Init javascript variables for ajax security forms
 ******************************************************************************/
function javascript_variables() {
    echo '<script type="text/javascript">' . "\n";
    echo 'var ajax_url = "' . admin_url( 'admin-ajax.php' ) . '";' . "\n";
    echo 'var ajax_nonce = "' . wp_create_nonce( 'secure_nonce_newsletter' ) . '";' . "\n";
    echo '</script>' . "\n";
}
add_action ( 'wp_head', 'javascript_variables' );


/*******************************************************************************
 * Create ours custom intervals
 ******************************************************************************/
function newsletter_custom_schedule( $schedules ) {
    $schedules['every_newsletter_interval'] = array(
        'interval' => SMTP_INTERVAL_LIMIT,
        'display'  => __( 'Interval de la newsletter', 'BTB' ),
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'newsletter_custom_schedule' );


/*******************************************************************************
 * Init month cron job
 ******************************************************************************/
register_activation_hook( __FILE__, 'newsletter_month_cron_init' );
function newsletter_month_cron_init() {
	$hook = 'newsletter_every_month_cron_hook';
	$args = array( false );
	if( !wp_next_scheduled( $hook, $args ) ) {
		wp_schedule_single_event(
			strtotime( date( 'Y-m-' . NEWSLETTER_MONTH_DAY . ' ' . NEWSLETTER_MONTH_TIME, strtotime( 'next month' ) ) ),
			$hook,
			$args
		);
	}
}
add_action( 'newsletter_every_month_cron_hook', 'newsletter_every_month_cron_job' );


/*******************************************************************************
 * Init notification cron job
 ******************************************************************************/
register_activation_hook( __FILE__, 'newsletter_interval_cron_init' );
function newsletter_interval_cron_init() {
	$hook = 'newsletter_interval_cron_hook';
	$args = array( false );
	if( !wp_next_scheduled( $hook, $args ) ) {
		wp_schedule_event(
			time() + SMTP_INTERVAL_LIMIT,
			'every_newsletter_interval',
			$hook,
			$args
		);
	}
}
add_action( 'newsletter_interval_cron_hook', 'newsletter_interval_cron_job' );


/*******************************************************************************
 * Init notifications and newsletter service
 ******************************************************************************/
function newsletter_init() {
	global $wpdb;

	$query = "
            CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "btb_newsletter (
              id bigint(20) NOT NULL AUTO_INCREMENT,
              address text NOT NULL,
              type text NOT NULL,
              pending text NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $query );

	newsletter_interval_cron_init();
	newsletter_month_cron_init();
}
add_action( 'after_switch_theme', 'newsletter_init' );


/*******************************************************************************
 * Register new email address to notification or newsletter service
 ******************************************************************************/
function newsletter_register( $email, $type ) {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	global $wp_filesystem;
	global $wpdb;

	$email = sanitize_email( $email );
	$type = esc_attr( $type );
	$mail_type = $type;

	if( !is_email( $email ) ) {
        echo __( '[ERREUR] - Veuillez entrer une adresse email correcte!', 'BTB' );
        wp_die();
    }

    $datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE address = '$email' AND type LIKE '%$type%'" );
	if( $wpdb->num_rows > 0 ) {
		echo __( 'Votre adresse email est déjà enregistrée! Pour vous désabonner, rendez-vous au bas des emails que vous avez recus.', 'BTB' );
        wp_die();
	}

	$datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE address = '$email'" );
	$id = ( $wpdb->num_rows > 0 )
		? $datas[0]->id
		: 0;
	$type .= ( $wpdb->num_rows > 0 )
		? ' ' . $datas[0]->type
		: '';

	$sql = "INSERT INTO {$wpdb->prefix}btb_newsletter (id, address, type, pending) VALUES ($id, '$email', '$type', '') ON DUPLICATE KEY UPDATE address='$email', type='$type'";
	if( $wpdb->query( $sql ) === false ) {
		echo __( '[ERREUR] - Impossible d\'enregistrer votre adresse email', 'BTB' );
		wp_die();
	}

	$subject = sprintf( __( "[%s de %s] - Merci pour votre inscription!", 'BTB' ),
		ucwords( $mail_type ),
		get_bloginfo( 'name' )
	);

	$file = trailingslashit( get_template_directory() ) . 'template_newsletter_registered.html';
	$body = __( "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body><h3>%SITE_NAME% - %TYPE%</h3><br /><h4>Ce message indique que votre inscription a bien été prise en compte avec l'adresse email %EMAIL%.</h4><br /><span style='font-size:small;'>(Inutile de répondre à cette adresse email, celle-ci ne reçoit pas les courriers - Pour nous contacter veuillez utiliser le formulaire adéquat sur notre site que vous trouverez par le menu 'Nous contacter' - Merci de votre comphréhension)</span></body></html>", 'BTB' );

	$body = str_replace(
		array(
			'%SITE_NAME%',
			'%EMAIL%',
			'%TYPE%'
		),
		array(
			get_bloginfo( 'name' ),
			$email,
			ucwords( $mail_type )
		),
		$body
	);

	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	wp_mail( $email, $subject, $body, $headers );

	echo __( 'Merci pour votre inscription!', 'BTB' );
    wp_die();
}


/*******************************************************************************
 * Fire when an user register their email address for notifications
 ******************************************************************************/
function submit_notification_function() {
    check_ajax_referer( 'secure_nonce_newsletter', 'security' );
	newsletter_register( $_POST["email-notification-form"], 'notification' );
}
add_action( 'wp_ajax_submit_notification', 'submit_notification_function' );
add_action( 'wp_ajax_nopriv_submit_notification', 'submit_notification_function' );


/*******************************************************************************
 * Fire when an user register their email address for notifications
 ******************************************************************************/
function submit_newsletter_function() {
    check_ajax_referer( 'secure_nonce_newsletter', 'security' );
	newsletter_register( $_POST["email-newsletter-form"], 'newsletter' );
}
add_action( 'wp_ajax_submit_newsletter', 'submit_newsletter_function' );
add_action( 'wp_ajax_nopriv_submit_newsletter', 'submit_newsletter_function' );



/*******************************************************************************
 * Send HTML mail
 ******************************************************************************/
function newsletter_send_mail( $to, $subject, $content ) {
	$headers = array( "Content-Type: text/html; charset=UTF-8" );
	$headers[] = "From: " . NEWSLETTER_FROM_EMAIL;

	return wp_mail( $to, $subject, $content, implode( "\r\n", $headers ) );
}


/*******************************************************************************
 * Fire when new post published
 ******************************************************************************/
function newsletter_new_post( $new_status, $old_status, $post ) {
	if( is_wp_error( $post ) || !$post ) return;

	$post_type = get_post_type( $post->ID );
	if( $post_type == 'page' || $post_type == 'book' ) return;

    if( $old_status === 'publish' ) return;
	if( $new_status !== 'publish' ) return;

	$post_id = '[' . $post->ID . ']';

	global $wpdb;

	$datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE type LIKE '%notification%' AND pending NOT LIKE '%$post_id%'" );
	if( $wpdb->num_rows <= 0 )
		return;

	foreach( $datas as $account ) {
		$pending = $account->pending . $post_id;

		$sql = "UPDATE {$wpdb->prefix}btb_newsletter SET pending='$pending' WHERE id=" . $account->id;
		$wpdb->query( $sql );
	}
}
add_action( 'transition_post_status', 'newsletter_new_post', 10, 3 );


/*******************************************************************************
 * Fire every month
 ******************************************************************************/
function newsletter_every_month_cron_job() {

	if( is_writable( ABSPATH ) ) {
		$file = 'newsletter.html';

		if( file_exists( ABSPATH . $file ) ) {
			if( !is_writable( ABSPATH . $file ) )
				return;

			if( !@unlink( ABSPATH . $file ) )
				return;
		}

		$t = strtotime( '-1 month', time() );
		$prev_month_number = date_i18n( 'm', $t );
		$prev_year = date_i18n( 'o', $t );
		$prev_month_name = ucwords( date_i18n( 'F', $t ) );
		$prev_month_year_name = ucwords( date_i18n( 'F o', $t ) );

		$get_prev_month_posts = function( $type ) {
			$t = time();
			$timestamp = strtotime( '-1 month', $t );
			$year = date( 'o', $timestamp );
			$month = date( 'm', $timestamp );
			$mday = date( 't', $timestamp );
			$before_date = $year . '-' . $month . '-' . $mday;
			$after_date = $year . '-' . $month . '-01';

			return get_posts(
				array(
					'order_by'		=> 'date',
					'order'			=> 'DESC',
					'post_type'		=> $type,
					'date_query'	=> array(
						'before'	=> $before_date,
						'after'		=> $after_date,
						'inclusive' => true
					)
				)
			);
		};

		ob_start();
		include( get_template_directory() . '/newsletter_template.php' );
		$content = ob_get_contents();
		ob_end_clean();

		file_put_contents( ABSPATH . $file, $content );

		global $wpdb;
		$sql = "UPDATE {$wpdb->prefix}btb_newsletter SET pending=CONCAT( pending, '[newsletter]' ) WHERE type LIKE '%newsletter%' AND pending NOT LIKE '%[newsletter]%'";
		$wpdb->query( $sql );

	}

	newsletter_month_cron_init();
}


/*******************************************************************************
 * Update pending
 ******************************************************************************/
function newsletter_update_pending( $id, $pending ) {
	global $wpdb;
	$sql = "UPDATE {$wpdb->prefix}btb_newsletter SET pending='$pending' WHERE id=$id";
	return $wpdb->query( $sql );
}


/*******************************************************************************
 * Send notification for an account
 ******************************************************************************/
function newsletter_send_notifications( $account ) {
	global $newsletter_allowed_types;

	$new_pending = $account->pending;

	$matches = array();
	$result = preg_match_all('|\\[(\\d+)\\]|i', $new_pending, $matches, PREG_SET_ORDER);
	$list = array();
	foreach( $matches as $match ) {
		$id = intval( $match[1] );
		$list[] = $id;
		$new_pending = str_replace( '[' . $id . ']', '', $new_pending );
	}

	$notifications_posts = get_posts(
		array(
			'post__in'	=> $list,
			'order_by'	=> 'post__in',
			'post_type'	=> 'any'
		)
	);
	if( $notifications_posts !== false && count( $notifications_posts ) > 0 ) {

		ob_start();
		include( get_template_directory() . '/newsletter_notification_template.php' );
		$content = ob_get_contents();
		ob_end_clean();

		if( newsletter_send_mail( $account->address, __( 'Hey! De nouvelles publications sont disponibles!', 'BTB' ), $content ) )
			return $new_pending;

	}

	return $account->pending;
}


/*******************************************************************************
 * Send newsletter for an account
 ******************************************************************************/
function newsletter_send_newsletter( $account ) {
	$new_pending = str_replace( '[newsletter]', '', $account->pending );

	if( file_exists( ABSPATH . 'newsletter.html' ) ) {
		ob_start();
		include( ABSPATH . 'newsletter.html' );
		$content = ob_get_contents();
		ob_end_clean();

		if( newsletter_send_mail( $account->address, __( "Votre newsletter est arrivée! Récap' du mois dernier.", 'BTB' ), $content ) )
			return $new_pending;

	}

	return $account->pending;
}


/*******************************************************************************
 * Fire every newsletter interval
 ******************************************************************************/
function newsletter_interval_cron_job() {
	global $wpdb;

	$global_limits = intval( SMTP_MAX_MAILS_INTERVAL );

	// send notifications
	if( $global_limits > 0 ) {
		$datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE type LIKE '%notification%' AND pending NOT LIKE '' LIMIT " . $global_limits );
		if( $wpdb->num_rows > 0 ) {
			foreach( $datas as $account ) {
				if( $account->pending != '[newsletter]' ) {
					$pending = newsletter_send_notifications( $account );
					newsletter_update_pending( $account->id, $pending );
					$global_limits--;
				}
			}
		}
	}

	// send newsletter
	if( $global_limits > 0 ) {
		$datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE type LIKE '%newsletter%' AND pending LIKE '%[newsletter]%' LIMIT " . $global_limits );
		if( $wpdb->num_rows > 0 ) {
			foreach( $datas as $account ) {
				$pending = newsletter_send_newsletter( $account );
				newsletter_update_pending( $account->id, $pending );
				$global_limits--;
			}
		}
	}


}

/*******************************************************************************
 * Catch unsubscribe links
 ******************************************************************************/
function newsletter_unsubscribe() {
	if( isset( $_GET['unsubscribe'] )
		&& isset( $_GET['type'] )
		&& isset( $_GET['id'] ) ) {

		$email = trim( esc_html( $_GET['unsubscribe'] ) );
		$id = intval( $_GET['id'] );
		$type = strtolower( trim( $_GET['type'] ) );

		if( is_email( $email )
			&& $id > 0
			&& ( $type == 'notification' || $type == 'newsletter' ) ) {

			global $wpdb;
			$query = "SELECT * FROM {$wpdb->prefix}btb_newsletter WHERE id=$id AND LOWER(address)=LOWER('$email') AND type LIKE '%$type%'";
			$datas = $wpdb->get_results( $query );
			if( $wpdb->num_rows > 0 ) {
				$datas = $datas[0];

				$new_type = trim( str_replace( $type, '', $datas->type ) );

				if( $new_type == '' ) {
					$query = "DELETE FROM {$wpdb->prefix}btb_newsletter WHERE id=$id AND LOWER(address)=LOWER('$email')";
				} else {
					$new_pending = $datas->pending;
					switch( $type ) {
						case 'notification':
							if( stripos( $datas->pending, '[newsletter]' ) !== false )
								$new_pending = '[newsletter]';
							else
								$new_pending = '';

							break;
						case 'newsletter':
							$new_pending = trim( str_replace( '[newsletter]', '', $datas->pending ) );
							break;
					}
					$query = "UPDATE {$wpdb->prefix}btb_newsletter SET type='$new_type', pending='$new_pending' WHERE id=$id AND LOWER(address)=LOWER('$email')";
				}
				$result = $wpdb->query( $query );

				wp_die(
					( $result )
						? sprintf( __( "<span style='font-size: larger;'>Nous sommes si triste de vous annoncer la validation de votre désinscription au service <b>%s</b>.</span><br /><br />A bientôt sur le site de %s!", 'BTB' ), $type, get_bloginfo( 'name' ) )
						: __( "<span style='font-size: larger;'><b>Houston nous avons un problème!</b><br />Impossible de valider votre désinscription, surement dû à un problème technique.</span><br /><br />N'hésitez pas réessayer ultérieurement ou nous contacter au plus vite.", 'BTB' ),
					sprintf( __( "Désinscription du service: %s", 'BTB' ), $type ),
					array(
						'link_text'		=> __( "Retour à la page d'accueil", 'BTB' ),
						'link_url'		=> home_url()
					)
				);

			}
		}
	}

	if( isset( $_GET['ns_notifs'] ) ) {
		do_action( 'newsletter_interval_cron_hook' );
		die();
		exit();
	}
}
add_action( 'init', 'newsletter_unsubscribe' );



?>