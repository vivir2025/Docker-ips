-- =============================================================================
-- MIGRACIÓN: SoftDelete + Audit Trail para Historia Clínica
-- =============================================================================
-- Cumplimiento legal: Resolución 1995/1999 MinSalud Colombia
--   Art. 15 — Retención y tiempo de conservación (mínimo 20 años)
--   Art. 14 — Confidencialidad e integridad de la HC
--   Ley 23 de 1981 — Ética Médica (Art. 34-40)
--
-- PRINCIPIO: Ningún registro de HC puede ser destruido.
--            Todo cambio queda registrado con usuario, IP y timestamp.
-- =============================================================================

USE `ips`;

-- =============================================================================
-- 1. TABLA CENTRAL DE AUDITORÍA — Stack de versiones
-- =============================================================================
-- Cada fila = una versión del registro en ese momento exacto.
-- datos_antes y datos_despues contienen el JSON completo del registro.
-- Esto permite reconstruir cualquier HC en cualquier punto del tiempo.

CREATE TABLE IF NOT EXISTS `auditoria_hc` (
    `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tabla`          VARCHAR(100)    NOT NULL COMMENT 'Tabla afectada',
    `id_registro`    BIGINT          NOT NULL COMMENT 'PK del registro afectado',
    `accion`         ENUM('CREATE','UPDATE','DELETE','RESTORE') NOT NULL,
    `usuario_id`     INT             NULL     COMMENT 'FK usuario que realizó la acción',
    `usuario_label`  VARCHAR(150)    NULL     COMMENT 'Email o nombre del usuario (desnormalizado para trazabilidad)',
    `usuario_ip`     VARCHAR(45)     NULL     COMMENT 'IP del cliente (IPv4 o IPv6)',
    `datos_antes`    LONGTEXT        NULL     COMMENT 'Snapshot JSON del registro ANTES del cambio',
    `datos_despues`  LONGTEXT        NULL     COMMENT 'Snapshot JSON del registro DESPUÉS del cambio',
    `created_at`     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    INDEX `idx_tabla_registro` (`tabla`, `id_registro`),
    INDEX `idx_usuario_id`     (`usuario_id`),
    INDEX `idx_accion`         (`accion`),
    INDEX `idx_created_at`     (`created_at`),
    INDEX `idx_tabla_fecha`    (`tabla`, `created_at`)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Audit trail inmutable de Historia Clínica — NO MODIFICAR NI TRUNCAR';


-- =============================================================================
-- 2. COLUMNAS DE SOFTDELETE Y TRAZABILIDAD EN TABLAS DE HC
-- =============================================================================
-- Patrón aplicado a cada tabla:
--   created_by  INT NULL  — quién creó el registro
--   updated_at  DATETIME  — cuándo fue la última modificación
--   updated_by  INT NULL  — quién hizo la última modificación
--   deleted_at  DATETIME  — NULL = activo, NOT NULL = eliminado lógicamente
--   deleted_by  INT NULL  — quién solicitó la eliminación lógica
-- =============================================================================

-- -----------------------------------------------------------------------
-- Tabla: hc  (Historia Clínica principal)
-- -----------------------------------------------------------------------
ALTER TABLE `hc`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL COMMENT 'Usuario creador' AFTER `hcFecha`,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL COMMENT 'Última modificación',
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL COMMENT 'Usuario última modificación',
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL COMMENT 'SoftDelete: fecha de eliminación lógica',
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL COMMENT 'SoftDelete: usuario que eliminó';

-- -----------------------------------------------------------------------
-- Tabla: historia  (HC alternativa / encabezado)
-- -----------------------------------------------------------------------
ALTER TABLE `historia`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: historia_medicamento
-- -----------------------------------------------------------------------
ALTER TABLE `historia_medicamento`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: historia_diagnostico
-- -----------------------------------------------------------------------
ALTER TABLE `historia_diagnostico`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: historia_cups
-- -----------------------------------------------------------------------
ALTER TABLE `historia_cups`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: hc_complementaria
-- -----------------------------------------------------------------------
ALTER TABLE `hc_complementaria`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: hcs_paraclinico  (resultados de paraclínicos)
-- -----------------------------------------------------------------------
ALTER TABLE `hcs_paraclinico`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: hcs_visitas
-- -----------------------------------------------------------------------
ALTER TABLE `hcs_visitas`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: cita  (citas médicas — relacionada con HC)
-- -----------------------------------------------------------------------
ALTER TABLE `cita`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;

-- -----------------------------------------------------------------------
-- Tabla: paciente
-- -----------------------------------------------------------------------
ALTER TABLE `paciente`
    ADD COLUMN IF NOT EXISTS `created_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT          NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME     NULL DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `deleted_by` INT          NULL DEFAULT NULL;


-- =============================================================================
-- 3. ÍNDICES ADICIONALES para consultas de registros activos
-- =============================================================================
-- El filtro WHERE deleted_at IS NULL es el más frecuente en la app.
-- Estos índices lo hacen O(log n) en lugar de full-table scan.

-- Índice en hc
ALTER TABLE `hc`
    ADD INDEX IF NOT EXISTS `idx_hc_activo` (`deleted_at`);

-- Índice en historia_medicamento
ALTER TABLE `historia_medicamento`
    ADD INDEX IF NOT EXISTS `idx_his_med_activo` (`deleted_at`);

-- Índice en historia_diagnostico
ALTER TABLE `historia_diagnostico`
    ADD INDEX IF NOT EXISTS `idx_his_dx_activo` (`deleted_at`);

-- Índice en cita
ALTER TABLE `cita`
    ADD INDEX IF NOT EXISTS `idx_cita_activo` (`deleted_at`);

-- Índice en paciente
ALTER TABLE `paciente`
    ADD INDEX IF NOT EXISTS `idx_paciente_activo` (`deleted_at`);


-- =============================================================================
-- 4. VISTA: hc_activa  — Solo HCs no eliminadas (uso cotidiano en la app)
-- =============================================================================
CREATE OR REPLACE VIEW `hc_activa` AS
    SELECT * FROM `hc`
    WHERE `deleted_at` IS NULL;


-- =============================================================================
-- 5. VISTA: auditoria_hc_legible — Audit trail con datos decodificados
-- =============================================================================
CREATE OR REPLACE VIEW `v_auditoria_hc` AS
    SELECT
        a.id,
        a.tabla,
        a.id_registro,
        a.accion,
        a.usuario_label,
        a.usuario_ip,
        a.created_at        AS fecha_accion,
        u.usuNombre         AS nombre_usuario,
        a.datos_antes,
        a.datos_despues
    FROM `auditoria_hc` a
    LEFT JOIN `usuario` u ON u.idUsuario = a.usuario_id
    ORDER BY a.created_at DESC;


-- =============================================================================
-- Confirmación
-- =============================================================================
SELECT CONCAT(
    '✅ Migración SoftDelete + Audit Trail aplicada. ',
    'Tabla auditoria_hc creada. ',
    'Columnas deleted_at/deleted_by/updated_at/updated_by/created_by ',
    'agregadas a tablas de HC.'
) AS Estado;