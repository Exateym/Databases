USE lab_two; -- Используемая база данных
CREATE TABLE table_borisov ( -- Создание таблицы
    id INT PRIMARY KEY AUTO_INCREMENT, -- Первичный ключ
    last_name VARCHAR(50),
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    phone_number VARCHAR(15), -- Указание номера телефона в формате 89001234567
    salary DECIMAL(10, 2), /* Хранит числа с заданной точностью.
    Использует два параметра — максимальное количество цифр всего числа (precision)
    и количество цифр дробной части (scale). Рекомендуемый тип данных для работы с валютами --*/
    address VARCHAR(100),
    work_experience INT -- Продолжительность трудовой деятельности в годах
);