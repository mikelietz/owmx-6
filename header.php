<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<!DOCTYPE html>
<html lang="<?php echo Options::get( 'locale', 'en' ); ?>">
<head>
	<meta charset="UTF-8">
	<title><?php if ($request->display_entry && isset($post)) { echo "{$post->title} - "; } ?><?php Options::out( 'title' ) ?></title>
	<meta name="generator" content="Habari">

	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/s/a.css">
	<link rel="Shortcut Icon" href="<?php Site::out_url( 'theme' ); ?>/favicon.ico">
	<?php $theme->header(); ?>
</head>
<body class="<?php $theme->body_class(); ?>">
	<!--begin wrapper-->
	<div id="a">
		<!--begin masthead-->
		<header>
			<a href="<?php Site::out_url( 'habari'); ?>" title="<?php Options::out( 'title' ); ?>"><strong><?php Options::out( 'title' ); ?></strong> <?php Options::out( 'tagline' ); ?></a>
		</header>
	<!--end masthead-->
