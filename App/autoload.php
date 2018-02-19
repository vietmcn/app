<?php
//lib
require_once 'Lib/class.controller.php';
require_once 'Lib/class.models.php';
require_once 'Lib/class.Mobile_Detect.php';
require_once 'Lib/class.meta-post.php';
require_once 'Lib/class.posts.php';
//mod
require_once 'Mod/class.seo.php';
require_once 'Mod/class.content.php';
require_once 'Mod/class.content-single.php';
require_once 'Mod/class.pagined.php';
require_once 'Mod/class.sidebar.php';
//Admin
if ( is_admin() ) {
    require_once 'Admin/class.metapost.php';
    require_once 'Admin/class.category.php';
}
//custom taxomy
require_once 'Admin/class.taxonomy.php';

//Controller Templates
global $App_controller;
$App_controller->call_controller( array( 
    'className' => 'template',
    'new' => 'App_config_template',
) );
$App_controller->call_controller( array(
    'className' => 'scripts',
    'new' => 'App_conf_script'
));
$App_controller->call_controller( array(
    'className' => 'seo',
    'new' => 'App_control_seo'
) );
$App_controller->call_controller( array(
    'className' => 'header',
    'new' => 'App_header'
) );
$App_controller->call_controller( array(
    'className' => 'content',
    'new' => 'App_content'
) );
$App_controller->call_controller( array(
    'className' => 'ajax',
    'new' => 'App_ajax'
) );
$App_controller->call_controller( array(
    'className' => 'content-single',
    'new' => 'App_control_single'
) );
$App_controller->call_controller( array(
    'className' => 'footer',
    'new' => 'App_control_footer'
) );
$App_controller->call_controller( array(
    'className' => 'ads',
    'new' => 'App_control_ads'
) );