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
                  <h4>Add R&D Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-rnd.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Details</li>
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
                        <h4>R&D Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-rnd.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Banner Heading-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Banner Heading" value="{{ old('heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_image">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewBannerImage()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="bannerImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="banner_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>
                                                

                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description" rows="5" placeholder="Enter Description here" required >{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Description here.</div>
                                        </div>

                                        <hr>
                                        <h5 class="mb-4"><strong># Infra & Capacity</strong></h5>


                                        <!-- Banner Heading-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="infra_heading">Infra Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="infra_heading" type="text" name="infra_heading" placeholder="Enter Infra Heading" value="{{ old('infra_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Infra Heading.</div>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="infra_image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="infra_image" type="file" name="infra_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewinfraImage()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="infraImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="infra_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>
                                                

                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="infra_description">Infra Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote1" class="form-control" name="infra_description" rows="5" placeholder="Enter Infra Description here" required >{{ old('infra_description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Infra Description here.</div>
                                        </div>


                                        <hr>
                                        <h5 class="mb-4"><strong># Innovation</strong></h5>


                                        <!-- Banner Heading-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="innovation_heading">Innovation Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="innovation_heading" type="text" name="innovation_heading" placeholder="Enter Innovation Heading" value="{{ old('innovation_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Innovation Heading.</div>
                                        </div>


                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="innovation_image_1">Innovation Image 1<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="innovation_image_1" type="file" name="innovation_image_1" accept=".jpg, .jpeg, .png, .webp" required onchange="previewinnovation1Image()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="innovation_1ImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="innovation_1_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>
                                                

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="innovation_image_2">Innovation Image 2 <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="innovation_image_2" type="file" name="innovation_image_2" accept=".jpg, .jpeg, .png, .webp" required onchange="previewinnovation2Image()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="innovation_2ImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="innovation_2_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>
                                                

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="innovation_image_3">Innovation Image 3<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="innovation_image_3" type="file" name="innovation_image_3" accept=".jpg, .jpeg, .png, .webp" required onchange="previewinnovation3Image()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="innovation_3ImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="innovation_3_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>
                                                

                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="innovation_description">Innovation Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote2" class="form-control" name="innovation_description" rows="5" placeholder="Enter Innovation Description here" required >{{ old('innovation_description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Innovation Description here.</div>
                                        </div>

                                     
                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('home-rnd.index') }}" class="btn btn-danger px-4">Cancel</a>
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


      
        <!--Card DEtails Preview & Add More Option-->
        <script>
            function previewBannerImage() {
                const file = document.getElementById('banner_image').files[0];
                const previewContainer = document.getElementById('bannerImagePreviewContainer');
                const previewImage = document.getElementById('banner_image_preview');

                // Clear the previous preview
                previewImage.src = '';
                
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Display the image preview
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';  // Show the preview section
                        };

                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewinfraImage() {
                const file = document.getElementById('infra_image').files[0];
                const previewContainer = document.getElementById('infraImagePreviewContainer');
                const previewImage = document.getElementById('infra_image_preview');

                // Clear the previous preview
                previewImage.src = '';
                
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Display the image preview
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';  // Show the preview section
                        };

                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewinnovation1Image() {
                const file = document.getElementById('innovation_image_1').files[0];
                const previewContainer = document.getElementById('innovation_1ImagePreviewContainer');
                const previewImage = document.getElementById('innovation_1_image_preview');

                // Clear the previous preview
                previewImage.src = '';
                
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Display the image preview
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';  // Show the preview section
                        };

                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewinnovation2Image() {
                const file = document.getElementById('innovation_image_2').files[0];
                const previewContainer = document.getElementById('innovation_2ImagePreviewContainer');
                const previewImage = document.getElementById('innovation_2_image_preview');

                // Clear the previous preview
                previewImage.src = '';
                
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Display the image preview
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';  // Show the preview section
                        };

                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewinnovation3Image() {
                const file = document.getElementById('innovation_image_3').files[0];
                const previewContainer = document.getElementById('innovation_3ImagePreviewContainer');
                const previewImage = document.getElementById('innovation_3_image_preview');

                // Clear the previous preview
                previewImage.src = '';
                
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Display the image preview
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';  // Show the preview section
                        };

                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }
            
        </script>

        <script>
            $(document).ready(function() {
                $('#summernote1').summernote({
                height: 200, 
                focus: true  
                });
            });

            $(document).ready(function() {
                $('#summernote2').summernote({
                height: 200, 
                focus: true  
                });
            });
        </script>

       
</body>

</html>