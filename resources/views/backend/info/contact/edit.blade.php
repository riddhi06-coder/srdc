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
                  <h4>Edit Contact Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-contact.index') }}">Contact Details</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Contact Details</li>
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
                        <h4>Contact Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-contact.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Address.-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="address">Address <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="address" type="text" name="address" placeholder="Enter Address" value="{{ old('address', $details->address) }}" required>
                                            <div class="invalid-feedback">Please enter a Address.</div>
                                        </div>

                                         <!-- Location.-->
                                         <div class="col-md-6">
                                            <label class="form-label" for="location">Location URL<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="location" type="text" name="location" placeholder="Enter Location URL" value="{{ old('location', $details->location) }}" required>
                                            <div class="invalid-feedback">Please enter a Location URL.</div>
                                        </div>

                                        <!-- Email-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="email">Email </label>
                                            <input class="form-control" id="email" type="text" name="email" placeholder="Enter Email" value="{{ old('email', $details->email) }}">
                                            <div class="invalid-feedback">Please enter a Email</div>
                                        </div>


                                        <!-- Contact No.-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact">Contact No.</label>
                                            <input class="form-control" id="contact" type="text" name="contact" placeholder="Enter Contact No." value="{{ old('contact', $details->contact) }}">
                                            <div class="invalid-feedback">Please enter a Contact No..</div>
                                        </div>

                                        <!-- Map.-->
                                        <div class="col-md-6">
                                            <label class="form-label" for="map">Map URL<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="map" type="text" name="map" placeholder="Enter Map URL" value="{{ old('map', $details->map) }}" required>
                                            <div class="invalid-feedback">Please enter a Map URL.</div>
                                        </div>


                                        <!-- Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="company_description">Company Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="company_description" rows="6" placeholder="Enter Company Description here" required >{{ old('company_description', $details->company_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter Company Description here.</div>
                                        </div>

                                        <hr>
                                        <h4># Social Media</h4>
                             
                                        <!-- Social Media Links Table -->
                                        <div class="col-12">
                                            <table class="table table-bordered p-3" id="socialMediaTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Social Media Platform <span class="txt-danger">*</span></th>
                                                        <th>URL <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                               
                                                @php
                                                    $platforms = json_decode($details->platforms, true);
                                                    $urls = json_decode($details->social_urls, true);
                                                @endphp

                                                <tbody>
                                                    @if(!empty($platforms) && !empty($urls))
                                                        @foreach($platforms as $index => $platform)
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control" name="social_media_platform[]" required>
                                                                        <option value="">Select Platform</option>
                                                                        @foreach(['Facebook','Twitter','Instagram','LinkedIn','Youtube','Watsapp','Pinterest'] as $option)
                                                                            <option value="{{ $option }}" {{ $platform == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="url" name="social_media_url[]" value="{{ $urls[$index] ?? '' }}" placeholder="Enter URL" required>
                                                                </td>
                                                                <td>
                                                                    @if($index == 0)
                                                                        <button type="button" class="btn btn-success add-row">Add Row</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        {{-- Fallback row if no data exists --}}
                                                        <tr>
                                                            <td>
                                                                <select class="form-control" name="social_media_platform[]" required>
                                                                    <option value="">Select Platform</option>
                                                                    <option value="Facebook">Facebook</option>
                                                                    <option value="Twitter">Twitter</option>
                                                                    <option value="Instagram">Instagram</option>
                                                                    <option value="LinkedIn">LinkedIn</option>
                                                                    <option value="Youtube">YouTube</option>
                                                                    <option value="Watsapp">Watsapp</option>
                                                                    <option value="Pinterest">Pinterest</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="url" name="social_media_url[]" placeholder="Enter URL" required>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-success add-row">Add Row</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-contact.index') }}" class="btn btn-danger px-4">Cancel</a>
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

        <!-- JavaScript to add rows dynamically -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tableBody = document.querySelector('#socialMediaTable tbody');

                // Add Row Logic
                document.querySelector('.add-row').addEventListener('click', function () {
                    const newRow = document.createElement('tr');

                    newRow.innerHTML = `
                        <td>
                            <select class="form-control" name="social_media_platform[]" required>
                                <option value="">Select Platform</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Instagram">Instagram</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Youtube">YouTube</option>
                                <option value="Watsapp">Watsapp</option>
                                <option value="Pinterest">Pinterest</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control" type="url" name="social_media_url[]" placeholder="Enter URL" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                });

                // ✅ Event Delegation for Remove Buttons (both initial and added later)
                tableBody.addEventListener('click', function (e) {
                    if (e.target && e.target.classList.contains('remove-row')) {
                        e.target.closest('tr').remove();
                    }
                });
            });
        </script>


</body>

</html>