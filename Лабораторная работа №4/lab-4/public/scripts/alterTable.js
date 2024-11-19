async function alterTable()
{
    tableName = document.getElementById('ddl-table-alter').value;
    alterArgs = document.getElementById('ddl-alter-args').value;
    if (!tableName || !alterArgs)
    {
        alert("Пожалуйста, выберите таблицу и введите данные для ALTER TABLE.");
        return;
    }
    try
    {
        response = await fetch('https://lab-4/scripts/alterTable.php',
        {
            method: 'POST',
            headers:
            {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({tableName: tableName, alterArgs: alterArgs})
        });

        result = await response.json();
        if (result.success) {
            alert("Действие ALTER успешно!");
        } else {
            alert("Ошибка при выполнении ALTER: " + result.error);
        }
    }
    catch (error)
    {
        console.error("Ошибка при отправке запроса: ", error);
        alert("Ошибка при выполнении ALTER!");
    }
}