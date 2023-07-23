@extends('guest.layouts.base')

@section('contents')

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
        class="form-control" 
        id="name" 
        name="name"  
        required autofocus autocomplete="name"
        value="{{old('name')}}">
      </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" 
      class="form-control" 
      id="email" 
      aria-describedby="emailHelp" 
      name="email" 
      :value="old('email')" 
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

    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" 
        class="form-control" 
        id="password" 
        name="password_confirmation" 
        required autocomplete="current-password">
      </div>

    <a href="{{ route('login') }}">
        'Already registered?'
    </a>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
    
@endsection