<?php
/**
 * The template for displaying nothing found.
 * Used when no post are found.
 * @theme jacqui
 * @since 0.1
 */
?>
<div class="entry-content">
    <article>

    <h1><?php esc_html_e( 'No content found for that request', 'jacqui' ); ?></h1>
    <h2><?php esc_html_e( 'You may want to try a search for similar content. You can use this search bar.', 'jacqui' ); ?></h2>
        
        <div class="found-none">
            <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label class="screen-reader-text" for="s"><?php esc_html_e( 'SEARCH', 'jacqui' ); ?></label>
                <label class="icon-search"><i class="fa fa-search"></i></label>
                <div class="input-container">    
                    <input class="custom-text" type="text" placeholder="<?php esc_html_e( 'Search', 'jacqui' ); ?>" name="s" id="s"/>
                    <input type="submit" class="search-submit" />
                </div>
            </form>
        </div>

    </article>
</div><!-- .entry-content -->

    <?php get_template_part( 'content', 'footer' ); ?>

