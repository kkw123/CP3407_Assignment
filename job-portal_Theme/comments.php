<?php
/**
 * The template for displaying comments
 * @package Job Portal
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( comments_open()) : ?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php $job_portal_comments_number = get_comments_number();
				if ( '1' === $job_portal_comments_number ) {
					/* translators: %s: post title */
					printf( esc_html(_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'job-portal' )), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						esc_html(_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$job_portal_comments_number,
							'comments title',
							'job-portal'
						)),
						absint(number_format_i18n( $job_portal_comments_number )),
						get_the_title()
					);
				} ?>
		</h4>
		<ol class="comment-list">
			<?php wp_list_comments( array(
				'avatar_size' => 100,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => esc_html__( 'Reply', 'job-portal' ),
			) ); ?>
		</ol>
		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'job-portal' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'job-portal' ) . '</span>',
		) );
	endif; // Check for have_comments().
	comment_form(); ?>
</div>
<?php endif;