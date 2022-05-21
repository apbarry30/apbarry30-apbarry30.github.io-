<?php


// helper to check if the current page is the login screen
function is_login_page() {
    return !strncmp($_SERVER['REQUEST_URI'], '/wp-login.php', strlen('/wp-login.php'));
}


// deregister styles  & setup cache
add_action('wp_print_styles', 'ogk_deregister_styles', 100);
function ogk_deregister_styles() {

    if ( !is_admin() ) :

        global $theme_setup;
        global $wp_styles;

        if ( !is_user_logged_in() && !is_login_page() ) {

            if ( $theme_setup['disable_dash_icon_styles'] ) :
                wp_deregister_style('dashicons');
            endif;

            if ( $theme_setup['disable_admin_bar_styles'] ) :
                wp_deregister_style('admin-bar');
            endif;

        }

        if ( $theme_setup['disable_block_library'] ) :
            wp_deregister_style('wp-block-library');
        endif;

    endif;

}

/**
 *  Reusable Sections
 *
 *  The function that grabs all section parts from the sections folder
 */
function ogk_get_reusable_sections() {
    $files = glob(get_template_directory() . '/sections/*');

    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $file_str_name = str_replace('section-', '', $filename);
        $file_layout_name = str_replace('-', '_', $file_str_name);
        $file_layout_name .= '_section';

        if (get_row_layout() == $file_layout_name ) {
            get_template_part('sections/section', $file_str_name);
        }
    }
}

/**
 *  OGK Button
 *
 *  The function that renders a button
 * @param string $class
 * @param bool $download
 * @param string $link_selector
 * @param string $text_selector
 *
 * @return string
 */
function ogk_button( $class, $download = false, $link_selector = 'button_link', $text_selector = 'button_text' ) {
    ob_start(); ?>
    <div class="btn-wrap">
        <a href="<?= get_sub_field($link_selector) ?>" class="<?= $class ?>"<?php if($download == true): ?> download<?php endif; ?>><?= get_sub_field($text_selector) ?></a>
    </div>
    <?php echo ob_get_clean();
}


/**
 *   Create ACF options pages
 */
// ACF option pages
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'site-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ) );

}




/** =========================================================================================== **/
/**
 *  THEMED LOGIN PAGE
 */
function custom_login() { ?>
    <style type="text/css">
        body {
            background-color: #11090B !important;
            color: #222 !important;
        }

        .login .message, .login .success, .login #login_error {
            background-color: #eee !important;
            color: #11090B;
            border-left-color: #999 !important;
        }

        #login form {
            background: #eee;
        }

        form .submit input {
            background: #11090B !important;
            color: #fff !important;
            box-shadow: none !important;
            text-shadow: none !important;
            border-radius: 0 !important;
            border: none !important;
            text-transform: uppercase;
            font-weight: 700;

        }

        form .submit input:hover {
            background: #fff !important;
            color: #11090B !important;
            border: 2px solid #ddd !important;
        }

        #login h1 a, .login h1 a {
            background-image: url(<?= get_template_directory_uri() ?>/images/OGK_Logo_White.svg);
            height: 65px;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }

        #login path {
            fill: #000;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'custom_login' );

/** =========================================================================================== **/
/**
 * @return string|void
 * Login Logo to redirect to homepage
 */
function my_login_logo_url() {
    return home_url();
}

add_filter( 'login_headerurl', 'my_login_logo_url' );

/** =========================================================================================== **/

add_theme_support( 'menus' ); // add menus
add_theme_support( 'post-thumbnails' ); // add featured iamges
add_post_type_support( 'page', 'excerpt' ); // add excerpts

/** =========================================================================================== **/

/**
 * REGISTER MAIN MENU
 */
function register_my_menu() {
    register_nav_menus(
        array(
            'main-menu'   => __( 'Main Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}

add_action( 'init', 'register_my_menu' );

/**
 * @param $ulclass
 *
 * @return string|string[]|null
 */
function add_menuclass( $ulclass ) {
    return preg_replace( '/<a/', '<a class="menu-item"', $ulclass, - 1 );
}

add_filter( 'wp_nav_menu', 'add_menuclass' );

/** =========================================================================================== **/

/**
 * Allow shortcodes in menu items
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function wp_nav_menu_items( $items, $args ) {
    $items = do_shortcode( $items );

    return $items;
}

add_filter( 'wp_nav_menu_items', 'wp_nav_menu_items', 10, 2 );

/** =========================================================================================== **/

/**
 * add SVG to allowed file uploads
 *
 * @param $file_types
 *
 * @return array
 */
function add_file_types_to_uploads( $file_types ) {

    $new_filetypes        = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types           = array_merge( $file_types, $new_filetypes );

    return $file_types;
}

add_action( 'upload_mimes', 'add_file_types_to_uploads' );

/** =========================================================================================== **/

/**
 * OGKlip function
 * Missy's function for clipping a string to a desired length.
 */
function ogklip( $string, $width = 100 ) {
    $wrapped = wordwrap( $string, $width );
    $lines   = explode( "\n", $wrapped );
    $new_str = $lines[0] . '...';

    return $new_str;
}