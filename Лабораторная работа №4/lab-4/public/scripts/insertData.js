async function insertData()
{
    tableName = document.getElementById('dml-table-insert').value;
    columnList = document.getElementById('dml-insert-column-list').value;
    values = document.getElementById('dml-insert-values').value;
    if (!tableName || !columnList || !values)
    {
        alert("Пожалуйста, выберите таблицу и введите данные для INSERT.");
        return;
    }
    try
    {
        response = await fetch('https://lab-4/scripts/insertData.php',
        {
            method: 'POST',
            headers:
            {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({tableName: tableName, columnList: columnList, values: values})
        });

        result = await response.json();
        if (result.success) {
            alert("INSERT выполнен успешно!");
        } else {
            alert("Ошибка при выполнении INSERT: " + result.error);
        }
    }
    catch (error)
    {
        console.error("Ошибка при отправке запроса: ", error);
        alert("Ошибка при выполнении INSERT!");
    }
}