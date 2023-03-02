<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Подписание документов</title>

</head>
<body>

<style>
    body { font-family: DejaVu Sans, sans-serif; }
    .table {
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #dddddd;
        border-collapse: collapse;
    }
    .table th {
        font-weight: bold;
        padding: 5px;
        background: #efefef;
        border: 1px solid #dddddd;
    }
    .table td {
        border: 1px solid #dddddd;
        padding: 5px;
    }
    .text-center {
        text-align: center;
    }
    .text-fs-22 {
        font-size: 22px;
    }
    .text-fs-18 {
        font-size: 18px;
    }
    .text-lh-025 {
        line-height: 0.25;
    }
</style>

<div id="app">
    <div class="container">
        <p class="text-center text-fs-22 text-lh-025">Лист ознакомления</p>
        <p class="text-center text-fs-18 text-lh-025">с локально нормативными актами</p>
        <p class="text-center text-fs-18 text-lh-025">Сотрудник: {{ $user->fio }}</p>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Наименование документа</th>
                <th scope="col">Дата</th>
                <th scope="col">Подпись</th>
            </tr>
            </thead>
            <tbody>
            @foreach($docs as $doc)
                <tr>
                    <td>{{ $doc->name }}</td>
                    <td>{{ $doc->created_at->format('d.m.Y') }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
