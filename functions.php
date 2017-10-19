<?php
class Walker_Quickstart_Menu extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<li><a href='%s'%s>%s</a></li>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }

}
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


function admin_bar( $wp_admin_bar) {
  if ( !is_user_logged_in() )
  $wp_admin_bar->add_menu( array( 'title' => __( 'Log In' ), 'href' => wp_login_url() ) );
}
add_action( 'admin_bar_menu', 'admin_bar' );
add_filter( 'show_admin_bar', '__return_true' , 1000 );
function custom( $wp_customize )
{

    //  =============================
    //  = Text Input 2               =
    //  =============================
    $wp_customize->add_section('text', array(
        'title'    => __('Text Test', 'name'),
        'description' => '',
        'priority' => 10,
    ));

    $wp_customize->add_section('late', array(
        'title'    => __('Text test 2', 'name'),
        'description' => '',
        'priority' => 20,
    ));

    $wp_customize->add_setting('custom_ket', array(
        'default'        => 'value_xyz',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
     $wp_customize->add_setting('ket2', array(
        'default'        => 'value_xyz',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('themename_text_test', array(
        'label'      => __('Text Test', 'name'),
        'section'    => 'text',
        'settings'   => 'custom_ket',
        'type'    => 'textarea',
    ));
    $wp_customize->add_control('ed2', array(
        'label'      => __('Text test 2', 'name'),
        'section'    => 'late',
        'settings'   => 'ket2',
        'type'    => 'textarea',
    ));

    //  =============================
    //  = Text Input2                =
    //  =============================

}
add_action( 'customize_register', 'custom' );
?>
