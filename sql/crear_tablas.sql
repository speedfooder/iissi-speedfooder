DROP TABLE PROVEEDORES cascade constraints;
DROP TABLE ALERGENOS cascade constraints;
DROP TABLE PEDIDOS cascade constraints;
DROP TABLE PLATOS cascade constraints;
DROP TABLE CONSUMIDORES cascade constraints;
DROP TABLE MENUS cascade constraints;
DROP TABLE ALIMENTOS cascade constraints;
DROP TABLE PLATOSALIMENTOS cascade constraints;
DROP TABLE LINEASPEDIDOS cascade constraints;

CREATE TABLE PROVEEDORES
    (ein integer PRIMARY KEY,
    nombre char(20));
    
CREATE TABLE ALERGENOS
    (idAlergeno integer PRIMARY KEY,
    nombreAlergeno char(15) UNIQUE);

CREATE TABLE CONSUMIDORES
    (dni NUMBER(8,0) PRIMARY KEY not null,
    nombre varchar(75) not null,
    apellidos varchar(75),
    email varchar(75),
    usuario varchar (75) UNIQUE,
    contrasena varchar(75)
    );
    
CREATE TABLE PEDIDOS
    (nPedido integer PRIMARY KEY,
    dni NUMBER(8,0),
    precioTotal NUMBER(4,2) CHECK (precioTotal >= 0),
    estado char(10) DEFAULT 'en cola' CHECK (estado in ('en cola', 'preparando', 'listo')),
    fechahora TIMESTAMP,
    FOREIGN KEY(dni) REFERENCES consumidores);
    
CREATE TABLE PLATOS
    (idPlato integer PRIMARY KEY,
    nombre char(40) UNIQUE,
    precio NUMBER(4,2) CHECK (precio > 0));  
    

     
CREATE TABLE MENUS
    (idMenu integer PRIMARY KEY,
    nombrePlato integer,
    FOREIGN KEY(nombrePlato) REFERENCES platos
   );
    
CREATE TABLE ALIMENTOS
    (idAlimento integer PRIMARY KEY,
    nombreAlimento char(40) UNIQUE,
    procedencia integer,
    alergeno integer,
    fechaEntrada date,
    fechaCaducidad date,
    cantidad integer,
    check (cantidad >= 15), -- Stock de seguridad
    constraint fechas check (fechaEntrada < fechaCaducidad),
    FOREIGN KEY (procedencia) REFERENCES proveedores,
    FOREIGN KEY (alergeno) REFERENCES alergenos
    );
    
CREATE TABLE PLATOSALIMENTOS
    (idPlatoAlimento integer PRIMARY KEY,
    idPlato integer,
    idAlimento integer,
    FOREIGN KEY(idPlato) REFERENCES platos,
    FOREIGN KEY(idAlimento) REFERENCES alimentos
   );

CREATE TABLE LINEASPEDIDOS
    (idLineaPedido integer PRIMARY KEY,
    idpedido integer, 
    plato char(40),
    cantidadPlato integer,
    precioUnidad NUMBER(4,2),
    fecha date,
    --hora time,
    FOREIGN KEY (idpedido) REFERENCES pedidos
    );    