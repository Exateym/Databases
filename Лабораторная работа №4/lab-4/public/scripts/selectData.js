async function selectData() {
    tableName = document.getElementById('dml-table-select').value;
    conditions = document.getElementById('dml-select-args').value;

    // Проверка на выбор таблицы
    if (!tableName) {
        alert("Пожалуйста, выберите таблицу для выполнения SELECT.");
        return;
    }

    // Отправка запроса на сервер
    try {
        response = await fetch('https://lab-4/scripts/selectData.php', {
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
            alert("Ошибка при выполнении SELECT: " + result.error);
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
        alert('Ошибка при выполнении SELECT.');
    }
}

function displayResults(data) {
    let output = "<table><tr>";
    if (data.length > 0) {
        // Заголовки
        Object.keys(data[0]).forEach(key => {
            output += `<th>${key}</th>`;
        });
        output += "</tr>";

        // Данные
        data.forEach(row => {
            output += "<tr>";
            Object.values(row).forEach(value => {
                output += `<td>${value}</td>`;
            });
            output += "</tr>";
        });
    } else {
        output += "<tr><td colspan='100%'>Нет данных</td></tr>";
    }
    output += "</table>";

    document.getElementById('result-table').innerHTML = output;
}