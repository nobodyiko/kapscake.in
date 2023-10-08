

(function ($) {
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());

	/* Smartresize */
	(function ($, sr) {
		var debounce = function (func, threshold, execAsap) {
			var timeout;
			return function debounced() {
				var obj = this, args = arguments;

				function delayed() {
					if (!execAsap)
						func.apply(obj, args);
					timeout = null;
				}

				if (timeout)
					clearTimeout(timeout);
				else if (execAsap)
					func.apply(obj, args);
				timeout = setTimeout(delayed, threshold || 100);
			};
		};
		// smartresize
		jQuery.fn[sr] = function (fn) {
			return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
		};
	})(jQuery, 'smartresize');

	//Back To top
	var back_to_top = function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-to-top').css({bottom: "15px"});
			} else {
				jQuery('#back-to-top').css({bottom: "-100px"});
			}
		});
		jQuery('#back-to-top').click(function () {
			jQuery('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	};

	$(document).ready(function () {
		var $header = $('#masthead.header_default');
		var $content_pusher = $('#wrapper-container .content-pusher');
		$header.imagesLoaded(function () {
			var height_sticky_header = $header.outerHeight(true);
			$content_pusher.css({"padding-top": height_sticky_header + 'px'});
			$(window).resize(function () {
				var height_sticky_header = $header.outerHeight(true);
				$content_pusher.css({"padding-top": height_sticky_header + 'px'});
			});
		});
	});

	var thim_TopHeader = function () {
		var header = $('#masthead'),
			height_sticky_header = header.outerHeight(true),
			content_pusher = $('#wrapper-container .content-pusher'),
			top_site_main = $('#wrapper-container .top_site_main');

		//header_overlay
		if (header.hasClass('header_overlay')) {
			//header overlay
			header.imagesLoaded(function () {
				top_site_main.css({"padding-top": height_sticky_header + 'px'});
				$(window).resize(function () {
					var height_sticky_header = header.outerHeight(true);
					top_site_main.css({"padding-top": height_sticky_header + 'px'});
				});
			});
		} else {
			//Header default
			header.imagesLoaded(function () {
				if (header.hasClass('sticky-header')) {
					content_pusher.css({"padding-top": height_sticky_header + 'px'});
					$(window).resize(function () {
						var height_sticky_header = header.outerHeight(true);
						content_pusher.css({"padding-top": height_sticky_header + 'px'});
					});
				} else {
					content_pusher.css({"padding-top": "0px"});
					$(window).resize(function () {
						content_pusher.css({"padding-top": "0px"});
					});
				}
				;
			});
		}
	};

	var thimMenu = function () {
		//Add class for masthead
		var $header = $('#masthead.sticky-header'),
			off_Top = ($('.content-pusher').length > 0) ? $('.content-pusher').offset().top : 0,
			menuH = $header.outerHeight(),
			latestScroll = 0;
		if ($(window).scrollTop() > 2) {
			$header.removeClass('affix-top').addClass('affix');
		}

		var $thimfixed = $('.thim-fixed');
		var thimfixedTop = ($thimfixed.length > 0) ? $thimfixed.offset().top : 0;
		if (thimfixedTop != 0) {
			$thimfixed.css('width', $thimfixed.width());
		}
		;

		$(window).scroll(function () {

			var current = $(this).scrollTop();

			if (current > 2) {
				$header.removeClass('affix-top').addClass('affix');
				if ($header.hasClass('header_v2')) {
					$header.css({
						top: off_Top
					});
				}
				;
				if (current > menuH + off_Top) {
					if ($header.hasClass('header_v2')) {
						var $header_inner = $('.inner-header-top'),
							header_inner_height = $header_inner.outerHeight();
						$header.css({
							top: off_Top - header_inner_height
						});
					}
					;
				}
				;
			} else {
				$header.removeClass('affix').addClass('affix-top').removeClass('menu-show');
				if ($header.hasClass('header_v2')) {
					$header.css({
						top: 0
					});
				}
				;
			}

			if (current > latestScroll && current > menuH + off_Top) {
				if (!$header.hasClass('menu-hidden')) {
					$header.addClass('menu-hidden').removeClass('menu-show');
				}
			} else {
				if ($header.hasClass('menu-hidden')) {
					if ($header.hasClass('header_v2')) {
						var $header_inner = $('.inner-header-top'),
							header_inner_height = $header_inner.outerHeight();
						$header.css({
							top: off_Top - header_inner_height
						});
					}
					;

					$header.removeClass('menu-hidden').addClass('menu-show');
				}
			}

			latestScroll = current;


		});

		//Show submenu when hover
		if ($(window).width() > 767) {
			$('.wrapper-container:not(.mobile-menu-open) .site-header .navbar-nav >li,.wrapper-container:not(.mobile-menu-open) .site-header .navbar-nav li,.site-header .navbar-nav li ul li').on({
				'mouseenter': function () {
					$(this).children('.sub-menu').stop(true, false).fadeIn(250);
				},
				'mouseleave': function () {
					$(this).children('.sub-menu').stop(true, false).fadeOut(250);
				}
			});
		}

		if ($(window).width() > 767 && $('body').hasClass('header_v1')) {
			//Magic Line
			var menu_active = $('#masthead .navbar-nav>li.menu-item.current-menu-item,#masthead .navbar-nav>li.menu-item.current-menu-parent');

			if (menu_active.length > 0) {
				menu_active.before('<span id="magic-line"></span>');
				var menu_active_child = menu_active.find('>a,>span.disable_link'),
					menu_left = menu_active.position().left,
					menu_child_left = parseInt(menu_active_child.css('padding-left')),
					magic = $('#magic-line');
				magic.width(menu_active_child.width()).css("left", Math.round(menu_child_left + menu_left)).data('magic-width', magic.width()).data('magic-left', magic.position().left);
			} else {
				var first_menu = $('#masthead .navbar-nav>li.menu-item:first-child');
				first_menu.after('<span id="magic-line"></span>');
				var magic = $('#magic-line');
				magic.data('magic-width', 0);
			}

			$('#masthead .navbar-nav>li.menu-item').on({
				'mouseenter': function () {
					var elem = $(this).find('>a,>span.disable_link'),
						new_width = elem.width(),
						parent_left = elem.parent().position().left,
						left = parseInt(elem.css('padding-left'));
					if (!magic.data('magic-left')) {
						magic.css('left', Math.round(parent_left + left));
						magic.data('magic-left', 'auto');
					}
					magic.stop().animate({
						left : Math.round(parent_left + left),
						width: new_width
					});
				},
				'mouseleave': function () {
					magic.stop().animate({
						left : magic.data('magic-left'),
						width: magic.data('magic-width')
					});
				}
			});
		}

	};

	/* ****** jp-jplayer  ******/
	var post_audio = function () {
		$('.jp-jplayer').each(function () {
			var $this = $(this),
				url = $this.data('audio'),
				type = url.substr(url.lastIndexOf('.') + 1),
				player = '#' + $this.data('player'),
				audio = {};
			audio[type] = url;
			$this.jPlayer({
				ready              : function () {
					$this.jPlayer('setMedia', audio);
				},
				swfPath            : 'jplayer/',
				cssSelectorAncestor: player
			});
		});
	};

	var post_gallery = function () {
		if($('article.format-gallery .flexslider').length){
			$('article.format-gallery .flexslider').imagesLoaded(function () {
				$('article.format-gallery .flexslider').flexslider({
					slideshow     : true,
					animation     : 'fade',
					pauseOnHover  : true,
					animationSpeed: 400,
					smoothHeight  : true,
					directionNav  : true,
					controlNav    : false
				});
			});
		}
	};

	$(function () {
		back_to_top();
		/* Menu Sidebar */
		jQuery('.sliderbar-menu-controller').on('click', function (e) {
			e.stopPropagation();
			jQuery('.slider-sidebar').toggleClass('opened');
			jQuery('html,body').toggleClass('slider-bar-opened');
		});
		jQuery('#wrapper-container').on('click', function () {
			jQuery('.slider-sidebar').removeClass('opened');
			jQuery('html,body').removeClass('slider-bar-opened');
		});
		jQuery(document).keyup(function (e) {
			if (e.keyCode === 27) {
				jQuery('.slider-sidebar').removeClass('opened');
				jQuery('html,body').removeClass('slider-bar-opened');
			}
		});


		/* Waypoints magic
		 ---------------------------------------------------------- */
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
				jQuery(this).addClass('wpb_start_animation');
			}, {offset: '85%'});
		}
	});

	function empty(data) {
		if (typeof (data) == 'number' || typeof (data) == 'boolean') {
			return false;
		}
		if (typeof (data) == 'undefined' || data === null) {
			return true;
		}
		if (typeof (data.length) != 'undefined') {
			return data.length === 0;
		}
		var count = 0;
		for (var i in data) {
			if (Object.prototype.hasOwnProperty.call(data, i)) {
				count++;
			}
		}
		return count === 0;
	}

	var windowWidth = window.innerWidth,
		windowHeight = window.innerHeight,
		$document = $(document),
		orientation = windowWidth > windowHeight ? 'landscape' : 'portrait';
	var TitleAnimation = {
		selector   : '.article__parallax',
		initialized: false,
		animated   : false,
		initialize : function () {
			var that = this;
			if (this.initialized) {
				return;
			}
			this.initialized = true;
			$(this.selector).each(function (i, header) {
				var windowHeight = window.innerHeight,
					wh = $(window).height(),
					$header = $(header),
					$headline = $header.find('.article_heading'),
					timeline = new pixGS.TimelineMax(),
					$title = $headline.find('.heading__primary'),
					$subtitle = $headline.find('.heading__secondary'),
					headerTop = $header.offset().top,
					headerHeight = $header.outerHeight();
				// ------ A
				timeline.fromTo($title, 0.89, {opacity: 0}, {opacity: 1, ease: pixGS.Expo.easeOut}, '-=0.72');
				timeline.fromTo($title, 1, {'y': 30}, {'y': 0, ease: pixGS.Expo.easeOut}, '-=0.89');
				timeline.fromTo($subtitle, 0.65, {opacity: 0}, {opacity: 1, ease: pixGS.Quint.easeOut}, '-=0.65');
				timeline.fromTo($subtitle, 0.9, {y: 30}, {y: 0, ease: pixGS.Quint.easeOut}, '-=0.65');
				// ------ B
				timeline.addLabel("animatedIn");
				if (i == 0) {
					timeline.to($headline, 1.08, {y: -60, ease: pixGS.Linear.easeNone});
					timeline.to($title, 1.08, {opacity: 0, y: -60, ease: pixGS.Quad.easeIn}, '-=1.08');
				} else {
					timeline.to($title, 1.08, {opacity: 0, y: -60, ease: pixGS.Quad.easeIn});
				}

				timeline.to($subtitle, 1.08, {opacity: 0, y: -90, ease: pixGS.Quad.easeIn}, '-=1.08');
				timeline.addLabel("animatedOut");
				// ------ C
				var animatedInTime = timeline.getLabelTime("animatedIn"),
					animatedOutTime = timeline.getLabelTime("animatedOut"),
					start = headerTop + headerHeight / 2 - wh / 2,
					end = start + headerHeight / 2,
					ab, bc;

				ab = animatedInTime / animatedOutTime;
				bc = 1 - ab;

				if (Modernizr.touch) {
					timeline.tweenTo("animatedIn");
					return;
				}

				timeline.tweenTo("animatedOut", {
					onComplete: function () {
						$headline.data("animated", true);
					},
					onUpdate  : function () {
						var progress = (1 / (end - start)) * (latestScrollY - start),
							partialProgress = progress < 0 ? ab : ab + bc * progress,
							currentProgress = timeline.progress();

						if (Math.abs(partialProgress - currentProgress) < 0.01) {
							$headline.data("animated", true);
							this.kill();
						}
					}
				});

				$headline.data('tween', {
					timeline: timeline,
					ab      : ab,
					bc      : bc,
					start   : start,
					end     : end
				});
			});
			this.update();
		},
		update     : function () {
			var that = this;
			$(this.selector).each(function (i, element) {
				var $headline = $(element).find('.article_heading'),
					options = $headline.data('tween'),
					progress = 0;
				// some sanity check
				// we wouldn't want to divide by 0 - the Universe might come to an end
				if (!empty(options) && (options.end - options.start) !== 0) {
					progress = (1 / (options.end - options.start)) * (latestScrollY - options.start);
					// point B being labeled as "animated"
					var partialProgress = options.ab + options.bc * progress;
					$headline.data('progress', partialProgress);
					if (!$headline.data("animated") || (Modernizr.touch)) {
						return;
					}
					if (0 > progress) {
						partialProgress = options.ab;
					}
					if (1 > partialProgress) {
						options.timeline.progress(partialProgress);
						return;
					}
					options.timeline.progress(1);
				}
			});
		}
	};
	/* ====== ON RESIZE ====== */
	$(window).load(function () {
		thim_TopHeader();
		thimMenu();
		setTimeout(function () {
			TitleAnimation.initialize();
		}, 400);
		if($('#carousel').length){
			$('#carousel').flexslider({
				animation    : "slide",
				controlNav   : false,
				animationLoop: false,
				slideshow    : false,
				itemWidth    : 180,
				itemMargin   : 5,
				asNavFor     : '#slider'
			});
		}
		if($('#slider').length){
			$('#slider').flexslider({
				controlNav   : false,
				animationLoop: false,
				slideshow    : false,
				sync         : "#carousel",
			});
		}
	});

	$(window).on("debouncedresize", function (e) {
		windowWidth = $(window).width();
		windowHeight = $(window).height();
		TitleAnimation.initialize();
	});

	$(window).on("orientationchange", function (e) {
		setTimeout(function () {
			TitleAnimation.initialize();
		}, 300);
	});

	var latestScrollY = $('html').scrollTop() || $('body').scrollTop(),
		ticking = false;

	function updateAnimation() {
		ticking = false;
		TitleAnimation.update();
	}

	function requestScroll() {
		if (!ticking) {
			requestAnimationFrame(updateAnimation);
		}
		ticking = true;
	}

	$(window).on("scroll", function () {
		latestScrollY = $('html').scrollTop() || $('body').scrollTop();
		requestScroll();
	});

	/* ====== ON DOCUMENT READY ====== */
	$(document).ready(function () {
		post_audio();
		post_gallery();
	});

	//Preload
	$(window).load(function () {
		setTimeout(function () {
			$(window).resize(function () {
				$('.images_parallax').each(function (index, el) {
					$(el).imagesLoaded(function () {
						var parallaxHeight = $(this).find('img').height();
						$(this).height(parallaxHeight);
					});
				});
			}).trigger('resize');
		}, 500);

		if (jQuery().owlCarousel) {
			$(".thim-widget-event,.thim-gallery-images,.elementor-widget-thim-event").owlCarousel({
				autoplay          : true,
				items             : 1,
				loop              : true,
				autoplayHoverPause: true,
				dots              : true,
				nav               : false,
				autoHeight        : false
			});
			if($('.testimonials-style-4').length){
				$(".sc-testimonials").each(function(){
					var $time = $(this).attr('data-time');
					var $column =$(this).attr('data-column');
					
					$(".sc-testimonials").owlCarousel({
						autoplay          : true,
						items             : $column,
						margin            : 30,
						center: true,
						autoplayHoverPause: true,
						loop              : true,
						dots              : true,
						nav               : true,
						autoHeight        : false,
						autoplayTimeout   : $time,
						responsive : {
							// breakpoint from 0 up
							0 : {
								items : 1
							},
							// breakpoint from 480 up
							576 : {
								items : 2
							},
							// breakpoint from 768 up
							768 : {
								items : 2
							},
							1024 : {
								items : $column
							}
						}
					});
				})
			}else{
				$(".sc-testimonials").each(function(){
					if($(".sc-testimonials").length){
						var $time = $(this).attr('data-time');
						var $column =$(this).attr('data-column');
						var $column_tab;
						if($column >=2){
							$column_tab = 2;
						}else{
							$column_tab = 1;
						}
						$(".sc-testimonials").owlCarousel({
							autoplay          : true,
							items             : $column,
							margin            : 30,
							autoplayHoverPause: true,
							loop              : true,
							dots              : true,
							nav               : false,
							autoHeight        : false,
							autoplayTimeout   : $time,
							responsive : {
								// breakpoint from 0 up
								0 : {
									items : 1
								},
								// breakpoint from 480 up
								576 : {
									items : $column_tab
								},
								// breakpoint from 768 up
								768 : {
									items : $column_tab
								},
								1024 : {
									items : $column
								}
							}
						});
					}
				})
			}
			
			
			
		}
	});


	/* ****** PRODUCT QUICK VIEW  ******/
	var thim_quick_view = function () {
		$('.quick-view').on('click', function (e) {
			/* add loader  */
			$('.quick-view a').css('display', 'none');
			$(this).append('<a href="javascript:;" class="loading dark"></a>');
			var product_id = $(this).attr('data-prod');
			var data = {action: 'jck_quickview', product: product_id};
			$.post(ajaxurl, data, function (response) {
				$.magnificPopup.open({
					mainClass: 'my-mfp-zoom-in',
					items    : {
						src : '<div class="mfp-iframe-scaler">' + response + '</div>',
						type: 'inline'
					}
				});
				$('.quick-view a').css('display', 'inline-block');
				$('.loading').remove();
				$('.product-card .wrapper').removeClass('animate');
			});
			e.preventDefault();
		});
	};
	thim_quick_view();

	/**
	 * Woo load more
	 */
	var loadmore_woo = function (){
		var page = 1;
		$('.loadmore-product').on('click', function () {
			var button 		= $(this);
			var max_page 	= $(this).data('maxpage');
			var query 		= $(this).data('query');
			var data = {
				'action': 'loadmore-product',
				'page' : page,
				'query': query
			};

			$.ajax({
				url : ajaxurl,
				data : data,
				type : 'POST',
				beforeSend : function ( xhr ) {
					button.text('Loading...');
				},
				success : function( data ){
					if( data ) {
						$('.product-grid').append(data);
						button.text( 'Load more' );
						page = page+1;
						thim_quick_view();
						if ( page == max_page )
						button.remove();
					} else {
						button.remove();
					}
				}
			});
		});
	}
	loadmore_woo();

	var miniCartHover = function () {
		jQuery(document).on('mouseenter', '.minicart_hover', function () {
			jQuery(this).next('.widget_shopping_cart_content').slideDown();
		}).on('mouseleave', '.minicart_hover', function () {
			jQuery(this).next('.widget_shopping_cart_content').delay(100).stop(true, false).slideUp();
		});
		jQuery(document)
			.on('mouseenter', '.widget_shopping_cart_content', function () {
				jQuery(this).stop(true, false).show();
			})
			.on('mouseleave', '.widget_shopping_cart_content', function () {
				jQuery(this).delay(100).stop(true, false).slideUp();
			});
	};

	miniCartHover();

	jQuery(function ($) {
		var adminbar_height = jQuery('#wpadminbar').outerHeight();
		jQuery('.navbar-nav li a,.arrow-scroll > a').on('click', function (e) {
			if (parseInt(jQuery(window).scrollTop(), 10) < 2) {
				var height = 47;
			} else height = 0;
			var sticky_height = jQuery('#masthead').outerHeight();
			var menu_anchor = jQuery(this).attr('href');
			if (menu_anchor && menu_anchor.indexOf("#") == 0 && menu_anchor.length > 1) {
				e.preventDefault();
				$('html,body').animate({
					scrollTop: jQuery(menu_anchor).offset().top - adminbar_height - sticky_height + height
				}, 850);
			}
		});
	});

	/* Menu Sidebar */
	jQuery('.menu-mobile-effect').on('click', function (e) {
		e.stopPropagation();
		jQuery('.wrapper-container').toggleClass('mobile-menu-open');
	});

	jQuery('#main-content').on('click', function () {
		jQuery('.wrapper-container').removeClass('mobile-menu-open');
	});

	function mobilecheck() {
		var check = false;
		(function (a) {
			if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true
		})(navigator.userAgent || navigator.vendor || window.opera);
		return check;
	}

	/* mobile menu */
	if (jQuery(window).width() > 768) {
		jQuery('.navbar-nav>li.menu-item-has-children >a,.navbar-nav>li.menu-item-has-children >span').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
	} else {
		jQuery('.navbar-nav>li.menu-item-has-children:not(.current-menu-parent) >a,.navbar-nav>li.menu-item-has-children:not(.current-menu-parent) >span').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
		jQuery('.navbar-nav>li.menu-item-has-children.current-menu-parent >a,.navbar-nav>li.menu-item-has-children.current-menu-parent >span').after('<span class="icon-toggle"><i class="fa fa-angle-up"></i></span>');
	}
	jQuery('.navbar-nav>li.menu-item-has-children .icon-toggle').on('click', function (event) {
		//alert('test');
		if (jQuery(this).next('ul.sub-menu').is(':hidden')) {
			jQuery(this).next('ul.sub-menu').slideDown(500, 'linear');
			jQuery(this).html('<i class="fa fa-angle-up"></i>');
		} else {
			jQuery(this).next('ul.sub-menu').slideUp(500, 'linear');
			jQuery(this).html('<i class="fa fa-angle-down"></i>');
		}
	});

	if ($(window).width() < 767) {
		jQuery('.thim-widget-icon-box video').data('autoplay', false);
		jQuery('.elementor-widget-thim-icon-box video').data('autoplay', false);
	}


})(jQuery);

(function ($) {
	function unique_id() {
		function s4() {
			return Math.floor((1 + Math.random()) * 0x10000)
				.toString(16)
				.substring(1);
		}

		return s4() + s4() + s4() + s4();
	}

	$.fn.RevTextAnim = function (options) {
		return $.each(this, function () {
			var RevTextAnim = $(this).data('RevTextAnim');
			if ($.type(RevTextAnim) == 'undefined') {
				RevTextAnim = new $.RevTextAnim(this, options);
				$(this).data('RevTextAnim', RevTextAnim);
			}
			return this;
		});
	};

	$.RevTextAnim = function (elem, options) {
		this.options = $.extend({
			items: '>*'
		}, options || {});
		var that = this,
			$window = $(window),
			$element = $(elem);
		$items = $element.find(this.options.items),
			containerOffset = $element.offset();

		function initialize() {
			$window.bind('scroll.' + unique_id(), function () {
				var scrollTop = $window.scrollTop(),
					dx = (scrollTop - (containerOffset.top - that.options.offset)) / ($element.height() / 2);
				$items = $element.find(that.options.items);
				if (scrollTop > 0) {
					var len = $items.length;
					$items.each(function (i) {
						var dy = ((len - i) * dx);
						dy = -(dy * dy * dy) * 2;
						$(this).css({
							transform : 'translate3d(0px, ' + dy + 'px, 0px)',
							opacity   : Math.max(0, 1 - (dx / 2)),
							transition: 'initial'
						});
					});

				} else if (scrollTop == 0) {
					$items.each(function (i) {
						$(this)
							.css('transform', '')
							.css('opacity', '');
					});
				}
			});
		}

		initialize();
	};
	$(document).ready(function () {
		setTimeout(function () {
			$('.tp-revslider-mainul >li,.images_parallax').RevTextAnim({
				items : '.heading__secondary, .heading__primary, .show-separator, .tp-caption .tp-button',
				offset: 200
			});
		}, 1000);

		var winWidth = $(window).width();
		if (winWidth <= 360) {
			$('td.hb_addition_name[colspan="3"]').each(function () {
				$(this).attr('colspan', 1);
			});
		} else if (winWidth <= 767) {
			$('td.hb_addition_name[colspan="3"]').each(function () {
				$(this).attr('colspan', 2);
			});
		}
	});
	jQuery(function ($) {
		$('.video-container').on('click', '.beauty-intro .btns', function () {
			var iframe = '<iframe src="' + $(this).closest(".video-container").find(".yt-player").attr('data-video') + '" height= "' + $('.parallaxslider').height() + '"></iframe>';
			$(this).closest(".video-container").find(".yt-player").replaceWith(iframe);
			//debug >HP
			$(this).closest(".video-container").find('.hideClick:first').css('display', 'none');
		});

		/* Icon Box */
		$(".wrapper-box-icon").each(function () {
			var $this = $(this);
			if ($this.attr("data-icon")) {
				var $color_icon = $(".boxes-icon", $this).css('color');
				var $color_icon_change = $this.attr("data-icon");
			}
			if ($this.attr("data-icon-border")) {
				var $color_icon_border = $(".boxes-icon", $this).css('border-color');
				var $color_icon_border_change = $this.attr("data-icon-border");
			}
			if ($this.attr("data-icon-bg")) {
				var $color_bg = $(".boxes-icon", $this).css('background-color');
				var $color_bg_change = $this.attr("data-icon-bg");
			}


			if ($this.attr("data-btn-bg")) {
				var $color_btn_bg = $(".smicon-read", $this).css('background-color');
				var $color_btn_border = $(".smicon-read", $this).css('border-color');
				var $color_btn_bg_text_color = $(".smicon-read", $this).css('color');

				var $color_btn_bg_change = $this.attr("data-btn-bg");
				if ($this.attr("data-text-readmore")) {
					var $color_btn_bg_text_color_change = $this.attr("data-text-readmore");
				} else {
					$color_btn_bg_text_color_change = $color_btn_bg_text_color;
				}

				$(".smicon-read", $this).on({
					'hover'     : function () {
						if ($("#style_selector_container").length > 0) {
							if ($(".smicon-read", $this).css("background-color") != $color_btn_bg)
								$color_btn_bg = $(".smicon-read", $this).css('background-color');
						}
						$(".smicon-read", $this).css({
							'background-color': $color_btn_bg_change,
							'border-color'    : $color_btn_bg_change,
							'color'           : $color_btn_bg_text_color_change
						});
					},
					'mouseleave': function () {
						$(".smicon-read", $this).css({
							'background-color': $color_btn_bg,
							'border-color'    : $color_btn_border,
							'color'           : $color_btn_bg_text_color
						});
					}
				});

			}

			$(".boxes-icon", $this).on({
				'hover'     : function () {
					if ($this.attr("data-icon")) {
						$(".boxes-icon", $this).css({'color': $color_icon_change});
					}
					if ($this.attr("data-icon-bg")) {
						/* for select style*/
						if ($("#style_selector_container").length > 0) {
							if ($(".boxes-icon", $this).css("background-color") != $color_bg)
								$color_bg = $(".boxes-icon", $this).css('background-color');
						}

						$(".boxes-icon", $this).css({'background-color': $color_bg_change});
					}
					if ($this.attr("data-icon-border")) {
						$(".boxes-icon", $this).css({'border-color': $color_icon_border_change});
					}
				},
				'mouseleave': function () {
					if ($this.attr("data-icon")) {
						$(".boxes-icon", $this).css({'color': $color_icon});
					}
					if ($this.attr("data-icon-bg")) {
						$(".boxes-icon", $this).css({'background-color': $color_bg});
					}
					if ($this.attr("data-icon-border")) {
						$(".boxes-icon", $this).css({'border-color': $color_icon_border});
					}
				}
			});

		});
		/* End Icon Box */

		//Background video
		$('.bg-video-play').on("click", function () {
			var elem = $(this),
				video = $(this).parents('.thim-widget-icon-box, .elementor-widget-thim-icon-box').find('.full-screen-video'),
				player = video.get(0);
			elem.parents('.wrapper-box-icon').css('background-image', 'none');
			if (player.paused) {
				player.play();
				elem.addClass('bg-pause');
			} else {
				player.pause();
				elem.removeClass('bg-pause');
			}
		});

		//Background video
		$('.mute-audio').on("click", function () {
			var elem = $(this),
				video = $(this).parents('.thim-widget-icon-box, .elementor-widget-thim-icon-box').find('.full-screen-video'),
				player = video.get(0);
			if (player.muted) {
				player.muted = false;
				elem.removeClass('muted');
			} else {
				player.muted = true;
				elem.addClass('muted');
			}
		});


		if (jQuery().waypoint) {
			$('.wrapper-box-icon.background-video').waypoint(function () {
				var player = $(this).parent().find('.full-screen-video').get(0),
					autoPlay = $(this).parent().find('.full-screen-video').data('autoplay'),
					button = $(this).find('.bg-video-play');
				if (autoPlay) {
					button.trigger('click');
				}
			}, {
				triggerOnce: true,
				offset     : 'bottom-in-view'
			});
		}
	});

})(jQuery);

(function ($) {
	$(document).ready(function () {
		thim_sailing.init();

		function enableIsotope() {
			// for each filters
			$('.filter-controls').each(function (i, buttonGroup) {
				var $buttonGroup = $(buttonGroup);

				// init isotope
				$(window).load(function () {
					if ($('.thim-widget-gallery .wrapper-gallery-filter').length > 0) {
						$('.thim-widget-gallery .wrapper-gallery-filter').isotope({filter: '*'});
					}
					if ($('.elementor-widget-thim-gallery .wrapper-gallery-filter').length > 0) {
						$('.elementor-widget-thim-gallery .wrapper-gallery-filter').isotope({filter: '*'});
					}
				});

				// button click
				$buttonGroup.on('click', '.filter', function () {
					var $this = $(this);
					// change selected
					$buttonGroup.find('.active').removeClass('active');
					$this.addClass('active');
					// filter isotope
					var filterValue = $this.attr('data-filter');
					filter_wraper = $(this).parents('.thim-widget-gallery').find('.wrapper-gallery-filter');
					filter_wraper_el = $(this).parents('.elementor-widget-thim-gallery').find('.wrapper-gallery-filter');
					filter_wraper.isotope({filter: filterValue});
					filter_wraper_el.isotope({filter: filterValue});
				});
			});

		};

		enableIsotope();

		//Filter Gallery
		if($(".thim-widget-gallery .fancybox").length){
			$(".thim-widget-gallery .fancybox").fancybox({
				'margin'   : 50,
				'scrolling': 'yes',
				beforeShow : function () {
					var imgAlt = $(this.element).find("img").attr("alt");
					var dataAlt = $(this.element).data("alt");
					if (imgAlt) {
						$(".fancybox-image").attr("alt", imgAlt);
					} else if (dataAlt) {
						$(".fancybox-image").attr("alt", dataAlt);
					}
				}
			});
		}
		
		//Filter Gallery
		if($(".elementor-widget-thim-gallery .fancybox").length){
			$(".elementor-widget-thim-gallery .fancybox").fancybox({
				'margin'   : 50,
				'scrolling': 'yes',
				beforeShow : function () {
					var imgAlt = $(this.element).find("img").attr("alt");
					var dataAlt = $(this.element).data("alt");
					if (imgAlt) {
						$(".fancybox-image").attr("alt", imgAlt);
					} else if (dataAlt) {
						$(".fancybox-image").attr("alt", dataAlt);
					}
				}
			});
		}	
	});

	//select2
	$(document).ready(function () {
		$('.guests-number select').select2();
		$('.nav-guest .goUp').on('click', function () {
			var index = $('select[name="adults_capacity"] option:selected').index();
			var count = $(' select[name="adults_capacity"] option').length;

			if (index + 1 >= count) {
				return;
			}

			var selected = $($('select[name="adults_capacity"] option')[index + 1]).val();

			$('select[name="adults_capacity"]').val(selected);
			$('input.adults-input').val(selected);

			$('select[name="adults_capacity"]').trigger('change.select2'); // Notify only Select2 of changes

		});

		$('.nav-guest .goDown').on('click', function () {
			var index = $('select[name="adults_capacity"] option:selected').index();
			if (index <= 0) {
				return;
			}
			var selected = $($('select[name="adults_capacity"] option')[index - 1]).val();
			$('select[name="adults_capacity"]').val(selected);
			$('input.adults-input').val(selected);
			
			$('select[name="adults_capacity"]').trigger('change.select2'); // Notify only Select2 of changes

		});
		$('.rooms-layout-2 #hb-form-search-page #adults').remove();
		$('#adults').each(function () {
			var $form_list = $('.hb-form-field-list.nav-guest');
			$('#adults').on('click touch', function () {
				$form_list.toggleClass('active');
			});
			$(document).on('click touch', function (event) {
				if (!$(event.target).parents().addBack().is('#adults')) {
					$form_list.removeClass('active');
				}
			});
			$form_list.on('click touch', function (event) {
				event.stopPropagation();
			});
		});
	});

	$(document).ready(function () {
		$('.child-number select').select2();
		$('.nav-child .goUp').on('click', function () {
			var index = $('select[name="max_child"] option:selected').index();
			var count = $(' select[name="max_child"] option').length;

			if (index + 1 >= count) {
				return;
			}

			var selected = $($('select[name="max_child"] option')[index + 1]).val();

			$('select[name="max_child"]').val(selected);
			$('input.child-input').val(selected);

			$('select[name="max_child"]').trigger('change.select2'); // Notify only Select2 of changes

		});

		$('.nav-child .goDown').on('click', function () {
			var index = $('select[name="max_child"] option:selected').index();
			if (index <= 0) {
				return;
			}
			var selected = $($('select[name="max_child"] option')[index - 1]).val();
			$('select[name="max_child"]').val(selected);
			$('input.child-input').val(selected);

			$('select[name="max_child"]').trigger('change.select2'); // Notify only Select2 of changes

		});
		$('.rooms-layout-2 #hb-form-search-page #child').remove();
		$('#child').each(function () {
			var $form_list = $('.hb-form-field-list.nav-child');
			$('#child').on('click touch', function () {
				$form_list.toggleClass('active');
			});
			$(document).on('click touch', function (event) {
				if (!$(event.target).parents().addBack().is('#child')) {
					$form_list.removeClass('active');
				}
			});
			$form_list.on('click touch', function (event) {
				event.stopPropagation();
			});
		});
	});

	var thim_sailing = {

		init: function () {
			this.contactform7();
			if (typeof (hotel_settings) === 'undefined') {
			} else {
				this.custom_datepicker();
			}
			this.click_input_error();
			this.sticky_sidebar();
			this.slick_slider();
			this.switch_layout();
		},
		slick_slider: function(){
			var attr = $('html').attr('dir');
			if (typeof attr !== typeof undefined && attr !== false) {
				var righttoleft = true;
			} else {
				righttoleft = false;
			}
			$(window).resize(function(){
				var width_container = $('.container').width(),
					width_screen = $(window).width(),
					padding = ((width_screen - width_container) /2 );
					
				if(padding < 150){	
					padding1 = padding/2;	
				}else{
					padding1 = padding -75;
					
				}
				if($(window).width() > 1366){
					if($('.slick-dots','.element-main-slider').length){
						$('.slick-dots','.element-main-slider').css('left',padding1);
						$('.slick-dots','.element-main-slider').css('right','unset');
					}
				}else{
					padding1 = ((width_screen - width_container) /2 );
					if($('.slick-dots','.element-main-slider').length){
						$('.slick-dots','.element-main-slider').css('right',padding1);
						$('.slick-dots','.element-main-slider').css('left','unset');
					}
				}
				$('.info-sale-swapper.base').css('padding-left',padding);
				$('.thim-slider-posts.slider-2 .slider-post').css('padding-left',padding);	
					
			});
			$('.element-main-slider').each(function(){
				if($('.element-main-slider .wrap-element').length){
					let enable_autoplay = $('.element-main-slider .wrap-element').data('autoplay'),
						speed = $('.element-main-slider .wrap-element').data('speed'),
						auto_play = false;
					if(enable_autoplay == 1){
						auto_play = true;
					}else{
						auto_play = false;
					}	
					$('.element-main-slider .wrap-element').slick({
						dots: true,
						infinite: true,
						autoplay: auto_play,
						autoplaySpeed: speed,
						speed: 1000,  
						fade: true,
						arrows: false,
						rtl: righttoleft,
					});
				}
			});

			$('.info-sale-swapper').each(function(){
				if($('.info-sale-swapper.base').length){
					$('.info-sale-swapper.base').slick({
						nfinite: true,
						slidesToShow: 2,
						slidesToScroll: 1, 
						centerMode: true,
						centerPadding: '22%',
						dots: false,
						arrows: true,
						nextArrow:'<button type="button" class="arow-slick slick-next"><i class="las la-angle-left"></i></button>',
						rtl: righttoleft,
						responsive: [
							{
								breakpoint: 1366,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 1,
									centerPadding: '12%',
								}
							},
							{
								breakpoint: 1199,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 1,
									centerPadding: '6%',
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '30%',
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '20%',
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '0',
								}
							}
						]
					});
				}
				if($('.info-sale-swapper.style-1 .info-sale').length){
					$('.info-sale-swapper.style-1 .info-sale').slick({
						nfinite: true,
						slidesToShow: 1,
						slidesToScroll: 1, 
						dots: true,
						arrows: true,
						nextArrow:'<button type="button" class="arow-slick slick-next"><i class="las la-arrow-right"></i></i></button>',
						rtl: righttoleft,
						
					});
				}
			});

			$('.thim-slider-posts.slider-1').each(function(){
				
				if($('.slider-post','.thim-slider-posts.slider-1').length){
					
					$('.thim-slider-image').slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						rtl: righttoleft,
						arrows: false,
						fade:true,
						asNavFor: '.thim-slider-info',
					});
					$('.thim-slider-info').slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						rtl: righttoleft,
						arrows: false,
						dots:true,
						asNavFor: '.thim-slider-image',
					});
				}
			});

			$('.thim-slider-posts.slider-2').each(function(){
				
				if($('.slider-post','.thim-slider-posts.slider-2').length){
					
					$('.slider-post').slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						rtl: righttoleft,
						arrows: false,
						centerMode: true,
						centerPadding: '28.5%',
						dots: true,
						arrows: true,
						nextArrow:'<button type="button" class="arow-slick slick-next"><i class="las la-arrow-left"></i></i></button>',
						responsive: [
							{
								breakpoint: 767,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '15%',
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '0',
								}
							},
							
						]
					});
				}
			});

			$('.thim-list-video').each(function(){
				if($('.list-video','.thim-list-video').length){
					$('.list-video','.thim-list-video').not('.slick-initialized').slick({
						nfinite: true,
						slidesToShow: 1,
						slidesToScroll: 1, 
						dots: true,
						arrows: true,
						nextArrow:'<button type="button" class="arow-slick slick-next"><i class="las la-angle-right"></i></button>',
						rtl: righttoleft,
					});
				}
			});

			$('.testimonials-style-2').each(function(){
				if($('.testimonials-style-2').length){
					$('.sc-testimonials-img').slick({
						slidesToShow: 5,
						slidesToScroll: 1,
						rtl: righttoleft,
						arrows: false,
						centerPadding: '0px',
						centerMode: true,
						asNavFor: '.sc-testimonials-content',
						responsive: [
							{
								breakpoint: 1366,
								settings: {
									slidesToShow: 5,
									slidesToScroll: 1,
								
								}
							},
							{
								breakpoint: 1199,
								settings: {
									slidesToShow: 5,
									slidesToScroll: 1,
									
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: 3,
									slidesToScroll: 1,
									
								}
							},
							
						]
					});
					$('.sc-testimonials-content').slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						rtl: righttoleft,
						arrows: false,
						dots:true,
						asNavFor: '.sc-testimonials-img',
					});
				}
			});

			$('.hb_room_carousel_container.room-slider-4').each(function(){
				let t = $(this),
					number_show = t.data('number-show'),
					pagination = t.data('pagination'),
					thimpress_hotel_booking_carousel = $('.hb_room_carousel .rooms',t);
				if(thimpress_hotel_booking_carousel.length)	{
					thimpress_hotel_booking_carousel.slick({
						infinite: true,
						slidesToShow: number_show,
						focusOnSelect: true,
						rtl: righttoleft,
						loop         :true,
						centerMode: true,
						centerPadding: '19%',
						dots: pagination,
						arrows: true,
						appendArrows: $('.hb_room_carousel_container.room-slider-4').find('.navigation'),
						prevArrow: $('.hb_room_carousel_container.room-slider-4').find('.prev'),
						nextArrow: $('.hb_room_carousel_container.room-slider-4').find('.next'),
						responsive: [
							{
								breakpoint: 1700,
								settings: {
									slidesToShow: number_show,
									slidesToScroll: 1,
									centerPadding: '15%',
								}
							},
							{
								breakpoint: 1500,
								settings: {
									slidesToShow: number_show,
									slidesToScroll: 1,
									centerPadding: '9%',
								}
							},
							{
								breakpoint: 1366,
								settings: {
									slidesToShow: number_show,
									slidesToScroll: 1,
									centerPadding: '4.5%',
								}
							},
							{
								breakpoint: 1199,
								settings: {
									slidesToShow: number_show,
									slidesToScroll: 1,
									centerPadding: '30px',
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 1,
									centerPadding: '15px',
								}
							},
							{
								breakpoint: 650,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerPadding: '15px',
								}
							},
						]
					});
				}
				
			})
		},


		click_input_error: function () {
			$('input, .dk-select, .ui-datepicker-trigger').on('click', function () {
				var $parent = $(this).parent();
				if ($(this).hasClass('error') || $parent.find('input').hasClass('error')) {
					$(this).removeClass('error');
					$parent.find('input').removeClass('error');
				}
				;
				if ($parent.hasClass('error')) {
					$parent.removeClass('error');
				}
				;
				if ($parent.hasClass('hotel_booking_invalid_quantity') || $(this).hasClass('hotel_booking_invalid_quantity')) {
					$(this).removeClass('hotel_booking_invalid_quantity');
					$parent.removeClass('hotel_booking_invalid_quantity');
				}
				;
			});
		},

		contactform7: function () {
			$(".wpcf7-submit").on('click', function () {
				$(this).css("opacity", 0.2);
				$(this).parents('.wpcf7-form').addClass('processing');
				$('input:not([type=submit]), textarea').attr('style', '');
			});

			$(document).on('spam.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('invalid.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('mailsent.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('mailfailed.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$('body').on('click', 'input:not([type=submit]).wpcf7-not-valid, textarea.wpcf7-not-valid', function () {
				$(this).removeClass('wpcf7-not-valid');
			});
		},

		custom_datepicker: function () {
			var $dateinput = $(".hasDatepicker");
			if ($dateinput.length != 0) {
				var options = $dateinput.datepicker("option");
				$(options).each(function (index, option) {
					$(option).datepicker("option", {
						showOn    : 'button',
						buttonText: ''
					});
					$(option).datepicker('refresh');
				});
			}
			;
		},

		sticky_sidebar: function () {
			var offsetTop = 20;

			if ($(window).width() <= 768) {
				return false;
			}

			if ($("#wpadminbar").length) {
				offsetTop += $("#wpadminbar").outerHeight();
			}

			if ($('.sticky-sidebar').height() > $('#main').height()) {
				return false;
			}

			if ($('#masthead.sticky-header')) {
				offsetTop += $('#masthead.sticky-header').outerHeight();
			}
			if($(".sticky-sidebar").length){
				$(".sticky-sidebar").theiaStickySidebar({
					"containerSelector"     : "",
					"additionalMarginTop"   : offsetTop,
					"additionalMarginBottom": "0",
					"updateSidebarHeight"   : false,
					"minWidth"              : "768",
					"sidebarBehavior"       : "modern"
				});
			}
		},
		/**
		 * Blog, Product Grid, List switch
		 */
		switch_layout: function () {
			$('.thim-switch-layout').each(function () {
				var cookie_name = $(this).data('cookie'),
					archive = $(this).data('active'),
					class_list = cookie_name + '-list',
					class_grid = cookie_name + '-grid';
					$(archive).addClass(class_grid);
				if ( jQuery.cookie(cookie_name)  ) {
					if( jQuery.cookie(cookie_name) == class_list && $(archive).hasClass(class_grid)){
						$(archive).removeClass(class_grid).addClass(class_list);
						$('.thim-switch-layout > div').removeClass('switch-active');
						$('.thim-switch-layout > .switchToList').addClass('switch-active');
 					}else if ($(archive).hasClass(class_list)) {
						$(archive).removeClass(class_list).addClass(class_grid);
						$('.thim-switch-layout > div').removeClass('switch-active');
						$('.thim-switch-layout > .switchToGrid').addClass('switch-active');
					}
 				}
				$(this).on('click', '> div', function (e) {
					var elem = $(this);
 					e.preventDefault();
 					if (!elem.hasClass('switch-active')) {
						if (elem.hasClass('switchToGrid')) {
							$('.thim-switch-layout > div').removeClass('switch-active');
							elem.addClass('switch-active');
							$(archive).fadeOut(300, function () {
								$(archive).removeClass(class_list).addClass(class_grid).fadeIn(300);
								jQuery.cookie(cookie_name, class_grid, {expires: 3, path: '/'});
							});
						} else {
							$('.thim-switch-layout > div').removeClass('switch-active');
							elem.addClass('switch-active');
							$(archive).fadeOut(300, function () {
								$(archive).removeClass(class_grid).addClass(class_list).fadeIn(300);
								jQuery.cookie(cookie_name, class_list, {expires: 3, path: '/'});
							});
						}
					}
				});
			})
  		},
	};

	$(window).load(function () {
		var $search_button = $('.search-button'),
			$header = $('#masthead.sticky-header'),
			windoH = $(window).height();
		$('.thim-search-wrapper').find('.thim-search-form').css('height', windoH);
		$search_button.on('click', function (event) {
			$(this).parents('.thim-search-wrapper').find('.thim-search-form').addClass('open');
			$(document).on('keydown', function (e) {
				// ESCAPE key pressed
				if (e.keyCode == 27) {
					$(this).find('.thim-search-form').removeClass('open');
				}
			});
		});
		$(document).on('click', '.close-form', function (e) {
			e.stopPropagation();
			$(this).parents('.thim-search-form').removeClass('open');
		});
		$(window).scroll(function () {
			var window2 = windoH;
			if ($header.hasClass('menu-hidden')) {
				window2 = windoH + $header.height() + 40;
				$('.thim-search-wrapper').find('.thim-search-form').css('height', window2);
			}
		});

		$('.list-tab-event li:first-child').addClass('active');
		$('.tab-content').hide();
		$('.tab-content:first').show();

		// Click function
		$('.list-tab-event li').click(function(){
		$('.list-tab-event li').removeClass('active');
		$(this).addClass('active');
		$('.tab-content').hide();
		
		var activeTab = $(this).find('a').attr('href');
		$(activeTab).fadeIn();
		return false;
		});
	});

	$(window).load(function () {
		var $thim_sc_video_box = $('.thim-sc-video-box, .thim-list-video');

		$thim_sc_video_box.each(function () {
			
			if ($.magnificPopup) {
				$('.video-popup').magnificPopup({
					type        : 'iframe',
					removalDelay: 500,
					mainClass   : 'mfp-fade'
				});
			}
		});

	});

	if (typeof (hotel_settings) === 'undefined') {
	} else {
		$(window).load(function () {
			var today = new Date();
			var tomorrow = new Date();

			if (typeof (hotel_settings) == "undefined") {
				var start_plus = 1;
			} else {
				var start_plus = hotel_settings.min_booking_date;
			}

			start_plus = parseInt(start_plus);
			tomorrow.setDate(today.getDate() + start_plus);

			$('input[id^="check_in_date"]').datepicker("option", {
				showOn    : 'button',
				buttonText: '',
				altField  : $('input[id^="check_in_date"]').parent().find('.day'),
				altFormat : "dd",
				onSelect  : function () {
					var unique = $(this).attr('id');
					unique = unique.replace('check_in_date_', '');
					var date = $(this).datepicker('getDate');

					var month = hotel_booking_i18n.monthNamesShort[date.getMonth()];
					$('input[id^="check_in_date"]').parent().find('.month').val(month);

					var checkout = $('#check_out_date_' + unique);
					$('.hb-form-check-in #day').val(date.getDate());
					$('.hb-form-check-in #month').val(month);

					date.setDate(date.getDate() + start_plus);

					checkout.datepicker('option', 'minDate', date);
				},
				onClose   : function () {
					var unique = $(this).attr('id');
					unique = unique.replace('check_in_date_', '');
					var checkout = $('#check_out_date_' + unique);
					checkout.datepicker("show");
				},
			});

			$('input[id^="check_in_date"]').datepicker('refresh');

			$('input[id^="check_out_date"]').datepicker("option", {
				showOn    : 'button',
				buttonText: '',
				altField  : $('input[id^="check_out_date"]').parent().find('.day'),
				altFormat : "dd",
				onSelect  : function () {
					var unique = $(this).attr('id');
					unique = unique.replace('check_out_date_', '');
					var date = $(this).datepicker('getDate');

					var month = hotel_booking_i18n.monthNamesShort[date.getMonth()];
					$('input[id^="check_out_date"]').parent().find('.month').val(month);

					$('.hb-form-check-out #day2').val(date.getDate());
					$('.hb-form-check-out #month2').val(month);
				}
			});

			$('input[id^="check_out_date"]').datepicker('refresh');
		});
		$(window).load(function () {

			var today = new Date();
			var tomorrow = new Date();

			if (typeof (hotel_settings) == "undefined") {
				var start_plus = 1;
			} else {
				var start_plus = hotel_settings.min_booking_date;
			}

			start_plus = parseInt(start_plus);
			tomorrow.setDate(today.getDate() + start_plus);

			$('input.date-in-bookroom').datepicker({
				minDate       : today,
				maxDate       : '+365D',
				numberOfMonths: 1,
				showOn        : 'button',
				buttonText    : '',
				onSelect      : function () {
					var date = $(this).datepicker('getDate');
					if (date) {
						date.setDate(date.getDate() + start_plus);
					}
					var checkout = $('input.date-out-bookroom');
					checkout.datepicker('option', 'minDate', date);
				},
				onClose       : function () {
					var checkout = $('input.date-out-bookroom');
					checkout.datepicker("show");
				},
			});

			$('input.date-out-bookroom').datepicker({
				minDate       : tomorrow,
				maxDate       : '+365D',
				numberOfMonths: 1,
				showOn        : 'button',
				buttonText    : '',
				onSelect      : function () {
					var check_in = $('input.date-in-bookroom'),
					selected = $(this).datepicker('getDate');
					selected.setDate(selected.getDate() - start_plus);
					check_in.datepicker('option', 'maxDate', selected);
				}
			});
		});
	}

})(jQuery);

//form popup room new
(function ($) {
	"use strict";

	var thim_Contact_Course_Popup = function () {
		if ($('#contact-form-registration >.wpcf7').length) {
			var el = $('#contact-form-registration >.wpcf7'),
				el_H = el.outerHeight(),
				win_H = $(window).height();
			if (win_H > el_H) {
				el.css('top', (win_H - el_H) / 2);
			}
			el.append('<a href="#" class="thim-close fa fa-times"></a>');
		}

		$(document).on('click', '.thim-button-register-room .thim-enroll-room-button', function (e) {
			e.preventDefault();
			$('body').addClass('thim-contact-popup-active');
			$('#contact-form-registration').addClass('active');
		});

		$(document).on('click', '#contact-form-registration', function (e) {
			if ($(e.target).attr('id') == 'contact-form-registration') {
				$('body').removeClass('thim-contact-popup-active');
				$('#contact-form-registration').removeClass('active');
			}
		});

		$(document).on('click', '#contact-form-registration .thim-close', function (e) {
			e.preventDefault();
			$('body').removeClass('thim-contact-popup-active');
			$('#contact-form-registration').removeClass('active');
		});
	}

	$(window).load(function () {
		thim_Contact_Course_Popup();

		$(document).on('click', '#contact-form-registration .wpcf7-form-control.wpcf7-submit', function () {
			$(document).on('mailsent.wpcf7', function (event) {
				setTimeout(function () {
					$('body').removeClass('thim-contact-popup-active');
					$('#contact-form-registration').removeClass('active');
				}, 3000);
			});
		});
	});
	$(document).ready(function () {
		$('.thim_tours_slider').each(function(){
			var t = $(this);
			var thimpress_tour_carousel = $('.thim_tours_slider ul');
			if(thimpress_tour_carousel.length){
				thimpress_tour_carousel.owlCarousel({
					nav               : false,
					dots              : false,
					loop              : true,
					items             : t.data('number_show'),
					dotsSpeed         : 600,
					smartSpeed        : 600,
					autoplay          : true,
					autoplayHoverPause: true,
					margin            : 30,
					responsive        : {
						// breakpoint from 0 up
						0   : {
							items: 1
						},
						// breakpoint from 480 up
						480 : {
							items: 1
						},
						// breakpoint from 768 up
						768 : {
							items: 2
						},
						// breakpoint from 1024 up
						1024: {
							items: t.data('number_show')
						}
					}
				});
				// next
				$('.thim_tours_slider .navigation .next').on('click',function () {
					thimpress_tour_carousel.trigger('next.owl.carousel');
				});
				// prev
				$('.thim_tours_slider .navigation .prev').on('click',function () {
					thimpress_tour_carousel.trigger('prev.owl.carousel');
				});
			}
		});
		
		$('.hb_room_carousel_container.room-slider-base').each(function(){
			let t = $(this),
				number_show = t.data('number-show'),
				pagination = t.data('pagination'),
				thimpress_hotel_booking_carousel = $('.hb_room_carousel .rooms',t);
			if(thimpress_hotel_booking_carousel.length)	{
				thimpress_hotel_booking_carousel.owlCarousel({
					nav               : false,
					dots              : pagination,
					items             : number_show,
					dotsSpeed         : 600,
					smartSpeed        : 600,
					autoplay          : false,
					autoplayHoverPause: true,
					loop              : false,
					responsive        : {
						// breakpoint from 0 up
						0   : {
							items: 1
						},
						// breakpoint from 480 up
						480 : {
							items: 1
						},
						// breakpoint from 768 up
						576 : {
							items: 2
						},
						// breakpoint from 1024 up
						1024: {
							items: number_show
						}
					}
				});
				// next
				$('.navigation .next',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('next.owl.carousel');
				});
				// prev
				$('.navigation .prev',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('prev.owl.carousel');
				});
			}
			
		})
		$('.hb_room_carousel_container.style_new').each(function(){
			let t = $(this),
				thimpress_hotel_booking_carousel = $('.hb_room_carousel .rooms',t);
			if(thimpress_hotel_booking_carousel.length){
				thimpress_hotel_booking_carousel.owlCarousel({
					nav               : false,
					dots              : false,
					items             : 1,
					dotsSpeed         : 600,
					smartSpeed        : 600,
					autoplay          : true,
					loop              : true,
					autoplayHoverPause: true
				});
				// next
				$('.navigation .next',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('next.owl.carousel');
				});
				// prev
				$('.navigation .prev',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('prev.owl.carousel');
				});
			}		
		})

		$('.hb_room_carousel_container.hb_old_layout').each(function(){
			let t = $(this),
				number_show = t.data('number-show'),
				pagination = t.data('pagination'),
				thimpress_hotel_booking_carousel = $('.hb_room_carousel .rooms',t);
			if(thimpress_hotel_booking_carousel.length)	{
				thimpress_hotel_booking_carousel.owlCarousel({
					nav               : false,
					dots              : pagination,
					items             : number_show,
					dotsSpeed         : 600,
					smartSpeed        : 600,
					autoplay          : false,
					autoplayHoverPause: true,
					loop              : true,
					responsive        : {
						// breakpoint from 0 up
						0   : {
							items: 1
						},
						// breakpoint from 480 up
						480 : {
							items: 1
						},
						// breakpoint from 576 up
						576 : {
							items: 2
						},
						// breakpoint from 768 up
						768 : {
							items: 2
						},
						// breakpoint from 1024 up
						1024: {
							items: number_show
						}
					}
				});
				// next
				$('.navigation .next',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('next.owl.carousel');
				});
				// prev
				$('.navigation .prev',t).on('click',function () {
					thimpress_hotel_booking_carousel.trigger('prev.owl.carousel');
				});
			}
			
		})

		$('.hb_related_other_room').each(function(){
			let t = $(this),
				thimpress_hotel_booking_carousel_related = $('ul.rooms',t);
			if(thimpress_hotel_booking_carousel_related.length){
				thimpress_hotel_booking_carousel_related.owlCarousel({
					nav               : false,
					dots              : false,
					loop              : true,
					items             : t.data('item'),
					dotsSpeed         : 600,
					smartSpeed        : 600,
					autoplay          : true,
					autoplayHoverPause: true,
					responsive        : {
						// breakpoint from 0 up
						0   : {
							items: 1
						},
						// breakpoint from 480 up
						480 : {
							items: 1
						},
						// breakpoint from 768 up
						768 : {
							items: 2
						},
						// breakpoint from 1024 up
						1024: {
							items: t.data('item')
						}
					}
				});
				// next
				$('.navigation .next',t).on('click',function () {
					thimpress_hotel_booking_carousel_related.trigger('next.owl.carousel');
				});
				// prev
				$('.navigation .prev',t).on('click',function () {
					thimpress_hotel_booking_carousel_related.trigger('prev.owl.carousel');
				});
			}
		});
	});
})(jQuery);

/**
 * @version: 2.1.25
 * @author: Dan Grossman http://www.dangrossman.info/
 * @copyright: Copyright (c) 2012-2017 Dan Grossman. All rights reserved.
 * @license: Licensed under the MIT license. See http://www.opensource.org/licenses/mit-license.php
 * @website: https://www.daterangepicker.com/
 */
// Follow the UMD template https://github.com/umdjs/umd/blob/master/templates/returnExportsGlobal.js
(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Make globaly available as well
		define(['moment', 'jquery'], function (moment, jquery) {
			return (root.daterangepicker = factory(moment, jquery));
		});
	} else if (typeof module === 'object' && module.exports) {
		// Node / Browserify
		//isomorphic issue
		var jQuery = (typeof window != 'undefined') ? window.jQuery : undefined;
		if (!jQuery) {
			jQuery = require('jquery');
			if (!jQuery.fn) jQuery.fn = {};
		}
		module.exports = factory(require('moment'), jQuery);
	} else {
		// Browser globals
		root.daterangepicker = factory(root.moment, root.jQuery);
	}
}(this, function(moment, $) {
	var DateRangePicker = function(element, options, cb) {

		//default settings for options
		this.parentEl = 'body';
		this.element = $(element);
		this.startDate = moment().startOf('day');
		this.endDate = moment().endOf('day');
		this.minDate = false;
		this.maxDate = false;
		this.dateLimit = false;
		this.autoApply = false;
		this.singleDatePicker = false;
		this.showDropdowns = false;
		this.showWeekNumbers = false;
		this.showISOWeekNumbers = false;
		this.showCustomRangeLabel = true;
		this.timePicker = false;
		this.timePicker24Hour = false;
		this.timePickerIncrement = 1;
		this.timePickerSeconds = false;
		this.linkedCalendars = true;
		this.autoUpdateInput = true;
		this.alwaysShowCalendars = false;
		this.ranges = {};

		this.opens = 'right';
		if (this.element.hasClass('pull-right'))
			this.opens = 'left';

		this.drops = 'down';
		if (this.element.hasClass('dropup'))
			this.drops = 'up';

		this.buttonClasses = 'btn btn-sm';
		this.applyClass = 'btn-success';
		this.cancelClass = 'btn-default';

		this.locale = {
			direction: 'ltr',
			format: moment.localeData().longDateFormat('L'),
			separator: ' - ',
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
			weekLabel: 'W',
			customRangeLabel: 'Custom Range',
			daysOfWeek: moment.weekdaysMin(),
			monthNames: moment.monthsShort(),
			firstDay: moment.localeData().firstDayOfWeek()
		};

		this.callback = function() { };

		//some state information
		this.isShowing = false;
		this.leftCalendar = {};
		this.rightCalendar = {};

		//custom options from user
		if (typeof options !== 'object' || options === null)
			options = {};

		//allow setting options with data attributes
		//data-api options will be overwritten with custom javascript options
		options = $.extend(this.element.data(), options);

		//html template for the picker UI
		if (typeof options.template !== 'string' && !(options.template instanceof $))
			options.template = '<div class="daterangepicker dropdown-menu">' +
				'<div class="label">Calendar' +
				'</div>' +
				'<div class="calendar left">' +
				'<div class="daterangepicker_input">' +
				'<input class="input-mini form-control" type="text" name="daterangepicker_start" value="" />' +
				'<i class="fa fa-calendar glyphicon glyphicon-calendar"></i>' +
				'<div class="calendar-time">' +
				'<div></div>' +
				'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>' +
				'</div>' +
				'</div>' +
				'<div class="calendar-table"></div>' +
				'</div>' +
				'<div class="calendar right">' +
				'<div class="daterangepicker_input">' +
				'<input class="input-mini form-control" type="text" name="daterangepicker_end" value="" />' +
				'<i class="fa fa-calendar glyphicon glyphicon-calendar"></i>' +
				'<div class="calendar-time">' +
				'<div></div>' +
				'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>' +
				'</div>' +
				'</div>' +
				'<div class="calendar-table"></div>' +
				'</div>' +
				'<div class="ranges">' +
				'<div class="range_inputs">' +
				'<button class="applyBtn" disabled="disabled" type="button"></button> ' +
				'<button class="cancelBtn" type="button"></button>' +
				'</div>' +
				'</div>' +
				'</div>';

		this.parentEl = (options.parentEl && $(options.parentEl).length) ? $(options.parentEl) : $(this.parentEl);
		this.container = $(options.template).appendTo(this.parentEl);

		//
		// handle all the possible options overriding defaults
		//

		if (typeof options.locale === 'object') {

			if (typeof options.locale.direction === 'string')
				this.locale.direction = options.locale.direction;

			if (typeof options.locale.format === 'string')
				this.locale.format = options.locale.format;

			if (typeof options.locale.separator === 'string')
				this.locale.separator = options.locale.separator;

			if (typeof options.locale.daysOfWeek === 'object')
				this.locale.daysOfWeek = options.locale.daysOfWeek.slice();

			if (typeof options.locale.monthNames === 'object')
				this.locale.monthNames = options.locale.monthNames.slice();

			if (typeof options.locale.firstDay === 'number')
				this.locale.firstDay = options.locale.firstDay;

			if (typeof options.locale.applyLabel === 'string')
				this.locale.applyLabel = options.locale.applyLabel;

			if (typeof options.locale.cancelLabel === 'string')
				this.locale.cancelLabel = options.locale.cancelLabel;

			if (typeof options.locale.weekLabel === 'string')
				this.locale.weekLabel = options.locale.weekLabel;

			if (typeof options.locale.customRangeLabel === 'string'){
				//Support unicode chars in the custom range name.
				var elem = document.createElement('textarea');
				elem.innerHTML = options.locale.customRangeLabel;
				var rangeHtml = elem.value;
				this.locale.customRangeLabel = rangeHtml;
			}
		}
		this.container.addClass(this.locale.direction);

		if (typeof options.startDate === 'string')
			this.startDate = moment(options.startDate, this.locale.format);

		if (typeof options.endDate === 'string')
			this.endDate = moment(options.endDate, this.locale.format);

		if (typeof options.minDate === 'string')
			this.minDate = moment(options.minDate, this.locale.format);

		if (typeof options.maxDate === 'string')
			this.maxDate = moment(options.maxDate, this.locale.format);

		if (typeof options.startDate === 'object')
			this.startDate = moment(options.startDate);

		if (typeof options.endDate === 'object')
			this.endDate = moment(options.endDate);

		if (typeof options.minDate === 'object')
			this.minDate = moment(options.minDate);

		if (typeof options.maxDate === 'object')
			this.maxDate = moment(options.maxDate);

		// sanity check for bad options
		if (this.minDate && this.startDate.isBefore(this.minDate))
			this.startDate = this.minDate.clone();

		// sanity check for bad options
		if (this.maxDate && this.endDate.isAfter(this.maxDate))
			this.endDate = this.maxDate.clone();

		if (typeof options.applyClass === 'string')
			this.applyClass = options.applyClass;

		if (typeof options.cancelClass === 'string')
			this.cancelClass = options.cancelClass;

		if (typeof options.dateLimit === 'object')
			this.dateLimit = options.dateLimit;

		if (typeof options.opens === 'string')
			this.opens = options.opens;

		if (typeof options.drops === 'string')
			this.drops = options.drops;

		if (typeof options.showWeekNumbers === 'boolean')
			this.showWeekNumbers = options.showWeekNumbers;

		if (typeof options.showISOWeekNumbers === 'boolean')
			this.showISOWeekNumbers = options.showISOWeekNumbers;

		if (typeof options.buttonClasses === 'string')
			this.buttonClasses = options.buttonClasses;

		if (typeof options.buttonClasses === 'object')
			this.buttonClasses = options.buttonClasses.join(' ');

		if (typeof options.showDropdowns === 'boolean')
			this.showDropdowns = options.showDropdowns;

		if (typeof options.showCustomRangeLabel === 'boolean')
			this.showCustomRangeLabel = options.showCustomRangeLabel;

		if (typeof options.singleDatePicker === 'boolean') {
			this.singleDatePicker = options.singleDatePicker;
			if (this.singleDatePicker)
				this.endDate = this.startDate.clone();
		}

		if (typeof options.timePicker === 'boolean')
			this.timePicker = options.timePicker;

		if (typeof options.timePickerSeconds === 'boolean')
			this.timePickerSeconds = options.timePickerSeconds;

		if (typeof options.timePickerIncrement === 'number')
			this.timePickerIncrement = options.timePickerIncrement;

		if (typeof options.timePicker24Hour === 'boolean')
			this.timePicker24Hour = options.timePicker24Hour;

		if (typeof options.autoApply === 'boolean')
			this.autoApply = options.autoApply;

		if (typeof options.autoUpdateInput === 'boolean')
			this.autoUpdateInput = options.autoUpdateInput;

		if (typeof options.linkedCalendars === 'boolean')
			this.linkedCalendars = options.linkedCalendars;

		if (typeof options.isInvalidDate === 'function')
			this.isInvalidDate = options.isInvalidDate;

		if (typeof options.isCustomDate === 'function')
			this.isCustomDate = options.isCustomDate;

		if (typeof options.alwaysShowCalendars === 'boolean')
			this.alwaysShowCalendars = options.alwaysShowCalendars;

		// update day names order to firstDay
		if (this.locale.firstDay != 0) {
			var iterator = this.locale.firstDay;
			while (iterator > 0) {
				this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift());
				iterator--;
			}
		}

		var start, end, range;

		//if no start/end dates set, check if an input element contains initial values
		if (typeof options.startDate === 'undefined' && typeof options.endDate === 'undefined') {
			if ($(this.element).is('input[type=text]')) {
				var val = $(this.element).val(),
					split = val.split(this.locale.separator);

				start = end = null;

				if (split.length == 2) {
					start = moment(split[0], this.locale.format);
					end = moment(split[1], this.locale.format);
				} else if (this.singleDatePicker && val !== "") {
					start = moment(val, this.locale.format);
					end = moment(val, this.locale.format);
				}
				if (start !== null && end !== null) {
					this.setStartDate(start);
					this.setEndDate(end);
				}
			}
		}

		if (typeof options.ranges === 'object') {
			for (range in options.ranges) {

				if (typeof options.ranges[range][0] === 'string')
					start = moment(options.ranges[range][0], this.locale.format);
				else
					start = moment(options.ranges[range][0]);

				if (typeof options.ranges[range][1] === 'string')
					end = moment(options.ranges[range][1], this.locale.format);
				else
					end = moment(options.ranges[range][1]);

				// If the start or end date exceed those allowed by the minDate or dateLimit
				// options, shorten the range to the allowable period.
				if (this.minDate && start.isBefore(this.minDate))
					start = this.minDate.clone();

				var maxDate = this.maxDate;
				if (this.dateLimit && maxDate && start.clone().add(this.dateLimit).isAfter(maxDate))
					maxDate = start.clone().add(this.dateLimit);
				if (maxDate && end.isAfter(maxDate))
					end = maxDate.clone();

				// If the end of the range is before the minimum or the start of the range is
				// after the maximum, don't display this range option at all.
				if ((this.minDate && end.isBefore(this.minDate, this.timepicker ? 'minute' : 'day'))
					|| (maxDate && start.isAfter(maxDate, this.timepicker ? 'minute' : 'day')))
					continue;

				//Support unicode chars in the range names.
				var elem = document.createElement('textarea');
				elem.innerHTML = range;
				var rangeHtml = elem.value;

				this.ranges[rangeHtml] = [start, end];
			}

			var list = '<ul>';
			for (range in this.ranges) {
				list += '<li data-range-key="' + range + '">' + range + '</li>';
			}
			if (this.showCustomRangeLabel) {
				list += '<li data-range-key="' + this.locale.customRangeLabel + '">' + this.locale.customRangeLabel + '</li>';
			}
			list += '</ul>';
			this.container.find('.ranges').prepend(list);
		}

		if (typeof cb === 'function') {
			this.callback = cb;
		}

		if (!this.timePicker) {
			this.startDate = this.startDate.startOf('day');
			this.endDate = this.endDate.endOf('day');
			this.container.find('.calendar-time').hide();
		}

		//can't be used together for now
		if (this.timePicker && this.autoApply)
			this.autoApply = false;

		if (this.autoApply && typeof options.ranges !== 'object') {
			this.container.find('.ranges').hide();
		} else if (this.autoApply) {
			this.container.find('.applyBtn, .cancelBtn').addClass('hide');
		}

		if (this.singleDatePicker) {
			this.container.addClass('single');
			this.container.find('.calendar.left').addClass('single');
			this.container.find('.calendar.left').show();
			this.container.find('.calendar.right').hide();
			this.container.find('.daterangepicker_input input, .daterangepicker_input > i').hide();
			if (this.timePicker) {
				this.container.find('.ranges ul').hide();
			} else {
				this.container.find('.ranges').hide();
			}
		}

		if ((typeof options.ranges === 'undefined' && !this.singleDatePicker) || this.alwaysShowCalendars) {
			this.container.addClass('show-calendar');
		}

		this.container.addClass('opens' + this.opens);

		//swap the position of the predefined ranges if opens right
		if (typeof options.ranges !== 'undefined' && this.opens == 'right') {
			this.container.find('.ranges').prependTo( this.container.find('.calendar.left').parent() );
		}

		//apply CSS classes and labels to buttons
		this.container.find('.applyBtn, .cancelBtn').addClass(this.buttonClasses);
		if (this.applyClass.length)
			this.container.find('.applyBtn').addClass(this.applyClass);
		if (this.cancelClass.length)
			this.container.find('.cancelBtn').addClass(this.cancelClass);
		this.container.find('.applyBtn').html(this.locale.applyLabel);
		this.container.find('.cancelBtn').html(this.locale.cancelLabel);

		//
		// event listeners
		//

		this.container.find('.calendar')
			.on('click.daterangepicker', '.prev', $.proxy(this.clickPrev, this))
			.on('click.daterangepicker', '.next', $.proxy(this.clickNext, this))
			.on('mousedown.daterangepicker', 'td.available', $.proxy(this.clickDate, this))
			.on('mouseenter.daterangepicker', 'td.available', $.proxy(this.hoverDate, this))
			.on('mouseleave.daterangepicker', 'td.available', $.proxy(this.updateFormInputs, this))
			.on('change.daterangepicker', 'select.yearselect', $.proxy(this.monthOrYearChanged, this))
			.on('change.daterangepicker', 'select.monthselect', $.proxy(this.monthOrYearChanged, this))
			.on('change.daterangepicker', 'select.hourselect,select.minuteselect,select.secondselect,select.ampmselect', $.proxy(this.timeChanged, this))
			.on('click.daterangepicker', '.daterangepicker_input input', $.proxy(this.showCalendars, this))
			.on('focus.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsFocused, this))
			.on('blur.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsBlurred, this))
			.on('change.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsChanged, this));

		this.container.find('.ranges')
			.on('click.daterangepicker', 'button.applyBtn', $.proxy(this.clickApply, this))
			.on('click.daterangepicker', 'button.cancelBtn', $.proxy(this.clickCancel, this))
			.on('click.daterangepicker', 'li', $.proxy(this.clickRange, this))
			.on('mouseenter.daterangepicker', 'li', $.proxy(this.hoverRange, this))
			.on('mouseleave.daterangepicker', 'li', $.proxy(this.updateFormInputs, this));

		if (this.element.is('input') || this.element.is('button')) {
			this.element.on({
				'click.daterangepicker': $.proxy(this.show, this),
				'focus.daterangepicker': $.proxy(this.show, this),
				'keyup.daterangepicker': $.proxy(this.elementChanged, this),
				'keydown.daterangepicker': $.proxy(this.keydown, this)
			});
		} else {
			this.element.on('click.daterangepicker', $.proxy(this.toggle, this));
		}

		//
		// if attached to a text input, set the initial value
		//

		if (this.element.is('input') && !this.singleDatePicker && this.autoUpdateInput) {
			this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
			this.element.trigger('change');
		} else if (this.element.is('input') && this.autoUpdateInput) {
			this.element.val(this.startDate.format(this.locale.format));
			this.element.trigger('change');
		}

	};

	DateRangePicker.prototype = {

		constructor: DateRangePicker,

		setStartDate: function(startDate) {
			if (typeof startDate === 'string')
				this.startDate = moment(startDate, this.locale.format);

			if (typeof startDate === 'object')
				this.startDate = moment(startDate);

			if (!this.timePicker)
				this.startDate = this.startDate.startOf('day');

			if (this.timePicker && this.timePickerIncrement)
				this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

			if (this.minDate && this.startDate.isBefore(this.minDate)) {
				this.startDate = this.minDate.clone();
				if (this.timePicker && this.timePickerIncrement)
					this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
			}

			if (this.maxDate && this.startDate.isAfter(this.maxDate)) {
				this.startDate = this.maxDate.clone();
				if (this.timePicker && this.timePickerIncrement)
					this.startDate.minute(Math.floor(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
			}

			if (!this.isShowing)
				this.updateElement();

			this.updateMonthsInView();
		},

		setEndDate: function(endDate) {
			if (typeof endDate === 'string')
				this.endDate = moment(endDate, this.locale.format);

			if (typeof endDate === 'object')
				this.endDate = moment(endDate);

			if (!this.timePicker)
				this.endDate = this.endDate.endOf('day');

			if (this.timePicker && this.timePickerIncrement)
				this.endDate.minute(Math.round(this.endDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

			if (this.endDate.isBefore(this.startDate))
				this.endDate = this.startDate.clone();

			if (this.maxDate && this.endDate.isAfter(this.maxDate))
				this.endDate = this.maxDate.clone();

			if (this.dateLimit && this.startDate.clone().add(this.dateLimit).isBefore(this.endDate))
				this.endDate = this.startDate.clone().add(this.dateLimit);

			this.previousRightTime = this.endDate.clone();

			if (!this.isShowing)
				this.updateElement();

			this.updateMonthsInView();
		},

		isInvalidDate: function() {
			return false;
		},

		isCustomDate: function() {
			return false;
		},

		updateView: function() {
			if (this.timePicker) {
				this.renderTimePicker('left');
				this.renderTimePicker('right');
				if (!this.endDate) {
					this.container.find('.right .calendar-time select').attr('disabled', 'disabled').addClass('disabled');
				} else {
					this.container.find('.right .calendar-time select').removeAttr('disabled').removeClass('disabled');
				}
			}
			if (this.endDate) {
				this.container.find('input[name="daterangepicker_end"]').removeClass('active');
				this.container.find('input[name="daterangepicker_start"]').addClass('active');
			} else {
				this.container.find('input[name="daterangepicker_end"]').addClass('active');
				this.container.find('input[name="daterangepicker_start"]').removeClass('active');
			}
			this.updateMonthsInView();
			this.updateCalendars();
			this.updateFormInputs();
		},

		updateMonthsInView: function() {
			if (this.endDate) {

				//if both dates are visible already, do nothing
				if (!this.singleDatePicker && this.leftCalendar.month && this.rightCalendar.month &&
					(this.startDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.startDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
					&&
					(this.endDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.endDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
				) {
					return;
				}

				this.leftCalendar.month = this.startDate.clone().date(2);
				if (!this.linkedCalendars && (this.endDate.month() != this.startDate.month() || this.endDate.year() != this.startDate.year())) {
					this.rightCalendar.month = this.endDate.clone().date(2);
				} else {
					this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
				}

			} else {
				if (this.leftCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM') && this.rightCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM')) {
					this.leftCalendar.month = this.startDate.clone().date(2);
					this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
				}
			}
			if (this.maxDate && this.linkedCalendars && !this.singleDatePicker && this.rightCalendar.month > this.maxDate) {
				this.rightCalendar.month = this.maxDate.clone().date(2);
				this.leftCalendar.month = this.maxDate.clone().date(2).subtract(1, 'month');
			}
		},

		updateCalendars: function() {

			if (this.timePicker) {
				var hour, minute, second;
				if (this.endDate) {
					hour = parseInt(this.container.find('.left .hourselect').val(), 10);
					minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
					second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
					if (!this.timePicker24Hour) {
						var ampm = this.container.find('.left .ampmselect').val();
						if (ampm === 'PM' && hour < 12)
							hour += 12;
						if (ampm === 'AM' && hour === 12)
							hour = 0;
					}
				} else {
					hour = parseInt(this.container.find('.right .hourselect').val(), 10);
					minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
					second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
					if (!this.timePicker24Hour) {
						var ampm = this.container.find('.right .ampmselect').val();
						if (ampm === 'PM' && hour < 12)
							hour += 12;
						if (ampm === 'AM' && hour === 12)
							hour = 0;
					}
				}
				this.leftCalendar.month.hour(hour).minute(minute).second(second);
				this.rightCalendar.month.hour(hour).minute(minute).second(second);
			}

			this.renderCalendar('left');
			this.renderCalendar('right');

			//highlight any predefined range matching the current start and end dates
			this.container.find('.ranges li').removeClass('active');
			if (this.endDate == null) return;

			this.calculateChosenLabel();
		},

		renderCalendar: function(side) {

			//
			// Build the matrix of dates that will populate the calendar
			//

			var calendar = side == 'left' ? this.leftCalendar : this.rightCalendar;
			var month = calendar.month.month();
			var year = calendar.month.year();
			var hour = calendar.month.hour();
			var minute = calendar.month.minute();
			var second = calendar.month.second();
			var daysInMonth = moment([year, month]).daysInMonth();
			var firstDay = moment([year, month, 1]);
			var lastDay = moment([year, month, daysInMonth]);
			var lastMonth = moment(firstDay).subtract(1, 'month').month();
			var lastYear = moment(firstDay).subtract(1, 'month').year();
			var daysInLastMonth = moment([lastYear, lastMonth]).daysInMonth();
			var dayOfWeek = firstDay.day();

			//initialize a 6 rows x 7 columns array for the calendar
			var calendar = [];
			calendar.firstDay = firstDay;
			calendar.lastDay = lastDay;

			for (var i = 0; i < 6; i++) {
				calendar[i] = [];
			}

			//populate the calendar with date objects
			var startDay = daysInLastMonth - dayOfWeek + this.locale.firstDay + 1;
			if (startDay > daysInLastMonth)
				startDay -= 7;

			if (dayOfWeek == this.locale.firstDay)
				startDay = daysInLastMonth - 6;

			var curDate = moment([lastYear, lastMonth, startDay, 12, minute, second]);

			var col, row;
			for (var i = 0, col = 0, row = 0; i < 42; i++, col++, curDate = moment(curDate).add(24, 'hour')) {
				if (i > 0 && col % 7 === 0) {
					col = 0;
					row++;
				}
				calendar[row][col] = curDate.clone().hour(hour).minute(minute).second(second);
				curDate.hour(12);

				if (this.minDate && calendar[row][col].format('YYYY-MM-DD') == this.minDate.format('YYYY-MM-DD') && calendar[row][col].isBefore(this.minDate) && side == 'left') {
					calendar[row][col] = this.minDate.clone();
				}

				if (this.maxDate && calendar[row][col].format('YYYY-MM-DD') == this.maxDate.format('YYYY-MM-DD') && calendar[row][col].isAfter(this.maxDate) && side == 'right') {
					calendar[row][col] = this.maxDate.clone();
				}

			}

			//make the calendar object available to hoverDate/clickDate
			if (side == 'left') {
				this.leftCalendar.calendar = calendar;
			} else {
				this.rightCalendar.calendar = calendar;
			}

			//
			// Display the calendar
			//

			var minDate = side == 'left' ? this.minDate : this.startDate;
			var maxDate = this.maxDate;
			var selected = side == 'left' ? this.startDate : this.endDate;
			var arrow = this.locale.direction == 'ltr' ? {left: 'chevron-left', right: 'chevron-right'} : {left: 'chevron-right', right: 'chevron-left'};

			var html = '<table class="table-condensed">';
			html += '<thead>';
			html += '<tr>';

			// add empty cell for week number
			if (this.showWeekNumbers || this.showISOWeekNumbers)
				html += '<th></th>';

			if ((!minDate || minDate.isBefore(calendar.firstDay)) && (!this.linkedCalendars || side == 'left')) {
				html += '<th class="prev available"><i class="fa fa-' + arrow.left + ' glyphicon glyphicon-' + arrow.left + '"></i></th>';
			} else {
				html += '<th></th>';
			}

			var dateHtml = this.locale.monthNames[calendar[1][1].month()] + calendar[1][1].format(" YYYY");

			if (this.showDropdowns) {
				var currentMonth = calendar[1][1].month();
				var currentYear = calendar[1][1].year();
				var maxYear = (maxDate && maxDate.year()) || (currentYear + 5);
				var minYear = (minDate && minDate.year()) || (currentYear - 50);
				var inMinYear = currentYear == minYear;
				var inMaxYear = currentYear == maxYear;

				var monthHtml = '<select class="monthselect">';
				for (var m = 0; m < 12; m++) {
					if ((!inMinYear || m >= minDate.month()) && (!inMaxYear || m <= maxDate.month())) {
						monthHtml += "<option value='" + m + "'" +
							(m === currentMonth ? " selected='selected'" : "") +
							">" + this.locale.monthNames[m] + "</option>";
					} else {
						monthHtml += "<option value='" + m + "'" +
							(m === currentMonth ? " selected='selected'" : "") +
							" disabled='disabled'>" + this.locale.monthNames[m] + "</option>";
					}
				}
				monthHtml += "</select>";

				var yearHtml = '<select class="yearselect">';
				for (var y = minYear; y <= maxYear; y++) {
					yearHtml += '<option value="' + y + '"' +
						(y === currentYear ? ' selected="selected"' : '') +
						'>' + y + '</option>';
				}
				yearHtml += '</select>';

				dateHtml = monthHtml + yearHtml;
			}

			html += '<th colspan="5" class="month">' + dateHtml + '</th>';
			if ((!maxDate || maxDate.isAfter(calendar.lastDay)) && (!this.linkedCalendars || side == 'right' || this.singleDatePicker)) {
				html += '<th class="next available"><i class="fa fa-' + arrow.right + ' glyphicon glyphicon-' + arrow.right + '"></i></th>';
			} else {
				html += '<th></th>';
			}

			html += '</tr>';
			html += '<tr>';

			// add week number label
			if (this.showWeekNumbers || this.showISOWeekNumbers)
				html += '<th class="week">' + this.locale.weekLabel + '</th>';

			$.each(this.locale.daysOfWeek, function(index, dayOfWeek) {
				html += '<th>' + dayOfWeek + '</th>';
			});

			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';

			//adjust maxDate to reflect the dateLimit setting in order to
			//grey out end dates beyond the dateLimit
			if (this.endDate == null && this.dateLimit) {
				var maxLimit = this.startDate.clone().add(this.dateLimit).endOf('day');
				if (!maxDate || maxLimit.isBefore(maxDate)) {
					maxDate = maxLimit;
				}
			}

			for (var row = 0; row < 6; row++) {
				html += '<tr>';

				// add week number
				if (this.showWeekNumbers)
					html += '<td class="week">' + calendar[row][0].week() + '</td>';
				else if (this.showISOWeekNumbers)
					html += '<td class="week">' + calendar[row][0].isoWeek() + '</td>';

				for (var col = 0; col < 7; col++) {

					var classes = [];

					//highlight today's date
					if (calendar[row][col].isSame(new Date(), "day"))
						classes.push('today');

					//highlight weekends
					if (calendar[row][col].isoWeekday() > 5)
						classes.push('weekend');

					//grey out the dates in other months displayed at beginning and end of this calendar
					if (calendar[row][col].month() != calendar[1][1].month())
						classes.push('off');

					//don't allow selection of dates before the minimum date
					if (this.minDate && calendar[row][col].isBefore(this.minDate, 'day'))
						classes.push('off', 'disabled');

					//don't allow selection of dates after the maximum date
					if (maxDate && calendar[row][col].isAfter(maxDate, 'day'))
						classes.push('off', 'disabled');

					//don't allow selection of date if a custom function decides it's invalid
					if (this.isInvalidDate(calendar[row][col]))
						classes.push('off', 'disabled');

					//highlight the currently selected start date
					if (calendar[row][col].format('YYYY-MM-DD') == this.startDate.format('YYYY-MM-DD'))
						classes.push('active', 'start-date');

					//highlight the currently selected end date
					if (this.endDate != null && calendar[row][col].format('YYYY-MM-DD') == this.endDate.format('YYYY-MM-DD'))
						classes.push('active', 'end-date');

					//highlight dates in-between the selected dates
					if (this.endDate != null && calendar[row][col] > this.startDate && calendar[row][col] < this.endDate)
						classes.push('in-range');

					//apply custom classes for this date
					var isCustom = this.isCustomDate(calendar[row][col]);
					if (isCustom !== false) {
						if (typeof isCustom === 'string')
							classes.push(isCustom);
						else
							Array.prototype.push.apply(classes, isCustom);
					}

					var cname = '', disabled = false;
					for (var i = 0; i < classes.length; i++) {
						cname += classes[i] + ' ';
						if (classes[i] == 'disabled')
							disabled = true;
					}
					if (!disabled)
						cname += 'available';

					html += '<td class="' + cname.replace(/^\s+|\s+$/g, '') + '" data-title="' + 'r' + row + 'c' + col + '">' + calendar[row][col].date() + '</td>';

				}
				html += '</tr>';
			}

			html += '</tbody>';
			html += '</table>';

			this.container.find('.calendar.' + side + ' .calendar-table').html(html);

		},

		renderTimePicker: function(side) {

			// Don't bother updating the time picker if it's currently disabled
			// because an end date hasn't been clicked yet
			if (side == 'right' && !this.endDate) return;

			var html, selected, minDate, maxDate = this.maxDate;

			if (this.dateLimit && (!this.maxDate || this.startDate.clone().add(this.dateLimit).isAfter(this.maxDate)))
				maxDate = this.startDate.clone().add(this.dateLimit);

			if (side == 'left') {
				selected = this.startDate.clone();
				minDate = this.minDate;
			} else if (side == 'right') {
				selected = this.endDate.clone();
				minDate = this.startDate;

				//Preserve the time already selected
				var timeSelector = this.container.find('.calendar.right .calendar-time div');
				if (timeSelector.html() != '') {

					selected.hour(timeSelector.find('.hourselect option:selected').val() || selected.hour());
					selected.minute(timeSelector.find('.minuteselect option:selected').val() || selected.minute());
					selected.second(timeSelector.find('.secondselect option:selected').val() || selected.second());

					if (!this.timePicker24Hour) {
						var ampm = timeSelector.find('.ampmselect option:selected').val();
						if (ampm === 'PM' && selected.hour() < 12)
							selected.hour(selected.hour() + 12);
						if (ampm === 'AM' && selected.hour() === 12)
							selected.hour(0);
					}

				}

				if (selected.isBefore(this.startDate))
					selected = this.startDate.clone();

				if (maxDate && selected.isAfter(maxDate))
					selected = maxDate.clone();

			}

			//
			// hours
			//

			html = '<select class="hourselect">';

			var start = this.timePicker24Hour ? 0 : 1;
			var end = this.timePicker24Hour ? 23 : 12;

			for (var i = start; i <= end; i++) {
				var i_in_24 = i;
				if (!this.timePicker24Hour)
					i_in_24 = selected.hour() >= 12 ? (i == 12 ? 12 : i + 12) : (i == 12 ? 0 : i);

				var time = selected.clone().hour(i_in_24);
				var disabled = false;
				if (minDate && time.minute(59).isBefore(minDate))
					disabled = true;
				if (maxDate && time.minute(0).isAfter(maxDate))
					disabled = true;

				if (i_in_24 == selected.hour() && !disabled) {
					html += '<option value="' + i + '" selected="selected">' + i + '</option>';
				} else if (disabled) {
					html += '<option value="' + i + '" disabled="disabled" class="disabled">' + i + '</option>';
				} else {
					html += '<option value="' + i + '">' + i + '</option>';
				}
			}

			html += '</select> ';

			//
			// minutes
			//

			html += ': <select class="minuteselect">';

			for (var i = 0; i < 60; i += this.timePickerIncrement) {
				var padded = i < 10 ? '0' + i : i;
				var time = selected.clone().minute(i);

				var disabled = false;
				if (minDate && time.second(59).isBefore(minDate))
					disabled = true;
				if (maxDate && time.second(0).isAfter(maxDate))
					disabled = true;

				if (selected.minute() == i && !disabled) {
					html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
				} else if (disabled) {
					html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
				} else {
					html += '<option value="' + i + '">' + padded + '</option>';
				}
			}

			html += '</select> ';

			//
			// seconds
			//

			if (this.timePickerSeconds) {
				html += ': <select class="secondselect">';

				for (var i = 0; i < 60; i++) {
					var padded = i < 10 ? '0' + i : i;
					var time = selected.clone().second(i);

					var disabled = false;
					if (minDate && time.isBefore(minDate))
						disabled = true;
					if (maxDate && time.isAfter(maxDate))
						disabled = true;

					if (selected.second() == i && !disabled) {
						html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
					} else if (disabled) {
						html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
					} else {
						html += '<option value="' + i + '">' + padded + '</option>';
					}
				}

				html += '</select> ';
			}

			//
			// AM/PM
			//

			if (!this.timePicker24Hour) {
				html += '<select class="ampmselect">';

				var am_html = '';
				var pm_html = '';

				if (minDate && selected.clone().hour(12).minute(0).second(0).isBefore(minDate))
					am_html = ' disabled="disabled" class="disabled"';

				if (maxDate && selected.clone().hour(0).minute(0).second(0).isAfter(maxDate))
					pm_html = ' disabled="disabled" class="disabled"';

				if (selected.hour() >= 12) {
					html += '<option value="AM"' + am_html + '>AM</option><option value="PM" selected="selected"' + pm_html + '>PM</option>';
				} else {
					html += '<option value="AM" selected="selected"' + am_html + '>AM</option><option value="PM"' + pm_html + '>PM</option>';
				}

				html += '</select>';
			}

			this.container.find('.calendar.' + side + ' .calendar-time div').html(html);

		},

		updateFormInputs: function() {

			//ignore mouse movements while an above-calendar text input has focus
			if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
				return;

			this.container.find('input[name=daterangepicker_start]').val(this.startDate.format(this.locale.format));
			if (this.endDate)
				this.container.find('input[name=daterangepicker_end]').val(this.endDate.format(this.locale.format));

			if (this.singleDatePicker || (this.endDate && (this.startDate.isBefore(this.endDate) || this.startDate.isSame(this.endDate)))) {
				this.container.find('button.applyBtn').removeAttr('disabled');
			} else {
				this.container.find('button.applyBtn').attr('disabled', 'disabled');
			}

		},

		move: function() {
			var parentOffset = { top: 0, left: 0 },
				containerTop;
			var parentRightEdge = $(window).width();
			if (!this.parentEl.is('body')) {
				parentOffset = {
					top: this.parentEl.offset().top - this.parentEl.scrollTop(),
					left: this.parentEl.offset().left - this.parentEl.scrollLeft()
				};
				parentRightEdge = this.parentEl[0].clientWidth + this.parentEl.offset().left;
			}

			if (this.drops == 'up')
				containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
			else
				containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
			this.container[this.drops == 'up' ? 'addClass' : 'removeClass']('dropup');

			if (this.opens == 'left') {
				this.container.css({
					top: containerTop,
					right: parentRightEdge - this.element.offset().left - this.element.outerWidth(),
					left: 'auto'
				});
				if (this.container.offset().left < 0) {
					this.container.css({
						right: 'auto',
						left: 9
					});
				}
			} else if (this.opens == 'center') {
				this.container.css({
					top: containerTop,
					left: this.element.offset().left - parentOffset.left + this.element.outerWidth() / 2
					- this.container.outerWidth() / 2,
					right: 'auto'
				});
				if (this.container.offset().left < 0) {
					this.container.css({
						right: 'auto',
						left: 9
					});
				}
			} else {
				this.container.css({
					top: containerTop,
					left: this.element.offset().left - parentOffset.left,
					right: 'auto'
				});
				if (this.container.offset().left + this.container.outerWidth() > $(window).width()) {
					this.container.css({
						left: 'auto',
						right: 0
					});
				}
			}
		},

		show: function(e) {
			if (this.isShowing) return;

			// Create a click proxy that is private to this instance of datepicker, for unbinding
			this._outsideClickProxy = $.proxy(function(e) { this.outsideClick(e); }, this);

			// Bind global datepicker mousedown for hiding and
			$(document)
				.on('mousedown.daterangepicker', this._outsideClickProxy)
				// also support mobile devices
				.on('touchend.daterangepicker', this._outsideClickProxy)
				// also explicitly play nice with Bootstrap dropdowns, which stopPropagation when clicking them
				.on('click.daterangepicker', '[data-toggle=dropdown]', this._outsideClickProxy)
				// and also close when focus changes to outside the picker (eg. tabbing between controls)
				.on('focusin.daterangepicker', this._outsideClickProxy);

			// Reposition the picker if the window is resized while it's open
			$(window).on('resize.daterangepicker', $.proxy(function(e) { this.move(e); }, this));

			this.oldStartDate = this.startDate.clone();
			this.oldEndDate = this.endDate.clone();
			this.previousRightTime = this.endDate.clone();

			this.updateView();
			this.container.show();
			this.move();
			this.element.trigger('show.daterangepicker', this);
			this.isShowing = true;
		},

		hide: function(e) {
			if (!this.isShowing) return;

			//incomplete date selection, revert to last values
			if (!this.endDate) {
				this.startDate = this.oldStartDate.clone();
				this.endDate = this.oldEndDate.clone();
			}

			//if a new date range was selected, invoke the user callback function
			if (!this.startDate.isSame(this.oldStartDate) || !this.endDate.isSame(this.oldEndDate))
				this.callback(this.startDate, this.endDate, this.chosenLabel);

			//if picker is attached to a text input, update it
			this.updateElement();

			$(document).off('.daterangepicker');
			$(window).off('.daterangepicker');
			this.container.hide();
			this.element.trigger('hide.daterangepicker', this);
			this.isShowing = false;
		},

		toggle: function(e) {
			if (this.isShowing) {
				this.hide();
			} else {
				this.show();
			}
		},

		outsideClick: function(e) {
			var target = $(e.target);
			// if the page is clicked anywhere except within the daterangerpicker/button
			// itself then call this.hide()
			if (
				// ie modal dialog fix
			e.type == "focusin" ||
			target.closest(this.element).length ||
			target.closest(this.container).length ||
			target.closest('.calendar-table').length
			) return;
			this.hide();
			this.element.trigger('outsideClick.daterangepicker', this);
		},

		showCalendars: function() {
			this.container.addClass('show-calendar');
			this.move();
			this.element.trigger('showCalendar.daterangepicker', this);
		},

		hideCalendars: function() {
			this.container.removeClass('show-calendar');
			this.element.trigger('hideCalendar.daterangepicker', this);
		},

		hoverRange: function(e) {

			//ignore mouse movements while an above-calendar text input has focus
			if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
				return;

			var label = e.target.getAttribute('data-range-key');

			if (label == this.locale.customRangeLabel) {
				this.updateView();
			} else {
				var dates = this.ranges[label];
				this.container.find('input[name=daterangepicker_start]').val(dates[0].format(this.locale.format));
				this.container.find('input[name=daterangepicker_end]').val(dates[1].format(this.locale.format));
			}

		},

		clickRange: function(e) {
			var label = e.target.getAttribute('data-range-key');
			this.chosenLabel = label;
			if (label == this.locale.customRangeLabel) {
				this.showCalendars();
			} else {
				var dates = this.ranges[label];
				this.startDate = dates[0];
				this.endDate = dates[1];

				if (!this.timePicker) {
					this.startDate.startOf('day');
					this.endDate.endOf('day');
				}

				if (!this.alwaysShowCalendars)
					this.hideCalendars();
				this.clickApply();
			}
		},

		clickPrev: function(e) {
			var cal = $(e.target).parents('.calendar');
			if (cal.hasClass('left')) {
				this.leftCalendar.month.subtract(1, 'month');
				if (this.linkedCalendars)
					this.rightCalendar.month.subtract(1, 'month');
			} else {
				this.rightCalendar.month.subtract(1, 'month');
			}
			this.updateCalendars();
		},

		clickNext: function(e) {
			var cal = $(e.target).parents('.calendar');
			if (cal.hasClass('left')) {
				this.leftCalendar.month.add(1, 'month');
			} else {
				this.rightCalendar.month.add(1, 'month');
				if (this.linkedCalendars)
					this.leftCalendar.month.add(1, 'month');
			}
			this.updateCalendars();
		},

		hoverDate: function(e) {

			//ignore mouse movements while an above-calendar text input has focus
			//if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
			//    return;

			//ignore dates that can't be selected
			if (!$(e.target).hasClass('available')) return;

			//have the text inputs above calendars reflect the date being hovered over
			var title = $(e.target).attr('data-title');
			var row = title.substr(1, 1);
			var col = title.substr(3, 1);
			var cal = $(e.target).parents('.calendar');
			var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

			if (this.endDate && !this.container.find('input[name=daterangepicker_start]').is(":focus")) {
				this.container.find('input[name=daterangepicker_start]').val(date.format(this.locale.format));
			} else if (!this.endDate && !this.container.find('input[name=daterangepicker_end]').is(":focus")) {
				this.container.find('input[name=daterangepicker_end]').val(date.format(this.locale.format));
			}

			//highlight the dates between the start date and the date being hovered as a potential end date
			var leftCalendar = this.leftCalendar;
			var rightCalendar = this.rightCalendar;
			var startDate = this.startDate;
			if (!this.endDate) {
				this.container.find('.calendar tbody td').each(function(index, el) {

					//skip week numbers, only look at dates
					if ($(el).hasClass('week')) return;

					var title = $(el).attr('data-title');
					var row = title.substr(1, 1);
					var col = title.substr(3, 1);
					var cal = $(el).parents('.calendar');
					var dt = cal.hasClass('left') ? leftCalendar.calendar[row][col] : rightCalendar.calendar[row][col];

					if ((dt.isAfter(startDate) && dt.isBefore(date)) || dt.isSame(date, 'day')) {
						$(el).addClass('in-range');
					} else {
						$(el).removeClass('in-range');
					}

				});
			}

		},

		clickDate: function(e) {

			if (!$(e.target).hasClass('available')) return;

			var title = $(e.target).attr('data-title');
			var row = title.substr(1, 1);
			var col = title.substr(3, 1);
			var cal = $(e.target).parents('.calendar');
			var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

			//
			// this function needs to do a few things:
			// * alternate between selecting a start and end date for the range,
			// * if the time picker is enabled, apply the hour/minute/second from the select boxes to the clicked date
			// * if autoapply is enabled, and an end date was chosen, apply the selection
			// * if single date picker mode, and time picker isn't enabled, apply the selection immediately
			// * if one of the inputs above the calendars was focused, cancel that manual input
			//

			if (this.endDate || date.isBefore(this.startDate, 'day')) { //picking start
				if (this.timePicker) {
					var hour = parseInt(this.container.find('.left .hourselect').val(), 10);
					if (!this.timePicker24Hour) {
						var ampm = this.container.find('.left .ampmselect').val();
						if (ampm === 'PM' && hour < 12)
							hour += 12;
						if (ampm === 'AM' && hour === 12)
							hour = 0;
					}
					var minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
					var second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
					date = date.clone().hour(hour).minute(minute).second(second);
				}
				this.endDate = null;
				this.setStartDate(date.clone());
			} else if (!this.endDate && date.isBefore(this.startDate)) {
				//special case: clicking the same date for start/end,
				//but the time of the end date is before the start date
				this.setEndDate(this.startDate.clone());
			} else { // picking end
				if (this.timePicker) {
					var hour = parseInt(this.container.find('.right .hourselect').val(), 10);
					if (!this.timePicker24Hour) {
						var ampm = this.container.find('.right .ampmselect').val();
						if (ampm === 'PM' && hour < 12)
							hour += 12;
						if (ampm === 'AM' && hour === 12)
							hour = 0;
					}
					var minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
					var second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
					date = date.clone().hour(hour).minute(minute).second(second);
				}
				this.setEndDate(date.clone());
				if (this.autoApply) {
					this.calculateChosenLabel();
					this.clickApply();
				}
			}

			if (this.singleDatePicker) {
				this.setEndDate(this.startDate);
				if (!this.timePicker)
					this.clickApply();
			}

			this.updateView();

			//This is to cancel the blur event handler if the mouse was in one of the inputs
			e.stopPropagation();

		},

		calculateChosenLabel: function () {
			var customRange = true;
			var i = 0;
			for (var range in this.ranges) {
				if (this.timePicker) {
					if (this.startDate.isSame(this.ranges[range][0]) && this.endDate.isSame(this.ranges[range][1])) {
						customRange = false;
						this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').html();
						break;
					}
				} else {
					//ignore times when comparing dates if time picker is not enabled
					if (this.startDate.format('YYYY-MM-DD') == this.ranges[range][0].format('YYYY-MM-DD') && this.endDate.format('YYYY-MM-DD') == this.ranges[range][1].format('YYYY-MM-DD')) {
						customRange = false;
						this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').html();
						break;
					}
				}
				i++;
			}
			if (customRange) {
				if (this.showCustomRangeLabel) {
					this.chosenLabel = this.container.find('.ranges li:last').addClass('active').html();
				} else {
					this.chosenLabel = null;
				}
				this.showCalendars();
			}
		},

		clickApply: function(e) {
			this.hide();
			this.element.trigger('apply.daterangepicker', this);
		},

		clickCancel: function(e) {
			this.startDate = this.oldStartDate;
			this.endDate = this.oldEndDate;
			this.hide();
			this.element.trigger('cancel.daterangepicker', this);
		},

		monthOrYearChanged: function(e) {
			var isLeft = $(e.target).closest('.calendar').hasClass('left'),
				leftOrRight = isLeft ? 'left' : 'right',
				cal = this.container.find('.calendar.'+leftOrRight);

			// Month must be Number for new moment versions
			var month = parseInt(cal.find('.monthselect').val(), 10);
			var year = cal.find('.yearselect').val();

			if (!isLeft) {
				if (year < this.startDate.year() || (year == this.startDate.year() && month < this.startDate.month())) {
					month = this.startDate.month();
					year = this.startDate.year();
				}
			}

			if (this.minDate) {
				if (year < this.minDate.year() || (year == this.minDate.year() && month < this.minDate.month())) {
					month = this.minDate.month();
					year = this.minDate.year();
				}
			}

			if (this.maxDate) {
				if (year > this.maxDate.year() || (year == this.maxDate.year() && month > this.maxDate.month())) {
					month = this.maxDate.month();
					year = this.maxDate.year();
				}
			}

			if (isLeft) {
				this.leftCalendar.month.month(month).year(year);
				if (this.linkedCalendars)
					this.rightCalendar.month = this.leftCalendar.month.clone().add(1, 'month');
			} else {
				this.rightCalendar.month.month(month).year(year);
				if (this.linkedCalendars)
					this.leftCalendar.month = this.rightCalendar.month.clone().subtract(1, 'month');
			}
			this.updateCalendars();
		},

		timeChanged: function(e) {

			var cal = $(e.target).closest('.calendar'),
				isLeft = cal.hasClass('left');

			var hour = parseInt(cal.find('.hourselect').val(), 10);
			var minute = parseInt(cal.find('.minuteselect').val(), 10);
			var second = this.timePickerSeconds ? parseInt(cal.find('.secondselect').val(), 10) : 0;

			if (!this.timePicker24Hour) {
				var ampm = cal.find('.ampmselect').val();
				if (ampm === 'PM' && hour < 12)
					hour += 12;
				if (ampm === 'AM' && hour === 12)
					hour = 0;
			}

			if (isLeft) {
				var start = this.startDate.clone();
				start.hour(hour);
				start.minute(minute);
				start.second(second);
				this.setStartDate(start);
				if (this.singleDatePicker) {
					this.endDate = this.startDate.clone();
				} else if (this.endDate && this.endDate.format('YYYY-MM-DD') == start.format('YYYY-MM-DD') && this.endDate.isBefore(start)) {
					this.setEndDate(start.clone());
				}
			} else if (this.endDate) {
				var end = this.endDate.clone();
				end.hour(hour);
				end.minute(minute);
				end.second(second);
				this.setEndDate(end);
			}

			//update the calendars so all clickable dates reflect the new time component
			this.updateCalendars();

			//update the form inputs above the calendars with the new time
			this.updateFormInputs();

			//re-render the time pickers because changing one selection can affect what's enabled in another
			this.renderTimePicker('left');
			this.renderTimePicker('right');

		},

		formInputsChanged: function(e) {
			var isRight = $(e.target).closest('.calendar').hasClass('right');
			var start = moment(this.container.find('input[name="daterangepicker_start"]').val(), this.locale.format);
			var end = moment(this.container.find('input[name="daterangepicker_end"]').val(), this.locale.format);

			if (start.isValid() && end.isValid()) {

				if (isRight && end.isBefore(start))
					start = end.clone();

				this.setStartDate(start);
				this.setEndDate(end);

				if (isRight) {
					this.container.find('input[name="daterangepicker_start"]').val(this.startDate.format(this.locale.format));
				} else {
					this.container.find('input[name="daterangepicker_end"]').val(this.endDate.format(this.locale.format));
				}

			}

			this.updateView();
		},

		formInputsFocused: function(e) {

			// Highlight the focused input
			this.container.find('input[name="daterangepicker_start"], input[name="daterangepicker_end"]').removeClass('active');
			$(e.target).addClass('active');

			// Set the state such that if the user goes back to using a mouse,
			// the calendars are aware we're selecting the end of the range, not
			// the start. This allows someone to edit the end of a date range without
			// re-selecting the beginning, by clicking on the end date input then
			// using the calendar.
			var isRight = $(e.target).closest('.calendar').hasClass('right');
			if (isRight) {
				this.endDate = null;
				this.setStartDate(this.startDate.clone());
				this.updateView();
			}

		},

		formInputsBlurred: function(e) {

			// this function has one purpose right now: if you tab from the first
			// text input to the second in the UI, the endDate is nulled so that
			// you can click another, but if you tab out without clicking anything
			// or changing the input value, the old endDate should be retained

			if (!this.endDate) {
				var val = this.container.find('input[name="daterangepicker_end"]').val();
				var end = moment(val, this.locale.format);
				if (end.isValid()) {
					this.setEndDate(end);
					this.updateView();
				}
			}

		},

		elementChanged: function() {
			if (!this.element.is('input')) return;
			if (!this.element.val().length) return;
			if (this.element.val().length < this.locale.format.length) return;

			var dateString = this.element.val().split(this.locale.separator),
				start = null,
				end = null;

			if (dateString.length === 2) {
				start = moment(dateString[0], this.locale.format);
				end = moment(dateString[1], this.locale.format);
			}

			if (this.singleDatePicker || start === null || end === null) {
				start = moment(this.element.val(), this.locale.format);
				end = start;
			}

			if (!start.isValid() || !end.isValid()) return;

			this.setStartDate(start);
			this.setEndDate(end);
			this.updateView();
		},

		keydown: function(e) {
			//hide on tab or enter
			if ((e.keyCode === 9) || (e.keyCode === 13)) {
				this.hide();
			}
		},

		updateElement: function() {
			if (this.element.is('input') && !this.singleDatePicker && this.autoUpdateInput) {
				this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
				this.element.trigger('change');
			} else if (this.element.is('input') && this.autoUpdateInput) {
				this.element.val(this.startDate.format(this.locale.format));
				this.element.trigger('change');
			}
		},

		remove: function() {
			this.container.remove();
			this.element.off('.daterangepicker');
			this.element.removeData();
		}

	};

	$.fn.daterangepicker = function(options, callback) {
		this.each(function() {
			var el = $(this);
			if (el.data('daterangepicker'))
				el.data('daterangepicker').remove();
			el.data('daterangepicker', new DateRangePicker(el, options, callback));
		});
		return this;
	};

	return DateRangePicker;

}));

(function ($) {

    /**
     * Custom DateRangePicker
     *
     * @param el {DOM}
     * @param args {Object}
     * @constructor
     */
    function DateRangePickerMinDate(el, args) {

        var $el = $(el),
            datePicker = $el.data('daterangepicker'),
            $views = {},
            dateMin,
            selectedEnd;

        dateMin = parseInt(args.dateMin || 0);

        //console.log(args)

        // If DateRangePicker is not applied to input or dateMin option is already added
        if (!datePicker || datePicker.dateMin) {
            return;
        }

        // Calculate the dateMin with the dateLimit option if it's set
        // dateMin always less than or equals with dateLimit
        if (datePicker.dateLimit && dateMin > datePicker.dateLimit.days) {
            dateMin = datePicker.dateLimit.days;
        }

        // If dateMin is less than 2 then no need to our code
        if (dateMin < 2) {
            return;
        }

        datePicker.dateMin = true;

        var customID = 'custom-date-min',
            availableDates = 0,

            /**
             * Highlight the date on the left or right calendar
             *
             * @param startDate
             * @param endDate
             * @param side
             */
            highlightDate = function (startDate, endDate, side) {
                var calendar = datePicker[side === 'left' ? 'leftCalendar' : 'rightCalendar'].calendar;

                // Reset to default if user has selected the end date
                if (selectedEnd) {
                    $.each(['left', 'right'], function () {
                        $views[this].find('td').removeClass('date-min no-click')
                    });

                    return;
                }

                /**
                 * Loop through all cells in calendar and highlight the dates user can not select
                 */
                for (var row = 0; row < 6; row++) {
                    for (var col = 0; col < 7; col++) {
                        var d = calendar[row][col],
                            $date;

                        if (d.isSame(startDate) || d.isSame(endDate) || d.isAfter(startDate) && d.isBefore(endDate)) {
                            $date = $views[side].find('[data-title="r' + row + 'c' + col + '"]').addClass('in-range date-min');
                        } else {
                        }

                        if ($date && $date.hasClass('available')) {
                            availableDates++;
                            if (availableDates < dateMin) {
                                $date.addClass('no-click');
                            }
                        }
                    }
                }
            },

            /**
             * Highlight the dates in range
             */
            highlightDatesRange = function () {
                $views[this] = datePicker.container.find('.calendar.' + this);
                $views[this].off('mouseup.' + customID).on('mouseup.' + customID, function (e) {
                    var $startDate = datePicker.container.find('.start-date'),
                        $endDate = datePicker.container.find('.end-date'),
                        side = $startDate.closest('.calendar').hasClass('left') ? 'left' : 'right',
                        calendar = datePicker[side === 'left' ? 'leftCalendar' : 'rightCalendar'].calendar,
                        title = $startDate.attr('data-title'),
                        curRow = title.substr(1, 1),
                        curCol = title.substr(3, 1),
                        startDate = calendar[curRow][curCol],
                        endDate = startDate.clone().add(dateMin - 1, 'day');

                    selectedEnd = !!$endDate.length;
                    availableDates = 0;

                    highlightDate(startDate, endDate, 'left');
                    highlightDate(startDate, endDate, 'right');
                });
            };
        $el.attr('data-date-min', dateMin).data('dateMin', dateMin);

        $.each(['left', 'right'], highlightDatesRange);
    }

    // jQuery plugin
    $.fn.DateRangePickerMinDate = function (args) {
        return $.each(this, function () {
            var _args = $.extend(args, $(this).data());
            $(this).on('focus', function () {
                new DateRangePickerMinDate(this, $.extend({dateMin: ''}, _args));
            });
        });
    }
})(jQuery);

(function ($) {
	"use strict";

    $(document).ready(function () {
        $('.room-faqs-box__title').on('click',function (e) {
            e.preventDefault();
            const content = $(this).parent('.room-faqs-box').find('.room-faqs-box__content');
            if ( content.hasClass('active') ) {
                content.removeClass('active');
                $(this).removeClass('active');
                content.slideUp(300);
            } else {
                content.addClass('active');
                $(this).addClass('active');
                content.slideDown(300);
            }

        })
		$(document).on('click', '.menu-mobile-effect', function (e) {
			e.stopPropagation();
			$('body').toggleClass('mobile-menu-open')
		})

		// $(document).on('click', '#main-content, .main-navigation .thim-ekits-menu__mobile__close', function (e) {
		// 	e.stopPropagation();
		// 	$('body').removeClass('mobile-menu-open')
		// })

		$('.navbar-main-menu li.menu-item-has-children > a, .main-navigation .menu li.menu-item-has-children > a').after('<span class="icon-toggle"><i class="tk tk-angle-right" aria-hidden="true"></i></span>');
		$("span").remove(".thim-ekits-menu__icon");
		$('.navbar-main-menu > li.menu-item-has-children .icon-toggle, .main-navigation .menu > li.menu-item-has-children .icon-toggle').on('click', function () {
			if ($(this).next('ul.sub-menu').is(':hidden')) {
				$(this).next('ul.sub-menu').slideDown(200, 'linear');
			}
		});

		// $('.main-navigation > .inner-navigation').after('<li class="thim-ekits-menu__mobile__close"><i class="tk tk-times"></i></li>');
		$('.navbar-main-menu .sub-menu > li:first-child, .main-navigation .menu .sub-menu > li:first-child').before('<li class="thim-ekits-menu__mobile__backlink"><i class="tk tk-angle-left" aria-hidden="true"></i>Back</li>');

		$(document).on('click', '.navbar-main-menu > li.menu-item-has-children .icon-toggle, .main-navigation .menu > li.menu-item-has-children .icon-toggle', function (e) {
			e.stopPropagation();
			$(this).next('ul.sub-menu').addClass('show');
		})

		$(document).on('click', '.thim-ekits-menu__mobile__backlink', function (e) {
			e.preventDefault();
			$(this).parent('ul.sub-menu').removeClass('show').slideUp(200, 'linear');
		})

	});

	

	function widthDay() {
		$('.layout-multidate input.day').each(function () {
			var text = $(this).val() + 1;
			var getWidth = $('<span class="getWidth">' + text + '</span>').insertAfter(this);
			$(this).css({'width': getWidth.outerWidth()}).next('.getWidth').remove();
		});
	}

	if (typeof (hotel_settings) === 'undefined') {

	} else {
		$(window).on('load', function () {
			$('.layout-multidate input[id^="check_in_date"]').datepicker("option", {
				altField : $('.layout-multidate input[id^="check_in_date"]').parent().find('.day'),
				altFormat: "dd",
			});
			$('.layout-multidate input[id^="check_out_date"]').datepicker("option", {
				altField : $('.layout-multidate input[id^="check_out_date"]').parent().find('.day'),
				altFormat: "dd",
			});
			widthDay();
		})
	}
	;

	$(document).ready(function () {

		if (typeof (hotel_settings) === 'undefined') {
			var start_plus = 1;
		} else {
			var start_plus = hotel_settings.min_booking_date + 1;
		}

		start_plus = parseInt(start_plus);
		var date_min = new Date();
		date_min.setDate(date_min.getDate());

		$('#multidate').daterangepicker({
			parentEl : ".layout-multidate .hb-form-table",
			minDate  : date_min,
			autoclose: true,
			autoApply: true
		});

		$('#multidate').DateRangePickerMinDate({
			dateMin: start_plus
		});

		$('#multidate').on('apply.daterangepicker', function (ev, picker) {

			$('.layout-multidate input[id^="check_in_date"]').val(picker.startDate.format('MMMM DD, YYYY'));
			// $('#day').val(picker.startDate.format('DD'));
			// $('#month').val(picker.startDate.format('MMM YYYY'));
			$('.layout-multidate input[id^="check_out_date"]').val(picker.endDate.format('MMMM DD, YYYY'));
			// $('#day2').val(picker.endDate.format('DD'));
			// $('#month2').val(picker.endDate.format('MMM YYYY'));

			widthDay();

		});

		$('#multidate').on('cancel.daterangepicker', function (ev, picker) {
			$(this).val('');
		});

	});

})(jQuery);