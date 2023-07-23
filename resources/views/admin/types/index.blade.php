@extends('admin.layouts.base')

@section('contents')

    <h1>Types</h1>

    @if (session('delete_success'))
        @php $type = session('delete_success') @endphp
        <div class="alert alert-danger">
            La tipologia "{{ $type->name }}" è stata eliminata per sempre :(
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <th scope="row">{{ $type->id }}</th>
                    <td>{{ $type->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.types.show', ['type' => $type]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.types.edit', ['type' => $type]) }}">Edit</a>

                        <button 
                        type="button" 
                        class="btn btn-danger js-delete" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal" 
                        data-id="{{ $type->id }}">
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
                        data-template="{{ route('admin.types.destroy', ['type' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete-type"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection