<?php /* Jacqui theme footer */
        get_sidebar(); ?>
    
    </main> <!-- #main.row -->
</div> <!-- #page.grid -->

<?php 
    $jacqui_theme_options = ( ''!= jacqui_theme_options() ) ? esc_attr( jacqui_theme_options() ) : null; ?>

    <div class="grid <?php echo esc_attr( $jacqui_theme_options['width'] ); ?>">
       <div class="row">
           <nav id="site-navigation" class="c12" role="navigation">
                <?php 
                if( has_nav_menu( 'custom-menu' )) : 
                    wp_nav_menu( array( 'theme_location' => 'custom-menu', 'container_class' => 'custom-class' ) ); ?>
                <?php else : ?>
                <div class="no-menu"></div>

                <?php 
                endif; ?>
           </nav>		
        </div>
    </div><div class="clearfix"></div>

        <footer class="footer" role="contentinfo">
            <div class="wfull">

                <section class="row">
                    <div class="c12">
                        <?php 
                        if ( is_active_sidebar( 'footer-wide-area' )) : ?>
                        
                        <ul id="sidebar">

                            <?php dynamic_sidebar( 'footer-wide-area' ); ?>

                        </ul>
                        <?php 
                        endif; ?>
                    </div><!-- ends c12 -->
                </section>

                    <section class="row">
                        <div class="c12" id="footer-content">
                            <p class="copyright"><span class="fl">&copy; <?php 
                                echo esc_attr( date("Y") );                     // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
                                ?><a href="<?php echo esc_url( home_url("/") ); ?>"><?php echo bloginfo("name"); ?></a>.
                                <?php 
                                esc_html_e( ' All Rights Reserved.', 'jacqui' ); ?></span> 
                                <span class="credit-link fr"> <?php 
                                do_action( 'jacqui_footer_credits' ); ?></span>
                            </p>
                        </div><!-- .c12 -->
                    </section>

	        </div><!-- .wfull -->
        </footer><!-- #footer -->

<?php 
wp_footer(); ?>
</body>
</html>
