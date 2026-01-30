<table class="table table-dark table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Birth Certificate</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(!$childrens || $childrens->isEmpty())
            <tr>
                <td colspan="7">No children available.</td>
            </tr>
        @else
            @foreach($childrens as $children)
                <tr>
                    <td>{{ $children->id }}</td>
                    <td>{{ $children->first_name }} {{ $children->last_name }}</td>
                    <td>{{ $children->email }}</td>
                    <td>{{ Carbon\Carbon::parse($children->birth_date)->age }} Years</td>
                    <td>
                        @if(!empty($children->birth_certificate))
                            <img src="{{ asset('storage/' . $children->birth_certificate) }}" alt="Birth Certificate" class="img-thumbnail" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td><button type="button" class="btn btn-success edit-children" data-url="{{ route('childrens.edit', $children->id) }}">Edit</button>
                        <button type="button" class="btn btn-danger delete-children" data-url="{{ route('childrens.destroy', $children->id) }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>