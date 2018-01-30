<?php
if( !class_exists( 'App_controller_footer' ) ) {
    class App_controller_footer extends Controller
    {
        public function __construct()
        {
            add_action( 'app_footer', array( $this, 'footer_before' ), 5 );
            add_action( 'app_footer', array( $this, 'footer_top' ) );
            add_action( 'app_footer', array( $this, 'footer_after' ), 50 );
        }
        public function footer_before()
        {
            echo '<div class="container no-gutters">';
        }
        public function footer_after()
        {
            echo '</div>';
        }
        public function footer_top()
        {
            $out  = '<div class="App-footer-info row">';
            $out .= '<div class="col-sm">Trangfox</div>';
            $out .= '<div class="col-sm">Trangfox</div>';
            $out .= '<div class="col-sm">Trangfox</div>';
            $out .= '</div>';
            echo $out;
        }
    }
    
}