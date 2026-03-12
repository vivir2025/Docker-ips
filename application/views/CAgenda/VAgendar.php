<!-- ═══ Google-style top bar — IPS Cajibio (Agenda) ═════════════════════ -->
<style>
#ips-topbar-ag {
    position: fixed; top: 0; left: 0;
    height: 3px; width: 0%; z-index: 99999;
    background: linear-gradient(90deg, #3498db 0%, #85d8ff 40%, #2980b9 70%, #3498db 100%);
    background-size: 300% 100%;
    border-radius: 0 2px 2px 0;
    box-shadow: 0 0 10px rgba(52,152,219,0.8);
    animation: ips-shine-ag 1.2s linear infinite;
    display: none;
}
@keyframes ips-shine-ag {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>

<div id="ips-topbar-ag"></div>

<style type="text/css">
/* Estilos mejorados para la vista de agenda */
.agenda-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

.agenda-header-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid #e0e0e0;
}

.agenda-header-section h4 {
    color: #2c3e50;
    margin: 0 0 20px 0;
    font-weight: 700;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.agenda-header-section h4 i {
    color: #3498db;
}

/* Skeleton Loader */
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

/* Tarjetas de agenda */
.agenda-display-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.12);
    border: 2px solid #e0e0e0;
    margin-bottom: 25px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.agenda-display-card:hover {
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

/* Tabla profesional */
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
    text-align: center;
}

.agenda-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    font-size: 14px;
    border-bottom: 1px solid #e9ecef;
    text-align: center;
}

.agenda-table tbody tr {
    transition: background-color 0.2s ease;
}

.agenda-table tbody tr:hover {
    background-color: #f8f9fa;
}

.cita-numero {
    font-weight: 700;
    color: #3498db;
    font-size: 16px;
}

.cita-hora {
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
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

.badge-cancelado {
    background: #ffebee;
    color: #c62828;
}

.btn-agenda-action {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0 3px;
}

.btn-agenda-primary {
    background: #3498db;
    color: white;
}

.btn-agenda-primary:hover {
    background: #2980b9;
    transform: scale(1.05);
}

.btn-agenda-danger {
    background: #e74c3c;
    color: white;
}

.btn-agenda-danger:hover {
    background: #c0392b;
    transform: scale(1.05);
}

.btn-agenda-success {
    background: #27ae60;
    color: white;
}

.btn-agenda-success:hover {
    background: #229954;
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

/* Estilos mejorados para formularios */
.agenda-header-section label {
    font-weight: 600;
    color: #495057;
    font-size: 13px;
    margin-bottom: 8px;
}

.agenda-header-section .form-control {
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.agenda-header-section .form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
}

.agenda-header-section select.form-control {
    cursor: pointer;
}

/* Estilos para modales profesionales */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    border-bottom: none;
    padding: 20px 25px;
}

.modal-header .close {
    color: white;
    opacity: 1;
    text-shadow: none;
    font-size: 28px;
}

.modal-header .close:hover {
    opacity: 0.8;
}

.modal-title {
    font-weight: 700;
    font-size: 20px;
}

.modal-body {
    padding: 25px;
}

.modal-body label {
    font-weight: 600;
    color: #495057;
    font-size: 13px;
    margin-bottom: 8px;
}

.modal-body .form-control {
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.modal-body .form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
}

.modal-footer {
    border-top: 2px solid #f0f0f0;
    padding: 15px 25px;
}

.modal-footer .btn {
    border-radius: 6px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.modal-footer .btn-primary {
    background: #3498db;
    border: none;
}

.modal-footer .btn-primary:hover {
    background: #2980b9;
    transform: scale(1.05);
}

.modal-footer .btn-secondary {
    background: #95a5a6;
    border: none;
}

.modal-footer .btn-secondary:hover {
    background: #7f8c8d;
}

/* Forzar ancho completo en inputs de hora */
input[type="time"].form-control {
    min-width: 0;
    width: 100%;
}

#lista_nombre, #lista_codigo {
    border: 1px solid #ddd;
    background-color: #fff;
    position: absolute;
    z-index: 1000;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    margin-top: 2px;
}

#respuesta_nombre .elemento-lista,
#respuesta_codigo .elemento-lista {
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border-bottom: 1px solid #f0f0f0;
}

#respuesta_nombre .elemento-lista:hover,
#respuesta_codigo .elemento-lista:hover {
    background-color: #e3f2fd;
}

#respuesta_nombre .elemento-lista:last-child,
#respuesta_codigo .elemento-lista:last-child {
    border-bottom: none;
}

#respuesta_nombre .text-danger,
#respuesta_codigo .text-danger {
    color: red;
    padding: 10px;
    font-size: 14px;
}

/* Alerta personalizada bonita */
.custom-alert-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.custom-alert-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.7);
    background: white;
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    min-width: 350px;
    animation: zoomIn 0.3s ease forwards;
}

.custom-alert-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #28a745;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: scaleUp 0.5s ease;
}

.custom-alert-icon svg {
    width: 50px;
    height: 50px;
    stroke: white;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
    fill: none;
    animation: drawCheck 0.5s ease 0.3s forwards;
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
}

.custom-alert-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.custom-alert-message {
    font-size: 16px;
    color: #666;
    margin-bottom: 25px;
}

.custom-alert-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.custom-alert-btn:hover {
    background: #218838;
    transform: scale(1.05);
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

@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}

    
</style>
<div class="agenda-container">
    <!-- Sección de consulta de agenda -->
    <div class="agenda-header-section">
        <h4><i class="fa fa-search"></i> Consultar Agenda</h4>
        <form>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Profesional</label>
                <select class="form-control" name="profesional" required="" id='profesional'>
                    <option value="">[Seleccione]</option>
                    <?php
                    foreach ($usuario as $usu) {
                        echo "<option value='" . $usu['idUsuario'] . "' >" . $usu['usuNombre'] . " " . $usu['usuApellido'] .  "</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="form-group col-md-2">
                <label>Area</label>
                <select class="form-control" name="area" required="" id="area">
                    <option value="">[Seleccione]</option>
                    <?php
                    foreach ($proceso as $pro) {
                        echo "<option value={$pro->idProceso}>{$pro->proNombre}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Sede</label>
                <select class="form-control" name="sede" id="sede">
                    <option value="">[Seleccione]</option>
                    <?php
                    foreach ($sede as $s) {
                        echo "<option value={$s->idSede}>{$s->sedNombre}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Consultorio</label>
                <input class="form-control" name="consultorio" placeholder="Consultorio" type="text" id="consultorio">
            </div>
            <div class="form-group col-md-2">
                <label>Fecha</label>
                <input class="form-control" name="fecha" id="fecha" type="date" required="">
            </div>
            <div class="form-group col-md-2">
                <label style="opacity: 0;">---</label>
                <button type="button" class="form-control btn-agenda-action btn-agenda-primary" onclick="buscar_agenda()" style="height: 38px;"><i class="fa fa-search"></i> Consultar</button>
            </div>
        </div>
        </form>
    </div>

    <!-- Sección de crear agenda -->
    <div class="agenda-header-section" id="crear_agenda" style="display: none;">
        <h4><i class="fa fa-calendar-plus"></i> Crear Nueva Agenda</h4>
        <form>
        <!-- Fila 1: Horarios, intervalo, brigada y modalidad -->
        <div class="form-row">
            <div class="form-group col-md-2">
                <label><i class="fa fa-clock-o" style="color:#3498db"></i> Hora Inicio</label>
                <input class="form-control" name="inicio" type="time" id="inicio">
            </div>
            <div class="form-group col-md-2">
                <label><i class="fa fa-clock-o" style="color:#e74c3c"></i> Hora Fin</label>
                <input class="form-control" name="fin" type="time" id="fin">
            </div>
            <div class="form-group col-md-2">
                <label><i class="fa fa-sliders" style="color:#3498db"></i> Intervalo</label>
                <select class="form-control" name="intervalo" id="intervalo">
                    <option value="">[Seleccione]</option>
                    <option value="5">5 Minutos</option>
                    <option value="10">10 Minutos</option>
                    <option value="15">15 Minutos</option>
                    <option value="20">20 Minutos</option>
                    <option value="25">25 Minutos</option>
                    <option value="30">30 Minutos</option>
                    <option value="35">35 Minutos</option>
                    <option value="40">40 Minutos</option>
                    <option value="45">45 Minutos</option>
                    <option value="50">50 Minutos</option>
                    <option value="55">55 Minutos</option>
                    <option value="60">60 Minutos</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label><i class="fa fa-users" style="color:#3498db"></i> Brigada</label>
                <select class="form-control" name="brigada" id="brigada">
                    <option value="">[Seleccione]</option>
                    <?php
                    foreach ($brigada as $b) {
                        echo "<option value={$b->idBrigada}>{$b->briNombre}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label><i class="fa fa-hospital-o" style="color:#3498db"></i> Modalidad</label>
                <select class="form-control" name="modalidad" id="modalidad">
                    <option value="">[Seleccione]</option>
                    <option value="TELEMEDICINA">TELEMEDICINA</option>
                    <option value="INTRAMURAL">INTRAMURAL</option>
                    <option value="EXTRAMURAL">EXTRAMURAL</option>
                </select>
            </div>
        </div>
        <!-- Fila 2: Etiqueta y botón -->
        <div class="form-row align-items-end">
            <div class="form-group col-md-5">
                <label><i class="fa fa-tag" style="color:#3498db"></i> Etiqueta</label>
                <select class="form-control" name="etiqueta" id="etiqueta">
                    <option value="">[Seleccione]</option>
                    <option value="REFORMULACION">REFORMULACION</option>
                    <option value="VISITA DOMICILIARIA">VISITA DOMICILIARIA</option>
                    <option value="CONTROL">CONTROL</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <button type="button" class="btn-agenda-action btn-agenda-success btn-block" id="add_agenda" style="height: 38px; font-size:14px;">
                    <i class="fa fa-plus-circle"></i> Crear Agenda
                </button>
            </div>
        </div>
        </form>
    </div>

    <br>
    <div id="mens"></div>
    <div id="resultado" style="display: none;">
        <!-- Skeleton Loader -->
        <div id="skeletonLoader" class="skeleton-loader" style="display: none;">
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
        <!-- Contenedor de resultados -->
        <div id="agendaResultados"></div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><i class="fa fa-calendar-plus"></i> Agendar Nueva Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>

                        <input name='idAgenda' id="idAgenda" hidden="" />

                        <input name='ageFecha' id="ageFecha" hidden="" />

                        <input name="fecha_inicial" id="fecha_inicial" hidden="" />

                        <input name="fecha_fin" id="fecha_fin" hidden="" />

                        <input id='id_paciente' name='id_paciente' hidden="" />

                        <input id='cups_contratado' name='cups_contratado' hidden="" />
                        <div id="mens_cita" style="display: none;"></div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>N° Documento</label>
                                <input class="form-control" name="documento" type="text" required="" id="documento">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tipo Documento</label>
                                <input type="text" class="form-control" name="tipo" id="tipo" readonly="readonly" placeholder="TIPO IDENTIFICACION..." />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Nombre</label>
                                <input class="form-control" name="nombre" type="text" required="" id="nombre" readonly="" placeholder="NOMBRE...">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" readonly="readonly" placeholder="APELLIDO..." />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Fecha nacimiento</label>
                                <input class="form-control" name="fecha_nacimiento" type="text" required="" id="fecha_nacimiento" readonly="" placeholder="FECHA NACIMIENTO...">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sexo</label>
                                <input type="text" class="form-control" name="sexo" id="sexo" readonly="readonly" placeholder="SEXO..." />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Domicilio</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" readonly="readonly" placeholder="DOMICILIO..." />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" readonly="readonly" placeholder="TELEFONO..." />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Regimen</label>
                                <input class="form-control" name="regimen" type="text" required="" id="regimen" readonly="" placeholder="REGIMEN...">
                            </div>
                            <div class="form-group col-md-3">
                                <label>EPS</label>
                                <input type="text" class="form-control" name="empresa" id="empresa" readonly="readonly" placeholder="EPS..." />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tipo patologia</label>
                                <select class="form-control" required="" name="patologia" id="patologia">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="HTA">HTA</option>
                                    <option value="DM">DM</option>
                                    <option value="ERC">ERC</option>
                                    <option value="NUEVO">NUEVO</option>
                                    <option value="EVENTO">EVENTO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Fecha deseada</label>
                                <input type="date" class="form-control" name="fecha_deseada" id="fecha_deseada" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Peso - Perimetro</label>
                                <textarea type="text" class="form-control" name="nota" id="nota" required="" placeholder="Peso- Perimetro"></textarea>
                            </div>
                        </div>
                        <div class="form-row" id="historial_cita" style="display: none;">
                        </div>
                        <p style="color: blue;">Cups</p>
                        <hr>
                        <div id="mensaje" style="display: none;">
                            <p style='color:red;'>No puede seleccionar este servicio</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Codigo</label>
                                <input class="form-control" name="codigo" type="text" required="" id="codigo" placeholder="CODIGO..." autocomplete="off">
                                <!-- Lista para autocompletar por codigo -->
                                <div id="lista_codigo" style="display: none;">
                                    <div id="respuesta_codigo"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-10 position-relative">
                                <label for="cup">Cups</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="cup" 
                                    id="cup" 
                                    placeholder="CUPS..." 
                                    autocomplete="off" 
                                />
                                <!-- Lista para autocompletar -->
                                <div id="lista_nombre" class="dropdown-menu w-100" style="display: none; max-height: 200px; overflow-y: auto;">
                                    <div id="respuesta_nombre"></div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <a class="btn btn-primary" id="add_cita">Crear agenda</a>
                            <!--a class="btn btn-primary" id="add_cita">Agendar Cita</a-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Modal Agregar  Cita-->

    <!-- Modal Cancelar Cita-->
    <div class="modal fade bd-example-modal-lg-cancelar-cita" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><i class="fa fa-times-circle"></i> Cancelar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input name='idCita' id="idCita" hidden="" />
                        <div id="mens_cita_cancelar" style="display: none;"></div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Registre el motivo por el cual desea cancelar la cita</label>
                                <textarea class="form-control" name="motivo" id="motivo" type="text" required="" id="motivo" placeholder="Digite el motivo"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <a class="btn btn-primary" id="cancelar_cita">Cancelar cita</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Modal Agregar -->


</div>

<!-- Alerta personalizada -->
<div id="customAlert" class="custom-alert-overlay">
    <div class="custom-alert-box">
        <div class="custom-alert-icon">
            <svg viewBox="0 0 52 52">
                <polyline points="14 27 22 35 38 19"/>
            </svg>
        </div>
        <div class="custom-alert-title">¡Éxito!</div>
        <div class="custom-alert-message" id="customAlertMessage">Paciente agendado correctamente</div>
        <button class="custom-alert-btn" onclick="cerrarAlertaPersonalizada()">Aceptar</button>
    </div>
</div>

<script type='text/javascript'>

      // Funciones para alerta personalizada
      function mostrarAlertaPersonalizada(titulo, mensaje, tipo) {
          $('#customAlertMessage').text(mensaje);
          $('.custom-alert-title').text(titulo);
          
          // Cambiar color según tipo
          var color = tipo === 'success' ? '#28a745' : tipo === 'error' ? '#dc3545' : '#ffc107';
          $('.custom-alert-icon').css('background', color);
          $('.custom-alert-btn').css('background', color);
          
          $('#customAlert').fadeIn(300);
      }
      
      function cerrarAlertaPersonalizada() {
          $('#customAlert').fadeOut(300);
      }
      
      // Cerrar con ESC o click fuera
      $(document).on('keydown', function(e) {
          if (e.key === 'Escape' && $('#customAlert').is(':visible')) {
              cerrarAlertaPersonalizada();
          }
      });
      
      $('#customAlert').on('click', function(e) {
          if (e.target.id === 'customAlert') {
              cerrarAlertaPersonalizada();
          }
      });

      // Limpiar modal cuando se cierra sin guardar
      $('#exampleModal').on('hidden.bs.modal', function () {
          limpiar_formulario_cita();
      });

      function eliminar(id) {
          if (confirm('¿Usted desea eliminar la agenda? Recuerde que las citas asignadas al itinerario tambien seran eliminadas.')) {
              document.location.href = "<?php echo base_url() . 'index.php/CAgenda/eliminar/' ?>" + id;
          }
        }

      $("#cancelar_cita").click(function() {

        idCita = $("#idCita").val();
        motivo = $("#motivo").val();

        if (idCita != "" && motivo != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CCita/cancelar'; ?>",
                type: 'POST',
                data: {
                    idCita: idCita,
                    motivo: motivo
                },

                success: function(result) {

                    //console.log(result);

                    $("#idCita").val("");
                    $("#motivo").val("");
                    $('#exampleModal1').modal('hide');
                    $('#mens_cita_cancelar').hide();
                    buscar_agenda();

                    //$("#mens").html(result);
                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $('#mens_cita_cancelar').show();
            $("#mens_cita_cancelar").html(html);

        }

    });

    $("#add_cita").click(function () {
    // Captura los valores del formulario
    var idAgenda = $("#idAgenda").val();
    var fecha_inicial = $("#fecha_inicial").val();
    var fecha_fin = $("#fecha_fin").val();
    var id_paciente = $("#id_paciente").val();
    var cups_contratado = $("#cups_contratado").val();
    var fecha_deseada = $("#fecha_deseada").val();
    var nota = $("#nota").val();
    var ageFecha = $("#ageFecha").val();
    var patologia = $("#patologia").val();

    // Validación de campos
    if (
        idAgenda !== "" &&
        fecha_inicial !== "" &&
        fecha_fin !== "" &&
        id_paciente !== "" &&
        cups_contratado !== "" &&
        fecha_deseada !== "" &&
        nota !== "" &&
        ageFecha !== "" &&
        patologia !== ""
    ) {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/CCita/agregar'; ?>",
            type: "POST",
            data: {
                idAgenda: idAgenda,
                fecha_inicial: fecha_inicial,
                fecha_fin: fecha_fin,
                id_paciente: id_paciente,
                cups_contratado: cups_contratado,
                fecha_deseada: fecha_deseada,
                nota: nota,
                ageFecha: ageFecha,
                patologia: patologia,
            },
            success: function (result) {
                // Llamar a la función para buscar la agenda actualizada
                buscar_agenda();

                // Limpiar los campos del formulario
                $("#id_paciente, #documento, #tipo, #nombre, #apellido, #fecha_nacimiento, #sexo, #direccion, #telefono, #regimen, #empresa, #idAgenda, #fecha_inicial, #fecha_fin, #cups_contratado, #fecha_deseada, #nota, #ageFecha, #patologia, #etiqueta, #codigo, #cup").val("");
                $('#mens_cita').hide();

                // Cerrar el modal
                $('#exampleModal').modal('hide');

                // Mostrar alerta bonita
                setTimeout(function() {
                    mostrarAlertaPersonalizada('¡Éxito!', 'Paciente agendado correctamente', 'success');
                }, 300);
            },
        });
    } else {
        // Mostrar mensaje de error si hay campos vacíos
        var html =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
            "No deje campos vacíos" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span>" +
            "</button>" +
            "</div>";
        $("#mens_cita").show().html(html);
    }
});




    $("#add_agenda").click(function() {

        profesional = $("#profesional").val();
        area = $("#area").val();
        sede = $("#sede").val();
        consultorio = $("#consultorio").val();
        fecha = $("#fecha").val();
        inicio = $("#inicio").val();
        fin = $("#fin").val();
        intervalo = $("#intervalo").val();
        modalidad = $("#modalidad").val();
        etiqueta = $("#etiqueta").val();
        brigada = $("#brigada").val();


        if (profesional != "" && area != "" && sede != "" && consultorio != "" && fecha != "" && inicio != "" && fin != "" && intervalo != "" && modalidad != "" && etiqueta != "" && brigada != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CAgenda/agregar'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    profesional: profesional,
                    area: area,
                    sede: sede,
                    consultorio: consultorio,
                    fecha: fecha,
                    inicio: inicio,
                    fin: fin,
                    intervalo: intervalo,
                    modalidad: modalidad,
                    etiqueta: etiqueta,
                    brigada: brigada
                },

                success: function(result) {
                    if (result.status === 'error') {
                        // Mostrar mensaje de error si ya existe la agenda
                        html = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" + result.message + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        $("#mens").html(html);
                    } else {
                        // Éxito - actualizar la vista
                        buscar_agenda();
                        $('#sede').val("");
                        $('#consultorio').val("");
                        $('#inicio').val("");
                        $('#fin').val("");
                        $('#intervalo').val("");
                        $('#modalidad').val("");
                        $("#etiqueta").val("");
                        $("#brigada").val("");
                        
                        // Mostrar alerta bonita personalizada
                        setTimeout(function() {
                            mostrarAlertaPersonalizada('¡Éxito!', 'Agenda creada correctamente', 'success');
                        }, 300);
                    }
                },
                error: function() {
                    html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Error al crear la agenda. Por favor intente nuevamente.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    $("#mens").html(html);
                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens").html(html);

        }

    });

    //Cancelar cita

    var idCita = 0;

    function cancel(idCita) {

        idCita = idCita;
        $("#idCita").val(idCita);

    }


    //Cita

    var idProceso = 0;
    var idUsuario = 0;
    var ageFecha = ''; ///Fecha Cita
    var ageHoraInicio = '';
    var hora_final = '';
    var idAgenda = 0;

    function save_agenda(idProceso, idUsuario, ageFecha, fechaInit, fechaEnd, idAgenda) {
        idProceso = idProceso;
        idUsuario = idUsuario;
        ageFecha = ageFecha;
        fechaInit = fechaInit;
        fechaEnd = fechaEnd;
        idAgenda = idAgenda;


        $("#idAgenda").val(idAgenda);
        $("#fecha_inicial").val(fechaInit);
        $("#fecha_fin").val(fechaEnd);
        $("#ageFecha").val(ageFecha);

        //console.log(idAgenda);
    }


    ///Cups busqueda

    // Variables para controlar si estamos seleccionando un elemento
    var seleccionandoElemento = false;
    var timeoutBusqueda = null;
    var ultimoValorCup = '';
    var ultimoValorCodigo = '';

    // Búsqueda por código con debounce y control de cambios
    $("#codigo").on("input", function(e) {
        if (seleccionandoElemento) {
            e.stopImmediatePropagation();
            return false;
        }
        
        var valorInput = $(this).val().trim();
        
        // Si el valor no cambió, no hacer nada
        if (valorInput === ultimoValorCodigo) return;
        ultimoValorCodigo = valorInput;
        
        clearTimeout(timeoutBusqueda);
        
        if (valorInput === "") {
            $("#lista_codigo").hide();
            return;
        }
        
        timeoutBusqueda = setTimeout(function() {
            if (!seleccionandoElemento) {
                buscar_cups_codigo();
            }
        }, 400);
    });

    // Búsqueda por nombre con debounce y control de cambios
    $("#cup").on("input", function(e) {
        if (seleccionandoElemento) {
            e.stopImmediatePropagation();
            return false;
        }
        
        var valorInput = $(this).val().trim();
        
        // Si el valor no cambió, no hacer nada
        if (valorInput === ultimoValorCup) return;
        ultimoValorCup = valorInput;
        
        clearTimeout(timeoutBusqueda);
        
        if (valorInput === "") {
            $("#lista_nombre").hide();
            return;
        }
        
        timeoutBusqueda = setTimeout(function() {
            if (!seleccionandoElemento) {
                buscar_cups_nombre();
            }
        }, 400);
    });
    
    // Prevenir que se dispare el evento al hacer focus
    $("#cup, #codigo").on("focus", function() {
        ultimoValorCup = $("#cup").val();
        ultimoValorCodigo = $("#codigo").val();
    });

    function buscar_cups_codigo() {
        var textoBusqueda = $("input#codigo").val().trim();
        var documento = $("input#documento").val();
        var agenda = $("#idAgenda").val();

        if (textoBusqueda !== "") {
            $("#respuesta_codigo").html("<div>Cargando...</div>");
            $('#lista_codigo').show();

            $.post("<?= base_url("index.php/CCups_Contratado/cups_codigo_detalle") ?>", {
                valorBusqueda: textoBusqueda,
                documento: documento,
                agenda: agenda
            })
            .done(function(data) {
                $("#respuesta_codigo").html(data);
                $('#lista_codigo').show();
            })
            .fail(function() {
                $("#respuesta_codigo").html("<div class='text-danger'>Error al cargar resultados</div>");
            });
        } else {
            $("#cups_contratado").val("");
            $("#cup").val("");
            $('#lista_codigo').hide();
        }
    }

    function buscar_cups_nombre() {
        var textoBusqueda = $("input#cup").val().trim();
        var documento = $("input#documento").val();
        var agenda = $("#idAgenda").val();

        // Evitar consultas vacías
        if (textoBusqueda !== "") {
            // Mostrar un mensaje de carga
            $("#respuesta_nombre").html("<div>Cargando...</div>");
            $('#lista_nombre').show();

            // Hacer la solicitud AJAX
            $.post("<?= base_url('index.php/CCups_Contratado/cups_nombre_detalle') ?>", {
                valorBusqueda: textoBusqueda,
                documento: documento,
                agenda: agenda
            })
            .done(function(data) {
                // Mostrar los resultados
                $("#respuesta_nombre").html(data);
                $('#lista_nombre').show();
            })
            .fail(function() {
                // Mostrar mensaje de error si falla
                $("#respuesta_nombre").html("<div class='text-danger'>Error al cargar resultados</div>");
            });
        } else {
            // Ocultar la lista si no hay texto
            $('#lista_nombre').hide();
            $("#cups_contratado").val("");
            $("#codigo").val("");
        }
    }

    // Delegar el clic en elementos dinámicos para evitar problemas
    $(document).on("click", ".elemento-lista", function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        // Activar flag INMEDIATAMENTE para evitar trigger de búsqueda
        seleccionandoElemento = true;
        
        var elemento = $(this);
        var nombreCup = elemento.data("nombre");
        var codigoCup = elemento.data("codigo");
        var cupsContratado = elemento.data("cups-contratado");
        var tarifa = elemento.data("tarifa");
        var categoria = elemento.data("categoria");
        var pacienteCategoria = elemento.data("paciente-categoria");

        // Limpiar timeouts pendientes
        clearTimeout(timeoutBusqueda);
        
        // Ocultar los listados PRIMERO
        $('#lista_nombre').hide();
        $('#lista_codigo').hide();
        $('#mensaje').hide();
        
        // Actualizar valores de referencia ANTES de asignar
        ultimoValorCup = nombreCup;
        ultimoValorCodigo = codigoCup;
        
        // Asignar valores a los inputs DESPUÉS de ocultar listas
        $("#cup").val(nombreCup);
        $("#codigo").val(codigoCup);
        $("#cups_contratado").val(cupsContratado);
        
        console.log("CUPS seleccionado: " + nombreCup + " - " + codigoCup);
        
        // Desactivar flag después de un delay más largo
        setTimeout(function() {
            seleccionandoElemento = false;
        }, 700);
        
        return false;
    });

    // Cerrar el listado si el usuario hace clic fuera
    $(document).on("click", function(e) {
        if (!$(e.target).closest("#lista_nombre, #cup, #lista_codigo, #codigo").length) {
            $('#lista_nombre').hide();
            $('#lista_codigo').hide();
        }
    });



    // Valores asignados codigo y nombre cups (FUNCIÓN LEGACY - mantener para compatibilidad)

    function elemento_selecionado(object) {
        // Activar flag para evitar búsquedas
        seleccionandoElemento = true;
        
        datos_cups = (object.id).split('&');

        paciente_categoria = datos_cups[5];
        categoria_cups = datos_cups[4];

        // Limpiar timeouts
        clearTimeout(timeoutBusqueda);
        
        // Ocultar listas PRIMERO
        $('#lista_nombre').hide();
        $('#lista_codigo').hide();
        $('#mensaje').hide();
        
        // Actualizar valores de referencia ANTES de asignar
        ultimoValorCup = datos_cups[0];
        ultimoValorCodigo = datos_cups[1];
        
        // Asignar valores DESPUÉS
        $('#cup').val(datos_cups[0]);
        $('#codigo').val(datos_cups[1]);
        $('#cups_contratado').val(datos_cups[2]);
        
        // Desactivar flag después de un delay
        setTimeout(function() {
            seleccionandoElemento = false;
        }, 700);

        //  $('#mensaje').show();
        /*if(paciente_categoria == 5){

            $('#cup').val("");
            $('#codigo').val("");
            $('#mensaje').show();

        }else if (paciente_categoria == 6){

            $('#cup').val(datos_cups[0]);
            $('#codigo').val(datos_cups[1]);
            $('#cups_contratado').val(datos_cups[2]);
            $('#lista_nombre').hide();
            $('#mensaje').hide();
            $('#lista_codigo').hide();

        }
        else if (paciente_categoria == 4) {

            $('#cup').val(datos_cups[0]);
            $('#codigo').val(datos_cups[1]);
            $('#cups_contratado').val(datos_cups[2]);
            $('#lista_nombre').hide();
            $('#mensaje').hide();
            $('#lista_codigo').hide();

        } else {

            if (paciente_categoria == 1 && paciente_categoria == categoria_cups) {

                //console.log(paciente_categoria +" "+ categoria_cups +"-1");

                $('#cup').val("");
                $('#codigo').val("");
                $('#mensaje').show();

            } else if (paciente_categoria == 2 && paciente_categoria == categoria_cups) {

                $('#cup').val(datos_cups[0]);
                $('#codigo').val(datos_cups[1]);
                $('#cups_contratado').val(datos_cups[2]);
                $('#lista_nombre').hide();
                $('#mensaje').hide();
                $('#lista_codigo').hide();

                //console.log(paciente_categoria +" "+ categoria_cups +"-2");

            } else if (paciente_categoria == 3 && categoria_cups == 1) {

                $('#cup').val(datos_cups[0]);
                $('#codigo').val(datos_cups[1]);
                $('#cups_contratado').val(datos_cups[2]);
                $('#lista_nombre').hide();
                $('#mensaje').hide();
                $('#lista_codigo').hide();

                //console.log(paciente_categoria +" "+ categoria_cups +"-3");

            } else if (paciente_categoria == 1 && categoria_cups == 2) {

                $('#cup').val(datos_cups[0]);
                $('#codigo').val(datos_cups[1]);
                $('#cups_contratado').val(datos_cups[2]);
                $('#lista_nombre').hide();
                $('#mensaje').hide();
                $('#lista_codigo').hide();

                //console.log(paciente_categoria +" "+ categoria_cups +"-4");

            } else {

                $('#cup').val("");
                $('#codigo').val("");
                $('#mensaje').show();

                //console.log(paciente_categoria +" "+ categoria_cups +"-5");

            }
        }*/
    }

    ///Traer paciente por documento


    $("#documento").change(function() {

        verificar_paciente();
    });

    function verificar_paciente() {

        var pacDocumento = $("#documento").val();

        $.ajax({
            url: '<?= base_url() ?>index.php/CCita/usuario_detalle',
            method: 'post',
            data: {
                pacDocumento: pacDocumento
            },
            dataType: 'json',

            success: function(data) {
                //console.log(response);
                var len = data.length;

                if (len > 0) {

                    $("#id_paciente").val(data[0].idPaciente);
                    $("#tipo").val(data[0].docNombre);
                    $("#nombre").val(data[0].pacNombre);
                    $("#apellido").val(data[0].pacApellido);
                    $("#fecha_nacimiento").val(data[0].pacFecNacimiento);
                    $("#sexo").val(data[0].pacSexo);
                    $("#direccion").val(data[0].pacDireccion);
                    $("#telefono").val(data[0].pacTelefono);
                    $("#regimen").val(data[0].regNombre);
                    $("#empresa").val(data[0].empNombre);

                    // Activar flag antes de limpiar campos
                    seleccionandoElemento = true;
                    clearTimeout(timeoutBusqueda);
                    
                    // Actualizar valores de referencia
                    ultimoValorCup = '';
                    ultimoValorCodigo = '';
                    
                    $("#codigo").val("");
                    $("#cup").val("");
                    $("#cups_contratado").val("");
                    
                    setTimeout(function() { seleccionandoElemento = false; }, 500);

                    var html = "<a class='btn btn-link' onclick = 'historial(" + data[0].idPaciente + ")'>HISTORIAL DE CITAS</a>";

                    $('#historial_cita').show();
                    $("#historial_cita").html(html);




                } else {

                    limpiar_formulario_paciente();

                }

            }
        });
    }

    function historial(id) {

        url = "<?php echo base_url() . 'index.php/CAgenda/historial/' ?>" + id;
        window.open(url);
    }

    // Limpiar formulario paciente
    function limpiar_formulario_paciente() {
        $("#id_paciente").val("");
        $("#documento").val("");
        $("#tipo").val("");
        $("#nombre").val("");
        $("#apellido").val("");
        $("#fecha_nacimiento").val("");
        $("#sexo").val("");
        $("#direccion").val("");
        $("#telefono").val("");
        $("#regimen").val("");
        $("#empresa").val("");
    }

    // Limpiar formulario completo de cita
    function limpiar_formulario_cita() {
        // Activar flag para evitar búsquedas mientras limpiamos
        seleccionandoElemento = true;
        
        // Limpiar datos del paciente
        limpiar_formulario_paciente();
        
        // Limpiar campos de CUPS
        $("#codigo").val("");
        $("#cup").val("");
        $("#cups_contratado").val("");
        
        // Limpiar otros campos
        $("#idAgenda").val("");
        $("#fecha_inicial").val("");
        $("#fecha_fin").val("");
        $("#ageFecha").val("");
        $("#patologia").val("");
        $("#fecha_deseada").val("");
        $("#nota").val("");
        
        // Ocultar listas y mensajes
        $('#lista_nombre').hide();
        $('#lista_codigo').hide();
        $('#mensaje').hide();
        $('#mens_cita').hide();
        $('#historial_cita').hide();
        
        // Desactivar flag después de limpiar
        setTimeout(function() {
            seleccionandoElemento = false;
        }, 500);
    }


    ///Agenda

    // ── Barra de progreso ─────────────────────────────────────────────────
    var $barAG = $('#ips-topbar-ag'), barTimerAG;

    function barStartAG() {
        clearTimeout(barTimerAG);
        $barAG.stop(true).css({ width: '0%', display: 'block' }).animate({ width: '75%' }, 700);
    }
    function barDoneAG() {
        $barAG.animate({ width: '100%' }, 200, function () {
            var self = $(this);
            barTimerAG = setTimeout(function () { self.fadeOut(300).css('width', '0%'); }, 250);
        });
    }

    //$('#buttonConsultar').click(function(evento){
    function buscar_agenda() {
        var idUsuario = $('#profesional').val();
        var ageFecha = $('#fecha').val();
        var idProceso = $('#area').val();

        // Mostrar skeleton loader + barra superior
        $('#resultado').show();
        $('#skeletonLoader').show();
        $('#agendaResultados').html('');
        barStartAG();

        $.post("<?= base_url("index.php/CAgenda/mostrarAgenda") ?>", {
            usuario: idUsuario,
            fecha: ageFecha,
            proceso: idProceso
        }, function(data) {
            // Ocultar skeleton, mostrar resultados, completar barra
            $('#skeletonLoader').hide();
            $('#crear_agenda').show();
            $("#agendaResultados").html(data);
            barDoneAG();
        });
    }
    //});
</script>