$(document).ready(function() {
	$('#loader').fadeOut(200);
	$('body').css('opacity', '1');
	$('.owl-carousel').owlCarousel({
		lazyLoad: true,
	});
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

	$('.dropdown-menu').click(function() {
		return false;
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
			parent = parents.find('.img-preview img').first();
			
		parent.attr('src', '/img/product/' + $(this).data('image'));
	});

	// product qty

	$('.container').on('click', '.more', function() {
		var qty = $(this).next().html(),
			addedFlower = $(this).parents().closest('.added-flower');
			flowerId = addedFlower.data('id');

		qty = parseInt(qty);
		qty += 1;
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i][0] == flowerId) {
				selectedFlowers[i][4] = qty;
			}
		}
		$(this).next().html(qty);
		getTotalQty();
	});
	$('.container').on('click', '.less', function() {
		var qty = $(this).prev().html(),
			addedFlower = $(this).parents().closest('.added-flower');
			flowerId = addedFlower.data('id');

		qty = parseInt(qty);
		qty -= 1;
		for (var i = 0; i < selectedFlowers.length; i++) {
			if (selectedFlowers[i][0] == flowerId) {
				selectedFlowers[i][4] = qty;
			}
		}
		$(this).prev().html(qty);
		if ($(this).prev().html() <= 0) {
			$(this).prev().html(1);
		}
		getTotalQty();
	});

	// update total qty

	function getTotalQty() {
		var commonQty = 0;
		$('.added-flower h4').each(function(){
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
			flowerData.flowerQty   = 1;

		selectedFlowers.push(flowerData);

		var list = $('.flowers-list');
		list.prepend('<div class="row added-flower mt-4" data-id="' + flowerData.id + '"><div class="col-4"><img src="' + flowerData.img + '" alt="' + flowerData.name + '"></div><div class="col-8 text-left"><p>' + flowerData.name + '</p><div class="qty-indicators unselectable d-inline-block"><i class="fas fa-plus more"></i><h4 class="qty d-inline">' + flowerData.flowerQty + '</h4><i class="fas fa-minus less"></i></div><p class="d-inline-block mr-4 ml-3">$' + flowerData.price + '.00</p><i class="fas fa-trash-alt remove text-danger" data-id="' + flowerData.id + '"></i><select style="border-radius: 0" class="custom-select" id="' + flowerData.id + '"><option disabled selected class="hidden-option">Choose One</option><option value="AL1">Alabama1</option><option value="AL2">Alabama2</option><option value="AL3">Alabama3</option></select></div></div>');
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

	var size;

	$('.size').on('change', 'select', function () {
		size = $(this).val();
	});


	// color

	var selectedColor,
		color = {};

	$('.colors').on('click', 'img', function() {
		var activeImg = $('.active-img'),
			img 	  = $(this),
			name	  = $(this).next(),
			icon	  = '<i class="fas fa-check ml-2"></i>';

		if (selectedColor) {
			selectedColor.find('i').remove();
		}
		name.append(icon);
		selectedColor = name;
		activeImg.fadeOut(100, function(){
			activeImg.attr('src', img.attr('src'));
			// activeImg.attr('data-color', img.attr('data-color'));
			color.img = activeImg.attr('src');
		});
		color.color = img.data('color');
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
		$('#cart-modal .modal-body').html(cart);
		$('#cart-modal').modal();
	}

	$('.add-to-cart').click(function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var addAjaxData = {
			'accessories': accessories,
			'color': color,
			'size': size,
		}
		$.ajax({
			url: '/cart/add',
			data: {
				id: id,
				data: addAjaxData,
			},
			type: 'GET',
			success: function (res) {
				if (!res) alert('Error!');
				showCart(res);
				// console.log(res);
			},
			error: function () {
				alert('Error');
			}
		});
	});

	// END AJAX ADD TO CART

	// CLEAR CART

	function clearCart() {
		$.ajax({
			url: '/cart/clear',
			type: 'GET',
			success: function(res) {
				if (!res) alert('Clear Error!');
				showCart(res);
			},
			error: function() {
				alert('Clear Error');
			}
		});
	}

	$('.clear-cart').click(function(){
		clearCart();
	});

	// END CLEAR CART

	// GET CART

	function getCart() {
		$.ajax({
			url: '/cart/show-cart',
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

	$('#cart-modal').on('click', '.del-item', function () {
		var id = $(this).data('id');
		$.ajax({
			url: '/cart/del-item',
			type: 'GET',
			data: {id: id},
			success: function(res) {
				if (!res) alert('Error');
				showCart(res);
			},
			error: function() {
				alert('Error!');
			}
		});
	});

	// END DEL ITEM
	
});
