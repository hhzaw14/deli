<x-backend>
    <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
	                <div class="row">
						<div class="col-md-12 mb-2">
							<div class="overview-wrap">
								<h2 class="title-1">Food Order </h2>
								<a class="au-btn au-btn-icon au-btn--blue" href="{{ route('cuisine.create')}}">
									<i class="zmdi zmdi-plus"></i>Add Cuisine</a>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-light text-dark">
                                    	@php $i=1; @endphp
                                        @foreach($cuisines as $cuisine)
	                                        <tr>
	                                        	<td> {{$i++}}</td>
	                                            <td>{{ $cuisine->name }}</td>
	                                            <td class="text-center"> 
                                                    <a href="{{ route('cuisine.edit', $cuisine->id) }}">
                                                       <i class="far fa-edit px-3 py-2 bg-dark text-light"></i>
                                                    </a>
                                                    <form action="{{ route('cuisine.destroy', $cuisine->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete ?')" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">
                                                           <i class="far fa-trash-alt px-3 py-2 bg-dark text-light"></i>
                                                        </button>
                                                    </form>
                                                </td>
	                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-backend>