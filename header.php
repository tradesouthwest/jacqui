<!DOCTYPE html>
<?php 
/**
 * Jacqui theme for ClassicPress - `header.php`
 * @since 1.0.3
 */ 

$jacqui_theme_options = jacqui_theme_options(); 
?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="page" class="grid<?php echo esc_html( ' ' . $jacqui_theme_options['width'] ); ?>">

        <nav id="site-navigation" class="c12" role="navigation">
            <?php 
            if( has_nav_menu( 'custom-menu' )) : 
                 wp_nav_menu( array( 'theme_location' => 'custom-menu', 'container_class' => 'custom-class' ) ); ?>
               <?php else : ?><div class="no-menu"></div>
            <?php 
            endif; ?>
        </nav>

        <header id="header" class="row" role="banner">
            <div class="c12">
                <div id="mobile-menu">
                    <a href="#" class="left-menu"><i class="fa fa-navicon"></i></a>
                    <a href="#"><i class="fa fa-sort"></i></a>
                </div>
            </div>
        
                <section class="c9">
                    <div class="header-wrap">
                        <?php $header_image = get_header_image();
			            if ( ! empty( $header_image ) ) : ?>

                        <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                        rel="home"><img id="header-img" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" 
                        height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
		            	<?php 
                        endif; ?>

                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                            title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                            rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

                    </div><!-- ends header-wrap -->
                </section>

                    <section class="c3 end" id="top-right">
                        <?php
                        // Header Widgetized Area
		                get_sidebar( 'header-area' ); ?>
                    </section>

                        <nav id="site-navigation" class="c12" role="navigation">
                            <h3 class="screen-reader-text"><?php esc_html_e( 'Main Menu', 'jacqui' ); ?></h3>
                            <a class="screen-reader-text" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'jacqui' ); ?>">
                                <?php esc_html_e( 'Skip to content', 'jacqui' ); ?></a>
                            <?php 
                            if( has_nav_menu( 'primary' )) : wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
                                <?php 
                                else : ?>
                            <div class="no-menu"></div>
                            <?php 
                            endif; ?>
                        </nav><!-- #site-navigation -->
        </header><!-- #header .row -->

            <?php 
            if( ! is_single() ) { ?>
            <?php get_template_part( 'content', 'profile' ); ?>
            <?php 
            } ?>
                <main id="main" class="row">
                    <div id="left-nav"></div>
