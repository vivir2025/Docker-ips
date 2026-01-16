<style>
/* Estilos profesionales para lista de pacientes */
.pacientes-container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 20px;
}

.pacientes-header {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pacientes-header h4 {
    color: #2c3e50;
    margin: 0;
    font-weight: 700;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pacientes-header h4 i {
    color: #3498db;
}

.btn-add-patient {
    padding: 12px 24px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-add-patient:hover {
    background: #229954;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
    color: white;
    text-decoration: none;
}

/* Tabla profesional de pacientes */
.pacientes-table-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.12);
    border: 3px solid #e0e0e0;
    overflow: hidden;
}

.table-responsive {
    overflow-x: auto;
}

.pacientes-table {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.pacientes-table thead {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
}

.pacientes-table thead th {
    padding: 14px 12px;
    font-size: 13px;
    font-weight: 700;
    color: white;
    border: 2px solid #2874a6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.pacientes-table tbody td {
    padding: 12px;
    vertical-align: middle;
    font-size: 13px;
    border: 2px solid #dee2e6;
    border-top: none;
    text-align: center;
}

.pacientes-table tbody tr {
    transition: background-color 0.2s ease;
    background: white;
}

.pacientes-table tbody tr:hover {
    background-color: #f8f9fa;
}

.patient-doc {
    font-weight: 700;
    color: #3498db;
    font-size: 14px;
}

.patient-name {
    font-weight: 600;
    color: #2c3e50;
}

.patient-age {
    font-weight: 600;
    color: #7f8c8d;
    font-size: 16px;
}

.badge-afiliacion {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    background: #e3f2fd;
    color: #1976d2;
}

.badge-estado {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
}

.badge-activo {
    background: #e8f5e9;
    color: #388e3c;
}

.badge-inactivo {
    background: #ffebee;
    color: #c62828;
}

.btn-action-table {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-update {
    background: #3498db;
    color: white;
}

.btn-update:hover {
    background: #2980b9;
    transform: scale(1.05);
    color: white;
    text-decoration: none;
}

.btn-delete {
    background: #e74c3c;
    color: white;
}

.btn-delete:hover {
    background: #c0392b;
    transform: scale(1.05);
    color: white;
}

/* Modal mejorado */
.modal-content {
    border-radius: 12px;
    border: none;
}

.modal-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    padding: 20px 25px;
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
}

.modal-body .form-control {
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
}

.modal-body .form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
}

.modal-footer {
    border-top: 2px solid #f0f0f0;
    padding: 15px 25px;
}

/* Alerta personalizada */
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
    animation: zoomIn 0.3s ease forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    to { transform: translate(-50%, -50%) scale(1); }
}

.custom-alert-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-alert-icon.success {
    background: #e8f5e9;
}

.custom-alert-icon svg {
    width: 50px;
    height: 50px;
    stroke: #27ae60;
    stroke-width: 3;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    animation: drawCheck 0.5s ease forwards;
}

@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}

.custom-alert-title {
    font-size: 24px;
    font-weight: 700;
    color: #27ae60;
    margin-bottom: 10px;
}

.custom-alert-message {
    font-size: 16px;
    color: #555;
    margin-bottom: 25px;
}

.custom-alert-btn {
    padding: 12px 30px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.custom-alert-btn:hover {
    background: #229954;
    transform: scale(1.05);
}
</style>

<!-- This is the view where I list patients where I can delete and update patient information -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Formulario Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('CPaciente/agregar'); ?>
                    <p style="color: white;">Paciente</p>
                    <div class="form-row ">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Tipo Documento</label>
                            <select class="form-control" name="tipo" id="tipo" required="">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($tipo_documento as $tipo_doc) {
                                        echo "<option value={$tipo_doc->idTipDocumento}>{$tipo_doc->docNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Identificación</label>
                            <input class="form-control" name="identificacion" type="text" id="inputEmail4" placeholder="Documento" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Nombre" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Apellido</label>
                            <input class="form-control" name="apellido" type="text" placeholder="Apellido" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Correo</label>
                            <input class="form-control" name="correo" type="email" required="" placeholder="Correo">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Fecha Nacimiento</label>
                            <input class="form-control" name="fecha_nacimiento" type="date" id="inputEmail4" placeholder="Nombre" required="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Sexo</label>
                            <select class="form-control" name="sexo" id="sexo" required="">
                                <option value="">[Seleccione]</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Depto Nacimiento</label>
                            <select id="departamento" class="form-control" required="" name="departamento_nacimiento">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($departamento as $dep) {
                                        echo "<option value={$dep->idDepartamento}>{$dep->depNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Municipio Nacimiento</label>
                            <select id="municipio" class="form-control" required="" name="municipio_nacimiento">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($municipio as $mun) {
                                        echo "<option value={$mun->idMunicipio}>{$mun->munNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Domicilio</label>
                            <input class="form-control" name="domicilio" type="text" id="inputEmail4" placeholder="Domicilio" required="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Telefono</label>
                            <input class="form-control" name="telefono" type="text" id="inputEmail4" placeholder="Telefono" required="">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Depto Residencia</label>
                            <select class="form-control" required="" name="departamento_residencia">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($departamento as $dep) {
                                        echo "<option value={$dep->idDepartamento}>{$dep->depNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Municipio Residencia</label>
                            <select class="form-control" required="" name="municipio_residencia">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($municipio as $mun) {
                                        echo "<option value={$mun->idMunicipio}>{$mun->munNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Zona Residencial</label>
                            <select class="form-control" required="" name="zona_residencial">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($zona_residencial as $zona) {
                                        echo "<option value={$zona->zona_residencial}>{$zona->zonNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Regimen</label>
                            <select class="form-control" required="" name="regimen">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($regimen as $reg) {
                                        echo "<option value={$reg->idRegimen}>{$reg->regNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Eps</label>
                            <select class="form-control" required="" name="empresa">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($empresa as $empre) {
                                        echo "<option value={$empre->idEmpresa}>{$empre->empNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tipo Afiliacion</label>
                            <select class="form-control" required="" name="tipo_afiliacion">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($tipo_afiliacion as $tipo) {
                                        echo "<option value={$tipo->tip_afi}>{$tipo->tipNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Raza</label>
                            <select class="form-control" name="raza" id="raza" required="">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($raza as $r) {
                                        echo "<option value={$r->idRaza}>{$r->razNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Estado Civil</label>
                            <input class="form-control" name="estado_civil" type="text" id="inputEmail4" placeholder="Estado Civil" required="">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Escolaridad</label>
                            <select class="form-control" name="escolaridad" id="escolaridad" required="">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($escolaridad as $esco) {
                                        echo "<option value={$esco->idEscolaridad}>{$esco->escNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Ocupacion</label>
                            <textarea class="form-control" required="" name="ocupacion" rows="2" placeholder="PUTR"></textarea>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>ObservacionN</label>
                            <textarea class="form-control" name="observacion" required="" rows="2" placeholder="Observacion"></textarea>
                        </div>

                    </div>
                    <p style="color: blue;">Acudiente</p>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Nombre Completo</label>
                            <input class="form-control" name="acudiente" type="text" placeholder="Nombre Completo" required="">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tipo Parentesco</label>
                            <select class="form-control" name="tipo_parentesco" required="">
                                <option value="">[Seleccione]</option>
                                <?php
                                    foreach ($parentesco as $paren) {
                                        echo "<option value={$paren->idParentesco}>{$paren->tipParNombre}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Telefono</label>
                            <input class="form-control" name="telefono_acudiente" type="text" placeholder="Telefono" required="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Direccion</label>
                            <input class="form-control" name="direccion_acudiente" type="text" placeholder="Direccion" required="">
                        </div>
                        <div class="form-group col-md-12 ">
                            <label>Novedad</label>
                            <textarea class="form-control" name="Novedad" required="" rows="2" placeholder="Novedad"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" value="Agregar Paciente" class="btn btn-danger" />
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Vista profesional de lista de pacientes -->
<div class="pacientes-container">
    <div class="pacientes-header">
        <h4><i class="fa fa-users"></i> Lista de Pacientes</h4>
        <a class="btn-add-patient" href="<?= base_url("index.php/CPaciente/formulario_paciente") ?>">
            <i class="fa fa-plus-circle"></i> Agregar Paciente
        </a>
    </div>

    <div class="pacientes-table-card">
        <div class="table-responsive">
            <table id="example" class="pacientes-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Documento</th>
                        <th style="width: 25%;">Nombre Completo</th>
                        <th style="width: 18%;">Correo</th>
                        <th style="width: 8%;">Edad</th>
                        <th style="width: 15%;">Tipo Afiliación</th>
                        <th style="width: 10%;">Estado</th>
                        <th style="width: 7%;">Actualizar</th>
                        <th style="width: 7%;">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                            <?php
                                foreach ($paciente as $pac) {
                                ?>

                                <tr>
                                    <td><span class="patient-doc"><?= $pac->pacDocumento; ?></span></td>
                                    <td><span class="patient-name"><?= $pac->pacNombre . " " . $pac->pacNombre2 ." ". $pac->pacApellido ." ". $pac->pacApellido2 ; ?></span></td>
                                    <td><?= $pac->pacCorreo; ?></td>
                                    <td><span class="patient-age"><?php
                                            list($anio, $mes, $dia) = explode("-", $pac->pacFecNacimiento);
                                            $anio_dif = date("Y") - $anio;
                                            $mes_dif = date("m") - $mes;
                                            $dia_dif = date("d") - $dia;

                                            if ($dia_dif < 0 || $mes_dif < 0) {
                                                $anio_dif--;
                                            }

                                            echo $anio_dif;
                                            ?> años</span>
                                    </td>
                                    <td>
                                        <span class="badge-afiliacion"><?= $pac->tipNombre; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-estado <?= $pac->pacEstado == 'ACTIVO' ? 'badge-activo' : 'badge-inactivo' ?>">
                                            <?= $pac->tipo_novedad; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn-action-table btn-update" href="<?= base_url("index.php/CPaciente/modRecuperar/$pac->idPaciente") ?>">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($pac->pacEstado == 'ACTIVO') { ?>
                                            <button class="btn-action-table btn-delete" onclick="eliminar('<?php echo $pac->idPaciente; ?>')">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        <?php } else { ?>
                                            <span style="color: #95a5a6;">--</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                                }
                                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Alerta personalizada -->
<div id="customAlertPaciente" class="custom-alert-overlay">
    <div class="custom-alert-box">
        <div class="custom-alert-icon success">
            <svg viewBox="0 0 52 52">
                <polyline points="14 27 22 35 38 19"/>
            </svg>
        </div>
        <div class="custom-alert-title">¡Éxito!</div>
        <div class="custom-alert-message" id="customAlertMessagePaciente">Operación realizada correctamente</div>
        <button class="custom-alert-btn" onclick="cerrarAlertaPaciente()">Aceptar</button>
    </div>
</div>

<script type="text/javascript">
    // Funciones para alerta personalizada
    function mostrarAlertaPaciente(titulo, mensaje) {
        $('#customAlertMessagePaciente').text(mensaje);
        $('.custom-alert-title').text(titulo);
        $('#customAlertPaciente').fadeIn(300);
    }

    function cerrarAlertaPaciente() {
        $('#customAlertPaciente').fadeOut(300);
    }

    // Función eliminar con confirmación personalizada
    function eliminar(id) {
        if (confirm('¿Está seguro que desea eliminar este paciente?')) {
            document.location.href = "<?php echo base_url() . 'index.php/CPaciente/eliminar/' ?>" + id;
        }
    }

    // Verificar si hay mensaje de éxito en la URL
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'added') {
            setTimeout(function() {
                mostrarAlertaPaciente('¡Éxito!', 'Paciente agregado correctamente');
            }, 300);
        } else if (urlParams.get('success') === 'updated') {
            setTimeout(function() {
                mostrarAlertaPaciente('¡Éxito!', 'Paciente actualizado correctamente');
            }, 300);
        } else if (urlParams.get('success') === 'deleted') {
            setTimeout(function() {
                mostrarAlertaPaciente('¡Éxito!', 'Paciente eliminado correctamente');
            }, 300);
        }
    });
</script>