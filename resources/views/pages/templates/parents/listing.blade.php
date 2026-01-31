<table class="table table-dark table-bordered table-striped">
    <thead>
        <tr>
            <th>Select</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Profile Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(!$parents || $parents->isEmpty())
            <tr>
                <td colspan="8">No parent available.</td>
            </tr>
        @else
            @foreach($parents as $parent)
                <tr>
                    <td><input class="delete-checkboxes" type="checkbox" name="parent_ids" value="{{ $parent->id }}"></td>
                    <td>{{ $parent->id }}</td>
                    <td>{{ $parent->full_name }}</td>
                    <td>{{ $parent->email }}</td>
                    <td>{{ Carbon\Carbon::parse($parent->birth_date)->age }} Years</td>
                    <td>
                        @if(!empty($parent->profile_image))
                            <img src="{{ asset('storage/' . $parent->profile_image) }}" alt="Profile Image" class="img-thumbnail" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td><button type="button" class="btn btn-success edit-parent" data-url="{{ route('parents.edit', $parent->id) }}">Edit</button>
                        <button type="button" class="btn btn-danger delete-parent" data-url="{{ route('parents.destroy', $parent->id) }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $parents->links() }}
</div>