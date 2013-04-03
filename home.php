<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); }
	$theme->display ( 'header' ); ?>
<!--begin content-->
	<div id="b">
		<!--begin loop-->
		<?php foreach ( $posts as $post ) : ?>
			<article id="post-<?php echo $post->id; ?>">
				<h1><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
				<?php echo $post->content_out; ?>
				<section class="meta">
					<p>Author: <?php echo $post->author->displayname; ?> | Date: <time datetime="<?php echo $post->pubdate_out->format(DateTime::ATOM); ?>" pubdate><?php echo $post->pubdate_out->format(); ?></time> | <?php echo $theme->comments_link($post,'%d&nbsp;comments','%d&nbsp;comment','%d&nbsp;comments'); 
						if ( $loggedin ) { ?> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>">Edit</a><?php } ?></p>
					<?php if ( count( $post->tags ) ) : ?>
					<p>Tags: <?php echo $post->tags_out; ?></p>
					<?php endif; ?>
				</section>
			</article>	
		<?php endforeach; ?>
		<!--end loop-->
		<!--pagination-->
			<section class="pagenav">
				<?php echo $theme->prev_page_link( _t( '&laquo;&nbsp;Newer&nbsp;Posts' ) ); ?><?php echo $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2, 'hideIfSinglePage' => true ) ); ?> <?php echo $theme->next_page_link( _t( 'Older&nbsp;Posts&nbsp;&raquo;' ) ); ?>
			</section>
		<aside><?php
			Plugins::act( 'theme_sidebar_top' );
			echo $theme->area( 'sidebar' );
			Plugins::act( 'theme_sidebar_bottom' ); ?>
		</aside>
	</div>
	<!--end content-->
<?php 	$theme->display ( 'footer' ); ?>
