@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Документы</div>

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
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->id }}</td>
                                    <td>{{ $file->name }}</td>
                                    <td>
                                        <span class="mx-3">
                                            @if (isset($documentActivate[$file->id]))
                                                <i class="bi bi-check2-square text-success"></i>
                                            @else
                                                <i id="icon-to-read-file-{{ $file->id }}" class="bi bi-x-lg text-danger"></i>
                                            @endif
                                        </span>
                                        <a href="{{ route('document.show', $file->id) }}" class="btn btn-primary" target="_blank" onclick="click_read_file({{ $file->id }});">Посмотреть</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Формирование отчета</div>

                <div class="card-body">
                    <div class="btn">
                        <form >
                            @if($user->read_all_docs == 0)
                                <button id="get-report" type="submit" class="btn btn-success" disabled>
                                    Сформировать лист
                                </button>
                            @else
                                <button id="get-report" type="submit" class="btn btn-success">
                                    Сформировать лист
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var documents = [
            @foreach($files as $file)
                {{ $file->id }},
            @endforeach
        ];

        console.log(documents)

        function click_read_file(idFile) {
            $('#icon-to-read-file-' + idFile).replaceWith('<i class="bi bi-check2-square text-success"></i>');
            deleteElementWithFiles(idFile);
        }

        function deleteElementWithFiles(idFile) {
            var index = documents.indexOf(idFile);
            documents.splice(index, 1);
            console.log(documents);

            activateBtnGetReport();
        }

        function activateBtnGetReport() {
            if (documents.length === 0) {
                $('#get-report').prop('disabled', false);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('document.set.all') }}',
                    method: 'post',
                    // dataType: 'JSON',
                    data: {"user_id": "1", "all_docs": "1"},
                    success:function(response)
                    {
                        console.log('success');
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('error');
                        console.log(response);
                    }
                });
            }
        }
    </script>
@endsection
