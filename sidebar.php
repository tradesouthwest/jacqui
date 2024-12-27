<?php
/**
 * Sidebar for theme Jacqui
 */
$jacqui_theme_options = get_option( 'jacqui_theme_options' );
if ( 3 != $jacqui_theme_options['layout'] ) {
?>
<div id="secondary" <?php esc_attr( jacqui_sidebar_class() ); ?> role="complementary">
    <div id="sidebar-one">
        <?php 
        if ( ! is_active_sidebar( 'sidebar') ) : ?>

        <aside id="meta" class="widget">
            <h3 class="widget-title"><?php 
                esc_html_e( 'Meta', 'jacqui' ); ?></h3>
                <ul>
                    <?php 
                    wp_register(); ?>
                    <li><?php 
                    wp_loginout(); ?></li>
                    <?php 
                    wp_meta(); ?>
                </ul>
        </aside>

            <aside id="archives" class="widget">
                <h3 class="widget-title"><?php 
                    esc_html_e( 'Archives', 'jacqui' ); ?></h3>
                    <ul>
                        <?php 
                        wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                    </ul>
            </aside>

        <?php else : 
            dynamic_sidebar( 'sidebar' ); ?>
<?php 
endif; ?>

    </div><!-- #sidebar-one -->
</div><!-- #secondary.widget-area -->
<?php
}
?>
