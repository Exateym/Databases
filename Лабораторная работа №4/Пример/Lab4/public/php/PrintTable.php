<?php
    //Подключение к БД
    $dataBase = new mysqli("localhost","root","101110123940Ov!","serebryakov");
    //Передача переменных
    $tableName = $_POST['tableName'];
    //Если не удалось подключиться
    if($dataBase->connect_error) 
    {
        exit("Unable to connect the DB. Check login information in the script. INFO:". $dataBase->connect_error);
    }
    //Получаем результат запроса
    $result = $dataBase->query("SELECT * FROM {$tableName}");
    //Превращаем каждую строку в элемент ассоциативного массива и записываем его 
    $table = [];
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $table[] = $row;
        }
        
    }
    //Возвращаем результат запроса в формате JSON
    echo json_encode($table);
    //Закрываем соединение
    $dataBase->close();
?>