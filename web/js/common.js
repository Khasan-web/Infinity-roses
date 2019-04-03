$(document).ready(function() {
	$('#loader').fadeOut(200);
	$('body').css('opacity', '1');
	$('.owl-carousel').owlCarousel({
		lazyLoad: true,
	});
});

// setting default css to nav-link | style attr doesnt work
$('nav .nav-link').css('padding', '3px 15px');

// helper about buying of a product
$('.toggle').click(function () {
	$('.helper').toggle();
});	

var ru;
if (window.location.href.indexOf("ru") > -1) {
	ru = 'ru/';
} else {
	ru = '';
}

new WOW().init();
$('#gift-finder').slider()
.on('slide', function(ev){
	$(this).parent().find('.tooltip').css('opacity', '1');
});
$('#gift-finder-page').slider()
.on('slide', function(ev){
	$(this).parent().find('.tooltip').css('opacity', '1');
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
			$('nav .nav-link').css('padding', '8px 15px');
		} else if (top < navTop){
			$('nav').css({'padding': '3px 0', 'position': 'absolute', 'top': '115px'});
			if (!$('#navbarNav').hasClass('show')) {
				$('nav').css({'background': 'transparent'});
				$('#nav-brand').css({'background': 'transparent'});
			} else {
				$('nav').css({'background': '#000'});
				$('#nav-brand').css({'background': '#000'});
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

	$('li .product-item').mouseover(function() {
		var parents = $(this).parents(),
			parent = parents.closest('.content').find('.img-preview img');
			
		parent.attr('src', $(this).data('image'));
	});

	// product qty

	var productQty = 1;
	function updateQty () {
		productQty = $('.input-qty').val();
	}

	$('.input-qty').change(function () {
		updateQty();
	});	

	$('.container').on('click', '.more', function() {
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
	$('.container').on('click', '.less', function() {
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
		$('.added-flower input').each(function(){
			commonQty += parseInt($(this).html());
		});
		$('.count').html(commonQty);
	}


	// logic for switcher

	$(".custom-switch").click(function (){
		var toggle = $(this).find('input[type="checkbox"]').attr("checked");
		if (toggle == "checked") {
			$(this).find('input[type="checkbox"]').removeAttr("checked", "checked");
		} else {
			$(this).find('input[type="checkbox"]').attr("checked", "checked");
		}
	});

	$(".custom-checkbox").click(function (){
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

	$('.drop-item').hover(function() {
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

	$('.form-order').click(function() {
		var creatorAjaxData = {};
		creatorAjaxData.flowers = selectedFlowers;
		creatorAjaxData.container = container;
		creatorAjaxData.accessories = accessories;
		// $.ajax({
		// 	url: '/creator/formalize-set',
		// 	data: {data: creatorAjaxData},
		// 	type: 'GET',
		// 	success: function (res) {
		// 		if (!res) return alert('Error');
		// 		// smth else
		// 	},
		// 	error: function () {
		// 		alert('Error');
		// 	}
		// });
		console.log(creatorAjaxData);
	});

	// end ajax add own set


	$('#container').on('click', '.container-item', function () {
		var id = $(this).find('img').data('id');
		next('container', 'accessories');
	});

	$('.chocolate').on('click', 'div', function() {
		var chocolate = $(this).find('img').data('id');
		$('.chocolate div').css('opacity', '0.4');
		$(this).css('opacity', '1');
	});	
	$('.parfume').on('click', 'div', function() {
		var parfume = $(this).find('img').data('id');
		$('.parfume div').css('opacity', '0.4');
		$(this).css('opacity', '1');
	});

	var selectedFlowers = [];

	$('#roses').on('click', '.flower', function() {
		flowerData = {};
		var flower 	   = $(this).find('img');
			flowerData.id     	   = flower.data('id');
			flowerData.name   	   = flower.data('name');
			flowerData.price  	   = flower.data('price');
			flowerData.img	   	   = flower.attr('src');
			flowerData.qty   	   = 1;
			flowerData.sum;

		selectedFlowers.push(flowerData);

		var list = $('.flowers-list');
		list.prepend('<div class="row added-flower mt-4" data-id="' + flowerData.id + '"><div class="col-4"><img src="' + flowerData.img + '" alt="' + flowerData.name + '"></div><div class="col-8 text-left"><p class="d-inline-block mr-3">' + flowerData.name + '</p><i class="fas fa-trash-alt remove text-danger" data-id="' + flowerData.id + '"></i><div class="qty-indicators unselectable d-inline-block"><i class="fas fa-plus more"></i><input type="number" class="form-control form-control-sm d-inline" style="width: 50px"><i class="fas fa-minus less"></i></div><p class="d-inline-block">$' + flowerData.price + '.00</p><select style="border-radius: 0" class="custom-select" id="' + flowerData.id + '"><option disabled selected class="hidden-option">Choose One</option><option value="AL1">Alabama1</option><option value="AL2">Alabama2</option><option value="AL3">Alabama3</option></select></div></div>');
		// colors will be added in .flower elements and got like an array, after by for or foreach will be implemented in DOM
		getTotalQty();

		// for colors will be cetain ajax to actionColors that will return colors of product by using id ( not good option )
		// also try to use one ajax

		allowNextStep();
	});
	$('.flowers-list').on('change', 'select', function() { 
		var id = $(this).parents().closest('.added-flower').data('id');
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i][0] == id) {
				selectedFlowers[i][5] = $(this).val();
			}
		}
	});

	$('.flowers-list').on('click', '.remove', function() { 
		var parents = $(this).parents(),
			parentFlower = parents.closest('.added-flower'),
			id = $(this).data('id');

		parentFlower.remove();
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i][0] == id) {
				selectedFlowers.splice(i, 1);
			}
		}
		allowNextStep();
		getTotalQty();
	});


	// container

	var container;

	$('#container').on('click', 'img', function () {
		container = $(this).data('id');
	});

	// accessories

	accessories = {};
	$('.parfume').on('click', 'img', function () {
		accessories.parfume = $(this).data('id');
		allowNextStep();
	});
	$('.chocolate').on('click', 'img', function () {
		accessories.chocolate = $(this).data('id');
		allowNextStep();
	});

	function allowNextStep() {
		if (selectedFlowers.length) {
			$('.flowers-selection').removeAttr('disabled');
		} else {
			$('.flowers-selection').attr('disabled', '');
		}

		if (accessories.parfume && accessories.chocolate) {
			$('.accessories').removeAttr('disabled');
		} else {
			$('.accessories').attr('disabled', '');
		}
	}


	// product | dependence of price from size

	var sizeInfo = {},
		position = 1;
	setSizeInfo();

	$('#product-details').on('click', '.custom-checkbox', function () {
		setSizeInfo();
	});	

	$('#product-details').find('.vase:checked').change(function () {
		alert('123');
	});

	function setSizeInfo() {
 		var selectedOption = $('.size select').children('option:selected'), 
		height = $('.size select').next().find('.height'),
		width = $('.size select').next().find('.width'),
		size = selectedOption.val(),
		price = selectedOption.data('price'),
		vase_checkbox = $('#product-details').find('.vase:checked').val();

		if (size) {
			size = size.toLowerCase();
		}

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
		if (price >= 1000000) {
			price = price / 1000000 + 'M' + ' ' + sum;
		} else {
			price = price / 1000 + 'K' + ' ' + sum;
		}
		$('.product__price').text(price);

		// set width and height
		height.text(selectedOption.data('height'));
		width.text(selectedOption.data('width'));

		// show images
		$('.colors .color').each(function (i) {
			if ($(this).find('img').data('position') == position && $(this).find('img').data('size') == size) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});

		$('.product__position img').each(function (i) {
			// if ($(this).hasClass('active-img__image')) {
			// 	$('.active-img').attr('src', $(this).data('src'))
			// }
			if ($(this).data('size') == size) {
				$(this).parent().show();
				if ($(this).hasClass('closed')) {
					var itemToAppend = $(this).parent();
					$(this).parent().remove();
					$('.product__position').append(itemToAppend);
				}
			} else {
				$(this).parent().hide();
			}
		});
		
	}

	$('.product__position').on('click', 'img', function () {
		var img = $(this),
			size = $('.size select').children('option:selected').val();

		position = $(this).data('position');
		size = size.toLowerCase();

		$('.active-img').fadeOut(300, function(){
			$('.active-img').attr('src', img.data('src'));
			$('.active-img').fadeIn('slow');
			$('.active-img').data('position', position);
		});

		$('.colors .color').each(function (i) {
			if ($(this).find('img').data('position') == position && $(this).find('img').data('size') == size) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});

	$('.size').on('change', 'select', function () {
		setSizeInfo();
	});


	// color
	var selectedColor,
		color = {};

	color.color = $('.active-img').data('color');

	$('.colors').on('click', 'img[data-color]', function() {
		var activeImg = $('.active-img'),
			selectedImg = $(this),
			name	  = $(this).next(),
			icon	  = '<i class="fas fa-check ml-2"></i>';

		if (selectedColor) {
			selectedColor.find('i').remove();
		}
		name.append(icon);
		selectedColor = name;
		activeImg.fadeOut(100, function(){
			activeImg.attr('src', selectedImg.data('src'));
			activeImg.data('color', selectedImg.data('color'));
			color.img = activeImg.attr('src');
		});
		color.color = $(this).data('color');
		activeImg.fadeIn();
	});

	
	// product | accessories

	var accessories = {};

	$('.toggle-parfume').click(function(){
		$('.chocolate-carousel').hide(0);
		$('.parfume-carousel').fadeIn();
	});
	$('.toggle-chocolate').click(function(){
		$('.parfume-carousel').hide(0);
		$('.chocolate-carousel').fadeIn();
	});

	$('.parfume-carousel').on('click', 'img', function () {
		var id = $(this).parent().data('id');
		if (accessories.hasOwnProperty('parfume')) {
			$('.parfume-carousel').fadeOut();
			accessories.parfume = id;
			return;
		}
		var html = $('.toggle-parfume').html();
		$('.toggle-parfume').html(html + '<i class="fas fa-check ml-2"></i>');
		accessories.parfume = id;
		if (accessories.hasOwnProperty('chocolate')) {
			$('.parfume-carousel').hide(0);
		} else {
			$('.parfume-carousel').hide(0);
			$('.chocolate-carousel').fadeIn();
		}
	});

	$('.chocolate-carousel').on('click', 'img', function () {
		var id = $(this).parent().data('id');
		if (accessories.hasOwnProperty('parfume')) {
			$('.chocolate-carousel').fadeOut();
		} else {
			$('.chocolate-carousel').hide(0);
			$('.parfume-carousel').fadeIn();
		}
		if (!accessories.hasOwnProperty('chocolate')) {
			var html = $('.toggle-chocolate').html();
			$('.toggle-chocolate').html(html + '<i class="fas fa-check ml-2"></i>');
		}
		accessories.chocolate = id;
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

		var clear = ru ? 'Очистить корзину' : 'Clear the cart',
		buttonExist = cartModal.find('.clear-cart'),
		notFound = cartModal.find('.not-found');
		if (!notFound.length && !buttonExist.length) {
			cartModal.find('.modal-footer').html('<button class="btn btn-outline-danger clear-cart">' + clear + '</button>' + cartModal.find('.modal-footer').html());
		} else if(notFound.length) {
			buttonExist.remove();
		}
	}

	$('.add-to-cart').click(function(e) {
		e.preventDefault();
		var id = $(this).data('id');

		$('.colors .color img').each(function (i) {
			if ($(this).data('position') == 1 && $(this).data('color') == color.color) {
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

	$('#cart-modal').on('click', '.clear-cart', function(){
		clearCart();
	});

	// END CLEAR CART

	// GET CART

	function getCart() {
		$.ajax({
			url: '/' + ru + 'cart/show-cart',
			type: 'GET',
			success: function(res) {
				if (!res) alert('Error');
				showCart(res);
			},
			error: function() {
				alert('Error!');
			}
		});
	}

	$('.showCart').click(function(e){
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
			data: {id: id},
			success: function(res) {
				if (!res) goldAlert('Error');
				showCart(res);
			},
			error: function() {
				goldAlert('Error!');
			}
		});
	});

	// END DEL ITEM


	// close notification

	$(window).scroll(function() {
		if ($(document).scrollTop() >= 2300) {
			$('.notifications').css('right', '0');
		}
	});

	$('.notifications').on('click', '.close', function () {
		var notification = $(this).parent();
		notification.css('right', '-100%');
		$('.notifications').hide();
	});


	// auto options in search

	$('.search').on('keyup', function () {
		var q = $(this).val();
		q = q.trim();
		$.ajax({
			url: '/' + ru + 'category/get-products',
			data: {q: q},
			type: 'GET',
			success: function (res) {
				if (!res) goldAlert('Error!');
				$('.auto-complete').html(res);
				if (!q) {
					$('.auto-complete').html("");
				}
			},
			error: function () {
				goldAlert ('Error');
			}
		});
	});

	$('.closed').on('click', function () {
		var img = $(this);
		$('.active-img').fadeOut(300, function(){
			$('.active-img').attr('src', img.data('src'));
			$('.active-img').fadeIn('slow');
		});
		return false;
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
					success: function(res) {
						if (!res) goldAlert('Clear Error!');
						showCart(res);
					},
					error: function() {
						goldAlert('Clear Error');
					}
				});
			});
		}
		$('#alert-modal').modal('toggle');
	}
	
});
