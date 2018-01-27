<?php
//lib
require_once 'Lib/class.controller.php';
//Controller Templates
require_once 'Control/class.template.php';
require_once 'Control/class.scripts.php';

$App_Controller->call_controller( array(
    'control_name' => '',
    'link' => '',
) );