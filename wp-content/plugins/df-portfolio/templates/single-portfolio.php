<?php 
/*
* single portfolio
*/

get_header(); 
?>

<div id="content-wrap" class="df_container-fluid fluid-width fluid-max col-full">

    <div class="df_row-fluid main-sidebar-container">
    
        <div <?php dahz_attr('content'); ?>>
            <?php
            while (have_posts()) : the_post();

                echo '<div class="df-single-portfolio-top-layout alignleft">';
                df_single_portfolio();
                echo "</div>";
                echo '<div class="clear"></div>';

                df_single_portfolio_postnav();
                df_single_portfolio_related_post();
                
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || '0' != get_comments_number()) :
                    comments_template();
                endif;
            endwhile; // end of the loop.    
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>

</div><!-- .df_container-fluid -->
<?php get_footer(); ?>