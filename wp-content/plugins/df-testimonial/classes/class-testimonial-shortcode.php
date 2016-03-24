<?php
/**
 * Testimonial_Shortcodes class.
 *
 * @class 		Testimonial_Shortcodes
 * @version		1.0.0
 * @package 	WordPress
 * @subpackage 	Testimonial/Classes
 * @category	Class
 * @author 		Dahz
 */
class Testimonial_Shortcodes {

	public function __construct() {
		// Regular shortcodes
		add_shortcode( 'df_testimonial', array( $this, 'dahztheme_testimonials_shortcode' ) );
	}

	/**
	 * Shortcode Wrapper
	 *
	 * @param 	mixed $function
	 * @param 	array $atts (default: array())
	 * @return 	string
	 */
	public static function shortcode_wrapper( $function, $atts = array(), $wrapper = array( 'class' => 'testimonial-item', 'before' => null, 'after' => null ) ){
		ob_start();

		$before = empty( $wrapper['before'] ) ? '<div class="' . $wrapper['class'] . '">' : $wrapper['before'];
		$after 	= empty( $wrapper['after'] ) ? '</div>' : $wrapper['after'];

		echo $before;
		call_user_func( $function, $atts );
		echo $after;

		return ob_get_clean();
	}

	/**
	 * Recent Testimonial shortcode
	 *
	 * @access 	public
	 * @param 	array $atts
	 * @return 	string
	 */
	public function dahztheme_testimonials_shortcode( $atts, $content = null ) {

		$args = (array)$atts;

        $defaults = array(
            'limit'             	=> 5,
            'per_row'           	=> null,
            'orderby'           	=> 'menu_order',
            'order'             	=> 'DESC',
            'id'                	=> 0,
            'display_author'    	=> false,
            'display_avatar'    	=> false,
            'display_url'       	=> false,
            'effect'            	=> 'fade', // Options: 'fade', 'none'
            'echo'              	=> false,
            'size'              	=> 70,
            'category'          	=> 0,
            'position'          	=> 'left', //  Options: 'left', 'center', 'right'
            'id_testimonial_slider' => 0,
            'testimonial_slider' 	=> false,
            'el_class' 				=> '',
            'testi_text_size'       => '',
            'testi_text_color'      => '',
            'testi_au_color'        => '',
            'testi_au_size'         => '',
        );

        $args = shortcode_atts( $defaults, $atts );

        // Make sure we return and don't echo.
        $args['echo'] = false;

        // Fix integers.
        if ( isset( $args['limit'] ) ) $args['limit'] = intval( $args['limit'] );
        if ( isset( $args['size'] ) &&  ( 0 < intval( $args['size'] ) ) ) $args['size'] = intval( $args['size'] );
        if ( isset( $args['category'] ) && is_numeric( $args['category'] ) ) $args['category'] = intval( $args['category'] );

        // Fix booleans.
        foreach ( array( 'display_author', 'display_url', 'pagination', 'display_avatar') as $k => $v ) {
            if ( isset( $args[$v] ) && ( 'true' == $args[$v] ) ) {
                $args[$v] = true;
            } else {
                $args[$v] = false;
            }
        }

        return $this->dahztheme_testimonials( $args );

	}

	/**
	 * Display or return HTML-formatted testimonials.
	 * @param  string/array $args  Arguments.
	 * @since  1.0.0
	 * @return string
	 */
	public function dahztheme_testimonials ( $args = '' ) {
	    global $post, $more;

	    $defaults = apply_filters( 'dahztheme_testimonials_default_args', array(
	        'limit'             	=> 5,
	        'per_row'           	=> null,
	        'orderby'           	=> 'menu_order',
	        'order'             	=> 'DESC',
	        'id'                	=> 0,
	        'display_author'    	=> true,
	        'display_avatar'    	=> true,
	        'display_url'       	=> true,
	        'effect'            	=> 'fade', // Options: 'fade', 'none'
	        'echo'              	=> true,
	        'size'              	=> 70,
	        'title'             	=> '',
	        'before'            	=> '<div class="widget widget_dahzthemes_testimonials">',
	        'after'             	=> '</div>',
	        'before_title'      	=> '<h2>',
	        'after_title'       	=> '</h2>',
	        'category'          	=> 0,
	        'position'          	=> 'left', //  Options: 'left', 'center', 'right'
	        'id_testimonial_slider' => 0,
	        'testimonial_slider' 	=> true,
            'testi_text_size'       => '',
            'testi_text_color'      => '',
            'testi_au_color'        => '',
            'testi_au_size'         => '',
	    ) );

	    $args = wp_parse_args( $args, $defaults );

	    // Allow child themes/plugins to filter here.
	    $args = apply_filters( 'dahztheme_testimonials_args', $args );
	    $html = '';

	    do_action( 'dahztheme_testimonials_before', $args );

        // The Query.
        $query = $this->get_testimonials( $args );

        // The Display.
        if ( ! is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {

            $class = $position = '';

            if ( is_numeric( $args['per_row'] ) ) {
                $class .= ' columns-' . intval( $args['per_row'] );
            }

            if ( 'none' != $args['effect'] ) {
                $class .= ' effect-' . $args['effect'];
            }

            $html .= $args['before'] . "\n";
            if ( '' != $args['title'] ) {
                $html .= $args['before_title'] . esc_html( $args['title'] ) . $args['after_title'] . "\n";
            }

            if ($args['testimonial_slider'] == "true") {
                $html .= '<div class="testimonials slider-testimonial-active component' . esc_attr( $class ) . '">' . "\n";
            } else {
                $html .= '<div class="testimonials component' . esc_attr( $class ) . '">' . "\n";
            }
            $html .= '<div class="testimonials-list">' . "\n";

            if ('' != $args['position']) {
                $position .= ' position_' . $args['position'];
            }

            $html .= '<div class="testimonials'. esc_attr( $position ) .'">' . "\n";

            if ($args['testimonial_slider'] == "true") {
                $html .= '<div id="'.$args['id_testimonial_slider'].'" class="owl-carousel slider-testimonial">';
            }

            // Begin templating logic.
            $tpl = '<div id="quote-%%ID%%" class="%%CLASS%%" style="font-size:%%TEXT_SIZE%%px; color:%%TEXT_COLOR%%;" itemprop="review" itemscope itemtype="http://schema.org/Review"><div class="testimonials-text" itemprop="reviewBody">%%TEXT%%</div>%%AVATAR%% %%AUTHOR%%</div>';
            $tpl = apply_filters( 'dahztheme_testimonials_item_template', $tpl, $args );

            $count = 0;
            foreach ( $query as $post ) { $count++;
                $template = $tpl;

                $css_class = 'quote';
                if ( ( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == ( $count - 1 ) % $args['per_row'] ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == $count % $args['per_row'] ) ) || count( $query ) == $count ) { $css_class .= ' last'; }

                // Add a CSS class if no image is available.
                if ( isset( $post->image ) && ( '' == $post->image ) ) {
                    $css_class .= ' no-image';
                }

                setup_postdata( $post );

                $author = $author_text = '';

                // If we need to display the author, get the data.
                if ( ( get_the_title( $post ) != '' ) && true == $args['display_author'] ) {
                    $author .= '<cite class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">';

                    $author_name = '<span itemprop="name"><a style="color:%%TEXT_AUTH_COLOR%%; font-size:%%TEXT_AUTH_SIZE%%px;" href="'. esc_url( $post->url ) .'" itemprop="url">' . get_the_title( $post ) . '</a></span><br>';

                    $author .= $author_name;

                    if ( isset( $post->byline ) && '' != $post->byline ) {
                        $author .= ' <span class="title" style="color:%%TEXT_AUTH_COLOR%%; font-size:%%TEXT_AUTH_SIZE%%px;" itemprop="jobTitle">' . $post->byline . '</span><!--/.title-->' . "\n";
                    }

                    $author .= '</cite><!--/.author-->' . "\n";

                    // Templating engine replacement.
                    $template = str_replace( '%%AUTHOR%%', $author, $template );
                } else {
                    $template = str_replace( '%%AUTHOR%%', '', $template );
                }

                // Templating logic replacement.
                $template 	= str_replace( '%%ID%%', get_the_ID(), $template );
                $template   = str_replace( '%%CLASS%%', esc_attr( $css_class ), $template );
                $template   = str_replace( '%%TEXT_SIZE%%', $args['testi_text_size'], $template );
                $template   = str_replace( '%%TEXT_COLOR%%', $args['testi_text_color'], $template );
                $template   = str_replace( '%%TEXT_AUTH_COLOR%%', $args['testi_au_color'], $template );
                $template 	= str_replace( '%%TEXT_AUTH_SIZE%%', $args['testi_au_size'], $template );

                if ( isset( $post->image ) && ( '' != $post->image ) && true == $args['display_avatar'] && ( '' != $post->url ) ) {
                    $template = str_replace( '%%AVATAR%%', '<a href="' . esc_url( $post->url ) . '" class="avatar-link">' . $post->image . '</a>', $template );
                } elseif ( isset( $post->image ) && ( '' != $post->image ) && true == $args['display_avatar'] ) {
                    $template = str_replace( '%%AVATAR%%', $post->image, $template );
                } else {
                    $template = str_replace( '%%AVATAR%%', '', $template );
                }

                // Remove any remaining %%AVATAR%% template tags.
                $template   = str_replace( '%%AVATAR%%', '', $template );
                $real_more  = $more;
                $more       = 0;
                $content    = apply_filters( 'dahztheme_testimonials_content', apply_filters( 'the_content', get_the_content( __( 'Read full testimonial...', 'dahztheme' ) ) ), $post );
                $more       = $real_more;
                $template   = str_replace( '%%TEXT%%', $content, $template );

                // Assign for output.
                $html .= $template;

                if( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == $count % $args['per_row'] ) ) {
                    $html .= '<div class="clear"></div>' . "\n";
                }
            }

            wp_reset_postdata();

            $html .= '</div><!--/.testimonials-list-->' . "\n";
            $html .= '</div><!--/.testimonials-component-->' . "\n";
            if ($args['testimonial_slider'] == "true") {
                $html .= '</div><!--/.testimonials-slider-->' . "\n";
            }

            $html .= '<div class="clear"></div>' . "\n";
            $html .= '</div><!--/.testimonials-->' . "\n";
            $html .= $args['after'] . "\n";
        }

        // Allow child themes/plugins to filter here.
        $html = apply_filters( 'dahztheme_testimonials_html', $html, $query, $args );

        if ( $args['echo'] != true ) { return $html; }

        // Should only run is "echo" is set to true.
        echo $html;

        do_action( 'dahztheme_testimonials_after', $args ); // Only if "echo" is set to true.
	} // End dahztheme_testimonials()

	/**
	 * Get testimonials.
	 * @param  string/array $args Arguments to be passed to the query.
	 * @since  1.0.0
	 * @return array/boolean      Array if true, boolean if false.
	 */
	function get_testimonials ( $args = '' ) {
	    $defaults = array(
	        'limit' 	=> 5,
	        'orderby' 	=> 'menu_order',
	        'order' 	=> 'DESC',
	        'id' 		=> 0,
	        'category' 	=> 0
	    );

	    $args = wp_parse_args( $args, $defaults );

	    // Allow child themes/plugins to filter here.
	    $args = apply_filters( 'dahz_get_testimonials_args', $args );

	    // The Query Arguments.
	    $query_args 					= array();
	    $query_args['post_type'] 		= 'testimonial';
	    $query_args['numberposts'] 		= $args['limit'];
	    $query_args['orderby'] 			= $args['orderby'];
	    $query_args['order'] 			= $args['order'];
	    $query_args['suppress_filters'] = false;

	    $ids = explode( ',', $args['id'] );

	    if ( 0 < intval( $args['id'] ) && 0 < count( $ids ) ) {
	        $ids = array_map( 'intval', $ids );
	        if ( 1 == count( $ids ) && is_numeric( $ids[0] ) && ( 0 < intval( $ids[0] ) ) ) {
	            $query_args['p'] = intval( $args['id'] );
	        } else {
	            $query_args['ignore_sticky_posts'] = 1;
	            $query_args['post__in'] = $ids;
	        }
	    }

	    // Whitelist checks.
	    if ( ! in_array( $query_args['orderby'], array( 'none', 'ID', 'author', 'title', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order', 'meta_value', 'meta_value_num' ) ) ) {
	        $query_args['orderby'] 		= 'date';
	    }

	    if ( ! in_array( $query_args['order'], array( 'ASC', 'DESC' ) ) ) {
	        $query_args['order'] 		= 'DESC';
	    }

	    if ( ! in_array( $query_args['post_type'], get_post_types() ) ) {
	        $query_args['post_type'] 	= 'testimonial';
	    }

	    $tax_field_type = '';

	    // If the category ID is specified.
	    if ( is_numeric( $args['category'] ) && 0 < intval( $args['category'] ) ) {
	        $tax_field_type = 'id';
	    }

	    // If the category slug is specified.
	    if ( ! is_numeric( $args['category'] ) && is_string( $args['category'] ) ) {
	        $tax_field_type = 'slug';
	    }

	    // Setup the taxonomy query.
	    if ( '' != $tax_field_type ) {
	        $term = $args['category'];
	        if ( is_string( $term ) ) { $term = esc_html( $term ); } else { $term = intval( $term ); }
	        $query_args['tax_query'] = array( array( 'taxonomy' => 'testimonial_category', 'field' => $tax_field_type, 'terms' => array( $term ) ) );
	    }


	    // The Query.
	    $query = get_posts( $query_args );


	    // The Display.
	    if ( ! is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {
	        foreach ( $query as $k => $v ) {
	            $meta = get_post_custom( $v->ID );

	            // Get the image.
	            $query[$k]->image 	= $this->testimonial_get_image( $v->ID, $args['size'] );
	            // Get the byline.
	            $query[$k]->byline 	= $this->testimonial_get_byline( $v->ID);
	            // Get the url.
	            $query[$k]->url 	= $this->testimonial_get_url( $v->ID );

	        }
	    } else {
	        $query = false;
	    }

	    return $query;
	} // End get_testimonials()

	/**
	 * Get the image for the given ID. If no featured image, check for Gravatar e-mail.
	 * @param  int              $id   Post ID.
	 * @param  string/array/int $size Image dimension.
	 * @since  1.0.0
	 * @return string           <img> tag.
	 */
	public function testimonial_get_image ( $id, $size ) {
        $response = '';

        if ( has_post_thumbnail( $id ) ) {
            // If not a string or an array, and not an integer, default to 100x9999.
            if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
                $size = array( intval( $size ), intval( $size ) );
            } elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
                $size = array( 100, 100 );
            }
            $response = get_the_post_thumbnail( intval( $id ), $size, array( 'class' => 'avatar' ) );
        } else {
            $gravatar_email = esc_attr(get_post_meta( $id, '_gravatar', true ));
            if ( '' != $gravatar_email && is_email( $gravatar_email ) ) {
                $response = get_avatar( $gravatar_email, $size );
            }
        }

        return $response;
	} // End testimonial_get_image()

	public function testimonial_get_byline ( $id ) {
        $response 	= '';
        $byline 	= esc_attr(get_post_meta( $id, '_byline', true ));

        if ( '' != $byline )  {
            $response = $byline;
        }

        return $response;
	} // End testimonial_get_byline()

	public function testimonial_get_url ( $id ) {
        $response 	= '';
        $url 		= esc_attr(get_post_meta( $id, '_url', true ));

        if ( '' != $url )  {
            $response = $url;
        }

        return $response;
	} // End testimonial_get_url()
}

new Testimonial_Shortcodes();