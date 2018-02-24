<!DOCTYPE html>
<html <?php language_attributes(); ?> class="veujs">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<?php do_action('app_seo');?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>><div id="fb-root"></div>
<div id="App-page" class="App-site"><div id="App-Main"><header data-elemt="App-header" id="App-head" class=""><?php do_action('App_temp_header_before');?><div class="App-header-content"><?php do_action('App_temp_header');?></div><?php do_action('App_temp_header_after');?></header>
