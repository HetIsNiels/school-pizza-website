var orderOffset = 0;
var cart = [];
var orderLocation = null;

window.addEventListener('load', function() {
	var horizonScrollers = document.getElementsByClassName('horizontal-scroll');

	for(var i = 0; i < horizonScrollers.length; i++){
		var elm = horizonScrollers.item(i);

		elm.addEventListener('mousewheel', horizontalScroll);
		elm.addEventListener('DOMMouseScroll', horizontalScroll);
	}

	if(document.getElementById('order-fixed-scroll') == undefined)
		return;

	orderOffset = document.getElementById('order-fixed-scroll').getBoundingClientRect().top + document.body.scrollTop;

	window.addEventListener('scroll', function () {
		document.getElementById('order-fixed-scroll').style.top = (document.body.scrollTop - orderOffset) + 'px';
		document.getElementById('order-fixed-scroll').style.position = document.body.scrollTop < orderOffset ? 'static' : 'absolute';
	});

	window.addEventListener('click', function(event){
		if(event.target.dataset['cartAction'] == undefined)
			return;

		switch(event.target.dataset['cartAction'].toLowerCase()){
			case 'add':
				addToCart(event.target.dataset['cartName'], event.target.dataset['cartPrice'], event.target.dataset['cartType']);
				break;

			case 'order':
				order();
				break;

			default:
				alert('Unknown action');
				break;
		}
	});

	document.getElementById('cart-select-location').addEventListener('change', function(event){
		orderLocation = event.target.value;
		document.getElementById('cart-order-button').removeAttribute('disabled');
	});

	updateCart();
});

function horizontalScroll(event) {
	var elm = event.target;

	while(!elm.classList.contains('horizontal-scroll'))
		elm = elm.parentNode;

	var delta = Math.max(-1, Math.min(1, (event.wheelDelta || -event.detail)));
	elm.scrollLeft -= (delta * 40);
	event.preventDefault();
}

function addToCart(name, price, type){
	if(cart.length == 50){
		var q = document.querySelectorAll('button[data-cart-action=add]');

		for(var i = 0; i < q.length; i++){
			q.item(i).setAttribute('disabled', 'disabled');
			q.item(i).setAttribute('title', 'Je kan niet meer producten bestellen.');
		}
	}else if(cart.length >= 60)
		return;

	var item = {
		'name': name,
		'price': parseFloat(price),
		'type': type
	};

	cart.push(item);
	updateCart();
}

function calculateDiscount(price, products){
	var d = 0;
	var discount = 0;

	for(var i in products){
		var product = products[i];

		if(product.type == 'pizza'){
			d++;

			if(d == 2){
				d = 0;
				discount += 0.5 * product.price;
			}
		}
	}

	return discount;
}

function updateCart(){
	var price = 0;

	var html = '<h1>Mijn bestelling</h1>';
	html += '<div class="order-products"><div class="start">';

	for(var i in cart){
		price += cart[i].price;

		html += '<div class="product"><strong>' + cart[i].name + '</strong><em>&euro;' + cart[i].price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</em></div>';
	}

	if(cart.length == 0)
		html += 'Je bestelling is nog leeg!';

	var discount = calculateDiscount(price, cart);

	html += '</div><div class="end">';

	if(discount > 0)
		html += '<div class="product"><strong>Korting</strong><em>&euro;' + discount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</em></div>';

	price -= discount;

	html += '<div class="product"><strong>Totaal</strong><em>&euro;' + price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</em></div>';

	html += '</div></div>';

	document.getElementById('cart').innerHTML = html;
}

function order(){
	var data = {
		'cart': cart,
		'location': orderLocation,
		'mail': prompt('Wat is uw e-mail?', '')
	};

	data = JSON.stringify(data);
	document.cookie = 'cartData=' + data;
	window.location = 'processOrder.php';
}