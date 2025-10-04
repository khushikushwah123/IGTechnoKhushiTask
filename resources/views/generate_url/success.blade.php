@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
@if(session('danger'))
    <div>{{ session('danger') }}</div>
@endif

<h1>Url Generated Succcessfully</h1>
<p>Your Url is : <a href="{{ url('/exit-page/'.$check->base_path) }}">{{ url('/exit-page/'.$check->base_path) }}</a></p>
<p>Main Url is : {{ $check->url }}</p>
