<?php
	count_post_visits();
	verify_and_set_rating();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<?php if( WP_DEBUG ) { ?>
		<meta http-equiv="Pragma" content="no-cache" />
	    <meta http-equiv="Expires" content="-1" />
	    <?php } ?>

	    <meta charset="<?php bloginfo('charset'); ?>">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
	    <meta name="robots" content="index,follow" />
	    <link rel="profile" href="http://gmpg.org/xfn/11" />

	    <?php seo_get_heads(); ?>

		<?php wp_head(); ?>



		<script type="text/javascript">
			function timediff()
			{
				fin = ( new Date() ).getTime();
				secondes = ( fin - debut ) / 1000;
				document.getElementById( "chargement" ).innerHTML = secondes + " s";
			}
			function timeStamp() { return ( ( new Date() ).getTime() ); }

			debut = timeStamp();
		</script>

	</head>

	<body <?php body_class(); ?>>
	    <?php
			wp_body_open();

			seo_get_organizationcard_metadatas();
			seo_get_sitesearch_metadatas();
		?>
	    <header>
	        <div class="site-title">
	            <a href="<?php bloginfo( 'url' ); ?>" title="<?php echo __( 'Accueil du site', 'BTB' ); ?>"><?php bloginfo( 'name' ); ?></a>
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
	        <nav class="header-menu">

	            <div id="menu-toggle" class="toggle" onclick="toggleMenu()">
	                <i class="fas fa-bars" title="<?php echo __( 'Menu principal', 'BTB' ); ?>"></i>
	            </div>

				<div class="normal-search">
	            	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>" >
						<i class="fas fa-search"></i>
						<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo __( 'votre recherche ici', 'BTB' ) ?>" />
	            	</form>
	            </div>

	            <?php
	                wp_nav_menu( array(
	                    'theme_location' => 'main',
	                    'container' => 'ul',
	                    'menu_class' => 'menu',
	                    'menu_id' => 'menu-principal'
	                ) );
	            ?>

	        </nav>
	    </header>

	    <main>
	        <div class="content">
	        	<?php the_breadcrumb(); ?>