# 👤 Persona del Proyecto — Sistema IPS Cajibío

## Visión

Sistema de gestión clínica para IPS (Institución Prestadora de Salud) en Colombia.
La prioridad absoluta es la **integridad, trazabilidad y conservación** de la Historia Clínica.
Ningún dato médico puede destruirse — todo cambio debe quedar auditado.

## Contexto del Equipo

- **Dominio:** Salud pública colombiana — atención primaria, visitas domiciliarias, brigadas de salud
- **Entorno de trabajo:** Windows 11, Docker Desktop, Visual Studio Code, PowerShell
- **Stack técnico:** CodeIgniter 3, PHP 8.0, MySQL 8.0, Apache, Nginx (reverse proxy)
- **Repositorio:** https://github.com/vivir2025/Docker-ips.git (rama `main`)
- **Ruta local:** `c:\docker\cajibio`

## Sedes en operación

| Sede | Contenedor | Ruta web |
|---|---|---|
| Cajibío | `cajibio_app` | `http://localhost/cajibio/` |
| Piéndamo | `piendamo_app` | `http://localhost/piendamo/` |
| Morales | `morales_app` | `http://localhost/morales/` |

## Valores de diseño

1. **Integridad médica primero** — La HC es un documento legal. No se borra, no se altera sin trazabilidad.
2. **Cumplimiento normativo** — Resolución 1995/1999 MinSalud · Ley 23/1981 · Ley 100/1993.
3. **Trazabilidad total** — Toda operación CREATE/UPDATE/DELETE queda registrada en `auditoria_hc` con usuario, IP y timestamp.
4. **SoftDelete obligatorio** — `deleted_at` marca la eliminación lógica. `DELETE` físico está prohibido en tablas médicas.
5. **Evolución sin rotura** — Los cambios de modelo deben ser retrocompatibles con los controladores existentes.

## Módulos del sistema

| Módulo | Controlador | Descripción |
|---|---|---|
| Autenticación | `CLogin` | Login/sesión de usuarios |
| Pacientes | `CPaciente` | CRUD de pacientes |
| Agenda | `CAgenda` | Programación de citas con verificación de traslapes |
| Historia Clínica | `CHistoria` | HC con SoftDelete + Audit Trail |
| Historial | `CHistorial` | Consulta de HC por paciente y estado |
| Citas | `CCita` | Gestión de citas médicas |
| Facturación | `CFactura` | Facturación y CUPS contratados |
| RIPS | `CRips` | Reportes RIPS (normativa Colombia) |
| Contratos | `CContrato` | Contratos con empresas/aseguradoras |
| Informes | `CInforme` | Reportes y estadísticas |
| Backup | `CBackup` | Respaldo de datos |

## Base de datos

- **Motor:** MySQL 8.0 · charset `utf8mb4`
- **Base:** `ips`
- **Host dentro de Docker:** `db` (service name, no `localhost`)
- **Credenciales:** variables de entorno en `.env` (nunca hardcodeadas)
- **Auditoría:** tabla `auditoria_hc` — inmutable, nunca truncar

## Convenciones de código

```
Controladores: C{Entidad}.php     (ej: CHistoria.php)
Modelos:       M{Entidad}.php     (ej: MHistoria.php)
Vistas:        V{Entidad}.php     (ej: VHistoria.php)
Modelos médicos: extienden MY_Model (NO CI_Model)