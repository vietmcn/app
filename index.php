<?php
get_header();
do_action( 'app_main_before' );
app_before_wrap();
do_action( 'app_main' );
app_after_wrap();
get_footer();