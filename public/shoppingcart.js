$(document).ready(function(){

	cartNoti();
	showTable();

	$('.addtocartBtn').on('click',function(){
		// alert('hi');
		var id=$(this).data('id');
		var name=$(this).data('name');
		var codeno=$(this).data('codeno');
		var photo=$(this).data('photo');
		var price=$(this).data('price');
		var qty=1;

		var mylist={id:id,codeno:codeno,name:name,photo:photo,
			price:price,qty:qty};


		// console.log(mylist);
		var cart=localStorage.getItem('cart');
		var cartArray;

		if(cart==null){
			cartArray=Array();
		}
		else{
			cartArray=JSON.parse(cart);
		}

		var status=false;

		$.each(cartArray,function(i,v){
			if(id==v.id){
				v.qty++;
				status=true;
			}


		})
		if(!status){
			cartArray.push(mylist);
		}

		var cartData=JSON.stringify(cartArray);
		localStorage.setItem("cart",cartData);

		cartNoti();
		showTable();

	})


	function cartNoti(){
		var cart=localStorage.getItem('cart');


		if(cart){

			var cartArray=JSON.parse(cart);
			var total=0;
			var noti=0;

			$.each(cartArray,function(i,v){

				var price=v.price;
				
				var qty=v.qty;

				var subtotal=price*qty;

				noti+=qty++;
				total+=subtotal ++;


			})
			$('.shoppingcartNoti').html(noti);
			$('.shoppingcartTotal').html(total+' KS ');

		}
		else{

			$('.shoppingcartNoti').html(0);
			// $('.shoppingcartTotal').html(0+' KS ');
		}
	}


	function showTable(){
		var cart=localStorage.getItem('cart');


		if(cart){

			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();

			var cartArray=JSON.parse(cart);
			var shoppingcartData='';

			if(cartArray.length>0){

				var total=0;

				$.each(cartArray,function(i,v){

					var id=v.id;
					var name=v.name;
					var codeno=v.codeno;
					var price=v.price;
					var photo=v.photo;
					var qty=v.qty;

					var subtotal=price*qty;

					shoppingcartData+=`
					<tr>
					<th class="pl-0 border-0" scope="row">
					<div class="media align-items-center"><a class="reset-anchor d-block animsition-link"><img src="${photo}" alt="..." width="70"/></a>
					<div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link">${name}</a></strong></div>
					</div>
					</th>
					<td class="align-middle border-0">
					<p class="mb-0 small">${price} Ks</p>
					</td>
					<td class="align-middle border-0">
					<div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
					<div class="quantity">
					<button class="dec-btn p-0 plus_btn" data-id=${i}><i class="fas fa-caret-left"></i></button>
					<input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" value="${qty}"/>
					<button class="inc-btn p-0 minus_btn" data-id=${i}><i class="fas fa-caret-right"></i></button>
					</div>
					</div>
					</td>
					<td class="align-middle border-0">
					<p class="mb-0 small">${subtotal}</p>
					</td>
					<td class="align-middle border-0"><a class="reset-anchor remove" data-id=${i}><i class="fas fa-trash-alt small text-muted"></i></a></td>
					</tr>
					`;



				})

				$('#shoppingcart_table').html(shoppingcartData);

			}
			else{

				$('.shoppingcart_div').hide();
				$('.noneshoppingcart_div').show();

			}

		}
		else{

		}
	


	}


	$('#shoppingcart_table').on('click','.remove',function(){
		var id=$(this).data('id');
		var cart=localStorage.getItem('cart');
		var cartArray=JSON.parse(cart);

		$.each(cartArray,function(i,v){
			
			if(i==id){
			cartArray.splice(id,1);
			}

		})

			//console.log(cartArray);
		var cartData=JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);

		showTable();
		cartNoti();


	})

	$('#shoppingcart_table').on('click','.plus_btn',function(){
		//alert("ok");
		var id=$(this).data('id');
		console.log(id);
		var cart=localStorage.getItem('cart');
		var cartArray=JSON.parse(cart);

		$.each(cartArray,function(i,v){
			
			if(i==id){
				v.qty++;
			}

		})

			//console.log(cartArray);
		var cartData=JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);

		showTable();
		cartNoti();
	})

	$('#shoppingcart_table').on('click','.minus_btn',function(){
		var id=$(this).data('id');
		//console.log(id);
		var cart=localStorage.getItem('cart');
		var cartArray=JSON.parse(cart);

		$.each(cartArray,function(i,v){
			
			if(i==id){
				v.qty--;
				if(v.qty==0){
					cartArray.splice(id,1);
				}
			}

		})

			//console.log(cartArray);
		var cartData=JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);

		showTable();
		cartNoti();
	})


	$('.checkoutBtn').click(function (){
		// alert('hi');
		var cart=localStorage.getItem('cart');
		var address=$('#address').val();
		var townshipid=$('#township').val();


		// console.log(cart);

		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').
		attr('content')
		}
		});

		$.post('/order',{data:cart,address:address,townshipid:townshipid},function(response){
			localStorage.clear();
			//location.href="ordersuccess";
		})

	})

})