<?php
/**
* Part Header Actions
*
*
* @package      Verko
* @subpackage   classes
* @since        1.0
* @author       Dahz
* @copyright    Copyright (c) 2015, Dahz
* @license      http://www.gnu.org/licenses/gpl.html
*/

if ( ! class_exists( 'DF_part_header' ) ) :
	class DF_part_header{

	static $instance;
	private $df_options;

	function __construct(){
		self::$instance =& $this;

		add_action( 'template_redirect', array( $this, 'df_set_header_hooks') );
	}


	/**
	* Set all header hooks
	* template_redirect callback
	* @return  void
	*
	* @package Verko
	* @since Verko 1.0
	*/
	function df_set_header_hooks() {
		$this->df_options = get_option( 'df_options' );
		// head actions
		add_action( 'wp_head', array( $this, 'df_site_favicon_display' ) );

		// header actions
		add_action( '__before_wrapper', array( $this, 'df_header_top_display' ) );
		add_action( '__header', array( $this, 'df_header_main_display' ) );

		//  header topbar filter classes
		add_filter( 'df_header_topbar_classes', array( $this, 'df_set_header_wide_options' ) );
		// header inner filter classes
		add_filter( 'df_header_inner_classes', array( $this, 'df_set_header_wide_options' ) );
		// nav menu filter alignment classes
		add_filter( 'df_menu_alignment', array( $this, 'df_set_menu_alignment' ) );
	}



	/**
	* Render favicon from options.
	*
	*
	* @package Verko
	* @since Verko 1.0
	*/
	/* ----------------------------------------------------------------------------------- */
	/* Site Favicon                                                                        */
	/* ----------------------------------------------------------------------------------- */
	  function df_site_favicon_display() {

	    $icon_favicon       = $this->df_options['fav_icon'];
	    $icon_touch         = $this->df_options['icon_touch'];
	    $icon_tile          = $this->df_options['icon_tile'];
	    $icon_tile_bg_color = $this->df_options['icon_tile_bg_color'];

	    if ( $icon_favicon != '' ) {
	      echo '<link rel="shortcut icon" href="' . esc_url( $icon_favicon ) . '">';
	    }

	    if ( $icon_touch != '' ) {
	      echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $icon_touch ) . '">';
	    }

	    if ( $icon_tile != '' ) {
	      echo '<meta name="msapplication-TileColor" content="' . $icon_tile_bg_color . '">';
	      echo '<meta name="msapplication-TileImage" content="' . $icon_tile . '">';
	    }

	  }

	function df_header_top_display() {
		ob_start();

	        if( !( is_404() || is_page_template( 'template-blank.php' ) ) ) :

				dahz_get_template( 'global', 'ajax-search' ); // Loads the includes/templates/global/ajax-search.php template.

				dahz_get_template( 'global', 'off-canvas' ); // Loads the includes/templates/global/off-canvas.php template.

		    endif;

			dahz_get_template( 'global', 'page-loader' ); // Loads the includes/templates/global/page-loader.php template.

		$html = ob_get_contents();
		if ( $html ) ob_end_clean();
		echo $html;
	}

	function df_header_main_display() {
	    ob_start();

		if( is_404() || is_page_template( 'template-blank.php' ) ) return;
		?>

	    <div class="header-wrapper col-full">

			<?php dahz_get_template( 'global', 'navbar' ); // Loads the includes/templates/global/navbar.php template.?>

		    <?php
					 if ( is_home() && $this->df_options['feat_slider'] != 0 ){
					 	 dahz_get_header( 'home-blog-slider' );
					 } else {
						 dahztheme_title_controller();
					 }
				?>

	    </div>

		<?php
	    $html = ob_get_contents();
	    if ( $html ) ob_end_clean();
	    echo $html;
	}

	/**
	* Set the header wide option
	* Callback for df_set_header_wide_options filter
	*
	*
	* @package Verko
	* @since Verko 1.0
	**/
	function df_set_header_wide_options( $classes ){

		$nav_wide_classes = ( isset( $_GET['header-wide'] ) || $this->df_options['header_navbar_wide'] == 1 ) ? 'widepad' : 'fluid-max';

		return str_replace( 'fluid-max', $nav_wide_classes, $classes );
	}

	/**
	* Set the navigation menu alignment
	* Callback for df_set_menu_alignment filter
	*
	*
	* @package Verko
	* @since Verko 1.0
	**/
	function df_set_menu_alignment( $classes ){
		if ( ! is_array( $classes ) )
					return $classes;

		$nav_align = $this->df_options['header_navbar_align'];
	  $nav_classes = array();

			if ( isset( $_GET['navbar-align-right'] ) || 'align-right' == $nav_align ){
					$nav_classes[] = 'alignright';
			} elseif( isset( $_GET['navbar-align-center'] ) || 'align-center' == $nav_align ){
					$nav_classes[] = 'aligncenter';
			} else {
					$nav_classes[] = 'alignleft';
			}

		return array_merge( $classes, $nav_classes );
	}

} //end of class
endif;
new DF_part_header();
