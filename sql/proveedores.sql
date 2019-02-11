CREATE OR REPLACE procedure addProvider(w_ein IN PROVEEDORES.EIN%TYPE, w_nom IN Proveedores.nombre%TYPE) AS
  BEGIN
    -- TAREA: Se necesita implantación para procedure BASIC_ROCEDURE.addProvider
    INSERT INTO PROVEEDORES VALUES(w_ein , w_nom);
  END addProvider;
/  
CREATE OR REPLACE PROCEDURE deleteProvider
       (w_nom PROVEEDORES.NOMBRE%type)
      IS
          
      BEGIN
          delete from PROVEEDORES where NOMBRE=w_nom;
      END deleteProvider;
      