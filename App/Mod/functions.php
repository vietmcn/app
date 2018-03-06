<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function app_classBody() {
    if ( is_page( array( 'video', 'gallery' ) ) ) {
        echo 'app-hidden';
        if ( is_page( 'video' ) ) {
            echo ' app-page-video';
        }
    } 
}
function app_before_wrap() {
    global $App_mobile;
    if ( ! $App_mobile->isMobile() ) {
        $class = 'col-md-9';
    } else {
        $class = 'col';
    }
    $out  = '<section class="App-content container">';
     $out .= '<div class="App-getContents row no-gutters col-12 '.$class.' " data-sticky-container>';
    echo $out;
}
function app_after_wrap()
{
    echo '</div></section>';
}