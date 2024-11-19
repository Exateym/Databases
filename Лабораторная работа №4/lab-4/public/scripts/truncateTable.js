async function truncateTable() {
    tableName = document.getElementById('ddl-table-truncate').value;

    // Проверка на выбор таблицы
    if (!tableName) {
        alert("Пожалуйста, выберите таблицу для очистки.");
        return;
    }

    try {
        response = await fetch('scripts/truncateTable.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ tableName: tableName })
        });

        const result = await response.json();
        if (result.success) {
            alert(`Таблица "${tableName}" успешно очищена.`);
        } else {
            alert("Ошибка при очистке таблицы: " + result.error);
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
        alert('Ошибка при очистке таблицы.');
    }
}