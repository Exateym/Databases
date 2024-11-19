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

// Проверка на успешное подключение
if ($dataBase->connect_error) {
	exit("Ошибка подключения к базе данных: " . $dataBase->connect_error);
}

// Получение имени таблицы из тела запроса (POST)
$inputData = json_decode(file_get_contents('php://input'), true);
$tableName = $inputData['tableName'];

// Проверка и выполнение запроса
if ($tableName) {
    $query = "TRUNCATE TABLE " . $dataBase->real_escape_string($tableName);

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