-- SISOCS local compatibility schema
--
-- The upstream repository contains application code but no recoverable SISOCS
-- disclosure dump or full application schema. This file is therefore a local,
-- synthetic compatibility schema derived from the model definitions, queries,
-- and OCDS mapper in this repository. It is not a production database dump.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS sisocs_local_metadata (
    id TINYINT UNSIGNED NOT NULL,
    marker VARCHAR(100) NOT NULL,
    schema_version VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO sisocs_local_metadata (id, marker, schema_version) VALUES
    (1, 'sisocs-local-demo-v1', '1')
ON DUPLICATE KEY UPDATE marker = VALUES(marker), schema_version = VALUES(schema_version);

CREATE TABLE IF NOT EXISTS pcounter_users (
    user_ip VARCHAR(255) NOT NULL,
    user_time INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (user_ip)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pcounter_save (
    save_name VARCHAR(10) NOT NULL,
    save_value INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (save_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pcounter_save (save_name, save_value) VALUES
    ('day_time', 0), ('counter', 0), ('yesterday', 0),
    ('max_count', 0), ('max_time', 0)
ON DUPLICATE KEY UPDATE save_value = VALUES(save_value);

CREATE TABLE IF NOT EXISTS cs_sector (
    idSector INT NOT NULL AUTO_INCREMENT,
    sector VARCHAR(150) NOT NULL,
    PRIMARY KEY (idSector), UNIQUE KEY uq_sector (sector)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_subsector (
    idSubSector INT NOT NULL AUTO_INCREMENT,
    idSector INT NOT NULL,
    subsector VARCHAR(150) NOT NULL,
    PRIMARY KEY (idSubSector), KEY ix_subsector_sector (idSector)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_entes (
    idEnte INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(255) NOT NULL,
    uri VARCHAR(500) NULL,
    PRIMARY KEY (idEnte)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_entes_unidad (
    idUnidad INT NOT NULL AUTO_INCREMENT,
    idEnte INT NULL,
    descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (idUnidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_funcionarios (
    idFuncionario INT NOT NULL AUTO_INCREMENT,
    idEnte INT NULL,
    idUnidad INT NULL,
    nombre VARCHAR(255) NOT NULL,
    puesto VARCHAR(255) NULL,
    telefono VARCHAR(100) NULL,
    correo VARCHAR(255) NULL,
    PRIMARY KEY (idFuncionario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_rol (
    idRol INT NOT NULL AUTO_INCREMENT,
    rol VARCHAR(150) NOT NULL,
    PRIMARY KEY (idRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_departamento (
    idDepartamento INT NOT NULL AUTO_INCREMENT,
    departamento VARCHAR(150) NOT NULL,
    codigo VARCHAR(30) NULL,
    PRIMARY KEY (idDepartamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_municipio (
    idMunicipio INT NOT NULL AUTO_INCREMENT,
    idDepartamento INT NOT NULL,
    municipio VARCHAR(150) NOT NULL,
    PRIMARY KEY (idMunicipio), KEY ix_municipio_departamento (idDepartamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_region (
    idRegion INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(150) NOT NULL,
    PRIMARY KEY (idRegion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_tipocontrato (
    idTipoContrato INT NOT NULL AUTO_INCREMENT,
    contrato VARCHAR(150) NOT NULL,
    PRIMARY KEY (idTipoContrato)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_metodo (
    idMetodo INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NULL,
    adquisicion VARCHAR(150) NULL,
    siglas VARCHAR(10) NULL,
    PRIMARY KEY (idMetodo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_metodo_adjudicacion (
    idMetodoAdjudicacion INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    PRIMARY KEY (idMetodoAdjudicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_tipo_garantias (
    idTipoGarantia INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    PRIMARY KEY (idTipoGarantia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_proposito (
    idProposito INT NOT NULL AUTO_INCREMENT,
    proposito VARCHAR(255) NOT NULL,
    PRIMARY KEY (idProposito)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_estado (
    estado VARCHAR(25) NOT NULL,
    PRIMARY KEY (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_fuentesfinan (
    idFuente INT NOT NULL AUTO_INCREMENT,
    fuente VARCHAR(255) NOT NULL,
    PRIMARY KEY (idFuente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_currency (
    idCurrency INT NOT NULL AUTO_INCREMENT,
    moneda VARCHAR(80) NOT NULL,
    code VARCHAR(10) NULL,
    PRIMARY KEY (idCurrency)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_monedas (
    idMoneda INT NOT NULL AUTO_INCREMENT,
    moneda VARCHAR(80) NOT NULL,
    PRIMARY KEY (idMoneda)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_proyecto (
    idProyecto INT NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(30) NOT NULL,
    nombre_proyecto VARCHAR(2000) NOT NULL,
    proposito TEXT NULL,
    descrip TEXT NULL,
    idSector INT NULL,
    idSubSector INT NULL,
    idEnte INT NULL,
    idUnidad INT NULL,
    idFuncionario INT NULL,
    idRol INT NULL,
    idPrograma INT NULL,
    idRegion INT NULL,
    presupuesto DECIMAL(20,2) NULL,
    fechaaprob DATETIME NULL,
    codsefin VARCHAR(50) NULL,
    descambiental TEXT NULL,
    descreasentamiento TEXT NULL,
    especiplano VARCHAR(500) NULL,
    presuprogra VARCHAR(500) NULL,
    estudiofact VARCHAR(500) NULL,
    estudioimpact VARCHAR(500) NULL,
    licambi VARCHAR(500) NULL,
    planreasea VARCHAR(500) NULL,
    acuerdofinan VARCHAR(500) NULL,
    notaprioridad VARCHAR(500) NULL,
    constanciabanco VARCHAR(500) NULL,
    otro VARCHAR(500) NULL,
    lat1 DECIMAL(12,8) NULL,
    lon1 DECIMAL(12,8) NULL,
    lat2 DECIMAL(12,8) NULL,
    lon2 DECIMAL(12,8) NULL,
    estado VARCHAR(25) NOT NULL DEFAULT 'BORRADOR',
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    fecha_recepcion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    eje INT NULL,
    PRIMARY KEY (idProyecto), UNIQUE KEY uq_proyecto_codigo (codigo), KEY ix_proyecto_estado (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_proyecto_municipio (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    idMunicipio INT NULL,
    idDepartamento INT NULL,
    beneficio TEXT NULL,
    estado VARCHAR(25) NULL,
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    PRIMARY KEY (id), KEY ix_pm_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_proyecto_fuente (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    idFuente INT NULL,
    idMoneda INT NULL,
    programa VARCHAR(255) NULL,
    fuente VARCHAR(255) NULL,
    monto DECIMAL(20,2) NULL,
    moneda VARCHAR(80) NULL,
    tasa_cambio DECIMAL(20,6) NULL,
    tasacambio DECIMAL(20,6) NULL,
    fecha DATETIME NULL,
    estado VARCHAR(25) NULL,
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    PRIMARY KEY (id), KEY ix_pf_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_parties (
    id INT NOT NULL AUTO_INCREMENT,
    legalName VARCHAR(500) NOT NULL,
    uri VARCHAR(500) NULL,
    identifier VARCHAR(255) NULL,
    scheme VARCHAR(80) NULL,
    streetAddress VARCHAR(500) NULL,
    locality VARCHAR(150) NULL,
    region VARCHAR(150) NULL,
    countryName VARCHAR(150) NULL,
    contactPoint_name VARCHAR(255) NULL,
    contactPoint_email VARCHAR(255) NULL,
    contactPoint_telephone VARCHAR(100) NULL,
    roles VARCHAR(255) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_calificacion (
    idCalificacion INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    numproceso VARCHAR(100) NULL,
    nomprocesoproyecto VARCHAR(2000) NULL,
    idEnte INT NULL,
    idUnidad INT NULL,
    idFuncionario INT NULL,
    idRol INT NULL,
    proceseval VARCHAR(255) NULL,
    invitainter VARCHAR(500) NULL,
    basespreca VARCHAR(500) NULL,
    resolucion VARCHAR(500) NULL,
    convocainvi VARCHAR(500) NULL,
    tdr VARCHAR(500) NULL,
    aclaraciones VARCHAR(500) NULL,
    actarecpcion VARCHAR(500) NULL,
    tipocontrato VARCHAR(150) NULL,
    idTipoContrato INT NULL,
    idMetodo INT NULL,
    estado VARCHAR(25) NOT NULL DEFAULT 'BORRADOR',
    otro VARCHAR(500) NULL,
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    fecha_recepcion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    contract_startDate DATETIME NULL,
    award_startDate DATETIME NULL,
    enquiry_startDate DATETIME NULL,
    tender_startDate DATETIME NULL,
    contract_endDate DATETIME NULL,
    award_endDate DATETIME NULL,
    enquiry_endDate DATETIME NULL,
    tender_endDate DATETIME NULL,
    contract_maxExtentDate DATETIME NULL,
    award_maxExtentDate DATETIME NULL,
    enquiry_maxExtentDate DATETIME NULL,
    tender_maxExtentDate DATETIME NULL,
    contract_durationInDays INT NULL,
    award_durationInDays INT NULL,
    enquiry_durationInDays INT NULL,
    tender_durationInDays INT NULL,
    PRIMARY KEY (idCalificacion), KEY ix_cal_project (idProyecto), KEY ix_cal_state (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_calificacion_oferente (
    id INT NOT NULL AUTO_INCREMENT,
    idCalificacion INT NOT NULL,
    idOferente INT NOT NULL,
    estado VARCHAR(25) NULL,
    PRIMARY KEY (id), KEY ix_cal_offer (idCalificacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_oferente (
    idOferente INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(500) NULL,
    idParty INT NULL,
    PRIMARY KEY (idOferente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_adjudicacion (
    idAdjudicacion INT NOT NULL AUTO_INCREMENT,
    idCalificacion INT NOT NULL,
    numproceso VARCHAR(100) NULL,
    nparticipantes INT NULL,
    costoesti DECIMAL(20,2) NULL,
    actaaper VARCHAR(500) NULL,
    informeacta VARCHAR(500) NULL,
    resoladju VARCHAR(500) NULL,
    estado VARCHAR(25) NOT NULL DEFAULT 'BORRADOR',
    otro VARCHAR(500) NULL,
    fechapublicado DATETIME NULL,
    fechacreacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    idMetodoAdjudicacion INT NULL,
    PRIMARY KEY (idAdjudicacion), KEY ix_award_cal (idCalificacion), KEY ix_award_state (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contratacion (
    idContratacion INT NOT NULL AUTO_INCREMENT,
    idAdjudicacion INT NOT NULL,
    idEntidad INT NULL,
    idoferente INT NULL,
    precioLPS DECIMAL(20,2) NULL,
    precioUSD DECIMAL(20,2) NULL,
    precio DECIMAL(20,2) NULL,
    alcances TEXT NULL,
    fechainicio DATE NULL,
    fechafinal DATE NULL,
    duracioncontrato INT NULL,
    documentocontra VARCHAR(500) NULL,
    regante VARCHAR(500) NULL,
    espeplanos VARCHAR(500) NULL,
    estado VARCHAR(25) NOT NULL DEFAULT 'BORRADOR',
    otro VARCHAR(500) NULL,
    ncontrato VARCHAR(150) NULL,
    titulocontrato VARCHAR(1000) NULL,
    primario TINYINT(1) NOT NULL DEFAULT 1,
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    fecharecibido DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    PRIMARY KEY (idContratacion), KEY ix_contract_award (idAdjudicacion), KEY ix_contract_state (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_preferredBidders (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    parties_id INT NOT NULL,
    parties_name VARCHAR(500) NULL,
    PRIMARY KEY (id), KEY ix_preferred_contract (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_inicio_ejecucion (
    idInicioEjecucion INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    idContacto INT NULL,
    fecha_inicio DATE NULL,
    programainicial VARCHAR(500) NULL,
    estado VARCHAR(25) NOT NULL DEFAULT 'BORRADOR',
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    codigo VARCHAR(100) NULL,
    geo_latitud DECIMAL(12,8) NULL,
    geo_longitud DECIMAL(12,8) NULL,
    geo_lati_final DECIMAL(12,8) NULL,
    geo_long_final DECIMAL(12,8) NULL,
    imagen VARCHAR(500) NULL,
    PRIMARY KEY (idInicioEjecucion), KEY ix_exec_contract (idContratacion), KEY ix_exec_state (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contactos (
    idContacto INT NOT NULL AUTO_INCREMENT,
    Nombres VARCHAR(255) NULL,
    direccion VARCHAR(500) NULL,
    telefono VARCHAR(100) NULL,
    movil VARCHAR(100) NULL,
    email VARCHAR(255) NULL,
    PRIMARY KEY (idContacto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_document_types (
    idDocumentType INT NOT NULL AUTO_INCREMENT,
    code VARCHAR(150) NOT NULL,
    title VARCHAR(150) NOT NULL,
    description VARCHAR(1000) NULL,
    PRIMARY KEY (idDocumentType),
    UNIQUE KEY uq_document_type_code (code),
    UNIQUE KEY uq_document_type_title (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_planning_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_plan_doc_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_planning_milestone (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    dueDate DATETIME NULL,
    dateMet DATETIME NULL,
    PRIMARY KEY (id), KEY ix_plan_milestone_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_tender_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idCalificacion INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_tender_doc_cal (idCalificacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_award_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idAdjudicacion INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_award_doc_award (idAdjudicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contract_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_contract_doc_contract (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_implementation_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_impl_doc_exec (idInicioEjecucion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_advance_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idAvance INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_advance_doc_advance (idAvance)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contracts_signatories (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    parties_id INT NOT NULL,
    parties_name VARCHAR(500) NULL,
    PRIMARY KEY (id), KEY ix_signatory_contract (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contracts_organization_details (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    parties_id INT NOT NULL,
    PRIMARY KEY (id), KEY ix_org_contract (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contracts_milestone (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    dueDate DATETIME NULL,
    dateMet DATETIME NULL,
    PRIMARY KEY (id), KEY ix_contract_milestone (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contratos (
    idContratos INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    nmodifica INT NULL,
    fecha DATETIME NULL,
    tipomodifica VARCHAR(255) NULL,
    justimodcontrato TEXT NULL,
    precioactual DECIMAL(20,2) NULL,
    fechatercontra DATE NULL,
    justificacion_fechatercontra TEXT NULL,
    alcanceactucontrato TEXT NULL,
    adendas VARCHAR(500) NULL,
    prograactu VARCHAR(500) NULL,
    prograini VARCHAR(500) NULL,
    estado VARCHAR(25) NULL,
    otro VARCHAR(500) NULL,
    fecha_creacion DATETIME NULL,
    fecha_publicacion DATETIME NULL,
    usuario_creacion INT NULL,
    usuario_publicacion INT NULL,
    PRIMARY KEY (idContratos), KEY ix_contratos_contract (idContratacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_contratos_documents (
    id INT NOT NULL AUTO_INCREMENT,
    idContrato INT NOT NULL,
    documentType VARCHAR(100) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    url VARCHAR(1000) NULL,
    pageStart INT NULL,
    pageEnd INT NULL,
    datePublished DATETIME NULL,
    dateModified DATETIME NULL,
    accessDetails TEXT NULL,
    PRIMARY KEY (id), KEY ix_contratos_doc (idContrato)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_budgetBreakdown (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    description TEXT NULL,
    sourceParty_id INT NULL,
    sourceParty_name VARCHAR(500) NULL,
    amount DECIMAL(20,2) NULL,
    currency VARCHAR(20) NULL,
    startDate DATE NULL,
    endDate DATE NULL,
    PRIMARY KEY (id), KEY ix_budget_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_prequalification (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    startDate DATETIME NULL,
    endDate DATETIME NULL,
    durationInDays INT NULL,
    enquiryPeriod_startDate DATETIME NULL,
    enquiryPeriod_endDate DATETIME NULL,
    qualificationPeriod_startDate DATETIME NULL,
    qualificationPeriod_endDate DATETIME NULL,
    eligibilityCriteria TEXT NULL,
    PRIMARY KEY (id), KEY ix_prequal_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_forecast (
    id INT NOT NULL AUTO_INCREMENT,
    idProyecto INT NOT NULL,
    title VARCHAR(500) NULL,
    unidad VARCHAR(100) NULL,
    medida DECIMAL(20,4) NULL,
    PRIMARY KEY (id), KEY ix_forecast_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_forecast_observations (
    id INT NOT NULL AUTO_INCREMENT,
    forecast_id INT NOT NULL,
    obs_notes TEXT NULL,
    obs_amount DECIMAL(20,4) NULL,
    obs_currency VARCHAR(20) NULL,
    PRIMARY KEY (id), KEY ix_forecast_observation (forecast_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_implementation_milestone (
    id INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    dueDate DATETIME NULL,
    dateMet DATETIME NULL,
    PRIMARY KEY (id), KEY ix_impl_milestone (idInicioEjecucion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_avances (
    idAvances INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    idContratacion INT NULL,
    porcent_programado DECIMAL(7,2) NULL,
    porcent_real DECIMAL(7,2) NULL,
    finan_programado DECIMAL(20,2) NULL,
    finan_real DECIMAL(20,2) NULL,
    fecha_registro DATETIME NULL,
    user_registro INT NULL,
    fecha_avance DATE NULL,
    desc_problemas TEXT NULL,
    desc_temas TEXT NULL,
    adj_garantias VARCHAR(500) NULL,
    adj_avances VARCHAR(500) NULL,
    adj_supervicion VARCHAR(500) NULL,
    adj_evaluacion VARCHAR(500) NULL,
    adj_tecnica VARCHAR(500) NULL,
    adj_financiero VARCHAR(500) NULL,
    adj_recepcion VARCHAR(500) NULL,
    adj_disconformidad VARCHAR(500) NULL,
    estado VARCHAR(25) NULL,
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    PRIMARY KEY (idAvances), KEY ix_avance_exec (idInicioEjecucion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_avances_imagenes (
    idImagen INT NOT NULL AUTO_INCREMENT,
    idAvances INT NOT NULL,
    nombre_imagen VARCHAR(255) NULL,
    nombre_fisico VARCHAR(255) NULL,
    ubicacion_imagen VARCHAR(1000) NULL,
    estado VARCHAR(25) NULL,
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    PRIMARY KEY (idImagen), KEY ix_avance_image (idAvances)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_final_ejecucion (
    idFinalEjecucion INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    fecha_final DATE NULL,
    estado VARCHAR(25) NULL,
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    PRIMARY KEY (idFinalEjecucion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_final_ejecucion_imagenes (
    id INT NOT NULL AUTO_INCREMENT,
    idFinalEjecucion INT NOT NULL,
    nombre_imagen VARCHAR(255) NULL,
    nombre_fisico VARCHAR(255) NULL,
    ubicacion_imagen VARCHAR(1000) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_desembolsos_montos (
    id INT NOT NULL AUTO_INCREMENT,
    idDesembolso INT NULL,
    idInicioEjecucion INT NOT NULL,
    desembolso INT NULL,
    monto DECIMAL(20,2) NULL,
    descripcion VARCHAR(255) NULL,
    fecha_desembolso DATE NULL,
    fecha DATE NULL,
    estado VARCHAR(25) NULL,
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_garantias (
    idGarantia INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    idTipoGarantia INT NOT NULL,
    fecha_vencimiento DATE NULL,
    monto DECIMAL(20,2) NULL,
    estado VARCHAR(25) NULL,
    usuario_creacion INT NULL,
    fecha_creacion DATETIME NULL,
    usuario_publicacion INT NULL,
    fecha_publicacion DATETIME NULL,
    PRIMARY KEY (idGarantia), KEY ix_garantia_ejecucion (idInicioEjecucion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_finance (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    amount DECIMAL(20,2) NULL,
    currency VARCHAR(20) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_risk_category (
    id INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_risk_allocation (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    idRiskCategory INT NULL,
    allocation_party_id INT NULL,
    description TEXT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_share_capital (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    party_id INT NULL,
    amount DECIMAL(20,2) NULL,
    currency VARCHAR(20) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_shareholders (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    parties_id INT NULL,
    percentage DECIMAL(8,4) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_debt_equity_ratio (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    debt DECIMAL(20,2) NULL,
    equity DECIMAL(20,2) NULL,
    ratio DECIMAL(12,4) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_actual_irr (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    irr DECIMAL(12,6) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_amendment (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    date DATETIME NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_lenders_suppliers (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    parties_id INT NULL,
    role VARCHAR(100) NULL,
    amount DECIMAL(20,2) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_gov_support_guarantee (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    description TEXT NULL,
    amount DECIMAL(20,2) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_tariffs (
    id INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    tittle VARCHAR(500) NULL,
    paidBy_party_id INT NULL,
    startDate DATE NULL,
    endDate DATE NULL,
    maxExtentDate DATE NULL,
    durationInDays INT NULL,
    notes TEXT NULL,
    dimensions VARCHAR(255) NULL,
    description TEXT NULL,
    amount DECIMAL(20,2) NULL,
    currency VARCHAR(20) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_transactions (
    id INT NOT NULL AUTO_INCREMENT,
    idInicioEjecucion INT NOT NULL,
    relatedImplementationMilestone INT NULL,
    source VARCHAR(500) NULL,
    payer_id INT NULL,
    payer_name VARCHAR(500) NULL,
    payee_id INT NULL,
    payee_name VARCHAR(500) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    amount DECIMAL(20,2) NULL,
    currency VARCHAR(20) NULL,
    date DATETIME NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_related_process (
    id INT NOT NULL AUTO_INCREMENT,
    idContratacion INT NOT NULL,
    idProyecto INT NOT NULL,
    PRIMARY KEY (id), KEY ix_related_contract (idContratacion), KEY ix_related_project (idProyecto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_announcement (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    date DATETIME NULL,
    idProyecto INT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cs_slides_images (
    id INT NOT NULL AUTO_INCREMENT,
    url VARCHAR(1000) NULL,
    title VARCHAR(500) NULL,
    description TEXT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP VIEW IF EXISTS vCiudadano;
CREATE VIEW vCiudadano AS
SELECT
    p.idProyecto,
    p.codigo AS proyecto_codigo,
    p.nombre_proyecto AS proyecto_nombre,
    p.descrip AS proyecto_descripcion,
    p.proposito AS proyecto_proposito,
    p.fechaaprob AS proyecto_fecha_aprobacion,
    p.presupuesto AS proyecto_presupuesto,
    p.lat1 AS proyecto_lat1,
    p.lon1 AS proyecto_lon1,
    p.lat2 AS proyecto_lat2,
    p.lon2 AS proyecto_lon2,
    p.idSector,
    s.sector AS proyecto_sector,
    p.idSubSector,
    ss.subsector AS proyecto_subsector,
    p.idEnte,
    e.descripcion AS proyecto_ente,
    p.idFuncionario,
    f.nombre AS proyecto_funcionario_nombre,
    p.estado AS proyecto_estado,
    p.codigo AS proyecto_codigo_depto,
    p.codigo AS BIP,
    p.idPrograma,
    p.idPrograma AS programa_codigo,
    p.proposito AS programa_proposito,
    p.descrip AS programa_descripcion,
    p.nombre_proyecto AS programa_nombre,
    p.presupuesto AS programa_costo,
    p.fechaaprob AS programa_fecha,
    p.estado AS programa_estado,
    f.nombre AS proyecto_funcionario,
    (SELECT GROUP_CONCAT(DISTINCT d.departamento ORDER BY d.departamento SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_depto,
    (SELECT GROUP_CONCAT(DISTINCT m.municipio ORDER BY m.municipio SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_municipio m ON m.idMunicipio = pm.idMunicipio
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_muni,
    (SELECT GROUP_CONCAT(DISTINCT d.departamento ORDER BY d.departamento SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_ubicacion,
    cal.idCalificacion,
    cal.numproceso AS calificacion_numero,
    cal.numproceso AS calificacion_codigo,
    cal.nomprocesoproyecto AS calificacion_nombre,
    COALESCE(metodo.adquisicion, metodo.nombre) AS calificacion_metodo,
    cal.estado AS calificacion_estado,
    cal.estado AS calificacion_estatus,
    cal.proceseval AS calificacion_evaluacion,
    fcal.nombre AS calificacion_funcionario,
    cal.idTipoContrato,
    (SELECT GROUP_CONCAT(DISTINCT po.legalName SEPARATOR '; ')
       FROM cs_calificacion_oferente co
       JOIN cs_parties po ON po.id = co.idOferente
      WHERE co.idCalificacion = cal.idCalificacion) AS calificacion_oferente,
    ad.idAdjudicacion,
    ad.numproceso AS adjudicacion_codigo,
    ad.numproceso AS adjudicacion_proceso,
    ad.numproceso AS adjudicacion_nombre,
    ad.costoesti AS adjudicacion_costo,
    ad.estado AS adjudicacion_estado,
    ad.nparticipantes AS adjudicacion_nacionales,
    0 AS adjudicacion_internacionales,
    con.idContratacion,
    con.primario,
    con.ncontrato AS contratacion_numero,
    con.titulocontrato AS contratacion_nombre,
    con.precio AS contratacion_precio,
    con.precioLPS AS contratacion_precioLPS,
    con.precioUSD AS contratacion_precioUSD,
    con.fechainicio AS contratacion_inicio,
    con.fechafinal AS contratacion_final,
    con.fechainicio AS contratacion_fecha_inicio,
    con.fechafinal AS contratacion_fecha_final,
    con.duracioncontrato AS contratacion_duracion,
    con.estado AS contratacion_estado,
    (SELECT GROUP_CONCAT(DISTINCT pc.legalName SEPARATOR '; ')
       FROM cs_preferredBidders pb
       JOIN cs_parties pc ON pc.id = pb.parties_id
      WHERE pb.idContratacion = con.idContratacion) AS contratacion_oferente,
    con.alcances AS contratacion_alcances,
    ie.idInicioEjecucion,
    (SELECT GROUP_CONCAT(DISTINCT d.idDepartamento ORDER BY d.idDepartamento SEPARATOR ',')
       FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_iddepartamento,
    (SELECT GROUP_CONCAT(DISTINCT d.departamento ORDER BY d.departamento SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_departamento,
    (SELECT GROUP_CONCAT(DISTINCT d.departamento ORDER BY d.departamento SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_departamentos,
    (SELECT GROUP_CONCAT(DISTINCT m.municipio ORDER BY m.municipio SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_municipio m ON m.idMunicipio = pm.idMunicipio
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_municipio,
    (SELECT GROUP_CONCAT(DISTINCT m.municipio ORDER BY m.municipio SEPARATOR ', ')
       FROM cs_proyecto_municipio pm JOIN cs_municipio m ON m.idMunicipio = pm.idMunicipio
      WHERE pm.idProyecto = p.idProyecto) AS proyecto_municipios,
    (SELECT GROUP_CONCAT(DISTINCT pm.beneficio SEPARATOR '; ')
       FROM cs_proyecto_municipio pm WHERE pm.idProyecto = p.idProyecto) AS proyecto_beneficio,
    (SELECT GROUP_CONCAT(DISTINCT COALESCE(pf.fuente, ff.fuente) SEPARATOR '; ')
       FROM cs_proyecto_fuente pf LEFT JOIN cs_fuentesfinan ff ON ff.idFuente = pf.idFuente
      WHERE pf.idProyecto = p.idProyecto) AS proyecto_fuente,
    (SELECT GROUP_CONCAT(DISTINCT tc.contrato SEPARATOR '; ')
       FROM cs_calificacion c2 JOIN cs_tipocontrato tc ON tc.idTipoContrato = c2.idTipoContrato
      WHERE c2.idProyecto = p.idProyecto) AS tc
FROM cs_proyecto p
LEFT JOIN cs_sector s ON s.idSector = p.idSector
LEFT JOIN cs_subsector ss ON ss.idSubSector = p.idSubSector
LEFT JOIN cs_entes e ON e.idEnte = p.idEnte
LEFT JOIN cs_funcionarios f ON f.idFuncionario = p.idFuncionario
LEFT JOIN cs_calificacion cal ON cal.idProyecto = p.idProyecto AND cal.estado = 'PUBLICADO'
LEFT JOIN cs_metodo metodo ON metodo.idMetodo = cal.idMetodo
LEFT JOIN cs_funcionarios fcal ON fcal.idFuncionario = cal.idFuncionario
LEFT JOIN cs_adjudicacion ad ON ad.idCalificacion = cal.idCalificacion AND ad.estado = 'PUBLICADO'
LEFT JOIN cs_contratacion con ON con.idAdjudicacion = ad.idAdjudicacion AND con.estado = 'PUBLICADO'
LEFT JOIN cs_inicio_ejecucion ie ON ie.idContratacion = con.idContratacion AND ie.estado = 'PUBLICADO'
WHERE p.estado = 'PUBLICADO';

DROP VIEW IF EXISTS vProyecto;
CREATE VIEW vProyecto AS
SELECT p.*, s.sector, ss.subsector, e.descripcion AS ente, f.nombre AS funcionario_nombre,
       r.descripcion AS region
FROM cs_proyecto p
LEFT JOIN cs_sector s ON s.idSector = p.idSector
LEFT JOIN cs_subsector ss ON ss.idSubSector = p.idSubSector
LEFT JOIN cs_entes e ON e.idEnte = p.idEnte
LEFT JOIN cs_funcionarios f ON f.idFuncionario = p.idFuncionario
LEFT JOIN cs_region r ON r.idRegion = p.idRegion;

DROP VIEW IF EXISTS vproyecto_beneficiario;
DROP VIEW IF EXISTS vproyecto_municipio;
CREATE VIEW vproyecto_municipio AS
SELECT pm.*, d.departamento, m.municipio
FROM cs_proyecto_municipio pm
LEFT JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
LEFT JOIN cs_municipio m ON m.idMunicipio = pm.idMunicipio AND m.idDepartamento = pm.idDepartamento;
CREATE VIEW vproyecto_beneficiario AS
SELECT pm.idProyecto, pm.idMunicipio, pm.idDepartamento,
       pm.beneficio AS Beneficio, d.departamento, m.municipio
FROM cs_proyecto_municipio pm
LEFT JOIN cs_departamento d ON d.idDepartamento = pm.idDepartamento
LEFT JOIN cs_municipio m ON m.idMunicipio = pm.idMunicipio AND m.idDepartamento = pm.idDepartamento;

DROP VIEW IF EXISTS vproyecto_fuente;
CREATE VIEW vproyecto_fuente AS
SELECT pf.*, COALESCE(pf.fuente, ff.fuente) AS fuente_nombre, cu.moneda AS moneda_nombre
FROM cs_proyecto_fuente pf
LEFT JOIN cs_fuentesfinan ff ON ff.idFuente = pf.idFuente
LEFT JOIN cs_currency cu ON cu.idCurrency = pf.idMoneda;

DROP VIEW IF EXISTS vCalificacion;
CREATE VIEW vCalificacion AS
SELECT c.*, e.descripcion AS ente, f.nombre AS funcionario_nombre,
       tc.contrato AS contrato, m.nombre AS metodo
FROM cs_calificacion c
LEFT JOIN cs_entes e ON e.idEnte = c.idEnte
LEFT JOIN cs_funcionarios f ON f.idFuncionario = c.idFuncionario
LEFT JOIN cs_tipocontrato tc ON tc.idTipoContrato = c.idTipoContrato
LEFT JOIN cs_metodo m ON m.idMetodo = c.idMetodo;

DROP VIEW IF EXISTS vcalificacion_oferente;
CREATE VIEW vcalificacion_oferente AS
SELECT co.*, p.legalName, p.uri, p.roles
FROM cs_calificacion_oferente co LEFT JOIN cs_parties p ON p.id = co.idOferente;

DROP VIEW IF EXISTS vAdjudicacion;
CREATE VIEW vAdjudicacion AS
SELECT a.*, c.idProyecto, c.numproceso AS calificacion_numproceso,
       m.nombre AS metodo_adjudicacion
FROM cs_adjudicacion a
LEFT JOIN cs_calificacion c ON c.idCalificacion = a.idCalificacion
LEFT JOIN cs_metodo_adjudicacion m ON m.idMetodoAdjudicacion = a.idMetodoAdjudicacion;

DROP VIEW IF EXISTS vContratacion;
CREATE VIEW vContratacion AS
SELECT c.*, a.idCalificacion, ca.idProyecto, p.legalName AS oferente,
       ca.numproceso, ca.idTipoContrato
FROM cs_contratacion c
LEFT JOIN cs_adjudicacion a ON a.idAdjudicacion = c.idAdjudicacion
LEFT JOIN cs_calificacion ca ON ca.idCalificacion = a.idCalificacion
LEFT JOIN cs_parties p ON p.id = c.idoferente;

DROP VIEW IF EXISTS vContratos;
CREATE VIEW vContratos AS SELECT * FROM cs_contratos;

DROP VIEW IF EXISTS vEjecucion;
CREATE VIEW vEjecucion AS
SELECT ie.*, co.Nombres AS contacto_nombre, co.direccion AS contacto_direccion,
       co.telefono AS contacto_telefono, co.email AS contacto_email,
       c.idAdjudicacion, a.idCalificacion, ca.idProyecto,
       c.ncontrato, c.titulocontrato
FROM cs_inicio_ejecucion ie
LEFT JOIN cs_contactos co ON co.idContacto = ie.idContacto
LEFT JOIN cs_contratacion c ON c.idContratacion = ie.idContratacion
LEFT JOIN cs_adjudicacion a ON a.idAdjudicacion = c.idAdjudicacion
LEFT JOIN cs_calificacion ca ON ca.idCalificacion = a.idCalificacion;

DROP VIEW IF EXISTS vAvances;
CREATE VIEW vAvances AS
SELECT av.*, av.porcent_programado AS porcentaje_programado,
       av.porcent_real AS porcentaje_real,
       av.finan_programado AS financiero_programado,
       av.finan_real AS financiero_real,
       av.desc_problemas AS problemas,
       av.desc_temas AS temas_relevantes,
       ie.fecha_inicio
FROM cs_avances av LEFT JOIN cs_inicio_ejecucion ie ON ie.idInicioEjecucion = av.idInicioEjecucion;

DROP VIEW IF EXISTS vidpaths;
CREATE VIEW vidpaths AS
SELECT p.idProyecto, cal.idCalificacion, ad.idAdjudicacion,
       con.idContratacion, ie.idInicioEjecucion
FROM cs_proyecto p
LEFT JOIN cs_calificacion cal ON cal.idProyecto = p.idProyecto
LEFT JOIN cs_adjudicacion ad ON ad.idCalificacion = cal.idCalificacion
LEFT JOIN cs_contratacion con ON con.idAdjudicacion = ad.idAdjudicacion
LEFT JOIN cs_inicio_ejecucion ie ON ie.idContratacion = con.idContratacion;

DROP VIEW IF EXISTS v_avance_ft;
CREATE VIEW v_avance_ft AS
SELECT av.*, av.porcent_programado AS porcentaje_programado,
       av.porcent_real AS porcentaje_real,
       av.finan_programado AS financiero_programado,
       av.finan_real AS financiero_real,
       av.desc_problemas AS problemas,
       av.desc_temas AS temas_relevantes,
       ie.fecha_inicio
FROM cs_avances av LEFT JOIN cs_inicio_ejecucion ie ON ie.idInicioEjecucion = av.idInicioEjecucion;

DROP VIEW IF EXISTS v_imagenes_poravance;
CREATE VIEW v_imagenes_poravance AS
SELECT ai.*
FROM cs_avances_imagenes ai;

DROP VIEW IF EXISTS v_doc_avancesporid;
CREATE VIEW v_doc_avancesporid AS
SELECT ad.*
FROM cs_advance_documents ad;

DROP FUNCTION IF EXISTS fn_precio_actualizado;
DROP FUNCTION IF EXISTS fn_precio_actualizado_usd;
DELIMITER $$
CREATE FUNCTION fn_precio_actualizado(p_idContratacion INT)
RETURNS DECIMAL(20,2)
READS SQL DATA
BEGIN
    DECLARE base_price DECIMAL(20,2) DEFAULT 0;
    DECLARE amendments DECIMAL(20,2) DEFAULT 0;
    SELECT COALESCE(NULLIF(precioLPS, 0), precio, 0) INTO base_price
      FROM cs_contratacion WHERE idContratacion = p_idContratacion;
    SELECT COALESCE(SUM(precioactual), 0) INTO amendments
      FROM cs_contratos WHERE idContratacion = p_idContratacion;
    RETURN base_price + amendments;
END$$
CREATE FUNCTION fn_precio_actualizado_usd(p_idContratacion INT)
RETURNS DECIMAL(20,2)
READS SQL DATA
BEGIN
    DECLARE price_usd DECIMAL(20,2) DEFAULT 0;
    SELECT COALESCE(precioUSD, 0) INTO price_usd
      FROM cs_contratacion WHERE idContratacion = p_idContratacion;
    RETURN price_usd;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_portal_indicadores;
DELIMITER $$
CREATE PROCEDURE sp_portal_indicadores()
READS SQL DATA
BEGIN
    SELECT
        (SELECT COUNT(*) FROM cs_proyecto WHERE estado = 'PUBLICADO') AS proyectos,
        (SELECT COALESCE(SUM(fn_precio_actualizado(c.idContratacion)), 0)
           FROM cs_contratacion c WHERE c.estado = 'PUBLICADO') AS contratado,
        (SELECT COALESCE(SUM(fn_precio_actualizado_usd(c.idContratacion)), 0)
           FROM cs_contratacion c WHERE c.estado = 'PUBLICADO') AS contratadoUSD;
END$$
DELIMITER ;

SET FOREIGN_KEY_CHECKS = 1;
