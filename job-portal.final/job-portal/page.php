<?php
get_header(); ?>

<section class="single-blog-page-section">
    <div class="container">

        <?php job_portal_breadcrums();?>

        <div class="row">
            <?php $custom_class = (get_theme_mod('single_sidebar', 'right') == 'left') ? "9" : ((get_theme_mod('single_sidebar', 'right') == 'right') ? "9" : "12"); 
            if ( get_theme_mod( 'single_sidebar','right' ) == "left" ) { ?>
            <div class="col-lg-3 col-md-3 col-xs-12">
                <?php get_sidebar(); ?>    
            </div>
            <?php } ?>
            <div class="col-lg-<?php echo esc_attr($custom_class); ?> col-md-<?php echo esc_attr($custom_class); ?> col-xs-12">
                <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); 
                        get_template_part('templates/content','page');                   
                  endwhile;
               endif; ?>
            </div>

            <?php if ( get_theme_mod( 'single_sidebar','right' ) == "right" ) { ?>
            <div class="col-lg-3 col-md-3 col-xs-12">
                <?php get_sidebar(); ?>    
            </div>
            <?php } ?>

            </div>
        </div>
    </div>
</section>
<?php get_footer();