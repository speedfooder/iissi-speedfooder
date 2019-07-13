/* CONSUMIDORES */
execute elimina_cliente(08851212);
execute elimina_cliente(69875148);
execute elimina_cliente(30683446);
execute elimina_cliente(55353855);
execute elimina_cliente(44006180);
execute elimina_cliente(32581836);
execute elimina_cliente(85989372);
execute elimina_cliente(86531448);
execute elimina_cliente(37019020);

execute crea_cliente(08851212, 'Juana', 'Lopez', 'juanalopez@gmail.com', 'jualop', 'JuanaLop1234');
execute crea_cliente(69875148, 'Daniel', 'Sanchez', 'dnsanchez@gmail.com', 'dnsanch', 'DaniXTI163');
execute crea_cliente(30683446, 'Unai', 'Garay', 'uanigrysky@gmail.com', 'unaigar', 'GaraGary35');
execute crea_cliente(55353855, 'Aitor', 'Diaz', 'todzcorp@gmail.com', 'aitodiz', '54DzrtxAito');
execute crea_cliente(44006180, 'Jose Maria', 'Tena', 'josemariatena98@gmail.com', 'jomatena', 'JTN46mrvdia');
execute crea_cliente(32581836, 'Janire', 'Lopez', 'janiiilp8@gmail.com', 'janilopi', 'drknTO4get25');
execute crea_cliente(85989372, 'Victor', 'Ramos', 'vctmail91@gmail.com', 'victrammas', 'GoxR26frsh');
execute crea_cliente(86531448, 'Abel Joaquin', 'Morales', 'abquinarlequin@gmail.com', 'abequin', 'ArleQuine1980');
execute crea_cliente(37019020,'Samuel','Smith','samusmithcorp@gmail.com','admin','admin1234X');

/* ALERGENOS */
execute eliminaAlergenos('gluten');
execute eliminaAlergenos('huevos');
execute eliminaAlergenos('crustaceos');
execute eliminaAlergenos('cacahuetes');
execute eliminaAlergenos('soja');
execute eliminaAlergenos('lactosa');
execute eliminaAlergenos('apio');
execute eliminaAlergenos('mostaza');

execute addAlergenos('gluten');
execute addAlergenos('huevos');
execute addAlergenos('crustaceos');
execute addAlergenos('cacahuetes');
execute addAlergenos('soja');
execute addAlergenos('lactosa');
execute addAlergenos('apio');
execute addAlergenos('mostaza');

/* PLATOS */
execute elimina_plato('Montadito Lomo');
execute elimina_plato('Serranito');
execute elimina_plato('Montadito Vegetal con queso');
execute elimina_plato('Montadito Lomo');
execute elimina_plato('Montadito Mixto');
execute elimina_plato('Montadito Queso y Bacon');
execute elimina_plato('Montadito Pollo Plancha');
execute elimina_plato('Montadito Pollo Empanado');
execute elimina_plato('Montadito Jamon');
execute elimina_plato('Empanada Vegetal');
execute elimina_plato('Empanada Mixta');

execute inserta_plato('Montadito Lomo', to_number('1,5'));
execute inserta_plato('Serranito', to_number('2,0'));
execute inserta_plato('Montadito Vegetal con queso', to_number('2,0'));
execute inserta_plato('Montadito Mixto', to_number('2,5'));
execute inserta_plato('Montadito Queso y Bacon', to_number('1,99'));
execute inserta_plato('Montadito Pollo Plancha', to_number('3,5'));
execute inserta_plato('Montadito Pollo Empanado', to_number('3,5'));
execute inserta_plato('Montadito Jamon', to_number('2,8'));
execute inserta_plato('Empanada Vegetal', to_number('2,0'));
execute inserta_plato('Empanada Mixta', to_number('2,5'));

/* PROVEEDORES */
execute deleteProvider('Horno La Parra');
execute deleteProvider('Cervalle');
execute deleteProvider('Lacteos El Recreo');
execute deleteProvider('Frubana');
execute deleteProvider('Aves felices');

execute addProvider(1, 'Horno La Parra');
execute addProvider(2, 'Cervalle');
execute addProvider(3, 'Lacteos El Recreo');
execute addProvider(4, 'Frubana');
execute addProvider(5, 'Aves felices');

/* ALIMENTOS */
execute deleteAlimento('Pan Montadito');
execute deleteAlimento('Hojaldre empanada');
execute deleteAlimento('Cerdo - Lomo');
execute deleteAlimento('Cerdo - Jamon');
execute deleteAlimento('Cerdo - Bacon');
execute deleteAlimento('Lechuga');
execute deleteAlimento('Cebolla');
execute deleteAlimento('Tomate');
execute deleteAlimento('Pimiento verde');
execute deleteAlimento('Queso en lonchas');
execute deleteAlimento('Pollo - Plancha');
execute deleteAlimento('Pollo - Empanado');

execute addAlimento('Pan Montadito', 1, 2, DATE '2019-01-25', DATE '2019-02-25', 100);
execute addAlimento('Hojaldre empanada', 1, 2, DATE '2019-01-25', DATE '2019-02-25', 70);
execute addAlimento('Cerdo - Lomo', 2, null, DATE '2019-02-01', DATE '2019-02-25', 100);
execute addAlimento('Cerdo - Jamon', 2, null, DATE '2019-02-01', DATE '2019-02-25', 70);
execute addAlimento('Cerdo - Bacon', 2, null, DATE '2019-02-01', DATE '2019-02-25', 50);
execute addAlimento('Lechuga', 4, null, DATE '2019-01-20', DATE '2019-01-30', 100);
execute addAlimento('Cebolla', 4, null, DATE '2019-01-20', DATE '2019-01-30', 100);
execute addAlimento('Tomate', 4, null, DATE '2019-01-20', DATE '2019-01-30', 100);
execute addAlimento('Pimiento verde', 5, null, DATE '2019-01-20', DATE '2019-01-30', 100);
execute addAlimento('Queso en lonchas', 3, 6, DATE '2019-01-25', DATE '2019-02-05', 100);
execute addAlimento('Pollo - Plancha', 5, null, DATE '2019-02-01', DATE '2019-02-25', 50);
execute addAlimento('Pollo - Empanado', 5, null, DATE '2019-02-01', DATE '2019-02-25', 50);


/* RELACION PLATOS ALIMENTOS */
execute elimina_alimento_de_plato(2, 2);
execute elimina_alimento_de_plato(2, 6);
execute elimina_alimento_de_plato(4, 2);
execute elimina_alimento_de_plato(4, 6);
execute elimina_alimento_de_plato(4, 8);
execute elimina_alimento_de_plato(4, 18);

execute añade_alimento_en_plato(1, 1);
execute añade_alimento_en_plato(1, 3);
execute añade_alimento_en_plato(2, 1);
execute añade_alimento_en_plato(2, 3);
execute añade_alimento_en_plato(2, 4);
execute añade_alimento_en_plato(2, 9);
execute añade_alimento_en_plato(3, 1);
execute añade_alimento_en_plato(3, 6);
execute añade_alimento_en_plato(3, 8);
execute añade_alimento_en_plato(3, 7);
execute añade_alimento_en_plato(3, 10);
execute añade_alimento_en_plato(4, 1);
execute añade_alimento_en_plato(4, 4);
execute añade_alimento_en_plato(4, 10);
execute añade_alimento_en_plato(5, 1);
execute añade_alimento_en_plato(5, 5);
execute añade_alimento_en_plato(5, 10);
execute añade_alimento_en_plato(6, 1);
execute añade_alimento_en_plato(6, 11);
execute añade_alimento_en_plato(6, 9);
execute añade_alimento_en_plato(7, 1);
execute añade_alimento_en_plato(7, 12);
execute añade_alimento_en_plato(7, 9);
execute añade_alimento_en_plato(8, 1);
execute añade_alimento_en_plato(8, 4);
execute añade_alimento_en_plato(9, 7);
execute añade_alimento_en_plato(9, 8);
execute añade_alimento_en_plato(9, 9);
execute añade_alimento_en_plato(9, 2);
execute añade_alimento_en_plato(10, 2);
execute añade_alimento_en_plato(10, 4);
execute añade_alimento_en_plato(10, 10);

/* PEDIDO */
execute elimina_pedido(2);

execute crea_pedido(11111111);

/* LINEAS DE PEDIDOS */
execute elimina_plato_Lpedido(6);
execute elimina_plato_Lpedido(8);

execute añade_plato_Lpedido(4, 'Serranito');
execute añade_plato_Lpedido(4, 'Montadito Lomo');

execute modifica_cantidad_Lpedido(6, 3);
execute modifica_cantidad_Lpedido(8, 2);

