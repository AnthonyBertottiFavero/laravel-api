@extends('admin.layouts.base')

@section('contents')
    <h1>Add new Post</h1>
    
    <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" novalidate>
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

        <div class="mb-3">
            <label for="client_name" class="form-label">Nome Cliente</label>
            <input
                type="text"
                class="form-control @error('client_name') is-invalid @enderror"
                id="client_name"
                name="client_name"
                value="{{ old('client_name') }}"
            >
            @error('client_name')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <label class="input-group-text  @error('image') is-invalid @enderror" for="image">Upload</label>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Tipo</label>

            <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example" id="type" name="type_id">
                <option selected value="0">Seleziona una categoria</option>
                @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <h3>Technologia</h3>

            @foreach ($technologies as $technology)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]"  @if (in_array($technology->id, old('technologies', [])))
                    checked  
                @endif >
                <label class="form-check-label" for="flexCheckDefault">
                  {{$technology->name}}
                </label>
            </div>
            @endforeach
            
        </div>

        <div class="mb-3">
            <label for="url_image" class="form-label">Immagine</label>
            <input
                type="text"
                class="form-control @error('url_image') is-invalid @enderror"
                id="url_image"
                name="url_image"
                value="{{ old('url_image') }}"
            >
            @error('url_image')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pickup_date" class="form-label">Data inizio progetto</label>
            <input
                type="date"
                class="form-control @error('pickup_date') is-invalid @enderror"
                id="pickup_date"
                name="pickup_date"
                value="{{ old('pickup_date') }}"
            >
            @error('pickup_date')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deploy_date" class="form-label">Data consegna progetto</label>
            <input
                type="date"
                class="form-control @error('deploy_date') is-invalid @enderror"
                id="deploy_date"
                name="deploy_date"
                value="{{ old('deploy_date') }}"
            >
            @error('deploy_date')
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
                name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Salva</button>
    </form>
@endsection