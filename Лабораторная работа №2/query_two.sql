-- Получить список сотрудников с их адресами, отсортировать по адресу
USE borisov;
SELECT last_name, first_name, address FROM table_borisov ORDER BY address;