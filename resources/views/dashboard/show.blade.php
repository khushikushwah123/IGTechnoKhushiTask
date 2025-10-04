<h1>Show Page of Generated Url</h1>
<h3>Title : {{ $urls->title }}</h3>
<h3>Base Path : <a href="{{ url('/exit-page/'.$urls->base_path) }}">{{ url('/exit-page/'.$urls->base_path) }}</a></h3>
<h3>Main Url : {{ $urls->url }}</h3>
<h3>Expire On : {{ $urls->expiration }}</h3>

<h2>Clicks On</h2>
<table>
    <thead>
        <tr>
            <th>IP</th>
        </tr>
    </thead>
    <tbody>
        @if(count($on_click) > 0)
            @foreach($on_click as $row)
                <tr>
                    <td>{{ $row->ip }}</td>
                </tr>
            @endforeach
        @else
                <p>No Data found</p>
        @endif
    </tbody>
</table>
