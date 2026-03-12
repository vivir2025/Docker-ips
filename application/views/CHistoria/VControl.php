<style type="text/css">
    .checkRedondo{
        border-radius: 50%; /* Hace el checkbox redondo */
    }
    #body{
        background-color: white;
        
    }

   .form-group {
            position: relative;
        }

        .microfono {
            position: absolute;
            top: 50%; /* Centra verticalmente el ícono */
            right: 10px; /* Ajusta la posición horizontal del ícono */
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background-color: transparent;
            background-image: url('http://45.167.125.238/ips/assets/img/micro2.ico'); /* Ruta a la imagen del micrófono inactivo */
            background-size: cover;
            cursor: pointer;
            z-index: 1;
            display: inline-block; /* Para que el icono se ajuste al tamaño del contenido */
            transition: transform 0.3s ease-in-out;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(0, 0, 255, 0.7);
        }

        .microfono.active {
            animation: pulse 1s infinite; /* Aplica la animación cuando está activo */
            background-image: url('http://45.167.125.238/ips/assets/img/micro2.ico'); /* Ruta a la imagen del micrófono activo */
            box-shadow: 0 0 0 10px rgba(0, 0, 255, 0); /* Restaura la sombra */
        }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                box-shadow: 0 0 0 0 rgba(0, 0, 255, 0.7);
            }
            50% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(0, 0, 255, 0);
            }
            100% {
                transform: scale(0.8);
                box-shadow: 0 0 0 0 rgba(0, 0, 255, 0.7);
            }
        }

        .form-control {
            padding-right: 40px; /* Ajusta el espacio para el ícono */
            z-index: 0;
        }
    fieldset {
        border: 1px ridge #0f0fef;
        /* Borde */
    }

    legend {
        text-align: left;
        /* Puedes cambiarlo por center o right */
        width: inherit;
        /* Or auto */
        padding: 0 10px;
        /* To give a bit of padding on the left and right */
        border-bottom: none;
        font-size: 16px;
    }
</style>
<!-- This is the control medical history view  -->
<div class="bg-white">

<div class="mx-auto" style="width: 1300px;">

    <h5 style="color: blue;"><?= $detalles_cita[0]->espNombre ?>CONTROL GESTIÓN DEL RIESGO CARDIO RENAL23 - <?= $detalles_cita[0]->citFecha ?></h5>
    <form name="formulario" method="post" action="<?php echo site_url('CHistoria/guardar'); ?>">
        <?php foreach ($historia as $h) { ?>
            <input hidden="" name='id' value='<?= $cita ?>' />
            <input type="text" name="idHistoria" id="idHistoria" required="" value="<?= $idHistoria ?>" hidden>
            <fieldset>
                <legend>DATOS PACIENTE</legend>
                <div class="form-row" style="text-align:center">
                    <div class="form-group col-md-2">
                        <strong>NOMBRE</strong><br>
                        <?php
                        echo $detalles_cita[0]->nom_abreviacion . " " . $detalles_cita[0]->pacDocumento . "<br>";
                        echo $detalles_cita[0]->pacNombre . " " . $detalles_cita[0]->pacNombre2 . " " . $detalles_cita[0]->pacApellido . " " . $detalles_cita[0]->pacApellido2;
                        ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>FECHA NACIMIENTO Y EDAD</strong><br>
                        <?php echo $detalles_cita[0]->pacFecNacimiento . "<br>";
                        list($anio, $mes, $dia) = explode("-", $detalles_cita[0]->pacFecNacimiento);
                        $anio_dif = date("Y") - $anio;
                        $mes_dif = date("m") - $mes;
                        $dia_dif = date("d") - $dia;

                        if ($dia_dif < 0 || $mes_dif < 0) {
                            $anio_dif--;
                            //return $anio_dif;
                        }

                        echo $anio_dif . "Años";
                        ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>SEXO</strong><br>
                        <?php if ($detalles_cita[0]->pacSexo == "M") {
                            echo "MASCULINO";
                        } else {
                            echo "FEMENINO";
                        } ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>ESTADO CIVIL</strong><br>
                        <?php echo $detalles_cita[0]->pacEstCivil; ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>TELEFONO</strong><br>
                        <?php echo $detalles_cita[0]->pacTelefono; ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>DIRECCIÓN</strong><br>
                        <?php
                        echo $detalles_cita[0]->depNombre . " - " . $detalles_cita[0]->munNombre . "<br>" . $detalles_cita[0]->pacDireccion; ?>
                    </div>
                </div>
                <div class="form-row" style="text-align:center">
                    <div class="form-group col-md-3">
                        <strong>ASEGURADORA</strong><br>
                        <?php
                        echo $detalles_cita[0]->empNombre; ?>
                    </div>

                    <div class="form-group col-md-3">
                        <strong>RÉGIMEN</strong><br>
                        <?php echo $detalles_cita[0]->regNombre; ?>
                    </div>
                    <div class="form-group col-md-3">
                        <strong>OCUPACIÓN</strong><br>
                        <?php echo $detalles_cita[0]->ocuNombre; ?>
                    </div>
                    <div class="form-group col-md-3">
                        <strong>BRIGADA</strong><br>
                        <?php echo $detalles_cita[0]->zonNombre; ?>
                    </div>
                </div>

            </fieldset><br>
            <fieldset>
                <legend>ACUDIENTE</legend>
                <div class="form-row" style="margin: 10px;">
                    <div class="form-group col-md-4">
                        <strong>NOMBRE ACOMPAÑANTE</strong>
                        <input class="form-control input-sm" name="acompanante" id="acompanante" type="text" placeholder="Acompañante" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <strong>PARENTESCO</strong>
                        <input class="form-control input-sm" name="parentesco" id="parentesco" type="text" placeholder="Parentesco" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <strong>TELÉFONO</strong>
                        <input class="form-control input-sm" name="telefono" id="telefono" type="text" required="" placeholder="Telefono">
                    </div>
                </div>

            </fieldset><br>


            <fieldset>
                <legend>HISTORIA CLÍNICA</legend>

                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>PRESIÓN ARTERIAL SISTÓLICA</strong>
                            <input type="number" name="ef_pa_sistolica_sentado_pie" id="ef_pa_sistolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial sistolica">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>PRESIÓN ARTERIAL DIASTÓLICA</strong>
                            <input type="number" name="ef_pa_distolica_sentado_pie" id="ef_pa_distolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial distolica">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>FRECUENCIA CARDIACA</strong>
                            <input type="number" name="ef_frecuencia_fisica" class="form-control" required="" placeholder="Frecuencia cardiaca" id="ef_frecuencia_fisica">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>FRECUENCIA RESPIRATORIA</strong>
                            <input type="number" name="ef_frecuencia_respiratoria" id="ef_frecuencia_respiratoria" class="form-control" required="" placeholder="Frecuencia respiratoria">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>PERIMETRO ABDOMINAL</strong>
                            <input type="number" name="perimetro_abdominal" class="form-control" required="" placeholder="Perimetro abdominal" id="perimetro_abdominal">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>INSULINO REQUIRIENTE</strong>
                            <?php if ($h->insulina_requiriente == 'NO') { ?>
                                <select name="insulina_requiriente" required="" id="insulina_requiriente" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="<?= $h->insulina_requiriente; ?>" selected><?= $h->insulina_requiriente; ?></option>
                                </select>
                            <?php } elseif ($h->insulina_requiriente == 'SI') { ?>
                                <select name="insulina_requiriente" required="" id="insulina_requiriente" class="form-control input-sm">
                                    <option value="NO">NO</option>
                                    <option value="<?= $h->insulina_requiriente; ?>" selected><?= $h->insulina_requiriente; ?></option>
                                </select>


                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <strong>PESO KG</strong>
                            <input type="number" name="peso" id="peso" class="form-control" required="" placeholder="Peso KG" onchange="calcular_imc();">
                        </div>
                        <div class="form-group col-md-3">
                            <strong>TALLA CM</strong>
                            <input class="form-control" name="talla" id="talla" required="" type="number" value="<?php echo $historia[0]->hcTalla; ?>" onchange="calcular_imc();">
                        </div>
                        <div class="form-group col-md-3">
                            <strong>IMC</strong>
                            <input type="number" name="imc" id="imc" class="form-control" required="" placeholder="IMC" readonly="">
                        </div>
                        <div class="form-group col-md-3">
                            <strong>CLASIFICACIÓN</strong>
                            <input class="form-control" name="clasificacion" id="clasificacion" required="" type="text" placeholder="Clasificacion" readonly="">
                        </div>
                    </div>
                </div>
            </fieldset><br>

            <fieldset>
                <legend>EXAMEN FÍSICO POR SISTEMA</legend>

                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CABEZA</strong>
                            <input type="text" name="ef_cabeza" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_cabeza">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OJOS (AGUDEZA VISUAL)</strong>
                            <input type="text" name="ef_agudeza_visual" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_agudeza_visual">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>OÍDOS</strong>
                            <input type="text" name="oidos" class="form-control" required="" value="NORMAL NO REFIERE" id="oidos">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>NARIZ Y SENOS PARANASALES</strong>
                            <input type="text" name="nariz_senos_paranasales" class="form-control" required="" value="NORMAL NO REFIERE" id="nariz_senos_paranasales">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CAVIDAD ORAL</strong>
                            <input type="text" name="cavidad_oral" class="form-control" required="" value="NORMAL NO REFIERE" id="cavidad_oral">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>CUELLO</strong>
                            <input type="text" name="ef_cuello" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_cuello">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CARDIO RESPIRATORIO</strong>
                            <input type="text" name="cardio_respiratorio" class="form-control" required="" value="NORMAL NO REFIERE" id="cardio_respiratorio">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>MAMAS</strong>
                            <input type="text" name="ef_mamas" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_mamas">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GASTROINTESTINAL</strong>
                            <input type="text" name="gastrointestinal" class="form-control" required="" value="NORMAL NO REFIERE" id="gastrointestinal">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GENITOURINARIO</strong>
                            <input type="text" name="ef_genito_urinario" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_genito_urinario">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>MÚSCULO ESQUELÉTICO</strong>
                            <input type="text" name="musculo_esqueletico" class="form-control" required="" value="NORMAL NO REFIERE" id="musculo_esqueletico">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>PIEL Y ANEXOS PULSOS</strong>
                            <input type="text" name="ef_piel_anexos_pulsos" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_piel_anexos_pulsos">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>INSPECCIÓN Y SENSIBILIDAD EN PIES</strong>
                            <input type="text" name="inspeccion_sensibilidad_pies" class="form-control" required="" value="NORMAL NO REFIERE" id="inspeccion_sensibilidad_pies">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>NERVIOSO</strong>
                            <input type="text" name="ef_sistema_nervioso" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_sistema_nervioso">

                        </div>
                        <div class="form-group col-md-6">
                            <strong>CAPACIDAD COGNITIVA, ORIENTACIÓN</strong>
                            <input type="text" name="capacidad_congnitiva_orientacion" class="form-control" required="" value="NORMAL NO REFIERE" id="capacidad_congnitiva_orientacion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>REFLEJO AQUILIAR</strong>
                            <input type="text" name="ef_reflejo_aquiliar" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_reflejo_aquiliar">

                        </div>

                        <div class="form-group col-md-6">
                            <strong>REFLEJO PATELAR</strong>
                            <input type="text" name="ef_reflejo_patelar" class="form-control" required="" value="NORMAL NO REFIERE" id="ef_reflejo_patelar">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <strong>ANT DISLIPIDEMIA FAMILIAR</strong>
                            <input type="text" name="dislipidemia" id="dislipidemia" class="form-control" required="" value="NO">
                        </div>
                        <div class="form-group col-md-3">
                            <strong>LESIÓN DE ÓRGANO BLANCO</strong>
                            <select name="lesion_organo_blanco" required="" class="form-control input-sm" id="lesion_organo_blanco">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_lesion_organo_blanco">
                            <strong>DESCRIPCIÓN LESIÓN DE ÓRGANO BLANCO</strong><br>
                            <input type="text" name="descripcion_lesion_organo_blanco" placeholder="DESCRIPCION" class="form-control">
                        </div>
                    </div>
            </fieldset><br>
            <fieldset>
                <legend>EXÁMENES</legend>
                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <strong>ELECTROCARDIOGRAMA</strong><br>
							 <input type="date" class="form-control" name="fex_es" id="fex_es" required="" /><br>
                            <input type="text" name="hcElectrocardiograma" class="form-control" placeholder="Electrocardiograma" required="" id="hcElectrocardiograma">
                        </div>
                        <div class="form-group col-md-4">
                            <strong>ECOCARDIOGRAMA</strong><br>
							<input type="date" class="form-control" name="fex_es1" id="fex_es1" required="" /><br>
                            <input type="text" name="hcEcocardiograma" class="form-control" placeholder="Ecocardiograma" required="" id="hcEcocardiograma">
                        </div>
                        <div class="form-group col-md-4">
                            <strong>ECOGRAFÍA RENAL</strong><br>
							<input type="date" class="form-control" name="fex_es2" id="fex_es2" required="" /><br>
                            <input type="text" name="hcEcografiaRenal" class="form-control" placeholder="Ecografia renal" required="" id="hcEcografiaRenal">
                        </div>
                    </div>
                </div>
            </fieldset><br>
            
     

            <br>
            <fieldset>
                <legend>REVISIÓN POR SISTEMA</legend>
                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GENERAL</strong>
                            <input class="form-control" name="general" id="general" required="" type="text" value="NORMAL">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>CABEZA</strong>
                            <input type="text" name="cabeza" id="cabeza" class="form-control" required="" value="NORMAL">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>RESPIRATORIO</strong>
                            <input type="text" name="respiratorio" id="respiratorio" class="form-control" required="" value="NORMAL">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>CARDIOVASCULAR</strong>
                            <input type="text" name="cardiovascular" id="cardiovascular" class="form-control" required="" value="NORMAL">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GASTROINTESTINAL</strong>
                            <input type="text" name="gastrointestinal" id="gastrointestinal" class="form-control" required="" value="NORMAL">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <strong>OSTEOARTROMUSCULAR</strong>
                            <input type="text" name="osteoatromuscular" id="osteoatromuscular" class="form-control" required="" value="NORMAL">
                        </div>

                        <div class="form-group col-md-6">
                            <strong>SISTEMA NERVIOSO CENTRAL</strong>
                            <input type="text" name="snc" id="snc" class="form-control" required="" value="NORMAL">
                        </div>
                    </div>
                </div>
            </fieldset><br>

            <?php if (count($clasificacion) == 0) { ?>
                
                <fieldset>
                    <legend>CLASIFICACIÓN</legend>

                    <div style="margin: 10px;">
                    <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN ESTADO METABÓLICO</strong>
                            <select name="ClasificacionEstadoMetabolico" id="ClasificacionEstadoMetabolico" required="" class="form-control input-sm" >
				                <option value="">[SELECCIONE]</option>
                                <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERADO</option>
                                <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                            </select>
                        </div>
                        
                         
						<div class="form-group col-md-6">
                            <strong>HIPERTENSIÓN ARTERIAL</strong>
                            <select name="hipertension_arterial_personal" id="hipertension_arterial_personal" class="form-control input-sm" required>
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>	
                       <div class="form-group col-md-6">							
                                <strong>CLASIFICACIÓN HTA</strong>
                                <select name="clasificacion_hta" id="hta" required="" class="form-control input-sm">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="PA Normal">PA Normal</option>
                                    <option value="PA Normal - Alta">PA Normal - Alta</option>
                                    <option value="HTA Grado 1">HTA Grado 1</option>
                                    <option value="HTA Grado 2">HTA Grado 2</option>
                                    <option value="No HTA">No HTA</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN DM</strong>
                                <select class="form-control" required="" name="clasificacion_dm" id="clasificacion_dm">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="TIPO 1">TIPO 1</option>
                                    <option value="TIPO 2">TIPO 2</option>
                                    <option value="NO DIABETICO">NO DIABÉTICO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN ERC ESTADIO</strong>
                                <select class="form-control" name="clasificacion_erc_estado" required="" id="clasificacion_erc_estado">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="IIIA">IIIA</option>
                                    <option value="IIIB">IIIB</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN ERC CATEGORÍA DE ALBUMINURIA PERSISTENTE</strong>
                                <select class="form-control" name="clasificacion_erc_categoria_ambulatoria_persistente" required="" id="clasificacion_erc_categoria_ambulatoria_persistente">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
									<option value="SIN CLASIFICAR">SIN CLASIFICACIÓN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN RIESGO CARDIO VASCULAR</strong>
                                <select class="form-control" name="clasificacion_rcv" required="" id="clasificacion_rcv">
                                    <option value="">[SELECCIONE]</option>
                                    <option value="BAJO">BAJO</option>
                                    <option value="MODERADO">MODERADO</option>
                                    <option value="ALTO">ALTO</option>
                                    <option value="MUY ALTO">MUY ALTO</option>
                                    <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>TASA DE FILTRACIÓN GLOMERULAR CKD-EPI</strong>
                                <input class="form-control" name="tasa_filtracion_glomerular_ckd_epi" type="number" id="tasa_filtracion_glomerular_ckd_epi" placeholder="Tasa de filtracion glomerular CKD-EPI" value="0">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>TASA DE FILTRACIÓN GLOMERULAR Cockcroft-Gault</strong>
                                <input class="form-control" name="tasa_filtracion_glomerular_gockcroft_gault" type="number" placeholder="Tasa de filtracion glomerular Cockcroft-Gault" value="0" id="tasa_filtracion_glomerular_gockcroft_gault">
                            </div>
                        </div>
                    </div>
                </fieldset><br>

            <?php } else { ?>

                <fieldset>
                    <legend>CLASIFICACIÓN</legend>
					

                    <div style="margin: 10px;">
					<div class="form-row">
                   
                
						<div class="form-group col-md-6">
                            <strong>HIPERTENSIÓN ARTERIAL</strong>
                            <?php if ($clasificacion[0]->hcHipertensionArterialPersonal == 'SI') { ?>
                            <select class="form-control" required="" name="hipertension_arterial_personal"   >
                                <option value="<?= $clasificacion[0]->hcHipertensionArterialPersonal; ?>" selected><?= $clasificacion[0]->hcHipertensionArterialPersonal ; ?></option>
                                <option value="NO" >NO</option>
                            </select>
                            
                            <?php } elseif ($clasificacion[0]->hcHipertensionArterialPersonal == 'NO') { ?>

                                <select class="form-control" required="" name="hipertension_arterial_personal"   >
                                <option value="SI">SI</option>
                                <option value="<?= $clasificacion[0]->hcHipertensionArterialPersonal; ?>" selected><?= $clasificacion[0]->hcHipertensionArterialPersonal; ?></option>
                            </select>

                            <?php } else { ?>
                                    <select class="form-control" required="" name="hipertension_arterial_personal">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                      |
                                    </select>

                                <?php } ?>
                        </div>  
						<div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN HTA</strong>
                                <?php if ($clasificacion[0]->hcClasificacionHta == 'PA Normal') { ?>
                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="<?= $clasificacion[0]->hcClasificacionHta; ?>" selected><?= $clasificacion[0]->hcClasificacionHta; ?></option>
                                        <option value="PA Normal - Alta">PA Normal - Alta</option>
                                        <option value="HTA Grado 1">HTA Grado 1</option>
                                        <option value="HTA Grado 2">HTA Grado 2</option>
                                        <option value="No HTA">No HTA</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionHta == 'PA Normal - Alta') { ?>

                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="PA Normal">PA Normal</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionHta; ?>" selected><?= $clasificacion[0]->hcClasificacionHta; ?></option>
                                        <option value="HTA Grado 1">HTA Grado 1</option>
                                        <option value="HTA Grado 2">HTA Grado 2</option>
                                        <option value="No HTA">No HTA</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionHta == 'HTA Grado 1') { ?>
                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="PA Normal">PA Normal</option>
                                        <option value="PA Normal - Alta">PA Normal - Alta</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionHta; ?>" selected><?= $clasificacion[0]->hcClasificacionHta; ?></option>
                                        <option value="HTA Grado 2">HTA Grado 2</option>
                                        <option value="No HTA">No HTA</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionHta == 'HTA Grado 2') { ?>
                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="PA Normal">PA Normal</option>
                                        <option value="PA Normal - Alta">PA Normal - Alta</option>
                                        <option value="HTA Grado 1">HTA Grado 1</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionHta; ?>" selected><?= $clasificacion[0]->hcClasificacionHta; ?></option>
                                        <option value="No HTA">No HTA</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionHta == 'No HTA') { ?>

                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="PA Normal">PA Normal</option>
                                        <option value="PA Normal - Alta">PA Normal - Alta</option>
                                        <option value="HTA Grado 1">HTA Grado 1</option>
                                        <option value="HTA Grado 2">HTA Grado 2</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionHta; ?>" selected><?= $clasificacion[0]->hcClasificacionHta; ?></option>
                                    </select>

                                <?php } else { ?>
                                    <select class="form-control" required="" name="clasificacion_hta">
                                        <option value="PA Normal">PA Normal</option>
                                        <option value="PA Normal - Alta">PA Normal - Alta</option>
                                        <option value="HTA Grado 1">HTA Grado 1</option>
                                        <option value="HTA Grado 2">HTA Grado 2</option>
                                        <option value="No HTA">No HTA</option>
                                    </select>

                                <?php } ?>

                            </div>
					
					  
                        <div class="form-group col-md-6">
                            <strong>DIABETES MELLITUS</strong>
                            <?php if ($clasificacion[0]->hcDiabetesMellitusPersonal == 'SI') { ?>
                            <select class="form-control" required="" name="diabetes_mellitus_personal">
                            <option value="<?= $clasificacion[0]->hcDiabetesMellitusPersonal; ?>" selected><?= $clasificacion[0]->hcDiabetesMellitusPersonal; ?></option>
                                <option value="NO" >NO</option>
                            </select>
                            
                            <?php } elseif ($clasificacion[0]->hcDiabetesMellitusPersonal == 'NO') { ?>

                                <select class="form-control" required="" name="diabetes_mellitus_personal"   >
                                <option value="SI">SI</option>
                                <option value="<?= $clasificacion[0]->hcDiabetesMellitusPersonal; ?>" selected><?= $clasificacion[0]->hcDiabetesMellitusPersonal; ?></option>
                            </select>

                            <?php } else { ?>
                                    <select class="form-control" required="" name="diabetes_mellitus_personal">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                      
                                    </select>

                                <?php } ?>
                        </div>
                      
							
                           
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN DM</strong>
                                <?php if ($clasificacion[0]->hcClasificacionDm == 'TIPO 1') { ?>
                                    <select class="form-control" required="" name="clasificacion_dm">
                                        <option value="<?= $clasificacion[0]->hcClasificacionDm; ?>" selected><?= $clasificacion[0]->hcClasificacionDm; ?></option>
                                        <option value="TIPO 2">TIPO 2</option>
                                        <option value="NO DIABETICO">NO DIABÉTICO</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionDm == 'TIPO 2') { ?>

                                    <select class="form-control" required="" name="clasificacion_dm">
                                        <option value="TIPO 1">TIPO 1</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionDm; ?>" selected><?= $clasificacion[0]->hcClasificacionDm; ?></option>
                                        <option value="NO DIABETICO">NO DIABÉTICO</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionDm == 'NO DIABETICO') { ?>

                                    <select class="form-control" required="" name="clasificacion_dm">
                                        <option value="TIPO 1">TIPO 1</option>
                                        <option value="TIPO 2">TIPO 2</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionDm; ?>" selected><?= $clasificacion[0]->hcClasificacionDm; ?></option>
                                    </select>

                                <?php } else { ?>
                                    <select class="form-control" required="" name="clasificacion_dm">
                                        <option value="TIPO 1">TIPO 1</option>
                                        <option value="TIPO 2">TIPO 2</option>
                                        <option value="NO DIABETICO">NO DIABÉTICO</option>
                                    </select>

                                <?php } ?>


                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN ERC ESTADO</strong>
                                <?php if ($clasificacion[0]->hcClasificacionErcEstado == 'I') { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'II') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IIIA') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IIIB') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IV') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'V') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'SIN CLASIFICACION') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                    </select>

                                <?php } else { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN</option>
                                    </select>

                                <?php } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN ERC CATEGORÍA DE ALBUMINURIA PERSISTENTE</strong>
                                <?php if ($clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente == 'A1') { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_categoria_ambulatoria_persistente">
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?>" selected><?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?></option>
                                        <option value="A2">A2</option>
                                        <option value="A3">A3</option>
										<option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente == 'A2') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_categoria_ambulatoria_persistente">
                                        <option value="A1">A1</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?>" selected><?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?></option>
                                        <option value="A3">A3</option>
										<option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente == 'A3') { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_categoria_ambulatoria_persistente">
                                        <option value="A1">A1</option>
                                        <option value="A2">A2</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?>" selected><?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?></option>
										<option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>
									
								<?php } elseif ($clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente == 'SIN CLASIFICAR') { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_categoria_ambulatoria_persistente">
                                        <option value="A1">A1</option>
                                        <option value="A2">A2</option>
										 <option value="A3">A3</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?>" selected><?= $clasificacion[0]->hcClasificacionErcCategoriaAmbulatoriaPersistente; ?></option>
                                    </select>

                                <?php } else { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_categoria_ambulatoria_persistente">
                                        <option value="A1">A1</option>
                                        <option value="A2">A2</option>
                                        <option value="A3">A3</option>
										<option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN RCV</strong>

                                <?php if ($clasificacion[0]->hcClasificacionRcv == 'BAJO') { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="<?= $clasificacion[0]->hcClasificacionRcv; ?>" selected><?= $clasificacion[0]->hcClasificacionRcv; ?></option>
                                        <option value="MODERADO">MODERADO</option>
                                        <option value="ALTO">ALTO</option>
                                        <option value="MUY ALTO">MUY ALTO</option>
                                        <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionRcv == 'MODERADO') { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="BAJO">BAJO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionRcv; ?>" selected><?= $clasificacion[0]->hcClasificacionRcv; ?></option>
                                        <option value="ALTO">ALTO</option>
                                        <option value="MUY ALTO">MUY ALTO</option>
                                        <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionRcv == 'ALTO') { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="BAJO">BAJO</option>
                                        <option value="MODERADO">MODERADO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionRcv; ?>" selected><?= $clasificacion[0]->hcClasificacionRcv; ?></option>
                                        <option value="MUY ALTO">MUY ALTO</option>
                                        <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php  } elseif ($clasificacion[0]->hcClasificacionRcv == 'MUY ALTO') { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="BAJO">BAJO</option>
                                        <option value="MODERADO">MODERADO</option>
                                        <option value="ALTO">ALTO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionRcv; ?>" selected><?= $clasificacion[0]->hcClasificacionRcv; ?></option>
                                        <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php  } elseif ($clasificacion[0]->hcClasificacionRcv == 'SIN CLASIFICAR') { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="BAJO">BAJO</option>
                                        <option value="MODERADO">MODERADO</option>
                                        <option value="ALTO">ALTO</option>
                                        <option value="MUY ALTO">MUY ALTO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionRcv; ?>" selected><?= $clasificacion[0]->hcClasificacionRcv; ?></option>
                                    </select>



                                <?php } else { ?>
                                    <select class="form-control" required="" name="clasificacion_rcv">
                                        <option value="BAJO">BAJO</option>
                                        <option value="MODERADO">MODERADO</option>
                                        <option value="ALTO">ALTO</option>
                                        <option value="MUY ALTO">MUY ALTO</option>
                                        <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                                    </select>

                                <?php } ?>

                            </div>
							<div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN ESTADO METABÓLICO</strong>
                                <?php if ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'HTA-RIESGOS BAJO') { ?>
                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'HTA-RIESGOS MODERNO') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                        <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'HTA-RIESGOS ALTO') { ?>
                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                        <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                    <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'HTA-RIESGOS MUY ALTO') { ?>
                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                        <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'HTA-RIESGOS SIN CLASIFICAR') { ?>
                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                        <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'DM-RIESGOS SIN COMPLICACIONES') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                     <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'DM-RIESGOS CON COMPLICACIONES') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                    
                                     <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'ERC-RIESGOS ESTADIO IIIB') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                    
                                     <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'ERC-RIESGOS ESTADIO IV') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                                 <?php } elseif ($clasificacion[0]->hcClasificacionEstadoMetabolico == 'ERC-RIESGOS ESTADIO V') { ?>

                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?>" selected><?= $clasificacion[0]->hcClasificacionEstadoMetabolico; ?></option>
                                        
                                    </select>


                                <?php } else { ?>
                                    <select class="form-control" required="" name="ClasificacionEstadoMetabolico">
                                    <option value="HTA-RIESGOS BAJO">HTA-RIESGOS BAJO</option>
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERNO</option>
                                        <option value="HTA-RIESGOS ALTO">HTA-RIESGOS ALTO</option>
                                        <option value="HTA-RIESGOS MUY ALTO">HTA-RIESGOS MUY ALTO</option>
                                        <option value="HTA-RIESGOS SIN CLASIFICAR">HTA-RIESGOS SIN CLASIFICAR</option>
                                        <option value="DM-RIESGOS SIN COMPLICACIONES">DM-RIESGOS SIN COMPLICACIONES</option>
                                        <option value="DM-RIESGOS CON COMPLICACIONES">DM-RIESGOS CON COMPLICACIONES</option>
                                        <option value="ERC-RIESGOS ESTADIO IIIB">ERC-RIESGOS ESTADIO IIIB</option>
                                        <option value="ERC-RIESGOS ESTADIO IV">ERC-RIESGOS ESTADIO IV</option>
                                        <option value="ERC-RIESGOS ESTADIO V">ERC-RIESGOS ESTADIO V</option>
                                    </select>

                                <?php } ?>

                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>TASA DE FILTRACIÓN GLOMERULAR CKD-EPI</strong>
                                 <?php if ($h->tasa_filtracion_glomerular_ckd_epi == ""){?>

                                    <input class="form-control" name="tasa_filtracion_glomerular_ckd_epi" required="" type="number" id="tasa_filtracion_glomerular_ckd_epi" placeholder="Tasa de filtracion glomerular CKD-EPI">
                                    
                                <?php }else{ ?>
                                <input class="form-control" name="tasa_filtracion_glomerular_ckd_epi" required="" type="number" value="<?= $h->tasa_filtracion_glomerular_ckd_epi; ?>" id="tasa_filtracion_glomerular_ckd_epi">
                                <?php } ?>
							</div>
							
                            <div class="form-group col-md-6">
                                <strong>TASA DE FILTRACIÓN GLOMERULAR Cockcroft-Gault</strong>
                                <?php if ($h->tasa_filtracion_glomerular_gockcroft_gault == ""){?>

                                <input class="form-control" name="tasa_filtracion_glomerular_gockcroft_gault" required="" type="number" id="tasa_filtracion_glomerular_gockcroft_gault" placeholder="Tasa de filtracion glomerular Cockroft-Gault">

                                <?php }else{ ?>
                                 <input class="form-control" name="tasa_filtracion_glomerular_gockcroft_gault" required="" type="number" value="<?= $h->tasa_filtracion_glomerular_gockcroft_gault; ?>" id="tasa_filtracion_glomerular_gockcroft_gault">
                                <?php } ?>
                            </div>
                        </div>
                </fieldset>

            <?php } ?><br>

            <fieldset>
                <legend>EDUCACIÓN</legend>

                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ALIMENTACIÓN</strong>
                            <input class="form-control" type="text" name="alimentacion" value="<?= $h->hcAlimentacion ?>" id="alimentacion">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>FOMENTO DE ACTIVIDAD FÍSICA</strong>
                            <input name="fomento_actividad_fisica" required="" class="form-control" value="<?= $h->hcFomentoActividadFisica ?>" id="fomento_actividad_fisica">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>IMPORTANCIA DE ADHERENCIA A TRATAMIENTO</strong>
                            <input type="text" name="importancia_adherencia_tratamiento" required="" class="form-control" value="<?= $h->hcOmportanciaAdherenciaTratamiento ?>" id="importancia_adherencia_tratamiento">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>DISMINUCIÓN DE CONSUMO DE SAL/AZÚCAR</strong>
                            <input name="disminucion_consumo_sal_azucar" type="text" required="" class="form-control" value="<?= $h->hcDisminucionConsumoSalAzucar ?>" id="disminucion_consumo_sal_azucar">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>DISMINUCIÓN DE CONSUMO CIGARRILLO</strong>
                            <input name="disminucion_consumo_cigarrillo" required="" class="form-control" value="<?= $h->hcDisminucionConsumoCigarrillo ?>" id="disminucion_consumo_cigarrillo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>DISMINUCIÓN DE PESO</strong>
                            <input name="disminucion_peso" required="" class="form-control" value="<?= $h->hcDisminucionPeso ?>" id="disminucion_peso">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>CONSUMO DE FRUTAS Y VERDURAS</strong>
                            <input name="consumo_frutas_verduras" required="" class="form-control" value="<?= $h->hcConsumoFrutasVerduras ?>" id="consumo_frutas_verduras">
                        </div>

                    </div>
                </div>
            </fieldset><br>

            <fieldset>
                <legend>ADHERENCIA FARMACOLÓGICA VALORACIÓN TEST DE MORISKY</legend>
                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>OLVIDA ALGUNA VEZ TOMAR SUS MEDICAMENTOS</strong>
                            <input type="text" name="test_morisky_olvida_tomar_medicamentos" required="" class="form-control" value="<?= $h->hcOlvidaTomarMedicamentos ?>" id="test_morisky_olvida_tomar_medicamentos">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>TOMA LOS MEDICAMENTOS A LA HORA INDICADA</strong>
                            <input type="text" name="test_morisky_toma_medicamentos_hora_indicada" required="" class="form-control" value="<?= $h->hcTomaMedicamentosHoraIndicada ?>" id="test_morisky_toma_medicamentos_hora_indicada">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CUANDO SE ENCUENTRA BIEN ¿DEJA DE TOMAR SUS MEDICAMENTOS?</strong>
                            <input type="text" name="test_morisky_cuando_esta_bien_deja_tomar_medicamentos" required="" class="form-control" value="<?= $h->hcCuandoEstaBienDejaTomarMedicamentos ?>" id="test_morisky_cuando_esta_bien_deja_tomar_medicamentos">
                        </div>


                        <div class="form-group col-md-6">
                            <strong>CUANDO SE ENCUENTRA MAL ¿DEJA DE TOMAR SUS MEDICAMENTOS?</strong>
                            <input type="text" name="test_morisky_siente_mal_deja_tomarlos" required="" class="form-control" value="<?= $h->hcSienteMalDejaTomarlos ?>" id="test_morisky_siente_mal_deja_tomarlos">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ADHERENTE</strong>
                            <select name="adherente" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset><br>

            <div style="border: ridge #0f0fef 1px;">
        <div class="form-row" style="margin: 10px;">
            <div class="form-group col-md-12">
                <strong>OTRAS OBSERVACIONES</strong>
                <div class="form-group" style="position: relative;">
                    <textarea class="form-control" name="observaciones_generales" placeholder="Observaciones generales" required="" rows="2" id="observaciones_generales"></textarea>
                    <span class="microfono" id="microfono"></span>
                </div>
            </div>
        </div>
            </div>
<br>
<fieldset>
            <legend>EXAMENES PDF</legend>
            <div style="margin: 10px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="mens_pdf"></div>
                        <!-- Formulario para agregar PDF -->
                        <form id="formPdf" enctype="multipart/form-data">
                            <!-- Campo oculto para idHistoria -->
                            <input type="hidden" name="idHistoria" id="idHistoria" value="<?php echo isset($idHistoria) ? $idHistoria : ''; ?>">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <center>FORMATO DE EXAMENES PDF</center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Archivo PDF</th>
                                        <th>Observación</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>
                                        <input type="file" name="Archivo" id="Archivo" accept="application/pdf" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="Observación" id="Observación" placeholder="Observación" required>
                                    </td>
                                    <td>
                                        <button type="button" id="add_pdf" class="btn btn-outline-info">Agregar</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br><br>
                        <!-- Tabla para mostrar la lista de PDFs guardados -->
                        <table class="table table-bordered" id="pdfData">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <center>LISTA FORMATO DE EXAMENES PDF</center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Nombre PDF</th>
                                    <th>Observación</th>
                                    <th>Opsiones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        foreach ($examenes_pdf as $pdf) {
                            echo "<tr>";
                            echo "<td>{$pdf->Archivo}</td>";
                            echo "<td>{$pdf->Observación}</td>";
                            echo "<td><a class='btn btn-outline-info' href='" . base_url($pdf->Archivo) . "' target='_blank'>Ver</a></td>";
                            echo "</tr>";
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </fieldset>
<br>
<fieldset>
    <legend>MEDICAMENTOS</legend>
    <div style="margin: 10px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="modal fade" id="modal_medicamento">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myLargeModalLabel">Formulario Medicamentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br>
                            <div class="container" id="mens_actualizacion_medicamento"></div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input name="id_his_med_actualizacion" id="id_his_med_actualizacion" hidden="" />
                                        <label>Cantidad</label>
                                        <input class="form-control" name="editar_cantidad" type="text" id="editar_cantidad" placeholder="Cantidad" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Dosis</label>
                                        <input class="form-control" name="editar_dosis" type="text" placeholder="Dosis" id="editar_dosis">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                                <a id="actualizar_medicamento" class="btn btn-outline-info">Guardar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="mens"></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <center>FÓRMULA MÉDICA</center>
                            </th>
                        </tr>
                        <tr>
                            <th>MEDICAMENTO</th>
                            <th>CANTIDAD</th>
                            <th>DOSIS</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tr>
                        <form>
                            <td>
                                <input type="text" name="idMedicamento" id="idMedicamento" hidden="">
                                <input type="text" id="medicamento" name="medicamento" onKeyUp="buscar();" class="form-control" placeholder="Medicamento" size="80" />
                                <div id="lista_nombre" style="display: none;"></div>
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
                </table>
                <br><br>
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th colspan="7">
                                <center>FÓRMULA MÉDICA <?php echo date("Y-m-d", time()); ?></center>
                            </th>
                        </tr>
                        <tr>
                            <th> <input type="checkbox" id="seleccionarTodosMedicamentos" class="checkRedondo"> SELECCIONAR</th>
                            <th>MEDICAMENTO</th>
                            <th>CANTIDAD</th>
                            <th>DOSIS</th>
                            <th colspan="2">OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($medicamento_historia as $mh) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='checkEliminarMedicamento' value='{$mh->id_his_med}' style='border-radius: 50%;'></td>";
                            echo "<td>" . $mh->medNombre . "</td>";
                            echo "<td>" . $mh->hisMedCantidad . "</td>";
                            echo "<td>" . $mh->hisMedDosis . "</td>";
                            echo "<td><button type='button' class='btn btn-outline-primary btn-view-medicamento' value='$mh->id_his_med' data-toggle='modal' data-target='#modal_medicamento'>Editar</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <a class="btn btn-outline-danger" id="botonEliminarMedicamentos" style="border-radius: 50px;">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<br>


    <fieldset>
    <legend>REMISIÓN</legend>
    <div style="margin: 10px;">
        <div class="row">
            <div class="col-sm-12">
                <div id="mens_remision"></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <center>FORMATO DE REMISIÓN</center>
                            </th>
                        </tr>
                        <tr>
                            <th>REMISIÓN</th>
                            <th>OBSERVACIÓN</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tr>
                        <form>
                            <td>
                                <input type="text" name="idRemision" id="idRemision" hidden="">
                                <input type="text" id="remision" name="remision" onKeyUp="buscar_remision();" class="form-control" placeholder="Remisión" />
                                <div id="lista_nombre_remision" style="display: none;"></div>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="remObservacion" id="remObservacion" placeholder="Observación" />
                            </td>
                            <td>
                                <a id="add_remision" class="btn btn-outline-info">Agregar</a>
                            </td>
                        </form>
                    </tr>
                </table>
                <br><br>
                <table class="table table-bordered" id="data1">
                    <thead>
                        <tr>
                            <th colspan="7">
                                <center>FORMULA DE REMISIÓN <?php echo date("Y-m-d", time()); ?></center>
                            </th>
                        </tr>
                        <tr>
                            <th> 
                                <input type="checkbox" id="remisionTodos" class="checkRedondo"> SELECCIONAR
                            </th>
                            <th>CÓDIGO</th>
                            <th>REMISIÓN</th>
                            <th>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($remision_historia as $r) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='checkEliminar checkRemision' value='{$r->id_his_rem}' style='border-radius: 50%;'></td>";
                            echo "<td>". $r->remCodigo . "</td>";
                            echo "<td>" . $r->remNombre . "</td>";
                            echo "<td>" . $r->remObservacion . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <a class="btn btn-outline-danger" id="botonEliminarRemisiones" style="border-radius: 50px;">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<br>

<fieldset>
    <legend>AYUDAS DIAGNÓSTICAS</legend>
    <div style="margin: 10px;">
        <div class="row">
            <div class="col-sm-12">
                <div id="mens_cups"></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <center>FORMATO AYUDA DIAGNOSTICA</center>
                            </th>
                        </tr>
                        <tr>
                            <th>CUPS</th>
                            <th>OBSERVACIÓN</th>
                            <th>OPCIÓN</th>
                            <th>PAQUETE</th>
                        </tr>
                    </thead>
                    <tr>
                        <form>
                            <td>
                                <input type="text" name="idCups" id="idCups" hidden="">
                                <input type="text" id="cup" name="cup" onKeyUp="buscar_cups();" class="form-control" placeholder="CUPS" />
                                <div id="lista_nombre_cups" style="display: none;"></div>
                            </td>
                            <td>
                                <input type="text" name="cupObservacion" id="cupObservacion" placeholder="Observacion" class="form-control">
                            </td>
                            <td>
                                <a id="add_cups" class="btn btn-outline-info">Agregar</a>
                            </td>
                            <td>
                                <a id="add_paquete" class="btn btn-outline-success">P_Lipidico</a>
                            </td>
                        </form>
                    </tr>
                </table>
                <br><br>
                <table class="table table-bordered" id="data2">
                    <thead>
                        <tr>
                            <th colspan="7">
                                <center>FORMATO AYUDA DIAGNOSTICA <?php echo date("Y-m-d", time()); ?></center>
                            </th>
                        </tr>
                        <tr>
                            <th><input type="checkbox" id="seleccionarTodosAyudas" class="checkRedondo"> SELECCIONAR</th>
                            <th>CÓDIGO</th>
                            <th>CUPS</th>
                            <th>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cups_historia as $ch) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='checkEliminarAyuda' value='{$ch->id_his_cups}' style='border-radius: 50%;'></td>";
                            echo "<td>" . $ch->cupCodigo . "</td>";
                            echo "<td>" . $ch->cupNombre . "</td>";
                            echo "<td>" . $ch->cupObservacion . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <a class="btn btn-outline-danger" id="botonEliminarAyudas" style="border-radius: 50px;">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<br>


<fieldset>
    <legend>DIAGNÓSTICO</legend>
    <div class="form-row" style="margin: 10px;">
        <div class="col-sm-12">
            <div id="mens_diagnostico"></div>
        </div>
        <!-- Diagnóstico principal -->
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
        <div class="form-group col-md-1"><br>
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
        <div class="form-group col-md-1"><br>
            <a id="add_diagnostico1" class="btn btn-outline-primary">Guardar</a>
        </div>

        <!-- Tabla de Diagnósticos -->
        <div id="data3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="7">
                            <center>FORMATO DIAGNÓSTICO <?php echo date("Y-m-d", time()); ?></center>
                        </th>
                    </tr>
                    <tr>
                        <th><input type="checkbox" id="diagnosticoTodos" class="checkRedondo"> SELECCIONAR</th>
                        <th>CÓDIGO</th>
                        <th>DIAGNÓSTICO</th>
                        <th>CLASIFICACIÓN</th>
                        <th>TIPO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($diagnostico_historia as $dh) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' class='checkEliminar' value='{$dh->id_his_dia}' style='border-radius: 50%;'></td>";
                        echo "<td>" . $dh->diaCodigo . "</td>";
                        echo "<td>" . $dh->diaNombre . "</td>";
                        echo "<td>" . $dh->his_dia_tipo . "</td>";
                        echo "<td>" . $dh->hcTipoDiagnostico . "</td>";
                        echo "</tr>";
                    }
                    $contador = count($diagnostico_historia);
                    ?>
                </tbody>
            </table>
            <div class="modal-footer">
                <a class="btn btn-outline-danger" id="botonEliminarDiagnosticos" style="border-radius: 50px;">Eliminar</a>
            </div>
        </div>

        <!-- Causa Externa -->
        <div class="form-group col-md-6">
            <strong>CAUSA EXTERNA</strong>
            <select name="causa_externa" required="" class="form-control input-sm">
                <option value="ACCIDENTE DE TRABAJO">ACCIDENTE DE TRABAJO</option>
                <option value="ACCIDENTE DE TRANSITO">ACCIDENTE DE TRÁNSITO</option>
                <option value="ACCIDENTE RABICO">ACCIDENTE RÁBICO</option>
                <option value="ACCIDENTE OFIDICO">ACCIDENTE OFÍDICO</option>
                <option value="OTRO TIPO DE ACCIDENTE">OTRO TIPO DE ACCIDENTE</option>
                <option value="EVENTO CATASTROFICO">EVENTO CATASTRÓFICO</option>
                <option value="LESION POR AGRESION">LESIÓN POR AGRESIÓN</option>
                <option value="LESION AUTO INFLIGIDA">LESIÓN AUTO INFLIGIDA</option>
                <option value="SOSPECHA DE MALTRATO FISICO">SOSPECHA DE MALTRATO FÍSICO</option>
                <option value="SOSPECHA DE ABUSO SEXUAL">SOSPECHA DE ABUSO SEXUAL</option>
                <option value="SOSPECHA DE VIOLENCIA SEXUAL">SOSPECHA DE VIOLENCIA SEXUAL</option>
                <option value="SOSPECHA DE MALTRATO EMOCIONAL">SOSPECHA DE MALTRATO EMOCIONAL</option>
                <option value="ENFERMEDAD GENERAL">ENFERMEDAD GENERAL</option>
                <option value="ENFERMEDAD PROFESIONAL">ENFERMEDAD PROFESIONAL</option>
                <option value="OTRA">OTRA</option>
            </select>
        </div>
    </div>
</fieldset>
<br>

            <div style="border: ridge #0f0fef 1px;">
                <div class="form-row" style="margin: 10px;">
                    <div class="form-group col-md-12">
                        <strong>FINALIDAD</strong>
                        <input class="form-control input-sm" name="finalidad" type="text" required="" value="<?= $h->finalidad_idFinalidad; ?>">
                    </div>
                </div>
            </div><br>
            <div style="border: ridge #0f0fef 1px;">
                <div class="form-row" style="margin: 10px;">
                    <!--div id="mens_paraclinico_upload" style="display: none;"></div-->

                    <div class="row">
                        <!-- Button trigger modal -->
                        <div class="col-12">
                            <?php $doc = $detalles_cita[0]->pacDocumento; ?>
                            <a type="button" class="btn btn-outline-primary " target="_blank" href="<?= base_url("index.php/CHistoria/lista_paraclinico/$doc") ?>">
                                Paraclinicos
                            </a>
                        </div>
                        <br>
                     
                <div class="form-row" style="margin: 10px;">
                        <div class=" col-12">
                            <?php $doc = $detalles_cita[0]->pacDocumento; ?>
                            <a type="button" class="btn btn-outline-primary " target="_blank" href="<?= base_url("index.php/CHistoria/lista_visitas/$doc") ?>">
                               App visitas Domiciliaria
                            </a>
                        </div>
                    </div>
                </div></div>
            </div><br>

            <div style="border: ridge #0f0fef 1px;">
                <div class="form-row" style="margin: 10px; text-align:center;">
                    <div class="form-group col-md-6">
                        <?php

                        echo '<img alt="Image placeholder" width="302px" height="70px" src="data:image/jpeg;base64,' . base64_encode($detalles_cita[0]->usuFirma) . '"/>'; ?><br>

                        <strong>FIRMA DIGITAL</strong><br>
                        <strong>PROFESIONAL: </strong>
                        <em><?= $detalles_cita[0]->usuNombre . " " . $detalles_cita[0]->usuApellido; ?><br>RM: <?= $detalles_cita[0]->usuRegistroProfesional; ?></em>
                    </div>
                    <div class="form-group col-md-6"><br><br><br><br><br>
                        <strong>FIRMA PACIENTE: </strong>
                        <em><?= $h->nom_abreviacion . "-" . $h->pacDocumento . " " . $h->pacNombre . " " . $h->pacApellido ?></em>
                    </div>
                </div>
            </div><br>


            <br>
        <?php } ?>
	
        <div id="contador">
            <input type="button"  class="btn btn-primary" onclick="pregunta('<?php echo $contador ; ?>')" value="Enviar">
        </div>
    </form>
</div>


<script type="text/javascript">
    window.history.forward(1);
     //// Está parte del codigo agrega el paquete de laboratorios con el boton cargar
$(document).ready(function() {
    // ... Tu código existente ...

    $("#add_paquete").click(function() {
        var specificCUPSCodes = ['370', '367', '369', '419']; // Añade aquí tus códigos CUPS específicos

        var idHistoria = $("#idHistoria").val(); // Get idHistoria if needed

        if (idHistoria != "") {
            $.each(specificCUPSCodes, function(index, code) {
                $.ajax({
                    url: "<?php echo base_url() . 'index.php/CHistoria/agregar_cups'; ?>",
                    type: 'POST',
                    data: {
                        idCups: code,
                        idHistoria: idHistoria,
                        observacion: ''
                    },
                    success: function(result) {
                        console.log("Added CUPS code: " + code);
                        // Aquí podrías realizar acciones adicionales después de agregar cada código CUPS si es necesario

                        $("#data2").load(" #data2");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding CUPS code: " + code);
                    }
                });
            });

            // Mensaje de éxito después de agregar los códigos CUPS
            var successMessage = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Paquete  Registrado con Éxito<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_cups").html(successMessage);

        } 
    });

});

    function pregunta(contador) {

			if(document.formulario.peso.value == "") {

			alert("Tiene que escribir el peso del paciente")
			document.formulario.peso.focus()


        } else if (document.formulario.talla.value == "") {

            alert("Tiene que escribir la talla de la persona")
            document.formulario.talla.focus()
			
		} else if (document.formulario.perimetro_abdominal.value == "") {

            alert("Tiene que escribir el perimetro_abdominal de la persona")
            document.formulario.perimetro_abdominal.focus()	
			
	


        } else if (document.formulario.ef_pa_sistolica_sentado_pie.value == "") {

            alert("Tiene que escribir la presion arterial sistolica")
            document.formulario.ef_pa_sistolica_sentado_pie.focus()

        } else if (document.formulario.ef_pa_distolica_sentado_pie.value == "") {

            alert("Tiene que escribir la presion arterial distolica")
            document.formulario.ef_pa_distolica_sentado_pie.focus()

        } else if (document.formulario.ef_frecuencia_fisica.value == "") {

            alert("Tiene que escribir la frecuencia cardiaca")
            document.formulario.ef_frecuencia_fisica.focus()

        } else if (document.formulario.ef_frecuencia_respiratoria.value == "") {

            alert("Tiene que escribir la frecuencia respiratoria")
            document.formulario.ef_frecuencia_respiratoria.focus()

        } else if (document.formulario.clasificacion_hta.value == "") {

            alert("Tiene que escribir la clasificacion HTA")
            document.formulario.clasificacion_hta.focus()

        } else if (document.formulario.clasificacion_dm.value == "") {

            alert("Tiene que escribir la clasificacion DM")
            document.formulario.clasificacion_dm.focus()

        } else if (document.formulario.clasificacion_erc_estado.value == "") {

            alert("Tiene que escribir la clasificacion ERC estado")
            document.formulario.clasificacion_erc_estado.focus()

        } else if (document.formulario.clasificacion_erc_categoria_ambulatoria_persistente.value == "") {

            alert("Tiene que escribir la clasificacion ERC categoria de albuminuria persistente")
            document.formulario.clasificacion_erc_categoria_ambulatoria_persistente.focus()

        } else if (document.formulario.clasificacion_rcv.value == "") {

            alert("Tiene que escribir la clasificacion riesgo cardio vascular")
            document.formulario.clasificacion_rcv.focus()
			
			} else if (document.formulario.observaciones_generales.value == "") {

            alert("Tiene que escribir la Observaciones generales de la persona")
            document.formulario.observaciones_generales.focus()	

        } else if (contador < 1) {

            alert("Tiene que agregar como minimo un diagnostico")
            document.formulario.codigo.focus()
            return 0;

        } else {

            if (confirm('¿Estas seguro de enviar este formulario?')) {
                document.getElementById('guardandoOverlayHC').style.display='flex';
                document.formulario.submit();
            }
        }
    }

    $("#actualizar_medicamento").click(function() {

        cantidad = $("#editar_cantidad").val();
        dosis = $("#editar_dosis").val();
        id_his_med_actualizacion = $("#id_his_med_actualizacion").val();

        //alert(cantidad +" - "+ dosis)


        //console.log(cantidad);



        if (cantidad != "" && dosis != "" && id_his_med_actualizacion != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/actualizar_medicamento'; ?>",
                type: 'POST',
                data: {
                    cantidad: cantidad,
                    dosis: dosis,
                    id_his_med_actualizacion: id_his_med_actualizacion
                },

                success: function(result) {

                    //console.log(result);
                    $("#mens").html(result);
                    $("#modal_medicamento").hide();

                    $("#modal_medicamento").modal('hide'); //ocultamos el modal
                    /*$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();*/
                    $("#data").load(" #data");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_actualizacion_medicamento").html(html);

        }

    });

    $(document).on("click", ".btn-view-medicamento", function() {
        id_his_med = $(this).val();


        //alert(id_his_med)
        $.ajax({
            url: "<?php echo base_url() . 'index.php/CHistoria/consultar_medicamento'; ?>",
            method: 'post',
            data: {
                id_his_med: id_his_med
            },
            dataType: 'json',
            success: function(data) {


                $("#id_his_med_actualizacion").val(data[0].id_his_med);
                $("#editar_cantidad").val(data[0].hisMedCantidad);
                $("#editar_dosis").val(data[0].hisMedDosis);


                $("#modal_medicamento .modal-body").show();
            }
        });
    });


    $("#lesion_organo_blanco").change(function() {
        //alert($("#hipertension_arterial").val())
        if ($("#lesion_organo_blanco").val() == 'SI') {
            $('#descripcion_lesion_organo_blanco').show();
        } else {
            $('#descripcion_lesion_organo_blanco').hide();
            $("input[name*='descripcion_lesion_organo_blanco']").val("");

        }
    });



    function calcular_presion_arterial() {

        var sistolica = $("input#ef_pa_sistolica_sentado_pie").val();
        var distolica = $("input#ef_pa_distolica_sentado_pie").val();


        if (sistolica != "" && distolica != "") {

            if (sistolica < 130 && distolica < 85) {
                $("#hta").val("PA Normal");

            } else if (sistolica >= 130 && sistolica <= 139 && distolica >= 85 && distolica <= 89) {

                $("#hta").val("PA Normal - Alta");

            } else if (sistolica >= 140 && sistolica <= 159 && distolica >= 90 && distolica <= 99) {

                $("#hta").val("HTA Grado 1");

            } else if (sistolica >= 160 && distolica >= 100) {

                $("#hta").val("HTA Grado 2");

            } else {
                $("#ef_pa_sistolica_sentado_pie").val("");
                $("#ef_pa_distolica_sentado_pie").val("");

                alert("Valor no admitido")
            }


        }
    }
   

   

    

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
        idHistoria = $("#idHistoria").val();
        tipo_item = $("#tipo_item3").val();
        tipo_diagnostico3 = $("#tipo_diagnostico3").val();


        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico3 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico3'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    idHistoria: idHistoria,
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
        idHistoria = $("#idHistoria").val();
        tipo_item = $("#tipo_item2").val();
        tipo_diagnostico2 = $("#tipo_diagnostico2").val();


        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico2 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico2'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    idHistoria: idHistoria,
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
        idHistoria = $("#idHistoria").val();
        tipo_item = $("#tipo_item1").val();
        tipo_diagnostico1 = $("#tipo_diagnostico1").val();


        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico1 != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico1'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    idHistoria: idHistoria,
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
        idHistoria = $("#idHistoria").val();
        tipo_item = $("#tipo_item").val();
        tipo_diagnostico = $("#tipo_diagnostico").val();


        if (idDiagnostico != "" && diagnostico != "" && tipo_item != "" && tipo_diagnostico != "") {

            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/agregar_diagnostico'; ?>",
                type: 'POST',
                data: {
                    idDiagnostico: idDiagnostico,
                    diagnostico: diagnostico,
                    idHistoria: idHistoria,
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


    function calcular_imc() {

        var peso = $("input#peso").val();
        var talla = $("input#talla").val();


        if (talla % 1 == 0 && talla != "") {
            alert("Digite un valor decimal ej: 1.73");
            $("#talla").val("");
        } else {
            TotalImc = parseInt(peso) / (parseFloat(talla) * parseFloat(talla));
            Imc = (TotalImc).toFixed(1);

            $("#imc").val(Imc);

            if (Imc < 18.5 && talla != "") {
                $("#clasificacion").val("Bajo peso");

            } else if (Imc >= 18.5 && Imc <= 24.9 && talla != "") {
                $("#clasificacion").val("Adecuado");
            } else if (Imc >= 25.0 && Imc <= 29.9 && talla != "") {
                $("#clasificacion").val("Sobrepeso");
            } else if (Imc >= 30.0 && Imc <= 34.9 && talla != "") {
                $("#clasificacion").val("Obesidad grado 1");

            } else if (Imc >= 35.0 && Imc <= 39.9 && talla != "") {
                $("#clasificacion").val("Obesidad grado 2");
            } else if (Imc > 40 && talla != "") {
                $("#clasificacion").val("Obesidad grado 3");
            }
        }
    }
    
    $(document).ready(function() {
    // Delegación de eventos para seleccionar/deseleccionar todos los checkboxes de diagnósticos
    $('#diagnosticoTodos').on('click', function() {
        // Seleccionar o deseleccionar todos los checkboxes de la clase checkEliminar
        $('.checkEliminar').prop('checked', this.checked);
    });

    // Función para eliminar diagnósticos al confirmar la acción
    $('#botonEliminarDiagnosticos').on('click', function() {
        eliminarDiagnosticos();  // Llamar a la función para eliminar los diagnósticos seleccionados
    });

    // Función para eliminar diagnósticos
    function eliminarDiagnosticos() {
        var seleccionados = [];

        // Iterar sobre los checkboxes de diagnósticos seleccionados
        $('.checkEliminar:checked').each(function() {
            seleccionados.push($(this).val());  // Añadir el valor del checkbox (ID del diagnóstico) a la lista de seleccionados
        });

        // Verificar si hay diagnósticos seleccionados y confirmar la acción
        if (seleccionados.length > 0 && confirm('¿Desea eliminar los diagnósticos seleccionados?')) {
            $.ajax({
                url: "<?php echo base_url() . 'index.php/CHistoria/eliminar_diagnostico'; ?>",
                type: 'POST',
                data: {
                    id_his_dia: seleccionados  // Enviar la lista de IDs de diagnósticos a eliminar
                },
                success: function(result) {
                    $("#mens_diagnostico").html(result);  // Mostrar mensaje de éxito o error
                    // Recargar la tabla de diagnósticos para reflejar los cambios
                    $("#data3").load(" #data3");
                }
            });
        }
    }
});








    // En globo el funcionamiento de ayudas diagnosticas
    $(document).ready(function() {
    // Delegación de eventos para seleccionar/deseleccionar todos los checkboxes
    $(document).on('change', '#ayudaTodosl', function() {
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



    $(document).ready(function() {
    // Delegación de eventos para seleccionar/deseleccionar todos los checkboxes de medicamentos
    $(document).on('change', '#seleccionarTodosMedicamentos', function() {
        $('.checkEliminarMedicamento').prop('checked', this.checked);
    });

    // Función para eliminar medicamentos al confirmar la acción
    $('#botonEliminarMedicamentos').on('click', function() {
        eliminarSeleccionados();
    });

    // Función para eliminar medicamentos
    function eliminarSeleccionados() {
        var seleccionados = [];

        // Iterar sobre los checkboxes de medicamentos seleccionados
        $('.checkEliminarMedicamento:checked').each(function() {
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
});



    // Función para seleccionar o deseleccionar todos los checkboxes de remisiones
$('#remisionTodos').on('click', function() {
    $('.checkRemision').prop('checked', this.checked);
});

// Función para eliminar remisiones al confirmar la acción
function eliminarRemisiones() {
    var seleccionados = [];

    // Iterar sobre los checkboxes de remisiones seleccionadas
    $('.checkRemision:checked').each(function() {
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
                $("#data1").load(" #data1");
            }
        });
    }
}

// Asociar la función eliminarRemisiones() al evento click del botón de eliminar remisiones
$('#botonEliminarRemisiones').on('click', function() {
    eliminarRemisiones();
});


$(document).ready(function() {
    // Delegación de eventos para seleccionar/deseleccionar todos los checkboxes de ayudas diagnósticas
    $(document).on('change', '#seleccionarTodosAyudas', function() {
        $('.checkEliminarAyuda').prop('checked', this.checked);
    });

    // Función para eliminar ayudas diagnósticas al confirmar la acción
    $('#botonEliminarAyudas').on('click', function() {
        eliminarAyudas();
    });

    // Función para eliminar ayudas diagnósticas
    function eliminarAyudas() {
        var seleccionados = [];

        // Iterar sobre los checkboxes de ayudas diagnósticas seleccionadas
        $('.checkEliminarAyuda:checked').each(function() {
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
                    $("#mens_cups").html(result);
                    $("#data2").load(" #data2");
                }
            });
        }
    }
});



//

    $(document).ready(function() {

        $("#add_cups").click(function() {

            idCups = $("#idCups").val();
            idHistoria = $("#idHistoria").val();
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
                        $("#mens_cups").html(result);
                        $("#data2").load(" #data2");

                    }
                });

            } else {

                html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                $("#mens_cups").html(html);

            }

        });
    });
///////////////////////para agregar los pdfs
$("#add_pdf").click(function(e) {
    e.preventDefault();

    var idHistoria = $("#idHistoria").val();
    var observacion = $("#Observación").val();
    var archivo = $("#Archivo")[0].files[0]; // Obtener el archivo PDF

    if (idHistoria != "" && observacion != "" && archivo) {
        // Crear un FormData para enviar los datos y el archivo
        var formData = new FormData();
        formData.append("idHistoria", idHistoria);
        formData.append("observacion", observacion);
        formData.append("Archivo", archivo); // Nombre "Archivo" debe coincidir con el nombre en PHP

        $.ajax({
            url: "<?php echo base_url() . 'index.php/CHistoria/agregar_pdf'; ?>",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(result) {
                $('#Archivo').val("");
                $('#Observación').val("");
                $("#mens_pdf").html(result);
                $("#pdfData").load(" #pdfData"); // Recargar la lista de PDFs
            }
        });
    } else {
        // Mensaje de error si faltan datos
        html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        $("#mens_pdf").html(html);
    }
});


    $("#add_remision").click(function() {

        idRemision = $("#idRemision").val();
        idHistoria = $("#idHistoria").val();
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
                    $("#mens_remision").html(result);
                    $("#data1").load(" #data1");

                }
            });

        } else {

            html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No deje campos vacíos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_remision").html(html);

        }

    });

    $("#add").click(function() {

        idMedicamento = $("#idMedicamento").val();
        cantidad = $("#cantidad").val();
        idHistoria = $("#idHistoria").val();
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
                    $("#data").load(" #data");

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


    function elemento_selecionado_cups(object) {
        dato_cups = (object.id).split('&');

        idCups = dato_cups[0];
        cupNombre = dato_cups[1];

        $('#idCups').val(idCups);
        $('#cup').val(cupNombre);
        $('#lista_nombre_cups').hide();
    }

    function elemento_selecionado(object) {
        dato_medicamento = (object.id).split('&');

        idMedicamento = dato_medicamento[0];
        medNombre = dato_medicamento[1];


        $('#idMedicamento').val(idMedicamento);
        $('#medicamento').val(medNombre);
        $('#lista_nombre').hide();
    }

    function elemento_selecionado_remision(object) {
        dato_remision = (object.id).split('&');

        idRemision = dato_remision[0];
        remNombre = dato_remision[1];

        $('#idRemision').val(idRemision);
        $('#remision').val(remNombre);
        $('#lista_nombre_remision').hide();
    }

    const botonMicrofono = document.getElementById('microfono');
        const campoTexto = document.getElementById('observaciones_generales');

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

<style>#guardandoOverlayHC{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(44,62,80,.88);z-index:99999;justify-content:center;align-items:center;flex-direction:column}.guardando-box{background:#fff;border-radius:16px;padding:40px 55px;text-align:center;box-shadow:0 12px 40px rgba(0,0,0,.35)}.guardando-spinner{width:56px;height:56px;border:6px solid #f0f0f0;border-top:6px solid #3498db;border-radius:50%;animation:spin-hc .9s linear infinite;margin:0 auto 18px}.guardando-titulo{font-size:20px;font-weight:700;color:#2c3e50;margin-bottom:6px}.guardando-sub{font-size:14px;color:#7f8c8d}@keyframes spin-hc{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style><div id='guardandoOverlayHC'><div class='guardando-box'><div class='guardando-spinner'></div><div class='guardando-titulo'>Guardando Historia Clínica</div><div class='guardando-sub'>Por favor espere, no cierre esta ventana...</div></div></div>
