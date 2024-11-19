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

// Получение имени таблицы из тела запроса (POST)
$inputData = json_decode(file_get_contents('php://input'), true);
$tableName = $inputData['query'];

// Проверка и выполнение запроса
if ($tableName) {
    $query = $dataBase->real_escape_string($tableName);

    if ($dataBase->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $dataBase->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Имя таблицы не указано.']);
}

// Закрытие соединения с базой данных
$dataBase->close();
?>