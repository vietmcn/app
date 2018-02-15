jQuery(function($){
	var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
	    bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts
 
	$(window).scroll(function(){
		var data = {
			'action': 'loadmore',
			//'query': app_loadmore_params.posts,
			'page' : app_loadmore_params.current_page,
			'security' : app_loadmore_params.check_nonce
		};
		
		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ) {
			$.ajax({
				url : app_loadmore_params.ajaxurl,
				data: data,
				type:'POST',
				beforeSend: function( xhr ){
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
					// you see, the AJAX call is in process, we shouldn't run it again until complete
					//canBeLoaded = false; 
				},
				complete: function( data ){
					// you can also remove your own preloader here
			    	$('#App').hide();
				},
				success: function( data ){
					if( data ) {
						$('#App').before( data ); // where to insert posts
						canBeLoaded = true; // the ajax is completed, now we can run it again
                        app_loadmore_params.current_page++;
                        $("img.app-lazy").lazyload();
						//Stop load post 
						if ( app_loadmore_params.current_page == app_loadmore_params.max_page ) {
							canBeLoaded = false;
						}
					} else {
                        canBeLoaded = false;
                    }
				},
				error: function( data ) {
					console.log('Lổi rồi Đại Vương ơi!');
				},
			});
		}
	});
});