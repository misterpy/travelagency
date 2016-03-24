<?php

if (!defined('ABSPATH')) {
	exit;
}

/* =============================================================
* TABLE OF CONTENTS - INCLUDES/ADMIN/THEME-CUSTOMIZER.PHP
*
* - __construct
* - Initialize Output Theme Mods
* - Remove Unused Native Section
* - Customizer Manager Init
*
================================================================ */

class DF_theme_customizer {

	static $instance;

	public $prefix = 'df_customizer_';
	private $suffix;

	public function __construct () {
    self::$instance =& $this;

		$this->suffix = dahz_get_min_suffix();

  		add_action( 'after_setup_theme', array( $this, '_load_customizer' ) );
  }


	function _load_customizer(){
		require_once CUSTOMIZER_DIR . 'typography.php';
		add_action( 'customize_register', array( $this, 'df_register_theme_customizer'  ), 100 );
		add_action( 'customize_register', array( $this, 'df_add_remove_customizer_sections' ), 100 );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'df_enqueue_customizer_admin_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'df_enqueue_customizer_admin_preview_scripts' ) );
	}


	/**
	 * Get Panel Customizer
	 * @return array
	 */
	private function customizer_get_panel(){
		$panels = array(
			'header'  => array( 'name' => 'header_panel', 'title' => 'Header', 'priority' => 10, 'sections' => array(
						// Panel: Header
						/* Section : Topbar */
						'topbar' => array('name' => 'topbar_section', 'title' => _x('Topbar', 'backend customizer', 'backend_dahztheme'), 'priority' => 5),
						/* Section : Logo Setting */
						'logo' => array('name' => 'logo_section', 'title' => _x('Logo', 'backend customizer', 'backend_dahztheme'), 'priority' => 10),
						/* Section : Navbar */
						'navbar' => array('name' => 'navbar_section', 'title' => _x('Navbar', 'backend customizer', 'backend_dahztheme'), 'priority' => 15),
						/* Section : Navbar Transparency */
						'navbar_transparency' => array('name' => 'navbar_transparency_section', 'title' => _x('Transparency', 'backend customizer', 'backend_dahztheme'), 'priority' => 20),
						/* Section : Sticky */
						'navbar_sticky' => array('name' => 'navbar_sticky_section', 'title' => _x('Sticky', 'backend customizer', 'backend_dahztheme'), 'priority' => 25),
						/* Section : Miscellaneous */
						'navbar_miscellaneous_section' => array('name' => 'navbar_miscellaneous_section', 'title' => _x('Miscellaneous', 'backend customizer', 'backend_dahztheme'), 'priority' => 30),
						/* Section : Page Title */
						'pagetitle' => array('name' => 'pagetitle_section', 'title' => _x('Page Title', 'backend customizer', 'backend_dahztheme'), 'priority' => 35)
						)
			),
			'content' => array('name' => 'content_panel', 'title' => 'Content', 'priority' => 20, 'sections' => array(
					// Panel: Content
					/* Section : Outer Area */
					'outer_area' => array('name' => 'outer_area_section', 'title' => _x('Outer Area', 'backend customizer','backend_dahztheme'), 'priority'	=> 0),
					/* Section : Content Area */
					'content_area' => array('name' => 'content_area_section', 'title'	=> _x('Content Area', 'backend customizer','backend_dahztheme'), 'priority'	=> 10),
					/* Section : Typography */
					'typo' => array('name' => 'typo_section', 'title'	=> _x('Typography', 'backend customizer','backend_dahztheme'),'priority' => 20)

						)
			),
			'footer' => array('name' => 'footer_panel', 'title' => 'Footer', 'priority' => 30, 'sections' => array(
					// Panel: Footer
					/* Section : Widget Footer */
					'primary' => array('name' => 'primary_section', 'title' => _x('Primary Footer', 'backend customizer', 'backend_dahztheme'), 'priority' => 5),
					/* Section : Copyright Footer */
					'copyright' => array('name' => 'copyright_section', 'title' => _x('Copyright Footer', 'backend customizer', 'backend_dahztheme'), 'priority' => 10)
						)
			),
			'blog' => array('name' => 'blog_panel', 'title' => 'Blog', 'priority' => 50, 'sections' => array(
					// Panel: Blog
					/* Section : Featured Slider */
					'featslider' => array('name' => 'featslider_section', 'title' => _x('Featured Slider', 'backend customizer', 'backend_dahztheme'), 'priority' => 0),
					/* Section : Layout */
					'layout' => array('name' => 'layout_section', 'title' => _x('Layout', 'backend customizer', 'backend_dahztheme'), 'priority' => 10),
					/* Section : Single Blog */
					'singleblog' => array('name' => 'singleblog_section', 'title' => _x('Single Blog', 'backend customizer', 'backend_dahztheme'), 'priority'=> 20),
					/* Section : Archive */
					'archive' => array('name' => 'archive_section', 'title' => _x('Archive', 'backend customizer', 'backend_dahztheme'), 'priority' => 30),
					/* Section : Share */
					'share' => array('name' => 'share_section', 'title' => _x('Share', 'backend customizer', 'backend_dahztheme'), 'priority'	=> 40)
						)
			),
			'misc' => array('name' => 'misc_panel', 'title' => 'Misc', 'priority' => 60, 'sections' => array(
					// Panel: Misc
					/* Favicon */
					'site_icon' => array('name' => 'site_icon_section', 'title' => _x('Site Icon', 'backend customizer', 'backend_dahztheme'), 'priority' => 5),
					/* Google Analytics */
					'google_analytics' => array('name' => 'google_analytics_section', 'title'	=> _x('Google Analytics', 'backend customizer', 'backend_dahztheme'), 'priority' => 10),
					/* Social Connects */
					'social_connect' => array('name' => 'social_connect_section', 'title' => _x('Social Connect', 'backend customizer', 'backend_dahztheme'), 'priority' => 15),
					/* 404 */
					'404' => array('name' => '404_section', 'title' => _x('404', 'backend customizer', 'backend_dahztheme'),	'priority'		=> 20),
					/* Page Loader */
					'page_loader' => array('name' => 'page_loader_section', 'title' => _x('Page Loader', 'backend customizer', 'backend_dahztheme'), 'priority' => 25),
					/* Font Subsets */
					'font_subset' => array('name' => 'font_subset_section', 'title' => _x('Font Subset', 'backend customizer', 'backend_dahztheme'), 'priority' => 30)
						)
			)
			);

		return apply_filters( 'create_customizer_panels', $panels );
	}

	/**
	 * Register Theme Customizer
	 */
	public function df_register_theme_customizer( $wp_customize ){
		if ( ! isset( $wp_customize ) ) {
			return;
		}

			$prefix  = $this->prefix;
			$panels  = $this->customizer_get_panel();

			/* Section : Screen Layout Mode */
			$wp_customize->add_section( $prefix . 'general_section', array('title' => _x('General', 'backend customizer','backend_dahztheme'), 'priority' => 0 ) );
			/* Section : Button Mode */
			$wp_customize->add_section( $prefix . 'button_section', array('title' => _x('Button', 'backend customizer','backend_dahztheme'), 'priority' => 40 ) );
			/* Section : Custom CSS */
			$wp_customize->add_section( $prefix . 'custom_style_section', array('title' => _x('Custom CSS', 'backend customizer', 'dahztheme'), 'priority' => 1000 ) );

			// Tier 1 : Add Panel
			foreach ( $panels as $panel ) {
				$wp_customize->add_panel( $prefix . $panel['name'], array(
					'title' => $panel['title'],
					'priority' => $panel['priority']
				) );
				// Tier 2 : Add Section
				foreach ( $panel['sections'] as $section ) {
					$wp_customize->add_section(	$prefix . $section['name'],	array(
							'title'			=> $section['title'],
							'priority'  => $section['priority'],
							'panel'			=> $prefix . $panel['name']
						)
					);
				}
			}

	}
	/**
	* dahz_remove_customizer_sections
	*
	* Remove Unused Native Sections
	*
	* @param $wp_manager
	* @return void
	*
	*/
	public function df_add_remove_customizer_sections( $wp_manager ) {

		$remove_section = array( 'themes', 'nav', 'colors', 'title_tagline', 'background_image', 'static_front_page', 'header_image' );
        $wp_manager->remove_control( 'active_theme' );
		foreach ( $remove_section as $remove ) {
			$wp_manager->remove_section( $remove );
		}

	}

	/* ----------------------------------------------------------------------------------- */
	/* Theme Customizer JavaScript                                                         */
	/* ----------------------------------------------------------------------------------- */
	public function df_enqueue_customizer_admin_scripts() {
	        wp_enqueue_script( 'df-customizer-admin', ASSETS_URI . 'js/admin/theme-customizer-control'.$this->suffix.'.js', array('jquery'), NULL, true );
	}

	/* ----------------------------------------------------------------------------------- */
	/* Theme Customizer Preview JavaScript                                                 */
	/* ----------------------------------------------------------------------------------- */
	public function df_enqueue_customizer_admin_preview_scripts() {
	         wp_enqueue_script( 'df-customizer-preview', ASSETS_URI . 'js/admin/theme-customizer-preview'.$this->suffix.'.js', array('jquery', 'customize-preview'), NULL, true );

	         do_action( 'df_customizer_preview_localize' );
	}


}
new DF_theme_customizer;
