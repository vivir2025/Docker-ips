<!-- ═══ Google-style loader — IPS Cajibio ═══════════════════════════════ -->
<style>
/* ── Barra de progreso superior (estilo Google/YouTube) ── */
#ips-topbar {
    position: fixed;
    top: 0; left: 0;
    height: 3px;
    width: 0%;
    z-index: 99999;
    background: linear-gradient(90deg, #007bff 0%, #00d4ff 50%, #007bff 100%);
    background-size: 200% 100%;
    border-radius: 0 2px 2px 0;
    box-shadow: 0 0 12px rgba(0, 123, 255, 0.7);
    transition: width 0.3s ease;
    animation: ips-shine 1.2s linear infinite;
    display: none;
}
@keyframes ips-shine {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* ── Shimmer para skeleton rows ── */
@keyframes ips-shimmer {
    0%   { background-position: -600px 0; }
    100% { background-position: 600px 0; }
}
.ips-skeleton td {
    padding: 12px 10px !important;
    border-color: #e9ecef !important;
}
.ips-ph {
    height: 13px;
    border-radius: 6px;
    background: linear-gradient(90deg, #e8ecf0 25%, #f8f9fa 50%, #e8ecf0 75%);
    background-size: 600px 100%;
    animation: ips-shimmer 1.4s ease-in-out infinite;
    display: inline-block;
}
</style>

<!-- Barra superior -->
<div id="ips-topbar"></div>

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

<!-- Tabla presentación de la información -->
<div  class="container-fluid text-white">
    <div class="row justify-content-center">
        <div class="col-lg-10 ">
            <!-- Button trigger modal -->
            <h5 style="color:#FFFFFF">LISTA DE PACIENTES</h5>
                <hr>
                <a class="btn btn-primary" href="<?= base_url("index.php/CPaciente/formulario_paciente") ?>">Agregar Paciente</a><br><br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered bg-light" >
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Edad</th>
                                <th>Tipo Afiliacion</th>
                                <th>Estado</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="skeleton-body">
                            <?php for ($i = 0; $i < 8; $i++): ?>
                            <tr class="ips-skeleton">
                                <td><span class="ips-ph" style="width:<?= [72,88,65,80,75,90,68,70][$i] ?>px"></span></td>
                                <td><span class="ips-ph" style="width:<?= [160,140,180,155,170,145,165,150][$i] ?>px"></span></td>
                                <td><span class="ips-ph" style="width:<?= [130,115,140,125,135,120,130,110][$i] ?>px"></span></td>
                                <td><span class="ips-ph" style="width:30px"></span></td>
                                <td><span class="ips-ph" style="width:<?= [80,90,70,85,75,88,72,82][$i] ?>px"></span></td>
                                <td><span class="ips-ph" style="width:55px"></span></td>
                                <td><span class="ips-ph" style="width:78px; height:28px; border-radius:4px; background:linear-gradient(90deg,#cfe2ff 25%,#e7f1ff 50%,#cfe2ff 75%); background-size:600px 100%; animation:ips-shimmer 1.4s ease-in-out infinite;"></span></td>
                                <td><span class="ips-ph" style="width:65px; height:28px; border-radius:4px; background:linear-gradient(90deg,#f8d7da 25%,#fde8e9 50%,#f8d7da 75%); background-size:600px 100%; animation:ips-shimmer 1.4s ease-in-out infinite;"></span></td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                        </table>
                </div><!-- /.table-responsive -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id) {
        if (confirm('¿Desea eliminar el registro?')) {
            document.location.href = "<?php echo base_url() . 'index.php/CPaciente/eliminar/' ?>" + id;
        }
    }

    // ── Barra de progreso ──────────────────────────────────────────────────
    var $bar = $('#ips-topbar'), barTimer;

    function barStart() {
        clearTimeout(barTimer);
        $bar.stop(true).css({ width: '0%', display: 'block' }).animate({ width: '75%' }, 800);
    }
    function barDone() {
        $bar.animate({ width: '100%' }, 200, function () {
            var self = $(this);
            barTimer = setTimeout(function () { self.fadeOut(300).css('width', '0%'); }, 250);
        });
    }

    $(document).ready(function () {
        var tabla = $('#example').DataTable({
            destroy: true,
            serverSide: true,
            processing: true,
            language: {
                decimal:        ',',
                thousands:      '.',
                emptyTable:     'No hay datos disponibles en la tabla',
                info:           'Mostrando _START_ a _END_ de _TOTAL_ registros',
                infoEmpty:      'Mostrando 0 a 0 de 0 registros',
                infoFiltered:   '(filtrado de _MAX_ registros totales)',
                infoPostFix:    '',
                lengthMenu:     'Mostrar _MENU_ registros',
                loadingRecords: 'Cargando...',
                processing:     'Procesando...',
                search:         'Buscar:',
                searchPlaceholder: 'Documento, nombre, correo...',
                zeroRecords:    'No se encontraron resultados',
                paginate: {
                    first:    'Primero',
                    last:     'Último',
                    next:     'Siguiente',
                    previous: 'Anterior'
                },
                aria: {
                    sortAscending:  ': activar para ordenar la columna de forma ascendente',
                    sortDescending: ': activar para ordenar la columna de forma descendente'
                }
            },
            ajax: {
                url: '<?= base_url("index.php/CPaciente/ajax_pacientes") ?>',
                type: 'POST'
            },
            columns: [
                { title: 'Documento',       data: 0 },
                { title: 'Nombre',          data: 1 },
                { title: 'Correo',          data: 2 },
                { title: 'Edad',            data: 3, orderable: false },
                { title: 'Tipo Afiliación', data: 4 },
                { title: 'Estado',          data: 5 },
                { title: 'Actualizar',      data: 6, orderable: false },
                { title: 'Eliminar',        data: 7, orderable: false }
            ],
            order: [[1, 'asc']],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            responsive: true
        });

        // ── Hooks de carga ─────────────────────────────────────────────────
        tabla.on('preXhr.dt', function () {
            barStart();
        });

        tabla.on('draw.dt', function () {
            barDone();
            // Elimina las skeleton rows la primera vez
            $('#skeleton-body tr.ips-skeleton').fadeOut(200, function () { $(this).remove(); });
        });

        // Primera carga: la barra arranca de inmediato
        barStart();
    });
</script>
