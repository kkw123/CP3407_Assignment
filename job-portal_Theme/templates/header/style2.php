<div class="browse-jobs">
  <div class="container">
    <div class="browse-jobs-wrapper">
       <div class="row">
          <div class="browse-jobs-number">
            <h1><?php if(is_single() || is_page()): the_title(); elseif(is_home()): esc_html_e('Blog','job-portal'); else: the_archive_title(); endif; ?></h1>
          </div>
        </div>
    </div>
  </div>
</div>