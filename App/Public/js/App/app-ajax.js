jQuery(function($){
	//SDK facebook
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = '//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=476780242707904&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));
	//lazy
	$("img.app-lazy").lazyload();
	//Swiper
	var swiper = new Swiper('.swiper-container', {
		lazy: true,
		pagination: {
		  el: '.swiper-pagination',
		  dynamicBullets: true,
		},
	});
	//Ajax Load More Post
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
					$('#App').show().html(
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
						$("img.app-lazy").lazyload();

						/*if ( app_loadmore_params.current_page == app_loadmore_params.max_page ) {
							//canBeLoaded = false;
							//$('#App').hide(); 
							$('#App').html('No Content');
						}*/
					} else {
						//$('#App').hide(); 
						$('#App').html('<h5><i class="ion-social-octocat"></i>Hết Gì Để Xem Rồi Đại Vương Ơi!</h5>');
						canBeLoaded = false;
					}
				}
			});
		}
	});
});