<?php

/**
  * Blog
  *
  * @example
  * [blog posts="" category="category slug" order="" orderby="" ids="" slider_post_number="" extra_class=""]
**/

function df_blog_latest_sc( $atts ) {
    extract( shortcode_atts( array(
        'posts'              => '-1',
        'category'           => '',
        'order'              => '',
        'orderby'            => '',
        'ids'                => '',
        'slider_post_number' => '',
        'extra_class'        => ''
    ), $atts ) );

    if ( $slider_post_number == '' ) :
        $slider_post_number = '3';
    endif;

    if ( $ids != '' ) :
        $ids = explode( ',', $ids );
    endif;

    ob_start();

    $args = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'category_name'       => $category,
        'posts_per_page'      => $posts,
        'order'               => $order,
        'orderby'             => $orderby,
        'post__in'            => $ids
    );

    if( $category != '' ) {
        // string to array
        $str = $category;
        $arr = explode( ',', $str );

        $args['tax_query'][] = array(
          'taxonomy'  => 'category',
          'field'     => 'slug',
          'terms'     => $arr
        );
    }

    query_posts( $args );

    if( have_posts() ) : ?>
        <div class="blog shorcode-blog <?php echo $extra_class; ?>">
            <?php df_slider_blog_sc( $slider_post_number ); ?>
        </div>
    <?php
    wp_reset_query();

    endif; ?>


<?php

    return ob_get_clean();
}
add_shortcode('blog', 'df_blog_latest_sc');

/* ----------------------------------------------------------------------------------- */
/* If post slider                                                               */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_slider_blog_sc')) :
    function df_slider_blog_sc($slider_post_number) {
        $class_blog_slider = 'df-blog-slider-'.rand(0,200);
        $image_before = '<div class="blog-slider-animation"><span></span>';
        $image_after = '</div>';
        ?>
            <div class="blog-sc-slider">
                    <div id="blog-sc-slider" class="<?php echo $class_blog_slider; ?>" data-image-length="<?php echo $slider_post_number; ?>">
                    <?php   while ( have_posts() ) : the_post();?>
                            <div class="blog-sc-content">
                            <?php $image_pf = get_post_format();
                                if (has_post_thumbnail()) {
                                    echo $image_before;
                                    the_post_thumbnail('dahz-grid-thumb-cropping');
                                    echo $image_after;
                                } else {
                                    $url_src = get_template_directory_uri() . '/includes/assets/images/post-formats/big/';
                                    switch ($image_pf) {
                                        case 'audio':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'audio.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'gallery':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'gallery.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'image':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'image.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'video':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'video.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'quote':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'quote.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'link':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'link.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'aside':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'aside.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'status':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'status.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        case 'chat':
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'chat.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                            break;
                                        default:
                                            echo $image_before;
                                            echo '<img src="' . esc_url($url_src) . 'standard.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
                                            echo $image_after;
                                    }
                                }
                                ?>
                                <h2 class="related-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                <?php df_related_posted_on();?>
                            </div>
                            <?php
                       endwhile;
                        echo "</div></div><div class='clear'></div>";


    }
endif;

