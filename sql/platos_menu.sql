/* Procedimiento que inserta un plato */
CREATE OR REPLACE PROCEDURE inserta_plato
(w_nombre_plato IN platos.nombre%TYPE, w_precio_plato IN platos.precio%TYPE) IS
BEGIN
    INSERT INTO platos
        VALUES(SEC_PLATOS.nextval, w_nombre_plato, w_precio_plato);
    COMMIT WORK;
END inserta_plato;
/

/* Procedimiento para actualizar la información de un plato */
CREATE OR REPLACE PROCEDURE actualiza_plato
    (w_id IN platos.idplato%TYPE, w_nombre_plato IN platos.nombre%TYPE, w_precio_plato IN platos.precio%TYPE) IS
    BEGIN
        UPDATE platos
        SET nombre = w_nombre_plato,
            precio = w_precio_plato
            WHERE w_id = platos.idplato;
    END actualiza_plato;
 /
 
/*Procedimiento para actualizar el nombre de un plato exclusivamente recibiendo una cadena y la id del plato (by ignacio)*/
CREATE OR REPLACE PROCEDURE actualiza_nombre_plato
    (w_id IN platos.idplato%TYPE, w_nombre_plato IN platos.nombre%TYPE) IS
    BEGIN
        UPDATE PLATOS
        SET nombre=w_nombre_plato
        WHERE w_id = platos.idplato;
    END actualiza_nombre_plato; 
/
/*Procedimiento para actualizar el PRECIO de un plato exclusivamente recibiendo una cadena y la id del plato (by ignacio)*/
CREATE OR REPLACE PROCEDURE actualiza_precio_plato
    (w_id IN platos.idplato%TYPE, w_precio_plato IN platos.precio%TYPE) IS
    BEGIN
        UPDATE PLATOS
        SET precio=w_precio_plato
        WHERE w_id = platos.idplato;
    END actualiza_precio_plato; 
/
/* Procedimiento para eliminar un plato */
CREATE OR REPLACE PROCEDURE elimina_plato
    (w_nombre_plato IN platos.nombre%TYPE) IS
    BEGIN
        DELETE FROM platos WHERE w_nombre_plato = platos.nombre;
    END elimina_plato;
    
  /  
/* Procedimiento que inserta un plato en el menú */
CREATE OR REPLACE PROCEDURE inserta_plato_menu
(w_nombre_plato IN menus.nombreplato%TYPE) IS
BEGIN
    INSERT INTO menus
        VALUES(SEC_MENUS.nextval, w_nombre_plato);
    COMMIT WORK;
END inserta_plato_menu;
/
/* Procedimiento para eliminar un plato */
CREATE OR REPLACE PROCEDURE elimina_plato_menu
    (w_id IN menus.idmenu%TYPE) IS
    BEGIN
        DELETE FROM menus WHERE w_id = menus.idmenu;
    END elimina_plato_menu;
/

CREATE OR REPLACE PROCEDURE MUESTRAALIMENTOS(w_plato in PLATOS.NOMBRE%TYPE)
IS  
CURSOR cursoralimentos is 
SELECT NOMBREALIMENTO 
FROM PLATOSALIMENTOS,ALIMENTOS 
WHERE idplato=2 and PLATOSALIMENTOS.IDALIMENTO=ALIMENTOS.IDALIMENTO;
cursorAlimentorec cursoralimentos%ROWTYPE;
begin
    FOR cursorAlimentorec IN cursoralimentos
LOOP
DBMS_OUTPUT.PUT_LINE
(cursorAlimentorec.nombrealimento);
END LOOP;
end;
/
/*borrado absoluto de un plato en cualquier tabla recibiendo la ID del mismo*/
create or replace procedure borradoplato(w_idplato PLATOS.IDPLATO%TYPE) AS
    begin
        delete from PLATOSALIMENTOS where PLATOSALIMENTOS.IDPLATO= w_idplato;
        delete from PLATOS where PLATOS.IDPLATO=w_idplato;
    end;
/