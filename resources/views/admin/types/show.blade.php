@extends('admin.layouts.base')

@section('contents')

    <h1>{{$type->name}}</h1>
    <p>{{$type->description}}</p>

    <h2>Portfolios with this type:</h2>
    <ul>
        @foreach ($type->portfolios as $portfolio)
            <li><a href="{{ route('admin.portfolios.show', ['portfolio' => $portfolio]) }}">{{ $portfolio->name }}</a></li>
        @endforeach
    </ul>
    
@endsection