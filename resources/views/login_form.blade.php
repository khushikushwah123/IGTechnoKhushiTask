
{{-- @extends('layouts.app')
@section('content') --}}
    <h2>Login Page</h2>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div>{{ session('danger') }}</div>
    @endif

    <form method="POST" >@csrf
        <div>
            <label>Email</label>
            <input name="email" type="email" value="{{ old('email') }}" class="form-control">
            <p class="text-danger">{{ $errors->first('email') }}</p>
        </div>
        <div>
            <label>Password</label>
            <input name="password" value="{{ old('password') }}" class="form-control">
            <p class="text-danger">{{ $errors->first('password') }}</p>
        </div>
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>
{{-- @endsection --}}
