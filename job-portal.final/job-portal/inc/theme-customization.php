<?php

function job_portal_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
//select sanitization function
function job_portal_sanitize_select( $input, $setting ){         
//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
$input = sanitize_key($input); 
//get the list of possible select options 
$choices = $setting->manager->get_control( $setting->id )->choices;                            
return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
}
//URL
function job_portal_sanitize_url( $url ) {
  return esc_url_raw( $url );
}
function job_portal_cats() {
  $cats = array();
  $cats[0] = "All";
  foreach ( get_categories() as $categories => $category ) {
    $cats[$category->term_id] = $category->name;
  }
  return $cats;
}
/**
* Customization options
**/
function job_portal_customize_register( $wp_customize ) {

  $wp_customize->add_panel('general',array(
      'title' => __( 'General Settings', 'job-portal' ),
      'description' => __('General Settings','job-portal'),
      'priority' => 20, 
  ));
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';   
  $wp_customize->get_section('title_tagline')->title = esc_html__( 'Header & Logo Section', 'job-portal'); 

  $wp_customize->add_setting('job_portal_theme_color',array(
      'default'           => '#49b6c3',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
  ) );
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize,
      'job_portal_theme_color',
      array(
        'label'   => esc_html__( 'Theme Color', 'job-portal' ),
        'section' => 'colors',
      )
  ) ); 

  $wp_customize->add_setting('logo_height',array(
    'default' => '60',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control('logo_height',array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'job-portal'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 60 (default: 10px)",'job-portal'),
    'type'       => 'text',
    'priority'    => 49,
    )
  );

  // Start Blog Listing Section 
  $wp_customize->add_section( 'blog_page_section', array(
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__('Blog(Archive) Page', 'job-portal'),
    'panel'          => 'general'
  ) );
  // Meta Tag Checkbox
  $wp_customize->add_setting( 'blog_meta_tag', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'job_portal_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'blog_meta_tag', array(
    'type' => 'checkbox',
    'section' => 'blog_page_section', // Add a default or your own section
    'label' => esc_html__( 'Check this box for hide meta tag', 'job-portal' ),
  ) );
  // Blog Image Checkbox
  $wp_customize->add_setting( 'blog_post_image', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'job_portal_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'blog_post_image', array(
    'type' => 'checkbox',
    'section' => 'blog_page_section', // Add a default or your own section
    'label' => esc_html__( 'Check this box for hide post image', 'job-portal' ),
  ) );
  // Read More Link
  $wp_customize->add_setting( 'blog_post_readmore', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'job_portal_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'blog_post_readmore', array(
    'type' => 'checkbox',
    'section' => 'blog_page_section', // Add a default or your own section
    'label' => esc_html__( 'Check this box for hide read more link', 'job-portal' ),
  ) );
  // Post Content Limit
  $wp_customize->add_setting( 'blog_post_content_limit', array(
    'default' => '40',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  ) );
  $wp_customize->add_control( 'blog_post_content_limit', array(
    'type' => 'text',
    'priority' => 10,
    'section' => 'blog_page_section',
    'label' => esc_html__( 'Post Content Limit', 'job-portal' ),
  ) );
  // Blog sidebar setting 
  $wp_customize->add_setting( 'blog_sidebar', array(
    'default' => 'right',
    'sanitize_callback' => 'job_portal_sanitize_select',
  ) );
  $wp_customize->add_control( 'blog_sidebar', array(
    'type' => 'select',
    'section' => 'blog_page_section',
    'label' => esc_html__( 'Sidebar Layout', 'job-portal' ),
    'choices' => array(
      'right' => 'Right',
      'left' => 'Left',
      'full' => 'Full',
      )
  ) );
  // End Blog Listing Section
  // Start Single Post Page Section
  $wp_customize->add_section( 'single_page_section', array(
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__('Single Post Page', 'job-portal'),
    'panel'          => 'general'
  ) );
  // Single Post Meta Tag Checkbox 
  $wp_customize->add_setting( 'single_post_meta_tag', array(
    'default' => false,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'job_portal_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'single_post_meta_tag', array(
    'type' => 'checkbox',
    'section' => 'single_page_section', // Add a default or your own section
    'label' => esc_html__( 'Check this box for hide meta tag.', 'job-portal' ),      
  ) );
  
  // Single Post Image Checkbox 
  $wp_customize->add_setting( 'single_post_image', array(
    'default' => false,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'job_portal_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'single_post_image', array(
    'type' => 'checkbox',
    'section' => 'single_page_section', // Add a default or your own section
    'label' => esc_html__( 'Check this box for hide post image.', 'job-portal' ),
  ) );
  // Single Post Page Sidebar
  $wp_customize->add_setting( 'single_sidebar', array(
    'default' => 'right',
    'sanitize_callback' => 'job_portal_sanitize_select',
  ) );
  $wp_customize->add_control( 'single_sidebar', array(
    'type' => 'select',
    'section' => 'single_page_section',
    'label' => esc_html__( 'Sidebar Layout', 'job-portal' ),
    'choices' => array(
      'right' => 'Right',
      'left' => 'Left',
      'full' => 'Full',
    )
  ) );
  // End Blog Page Section
 /* -----------------   Front Page option.----------------------------- */
 // Frontpage Search Heading Section.
  $wp_customize->add_panel( 'frontpage_options_panel' ,
   array(
      'title'       => __( 'Front Page : Options', 'job-portal' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      
  )
);
$wp_customize->add_section( 'frontpage_options_section' ,
   array(
      'title'       => __( 'Front Page : Header Search', 'job-portal' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel'       => 'frontpage_options_panel'      
  )
);    
$wp_customize->add_setting( 'search_header_title',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Browse Jobs','job-portal'),
      )
  );
  $wp_customize->add_control( 'search_header_title',
      array(          
          'section' => 'frontpage_options_section',                
          'label'   => __('Main Search Box Title Text : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title like Browse Jobs','job-portal')),
      )
  );

  $wp_customize->add_setting( 'search_header_subtitle',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Find jobs,employeement & career opportunities.','job-portal'),
      )
  );
  $wp_customize->add_control( 'search_header_subtitle',
      array(          
          'section' => 'frontpage_options_section',                
          'label'   => __('Main Search Box Sub Title Text : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title like Find jobs.','job-portal')),
      )
  );
  $wp_customize->add_setting( 'search_header_placeholder',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('What are you looking for?','job-portal'),
      )
  );
  $wp_customize->add_control( 'search_header_placeholder',
      array(          
          'section' => 'frontpage_options_section',                
          'label'   => __('Main Search Box Placeholder : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title like What are you looking for?','job-portal')),
      )
  );
  $wp_customize->add_setting( 'search_header_search_btn_text',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Search','job-portal'),
      )
  );
  $wp_customize->add_control( 'search_header_search_btn_text',
      array(          
          'section' => 'frontpage_options_section',                
          'label'   => __('Main Search Box Button Text : ','job-portal'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title like Search','job-portal')),
      )
  ); 
  // Frontpage Featured Jobs Section.
  $wp_customize->add_section( 'frontpage_featured_job_section' ,
   array(
      'title'       => __( 'Front Page : Featured Job Section', 'job-portal' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel'       => 'frontpage_options_panel'      
  )
);
$wp_customize->add_setting( 'front_page_featured_jobs_switch',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'job_portal_sanitize_checkbox',
        'priority' => 20, 
        'default' => false,
    )
);
$wp_customize->add_control( 'front_page_featured_jobs_switch',
    array(          
        'section' => 'frontpage_featured_job_section',                
        'label'   => __('Check this box for hide this section','job-portal'),          
        'type'    => 'checkbox',
    )
);
$wp_customize->add_setting( 'front_page_featured_jobs_title',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Featured Jobs','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_title',
      array(          
          'section' => 'frontpage_featured_job_section',                
          'label'   => __('Section Title Text  & Subtitle Text : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title like Featured Jobs','job-portal')),
      )
  );
  $wp_customize->add_setting( 'front_page_featured_jobs_subtitle',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => '',
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_subtitle',
      array(          
          'section' => 'frontpage_featured_job_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title ','job-portal')),
      )
  );

  $wp_customize->add_setting( 'front_page_featured_jobs_post_category',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_select',
          'priority' => 20, 
          'default' => 0,
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_post_category',
      array(          
          'section' => 'frontpage_featured_job_section',                
          'label'   => __('Select Category  & Post limit: ','job-portal'),          
          'type'    => 'select',  
          'choices' => job_portal_cats()        
      )
  );
  $wp_customize->add_setting( 'front_page_featured_jobs_post_limit',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'absint',
          'priority' => 20, 
          'default' => 4,
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_post_limit',
      array(          
          'section' => 'frontpage_featured_job_section',                         
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Post limit ','job-portal')),
      )
  );

  $wp_customize->add_setting( 'front_page_featured_jobs_image_switch',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'job_portal_sanitize_checkbox',
        'priority' => 20, 
        'default' => false,
    )
);
  $wp_customize->add_control( 'front_page_featured_jobs_image_switch',
      array(          
          'section' => 'frontpage_featured_job_section',                
          'label'   => __('Check for hide image in this section','job-portal'),          
          'type'    => 'checkbox',
      )
  );

  $wp_customize->add_setting( 'front_page_featured_jobs_date_switch',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_checkbox',
          'priority' => 20, 
          'default' => false,
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_date_switch',
      array(          
          'section' => 'frontpage_featured_job_section',                
          'label'   => __('Check for hide date in this section','job-portal'),          
          'type'    => 'checkbox',
      )
  );
  $wp_customize->add_setting( 'front_page_featured_jobs_readmore_switch',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_checkbox',
          'priority' => 20, 
          'default' => false,
      )
  );
  $wp_customize->add_control( 'front_page_featured_jobs_readmore_switch',
      array(          
          'section' => 'frontpage_featured_job_section',                
          'label'   => __('Check for hide readmore link in this section','job-portal'),          
          'type'    => 'checkbox',
      )
  );


// About Us option
  $wp_customize->add_section( 'front_page_about_us_section' ,
   array(
      'title'       => __( 'Front Page : About Us Section', 'job-portal' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel'       => 'frontpage_options_panel'      
  )
);
$wp_customize->add_setting( 'front_page_about_us_switch',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'job_portal_sanitize_checkbox',
        'priority' => 20, 
        'default' => false,
    )
);
$wp_customize->add_control( 'front_page_about_us_switch',
    array(          
        'section' => 'front_page_about_us_section',                
        'label'   => __('Check this box for hide this section','job-portal'),          
        'type'    => 'checkbox',
    )
);
$wp_customize->add_setting( 'front_page_about_us_title',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('About Us','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_about_us_title',
      array(          
          'section' => 'front_page_about_us_section',                
          'label'   => __('Section Title Text  & Subtitle Text : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title like About Us','job-portal')),
      )
  );
  $wp_customize->add_setting( 'front_page_about_us_subtitle',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('About Us Sub Title','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_about_us_subtitle',
      array(          
          'section' => 'front_page_about_us_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title ','job-portal')),
      )
  );

   $wp_customize->add_setting( 'front_page_about_us_content',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
          'default' => esc_html__('About Us Content','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_about_us_content',
      array(          
          'section' => 'front_page_about_us_section',
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Content ','job-portal')),
      )
  );
 
 $wp_customize->add_setting( 'front_page_about_us_btn_url',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_url',
          'priority' => 20, 
          'default' => '',
      )
  );
  $wp_customize->add_control( 'front_page_about_us_btn_url',
      array(          
          'section' => 'front_page_about_us_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Button Url ','job-portal')),
      )
  );
  $wp_customize->add_setting( 'front_page_about_us_btn_text',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Read More','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_about_us_btn_text',
      array(          
          'section' => 'front_page_about_us_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Button Text ','job-portal')),
      )
  );
  $wp_customize->add_setting( 'front_page_about_us_bg_image', array(
      'type'              => 'theme_mod',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );
  $wp_customize->add_control(new WP_Customize_Cropped_Image_Control( $wp_customize,
      'front_page_about_us_bg_image',array(
      'label'             => esc_html__('About Us Image','job-portal'),
      'section'           => 'front_page_about_us_section',
      'settings'          => 'front_page_about_us_bg_image',
      'description'       => esc_html__('Upload Image Size : 800 x 800', 'job-portal'),
      'height'            => 800,
      'width'             => 800,
      'flex_width'        => true,
      'flex_height'       => true,
      )) );
  $wp_customize->add_setting( 'front_page_about_us_btn_switch',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_checkbox',
          'priority' => 20, 
          'default' => false,
      )
  );
  $wp_customize->add_control( 'front_page_about_us_btn_switch',
      array(          
          'section' => 'front_page_about_us_section',                
          'label'   => __('Check for hide button in this section','job-portal'),          
          'type'    => 'checkbox',
      )
  );

  // Latest blog option
  $wp_customize->add_section( 'frontpage_latest_blog_section' ,
   array(
      'title'       => __( 'Front Page : Latest Blog Section', 'job-portal' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel'       => 'frontpage_options_panel'      
  )
);
$wp_customize->add_setting( 'front_page_latest_blog_switch',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'job_portal_sanitize_checkbox',
        'priority' => 20, 
        'default' => false,
    )
);
$wp_customize->add_control( 'front_page_latest_blog_switch',
    array(          
        'section' => 'frontpage_latest_blog_section',                
        'label'   => __('Check this box for hide this section','job-portal'),          
        'type'    => 'checkbox',
    )
);
$wp_customize->add_setting( 'front_page_latest_blog_title',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => esc_html__('Latest Blog','job-portal'),
      )
  );
  $wp_customize->add_control( 'front_page_latest_blog_title',
      array(          
          'section' => 'frontpage_latest_blog_section',                
          'label'   => __('Section Title Text  & Subtitle Text : ','job-portal'),          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title like Latest Blog','job-portal')),
      )
  );
  $wp_customize->add_setting( 'front_page_latest_blog_subtitle',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
          'default' => '',
      )
  );
  $wp_customize->add_control( 'front_page_latest_blog_subtitle',
      array(          
          'section' => 'frontpage_latest_blog_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title ','job-portal')),
      )
  );

  $wp_customize->add_setting( 'front_page_latest_blog_category',
      array(
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'job_portal_sanitize_select',
          'priority' => 20, 
          'default' => 0,
      )
  );
  $wp_customize->add_control( 'front_page_latest_blog_category',
      array(          
          'section' => 'frontpage_latest_blog_section',                
          'label'   => __('Select Category  & Post limit: ','job-portal'),          
          'type'    => 'select',  
          'choices' => job_portal_cats()        
      )
  );  
  
  

  $wp_customize->add_setting( 'front_page_latest_blog_image_switch',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'job_portal_sanitize_checkbox',
        'priority' => 20, 
        'default' => false,
    )
);
  $wp_customize->add_control( 'front_page_latest_blog_image_switch',
      array(          
          'section' => 'frontpage_latest_blog_section',                
          'label'   => __('Check for hide image in this section','job-portal'),          
          'type'    => 'checkbox',
      )
  );
  
  /*  ---------------------- Front page Option end ------------------------------   */
}
add_action( 'customize_register', 'job_portal_customize_register' );
function job_portal_custom_css(){ 
  $custom_css='';
  $custom_css .= '*::selection{
    background: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';
    color: '.esc_attr(get_theme_mod('job_portal_theme_color','#fff')).';
  }
  .sidebar aside .sidebar-title h4, .blog-page-section .blog-post .blog-read-more, .navigation .nav-links .nav-previous a, .navigation .nav-links .nav-next a, .wpcf7-form .wpcf7-form-control.wpcf7-submit, .wpcf7-form input[type="submit"]{
    color: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';
    border-color: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';
  }
  .blog-post-date a, .blog-page-section .blog-post h4 a:hover, .blog-page-section .blog-post h4 a:focus, .blog-page-section .blog-post h4 a:active, .sidebar aside .sidebar-post-list ul li .blog-post-title, .sidebar aside ul li a:hover, .sidebar aside ul li a:focus, .sidebar aside ul li a:active, .sidebar aside .sidebar-post-list ul li .blog-post-title h4 a:hover, .sidebar aside .sidebar-post-list ul li .blog-post-title h4 a:focus, .sidebar aside .sidebar-post-list ul li .blog-post-title h4 a:active, .footer-wrapper .footer-item ul li a:hover, .footer-wrapper .footer-item ul li a:focus, .footer-wrapper .footer-item .tagcloud a:hover, .breadcrums li a{color: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';}

  .wpcf7-form label input[type="text"], .wpcf7-form label input[type="email"],
  .wpcf7-form input[type="text"], .wpcf7-form input[type="email"], .wpcf7-form label textarea, .wpcf7-form textarea, .wpcf7-form input, .wpcf7-form .wpcf7-form-control:hover.wpcf7-submit:hover, .wpcf7-form input[type="submit"]:hover{border-color: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';}

  .navigation .page-numbers li span, .sidebar aside .tagcloud a:hover, #cssmenu > ul > li > a:before, #cssmenu ul ul, #cssmenu ul ul li a, .navigation .nav-links .nav-previous a:hover, .navigation .nav-links .nav-next a:hover, .wpcf7-form .wpcf7-form-control:hover.wpcf7-submit:hover, .wpcf7-form input[type="submit"]:hover{background: '.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';}
  .navigation .page-numbers li a, .navigation .page-numbers li span, .footer .footer-wrapper .footer-item{border-color:'.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';}
  #cssmenu ul ul:after{border-bottom-color:'.esc_attr(get_theme_mod('job_portal_theme_color','#49b6c3')).';}
  @media screen and (max-width:1024px){
    #cssmenu ul ul li a{background:transparent;}
  }
  .logoSite img.img-responsive.logo-fixed {
    max-height: '.esc_attr(get_theme_mod('logo_height',60)).'px;
  }';
  if ( get_theme_mod('front_page_about_us_bg_image') != '') : 
  $bg_url= wp_get_attachment_url(get_theme_mod('front_page_about_us_bg_image'));
  $custom_css .='.search-jobs .search-jobs-image {
    background: url('.esc_url($bg_url).');
    background-size: cover;
    background-repeat: no-repeat;
  }';
endif;
  if ( get_header_image() ) : 
    $custom_css .= '#home-page.main-section{        
        background-image: url('. esc_url(get_header_image()).');
    }';
   else: 
  $custom_css .= '#home-page.main-section{        
        background-color: #000;
    }';
   endif;
  wp_add_inline_style('job-portal-style',$custom_css);
}
