-- Archivo de prueba para verificar las relaciones de usuarios y eventos

-- INICIO DE LA MIGRACION

-- 1. Insertamos 3 Usuarios de prueba
-- El primer usuario será nuestro Staff/Organizador
INSERT INTO `usuario` (`username`, `password`, `activo`, `superusuario`, `nombre`, `apaterno`, `amaterno`, `matricula`, `email`, `categoria`, `whatsapp`, `grupo`) VALUES
('nito_admin', 'pass123', 1, 1, 'Nicolas', 'Hernández', 'Maldonado', 20230001, 'nicolas@utvam.edu.mx', 'Staff', '5551234567', 'T.S.U. Multiplataforma'),
('maria_dev', 'pass456', 1, 0, 'Maria', 'Gomez', 'Lopez', 20230002, 'maria.gomez@utvam.edu.mx', 'Alumno', '5559876543', 'T.S.U. Multiplataforma'),
('juan_gamer', 'pass789', 1, 0, 'Juan', 'Perez', 'Ruiz', 20230003, 'juan.perez@utvam.edu.mx', 'Alumno', '5555555555', 'T.S.U. Multiplataforma');

-- 2. Insertamos 2 Eventos de prueba
INSERT INTO `evento` (`nombre`, `fecha_hora`, `lugar`, `costo_interno`, `costo_externo`, `requiere_registro`) VALUES
('Presentación de Proyectos: MediApp', '2026-04-15 10:00:00', 'Auditorio Principal UTVAM', 0.00, 50.00, 1),
('Torneo Universitario eSports (LoL)', '2026-05-20 16:00:00', 'Sala de Computo 3', 0.00, 0.00, 1);

-- 3. Asignamos un Responsable al Evento 1 (Nicolas organiza la presentación)
-- Asumiendo que el ID de Nicolas es 1 y el del primer evento es 1
INSERT INTO `responsable_evento` (`evento_id`, `usuario_id`) VALUES
(1, 1),
(2, 1);

-- 4. Simulamos el Pre-registro (Maria y Juan se inscriben al Evento 1)
-- IDs: evento=1, usuarios maria=2 y juan=3
INSERT INTO `registro` (`evento_id`, `usuario_id`, `fecha_registro`) VALUES
(1, 2, '2026-03-05 14:30:00'),
(1, 3, '2026-03-06 09:15:00');

-- 5. Simulamos el Pase de Lista / Asistencia (Maria asiste al Evento 1, validada por Nicolas)
-- IDs: evento=1, usuario asiste=2, registrado_por staff=1
INSERT INTO `asistencia` (`evento_id`, `usuario_id`, `registrado_por`, `fecha_entrada`) VALUES
(1, 2, 1, '2026-04-15 09:55:00');

-- Registramos esta migración en el control
INSERT INTO `migraciones` (`tipo`, `nombre`, `descripcion`, `archivo`)
VALUES ('DML', 'Insert datos de prueba', 'Insercion de usuarios, eventos y asistencias para pruebas de integracion', 'mig_010_dml_datos_prueba.sql');

-- FIN DE LA MIGRACION