/* Procedimiento para añadir a un nuevo cliente registrado */
CREATE OR REPLACE PROCEDURE crea_cliente
        (w_dni IN consumidores.dni%TYPE, w_nombre IN consumidores.nombre%TYPE, w_apellidos IN consumidores.apellidos%TYPE,
        w_email IN consumidores.email%TYPE, w_usuario IN consumidores.usuario%TYPE, w_contrasena IN consumidores.contrasena%TYPE)  IS
    BEGIN
    INSERT INTO consumidores VALUES (w_dni, w_nombre, w_apellidos, w_email, w_usuario, w_contrasena);
    COMMIT WORK;
    END crea_cliente;

/    
/* Procedimiento para actualizar la información de un cliente */
CREATE OR REPLACE PROCEDURE actualiza_cliente
    (w_dni IN consumidores.dni%TYPE, w_nuevo_dni IN consumidores.dni%TYPE, w_nombre IN consumidores.nombre%TYPE, w_apellidos IN consumidores.apellidos%TYPE,
     w_email IN consumidores.email%TYPE, w_usuario IN consumidores.usuario%TYPE, w_contrasena IN consumidores.contrasena%TYPE) IS
    BEGIN
        UPDATE consumidores 
        SET dni = w_nuevo_dni,
            nombre = w_nombre,
            apellidos =  w_apellidos,
            email = w_email,
            usuario = w_usuario,
            contrasena = w_contrasena
        WHERE w_dni = consumidores.dni;
    END actualiza_cliente;
    
/* Procedimiento para eliminar un cliente registrado */
/
CREATE OR REPLACE PROCEDURE elimina_cliente
    (w_dni IN consumidores.dni%TYPE) IS
    BEGIN
        DELETE FROM consumidores WHERE w_dni = consumidores.dni;
    END elimina_cliente;
/    
/*Funcion que devuelve el numero de pedidos que un cliente ha realizado */
CREATE OR REPLACE FUNCTION muestra_pedidos_realizados(w_dni CONSUMIDORES.DNI%type) 
  return number IS pedidosrealizados integer;
  BEGIN
   SELECT COUNT (*) INTO pedidosrealizados FROM pedidos WHERE dni=w_dni;
      return pedidosrealizados;
  END muestra_pedidos_realizados;  
/  
/* Funcion que devuelve el numero de pedidos restantes hasta el descuento */
CREATE OR REPLACE FUNCTION muestra_pedidos_restantes(w_dni CONSUMIDORES.DNI%type) 
  return number IS pedidosrestantes integer;
  BEGIN
    SELECT 10-muestra_pedidos_realizados(w_dni) INTO pedidosrestantes from consumidores 
        where dni=w_dni;
    RETURN pedidosrestantes;
  END muestra_pedidos_restantes;
 / 
  
  