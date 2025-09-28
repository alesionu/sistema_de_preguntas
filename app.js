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
        
        cargarPreguntas(examenId);
        
        $("#examenId").val(examenId);
    });

    // Formulario para guardar/editar preguntas - CORREGIDO
    $("#formPregunta").submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: 'gestionar_pregunta.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // AGREGADO: Especificar que esperamos JSON
            success: function(response) {
                console.log(response);
                
                // CORREGIDO: Verificar la respuesta JSON correctamente
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
                console.log('Response text:', xhr.responseText); // Para debug
                alert("Error al procesar la solicitud");
            }
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

}); // limite

// Función para eliminar pregunta
function eliminarPregunta(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta pregunta?')) {
        $.ajax({
            url: 'eliminar_pregunta.php',
            method: 'POST',
            data: { pregunta_id: id },
            dataType: 'json', // AGREGADO: Si eliminar_pregunta.php también devuelve JSON
            success: function(response) {
                // Si eliminar_pregunta.php devuelve JSON, verificar response.success
                // Si no devuelve JSON, usar la lógica original
                const examenId = $("#examenId").val();
                cargarPreguntas(examenId);
                alert("Pregunta eliminada exitosamente");
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("Error al eliminar la pregunta");
            }
        });
    }
}

// Función para editar pregunta - NUEVA FUNCIÓN
function editarPregunta(id, textoActual) {
    // Llenar el modal con los datos actuales
    $("#preguntaId").val(id);
    $("#texto_pregunta").val(textoActual);
    $("#modalPreguntaLabel").text("Editar Pregunta");
    $("#btnGuardarPregunta").text("Actualizar");
    
    // Mostrar el modal
    $("#modalPregunta").modal('show');
}

// Código para sorteo de preguntas
$("#btn_desplegable_sorteo").on("click", function(){
    $.ajax({
        url: "desplegable_sorteo.php",
        method: "GET",
        success: function(response){
            $("#listaExamenes").html(response);
        }
    });
});

// Cargar exámenes al hacer clic en el dropdown (parece duplicado, verificar si es necesario)
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

// Manejar selección de examen (parece duplicado también)
$(document).on('click', '.dropdown-item[data-id]', function(e) {
    e.preventDefault();
    
    const examenId = $(this).data('id');
    const nombreExamen = $(this).text();
    
    // Actualizar el botón con el nombre del examen seleccionado
    $("#btn_desplegable_examen").html(nombreExamen + ' <span class="caret"></span>');
    
    // Guardar el ID del examen seleccionado
    window.examenSeleccionado = examenId;
});

// Formulario para sorteo de preguntas
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

// Función para mostrar preguntas sorteadas
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