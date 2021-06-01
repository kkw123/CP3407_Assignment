<!--footer start-->
<footer class="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="row">
                <?php  for($i=1 ;$i<=4;$i++):
                if(is_active_sidebar( 'footer-'.$i )) { ?>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <?php dynamic_sidebar( 'footer-'.$i ); ?>
                </div>
                <?php } endfor;  ?>
            </div>
        </div>
    </div>
</footer>
<!--footer end-->
<footer class="footer-copyrights">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="copyright-text"><?php esc_html_e('Theme :','job-portal'); ?> <a href="<?php echo esc_url('https://piperthemes.com/wordpress-themes/job-portal'); ?>"><?php esc_html_e(' Job Portal WordPress Theme','job-portal'); ?></a></p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); 