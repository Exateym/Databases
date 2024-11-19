async function fetchTableList() {
    try {
        const response = await fetch('https://lab-4/scripts/table_names/get_data.php');
        const tables = await response.json();

        // Получаем все выпадающие списки по ID
        const tableSelects = [
            document.getElementById('ddl-table-alter'),
            document.getElementById('ddl-table-drop'),
            document.getElementById('ddl-table-truncate'),
            document.getElementById('dml-table-insert'),
            document.getElementById('dml-table-update'),
            document.getElementById('dml-table-delete'),
            document.getElementById('dml-table-select'),
            document.getElementById('join-table-1'),
            document.getElementById('join-table-2')
        ];

        // Для каждого выпадающего списка обнуляем старые опции и добавляем новые
        tableSelects.forEach(select => {
            // Добавляем новые опции из списка таблиц
            tables.forEach(table => {
                const option = document.createElement('option');
                option.value = table; // Название таблицы
                option.textContent = table; // Текст, который будет отображаться в списке
                select.appendChild(option); // Добавляем опцию в список
            });
        });
    } catch (error) {
        console.error('Ошибка при получении списка таблиц:', error);
    }
}

// Вызываем функцию при загрузке страницы

fetchTableList();