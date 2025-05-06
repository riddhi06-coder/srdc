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
                  <h4>Edit Product Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('managing-products-details.index') }}">Product Details</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Product Details</li>
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
                        <h4>Product Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('managing-products-details.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                      <!-- Product Name -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_name">Product Name <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="product_name" name="product_name" required>
                                                <option value="">Select a Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ (old('product_name', $details->product_id) == $product->id) ? 'selected' : '' }}>
                                                        {{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a product.</div>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_image">Product Image </label>
                                            <input class="form-control" id="product_image" type="file" name="product_image" accept=".jpg, .jpeg, .png, .webp" onchange="previewBannerImage()">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp formats are allowed.</b></small>

                                            <!-- Preview Section (Moved here) -->
                                            <div id="bannerImagePreviewContainer" style="margin-top: 10px; {{ $details->images ? '' : 'display: none;' }}">
                                                <img id="banner_image_preview" src="{{ $details->images ? asset('uploads/speciality_chemicals/' . $details->images) : '' }}" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>

                                        <hr>
                                        <h4># Details Section</h4>


                                        <!-- Section Title.-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" value="{{ old('section_title', $details->section_title) }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>

                                         <!-- CAS No.-->
                                         <div class="col-md-6">
                                            <label class="form-label" for="cas_no">CAS No <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="cas_no" type="text" name="cas_no" placeholder="Enter CAS No" value="{{ old('cas_no', $details->cas_no) }}" required>
                                            <div class="invalid-feedback">Please enter a CAS No.</div>
                                        </div>


                                         <!-- MOL. Wt-->
                                         <div class="col-md-6">
                                            <label class="form-label" for="mol_wt">MOL. Wt <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="mol_wt" type="text" name="mol_wt" placeholder="Enter MOL. Wt" value="{{ old('mol_wt', $details->mol_wt) }}" required>
                                            <div class="invalid-feedback">Please enter a MOL. Wt.</div>
                                        </div>


                                        <hr>
                                        <h4># Applications Section</h4>

                                        <!-- Section Title.-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title_1">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title_1" type="text" name="section_title_1" placeholder="Enter Section Title" value="{{ old('section_title_1', $details->applications_section_title) }}" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>

                                        <!-- Banner Heading table -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Application Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $oldHeadings = old('application_name', $applicationNames);
                                                    @endphp


                                                    @foreach ($oldHeadings as $index => $heading)
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="application_name[]" class="form-control" placeholder="Enter Application Name" value="{{ $heading }}">
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

                                        <!-- Document Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_document">Upload Document</label>
                                            <input class="form-control" id="product_document" type="file" name="product_document"
                                                accept=".pdf, .csv, .jpg, .jpeg, .png, .webp" onchange="previewDocumentFile()">
                                            <div class="invalid-feedback">Please upload a valid file (max 3MB).</div>
                                            <small class="text-secondary">
                                                <b>Allowed formats: .pdf, .csv, .jpg, .jpeg, .png, .webp — Max size: 3MB.</b>
                                            </small>

                                            <!-- Preview Section -->
                                            <div id="documentPreview" style="margin-top: 10px; {{ $details->document ? '' : 'display: none;' }}">
                                                @if ($details->document)
                                                    <p><strong>File:</strong> <span id="docName">{{ $details->document }}</span></p>
                                                    <p><strong>Size:</strong> <span id="docSize">
                                                        {{-- Get file size --}}
                                                        @php
                                                            $path = public_path('uploads/speciality_chemicals/' . $details->document);
                                                            echo file_exists($path) ? round(filesize($path) / (1024 * 1024), 2) . ' MB' : '-';
                                                        @endphp
                                                    </span></p>

                                                    @if(preg_match('/\.(jpg|jpeg|png|webp)$/i', $details->document))
                                                        <img id="imagePreview"
                                                            src="{{ asset('/uploads/speciality_chemicals/documents/' . $details->document) }}"
                                                            alt="Image Preview"
                                                            style="display: block; max-width: 100%; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; padding: 5px;">
                                                    @else
                                                        <p><a href="{{ asset('/uploads/speciality_chemicals/documents/' . $details->document) }}" target="_blank">View Existing File</a></p>
                                                        <img id="imagePreview" src="" style="display: none;">
                                                    @endif
                                                @else
                                                    <p><strong>File:</strong> <span id="docName"></span></p>
                                                    <p><strong>Size:</strong> <span id="docSize"></span></p>
                                                    <img id="imagePreview" src="" style="display: none;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('managing-products-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                const file = document.getElementById('product_image').files[0];
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

        <!--Banner Heading Preview & Add More Option-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let rowIndex = 1; // Start row index for new rows

                // Add row functionality
                document.getElementById("addPrintRow").addEventListener("click", function () {
                    const tableBody = document.querySelector("#printsTable tbody");
                    const newRow = document.createElement("tr");

                    newRow.innerHTML = `
                        <td>
                            <input type="text" name="application_name[]" class="form-control" placeholder="Enter Application Name">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                    rowIndex++; // Increment row index for unique IDs
                });

                // Remove row functionality
                document.querySelector("#printsTable").addEventListener("click", function (e) {
                    if (e.target.classList.contains("removePrintRow")) {
                        const row = e.target.closest("tr");
                        row.remove();
                    }
                });
            });
        </script>


        <!--- preview for document---->
        <script>
            function previewDocumentFile() {
                const input = document.getElementById('product_document');
                const file = input.files[0];

                const preview = document.getElementById('documentPreview');
                const docName = document.getElementById('docName');
                const docSize = document.getElementById('docSize');
                const imagePreview = document.getElementById('imagePreview');

                if (file) {
                    const sizeInMB = file.size / (1024 * 1024);
                    if (sizeInMB > 3) {
                        alert("File size exceeds 3MB. Please choose a smaller file.");
                        input.value = "";
                        preview.style.display = "none";
                        imagePreview.style.display = "none";
                        return;
                    }

                    docName.textContent = file.name;
                    docSize.textContent = sizeInMB.toFixed(2) + ' MB';
                    preview.style.display = "block";

                    // Show image preview if it's an image file
                    const imageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
                    if (imageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = "block";
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.style.display = "none";
                        imagePreview.src = "";
                    }
                } else {
                    preview.style.display = "none";
                    imagePreview.style.display = "none";
                }
            }
        </script>


</body>

</html>