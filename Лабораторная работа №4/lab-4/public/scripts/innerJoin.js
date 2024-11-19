document.querySelector('[data-command="inner-join"]').addEventListener('click', async () => {
    const table1 = document.getElementById('join-table-1').value;
    const table2 = document.getElementById('join-table-2').value;
    const joinCondition = document.getElementById('join-args').value;

    if (!table1 || !table2 || !joinCondition) {
        alert("Пожалуйста, выберите обе таблицы и задайте условие соединения.");
        return;
    }

    const response = await fetch('https://lab-4/scripts/innerJoin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ table1, table2, joinCondition })
    });
    
    const data = await response.json();
    displayJoinResult(data);
});

function displayJoinResult(data) {
    let resultHTML = '<table><tr>';
    // Создаём заголовки
    Object.keys(data[0]).forEach(key => {
        resultHTML += `<th>${key}</th>`;
    });
    resultHTML += '</tr>';
    
    // Добавляем строки данных
    data.forEach(row => {
        resultHTML += '<tr>';
        Object.values(row).forEach(value => {
            resultHTML += `<td>${value}</td>`;
        });
        resultHTML += '</tr>';
    });
    resultHTML += '</table>';
    
    document.getElementById('result-table').innerHTML = resultHTML;
}