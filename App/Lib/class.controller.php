<?php
if ( !class_exists('Controller' ) ) {
    class Controller
    {
        public function call_controller()
        {
            require_once 'Control/class.content.php';
        }
    }
}
$App_controller new Controller();