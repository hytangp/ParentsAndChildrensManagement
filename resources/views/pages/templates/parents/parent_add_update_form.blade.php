<form id="addUpdateParentForm" data-url="{{ isset($parent) ? route('parents.update', $parent->id) : route('parents.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($parent))
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ isset($parent) ? 'Update' : 'Add' }} Parent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body form-group">
            <div class="mb-3">
                <label for="parentFirstName" class="col-form-label">First Name:</label>
                <input name="first_name" type="text" class="form-control" value="{{ $parent->first_name ?? '' }}" id="parentFirstName" required>
            </div>
            <div class="mb-3">
                <label for="parentLastName" class="col-form-label">Last Name:</label>
                <input name="last_name" type="text" class="form-control" value="{{ $parent->last_name ?? '' }}" id="parentLastName" required>
            </div>
            <div class="mb-3">
                <label for="parentEmail" class="col-form-label">Email:</label>
                <input name="email" type="email" class="form-control" value="{{ $parent->email ?? '' }}" id="parentEmail" required>
            </div>
            <div class="mb-3">
                <label for="parentCountry" class="col-form-label">Country:</label>
                <input name="country" type="text" class="form-control" value="{{ $parent->country ?? '' }}" id="parentCountry" required>
            </div>
            <div class="mb-3">
                <label for="parentBirthDate" class="col-form-label">Birthdate:</label>
                <input name="birth_date" type="date" class="form-control" value="{{ $parent->birth_date ?? '' }}" id="parentBirthDate" required>
            </div>
            <div class="mb-3">
                <label for="parentState" class="col-form-label">State:</label>
                <select class="form-select" name="state" required>
                    <option {{ isset($parent) && $parent->state == 'Gujarat' ? 'selected' : '' }} value="Gujarat">Gujarat</option>
                    <option {{ isset($parent) && $parent->state == 'Maharashtra' ? 'selected' : '' }} value="Maharashtra">Maharashtra</option>
                    <option {{ isset($parent) && $parent->state == 'Rajasthan' ? 'selected' : '' }} value="Rajasthan">Rajasthan</option>
                    <option {{ isset($parent) && $parent->state == 'Karnataka' ? 'selected' : '' }} value="Karnataka">Karnataka</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="parentCity" class="col-form-label">City:</label>
                <select class="form-select" name="city" required>
                    <option {{ isset($parent) && $parent->city == 'Surat' ? 'selected' : '' }} value="Surat">Surat</option>
                    <option {{ isset($parent) && $parent->city == 'Mumbai' ? 'selected' : '' }} value="Mumbai">Mumbai</option>
                    <option {{ isset($parent) && $parent->city == 'Nagpur' ? 'selected' : '' }} value="Nagpur">Nagpur</option>
                    <option {{ isset($parent) && $parent->city == 'Bangalore' ? 'selected' : '' }} value="Bangalore">Bangalore</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ParentResidentProof" class="form-label">Residential Proof:</label>
                <input name="residential_proofs[]" class="form-control" type="file" id="ParentResidentProof" multiple>
                @if(!empty($parent) && !empty($parent->residential_proof))
                    @foreach (json_decode($parent->residential_proof) as $proof)
                        <img src="{{ asset('storage/' . $proof) }}" class="img-thumbnail show-uploaded-image mt-2" width="100">
                    @endforeach
                @endif
            </div>
            <div class="mb-3">
                <label for="ParentProfileImage" class="form-label">Profile Image:</label>
                <input name="profile_image" class="form-control" type="file" id="ParentProfileImage">
                @if(!empty($parent) && !empty($parent->profile_image))
                    <img src="{{ asset('storage/' . $parent->profile_image) }}" class="img-thumbnail show-uploaded-image mt-2" width="100">
                @endif
            </div>
            <div class="mb-3">
                <label for="categoryEducation" class="col-form-label">Education:</label>
                <input name="education" type="text" class="form-control" value="{{ $parent->education ?? '' }}" id="categoryEducation">
            </div>
            <div class="mb-3">
                <label for="categoryOccupation" class="col-form-label">Occupation:</label>
                <input name="occupation" type="text" class="form-control" value="{{ $parent->occupation ?? '' }}" id="categoryOccupation">
            </div>
            <div class="mb-3">
                <label for="parentChi" class="col-form-label">Childrens:</label>
                <select class="form-select" multiple name="childrens[]">
                    <option disabled>Select children(s) of the Parent</option>
                    @if(!empty($childrens))
                        @foreach ($childrens as $child)
                            <option {{ !empty($parent) && !empty($parent->childrens) && $parent->childrens->contains('children_id', $child->id) ? 'selected' : '' }} value="{{ $child->id }}">{{ $child->first_name }} {{ $child->last_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addUpdateParentBtn" class="btn btn-primary">Save changes</button>
    </div>
</form>