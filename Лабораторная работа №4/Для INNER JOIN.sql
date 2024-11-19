-- Создаём таблицу students
CREATE TABLE students (
    student_id INT PRIMARY KEY,
    name VARCHAR(50),
    course_id INT
);

-- Создаём таблицу courses
CREATE TABLE courses (
    course_id INT PRIMARY KEY,
    course_name VARCHAR(50)
);

-- Добавляем данные в таблицу students
INSERT INTO students (student_id, name, course_id) VALUES
(1, 'Alice', 101),
(2, 'Bob', 102),
(3, 'Charlie', 101),
(4, 'David', 103);

-- Добавляем данные в таблицу courses
INSERT INTO courses (course_id, course_name) VALUES
(101, 'Mathematics'),
(102, 'Science'),
(103, 'History');

SELECT students.name AS student_name, courses.course_name
FROM students
INNER JOIN courses ON students.course_id = courses.course_id;