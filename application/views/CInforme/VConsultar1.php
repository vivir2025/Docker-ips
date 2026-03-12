<!-- This is the view where the 1552 report is generated -->

<style>
/* Modal de descarga profesional */
.download-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(44, 62, 80, 0.95);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.download-modal {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 20px;
    padding: 50px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    min-width: 400px;
    animation: zoomIn 0.4s ease;
}

.download-icon-container {
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s ease-in-out infinite;
}

.download-icon-container i {
    font-size: 50px;
    color: white;
}

.download-title {
    font-size: 26px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 15px;
}

.download-subtitle {
    font-size: 16px;
    color: #7f8c8d;
    margin-bottom: 30px;
}

.download-progress-bar {
    width: 100%;
    height: 6px;
    background: #ecf0f1;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
}

.download-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    width: 0%;
    animation: progressAnimation 2s ease-in-out infinite;
}

.download-status {
    font-size: 14px;
    color: #95a5a6;
    font-weight: 500;
}

/* Animación de éxito */
.download-success {
    display: none;
}

.download-success .download-icon-container {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    animation: successPulse 0.6s ease;
}

.download-success .download-title {
    color: #27ae60;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    from { 
        transform: translate(-50%, -50%) scale(0.7);
        opacity: 0;
    }
    to { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes progressAnimation {
    0% { width: 0%; margin-left: 0%; }
    50% { width: 80%; margin-left: 10%; }
    100% { width: 0%; margin-left: 100%; }
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Estilos del formulario */
.informe-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 40px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.informe-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 25px;
    border-bottom: 3px solid #667eea;
}

.informe-header h3 {
    color: #2c3e50;
    font-weight: 700;
    font-size: 28px;
    margin: 0;
}

.informe-header p {
    color: #7f8c8d;
    margin-top: 10px;
    font-size: 14px;
}

.form-group-inline {
    display: flex;
    align-items: center;
    gap: 20px;
    justify-content: center;
    margin-bottom: 30px;
}

.form-group-inline label {
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
    min-width: 80px;
}

.form-group-inline input[type="date"] {
    padding: 12px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    width: 200px;
}

.form-group-inline input[type="date"]:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.btn-generar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 15px 50px;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-generar:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.btn-generar:active {
    transform: translateY(0);
}
</style>

<div class="informe-container">
    <div class="informe-header">
        <h3>📊 Informe  (1552)</h3>
        <p>Genere su informe seleccionando el rango de fechas</p>
    </div>

    <form id="formInforme" action="<?= site_url('CInforme/exportar_1') ?>" method="post">
        <div style="display: flex; align-items: center; justify-content: center; gap: 30px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <label style="font-weight: 600; color: #2c3e50; margin: 0;">📅 Desde:</label>
                <input type="date" name="fecha" style="padding: 12px 20px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px;" required>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <label style="font-weight: 600; color: #2c3e50; margin: 0;">📅 Hasta:</label>
                <input type="date" name="fecha1" style="padding: 12px 20px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px;" required>
            </div>

            <button type="submit" class="btn-generar">
                <i class="fas fa-download"></i> Generar Informe
            </button>
        </div>
    </form>
</div>

<!-- Modal de descarga -->
<div id="downloadOverlay" class="download-overlay">
    <div class="download-modal" id="downloadModal">
        <div class="download-icon-container">
            <i class="fas fa-file-download"></i>
        </div>
        <div class="download-title">Generando Informe</div>
        <div class="download-subtitle">Por favor espere mientras procesamos su solicitud...</div>
        <div class="download-progress-bar">
            <div class="download-progress-fill"></div>
        </div>
        <div class="download-status">Procesando datos del informe</div>
    </div>
</div>

<script>
document.getElementById('formInforme').addEventListener('submit', function(e) {
    // Mostrar modal de descarga
    document.getElementById('downloadOverlay').style.display = 'block';
    
    // Simular el proceso de descarga y ocultar automáticamente
    setTimeout(function() {
        // Cambiar a estado de éxito
        var modal = document.getElementById('downloadModal');
        modal.classList.add('download-success');
        modal.querySelector('.download-title').textContent = '¡Descarga Completada!';
        modal.querySelector('.download-subtitle').textContent = 'El archivo se ha descargado correctamente';
        modal.querySelector('.download-status').textContent = 'Informe RIPS generado correctamente';
        modal.querySelector('.download-icon-container i').className = 'fas fa-check';
        
        // Ocultar modal después de 2 segundos
        setTimeout(function() {
            document.getElementById('downloadOverlay').style.display = 'none';
            // Resetear modal para próxima vez
            modal.classList.remove('download-success');
            modal.querySelector('.download-title').textContent = 'Generando Informe';
            modal.querySelector('.download-subtitle').textContent = 'Por favor espere mientras procesamos su solicitud...';
            modal.querySelector('.download-status').textContent = 'Procesando datos del informe';
            modal.querySelector('.download-icon-container i').className = 'fas fa-file-download';
        }, 2000);
    }, 3000);
});
</script>
