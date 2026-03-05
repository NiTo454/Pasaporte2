alter table usuario ADD
matricula VARCHAR(50) NULL;

insert into permisos (tipo, codename, nombre) values
('usuario', 'add_usuario', 'Agregar usuario'),
('usuario', 'change_usuario', 'Cambiar usuario'),
('usuario', 'delete_usuario', 'Eliminar usuario'),
('usuario', 'view_usuario', 'Ver usuario'),
('usuario', 'list_usuario', 'Listar usuarios');

INSERT INTO
    `migraciones` (
        `tipo`,
        `nombre`,
        `descripcion`,
        `archivo`
    )
VALUES (
        'DDL',
        'actualizacion tablas anteriores',
        'Actualizacion de tablas anteriores con nueva columna matricula',
        'mig_006_ddl_actualizacion_tablas_anteriores.sql'
    );

-- FIN DE LA MIGRACION
