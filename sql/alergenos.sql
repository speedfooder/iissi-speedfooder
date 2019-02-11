create or replace procedure addAlergenos (w_nom alergenos.NOMBREALERGENO%type) as
    begin
        insert into alergenos values (sec_alergenos.nextval, w_nom);
        commit work;
    end addAlergenos;
/
create or replace procedure eliminaAlergenos(w_nom alergenos.NOMBREALERGENO%type)
as
    begin
        delete from alergenos where NOMBREALERGENO=w_nom;
    end eliminaAlergenos;
/
create or replace function muestraAlergenos (w_nom ALIMENTOS.NOMBREALIMENTO%TYPE)
    RETURN VARCHAR2 IS ALERG ALERGENOS.NOMBREALERGENO%type;
    BEGIN
       
        select alergenos.NOMBREALERGENO into ALERG from alergenos, alimentos where alergenos.idalergeno = alimentos.alergeno and alimentos.NOMBREALIMENTO = w_nom;
        
        RETURN ALERG;
    END muestraAlergenos;
