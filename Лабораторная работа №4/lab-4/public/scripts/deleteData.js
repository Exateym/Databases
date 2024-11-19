async function deleteData() {
    tableName = document.getElementById('dml-table-delete').value;
    conditions = document.getElementById('dml-delete-args').value;

    // Проверка на выбор таблицы
    if (!tableName) {
        alert("Пожалуйста, выберите таблицу для выполнения DELETE.");
        return;
    }

    // Отправка запроса на сервер
    try {
        response = await fetch('https://lab-4/scripts/deleteData.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ table: tableName, conditions: conditions })
        });

        result = await response.json();
        if (result.success) {
            displayResults(result.data); // Отображение результата
        } else {
            alert("Ошибка при выполнении DELETE: " + result.error);
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
        alert('Ошибка при выполнении DELETE.');
    }
}