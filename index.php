<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // Получаем параметры, устанавливаем значение по умолчанию
        $html_type = $_GET['html_type'] ?? '';
        $content = $_GET['content'] ?? 'all';

        // Главное меню - без выделенного пункта по умолчанию
        echo "<div id='main_menu'>";
        echo "<a href='?html_type=TABLE" . ($content != 'all' ? "&content=$content" : "") . "' class='" . ($html_type === 'TABLE' ? 'selected' : '') . "'>Табличная верстка</a> ";
        echo "<a href='?html_type=DIV" . ($content != 'all' ? "&content=$content" : "") . "' class='" . ($html_type === 'DIV' ? 'selected' : '') . "'>Блочная верстка</a>";
        echo "</div>";

        // Боковое меню
        echo "<div id='side_menu'>";
        echo "<a href='?" . ($html_type ? "html_type=$html_type&" : "") . "content=all' class='" . ($content === 'all' ? 'selected' : '') . "'>Всё</a> ";
        for ($i = 2; $i <= 9; $i++) {
            echo "<a href='?" . ($html_type ? "html_type=$html_type&" : "") . "content=$i' class='" . ($content == $i ? 'selected' : '') . "'>$i</a> ";
        }
        echo "</div>";

        // Функция для создания ссылок из чисел
        function outNumAsLink($num) {
            return "<a href='?content=$num'>$num</a>";
        }

        // Функции для отображения таблицы умножения
        function outTableForm($content) {
            echo "<table class='table'>";
            for ($i = 2; $i <= 9; $i++) {
                echo "<tr>";
                for ($j = 2; $j <= 9; $j++) {
                    if ($content === 'all' || $content == $i) {
                        echo "<td>" . outNumAsLink($i) . " x " . outNumAsLink($j) . " = " . outNumAsLink($i * $j) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        function outDivForm($content) {
            echo "<div class='div-grid'>";
            for ($i = 2; $i <= 9; $i++) {
                // Проверка на скрытие других блоков
                $style = ($content === 'all' || $content == $i) ? "" : "display: none;";
                echo "<div style='$style'>";
                for ($j = 2; $j <= 9; $j++) {
                    if ($content === 'all' || $content == $i) {
                        echo outNumAsLink($i) . " x " . outNumAsLink($j) . " = " . outNumAsLink($i * $j) . "<br>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
        }

        // Вывод таблицы умножения в зависимости от выбранного типа верстки
        if ($html_type === 'DIV') {
            outDivForm($content);
        } else {
            outTableForm($content);
        }

        // Подвал с информацией
        echo "<footer>";
        echo "<p>Тип верстки: " . ($html_type === 'DIV' ? 'Блочная' : ($html_type === 'TABLE' ? 'Табличная' : 'По умолчанию (Табличная)')) . "</p>";
        echo "<p>Таблица: " . ($content === 'all' ? 'Полная' : "На $content") . "</p>";
        echo "<p>Дата и время: " . date("d.m.Y H:i:s") . "</p>";
        echo "</footer>";
    ?>
</body>
</html>
