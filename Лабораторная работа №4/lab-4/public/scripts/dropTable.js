async function dropTable() {
    const tableName = document.getElementById('ddl-table-drop').value;

    // Проверка на выбор таблицы
    if (!tableName) {
        alert("Пожалуйста, выберите таблицу для удаления.");
        return;
    }

    // Отправляем запрос на сервер для удаления таблицы
    try {
        const response = await fetch('scripts/dropTable.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ table: tableName })
        });

        const result = await response.json();
        if (result.success) {
            alert(`Таблица "${tableName}" успешно удалена.`);
            // Обновляем список таблиц после удаления
            await fetchTableList();
        } else {
            alert("Ошибка при удалении таблицы: " + result.error);
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
        alert('Ошибка при удалении таблицы.');
    }
}
