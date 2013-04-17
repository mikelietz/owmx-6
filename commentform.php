<?php
namespace Habari;
if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
	<h3><?php $theme->comments_count($post,'no&nbsp;responses','%d&nbsp;response','%d&nbsp;responses'); ?> <?php _e('to'); ?> <?php echo $post->title; ?></h3>
<a href="<?php echo $post->comment_feed_link; ?>">Comment Feed</a>

	<h4 class="commentheading" id="comments"><?php echo $post->comments->comments->approved->count; ?> <?php echo _n( 'Comment', 'Comments', $post->comments->comments->approved->count ); ?></h4>
		<?php
		if ( $post->comments->moderated->count ) { ?>
	<div class="comments">
<?php		foreach ( $post->comments->comments->moderated as $comment ) : ?>

			<article id="comment-<?php echo $comment->id; ?>" class="comment"><?php echo $comment->content_out; ?>
				<div class="comment-meta">#<a href="#comment-<?php echo $comment->id; ?>" class="counter" title="<?php _e('Permanent Link to this Comment'); ?>"><?php echo $comment->id; ?></a> |
				<span class="commentauthor"><?php $theme->comment_author_link($comment); ?></span>
				<span class="commentdate"> <?php _e('on'); ?> <a href="#comment-<?php echo $comment->id; ?>" title="<?php _e('Time of this comment'); ?>"><?php $comment->date->out('M j, Y h:ia'); ?></a></span></div>
			</article>
		<?php	endforeach; ?>
	</div>
<?php		if ( $post->comments->pingbacks->count ) : ?>
			<div id="pings">
			<h4><?php $theme->pingback_count($post); ?></h4>
				<ul id="pings-list">
					<?php foreach ( $post->comments->pingbacks->approved as $pingback ) : ?>
						<li id="ping-<?php echo $pingback->id; ?>">

								<div class="comment-content">
								<?php echo $pingback->content; ?>
								</div>
								<div class="ping-meta"><a href="<?php echo $pingback->url; ?>" title=""><?php echo $pingback->name; ?></a></div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif;

		}
		else { ?>
		<p>There are currently no comments.</p>

<?php		}

		if ( !$post->info->comments_disabled ) :	?>


	<section class="commentform meta">
	<h4>Leave a comment</h4>
<?php if ( Session::has_messages() ) {
		Session::messages_out();
	}
?>
<?php $post->comment_form()->out(); ?>
	</section>
<?php	else: ?>
	<h4>Comments have been disabled.</h4>
<?php	endif; ?>
