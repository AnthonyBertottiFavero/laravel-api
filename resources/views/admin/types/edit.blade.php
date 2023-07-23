@extends('admin.layouts.base')

@section('contents')
    <h1>Edit Type</h1>
    
    <form method="POST" action="{{ route('admin.types.update', ['type' => $type]) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', $type->name) }}"
            >
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="3"
                name="description">{{ old('description', $type->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Salva</button>
    </form>
@endsection