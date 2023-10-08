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

		$('#preload').delay(100).fadeOut(500, function () {
			$(this).remove();
		});
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

			var $time = $(".sc-testimonials").attr('data-time');
			if($(".sc-testimonials").length){
				$(".sc-testimonials").owlCarousel({
					autoplay          : true,
					items             : 1,
					autoplayHoverPause: true,
					loop              : true,
					dots              : true,
					nav               : false,
					autoHeight        : false,
					autoplayTimeout   : $time,
				});
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

	if (mobilecheck()) {
		window.addEventListener('load', function () { // on page load
			document.getElementById('main-content').addEventListener("touchstart", function (e) {
				jQuery('.wrapper-container').removeClass('mobile-menu-open');
			});
		}, false);
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

			$('select[name="adults_capacity"]').trigger('change.select2'); // Notify only Select2 of changes

		});

		$('.nav-guest .goDown').on('click', function () {
			var index = $('select[name="adults_capacity"] option:selected').index();
			if (index <= 0) {
				return;
			}
			var selected = $($('select[name="adults_capacity"] option')[index - 1]).val();
			$('select[name="adults_capacity"]').val(selected);

			$('select[name="adults_capacity"]').trigger('change.select2'); // Notify only Select2 of changes

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

			$('select[name="max_child"]').trigger('change.select2'); // Notify only Select2 of changes

		});

		$('.nav-child .goDown').on('click', function () {
			var index = $('select[name="max_child"] option:selected').index();
			if (index <= 0) {
				return;
			}
			var selected = $($('select[name="max_child"] option')[index - 1]).val();
			$('select[name="max_child"]').val(selected);

			$('select[name="max_child"]').trigger('change.select2'); // Notify only Select2 of changes

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
						buttonText: '<i class="fa fa-calendar"></i>'
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
	};

	$(window).load(function () {
		var cookie_name = 'room_switch',
			archive = $('#thim-room-archive');
		if (archive.length > 0) {
			//Check grid-layout
			if (!jQuery.cookie(cookie_name) || jQuery.cookie(cookie_name) == 'grid-layout') {
				if (archive.hasClass('thim-room-list')) {
					archive.removeClass('thim-room-list').addClass('thim-room-grid');
				}
				$('.thim-room-switch-layout > a.switchToGrid').addClass('switch-active');
			} else {
				if (archive.hasClass('thim-room-grid')) {
					archive.removeClass('thim-room-grid').addClass('thim-room-list');
				}
				$('.thim-room-switch-layout > a.switchToList').addClass('switch-active');
			}

			$('.thim-room-switch-layout > a').on('click', function (event) {
				var elem = $(this);

				event.preventDefault();
				if (!elem.hasClass('switch-active')) {
					if (elem.hasClass('switchToGrid')) {
						$('.thim-room-switch-layout > a').removeClass('switch-active');
						elem.addClass('switch-active');
						archive.fadeOut(300, function () {
							archive.removeClass('thim-room-list').addClass(' thim-room-grid').fadeIn(300);
							jQuery.cookie(cookie_name, 'grid-layout', {expires: 3, path: '/'});
						});
					} else {
						$('.thim-room-switch-layout > a').removeClass('switch-active');
						elem.addClass('switch-active');
						archive.fadeOut(300, function () {
							archive.removeClass('thim-room-grid').addClass('thim-room-list').fadeIn(300);
							jQuery.cookie(cookie_name, 'list-layout', {expires: 3, path: '/'});
						});
					}
				}
			});
		}
	});

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
	});

	$(window).load(function () {
		var $thim_sc_video_box = $('.thim-sc-video-box');

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
				buttonText: '<i class="fa fa-calendar"></i>',
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
				buttonText: '<i class="fa fa-calendar"></i>',
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
				buttonText    : '<i class="fa fa-calendar"></i>',
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
				buttonText    : '<i class="fa fa-calendar"></i>',
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
					autoplay          : true,
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
					autoplay          : true,
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


	$(document).ready(function () {

		var date_min = new Date();
		date_min.setDate(date_min.getDate());
		if(jQuery().daterangepicker){
			$('#multidate').daterangepicker({
				parentEl : ".layout-multidate .hb-form-table",
				minDate  : date_min,
				autoclose: true,
				autoApply: true
			});


			$('#multidate').on('apply.daterangepicker', function (ev, picker) {

				$('.layout-multidate input[id^="check_in_date"]').val(picker.startDate.format('MMMM DD, YYYY'));
				// $('#day').val(picker.startDate.format('DD'));
				// $('#month').val(picker.startDate.format('MMM YYYY'));
				$('.layout-multidate input[id^="check_out_date"]').val(picker.endDate.format('MMMM DD, YYYY'));
				// $('#day2').val(picker.endDate.format('DD'));
				// $('#month2').val(picker.endDate.format('MMM YYYY'));
			});

			$('#multidate').on('cancel.daterangepicker', function (ev, picker) {
				$(this).val('');
			});
		}
	});

})(jQuery);
