<style type="text/css">
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
<!-- This view is integrated into the history of Nefro and Internistas with their respective fields -->
<div class="bg-white">
<div class="mx-auto" style="width: 1300px;">
    <h5 style="color: blue;"><?php if ($proceso == 6) {
                                    echo "NEFROLOGIA GESTION DEL RIESGO CARDIO RENAL";
                                } else {
                                    echo "INTERNISTA GESTION DEL RIESGO CARDIO RENAL";
                                } ?></h5>

    <?php if (count($historia) == 0) { ?>

        <form name="formulario" method="post" action="<?php echo site_url('CHistoria/guardar'); ?>">

            <input hidden="" name='id' value='<?= $cita ?>' />
            <input type="text" name="idHistoria" id="idHistoria" required="" value="<?= $idHistoria ?>" hidden>
            <fieldset>
                <legend>DATOS PACIENTE</legend>
                <div class="form-row" style="text-align:center">
                    <div class="form-group col-md-2">
                        <strong>NOMBRE</strong><br>
                        <?php
                        echo $datos_cita[0]->nom_abreviacion . " " . $datos_cita[0]->pacDocumento . "<br>";
                        echo $datos_cita[0]->pacNombre . " " . $datos_cita[0]->pacNombre2 . " " . $datos_cita[0]->pacApellido . " " . $datos_cita[0]->pacApellido2; ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>FECHA NACIMIENTO Y EDAD</strong><br>
                        <?php echo $datos_cita[0]->pacFecNacimiento . "<br>";
                        list($anio, $mes, $dia) = explode("-", $datos_cita[0]->pacFecNacimiento);
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
                        <?php if ($datos_cita[0]->pacSexo == "M") {
                            echo "MASCULINO";
                        } else {
                            echo "FEMENINO";
                        } ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>ESTADO CIVIL</strong><br>
                        <?php echo $datos_cita[0]->pacEstCivil; ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>TELÉFONO</strong><br>
                        <?php echo $datos_cita[0]->pacTelefono; ?>
                    </div>
                    <div class="form-group col-md-2">
                        <strong>DIRECCIÓN</strong><br>
                        <?php
                        echo $datos_cita[0]->depNombre . " - " . $datos_cita[0]->munNombre . "<br>" . $datos_cita[0]->pacDireccion; ?>
                    </div>
                </div>
                <div class="form-row" style="text-align:center">
                    <div class="form-group col-md-3">
                        <strong>ASEGURADORA</strong><br>
                        <?php
                        echo $datos_cita[0]->empNombre; ?>
                    </div>

                    <div class="form-group col-md-3">
                        <strong>RÉGIMEN</strong><br>
                        <?php echo $datos_cita[0]->regNombre; ?>
                    </div>
                    <div class="form-group col-md-3">
                        <strong>OCUPACIÓN</strong><br>
                        <?php echo $datos_cita[0]->ocuNombre; ?>
                    </div>
                    <div class="form-group col-md-3">
                        <strong>BRIGADA</strong><br>
                        <?php echo $datos_cita[0]->zonNombre; ?>
                    </div>
                </div>

            </fieldset><br>
            <fieldset>
                <legend>ACUDIENTE</legend>
                <div class="form-row" style="margin: 10px;">
                    <div class="form-group col-md-4">
                        <strong>NOMBRE ACOMPAÑANTE</strong>
                        <input class="form-control input-sm" name="acompanante" id="acompanante" type="text" placeholder="Nombre" required="">
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

            <div style="border: ridge #0f0fef 1px;">
                <div class="form-row" style="margin: 10px;">
                    <div class="form-group col-md-12">
                        <strong>FINALIDAD</strong>
                        <input class="form-control input-sm" name="finalidad" id="finalidad" type="text" required="" value="NO APLICA">
                    </div>
                </div>
            </div><br>



            <fieldset>
                <legend>HISTORIA CLÍNICA</legend>

                <div style="margin: 10px;">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <strong>MOTIVO CONSULTA</strong>
                            <textarea class="form-control" name="motivo_complementaria" rows="2" required="" placeholder="Motivo consulta" id="motivo_complementaria"></textarea>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <strong>ENFERMEDAD ACTUAL</strong>
                            <textarea class="form-control" name="enfermedad_actual" id="enfermedad_actual" rows="2" required="" placeholder="Enfermedad actual"></textarea>
                        </div>
                    </div>
                </div>
            </fieldset><br>

            <fieldset>
                <legend>ANTECEDENTES PERSONALES</legend>
                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>SISTEMA NERVIOSO: DOLORES DE CABEZA, CONVULSIONES, MAREOS, PARÁLISIS, TRASTORNOS MENTALES</strong>
                            <select name="sistema_nervioso" id="sistema_nervioso" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_sistema_nervioso">
                            <strong>DESCRIPCIÓN SISTEMA NERVIOSO: DOLORES DE CABEZA, CONVULSIONES, MAREOS, PARÁLISIS, TRASTORNOS MENTALES</strong>
                            <input class="form-control input-sm" name="descripcion_sistema_nervioso" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>SISTEMA HEMOLINFATICO: ANEMIA, DESÓRDENES SANGUÍNEOS O PROBLEMAS DE COAGULACIÓN</strong>
                            <select name="sistema_hemolinfatico" required="" class="form-control input-sm" id="sistema_hemolinfatico">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_sistema_hemolinfatico">
                            <strong>DESCRIPCIÓN SISTEMA HEMOLINFATICO: ANEMIA, DESÓRDENES SANGUÍNEOS O PROBLEMAS DE COAGULACIÓN</strong>
                            <input class="form-control input-sm" name="descripcion_sistema_hemolinfatico" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>APARATO DIGESTIVO: ÚLCERAS, GASTRITIS, CIRROSIS, DIVERTÍCULOS, COLITIS, HEMORROIDES</strong>
                            <select name="aparato_digestivo" id="aparato_digestivo" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_aparato_digestivo">
                            <strong>DESCRIPCIÓN APARATO DIGESTIVO: ÚLCERAS, GASTRITIS, CIRROSIS, DIVERTÍCULOS, COLITIS, HEMORROIDES</strong>
                            <input class="form-control input-sm" name="descripcion_aparato_digestivo" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ÓRGANOS DE LOS SENTIDOS: CATARATAS, PTERIGIOS, VISIÓN CORTA, OTITIS, DESVIACIÓN DEL TABIQUE, SINUSITIS, AMIGDALITIS</strong>
                            <select name="organos_sentidos" required="" class="form-control input-sm" id="organos_sentidos">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_organos_sentidos">
                            <strong>DESCRIPCIÓN ÓRGANOS DE LOS SENTIDOS: CATARATAS, PTERIGIOS, VISIÓN CORTA, OTITIS, DESVIACIÓN DEL TABIQUE, SINUSITIS, AMIGDALITIS</strong>
                            <input class="form-control input-sm" name="descripcion_organos_sentidos" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ENDOCRINO-METABOLICOS: DIABETES, ENFERMEDADES DE LA TIROIDES, ALTERACIÓN DE LAS GRASAS, O ÁCIDOS ÚRICO SANGUÍNEOS</strong>
                            <select name="endocrino_metabolico" required="" class="form-control input-sm" id="endocrino_metabolico">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_endocrino_metabolico">
                            <strong>DESCRIPCIÓN ENDOCRINO-METABOLICOS: DIABETES, ENFERMEDADES DE LA TIROIDES, ALTERACIÓN DE LAS GRASAS, O ÁCIDOS ÚRICO SANGUÍNEOS</strong>
                            <input class="form-control input-sm" name="descripcion_endocrino_metabolico" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>INMUNOLÓGICOS: LUPUS, ARTRITIS REUMATOIDES</strong><br>
                            <select name="inmunologico" required="" class="form-control input-sm" id="inmunologico">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_inmunologico">
                            <strong>DESCRIPCIÓN INMUNOLÓGICOS: LUPUS, ARTRITIS REUMATOIDES</strong>
                            <input class="form-control input-sm" name="descripcion_inmunologico" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CÁNCER, TUMORES, RADIOTERAPIA O QUIMIOTERAPIA</strong>
                            <select name="cancer_tumores_radio_quimioterapia" id="cancer_tumores_radio_quimioterapia" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_cancer_tumores_radio_quimioterapia">
                            <strong>DESCRIPCIÓN CÁNCER, TUMORES, RADIOTERAPIA O QUIMIOTERAPIA</strong>
                            <input class="form-control input-sm" name="descripcion_cancer_tumores_radio_quimioterapia" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GLÁNDULAS MAMARIAS: DOLORES, MASAS, SECRECIONES</strong>
                            <select name="glandulas_mamarias" id="glandulas_mamarias" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_glandulas_mamarias">
                            <strong>DESCRIPCIÓN GLÁNDULAS MAMARIAS: DOLORES, MASAS, SECRECIONES</strong>
                            <input class="form-control input-sm" name="descripcion_glandulas_mamarias" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>HIPERTENSIÓN, DIABETES, ERC</strong>
                            <select name="hipertension_diabetes_erc" id="hipertension_diabetes_erc" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_hipertension_diabetes_erc">
                            <strong>DESCRIPCIÓN HIPERTENSIÓN, DIABETES, ERC</strong>
                            <input class="form-control input-sm" name="descripcion_hipertension_diabetes_erc" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>REACCIONES ALÉRGICAS</strong>
                            <select name="reacion_alergica" required="" class="form-control input-sm" id="reacion_alergica">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_reacion_alergica">
                            <strong>DESCRIPCIÓN REACCIONES ALÉRGICAS</strong>
                            <input class="form-control input-sm" name="descripcion_reacion_alergica" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CARDIO VASCULARES: HIPERTENSIÓN, INFARTOS, ANGINAS, SOPLOS, ARRITMIAS, ENFERMEDADES CORONARIAS</strong>
                            <select name="cardio_vasculares" required="" class="form-control input-sm" id="cardio_vasculares">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_cardio_vasculares">
                            <strong>DESCRIPCIÓN CARDIO VASCULARES: HIPERTENSIÓN, INFARTOS, ANGINAS, SOPLOS, ARRITMIAS, ENFERMEDADES CORONARIAS</strong>
                            <input class="form-control input-sm" name="descripcion_cardio_vasculares" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>RESPIRATORIOS: ASMA, ENFISEMA, INFECCIÓN LARÍNGEA O EN BRONQUIOS</strong><br><br>
                            <select name="respiratorios" required="" class="form-control input-sm" id="respiratorios">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_respiratorios">
                            <strong>DESCRIPCIÓN RESPIRATORIOS: ASMA, ENFISEMA, INFECCIÓN LARÍNGEA O EN BRONQUIOS</strong>
                            <input class="form-control input-sm" name="descripcion_respiratorios" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>URINARIAS: INSUFICIENCIA RENAL, CÁLCULOS, ORINA CON SANGRE, INFECCIONES FRECUENTES, PRÓSTATAS ENFERMAS</strong>
                            <select name="crinarias" required="" class="form-control input-sm" id="crinarias">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_crinarias">
                            <strong>DESCRIPCIÓN URINARIAS: INSUFICIENCIA RENAL, CÁLCULOS, ORINA CON SANGRE, INFECCIONES FRECUENTES, PRÓSTATAS ENFERMAS</strong>
                            <input class="form-control input-sm" name="descripcion_crinarias" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>OSTEOARTICULARES: ENFERMEDADES DE LA COLUMNA, DOLOR DE RODILLA, DEFORMIDADES</strong>
                            <select name="osteoarticulares" id="osteoarticulares" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_osteoarticulares">
                            <strong>DESCRIPCIÓN OSTEOARTICULARES: ENFERMEDADES DE LA COLUMNA, DOLOR DE RODILLA, DEFORMIDADES</strong>
                            <input class="form-control input-sm" name="descripcion_osteoarticulares" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>INFECCIOSOS: HEPATITIS, TUBERCULOSIS, SIDA O VIH(+), ENFERMEDADES DE TRANSMISIÓN SEXUAL</strong>
                            <select name="infecciosos" id="infecciosos" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_infecciosos">
                            <strong>DESCRIPCIÓN INFECCIOSOS: HEPATITIS, TUBERCULOSIS, SIDA O VIH(+), ENFERMEDADES DE TRANSMISIÓN SEXUAL</strong>
                            <input class="form-control input-sm" name="descripcion_infecciosos" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CIRUGÍAS TRAUMAS(ACCIDENTES)</strong><br>
                            <select name="cirugias_traumas" required="" class="form-control input-sm" id="cirugias_traumas">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_cirugias_traumas">
                            <strong>DESCRIPCIÓN CIRUGÍAS TRAUMAS(ACCIDENTES)</strong>
                            <input class="form-control input-sm" name="descripcion_cirugias_traumas" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>TRATAMIENTOS CON MEDICACIÓN</strong>
                            <select name="tratamiento_medicacion" required="" class="form-control input-sm" id="tratamiento_medicacion">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6" style="display: none;" id="descripcion_tratamiento_medicacion">
                            <strong>DESCRIPCIÓN TRATAMIENTOS CON MEDICACIÓN</strong>
                            <input class="form-control input-sm" name="descripcion_tratamiento_medicacion" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ANTECEDENTES QUIRÚRGICOS</strong>
                            <select name="antecedentes_quirurgicos" id="antecedentes_quirurgicos" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_quirurgicos">
                            <strong>DESCRIPCIÓN ANTECEDENTES QUIRÚRGICOS</strong>
                            <input class="form-control input-sm" name="descripcion_antecedentes_quirurgicos" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ANTECEDENTES FAMILIARES</strong>
                            <select name="antecedentes_familiares" id="antecedentes_familiares" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_familiares">
                            <strong>DESCRIPCIÓN ANTECEDENTES FAMILIARES</strong>
                            <input class="form-control input-sm" name="descripcion_antecedentes_familiares" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CONSUMO DE TABACO</strong>
                            <select name="consumo_tabaco" id="consumo_tabaco" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_consumo_tabaco">
                            <strong>DESCRIPCIÓN CONSUMO DE TABACO</strong>
                            <input class="form-control input-sm" name="descripcion_consumo_tabaco" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ANTECEDENTES DE ALCOHOL</strong>
                            <select name="antecedentes_alcohol" id="antecedentes_alcohol" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_alcohol">
                            <strong>DESCRIPCIÓN ANTECEDENTES DE ALCOHOL</strong>
                            <input class="form-control input-sm" name="descripcion_antecedentes_alcohol" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>SEDENTARISMO</strong>
                            <select name="sedentarismo" id="sedentarismo" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_sedentarismo">
                            <strong>DESCRIPCIÓN SEDENTARISMO</strong>
                            <input class="form-control input-sm" name="descripcion_sedentarismo" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>GINECOLÓGICOS, TUMORES O MASA EN OVARIOS, ÚTERO, MENSTRUACIÓN ANORMAL</strong>
                            <select name="ginecologicos" id="ginecologicos" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_ginecologicos">
                            <strong>DESCRIPCIÓN GINECOLÓGICOS, TUMORES O MASA EN OVARIOS, ÚTERO, MENSTRUACIÓN ANORMAL</strong>
                            <input class="form-control input-sm" name="descripcion_ginecologicos" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CITOLOGÍA VAGINAL PATOLÓGICAS O ANORMALES</strong>
                            <select name="citologia_vaginal" id="citologia_vaginal" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="display: none;" id="descripcion_citologia_vaginal">
                            <strong>DESCRIPCIÓN CITOLOGÍA VAGINAL PATOLÓGICAS O ANORMALES</strong>
                            <input class="form-control input-sm" name="descripcion_citologia_vaginal" type="text" required="" placeholder="Descripcion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>MENARQUIA</strong>
                            <input type="number" name="menarquia" class="form-control" value="0" id="menarquia">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>GESTACIONES</strong>
                            <input type="number" name="gestaciones" class="form-control" value="0" id="gestaciones">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <strong>PARTOS</strong>
                            <input type="number" name="parto" class="form-control" value="0" id="parto">
                        </div>
                        <div class="form-group col-md-4">
                            <strong>ABORTOS</strong>
                            <input type="number" name="aborto" class="form-control" value="0" id="aborto">
                        </div>
                        <div class="form-group col-md-4">
                            <strong>CESARÍAS</strong>
                            <input type="number" name="cesaria" class="form-control" value="0" id="cesaria">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>MÉTODOS ANTICONCEPTIVOS</strong>
                            <select name="metodo_anticonceptivo" id="metodo_anticonceptivo" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>MÉTODO ANTICONCEPTIVO ¿CUÁL?</strong>
                            <input type="text" name="metodo_anticonceptivo_cual" class="form-control" value="NINGUNO" placeholder="¿Cual?" id="metodo_anticonceptivo_cual">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES ANTECEDENTES PERSONALES</strong>
                            <input type="text" name="obs_antecedentes_personales" class="form-control" value="NINGUNO" id="obs_antecedentes_personales">
                        </div>
                    </div>


                </div>
            </fieldset><br>
            <fieldset>
                <legend>REVISIÓN POR SISTEMA</legend>

                <div style="margin: 10px;">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CABEZA</strong>
                            <select name="ef_cabeza" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES CABEZA</strong>
                            <input type="text" name="ef_obs_cabeza" class="form-control" required="" value="NINGUNO" id="ef_obs_cabeza">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CUELLO</strong>
                            <select name="ef_cuello" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES CUELLO</strong>
                            <input type="text" name="ef_obs_cuello" class="form-control" required="" value="NINGUNO" id="ef_obs_cuello">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>TÓRAX</strong>
                            <select name="ef_torax" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES TÓRAX</strong>
                            <input type="text" name="ef_obs_torax" class="form-control" required="" value="NINGUNO" id="ef_obs_torax">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>ABDOMEN</strong>
                            <select name="ef_abdomen" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES ABDOMEN</strong>
                            <input type="text" name="ef_obs_abdomen" class="form-control" required="" value="NINGUNO" id="ef_obs_abdomen">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>EXTREMIDADES</strong>
                            <select name="ef_extremidades" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES EXTREMIDADES</strong>
                            <input type="text" name="ef_obs_extremidades" class="form-control" required="" value="NINGUNO" id="ef_obs_extremidades">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>NEUROLÓGICO Y ESTADO MENTAL</strong>
                            <select name="neurologia_estado_mental" required="" class="form-control input-sm">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <strong>OBSERVACIONES NEUROLÓGICO Y ESTADO MENTAL</strong>
                            <input type="text" name="obs_neurologia_estado_mental" class="form-control" required="" value="NINGUNO" id="obs_neurologia_estado_mental">
                        </div>
                    </div>
                </div>
            </fieldset><br>
            <fieldset>
                <legend>EXAMEN FÍSICO</legend>

                <div style="margin: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>PESO KG</strong>
                            <input type="number" name="peso" id="peso" class="form-control" required="" placeholder="Peso KG" onchange="calcular_imc();">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>TALLA CM</strong>
                            <input class="form-control" name="talla" id="talla" required="" type="number" value="<?php echo $historia[0]->hcTalla; ?>" onchange="calcular_imc();">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>IMC</strong>
                            <input type="number" name="imc" id="imc" class="form-control" required="" placeholder="IMC" readonly="">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>PERIMETRO ABDOMINAL</strong>
                            <input type="text" name="perimetro_abdominal" class="form-control" required="" placeholder="Perimetro abdominal" id="perimetro_abdominal">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>PRESIÓN ARTERIAL SISTÓLICA</strong>
                            <input type="number" name="ef_pa_sistolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial sistolica" id="ef_pa_sistolica_sentado_pie">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>PRESIÓN ARTERIAL DIASTÓLICA</strong>
                            <input type="number" name="ef_pa_distolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial distolica" id="ef_pa_distolica_sentado_pie">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>FRECUENCIA CARDIACA</strong>
                            <input type="text" name="ef_frecuencia_fisica" class="form-control" required="" placeholder="Frecuencia cardiaca" id="ef_frecuencia_fisica">
                        </div>
                        <div class="form-group col-md-6">
                            <strong>FRECUENCIA RESPIRATORIA</strong>
                            <input type="text" name="ef_frecuencia_respiratoria" class="form-control" required="" placeholder="Frecuencia respiratoria" id="ef_frecuencia_respiratoria">
                        </div>
                    </div>
                </div>
            </fieldset><br>

            <div style="border: ridge #0f0fef 1px;">
                <div class="form-row" style="margin: 10px;">
                    <div class="form-group col-md-12">
                        <strong>ANÁLISIS PLAN</strong>
                        <textarea class="form-control" name="observaciones_generales" placeholder="Analisis plan" required="" rows="2" id="observaciones_generales"></textarea>
                    </div>
                </div>
            </div><br>
            <fieldset>
                <legend>CLASIFICACION</legend>

                <div style="margin: 10px;">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN ESTADO METABÓLICO</strong>
                            <select name="ClasificacionEstadoMetabolico" id="ClasificacionEstadoMetabolico" required="" class="form-control input-sm" >
				                <option value="">[SELECCIONE]</option>
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
                        </div>
                    <div class="form-group col-md-6">
                            <strong>HIPERTENSIÓN ARTERIAL</strong>
                            <select name="hipertension_arterial_personal" id="hipertension_arterial_personal" required="" class="form-control input-sm" >
				                <option value="">[SELECCIONE]</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>DIABETES MELLITUS</strong>
                            <select name="diabetes_mellitus_personal" id="diabetes_mellitus_personal" required="" class="form-control input-sm" >
                                <option value="">[SELECCIONE]</option>
                                <option value="SI">SI</option>
                                <option value="NO" >NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN HTA</strong>
                            <select class="form-control" required="" name="clasificacion_hta">
                                <option value="PA Normal">PA Normal</option>
                                <option value="PA Normal - Alta">PA Normal - Alta</option>
                                <option value="HTA Grado 1">HTA Grado 1</option>
                                <option value="HTA Grado 2">HTA Grado 2</option>
                                <option value="No HTA" selected>No HTA</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN DM</strong>
                            <select class="form-control" required="" name="clasificacion_dm">
                                <option value="TIPO 1">TIPO 1</option>
                                <option value="TIPO 2">TIPO 2</option>
                                <option value="NO DIABETICO">NO DIABETICO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN ERC ESTADO</strong>
                            <select class="form-control" required="" name="clasificacion_erc_estado">
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
									<option value="SIN CLASIFICAR">SIN CALSIFICACIÓN</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>CLASIFICACIÓN RCV</strong>
                            <select class="form-control" required="" name="clasificacion_rcv">
                                <option value="BAJO">BAJO</option>
                                <option value="MODERADO">MODERADO</option>
                                <option value="ALTO">ALTO</option>
                                <option value="MUY ALTO">MUY ALTO</option>
                                <option value="SIN CLASIFICAR">SIN CLASIFICAR</option>
                            </select>
                        </div>
                    </div>
            </fieldset>

            <br>

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
</fieldset><br>
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

                        echo '<img alt="Image placeholder" width="302px" height="70px" src="data:image/jpeg;base64,' . base64_encode($datos_cita[0]->usuFirma) . '"/>'; ?><br>
                        <strong>FIRMA DIGITAL</strong><br>
                        <strong>PROFESIONAL: </strong>
                        <em><?= $datos_cita[0]->usuNombre . " " . $datos_cita[0]->usuApellido; ?><br>RM: <?= $datos_cita[0]->usuRegistroProfesional; ?></em>
                    </div>
                    <div class="form-group col-md-6"><br><br><br><br><br>
                        <strong>FIRMA PACIENTE: </strong>
                        <em><?= $datos_cita[0]->nom_abreviacion . "-" . $datos_cita[0]->pacDocumento . " " . $datos_cita[0]->pacNombre . " " . $datos_cita[0]->pacApellido ?></em>
                    </div>
                </div>
            </div><br>


            <div id="contador">
                <input type="button" class="btn btn-primary" onclick="pregunta('<?php echo $contador; ?>')" value="Enviar">
            </div>
        </form>


    <?php

    } else { ?>
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
                            echo $datos_cita[0]->nom_abreviacion . " " . $datos_cita[0]->pacDocumento . "<br>";
                            echo $datos_cita[0]->pacNombre . " " . $datos_cita[0]->pacNombre2 . " " . $datos_cita[0]->pacApellido . " " . $datos_cita[0]->pacApellido2;
                            ?>
                        </div>
                        <div class="form-group col-md-2">
                            <strong>FECHA NACIMIENTO Y EDAD</strong><br>
                            <?php echo $datos_cita[0]->pacFecNacimiento . "<br>";
                            list($anio, $mes, $dia) = explode("-", $datos_cita[0]->pacFecNacimiento);
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
                            <?php if ($datos_cita[0]->pacSexo == "M") {
                                echo "MASCULINO";
                            } else {
                                echo "FEMENINO";
                            } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <strong>ESTADO CIVIL</strong><br>
                            <?php echo $datos_cita[0]->pacEstCivil; ?>
                        </div>
                        <div class="form-group col-md-2">
                            <strong>TELÉFONO</strong><br>
                            <?php echo $datos_cita[0]->pacTelefono; ?>
                        </div>
                        <div class="form-group col-md-2">
                            <strong>DIRECCIÓN</strong><br>
                            <?php
                            echo $datos_cita[0]->depNombre . " - " . $datos_cita[0]->munNombre . "<br>" . $datos_cita[0]->pacDireccion; ?>
                        </div>
                    </div>
                    <div class="form-row" style="text-align:center">
                        <div class="form-group col-md-3">
                            <strong>ASEGURADORA</strong><br>
                            <?php
                            echo $datos_cita[0]->empNombre; ?>
                        </div>

                        <div class="form-group col-md-3">
                            <strong>RÉGIMEN</strong><br>
                            <?php echo $datos_cita[0]->regNombre; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <strong>OCUPACIÓN</strong><br>
                            <?php echo $datos_cita[0]->ocuNombre; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <strong>BRIGADA</strong><br>
                            <?php echo $datos_cita[0]->zonNombre; ?>
                        </div>
                    </div>

                </fieldset><br>
                <fieldset>
                    <legend>ACUDIENTE</legend>
                    <div class="form-row" style="margin: 10px;">
                        <div class="form-group col-md-4">
                            <strong>NOMBRE ACOMPAÑANTE</strong>
                            <input class="form-control input-sm" name="acompanante" id="acompanante" type="text" placeholder="Nombre" required="">
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

                <div style="border: ridge #0f0fef 1px;">
                    <div class="form-row" style="margin: 10px;">
                        <div class="form-group col-md-12">
                            <strong>FINALIDAD</strong>
                            <input class="form-control input-sm" name="finalidad" type="text" required="" value="NO APLICA" id="finalidad">
                        </div>
                    </div>
                </div><br>



                <fieldset>
                    <legend>HISTORIA CLÍNICA</legend>

                    <div style="margin: 10px;">
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <strong>MOTIVO CONSULTA</strong>
                                <textarea class="form-control" name="motivo_complementaria" rows="2" required="" placeholder="Motivo consulta" id="motivo_complementaria"></textarea>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <strong>ENFERMEDAD ACTUAL</strong>
                                <textarea class="form-control" name="enfermedad_actual" rows="2" required="" placeholder="Enfermedad actual" id="enfermedad_actual"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset><br>

                <fieldset>
                    <legend>ANTECEDENTES PERSONALES</legend>
                    <div style="margin: 10px;">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>SISTEMA NERVIOSO: DOLORES DE CABEZA, CONVULSIONES, MAREOS, PARÁLISIS, TRASTORNOS MENTALES</strong>
                                <select name="sistema_nervioso" id="sistema_nervioso" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_sistema_nervioso">
                                <strong>DESCRIPCIÓN SISTEMA NERVIOSO: DOLORES DE CABEZA, CONVULSIONES, MAREOS, PARÁLISIS, TRASTORNOS MENTALES</strong>
                                <input class="form-control input-sm" name="descripcion_sistema_nervioso" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>SISTEMA HEMOLINFATICO: ANEMIA, DESÓRDENES SANGUÍNEOS O PROBLEMAS DE COAGULACIÓN</strong>
                                <select name="sistema_hemolinfatico" required="" class="form-control input-sm" id="sistema_hemolinfatico">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_sistema_hemolinfatico">
                                <strong>DESCRIPCIÓN SISTEMA HEMOLINFATICO: ANEMIA, DESÓRDENES SANGUÍNEOS O PROBLEMAS DE COAGULACIÓN</strong>
                                <input class="form-control input-sm" name="descripcion_sistema_hemolinfatico" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>APARATO DIGESTIVO: ÚLCERAS, GASTRITIS, CIRROSIS, DIVERTÍCULOS, COLITIS, HEMORROIDES</strong>
                                <select name="aparato_digestivo" id="aparato_digestivo" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_aparato_digestivo">
                                <strong>DESCRIPCIÓN APARATO DIGESTIVO: ÚLCERAS, GASTRITIS, CIRROSIS, DIVERTÍCULOS, COLITIS, HEMORROIDES</strong>
                                <input class="form-control input-sm" name="descripcion_aparato_digestivo" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ÓRGANOS DE LOS SENTIDOS: CATARATAS, PTERIGIOS, VISIÓN CORTA, OTITIS, DESVIACIÓN DEL TABIQUE, SINUSITIS, AMIGDALITIS</strong>
                                <select name="organos_sentidos" required="" class="form-control input-sm" id="organos_sentidos">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_organos_sentidos">
                                <strong>DESCRIPCIÓN ÓRGANOS DE LOS SENTIDOS: CATARATAS, PTERIGIOS, VISIÓN CORTA, OTITIS, DESVIACIÓN DEL TABIQUE, SINUSITIS, AMIGDALITIS</strong>
                                <input class="form-control input-sm" name="descripcion_organos_sentidos" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ENDOCRINO-METABOLICOS: DIABETES, ENFERMEDADES DE LA TIROIDES, ALTERACIÓN DE LAS GRASAS, O ÁCIDOS ÚRICO SANGUÍNEOS</strong>
                                <select name="endocrino_metabolico" required="" class="form-control input-sm" id="endocrino_metabolico">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_endocrino_metabolico">
                                <strong>DESCRIPCIÓN ENDOCRINO-METABOLICOS: DIABETES, ENFERMEDADES DE LA TIROIDES, ALTERACIÓN DE LAS GRASAS, O ÁCIDOS ÚRICO SANGUÍNEOS</strong>
                                <input class="form-control input-sm" name="descripcion_endocrino_metabolico" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>INMUNOLÓGICOS: LUPUS, ARTRITIS REUMATOIDES</strong><br>
                                <select name="inmunologico" required="" class="form-control input-sm" id="inmunologico">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_inmunologico">
                                <strong>DESCRIPCIÓN INMUNOLÓGICOS: LUPUS, ARTRITIS REUMATOIDES</strong>
                                <input class="form-control input-sm" name="descripcion_inmunologico" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CÁNCER, TUMORES, RADIOTERAPIA O QUIMIOTERAPIA</strong>
                                <select name="cancer_tumores_radio_quimioterapia" id="cancer_tumores_radio_quimioterapia" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_cancer_tumores_radio_quimioterapia">
                                <strong>DESCRIPCIÓN CÁNCER, TUMORES, RADIOTERAPIA O QUIMIOTERAPIA</strong>
                                <input class="form-control input-sm" name="descripcion_cancer_tumores_radio_quimioterapia" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>GLÁNDULAS MAMARIAS: DOLORES, MASAS, SECRECIONES</strong>
                                <select name="glandulas_mamarias" id="glandulas_mamarias" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_glandulas_mamarias">
                                <strong>DESCRIPCIÓN GLÁNDULAS MAMARIAS: DOLORES, MASAS, SECRECIONES</strong>
                                <input class="form-control input-sm" name="descripcion_glandulas_mamarias" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>HIPERTENSIÓN, DIABETES, ERC</strong>
                                <select name="hipertension_diabetes_erc" id="hipertension_diabetes_erc" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_hipertension_diabetes_erc">
                                <strong>DESCRIPCIÓN HIPERTENSIÓN, DIABETES, ERC</strong>
                                <input class="form-control input-sm" name="descripcion_hipertension_diabetes_erc" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>REACCIONES ALÉRGICAS</strong>
                                <select name="reacion_alergica" required="" class="form-control input-sm" id="reacion_alergica">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_reacion_alergica">
                                <strong>DESCRIPCIÓN REACCIONES ALÉRGICAS</strong>
                                <input class="form-control input-sm" name="descripcion_reacion_alergica" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CARDIO VASCULARES: HIPERTENSIÓN, INFARTOS, ANGINAS, SOPLOS, ARRITMIAS, ENFERMEDADES CORONARIAS</strong>
                                <select name="cardio_vasculares" required="" class="form-control input-sm" id="cardio_vasculares">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_cardio_vasculares">
                                <strong>DESCRIPCIÓN CARDIO VASCULARES: HIPERTENSIÓN, INFARTOS, ANGINAS, SOPLOS, ARRITMIAS, ENFERMEDADES CORONARIAS</strong>
                                <input class="form-control input-sm" name="descripcion_cardio_vasculares" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>RESPIRATORIOS: ASMA, ENFISEMA, INFECCIÓN LARÍNGEA O EN BRONQUIOS</strong><br><br>
                                <select name="respiratorios" required="" class="form-control input-sm" id="respiratorios">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_respiratorios">
                                <strong>DESCRIPCIÓN RESPIRATORIOS: ASMA, ENFISEMA, INFECCIÓN LARÍNGEA O EN BRONQUIOS</strong>
                                <input class="form-control input-sm" name="descripcion_respiratorios" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>URINARIAS: INSUFICIENCIA RENAL, CÁLCULOS, ORINA CON SANGRE, INFECCIONES FRECUENTES, PRÓSTATAS ENFERMAS</strong>
                                <select name="crinarias" required="" class="form-control input-sm" id="crinarias">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_crinarias">
                                <strong>DESCRIPCIÓN URINARIAS: INSUFICIENCIA RENAL, CÁLCULOS, ORINA CON SANGRE, INFECCIONES FRECUENTES, PRÓSTATAS ENFERMAS</strong>
                                <input class="form-control input-sm" name="descripcion_crinarias" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>OSTEOARTICULARES: ENFERMEDADES DE LA COLUMNA, DOLOR DE RODILLA, DEFORMIDADES</strong>
                                <select name="osteoarticulares" id="osteoarticulares" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_osteoarticulares">
                                <strong>DESCRIPCIÓN OSTEOARTICULARES: ENFERMEDADES DE LA COLUMNA, DOLOR DE RODILLA, DEFORMIDADES</strong>
                                <input class="form-control input-sm" name="descripcion_osteoarticulares" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>INFECCIOSOS: HEPATITIS, TUBERCULOSIS, SIDA O VIH(+), ENFERMEDADES DE TRANSMISIÓN SEXUAL</strong>
                                <select name="infecciosos" id="infecciosos" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_infecciosos">
                                <strong>DESCRIPCIÓN INFECCIOSOS: HEPATITIS, TUBERCULOSIS, SIDA O VIH(+), ENFERMEDADES DE TRANSMISIÓN SEXUAL</strong>
                                <input class="form-control input-sm" name="descripcion_infecciosos" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CIRUGÍAS TRAUMAS(ACCIDENTES)</strong><br>
                                <select name="cirugias_traumas" required="" class="form-control input-sm" id="cirugias_traumas">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_cirugias_traumas">
                                <strong>DESCRIPCIÓN CIRUGÍAS TRAUMAS(ACCIDENTES)</strong>
                                <input class="form-control input-sm" name="descripcion_cirugias_traumas" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>TRATAMIENTOS CON MEDICACIÓN</strong>
                                <select name="tratamiento_medicacion" required="" class="form-control input-sm" id="tratamiento_medicacion">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6" style="display: none;" id="descripcion_tratamiento_medicacion">
                                <strong>DESCRIPCIÓN TRATAMIENTOS CON MEDICACIÓN</strong>
                                <input class="form-control input-sm" name="descripcion_tratamiento_medicacion" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ANTECEDENTES QUIRÚRGICOS</strong>
                                <select name="antecedentes_quirurgicos" id="antecedentes_quirurgicos" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_quirurgicos">
                                <strong>DESCRIPCIÓN ANTECEDENTES QUIRÚRGICOS</strong>
                                <input class="form-control input-sm" name="descripcion_antecedentes_quirurgicos" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ANTECEDENTES FAMILIARES</strong>
                                <select name="antecedentes_familiares" id="antecedentes_familiares" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_familiares">
                                <strong>DESCRIPCIÓN ANTECEDENTES FAMILIARES</strong>
                                <input class="form-control input-sm" name="descripcion_antecedentes_familiares" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CONSUMO DE TABACO</strong>
                                <select name="consumo_tabaco" id="consumo_tabaco" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_consumo_tabaco">
                                <strong>DESCRIPCIÓN CONSUMO DE TABACO</strong>
                                <input class="form-control input-sm" name="descripcion_consumo_tabaco" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ANTECEDENTES DE ALCOHOL</strong>
                                <select name="antecedentes_alcohol" id="antecedentes_alcohol" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6" style="display: none;" id="descripcion_antecedentes_alcohol">
                                <strong>DESCRIPCIÓN ANTECEDENTES DE ALCOHOL</strong>
                                <input class="form-control input-sm" name="descripcion_antecedentes_alcohol" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>SEDENTARISMO</strong>
                                <select name="sedentarismo" id="sedentarismo" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_sedentarismo">
                                <strong>DESCRIPCIÓN SEDENTARISMO</strong>
                                <input class="form-control input-sm" name="descripcion_sedentarismo" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>GINECOLÓGICOS, TUMORES O MASA EN OVARIOS, ÚTERO, MENSTRUACIÓN ANORMAL</strong>
                                <select name="ginecologicos" id="ginecologicos" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_ginecologicos">
                                <strong>DESCRIPCIÓN GINECOLÓGICOS, TUMORES O MASA EN OVARIOS, ÚTERO, MENSTRUACIÓN ANORMAL</strong>
                                <input class="form-control input-sm" name="descripcion_ginecologicos" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CITOLOGÍA VAGINAL PATOLÓGICAS O ANORMALES</strong>
                                <select name="citologia_vaginal" id="citologia_vaginal" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="descripcion_citologia_vaginal">
                                <strong>DESCRIPCIÓN CITOLOGÍA VAGINAL PATOLÓGICAS O ANORMALES</strong>
                                <input class="form-control input-sm" name="descripcion_citologia_vaginal" type="text" required="" placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>MENARQUIA</strong>
                                <input type="number" name="menarquia" id="menarquia" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>GESTACIONES</strong>
                                <input type="number" name="gestaciones" id="gestaciones" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <strong>PARTOS</strong>
                                <input type="number" name="parto" id="parto" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <strong>ABORTOS</strong>
                                <input type="number" name="aborto" id="aborto" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <strong>CESARÍAS</strong>
                                <input type="number" name="cesaria" id="cesaria" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>MÉTODOS ANTICONCEPTIVOS</strong>
                                <select name="metodo_anticonceptivo" id="metodo_anticonceptivo" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <strong>MÉTODO ANTICONCEPTIVO ¿CUÁL?</strong>
                                <input type="text" name="metodo_anticonceptivo_cual" id="metodo_anticonceptivo_cual" class="form-control" value="NINGUNO" placeholder="¿Cual?">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES ANTECEDENTES PERSONALES</strong>
                                <input type="text" name="obs_antecedentes_personales" class="form-control" value="NINGUNO" id="obs_antecedentes_personales">
                            </div>
                        </div>


                    </div>
                </fieldset><br>
                <fieldset>
                    <legend>REVISIÓN POR SISTEMA</legend>

                    <div style="margin: 10px;">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CABEZA</strong>
                                <select name="ef_cabeza" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES CABEZA</strong>
                                <input type="text" name="ef_obs_cabeza" class="form-control" required="" value="NINGUNO" id="ef_obs_cabeza">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>CUELLO</strong>
                                <select name="ef_cuello" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES CUELLO</strong>
                                <input type="text" name="ef_obs_cuello" class="form-control" required="" value="NINGUNO" id="ef_obs_cuello">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>TÓRAX</strong>
                                <select name="ef_torax" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES TÓRAX</strong>
                                <input type="text" name="ef_obs_torax" class="form-control" required="" value="NINGUNO" id="ef_obs_torax">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>ABDOMEN</strong>
                                <select name="ef_abdomen" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES ABDOMEN</strong>
                                <input type="text" name="ef_obs_abdomen" class="form-control" required="" value="NINGUNO" id="ef_obs_abdomen">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>EXTREMIDADES</strong>
                                <select name="ef_extremidades" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES EXTREMIDADES</strong>
                                <input type="text" name="ef_obs_extremidades" class="form-control" required="" value="NINGUNO" id="ef_obs_extremidades">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>NEUROLÓGICO Y ESTADO MENTAL</strong>
                                <select name="neurologia_estado_mental" required="" class="form-control input-sm">
                                    <option value="SI">SI</option>
                                    <option value="NO" selected>NO</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <strong>OBSERVACIONES NEUROLÓGICO Y ESTADO MENTAL</strong>
                                <input type="text" name="obs_neurologia_estado_mental" class="form-control" required="" value="NINGUNO" id="obs_neurologia_estado_mental">
                            </div>
                        </div>
                    </div>
                </fieldset><br>
                <fieldset>
                    <legend>EXAMEN FISICO</legend>

                    <div style="margin: 10px;">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>PESO KG</strong>
                                <input type="number" name="peso" id="peso" class="form-control" required="" placeholder="Peso KG" onchange="calcular_imc();">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>TALLA CM</strong>
                                <input class="form-control" name="talla" id="talla" required="" type="number" value="<?php echo $historia[0]->hcTalla; ?>" onchange="calcular_imc();">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>IMC</strong>
                                <input type="number" name="imc" id="imc" class="form-control" required="" placeholder="IMC" readonly="">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>PERIMETRO ABDOMINAL</strong>
                                <input type="text" name="perimetro_abdominal" class="form-control" required="" placeholder="Perimetro abdominal" id="perimetro_abdominal">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>PRESIÓN ARTERIAL SISTÓLICA</strong>
                                <input type="number" name="ef_pa_sistolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial sistolica" id="ef_pa_sistolica_sentado_pie">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>PRESIÓN ARTERIAL DIASTÓLICA</strong>
                                <input type="number" name="ef_pa_distolica_sentado_pie" class="form-control" required="" placeholder="Presion arterial distolica" id="ef_pa_distolica_sentado_pie">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>FRECUENCIA CARDIACA</strong>
                                <input type="text" name="ef_frecuencia_fisica" class="form-control" required="" placeholder="Frecuencia cardiaca" id="ef_frecuencia_fisica">
                            </div>
                            <div class="form-group col-md-6">
                                <strong>FRECUENCIA RESPIRATORIA</strong>
                                <input type="text" name="ef_frecuencia_respiratoria" class="form-control" required="" placeholder="Frecuencia respiratoria" id="ef_frecuencia_respiratoria">
                            </div>
                        </div>
                    </div>
                </fieldset><br>

                <div style="border: ridge #0f0fef 1px;">
                    <div class="form-row" style="margin: 10px;">
                        <div class="form-group col-md-12">
                            <strong>ANÁLISIS PLAN</strong>
                            <textarea class="form-control" name="observaciones_generales" placeholder="Analisis plan" required="" rows="2" id="observaciones_generales"></textarea>
                        </div>
                    </div>
                </div><br>
                <fieldset>
                    <legend>CLASIFICACIÓN</legend>

                    <div style="margin: 10px;">
                        <div class="form-row">
                     
                        <div class="form-group col-md-6">
                            <strong>HIPERTENSIÓN ARTERIAL</strong>
                            <?php if ($clasificacion[0]->hcHipertensionArterialPersonal == 'SI') { ?>
                            <select class="form-control" required="" name="hipertension_arterial_personal"   >
                                <option value="<?= $clasificacion[0]->hcHipertensionArterialPersonal; ?>" selected><?= $clasificacion[0]->hcHipertensionArterialPersonal; ?></option>
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
                                        <option value="No HTA" selected>No HTA</option>
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
                                            
                            <div class="form-group col-md-6">
                                <strong>CLASIFICACIÓN  ERC ESTADO</strong>
                                <?php if ($clasificacion[0]->hcClasificacionErcEstado == 'I') { ?>
                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'II') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IIIA') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IIIB') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'IV') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="V">V</option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
                                    </select>

                                <?php } elseif ($clasificacion[0]->hcClasificacionErcEstado == 'V') { ?>

                                    <select class="form-control" required="" name="clasificacion_erc_estado">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="IIIA">IIIA</option>
                                        <option value="IIIB">IIIB</option>
                                        <option value="IV">IV</option>
                                        <option value="<?= $clasificacion[0]->hcClasificacionErcEstado; ?>" selected><?= $clasificacion[0]->hcClasificacionErcEstado; ?></option>
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
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
                                        <option value="SIN CLASIFICACION">SIN CLASIFICACIÓN </option>
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

                                <?php } elseif ($clasificacion[0]->hcClasificacionRcv == 'SIN CLASIFICAR') { ?>
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
                                        <option value="HTA-RIESGOS MODERNO">HTA-RIESGOS MODERADO</option>
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
                </fieldset><br>
                <br>



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
</fieldset> <br>

                <div style="border: ridge #0f0fef 1px;">
                    <div class="form-row" style="margin: 10px;">
                        <!--div id="mens_paraclinico_upload" style="display: none;"></div-->

                        <div class="row">
                            <!-- Button trigger modal -->
                            <div class="col-12">
                                <?php $doc = $datos_cita[0]->pacDocumento; ?>
                                <a type="button" class="btn btn-outline-primary " target="_blank" href="<?= base_url("index.php/CHistoria/lista_paraclinico/$doc") ?>">
                                    Paraclinicos
                                </a>
                           
                </div><br>
               <br>
                <div class="col-12">
                           
                                <?php $doc = $datos_cita[0]->pacDocumento; ?>
                                <a type="button" class="btn btn-outline-primary " target="_blank" href="<?= base_url("index.php/CHistoria/lista_visitas/$doc") ?>">
                               App visitas Domiciliaria
                            </a>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div style="border: ridge #0f0fef 1px;">
                    <div class="form-row" style="margin: 10px; text-align:center;">
                        <div class="form-group col-md-6">
                            <?php

                            echo '<img alt="Image placeholder" width="302px" height="70px" src="data:image/jpeg;base64,' . base64_encode($datos_cita[0]->usuFirma) . '"/>'; ?><br>
                            <strong>FIRMA DIGITAL</strong><br>
                            <strong>PROFESIONAL: </strong>
                            <em><?= $datos_cita[0]->usuNombre . " " . $datos_cita[0]->usuApellido; ?><br>RM: <?= $datos_cita[0]->usuRegistroProfesional; ?></em>
                        </div>
                        <div class="form-group col-md-6"><br><br><br><br><br>
                            <strong>FIRMA PACIENTE: </strong>
                            <em><?= $datos_cita[0]->nom_abreviacion . "-" . $datos_cita[0]->pacDocumento . " " . $datos_cita[0]->pacNombre . " " . $datos_cita[0]->pacApellido ?></em>
                        </div>
                    </div>
                </div><br>

            <?php } ?>
            <div id="contador">
                <input type="button" class="btn btn-primary" onclick="pregunta('<?php echo $contador; ?>')" value="Enviar">
            </div>
        </form>
    <?php } ?>
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
            var successMessage = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Paquete Registrado con Éxito<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $("#mens_cups").html(successMessage);

        } 
    });

});


    function pregunta(contador) {

        if (document.formulario.motivo_complementaria.value == "") {
            alert("Tiene que escribir el motivo de la consulta")
            document.formulario.motivo_complementaria.focus()
            return 0;

        } else if (document.formulario.enfermedad_actual.value == "") {

            alert("Tiene que escribir la enfermedad actual del paciente")
            document.formulario.enfermedad_actual.focus()



        } else if (document.formulario.peso.value == "") {

            alert("Tiene que escribir el peso del paciente")
            document.formulario.peso.focus()


        } else if (document.formulario.talla.value == "") {

            alert("Tiene que escribir la talla de la persona")
            document.formulario.talla.focus()


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

        } else if (contador < 1) {

            alert("Tiene que agregar como minimo un diagnostico")
            document.formulario.codigo.focus()
            return 0;

        } else {

            if (confirm('¿Estas seguro de enviar este formulario?')) {
                document.getElementById('guardandoOverlayHC').style.display='flex';document.formulario.submit();
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

    $("#sistema_nervioso").change(function() {
        //alert($("#hipertension_arterial").val())
        if ($("#sistema_nervioso").val() == 'SI') {
            $('#descripcion_sistema_nervioso').show();
        } else {
            $('#descripcion_sistema_nervioso').hide();
            $("input[name*='descripcion_sistema_nervioso']").val("");

        }
    });

    $("#sistema_hemolinfatico").change(function() {
        //alert($("#hipertension_arterial").val())
        if ($("#sistema_hemolinfatico").val() == 'SI') {
            $('#descripcion_sistema_hemolinfatico').show();
        } else {
            $('#descripcion_sistema_hemolinfatico').hide();
            $("input[name*='descripcion_sistema_hemolinfatico']").val("");

        }
    });

    $("#aparato_digestivo").change(function() {
        //alert($("#hipertension_arterial").val())
        if ($("#aparato_digestivo").val() == 'SI') {
            $('#descripcion_aparato_digestivo').show();
        } else {
            $('#descripcion_aparato_digestivo').hide();
            $("input[name*='descripcion_aparato_digestivo']").val("");

        }
    });

    $("#organos_sentidos").change(function() {

        if ($("#organos_sentidos").val() == 'SI') {
            $('#descripcion_organos_sentidos').show();
        } else {
            $('#descripcion_organos_sentidos').hide();
            $("input[name*='descripcion_organos_sentidos']").val("");

        }
    });

    $("#endocrino_metabolico").change(function() {

        if ($("#endocrino_metabolico").val() == 'SI') {
            $('#descripcion_endocrino_metabolico').show();
        } else {
            $('#descripcion_endocrino_metabolico').hide();
            $("input[name*='descripcion_endocrino_metabolico']").val("");

        }
    });

    $("#inmunologico").change(function() {

        if ($("#inmunologico").val() == 'SI') {
            $('#descripcion_inmunologico').show();
        } else {
            $('#descripcion_inmunologico').hide();
            $("input[name*='descripcion_inmunologico']").val("");

        }
    });

    $("#cancer_tumores_radio_quimioterapia").change(function() {

        if ($("#cancer_tumores_radio_quimioterapia").val() == 'SI') {
            $('#descripcion_cancer_tumores_radio_quimioterapia').show();
        } else {
            $('#descripcion_cancer_tumores_radio_quimioterapia').hide();
            $("input[name*='descripcion_cancer_tumores_radio_quimioterapia']").val("");

        }
    });

    $("#glandulas_mamarias").change(function() {

        if ($("#glandulas_mamarias").val() == 'SI') {
            $('#descripcion_glandulas_mamarias').show();
        } else {
            $('#descripcion_glandulas_mamarias').hide();
            $("input[name*='descripcion_glandulas_mamarias']").val("");

        }
    });

    $("#hipertension_diabetes_erc").change(function() {

        if ($("#hipertension_diabetes_erc").val() == 'SI') {
            $('#descripcion_hipertension_diabetes_erc').show();
        } else {
            $('#descripcion_hipertension_diabetes_erc').hide();
            $("input[name*='descripcion_hipertension_diabetes_erc']").val("");

        }
    });

    $("#reacion_alergica").change(function() {

        if ($("#reacion_alergica").val() == 'SI') {
            $('#descripcion_reacion_alergica').show();
        } else {
            $('#descripcion_reacion_alergica').hide();
            $("input[name*='descripcion_reacion_alergica']").val("");

        }
    });

    $("#cardio_vasculares").change(function() {

        if ($("#cardio_vasculares").val() == 'SI') {
            $('#descripcion_cardio_vasculares').show();
        } else {
            $('#descripcion_cardio_vasculares').hide();
            $("input[name*='descripcion_cardio_vasculares']").val("");

        }
    });


    $("#respiratorios").change(function() {

        if ($("#respiratorios").val() == 'SI') {
            $('#descripcion_respiratorios').show();
        } else {
            $('#descripcion_respiratorios').hide();
            $("input[name*='descripcion_respiratorios']").val("");

        }
    });

    $("#crinarias").change(function() {

        if ($("#crinarias").val() == 'SI') {
            $('#descripcion_crinarias').show();
        } else {
            $('#descripcion_crinarias').hide();
            $("input[name*='descripcion_crinarias']").val("");

        }
    });

    $("#osteoarticulares").change(function() {

        if ($("#osteoarticulares").val() == 'SI') {
            $('#descripcion_osteoarticulares').show();
        } else {
            $('#descripcion_osteoarticulares').hide();
            $("input[name*='descripcion_osteoarticulares']").val("");

        }
    });

    $("#infecciosos").change(function() {

        if ($("#infecciosos").val() == 'SI') {
            $('#descripcion_infecciosos').show();
        } else {
            $('#descripcion_infecciosos').hide();
            $("input[name*='descripcion_infecciosos']").val("");

        }
    });

    $("#cirugias_traumas").change(function() {

        if ($("#cirugias_traumas").val() == 'SI') {
            $('#descripcion_cirugias_traumas').show();
        } else {
            $('#descripcion_cirugias_traumas').hide();
            $("input[name*='descripcion_cirugias_traumas']").val("");

        }
    });

    $("#tratamiento_medicacion").change(function() {

        if ($("#tratamiento_medicacion").val() == 'SI') {
            $('#descripcion_tratamiento_medicacion').show();
        } else {
            $('#descripcion_tratamiento_medicacion').hide();
            $("input[name*='descripcion_tratamiento_medicacion']").val("");

        }
    });

    $("#antecedentes_quirurgicos").change(function() {

        if ($("#antecedentes_quirurgicos").val() == 'SI') {
            $('#descripcion_antecedentes_quirurgicos').show();
        } else {
            $('#descripcion_antecedentes_quirurgicos').hide();
            $("input[name*='descripcion_antecedentes_quirurgicos']").val("");

        }
    });



    $("#antecedentes_familiares").change(function() {

        if ($("#antecedentes_familiares").val() == 'SI') {
            $('#descripcion_antecedentes_familiares').show();
        } else {
            $('#descripcion_antecedentes_familiares').hide();
            $("input[name*='descripcion_antecedentes_familiares']").val("");

        }
    });

    $("#consumo_tabaco").change(function() {

        if ($("#consumo_tabaco").val() == 'SI') {
            $('#descripcion_consumo_tabaco').show();
        } else {
            $('#descripcion_consumo_tabaco').hide();
            $("input[name*='descripcion_consumo_tabaco']").val("");

        }
    });

    $("#antecedentes_alcohol").change(function() {

        if ($("#antecedentes_alcohol").val() == 'SI') {
            $('#descripcion_antecedentes_alcohol').show();
        } else {
            $('#descripcion_antecedentes_alcohol').hide();
            $("input[name*='descripcion_antecedentes_alcohol']").val("");

        }
    });

    $("#sedentarismo").change(function() {

        if ($("#sedentarismo").val() == 'SI') {
            $('#descripcion_sedentarismo').show();
        } else {
            $('#descripcion_sedentarismo').hide();
            $("input[name*='descripcion_sedentarismo']").val("");

        }
    });

    $("#ginecologicos").change(function() {

        if ($("#ginecologicos").val() == 'SI') {
            $('#descripcion_ginecologicos').show();
        } else {
            $('#descripcion_ginecologicos').hide();
            $("input[name*='descripcion_ginecologicos']").val("");

        }
    });

    $("#citologia_vaginal").change(function() {

        if ($("#citologia_vaginal").val() == 'SI') {
            $('#descripcion_citologia_vaginal').show();
        } else {
            $('#descripcion_citologia_vaginal').hide();
            $("input[name*='descripcion_citologia_vaginal']").val("");

        }
    });

    $("#metodo_anticonceptivo").change(function() {

        if ($("#metodo_anticonceptivo").val() == 'SI') {
            $("input[name*='metodo_anticonceptivo_cual']").val("");
        } else {
            $("input[name*='metodo_anticonceptivo_cual']").val("NINGUNO");

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
</script>
