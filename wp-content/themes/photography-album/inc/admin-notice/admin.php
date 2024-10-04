<?php 
/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action( 'wp_ajax_photography_album_dismissed_notice_handler', 'photography_album_ajax_notice_handler' );

/** * AJAX handler to record dismissible notice status. */
function photography_album_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function photography_album_admin_notice_deprecated_hook() {
        $current_screen = get_current_screen();
        if ($current_screen->id !== 'toplevel_page_photography-album-guide-page') {
        if ( ! get_option('dismissed-get_started', FALSE ) ) { ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="photography-album-getting-started-notice clearfix">
                    <div class="photography-album-theme-notice-content">
                        <h2 class="photography-album-notice-h2">
                            <?php
                            echo esc_html__( 'Let\'s Create Your website With', 'photography-album' ) . ' <strong>' . esc_html( wp_get_theme()->get('Name') ) . '</strong>';
                            ?>
                        </h2>
                        <span class="st-notification-wrapper">
                            <span class="st-notification-column-wrapper">
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Feature Rich WordPress Theme','photography-album'); ?></h2>
                                    <ul class="st-notification-column-list">
                                        <li><?php echo esc_html('Live Customize','photography-album'); ?></li>
                                        <li><?php echo esc_html('Detailed theme Options','photography-album'); ?></li>
                                        <li><?php echo esc_html('Cleanly Coded','photography-album'); ?></li>
                                        <li><?php echo esc_html('Search Engine Friendly','photography-album'); ?></li>
                                    </ul>
                                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=photography-album-guide-page' ) ); ?>" target="_blank" class="button-primary button"><?php echo esc_html('Get Started With Photography Album','photography-album'); ?></a>
                                </span>
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Customize Your Website','photography-album'); ?></h2>
                                    <ul>
                                        <li><a href="<?php echo esc_url( admin_url( 'customize.php' ) ) ?>" target="_blank" class="button button-primary"><?php echo esc_html('Customize','photography-album'); ?></a></li>
                                        <li><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ) ?>" class="button button-primary"><?php echo esc_html('Add Widgets','photography-album'); ?></a></li>
                                        <li><a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('Get Support','photography-album'); ?></a> </li>
                                    </ul>
                                </span>
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Get More Options','photography-album'); ?></h2>
                                    <ul>
                                        <li><a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DEMO_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('View Live Demo','photography-album'); ?></a></li>
                                        <li><a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="button button-primary"><?php echo esc_html('Purchase Now','photography-album'); ?></a></li>
                                        <li><a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DOCS_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('Free Documentation','photography-album'); ?></a> </li>
                                    </ul>
                                </span>
                            </span>
                        </span>

                        <style>
                        </style>
                    </div>
                </div>
            </div>
        <?php }
    }
}

add_action( 'admin_notices', 'photography_album_admin_notice_deprecated_hook' );

function photography_album_switch_theme_function () {
    delete_option('dismissed-get_started', FALSE );
}

add_action('after_switch_theme', 'photography_album_switch_theme_function');