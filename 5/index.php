<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кінотека — AJAX</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7; max-width: 800px; }
        table { border-collapse: collapse; width: 100%; background: #fff; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #333; color: #fff; }
        #search { padding: 8px; width: 100%; box-sizing: border-box; margin-top: 10px; }
        .summary { margin-top: 15px; padding: 12px; background: #eaffea; border: 1px solid #1a7a1a; }
        .error { color: #c0392b; margin-top: 10px; }
        form.add-form { margin-top: 25px; padding: 15px; background: #fff; border: 1px solid #ccc; }
        form.add-form input { display: block; width: 100%; margin-top: 8px; padding: 6px; box-sizing: border-box; }
        form.add-form button { margin-top: 10px; padding: 8px 16px; }
    </style>
</head>
<body>

<h1>Кінотека — AJAX</h1>

<input type="text" id="search" placeholder="Пошук за назвою фільму...">

<div class="summary" id="summary"></div>

<table>
    <thead>
        <tr><th>Назва</th><th>Режисер</th><th>Рік</th><th>Жанр</th><th>Рейтинг</th></tr>
    </thead>
    <tbody id="results"></tbody>
</table>

<form class="add-form" id="addForm">
    <h3>Додати фільм</h3>
    <input type="text" id="title" placeholder="Назва" required>
    <input type="text" id="director" placeholder="Режисер" required>
    <input type="number" id="year" placeholder="Рік" required>
    <input type="text" id="genre" placeholder="Жанр" required>
    <input type="number" step="0.1" id="rating" placeholder="Рейтинг (0-10)" min="0" max="10" required>
    <button type="submit">Додати</button>
    <div class="error" id="formError"></div>
</form>

<script src="script.js"></script>
</body>
</html>