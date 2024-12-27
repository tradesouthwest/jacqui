<?php
/**
 * The template for displaying excerpts.
 * Excerpts may need to be enabled from the Screen Options handle.
 * 
 * @since 1.0.0
 */
while ( have_posts() ) : the_post(); ?>	
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <div class="entry-content">

                <?php 
                the_excerpt(); ?>

            </div><!-- .entry-content -->
                <?php 
                get_template_part( 'content', 'footer' ); ?>

    </article>
<?php endwhile; // end of the loop ?>