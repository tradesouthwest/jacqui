            <div class="row" id="jqi-p">
                <div class="c12" id="jqi-profile">
                <?php 
                $args      = array( 'post_type' => 'custom_profile', 
                                    'posts_per_page' => 12          // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
                                ); 
                $the_query = new WP_Query( $args ); 
                    if ( $the_query->have_posts() ) : ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <article class="c4 profile-container">

                        <figure>

                        <?php 
                        if( has_post_thumbnail() ) {
                            $attachment_page_url = '';
                            $attachment_page_url = get_attachment_link( get_post_thumbnail_id() ); ?>
                            <a href="<?php echo esc_url( $attachment_page_url ); ?>" class="featured-image">
                                <?php the_post_thumbnail(); ?></a>
                        <?php 
                            } else { 
                                echo '<div class="no-thumb"></div>'; 
                        } ?>
                        </figure>

                            <div class="profile-content">
                                <h2><?php the_title(); ?></h2>
                            
                                    <?php the_content(); ?> 
                            </div>

                    </article>

                    <?php endwhile; wp_reset_postdata(); endif; ?>	
                    
                </div>		
            </div><!-- ends profile row -->