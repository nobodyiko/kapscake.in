(function ($) {
	"use strict";
	$(function () {
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
					'hover': function () {
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
				'hover': function () {
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
		$('.bg-video-play').on( "click", function () {
			var elem = $(this),
				video = $(this).parents('.thim-widget-icon-box').find('.full-screen-video'),
				player = video.get(0);
			if (player.paused) {
				player.play();
				elem.addClass('bg-pause');
			} else {
				player.pause();
				elem.removeClass('bg-pause');
			}
		});


		//Background video
		$('.mute-audio').on( "click", function () {
			var elem = $(this),
				video = $(this).parents('.thim-widget-icon-box').find('.full-screen-video'),
				player = video.get(0);

				console.log(player);
			// if (player.paused) {
			// 	player.play();
			// 	elem.addClass('bg-pause');
			// } else {
			// 	player.pause();
			// 	elem.removeClass('bg-pause');
			// }
		});
		
		
		
		if (jQuery().waypoint) {
			$('.wrapper-box-icon.background-video').waypoint(function () {
				var player = $(this).parent().find('.full-screen-video').get(0),
					button = $(this).find('.bg-video-play');
				if(player.paused ) {
					button.trigger('click');
				}
			}, {
				triggerOnce: true,
				offset     : 'bottom-in-view'
			});
		}
	});
})(jQuery);