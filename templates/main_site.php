<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body{
            background-color: #346573;
        }
    </style>
</head>
<body>
    <h1>Ласкаво просимо, <?= htmlspecialchars($currentUser) ?></h1>
    <form method="POST" action="/../controllers/logout.php">
        <input type="submit" value="LOGOUT">
    </form>
    <h2>Список товарів</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Країна</th>
            <th>Виробник</th>
            <th>Ціна</th>
            <th>Вибрати</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><?= $row['Name'] ?></td>
                <td><?= $row['Country'] ?></td>
                <td><?= $row['Producer'] ?></td>
                <td><?= $row['Price'] ?></td>
                <td><input type="checkbox" name="select[]" value="<?= $row['ID'] ?>"></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php if ($isAdmin) { ?>
        <button onclick="location.href='/../controllers/add.php'">Додати</button>
        <button id="editButton" onclick="location.href='/../controllers/edit.php?id=' + getSelectedId()" disabled>Змінити</button>
        <button id="deleteButton" onclick="location.href='/../controllers/delete.php?id=' + getSelectedId()" disabled>Видалити</button>
    <?php } ?>

    <script>
        // Функція для отримання ID вибраного товару
        function getSelectedId() {
            let selected = document.querySelector('input[name="select[]"]:checked');
            return selected ? selected.value : '';
        }

        // Функція для активації/деактивації кнопок
        function toggleButtons() {
            let selectedCheckbox = document.querySelector('input[name="select[]"]:checked');
            const editButton = document.getElementById('editButton');
            const deleteButton = document.getElementById('deleteButton');
            if (selectedCheckbox) {
                // Якщо є вибраний чекбокс, робимо кнопки активними
                editButton.disabled = false;
                deleteButton.disabled = false;
            } else {
                // Якщо немає вибраного чекбокса, блокуємо кнопки
                editButton.disabled = true;
                deleteButton.disabled = true;
            }
        }
        // Додаємо слухачів подій до чекбоксів
        const checkboxes = document.querySelectorAll('input[name="select[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleButtons);
        });
        // Ініціалізація стану кнопок при завантаженні сторінки
        toggleButtons();
    </script>
</body>
</html>