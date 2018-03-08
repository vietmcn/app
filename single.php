<?php
get_header();
echo '<article id="App-main" class="container"><div class="row">';
do_action( 'app_single' );
echo '</div></article>';
get_footer();