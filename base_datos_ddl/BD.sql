-- cuenta tu historia
CREATE TABLE CATEGORIA(
    id_cat int auto_increment primary key,
    _cat varchar(40) not null UNIQUE
)
ENGINE=INNODB;

CREATE TABLE ROL(
    id_rol int auto_increment primary key,
    _rol varchar(70) not null
)
ENGINE=INNODB;

-- En esta tabla es mejor que los campos de sexo y estado se manejen en tablas separadas
CREATE TABLE USUARIO (
    id_usuario int auto_increment primary key,
    _usuario varchar(60) not null,
    descripcion TINYTEXT default null, -- tinytext son 255 caracteres
    foto_perfil varchar(200) default null,
    edad int not null,      -- Es mejor cambiar campo a tipo fecha para calcular la edad según fecha actual
    sexo char(10) not null,
    correo varchar(200) not null UNIQUE,
    password varchar (255) not null,
    estado char(14) not null,
    id_rol int not null
)
ENGINE=INNODB;
ALTER TABLE USUARIO ADD CONSTRAINT usuario_rol_fk FOREIGN KEY (id_rol) REFERENCES ROL (id_rol);

CREATE TABLE PUBLICACION (
    id_publicacion int auto_increment primary key,
    titulo varchar(100) not null,
    _publicacion MEDIUMTEXT not null, -- o utilizar TEXT (65.535 caracteres)
    fecha date default null, -- se agregara automaticamente cuando el estado pase a estar activo, realizando un update
    estado_p varchar(14) not null,
    id_cat int not null,
    id_usuario int not null
)
ENGINE=INNODB;
ALTER TABLE PUBLICACION ADD CONSTRAINT public_cat_fk FOREIGN KEY (id_cat) REFERENCES CATEGORIA (id_cat);
ALTER TABLE PUBLICACION ADD CONSTRAINT public_user_fk FOREIGN KEY (id_usuario) REFERENCES USUARIO (id_usuario);

CREATE TABLE ACCESO ( -- entrada salida
    id_acceso int auto_increment primary key,
    _acceso char(7) not null
)
ENGINE=INNODB;

CREATE TABLE SESION (
    id_sesion int auto_increment primary key,
    fecha_hora datetime not null,
    id_acceso int not null,
    id_usuario int not null
)
ENGINE=INNODB;
ALTER TABLE SESION ADD CONSTRAINT sesion_access_fk FOREIGN KEY (id_acceso) REFERENCES ACCESO (id_acceso);
ALTER TABLE SESION ADD CONSTRAINT sesion_user_fk FOREIGN KEY (id_usuario) REFERENCES USUARIO (id_usuario);

CREATE TABLE LIKES (
	id_like int auto_increment primary key,
	id_usuario int not null,
	id_publicacion int not null
)
ENGINE=INNODB;
ALTER TABLE LIKES ADD CONSTRAINT like_public_fk FOREIGN KEY (id_publicacion) REFERENCES PUBLICACION (id_publicacion);
ALTER TABLE LIKES ADD CONSTRAINT like_usuario_fk FOREIGN KEY (id_usuario) REFERENCES USUARIO (id_usuario);

-- ---------------------------------------------------------------------------------------

-- INSERCIONES BASICAS
INSERT INTO CATEGORIA (_cat) VALUE ('Cotidiano');
INSERT INTO CATEGORIA VALUES (NULL,'Humor');
INSERT INTO CATEGORIA VALUES (NULL,'Romantico');
INSERT INTO CATEGORIA VALUES (NULL,'Drama');
INSERT INTO CATEGORIA VALUES (NULL,'Ficción');
INSERT INTO CATEGORIA VALUES (NULL,'Fantasia');
INSERT INTO CATEGORIA VALUES (NULL,'Acción');

INSERT INTO ROL VALUES(null, 'Usuario');
INSERT INTO ROL VALUES(null, 'Administrador');

INSERT INTO ACCESO VALUES (null, 'ENTRADA');
INSERT INTO ACCESO VALUES (null, 'SALIDA');
COMMIT;