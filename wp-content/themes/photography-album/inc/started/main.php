<?php

add_action( 'admin_menu', 'photography_album_getting_started' );
function photography_album_getting_started() {
    add_menu_page( 
        esc_html__('Demo Importer', 'photography-album'), // Page title
        esc_html__('Demo Importer', 'photography-album'), // Menu title
        'manage_options', // Capability
        'photography-album-guide-page', // Menu slug
        'photography_album_test_guide', // Function that renders the page
        'dashicons-admin-generic', // Icon
        2 // Position in the dashboard menu
    );
}

if ( ! defined( 'PHOTOGRAPHY_ALBUM_DOCS_FREE' ) ) {
define('PHOTOGRAPHY_ALBUM_DOCS_FREE',__('https://www.mishkatwp.com/instruction/photography-album-free-docs/','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_DOCS_PRO' ) ) {
define('PHOTOGRAPHY_ALBUM_DOCS_PRO',__('https://www.mishkatwp.com/instruction/photography-album-pro-docs/','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_BUY_NOW' ) ) {
define('PHOTOGRAPHY_ALBUM_BUY_NOW',__('https://www.mishkatwp.com/themes/photography-album-wordpress-theme/','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_SUPPORT_FREE' ) ) {
define('PHOTOGRAPHY_ALBUM_SUPPORT_FREE',__('https://wordpress.org/support/theme/photography-album','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_REVIEW_FREE' ) ) {
define('PHOTOGRAPHY_ALBUM_REVIEW_FREE',__('https://wordpress.org/support/theme/photography-album/reviews/#new-post','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_DEMO_PRO' ) ) {
define('PHOTOGRAPHY_ALBUM_DEMO_PRO',__('https://www.mishkatwp.com/pro/photography-album/','photography-album'));
}
if ( ! defined( 'PHOTOGRAPHY_ALBUM_BUNDLE' ) ) {
define('PHOTOGRAPHY_ALBUM_BUNDLE',__('https://www.mishkatwp.com/themes/wordpress-theme-bundle/','photography-album'));
}

function photography_album_test_guide() { ?>
	<?php $photography_album_theme = wp_get_theme();

	require_once get_template_directory() .'/inc/started/demo-import.php'; ?>

	<div class="wrap" id="main-page">
		<div id="righty">
			<div class="getstart-postbox donate">
				<h4><?php esc_html_e( 'Discount Upto 25%', 'photography-album' ); ?> <span><?php esc_html_e( '"Special25"', 'photography-album' ); ?></span></h4>
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'photography-album' ); ?></h3>
				<div class="getstart-inside">
					<p><?php esc_html_e('Click to upgrade to see the enhanced pro features available in the premium version.','photography-album'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'photography-album' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'photography-album' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'photography-album' ) ?></a>
					</div>
				</div>
				<div class="d-table">
				    <ul class="d-column">
				      <li class="feature"><?php esc_html_e('Features','photography-album'); ?></li>
				      <li class="free"><?php esc_html_e('Pro','photography-album'); ?></li>
				      <li class="plus"><?php esc_html_e('Free','photography-album'); ?></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('24hrs Priority Support','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('LearnPress Campatiblity','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Kirki Framework','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Posttype','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('One Click Demo Import','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Section Reordering','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Enable / Disable Option','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Multiple Sections','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Color Pallete','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Widgets','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Page Templates','photography-album'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
		  		</div>
			</div>
		</div>
		<div id="lefty">
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','photography-album'); ?><?php echo esc_html( $photography_album_theme ); ?>  <span><?php esc_html_e('Version: ', 'photography-album'); ?><?php echo esc_html($photography_album_theme['Version']);?></span></h3>
				<div class="demo-import-box">
					<h4><?php echo esc_html('Import homepage demo in just one click.','photography-album'); ?></h4>
					<p><?php echo esc_html('Get started with the WordPress theme installation','photography-album'); ?></p>
					<?php if(isset($_GET['import-demo']) && $_GET['import-demo'] == true){ ?>
			    		<p class="imp-success"><?php echo esc_html('Imported Successfully','photography-album'); ?></p>
			    		<a class="blue-button-1" href="<?php echo esc_url(home_url()); ?>" target="_blank"><?php echo esc_html('Go to Homepage','photography-album'); ?></a>
			    	<?php } else { ?>
					<form id="demo-importer-form" action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php" method="POST">
			        	<input type="submit" name="submit" value="<?php esc_attr_e('Get Start With Photography Album','photography-album'); ?>" class="blue-button-2">
			    	</form>
			    	<?php } ?>
				</div>
				<h4><?php esc_html_e('Begin with our theme features','photography-album'); ?></span></h4>
				<div class="customizer-inside">
					<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'Add Menus', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>"><?php esc_html_e('Go to Menu', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to menu >> Select menu which you had created >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'Add Logo', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>"><?php esc_html_e('Go to Site Identity', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Site Identity >> Select Logo Add Title or Tagline >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'Home Page Section', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=photography_album_home_page_section') ); ?>"><?php esc_html_e('Go to Home Page Section', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Home Page Sections >> Then go to different section which ever you want >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'Post Options', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=photography_album_post_image_on_off') ); ?>"><?php esc_html_e('Go to Post Options', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post Options >> Then go to different settings which ever you want >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'Post Layout Options', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=photography_album_post_layout') ); ?>"><?php esc_html_e('Go to Post Layout Options', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post Layout Options >> Then go to different settings which ever you want >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	<div class="photography-album-theme-setting-item">
                        <div class="photography-album-theme-setting-item-header">
                            <?php esc_html_e( 'General Options Options', 'photography-album' ); ?>                            
                       	</div>
                        <div class="photography-album-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=photography_album_preloader_setting') ); ?>"><?php esc_html_e('Go to General Options', 'photography-album'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post General Options >> Then go to different settings which ever you want >> Then Publish ', 'photography-album' ); ?></p>
                	</div>
                	
                	<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("Customize All Fonts", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("Customize All Color", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("Section Reorder", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("Typography Options", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("One Click Demo Import", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>
					<a target="_blank" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" class="photography-album-theme-setting-item photography-album-theme-setting-item-unavailable">
					    <div class="photography-album-theme-setting-item-header pro-option">
					        <span><?php esc_html_e("Background  Settings", "photography-album"); ?></span> <span><?php esc_html_e("Premium", "photography-album"); ?></span>
					    </div>
					</a>
					
				</div>
			</div>
		</div>
		<div id="righty">
			<div class="photography-album-theme-setting-sidebar-item">
		        <div class="photography-album-theme-setting-sidebar-header"><?php esc_html_e( 'Free Documentation', 'photography-album' ) ?></div>
		        <div class="photography-album-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Our guide is available if you require any help configuring and setting up the theme.', 'photography-album' ) ?></p>
		            <div id="admin_links">
		            	<a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Free Documentation', 'photography-album' ) ?></a>
		            </div>
		        </div>
		    </div>
		    <div class="photography-album-theme-setting-sidebar-item">
		        <div class="photography-album-theme-setting-sidebar-header"><?php esc_html_e( 'Support', 'photography-album' ) ?></div>
		        <div class="photography-album-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Visit our website to contact us if you face any issues with our lite theme!', 'photography-album' ) ?></p>
		            <div id="admin_links">
		            	<a class="blue-button-2" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'photography-album' ) ?></a>
		            </div>
		        </div>
		    </div>
		    <div class="photography-album-theme-setting-sidebar-item">
		        <div class="photography-album-theme-setting-sidebar-header"><?php esc_html_e( 'Review', 'photography-album' ) ?></div>
		        <div class="photography-album-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Are you having fun with Photography Album? Review us on WordPress.org to show your support!', 'photography-album' ) ?></p>
		            <div id="admin_links">
		            	<a href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_REVIEW_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Review', 'photography-album' ) ?></a>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

<?php } ?>