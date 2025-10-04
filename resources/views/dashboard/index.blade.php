
 @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div>{{ session('danger') }}</div>
    @endif
<h1>Generated Urls by User</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Base Path</th>
            <th>Main Url</th>
            <th>Expire On</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($urls) > 0)
            @foreach($urls as $row)
                <tr>
                    <td>{{ $row->title }}</td>
                    <td><a href="{{ url('/exit-page/'.$row->base_path) }}" target="_blank">{{ url('/exit-page/'.$row->base_path) }}</a></td>
                    <td>{{ $row->url }}</td>
                    <td>{{ $row->expiration }}</td>
                    <td>
                        <a href="{{ route('dashboard.show',base64_encode($row->id)) }}">View</a> |
                        <a href="{{ route('dashboard.edit',base64_encode($row->id)) }}">Edit</a> |
                        <a href="{{ route('dashboard.delete',base64_encode($row->id)) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
                <p>No Data found</p>
        @endif
    </tbody>
</table>
