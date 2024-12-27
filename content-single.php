<?php
/**
 * The template for displaying single posts.
 *
 * @theme jacqui
 * @since 0.1
 */
while ( have_posts() ) : the_post(); ?>	
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php 
                if ( has_post_thumbnail() ) { 
                    the_post_thumbnail(); 
                    } else { 
                    echo '<div class="no-thumb"></div>'; 
                } ?>
                <?php 
                the_content( __( 'Read more &rarr;', 'jacqui' ) ); ?>

                    <div class="entry-date">
                
                        <?php the_date('','<h4>','</h4>'); ?>

                    </div>

    </article>
<?php endwhile; // end of the loop ?>
