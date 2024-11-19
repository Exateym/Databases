async function createTable() {
    const tableData = document.getElementById('ddl-table-create').value;

    // Проверка на пустое поле ввода
    if (!tableData) {
        alert("Пожалуйста, введите запрос на создание таблицы.");
        return;
    }

    // Формируем запрос SQL для создания таблицы
    const createTableQuery = `CREATE TABLE ${tableData}`;

    // Отправляем запрос на сервер
    try {
        const response = await fetch('https://lab-4/scripts/createTable.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ query: createTableQuery }) // Передаем запрос на создание таблицы
        });

        const result = await response.json();
        if (result.success) {
            alert("Таблица успешно создана!");
        } else {
            alert("Ошибка при создании таблицы: " + result.error);
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
        alert('Ошибка при создании таблицы.');
    }
}