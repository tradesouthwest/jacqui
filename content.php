<?php
/**
 * The template for displaying full content.
 *
 * @theme jacqui
 * @since 0.1
 */
while ( have_posts() ) : the_post(); ?>	
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <div class="entry-content">
                <?php 
                the_content( esc_attr__( 'Read more &rarr;', 'jacqui' ) ); ?>

                    <div class="navigation">
                
                        <?php wp_link_pages(); ?>

                    </div>
            </div>

                <?php get_template_part( 'content', 'footer' ); ?>

                    <aside><?php comments_template(); ?></aside>

    </article><div class="clearfix"></div>
<?php endwhile; // end of the loop ?>

        <div id="navigation">
            <p><?php 
            posts_nav_link(); ?></p>
        </div>
