<?php

/*******************************************************************************
 * ADD CUSTUM SETTINGS TO ADMIN THEME PANEL
 ******************************************************************************/
function btb_custom_settings( $wp_customize ) {

	$wp_customize->add_section( 'social',
		array(
			'title'       => __( 'Réseaux sociaux', 'BTB' ),
			'priority'    => 1,
			'capability'  => 'edit_theme_options',
			'description' => __('Définissez vos réseaux sociaux.', 'BTB')
		)
	);
	$wp_customize->add_section( 'legals',
		array(
			'title'       => __( 'Droits et légalité', 'BTB' ),
			'priority'    => 2,
			'capability'  => 'edit_theme_options',
			'description' => __('', 'BTB')
		)
	);
	$wp_customize->add_section( 'styles',
		array(
			'title'       => __( 'Apparences', 'BTB' ),
			'priority'    => 3,
			'capability'  => 'edit_theme_options',
			'description' => __('Ajuster l\'apparence du thème.', 'BTB')
		)
	);
	$wp_customize->add_section( 'posts',
		array(
			'title'       => __( 'Publications', 'BTB' ),
			'priority'    => 4,
			'capability'  => 'edit_theme_options',
			'description' => __('Les paramètres des publications.', 'BTB')
		)
	);
	$wp_customize->add_section( 'privacy',
		array(
			'title'       => __( 'Mentions légales', 'BTB' ),
			'priority'    => 6,
			'capability'  => 'edit_theme_options',
			'description' => __('Mentions légales et politique de confidentialité.', 'BTB')
		)
	);
	$wp_customize->add_section( 'sitemap',
		array(
			'title'       => __( 'Sitemap', 'BTB' ),
			'priority'    => 7,
			'capability'  => 'edit_theme_options',
			'description' => __('Paramètres Sitemap de votre site.', 'BTB')
		)
	);
	$wp_customize->add_section( 'seo',
		array(
			'title'       => __( 'SEO', 'BTB' ),
			'priority'    => 8,
			'capability'  => 'edit_theme_options',
			'description' => __('Paramètres SEO de votre site.', 'BTB')
		)
	);

	/*******************************************************************************
	 * SEO
	 ******************************************************************************/

	// MAIN SITE TITLE
	$wp_customize->add_setting( 'seo_site_title',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_seo_site_title',
		array(
			'label'      => __( 'Titre de la page d\'accueil (55 caractères max) - laisser vide pour utiliser le titre par defaut.', 'BTB' ),
			'settings'   => 'seo_site_title',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );

	// MAIN SITE DESCRIPTION
	$wp_customize->add_setting( 'seo_site_description',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_seo_site_description',
		array(
			'label'      => __( 'Description de la page d\'accueil (160 caractères max) - laisser vide pour utiliser la description par defaut.', 'BTB' ),
			'settings'   => 'seo_site_description',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );

	// FACEBOOK TAGS
	$wp_customize->add_setting( 'facebook_tags',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_facebook_tags',
		array(
			'label'      => __( 'Ajouter les balises sociales Facebook', 'BTB' ),
			'settings'   => 'facebook_tags',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// TWITTER TAGS
	$wp_customize->add_setting( 'twitter_tags',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_twitter_tags',
		array(
			'label'      => __( 'Ajouter les balises sociales Twitter', 'BTB' ),
			'settings'   => 'twitter_tags',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// GOOGLE CARD TAGS
	$wp_customize->add_setting( 'google_card_tags',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_google_card_tags',
		array(
			'label'      => __( 'Ajouter la carte de présentation d\'entreprise pour le référencement Google', 'BTB' ),
			'settings'   => 'google_card_tags',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// GOOGLE SEARCH TAGS
	$wp_customize->add_setting( 'google_search_tags',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_google_search_tags',
		array(
			'label'      => __( 'Demander la fonctionalité "Recherche de Site" pour le référencement Google', 'BTB' ),
			'settings'   => 'google_search_tags',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// ARTICLES METADATAS
	$wp_customize->add_setting( 'article_metadatas',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_article_metadatas',
		array(
			'label'      => __( 'Inclure les métadonnées dans les articles pour aider à leurs référencements', 'BTB' ),
			'settings'   => 'article_metadatas',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// IMAGES LAZY LOADING
	$wp_customize->add_setting( 'images_lazy_loading',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_images_lazy_loading',
		array(
			'label'      => __( 'Utiliser le chargement différé pour les images', 'BTB' ),
			'settings'   => 'images_lazy_loading',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// VIDEOS LAZY LOADING
	$wp_customize->add_setting( 'videos_lazy_loading',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_videos_lazy_loading',
		array(
			'label'      => __( 'Utiliser le chargement différé pour les vidéos', 'BTB' ),
			'settings'   => 'videos_lazy_loading',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// PRELOAD STYLES
	$wp_customize->add_setting( 'preload_styles',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_preload_styles',
		array(
			'label'      => __( 'Précharger les fichiers de styles', 'BTB' ),
			'settings'   => 'preload_styles',
			'type'       => 'checkbox',
			'section'    => 'seo',
		)
	) );

	// GOOGLE
	$wp_customize->add_setting( 'googleverif',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_googleverif',
		array(
			'label'      => __( 'Google Verification Code', 'BTB' ),
			'settings'   => 'googleverif',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );
	// GOOGLE ANAKYTICS
	$wp_customize->add_setting( 'googleanalytics',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_googleanalytics',
		array(
			'label'      => __( 'Google Analytics ID', 'BTB' ),
			'settings'   => 'googleanalytics',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );
	// BING
	$wp_customize->add_setting( 'bingverif',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_bingverif',
		array(
			'label'      => __( 'Bing Verification Code', 'BTB' ),
			'settings'   => 'bingverif',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );
	// YANDEX
	$wp_customize->add_setting( 'yandexverif',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_yandexverif',
		array(
			'label'      => __( 'Yandex Verification Code', 'BTB' ),
			'settings'   => 'yandexverif',
			'type'       => 'text',
			'section'    => 'seo',
		)
	) );

	/*******************************************************************************
	 * SOCIAL
	 ******************************************************************************/

	// FACBOOK
	$wp_customize->add_setting( 'facebook_url',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_facebook_url',
		array(
			'label'      => __( 'Facebook URL', 'BTB' ),
			'settings'   => 'facebook_url',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'facebook_label',
		array(
			'default'    =>  __( 'Nous retrouver sur Facebook', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_facebook_label',
		array(
			'label'      => __( 'Description du lien Facebook', 'BTB' ),
			'settings'   => 'facebook_label',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'facebook_username',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_facebook_username',
		array(
			'label'      => __( 'Nom d\'utilisateur Facebook, @...', 'BTB' ),
			'settings'   => 'facebook_username',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );

	// TWITTER
	$wp_customize->add_setting( 'twitter_url',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_twitter_url',
		array(
			'label'      => __( 'Twitter URL', 'BTB' ),
			'settings'   => 'twitter_url',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'twitter_label',
		array(
			'default'    =>  __( 'Nous retrouver sur Twitter', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_twitter_label',
		array(
			'label'      => __( 'Description du lien Twitter', 'BTB' ),
			'settings'   => 'twitter_label',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'twitter_username',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_twitter_username',
		array(
			'label'      => __( 'Nom d\'utilisateur Twitter, @...', 'BTB' ),
			'settings'   => 'twitter_username',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );

	// INSTAGRAM
	$wp_customize->add_setting( 'instagram_url',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_instagram_url',
		array(
			'label'      => __( 'Instagram URL', 'BTB' ),
			'settings'   => 'instagram_url',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'instagram_label',
		array(
			'default'    =>  __( 'Nous retrouver sur Instagram', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_instagram_label',
		array(
			'label'      => __( 'Description du lien Instagram', 'BTB' ),
			'settings'   => 'instagram_label',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'instagram_username',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_instagram_username',
		array(
			'label'      => __( 'Nom d\'utilisateur Instagram, @...', 'BTB' ),
			'settings'   => 'instagram_username',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );

	// YOUTUBE
	$wp_customize->add_setting( 'youtube_url',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_youtube_url',
		array(
			'label'      => __( 'YouTube', 'BTB' ),
			'settings'   => 'youtube_url',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );
	$wp_customize->add_setting( 'youtube_label',
		array(
			'default'    =>  __( 'Notre chaine YouTube', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_youtube_label',
		array(
			'label'      => __( 'Description du lien YouTube', 'BTB' ),
			'settings'   => 'youtube_label',
			'type'       => 'text',
			'section'    => 'social',
		)
	) );

	/*******************************************************************************
	 * LEGALS
	 ******************************************************************************/

	// COPYRIGHT
	$wp_customize->add_setting( 'copyright',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_copyright',
		array(
			'label'      => __( 'Copyright', 'BTB' ),
			'settings'   => 'copyright',
			'type'       => 'text',
			'section'    => 'legals',
		)
	) );

	// LICENCE
	$wp_customize->add_setting( 'licence',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_licence',
		array(
			'label'      => __( 'Licence', 'BTB' ),
			'settings'   => 'licence',
			'type'       => 'text',
			'section'    => 'legals',
		)
	) );
	$wp_customize->add_setting( 'licence_url',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_licence_url',
		array(
			'label'      => __( 'Licence URL', 'BTB' ),
			'settings'   => 'licence_url',
			'type'       => 'text',
			'section'    => 'legals',
		)
	) );

	/*******************************************************************************
	 * STYLES
	 ******************************************************************************/
	// DEFAULT THEME
	$wp_customize->add_setting( 'default_theme_id',
		array(
			'default'    =>  '4',
			'transport'  => 'refresh'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_default_theme_id',
		array(
			'label'      => __( 'Couleur du thème par défaut', 'BTB' ),
			'settings'   => 'default_theme_id',
			'section'    => 'styles',
			'type'		 => 'select',
			'choices' => array(
				'1' => __( 'Orange', 'BTB' ),
				'2' => __( 'Vert', 'BTB' ),
				'3' => __( 'Turquoise', 'BTB' ),
				'4' => __( 'Or', 'BTB' ),
				'5' => __( 'Fushia', 'BTB' ),
				'6' => __( 'Rouge', 'BTB' ),
				'7' => __( 'Bleu', 'BTB' )
			)
		)
	) );

	// HERO DECONSO MAIN COLOR
	$wp_customize->add_setting( 'hero_deconso_main_color',
		array(
			'default'    =>  '#670E10',
			'transport'  => 'refresh'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'ct_hero_deconso_main_color',
		array(
			'label'      => __( 'Couleur de la section Deconso', 'BTB' ),
			'settings'   => 'hero_deconso_main_color',
			'section'    => 'styles'
		)
	) );

	// HERO CUISINE MAIN COLOR
	$wp_customize->add_setting( 'hero_cuisine_main_color',
		array(
			'default'    =>  '#6A5022',
			'transport'  => 'refresh'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'ct_hero_cuisine_main_color',
		array(
			'label'      => __( 'Couleur de la section Cuisine', 'BTB' ),
			'settings'   => 'hero_cuisine_main_color',
			'section'    => 'styles'
		)
	) );

	// WIDE WIDTH
	$wp_customize->add_setting( 'wide_width',
		array(
			'default'    =>  '1440',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_wide_width',
		array(
			'label'      => __( 'Largeur maximum de la page en pixels', 'BTB' ),
			'settings'   => 'wide_width',
			'section'    => 'styles',
			'type'		 => 'number'
		)
	) );

	// BOXED WIDTH
	$wp_customize->add_setting( 'boxed_width',
		array(
			'default'    =>  '1152',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_boxed_width',
		array(
			'label'      => __( 'Largeur de la partie centrale en pixels', 'BTB' ),
			'settings'   => 'boxed_width',
			'section'    => 'styles',
			'type'		 => 'number'
		)
	) );

	/*******************************************************************************
	 * POSTS
	 ******************************************************************************/

	// VIEW TOC
	$wp_customize->add_setting( 'view_toc',
		array(
			'default'    =>  'true',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_view_toc',
		array(
			'label'      => __( 'Afficher un sommaire au début de chaque publications?', 'BTB' ),
			'settings'   => 'view_toc',
			'type'       => 'checkbox',
			'section'    => 'posts',
		)
	) );

	// DISPLAY VIEWS COUNTER ON POSTS
	$wp_customize->add_setting( 'display_views_counter_on_posts',
		array(
			'default'    =>  'false',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_display_views_counter_on_posts',
		array(
			'label'      => __( 'Afficher le nombre de vues dans les publications?', 'BTB' ),
			'settings'   => 'display_views_counter_on_posts',
			'type'       => 'checkbox',
			'section'    => 'posts',
		)
	) );

	// DISPLAY VIEWS COUNTER ON POST LISTS
	$wp_customize->add_setting( 'display_views_counter_on_post_list',
		array(
			'default'    =>  'false',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_display_views_counter_on_post_list',
		array(
			'label'      => __( 'Afficher le nombre de vues dans les listes de publications?', 'BTB' ),
			'settings'   => 'display_views_counter_on_post_list',
			'type'       => 'checkbox',
			'section'    => 'posts',
		)
	) );

	/*******************************************************************************
	 * PRIVACY
	 ******************************************************************************/

	// OWNER NAME
	$wp_customize->add_setting( 'owner_name',
		array(
			'default'    =>  __( '', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_owner_name',
		array(
			'label'      => __( 'Nom du propriétaire', 'BTB' ),
			'settings'   => 'owner_name',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// OWNER COUNTRY
	$wp_customize->add_setting( 'owner_country',
		array(
			'default'    =>  __( 'France', 'BTB' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_owner_country',
		array(
			'label'      => __( 'Pays du propriétaire', 'BTB' ),
			'settings'   => 'owner_country',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// OWNER EMAIL
	$wp_customize->add_setting( 'owner_email',
		array(
			'default'    =>  get_bloginfo( 'admin_email' ),
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_owner_email',
		array(
			'label'      => __( 'Email du propriétaire', 'BTB' ),
			'settings'   => 'owner_email',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// HOSTER NAME
	$wp_customize->add_setting( 'hoster_name',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_hoster_name',
		array(
			'label'      => __( 'Nom de l\'hébergeur', 'BTB' ),
			'settings'   => 'hoster_name',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// HOSTER COUNTRY
	$wp_customize->add_setting( 'hoster_country',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_hoster_country',
		array(
			'label'      => __( 'Pays de l\'hébergeur', 'BTB' ),
			'settings'   => 'hoster_country',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// HOSTER EMAIL
	$wp_customize->add_setting( 'hoster_email',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_hoster_email',
		array(
			'label'      => __( 'Email de l\'hébergeur', 'BTB' ),
			'settings'   => 'hoster_email',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	// HOSTER PHONE
	$wp_customize->add_setting( 'hoster_phone',
		array(
			'default'    =>  '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_hoster_phone',
		array(
			'label'      => __( 'Téléphone de l\'hébergeur', 'BTB' ),
			'settings'   => 'hoster_phone',
			'type'       => 'text',
			'section'    => 'privacy',
		)
	) );

	/*******************************************************************************
	 * SITEMAP
	 ******************************************************************************/

	// AUTO SITEMAP
	$wp_customize->add_setting( 'auto_sitemap',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_auto_sitemap',
		array(
			'label'      => __( 'Mettre à jour automatiquement le fichier "sitemap.xml"', 'BTB' ),
			'settings'   => 'auto_sitemap',
			'type'       => 'checkbox',
			'section'    => 'sitemap',
		)
	) );

	// AUTO NEWS SITEMAP
	$wp_customize->add_setting( 'auto_news_sitemap',
		array(
			'default'    =>  true,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_auto_news_sitemap',
		array(
			'label'      => __( 'Mettre à jour automatiquement le fichier "news-sitemap.xml" pour Google Actualités', 'BTB' ),
			'settings'   => 'auto_news_sitemap',
			'type'       => 'checkbox',
			'section'    => 'sitemap',
		)
	) );

	// MAIN SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_main_changefreq',
		array(
			'default'    => 'daily',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_main_changefreq',
		array(
			'label'      => __( 'Mise à jour de la section principale', 'BTB' ),
			'settings'   => 'section_main_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// MAIN SECTION PRIORITY
	$wp_customize->add_setting( 'section_main_priority',
		array(
			'default'    => '1.0',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_main_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_main_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

	// TAGS SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_tags_changefreq',
		array(
			'default'    => 'weekly',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_tags_changefreq',
		array(
			'label'      => __( 'Mise à jour des Etiquettes', 'BTB' ),
			'settings'   => 'section_tags_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// TAGS SECTION PRIORITY
	$wp_customize->add_setting( 'section_tags_priority',
		array(
			'default'    => '0.3',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_tags_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_tags_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

	// CATEGORIES SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_categories_changefreq',
		array(
			'default'    => 'weekly',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_categories_changefreq',
		array(
			'label'      => __( 'Mise à jour des Catégories', 'BTB' ),
			'settings'   => 'section_categories_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// CATEGORIES SECTION PRIORITY
	$wp_customize->add_setting( 'section_categories_priority',
		array(
			'default'    => '0.3',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_categories_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_categories_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

	// PAGE SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_pages_changefreq',
		array(
			'default'    => 'weekly',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_pages_changefreq',
		array(
			'label'      => __( 'Mise à jour des Pages', 'BTB' ),
			'settings'   => 'section_pages_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// PAGE POST SECTION PRIORITY
	$wp_customize->add_setting( 'section_pages_priority',
		array(
			'default'    => '0.5',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_pages_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_pages_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

	// POSTS SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_posts_changefreq',
		array(
			'default'    => 'weekly',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_posts_changefreq',
		array(
			'label'      => __( 'Mise à jour des Publications', 'BTB' ),
			'settings'   => 'section_posts_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// POSTS POST SECTION PRIORITY
	$wp_customize->add_setting( 'section_posts_priority',
		array(
			'default'    => '0.8',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_posts_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_posts_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

	// BOOKS SECTION CHANGEFREQ
	$wp_customize->add_setting( 'section_books_changefreq',
		array(
			'default'    => 'weekly',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_books_changefreq',
		array(
			'label'      => __( 'Mise à jour de la Bibliothèque', 'BTB' ),
			'settings'   => 'section_books_changefreq',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'always' => __( 'Toujours', 'BTB' ),
				'hourly' => __( 'Toutes les heures', 'BTB' ),
				'daily' => __( 'Quotidiennement', 'BTB' ),
				'weekly' => __( 'Toutes les semaines', 'BTB' ),
				'monthly' => __( 'Mensuellement', 'BTB' ),
				'yearly' => __( 'Tous les ans', 'BTB' ),
				'never' => __( 'Jamais', 'BTB' ),
			)
		)
	) );
	// BOOKS POST SECTION PRIORITY
	$wp_customize->add_setting( 'section_books_priority',
		array(
			'default'    => '0.5',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ct_section_books_priority',
		array(
			'label'      => __( '', 'BTB' ),
			'settings'   => 'section_books_priority',
			'type'       => 'select',
			'section'    => 'sitemap',
			'choices' => array(
				'0.0' => __( 'Priorité: 0.0 - Aucune', 'BTB' ),
				'0.1' => __( 'Priorité: 0.1 - Très faible', 'BTB' ),
				'0.2' => __( 'Priorité: 0.2', 'BTB' ),
				'0.3' => __( 'Priorité: 0.3 - Faible', 'BTB' ),
				'0.4' => __( 'Priorité: 0.4', 'BTB' ),
				'0.5' => __( 'Priorité: 0.5 - Moyenne', 'BTB' ),
				'0.6' => __( 'Priorité: 0.6', 'BTB' ),
				'0.7' => __( 'Priorité: 0.7 - Importante', 'BTB' ),
				'0.8' => __( 'Priorité: 0.8', 'BTB' ),
				'0.9' => __( 'Priorité: 0.9 - Très importante', 'BTB' ),
				'1.0' => __( 'Priorité: 1.0 - Cruciale', 'BTB' ),
			)
		)
	) );

}
add_action( 'customize_register', 'btb_custom_settings' );

/*******************************************************************************
 * PLAY WITH CUSTOM THEME COLORS
 ******************************************************************************/
function get_custom_theme( $id ) {
	$th = [];

	switch( intval( $id ) ) {
		case 2: // green
			$th['name'] = __( 'Vert', 'BTB' );
			$th['main_color'] = '#00a50d';
			$th['breadcrumb_backcolor'] = '#fafff9';
			$th['site_title_hover_color'] = '#00a50d';
			$th['hero_main_color'] = '#354A05';
			break;
		case 3: // dark green
			$th['name'] = __( 'Turquoise', 'BTB' );
			$th['main_color'] = '#008767';
			$th['breadcrumb_backcolor'] = '#edf2f1';
			$th['site_title_hover_color'] = '#008767';
			$th['hero_main_color'] = '#354A05';
			break;
		case 4: // gold
			$th['name'] = __( 'Or', 'BTB' );
			$th['main_color'] = '#827700';
			$th['breadcrumb_backcolor'] = '#f9f8f2';
			$th['site_title_hover_color'] = '#827700';
			$th['hero_main_color'] = '#354A05';
			break;
		case 5: // purple
			$th['name'] = __( 'Fushia', 'BTB' );
			$th['main_color'] = '#930049';
			$th['breadcrumb_backcolor'] = '#f4edf3';
			$th['site_title_hover_color'] = '#930049';
			$th['hero_main_color'] = '#354A05';
			break;
		case 6: // dark red
			$th['name'] = __( 'Rouge', 'BTB' );
			$th['main_color'] = '#ad0005';
			$th['breadcrumb_backcolor'] = '#f7f2f2';
			$th['site_title_hover_color'] = '#ad0005';
			$th['hero_main_color'] = '#354A05';
			break;
		case 7: // blue
			$th['name'] = __( 'Bleu', 'BTB' );
			$th['main_color'] = '#0069af';
			$th['breadcrumb_backcolor'] = '#f9fbff';
			$th['site_title_hover_color'] = '#0069af';
			$th['hero_main_color'] = '#354A05';
			break;
		default: // orange
			$th['name'] = __( 'Orange', 'BTB' );
			$th['main_color'] = '#d84800';
			$th['breadcrumb_backcolor'] = '#fffdf9';
			$th['site_title_hover_color'] = '#d84800';
			$th['hero_main_color'] = '#354A05';
			break;
	}

	return $th;
}

function set_cookie_theme( $theme_id ) {
	$theme = get_custom_theme( $theme_id );

	setcookie( 'btb_custom_style[name]', $theme['name'], time() + 31556926 );
	setcookie( 'btb_custom_style[main_color]', $theme['main_color'], time() + 31556926 );
	setcookie( 'btb_custom_style[breadcrumb_backcolor]', $theme['breadcrumb_backcolor'], time() + 31556926 );
	setcookie( 'btb_custom_style[site_title_hover_color]',  $theme['site_title_hover_color'], time() + 31556926 );
	setcookie( 'btb_custom_style[hero_main_color]',  $theme['hero_main_color'], time() + 31556926 );
}

function get_default_theme_id() {
	return intval( get_theme_mod( 'default_theme_id', '1' ) );
}

function get_cookie_theme() {
	$th = get_custom_theme( get_default_theme_id() );

	if( isset( $_COOKIE['btb_custom_style'] ) ) {
		if( isset( $_COOKIE['btb_custom_style']['name'] ) )
			$th['name'] = $_COOKIE['btb_custom_style']['name'];

		if( isset( $_COOKIE['btb_custom_style']['main_color'] ) )
			$th['main_color'] = $_COOKIE['btb_custom_style']['main_color'];

		if( isset( $_COOKIE['btb_custom_style']['breadcrumb_backcolor'] ) )
			$th['breadcrumb_backcolor'] = $_COOKIE['btb_custom_style']['breadcrumb_backcolor'];

		if( isset( $_COOKIE['btb_custom_style']['site_title_hover_color'] ) )
			$th['site_title_hover_color'] = $_COOKIE['btb_custom_style']['site_title_hover_color'];

		if( isset( $_COOKIE['btb_custom_style']['hero_main_color'] ) )
			$th['hero_main_color'] = $_COOKIE['btb_custom_style']['hero_main_color'];
	}

	return $th;
}

function btb_customize_css()
{
	if( isset( $_GET['sc'] ) ) {
		set_cookie_theme( $_GET['sc'] );
		wp_redirect( home_url() );
		exit;
	}

	$custom_options = get_cookie_theme();
	?>
		 <style type="text/css">
			:root {
				--wide-width: <?php echo get_theme_mod( 'wide_width', '1440' ); ?>px;
				--boxed-width: <?php echo get_theme_mod( 'boxed_width', '1152' ); ?>px;
				/* Themed colors - <?php echo $custom_options['name']; ?> */
				--main-color: <?php echo $custom_options['main_color']; ?>;
				--breadcrumb-backcolor: <?php echo $custom_options['breadcrumb_backcolor']; ?>;
				--site-title-hover-color: <?php echo $custom_options['site_title_hover_color']; ?>;
				--hero-main-color: <?php echo $custom_options['hero_main_color']; ?>;
				/* Custom colors -*
				--deconso-main-color: <?php echo get_theme_mod( 'hero_deconso_main_color', '#670E10' ); ?>;
				--cuisine-main-color: <?php echo get_theme_mod( 'hero_cuisine_main_color', '#6A5022' ); ?>;
			}
		 </style>
	<?php
}
add_action( 'wp_head', 'btb_customize_css');

?>