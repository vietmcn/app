//Ajax Load More Post srcoll
var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts
$(window).scroll(function(){

var load = $(this),
    data = {
    'action': 'loadmore',
    'query': app_loadmore_params.posts, // that's how we get params from wp_localize_script() function
    'page' : app_loadmore_params.current_page,
    'security' : app_loadmore_params.check_nonce
};
if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ) {
    $.ajax({
        url : app_loadmore_params.ajaxurl, // AJAX handler
        data : data,
        type : 'GET',
        beforeSend : function ( xhr ) {
            // you can also add your own preloader here
            /*$('#App').show().html(
                '<div class="timeline-item">\n' +
                '<div class="animated-background facebook">\n' +
                    '<div class="load-thumbnail"></div>\n'+
                    '<div class="load-thumbnail left"></div>\n'+
                    '<div class="load-thumbnail line"></div>\n'+
                    '<div class="load-thumbnail l1"></div>\n'+
                    '<div class="load-thumbnail right"></div>\n'+
                    '<div class="load-thumbnail r1"></div>\n'+
                '</div>\n'+
                '</div>'
            );*/
            $('#App').show().html(
                '<div class="App-loading"><img src="//i.imgur.com/ug7qsYm.gif"/></div>'
            );
            canBeLoaded = false;
        // you see, the AJAX call is in process, we shouldn't run it again until complete
        },
        success : function( data ){
            if( data ) { 
                //load.text( 'More posts' ).prev().before(data); // insert new posts
                $('#App').before( data );
                canBeLoaded = true;
                app_loadmore_params.current_page++;
                //Lazy load images
                $("img.app-lazy").lazyload();
                
                /*if ( app_loadmore_params.current_page == app_loadmore_params.max_page ) {
                    //canBeLoaded = false;
                    //$('#App').hide(); 
                    $('#App').html('No Content');
                }*/
            } else {
                //$('#App').hide(); 
                $('#App').html('<h5><i class="ion-social-octocat"></i>Hết Gì Để Xem Rồi Nàng Ơi!!</h5>');
                canBeLoaded = false;
            }
        }
    });
}
});