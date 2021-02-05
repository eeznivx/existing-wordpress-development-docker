<?php
// Comment list
function vincent_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
    
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
			<?php if ( $avarta = get_avatar( $comment, $size='103' ) ) :
				printf( '<div class="gravatar">%1$s</div>', $avarta );
			endif; ?>
			<div class='comment-content'>
				<div class="comment-meta">
					<div class="comment-time"><?php echo get_comment_date(); ?></div>
					<?php 
					if ( $comment->user_id != '0' ) {
					    printf( '<h6 class="comment-author">%1$s</h6>', get_user_meta( $comment->user_id, 'nickname', true ) );
					} else {
					    printf( '<h6 class="comment-author">%1$s</h6>', get_comment_author_link() );
					}
					?>
					<?php edit_comment_link( esc_html__( 'Edit', 'vincent' ), '', '' ); ?>
				</div>
				<div class='comment-text'>
					<?php comment_text(); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<span class="unapproved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'vincent' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="comment-reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</div>
			</div>
		</article>
<?php }

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) return; ?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf( _n( '1 Comment', '%s Comments', get_comments_number(), 'vincent' ),
				number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'vincent_comments' ) ); ?>
		</ol><!-- /.comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="comments-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'vincent' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'vincent' ) ); ?></div>
				<div class="clearfix"></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'vincent' ); ?></p>
		<?php endif; ?>
	<?php endif; // if have_comments(). ?>

	<?php if ( comments_open() ) :
		$commenter = wp_get_current_commenter();
		$aria_req = get_option( 'require_name_email' ) ? " aria-required='true'" : '';
		$comment_args = array(
			'title_reply'			=> esc_html__( 'Leave a Reply', 'vincent' ),
			'id_submit'				=> 'comment-reply',
			'label_submit'			=> esc_html__( 'Submit Comment', 'vincent' ),
			'fields'				=> apply_filters( 'comment_form_default_fields', array(
				'author' => 
				'<fieldset class="name-wrap">
					<input type="text" id="author" class="tb-my-input" name="author" tabindex="1" placeholder="' . esc_attr__( 'Name*', 'vincent' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="32"' . $aria_req . '>
				</fieldset>',
				'email' =>
				'<fieldset class="email-wrap">
					<input type="text" id="email" class="tb-my-input" name="email" tabindex="2" placeholder="' . esc_attr__( 'Email*', 'vincent' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="32"' . $aria_req . '>
				</fieldset>',
			) ),
			'comment_field' 		=> '<fieldset class="message-wrap">
											<textarea id="comment-message" name="comment" rows="8" tabindex="4" placeholder="' . esc_attr__( 'Comment*', 'vincent' ) . '"></textarea>
										</fieldset>',
			'comment_notes_after'  	=> '',
			'comment_notes_before' 	=> '',
		);
		comment_form( $comment_args );
	endif; ?><!-- // if comments_open(). -->
</div><!-- /.comments-area -->

