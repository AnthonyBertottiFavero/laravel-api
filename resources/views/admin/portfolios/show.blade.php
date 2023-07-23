@extends('admin.layouts.base')

@section('contents')
<div class="cards-container d-flex justify-content-center">
    <div class="card m-4" style="width: 25rem;">
        {{-- <img src="{{$portfolio->image}}" class="card-img-top" alt="{{$portfolio->name}}"> --}}
        @if ($portfolio->image)
          <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->name }}">
        @endif
        <div class="card-body">
          <h2>Tipo: {{$portfolio->type->name}} </h2>
          <h3>Tecnologia: {{ implode(', ', $portfolio->technologies->pluck('name')->all()) }}</h3>
          <h5 class="card-title">{{$portfolio->name}}</h5>
          <p class="card-text">{{$portfolio->description}}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Nome del cliente: {{$portfolio->client_name}}</li>
          <li class="list-group-item">Data di inizio Progetto: {{$portfolio->pickup_date}}</li>
          <li class="list-group-item">Data di consegna Progetto: {{$portfolio->deploy_date}}</li>
        </ul>
        {{-- <div class="card-body">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div> --}}
    </div>
</div>

@endsection