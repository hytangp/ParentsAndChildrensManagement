<form id="addUpdateChildrenForm" data-url="{{ isset($children) ? route('childrens.update', $children->id) : route('childrens.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($children))
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ isset($children) ? 'Update' : 'Add' }} Children</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body form-group">
            <div class="mb-3">
                <label for="childrenFirstName" class="col-form-label">First Name:</label>
                <input name="first_name" type="text" class="form-control" value="{{ $children->first_name ?? '' }}" id="childrenFirstName" required>
            </div>
            <div class="mb-3">
                <label for="childrenLastName" class="col-form-label">Last Name:</label>
                <input name="last_name" type="text" class="form-control" value="{{ $children->last_name ?? '' }}" id="childrenLastName" required>
            </div>
            <div class="mb-3">
                <label for="childrenEmail" class="col-form-label">Email:</label>
                <input name="email" type="email" class="form-control" value="{{ $children->email ?? '' }}" id="childrenEmail" required>
            </div>
            <div class="mb-3">
                <label for="childrenCountry" class="col-form-label">Country:</label>
                <input name="country" type="text" class="form-control" value="{{ $children->country ?? '' }}" id="childrenCountry" required>
            </div>
            <div class="mb-3">
                <label for="childrenBirthDate" class="col-form-label">Birthdate:</label>
                <input name="birth_date" type="date" class="form-control" value="{{ $children->birth_date ?? '' }}" id="childrenBirthDate" required>
            </div>
            <div class="mb-3">
                <label for="childrenState" class="col-form-label">State:</label>
                <select class="form-select" name="state" required>
                    <option {{ isset($children) && $children->state == 'Gujarat' ? 'selected' : '' }} value="Gujarat">Gujarat</option>
                    <option {{ isset($children) && $children->state == 'Maharashtra' ? 'selected' : '' }} value="Maharashtra">Maharashtra</option>
                    <option {{ isset($children) && $children->state == 'Rajasthan' ? 'selected' : '' }} value="Rajasthan">Rajasthan</option>
                    <option {{ isset($children) && $children->state == 'Karnataka' ? 'selected' : '' }} value="Karnataka">Karnataka</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="childrenCity" class="col-form-label">City:</label>
                <select class="form-select" name="city" required>
                    <option {{ isset($children) && $children->city == 'Surat' ? 'selected' : '' }} value="Surat">Surat</option>
                    <option {{ isset($children) && $children->city == 'Mumbai' ? 'selected' : '' }} value="Mumbai">Mumbai</option>
                    <option {{ isset($children) && $children->city == 'Nagpur' ? 'selected' : '' }} value="Nagpur">Nagpur</option>
                    <option {{ isset($children) && $children->city == 'Bangalore' ? 'selected' : '' }} value="Bangalore">Bangalore</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ChildrenBirthCertificate" class="form-label">Birth Certificate:</label>
                <input name="birth_certificate" class="form-control" type="file" id="ChildrenBirthCertificate">
                @if(!empty($children) && !empty($children->birth_certificate))
                    <img src="{{ asset('storage/' . $children->birth_certificate) }}" class="img-thumbnail show-uploaded-image mt-2" width="100">
                @endif
            </div>
            <div class="mb-3">
                <label for="parentChi" class="col-form-label">Parents:</label>
                <select class="form-select" multiple name="parents[]">
                    <option disabled>Select parent(s) for the Children</option>
                    @if(!empty($parents))
                        @foreach ($parents as $parent)
                            <option {{ !empty($children) && !empty($children->parents) && $children->parents->contains('parent_id', $parent->id) ? 'selected' : '' }} value="{{ $parent->id }}">{{ $parent->full_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addUpdateChildrenBtn" class="btn btn-primary">Save changes</button>
    </div>
</form>