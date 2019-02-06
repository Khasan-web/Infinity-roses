$(document).ready(function() {
	$('#loader').fadeOut(200);
	$('body').css('opacity', '1');
});

new WOW().init();
$('#dp5').slider()
.on('slide', function(ev){
	$('.tooltip').css('opacity', '1');
});
$('.slider').css('width', '100%');

$(function() {

	var navbarHeight = $('#nav-brand').height() + 32, // 32 is padding of nav-brand
		bgImage = $('.bg-image').height();
	
	var introHeight = bgImage - navbarHeight;
	$('.intro').height(introHeight);
	
	var doc = document.documentElement,
		navTop = $('#nav-brand').height() + 32;

	$('nav').css({'background': 'transparent', 'padding': '3px 0', 'position': 'absolute', 'top': '115px'});


	// navbar background

	function scrollNav() {
		var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
		if (top >= navTop) {
			$('nav').css({'background': '#000', 'padding': '0', 'position': 'fixed', 'top': '0'});
			$('nav .nav-item').css('padding', '8px 0');
		} else if (top < navTop){
			$('nav').css({'padding': '3px 0', 'position': 'absolute', 'top': '115px'});
			if (!$('#navbarNav').hasClass('show')) {
				$('nav').css({'background': 'transparent'});
				$('#nav-brand').css({'background': 'transparent'});
			} else {
				$('nav').css({'background': '#000'});
				$('#nav-brand').css({'background': '#000'});
			}
			$('nav .nav-item').css('padding', '3px 0');
		}
	}

	onscroll = function navbarColor() {
		scrollNav();
	}

	if (!$('.bg-image').length) {
		$('nav').addClass('bg-black');
		$('#nav-brand').addClass('bg-black');
	}

	// make bg black on toggler click 

	var collapseIndex = 0;
	$('.navbar-toggler').click(function() {
		var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
		if (collapseIndex == 0) {
			$('#nav-brand').css('background', '#000');
			$('nav').css('background', '#000');
			collapseIndex = 1
		} else if (collapseIndex == 1 && top < navTop){
			collapseIndex = 0
			$('#nav-brand').css('background', 'transparent');
			$('nav').css('background', 'transparent');
		}
	});

	$('.dropdown-menu').click(function() {
		return false;
	});


	// product qty

	$('.more').click(function() {
		var qty = $(this).next().html();
		qty = parseInt(qty);
		qty += 1;
		$(this).next().html(qty)
	});
	$('.less').click(function() {
		var qty = $(this).prev().html();
		qty = parseInt(qty);
		qty -= 1;
		$(this).prev().html(qty);
		if ($(this).prev().html() <= 0) {
			$(this).prev().html(1)
		}
	});

	$('.add-to-cart-prod').click(function() {
		var qty = $('.qty').html();
		qty = parseInt(qty);
		if (qty <= 0) {
			$('.qty').html(1);
		}
	});


	// img picker

	$('.color img').click(function() {
		$('.active-img').attr('src', $(this).attr('src'));
		$('.active-img').attr('data-color', $(this).attr('data-color'));
	});

	if ($('.active-box').data('size') == 'lg') {
		$('.selected-box').html('Large Box');
	} else if ($('.active-box').data('size') == 'sm') {
		$('.selected-box').html('Small Box');
	}


	// choosing size of a product

	$('.box').click(function() {
		$('.box').removeClass('active-box');
		$(this).addClass('active-box');
		if ($(this).data('size') == 'lg') {
			$('.selected-box').html('Large Box');
		} else if ($(this).data('size') == 'sm') {
			$('.selected-box').html('Small Box');
		}
	});


	// logic for switcher

	$(".custom-switch").click(function (){
		var toggle = $(this).find('input[type="checkbox"]').attr("checked");
		if (toggle == "checked") {
			$(this).find('input[type="checkbox"]').removeAttr("checked", "checked");
		} else {
			$(this).find('input[type="checkbox"]').attr("checked", "checked");
		}
	});


	// drodown open
	$('.drop-item').hover(function() {
		var display = $(this).find('.dropdown-menu').css('display');
		if (display == 'block') {
			$(this).find('.dropdown-menu').hide();
			if ($('nav').css('position') == 'absolute') {
				$('#nav-brand').css('background', 'transparent');
				$('nav').css('background', 'transparent');
			}
		} else {
			$(this).find('.dropdown-menu').show();
			$('#nav-brand').css('background', '#000');
			$('nav').css('background', '#000');
		}
	});
	
	if ($(window).width() <= 992) {
		$('.drop-item').click(function() {
			if ($(this).find('.dropdown-menu').css('display') == 'block') {
				$(this).find('.dropdown-menu').css('display', 'none');
			} else {
				$(this).find('.dropdown-menu').css('display', 'block');
			}
		});
	}


});
