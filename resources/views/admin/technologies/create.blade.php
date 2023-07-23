@extends('admin.layouts.base')

@section('contents')
    <h1>Add new Technology</h1>
    
    <form method="POST" action="{{ route('admin.technologies.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>
        
        <button class="btn btn-primary">Salva</button>
    </form>
@endsection