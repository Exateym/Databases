async function updateData()
{
    tableName = document.getElementById('dml-table-update').value;
    commandArgs = document.getElementById('dml-update-args').value;
    if (!tableName || !commandArgs)
    {
        alert("Пожалуйста, выберите таблицу и введите аргументы для UPDATE.");
        return;
    }
    try
    {
        response = await fetch('https://lab-4/scripts/updateData.php',
        {
            method: 'POST',
            headers:
            {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({tableName: tableName, commandArgs: commandArgs})
        });

        result = await response.json();
        if (result.success)
        {
            alert("UPDATE выполнен успешно!");
        }
        else
        {
            alert("Ошибка при выполнении UPDATE: " + result.error);
        }
    }
    catch (error)
    {
        console.error("Ошибка при отправке запроса: ", error);
        alert("Ошибка при выполнении UPDATE!");
    }
}