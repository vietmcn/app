<?php
//Admin
if ( is_admin() ) {
    require_once 'Admin/class.metapost.php';
}
//lib
require_once 'Lib/class.controller.php';
require_once 'Lib/class.getMetapost.php';
require_once 'Lib/class.getPost.php';
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
    'className' => 'header',
    'new' => 'App_header'
) );
$App_controller->call_controller( array(
    'className' => 'content',
    'new' => 'App_content'
) );
$App_controller->call_controller( array(
    'className' => 'footer',
    'new' => 'App_controller_footer'
) );