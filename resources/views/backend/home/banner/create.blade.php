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
                  <h4>Add Home Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('banner-home.index') }}">Home</a>
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
                        <h4>Home Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('banner-home.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Video Upload -->
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="banner_video">Upload Video <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_video" type="file" name="banner_video" accept="video/mp4,video/webm,video/ogg" required>
                                            <small class="text-secondary"><b>Note: Maximum file size is 6MB. Allowed formats: .mp4, .webm, .ogg</b></small>
                                            <div class="invalid-feedback">Please upload a video (Max 6MB).</div>

                                            <!-- Video Preview Container -->
                                            <div id="videoPreviewContainer" class="mt-2" style="display: none;">
                                                <label class="form-label">Preview:</label>
                                                <video id="videoPreview" autoplay muted loop controls width="100%" style="border: 1px solid #ccc; border-radius: 5px;"></video>
                                            </div>
                                        </div>
                                                                            
                                        
                                        <!-- Banner Heading table -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong>Banner Heading</strong></h5>
                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Banner Heading</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $oldHeadings = old('banner_heading', ['']);
                                                    @endphp

                                                    @foreach ($oldHeadings as $index => $heading)
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="banner_heading[]" class="form-control" placeholder="Enter Banner Heading" value="{{ $heading }}">
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
                                            <a href="{{ route('banner-home.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                            <input type="text" name="banner_heading[]" class="form-control" placeholder="Enter Banner Heading">
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


        <script>
            document.getElementById('banner_video').addEventListener('change', function () {
                const file = this.files[0];
                const previewContainer = document.getElementById('videoPreviewContainer');
                const videoElement = document.getElementById('videoPreview');

                if (file) {
                    if (file.size > 6 * 1024 * 1024) {
                        alert("File size exceeds 6MB. Please upload a smaller video.");
                        this.value = '';
                        previewContainer.style.display = 'none';
                        videoElement.src = '';
                    } else {
                        const fileURL = URL.createObjectURL(file);
                        videoElement.src = fileURL;
                        previewContainer.style.display = 'block';
                    }
                }
            });
        </script>



</body>

</html>