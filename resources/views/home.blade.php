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
                                    <td class="align-middle">{{ $file->id }}</td>
                                    <td class="align-middle">{{ $file->name }}</td>
                                    <td>
                                        <span class="mx-3">
                                            @if (isset($documentActivate[$file->id]))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                                                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                                </svg>
                                            @else
                                                <svg id="icon-to-read-file-{{ $file->id }}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg text-danger" viewBox="0 0 16 16">
                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                </svg>
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
                        <form action="{{ route('document.create.finish') }}" method="GET">
                            @csrf
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
                    data: {"user_id": "{{ auth()->id() }}", "all_docs": "1"},
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
