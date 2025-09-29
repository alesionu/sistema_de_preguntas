$(document).ready(function() {
    
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

    $(document).on('click', '.dropdown-item[data-id]', function(e) {
        e.preventDefault();
        
        const examenId = $(this).data('id');
        const nombreExamen = $(this).text();
        
        $("#btn_desplegable_examen").html(nombreExamen + ' <span class="caret"></span>');
        
        $("#seccionPreguntas").show();
        $("#tituloExamen").text("Preguntas de: " + nombreExamen);
        
        cargarPreguntas(examenId);
        
        $("#examenId").val(examenId);
    });

    $("#formPregunta").submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: 'gestionar_pregunta.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                
                if (response.success) {
                    $("#modalPregunta").modal('hide');
                    const examenId = $("#examenId").val();
                    cargarPreguntas(examenId);
                    limpiarModal();
                    
                    alert(response.message || "Pregunta guardada exitosamente");
                } else {
                    alert("Error: " + (response.message || "Error desconocido"));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.log('Response text:', xhr.responseText);
                alert("Error al procesar la solicitud");
            }
        });
    });

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

    function limpiarModal() {
        $("#formPregunta")[0].reset();
        $("#preguntaId").val('');
        $("#modalPreguntaLabel").text("Nueva Pregunta");
        $("#btnGuardarPregunta").text("Guardar");
    }

    window.eliminarPregunta = function(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta pregunta?')) {
            const examenId = $("#examenId").val();
            console.log('ID de examen antes de eliminar:', examenId);
            
            if (!examenId) {
                alert("Error: No hay un examen seleccionado");
                return;
            }
            
            $.ajax({
                url: 'eliminar_pregunta.php',
                method: 'POST',
                data: { pregunta_id: id },
                success: function(response) {
                    console.log('Respuesta del servidor:', response);
                    alert("Pregunta eliminada exitosamente");
                    cargarPreguntas(examenId);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response text:', xhr.responseText);
                    alert("Error al eliminar la pregunta");
                }
            });
        }
    };

    window.editarPregunta = function(id, textoActual) {
        $("#preguntaId").val(id);
        $("#texto_pregunta").val(textoActual);
        $("#modalPreguntaLabel").text("Editar Pregunta");
        $("#btnGuardarPregunta").text("Actualizar");
        
        $("#modalPregunta").modal('show');
    };

});

$("#btn_desplegable_sorteo").on("click", function(){
    $.ajax({
        url: "desplegable_sorteo.php",
        method: "GET",
        success: function(response){
            $("#listaExamenes").html(response);
        }
    });
});

$("#btn_desplegable_examen").on("click", function(){
    $.ajax({
        url: "desplegable_sorteo.php",
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

$(document).on('click', '.dropdown-item[data-id]', function(e) {
    e.preventDefault();
    
    const examenId = $(this).data('id');
    const nombreExamen = $(this).text();
    
    $("#btn_desplegable_examen").html(nombreExamen + ' <span class="caret"></span>');
    
    window.examenSeleccionado = examenId;
});

$("#form_cantidad_preguntas").submit(function(e) {
    e.preventDefault();
    
    const cantidad = $("#input_cantidad").val();
    
    if (!window.examenSeleccionado) {
        alert("Por favor selecciona un examen primero");
        return;
    }
    
    if (!cantidad || cantidad <= 0) {
        alert("Por favor ingresa una cantidad válida");
        return;
    }
    
    $.ajax({
        url: 'sortear_preguntas.php',
        type: 'POST',
        data: {
            examen_id: window.examenSeleccionado,
            cantidad: cantidad
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                mostrarPreguntasSorteadas(response.preguntas);
                
                if (response.mensaje) {
                    alert(response.mensaje);
                }
            } else {
                alert("Error: " + response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.log(xhr.responseText);
            alert("Error al sortear las preguntas");
        }
    });
});

function mostrarPreguntasSorteadas(preguntas) {
    let html = '';
    preguntas.forEach(function(pregunta, index) {
        html += '<tr>';
        html += '<td>' + pregunta.id + '</td>';
        html += '<td>' + pregunta.pregunta + '</td>';
        html += '</tr>';
    });
    
    $("#tablaPreguntas").html(html);
}