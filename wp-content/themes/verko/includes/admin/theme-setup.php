<?php

if ( !defined('ABSPATH') ){
 exit;
}
/**
 * dahztheme functions and definitions
 *
 * @package dahztheme
 */
/* ------------------------------------------------------------------------------------

  TABLE OF CONTENTS

  - Global Content Width
  - Theme Setup

  ------------------------------------------------------------------------------------ */

/**
 * set grid thumb if content dynamicaly changing
 */
if( !function_exists('df_grid_content_thumb') ) :

  function df_grid_content_thumb() {

    $df_options  = get_option( 'df_options' );

    $df_grid_col = isset( $df_options[ 'blog_grid_col' ] ) ? $df_options[ 'blog_grid_col' ] : '2col';
    $content     = isset( $df_options[ 'layout_content' ] ) ? $df_options[ 'layout_content' ] : 'two-col-left';
    $max         = isset( $df_options[ 'site_max_width' ] ) ? $df_options[ 'site_max_width' ] : 1200; // 1400px, 1200px, 1000px
    $m_w         = 100;
    $c_w         = 75;

    $two_col   = ( $m_w / 2 ) - 2.5;
    $three_col = ( $m_w / 3 ) - 2.5;
    $four_col  = ( $m_w / 4 ) - 2.5;
    $five_col  = ( $m_w / 5 ) - 2.5;
    $two_col_sidebar   = ( $c_w / 2 ) - 2.5;
    $three_col_sidebar = ( $c_w / 3 ) - 2.5;
    $four_col_sidebar  = ( $c_w / 4 ) - 2.5;
    $five_col_sidebar  = ( $c_w / 5 ) - 2.5;

    if ( $content == 'one-col' ) {
            switch ( $df_grid_col ) {
              case '2col':
                  $output = round ( $max * ( $two_col / 100 ) ); break;
              case '3col':
                  $output = round ( $max * ( $three_col / 100 ) ); break;
              case '4col':
                  $output = round ( $max * ( $four_col / 100 ) ); break;
              case '5col':
                  $output = round ( $max * ( $five_col / 100 ) ); break;
              default:
                  $output = round ( $max * ( $two_col / 100 ) ); break;
          }
      } else {
          switch ( $df_grid_col ) {
              case '2col':
                  $output = round ( $max * ( $two_col_sidebar / 100 ) ); break;
              case '3col':
                  $output = round ( $max * ( $three_col_sidebar / 100 ) ); break;
              case '4col':
                  $output = round ( $max * ( $four_col_sidebar / 100 ) ); break;
              case '5col':
                  $output = round ( $max * ( $five_col_sidebar / 100 ) ); break;
              default:
                  $output = round ( $max * ( $two_col_sidebar / 100 ) ); break;
          }
     }

    return $output;

 }
endif;

add_action( 'customize_save', 'df_grid_content_thumb' );

/**
 * set width if content dynamicaly changing
 */
if( !function_exists('df_composer_global_content_width') ) :

  function df_composer_global_content_width() {
    $df_options = get_option('df_options' );

    $content = isset( $df_options[ 'layout_content' ] ) ? $df_options[ 'layout_content' ] : 'two-col-left';
    $max     = isset( $df_options[ 'site_max_width' ] ) ? $df_options[ 'site_max_width' ] : 1200; // 1400px, 1200px, 1000px
    $m_w     = 100 - 2.5;
    $c_w     = 75 - 2.5;

      if ( $content == 'one-col' ) {
          $output = round ( $max * ( $m_w / 100 ) );
      } else {
          $output = round ( $max * ( $c_w / 100 ) );
      }

      return $output;

  }

endif;

add_action( 'customize_save', 'df_composer_global_content_width' );

function dahztheme_content_width(){
  global $content_width;
  if ( !isset($content_width) ) {
      $content_width = df_composer_global_content_width(); /* pixels */
  }
}
add_action('template_redirect', 'dahztheme_content_width' );


if (!function_exists('dahztheme_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function dahztheme_setup() {

        $df_options = get_option('df_options' );
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /* The best thumbnail/image script ever. */
        add_theme_support( 'get-the-image' );

        // Plugin Support
        add_theme_support( 'jetpack' );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'qtranslate' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
          'primary-menu' => __( 'Primary Menu', 'dahztheme' ),
          'top-menu' => __( 'Top Menu', 'dahztheme' ),
          'off-canvas-menu' => __( 'Off Canvas Menu', 'dahztheme' ),
        ) );

        if( isset($df_options['header_navbar_position']) == 'split' ){
          register_nav_menus( array(
            'split-left-menu' => __( 'Split Left Menu', 'dahztheme' ),
            'split-right-menu' => __( 'Split Right Menu', 'dahztheme' )
          ) );
        }

        /* Adds core WordPress HTML5 support. */
        add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
       /*
       * Enable support for Post Formats.
       * See http://codex.wordpress.org/Post_Formats
       */
        add_theme_support('post-formats', array('audio', 'gallery', 'image', 'video', 'quote', 'link', 'chat', 'aside', 'status'));

        // Featured images.
        // $height_thumb = round( df_grid_content_thumb() / 1.333333333333333 );
        // add_image_size( 'dahz-large', df_composer_global_content_width(), 9999, false );
        // add_image_size( 'dahz-grid-thumb', df_grid_content_thumb(), 9999, false );
        // add_image_size( 'dahz-grid-thumb-cropped', df_grid_content_thumb(), $height_thumb, true );
        // add_image_size( 'dahz-small-thumb', 80, 80, true);

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background');
        add_theme_support('custom-header');


    }

endif; // dahztheme_setup
add_action('after_setup_theme', 'dahztheme_setup', 5);

if(!function_exists('df_theme_screen_config')) :
  /**
   * such a feature
   * @return array
   */
  function df_theme_screen_config(){
    $args = array(
      'theme_description' => 'Congratulations, you\'ve installed the best business theme for wordpress, Now let Us help you to create great website for your business.',
      'theme_badge' => ASSETS_URI.'images/verko.png',
      'theme_content' => 'df_screen_home', // callback
       );

    return $args;
  }
endif;

add_filter('dahz_screen_config', 'df_theme_screen_config');

function df_screen_home(){
  ob_start();?>
    <div>
        <h3>New to Wordpress?</h3>
        <p>We recommend your to read Wordpress <a href="http://codex.wordpress.org/WordPress_Lessons">guide</a> and Verko <a href="http://support.daffyhazan.com/docs/verko/">documentation</a></p>
      </div>

        <div class="row group"><!--Start row group one  -->
          <div class="col two-col">
            <h3>Want our demo content?</h3>
            <ol>
              <li><a href="<?php echo get_admin_url().'admin.php?page=dahz-addons'; ?>">Install required Plugins</a></li>
              <li><a href="<?php echo get_admin_url().'import.php?import=wordpress'; ?>">Import Demo Content</a></li>
              <li><a href="<?php echo get_admin_url().'admin.php?page=dahz-backup'; ?>">Import Customizer Setting</a></li>
            </ol>
          </div>

          <div class="col two-col">
            <h3>See Our Demo</h3>
            <ul>
              <li><a href="http://dahz.daffyhazan.com/verko/home-v4/">Business</a></li>
              <li><a href="http://dahz.daffyhazan.com/verkoagency/">Agency</a></li>
              <li><a href="http://dahz.daffyhazan.com/verkoapp/">App (one page)</a></li>
              <li><a href="http://dahz.daffyhazan.com/verko/home-v3/">App (multi page)</a></li>
              <li><a href="http://dahz.daffyhazan.com/verko/home-v5/">With full screen slider</a></li>
              <li><a href="http://dahz.daffyhazan.com/verko/blank-demo-v2/">Landing Pages (Newsletter)</a></li>
              <li><a href="http://dahz.daffyhazan.com/verko/blank-demo-v1/">Landing Pages (Download Page)</a></li>
              <li><a href="http://dahz.daffyhazan.com/verko/under-construction-v2/">Coming soon Page</a></li>
            </ul>
          </div>
        </div><!--end row group one  -->
    <hr />

    <div><!--Start row group two  -->
      <h3>Resources</h3>
      <p>Here you can read documentations of the theme and plugins to help you to get around the theme.</p>
    </div>
    <div class="row group">
      <div class="col two-col">
        <ul>
          <li><a href="http://support.daffyhazan.com/docs/verko/">Online Docs</a></li>
          <li><a href="ttp://support.daffyhazan.com/section/verko/">Knowledgebase </a></li>
          <li><a href="http://support.daffyhazan.com/verko-changelog/">Changelog </a></li>
          <li><a href="http://support.daffyhazan.com/forums/our-template/verko/">Support Forum</a></li>
        </ul>
      </div>
      <div class="col two-col">
        <ul>
          <li><a href="http://masterslider.com/doc/">Master Slider</a></li>
          <li><a href="contactform7.com/docs/">Contact Form 7</a></li>
          <li><a href="https://wpbakery.atlassian.net/wiki/display/VC/Visual+Composer+Pagebuilder+for+WordPress">Visual Composer</a></li>
        </ul>
      </div>
    </div><!--end row group two  -->
    <hr />

    <div><!--Start row group three  -->
      <h3>About Us</h3>
    </div>
    <div class="row group">
      <div class="col two-col">
        <p>
          We grow when people tell their friends about us, We’re flattered every time someone spreads the good word.
        </p>
        <p>
          <a href="http://themeforest.net/user/Dahz/portfolio">
            <img src="<?php echo ASSETS_URI.'images/home_screen/rate_button.png'; ?>" alt="RateUs" />
          </a>
          <div class="clear"></div>
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://themeforest.net/item/verko-responsive-business-one-page-wp-theme/11813617" data-text="Verko responsive business one page wp theme |" data-size="large">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        </p>
      </div>
      <div class="col two-col">
        <ul>
          <li><a href="http://daffyhazan.com">Dahz Official Website</a></li>
          <li><a href="http://themeforest.net/user/Dahz">Dahz in themeforest</a></li>
          <li><a href="http://themeforest.net/user/Dahz/portfolio">Dahz Portfolio</a></li>
        </ul>
      </div>
    </div><!--end row group three  -->
    <hr />

    <div><!--Start row group four  -->
      <h3>More item by dahz</h3>
    </div>
    <div class="more-item">
      <a href="http://themeforest.net/item/food-cook-multipurpose-food-recipe-wp-theme/4915630"><img src="<?php echo ASSETS_URI.'images/home_screen/fnc.png'; ?>" alt="Food and Cook"></a>
      <a href="http://themeforest.net/item/labomba-responsive-multipurpose-wordpress-theme/6106367"><img src="<?php echo ASSETS_URI.'images/home_screen/labomba.png'; ?>" alt="Labomba"></a>
      <a href="http://themeforest.net/item/az-multi-retail-concept-wordpress-theme/9279746?WT.ac=new_item&amp;WT.z_author=Dahz"><img src="<?php echo ASSETS_URI.'images/home_screen/az.png'; ?>" alt="AZ"></a>
      <a href="http://themeforest.net/item/loma-the-ultimate-wp-blog-theme/9930474"><img src="<?php echo ASSETS_URI.'images/home_screen/loma.png'; ?>" alt="Loma"></a>
      <a href="http://themeforest.net/item/liesel-cafe-dining-and-bakery-wordpress-theme/10176485"><img src="<?php echo ASSETS_URI.'images/home_screen/liesel.png'; ?>" alt="Liesel"></a>
      <a href="http://themeforest.net/item/dejure-responsive-wp-theme-for-law-firm-business/11228701"><img src="<?php echo ASSETS_URI.'images/home_screen/dejure.png'; ?>" alt="Dejure"></a>
    </div>
  <?php
  $output = ob_get_contents(); ob_end_clean();
  echo $output;
}

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dahz_register_image_sizes() {

  /* Adds the 'dahz-large' image size. */
  $height_thumb = round( df_grid_content_thumb() / 1.333333333333333 );
  add_image_size( 'dahz-large', df_composer_global_content_width(), 9999, false );
  add_image_size( 'dahz-grid-thumb', df_grid_content_thumb(), 9999, false );
  add_image_size( 'dahz-grid-thumb-cropping', df_grid_content_thumb(), $height_thumb, true );
  add_image_size( 'dahz-small-thumb', 80, 80, true);
}
add_action( 'init', 'dahz_register_image_sizes', 5 );


if (!function_exists('df_remove_menus')) :

    function df_remove_menus() {

        remove_submenu_page( 'themes.php', 'header_image' );      // 1
        remove_submenu_page( 'themes.php', 'custom-background' ); // 2

        // Remove featured image on page
        remove_meta_box( 'postimagediv', 'page', 'side' );

    }

endif;
add_action( 'admin_head', 'df_remove_menus', 999 );


/*-----------------------------------------------------------------------------------*/
/* Check if WooCommerce is activated */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'is_woocommerce_activated' ) ) :
  function is_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
endif;

/* ----------------------------------------------------------------------------------- */
/* Visual Composer Setup                                                               */
/* ----------------------------------------------------------------------------------- */

// if plugin Visual Composer is active Set WPB VC as Theme
add_action( 'vc_before_init', 'is__vcSetAsTheme' );
function is__vcSetAsTheme() {
    vc_set_as_theme(true);
    vc_disable_frontend();
}

/* ----------------------------------------------------------------------------------- */
/* Revolution Slider Setup                                                             */
/* ----------------------------------------------------------------------------------- */

// if plugin Revolution Slider is active Set RevS as Theme
if(function_exists('set_revslider_as_theme')) { set_revslider_as_theme(); }
