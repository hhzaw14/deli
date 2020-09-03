<x-backend>
	<div class="main-content">
		<div class="section__content section__content--p30">
		    <div class="container-fluid">
		    	<div class="row">
					<div class="col-md-12 mb-2">
						<div class="overview-wrap">
							<h2 class="title-1">Food Order </h2>
							<a class="au-btn au-btn-icon au-btn--blue" href="{{ route('menu.index')}}">
								<i class="zmdi zmdi-plus"></i> Back </a>
						</div>
					</div>
				</div>
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="card">
		                    <div class="card-header">
		                        <h3> Menu </h3>
		                    </div>
		                    <form action="{{ route('menu.store')}}" method="POST" class="form-horizontal"  enctype="multipart/form-data">
			                    @csrf
			                    <div class="card-body card-block">
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    Name
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" name="name" class="form-control">
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    Photo
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <div class="input-images"></div>

			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    Price
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" name="price" class="form-control">
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    Description
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <textarea class="form-control" name="description"></textarea>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    Restaurant
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <select name="restaurant_id" class="form-control col-4">
			                                    	<option> Choose Restaurant </option>
			                                    	@foreach($restaurants as $restaurant)
			                                    		<option value="{{ $restaurant->id}}"> {{ $restaurant->name }} </option>
			                                    	@endforeach
			                                    </select>
			                                </div>
			                            </div>
			                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    Category
		                                </div>
		                                <div class="col-12 col-md-9">
		                                    <select name="category_id" class="form-control col-4">
		                                    	<option> Choose Category </option>
		                                    	@foreach($categories as $category)
		                                    		<option value="{{ $category->id}}"> {{ $category->name }} </option>
		                                    	@endforeach
		                                    </select>
		                                </div>
		                            </div>
			                    </div>
			                    <div class="card-footer">
			                        <button type="submit" class="btn btn-dark btn-sm px-4 pt-2">
			                            Save
			                        </button>
			                    </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-12">
		                <div class="copyright">
		                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

@section('script_content')

    <script type="text/javascript">
        $(document).ready(function() {


            $('.input-images').imageUploader();

        });
    </script>
@endsection

</x-backend>