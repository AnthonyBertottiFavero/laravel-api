@extends('admin.layouts.base')

@section('contents')

    <h1>{{$technology->name}}</h1>

    <h2>Portfolios with this technology:</h2>
    <ul>
        @foreach ($technology->portfolios as $portfolio)
            <li><a href="{{ route('admin.portfolios.show', ['portfolio' => $portfolio]) }}">{{ $portfolio->name }}</a></li>
        @endforeach
    </ul>
    
@endsection