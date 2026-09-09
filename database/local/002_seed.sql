-- SISOCS local synthetic demonstration data
--
-- All projects, organisations, people, documents, and credentials below are
-- fictional and exist only to exercise the local application. The values are
-- intentionally not copied from a live SISOCS installation.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO cs_sector (idSector, sector) VALUES
    (1, 'Transporte'), (2, 'Agua y saneamiento')
ON DUPLICATE KEY UPDATE sector = VALUES(sector);
INSERT INTO cs_subsector (idSubSector, idSector, subsector) VALUES
    (1, 1, 'Carreteras'), (2, 2, 'Agua potable')
ON DUPLICATE KEY UPDATE idSector = VALUES(idSector), subsector = VALUES(subsector);
INSERT INTO cs_entes (idEnte, descripcion, uri) VALUES
    (1, 'Agencia Local de Infraestructura', 'https://example.invalid/local/agency')
ON DUPLICATE KEY UPDATE descripcion = VALUES(descripcion), uri = VALUES(uri);
INSERT INTO cs_entes_unidad (idUnidad, idEnte, descripcion) VALUES
    (1, 1, 'Unidad de Proyectos y Contratos')
ON DUPLICATE KEY UPDATE idEnte = VALUES(idEnte), descripcion = VALUES(descripcion);
INSERT INTO cs_funcionarios (idFuncionario, idEnte, idUnidad, nombre, puesto, telefono, correo) VALUES
    (1, 1, 1, 'Lucía Herrera', 'Directora de proyectos', '+504 0000 0001', 'lucia.herrera@example.invalid'),
    (2, 1, 1, 'Samuel Pineda', 'Especialista de adquisiciones', '+504 0000 0002', 'samuel.pineda@example.invalid')
ON DUPLICATE KEY UPDATE idEnte = VALUES(idEnte), idUnidad = VALUES(idUnidad), nombre = VALUES(nombre), puesto = VALUES(puesto), telefono = VALUES(telefono), correo = VALUES(correo);
INSERT INTO cs_rol (idRol, rol) VALUES
    (1, 'Responsable institucional'), (2, 'Especialista de adquisiciones')
ON DUPLICATE KEY UPDATE rol = VALUES(rol);
INSERT INTO cs_departamento (idDepartamento, departamento, codigo) VALUES
    (8, 'Francisco Morazán', 'HN-FM'), (5, 'Cortés', 'HN-CR')
ON DUPLICATE KEY UPDATE departamento = VALUES(departamento), codigo = VALUES(codigo);
INSERT INTO cs_municipio (idMunicipio, idDepartamento, municipio) VALUES
    (801, 8, 'Distrito Central'), (501, 5, 'San Pedro Sula')
ON DUPLICATE KEY UPDATE idDepartamento = VALUES(idDepartamento), municipio = VALUES(municipio);
INSERT INTO cs_region (idRegion, descripcion) VALUES
    (1, 'Centro'), (2, 'Norte')
ON DUPLICATE KEY UPDATE descripcion = VALUES(descripcion);
INSERT INTO cs_tipocontrato (idTipoContrato, contrato) VALUES
    (1, 'Concesión'), (9, 'Fideicomiso')
ON DUPLICATE KEY UPDATE contrato = VALUES(contrato);
INSERT INTO cs_metodo (idMetodo, nombre, adquisicion, siglas) VALUES
    (1, 'Licitación pública', 'Licitación pública', 'LP')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), adquisicion = VALUES(adquisicion), siglas = VALUES(siglas);
INSERT INTO cs_metodo_adjudicacion (idMetodoAdjudicacion, nombre) VALUES
    (1, 'Oferta evaluada')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);
INSERT INTO cs_tipo_garantias (idTipoGarantia, nombre) VALUES
    (1, 'Garantía de cumplimiento')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);
INSERT INTO cs_proposito (idProposito, proposito) VALUES
    (1, 'Mejorar la conectividad y la seguridad vial')
ON DUPLICATE KEY UPDATE proposito = VALUES(proposito);
INSERT INTO cs_estado (estado) VALUES
    ('BORRADOR'), ('REVISION'), ('REVISIÓN'), ('REVISÓN'), ('PUBLICADO')
ON DUPLICATE KEY UPDATE estado = VALUES(estado);
INSERT INTO cs_fuentesfinan (idFuente, fuente) VALUES
    (1, 'Fondo nacional de infraestructura'), (2, 'Financiamiento privado')
ON DUPLICATE KEY UPDATE fuente = VALUES(fuente);
INSERT INTO cs_currency (idCurrency, moneda, code) VALUES
    (1, 'Lempira hondureño', 'HNL'), (2, 'Dólar estadounidense', 'USD')
ON DUPLICATE KEY UPDATE moneda = VALUES(moneda), code = VALUES(code);
INSERT INTO cs_monedas (idMoneda, moneda) VALUES
    (1, 'Lempira hondureño'), (2, 'Dólar estadounidense')
ON DUPLICATE KEY UPDATE moneda = VALUES(moneda);

INSERT INTO cs_document_types (idDocumentType, code, title, description) VALUES
    (1, 'planning', 'Planificación', 'Documento sintético de planificación.'),
    (2, 'budget', 'Presupuesto', 'Documento sintético de presupuesto.'),
    (3, 'technical', 'Especificaciones técnicas', 'Documento sintético de especificaciones.'),
    (4, 'environmental', 'Evaluación ambiental', 'Documento sintético de evaluación ambiental.'),
    (5, 'contract', 'Contrato', 'Documento sintético de contrato.'),
    (6, 'other', 'Otro', 'Otro documento sintético para pruebas locales.')
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description);

INSERT INTO cs_parties (id, legalName, uri, identifier, scheme, streetAddress, locality, region, countryName, contactPoint_name, contactPoint_email, contactPoint_telephone, roles) VALUES
    (1, 'Agencia Local de Infraestructura', 'https://example.invalid/local/agency', 'LAI-001', 'local', 'Avenida de la Transparencia 1', 'Distrito Central', 'Francisco Morazán', 'Honduras', 'Lucía Herrera', 'lucia.herrera@example.invalid', '+504 0000 0001', 'publicAuthority;buyer'),
    (2, 'Consorcio Caminos Abiertos', 'https://example.invalid/caminos-abiertos', 'CCA-001', 'local', 'Calle de los Contratos 2', 'Distrito Central', 'Francisco Morazán', 'Honduras', 'María Solís', 'maria.solis@example.invalid', '+504 0000 0010', 'privateParty;supplier'),
    (3, 'Banco de Desarrollo de Prueba', 'https://example.invalid/banco-prueba', 'BDP-001', 'local', 'Plaza Financiera 3', 'Distrito Central', 'Francisco Morazán', 'Honduras', 'Diego Paz', 'diego.paz@example.invalid', '+504 0000 0020', 'financier'),
    (4, 'Empresa Municipal de Agua Demo', 'https://example.invalid/agua-demo', 'EMA-001', 'local', 'Calle del Agua 4', 'San Pedro Sula', 'Cortés', 'Honduras', 'Rosa Cruz', 'rosa.cruz@example.invalid', '+504 0000 0030', 'publicAuthority;buyer')
ON DUPLICATE KEY UPDATE legalName = VALUES(legalName), uri = VALUES(uri), identifier = VALUES(identifier), scheme = VALUES(scheme), streetAddress = VALUES(streetAddress), locality = VALUES(locality), region = VALUES(region), countryName = VALUES(countryName), contactPoint_name = VALUES(contactPoint_name), contactPoint_email = VALUES(contactPoint_email), contactPoint_telephone = VALUES(contactPoint_telephone), roles = VALUES(roles);

INSERT INTO cs_proyecto (idProyecto, codigo, nombre_proyecto, proposito, descrip, idSector, idSubSector, idEnte, idUnidad, idFuncionario, idRol, idRegion, presupuesto, fechaaprob, codsefin, descambiental, descreasentamiento, especiplano, presuprogra, estudiofact, estudioimpact, licambi, planreasea, acuerdofinan, notaprioridad, otro, lat1, lon1, lat2, lon2, estado, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion, eje) VALUES
    (1001, 'DEMO-001', 'Corredor Logístico de Demostración', 'Mejorar la conectividad y la seguridad vial', 'Proyecto ficticio para probar el ciclo completo de divulgación, desde la planificación hasta la implementación.', 1, 1, 1, 1, 1, 1, 1, 1250000000.00, '2026-01-15 00:00:00', 'BIP-DEMO-001', 'Evaluación ambiental local ficticia disponible para pruebas.', 'No se prevé reasentamiento en este conjunto de datos sintético.', 'demo://documents/especificaciones-corredor.pdf', 'demo://documents/presupuesto-corredor.xlsx', 'demo://documents/factibilidad-corredor.pdf', 'demo://documents/impacto-corredor.pdf', 'demo://documents/licencia-corredor.pdf', 'No aplica en el dataset sintético', 'demo://documents/acuerdo-financiamiento.pdf', 'Aprobación ficticia para pruebas locales', 'Datos de demostración sin valor contractual.', 14.10210000, -87.20450000, 14.14510000, -87.25050000, 'PUBLICADO', '2026-01-10 09:00:00', '2026-02-01 09:00:00', 1, 1, 1),
    (1002, 'DEMO-002', 'Planta Municipal de Agua Demo', 'Ampliar el acceso al agua potable', 'Proyecto ficticio publicado en estructuración para probar la búsqueda, el mapa y la etapa inicial.', 2, 2, 4, 1, 1, 1, 2, 320000000.00, '2026-02-10 00:00:00', 'BIP-DEMO-002', 'Ficha ambiental sintética.', 'No aplica al ejemplo local.', 'demo://documents/especificaciones-agua.pdf', 'demo://documents/presupuesto-agua.xlsx', 'demo://documents/factibilidad-agua.pdf', NULL, NULL, NULL, NULL, NULL, 'Datos de demostración sin valor contractual.', 15.50120000, -88.02510000, 15.51020000, -88.04010000, 'PUBLICADO', '2026-02-05 09:00:00', '2026-02-12 09:00:00', 1, 1, 1),
    (1003, 'DEMO-003', 'Terminal Intermodal Local', 'Conectar transporte urbano y regional', 'Registro ficticio en borrador para probar creación, reapertura y publicación controlada.', 1, 1, 1, 1, 1, 1, 1, 780000000.00, '2026-03-01 00:00:00', 'BIP-DEMO-003', 'Pendiente de completar en el flujo local.', 'Pendiente de completar en el flujo local.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Borrador sintético.', 14.07000000, -87.19000000, 14.08000000, -87.20000000, 'BORRADOR', '2026-03-05 09:00:00', NULL, 2, NULL, 1)
ON DUPLICATE KEY UPDATE nombre_proyecto = VALUES(nombre_proyecto), proposito = VALUES(proposito), descrip = VALUES(descrip), idSector = VALUES(idSector), idSubSector = VALUES(idSubSector), idEnte = VALUES(idEnte), idUnidad = VALUES(idUnidad), idFuncionario = VALUES(idFuncionario), idRol = VALUES(idRol), idRegion = VALUES(idRegion), presupuesto = VALUES(presupuesto), fechaaprob = VALUES(fechaaprob), estado = VALUES(estado), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion), usuario_creacion = VALUES(usuario_creacion), usuario_publicacion = VALUES(usuario_publicacion), lat1 = VALUES(lat1), lon1 = VALUES(lon1), lat2 = VALUES(lat2), lon2 = VALUES(lon2);

INSERT INTO cs_proyecto_municipio (id, idProyecto, idMunicipio, idDepartamento, beneficio, estado, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion) VALUES
    (10001, 1001, 801, 8, 'Usuarios de transporte y comercio del Distrito Central.', 'PUBLICADO', '2026-01-10 09:00:00', '2026-02-01 00:00:00', 1, 1),
    (10002, 1001, 501, 5, 'Comunidades y empresas conectadas por el corredor.', 'PUBLICADO', '2026-01-10 09:00:00', '2026-02-01 00:00:00', 1, 1),
    (10003, 1002, 501, 5, 'Hogares y comercios del municipio.', 'PUBLICADO', '2026-02-05 09:00:00', '2026-02-12 00:00:00', 1, 1),
    (10004, 1003, 801, 8, 'Beneficiarios de transporte urbano y regional.', 'BORRADOR', '2026-03-05 09:00:00', NULL, 2, NULL)
ON DUPLICATE KEY UPDATE idProyecto = VALUES(idProyecto), idMunicipio = VALUES(idMunicipio), idDepartamento = VALUES(idDepartamento), beneficio = VALUES(beneficio), estado = VALUES(estado), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion), usuario_creacion = VALUES(usuario_creacion), usuario_publicacion = VALUES(usuario_publicacion);

INSERT INTO cs_proyecto_fuente (id, idProyecto, idFuente, idMoneda, fuente, monto, moneda, tasa_cambio, estado, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion) VALUES
    (11001, 1001, 1, 1, 'Fondo nacional de infraestructura', 600000000.00, 'HNL', 1.000000, 'PUBLICADO', '2026-01-10 09:00:00', '2026-02-01 00:00:00', 1, 1),
    (11002, 1001, 2, 2, 'Financiamiento privado', 25000000.00, 'USD', 24.500000, 'PUBLICADO', '2026-01-10 09:00:00', '2026-02-01 00:00:00', 1, 1),
    (11003, 1002, 1, 1, 'Fondo nacional de infraestructura', 320000000.00, 'HNL', 1.000000, 'PUBLICADO', '2026-02-05 09:00:00', '2026-02-12 00:00:00', 1, 1),
    (11004, 1003, 1, 1, 'Fondo nacional de infraestructura', 780000000.00, 'HNL', 1.000000, 'BORRADOR', '2026-03-05 09:00:00', NULL, 2, NULL)
ON DUPLICATE KEY UPDATE idProyecto = VALUES(idProyecto), idFuente = VALUES(idFuente), idMoneda = VALUES(idMoneda), fuente = VALUES(fuente), monto = VALUES(monto), moneda = VALUES(moneda), tasa_cambio = VALUES(tasa_cambio), estado = VALUES(estado), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion), usuario_creacion = VALUES(usuario_creacion), usuario_publicacion = VALUES(usuario_publicacion);

INSERT INTO cs_calificacion (idCalificacion, idProyecto, numproceso, nomprocesoproyecto, idEnte, idFuncionario, idTipoContrato, idMetodo, proceseval, invitainter, basespreca, resolucion, convocainvi, tdr, aclaraciones, actarecpcion, estado, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion, tender_startDate, tender_endDate, tender_durationInDays) VALUES
    (2001, 1001, 'PROC-DEMO-001', 'Proceso de contratación del Corredor Logístico de Demostración', 1, 2, 1, 1, 'Evaluación técnica y económica', 'demo://documents/invitacion.pdf', 'demo://documents/bases.pdf', 'demo://documents/resolucion.pdf', 'demo://documents/convocatoria.pdf', 'demo://documents/tdr.pdf', 'Preguntas y respuestas ficticias.', 'demo://documents/acta-recepcion.pdf', 'PUBLICADO', '2026-02-05 09:00:00', '2026-02-15 09:00:00', 1, 1, '2026-02-15 00:00:00', '2026-03-15 00:00:00', 29)
ON DUPLICATE KEY UPDATE idProyecto = VALUES(idProyecto), numproceso = VALUES(numproceso), nomprocesoproyecto = VALUES(nomprocesoproyecto), idEnte = VALUES(idEnte), idFuncionario = VALUES(idFuncionario), idTipoContrato = VALUES(idTipoContrato), idMetodo = VALUES(idMetodo), estado = VALUES(estado), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion);

INSERT INTO cs_calificacion_oferente (id, idCalificacion, idOferente, estado) VALUES
    (21001, 2001, 2, 'PUBLICADO')
ON DUPLICATE KEY UPDATE idCalificacion = VALUES(idCalificacion), idOferente = VALUES(idOferente), estado = VALUES(estado);
INSERT INTO cs_adjudicacion (idAdjudicacion, idCalificacion, numproceso, nparticipantes, costoesti, actaaper, informeacta, resoladju, estado, fechapublicado, fechacreacion, fecha_publicacion, usuario_creacion, usuario_publicacion, idMetodoAdjudicacion) VALUES
    (3001, 2001, 'PROC-DEMO-001', 2, 1225000000.00, 'demo://documents/acta-apertura.pdf', 'demo://documents/informe-evaluacion.pdf', 'demo://documents/resolucion-adjudicacion.pdf', 'PUBLICADO', '2026-04-01 00:00:00', '2026-03-20 09:00:00', '2026-04-01 00:00:00', 1, 1, 1)
ON DUPLICATE KEY UPDATE idCalificacion = VALUES(idCalificacion), numproceso = VALUES(numproceso), nparticipantes = VALUES(nparticipantes), costoesti = VALUES(costoesti), estado = VALUES(estado), fechapublicado = VALUES(fechapublicado), fecha_publicacion = VALUES(fecha_publicacion);

INSERT INTO cs_contratacion (idContratacion, idAdjudicacion, idEntidad, idoferente, precioLPS, precioUSD, precio, alcances, fechainicio, fechafinal, duracioncontrato, documentocontra, regante, espeplanos, estado, ncontrato, titulocontrato, primario, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion) VALUES
    (4001, 3001, 1, 2, 1200000000.00, 48979591.84, 1200000000.00, 'Diseño, rehabilitación y mantenimiento demostrativo del corredor.', '2026-05-01', '2031-04-30', 1825, 'demo://documents/contrato-corredor.pdf', 'demo://documents/reglamento-usuario.pdf', 'demo://documents/planos-corredor.pdf', 'PUBLICADO', 'CONT-DEMO-001', 'Contrato del Corredor Logístico de Demostración', 1, '2026-04-05 09:00:00', '2026-04-15 00:00:00', 1, 1)
ON DUPLICATE KEY UPDATE idAdjudicacion = VALUES(idAdjudicacion), idEntidad = VALUES(idEntidad), idoferente = VALUES(idoferente), precioLPS = VALUES(precioLPS), precioUSD = VALUES(precioUSD), precio = VALUES(precio), alcances = VALUES(alcances), fechainicio = VALUES(fechainicio), fechafinal = VALUES(fechafinal), duracioncontrato = VALUES(duracioncontrato), estado = VALUES(estado), ncontrato = VALUES(ncontrato), titulocontrato = VALUES(titulocontrato), primario = VALUES(primario), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion);
INSERT INTO cs_preferredBidders (id, idContratacion, parties_id, parties_name) VALUES
    (41001, 4001, 2, 'Consorcio Caminos Abiertos')
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), parties_id = VALUES(parties_id), parties_name = VALUES(parties_name);
INSERT INTO cs_contracts_signatories (id, idContratacion, parties_id, parties_name) VALUES
    (42001, 4001, 1, 'Agencia Local de Infraestructura'), (42002, 4001, 2, 'Consorcio Caminos Abiertos')
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), parties_id = VALUES(parties_id), parties_name = VALUES(parties_name);
INSERT INTO cs_contracts_organization_details (id, idContratacion, parties_id) VALUES
    (43001, 4001, 1), (43002, 4001, 2)
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), parties_id = VALUES(parties_id);

INSERT INTO cs_inicio_ejecucion (idInicioEjecucion, idContratacion, idContacto, fecha_inicio, programainicial, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion, codigo, geo_latitud, geo_longitud, geo_lati_final, geo_long_final) VALUES
    (5001, 4001, 1, '2026-05-01', 'demo://documents/programa-inicial.xlsx', 'PUBLICADO', 1, '2026-04-20 09:00:00', 1, '2026-04-25 00:00:00', 'EJEC-DEMO-001', 14.10210000, -87.20450000, 14.14510000, -87.25050000)
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), idContacto = VALUES(idContacto), fecha_inicio = VALUES(fecha_inicio), programainicial = VALUES(programainicial), estado = VALUES(estado), fecha_creacion = VALUES(fecha_creacion), fecha_publicacion = VALUES(fecha_publicacion), codigo = VALUES(codigo), geo_latitud = VALUES(geo_latitud), geo_longitud = VALUES(geo_longitud), geo_lati_final = VALUES(geo_lati_final), geo_long_final = VALUES(geo_long_final);
INSERT INTO cs_contactos (idContacto, Nombres, direccion, telefono, movil, email) VALUES
    (1, 'Ana Gómez', 'Oficina de supervisión demo', '+504 0000 0040', '+504 0000 0041', 'ana.gomez@example.invalid')
ON DUPLICATE KEY UPDATE Nombres = VALUES(Nombres), direccion = VALUES(direccion), telefono = VALUES(telefono), movil = VALUES(movil), email = VALUES(email);

INSERT INTO cs_planning_documents (id, idProyecto, documentType, title, description, url, pageStart, pageEnd, datePublished, dateModified, accessDetails) VALUES
    (6001, 1001, 'planning', 'Ficha de factibilidad demo', 'Documento sintético para comprobar documentos de planificación.', 'demo://documents/factibilidad-corredor.pdf', 1, 8, '2026-01-20 00:00:00', '2026-01-20 00:00:00', 'Archivo local simulado, no es una fuente oficial.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_planning_milestone (id, idProyecto, title, description, dueDate, dateMet) VALUES
    (6101, 1001, 'Aprobación del proyecto', 'Hito sintético de aprobación.', '2026-01-01 00:00:00', '2026-01-15 00:00:00')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), dueDate = VALUES(dueDate), dateMet = VALUES(dateMet);
INSERT INTO cs_tender_documents (id, idCalificacion, documentType, title, description, url, datePublished, dateModified, accessDetails) VALUES
    (6201, 2001, 'tender', 'Bases de licitación demo', 'Documento sintético de bases.', 'demo://documents/bases.pdf', '2026-02-15 00:00:00', '2026-02-15 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_award_documents (id, idAdjudicacion, documentType, title, description, url, datePublished, dateModified, accessDetails) VALUES
    (6301, 3001, 'award', 'Resolución de adjudicación demo', 'Documento sintético de adjudicación.', 'demo://documents/resolucion-adjudicacion.pdf', '2026-04-01 00:00:00', '2026-04-01 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_contract_documents (id, idContratacion, documentType, title, description, url, datePublished, dateModified, accessDetails) VALUES
    (6401, 4001, 'contract', 'Contrato principal demo', 'Documento sintético de contrato.', 'demo://documents/contrato-corredor.pdf', '2026-04-15 00:00:00', '2026-04-15 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_implementation_documents (id, idInicioEjecucion, documentType, title, description, url, datePublished, dateModified, accessDetails) VALUES
    (6501, 5001, 'implementation', 'Programa inicial demo', 'Documento sintético de implementación.', 'demo://documents/programa-inicial.xlsx', '2026-04-25 00:00:00', '2026-04-25 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_advance_documents (id, idAvance, documentType, title, description, url, pageStart, pageEnd, datePublished, dateModified, accessDetails) VALUES
    (6510, 7201, 'advance', 'Informe de avance demo', 'Documento sintético del primer avance.', 'demo://documents/avance-inicial.pdf', 1, 3, '2026-06-04 00:00:00', '2026-06-04 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_contracts_milestone (id, idContratacion, title, description, dueDate, dateMet) VALUES
    (6601, 4001, 'Inicio de operaciones', 'Hito sintético del contrato.', '2026-05-01 00:00:00', '2026-05-01 00:00:00')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), dueDate = VALUES(dueDate), dateMet = VALUES(dateMet);
INSERT INTO cs_implementation_milestone (id, idInicioEjecucion, title, description, dueDate, dateMet) VALUES
    (6701, 5001, 'Primer avance publicado', 'Hito sintético para validar avances.', '2026-06-01 00:00:00', '2026-06-03 00:00:00')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), dueDate = VALUES(dueDate), dateMet = VALUES(dateMet);

INSERT INTO cs_budgetBreakdown (id, idProyecto, description, sourceParty_id, sourceParty_name, amount, currency, startDate, endDate) VALUES
    (6801, 1001, 'Rehabilitación y mantenimiento inicial', 1, 'Agencia Local de Infraestructura', 1250000000.00, 'HNL', '2026-01-01', '2031-12-31')
ON DUPLICATE KEY UPDATE description = VALUES(description), sourceParty_id = VALUES(sourceParty_id), sourceParty_name = VALUES(sourceParty_name), amount = VALUES(amount), currency = VALUES(currency), startDate = VALUES(startDate), endDate = VALUES(endDate);
INSERT INTO cs_prequalification (id, idProyecto, startDate, endDate, durationInDays, enquiryPeriod_startDate, enquiryPeriod_endDate, qualificationPeriod_startDate, qualificationPeriod_endDate, eligibilityCriteria) VALUES
    (6901, 1001, '2026-02-01 00:00:00', '2026-02-15 00:00:00', 14, '2026-02-01 00:00:00', '2026-02-05 00:00:00', '2026-02-06 00:00:00', '2026-02-15 00:00:00', 'Experiencia y capacidad financiera ficticias.')
ON DUPLICATE KEY UPDATE startDate = VALUES(startDate), endDate = VALUES(endDate), durationInDays = VALUES(durationInDays), eligibilityCriteria = VALUES(eligibilityCriteria);
INSERT INTO cs_forecast (id, idProyecto, title, unidad, medida) VALUES
    (7001, 1001, 'Usuarios beneficiados estimados', 'personas', 150000)
ON DUPLICATE KEY UPDATE title = VALUES(title), unidad = VALUES(unidad), medida = VALUES(medida);
INSERT INTO cs_forecast_observations (id, forecast_id, obs_notes, obs_amount, obs_currency) VALUES
    (7101, 7001, 'Estimación sintética de referencia.', 150000, 'HNL')
ON DUPLICATE KEY UPDATE obs_notes = VALUES(obs_notes), obs_amount = VALUES(obs_amount), obs_currency = VALUES(obs_currency);
INSERT INTO cs_avances (idAvances, idInicioEjecucion, idContratacion, porcent_programado, porcent_real, finan_programado, finan_real, fecha_registro, user_registro, fecha_avance, desc_problemas, desc_temas, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion) VALUES
    (7201, 5001, 4001, 12.00, 10.00, 144000000.00, 120000000.00, '2026-06-04 09:00:00', 1, '2026-06-03', 'Sin problemas materiales en el registro sintético.', 'Movilización de equipos y señalización.', 'PUBLICADO', 1, '2026-06-04 09:00:00', 1, '2026-06-04 09:00:00')
ON DUPLICATE KEY UPDATE porcent_programado = VALUES(porcent_programado), porcent_real = VALUES(porcent_real), finan_programado = VALUES(finan_programado), finan_real = VALUES(finan_real), fecha_registro = VALUES(fecha_registro), fecha_avance = VALUES(fecha_avance), desc_problemas = VALUES(desc_problemas), desc_temas = VALUES(desc_temas), estado = VALUES(estado);
INSERT INTO cs_avances_imagenes (idImagen, idAvances, nombre_imagen, nombre_fisico, ubicacion_imagen, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion) VALUES
    (7301, 7201, 'Avance inicial demo', 'avance-inicial-demo.txt', 'demo://files/avance-inicial-demo.txt', 'PUBLICADO', 1, '2026-06-04 09:00:00', 1, '2026-06-04 09:00:00')
ON DUPLICATE KEY UPDATE nombre_imagen = VALUES(nombre_imagen), nombre_fisico = VALUES(nombre_fisico), ubicacion_imagen = VALUES(ubicacion_imagen), estado = VALUES(estado), fecha_publicacion = VALUES(fecha_publicacion);
INSERT INTO cs_contratos (idContratos, idContratacion, nmodifica, fecha, tipomodifica, justimodcontrato, precioactual, fechatercontra, alcanceactucontrato, prograactu, estado, fecha_creacion, fecha_publicacion, usuario_creacion, usuario_publicacion) VALUES
    (7401, 4001, 1, '2026-07-01 00:00:00', 'Ajuste de calendario', 'Ajuste sintético sin cambio de alcance.', 0.00, '2031-04-30', 'Sin cambio material.', 'demo://documents/programa-inicial.xlsx', 'PUBLICADO', '2026-06-25 09:00:00', '2026-07-01 00:00:00', 1, 1)
ON DUPLICATE KEY UPDATE tipomodifica = VALUES(tipomodifica), justimodcontrato = VALUES(justimodcontrato), precioactual = VALUES(precioactual), fechatercontra = VALUES(fechatercontra), alcanceactucontrato = VALUES(alcanceactucontrato), estado = VALUES(estado);
INSERT INTO cs_contratos_documents (id, idContrato, documentType, title, description, url, datePublished, dateModified, accessDetails) VALUES
    (7501, 7401, 'amendment', 'Ajuste de calendario demo', 'Documento sintético de modificación.', 'demo://documents/modificacion-calendario.pdf', '2026-07-01 00:00:00', '2026-07-01 00:00:00', 'Archivo local simulado.')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), url = VALUES(url), datePublished = VALUES(datePublished), dateModified = VALUES(dateModified), accessDetails = VALUES(accessDetails);
INSERT INTO cs_finance (id, idContratacion, title, description, amount, currency) VALUES
    (7601, 4001, 'Financiamiento principal', 'Financiamiento sintético para pruebas de OCDS.', 25000000.00, 'USD')
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), amount = VALUES(amount), currency = VALUES(currency);
INSERT INTO cs_risk_category (id, descripcion) VALUES (1, 'Demanda'), (2, 'Construcción')
ON DUPLICATE KEY UPDATE descripcion = VALUES(descripcion);
INSERT INTO cs_risk_allocation (id, idContratacion, idRiskCategory, allocation_party_id, description) VALUES
    (7701, 4001, 1, 2, 'Asignación sintética de riesgo de demanda.'), (7702, 4001, 2, 2, 'Asignación sintética de riesgo de construcción.')
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), idRiskCategory = VALUES(idRiskCategory), allocation_party_id = VALUES(allocation_party_id), description = VALUES(description);
INSERT INTO cs_tariffs (id, idInicioEjecucion, tittle, paidBy_party_id, startDate, endDate, notes, dimensions, description, amount, currency) VALUES
    (7801, 5001, 'Tarifa demostrativa de usuario', 2, '2026-05-01', '2031-04-30', 'Tarifa sintética de referencia.', 'Por usuario', 'Tarifa demostrativa de usuario', 25.00, 'HNL')
ON DUPLICATE KEY UPDATE tittle = VALUES(tittle), paidBy_party_id = VALUES(paidBy_party_id), startDate = VALUES(startDate), endDate = VALUES(endDate), notes = VALUES(notes), dimensions = VALUES(dimensions), description = VALUES(description), amount = VALUES(amount), currency = VALUES(currency);
INSERT INTO cs_transactions (id, idInicioEjecucion, relatedImplementationMilestone, source, payer_id, payer_name, payee_id, payee_name, title, description, amount, currency, date) VALUES
    (7901, 5001, 6701, 'Financiamiento sintético', 1, 'Agencia Local de Infraestructura', 2, 'Consorcio Caminos Abiertos', 'Pago de avance demo', 'Transacción sintética de referencia.', 120000000.00, 'HNL', '2026-06-05 00:00:00')
ON DUPLICATE KEY UPDATE source = VALUES(source), payer_id = VALUES(payer_id), payer_name = VALUES(payer_name), payee_id = VALUES(payee_id), payee_name = VALUES(payee_name), title = VALUES(title), description = VALUES(description), amount = VALUES(amount), currency = VALUES(currency), date = VALUES(date);
INSERT INTO cs_desembolsos_montos (id, idDesembolso, idInicioEjecucion, desembolso, monto, descripcion, fecha_desembolso, fecha) VALUES
    (8001, 8001, 5001, 1, 120000000.00, 'Desembolso sintético de avance inicial.', '2026-06-05', '2026-06-05')
ON DUPLICATE KEY UPDATE idDesembolso = VALUES(idDesembolso), desembolso = VALUES(desembolso), monto = VALUES(monto), descripcion = VALUES(descripcion), fecha_desembolso = VALUES(fecha_desembolso), fecha = VALUES(fecha);
INSERT INTO cs_related_process (id, idContratacion, idProyecto) VALUES
    (8101, 4001, 1002)
ON DUPLICATE KEY UPDATE idContratacion = VALUES(idContratacion), idProyecto = VALUES(idProyecto);
INSERT INTO cs_announcement (id, title, description, date, idProyecto) VALUES
    (8201, 'Conjunto de demostración local', 'Los registros con código DEMO son ficticios y sirven para explorar las pantallas sin conectar servicios externos.', '2026-06-10 09:00:00', 1001)
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), date = VALUES(date), idProyecto = VALUES(idProyecto);
INSERT INTO cs_slides_images (id, url, title, description) VALUES
    (8301, 'images/mapa_sisocs.png', 'SISOCS local', 'Entorno sintético de exploración y pruebas.')
ON DUPLICATE KEY UPDATE url = VALUES(url), title = VALUES(title), description = VALUES(description);

-- Reset only the local demonstration identities, then recreate them with the
-- same SHA-256 mechanism used by CrugeAuthDefault. Plaintext passwords live in
-- .local/credentials.txt, which is generated by the local init script.
DELETE FROM cruge_authassignment;
DELETE FROM cruge_authitemchild;
DELETE FROM cruge_authitem;
DELETE FROM cruge_user;
INSERT INTO cruge_user (iduser, username, email, password, state, regdate) VALUES
    (1, 'admin', 'admin@sisocs.local', SHA2('local-admin-2026', 256), 1, UNIX_TIMESTAMP()),
    (2, 'editor', 'editor@sisocs.local', SHA2('local-editor-2026', 256), 1, UNIX_TIMESTAMP()),
    (3, 'reviewer', 'reviewer@sisocs.local', SHA2('local-reviewer-2026', 256), 1, UNIX_TIMESTAMP()),
    (4, 'viewer', 'viewer@sisocs.local', SHA2('local-viewer-2026', 256), 1, UNIX_TIMESTAMP());
INSERT INTO cruge_authitem (name, type, description) VALUES
    ('Publicador', 2, 'Reviews and publishes local demonstration records.'),
    ('Proyectos', 2, 'Creates and edits local project records.'),
    ('Adquisiciones', 2, 'Maintains qualification records.'),
    ('Adjudicaciones', 2, 'Maintains award records.'),
    ('Contratos', 2, 'Maintains contract records.'),
    ('Avances', 2, 'Maintains implementation progress.'),
    ('Programas', 2, 'Maintains programme records.'),
    ('Autor', 2, 'Local content author role.');
-- Map project operations to the roles that own each stage of the local
-- workflow.  Publicador is deliberately the only non-superuser role that
-- receives the publication-capable project update path.
INSERT INTO cruge_authitemchild (parent, child) VALUES
    ('Proyectos', 'action_proyecto_admin'),
    ('Proyectos', 'action_proyecto_create'),
    ('Proyectos', 'action_proyecto_update'),
    ('Proyectos', 'action_proyecto_ViewBeneficiaries'),
    ('Proyectos', 'action_proyecto_ViewDetBudgetBreakdown'),
    ('Proyectos', 'action_proyecto_ViewDetFuentesFinanciamiento'),
    ('Proyectos', 'action_proyecto_ViewDetPrequalification'),
    ('Proyectos', 'action_proyecto_ViewDocuments'),
    ('Proyectos', 'action_proyecto_ViewForecast'),
    ('Proyectos', 'action_proyecto_ViewMilestone'),
    ('Proyectos', 'action_proyecto_view'),
    ('Publicador', 'action_proyecto_admin'),
    ('Publicador', 'action_proyecto_update'),
    ('Publicador', 'action_proyecto_ViewBeneficiaries'),
    ('Publicador', 'action_proyecto_ViewDetBudgetBreakdown'),
    ('Publicador', 'action_proyecto_ViewDetFuentesFinanciamiento'),
    ('Publicador', 'action_proyecto_ViewDetPrequalification'),
    ('Publicador', 'action_proyecto_ViewDocuments'),
    ('Publicador', 'action_proyecto_ViewForecast'),
    ('Publicador', 'action_proyecto_ViewMilestone'),
    ('Publicador', 'action_proyecto_view');
INSERT INTO cruge_authassignment (userid, itemname) VALUES
    (1, 'Publicador'), (1, 'Proyectos'), (1, 'Adquisiciones'), (1, 'Adjudicaciones'), (1, 'Contratos'), (1, 'Avances'), (1, 'Programas'), (1, 'Autor'),
    (2, 'Proyectos'), (2, 'Adquisiciones'), (2, 'Adjudicaciones'), (2, 'Contratos'), (2, 'Avances'), (2, 'Programas'), (2, 'Autor'),
    (3, 'Publicador');

SET FOREIGN_KEY_CHECKS = 1;
