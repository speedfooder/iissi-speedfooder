/* Procedimiento modificar_estado_pedido (RF-001).

El cocinero podrá modificar el estado del pedido a "en cola", "preparando" o "listo" */
CREATE OR REPLACE PROCEDURE modificar_estado_pedido (w_npedido IN pedidos.npedido%TYPE,
    w_estado IN pedidos.estado%TYPE) IS
    BEGIN
       INSERT INTO pedidos (estado) VALUES (w_estado);
       COMMIT WORK;
END modificar_estado_pedido;