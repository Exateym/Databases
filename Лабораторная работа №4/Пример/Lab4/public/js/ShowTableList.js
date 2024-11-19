async function fetchData()
{
    await fetch('https://lab4/php/ShowTableList.php')
    .then(response => response.json())
    .then(data => 
        {
            console.log(data);
            let result = '';
            result += `<table>`;
            data.forEach(element =>
                {
                    //Получение массива ключей(атрибутов) у элемента
                    keys = Object.keys(element);
                    //Вывод таблицы
                    result += `<tr>`;
                    for(let i=0; i < keys.length; ++i)
                        {
                            
                            result += `<td>${element[keys[0]]}</td>`;
                        }
                    result += `</tr>`;
                    console.log(element[keys[0]]);
                })
                result += `</table>`
                console.log(result);
            document.getElementById('listBox').innerHTML = result;
        })
    .catch(error =>
        {
            console.error('ShowTableScript Error:', error.message);
        });

};
fetchData();
