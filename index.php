<?php include_once 'database.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>JSON NoSQL Demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Демонстрация работы с JSON и NoSQL</h1>

<h2>Добавить нового пользователя</h2>
<form method="POST">
    <div class="form-group">
        <label>Имя:</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>Возраст:</label>
        <input type="number" name="age" required>
    </div>
    <button type="submit">Сохранить</button>
</form>

<h2>Список пользователей</h2>
<?php if (!empty($users)): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= substr($user['id'], 0, 8) ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['created'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="delete" value="<?= $user['id'] ?>">
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Нет пользователей в базе данных</p>
<?php endif; ?>

<h3>Структура JSON-файла:</h3>
<pre><?= file_get_contents('/data/users.json') ?></pre>

<br>

<h3>Исходный код:</h3>
<pre><code class="language-php">
<?= htmlspecialchars(file_get_contents('database.php')); ?>
</code></pre>

<pre><code class="language-html">
<?= htmlspecialchars(file_get_contents(__FILE__)); ?>
</code></pre>


<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script>hljs.highlightAll();</script>


</body>
</html>