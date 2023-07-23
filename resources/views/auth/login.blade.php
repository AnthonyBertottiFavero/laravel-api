@extends('guest.layouts.base')

@section('contents')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" 
      class="form-control" 
      id="email" 
      aria-describedby="emailHelp" 
      name="email" 
      value="{{ old('email') }}" 
      required autofocus autocomplete="username">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" 
      class="form-control" 
      id="password" 
      name="password" 
      required autocomplete="current-password">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="remember" name="remember">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>

    <a href="{{ route('password.request') }}">
        'Forgot your password?'
    </a>

    <button type="submit" class="btn btn-primary">Log in</button>
</form>
@endsection