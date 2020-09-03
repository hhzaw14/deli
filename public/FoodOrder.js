$(document).ready(function(){

	$('.btnCategory').click(function(){

		var id = $(this).data('id');
		var rid = $(this).data('name');
		console.log(id, rid);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.post('/searchPost', {id:id, rid:rid}, function(response){


			var data=response;
			console.log(data);
			var catdata = '';
			if(data.length<1){
				
				$('#AllMenu').hide();
		        $('#CategoryMenu').show();
				catdata += `<div class="col-lg-12">
				 There is no items. </div>`;
				$('#CategoryMenu').html(catdata);
			}
			else{

				$.each(data, function(i,v){

					$('.AllMenu').hide();
			        $('.CategoryMenu').show();
					var name = v.name;
					var price = v.price;
					var photos = JSON.parse(v.photo);
					var photo=photos[0];

					catdata += `
						<div class="product text-center">
		                  <div class="mb-3 position-relative">
		                    <div class="badge text-white badge-"></div><a class="d-block" href="detail.html">
		                    	<img class="img-fluid w-100" src="/${photo}" style="height:150px;"></a>
		                    <div class="product-overlay">
		                      <ul class="mb-0 list-inline">
		                        <li class="list-inline-item m-0 p-0">
		                          <a class="btn btn-sm btn-outline-dark" href="#">
		                            <i class="far fa-heart"></i>
		                          </a>
		                        </li>
		                        <li class="list-inline-item m-0 p-0">
		                          <a class="btn btn-sm btn-dark" href="#">Add to cart</a>
		                        </li>
		                        <li class="list-inline-item mr-0">
		                          <a class="btn btn-sm btn-outline-dark" href="{{ route('idetail', $menu->id) }}">
		                            <i class="fas fa-expand"></i>
		                          </a>
		                        </li>
		                      </ul>
		                    </div>
		                  </div>
		                  <h6> <a class="reset-anchor" href="detail.html"> ${name}</a></h6>
		                  <p class="small text-muted"> ${price} Kyats </p>
		                </div>
					`;

					$('.CategoryMenu').html(catdata);
				})
			}
		
		})

	})
})