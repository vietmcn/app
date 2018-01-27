<?php
if ( !class_exists('Controller' ) ) {
    class Controller
    {
        public function call_controller( $atts = array() )
        {
            require_once get_template_directory().'/App/Control/class.'.$atts['className'].'.php';
            return new $atts['new'];
        }
    }
}
$App_controller = new Controller();