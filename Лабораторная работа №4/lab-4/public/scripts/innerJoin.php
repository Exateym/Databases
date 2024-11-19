<?php
$data = json_decode(file_get_contents('php://input'), true);
$table1 = $data['table1'];
$table2 = $data['table2'];
$joinCondition = $data['joinCondition'];

// Путь к файлу конфигурации
$configPath = __DIR__ . '../../connection_data.json';

// Чтение и декодирование JSON-файла
$configData = json_decode(file_get_contents($configPath), true);

// Проверка, удалось ли прочитать данные из JSON-файла
if (!$configData) {
	exit(json_encode(["error" => "Ошибка: невозможно загрузить данные конфигурации."]));
}

// Подключение к базе данных с использованием данных из JSON
$connection = new mysqli(
	$configData['host_adress'],
	$configData['username'],
	$configData['password'],
	$configData['data_base_name']
);

if ($connection->connect_error) {
    die(json_encode(['error' => 'Ошибка подключения: ' . $connection->connect_error]));
}

$query = "SELECT * FROM $table1 INNER JOIN $table2 ON $joinCondition";
$result = $connection->query($query);

if ($result && $result->num_rows > 0) {
    $output = [];
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    echo json_encode($output);
} else {
    echo json_encode(['error' => 'Нет данных или ошибка запроса']);
}

$connection->close();
?>