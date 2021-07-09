$('.generate-qr').on('click', function(e){
    let params = $(this).data('params'),
        id = $(this).data('id');

    e.preventDefault();
    $.get('/', {'r':'qr/generate-code', 'params':params}, function (data) {
        let modal = $('#qr_code_save')
        if ('true' === data.success) {
            modal.find('#qr_code_save_form').find('#id').val(id);
            modal.modal('show');
        }
    }, 'json');
})