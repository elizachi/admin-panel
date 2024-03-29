<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторы</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .title {
            text-align: center;
            font-size: 24px;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding: 10px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .form-container label {
            text-align: right;
            margin-right: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Список авторов</h1>
    </div>

    <div class="form-container">
        <form action="/authors" method="POST">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name">

            <label for="surname">Фамилия:</label>
            <input type="text" id="surname" name="surname">

            <label for="patronymic">Отчество:</label>
            <input type="text" id="patronymic" name="patronymic">

            <input type="submit" value="Добавить">
        </form>
    </div>


    {{CONTENT}}
</body>
</html>