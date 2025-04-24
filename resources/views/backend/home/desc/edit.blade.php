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
                  <h4>Edit About Sara Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('description.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Details</li>
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
                        <h4>About Sara Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('description.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading-->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Banner Heading" value="{{ old('heading', $details->heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description" rows="5" placeholder="Enter Description here" required >{{ old('description', $details->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter Description here.</div>
                                        </div>
                         
                                        
                                        <!-- Banner Details table -->
                                        <div class="table-container mb-4" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong># About Sara Details</strong></h5>
                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Number <span class="txt-danger">*</span></th>
                                                        <th>Description <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oldEntries as $index => $entry)
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="banner_items[{{ $index }}][name]" class="form-control" placeholder="Enter Name" value="{{ $entry['name'] }}" required>
                                                        </td>
                                                        <td>
                                                            <textarea name="banner_items[{{ $index }}][description]" class="form-control" placeholder="Enter Description" required>{{ $entry['description'] }}</textarea>
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

                                        <hr>

                                        <h4># Our Advantages</h4>
                                        <br><br>
                                        <!-- Section Heading-->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading" value="{{ old('section_heading', $details->section_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="section_description">Section Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="section_description" rows="5" placeholder="Enter Section Description here" required >{{ old('section_description', $details->section_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description here.</div>
                                        </div>
                                          
                                        <!-- Advantage Details Table -->
                                        <div class="table-container mb-4" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong># Advantage Details</strong></h5>
                                            <table class="table table-bordered p-3" id="advantageTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Heading <span class="txt-danger">*</span></th>
                                                        <th>Description <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oldAdvantages as $index => $item)
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="advantage_items[{{ $index }}][id]" value="{{ $item['id'] }}">
                                                            <input type="text" name="advantage_items[{{ $index }}][name]" class="form-control" placeholder="Enter Heading" value="{{ $item['name'] }}" required>
                                                        </td>
                                                        <td>
                                                            <textarea name="advantage_items[{{ $index }}][description]" class="form-control" placeholder="Enter Description" required>{{ $item['description'] }}</textarea>
                                                        </td>
                                                        <td>
                                                            @if($loop->first)
                                                                <button type="button" class="btn btn-primary" id="addAdvantageRow">Add More</button>
                                                            @else
                                                                <button type="button" class="btn btn-danger removeAdvantageRow">Remove</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('description.index') }}" class="btn btn-danger px-4">Cancel</a>
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

        <!---- Advnatages js---->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let advantageIndex = document.querySelectorAll('#advantageTable tbody tr').length;

                // Add More Row
                document.getElementById('advantageTable').addEventListener('click', function (e) {
                    if (e.target && e.target.id === 'addAdvantageRow') {
                        e.preventDefault();

                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>
                                <input type="hidden" name="advantage_items[${advantageIndex}][id]" value="">
                                <input type="text" name="advantage_items[${advantageIndex}][name]" class="form-control" placeholder="Enter Heading" required>
                            </td>
                            <td>
                                <textarea name="advantage_items[${advantageIndex}][description]" class="form-control" placeholder="Enter Description" required></textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeAdvantageRow">Remove</button>
                            </td>
                        `;

                        document.querySelector('#advantageTable tbody').appendChild(newRow);
                        advantageIndex++;
                    }
                });

                // Remove Row
                document.getElementById('advantageTable').addEventListener('click', function (e) {
                    if (e.target && e.target.classList.contains('removeAdvantageRow')) {
                        e.preventDefault();
                        const row = e.target.closest('tr');
                        row.remove();
                        reIndexAdvantageRows();
                    }
                });

                // Re-index rows after removal
                function reIndexAdvantageRows() {
                    const rows = document.querySelectorAll('#advantageTable tbody tr');
                    advantageIndex = 0;
                    rows.forEach((row, idx) => {
                        row.querySelectorAll('input, textarea').forEach(input => {
                            input.name = input.name.replace(/advantage_items\[\d+\]/, `advantage_items[${idx}]`);
                        });
                        advantageIndex++;
                    });
                }
            });
        </script>


       
</body>

</html>