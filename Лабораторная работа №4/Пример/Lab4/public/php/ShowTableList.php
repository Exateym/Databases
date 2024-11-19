<?php
    //Подключение к БД
    $dataBase = new mysqli("localhost","root","101110123940Ov!","serebryakov");
    //Если не удалось подключиться
    if($dataBase->connect_error) 
    {
        exit("Unable to connect the DB. Check login information in the script. INFO:". $dataBase->connect_error);
    }
    //Получаем результат запроса
    $result = $dataBase->query("SHOW TABLES");
    //Превращаем каждую строку в элемент ассоциативного массива и записываем его 
    $tables = [];
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $tables[] = $row;
        }
        
    }
    //Возвращаем результат запроса в формате JSON
    echo json_encode($tables);
    //Закрываем соединение
    $dataBase->close();
?>