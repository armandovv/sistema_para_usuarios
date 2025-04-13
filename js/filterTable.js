

{
    
document.getElementById('open-calendar').addEventListener('click', () => {
 const startDates = document.getElementById('start_date');
 const endDates = document.getElementById('end_date');
 startDates.style.display = 'inline-block';
 endDates.style.display = 'inline-block';
 startDates.focus(); // Automáticamente abre el selector de fecha
});
    
function filterTable() {
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);
    const rows = document.querySelectorAll('#tablaDatos tbody tr');

    rows.forEach(row => {
        const dateCell = row.children[1]; // Cambia "1" si la columna de fecha tiene otro índice.
        const rowDate = new Date(dateCell.textContent);

        // Mostrar u ocultar filas según el rango de fechas
        if (
            (!isNaN(startDate) && rowDate < startDate) ||
            (!isNaN(endDate) && rowDate > endDate)
        ) {
            row.style.display = 'none';
        } else {
            row.style.display = '';
        }
    });
}
}