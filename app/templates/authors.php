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
        button {
            margin-left: auto;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding: 10px;
        }
        .form-container form {
            margin-bottom: 10px;
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
        <button>Добавить</button>
    </div>

    <div class="form-container">
        <form>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name">
        </form>
        <form>
            <label for="surname">Фамилия:</label>
            <input type="text" id="surname" name="surname">
        </form>
        <form>
            <label for="patronymic">Отчество:</label>
            <input type="text" id="patronymic" name="patronymic">
        </form>
    </div>

    {{CONTENT}}
</body>
</html>