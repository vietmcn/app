<?php
if ( ! class_exists( 'App_getsidebar' ) ) :
    class App_getsidebar 
    {
        function sidebar_before() 
        {
            echo '<aside itemtype="http://schema.org/WPSideBar" itemscope role="complementary" class="App-widget">';
        }
        function sidebar_after()
        {
            echo '</aside>';
        }
        function sidebar( $atts )
        {
            if ( isset( $atts ) ) {
                dynamic_sidebar( $atts );
            } else {
                echo 'Lổi sidebar';
            }
        }
        function cover()
        {

        }
        public function Set( $atts = array() )
        {
            $this->sidebar_before();
            $this->sidebar( $atts['sidebar_slug'] );
            $this->sidebar_after();
        }    
    }
    
endif;
$App_getSidebar = new App_getsidebar();