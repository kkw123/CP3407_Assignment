<?php 
/* Theme Default function and extra function*/
add_action('tgmpa_register', 'job_portal_required_plugins');

function job_portal_required_plugins() {
    if (class_exists('TGM_Plugin_Activation')) {
        $plugins = array(
            array(
                'name' => __('Page Builder by SiteOrigin', 'job-portal'),
                'slug' => 'siteorigin-panels',
                'required' => false,
            ),
            array(
                'name' => __('SiteOrigin Widgets Bundle', 'job-portal'),
                'slug' => 'so-widgets-bundle',
                'required' => false,
            ),
            array(
                'name' => __('Contact Form 7', 'job-portal'),
                'slug' => 'contact-form-7',
                'required' => false,
            ),
        );
        $config = array(
            'default_path' => '',
            'menu' => 'job-portal-install-plugins',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false,
            'message' => '',
            'strings' => array(
                'page_title' => __('Install Recommended Plugins', 'job-portal'),
                'menu_title' => __('Install Plugins', 'job-portal'),
                'nag_type' => 'updated'
            )
        );
        tgmpa($plugins, $config);
    }
}
// Post Excerpt length
function job_portal_breadcrums() {
    $job_portal_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $job_portal_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    global $post;
    if (is_home() || is_front_page()) {
        if ($job_portal_showonhome == 1)
            echo '<ul class="breadcrums"><li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'job-portal') . '</a></li></ul>';
    } else {
        echo '<ul class="breadcrums"><li><a href="' . esc_url(home_url('/')). '">' . esc_html__('Home', 'job-portal') . '</a> ';
        if (is_category()) {
            $job_portal_thisCat = get_category(get_query_var('cat'), false);
            if ($job_portal_thisCat->parent != 0)
                echo wp_kses_post(get_category_parents($job_portal_thisCat->parent, TRUE, ' '));
                /* translators: %s: post single category name */
                printf(esc_html__('Archive by category "%s" ','job-portal'),single_cat_title('', false) );   
        } elseif (is_search()) {
            /* translators: %s: search query string */
            printf(esc_html__('Search Results For "%s" ','job-portal'),esc_html(get_search_query()) );   
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F') ). '</a> ';
            echo  esc_html(get_the_time('d'));
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo  esc_html(get_the_time('F')) ;
        } elseif (is_year()) {
            echo esc_html(get_the_time('Y')) ;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $job_portal_post_type = get_post_type_object(get_post_type());
                $job_portal_slug = $job_portal_post_type->rewrite;
                echo '<a href="' . esc_url(home_url('/'. $job_portal_slug['slug'] . '/')) .'">' . esc_html($job_portal_post_type->labels->singular_name) . '</a>';
                if ($job_portal_showcurrent == 1)
                    echo  esc_html(get_the_title()) ;
            } else {
                $job_portal_cat = get_the_category();
                $job_portal_cat = $job_portal_cat[0];
                $job_portal_cats = get_category_parents($job_portal_cat, TRUE, ' ');
                if ($job_portal_showcurrent == 0)
                    $job_portal_cats = preg_replace("#^(.+)\s\s$#", "$1", $job_portal_cats);
                echo wp_kses_post($job_portal_cats);
                if ($job_portal_showcurrent == 1)
                    echo  esc_html(get_the_title());
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $job_portal_post_type = get_post_type_object(get_post_type());
            echo esc_html($job_portal_post_type->labels->singular_name );
        } elseif (is_attachment()) {
            $job_portal_parent = get_post($post->post_parent);
            $job_portal_cat = get_the_category($job_portal_parent->ID);
            $job_portal_cat = $job_portal_cat[0];
            echo wp_kses_post(get_category_parents($job_portal_cat, TRUE, '  '));
            echo '<a href="' . esc_url(get_permalink($job_portal_parent)) . '">' . esc_html($job_portal_parent->post_title) . '</a>';
            if ($job_portal_showcurrent == 1)
                echo   esc_html(get_the_title());
        } elseif (is_page() && !$post->post_parent) {
            if ($job_portal_showcurrent == 1)
                echo esc_html(get_the_title());
        } elseif (is_page() && $post->post_parent) {
            $job_portal_parent_id = $post->post_parent;
            $job_portal_breadcrumbs = array();
            while ($job_portal_parent_id) {
                $job_portal_page = get_page($job_portal_parent_id);
                $job_portal_breadcrumbs[] = '<a href="' . esc_url(get_permalink($job_portal_page->ID)) . '">' . esc_html(get_the_title($job_portal_page->ID)) . '</a>';
                $job_portal_parent_id = $job_portal_page->post_parent;
            }
            $job_portal_breadcrumbs = array_reverse($job_portal_breadcrumbs);
            for ($job_portal_i = 0; $job_portal_i < count($job_portal_breadcrumbs); $job_portal_i++) {
                echo wp_kses_post($job_portal_breadcrumbs[$job_portal_i]);
                if ($job_portal_i != count($job_portal_breadcrumbs) - 1)
                    echo ' ';
            }
            if ($job_portal_showcurrent == 1)
                echo esc_html(get_the_title()) ;
        } elseif (is_tag()) {            
            /* translators: %s: post single tag */
            printf(esc_html__('Posts tagged "%s" ','job-portal'),single_tag_title('', false) );
        } elseif (is_author()) {
            global $author;
            $job_portal_userdata = get_userdata($author);
            /* translators: %s: post author */
            printf(esc_html__('Articles Published by "%s" ','job-portal'),esc_html($job_portal_userdata->display_name ) );
        } elseif (is_404()) {
            echo esc_html__('Error 404', 'job-portal') ;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                printf(/* translators: %s: post name */esc_html__('(Page  %s )','job-portal'),esc_html(get_query_var('paged')));                
        }
        echo '</li></ul>';
    }
}
//Post Meta values layout here.
function job_portal_post_meta(){ 
    $job_portal_tag_list = get_the_tag_list('', esc_html__( ', ', 'job-portal' ));
    $job_portal_date = sprintf( '<span><i class="fa fa-calendar"></i> <a href="%1$s" title="%2$s" ><time datetime="%3$s">%4$s</time></a></span>',
        esc_url( get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date() ),
        esc_html( get_the_date() )
    );
    /* translators: 1: author post url, 2: Author name, 3:author name */
    $job_portal_author = sprintf( '<span><i class="fa fa-user"></i> <a href="%1$s" title="%2$s" >%3$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        /* translators: 1: author name,*/
        esc_attr( sprintf( esc_html__( 'View all posts by %s', 'job-portal' ), get_the_author() ) ),
        get_the_author()
    );
    if ( $job_portal_tag_list ) {
        /* translators: 1: category name, 2: date time, 3: post author */
        $job_portal_utility_text = __('<div class="blog-post-date">%1$s %2$s <span><i class="fa fa-link"></i>%3$s</span></div>','job-portal');
    }else{
         /* translators: 1: category name, 2: date time*/
        $job_portal_utility_text = __('<div class="blog-post-date">%1$s %2$s</div>','job-portal');
    }
    printf(
        $job_portal_utility_text, 
        $job_portal_date,
        $job_portal_author,
        $job_portal_tag_list
    );    
}

// filter add this comment_form_field_comment funtion
function job_portal_comment_field( $comment_field ) {

  $comment_field =
    '<p class="comment-form-comment">
            <label for="comment">' . __( "Comment", "job-portal" ) . '</label>
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Comment", "job-portal" ) . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'job_portal_comment_field' );

// filter add this comment_form_default_fields funtion
function job_portal_comment_fields( $fields ) {

    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $label     = $req ? '*' : ' ' . __( '(optional)', 'job-portal' );
    $aria_req  = $req ? "aria-required='true'" : '';

    $fields['author'] =
        '<p class="comment-form-author">
            <label for="author">' . __( "Name", "job-portal" ) . $label . '</label>
            <input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name*", "job-portal" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30" ' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="comment-form-email">
            <label for="email">' . __( "Email", "job-portal" ) . $label . '</label>
            <input id="email" name="email" type="email" placeholder="' . esc_attr__( "Email Id*", "job-portal" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
        '" size="30" ' . $aria_req . ' />
        </p>';

    $fields['url'] =
        '<p class="comment-form-url">
            <label for="url">' . __( "Website", "job-portal" ) . '</label>
            <input id="url" name="url" type="url"  placeholder="' . esc_attr__( "Website url", "job-portal" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" />
            </p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'job_portal_comment_fields' );