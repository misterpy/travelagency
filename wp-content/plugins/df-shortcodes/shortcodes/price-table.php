<?php

function df_price_table($atts, $content = null){

    extract(shortcode_atts(array(
        'title'         => '',
        'price'         => '',
        'currency'      => '',
        'price_period'  => '',
        'show_button'   => '',
        'button_text'   => '',
        'button_link'   => '',
        'button_target' => '',
        // 'button_size'   => '',
        // 'button_style'    => '',
        'button_shape'    => '',
        'popular'       => '',
    ), $atts));

    ob_start(); ?>
        <?php if ($popular != ''): ?>
            <div class="df-price-table yes-popular-pt">
                <div class="popular-pt"><span><?php echo $popular; ?></span></div>
        <?php else: ?>
            <div class="df-price-table no-popular-pt">
        <?php endif ?>

            <ul>
                <li><h3 class="title-pt"><?php echo $title; ?></h3></li>
                <li class="price-container-pt">
                    <span class="currency-pt"><?php echo $currency; ?></span>
                    <span class="price-pt"><?php echo $price; ?></span>
                    <span class="price-period-pt"><?php echo $price_period; ?></span>
                </li>
                <li><?php echo do_shortcode($content); ?> </li>

                <?php if ($show_button == 'yes'): ?>

                    <li>
                        <a class="button <?php echo $button_shape; ?>" href="button_link" target="button_target">
                            <?php echo $button_text; ?>
                        </a>
                    </li>

                <?php endif ?>
            </ul>
        </div>

    <?php
    $price_table = ob_get_clean();
    return $price_table;

}
add_shortcode( 'price_table', 'df_price_table' );