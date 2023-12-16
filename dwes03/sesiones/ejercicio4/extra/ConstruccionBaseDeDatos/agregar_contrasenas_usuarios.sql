alter table empleados add column password varchar(128);
update empleados set `password`=SHA2(concat(dni,'test',reverse(concat(dni,'test')),'495k5ndikakzFSKZssd'),256) WHERE id>=0;
UPDATE empleados SET nombre='Encarnación', apellidos='López Pérez' where id=3;
UPDATE empleados SET nombre='Felípe', apellidos='Ruíz Alonso' where id=5;