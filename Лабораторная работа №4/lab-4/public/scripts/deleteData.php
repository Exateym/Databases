<?php
// Путь к файлу конфигурации
$configPath = __DIR__ . '../../connection_data.json';

// Чтение и декодирование JSON-файла
$configData = json_decode(file_get_contents($configPath), true);

// Проверка, удалось ли прочитать данные из JSON-файла
if (!$configData) {
	exit(json_encode(["error" => "Ошибка: невозможно загрузить данные конфигурации."]));
}

// Подключение к базе данных с использованием данных из JSON
$dataBase = new mysqli(
	$configData['host_adress'],
	$configData['username'],
	$configData['password'],
	$configData['data_base_name']
);

// Проверка на ошибки подключения
if ($dataBase->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Ошибка подключения к базе данных']);
    exit;
}

// Получение данных из запроса
$inputData = json_decode(file_get_contents('php://input'), true);
$tableName = $inputData['table'];
$conditions = $inputData['conditions'];

// Построение и выполнение запроса
$query = "DELETE FROM " . $dataBase->real_escape_string($tableName);
if (!empty($conditions)) {
    $query .= " WHERE " . $dataBase->real_escape_string($conditions);
}

$result = $dataBase->query($query);

if ($result) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $data]);
} else {
    echo json_encode(['success' => false, 'error' => $dataBase->error]);
}

// Закрытие соединения
$dataBase->close();
?>