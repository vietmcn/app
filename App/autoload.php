<?php
//lib
require_once 'Lib/class.controller.php';
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