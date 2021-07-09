$('#qr_create_form').find('#form_cancel').click(function(e){
    e.preventDefault();

    window.location.href = '/index.php?r=qr/index';
})