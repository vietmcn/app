<?php
if ( !class_exists( 'App_control_ads' ) ) :
    class App_control_ads extends Controller
    {
        public function __construct()
        {
            add_action( 'app_ads', array( $this, 'ads_all' ) );
        }
        public function ads_all()
        {
            $out = '<div class="App-ads-before col-md-12"><img src="https://2.bp.blogspot.com/-psP86qKU7fQ/VmF-iHnLx3I/AAAAAAAAAUM/7guEh5aJUb4/s1600/boleh.png"/></div>';
            echo $out;
        }
    }
    
endif;