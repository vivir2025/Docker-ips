
<!-- This view lists the appointments assigned to the health professional to initialize them ... -->

<style>
/* Barra de progreso lineal estilo YouTube/Google */
.linear-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: transparent;
    z-index: 9999;
    display: none;
}

.linear-progress-bar {
    height: 100%;
    background: #3498db;
    width: 0%;
    animation: progressAnimation 2s ease-in-out infinite;
}

@keyframes progressAnimation {
    0% {
        width: 0%;
        margin-left: 0%;
    }
    50% {
        width: 75%;
        margin-left: 25%;
    }
    100% {
        width: 0%;
        margin-left: 100%;
    }
}

/* Skeleton Loader Styles */
.skeleton-loader {
    display: block;
    margin: 20px 0;
}

.skeleton-table {
    width: 100%;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.skeleton-header {
    height: 60px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-row {
    height: 50px;
    background: linear-gradient(90deg, #f8f8f8 25%, #ececec 50%, #f8f8f8 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
    border-bottom: 1px solid #e0e0e0;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Estilos profesionales para el cronograma */
.cronograma-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

.cronograma-header {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: 2px solid #e0e0e0;
}

.cronograma-header h4 {
    color: #2c3e50;
    margin: 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
}

.cronograma-header h4 i {
    font-size: 28px;
    color: #3498db;
}

.cronograma-header .fecha-actual {
    color: #546e7a;
    font-size: 15px;
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.cronograma-header .fecha-actual i {
    color: #3498db;
}

.agenda-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.12);
    border: 2px solid #e0e0e0;
    margin-bottom: 25px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.agenda-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(0,0,0,0.18);
    border-color: #3498db;
}

.agenda-info-header {
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 3px solid #3498db;
}

.agenda-info-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2c3e50;
}

.agenda-info-header h5 i {
    color: #3498db;
}

.agenda-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.agenda-detail-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.agenda-detail-item i {
    font-size: 20px;
    color: #3498db;
}

.agenda-detail-item .label {
    font-size: 11px;
    color: #7f8c8d;
    display: block;
    text-transform: uppercase;
    font-weight: 600;
}

.agenda-detail-item .value {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.agenda-table {
    width: 100%;
    margin: 0;
}

.agenda-table thead {
    background: #f8f9fa;
}

.agenda-table thead th {
    padding: 15px 12px;
    font-size: 13px;
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.agenda-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    font-size: 14px;
    border-bottom: 1px solid #e9ecef;
}

.agenda-table tbody tr {
    transition: background-color 0.2s ease;
}

.agenda-table tbody tr:hover {
    background-color: #f8f9fa;
}

.agenda-table tbody tr.finalizado {
    background-color: #d4edda;
}

.cita-hora {
    font-weight: 600;
    color: #667eea;
    font-size: 15px;
}

.cita-paciente {
    font-weight: 500;
}

.cita-documento {
    color: #6c757d;
    font-size: 13px;
}

.badge-estado {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.badge-programado {
    background: #e3f2fd;
    color: #1976d2;
}

.badge-finalizado {
    background: #e8f5e9;
    color: #388e3c;
}

.badge-facturado {
    background: #fff3e0;
    color: #f57c00;
}

.btn-iniciar-cita {
    background: #3498db;
    border: none;
    color: white;
    padding: 8px 18px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
}

.btn-iniciar-cita:hover {
    background: #2980b9;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.5);
}

.btn-adicional {
    background: #28a745;
    border: none;
    color: white;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-adicional:hover {
    background: #218838;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #495057;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6c757d;
    font-size: 14px;
}

/* Alerta de confirmación personalizada */
.custom-confirm-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.custom-confirm-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.7);
    background: white;
    border-radius: 15px;
    padding: 35px;
    text-align: center;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
    min-width: 400px;
    max-width: 90%;
    animation: zoomIn 0.3s ease forwards;
}

.custom-confirm-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    border-radius: 50%;
    background: #3498db;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: scaleUp 0.5s ease;
}

.custom-confirm-icon i {
    font-size: 40px;
    color: white;
}

.custom-confirm-title {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 15px;
}

.custom-confirm-message {
    font-size: 16px;
    color: #546e7a;
    margin-bottom: 30px;
    line-height: 1.5;
}

.custom-confirm-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.custom-confirm-btn {
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    min-width: 120px;
}

.custom-confirm-btn-cancel {
    background: #ecf0f1;
    color: #7f8c8d;
}

.custom-confirm-btn-cancel:hover {
    background: #bdc3c7;
    color: #2c3e50;
    transform: scale(1.05);
}

.custom-confirm-btn-accept {
    background: #3498db;
    color: white;
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
}

.custom-confirm-btn-accept:hover {
    background: #2980b9;
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.5);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    to { transform: translate(-50%, -50%) scale(1); }
}

@keyframes scaleUp {
    0% { transform: scale(0); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Indicador de carga */
.loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(44, 62, 80, 0.85);
    z-index: 10000;
    animation: fadeIn 0.3s ease;
}

.loading-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.loading-spinner {
    width: 60px;
    height: 60px;
    margin: 0 auto 25px;
    border: 5px solid rgba(255, 255, 255, 0.2);
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.loading-text {
    color: white;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}

.loading-subtext {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<!-- Barra de progreso lineal -->
<div id="linearProgress" class="linear-progress">
    <div class="linear-progress-bar"></div>
</div>

<div class="cronograma-container">
    <div class="cronograma-header">
        <h4>
            <i class="fas fa-calendar-check"></i>
            Mi Cronograma de Hoy
        </h4>
        <div class="fecha-actual">
            <i class="far fa-clock"></i>
            <span><?php 
                setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');
                echo strftime("%A, %d de %B de %Y - %I:%M %p", time()); 
            ?></span>
        </div>
    </div>

    <!-- Skeleton Loader -->
    <div id="skeleton-loader" class="skeleton-loader" style="display: none;">
        <div class="skeleton-table">
            <div class="skeleton-header"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
        </div>
        <div class="skeleton-table">
            <div class="skeleton-header"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
            <div class="skeleton-row"></div>
        </div>
    </div>

    <!-- Contenedor de datos reales -->
    <div id="mens_cita"></div>
</div>

<!-- Alerta de confirmación personalizada -->
<div id="customConfirm" class="custom-confirm-overlay">
    <div class="custom-confirm-box">
        <div class="custom-confirm-icon">
            <i class="fas fa-question-circle"></i>
        </div>
        <div class="custom-confirm-title">¿Iniciar Cita?</div>
        <div class="custom-confirm-message" id="customConfirmMessage">¿Realmente desea iniciar esta cita?</div>
        <div class="custom-confirm-buttons">
            <button class="custom-confirm-btn custom-confirm-btn-cancel" onclick="cerrarConfirmPersonalizada(false)">
                <i class="fas fa-times"></i> Cancelar
            </button>
            <button class="custom-confirm-btn custom-confirm-btn-accept" onclick="cerrarConfirmPersonalizada(true)">
                <i class="fas fa-check"></i> Aceptar
            </button>
        </div>
    </div>
</div>

<!-- Indicador de carga -->
<div id="loadingOverlay" class="loading-overlay">
    <div class="loading-container">
        <div class="loading-spinner"></div>
        <div class="loading-text">Abriendo Historia Clínica</div>
        <div class="loading-subtext">Espere un momento por favor...</div>
    </div>
</div>

<script type='text/javascript'>
    // Variables para la confirmación personalizada
    var confirmCallback = null;

    // Funciones para mostrar/ocultar loading
    function mostrarLoading() {
        $('#loadingOverlay').fadeIn(300);
    }

    function ocultarLoading() {
        $('#loadingOverlay').fadeOut(300);
    }

    // Función para mostrar confirmación personalizada
    function mostrarConfirmPersonalizada(mensaje, callback) {
        $('#customConfirmMessage').text(mensaje);
        confirmCallback = callback;
        $('#customConfirm').fadeIn(300);
    }

    // Función para cerrar confirmación
    function cerrarConfirmPersonalizada(resultado) {
        $('#customConfirm').fadeOut(300);
        if (confirmCallback) {
            if (resultado) {
                // Mostrar loading antes de ejecutar el callback
                mostrarLoading();
            }
            confirmCallback(resultado);
            confirmCallback = null;
        }
    }

    // Cerrar con ESC
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#customConfirm').is(':visible')) {
            cerrarConfirmPersonalizada(false);
        }
    });

    // Cerrar con click fuera
    $('#customConfirm').on('click', function(e) {
        if (e.target.id === 'customConfirm') {
            cerrarConfirmPersonalizada(false);
        }
    });

    /*function eliminar(id_his_med) {
        if (confirm('¿Desea eliminar el medicamento?')) {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_medicamento'; ?>",
                type: 'POST',
                data: {
                    id_his_med: id_his_med
                },
                success: function(result) {
                    //location.reload(); 

                    nota_adicional(id_his_med); 
                    $("#lista_medicamento").load(" #lista_medicamento");
                    $("#mens").html(result);
                }
            });
        }
    }

    $("#add").click(function() {

        idMedicamento = $("#idMedicamento").val();
        cantidad = $("#cantidad").val();
        idHistoria = $("#id_hc").val();
        dosis = $("#dosis").val();
        medicamento = $("#medicamento").val();

        if (cantidad != "" && dosis != "" && medicamento != "") {

            if (idMedicamento == "") {

                var idMedicamento = 0;

            }

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_medicamento'; ?>",
                type: 'POST',
                data: {
                    idMedicamento: idMedicamento,
                    cantidad: cantidad,
                    idHistoria: idHistoria,
                    dosis: dosis,
                    medicamento: medicamento
                },

                success: function(result) {

                    $('#idMedicamento').val("");
                    $('#medicamento').val("");
                    $('#cantidad').val("0");
                    $('#dosis').val("");
                    $("#mens").html(result);
                    $("#refresh").load(" #refresh");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens").html(html);

        }

    });


    function buscar() {
        var medicamento = $("input#medicamento").val();

        if (medicamento != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_medicamento") ?>", {
                medicamento: medicamento

            }, function(mensaje) {
                $('#lista_nombre').show();
                $("#lista_nombre").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idMedicamento').val("");
            $('#medicamento').val("");
            $('#lista_nombre').hide();
        }

    };

    function elemento_selecionado(object) {
        dato_medicamento = (object.id).split('&');

        idMedicamento = dato_medicamento[0];
        medNombre = dato_medicamento[1];


        $('#idMedicamento').val(idMedicamento);
        $('#medicamento').val(medNombre);
        $('#lista_nombre').hide();
    }


    $("#nota_adicional").click(function() {

        id_hc = $("#id_hc").val();
        nota = $("#adicional").val();

        if (id_hc != "" && nota != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/nota_adicional'; ?>",
                type: 'POST',
                data: {
                    id_hc: id_hc,
                    nota: nota
                },

                success: function(result) {

                    //console.log(result);

                    $("#id_hc").val("");
                    $("#adicional").val("");
                    $('#exampleModal').modal('hide');
                    $('#mens_nota_adicional').hide();

                    //$("#mens").html(result);
                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $('#mens_nota_adicional').show();
            $("#mens_nota_adicional").html(html);

        }

    });

    // Primera carga con skeleton loader Y barra de progreso lineal
    $(document).ready(function() {
        // Mostrar barra de progreso y skeleton loader
        $("#linearProgress").show();
        $("#skeleton-loader").show();
        
        $.ajax({
            url: "<?php echo base_url() . 'index.php/CHistoria/agenda_cita'; ?>",
            type: 'POST',
            timeout: 10000, // 10 segundos timeout
            
            success: function(result) {
                // Ocultar barra de progreso y skeleton loader
                $("#linearProgress").fadeOut(300);
                $("#skeleton-loader").hide();
                $("#mens_cita").html(result).show();
            },
            error: function() {
                $("#linearProgress").fadeOut(300);
                $("#skeleton-loader").hide();
                $("#mens_cita").html('<div class="empty-state"><i class="fas fa-exclamation-circle"></i><h5>Error al cargar las citas</h5><p>Por favor, recarga la página</p></div>').show();
            }
        });
    });


    function nota_adicional(id_hc) {


        $("#id_hc").val(id_hc);

        //alert(id_hc)

        if ($("#id_hc").val() != "") {
            $.ajax({
                url: '<?= base_url() ?>index.php/CHistoria/mostrar_medicamento',
                method: 'post',
                data: {
                    id_hc: $("#id_hc").val()
                },
                dataType: 'json',
                success: function(mensaje) {

                    console.log(mensaje);

                    var html = "<table class='table table-bordered'>";
                    html += "<thead>";
                    html += "<th>MEDICAMENTO</th>";
                    html += "<th>CANTIDAD</th>";
                    html += "<th colspan='2'>OPCION</th>";
                    html += "</thead>";
                    html += "<tbody>";
                    for (key in mensaje) {
                        html += "<tr>";
                        html += "<td>" + mensaje[key].medNombre + "</td>";
                        html += "<td>" + mensaje[key].hisMedCantidad + "</td>";
                        html += "<td>" + mensaje[key].hisMedDosis + "</td>";
                        html += "<td><button type='button' class='btn btn-outline-primary btn-view-medicamento' value='$d->id_his_med' data-toggle='modal' data-target='#modal_medicamento'>Editar</button>";
                        html += "<td><a class='btn btn-outline-danger' onclick='eliminar(" + mensaje[key].id_his_med + ")'>Eliminar</a></td>";
                        html += "</tr>";
                    }
                    html += "</tbody>";
                    html += "</table>";
                    html += "</br>";
                    //$('#lista_medicamento').show();
                    $("#lista_medicamento").html(html);
                    $('#lista_medicamento').show();
                }
            });
        }

    }*/

    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/agenda_cita'; ?>",
        type: 'POST',

        success: function(result) {

            //console.log(result);
            $("#mens_cita").html(result);
        }
    });

    function verValoracion(idCita, id_cat_cups, idProceso, pacDocumento) {

        mostrarConfirmPersonalizada('¿Realmente desea iniciar esta cita?', function(resultado) {
            if (!resultado) return;

            if (idProceso == 1) {
                if (id_cat_cups == 1) {
                    window.location.replace("<?php echo base_url() . 'index.php/CHistoria/primera_vez_hta/' ?>" + idCita)
                } else {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/CHistoria/primeraVez_control',
                        method: 'post',
                        data: {
                            pacDocumento: pacDocumento
                        },
                        dataType: 'json',
                        success: function(data) {
                            var len = data.length;
                            if (len > 0) {
                                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/control_hta/' ?>" + idCita)
                            }
                        }
                    });
                }

            } else if (idProceso == 2) {
                if (id_cat_cups == 1) {
                    window.location.replace("<?php echo base_url() . 'index.php/CHistoria/trabajo_social/' ?>" + idCita)
                } else {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/CHistoria/primeraVez_control1',
                        method: 'post',
                        data: {
                            pacDocumento: pacDocumento
                        },
                        dataType: 'json',
                        success: function(data) {
                            var len = data.length;
                            if (len > 0) {
                                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/trabajo_social_control/' ?>" + idCita)
                            }
                        }
                    });
                }

            } else if (idProceso == 3) {
                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/reformulacion/' ?>" + idCita)

            } else if (idProceso == 4) {
                if (id_cat_cups == 1) {
                    window.location.replace("<?php echo base_url() . 'index.php/CHistoria/nutricionista/' ?>" + idCita)
                } else {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/CHistoria/primeraVez_control1',
                        method: 'post',
                        data: {
                            pacDocumento: pacDocumento
                        },
                        dataType: 'json',
                        success: function(data) {
                            var len = data.length;
                            if (len > 0) {
                                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/nutricionista_control/' ?>" + idCita)
                            }
                        }
                    });
                }

            } else if (idProceso == 13) {
                if (id_cat_cups == 1) {
                    window.location.replace("<?php echo base_url() . 'index.php/CHistoria/FISIOTERAPIA/' ?>" + idCita)
                } else {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/CHistoria/primeraVez_control1',
                        method: 'post',
                        data: {
                            pacDocumento: pacDocumento
                        },
                        dataType: 'json',
                        success: function(data) {
                            var len = data.length;
                            if (len > 0) {
                                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/Fisioterapia_control/' ?>" + idCita)
                            }
                        }
                    });
                }

            } else if (idProceso == 5) {
                if (id_cat_cups == 1) {
                    window.location.replace("<?php echo base_url() . 'index.php/CHistoria/psicologia/' ?>" + idCita)
                } else {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/CHistoria/primeraVez_control1',
                        method: 'post',
                        data: {
                            pacDocumento: pacDocumento
                        },
                        dataType: 'json',
                        success: function(data) {
                            var len = data.length;
                            if (len > 0) {
                                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/psicologia_control/' ?>" + idCita)
                            }
                        }
                    });
                }

            } else if (idProceso == 6) {
                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/historia_clinica/' ?>" + idCita)

            } else if (idProceso == 7) {
                window.location.replace("<?php echo base_url() . 'index.php/CHistoria/historia_clinica/' ?>" + idCita)
            }
        });
    }
</script>
