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
                  <h4>Add Page Details</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-career.index') }}">Page</a>
                    </li>
                    <li class="breadcrumb-item active">Add Page Details</li>
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
                        <h4>Page Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-career.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <!-- Title-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" value="{{ old('section_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>


                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description" rows="6" placeholder="Enter Description here" required >{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Please enter Description here.</div>
                                        </div>
                         

                                        <hr>
                                        <h4># Why Work</h4>
                                                                      
                                        <!-- Title-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title1">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title1" type="text" name="section_title1" placeholder="Enter Section Title" value="{{ old('section_title1') }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>


                                          <!-- Banner Details table -->
                                          <div class="table-container mb-4" style="margin-bottom: 20px;">
                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Name <span class="txt-danger">*</span></th>
                                                        <th>Image <span class="txt-danger">*</span></th>
                                                        <th>Description <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $oldEntries = old('banner_items', [['name' => '', 'description' => '']]);
                                                    @endphp

                                                    @foreach ($oldEntries as $index => $entry)
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="banner_items[{{ $index }}][name]" class="form-control" placeholder="Enter Name" value="{{ $entry['name'] ?? '' }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="banner_items[{{ $index }}][image]" class="form-control image-input" required>
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            <!-- Image Preview Element -->
                                                            <img src="#" alt="Preview" class="img-preview mt-2" style="max-width: 100px; display: none;">
                                                        </td>
                                                        <td>
                                                            <textarea name="banner_items[{{ $index }}][description]" class="form-control" placeholder="Enter Description" required>{{ $entry['description'] ?? '' }}</textarea>
                                                        </td>
                                                        <td>
                                                            @if($loop->first)
                                                                <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                            @else
                                                                <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-career.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        </script>

              
       <!--Card DEtails Preview & Add More Option-->
       <script>
         
         document.addEventListener("DOMContentLoaded", function () {
             let rowIndex = document.querySelectorAll("#printsTable tbody tr").length;

             // Add row functionality
             document.getElementById("addPrintRow").addEventListener("click", function () {
                 const tableBody = document.querySelector("#printsTable tbody");
                 const newRow = document.createElement("tr");

                 newRow.innerHTML = `
                     <td>
                         <input type="text" name="banner_items[${rowIndex}][name]" class="form-control" placeholder="Enter Name" required>
                     </td>
                     <td>
                         <input type="file" name="banner_items[${rowIndex}][image]" class="form-control image-input" required>
                         <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                         <br>
                         <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                         <!-- Image Preview Element -->
                         <img src="#" alt="Preview" class="img-preview mt-2" style="max-width: 100px; display: none;">
                     </td>
                     <td>
                         <textarea name="banner_items[${rowIndex}][description]" class="form-control" placeholder="Enter Description" required></textarea>
                     </td>
                     <td>
                         <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                     </td>
                 `;

                 tableBody.appendChild(newRow);
                 rowIndex++;
             });

             // Remove row functionality
             document.querySelector("#printsTable").addEventListener("click", function (e) {
                 if (e.target.classList.contains("removePrintRow")) {
                     e.target.closest("tr").remove();
                 }
             });

             // Image preview functionality (delegated event listener for dynamically added inputs)
             document.querySelector("#printsTable").addEventListener("change", function (e) {
                 if (e.target.classList.contains("image-input")) {
                     const row = e.target.closest("tr"); // Get the row of the file input
                     const imgPreview = row.querySelector(".img-preview"); // Get the image preview inside the same row
                     const file = e.target.files[0];
                     if (file) {
                         const reader = new FileReader();
                         reader.onload = function (e) {
                             imgPreview.src = e.target.result; // Set the image source
                             imgPreview.style.display = "block"; // Show the preview
                         };
                         reader.readAsDataURL(file);
                     } else {
                         imgPreview.src = ""; // Clear the image preview
                         imgPreview.style.display = "none"; // Hide the preview
                     }
                 }
             });
         });


        </script>


</body>

</html>