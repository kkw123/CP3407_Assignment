<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Job- Portal
 */ 
?>
<div class="blog-post">                    
    <?php  if(!get_theme_mod('blog_post_image', false) &&  has_post_thumbnail()): ?>
     <div class="blog-image">
       <a href="<?php the_permalink(); ?>">
        <?php  the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?>
       </a>
     </div>
    <?php endif; ?>                    
    <div class="blog-post-title">
     <?php
        if (!is_front_page()):
            if (is_singular()) :
                the_title('<h4>','</h4>');
            else :
                the_title('<h4><a href="' . esc_url(get_the_permalink()) . '" rel="bookmark">', '</a></h4>');
            endif;
     endif;?>                        
    </div>
    <?php if(!get_theme_mod('blog_meta_tag', false)){ 
        job_portal_post_meta();
     } ?>
    <div class="blog-post-text">
        <?php the_excerpt(); ?>
    </div> 
     
</div>
	