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
                          <a href="{{ route('manage-products.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products Details</li>
                      </ol>
                    </nav>

                    <a href="{{ route('manage-products.create') }}" class="btn btn-primary px-5 radius-30">+ Add Products</a>
							    </div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Industry</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>
                                        @php
                                            $industryIds = json_decode($product->industry_ids, true);
                                        @endphp
                                        @if (!empty($industryIds))
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($industryIds as $id)
                                                    <li>{{ $industries[$id] ?? 'N/A' }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <em>No Industry Assigned</em>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Example actions -->
                                        <a href="{{ route('manage-products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('manage-products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
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