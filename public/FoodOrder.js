$(document).ready(function(){

	$('#ItemSearch').change(function(){
		var sItem = $('#ItemSearch').val();
		console.log(sItem);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.post('/searchItem', {sItem:sItem}, function(response){
			var data=response;
			var catdata = '';
			// console.log(data);

			$.each(data, function(i,v){
				var name = v.name;
				var photo = v.logo;
				var routeURL="/"+"restaurantdetail/:id";

				routeURL=routeURL.replace(':id',v.id);
				console.log(routeURL);

				$('.AllMenu').hide();
		        $('.SearchMenu').show();

		        catdata += `

				    <section class="py-5 mb-5 bg-light col-12">
			          <div class="container">
			            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
			              <div class="col-lg-6">
			                <h1 class="h2 text-uppercase mb-0"> Search <small>${sItem}</small> </h1>
			              </div>
			              <div class="col-lg-6 text-lg-right">
			                <nav aria-label="breadcrumb">
			                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
			                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
			                    <li class="breadcrumb-item active" aria-current="page"> Search </li>
			                  </ol>
			                </nav>
			              </div>
			            </div>
			          </div>
			        </section>

		        	<div class="col-md-3 mb-4 mb-md-0">
				      <a class="category-item mb-4" href="${routeURL}">

				        <img class="img-fluid" src="/${photo}" alt="" style="width: 100%; height: 250px;">
				        <strong class="category-item-title">${name}</strong>
				      </a>
				    </div>
		        `;

			})

			$('.SearchMenu').html(catdata);


		})
	})

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
					var photos=JSON.parse(v.photo);
          			var photo=photos[2];
          			
          			var routeURL1= "/"+"idetail/:id";

          			var id = v.id;
          			var codeno = v.codeno;


					routeURL1=routeURL1.replace(':id',v.id);

					catdata += `
						<div class="col-lg-4 col-sm-6">
							<div class="product text-center">
			                  <div class="mb-3 position-relative">
			                    <div class="badge text-white badge-"></div><a class="d-block" href="detail.html">
			                    	<img class="img-fluid w-100" src="/${photo}" style="height:250px;"></a>
			                    <div class="product-overlay">
			                      <ul class="mb-0 list-inline">
			                        <li class="list-inline-item m-0 p-0">
			                          <a class="btn btn-sm btn-outline-dark" href="#">
			                            <i class="far fa-heart"></i>
			                          </a>
			                        </li>
			                        <li class="list-inline-item m-0 p-0">
			                          <a class="btn btn-sm btn-dark" style="color:white;" data-id="${id}" data-name="${name}" 
			                          data-price="${price}" 
			                          data-photo="${photos}" data-codeno="${codeno}">Add to cart</a>
			                        </li>
			                        <li class="list-inline-item mr-0">
			                          <a class="btn btn-sm btn-outline-dark" href="${routeURL1}">
			                            <i class="fas fa-expand"></i>
			                          </a>
			                        </li>
			                      </ul>
			                    </div>
			                  </div>
			                  <h6> <a class="reset-anchor" href="detail.html"> ${name}</a></h6>
			                  <p class="small text-muted"> ${price} Kyats </p>
			                </div>
		                </div>
					`;

					$('.CategoryMenu').html(catdata);
				})
			}
		
		})

	})

})