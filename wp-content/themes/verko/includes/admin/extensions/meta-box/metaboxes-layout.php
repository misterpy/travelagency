<?php
/* * ******************************************************** */
// Layout options
/* * ******************************************************** */
$nav_menus = get_terms('nav_menu');
$nav_menus_clear = array(0 => _x('Primary location menu', 'backend metabox', 'dahztheme'), -1 => _x('Default menu', 'backend metabox', 'dahztheme'));

foreach ($nav_menus as $nav_menu) {
    $nav_menus_clear[$nav_menu->term_id] = $nav_menu->name;
}

$url = ASSETS_URI . 'images/metaboxui/';

$meta_boxes[] = array(
    'title'     => _x('Page / Post Layout', 'backend metabox', 'dahztheme'),
    'pages'     => array('page', 'post', 'portfolio'),
    'context'   => 'normal',
    'priority'  => 'high',
    'autosave'  => true,
    'fields'    => array(
                        array(
                            'name'      => _x('Layout', 'backend metabox', 'dahztheme'),
                            'id'        => "{$prefix}_layout_content",
                            'type'      => 'image_select',
                            'options'   => array(
                                            'two-col-left'  => $url . '2cl.png',
                                            'one-col'       => $url . '1c.png',
                                            'two-col-right' => $url . '2cr.png'
                                           ),
                            'std'       => 'two-col-left'
                        ),
                        array(
                            'name'      => _x('Enable sidebar off-canvas', 'backend metabox', 'dahztheme'),
                            'id'        => "{$prefix}_layout_sidebar_offcanvas",
                            'type'      => 'checkbox',
                            'std'       => 0
                        ),
                        array(
                            'name'      => _x('Enable footer', 'backend metabox', 'dahztheme'),
                            'id'        => "{$prefix}_footer",
                            'type'      => 'checkbox',
                            'std'       => 1
                        ),
                        array(
                            'name'      => _x('Primary menu', 'backend metabox', 'dahztheme'),
                            'id'        => "{$prefix}_custom_menu",
                            'type'      => 'select',
                            'options'   => $nav_menus_clear,
                            'std'       => 0
                        ),

));