<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } 

class Owmx6 extends Theme
{
	public function action_init_theme()
	{
		Format::apply( 'autop', 'comment_content_out' );
		// Apply Format::tag_and_list() to post tags...
		Format::apply( 'tag_and_list', 'post_tags_out' );
		// Only uses the <!--more--> tag, with the 'more' as the link to full post
		Format::apply_with_hook_params( 'more', 'post_content_out', 'more' );
		// Creates an excerpt option. echo $post->content_excerpt;
		Format::apply_with_hook_params( 'more', 'post_content_excerpt', 'more',60, 1 );
		// Format the calendar like date for home, entry.single and entry.multiple templates
// 		Format::apply( 'format_date', 'post_pubdate_out','<span class="calyear">{Y}</span><br><span class="calday">{j}</span><br><span  class="calmonth">{F}</span>' );
	}

	public function add_template_vars()
	{
	if ( !$this->template_engine->assigned( 'pages' ) ) {
			$this->assign('pages', Posts::get( array( 'content_type' => 'page', 'status' => Post::status('published') ) ) );
		}
		//For Asides loop in sidebar.php
		$this->assign( 'asides', Posts::get( array( 'vocabulary' => array( 'tags:term' => 'aside' ), 'limit' => 5 ) ) );

		//for recent comments loop in sidebar.php
		$this->assign('recent_comments', Comments::get( array('limit'=>5, 'status'=>Comment::STATUS_APPROVED, 'orderby'=>'date DESC' ) ) );

		parent::add_template_vars();
		//visiting page/2, /3 will offset to the next page of posts in the sidebar
		$page =Controller::get_var( 'page' );
		$pagination =Options::get('pagination');
		if ( $page == '' ) { $page = 1; }
		$this->assign( 'more_posts', Posts::get(array ( 'status' => 'published','content_type' => 'entry', 'offset' => ($pagination)*($page), 'limit' => 5,  ) ) );

	}

	public function act_display_home( $user_filters = array() )
	{
		//To exclude aside tag from main content loop
		parent::act_display_home( array( 'vocabulary' => array( 'tags:not:term' => 'aside' ) ) );
	}

	/**
	 * Customize comment form layout with fieldsets. Needs thorough commenting.

	public function action_form_comment( $form ) { 
		$form->append( 'fieldset', 'cf_commenterinfo', _t( 'About You' ) );
		$form->move_before( $form->cf_commenterinfo, $form->cf_commenter );

		$form->cf_commenter->move_into($form->cf_commenterinfo);
		$form->cf_commenter->caption = _t('Name:') . '<span class="required">' . ( Options::get('comments_require_id') == 1 ? ' *' . _t('Required') : '' ) . '</span></label>';

		$form->cf_email->move_into( $form->cf_commenterinfo );
		$form->cf_email->caption = _t( 'Email Address:' ) . '<span class="required">' . ( Options::get('comments_require_id') == 1 ? ' *' . _t('Required') : '' ) . '</span></label>'; 

		$form->cf_url->move_into( $form->cf_commenterinfo );
		$form->cf_url->caption = _t( 'Web Address:' );

		$form->append('static','cf_disclaimer', _t( '<p><em><small>Email address is not published</small></em></p>') );
		$form->cf_disclaimer->move_into( $form->cf_commenterinfo );

		$form->append('fieldset', 'cf_contentbox', _t( 'Add to the Discussion' ) );
		$form->move_before($form->cf_contentbox, $form->cf_content);

		$form->cf_content->move_into($form->cf_contentbox);
	        $form->cf_content->caption = _t( 'Message: (Required)' );

		$form->cf_submit->caption = _t( 'Submit' );
	}
	 */
}

?>
