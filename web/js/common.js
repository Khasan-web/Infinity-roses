$(document).ready(function () {
	$('#loader').fadeOut(200);
	$('body').css('opacity', '1');
	$('.owl-carousel').owlCarousel({
		lazyLoad: true,
	});
});

new WOW().init();

// price formating, 1000000 --> 1 000 000
function priceWithSpaces(price) {
	price = parseInt(price);
	var result = price.toLocaleString();
	return result;
}

// magnific pop up
$('.gallery_images').magnificPopup({
	delegate: 'div',
	type: 'image',
	tLoading: 'Loading image #%curr%...',
	mainClass: 'item',
	fixedContentPos: false,
	gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
	},
	image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		// titleSrc: function(item) {
		// 	return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
		// }
	},
	callbacks: {
		open: function () {
			$("body").css("overflow", "hidden");
		},
		beforeClose: function () {
			$("body").css("overflow", "visible");
		},
	}
});

// detect what language is active
var ru;
if (window.location.href.indexOf("ru") > -1) {
	ru = 'ru/';
} else {
	ru = '';
}

// get GET parametrs
var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};

$(function () {

	// setting default css to nav-link | style attr doesnt work
	$('nav .nav-link').css('padding', '3px 15px');

	// helper about buying of a product
	$('.toggle').click(function () {
		$('.helper').toggle();
	});

	var navbarHeight = $('#nav-brand').height() + 32, // 32 is padding of nav-brand
		bgImage = $('.bg-image').height();

	var introHeight = bgImage - navbarHeight;
	$('.intro').height(introHeight);

	var doc = document.documentElement,
		navTop = $('#nav-brand').height() + 32;

	$('nav').css({
		'background': 'transparent',
		'padding': '3px 0',
		'position': 'absolute',
		'top': '115px'
	});

	// navbar background
	function scrollNav() {
		var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
		if (top >= navTop) {
			$('nav').css({
				'background': '#000',
				'padding': '0',
				'position': 'fixed',
				'top': '0'
			});
			$('nav .nav-link').css('padding', '8px 15px');
		} else if (top < navTop) {
			$('nav').css({
				'padding': '3px 0',
				'position': 'absolute',
				'top': '115px'
			});
			if (!$('#navbarNav').hasClass('show')) {
				$('nav').css({
					'background': 'transparent'
				});
				$('#nav-brand').css({
					'background': 'transparent'
				});
			} else {
				$('nav').css({
					'background': '#000'
				});
				$('#nav-brand').css({
					'background': '#000'
				});
			}
			$('nav .nav-link').css('padding', '3px 15px');
		}
	}

	onscroll = function navbarColor() {
		scrollNav();
	}

	// navbar bg-black if no bg-image

	if (!$('.bg-image').length) {
		$('nav').addClass('bg-black');
		$('#nav-brand').addClass('bg-black');
	}

	// make bg black on toggler click 

	$('.navbar-toggler').click(function () {
		$('#nav-brand').toggleClass('bg-black');
		$('nav').toggleClass('bg-black');
	});

	$('.navbar-toggler').dblclick(function () {
		$('#nav-brand').toggleClass('bg-black');
		$('nav').toggleClass('bg-black');
	});


	// active nav-item

	var location = window.location.pathname;
	if (location == '/category/fresh-roses') {
		$('#fresh-roses').addClass('active');
	} else if (location == '/category/infinity-roses') {
		$('#infinity-roses').addClass('active');
	} else if (location == '/category/luxury-collections') {
		$('#luxury-collections').addClass('active');
	}


	// change image in nav on hover

	$('li .product-item').mouseover(function () {
		var parents = $(this).parents(),
			parent = parents.closest('.content').find('.img-preview img');

		parent.attr('src', $(this).data('image'));
	});




	// GIFT FINDER RANGE SLIDER

	if ($('#gift-finder-page').length) {
		// The Best slider
		var slider = document.getElementById('gift-finder-page'),
			min = $('#gift-finder-page').data('min'),
			max = $('#gift-finder-page').data('max');
		noUiSlider.create(slider, {
			start: [min, max],
			connect: true,
			step: 10000,
			range: {
				'min': min,
				'max': max
			}
		});

		// set price from GET params
		if (getUrlParameter('price')) {
			var price = getUrlParameter('price').split(',');
			$('#gf-price').val(price);
			slider.noUiSlider.set([price[0], price[1]]);
		}

		// update price diapazon on slide
		slider.noUiSlider.on('update', function (values, handle) {
			$('.slider__min').text(priceWithSpaces(parseInt(values[0])));
			$('.slider__max').text(priceWithSpaces(parseInt(values[1])));
			$('#gf-price').val(parseInt(values[0]) + ',' + parseInt(values[1]));
		});
	}

	// GIFT FINDER RANGE SLIDER END 



	// NAVBAR GIFT FINDER RANGE SLIDER

	// The Best slider in navbar
	var sliderNav = document.getElementById('gift-finder-nav'),
		min = $('#gift-finder-nav').data('min'),
		max = $('#gift-finder-nav').data('max');
	noUiSlider.create(sliderNav, {
		start: [min, max],
		connect: true,
		step: 10000,
		range: {
			'min': min,
			'max': max
		}
	});

	// set price from GET params
	if (getUrlParameter('price')) {
		var price = getUrlParameter('price').split(',');
		$('#gf-price').val(price);
		sliderNav.noUiSlider.set([price[0], price[1]]);
	}

	// update price diapazon on slide
	sliderNav.noUiSlider.on('update', function (values, handle) {
		$('.slider__min-nav').text(priceWithSpaces(parseInt(values[0])));
		$('.slider__max-nav').text(priceWithSpaces(parseInt(values[1])));
		$('#gf-price-nav').val(parseInt(values[0]) + ',' + parseInt(values[1]));
	});

	// NAVBAR GIFT FINDER RANGE SLIDER END



	// product qty

	var productQty = 1;

	function updateQty() {
		productQty = $('.input-qty').val();
	}

	$('.input-qty').change(function () {
		updateQty();
	});

	$('.container').on('click', '.more', function () {
		var qty = $(this).parent().find('input'),
			addedFlower = $(this).parents().closest('.added-flower');
		flowerId = addedFlower.data('id');

		if (!qty.val()) {
			qty.val(1);
		}
		paresedQty = parseInt(qty.val());
		qty.val(paresedQty + 1);
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i].id == flowerId) {
				selectedFlowers[i].qty = qty.val();
				selectedFlowers[i].sum = selectedFlowers[i].qty * selectedFlowers[i].price;
			}
		}

		updateQty();
		getTotalQty();
	});
	$('.container').on('click', '.less', function () {
		var qty = $(this).parent().find('input'),
			addedFlower = $(this).parents().closest('.added-flower');
		flowerId = addedFlower.data('id');

		paresedQty = parseInt(qty.val());
		qty.val(paresedQty - 1);
		if (qty.val() <= 0) {
			qty.val(1);
		}
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i][0] == flowerId) {
				selectedFlowers[i][4] = qty.val();
				selectedFlowers[i].sum = selectedFlowers[i].qty * selectedFlowers[i].price;
			}
		}

		updateQty();
		getTotalQty();
	});

	// update total qty

	function getTotalQty() {
		var commonQty = 0;
		$('.added-flower input').each(function () {
			commonQty += parseInt($(this).html());
		});
		$('.count').html(commonQty);
	}


	// logic for switcher

	$(".custom-switch").click(function () {
		var toggle = $(this).find('input[type="checkbox"]').attr("checked");
		if (toggle == "checked") {
			$(this).find('input[type="checkbox"]').removeAttr("checked", "checked");
		} else {
			$(this).find('input[type="checkbox"]').attr("checked", "checked");
		}
	});

	$(".custom-checkbox").click(function () {
		var toggle = $(this).find('input[type="checkbox"]').attr("checked");
		if (toggle == "checked") {
			$(this).find('input[type="checkbox"]').removeAttr("checked", "checked");
			$(this).find('input[type="checkbox"]').val(false);
		} else {
			$(this).find('input[type="checkbox"]').attr("checked", "checked");
			$(this).find('input[type="checkbox"]').val(true);
		}
	});


	// drodown open

	$('.drop-item').hover(function () {
		var display = $(this).find('.dropdown-menu');
		if (display.css('display') == 'block') {
			display.css('display', 'none');
			if ($('nav').css('position') == 'absolute') {
				$('#nav-brand').css('background', 'transparent');
				$('nav').css('background', 'transparent');
			}
		} else {
			display.css('display', 'block');
			$('#nav-brand').css('background', '#000');
			$('nav').css('background', '#000');
		}
	});


	// **CREATOR**

	// ajax add own set

	// $('.form-order').click(function() {
	// 	var creatorAjaxData = {};
	// 	creatorAjaxData.flowers = selectedFlowers;
	// 	creatorAjaxData.container = container;
	// 	creatorAjaxData.accessories = accessories;
	// 	// $.ajax({
	// 	// 	url: '/creator/formalize-set',
	// 	// 	data: {data: creatorAjaxData},
	// 	// 	type: 'GET',
	// 	// 	success: function (res) {
	// 	// 		if (!res) return alert('Error');
	// 	// 		// smth else
	// 	// 	},
	// 	// 	error: function () {
	// 	// 		alert('Error');
	// 	// 	}
	// 	// });
	// 	console.log(creatorAjaxData);
	// });

	// // end ajax add own set


	// $('#container').on('click', '.container-item', function () {
	// 	var id = $(this).find('img').data('id');
	// 	next('container', 'accessories');
	// });

	// $('.chocolate').on('click', 'div', function() {
	// 	var chocolate = $(this).find('img').data('id');
	// 	$('.chocolate div').css('opacity', '0.4');
	// 	$(this).css('opacity', '1');
	// });	
	// $('.parfume').on('click', 'div', function() {
	// 	var parfume = $(this).find('img').data('id');
	// 	$('.parfume div').css('opacity', '0.4');
	// 	$(this).css('opacity', '1');
	// });

	// var selectedFlowers = [];

	// $('#roses').on('click', '.flower', function() {
	// 	flowerData = {};
	// 	var flower 	   = $(this).find('img');
	// 		flowerData.id     	   = flower.data('id');
	// 		flowerData.name   	   = flower.data('name');
	// 		flowerData.price  	   = flower.data('price');
	// 		flowerData.img	   	   = flower.attr('src');
	// 		flowerData.qty   	   = 1;
	// 		flowerData.sum;

	// 	selectedFlowers.push(flowerData);

	// 	var list = $('.flowers-list');
	// 	list.prepend('<div class="row added-flower mt-4" data-id="' + flowerData.id + '"><div class="col-4"><img src="' + flowerData.img + '" alt="' + flowerData.name + '"></div><div class="col-8 text-left"><p class="d-inline-block mr-3">' + flowerData.name + '</p><i class="fas fa-trash-alt remove text-danger" data-id="' + flowerData.id + '"></i><div class="qty-indicators unselectable d-inline-block"><i class="fas fa-plus more"></i><input type="number" class="form-control form-control-sm d-inline" style="width: 50px"><i class="fas fa-minus less"></i></div><p class="d-inline-block">$' + flowerData.price + '.00</p><select style="border-radius: 0" class="custom-select" id="' + flowerData.id + '"><option disabled selected class="hidden-option">Choose One</option><option value="AL1">Alabama1</option><option value="AL2">Alabama2</option><option value="AL3">Alabama3</option></select></div></div>');
	// 	// colors will be added in .flower elements and got like an array, after by for or foreach will be implemented in DOM
	// 	getTotalQty();

	// 	// for colors will be cetain ajax to actionColors that will return colors of product by using id ( not good option )
	// 	// also try to use one ajax

	// 	allowNextStep();
	// });
	// $('.flowers-list').on('change', 'select', function() { 
	// 	var id = $(this).parents().closest('.added-flower').data('id');
	// 	for (var i = 0; i < selectedFlowers.length; i++) {
	// 		if (selectedFlowers[i][0] == id) {
	// 			selectedFlowers[i][5] = $(this).val();
	// 		}
	// 	}
	// });

	// $('.flowers-list').on('click', '.remove', function() { 
	// 	var parents = $(this).parents(),
	// 		parentFlower = parents.closest('.added-flower'),
	// 		id = $(this).data('id');

	// 	parentFlower.remove();
	// 	for (var i = 0; i < selectedFlowers.length; i++) {
	// 		if (selectedFlowers[i][0] == id) {
	// 			selectedFlowers.splice(i, 1);
	// 		}
	// 	}
	// 	allowNextStep();
	// 	getTotalQty();
	// });


	// // container

	// var container;

	// $('#container').on('click', 'img', function () {
	// 	container = $(this).data('id');
	// });

	// // accessories

	// accessories = {};
	// $('.parfume').on('click', 'img', function () {
	// 	accessories.parfume = $(this).data('id');
	// 	allowNextStep();
	// });
	// $('.chocolate').on('click', 'img', function () {
	// 	accessories.chocolate = $(this).data('id');
	// 	allowNextStep();
	// });

	// function allowNextStep() {
	// 	if (selectedFlowers.length) {
	// 		$('.flowers-selection').removeAttr('disabled');
	// 	} else {
	// 		$('.flowers-selection').attr('disabled', '');
	// 	}

	// 	if (accessories.parfume && accessories.chocolate) {
	// 		$('.accessories').removeAttr('disabled');
	// 	} else {
	// 		$('.accessories').attr('disabled', '');
	// 	}
	// }


	// CREATOR END

	// show positions depends from color
	function positionsByColor(currentColor) {
		var size = $('.size select').children('option:selected').val();
		$('.product__position .position').each(function (i) {
			if ($(this).data('color') == currentColor && $(this).find('img').data('size') == size) {
				$(this).show(0);
			} else {
				$(this).hide(0);
			}
		});
	}
	positionsByColor($('.active-img').data('color'));

	// product | dependence of price from size

	var sizeInfo = {},
		position = 1,
		activeSize = $('.size select').children('option:selected').val();
	setSizeInfo();

	$('#product-details').on('click', '.custom-checkbox', function () {
		setSizeInfo();
	});

	function setSizeInfo() {
		var selectedOption = $('.size select').children('option:selected'),
			height = $('.size select').next().find('.height'),
			width = $('.size select').next().find('.width'),
			size = activeSize,
			price = selectedOption.data('price'),
			vase_checkbox = $('#product-details').find('.vase:checked').val();

		if (vase_checkbox) {
			price += parseInt($('.vase-price').text());
		}

		// object with info about selected size from select tag and its price
		sizeInfo = {
			selected_size: size,
			price: price
		}

		// change currency name dependently from language
		if (window.location.href.indexOf("ru") > -1) {
			sum = 'сум';
		} else {
			sum = 'sum';
		}

		// set price
		var showPrice = priceWithSpaces(price);
		$('.product__price').text(showPrice + ' ' + sum);

		// set width and height
		height.text(selectedOption.data('height'));
		width.text(selectedOption.data('width'));

		// show images
		$('.colors .color').each(function (i) {
			if ($(this).find('img').data('size')) {
				if ($(this).find('img').data('position') == 1 && $(this).find('img').data('size') == size) {
					$(this).show();
				} else {
					$(this).hide();
				}
			} else {
				if ($(this).find('img').data('position') == 1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			}

			// show main image
			if ($('.active-img').data('color') == $(this).find('img').data('color') && $(this).find('img').data('size') == size && $(this).find('img').data('position') == 1) {
				$('.active-img').attr('src', $(this).find('img').data('src'));
			}
		});

		// show positions depend from size
		$('.product__position img').each(function (i) {
			if ($(this).data('size') == size && $(this).parent().data('color') == $('.active-img').data('color')) {
				$(this).parent().show();
				// make closed image last
				if ($(this).hasClass('closed')) {
					var itemToAppend = $(this).parent();
					$(this).parent().remove();
					$('.product__position').append(itemToAppend);
				}
			} else {
				$(this).parent().hide();
			}

			// show image of closed box
			if ($(this).hasClass('closed') && $(this).data('size') == size) {
				$(this).parent().show(0);
			}
		});

	}

	// change position
	$('.product__position').on('click', 'img', function () {
		var img = $(this),
			size = $('.size select').children('option:selected').val();

		position = $(this).data('position');

		$('.active-img').fadeOut(300, function () {
			$('.active-img').attr('src', img.data('src'));
			$('.active-img').fadeIn('slow');
			$('.active-img').data('position', position);
		});

		if (!$(this).hasClass('closed')) {
			$('.colors .color').each(function (i) {
				if ($(this).find('img').data('position') == position) {
					if ($(this).find('img').data('size')) {
						if ($(this).find('img').data('size') == activeSize) {
							$(this).show();
						} else {
							$(this).hide();
						}
					} else {
						$(this).show();
					}
				} else {
					$(this).hide();
				}
			});
		}
	});

	$('.size').on('change', 'select', function () {
		activeSize = $(this).children('option:selected').val();
		setSizeInfo();
	});


	// color
	var selectedColor,
		color = {};

	color.color = $('.active-img').data('color');

	$('.colors').on('click', 'img[data-color]', function () {
		if (!$(this).parent().data('available')) {
			return false;
		}
		var activeImg = $('.active-img'),
			selectedImg = $(this),
			name = $(this).next(),
			icon = '<i class="fas fa-check ml-2"></i>';

		// change color of positions
		positionsByColor($(this).data('color'));

		selectedColor = name;
		$('.colors .color').each(function (i) {
			$(this).find('i').remove();
			if ($(this).find('img').data('color') == selectedImg.data('color')) {
				$(this).append(icon);
			} else {
				$(this).find('i').remove();
			}
		});
		color.img = activeImg.attr('src');
		activeImg.fadeOut(100);
		activeImg.attr('src', selectedImg.data('src'));
		activeImg.data('color', selectedImg.data('color'));
		color.color = $(this).data('color');
		activeImg.fadeIn();
	});


	// product | accessories

	var accessories = {};

	$('.toggle-parfume').click(function () {
		$('.chocolate-carousel').hide(0);
		$('.parfume-carousel').fadeIn();
	});
	$('.toggle-chocolate').click(function () {
		$('.parfume-carousel').hide(0);
		$('.chocolate-carousel').fadeIn();
	});

	$('.parfume-carousel').on('click', 'img', function () {
		var id = $(this).parent().data('id');

		// replace the parfume in object
		if (accessories.hasOwnProperty('parfume')) {
			accessories.parfume = id;

			// set active dot under selected parfume
			$('.parfume-carousel').find('i').hide();
			$(this).next().show();

			// hide parfume carousel
			$('.parfume-carousel').fadeOut();
			return;
		}

		// set active dot under selected parfume
		$('.parfume-carousel').find('i').hide();
		$(this).next().show();

		// put check icon in toggle-parfume button
		var html = $('.toggle-parfume').html();
		$('.toggle-parfume').html(html + '<i class="fas fa-check ml-2"></i>');

		// set a parfume in the object
		accessories.parfume = id;

		// if chocolate was selected, dont show chocolate corousel again
		if (accessories.hasOwnProperty('chocolate')) {
			$('.parfume-carousel').hide(0);
		} else {
			$('.parfume-carousel').hide(0);
			$('.chocolate-carousel').fadeIn();
		}

		// hide cancel button
		$('.cancel-parfume').hide(0);

	});

	$('.chocolate-carousel').on('click', 'img', function () {
		var id = $(this).parent().data('id');

		// put check icon in toggle-chocolate button
		if (!accessories.hasOwnProperty('chocolate')) {
			var html = $('.toggle-chocolate').html();
			$('.toggle-chocolate').html(html + '<i class="fas fa-check ml-2"></i>');
		}

		// set active dot under selected parfume
		$('.chocolate-carousel').find('i').hide();
		$(this).next().show();

		// set a chocolate in the object
		accessories.chocolate = id;

		$('.chocolate-carousel').fadeOut();
		$('.cancel-chocolate').hide(0);
	});

	// when parfume carousel will be opened, show button to cancel
	$('.toggle-parfume').click(function () {
		if (accessories.hasOwnProperty('parfume')) {
			$('.cancel-parfume').show();
		}
		if (accessories.hasOwnProperty('chocolate')) {
			$('.cancel-chocolate').hide(0);
		}
	});
	// when chocolate carousel will be opened, show button to cancel
	$('.toggle-chocolate').click(function () {
		if (accessories.hasOwnProperty('chocolate')) {
			$('.cancel-chocolate').show();
		}
		if (accessories.hasOwnProperty('parfume')) {
			$('.cancel-parfume').hide(0);
		}
	});

	// delete parfume from array of accessories on click button "cancel parfume"
	$('.cancel-parfume').click(function () {
		delete accessories.parfume;
		$('.parfume-carousel').find('i').hide();
		$('.toggle-parfume').find('i').remove();
		$(this).hide(0);
	});
	// delete chocolate from array of accessories on click button "cancel chocolate"
	$('.cancel-chocolate').click(function () {
		delete accessories.chocolate;
		$('.chocolate-carousel').find('i').hide();
		$('.toggle-chocolate').find('i').remove();
		$(this).hide(0);
	});


	// AJAX ADD TO CART

	function showCart(cart) {
		var cartTable = $('#cart').find('table'),
			cartModal = $('#cart-modal');

		if (cartTable.length) {
			cartTable.remove();
			$('#cart').find('.table-container').html(cart);
		} else {
			$('#cart-modal .modal-body').html(cart);
			$('#cart-modal').modal();
		}

		var clear = ru ? 'Очистить <span class="hide-on-mob">корзину</span>' : 'Clear the cart',
			buttonExist = cartModal.find('.clear-cart'),
			notFound = cartModal.find('.not-found');
		if (!notFound.length && !buttonExist.length) {
			cartModal.find('.modal-footer').html('<button class="btn btn-outline-danger clear-cart">' + clear + '</button>' + cartModal.find('.modal-footer').html());
		} else if (notFound.length) {
			buttonExist.remove();
		}
	}

	$('.add-to-cart').click(function (e) {
		e.preventDefault();
		var id = $(this).data('id');

		$('.colors .color img').each(function (i) {
			if ($(this).data('position') == 1 && $(this).data('color') == color.color && $(this).data('size') == activeSize) {
				color.img = $(this).attr('src');
			}
		});

		if ($('.vase')) {
			vase = $('#product-details').find('.vase:checked').val();
		}
		var addAjaxData = {
			'accessories': accessories,
			'color': color,
			'size': sizeInfo,
			'vase': vase
		}
		if (!$.isEmptyObject(addAjaxData.color) && !$.isEmptyObject(addAjaxData.size)) {
			$.ajax({
				url: '/' + ru + 'cart/add',
				type: 'GET',
				data: {
					id: id,
					data: addAjaxData,
				},
				success: function (res) {
					if (!res) goldAlert('Error!');
					console.log(res);
					$('.cart-qty').text(parseInt($('.cart-qty').text()) + 1);
					showCart(res);
				},
				error: function (xhr) {
					console.log(xhr);
				}
			});
		} else {
			goldAlert('Please complete the form');
		}
	});

	// END AJAX ADD TO CART

	// CLEAR CART

	function clearCart() {
		if (ru) {
			msg = 'Вы уверены, что хотите очистить корзину?';
		} else {
			msg = 'Are you sure to clear the cart?';
		}
		// second true means clear a cart
		goldAlert(msg, true);
	}

	$('#cart-modal').on('click', '.clear-cart', function () {
		clearCart();
	});

	// END CLEAR CART

	// GET CART

	function getCart() {
		$.ajax({
			url: '/' + ru + 'cart/show-cart',
			type: 'GET',
			success: function (res) {
				if (!res) alert('Error');
				showCart(res);
			},
			error: function () {
				alert('Error!');
			}
		});
	}

	$('.showCart').click(function (e) {
		e.preventDefault();
		getCart();
	});

	// END GET CART


	// DELET ITEM

	$('.cart').on('click', '.del-item', function () {
		var id = $(this).data('id');
		$.ajax({
			url: '/' + ru + 'cart/del-item',
			type: 'GET',
			data: {
				id: id
			},
			success: function (res) {
				if (!res) goldAlert('Error');
				showCart(res);
				$('.cart-qty').text(parseInt($('.cart-qty').text()) - 1);
			},
			error: function () {
				goldAlert('Error!');
			}
		});
	});

	// END DEL ITEM


	// close notification

	$(window).scroll(function () {
		if ($(document).scrollTop() >= 2300) {
			$('.notifications').css('right', '0');
		}
	});

	function closeNotific() {
		var notification = $(this).parent();
		notification.css('right', '-100%');
		$('.notifications').hide();
	}

	$('.notifications').on('click', '.close', function () {
		closeNotific();
	});

	// by esc
	$(document).keyup(function (e) {
		if (e.keyCode == 27) {
			closeNotific();
		}
	});

	// close notification end


	// auto options in search

	$('.search').on('keyup', function () {
		var q = $(this).val();
		q = q.trim();
		$.ajax({
			url: '/' + ru + 'category/get-products',
			data: {
				q: q
			},
			type: 'GET',
			success: function (res) {
				if (!res) goldAlert('Error!');
				$('.auto-complete').html(res);
				if (!q) {
					$('.auto-complete').html("");
				}
			},
			error: function () {
				// goldAlert('Please try again later, search doesnt work now');
			}
		});
	});

	// custom alert

	function goldAlert(msg, clear) {
		$('#alert-modal p').text(msg);
		$('#alert-modal').modal('toggle');
		if (clear) {
			$('.ok').click(function () {
				$.ajax({
					url: '/' + ru + 'cart/clear',
					type: 'GET',
					success: function (res) {
						if (!res) goldAlert('Clear Error!');
						showCart(res);
						$('.cart-qty').text('0');
					},
					error: function () {
						goldAlert('Clear Error');
					}
				});
			});
		}
		$('#alert-modal').modal('toggle');
	}

	// GALLERY

	// make categories buttons fixed if they reach 54px
	if ($('.gallery__categories').length) {
		var eTop = $('.gallery__categories').offset().top; //get the offset top of the element
	}
	$(window).scroll(function () { //when window is scrolled
		var categoriesOffset = eTop - $(window).scrollTop();
		if ($(window).width() <= 992) {
			navHeight = 54;
		} else {
			navHeight = 45;
		}
		if (categoriesOffset <= navHeight) {
			$('.gallery__categories').css({
				'position': 'fixed',
				'top': navHeight + 'px'
			});
			$('.gallery__title').css('padding-bottom', '55px');
		} else {
			$('.gallery__categories').css({
				'position': 'static'
			});
			$('.gallery__title').css('padding-bottom', '0px');
		}
	});

	// category filter 
	var galleryImages = [];
	// add all images to array
	$('.gallery_images .item').each(function () {
		galleryImages.push($(this));
	});
	$('.gallery__categories').on('click', '.gallery__category', function () {
		var categoryId = $(this).data('id');

		$('.gallery__categories button').removeClass('btn-dark');
		$('.gallery__categories button').addClass('btn-outline-dark');
		$(this).toggleClass('btn-outline-dark');
		$(this).toggleClass('btn-dark');

		$('.gallery_images .item').each(function () {
			// search in images
			for (i = 0; i < galleryImages.length; i++) {
				if (galleryImages[i][0].attributes['data-category']['value'] == categoryId) {
					$('.gallery_images').append(galleryImages[i]);
				} else {
					$(this).remove();
				}
			}
		});
		
		for (i = 0; i < galleryImages.length; i++) {
			if (galleryImages[i][0].attributes['data-category']['value'] == categoryId) {
				$('.gallery_images').append(galleryImages[i]);
			}
		}
		
		if (!$('.gallery_images .item').length) {
			$('.gallery_images .not-found').removeClass('d-none');
		} else {
			$('.gallery_images .not-found').addClass('d-none');
		}
	});

	// show all images
	$('.gallery__show-all').click(function () {
		$('.gallery__categories button').removeClass('btn-dark');
		$('.gallery__categories button').addClass('btn-outline-dark');
		$(this).toggleClass('btn-outline-dark');
		$(this).toggleClass('btn-dark');

		for (i = 0; i < galleryImages.length; i++) {
			$('.gallery_images').append(galleryImages[i]);
		}

		if (!$('.gallery_images .item').length) {
			$('.gallery_images .not-found').removeClass('d-none');
		} else {
			$('.gallery_images .not-found').addClass('d-none');
		}
	});
	// category filter end
	// GALLERY END


	// SHOW MAP
	$('.show-on-map').click(function () {
		// MAP
		var x = document.getElementById('map');
		var coords = {
			lat: 0,
			lng: 0
		};

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
		$('.map-section').css('height', '90vh');

		function showPosition(position) {
			// create a map and marker variable
			var mymap = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18),
				marker;

			// set red icon
			var LeafIcon = L.Icon.extend({
				options: {
					shadowUrl: '',
					iconSize: [49, 64],
					shadowSize: [50, 64],
					iconAnchor: [24, 64],
					shadowAnchor: [4, 62],
					popupAnchor: [-3, -76]
				}
			});
			var redIcon = new LeafIcon({
				iconUrl: 'web/img/placeholder.svg'
			});

			// set tile
			var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			});
			OpenStreetMap_Mapnik.addTo(mymap);

			// bind click and get new coords and set a new marker
			function onMapClick(e) {
				if (marker) {
					marker.remove();
					coords.lat = 0;
					coords.lng = 0;
					marker = L.marker([e.latlng.lat, e.latlng.lng], {
						icon: redIcon
					}).addTo(mymap);
					coords.lat = e.latlng.lat;
					coords.lng = e.latlng.lng;
					$('#order-address').data('coords', coords.lat + ',' + coords.lng);
				} else {
					marker = L.marker([e.latlng.lat, e.latlng.lng], {
						icon: redIcon
					}).addTo(mymap);
					coords.lat = e.latlng.lat;
					coords.lng = e.latlng.lng;
					$('#order-address').data('coords', coords.lat + ',' + coords.lng);
				}
			}

			// call binding
			mymap.on('click', onMapClick);

			// search
			var searchControl = new L.esri.Controls.Geosearch().addTo(mymap);

			var results = new L.LayerGroup().addTo(mymap);

			searchControl.on('results', function (data) {
				results.clearLayers();
				if (marker) {
					marker.remove();
				}
				for (var i = data.results.length - 1; i >= 0; i--) {
					results.addLayer(marker = L.marker(data.results[i].latlng, {
						icon: redIcon
					}));
					coords.lat = data.results[i].latlng.lat;
					coords.lng = data.results[i].latlng.lng;
				}
			});
		}

		// MAP END
	});

	// on submit form of ordering
	$(document).on('submit', 'form#order', function () {
		if ($('#order-address').data('coords')) {
			var coords = $('#order-address').data('coords');
			$('#order-address').val($('#order-address').val() + ' | ' + coords);
		}
	});

	// SHOW MAP END


	// Get detailed description of a sub-category on category view page
	$('#cat').on('click', '.more-info-show', function() {
		// clicked to show
		if ($(this).hasClass('show')) {
			$(this).removeClass('show').addClass('hide');
			ru ? $(this).html('Скрыть информацию') : $(this).html('Hide info');
			$('.more-info p').show();
		} 
		// clicked to hide
		else if ($(this).hasClass('hide')) {
			ru ? $(this).html('Читать больше...') : $(this).html('Read more...');
			$(this).removeClass('hide').addClass('show');
			$('.more-info p').hide();
		}
		return false;
	});
	// End detailed description

});