@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Добавление документа
                    <a href="{{ route('admin.documents.home') }}" class="btn btn-primary btn-sm mx-4">Посмотреть все</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group w-50">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Наименование документа"
                                name="name"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="text-danger">Это поле не может быть пустым</div>
                            @enderror
                        </div>
                        <div class="form-group w-50 mt-3">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_document">
                                    <label class="custom-file-label">Выберите файл</label>
                                </div>
                            </div>
                            @error('file_document')
                                <div class="text-danger">Это поле не может быть пустым</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" value="Добавить">
                        </div>
                    </form>
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
