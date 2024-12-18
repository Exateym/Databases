<?php
$servername = "localhost";
$username = "root";
$password = "dL-74#8A%bNa";
$dbname = "lab_two";

/* Создание нового подключения путём вызова конструктора класса mysqli.
Объект доступен через обращение к переменной $conn. */
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { // Обращение к свойству объекта connect_error. Возвращает описание последней ошибки подключения.
/* Функция die("Сообщение") завершает выполнение скрипта и выводит сообщение
Фактически, die() — это псевдоним для exit() в PHP. */
    die("Ошибка подключения: " . $conn->connect_error);
}

/* Проверка переданного параметра:
1. isset($_GET['query']) проверяет, существует ли параметр query в массиве $_GET.
Этот массив содержит все параметры, переданные через URL (например, query.php?query=1).
Возвращает логическое значение.
2. Если параметр query существует, его значение берётся и приводится к целому числу (int)$_GET['query'].
3. Если параметр query не передан (или равен NULL), то используется значение 0 по умолчанию. */
$queryNumber = isset($_GET['query']) ? (int)$_GET['query'] : 0; // Запись с помощью тернарного оператора.

$sql = ""; // Обозначить переменную для хранения запроса выше switch'а как строку.

switch ($queryNumber) {
    case 1:
        $sql = "SELECT last_name, first_name, phone_number, salary FROM table_borisov";
        break;
    case 2:
        $sql = "SELECT last_name, first_name, address FROM table_borisov ORDER BY address";
        break;
    case 3:
        $sql = "SELECT last_name, first_name, work_experience FROM table_borisov WHERE work_experience > 4";
        break;
    default:
        echo "Неверный запрос";
        exit();
}

/* Вызов метода query("Запрос"). SQL-запрос должен быть определён в программе в переменную $sql.
Возвращает false в случае возникновения ошибки.
В случае успешного выполнения запросов, которые создают набор результатов,
таких как SELECT, SHOW, DESCRIBE или EXPLAIN, вернёт объект класса mysqli_result.
Для остальных успешных запросов вернёт true. */
$result = $conn->query($sql);

$conn->close(); // Закрывает ранее открытое соединение с базой данных.

// $result->num_rows - Обращение к полю объекта mysqli_result, которое хранит количество строк в наборе результатов.
if ($result->num_rows > 0) {
	
	// Формирование таблицы.
	
    echo "<table border='1'>"; // Тег начала таблицы. Атрибут border задаёт толщину границы таблицы в пикселях.
    echo "<tr>"; // Метки tr являются строками таблицы и содержат элементы по столбцам.
	/* Метод fetch_field() возвращает следующее поле результирующего набора.
	Каждый раз, когда происходит вызов fetch_field(), метод возвращает объект
	с информацией о следующем столбце в результирующем наборе.
	Когда все столбцы обработаны, fetch_field() возвращает false.*/
    while ($fieldInfo = $result->fetch_field()) {
		// Элемент th выделяет заголовок жирным.
		/* htmlspecialchars — Преобразовывает специальные символы в HTML-сущности.
		Ряд символов в HTML несёт отдельный смысл и для сохранения значения такие
		символы представляют HTML-сущностями. Функция возвращает строку с этими преобразованиями.*/
        echo "<th>" . htmlspecialchars($fieldInfo->name) . "</th>"; // Обращение к полю name объекта столбца - получение имени столбца.
    }
    echo "</tr>";
	/* Метод класса mysqli_result выбирает одну строку данных из набора результатов
	и возвращает её в виде ассоциативного массива. Каждый последующий вызов этой функции
	будет возвращать следующую строку в наборе результатов или null, если строк больше нет. */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) { // Извлечение значения каждого элемента из массива строки.
            echo "<td>" . htmlspecialchars($value) . "</td>"; // Метка td - ячейка таблицы, располагает элемент в строке по столбцу.
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных для отображения"; // В случае, если таблица по запросу пуста.
}

$result->close();

?>