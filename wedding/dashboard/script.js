
function updateRow(btn) {
    const row = btn.closest('tr');
    const inputs = row.querySelectorAll('input[type="text"]');
    const data = {};
    inputs.forEach(input => {
        data[input.dataset.key] = input.value;
    });
    data.id = inputs[0].dataset.id;
    data.table = inputs[0].dataset.table;

    fetch('update.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(res => res.text()).then(msg => alert(msg));
}

function deleteRow(btn) {
    const row = btn.closest('tr');
    const id = row.querySelector('input').dataset.id;
    const table = row.querySelector('input').dataset.table;

    if (confirm("Are you sure to delete this record?")) {
        fetch('delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, table })
        }).then(res => res.text()).then(msg => {
            alert(msg);
            row.remove();
        });
    }
}
