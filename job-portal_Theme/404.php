<?php
/**
 * The template for displaying 404 pages (not found)
 * @package Job Portal
 */
get_header(); ?>
<section class="blog-page-section">
    <div class="container">
        
        <?php job_portal_breadcrums();?>

        <div class="row"> 
            <?php $custom_class = (get_theme_mod('blog_sidebar', 'right') == 'left') ? "9" : ((get_theme_mod('blog_sidebar', 'right') == 'right') ? "9" : "12"); 
            if ( get_theme_mod( 'blog_sidebar','right' ) == "left" ) { ?>
            <div class="col-lg-3 col-md-3 col-xs-12">
                <?php get_sidebar(); ?>    
            </div>
            <?php } ?>         
            <div class="col-lg-<?php echo esc_attr($custom_class); ?> col-md-<?php echo esc_attr($custom_class); ?> col-xs-12">
                <h3><?php esc_html_e( "Oops! That page can't be found.", 'job-portal' ); ?></h3>
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'job-portal'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php if ( get_theme_mod( 'blog_sidebar','right' ) == "right" ) { ?>
            <div class="col-lg-3 col-md-3 col-xs-12">
                <?php get_sidebar(); ?>    
            </div>
            <?php } ?> 
          </div>
        </div>
    </div>
</section>
<?php get_footer();