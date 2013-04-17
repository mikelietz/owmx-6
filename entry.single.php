<?php
namespace Habari;
if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); }
$theme->display ( 'header' ); ?>
<!--begin content-->
	<div id="b">
		<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?> post">
			<h1><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
			<section class="meta">
				<p>Author: <?php echo $post->author->displayname; ?> | Date: <time datetime="<?php echo $post->pubdate_out->format(DateTime::ATOM); ?>"><?php echo $post->pubdate_out->format(); ?></time> | <?php echo $theme->comments_link($post,'%d&nbsp;comments','%d&nbsp;comment','%d&nbsp;comments');
				if ( $loggedin ) { ?> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>">Edit</a><?php } ?></p>
				<?php if ( count( $post->tags ) ) : ?>
				<p>Tags: <?php echo $post->tags_out; ?></p>
				<?php endif; ?>
			</section>
			<?php echo $post->content_out; ?>
		<section class="post-nav">
			<?php if ( $previous = $post->ascend() ): ?>
			<span class="left"> &laquo; <a href="<?php echo $previous->permalink ?>" title="<?php echo $previous->slug ?>"><?php echo $previous->title ?></a></span>
			<?php endif; ?>
			<?php if ( $next = $post->descend() ): ?>
			<span class="right"><a href="<?php echo $next->permalink ?>" title="<?php echo $next->slug ?>"><?php echo $next->title ?></a> &raquo;</span>
			<?php endif; ?>
		</section>


		<?php include 'commentform.php'; ?>

		<section class="pagenav">
			<?php if ( $previous = $post->ascend() ): ?>
			<a class="prev-page" href="<?php echo $previous->permalink ?>" title="<?php echo $previous->slug ?>">&laquo; <?php echo $previous->title ?></a>			<?php endif; ?>
			<?php if ( $next = $post->descend() ): ?>
			<a class="next-page" href="<?php echo $next->permalink ?>" title="<?php echo $next->slug ?>"><?php echo $next->title ?> &raquo;</a>
			<?php endif; ?>
		</section>

		</article>
	<!--end primary content-->
		<aside><?php
			Plugins::act( 'theme_sidebar_top' );
			echo $theme->area( 'sidebar' );
			Plugins::act( 'theme_sidebar_bottom' ); ?>
		</aside>
	</div>
	<!--end content-->
<?php 	$theme->display ( 'footer' ); ?>
