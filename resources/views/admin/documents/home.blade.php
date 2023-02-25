@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Список документов
                    <a href="{{ route('admin.documents.create') }}" class="btn btn-success btn-sm mx-4">Добавить документ</a>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование документа</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>{{ $document->id }}</td>
                                <td>{{ $document->name }}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{ asset('storage/' . $document->path) }}" target="_blank" class="d-block w-25 text-center text-success">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.documents.edit', $document->id) }}" class="d-block w-25 text-center">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.documents.delete', $document->id) }}" method="POST" class="d-block w-25">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent">
                                                <i class="bi bi-trash text-danger" role="button"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
