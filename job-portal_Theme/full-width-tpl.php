<?php
/**
 * The template for displaying blog
 * template Name: Full Width
 * @package job-portal
 */
get_header(); ?>

<section class="single-blog-page-section">
    <div class="container">        
        <div class="row">            
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); 
                        get_template_part('templates/content','page');                    
                  endwhile;
               endif; ?>
            </div>            
        </div>
    </div>    
</section>
<?php get_footer();