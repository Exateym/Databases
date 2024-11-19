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
$tableName = $inputData['tableName'];
$columnList = $inputData['columnList'];
$values = $inputData['values'];

// Разделяем значения и подготавливаем их для использования в запросе
$valuesArray = explode(",", $values);
$placeholders = implode(", ", array_fill(0, count($valuesArray), "?"));
$columnListFormatted = "(" . $columnList . ")";
$query = "INSERT INTO " . $dataBase->real_escape_string($tableName) . " " . $columnListFormatted . " VALUES ($placeholders)";

// Подготавливаем запрос
$stmt = $dataBase->prepare($query);

if ($stmt) {
    // Привязываем параметры
    $stmt->bind_param(str_repeat("s", count($valuesArray)), ...$valuesArray);

    // Выполняем запрос
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    // Закрываем подготовленный запрос
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Ошибка подготовки запроса: ' . $dataBase->error]);
}

// Закрытие соединения с базой данных
$dataBase->close();
?>