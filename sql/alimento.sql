/* ignacio */
create or replace procedure addAlimento(w_nom ALIMENTOS.NOMBREALIMENTO%TYPE, w_proced ALIMENTOS.PROCEDENCIA%TYPE, 
w_alergeno ALERGENOS.NOMBREALERGENO%TYPE, w_fe ALIMENTOS.FECHAENTRADA%TYPE, 
w_fc ALIMENTOS.FECHACADUCIDAD%TYPE,w_cantidad ALIMENTOS.CANTIDAD%TYPE) AS
    BEGIN
        insert into ALIMENTOS VALUES(SEC_ALIMENTOS.NEXTVAL, w_nom, w_proced, w_alergeno, w_fe, w_fc, w_cantidad);
    END
;

/
create or replace procedure actualizaCantidad(w_nom ALIMENTOS.NOMBREALIMENTO%type, w_cantidad_sus number) as
    cantidadActual Integer;
    
    begin
        
        select CANTIDAD into cantidadActual from ALIMENTOS where ALIMENTOS.NOMBREALIMENTO=w_nom;
        
        update alimentos set Cantidad=(cantidadActual-w_cantidad_sus) where NOMBREALIMENTO=w_nom;   
    end
;
/
create or replace procedure deleteAlimento (w_id ALIMENTOS.idalimento%type) as
    begin
        DELETE FROM platosalimentos WHERE platosalimentos.idalimento=w_id;
        DELETE FROM alimentos WHERE IDALIMENTO=w_id;
    end;
/

