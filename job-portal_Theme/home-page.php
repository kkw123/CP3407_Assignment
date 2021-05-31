<?php
/**
 * The template for displaying blog
 * template Name: Home
 * @package job-portal
 */
get_header(); ?>
<!--featured job section start-->
<?php if(!get_theme_mod('front_page_featured_jobs_switch',false)):
 $number = get_theme_mod('front_page_featured_jobs_post_limit',4);
 $category_list = get_theme_mod('front_page_featured_jobs_post_category','');
$job_portal_category_r = new WP_Query( apply_filters( 'front_page_featured_jobs_posts_args', array( 'posts_per_page' => $number,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );    ?>
<section class="featured-jobs">
    <div class="container">
        <div class="row">
            <div class="featured-jobs-title">
                <h2 class="featured-jobs-main-title"><?php echo esc_html(get_theme_mod('front_page_featured_jobs_title',esc_html__('Featured Jobs','job-portal'))); ?></h2>
                <?php if(get_theme_mod('front_page_featured_jobs_subtitle','')!=''): ?>
                    <h6 class="featured-jobs-sub-title"><?php echo esc_html(get_theme_mod('front_page_featured_jobs_subtitle')); ?></h6>
                <?php endif; ?>
            </div>
        </div>
    </div>     
    <div class="container">
        <!--1st row start-->        
        <?php if ($job_portal_category_r->have_posts()) : $count=0; ?>
           <div class="row">
           <?php while ( $job_portal_category_r->have_posts() ) : $job_portal_category_r->the_post(); ?>        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="featured-job-item">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <?php if(!get_theme_mod('front_page_featured_jobs_image_switch',false) && has_post_thumbnail()): ?>                                
                            <div class="company-logo">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                            </div>
                            <?php endif; ?>                            
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="featured-job-title">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </div>
                            <?php if(!get_theme_mod('front_page_featured_jobs_date_switch',false)): ?>
                            <div class="featured-job-posted-date">
                                <h6><?php esc_html_e('Posted on: ','job-portal'); echo esc_html(get_the_date()); ?></h6>
                            </div>
                            <?php endif; ?>
                            <div class="featured-job-details">
                                <div class="featured-job-deatil-item">
                                   <?php the_excerpt(); ?>
                                </div>                                
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>                        
           <?php endwhile;?>
        </div><!--1st row end-->
        <?php endif; ?>
    </div>
</section>
<!--featured job section end-->
<?php endif; 

if(!get_theme_mod('front_page_about_us_switch',false)): ?>
<!--search job section start-->
<section class="search-jobs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="search-jobs-details">
                    <div class="search-jobs-details-title">
                        <h2><?php echo esc_html(get_theme_mod('front_page_about_us_title',esc_html__('About Us','job-portal'))); ?></h2>
                    </div>
                    <?php if(get_theme_mod('front_page_about_us_subtitle',esc_html__('About Us Sub Title','job-portal'))!=''): ?>
                    <div class="search-jobs-details-subtitle">
                        <h5><?php echo esc_html(get_theme_mod('front_page_about_us_subtitle',esc_html__('About Us Sub Title','job-portal'))); ?></h5>
                    </div>
                    <?php endif; 
                    if(get_theme_mod('front_page_about_us_content','')!=''): ?>
                    <div class="search-jobs-details-text">
                        <p><?php echo wp_kses_post(get_theme_mod('front_page_about_us_content')); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if(!get_theme_mod('front_page_about_us_btn_switch',false)): ?>
                    <div class="search-jobs-button">
                        <button class="btn btn-primary"><a href="<?php echo esc_url(get_theme_mod('front_page_about_us_btn_url',home_url('/'))); ?>"><?php echo esc_html(get_theme_mod('front_page_about_us_btn_text',esc_html__('Read More','job-portal'))); ?></a></button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="search-jobs-image">
                </div>
            </div>
        </div>
    </div>
</section>
<!--search job section end-->
<?php endif ;

if(!get_theme_mod('front_page_latest_blog_switch',false)): 
$category_list = get_theme_mod('front_page_latest_blog_category','');
$job_portal_latest_post = new WP_Query( apply_filters( 'front_page_featured_jobs_posts_args', array( 'posts_per_page' => 3,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );    ?>
<!--latest blog-post section start-->
<section class=" featured-jobs latest-blog-post">
    <div class="container">
        <div class="row">
            <div class="featured-jobs-title">
                <h2 class="featured-jobs-main-title"><?php echo esc_html(get_theme_mod('front_page_latest_blog_title',esc_html__('Latest Blog Post','job-portal'))); ?></h2>
                <?php if(get_theme_mod('front_page_latest_blog_subtitle','')!=''): ?>
                    <h6 class="latest-blog-sub-title"><?php echo esc_html(get_theme_mod('front_page_latest_blog_subtitle')); ?></h6>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($job_portal_latest_post->have_posts()) : ?>
        <div class="row">
            <?php while ( $job_portal_latest_post->have_posts() ) : $job_portal_latest_post->the_post(); ?> 
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="blog-post-item">
                    <?php if(!get_theme_mod('front_page_latest_blog_image_switch',false) && has_post_thumbnail()): ?>                                
                        <div class="blog-post-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="blog-post-title">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    </div>
                    <div class="blog-post-text">
                        <?php the_excerpt(); ?>
                    </div>                    
                </div>
            </div>            
            <?php endwhile;?> 
        </div>
    <?php endif;?> 
    </div>
</section>
<!--latest blog-post section end-->
<?php endif; 

get_footer();