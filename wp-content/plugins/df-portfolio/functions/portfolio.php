<?php
/* ----------------------------------------------------------------------------------- */
/* Handle redirects before single content is output.                                                                */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('portfolio_template_redirect')) :

	function portfolio_template_redirect() {

		if (is_single() && 'portfolio' == get_post_type()) {
			wp_safe_redirect(home_url(), 301);
			exit;
		}

	}

endif;

/* ----------------------------------------------------------------------------------- */
/* Category Portfolio                                                                  */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_category_portfolio')) :

    function df_category_portfolio() {
        global $post;
        $category = get_the_term_list($post->ID, 'portfolio-gallery', '<li>', '</li>, <li>', '</li>');
        echo '<ul class="df-category-content-post df-link">' . $category . '</ul>';
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Post Meta Portfolio                                                           */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_post_meta_portfolio')) :

    function df_post_meta_portfolio() {
	    global $post;
	    echo "<div class='df-portfolio-postmeta'>";
	    echo '<div class="df-single-portfolio-category">';
        df_category_portfolio();
		    if (comments_open() || '0' != get_comments_number()) {
		        echo "<a href='" . esc_url(get_comments_link()) . "' class='comment-port'>";
		        comments_number(__('0 Comments', 'dahztheme'), __('1 Comment', 'dahztheme'), __('% Comments', 'dahztheme'));
		        echo "</a>";
		    }
	    echo '</div>';
	    echo "</div>";
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Related post single Portfolio                                                       */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_portfolio_related_post')) :

	function df_single_portfolio_related_post() {
		global $post;

		$enable_related_portfolio = get_post_meta($post->ID, 'df_metabox_enable_related_port', true);
		$category_include 		  = get_post_meta($post->ID, 'df_metabox_select_category_include_porto_related');

		if ($enable_related_portfolio != '0') {

			$cat_inc = '';
			$cat_count_inc = count($category_include);
			if ($cat_count_inc = 1) {
			    $temp_catinc = array();
			    foreach ($category_include as $catinc) {
			        $temp_catinc[] = $catinc;
			    }
			    $cat_inc = implode(', ', $temp_catinc);
			} else if ($cat_count_inc > 1) {
			    $cat_inc = $category_include;
			}

			$category = wp_get_post_terms($post->ID, 'portfolio-gallery', array("fields" => "slugs"));
			$related_portfolio_title_text =  get_post_meta( $post->ID, 'df_metabox_portfolio_title_text', true); 

			if (function_exists('icl_register_string')) {icl_register_string('Df Portfolio Content', 'portfolio text – ' . $related_portfolio_title_text, $related_portfolio_title_text ); } 
			$icl_t = function_exists('icl_t'); 
			$related_portfolio = $icl_t ? icl_t('Df Portfolio Content', 'portfolio text – ' . $related_portfolio_title_text, $related_portfolio_title_text) : $related_portfolio_title_text;


		    $args = array(
		        'posts_per_page' => -1,
		        'post_type' => 'portfolio',
		        'post_status' => 'publish',
		        'post__not_in' => array($post->ID)
		    );

		    if (!empty($cat_inc)) {
		        $args['tax_query'] = array(
		            array(
		                'taxonomy' => 'portfolio-gallery',
		                'field' => 'slug',
		                'terms' => $category_include
		            )
		        );
		    } else {
		        $args['tax_query'] = array(
		            array(
		                'taxonomy' => 'portfolio-gallery',
		                'field' => 'slug',
		                'terms' => $category
		            )
		        );
		    }

		    $my_query = new wp_query($args);
	    ?>
		<div class="df-single-portfolio-related-post">
		    <div class="related-post"> 
		        <h3 class="related-post-title"><?php echo esc_attr($related_portfolio); ?></h3>  
		        <div id="related-slider"> 
		            <?php
		            while ($my_query->have_posts()) { $my_query->the_post(); ?>  
		                <div class="related-post-content"> 
		                    <?php
			                    df_single_portfolio_related_post_content();
		                    ?>
		                </div>  
		                <?php
		            }
		            echo "</div></div><div class='clear'></div></div>";
	        wp_reset_postdata();
	        }
	}
endif;

/* ----------------------------------------------------------------------------------- */
/* related post single Portfolio content                                               */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_portfolio_related_post_content')) :

	function df_single_portfolio_related_post_content() {
		global $post;
	    ?>
		    <article <?php post_class(); ?>> <!-- post class -->
		        <?php
		        $title_before = '<h2 class="df-post-title">';
		        $title_after = '</h2>';
		        $title_before = $title_before . '<a href="' . esc_url(get_permalink($post->ID)) . '" rel="bookmark" title="' . the_title_attribute(array('echo' => 0)) . '">';
		        $title_after = '</a>' . $title_after;
		        $url_src                = get_template_directory_uri() . '/includes/assets/images/post-formats/big/';
		        ?>
		        <div class="entry df-portfolio-content"> <!-- post class -->
		            <?php
		            if (has_post_thumbnail()) {
		                echo "<div class='df-port-image'>"; 
		                echo '<div class="view third-effect">';
		                the_post_thumbnail('dahz-grid-thumb-cropping');
		                echo '  <div class="mask">';
		                 echo '  <div class="mask-table">';        
		                echo '  <div class="mask-table-cell">'; 
		                the_title($title_before, $title_after);
		                echo '<div class="clear"></div>';
		                echo "</div></div>";
		                echo "</div></div>";
		                echo "</div>";
		            } else if (!has_post_thumbnail()) {
		                echo "<div class='df-port-image'>"; 
		                echo '<div class="view third-effect">';
	                            echo '<a href="' . get_the_permalink() . '" class="info"  rel="">';
	                            echo '<img src="' . $url_src . 'standard.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
	                            echo '</a>';
		                echo '  <div class="mask">';
						echo '  <div class="mask-table">';        
		                echo '  <div class="mask-table-cell">'; 
		                the_title($title_before, $title_after);
		                echo '<div class="clear"></div>';
		                echo "</div></div>";
		                echo "</div></div>";
		                echo "</div>";
		            }
		            ?>

		            <div class="clear"></div>
		        </div><!-- /.entry -->
		    </article> <!--end post class -->
	    <?php
	}

endif;

/* ----------------------------------------------------------------------------------- */
/* Template include single portfolio                                                   */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('portfolio_single_template')) :

	function portfolio_single_template($template) {

		if (get_post_type(get_the_ID()) == 'portfolio' && is_single()) {
			return PORTFOLIO_PLUGIN_FILE . 'templates/single-portfolio.php';
		}
		return $template;
	}
	
	add_filter('template_include', 'portfolio_single_template');
endif;


/* ----------------------------------------------------------------------------------- */
/* Top Image Single Portfolio                                                          */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_portfolio')) :

	function df_single_portfolio() {
	    global $post;

	    echo '<div class="df-single-portfolio-the-content">';
	    the_content();
	    echo '</div>';
	    echo '<div class="clear"></div>';
	}

endif;

/* ----------------------------------------------------------------------------------- */
/* Postnav single Portofolio next prev no thumbnail                                    */
/* ----------------------------------------------------------------------------------- */

if (!function_exists('df_single_portfolio_postnav')) :

    function df_single_portfolio_postnav() {
        $df_enable_pagination = get_post_meta(get_the_id(), 'df_metabox_portfolio_pagination_single',true);

        if ($df_enable_pagination) {
            $enable_back_to_page = get_post_meta(get_the_id(), 'df_metabox_enable_back_to_page', true);
            $back_to_page = get_post_meta(get_the_id(), 'df_metabox_back_to_page', true);
            $back_to_page = get_permalink($back_to_page);
            ?>
			<div class="df-single-portfolio-postnav">
	            <div class="post-pagination-portfolio">
	                <div class="nav-next small-right alignright">
	                    <?php
	                        next_post_link('%link', '<i class="md-chevron-right"></i> ');
	                    ?>
	                </div>
	                <?php if ($enable_back_to_page) { ?>
	                    <div class="df-back-to-page-portfolio">
	                        <a href="<?php echo esc_url($back_to_page); ?>"><i class="md-apps"></i></a>
	                    </div>
	                <?php } ?>
	                <div class="nav-prev small-left alignleft"><?php
	                        previous_post_link('%link', '<i class="md-chevron-left"></i> ');
	                    ?></div>
	            </div>
	            <div class="clear"></div>
			</div>


            <?php
        }
    }

endif;