function getCheckedGroup() {
    let keys = $('#w0').yiiGridView('getSelectedRows');
    let submitButton = document.querySelector('button[id="delete"]');
    submitButton.disabled = (keys.length === 0);
}

function deleteCheckedGroup() {
    let keys = $('#w0').yiiGridView('getSelectedRows');
    keys.forEach((item) => {
        $.ajax({
            type: "GET",
            url: "delete_group_by_id",
            data: {id: item},
        });
    });
    window.location.reload();
}