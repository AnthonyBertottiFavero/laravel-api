@extends('admin.layouts.base')

@section('contents')

    <h1>Portfolios</h1>

    @if (session('delete_success'))
        @php $portfolio = session('delete_success') @endphp
        <div class="alert alert-danger">
            Il portfolio "{{ $portfolio->name }}" è stato eliminato per sempre :(
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome Progetto</th>
                <th scope="col">Nome del Cliente</th>
                <th scope="col">Tipo</th>                
                <th scope="col">Tecnologia</th>                
                <th scope="col">Data Inizio Progetto</th>
                <th scope="col">Data Fine Progetto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                    <th scope="row">{{ $portfolio->id }}</th>
                    <td>{{ $portfolio->name }}</td>
                    <td>{{ $portfolio->client_name }}</td>
                    <td><a href="{{ route('admin.types.show', ['type' => $portfolio->type]) }}">{{ $portfolio->type->name }}</a></td>
                    {{-- <td>{{ implode(', ', $portfolio->technologies->pluck('name')->all()) }}</td> --}}
                    <td>
                        @foreach ($portfolio->technologies as $technology)
                            <a href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </td>
                    <td>{{ $portfolio->pickup_date}}</td>
                    <td>{{ $portfolio->deploy_date }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.portfolios.show', ['portfolio' => $portfolio]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.portfolios.edit', ['portfolio' => $portfolio]) }}">Edit</a>

                        <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $portfolio->id }}">
                            Delete
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.portfolios.destroy', ['portfolio' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{ $portfolios->links() }}

@endsection