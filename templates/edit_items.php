<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Редагувати товар</title>
    <style>
        body{
            background-color: #346573;
        }
    </style>
</head>
<body>
<h2>Редагувати товар</h2>
<form method="POST" action="">
    <label for="name">Назва:</label>
    <input type="text" name="name" id="name" value="<?= $item['Name'] ?>" required><br><br>

    <label for="country">Країна:</label>
    <input type="text" name="country" id="country" value="<?= $item['Country'] ?>" required><br><br>

    <label for="producer">Виробник:</label>
    <input type="text" name="producer" id="producer" value="<?= $item['Producer'] ?>" required><br><br>

    <label for="price">Ціна:</label>
    <input type="number" name="price" id="price" step="0.01" value="<?= $item['Price'] ?>" required><br><br>

    <button type="submit">Оновити</button>
</form>
</body>
</html>