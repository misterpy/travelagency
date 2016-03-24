<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Dahz Testimonial Admin Class
 *
 * All functionality pertaining to the restaurants admin.
 *
 * @package 	WordPress
 * @subpackage 	Testimonial_Admin
 * @category 	Plugin
 * @author 		Dahz
 * @since 		1.0.0
 */

class Testimonial_Admin {
	private $dir;
	private $assets_dir;
	private $assets_url;
	private $token;
	private $post_type;
	private $file;
	private $singular_name;
	private $plural_name;

	/**
	 * Constructor function.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct ( $file ) {
		$this->dir 			= dirname( $file );
		$this->file 		= $file;
		$this->assets_dir 	= trailingslashit( $this->dir ) . 'assets';
		$this->assets_url 	= esc_url( trailingslashit( plugins_url( '/assets/', $file ) ) );
		$this->token 		= 'testimonials';
		$this->post_type 	= 'testimonial';

		global $pagenow;

		add_action( 'admin_menu', array( $this, 'meta_box_setup' ), 20 );
		add_action( 'save_post', array( $this, 'meta_box_save' ) );
		add_filter( 'enter_title_here', array( $this, 'enter_title_here' ) );
		// add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'featured_image_set_link' ) );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'featured_image_remove_link' ) );
		add_filter( 'post_row_actions',  array( $this, 'remove_row_view_actions' ) );

		if ( $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && esc_attr( $_GET['post_type'] ) == $this->post_type ) {
			add_action( 'restrict_manage_posts', array( $this, 'testimonial_restrict_manage_posts' ) );
			add_filter( 'parse_query', array( $this, 'testimonial_post_type_request' ) );
		}
	} // End __construct()

	/**
	 * Filter the request to just give posts for the given taxonomy, if applicable.
	 *
	 * @access 	public
	 * @param 	array $post_types - post types to add taxonomy filtering to
	 * @uses 	wp_dropdown_categories()
	 * @since  	1.0.0
	 * @return 	void
	 */
	function testimonial_restrict_manage_posts() {
	    global $typenow;

	    $post_types = array( 'testimonial' );

	    if ( in_array( $typenow, $post_types ) ) {
	    	$filters = get_object_taxonomies( $typenow );

	        foreach ( $filters as $tax_slug ) {

	        	$tax_obj = get_taxonomy( $tax_slug );

	        	if ( isset( $_GET[$tax_slug] ) ) {
	        		$selected = esc_attr( $_GET[$tax_slug] );
		        } else {
		        	$selected = null;
		        }

	            wp_dropdown_categories( array(
	                'show_option_all' 	=> __( 'Show All ' . $tax_obj->label, 'dahztheme' ),
	                'taxonomy' 	  		=> $tax_slug,
	                'name' 		  		=> $tax_obj->name,
	                'orderby' 	  		=> 'name',
	                'selected' 	  		=> $selected,
	                'hierarchical' 	  	=> $tax_obj->hierarchical,
	                'show_count' 	  	=> true,
	                'hide_empty' 	  	=> true,
	            ) );
	        }
	    }
	} // End testimonial_restrict_manage_posts()

	/**
	 * Adjust the query string to use taxonomy slug instead of ID.
	 *
	 * @access 	public
	 * @param 	array $filters - all taxonomies for the current post type
	 * @uses 	get_object_taxonomies()
	 * @uses  	get_term_by()
	 * @since  	1.0.0
	 * @return 	void
	 */
	function testimonial_post_type_request( $query ) {
	  	global $pagenow, $typenow;

	    $filters = get_object_taxonomies( $typenow );

	    foreach ( $filters as $tax_slug ) {
			$var = &$query->query_vars[$tax_slug];

			if ( isset( $var ) ) {
				$term = get_term_by( 'id', $var, $tax_slug );

				if ( false != $term ) {
					$var = $term->slug;
				}
			}
	    }

	    return $query;
	} // End testimonial_post_type_request()

	/**
	 * Update messages for the post type admin.
	 * @since  1.0.0
	 * @param  array $messages Array of messages for all post types.
	 * @return array           Modified array.
	 */
	public function updated_messages ( $messages ) {
		global $post, $post_ID, $testimonial;

		$messages[$this->post_type] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( '%s updated. View %s%s%s', 'dahztheme' ), $testimonial->singular_name, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', strtolower( $testimonial->singular_name ), '</a>' ),
			2  => __( 'Custom field updated.', 'dahztheme' ),
			3  => __( 'Custom field deleted.', 'dahztheme' ),
			4  => sprintf( __( '%s updated.', 'dahztheme' ), $testimonial->singular_name ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( '%s restored to revision from %s', 'dahztheme' ), $testimonial->singular_name, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( '%s published. View %s%s%s', 'dahztheme' ), $testimonial->singular_name, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', strtolower( $testimonial->singular_name ), '</a>' ),
			7  => sprintf( __( '%s saved.' ), $testimonial->singular_name ),
			8  => sprintf( __( '%s submitted. Preview %s%s%s', 'dahztheme' ), $testimonial->singular_name, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', strtolower( $testimonial->singular_name ), '</a>' ),
			9  => sprintf( __( '%s scheduled for: %s. Preview %s', 'dahztheme' ), $testimonial->singular_name,
			// translators: Publish box date format, see http://php.net/date
			'<strong>' . date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) . '</strong>', '<a target="_blank" href="' . esc_url( get_permalink($post_ID) ) . '">', strtolower( $testimonial->singular_name ), '</a>' ),
			10 => sprintf( __( '%s draft updated. Preview %s%s%s', 'dahztheme' ), $testimonial->singular_name, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', strtolower( $testimonial->singular_name ), '</a>' ),
		);

		return $messages;
	} // End updated_messages()

	/**
	 * Customise the "Enter title here" text.
	 *
	 * @access 	public
	 * @since  	1.0.0
	 * @param 	string $title
	 * @return 	void
	 */
	public function enter_title_here ( $title ) {
		if ( get_post_type() == $this->post_type ) {
			$title = __( 'Enter the costumer name here', 'dahztheme' );
		}
		return $title;
	} // End enter_title_here()

	/**
	 * Setup the meta box.
	 *
	 * @access public
	 * @since  1.1.0
	 * @return void
	 */
	public function meta_box_setup () {
		global $testimonial;

		// Gravatar Meta Box Load
		add_meta_box( 'testimonial-gravatar', __( 'Testimonial Details', 'dahztheme' ), array( $this, 'meta_box_content' ), $this->post_type, 'normal', 'high' );

	} // End meta_box_setup()

	/**
	 * The contents of our meta box.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function meta_box_content () {
		global $post_id;
		$fields 	= get_post_custom( $post_id );
		$field_data = $this->get_custom_fields_settings();
		
		$html = '';

		$html .= '<input type="hidden" name="dahz_' . $this->token . '_nonce" id="dahz_' . $this->token . '_nonce" value="' . wp_create_nonce( plugin_basename( $this->dir ) ) . '" />';

		if ( 0 < count( $field_data ) ) {
			$html .= '<table class="form-table">' . "\n";
			$html .= '<tbody>' . "\n";
				foreach ( $field_data as $k => $v ) {
					$data = isset( $v['default'] ) ? $v['default'] : '';
					if ( isset( $fields['_' . $k] ) && isset( $fields['_' . $k][0] ) ) {
						$data = maybe_unserialize( $fields['_' . $k][0] );
					}

					switch ( $v['type'] ) {
						case 'text':
						case 'url':
							$field = '<input name="' . esc_attr( $k ) . '" type="text" id="' . esc_attr( $k ) . '" class="regular-text" value="' . esc_attr( $data ) . '" />';
							$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td>' . $field . "\n";
							if( isset( $v['description'] ) ) $html .= '<p class="description">' . $v['description'] . '</p>' . "\n";
							$html .= '</td><tr/>' . "\n";
							break;
						case 'hidden':
							$field = '<input name="' . esc_attr( $k ) . '" type="hidden" id="' . esc_attr( $k ) . '" value="' . esc_attr( $data ) . '" />';
							$html .= '<tr valign="top">' . $field . "\n";
							$html .= '<tr/>' . "\n";
							break;
						default:
							$field = apply_filters( 'dahz_testimonial_data_field_type_' . $v['type'], null, $k, $data, $v );
							if ( $field ) {
								$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td>' . $field . "\n";
								if( isset( $v['description'] ) ) $html .= '<p class="description">' . $v['description'] . '</p>' . "\n";
								$html .= '</td><tr/>' . "\n";
							}
						break;
					}
				}
			$html .= '</tbody>' . "\n";
			$html .= '</table>' . "\n";
		}

		echo $html;

	} // End meta_box_content()

	/**
	 * Save meta box fields.
	 *
	 * @access 	public
	 * @since  	1.1.0
	 * @param 	int $post_id
	 * @return 	void
	 */
	public function meta_box_save ( $post_id ) {
		global $post, $messages;

		// Verify
		if ( ( get_post_type() != $this->post_type ) || ! wp_verify_nonce( $_POST['dahz_' . $this->token . '_nonce'], plugin_basename( $this->dir ) ) ) {
			return $post_id;
		}

		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$field_data 	= $this->get_custom_fields_settings();
		$fields 		= array_keys( $field_data );

		foreach ( $fields as $f ) {

			switch ( $field_data[$f]['type'] ) {
				case 'url':
					${$f} = isset( $_POST[$f] ) ? esc_url( $_POST[$f] ) : '';
					break;
				default :
					${$f} = isset( $_POST[$f] ) ? strip_tags( trim( $_POST[$f] ) ) : '';
					break;
			}

			// save it
			update_post_meta( $post_id, '_' . $f, ${$f} );

		}

	} // End meta_box_save()

	/**
	 * Get the settings for the custom fields.
	 * @since  1.1.0
	 * @return array
	 */
	 public function get_custom_fields_settings () {
	 	$fields = array();

	 	$fields['gravatar'] = array(
		    'name' 			=> __( 'Gravatar E-Mail Address', 'dahztheme' ),
		    'description' 	=> sprintf( __( 'Enter in an e-mail address, to use a %sGravatar%s, instead of using the "Gravatar Image".', 'dahztheme' ), '<a href="' . esc_url( 'http://gravatar.com/' ) . '" target="_blank">', '</a>' ),
		    'type' 			=> 'text',
		    'default' 		=> ''
		);

		$fields['byline'] 	= array(
		    'name' 			=> __( 'Byline', 'dahztheme' ),
		    'description' 	=> __( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Company").', 'dahztheme' ),
		    'type' 			=> 'text',
		    'default' 		=> ''
		);

		$fields['url'] 		= array(
		    'name' 			=> __( 'Url', 'dahztheme' ),
		    'description' 	=> __( 'Enter a URL that applies to this customer (for example: http://example.com/).', 'dahztheme' ),
		    'type' 			=> 'url',
		    'default' 		=> ''
		);

	 	return apply_filters( 'testimonial_custom_fields', $fields );
	} // End get_custom_fields_settings()
	
	public function remove_row_view_actions( $actions ) {
		$post_type = $this->get_current_post_type();

		if ( 'testimonial' == $post_type ) {
		    unset( $actions['view'] );
		}

	    return $actions;
	}

	/**
	 * Tweak the 'Set featured image' string to say 'Set Gravatar Image'.
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function featured_image_set_link( $content ) {
		$post_type = $this->get_current_post_type();

		if ( 'testimonial' == $post_type ) {
	    	$content = str_replace( __( 'Set featured image' ), __( 'Set Avatar Image', 'dahztheme' ), $content );
		}

		return $content;
	}

	/**
	 * Tweak the 'Remove featured image' string to say 'Remove Gravatar Image'.
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function featured_image_remove_link( $content ) {
		$post_type = $this->get_current_post_type();

	    if ( 'testimonial' == $post_type ) {
	    	$content = str_replace( __( 'Remove featured image' ), __( 'Remove Avatar Image', 'dahztheme' ), $content );
		}

		return $content;
	}

	/**
	 * Determine what post type the current admin page is related to
	 * @access public
	 * @since  1.0.0
	 * @return string
	 */
	public function get_current_post_type() {
        global $post, $typenow, $current_screen;

        if ( $post && $post->post_type )
            return $post->post_type;

        elseif ( $typenow )
            return $typenow;

        elseif ( $current_screen && $current_screen->post_type )
            return $current_screen->post_type;

        elseif ( isset( $_REQUEST['post_type'] ) )
            return sanitize_key( $_REQUEST['post_type'] );

        return null;
    }
}