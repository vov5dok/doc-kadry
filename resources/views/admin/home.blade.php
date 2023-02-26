@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Список документов</div>

                <div class="card-body">
                    <div class="list-items">
                        <ul class="list-group list-group-flush">
                            @foreach($documents as $document)
                                <li class="list-group-item">{{ $document->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.documents.home') }}" class="btn btn-primary mx-2">Посмотреть все</a>
                    <a href="{{ route('admin.documents.create') }}" class="btn btn-success mx-2">Новый документ</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Список сотрудников</div>

                <div class="card-body">
                    <div class="list-items">
                        <ul class="list-group list-group-flush">
                            @foreach($users as $user)
                                <li class="list-group-item">{{ $user->fio }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users.home') }}" class="btn btn-primary mx-2">Посмотреть все</a>
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
