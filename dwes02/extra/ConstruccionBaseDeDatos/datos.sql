INSERT INTO usuarios (dni, activo, fnacim, nombre, apellidos, telefono, email, nombre_tutor, apellidos_tutor, telefono_tutor, email_tutor)
VALUES
  ('12345678A', 1, '2010-05-15', 'Juan', 'Pérez García', '123456789', 'juan@example.com', 'María', 'García López', '987654321', 'maria@example.com'),
  ('X8765432B', 1, '2012-09-20', 'Laura', 'Martínez Rodríguez', '987654321', 'laura@example.com', NULL, NULL, NULL, NULL),
  ('Y9876543C', 1, '2010-12-03', 'Carlos', 'González Gómez', '654321987', 'carlos@example.com', 'Luis', 'Gómez Pérez', '654321987', 'luis@example.com'),
  ('Z7654321D', 1, '2011-03-10', 'Ana', 'Sánchez Martín', '321654987', 'ana@example.com', 'José', 'Martín López', '987321654', 'jose@example.com'),
  ('B9876543E', 1, '2014-06-25', 'Elena', 'Gómez Martínez', '987321654', 'elena@example.com', 'Luis', 'Gómez Pérez', '654321987', 'luis@example.com'),
  ('C8765432F', 0, '2012-10-12', 'Marta', 'López Sánchez', '987654321', 'marta@example.com', 'María', 'García López', '987654321', 'maria@example.com'),
  ('D7654321G', 1, '2010-04-18', 'Pedro', 'García Gómez', '321654987', 'pedro@example.com', 'José', 'Martín López', '987321654', 'jose@example.com'),
  ('F6543210H', 1, '2011-07-30', 'Sofía', 'Pérez Rodríguez', '987654321', 'sofia@example.com', NULL, NULL, NULL, NULL),
  ('G5432109I', 1, '2012-01-05', 'Manuel', 'Sánchez Gómez', '654321987', 'manuel@example.com', 'Luis', 'Gómez Pérez', '654321987', 'luis@example.com'),
  ('H4321098J', 1, '2011-11-08', 'Laura', 'Martínez Sánchez', '321654987', 'laura.m@example.com', 'Luis', 'Gómez Pérez', '654321987', 'luis@example.com');

INSERT INTO empleados (dni, nombre, apellidos, roles) 
VALUES 
  ('12345678A', 'María', 'González Pérez', 'coord'),
  ('X8765432B', 'Carlos', 'López Martínez', 'trasoc'),
  ('Y9876543C', 'Laura', 'Martínez Rodríguez', 'trasoc'),
  ('Z7654321D', 'Juan', 'Sánchez Gómez', 'admin'),
  ('C8765432F', 'Marta', 'López Sánchez', 'edusoc');


INSERT INTO seguimiento (usuarios_id, empleados_id, fechahora, medio, otro, contactado, informe) 
VALUES 
  (1, 2, '2023-10-24 15:30:00', 'PRESENCIAL', NULL, 1, '<p>Durante la reunión presencial, se discutió el progreso del usuario en el programa. Se identificaron áreas de mejora y se establecieron objetivos realistas para las próximas semanas.</p>'),
  (2, 2, '2023-10-25 10:45:00', 'EMAIL', NULL, 1, '<p>A través del correo electrónico, se proporcionó al usuario información detallada sobre los recursos disponibles para su situación. También se le animó a asistir a futuras sesiones presenciales.</p>'),
  (3, 2, '2023-10-23 11:00:00', 'TLF', NULL, 1, '<p>Durante la llamada telefónica, se abordaron las preocupaciones del usuario y se le ofreció apoyo emocional. Se programó una reunión presencial para abordar temas más específicos.</p>'),
  (4, 2, '2023-10-26 14:15:00', 'VIDEOCONF', NULL, 0, NULL),
  (5, 2, '2023-10-25 12:30:00', 'PRESENCIAL', 'Conferencia Web', 1, '<p>El usuario y su tutor asistieron a la reunión presencial. Se discutió la posibilidad de utilizar conferencias web para futuras reuniones, ya que el usuario mencionó tener dificultades para viajar.</p>'),
  (7, 3, '2023-10-24 16:00:00', 'TLF', NULL, 1, '<p>Se confirmó la disponibilidad del usuario para asistir a la próxima reunión presencial. Se ofreció asesoramiento sobre recursos adicionales que podrían beneficiarle.</p>'),
  (8, 3, '2023-10-26 13:45:00', 'OTRO', 'Mensajería instantánea', 0, NULL),
  (9, 3, '2023-10-23 15:30:00', 'TLF', NULL, 1, '<p>Se discutió el plan de acción del usuario y se le animó a mantenerse en contacto a través de llamadas telefónicas regulares para evaluar su progreso.</p>'),
  (10, 3, '2023-10-25 16:30:00', 'PRESENCIAL', NULL, 0, NULL),
  (1, 3, '2023-10-24 17:00:00', 'VIDEOCONF', NULL, 1, '<p>La videoconferencia fue exitosa y se acordaron acciones específicas. Se acordó una visita domiciliaria para el próximo mes para proporcionar apoyo adicional.</p>');
