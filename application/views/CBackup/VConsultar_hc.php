<style>
.backup-container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 40px;
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 18px 45px rgba(23, 43, 77, 0.18);
}

.backup-header {
    text-align: center;
    margin-bottom: 32px;
    padding-bottom: 22px;
    border-bottom: 3px solid #1f8a70;
}

.backup-header h3 {
    margin: 0;
    color: #1f2d3d;
    font-size: 30px;
    font-weight: 700;
}

.backup-header p {
    margin: 10px 0 0;
    color: #607080;
    font-size: 14px;
}

.backup-panel {
    background: linear-gradient(135deg, #f4fbff 0%, #eef8f2 100%);
    border: 1px solid #dceee6;
    border-radius: 16px;
    padding: 28px;
}

.backup-panel-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
    color: #1f2d3d;
    font-size: 22px;
    font-weight: 700;
}

.backup-panel-subtitle {
    margin-bottom: 24px;
    color: #607080;
    font-size: 14px;
}

.backup-form-row {
    display: flex;
    gap: 18px;
    align-items: end;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.backup-field {
    flex: 1 1 220px;
}

.backup-field label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #234;
}

.backup-field input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #d8e4ea;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.backup-field input:focus {
    outline: none;
    border-color: #1f8a70;
    box-shadow: 0 0 0 4px rgba(31, 138, 112, 0.12);
}

.backup-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
}

.backup-actions {
    display: flex;
    justify-content: center;
}

.btn-backup {
    background: linear-gradient(135deg, #1f8a70 0%, #136f63 100%);
    border: none;
    color: #fff;
    padding: 15px 38px;
    border-radius: 28px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(19, 111, 99, 0.25);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-backup:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(19, 111, 99, 0.3);
}

.download-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(15, 33, 56, 0.9);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.download-modal {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    border-radius: 22px;
    padding: 44px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    min-width: 410px;
    animation: zoomIn 0.4s ease;
}

.download-icon-container {
    width: 96px;
    height: 96px;
    margin: 0 auto 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1f8a70 0%, #2ea66f 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s ease-in-out infinite;
}

.download-icon-container i {
    font-size: 44px;
    color: #fff;
}

.download-title {
    font-size: 26px;
    font-weight: 700;
    color: #1f2d3d;
    margin-bottom: 12px;
}

.download-subtitle,
.download-status {
    color: #607080;
}

.download-subtitle {
    margin-bottom: 24px;
}

.download-progress-bar {
    width: 100%;
    height: 6px;
    background: #e6ecef;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 16px;
}

.download-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #1f8a70 0%, #2ea66f 100%);
    width: 0%;
    animation: progressAnimation 2s ease-in-out infinite;
}

.download-success {
    display: none;
}

.download-success .download-icon-container {
    background: linear-gradient(135deg, #0ca678 0%, #51cf66 100%);
    animation: successPulse 0.6s ease;
}

.download-success .download-title {
    color: #168a5b;
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

@media (max-width: 768px) {
    .backup-container {
        margin: 20px 15px;
        padding: 24px;
    }

    .download-modal {
        min-width: auto;
        width: calc(100% - 30px);
        padding: 28px;
    }
}
</style>

<div class="backup-container">
    <div class="backup-header">
        <h3>Sincronizacion Manual HC</h3>
        <p>Genere un archivo SQL/TXT con historias clinicas, relaciones y remapeo de IDs para sincronizacion manual.</p>
    </div>

    <div class="backup-panel">
        <div class="backup-panel-title">
            <i class="fas fa-database"></i>
            <span>Generar backup de historias clinicas</span>
        </div>
        <div class="backup-panel-subtitle">
            Seleccione el rango de fechas e ingrese los IDs maximos del sistema destino antes de descargar el archivo.
        </div>

        <form id="formBackupHc" action="<?= site_url('CBackup/exportar_sql_hc') ?>" method="post">
            <div class="backup-form-row">
                <div class="backup-field">
                    <label for="fecha">Desde</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>

                <div class="backup-field">
                    <label for="fecha1">Hasta</label>
                    <input type="date" id="fecha1" name="fecha1" required>
                </div>
            </div>

            <div class="backup-grid">
                <div class="backup-field">
                    <label for="paciente_ids">ID max Paciente</label>
                    <input type="number" min="0" id="paciente_ids" name="paciente_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="agenda_ids">ID max Agenda</label>
                    <input type="number" min="0" id="agenda_ids" name="agenda_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="cita_ids">ID max Cita</label>
                    <input type="number" min="0" id="cita_ids" name="cita_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_ids">ID max HC</label>
                    <input type="number" min="0" id="hc_ids" name="hc_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_complementaria_ids">ID max HC Complementaria</label>
                    <input type="number" min="0" id="hc_complementaria_ids" name="hc_complementaria_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_medicamento_ids">ID max Medicamentos</label>
                    <input type="number" min="0" id="hc_medicamento_ids" name="hc_medicamento_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_cups_ids">ID max CUPS</label>
                    <input type="number" min="0" id="hc_cups_ids" name="hc_cups_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_diagnostico_ids">ID max Diagnosticos</label>
                    <input type="number" min="0" id="hc_diagnostico_ids" name="hc_diagnostico_ids" value="0">
                </div>
                <div class="backup-field">
                    <label for="hc_remision_ids">ID max Remisiones</label>
                    <input type="number" min="0" id="hc_remision_ids" name="hc_remision_ids" value="0">
                </div>
            </div>

            <div class="backup-actions">
                <button type="submit" class="btn-backup">
                    <i class="fas fa-download"></i> Descargar Backup HC
                </button>
            </div>
        </form>
    </div>
</div>

<div id="downloadOverlay" class="download-overlay">
    <div class="download-modal" id="downloadModal">
        <div class="download-icon-container">
            <i class="fas fa-file-export"></i>
        </div>
        <div class="download-title">Generando Backup</div>
        <div class="download-subtitle">Estamos armando el archivo de sincronizacion manual...</div>
        <div class="download-progress-bar">
            <div class="download-progress-fill"></div>
        </div>
        <div class="download-status">Procesando pacientes, agenda, citas e historias clinicas</div>
    </div>
</div>

<script>
document.getElementById('formBackupHc').addEventListener('submit', function () {
    document.getElementById('downloadOverlay').style.display = 'block';

    setTimeout(function () {
        var modal = document.getElementById('downloadModal');
        modal.classList.add('download-success');
        modal.querySelector('.download-title').textContent = 'Backup listo para descarga';
        modal.querySelector('.download-subtitle').textContent = 'El archivo TXT se esta descargando en su equipo';
        modal.querySelector('.download-status').textContent = 'Sincronizacion manual preparada correctamente';
        modal.querySelector('.download-icon-container i').className = 'fas fa-check';

        setTimeout(function () {
            document.getElementById('downloadOverlay').style.display = 'none';
            modal.classList.remove('download-success');
            modal.querySelector('.download-title').textContent = 'Generando Backup';
            modal.querySelector('.download-subtitle').textContent = 'Estamos armando el archivo de sincronizacion manual...';
            modal.querySelector('.download-status').textContent = 'Procesando pacientes, agenda, citas e historias clinicas';
            modal.querySelector('.download-icon-container i').className = 'fas fa-file-export';
        }, 1800);
    }, 2600);
});
</script>