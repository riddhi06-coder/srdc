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
                  <h4>Add Product Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-products.index') }}">Product</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Product Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <!-- Product Name-->
                                       <div class="col-md-6">
                                            <label class="form-label" for="product_name">Product Name <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="product_name" type="text" name="product_name" placeholder="Enter Product Name" value="{{ old('product_name') }}" required>
                                            <div class="invalid-feedback">Please enter a Industry Name.</div>
                                        </div>


                                        <!-- Industry Dropdown -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="industry_id">Industry <span class="txt-danger">*</span></label>
                                            <select id="industry_id" name="industry_id[]" multiple class="form-control" required>
                                                @foreach ($industry as $item)
                                                    <option value="{{ $item->id }}" {{ collect(old('industry_id'))->contains($item->id) ? 'selected' : '' }}>
                                                        {{ $item->industry_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select at least one Industry.</div>
                                        </div>

                                   
                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-products.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>
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

       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <!------For industry select 2---->
        <script>
            $(document).ready(function() {
                $('#industry_id').select2({
                    placeholder: "Select Industry",
                    allowClear: true
                });
            });
        </script>


</body>

</html>