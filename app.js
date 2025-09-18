$(document).ready(function() {
    
    $("#id_form_login").submit(function(e) {
        e.preventDefault();
        
        let input_usuario = $("#input_usuario").val();
        let input_password = $("#input_password").val();
        
        let datosFormulario = new FormData();
        datosFormulario.append('input_usuario', input_usuario);
        datosFormulario.append('input_password', input_password);
        
        $.ajax({
            url: 'guardar_login.php',
            type: 'POST',
            data: datosFormulario,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#id_form_login').trigger('reset');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});