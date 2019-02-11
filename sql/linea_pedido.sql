CREATE OR REPLACE PROCEDURE añade_plato_Lpedido
    (w_idpedido IN lineaspedidos.idpedido%TYPE, w_plato IN lineaspedidos.plato%TYPE) IS
    precioPlato number(4,2);
    BEGIN
        select precio into precioPlato from platos where platos.nombre=w_plato;
        INSERT INTO lineaspedidos
            VALUES  (sec_LineasPedidos.nextval, w_idpedido, w_plato, 1, precioPlato, SYSDATE);
            COMMIT WORK;
    END añade_plato_Lpedido;
/  
CREATE OR REPLACE PROCEDURE modifica_cantidad_Lpedido
    (w_idlineapedido IN lineaspedidos.idlineapedido%TYPE, w_cantidad IN lineaspedidos.cantidadplato%TYPE) IS
     precioPlato number(4,2);
    BEGIN
     select preciounidad into precioPlato from lineaspedidos where lineaspedidos.idlineapedido=w_idlineapedido;
     UPDATE lineaspedidos
     SET cantidadplato = w_cantidad, 
        preciounidad = w_cantidad * precioPlato
     WHERE idlineapedido = w_idlineapedido;
END modifica_cantidad_Lpedido;
/
CREATE OR REPLACE PROCEDURE elimina_plato_Lpedido
    (w_idlineapedido IN lineaspedidos.idlineapedido%TYPE) IS
    BEGIN
    DELETE FROM lineaspedidos WHERE idlineapedido = w_idlineapedido;
END elimina_plato_Lpedido;
/


