<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> >
    <?php  if(!get_theme_mod('single_post_image', false) &&  has_post_thumbnail()): ?>
       <div class="blog-image">
        <?php the_post_thumbnail(); ?>
       </div>
    <?php endif; ?>   
    <?php if(!get_theme_mod('single_post_meta_tag', false)){ 
        job_portal_post_meta();
     } ?>
    <div class="blog-post-text">
        <?php the_content(); 
        wp_link_pages( array(
            'before'      => esc_html__( 'Pages:', 'job-portal' ),
            'after'       => '',
            'link_before' => '',
            'link_after'  => '',
            'pagelink'    => esc_html__( 'Page', 'job-portal' ),
            'separator'   => '/',
        ) );?>
    </div>    
</div>   