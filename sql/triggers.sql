create or replace trigger checkCaducidad 
before update on alimentos 
for each row 
declare fechaActual date;
begin
    select sysdate into fechaActual from Dual;
    if :OLD.fechaCaducidad- fechaActual>0
    then 
    raise_application_error
(-20600,:OLD.fechaCaducidad||' se ha excedido la fecha de caducidad de un producto-comprobar el estado de: '||:old.nombre);
    end if;
end;


create or replace trigger stockSeguridad
after update on alimentos 
for each row
declare cantidadactual number(38,0);
begin 
    select :new.cantidad into cantidadactual from alimentos;
    if cantidadactual<15 then
    raise_application_error
    (-250213,'Hay que llamar a los proveedores de '||New.nombre);
    end if;
    
end;



