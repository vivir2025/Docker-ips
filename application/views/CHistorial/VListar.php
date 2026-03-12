<!-- ═══ Google-style top bar — IPS Cajibio (Historial) ══════════════════ -->
<style>
#ips-topbar-hc {
    position: fixed; top: 0; left: 0;
    height: 3px; width: 0%; z-index: 99999;
    background: linear-gradient(90deg, #3498db 0%, #85d8ff 40%, #2980b9 70%, #3498db 100%);
    background-size: 300% 100%;
    border-radius: 0 2px 2px 0;
    box-shadow: 0 0 10px rgba(52,152,219,0.8);
    animation: ips-shine-hc 1.2s linear infinite;
    display: none;
}
@keyframes ips-shine-hc {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>

<div id="ips-topbar-hc"></div>

<style>
/* Estilos profesionales para historial clínico */
.historial-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

.historial-search-section {
    background: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid #e0e0e0;
}

.historial-search-section h4 {
    color: #2c3e50;
    margin: 0 0 25px 0;
    font-weight: 700;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.historial-search-section h4 i {
    color: #3498db;
}

.search-input-group {
    display: flex;
    gap: 15px;
    align-items: flex-end;
}

.search-input-wrapper {
    flex: 1;
}

.search-input-wrapper label {
    font-weight: 600;
    color: #495057;
    font-size: 14px;
    margin-bottom: 10px;
    display: block;
}

.search-input-wrapper input {
    width: 100%;
    padding: 12px 18px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.search-input-wrapper input:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
    outline: none;
}

.btn-search {
    padding: 12px 30px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-search:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

/* Skeleton Loader */
.skeleton-loader-historial {
    display: none;
    margin: 20px 0;
}

.skeleton-card-historial {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 15px;
    border: 2px solid #e0e0e0;
}

.skeleton-header-historial {
    height: 70px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-body-historial {
    padding: 20px;
}

.skeleton-line-historial {
    height: 20px;
    background: linear-gradient(90deg, #f8f8f8 25%, #ececec 50%, #f8f8f8 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
    margin-bottom: 12px;
    border-radius: 4px;
}

.skeleton-line-historial:last-child {
    width: 70%;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Tarjeta de historial */
.historial-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.12);
    border: 3px solid #e0e0e0;
    margin-bottom: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.historial-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(0,0,0,0.18);
    border-color: #3498db;
}

.historial-card-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    padding: 15px 20px;
    font-weight: 700;
    font-size: 15px;
    border-bottom: 3px solid #2874a6;
}

.historial-card-body {
    padding: 15px;
}

.historial-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.historial-table thead {
    background: #f8f9fa;
}

.historial-table thead th {
    padding: 12px 10px;
    font-size: 13px;
    font-weight: 700;
    color: #2c3e50;
    border: 2px solid #dee2e6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.historial-table thead th:first-child {
    border-top-left-radius: 8px;
}

.historial-table thead th:last-child {
    border-top-right-radius: 8px;
}

.historial-table tbody td {
    padding: 12px 10px;
    vertical-align: middle;
    font-size: 13px;
    border: 2px solid #dee2e6;
    border-top: none;
    text-align: center;
}

.historial-table tbody tr {
    transition: background-color 0.2s ease;
}

.historial-table tbody tr:hover {
    background-color: #f8f9fa;
}

.patient-info {
    text-align: left;
}

.patient-info .doc-number {
    font-weight: 700;
    color: #3498db;
    font-size: 13px;
    margin-bottom: 4px;
}

.patient-info .patient-name {
    color: #2c3e50;
    font-weight: 600;
    font-size: 13px;
}

.area-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    background: #e3f2fd;
    color: #1976d2;
}

.professional-name {
    font-weight: 600;
    color: #2c3e50;
}

.history-date {
    font-weight: 600;
    color: #7f8c8d;
}

.action-buttons {
    display: flex;
    flex-wrap: nowrap;
    gap: 5px;
    justify-content: center;
    align-items: center;
}

.btn-action {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: 2px solid #e0e0e0;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
    flex-shrink: 0;
}

.btn-action img {
    width: 20px;
    height: 20px;
    object-fit: contain;
}

.btn-action:hover {
    transform: scale(1.2);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn-action.btn-historia {
    border-color: #F04848;
    background: #ffe5e5;
}

.btn-action.btn-historia:hover {
    background: #F04848;
    border-color: #F04848;
}

.btn-action.btn-print {
    border-color: #0004FF;
    background: #e5e5ff;
}

.btn-action.btn-print:hover {
    background: #0004FF;
    border-color: #0004FF;
}

.btn-action.btn-medicamento {
    border-color: #FFD800;
    background: #fffae5;
}

.btn-action.btn-medicamento:hover {
    background: #FFD800;
    border-color: #FFD800;
}

.btn-action.btn-remision {
    border-color: #00B305;
    background: #e5ffe6;
}

.btn-action.btn-remision:hover {
    background: #00B305;
    border-color: #00B305;
}

.btn-action.btn-ayuda {
    border-color: #029FFF;
    background: #e5f6ff;
}

.btn-action.btn-ayuda:hover {
    background: #029FFF;
    border-color: #029FFF;
}

.empty-state-historial {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    border: 2px solid #e0e0e0;
}

.empty-state-historial i {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state-historial h5 {
    color: #495057;
    margin-bottom: 10px;
    font-weight: 700;
}

.empty-state-historial p {
    color: #6c757d;
    font-size: 14px;
}

/* Overlay de carga para abrir historia */
.loading-overlay-historial {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.loading-content-historial {
    background: white;
    padding: 40px 50px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.loading-spinner-historial {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin-historial 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin-historial {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-text-historial {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.loading-subtext-historial {
    color: #7f8c8d;
    font-size: 14px;
}
</style>

<!-- Vista mejorada de historial clínico -->
<div class="historial-container">
    <div class="historial-search-section">
        <h4><i class="fa fa-file-medical"></i> Consultas y Historial por Documento</h4>
        <div class="search-input-group">
            <div class="search-input-wrapper">
                <label>Documento del Paciente</label>
                <input type="text" id="documento" placeholder="Ingrese número de documento" onkeyup="buscar_paciente()">
            </div>
        </div>
    </div>

    <!-- Skeleton Loader -->
    <div id="skeletonLoaderHistorial" class="skeleton-loader-historial">
        <div class="skeleton-card-historial">
            <div class="skeleton-header-historial"></div>
            <div class="skeleton-body-historial">
                <div class="skeleton-line-historial"></div>
                <div class="skeleton-line-historial"></div>
                <div class="skeleton-line-historial"></div>
            </div>
        </div>
        <div class="skeleton-card-historial">
            <div class="skeleton-header-historial"></div>
            <div class="skeleton-body-historial">
                <div class="skeleton-line-historial"></div>
                <div class="skeleton-line-historial"></div>
                <div class="skeleton-line-historial"></div>
            </div>
        </div>
    </div>

    <!-- Contenedor de resultados -->
    <div id="resultado" style="display: none;"></div>
</div>

<!-- Overlay de carga para abrir historia -->
<div id="loadingOverlayHistorial" class="loading-overlay-historial">
    <div class="loading-content-historial">
        <div class="loading-spinner-historial"></div>
        <div class="loading-text-historial">Abriendo historia clínica</div>
        <div class="loading-subtext-historial">Espere un momento, por favor...</div>
    </div>
</div>

<script type='text/javascript'>
    // Funciones para el overlay de carga
    function mostrarLoadingHistorial() {
        $('#loadingOverlayHistorial').css('display', 'flex');
    }

    function ocultarLoadingHistorial() {
        $('#loadingOverlayHistorial').css('display', 'none');
    }

    // ── Barra de progreso ─────────────────────────────────────────────────
    var $barHC = $('#ips-topbar-hc'), barTimerHC;

    function barStartHC() {
        clearTimeout(barTimerHC);
        $barHC.stop(true).css({ width: '0%', display: 'block' }).animate({ width: '75%' }, 700);
    }
    function barDoneHC() {
        $barHC.animate({ width: '100%' }, 200, function () {
            var self = $(this);
            barTimerHC = setTimeout(function () { self.fadeOut(300).css('width', '0%'); }, 250);
        });
    }

    function buscar_paciente() {
        var documento = $('#documento').val();

        if(documento.length >= 3) {
            // Mostrar skeleton loader + barra superior
            $('#resultado').hide();
            $('#skeletonLoaderHistorial').show();
            barStartHC();

            $.post("<?= base_url("index.php/CHistorial/buscar_paciente") ?>", {
                documento: documento
            }, function(data) {
                // Ocultar skeleton, mostrar resultados, completar barra
                $('#skeletonLoaderHistorial').hide();
                $('#resultado').show();
                $("#resultado").html(data);
                barDoneHC();
            });
        } else {
            $('#resultado').hide();
            $('#skeletonLoaderHistorial').hide();
        }
    }

    function verHistoriaCompleta(id_hc,id_proceso) {
        // Barra superior + overlay de carga
        barStartHC();
        mostrarLoadingHistorial();
        
        // Pequeño delay para que se vea el overlay antes de redirigir
        setTimeout(function() {
            document.location.href = "<?php echo base_url() . 'index.php/CHistoria/imprimir_historia_clinica_historial/' ?>" + id_hc;
        }, 300);
    }
    function verParaclinicos(id_hc,id_cat_cups, id_proceso) {

        
        document.location.href = "<?php echo base_url(). 'index.php/CHistoria/lista_paraclinico/' ?>"+ id_hc , id_hcs_paraclinico;


 }

    function verVisitas(id_hc,id_hcs_visitas, id_cat_cups, id_proceso) {

        
        document.location.href = "<?php echo base_url(). 'index.php/CHistoria/Lista_Visitas/' ?>"+ id_hc , id_hcs_visitas;


}

function Fisioterapia(id_hc) {

        
document.location.href = "<?php echo base_url(). 'index.php/CHistoria/Lista_Visitas/' ?>"+ id_hc ;


}


function vervistaparaclinico(id_hc,id_cat_cups, id_proceso) {

    
    document.location.href = "<?php echo base_url(). 'index.php/CHistoria/vistaparaclinico/' ?>"+ id_hc , id_hcs_paraclinico;


}

    
    function verValoracion(id_hc, id_cat_cups, id_proceso) {


        if (id_proceso == 1) {

            if (id_cat_cups == 1) {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_1/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            } else {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_2/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            }

        } else if (id_proceso == 2) {

            if (id_cat_cups == 1) {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_6/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            } else {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_8/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            }


        } else if (id_proceso == 3) {

            url = "<?php echo base_url() . 'index.php/CHistorial/hc_7/' ?>" + id_hc;


            window.open(url, "HISTORIAL HC", "width=800, height=400")


        } else if (id_proceso == 4) {


            if (id_cat_cups == 1) {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_9/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            } else {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_11/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            }
        } else if (id_proceso == 13) {


if (id_cat_cups == 1) {

    url = "<?php echo base_url() . 'index.php/CHistorial/hc_12/' ?>" + id_hc;
    window.open(url, "HISTORIAL HC", "width=800, height=400")

} else {

    url = "<?php echo base_url() . 'index.php/CHistorial/hc_13/' ?>" + id_hc;
    window.open(url, "HISTORIAL HC", "width=800, height=400")

}





        } else if (id_proceso == 5) {


            if (id_cat_cups == 1) {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_3/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            } else {

                url = "<?php echo base_url() . 'index.php/CHistorial/hc_10/' ?>" + id_hc;
                window.open(url, "HISTORIAL HC", "width=800, height=400")

            }

        } else if (id_proceso == 6) {


            url = "<?php echo base_url() . 'index.php/CHistorial/hc_4/' ?>" + id_hc;


            window.open(url, "HISTORIAL HC", "width=800, height=400")


        } else if (id_proceso == 7) {

            url = "<?php echo base_url() . 'index.php/CHistorial/hc_5/' ?>" + id_hc;


            window.open(url, "HISTORIAL HC", "width=800, height=400")


        }

    }


    function finestraSecundaria(url) {
        //alert(url)
        window.open(url, "HISTORIAL HC", "width=800, height=400")
    }
</script>
