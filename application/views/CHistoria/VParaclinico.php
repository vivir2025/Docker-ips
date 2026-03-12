<style>
.paraclinico-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 0 20px;
}

.paraclinico-header {
    text-align: center;
    margin-bottom: 40px;
}

.paraclinico-header h2 {
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin: 0 0 10px;
}

.paraclinico-header p {
    color: rgba(255, 255, 255, 0.85);
    font-size: 15px;
}

.upload-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(15, 93, 82, 0.12);
}

.upload-zone {
    position: relative;
    border: 2px dashed #0f5d52;
    border-radius: 16px;
    padding: 40px;
    text-align: center;
    background: linear-gradient(135deg, #f8fffe 0%, #eef7f5 100%);
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.upload-zone.dragover {
    border-color: #0ca678;
    background: linear-gradient(135deg, #ecfdf8 0%, #d0f3ea 100%);
    box-shadow: 0 0 0 4px rgba(12, 166, 120, 0.15);
}

.upload-icon {
    font-size: 56px;
    color: #0f5d52;
    animation: float 3s ease-in-out infinite;
}

.upload-zone.dragover .upload-icon {
    animation: float 0.6s ease-in-out;
    color: #0ca678;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.upload-text {
    line-height: 1.6;
}

.upload-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f5d52;
    margin: 0;
}

.upload-subtitle {
    font-size: 14px;
    color: #557073;
    margin: 0;
}

#uploadFile {
    display: none;
}

.file-input-label {
    user-select: none;
}

.upload-status {
    display: none;
    margin-top: 20px;
    padding: 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.file-info {
    display: none;
    background: #f5f9f8;
    border-radius: 12px;
    padding: 16px;
    margin-top: 20px;
    border-left: 4px solid #0f5d52;
}

.file-info-row {
    display: flex;
    justify-content: space-between;
    margin: 8px 0;
    font-size: 14px;
}

.file-info-label {
    color: #557073;
    font-weight: 600;
}

.file-info-value {
    color: #0f5d52;
    word-break: break-word;
    text-align: right;
    flex: 1;
    margin-left: 12px;
}

.progress-container {
    display: none;
    margin-top: 24px;
}

.progress-label {
    font-size: 13px;
    font-weight: 600;
    color: #0f5d52;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.progress-bar-wrapper {
    background: #e6f4f0;
    border-radius: 10px;
    overflow: hidden;
    height: 8px;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #0f5d52 0%, #0ca678 100%);
    width: 0%;
    transition: width 0.2s ease;
    border-radius: 10px;
}

.upload-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    justify-content: center;
}

.btn-upload-main {
    background: linear-gradient(135deg, #0f5d52 0%, #0ca678 100%);
    border: none;
    color: white;
    padding: 13px 36px;
    border-radius: 28px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(15, 93, 82, 0.25);
    display: none;
}

.btn-upload-main:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(15, 93, 82, 0.35);
}

.btn-upload-main:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-clear {
    background: #e6f4f0;
    border: none;
    color: #0f5d52;
    padding: 13px 28px;
    border-radius: 28px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: none;
}

.btn-clear:hover {
    background: #d0f3ea;
}

/* Modal de resultado */
.result-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(15, 33, 56, 0.85);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.result-modal {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 22px;
    padding: 48px;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
    min-width: 380px;
    animation: zoomIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.result-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    animation: scaleIn 0.5s ease;
}

.result-icon.success {
    background: linear-gradient(135deg, #0ca678 0%, #51cf66 100%);
}

.result-icon.error {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
}

.result-title {
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 12px;
}

.result-title.success {
    color: #0ca678;
}

.result-title.error {
    color: #e53e3e;
}

.result-message {
    font-size: 15px;
    color: #557073;
    margin: 0 0 28px;
    line-height: 1.6;
}

.btn-close-modal {
    background: linear-gradient(135deg, #0f5d52 0%, #0ca678 100%);
    border: none;
    color: white;
    padding: 12px 32px;
    border-radius: 26px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-close-modal:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(15, 93, 82, 0.3);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    from {
        transform: translate(-50%, -50%) scale(0.6);
        opacity: 0;
    }
    to {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
}

@keyframes scaleIn {
    from { transform: scale(0.5); }
    to { transform: scale(1); }
}

@media (max-width: 600px) {
    .paraclinico-container {
        padding: 0 12px;
    }

    .upload-card {
        padding: 24px;
    }

    .upload-zone {
        padding: 24px;
        min-height: 160px;
    }

    .result-modal {
        min-width: auto;
        width: calc(100% - 30px);
        padding: 32px;
    }
}
</style>

<div class="paraclinico-container">
    <div class="paraclinico-header">
        <h2>Cargar Paraclinicos</h2>
        <p>Sube tu archivo Excel con los datos de laboratorios para procesarlos en el sistema</p>
    </div>

    <div class="upload-card">
        <form id="form-upload-user" method="post" enctype="multipart/form-data">
            <div class="upload-zone" id="uploadZone">
                <div class="file-input-label">
                    <div class="upload-icon">📋</div>
                    <div class="upload-text">
                        <p class="upload-title">Arrastra tu archivo aquí</p>
                        <p class="upload-subtitle">o haz clic para seleccionar (xlsx)</p>
                    </div>
                </div>
                <input type="file" name="uploadFile" id="uploadFile" accept=".xlsx">
            </div>

            <div class="file-info" id="fileInfo">
                <div class="file-info-row">
                    <span class="file-info-label">Archivo:</span>
                    <span class="file-info-value" id="fileName">-</span>
                </div>
                <div class="file-info-row">
                    <span class="file-info-label">Tamaño:</span>
                    <span class="file-info-value" id="fileSize">-</span>
                </div>
                <div class="file-info-row">
                    <span class="file-info-label">Estado:</span>
                    <span class="file-info-value" id="fileStatus">Listo para cargar</span>
                </div>
            </div>

            <div class="progress-container" id="progressContainer">
                <div class="progress-label">
                    <span>Progreso de carga</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill" id="progressFill"></div>
                </div>
            </div>

            <div class="upload-actions">
                <button type="button" class="btn-upload-main" id="btnUpload">
                    <i class="fas fa-cloud-upload-alt"></i> Cargar archivo
                </button>
                <button type="button" class="btn-clear" id="btnClear">
                    <i class="fas fa-times"></i> Limpiar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="result-overlay" id="resultOverlay">
    <div class="result-modal" id="resultModal">
        <div class="result-icon success" id="resultIcon">
            <i class="fas fa-check"></i>
        </div>
        <h3 class="result-title success" id="resultTitle">Éxito</h3>
        <p class="result-message" id="resultMessage">El archivo se ha cargado correctamente</p>
        <button type="button" class="btn-close-modal" id="btnCloseResult">
            <i class="fas fa-check-circle"></i> Entendido
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadZone = document.getElementById('uploadZone');
    const uploadInput = document.getElementById('uploadFile');
    const btnUpload = document.getElementById('btnUpload');
    const btnClear = document.getElementById('btnClear');
    const fileInfo = document.getElementById('fileInfo');
    const progressContainer = document.getElementById('progressContainer');
    const resultOverlay = document.getElementById('resultOverlay');
    const resultModal = document.getElementById('resultModal');
    const btnCloseResult = document.getElementById('btnCloseResult');

    const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
    const ALLOWED_EXTENSIONS = ['xlsx', 'xls', 'csv'];

    let selectedFile = null;

    // Validar extensión del archivo
    function validateFile(file) {
        const ext = file.name.split('.').pop().toLowerCase();
        
        if (!ALLOWED_EXTENSIONS.includes(ext)) {
            showResult(false, 'Tipo de archivo no permitido', 'Solo se aceptan archivos Excel (.xlsx, .xls) y CSV');
            return false;
        }

        if (file.size > MAX_FILE_SIZE) {
            showResult(false, 'Archivo demasiado grande', 'El archivo no puede exceder 10 MB');
            return false;
        }

        return true;
    }

    // Formatear tamaño de archivo
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    }

    // Mostrar info del archivo
    function displayFileInfo(file) {
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = formatFileSize(file.size);
        document.getElementById('fileStatus').textContent = 'Listo para cargar';
        fileInfo.style.display = 'block';
        btnUpload.style.display = 'inline-block';
        btnClear.style.display = 'inline-block';
    }

    // Zona drag & drop
    uploadZone.addEventListener('click', () => uploadInput.click());

    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            uploadInput.files = files;
            selectedFile = files[0];
            
            if (validateFile(selectedFile)) {
                displayFileInfo(selectedFile);
            }
        }
    });

    // Seleccionar archivo
    uploadInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            selectedFile = e.target.files[0];
            
            if (validateFile(selectedFile)) {
                displayFileInfo(selectedFile);
            }
        }
    });

    // Limpiar selección
    btnClear.addEventListener('click', () => {
        uploadInput.value = '';
        selectedFile = null;
        fileInfo.style.display = 'none';
        progressContainer.style.display = 'none';
        btnUpload.style.display = 'none';
        btnClear.style.display = 'none';
        uploadZone.classList.remove('dragover');
    });

    // Cargar archivo
    btnUpload.addEventListener('click', () => {
        if (!selectedFile) {
            showResult(false, 'Sin archivo', 'Por favor selecciona un archivo antes de cargar');
            return;
        }

        const formData = new FormData();
        formData.append('uploadFile', selectedFile);
        formData.append('idHistoria', document.getElementById('idHistoria')?.value || '');

        btnUpload.disabled = true;
        progressContainer.style.display = 'block';
        document.getElementById('fileStatus').textContent = 'Cargando...';

        const xhr = new XMLHttpRequest();

        // Monitorear progreso
        xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                document.getElementById('progressFill').style.width = percent + '%';
                document.getElementById('progressPercent').textContent = percent + '%';
            }
        });

        xhr.addEventListener('load', () => {
            btnUpload.disabled = false;

            try {
                // Log de debug (ver en console)
                console.log('Response:', xhr.responseText);
                
                const result = JSON.parse(xhr.responseText);
                
                if (result.success === true) {
                    document.getElementById('fileStatus').textContent = '✓ Cargado correctamente';
                    showResult(true, '¡Archivo cargado!', result.message || 'Los datos paraclinicos se han guardado correctamente en el sistema');
                    
                    // Resetear después de 2 segundos
                    setTimeout(() => {
                        btnClear.click();
                    }, 2000);
                } else {
                    document.getElementById('fileStatus').textContent = 'Error al procesar';
                    let errorMsg = result.message || 'No se pudo procesar el archivo Excel';
                    
                    // Si hay debug info, añadirlo al mensaje
                    if (result.debug) {
                        console.log('Debug info:', result.debug);
                        errorMsg += '\n\nDetalles: Ver console (F12) para info técnica';
                    }
                    
                    showResult(false, 'Error al procesar', errorMsg);
                }
            } catch (e) {
                console.error('Parse error:', e);
                console.error('Raw response:', xhr.responseText);
                document.getElementById('fileStatus').textContent = 'Error en la respuesta';
                
                // Mostrar qué recibimos
                let errorShow = 'Respuesta inválida del servidor.\n\nQué recibimos:\n' + xhr.responseText.substring(0, 200);
                showResult(false, 'Error de formato', errorShow);
            }
        });

        xhr.addEventListener('error', () => {
            btnUpload.disabled = false;
            document.getElementById('fileStatus').textContent = 'Error de conexión';
            showResult(false, 'Error de conexión', 'No se pudo conectar con el servidor');
        });

        xhr.open('POST', '<?php echo base_url() . 'index.php/CHistoria/importar_excel1'; ?>', true);
        xhr.send(formData);
    });

    // Mostrar resultado
    function showResult(success, title, message) {
        const resultIcon = document.getElementById('resultIcon');
        const resultTitle = document.getElementById('resultTitle');
        const resultMessage = document.getElementById('resultMessage');

        if (success) {
            resultIcon.className = 'result-icon success';
            resultIcon.innerHTML = '<i class="fas fa-check"></i>';
            resultTitle.className = 'result-title success';
            resultTitle.textContent = title;
        } else {
            resultIcon.className = 'result-icon error';
            resultIcon.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
            resultTitle.className = 'result-title error';
            resultTitle.textContent = title;
        }

        resultMessage.textContent = message;
        resultOverlay.style.display = 'block';
    }

    // Cerrar modal de resultado
    btnCloseResult.addEventListener('click', () => {
        resultOverlay.style.display = 'none';
    });

    resultOverlay.addEventListener('click', (e) => {
        if (e.target === resultOverlay) {
            resultOverlay.style.display = 'none';
        }
    });
});
</script>
