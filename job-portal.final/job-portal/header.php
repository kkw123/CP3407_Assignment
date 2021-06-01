<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="preloader">
            <span class="preloader-custom-gif">
             <svg width='70px' height='70px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring">
                <circle id="loader" cx="50" cy="50" r="40" stroke-dasharray="163.36281798666926 87.9645943005142" stroke="<?php echo esc_attr(get_theme_mod('job_portal_theme_color','#30bced'));?>" fill="none" stroke-width="5"></circle>
             </svg>
            </span>
        </div>
        <!--main-section start-->
        <section id="home-page" class="main-section">
            <div class="image-overlay">  
                <!---- Start box-toper ---->
                <header>
                    <div class="header-top">
                        <div class="container">
                            <!-- Menu -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="logoSite">
                                        <?php if (has_custom_logo()) {
                                            the_custom_logo();
                                        }
                                        if(display_header_text()){ ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logoSite-brand">
                                            <?php echo esc_html(get_bloginfo('name')); ?>
                                            <span class="logoSite-brand-subline"><?php echo esc_html(get_bloginfo('description')); ?></span>
                                        </a>
                                    <?php } ?>
                                    </div>
                                    <div class="main-menu">                                       
                                        <nav id='cssmenu'>
                                        <?php
                                          $jobs_portal_defaults = array(
                                            'theme_location' => 'primary',
                                            'container' => 'ul',
                                            'items_wrap' => '<ul class="offside">%3$s</ul>',
                                            );
                                          wp_nav_menu($jobs_portal_defaults);
                                        ?>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Menu End -->
                        </div>
                    </div>
                </header>
                <!---- box-toper End ---->                
                <?php if(is_front_page()):
                    get_template_part('templates/header/style1');
                else:
                    get_template_part('templates/header/style2');
                endif;?>               
            </div>
        </section>     