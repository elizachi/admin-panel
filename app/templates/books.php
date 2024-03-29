<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книги</title>
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
            margin-left: auto; /* Перемещаем кнопку вправо */
        }
        .form-container {
            display: flex;
            flex-direction: column; /* Формы располагаются вертикально */
            align-items: flex-end; /* Формы выравниваются справа */
            padding: 10px;
        }
        .form-container form {
            margin-bottom: 10px; /* Добавляем отступ между формами */
        }
        .form-container label {
            text-align: right; /* Выравниваем текст метки по правому краю */
            margin-right: 10px; /* Добавляем отступ справа от метки */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Список книг</h1>
        <button>Добавить</button>
    </div>

    <div class="form-container">
        <form>
            <label for="title">Название:</label>
            <input type="text" id="title" name="title">
        </form>
        <form>
            <label for="publicationYear">Год публикации:</label>
            <input type="number" id="publicationYear" name="publicationYear">
        </form>
        <form>
            <label for="ISBN">ISBN:</label>
            <input type="text" id="ISBN" name="ISBN">
        </form>
        <form>
            <label for="pageCount">Количество страниц:</label>
            <input type="number" id="pageCount" name="pageCount">
        </form>
    </div>

    {{CONTENT}}
</body>
</html>