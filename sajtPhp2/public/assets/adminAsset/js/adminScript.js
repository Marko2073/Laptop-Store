
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.brisiAdmin');

    function showDeleteModal(event) {
        var btnId = event.target.getAttribute('data-IdBrisi');
        var strana = window.location.pathname;
        var niz = strana.split('/');
        var ruta = niz[niz.length - 1];
        var form = document.getElementById('deleteForm');
        form.action = '/' + ruta + '/' + btnId;
        $('#deleteModal').modal('show');
    }

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', showDeleteModal);
    });
});
