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
                            <a href="{{ route('manage-career.index') }}">Page</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Page Details</li>
                        </ol>
                        </nav>

                        <a href="{{ route('manage-career.create') }}" class="btn btn-primary px-5 radius-30">+ Add Page Details</a>
					</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->banner_title }}</td>
                                    <td>
                                        @if($data->banner_image)
                                            <img src="{{ asset('uploads/careers/' . $data->banner_image) }}" alt="Banner Image" style="max-height: 90px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Add your action buttons (Edit, Delete, etc.) -->
                                        <a href="{{ route('manage-career.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('manage-career.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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