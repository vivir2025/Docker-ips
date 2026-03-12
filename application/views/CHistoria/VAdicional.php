<style>
/* === DISEÑO PROFESIONAL AZUL === */
body {
    background: #f8f9fa !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.adicional-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px 12px 0 0;
    box-shadow: 0 4px 20px rgba(52,152,219,0.3);
    margin: -15px -15px 0 -15px;
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    color: #2c3e50 !important;
    margin: 35px 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 3px solid #3498db;
}

.form-group {
    position: relative;
}

.microfono {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    background-color: transparent;
    background-image: url('http://45.167.125.238/ips/assets/img/micro2.ico');
    background-size: cover;
    cursor: pointer;
    z-index: 1;
    display: inline-block;
    transition: transform 0.3s ease-in-out;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
}

.microfono.active {
    animation: pulse 1s infinite;
    background-image: url('http://45.167.125.238/ips/assets/img/micro2.ico');
    box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
}

@keyframes pulse {
    0% {
        transform: scale(0.8);
        box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
    }
    50% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
    }
    100% {
        transform: scale(0.8);
        box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
    }
}

.card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}

.card-header {
    background-color: #f8f9fa;
    cursor: pointer;
}

.card-header h5 {
    margin: 0;
}

.btn-default {
    color: #3498db;
    background-color: #f8f9fa;
    border: none;
}

.btn-default:hover {
    background-color: #e2e6ea;
    text-decoration: underline;
}

.checkRedondo {
    border-radius: 50%;
}

.table th, .table td {
    text-align: center;
    vertical-align: middle;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
}

.form-control {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 45px 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.15);
    outline: none;
}

.btn-primary {
    background: #3498db;
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(52,152,219,0.3);
}

.btn-primary:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52,152,219,0.5);
}

.btn-outline-info {
    border: 2px solid #3498db !important;
    color: #3498db !important;
    background: transparent !important;
    padding: 8px 20px;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-info:hover {
    background: #3498db !important;
    color: white !important;
    transform: translateY(-2px);
}

.btn-outline-primary {
    border: 2px solid #3498db !important;
    color: #3498db !important;
    background: transparent !important;
}

.btn-outline-primary:hover {
    background: #3498db !important;
    color: white !important;
}

.btn-outline-danger {
    border: 2px solid #dc3545 !important;
    color: #dc3545 !important;
}

.btn-outline-danger:hover {
    background: #dc3545 !important;
    color: white !important;
}

.table th {
    background: #f8f9fa !important;
    color: #2c3e50 !important;
    font-weight: 700 !important;
    border-bottom: 2px solid #3498db !important;
}

/* Skeleton Loader */
.skeleton-loader {
    display: none;
    padding: 20px;
}

.skeleton-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.skeleton-line {
    height: 20px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
    border-radius: 4px;
    margin-bottom: 15px;
}

.skeleton-line.short {
    width: 60%;
}

.skeleton-line.medium {
    width: 80%;
}

.skeleton-input {
    height: 45px;
    background: linear-gradient(90deg, #f8f8f8 25%, #ececec 50%, #f8f8f8 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
    border-radius: 8px;
    margin-bottom: 15px;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Overlay de guardando */
#guardandoOverlayAd {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(44,62,80,0.85);
    z-index: 99999;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.3s ease;
}

.guardando-box-ad {
    background: #fff;
    border-radius: 16px;
    padding: 40px 55px;
    text-align: center;
    box-shadow: 0 12px 40px rgba(52,152,219,0.4);
    animation: zoomIn 0.3s ease;
}

.guardando-spinner-ad {
    width: 56px;
    height: 56px;
    border: 6px solid #f0f0f0;
    border-top: 6px solid #3498db;
    border-radius: 50%;
    animation: spin-ad .9s linear infinite;
    margin: 0 auto 18px;
}

@keyframes spin-ad {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>

<!-- Skeleton Loader -->
<div id="skeletonLoaderAd" class="skeleton-loader">
    <div class="skeleton-card">
        <div class="skeleton-line short"></div>
        <div class="skeleton-input"></div>
        <div class="skeleton-input"></div>
    </div>
    <div class="skeleton-card">
        <div class="skeleton-line medium"></div>
        <div class="skeleton-input"></div>
        <div class="skeleton-input"></div>
        <div class="skeleton-input"></div>
    </div>
    <div class="skeleton-card">
        <div class="skeleton-line"></div>
        <div class="skeleton-input"></div>
    </div>
</div>

<!-- Overlay guardando -->
<div id="guardandoOverlayAd">
    <div class="guardando-box-ad">
        <div class="guardando-spinner-ad"></div>
        <div style="font-size:20px;font-weight:700;color:#2c3e50;margin-bottom:6px;">Guardando Datos</div>
        <div style="font-size:14px;color:#7f8c8d;">Espere un momento...</div>
    </div>
</div>

<!-- Contenido Principal -->
<div id="contenidoAdicional" class="container bg-light" style="display: none;">
    <div class="adicional-header">
        <h4 style="margin:0; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-notes-medical"></i>
            DATOS ADICIONALES
        </h4>
    </div>
    <div style="padding: 20px; background: white; border-radius: 0 0 12px 12px;">
    <h5 style="color: #3498db; font-weight: 700; font-size: 16px;">DATO ADICIONAL</h5>
    <hr>

    <form>
        <input name='id_hc' id="id_hc" value="<?= $id_hc ?>" hidden />
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Nota Adicional:</label>
                <textarea class="form-control" name="adicional" id="adicional" type="text" required="" placeholder="Digite la Nota Adicional o dar clic al microfono para esta Historia Clinica" rows="2"></textarea>
                <span class="microfono" id="microfono"></span>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-primary" id="nota_adicional">Guardar</a>
        </div>
    </form>

    <div class="col-sm-12 ">
        <?php if ($proceso_idProceso === 1 || $proceso_idProceso == 2 || $proceso_idProceso == 3 || $proceso_idProceso == 4 || $proceso_idProceso == 6 || $proceso_idProceso == 7) { ?>

            <h5 style="font-size: 14px;">MEDICAMENTO</h5>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th>MEDICAMENTO</th>
                    <th>CANTIDAD</th>
                    <th>DOSIS</th>
                    <th>OPCIÓN</th>
                </thead>
                <tr>
                    <form>
                        <td>
                            <input type="text" name="idMedicamento" id="idMedicamento" hidden="">
                            <input type="text" id="medicamento" name="medicamento" onKeyUp="buscar();" class="form-control" placeholder="Medicamento" size="80" />
                            <div id="lista_nombre" style="display: none;">

                            </div>
                        </td>
                        <td>
                            <input type="text" id="cantidad" name="cantidad" class="form-control" value="0" required="" />
                        </td>
                        <td>
                            <input type="text" id="dosis" name="dosis" class="form-control" placeholder="Dosis" />
                        </td>
                        <td>
                            <a id="add" class="btn btn-outline-info">Agregar</a>
                        </td>
                    </form>
                </tr>
            </table><br><br>

            <div id="accordion">
                <div class="card card-white">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="btn btn-default btn-sm collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                                Click Lista Medicamento
                            </a>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <br>
                        <div class="container">
                            <table class="table table-bordered" id="data">
                                <thead>
                                <th> <input type="checkbox" id="seleccionarTodos" class="checkRedondo"> SELECCIONAR</th>
                                    <th>MEDICAMENTO</th>
                                    <th>CANTIDAD</th>
                                    <th>DOSIS</th>
                                    <th>OPCIÓN</th>
                                </thead>
                                <tbody>
                                <?php
                        foreach ($medicamento_historia as $mh) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='checkEliminar' value='{$mh->id_his_med}' style='border-radius: 50%;'></td>";
                            echo "<td>" . $mh->medNombre . "</td>";
                            echo "<td>" . $mh->hisMedCantidad . "</td>";
                            echo "<td>" . $mh->hisMedDosis . "</td>";
                            echo "<td><button type='button' class='btn btn-outline-primary btn-view-medicamento' value='$mh->id_his_med' data-toggle='modal' data-target='#modal_medicamento'>Editar</button></td>";
                           
                            echo "</tr>";
                            echo "<tr>";
                            echo "</tr>";
                        }
                        ?>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                            <a class="btn btn-outline-danger" onclick='eliminarSeleccionados("{$mh->id_his_med}")' style="border-radius: 50px;">Eliminar </a>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            

        <?php } ?>
        <br>
        <?php if ($proceso_idProceso == 1 || $proceso_idProceso == 3 || $proceso_idProceso == 6 || $proceso_idProceso == 7) { ?>

            <h5 style="font-size: 14px;">AYUDA DIAGNOSTICA</h5>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th>CUPS</th>
                    <th>OBSERVACIÓN</th>
                    <th>OPCIÓN</th>
                </thead>
                <tr>
                    <form>
                        <td>

                            <input type="text" name="idCups" id="idCups" hidden="">
                            <input type="text" id="cup" name="cup" onKeyUp="buscar_cups();" class="form-control" placeholder="Remision" />
                            <div id="lista_nombre_cups" style="display: none;">

                            </div>
                        </td>
                        <td>
                            <input type="text" name="cupObservacion" id="cupObservacion" placeholder="Observacion" class="form-control">

                        </td>
                        <td>
                            <a id="add_cups" class="btn btn-outline-info">Agregar</a>
                        </td>
                    </form>
                </tr>
            </table><br>
            <div id="accordion">
                <div class="card card-white">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="btn btn-default btn-sm collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseOne">
                                Click Lista Ayudas Diagnostica
                            </a>
                        </h5>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <br>
                        <div class="container">
                            <table class="table table-bordered" id="data2">
                                <thead>
                                <th><input type="checkbox" id="ayudaTodos" class="checkRedondo"> SELECCIONAR</th>
                                    <th>CÓDIGO</th>
                                    <th>CUPS</th>
                                    <th>OBSERVACIÓN</th>
                                    <th>OPCIÓN</th>
                                </thead>
                                <tbody>

                                <?php
                                    foreach ($cups_historia as $ch) {

                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='checkEliminar' value='{$ch->id_his_cups}' style='border-radius: 50%;'></td>";
                                        echo "<td>" . $ch->cupCodigo . "</td>";
                                        echo "<td>" . $ch->cupNombre . "</td>";
                                        echo "<td>" . $ch->cupObservacion . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="modal-footer">
                            <a class="btn btn-outline-danger" onclick='eliminarAyudas("{$ch->id_his_cups}")' style="border-radius: 50px;">Eliminar </a>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <br>
        <?php if ($proceso_idProceso == 1 || $proceso_idProceso == 3 || $proceso_idProceso == 6 || $proceso_idProceso == 7) { ?>
            <div style="border: solid 1px #9c9c9c; padding: 15px;">
    <!-- Título principal -->
    <legend style="font-size: 15px;">DIAGNÓSTICO</legend>
    <hr>

    <!-- Formulario para Diagnóstico Principal -->
    <div class="form-row" style="margin: 10px;">
        <input name='id_hc' id="id_hc" value="<?= $id_hc ?>" hidden />

        <div class="col-sm-12">
            <div id="mens_diagnostico"></div>
        </div>

        <!-- Diagnóstico Principal -->
        <div class="form-group col-md-2">
            <strong>Diagnóstico</strong><br>
            <em>Principal</em>
        </div>
        <div class="form-group col-md-2">
            <strong>Código</strong>
            <input class="form-control input-sm" type="text" placeholder="Buscar por código" onKeyUp="buscar_codigo();" id="codigo" name="codigo">
            <div id="lista_codigo_diagnostico" style="display: none;"></div>
        </div>
        <div class="form-group col-md-4">
            <strong>Nombre</strong>
            <input type="text" name="idDiagnostico" id="idDiagnostico" hidden="">
            <input type="text" name="tipo_item" id="tipo_item" hidden="" value="PRINCIPAL">
            <input type="text" id="diagnostico" name="diagnostico" onKeyUp="buscar_diagnostico();" class="form-control" placeholder="Buscar por nombre">
            <div id="lista_nombre_diagnostico" style="display: none;"></div>
        </div>
        <div class="form-group col-md-3">
            <strong>TIPO DIAGNÓSTICO</strong>
            <select name="tipo_diagnostico" id="tipo_diagnostico" required="" class="form-control input-sm">
                <option value="CONFIRMADO NUEVO">CONFIRMADO NUEVO</option>
                <option value="REPETIDO">REPETIDO</option>
                <option value="IMPRESION DIAGNOSTICA">IMPRESIÓN DIAGNÓSTICA</option>
            </select>
        </div>
        <div class="form-group col-md-1">
            <br>
            <a id="add_diagnostico" class="btn btn-outline-primary">Guardar</a>
        </div>

        <!-- Diagnóstico Dx 1 -->
        <div class="form-group col-md-2">
            <strong>Diagnóstico</strong><br>
            <em>Dx 1</em>
        </div>
        <div class="form-group col-md-2">
            <strong>Código</strong>
            <input class="form-control input-sm" type="text" placeholder="Buscar por código" onKeyUp="buscar_codigo1();" id="codigo1">
            <div id="lista_codigo_diagnostico1" style="display: none;"></div>
        </div>
        <div class="form-group col-md-4">
            <strong>Nombre</strong>
            <input type="text" name="idDiagnostico1" id="idDiagnostico1" hidden="">
            <input type="text" name="tipo_item1" id="tipo_item1" hidden="" value="TIPO">
            <input type="text" id="diagnostico1" name="diagnostico1" onKeyUp="buscar_diagnostico1();" class="form-control" placeholder="Buscar por nombre">
            <div id="lista_nombre_diagnostico1" style="display: none;"></div>
        </div>
        <div class="form-group col-md-3">
            <strong>TIPO DIAGNÓSTICO</strong>
            <select name="tipo_diagnostico1" id="tipo_diagnostico1" required="" class="form-control input-sm">
                <option value="CONFIRMADO NUEVO">CONFIRMADO NUEVO</option>
                <option value="REPETIDO">REPETIDO</option>
                <option value="IMPRESION DIAGNOSTICA">IMPRESIÓN DIAGNÓSTICA</option>
            </select>
        </div>

        <div class="form-group col-md-1">
            <br>
            <a id="add_diagnostico1" class="btn btn-outline-primary">Guardar</a>
        </div>
    </div>

    <!-- Accordion para mostrar historial de diagnósticos -->
    <div id="accordion">
        <div class="card card-white">
            <div class="card-header" id="headingDiagnosticos">
                <h5 class="mb-0">
                    <a class="btn btn-default btn-sm collapsed" data-toggle="collapse" data-target="#collapseDiagnosticos" aria-expanded="false" aria-controls="collapseDiagnosticos">
                        Click para mostrar historial de Diagnósticos
                    </a>
                </h5>
            </div>

            <div id="collapseDiagnosticos" class="collapse" aria-labelledby="headingDiagnosticos" data-parent="#accordion">
                <br>
                <div class="container">
                    <!-- Tabla con los diagnósticos existentes -->
                    <table class="table table-bordered" id="dataDiagnosticos">
                        <thead>
                            <th><input type="checkbox" id="diagnosticoTodos" class="checkRedondo"> SELECCIONAR</th>
                            <th>CÓDIGO</th>
                            <th>DIAGNÓSTICO</th>
                            <th>CLASIFICACIÓN</th>
                            <th>TIPO</th>
                            <th>OPCIÓN</th>
                        </thead>
                        <tbody>
                            <?php foreach ($diagnostico_historia as $dh): ?>
                                <tr>
                                    <td><input type="checkbox" class="checkEliminar" value="<?= $dh->id_his_dia ?>" style="border-radius: 50%;"></td>
                                    <td><?= $dh->diaCodigo ?></td>
                                    <td><?= $dh->diaNombre ?></td>
                                    <td><?= $dh->his_dia_tipo ?></td>
                                    <td><?= $dh->hcTipoDiagnostico ?></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-danger eliminarDiagnostico" data-id="<?= $dh->id_his_dia ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <a class="btn btn-outline-danger" id="botonEliminarDiagnosticos" style="border-radius: 50px;">Eliminar seleccionados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php } ?>

        <br>
      <?php if ($proceso_idProceso == 1 || $proceso_idProceso == 3 || $proceso_idProceso == 6 || $proceso_idProceso == 7) { ?>

                    <h5 style="font-size: 14px;">MEDICAMENTOS</h5>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <th>MEDICAMENTO</th>
                        <th>CANTIDAD</th>
                        <th>DOSIS</th>
                        <th>OPCIÓN</th>
                        </thead>
                        <tr>
                        <form>
                            <td>
                                <input type="text" name="idMedicamento" id="idMedicamento" hidden="">
                                <input type="text" id="medicamento" name="medicamento" onKeyUp="buscar();" class="form-control" placeholder="Medicamento" size="80" />
                                <div id="lista_nombre" style="display: none;">

                                </div>
                            </td>
                            <td>
                                <input type="text" id="cantidad" name="cantidad" class="form-control" value="0" required="" />
                            </td>
                            <td>
                                <input type="text" id="dosis" name="dosis" class="form-control" placeholder="Dosis" />
                            </td>
                            <td>
                                <a id="add" class="btn btn-outline-info">Agregar</a>
                            </td>
                    </form>
                        </tr>
                    </table><br>

                   <div id="accordion">
                <div class="card card-white">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="btn btn-default btn-sm collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                                Click Lista Medicamento
                            </a>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <br>
                        <div class="container">
                            <table class="table table-bordered" id="data">
                                <thead>
                                <th> <input type="checkbox" id="seleccionarTodos" class="checkRedondo"> SELECCIONAR</th>
                                    <th>MEDICAMENTO</th>
                                    <th>CANTIDAD</th>
                                    <th>DOSIS</th>
                                    <th>OPCIÓN</th>
                                </thead>
                                <tbody>
                                <?php
                        foreach ($medicamento_historia as $mh) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='checkEliminar' value='{$mh->id_his_med}' style='border-radius: 50%;'></td>";
                            echo "<td>" . $mh->medNombre . "</td>";
                            echo "<td>" . $mh->hisMedCantidad . "</td>";
                            echo "<td>" . $mh->hisMedDosis . "</td>";
                            echo "<td><button type='button' class='btn btn-outline-primary btn-view-medicamento' value='$mh->id_his_med' data-toggle='modal' data-target='#modal_medicamento'>Editar</button></td>";
                           
                            echo "</tr>";
                            echo "<tr>";
                            echo "</tr>";
                        }
                        ?>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                            <a class="btn btn-outline-danger" onclick='eliminarSeleccionados("{$mh->id_his_med}")' style="border-radius: 50px;">Eliminar </a>
                </div>
                        </div>
                    </div>
                </div>
            </div>
                    <?php } ?>
                    <br>
        <?php if ($proceso_idProceso == 1 || $proceso_idProceso == 3 || $proceso_idProceso == 4 || $proceso_idProceso == 6 || $proceso_idProceso == 7) { ?>

            <h5 style="font-size: 14px;">Remisión</h5>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th>REMISIÓN</th>
                    <th>OBSERVACIÓN</th>
                    <th>OPCIÓN</th>
                </thead>
                <tr>
                    <form>
                        <td>

                            <input type="text" name="idRemision" id="idRemision" hidden="">
                            <input type="text" id="remision" name="remision" onKeyUp="buscar_remision();" class="form-control" placeholder="Remision" />
                            <div id="lista_nombre_remision" style="display: none;">

                            </div>
                        </td>
                        <td>
                            <input type class="form-control" name="remObservacion" id="remObservacion" placeholder="Observacion" />
                        </td>
                        <td>
                            <a id="add_remision" class="btn btn-outline-info">Agregar</a>
                        </td>
                    </form>
                </tr>
            </table><br>
            <div id="accordion">
                <div class="card card-white">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="btn btn-default btn-sm collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseOne">
                                Click Lista Remisión

                            </a>
                        </h5>
                    </div>

                    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <br>
                        <div class="container">
                            <table class="table table-bordered" id="data3">
                                <thead>
                                <th> <input type="checkbox" id="remisionTodos" class="checkRedondo"> SELECCIONAR</th>
                                    <th>CÓDIGO</th>
                                    <th>REMISIÓN</th>
                                    <th>OBSERVACIÓN</th>
                                    <th>OPCIÓN</th>
                                </thead>
                                <tbody>

                                <?php
                                    foreach ($remision_historia as $r) {

                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='checkEliminar' value='{$r->id_his_rem}' style='border-radius: 50%;'></td>";
                                        echo "<td>". $r->remCodigo . "</td>";
                                        echo "<td>" . $r->remNombre . "</td>";
                                        echo "<td>" . $r->remObservacion . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="modal-footer">
                            <a class="btn btn-outline-danger" onclick='eliminarRemisiones("{$r->id_his_rem}")' style="border-radius: 50px;">Eliminar </a>
                </div>
                        </div>
                    </div>
                </div>
            </div><br>
        <?php } ?>
        
    </div>
    <hr>
    <a href="<?= base_url("index.php/CHistoria/") ?>" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    </div>
</div>

<script type='text/javascript'>
// Mostrar skeleton loader al cargar la página
$(document).ready(function() {
    $('#skeletonLoaderAd').show();
    $('#contenidoAdicional').hide();
    
    // Simular carga de datos
    setTimeout(function() {
        $('#skeletonLoaderAd').fadeOut(300, function() {
            $('#contenidoAdicional').fadeIn(300);
        });
    }, 800);

    // Seleccionar/deseleccionar todos los checkboxes
    $('#diagnosticoTodos').on('click', function () {
        $('.checkEliminar').prop('checked', this.checked);
    });

    // Función para eliminar diagnósticos
    $('#botonEliminarDiagnosticos').on('click', function () {
        var seleccionados = [];

        // Obtener los checkboxes seleccionados
        $('.checkEliminar:checked').each(function () {
            seleccionados.push($(this).val());
        });

        // Verificar si hay diagnósticos seleccionados
        if (seleccionados.length > 0 && confirm('¿Desea eliminar los diagnósticos seleccionados?')) {
            $.ajax({
                url: "<?php echo base_url('index.php/CHistoria/eliminar_diagnostico'); ?>",
                type: 'POST',
                data: {
                    id_his_dia: seleccionados
                },
                success: function (result) {
                    // Mostrar mensaje de respuesta del servidor
                    $("#mens_diagnostico").html(result); 

                    // Eliminar las filas correspondientes de la tabla para los diagnósticos seleccionados
                    $('.checkEliminar:checked').each(function () {
                        $(this).closest('tr').remove();
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error al eliminar diagnósticos: ", error);
                }
            });
        } else {
            alert("No se seleccionó ningún diagnóstico.");
        }
    });
});

function elemento_selecionado_diagnostico(object) {
        dato_cups = (object.id).split('&');

        idDiagnostico = dato_cups[0];
        diaNombre = dato_cups[1];
        diaCodigo = dato_cups[2];

        $('#idDiagnostico').val(idDiagnostico);
        $('#diagnostico').val(diaNombre);
        $('#codigo').val(diaCodigo);
        $('#lista_nombre_diagnostico').hide();
        $('#lista_codigo_diagnostico').hide();

    }

    function elemento_selecionado_diagnostico1(object) {
        dato_cups = (object.id).split('&');

        idDiagnostico = dato_cups[0];
        diaNombre = dato_cups[1];
        diaCodigo = dato_cups[2];

        $('#idDiagnostico1').val(idDiagnostico);
        $('#diagnostico1').val(diaNombre);
        $('#codigo1').val(diaCodigo);
        $('#lista_nombre_diagnostico1').hide();
        $('#lista_codigo_diagnostico1').hide();
    }

    function elemento_selecionado_diagnostico2(object) {
        dato_cups = (object.id).split('&');

        idDiagnostico = dato_cups[0];
        diaNombre = dato_cups[1];
        diaCodigo = dato_cups[2];

        $('#idDiagnostico2').val(idDiagnostico);
        $('#diagnostico2').val(diaNombre);
        $('#codigo2').val(diaCodigo);
        $('#lista_nombre_diagnostico2').hide();
        $('#lista_codigo_diagnostico2').hide();
    }

    function elemento_selecionado_diagnostico3(object) {
        dato_cups = (object.id).split('&');

        idDiagnostico = dato_cups[0];
        diaNombre = dato_cups[1];
        diaCodigo = dato_cups[2];

        $('#idDiagnostico3').val(idDiagnostico);
        $('#diagnostico3').val(diaNombre);
        $('#codigo3').val(diaCodigo);
        $('#lista_nombre_diagnostico3').hide();
        $('#lista_codigo_diagnostico3').hide();
    }

    $("#add_diagnostico3").click(function() {

        idDiagnostico = $("#idDiagnostico3").val();
        diagnostico = $("#diagnostico3").val();
        id_hc = $("#id_hc").val();
        tipo_item = $("#tipo_item3").val();
        tipo_diagnostico3 = $("#tipo_diagnostico3").val();

        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico3 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico3t'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    id_hc: id_hc,
                    tipo_item: tipo_item,
                    tipo_diagnostico3: tipo_diagnostico3
                },

                success: function(result) {

                    //console.log(result);
                    $('#idDiagnostico3').val("");
                    tipo_diagnostico1
                    $('#diagnostico3').val("");
                    $('#codigo3').val("");
                    $("#mens_diagnostico").html(result);
                    $("#data3").load(" #data3");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_diagnostico").html(html);

        }

    });

    $("#add_diagnostico2").click(function() {

        idDiagnostico = $("#idDiagnostico2").val();
        diagnostico = $("#diagnostico2").val();
        id_hc = $("#id_hc").val();
        tipo_item = $("#tipo_item2").val();
        tipo_diagnostico2 = $("#tipo_diagnostico2").val();

        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico2 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico2t'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    id_hc: id_hc,
                    tipo_item: tipo_item,
                    tipo_diagnostico2: tipo_diagnostico2
                },

                success: function(result) {

                    //console.log(result);
                    $('#idDiagnostico2').val("");
                    $('#diagnostico2').val("");
                    $('#codigo2').val("");
                    $("#mens_diagnostico").html(result);
                    $("#data3").load(" #data3");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_diagnostico").html(html);

        }

    });

    $("#add_diagnostico1").click(function() {

        idDiagnostico = $("#idDiagnostico1").val();
        diagnostico = $("#diagnostico1").val();
        id_hc = $("#id_hc").val();
        tipo_item = $("#tipo_item1").val();
        tipo_diagnostico1 = $("#tipo_diagnostico1").val();

        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico1 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico1t'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    id_hc: id_hc,
                    tipo_item: tipo_item,
                    tipo_diagnostico1: tipo_diagnostico1
                },

                success: function(result) {

                    //console.log(result);
                    $('#idDiagnostico1').val("");
                    $('#diagnostico1').val("");
                    $('#codigo1').val("");
                    $("#mens_diagnostico").html(result);
                    $("#data3").load(" #data3");
                    $("#contador").load(" #contador");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_diagnostico").html(html);

        }

    });

    $("#add_diagnostico").click(function() {

        idDiagnostico = $("#idDiagnostico").val();
        diagnostico = $("#diagnostico").val();
        id_hc = $("#id_hc").val();

        tipo_item = $("#tipo_item").val();
        tipo_diagnostico = $("#tipo_diagnostico").val();

        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnosticot'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    id_hc: id_hc, // Cambia la clave
                    tipo_item: tipo_item,
                    tipo_diagnostico: tipo_diagnostico
                },

                success: function(result) {

                    $('#idDiagnostico').val("");
                    $('#diagnostico').val("");
                    $('#codigo').val("");
                    $("#mens_diagnostico").html(result);
                    //$("#data_diagnostico").load(" #data_diagnostico");
                    $("#data3").load(" #data3");
                    $("#contador").load(" #contador");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_diagnostico").html(html);

        }

    });

    function buscar_codigo() {
        var codigo = $("input#codigo").val();

        if (codigo != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_codigo") ?>", {
                codigo: codigo

            }, function(mensaje) {
                $('#lista_codigo_diagnostico').show();
                $("#lista_codigo_diagnostico").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico').val("");
            $('#diagnostico').val("");
            $('#codigo').val("");
            $('#lista_codigo_diagnostico').hide();
        }

    };

    function buscar_codigo1() {
        var codigo = $("input#codigo1").val();

        if (codigo != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_codigo1") ?>", {
                codigo: codigo

            }, function(mensaje) {
                $('#lista_codigo_diagnostico1').show();
                $("#lista_codigo_diagnostico1").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico1').val("");
            $('#diagnostico1').val("");
            $('#codigo1').val("");
            $('#lista_codigo_diagnostico1').hide();
        }

    };

    function buscar_codigo2() {
        var codigo = $("input#codigo2").val();

        if (codigo != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_codigo2") ?>", {
                codigo: codigo

            }, function(mensaje) {
                $('#lista_codigo_diagnostico2').show();
                $("#lista_codigo_diagnostico2").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico2').val("");
            $('#diagnostico2').val("");
            $('#codigo2').val("");
            $('#lista_codigo_diagnostico2').hide();
        }

    };

    function buscar_codigo3() {
        var codigo = $("input#codigo3").val();

        if (codigo != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_codigo3") ?>", {
                codigo: codigo

            }, function(mensaje) {
                $('#lista_codigo_diagnostico3').show();
                $("#lista_codigo_diagnostico3").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico3').val("");
            $('#diagnostico3').val("");
            $('#codigo3').val("");
            $('#lista_codigo_diagnostico3').hide();
        }

    };

    function buscar_diagnostico() {
        var diagnostico = $("input#diagnostico").val();

        if (diagnostico != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_diagnostico") ?>", {
                diagnostico: diagnostico

            }, function(mensaje) {
                $('#lista_nombre_diagnostico').show();
                $("#lista_nombre_diagnostico").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico').val("");
            $('#diagnostico').val("");
            $('#lista_nombre_diagnostico').hide();
        }

    };

    function buscar_diagnostico1() {
        var diagnostico = $("input#diagnostico1").val();

        if (diagnostico != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_diagnostico1") ?>", {
                diagnostico: diagnostico

            }, function(mensaje) {
                $('#lista_nombre_diagnostico1').show();
                $("#lista_nombre_diagnostico1").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico1').val("");
            $('#diagnostico1').val("");
            $('#lista_nombre_diagnostico1').hide();
        }

    };

    function buscar_diagnostico2() {
        var diagnostico = $("input#diagnostico2").val();

        if (diagnostico != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_diagnostico2") ?>", {
                diagnostico: diagnostico

            }, function(mensaje) {
                $('#lista_nombre_diagnostico2').show();
                $("#lista_nombre_diagnostico2").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico2').val("");
            $('#diagnostico2').val("");
            $('#lista_nombre_diagnostico2').hide();
        }

    };

    function buscar_diagnostico3() {
        var diagnostico = $("input#diagnostico3").val();

        if (diagnostico != "") {
            $.post("<?= base_url("index.php/CHistoria/buscar_diagnostico3") ?>", {
                diagnostico: diagnostico

            }, function(mensaje) {
                $('#lista_nombre_diagnostico3').show();
                $("#lista_nombre_diagnostico3").html(mensaje);

                //console.log(mensaje);
            });
        } else {
            $('#idDiagnostico3').val("");
            $('#diagnostico3').val("");
            $('#lista_nombre_diagnostico3').hide();
        }

    };

        //////////////////////////////////adicinal 
        $("#add_remision").click(function() {

idRemision = $("#idRemision").val();
idHistoria = $("#id_hc").val();
remision = $("#remision").val();
observacion = $("#remObservacion").val();

if (idRemision != "" && remision != "") {

    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/agregar_remision'; ?>",
        type: 'POST',
        data: {
            idRemision: idRemision,
            idHistoria: idHistoria,
            observacion: observacion
        },

        success: function(result) {

            $('#idRemision').val("");
            $('#remision').val("");
            $('#remObservacion').val("");
            $("#data3").load(" #data3");
            alert("Elemento registrado correctamente!!!")

        }
    });

} else {

    alert("No deje campos vacios")

}

});

function elemento_selecionado_remision(object) {
dato_remision = (object.id).split('&');

idRemision = dato_remision[0];
remNombre = dato_remision[1];

$('#idRemision').val(idRemision);
$('#remision').val(remNombre);
$('#lista_nombre_remision').hide();
}

function buscar_remision() {
var remision = $("input#remision").val();

if (remision != "") {
    $.post("<?= base_url("index.php/CHistoria/buscar_remision") ?>", {
        remision: remision

    }, function(mensaje) {
        $('#lista_nombre_remision').show();
        $("#lista_nombre_remision").html(mensaje);

        //console.log(mensaje);
    });
} else {
    $('#idRemision').val("");
    $('#remision').val("");
    $('#lista_nombre_remision').hide();
}

};

$("#add_cups").click(function() {

idCups = $("#idCups").val();
idHistoria = $("#id_hc").val();
cup = $("#cup").val();
observacion = $("#cupObservacion").val();

if (idCups != "" && cup != "") {

    //alert(idCups +"__"+ cup)

    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/agregar_cups'; ?>",
        type: 'POST',
        data: {
            idCups: idCups,
            idHistoria: idHistoria,
            observacion: observacion
        },

        success: function(result) {

            $('#idCups').val("");
            $('#cup').val("");
            $('#cupObservacion').val("");
            $("#data2").load(" #data2");
            alert("Elemento registrado correctamente!!!")

        }
    });

} else {

    alert("No deje campos vacios!!!")

}

});

function elemento_selecionado_cups(object) {
dato_cups = (object.id).split('&');

idCups = dato_cups[0];
cupNombre = dato_cups[1];

$('#idCups').val(idCups);
$('#cup').val(cupNombre);
$('#lista_nombre_cups').hide();
}

function buscar_cups() {
var cups = $("input#cup").val();

if (cups != "") {
    $.post("<?= base_url("index.php/CHistoria/buscar_cups") ?>", {
        cups: cups

    }, function(mensaje) {
        $('#lista_nombre_cups').show();
        $("#lista_nombre_cups").html(mensaje);

        //console.log(mensaje);
    });
} else {
    $('#idCups').val("");
    $('#cup').val("");
    $('#lista_nombre_cups').hide();
}

};

//En globo la parte de seleccion para los medicamentos
$(document).ready(function() {
// Delegación de eventos para seleccionar/deseleccionar todos los checkboxes
$(document).on('change', '#seleccionarTodos', function() {
$('.checkEliminar').prop('checked', this.checked);
});

});

// Función para eliminar medicamentos al confirmar la acción
function eliminarSeleccionados() {
var seleccionados = [];

// Iterar sobre los checkboxes y obtener los seleccionados
$('.checkEliminar:checked').each(function() {
seleccionados.push($(this).val()); // Añadir el valor del checkbox a la lista de seleccionados
});

if (seleccionados.length > 0 && confirm('¿Desea eliminar los medicamentos seleccionados?')) {
$.ajax({
    url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_medicamento'; ?>",
    type: 'POST',
    data: {
        id_his_med: seleccionados // Enviar la lista de IDs a eliminar
    },
    success: function(result) {
        $("#mens").html(result);
        $("#data").load(" #data");
    }
});
}
}
// En globo el funcionamiento de ayudas diagnosticas
$(document).ready(function() {
// Delegación de eventos para seleccionar/deseleccionar todos los checkboxes
$(document).on('change', '#ayudaTodos', function() {
$('.checkEliminar').prop('checked', this.checked);
});

});
// Función para eliminar ayudas diagnósticas al confirmar la acción
function eliminarAyudas() {
var seleccionados = [];

// Iterar sobre los checkboxes de ayudas diagnósticas y obtener los seleccionados
$('.checkEliminar:checked').each(function() {
    seleccionados.push($(this).val()); // Añadir el valor del checkbox a la lista de seleccionados
});

if (seleccionados.length > 0 && confirm('¿Desea eliminar las ayudas diagnósticas seleccionadas?')) {
    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_cups'; ?>",
        type: 'POST',
        data: {
            id_his_cups: seleccionados // Enviar la lista de IDs a eliminar
        },
        success: function(result) {
            $("#mens").html(result);
            $("#data2").load(" #data2");
        }
    });
}
}

// Asociar la función eliminarAyudas() al evento click del botón de eliminar ayudas diagnósticas
$('#botonEliminarAyudas').on('click', function() {
eliminarAyudas();
});

//En globo la parte de seleccion para los medicamentos
$(document).ready(function() {
// Delegación de eventos para seleccionar/deseleccionar todos los checkboxes
$(document).on('change', '#seleccionarTodos', function() {
$('.checkEliminar').prop('checked', this.checked);
});

});

// Función para eliminar medicamentos al confirmar la acción
function eliminarSeleccionados() {
var seleccionados = [];

// Iterar sobre los checkboxes y obtener los seleccionados
$('.checkEliminar:checked').each(function() {
seleccionados.push($(this).val()); // Añadir el valor del checkbox a la lista de seleccionados
});

if (seleccionados.length > 0 && confirm('¿Desea eliminar los medicamentos seleccionados?')) {
$.ajax({
    url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_medicamento'; ?>",
    type: 'POST',
    data: {
        id_his_med: seleccionados // Enviar la lista de IDs a eliminar
    },
    success: function(result) {
        $("#mens").html(result);
        $("#data").load(" #data");
    }
});
}
}
//En globo la parte del funcionamiento de selelcion de remision

$(document).ready(function() {
// Delegación de eventos para seleccionar/deseleccionar todos los checkboxes
$(document).on('change', '#remisionTodos', function() {
$('.checkEliminar').prop('checked', this.checked);
});

});

// Función para eliminar remisiones al confirmar la acción
function eliminarRemisiones() {
var seleccionados = [];

// Iterar sobre los checkboxes de remisiones y obtener los seleccionados
$('.checkEliminar:checked').each(function() {
    seleccionados.push($(this).val()); // Añadir el valor del checkbox a la lista de seleccionados
});

if (seleccionados.length > 0 && confirm('¿Desea eliminar las remisiones seleccionadas?')) {
    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_remision'; ?>",
        type: 'POST',
        data: {
            id_his_rem: seleccionados // Enviar la lista de IDs a eliminar
        },
        success: function(result) {
            $("#mens").html(result);
            $("#data3").load(" #data3");
        }
    });
}
}

// Asociar la función eliminarRemisiones() al evento click del botón de eliminar remisiones
$('#botonEliminarRemisiones').on('click', function() {
eliminarRemisiones();
});

//

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
            $("#data").load(" #data");
            alert("Elemento registrado correctamente!!!")
        }
    });

} else {

    alert("No deje campos vacios!!!")

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

// Función para mostrar overlay
function mostrarOverlay() {
    $('#guardandoOverlayAd').css('display', 'flex');
}

function ocultarOverlay() {
    $('#guardandoOverlayAd').fadeOut(300);
}

$("#nota_adicional").click(function() {

id_hc = $("#id_hc").val();
nota = $("#adicional").val();

if (id_hc != "" && nota != "") {
    mostrarOverlay();
    
    $.ajax({
        url: "<?php echo base_url() . 'index.php/CHistoria/nota_adicional'; ?>",
        type: 'POST',
        data: {
            id_hc: id_hc,
            nota: nota
        },

        success: function(result) {
            ocultarOverlay();
            $("#id_hc").val("");
            $("#adicional").val("");
            alert("Elemento registrado correctamente!!!")
        },
        error: function() {
            ocultarOverlay();
        }
    });

} else {
    alert("No deje campos vacios")
}

});
const botonMicrofono = document.getElementById('microfono');
const campoTexto = document.getElementById('adicional');

let recognition = null;

botonMicrofono.addEventListener('click', function() {
    if (!recognition) {
        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
            recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();

            recognition.lang = 'es-ES'; // Establecer el idioma del reconocimiento (español)

            recognition.onstart = function() {
                botonMicrofono.classList.add('active');
            };

            recognition.onend = function() {
                botonMicrofono.classList.remove('active');
            };

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                campoTexto.value += ' ' + transcript;
            };

            recognition.start();
        } else {
            alert('El reconocimiento de voz no es compatible con este navegador.');
        }
    } else {
        recognition.stop();
        recognition = null;
    }
});
</script>