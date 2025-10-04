{{-- @extends('layouts.app')
@section('content') --}}
    <h2>Generate Url</h2>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div>{{ session('danger') }}</div>
    @endif

    <form method="POST" >@csrf
        <div>
            <label>Url</label>
            <input name="url" type="url" value="{{ old('url') }}" class="form-control">
            <p class="text-danger">{{ $errors->first('url') }}</p>
        </div>
        <div>
            <label>Title</label>
            <input name="title" value="{{ old('title') }}" class="form-control">
            <p class="text-danger">{{ $errors->first('title') }}</p>
        </div>
        <div>
            <label>Expire Date Time</label>
            <input type="datetime-local" name="expire_on" value="{{ old('expire_on') }}" class="form-control">
            <p class="text-danger">{{ $errors->first('expire_on') }}</p>
        </div>
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>
{{-- @endsection --}}
