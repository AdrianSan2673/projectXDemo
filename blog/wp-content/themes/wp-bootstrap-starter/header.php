<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body class="hold-transition layout-navbar-fixed layout-top-nav">
<div id="page" class="wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light ml-0 <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
        <div class="container">
            <div class="navbar-brand">
				<?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
				<a href="<?php echo esc_url( home_url( '/' )); ?>">
					<img src="<?php echo esc_url(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="img-fluid logo">
				</a>
				<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
				<?php endif; ?>

			</div>
			<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<?php
			wp_nav_menu(array(
				'theme_location'    => 'primary',
				'container'       => 'div',
				'container_id'    => 'main-nav',
				'container_class' => 'collapse navbar-collapse order-3',
				'menu_id'         => false,
				'menu_class'      => 'navbar-nav mx-auto',
				'depth'           => 3,
				'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
				'walker'          => new wp_bootstrap_navwalker()
			));
			?>

        </div>
	</nav><br><!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
            <div class="container">
                <h1>
                    <?php
                    if(get_theme_mod( 'header_banner_title_setting' )){
                        echo get_theme_mod( 'header_banner_title_setting' );
                    }else{
                        echo 'WordPress + Bootstrap';
                    }
                    ?>
                </h1>
                <p>
                    <?php
                    if(get_theme_mod( 'header_banner_tagline_setting' )){
                        echo get_theme_mod( 'header_banner_tagline_setting' );
                }else{
                        echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','wp-bootstrap-starter');
                    }
                    ?>
                </p>
                <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
            </div>
        </div>
    <?php endif; ?>
	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <?php endif; ?>