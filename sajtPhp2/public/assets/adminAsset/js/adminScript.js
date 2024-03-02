document.addEventListener('DOMContentLoaded', function() {
    var deletebtns = document.getElementsByClassName('brisiAdmin');

    function showDeleteModal(event) {
        var btnId = event.target.getAttribute('data-IdBrisi');
        $('#deleteModal').data('btnid', btnId);
        $('#deleteModal').modal('show');
    }

    for (var i = 0; i < deletebtns.length; i++) {
        deletebtns[i].addEventListener('click', showDeleteModal, false);
    }

    $('#confirmDelete').on('click', function() {
        var btnId = $('#deleteModal').data('btnid');
        var strana = window.location.pathname;
        var niz = strana.split('/');
        var ruta = niz[niz.length - 1];
        var action =$('#deleteForm'+btnId).attr('action');



        $.ajax({
            url:  '/'+ ruta + '/' + btnId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'Delete',
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                location.reload();
            }

        });
        $('#deleteModal').modal('hide');
    });

    $('#cancelDelete').on('click', function() {
        $('#deleteModal').modal('hide');
    });
});
