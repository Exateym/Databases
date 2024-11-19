async function fetchData() {
    try {
        const response = await fetch('https://lab-4/scripts/table_names/get_data.php');
        const data = await response.json();

        let result = '<ul>';
        data.forEach(tableName => {
            result += `<li>${tableName}</li>`;
        });
        result += '</ul>';

        document.getElementById('table-names').innerHTML = result;
    } catch (error) {
        console.error('ShowTableScript Error:', error.message);
    }
}

fetchData();