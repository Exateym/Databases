document.getElementById('DDLform').addEventListener('submit',async function(e){
    //Для предотвращения полной перезагрузки сайта
    e.preventDefault();

    var params = new FormData(document.querySelector('#DDLform'));
    let data = await fetch('https://lab4/php/PrintTable.php',{
        method: 'POST',
        body: params
    })
    .then(response =>{
        return response.json();
    })
    .catch(error =>{
        console.error('Data recieve error: ', error);
    })
    //Получаем массив столбцов, аргументов
    const args = Object.keys(data[0]);
    //Формируем таблицу
    let result = '';
    result+='<table>';
    result+='<tr>';
    for(let i=0; i<args.length; ++i){
        result+='<td>';
        result+=Object.keys(data[0])[i];
        result+='</td>';
    }
    result+='</tr>';
    data.forEach(element => {
        result+='<tr>';
        for(let i=0; i < args.length; ++i){
                result+='<td>';
                result+=element[args[i]];
                result+='</td>';
            }
            result+='</tr>';
    });
    result+='</table>';
    document.getElementById('resultTable').innerHTML = result;
})