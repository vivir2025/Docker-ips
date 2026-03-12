<!-- lists the desents authorized by the patients -->
<div class="container">

    <hr>
    <h5 style="color: white;">
        <a href="https://app-fnpv-web.nacerparavivir.org/login" target="_blank" rel="noopener" style="color: white; text-decoration: none;">CONSULTAS Y/O HISTORIAL VISITAS DOMICILIARIAS POR DOCUMENTO PACIENTE</a>
    </h5>
    <hr>
    <div class="form-row">
        <label class="col-sm-2 col-form-label text-white">Documento:</label>
        <div class="input-group col-sm-10 ">
            <input class="form-control" type="text" id="documento" placeholder="Documento" required="">
            <div class="input-group-append">
                <body onkeyup="buscar_paciente2()"></body>
            </div>
        </div>
        
    </div><br>
    <div>
    <div  id="resultado" style="display: none;"></div>
</div> 

<script type='text/javascript'>
    function buscar_paciente2() {
        var documento = $('#documento').val();

        //alert(documento);

        $.post("<?= base_url("index.php/CHistorial/buscar_paciente4") ?>", {
            documento: documento
        }, function(data) {
            $('#resultado').show();
            $("#resultado").html(data);
        });
    }

    function verVisitas(id_de, ) {

        
document.location.href = "<?php echo base_url(). 'index.php/CHistoria/Lista_desentimiento/' ?>"+  id_de;


}


    function finestraSecundaria(url) {
        //alert(url)
        window.open(url, "HISTORIAL HC", "width=800, height=400")
    }
</script>
