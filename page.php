<?php
/* page template
 * shows blog if static and most pages without a home; not posts
 * @theme jacqui
 * @since jacqui 0.1
 */
get_header(); ?>

    <section id="primary" <?php esc_attr( jacqui_primary_attr() ); ?>>
        <?php 
        if ( have_posts() ) : ?>
        
            <?php 
            get_template_part( 'content' ); ?>

        <?php else : ?>
            <?php 
            get_template_part( 'content', 'none' ); ?>
            
        <?php 
        endif; // end of the loop. ?>
    </section><!-- #primary.c8 -->

<?php get_footer(); ?>
