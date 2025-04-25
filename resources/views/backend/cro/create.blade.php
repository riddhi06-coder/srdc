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
                  <h4>Add CRO Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-cro.index') }}">About</a>
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
                        <h4>CRO Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-cro.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Title-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner Title" value="{{ old('banner_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Title.</div>
                                        </div>


                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_image">Background Image <span class="txt-danger">*</span></label>
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

                                        <hr>
                                        <h4># Section 1</h4>
                                        

                                         <!-- Image Upload -->
                                         <div class="col-md-6 mb-4">
                                            <label class="form-label" for="image">Image<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewImage()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="ImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description" rows="6" placeholder="Enter Description here" required >{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Description here.</div>
                                        </div>
                         

                                        <hr>
                                        <h4># Section 2</h4>

                                        
                                        <!-- Title-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" value="{{ old('section_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>


                                        <!-- Image 2Upload -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="vision_image">Image<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="vision_image" type="file" name="vision_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewVisionImage()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section -->
                                            <div id="VisionImagePreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="vision_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="section_description">Section Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote1" class="form-control" name="section_description" rows="6" placeholder="Enter Section Description here" required >{{ old('section_description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description here.</div>
                                        </div>


                                          <!-- Description -->
                                          <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="section_description1">Section Description 2<span class="txt-danger">*</span></label>
                                            <textarea id="section_description1" class="form-control" name="section_description1" rows="6" placeholder="Enter Section Description 2 here" required >{{ old('section_description1') }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description 2 here.</div>
                                        </div>


                                        <hr>
                                        <h4># Section 3</h4>

                                              
                                        <!-- Title-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title1">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title1" type="text" name="section_title1" placeholder="Enter Section Title" value="{{ old('section_title1') }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>


                                        <!-- Image 3 Upload -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="image3">Image<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image3" type="file" name="image3" accept=".jpg, .jpeg, .png, .webp" required onchange="previewImage3()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section -->
                                            <div id="Image3PreviewContainer" style="display: none; margin-top: 10px;">
                                                <img id="image3_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                         <!-- Description -->
                                         <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="section_description2">Section Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote2" class="form-control" name="section_description2" rows="6" placeholder="Enter Section Description here" required >{{ old('section_description2') }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description here.</div>
                                        </div>


                                          <!-- Description -->
                                          <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="section_description3">Section Description 2<span class="txt-danger">*</span></label>
                                            <textarea id="section_description3" class="form-control" name="section_description3" rows="6" placeholder="Enter Section Description 2 here" required >{{ old('section_description3') }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description 2 here.</div>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('home-cro.index') }}" class="btn btn-danger px-4">Cancel</a>
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


        <script>
            $(document).ready(function() {
                $('#summernote1').summernote({
                height: 200, 
                focus: true   
                });

                $('#summernote2').summernote({
                height: 200, 
                focus: true   
                });
            });
        </script>

      
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

            function previewVisionImage() {
                const file = document.getElementById('vision_image').files[0];
                const previewContainer = document.getElementById('VisionImagePreviewContainer');
                const previewImage = document.getElementById('vision_image_preview');

                previewImage.src = '';
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewImage() {
                const file = document.getElementById('image').files[0];
                const previewContainer = document.getElementById('ImagePreviewContainer');
                const previewImage = document.getElementById('image_preview');

                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewImage.src = '';
                        previewContainer.style.display = 'none';
                    }
                }
            }

            function previewImage3() {
                const file = document.getElementById('image3').files[0];
                const previewContainer = document.getElementById('Image3PreviewContainer');
                const previewImage = document.getElementById('image3_preview');

                previewImage.src = '';
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('Please upload a valid image file (jpg, jpeg, png, webp).');
                        previewContainer.style.display = 'none';
                    }
                }
            }
        </script>


</body>

</html>