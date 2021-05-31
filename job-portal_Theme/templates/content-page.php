<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> >
    <?php  if(!get_theme_mod('single_post_image', false) &&  has_post_thumbnail()): ?>
       <div class="blog-image">
        <?php the_post_thumbnail(); ?>
       </div>
    <?php endif; ?>    
    <div class="blog-post-text">
        <?php the_content(); ?>
    </div>    
</div>   