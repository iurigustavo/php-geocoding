deleteConfirm = function (formId) {
    Swal.fire({
        title: 'Você tem certeza?',
        icon: 'warning',
        text: 'Deseja deletar esse registro?',
        showCancelButton: true,
        confirmButtonText: 'Remover',
        confirmButtonColor: '#e3342f',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('body').find('#' + formId).append('<input name="_token" type="hidden" value="' + token + '">');
            document.getElementById(formId).submit();
        }
    });
}