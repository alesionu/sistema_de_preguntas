$(document).ready(function() {
    
    // Login form
    $("#id_form_login").submit(function(e) {
        e.preventDefault();
        
        let input_usuario = $("#input_usuario").val();
        let input_password = $("#input_password").val();
        
        let datosFormulario = new FormData();
        datosFormulario.append('input_usuario', input_usuario);
        datosFormulario.append('input_password', input_password);
        
        $.ajax({
            url: 'validar_login.php',
            type: 'POST',
            data: datosFormulario,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response === "Login exitoso") {
                    window.location.href = 'index.php';
                } else {
                    alert("Credenciales incorrectas");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    // Desplegable de exámenes en sección preguntas
    $("#btn_desplegable_examen").on("click", function(){
        $.ajax({
            url: "listar_examenes_preguntas.php",
            method: "GET",
            success: function(response){
                $("#listaExamenes").html(response);
            },
            error: function(xhr, status, error){
                console.error("Error AJAX:", error);
                $("#listaExamenes").html('<li><span class="dropdown-item">Error al cargar</span></li>');
            }
        });
    });

    // Manejar selección de examen
    $(document).on('click', '.dropdown-item[data-id]', function(e) {
        e.preventDefault();
        
        const examenId = $(this).data('id');
        const nombreExamen = $(this).text();
        
        // Actualizar el botón con el nombre del examen seleccionado
        $("#btn_desplegable_examen").html(nombreExamen + ' <span class="caret"></span>');
        
        // Mostrar la sección de preguntas
        $("#seccionPreguntas").show();
        $("#tituloExamen").text("Preguntas de: " + nombreExamen);
        
        // Cargar las preguntas del examen seleccionado
        cargarPreguntas(examenId);
        
        // Guardar el ID del examen para usarlo en el modal
        $("#examenId").val(examenId);
    });

    // Formulario para guardar/editar preguntas
    $("#formPregunta").submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: 'gestionar_pregunta.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response.includes("exitoso")) {
                    // Cerrar modal
                    $("#modalPregunta").modal('hide');
                    // Recargar preguntas
                    const examenId = $("#examenId").val();
                    cargarPreguntas(examenId);
                    // Limpiar formulario
                    limpiarModal();
                    
                    // Mostrar mensaje de éxito
                    alert("Pregunta guardada exitosamente");
                } else {
                    alert("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("Error al procesar la solicitud");
            }
        });
    });
});

// Función para cargar preguntas de un examen
function cargarPreguntas(examenId) {
    $.ajax({
        url: 'listar_preguntas.php',
        method: 'GET',
        data: { examen_id: examenId },
        success: function(response) {
            $("#tablaPreguntas").html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            $("#tablaPreguntas").html('<tr><td colspan="3">Error al cargar preguntas</td></tr>');
        }
    });
}

// Función para limpiar el modal
function limpiarModal() {
    $("#formPregunta")[0].reset();
    $("#preguntaId").val('');
    $("#modalPreguntaLabel").text("Nueva Pregunta");
    $("#btnGuardarPregunta").text("Guardar");
}

// Función para editar pregunta
function editarPregunta(id, texto) {
    $("#preguntaId").val(id);
    $("#textoPregunta").val(texto);
    $("#modalPreguntaLabel").text("Editar Pregunta");
    $("#btnGuardarPregunta").text("Actualizar");
    $("#modalPregunta").modal('show');
}

// Función para eliminar pregunta
function eliminarPregunta(id) {
    if (confirm("¿Está seguro de que desea eliminar esta pregunta?")) {
        $.ajax({
            url: 'eliminar_pregunta.php',
            method: 'POST',
            data: { pregunta_id: id },
            success: function(response) {
                if (response.includes("exitoso")) {
                    // Recargar preguntas
                    const examenId = $("#examenId").val();
                    cargarPreguntas(examenId);
                    alert("Pregunta eliminada exitosamente");
                } else {
                    alert("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("Error al eliminar la pregunta");
            }
        });
    }
}