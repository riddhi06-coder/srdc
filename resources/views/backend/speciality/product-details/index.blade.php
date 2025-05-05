<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->

    
     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <nav aria-label="breadcrumb" role="navigation">
                      <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                          <a href="{{ route('managing-products-details.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products Details</li>
                      </ol>
                    </nav>

                    <a href="{{ route('managing-products-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Products Details</a>
							    </div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index => $productDetail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $productDetail->product->product_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($productDetail->images)
                                            <img src="{{ asset('/uploads/speciality_chemicals/' . $productDetail->images) }}" alt="Product Image" style="height: 100px;">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('managing-products-details.edit', $productDetail->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('managing-products-details.destroy', $productDetail->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
        </div>
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>