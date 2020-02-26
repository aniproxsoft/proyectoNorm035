DELIMITER //
CREATE PROCEDURE sp_autentification (empleado_num varchar(500), pass varchar(255))
BEGIN
    DECLARE flag boolean;
    DECLARE count int;
   
    DECLARE user_id int;
    
    

    DROP TABLE IF EXISTS temp_empleado;
    
    SELECT COUNT(*) FROM  usuario as us
	INNER JOIN empleado e on e.usuario_id=us.usuario_id 
	WHERE (us.PASSWORD=SHA(pass)
	and us.status=1) and e.status=1
   	into count;
    


    
    IF(count>0)THEN
        set flag=true;
        CREATE TEMPORARY TABLE temp_empleado AS
      	SELECT '0' as flag, e.num_empleado,e.nombre_empleado,e.apellidos,
        CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
        e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
        WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
        (SELECT CASE WHEN e.statatus_estudios='1' THEN 'Terminada' ELSE 'Incompleta' end) as estatus_estudios,
        e.division_id,d.nombre_division,e.usuario_id,us.rol_id,ur.nombre_rol
		from empleado e
      	INNER JOIN usuario us on us.usuario_id=e.usuario_id 
        INNER JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
        INNER JOIN division d on e.division_id=d.division_id
        INNER JOIN usuario_rol ur on us.rol_id=ur.rol_id
       	;

        SELECT usuario_id from temp_empleado WHERE num_empleado=empleado_num into user_id;
    	
        UPDATE temp_empleado set
        flag='1';
        SELECT * FROM temp_empleado where num_empleado=empleado_num;
        
    ELSE
        set flag= false;
        CREATE TEMPORARY TABLE temp_empleado AS
      	SELECT '0' as flag, null as num_empleado,null as nombre_empleado,null as apellidos,
        null as nombre_completo,
        null as edad,null as sexo,null as sexo_completo,null as nivel_estudios_id,null as nombre_estudios,
        null as estatus_estudios,
        null as division_id,null as nombre_division,null as usuario_id,null as rol_id,null as nombre_rol;
        SELECT * FROM temp_empleado ;
    END if;
    
END


DELIMITER //
CREATE PROCEDURE sp_get_employees(opcion varchar(10))
BEGIN
	if(opcion='all')THEN
		SELECT e.num_empleado,e.nombre_empleado,e.apellidos,
        CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
        e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
        WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
        (SELECT CASE WHEN e.statatus_estudios='1' THEN 'Terminada' ELSE 'Incompleta' end) as estatus_estudios,
        e.division_id,d.nombre_division,e.usuario_id,us.rol_id,ur.nombre_rol
		from empleado e
      	INNER JOIN usuario us on us.usuario_id=e.usuario_id 
        INNER JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
        INNER JOIN division d on e.division_id=d.division_id
        INNER JOIN usuario_rol ur on us.rol_id=ur.rol_id
       	;
	END if;
END