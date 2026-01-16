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
                        <tbody>
                            <?php
                                foreach ($paciente as $pac) {
                                ?>

                                <tr>
                                    <td><?= $pac->pacDocumento; ?></td>
                                    <td><?= $pac->pacNombre . " " . $pac->pacNombre2 ." ". $pac->pacApellido ." ". $pac->pacApellido2 ; ?></td>
                                    <td><?= $pac->pacCorreo; ?></td>
                                    <td> <?php
                                            list($anio, $mes, $dia) = explode("-", $pac->pacFecNacimiento);
                                            $anio_dif = date("Y") - $anio;
                                            $mes_dif = date("m") - $mes;
                                            $dia_dif = date("d") - $dia;

                                            if ($dia_dif < 0 || $mes_dif < 0) {
                                                $anio_dif--;
                                                //return $anio_dif;
                                            }

                                            echo $anio_dif;

                                            ?>

                                    </td>
                                    
                                    <td>
                                        <?= $pac->tipNombre; ?>
                                    </td>
                                    <td>
                                        <?= $pac->tipo_novedad; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="<?= base_url("index.php/CPaciente/modRecuperar/$pac->idPaciente") ?>">Actualizar</a>
                                    </td>
                                    <td>
                                        <?php if ($pac->pacEstado == 'ACTIVO') { ?>

                                            <a class="btn btn-danger" onclick="eliminar('<?php echo $pac->idPaciente; ?>')">Eliminar</a>

                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                                }
                                ?>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function eliminar(id) {
        if (confirm('¿Desea eliminar el registro?')) {
            document.location.href = "<?php echo base_url() . 'index.php/CPaciente/eliminar/' ?>" + id;
            }
    }
</script>