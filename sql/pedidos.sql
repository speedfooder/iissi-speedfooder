CREATE OR REPLACE PROCEDURE crea_pedido
    (w_dni IN pedidos.dni%TYPE) IS
    BEGIN
        INSERT INTO PEDIDOS
            VALUES(sec_Pedidos.nextval, w_dni, 0, 'en cola', SYSDATE);
        COMMIT WORK;
END crea_pedido;

/

CREATE OR REPLACE PROCEDURE modifica_estado_pedido
    (w_npedido IN pedidos.npedido%TYPE, w_estado IN pedidos.estado%TYPE) IS
    BEGIN
        UPDATE PEDIDOS
        SET  estado = w_estado
        WHERE npedido = w_npedido;
END modifica_estado_pedido;

/

CREATE OR REPLACE PROCEDURE elimina_pedido
    (w_npedido IN pedidos.npedido%TYPE) IS
    BEGIN
        DELETE FROM pedidos WHERE npedido = w_npedido;
END elimina_pedido;
