<?php   
    // Путь к файлу конфигурации
    $configPath = __DIR__ . '../../../connection_data.json';

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
    // Выполнение запроса и вывод таблиц
    $result = $dataBase->query("SHOW TABLES");
    $tables = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
    }
    // Возвращаем результат запроса в формате JSON
    echo json_encode($tables);

    // Закрытие соединения
    $dataBase->close();
?>