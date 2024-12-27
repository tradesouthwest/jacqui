<?php
/* single template
 * shows posts
 * @theme Jacqui
 */
get_header(); ?>

    <div id="primary" <?php esc_attr( jacqui_primary_attr() ); ?>>
    <?php 
    if ( have_posts() ) : ?>
    
        <?php get_template_part( 'content', 'single' ); ?>
        
            <?php comments_template(); ?>
            
                <?php get_template_part( 'content', 'footer' ); ?>
        <?php 
        else : get_template_part( 'content', 'none' ); ?> 
    <?php 
    endif; ?>
            <div id="navigation">
                <p><?php previous_post_link();  ?> <span> <?php next_post_link(); ?></span></p>
            </div>
    </div><!-- #primary.c8 -->

<?php 
get_footer(); ?>