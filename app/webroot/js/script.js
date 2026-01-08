jQuery(document).ready(function($){

var SITE_URL = 'http://uat.citizenshare.net/users';

  //START: FIX HEADER SCROLL
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var MQL = 1170;

	//primary navigation slide-in effect
	if($(window).width() > MQL) {
		var headerHeight = $('.cd-header').height();
		$(window).on('scroll',
		{
	        previousTop: 0
	    }, 
	    function () {
		    var currentTop = $(window).scrollTop();
		    //check if user is scrolling up
        //$('.cd-header').addClass('is-visible is-fixed');
		    if (currentTop < this.previousTop ) {
		    	//if scrolling up...
		    	if (currentTop > 0 && $('.cd-header').hasClass('is-fixed')) {
		    		//$('.cd-header').addClass('is-visible');
		    	} else {
            //$('.cd-header').removeClass('is-visible is-fixed');
		    	}
		    } else {
		    	//if scrolling down...
          //$('.cd-header').removeClass('is-visible');
          //if( currentTop > headerHeight && !$('.cd-header').hasClass('is-fixed')) $('.cd-header').addClass('is-fixed');
		    }
		    this.previousTop = currentTop;
		});
	}
  
	var fillingBlocks = $('.cd-service').not('.cd-service-divider');

	//store service items top position into an array
	var topValueFillingBlocks = [];
	fillingBlocks.each(function(index){
		var topValue = $(this).offset().top;
		topValueFillingBlocks[topValueFillingBlocks.length] = topValue;
	});

	//add the .focus class to the first service item
	fillingBlocks.eq(0).addClass('focus');

	$(window).on('scroll', function(){
		//check which service item is in the viewport and add the .focus class to it
		updateOnFocusItem(fillingBlocks.slice(1));
		//evaluate the $(window).scrollTop value and change the body::after and body::before background accordingly (using the new-color-n classes)
		bodyBackground(topValueFillingBlocks);
	});

	var contentSections = $('.cd-section'),
		navigationItems = $('.cd-secondary-nav a');

	updateNavigation();
	$(window).on('scroll', function(){
		updateNavigation();
	});

	//smooth scroll to the section
	navigationItems.on('click', function(event){
        if ($(this).attr('id') != 'btn-search') {
          smoothScroll($(this.hash));
        }
    });
    //smooth scroll to second section
    $('.cd-scroll-down').on('click', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
    });

    //close navigation on touch devices when selectin an elemnt from the list
    $('.touch .cd-secondary-nav a').on('click', function(){
    	$('.touch .cd-secondary-nav').removeClass('open');
    });
    
	function updateNavigation() {
		contentSections.each(function(){
			$this = $(this);
			var activeSection = $('.cd-secondary-nav a[href="#'+$this.attr('id')+'"]').data('number') - 1;
			if ( ( $this.offset().top - $(window).height()/2 < $(window).scrollTop() ) && ( $this.offset().top + $this.height() - $(window).height()/2 > $(window).scrollTop() ) ) {
				navigationItems.eq(activeSection).addClass('is-selected');
			}else {
				navigationItems.eq(activeSection).removeClass('is-selected');
			}
		});
	}

	function smoothScroll(target) {
							$('body,html').animate(
									{'scrollTop':target.offset().top},
									600
							);
	}
//END: FIX HEADER SCROLL

//START: SEARCH BAR HIDE/SHOW
    $('#btn-search').click(function() {
      $('.cd-header').hide();
      $('#search-outer').show();
      $('#s').focus();
    });
    
    $('#close>a').click(function(e) {
      e.preventDefault();
      $('.cd-header').show();
      $('#search-outer').hide();
    });
//END: SEARCH BAR HIDE/SHOW

//START: CART SLIDEIN
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var $L = 1200,
		$menu_navigation = $('cd-secondary-nav'),
		$cart_trigger = $('#cd-cart-trigger'),
		$lateral_cart = $('#cd-cart'),
		$shadow_layer = $('#cd-shadow-layer');

	//open cart
	$cart_trigger.on('click', function(event){
		event.preventDefault();
		//close lateral menu (if it's open)
		$menu_navigation.removeClass('speed-in');
		toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
	});

	//close lateral cart or lateral menu
	$shadow_layer.on('click', function(){
		$shadow_layer.removeClass('is-visible');
		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( $lateral_cart.hasClass('speed-in') ) {
			$lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$menu_navigation.removeClass('speed-in');
		} else {
			$menu_navigation.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$lateral_cart.removeClass('speed-in');
		}
	});

	//move #main-navigation inside header on laptop
	//insert #main-navigation after header on mobile
	move_navigation( $menu_navigation, $L);
	$(window).on('resize', function(){
		move_navigation( $menu_navigation, $L);
		
		if( $(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
			$menu_navigation.removeClass('speed-in');
			$shadow_layer.removeClass('is-visible');
			$('body').removeClass('overflow-hidden');
		}

	});
//END: CART SLIDEIN

//START: SIGN/SIGNUP/FORGOT PASSWORD
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_signup2 = $form_modal.find('#cd-signup2'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$form_modal_tab2 = $('.cd-switcher2'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup2 = $form_modal_tab.children('li').eq(1).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(0).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.cd-sign-nav');

	//open modal
	$main_nav.on('click', function(event){


			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');	
			//show the selected form
			if ($(event.target).is('.cd-signup')) {
        signup_selected();
			} else {
        login_selected();
   }
	});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//switch from a tab to another
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected2();
	});
	
	$form_modal_tab2.on('click', function(event) {
  event.preventDefault();
		signup_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'text' == $password_field.attr('type') ) ? $password_field.attr('type', 'password') : $password_field.attr('type', 'text');
		( 'Show' == $this.text() ) ? $this.text('Hide') : $this.text('Show');
		//focus and move cursor to the end of input field
		$password_field.putCursorAtEnd();
	});

	//show forgot-password form 
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//back to login from the forgot-password form
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup2.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup2.removeClass('selected');
		$('.cd-switcher li a.selected').text('Sign In');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup2.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$('.cd-switcher li a.selected').text('Sign Up');
	}

	function signup_selected2(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_signup2.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup2.addClass('selected');
	}
	
	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_signup2.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	//REMOVE THIS - it's just to show error messages 
	$form_login.find('input[type="submit"]').on('click', function(event){
    $('.cd-error-message').removeClass('is-visible');
    $('input').removeClass('has-error');
    if ($form_login.find('input[placeholder="Username"]').val().length == 0) {
      $form_login.find('input[placeholder="Username"]').addClass('has-error').next('span').addClass('is-visible');
      event.preventDefault();
    }
    if ($form_login.find('input[placeholder="Password"]').val().length == 0) {
      $form_login.find('input[placeholder="Password"]').addClass('has-error').next().next('span').addClass('is-visible');
      event.preventDefault();
    }
	});
  $form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});


	//IE9 placeholder fallback
	//credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
		  	}
		}).blur(function() {
		 	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  	$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
			 		input.val('');
				}
		  	})
		});
	}
//END: SIGNIN/SIGNUP/FORGOT PASSWORD

//BEGIN: PROJECT GALLERY
	var visionTrigger = $('.cd-3d-trigger'),
		galleryItems = $('#cd-gallery-items').children('li'),
		galleryNavigation = $('.cd-item-navigation a');

	//mobile - trigger 3d vision
	visionTrigger.on('click', function(){
		$this = $(this);
		// $this.parent('li').toggleClass('active');
		if( $this.parent('li').hasClass('active') ) {
			$this.parent('li').removeClass('active');
			hideNavigation($this.parent('li').find('.cd-item-navigation'));
		} else {
			$this.parent('li').addClass('active');
			updateNavigation2($this.parent('li').find('.cd-item-navigation'), $this.parent('li').find('.cd-item-wrapper'));
		}
		
	});

	//change image in the slider
	galleryNavigation.on('click', function(){
		$this = $(this);

		var direction = $this.text(),
			activeContainer = $this.parents('nav').eq(0).siblings('.cd-item-wrapper');
		if( direction=="Next") {
			showNextSlide(activeContainer);
		}else {
			showPreviousSlide(activeContainer);
		}
		updateNavigation2($this.parents('.cd-item-navigation').eq(0), activeContainer);
	});
	//desktop - update navigation visibility
	$('.no-touch #cd-gallery-items li').hover(function(){
		$this = $(this).children('.cd-item-wrapper');
		updateNavigation2($this.siblings('nav').find('.cd-item-navigation').eq(0), $this);
	}, function(){
		$this = $(this).children('.cd-item-wrapper');
		hideNavigation($this.siblings('nav').find('.cd-item-navigation').eq(0));
	});

	function showNextSlide(container) {
		var itemToHide = container.find('.cd-item-front'),
			itemToShow = container.find('.cd-item-middle'),
			itemMiddle = container.find('.cd-item-back'),
			itemToBack = container.find('.cd-item-out').eq(0);

		itemToHide.addClass('move-right').removeClass('cd-item-front').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			itemToHide.addClass('hidden');
		});
		itemToShow.addClass('cd-item-front').removeClass('cd-item-middle');
		itemMiddle.addClass('cd-item-middle').removeClass('cd-item-back');
		itemToBack.addClass('cd-item-back').removeClass('cd-item-out');
	}

	function showPreviousSlide(container) {
		var itemToMiddle = container.find('.cd-item-front'),
			itemToBack = container.find('.cd-item-middle'),
			itemToShow = container.find('.move-right').slice(-1),
			itemToOut = container.find('.cd-item-back');

		// itemToShow.removeClass('hidden').removeClass('move-right').addClass('cd-item-front');
		itemToShow.removeClass('hidden').addClass('cd-item-front');
		itemToMiddle.removeClass('cd-item-front').addClass('cd-item-middle');
		itemToBack.removeClass('cd-item-middle').addClass('cd-item-back');
		itemToOut.removeClass('cd-item-back').addClass('cd-item-out');

		var stop = setInterval(function(){myTimer()}, 100);
		
		function myTimer(){
			if( !itemToShow.hasClass('hidden') ) {
				itemToShow.removeClass('move-right');
				window.clearInterval(stop);
			}
		}
	}

	function updateNavigation2(navigation, container) {
		var isNextActive = ( container.find('.cd-item-middle').length > 0 ) ? true : false,
			isPrevActive = 	( container.children('li').eq(0).hasClass('cd-item-front') ) ? false : true;
		(isNextActive) ? navigation.find('a').eq(1).addClass('visible') : navigation.find('a').eq(1).removeClass('visible');
		(isPrevActive) ? navigation.find('a').eq(0).addClass('visible') : navigation.find('a').eq(0).removeClass('visible');
	}

	function hideNavigation(navigation) {
		navigation.find('a').removeClass('visible');
	}
//END: PROJECT GALLERY

/*
//START: QTIP Profile
    function setup_profile(data) {
							var htmlstring;
							htmlstring =	'<div class="profile">';
							htmlstring +=	'<div class="profile_details">';
							htmlstring +=	'<div class="image_container">';
							profile_img = null;
							$.each(data.File, function (k,v) {
														profile_img = v.name;
							});
							if (profile_img != null) {
							htmlstring +=	'<img src="/files/'+data.User.id+'/user/'+profile_img+'" border="0">';
							} else {
							htmlstring +=	'<img src="/files/default/user/blank-profile.png" border="0">';
							}
							htmlstring +=	'</div>';
							htmlstring +=	'<div class="name">';
							$.each(data.Profile, function (k,v) {
														profile_name = v.first_name + ' ' + v.last_name;
														profile_title = v.industry_title;
							});
							htmlstring +=	profile_name;
							htmlstring +=	'</div>';
							htmlstring +=	'<div class="industry_title">';
							htmlstring +=	profile_title;
							htmlstring +=	'</div>';
							htmlstring +=	'<div><a href="/users/profile/'+data.User.id+'" class="btn">View Full Profile</a></div>';
							htmlstring +=	'<div class="follow">';
							if (data.Followed.id != null) {
							htmlstring +=	'<a href="/users/unfollow/'+data.User.id+'" class="btn btn-green btn-ghost">Unfollow</a>';
							} else {
							htmlstring +=	'<a href="/users/follow/'+data.User.id+'" class="btn btn-green">Follow</a>';
							}
							htmlstring +=	'</div></div>';
							htmlstring +=	'<div class="network">';
							htmlstring +=	'<h3>Followers</h3>';
							htmlstring +=	'<div class="followers">';
							$.each(data.Follower, function (fk,fv) {
														profile_img2 = null;
							htmlstring +=	'<div class="people">';
							htmlstring +=	'<span class="avatar-small"><a href="'+SITE_URL+'/profile/'+fv.id+'" data-hasqtip="0">';
							profile_img2 = null;
							$.each(fv.File, function (k,v) {
														profile_img2 = v.name;
							});
							if (profile_img2 != null) {
							htmlstring +=	'<img src="/files/'+fv.id+'/user/'+profile_img2+'" border="0" class="avatar-image">';
							} else {
							htmlstring +=	'<img src="/files/default/user/blank-profile.png" border="0" class="avatar-image" border="0">';
							}
							htmlstring +=	'</a></span></div>';
							});
							htmlstring +=	'<div class="margin20"><a class="red" href="/users/followers/'+data.User.id+'">View all &rarr;</a></div>';
							htmlstring +=	'</div><h3>Followings</h3>';
							htmlstring +=	'<div class="following">';
							$.each(data.Following, function (fk,fv) {
														profile_img3 = null;
							htmlstring +=	'<div class="people">';
							htmlstring +=	'<span class="avatar-small">';
							htmlstring +=	'<a href="'+SITE_URL+'/profile/'+fv.id+'" data-hasqtip="1">';
							profile_img3 = null;
							$.each(fv.File, function (k,v) {
														profile_img3 = v.name;
							});
							if (profile_img3 != null) {
							htmlstring +=	'<img src="/files/'+fv.id+'/user/'+profile_img3+'" border="0" class="avatar-image">';
							} else {
							htmlstring +=	'<img src="/files/default/user/blank-profile.png" border="0" class="avatar-image" border="0">';
							}
							htmlstring +=	'</div>';
							});
							htmlstring +=	'<div class="margin20"><a class="red" href="/users/followings/'+data.User.id+'">View all &rarr;</a></div>';
							htmlstring +=	'</div></div></div>';
							return htmlstring;
				}
    $('.avatar-small>a').each(function() {
         $(this).qtip({
     							hide: 'unfocus',
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href'), // Use href attribute as URL
																								type: 'POST',
																								dataType: 'json',
																								crossDomain: true,
																								data: { ajax: true }
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
                        var context = setup_profile(content);
																								api.set('content.text', context);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    }); 
        
                    return 'Loading...'; // Set some initial text
                }
            },
            position: {
														  my: 'top center',
																at: 'bottom center',
														  viewport: $(window)
            },
            style: 'qtip-bootstrap'
         });
     });

    $('.name>a').each(function() {
         $(this).qtip({
     							hide: 'unfocus',
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href'), // Use href attribute as URL
																								type: 'POST',
																								dataType: 'json',
																								crossDomain: true,
																								data: { ajax: true }
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
																								var context = setup_profile(content);
                        api.set('content.text', context);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    });
        
                    return 'Loading...'; // Set some initial text
                }
            },
            position: {
														  my: 'top center',
																at: 'bottom center',
																viewport: $(window)
            },
            style: 'qtip-bootstrap'
         });
     });
//END: QTIP Profile
*/

//START: FOLLOW
$(document.body).on('click', '.category_follow a.btn', function(e) {
							e.preventDefault();
							$(this).text('FOLLOWING');
							$(this).parents('.category_follow').find('.count').text(parseInt($(this).parents('.category_follow').find('.count').text())+1);
});

$('div.follow>a.btn-small').click(function(e) {
							e.preventDefault();
							$(this).text('Following');
});

$(document.body).on('click', 'div.follow>a', function(e) {
							e.preventDefault();
						 var followbtn = $(this);
							var id = followbtn.attr('href').replace('/users/follow/', '');
						 var actionurl = '/users/follow/';
						 if ($(this).hasClass('btn-ghost')) {
														actionurl = '/users/unfollow/';
														id = followbtn.attr('href').replace('/users/unfollow/', '');
						 }
						 $.ajax({
														dataType: 'json',
														method: 'GET',
														url: actionurl + id
       })
       .done(function(msg){
														if (msg == 'success') {							
																					if (followbtn.hasClass('btn-ghost')) {
																												followbtn.text('Follow');
																												followbtn.removeClass('btn-ghost');
																					} else {
																												followbtn.text('Unfollow');
																												followbtn.addClass('btn-ghost');
																					}
														}
						 })
							.fail(function (xhr, ajaxOptions, thrownError) {
														if (xhr.status==403) {
																		$('.cd-sign-nav .cd-signin').click();
														}
						 });
});
//END: FOLLOW

$('#about iframe').contents().find('.pluginButtonContainer').css({'background':'#c8c8c8 !important'});
$('#about iframe').contents().find('.pluginButtonImage').css({'background':'#c8c8c8 !important'});
$('#about iframe').contents().find('.pluginButtonLabel').css({'background':'#c8c8c8 !important'});

$('a .save_class').click(function(e) {
			e.preventDefault();
			$('.class_save_notification').hide();
			$('.class_save_notification').show();
});

$('.class_save_notification .close').click(function(e) {
							e.preventDefault();
							$('.class_save_notification').hide();
});

});

jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};

function toggle_panel_visibility ($lateral_panel, $background_layer, $body) {
	if( $lateral_panel.hasClass('speed-in') ) {
		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		$lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$body.removeClass('overflow-hidden');
		});
		$background_layer.removeClass('is-visible');

	} else {
		$lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$body.addClass('overflow-hidden');
		});
		$background_layer.addClass('is-visible');
	}
}

function move_navigation( $navigation, $MQ) {
	if ( $(window).width() >= $MQ ) {
		$navigation.detach();
		$navigation.appendTo('header');
	} else {
		$navigation.detach();
		$navigation.insertAfter('header');
	}
}

function updateOnFocusItem(items) {
  items.each(function(){
    ( $(this).offset().top - $(window).scrollTop() <= $(window).height()/2 ) ? $(this).addClass('focus') : $(this).removeClass('focus');
  });
}

function bodyBackground(itemsTopValues) {
  var topPosition = $(window).scrollTop() + $(window).height()/2,
    servicesNumber = itemsTopValues.length;
  $.each(itemsTopValues, function(key, value){
    if ( (itemsTopValues[key] <= topPosition && itemsTopValues[key+1] > topPosition) || (itemsTopValues[key] <= topPosition && key+1 == servicesNumber ) ) {	
      $('body').removeClass('new-color-'+(key-1)+' new-color-'+(key+1)).addClass('new-color-'+key);
    }
  });
}
