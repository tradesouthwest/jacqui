<?php
/* Image template, shows images.
 * @since 1.0.3
 */
get_header(); ?>

<div id="primary" <?php esc_attr( jacqui_primary_attr() ); ?>>
    <?php 
if ( have_posts() ) : ?> 
    <?php 
    while ( have_posts() ) : the_post(); ?>
    <div class="entry-meta">
        <?php
        $metadata = wp_get_attachment_metadata();
        echo esc_html__( 'Published&#058; ', 'jacqui' ) . '<span class="entry-date"><time class="entry-date" 
            datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) .'</time></span> 
            | ' . esc_html__( 'Orig&#39; Resolution&#058; ', 'jacqui' ) .'<a href="' . esc_url( wp_get_attachment_url() ) .'" 
            title="' . esc_attr( get_the_title( $post->post_parent ) ) . '">' . esc_attr( $metadata['width'] ) . ' &times; ' . esc_attr( $metadata['height'] ) . '</a> 
            | ' . esc_html__( 'Gallery&#058;', 'jacqui' ) . '<a href="' . esc_url( get_permalink( $post->post_parent ) ) . '" 
            title="' . esc_attr__( 'Return to ', 'jacqui' ) . esc_attr( get_the_title( $post->post_parent ) ) . '" 
            rel="gallery">' . esc_html( get_the_title( $post->post_parent ) ) . '</a>'; 
        ?>
    </div><!-- .entry-meta -->
        <div class="entry-attachment">
            <div class="attachment">
                <?php
                /**
                 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                 * or the first image (if we're looking at the last ), or, in a gallery of one, just the link to that image file
                 */
                $attachments = array_values( get_children( array( 
                'post_parent'    => $post->post_parent, 
                'post_status'    => 'inherit', 
                'post_type'      => 'attachment', 
                'post_mime_type' => 'image', 
                'order'          => 'ASC', 
                'orderby'        => 'menu_order ID' 
                ) ) );
                    foreach ( $attachments as $k => $attachment ) {
                        if ( $attachment->ID == $post->ID )
                            break;
                    }
                    $k++;
                    // If there is more than 1 attachment in a gallery
                    if ( count( $attachments ) > 1 ) {
                        if ( isset( $attachments[ $k ] ) )
                        // get the URL of the next image attachment
                            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                            else
                        // or get the URL of the first image attachment
                                $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                                } else {
                                        // or, if there's only 1 image, get the URL of the image
                                        $next_attachment_url = wp_get_attachment_url();
                        } ?>
                    <a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                    $attachment_size = apply_filters( 'jacqui_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
                    echo wp_get_attachment_image( $post->ID, $attachment_size ); ?></a>
            </div><!-- .attachment -->
 
                <?php 
                if ( ! empty( $post->post_excerpt ) ) : ?>
                <div class="entry-caption">
                
                    <?php 
                    the_excerpt(); ?>

                </div><!-- .entry-caption -->
                <?php 
                endif; ?>

        </div><!-- .entry-attachment -->
        
            <?php 
            comments_template(); ?>

    <?php 
    endwhile; // end of the loop. ?>
            <?php 
            get_template_part( 'content', 'footer' ); ?>
        
    <?php 
        else : get_template_part( 'content', 'none' ); ?> 
    <?php 
endif; ?>
</div><!-- #primary.c8 -->
<?php 
get_footer(); ?>