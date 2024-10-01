-- Получить список сотрудников с опытом работы больше 4 лет
USE lab_two;
SELECT last_name, first_name, work_experience FROM table_borisov WHERE work_experience > 4;