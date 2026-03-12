<!-- ═══ Google-style loader — IPS Cajibio (Usuarios) ════════════════════ -->
<style>
#ips-topbar-u {
    position: fixed; top: 0; left: 0;
    height: 3px; width: 0%; z-index: 99999;
    background: linear-gradient(90deg, #2a327d 0%, #4e5fc7 40%, #166a28 70%, #2a327d 100%);
    background-size: 300% 100%;
    border-radius: 0 2px 2px 0;
    box-shadow: 0 0 10px rgba(42,50,125,0.7);
    animation: ips-shine-u 1.4s linear infinite;
    display: none;
}
@keyframes ips-shine-u {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
@keyframes ips-shimmer-u {
    0%   { background-position: -600px 0; }
    100% { background-position:  600px 0; }
}
#user-skeleton-overlay {
    position: absolute; top: 0; left: 0;
    width: 100%; z-index: 10;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0 0 4px 4px;
}
#user-skeleton-overlay table { margin-bottom: 0; }
.uph {
    height: 13px; border-radius: 6px; display: inline-block;
    background: linear-gradient(90deg, #e8ecf0 25%, #f8f9fa 50%, #e8ecf0 75%);
    background-size: 600px 100%;
    animation: ips-shimmer-u 1.4s ease-in-out infinite;
}
</style>

<div id="ips-topbar-u"></div>

<!-- This is the view where I list and search for the different users  -->
<div class="container text-white">
    <!-- Button trigger modal -->
    <h5 style="color:#FFFFFF">LISTA DE USUARIOS</h5>
    <hr>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
        Agregar Usuario</button><br><br>


    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <?php echo form_open_multipart('CUsuario/agregar'); ?>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"style="background:linear-gradient(20deg, #2a327d,#2a327d, #166a28, #166a28, #2a327d,#2a327d);">
                    <h5 class="modal-title text-white" id="myLargeModalLabel " >Formulario Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " enctype="multipart/form-data"style="background:linear-gradient(20deg, #2a327d,#2a327d, #166a28, #166a28, #2a327d,#2a327d);">
                    <p style="color: white;">Usuario</p>
                    <div class="form-row">
                        <div class="form-group col-md-4 text-white">
                            <label for="inputEmail4">Documento</label>
                            <input class="form-control" name="documento" type="text" placeholder="Documento" required="">
                        </div>
                        <div class="form-group col-md-4 text-white">
                            <label for="inputEmail4">Nombre</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Nombre" required="">
                        </div>
                        <div class="form-group col-md-4 text-white">
                            <label for="inputEmail4">Apellido</label>
                            <input class="form-control" name="apellido" type="text" placeholder="Apellido" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-white">
                            <label for="inputEmail4">Telefono</label>
                            <input class="form-control" name="telefono" type="text" placeholder="Telefono" required="">
                        </div>
                        <div class="form-group col-md-6 text-white">
                            <label for="inputEmail4">Correo</label>
                            <input class="form-control" name="correo" type="email" placeholder="Correo" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 text-white">
                            <label for="inputEmail4">Rol</label>
                            <select class="form-control" required="" name="rol" id="rol" onChange="mostrar(this.value);">
                                <option value="">[Seleccione]</option>
                                <?php
                                foreach ($rol as $r) {
                                    echo "<option value={$r->idRol}>{$r->rolNombre}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="tipo_usuario" style="display: none;">
                            <label for="inputEmail4">Tipo Usuario</label>
                            <select class="form-control" name="especialidad" id="especialidad"> 
                                <option value="">[Seleccione]</option>
                                <?php
                                foreach ($especialidad as $espe) {
                                    echo "<option value={$espe->idEspecialidad}>{$espe->espNombre}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-4" id="resolucion" style="display: none;">
                            <label for="inputEmail4">Resolucion</label>
                            <input onkeyup="validar()" class="inputFormu form-control" name="resolucion" id="resolucion" type="text" placeholder="Resolucion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3 text-white">
                            <label for="inputEmail4">Login</label>
                            <input class="form-control" name="login" type="text" placeholder="Login" required="" minlength="7">
                        </div>
                        <div class="form-group col-md-3 text-white">
                            <label for="inputEmail4">Contraseña</label>
                            <input class="form-control" name="pwd" type="password" placeholder="Contraseña" required="" minlength="7">
                        </div>
                        <div class="form-group col-md-6" id="firma" style="display: none;">
                            <label for="inputEmail4">Firma</label>
                            <input class="form-control" name="firma" id="firma1" type="file" accept="image/*" onchange="ValidarTamaño(this);">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"style="background:linear-gradient(20deg, #2a327d,#2a327d, #166a28, #166a28, #2a327d,#2a327d);">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input id="boton" type="submit" name="submit" value="Agregar" class="btn btn-primary" />
                </div>
            </div>
        </div>
    </div>
    <div style="position:relative">
    <!-- ── Skeleton overlay ── -->
    <div id="user-skeleton-overlay">
        <table class="table table-bordered bg-light mb-0" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>Resolución</th><th>Identificación</th><th>Nombre</th>
                    <th>Área</th><th>Estado</th><th>Actualizar</th><th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $docW  = [62,78,55,70,65,80,58];
                $nomW  = [140,120,160,135,150,125,145];
                $areaW = [80,95,70,88,75,90,72];
                for ($i = 0; $i < 7; $i++): ?>
                <tr>
                    <td><span class="uph" style="width:45px"></span></td>
                    <td><span class="uph" style="width:<?= $docW[$i] ?>px"></span></td>
                    <td><span class="uph" style="width:<?= $nomW[$i] ?>px"></span></td>
                    <td><span class="uph" style="width:<?= $areaW[$i] ?>px"></span></td>
                    <td><span class="uph" style="width:50px"></span></td>
                    <td><span class="uph" style="width:80px;height:28px;border-radius:4px;background:linear-gradient(90deg,#d1ecf1 25%,#eaf6f8 50%,#d1ecf1 75%);background-size:600px 100%;animation:ips-shimmer-u 1.4s ease-in-out infinite;"></span></td>
                    <td><span class="uph" style="width:65px;height:28px;border-radius:4px;background:linear-gradient(90deg,#f8d7da 25%,#fde8e9 50%,#f8d7da 75%);background-size:600px 100%;animation:ips-shimmer-u 1.4s ease-in-out infinite;"></span></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div><!-- /#user-skeleton-overlay -->

    <div class="table-responsive">
        <table id="example" class="table table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Resolucion</th>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Area</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuario as $usu) {
                ?>

                    <tr>
                        <td><?= $usu->usuRegistroProfesional; ?></td>
                        <td><?= $usu->usuDocumento ?></td>
                        <td><?= $usu->usuNombre . " " . $usu->usuApellido; ?></td>
                        <td><?= $usu->rolNombre; ?></td>
                        <td><?= $usu->estNombre; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url("index.php/CUsuario/modRecuperar/$usu->idUsuario") ?>">Actualizar</a>
                        </td>

                        <td>
                            <?php if ($usu->estado_idEstado == 1) { ?>
                                <a class="btn btn-danger" onclick="eliminar('<?php echo $usu->idUsuario; ?>')"> Eliminar</a>

                            <?php }

                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Resolucion</th>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Area</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div><!-- /.table-responsive -->
    </div><!-- /position:relative wrapper -->
</div>

<style>#prueba:hover {
color: #F21414;
}
</style>


<script type="text/javascript">
    /*$("#firma1").change(function() {
        $("button").prop("disabled", this.files.length == 0);
    });*/

    function ValidarTamaño(obj) {
        var uploadFile = obj.files[0];
        var img = new Image();
        img.onload = function() {
            if (this.width.toFixed(0) != 302 && this.height.toFixed(0) != 70) {
                alert("La imagen debe ser de tamaño 302px por 70px.");
                $('#firma1').val("");
            }

        };
        img.src = URL.createObjectURL(uploadFile);
    }


    // ── Barra de progreso ─────────────────────────────────────────────────
    var $barU = $('#ips-topbar-u'), barTimerU;

    function barStartU() {
        clearTimeout(barTimerU);
        $barU.stop(true).css({ width: '0%', display: 'block' }).animate({ width: '75%' }, 600);
    }
    function barDoneU() {
        $barU.animate({ width: '100%' }, 200, function () {
            var self = $(this);
            barTimerU = setTimeout(function () { self.fadeOut(300).css('width','0%'); }, 250);
        });
    }

    $(document).ready(function () {
        barStartU();
        // Espera a que VFooter inicialice #example para ocultar el skeleton
        $('#example').one('init.dt', function () {
            barDoneU();
            $('#user-skeleton-overlay').fadeOut(250);
        });
    });

    function eliminar(id) {
        if (confirm('¿Desea eliminar el registro?')) {
            document.location.href = "<?php echo base_url() . 'index.php/CUsuario/eliminar/' ?>" + id;
        }
    }

    function validar() {
        var validado = true;
        elementos = document.getElementsByClassName("inputFormu");
        //select = $("#especialidad").val();

        //alert(select)
        ///for (i = 0; i < elementos.length; i++) {
        /*if (elementos[i].value == "" || elementos[i].value == null) {
            validado = false
        }*/
        //}
        if (elementos == "" || elementos == null) {
            validado = false
        }else {
            validado = true
        }

        if (validado) {
            document.getElementById("boton").disabled = false;

        } else {
            document.getElementById("boton").disabled = true;
            //Salta un alert cada vez que escribes y hay un campo vacio
            //alert("Hay campos vacios")   
        }
    }

    function mostrar(id) {
        if (id == 2) {

            $("#tipo_usuario").show();
            $("#resolucion").show();
            $("#firma").show();

            document.getElementById("boton").disabled = true;

        } else {

            $("#tipo_usuario").hide();
            $("#resolucion").hide();
            $("#firma").hide();

            document.getElementById("boton").disabled = false;
        }
    }

    
</script>