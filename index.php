<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 * @theme jacqui
 * @since jacqui 0.1
 */
get_header(); ?>

    <div id="primary" <?php esc_attr( jacqui_primary_attr() ); ?>>
    <?php 
    if ( have_posts() ) : ?>
        <?php 
        get_template_part( 'content' ); ?>
         
        <?php comments_template(); ?>

        <?php 
        else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
    <?php 
    endif; // end of the loop. ?>

    </div><!-- #primary.c8 -->
<?php 
get_footer(); ?>