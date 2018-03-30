jQuery(document).ready(function($){
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
	//lazyload youtube
	$.fn.LAZYYT = function() {
		$(this).lazyYT('AIzaSyD8kZXa_ycmJRrxlDc56zyYSuQniQVT7AY', {
			loading_text: 'It is loading!...',
			display_title: false,
			display_duration: true,
			youtube_parameters: 'rel=1&showinfo=0',
			default_ratio: '16:9',
		});
	};
	$('.js-lazyYT').each(function() {
		$(this).LAZYYT();
	});
	//
	var swiper = new Swiper('.app-gallery', {
		slidesPerView: 3,
		spaceBetween: 5,
		freeMode: true,
		lazy: true,
	});
	//Ajax Load More Post srcoll
	var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
	bottomOffset = 1500; // the distance (in px) from the page bottom when you want to load more posts
	
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
				type : 'POST',
				cache : false,
				async: true,
				datatype: "html",
				beforeSend : function ( xhr ) {
					// you see, the AJAX call is in process, we shouldn't run it again until complete
					canBeLoaded = false;
					//loading place
					$('#App').show().html('<div class="App-loading"><img src="//i.imgur.com/ug7qsYm.gif"/></div>');
				},
				complete : function( response ) {
					$('.App-youtube').removeClass('js-lazyYT');
				},
				success : function( response ) {
					setTimeout(function() {
					if( response ) { 
						$('#App').before( response );
						app_loadmore_params.current_page++
						//Lazy load images
						$("img.app-lazy").lazyload();
						canBeLoaded = true;
						//load youtube
						$('.js-lazyYT').each(function() {
							$(this).LAZYYT();
						});
						//swiper
						var swiper = new Swiper('.app-gallery', {
							slidesPerView: 3,
							spaceBetween: 5,
							freeMode: true,
							lazy: true,
						});
					} else {
						//$('#App').hide(); 
						canBeLoaded = false;
						$('#App').html('<h5 class="flex"><i class="ion-social-octocat"></i>Hết Gì Để Xem Rồi Nàng Ơi!!</h5>');
					}
					}, 500 );
				},
				
			});
		}
	});
});
