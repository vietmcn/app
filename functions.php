<?php
//Get VerSion Template
$version = wp_get_theme('template');
$app_ver = $version->get( 'Version' );

require_once 'App/autoload.php';