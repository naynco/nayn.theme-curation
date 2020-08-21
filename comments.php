<?php 

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>
	
	<a name="comments"></a>

	<div class="comments">
			
		<h2 class="comments-title">
		
			<?php 
			$comment_count = count( $wp_query->comments_by_type['comment'] );
			echo $comment_count . ' ' . _n( 'Comment', 'Comments', $comment_count, 'nayncuration' ); ?>
			
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'nayncuration_comment' ) ); ?>
		</ol>
		
		<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
		
			<div class="pingbacks">
			
				<div class="pingbacks-inner">
			
					<h3 class="pingbacks-title">

						<?php 
						$pingback_count = count( $wp_query->comments_by_type['pings'] );
						echo $pingback_count . ' ' . _n( 'Pingback', 'Pingbacks', $pingback_count, 'nayncuration' ); ?>
					
					</h3>
				
					<ol class="pingbacklist">
						<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'nayncuration_comment' ) ); ?>
					</ol>
					
				</div>
				
			</div>
		
		<?php endif; ?>
			
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
			<div class="comment-nav-below post-nav" role="navigation">
			
				<h3 class="assistive-text section-heading"><?php _e( 'Comment Navigation', 'nayncuration' ); ?></h3>
				
				<div class="post-nav-older"><?php previous_comments_link( '&laquo; ' . __('Older','nayncuration') . '<span> ' . __('Comments', 'nayncuration') . '</span>'); ?></div>
				
				<div class="post-nav-newer"><?php next_comments_link( __('Newer','nayncuration') . '<span> ' . __('Comments', 'nayncuration') . '</span>  &raquo;' ); ?></div>
				
				<div class="clear"></div>
				
			</div><!-- .comment-nav-below -->
			
		<?php endif; ?>
		
	</div><!-- .comments -->
	
	<?php 
endif;

if ( ! comments_open() && !is_page() ) : ?>

	<p class="nocomments"><?php _e( 'Comments are closed.', 'nayncuration' ); ?></p>
	
<?php endif;

comment_form();

?>