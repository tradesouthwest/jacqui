<?php 
/* search template
 * @theme jacqui
 */
get_header(); ?>
    <section id="primary" <?php esc_attr( jacqui_primary_attr() ); ?>>
		
        <?php 
        if ( have_posts() ) : ?>
        <header id="archive-header">
            <h1 class="page-title"><?php 
            global $wp_query;
            $num = $wp_query->found_posts;
                printf( '%1$s "%2$s"',
                    esc_attr( $num ) . esc_html__( ' search results for', 'jacqui'),
                    get_search_query()
                ); ?></h1>
        </header><!-- #archive-header -->

            <?php 
            get_template_part( 'content', 'excerpt' ); ?>
            <?php 
            jacqui_pagination(); ?>

        <?php else : 
            get_template_part( 'content', 'none' );
        endif; ?>

    </section><!-- #primary.c8 -->
<?php get_footer(); ?>
