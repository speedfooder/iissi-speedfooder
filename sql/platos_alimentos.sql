/* Procedimiento para añadir un alimento a un plato */
CREATE OR REPLACE PROCEDURE añade_alimento_en_plato
        (w_idplato IN platosalimentos.idplato%TYPE, w_idalimento IN platosalimentos.idalimento%TYPE)  IS
    BEGIN
    INSERT INTO platosalimentos
        VALUES (sec_platosalimentos.nextval, w_idplato, w_idalimento);
    COMMIT WORK;
    END añade_alimento_en_plato;
/   
/* Procedimiento para eliminar un alimento de un plato */
CREATE OR REPLACE PROCEDURE elimina_alimento_de_plato
    (w_idplatoalimento IN platosalimentos.idplatoalimento%TYPE) IS
    BEGIN
        DELETE FROM platosalimentos WHERE w_idplatoalimento = platosalimentos.idplatoalimento;
    END elimina_alimento_de_plato;
/
CREATE OR REPLACE PROCEDURE eliminaDepPlato (w_idplato IN platosalimentos.idplato%type) IS
    BEGIN
        DELETE FROM platosalimentos where platosalimentos.idplato=w_idplato;
    END eliminaDepPlato;