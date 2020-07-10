-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-07-2020 a las 03:34:22
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `norma035db`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_autentification`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_autentification` (IN `empleado_num` VARCHAR(500), IN `pass` VARCHAR(255), IN `opc` INT)  BEGIN
    DECLARE flag boolean;
    DECLARE count int;
   
    DECLARE user_id int;
    
    IF(opc=1)THEN
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
            (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' WHEN e.status_estudios='0' THEN 'Incompleta' end) as estatus_estudios,
            e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol,e.status
            from empleado e
            INNER JOIN usuario us on us.usuario_id=e.usuario_id 
            INNER JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
            INNER JOIN division d on e.division_id=d.division_id
            INNER JOIN usuario_rol ur on e.rol_id=ur.rol_id
            ;

            
        
            UPDATE temp_empleado set
            flag='1';
            SELECT * FROM temp_empleado where num_empleado=empleado_num and rol_id=1;
        
        ELSE
            set flag= false;
            CREATE TEMPORARY TABLE temp_empleado AS
            SELECT '0' as flag, null as num_empleado,null as nombre_empleado,null as apellidos,
            null as nombre_completo,
            null as edad,null as sexo,null as sexo_completo,null as nivel_estudios_id,null as nombre_estudios,
            null as estatus_estudios,
            null as division_id,null as nombre_division,null as usuario_id,null as rol_id,null as nombre_rol;
            SELECT * FROM temp_empleado ;
        END IF;
    ELSE IF(opc=2)THEN
        DROP TABLE IF EXISTS temp_empleado;
    
        SELECT COUNT(*) FROM  empleado as e
        where e.num_empleado=empleado_num
        and e.status=2
        into count;
    


    
        IF(count>0)THEN
            set flag=true;
            CREATE TEMPORARY TABLE temp_empleado AS
            SELECT '0' as flag, e.num_empleado,e.nombre_empleado,e.apellidos,
            CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
            e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
            WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
            (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' WHEN e.status_estudios='0' THEN 'Incompleta' end) as estatus_estudios,
            e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol,e.status
            from empleado e
            LEFT OUTER JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
            LEFT OUTER JOIN division d on e.division_id=d.division_id
            LEFT OUTER JOIN usuario_rol ur on e.rol_id=ur.rol_id
            ;

            
        
            UPDATE temp_empleado set
            flag='1';
            SELECT * FROM temp_empleado where num_empleado=empleado_num;
        
        ELSE
            set flag= false;
            CREATE TEMPORARY TABLE temp_empleado AS
            SELECT flag, e.num_empleado,e.nombre_empleado,e.apellidos,
            CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
            e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
            WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,'' as nombre_estudios,
            (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' WHEN e.status_estudios='0' THEN 'Incompleta' end) as estatus_estudios,
            e.division_id,'' as nombre_division,e.usuario_id,e.rol_id,'' as nombre_rol,e.status
            from empleado e;
            SELECT COUNT(*) FROM temp_empleado where num_empleado=empleado_num into count;
            IF(count>0)THEN
             SELECT * FROM temp_empleado where num_empleado=empleado_num;
            ELSE
                DROP TABLE IF EXISTS temp_empleado;
                CREATE TEMPORARY TABLE temp_empleado AS
                SELECT '0' as flag, null as num_empleado,null as nombre_empleado,null as apellidos,
                null as nombre_completo,
                null as edad,null as sexo,null as sexo_completo,null as nivel_estudios_id,null as nombre_estudios,
                null as estatus_estudios,
                null as division_id,null as nombre_division,null as usuario_id,null as rol_id,null as nombre_rol, null as status;
                SELECT * FROM temp_empleado ;
            END IF;

           
        END IF;

        END IF;
    END IF;

    
    
END$$

DROP PROCEDURE IF EXISTS `sp_get_criterios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_criterios` ()  BEGIN
    SELECT c.criterio_id,c.criterio_desc,c.criterio_nombre
    FROM criterio c
    WHERE c.guia_id=2
    ORDER BY c.criterio_id;

END$$

DROP PROCEDURE IF EXISTS `sp_get_divisiones`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_divisiones` ()  BEGIN
    SELECT d.division_id,d.nombre_division 
    FROM division d;
END$$

DROP PROCEDURE IF EXISTS `sp_get_employees`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_employees` (IN `opcion` VARCHAR(10))  BEGIN
    if(opcion='all')THEN
        SELECT e.num_empleado,e.nombre_empleado,e.apellidos,
        CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
        e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
        WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
        (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' ELSE 'Incompleta' end) as estatus_estudios,
        e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol,resultado_guia1(e.num_empleado) as status_guia
        from empleado e
        LEFT JOIN usuario us on us.usuario_id=e.usuario_id 
        LEFT JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
        LEFT JOIN division d on e.division_id=d.division_id
        LEFT JOIN usuario_rol ur on e.rol_id=ur.rol_id;
    ELSE IF(opcion='some')THEN
        SELECT e.num_empleado,e.nombre_empleado,e.apellidos,
        CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
        e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
        WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
        (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' ELSE 'Incompleta' end) as estatus_estudios,
        e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol,resultado_guia1(e.num_empleado) as status_guia
        from empleado e
        LEFT JOIN usuario us on us.usuario_id=e.usuario_id 
        LEFT JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
        LEFT JOIN division d on e.division_id=d.division_id
        LEFT JOIN usuario_rol ur on e.rol_id=ur.rol_id
        WHERE e.status>2;
        END IF;
    END if;
END$$

DROP PROCEDURE IF EXISTS `sp_get_employee_select`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_employee_select` (IN `opcion` VARCHAR(10), IN `num_employee` VARCHAR(50))  BEGIN
  IF (opcion='one')THEN
            SELECT e.num_empleado,e.nombre_empleado,e.apellidos,
            CONCAT(e.nombre_empleado, ' ' , e.apellidos)as nombre_completo,
            e.edad,e.sexo,(SELECT CASE WHEN UPPER(e.sexo)='M' THEN "Masculino" 
            WHEN UPPER(e.sexo)='F' THEN "Femenino" END)as sexo_completo,e.nivel_estudios_id,ne.nombre_estudios,
            (SELECT CASE WHEN e.status_estudios='1' THEN 'Terminada' ELSE 'Incompleta' end) as estatus_estudios,
            e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol,
            (SELECT sp_calcula_antiguedad(e.antiguedad_puesto))as antiguedad_puesto,
            (SELECT sp_calcula_antiguedad(e.fecha_antiguedad))as antiguedad_utn
            from empleado e
            LEFT JOIN usuario us on us.usuario_id=e.usuario_id 
            LEFT JOIN nivel_estudios ne on e.nivel_estudios_id=ne.nivel_estudios_id
            LEFT JOIN division d on e.division_id=d.division_id
            LEFT JOIN usuario_rol ur on e.rol_id=ur.rol_id
            WHERE e.num_empleado=num_employee
            and e.status=3;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_get_guiaResuelta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_guiaResuelta` (IN `num_empleado` INT(11))  BEGIN
    SELECT p.pregunta_desc as pregunta,
	(SELECT CASE WHEN UPPER(r.valor_respuesta)=1 THEN "Si" 
	WHEN UPPER(r.valor_respuesta)=0 THEN "No" END)as respuesta 
	from pregunta p, respuesta r
	where (p.pregunta_id= r.pregunta_id and p.guia_id=1 and r.guia_id=1 	)
	and r.num_empleado= num_empleado ;
END$$

DROP PROCEDURE IF EXISTS `sp_get_guias_contestadas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_guias_contestadas` (`empleado_num` INT(11))  BEGIN
    SELECT DISTINCT r.guia_id,g.guia_nombre
    FROM respuesta r
    JOIN guia g on r.guia_id=g.guia_id
    WHERE r.num_empleado=empleado_num;

END$$

DROP PROCEDURE IF EXISTS `sp_get_nivel_estudios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_nivel_estudios` ()  BEGIN
    SELECT ne.nivel_estudios_id,ne.nombre_estudios
        FROM nivel_estudios ne;
END$$

DROP PROCEDURE IF EXISTS `sp_get_num_eployees`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_num_eployees` ()  BEGIN
    SELECT  e.num_empleado,(SELECT CASE WHEN e.status='3' 
                        THEN 'Realizada' ELSE 'No realizada' end)as guia,
                        (SELECT CASE WHEN e.status='2' 
                        THEN 'Otorgado' ELSE 'Denegado' end) as acceso
    FROM empleado e
    WHERE e.usuario_id is null
    and e.status>0;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas2` ()  BEGIN
	
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion
    FROM pregunta p
    INNER JOIN seccion s ON s.seccion_id=p.seccion_id and s.guia_id=1
    where p.guia_id=1
    and p.seccion_id=2;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas3`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas3` ()  BEGIN
	
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion
    FROM pregunta p
    INNER JOIN seccion s ON s.seccion_id=p.seccion_id and s.guia_id=1
    where p.guia_id=1
    and p.seccion_id=3;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas4`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas4` ()  BEGIN
	
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion
    FROM pregunta p
    INNER JOIN seccion s ON s.seccion_id=p.seccion_id and s.guia_id=1
    where p.guia_id=1
    and p.seccion_id=4;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntasI`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntasI` ()  BEGIN

	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion
    FROM pregunta p
    INNER JOIN seccion s ON s.seccion_id=p.seccion_id and s.guia_id=1
    where p.guia_id=1
    and p.seccion_id=1;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas_guia_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas_guia_2` (`seccion_num` INT(11))  BEGIN
    SELECT p.pregunta_id,p.seccion_id,
    p.pregunta_desc
    FROM pregunta p
    WHERE p.guia_id=2
    AND p.seccion_id=seccion_num;
END$$

DROP PROCEDURE IF EXISTS `sp_get_puestos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_puestos` ()  BEGIN
    SELECT ur.rol_id,ur.nombre_rol,
    ur.rol_desc
    from usuario_rol ur
    where ur.rol_id>1;
END$$

DROP PROCEDURE IF EXISTS `sp_get_respuestas_guia_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_respuestas_guia_2` (IN `empleado_num` INT(11))  BEGIN
    SELECT p.pregunta_id,p.pregunta_desc,
    (SELECT sp_get_desc_respuesta_guia_2(p.pregunta_id,IFNULL(r.valor_respuesta,5)))as respuesta,
    r.valor_respuesta
    FROM respuesta r
    JOIN pregunta p ON r.pregunta_id=p.pregunta_id 
    AND p.guia_id=r.guia_id
    WHERE r.num_empleado=empleado_num
    AND r.guia_id=2
    ORDER BY p.pregunta_id;
END$$

DROP PROCEDURE IF EXISTS `sp_get_resultados_guia_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_resultados_guia_2` (IN `empleado_num` INT(11), IN `opc` INT(11))  BEGIN
DECLARE resultado int UNSIGNED DEFAULT 0;
   CASE opc
    WHEN 1 THEN
        SELECT SUM(r.valor_respuesta)as resultado 
        FROM respuesta r
        WHERE r.num_empleado = empleado_num and r.guia_id=2 into resultado;

        SELECT 'Calificacion final del cuestionario' as seccion_desc,
        (SELECT sp_get_calificacion_final(resultado)) as resultado,
        resultado as puntaje;
    WHEN 2 THEN 
        SELECT DISTINCT (c.categoria_desc) as seccion_desc,(SELECT sp_get_calificacion_categoria((SELECT SUM(r.valor_respuesta) 
            FROM respuesta r
            WHERE (r.num_empleado = empleado_num and r.guia_id=2) AND
            r.pregunta_id IN (SELECT cl.pregunta_id
            FROM clasificacion cl
            WHERE cl.guia_id=2 AND cl.categoria_id=c.categoria_id)),c.categoria_id)) 
            as resultado,(SELECT SUM(r.valor_respuesta) 
            FROM respuesta r
            WHERE (r.num_empleado = empleado_num and r.guia_id=2) AND
            r.pregunta_id IN (SELECT cl.pregunta_id
            FROM clasificacion cl
            WHERE cl.guia_id=2 AND cl.categoria_id=c.categoria_id)) as puntaje
        FROM categoria c
        LEFT JOIN clasificacion cla ON cla.categoria_id=c.categoria_id and cla.guia_id=2
        LEFT JOIN respuesta r ON r.pregunta_id=cla.pregunta_id and r.guia_id=2
        WHERE c.guia_id=2 AND  r.num_empleado=empleado_num;
    WHEN 3 THEN
        SELECT DISTINCT (d.dominio_desc) as seccion_desc,(SELECT sp_get_calificacion_dominio((SELECT SUM(r.valor_respuesta) 
            FROM respuesta r
            WHERE (r.num_empleado = empleado_num and r.guia_id=2) AND
            r.pregunta_id IN (SELECT cl.pregunta_id
            FROM clasificacion cl
            WHERE cl.guia_id=2 AND cl.dominio_id=d.dominio_id)),d.dominio_id)) 
            as resultado,(SELECT SUM(r.valor_respuesta) 
            FROM respuesta r
            WHERE (r.num_empleado = empleado_num and r.guia_id=2) AND
            r.pregunta_id IN (SELECT cl.pregunta_id
            FROM clasificacion cl
            WHERE cl.guia_id=2 AND cl.dominio_id=d.dominio_id)) as puntaje
            FROM dominio d
            LEFT JOIN clasificacion cla ON cla.dominio_id=d.dominio_id and cla.guia_id=2
            LEFT JOIN respuesta r ON r.pregunta_id=cla.pregunta_id and r.guia_id=2
            WHERE d.guia_id=2 AND  r.num_empleado=empleado_num;




   END CASE; 
END$$

DROP PROCEDURE IF EXISTS `sp_get_secciones_guia_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_secciones_guia_2` ()  BEGIN
    SELECT s.seccion_id,s.nombre_seccion
    from seccion s
    WHERE s.guia_id=2;
END$$

DROP PROCEDURE IF EXISTS `sp_insert_empleado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_empleado` (IN `jsonEmpleado` VARCHAR(65000))  BEGIN
    DECLARE flag boolean;
    DECLARE count int  UNSIGNED DEFAULT 0;
    DECLARE msj varchar(50);
    DECLARE countInsert int UNSIGNED DEFAULT 0;
    DECLARE json_items int UNSIGNED   DEFAULT  JSON_LENGTH(jsonEmpleado); 
    DECLARE _index int UNSIGNED DEFAULT 0;
    
                WHILE _index < json_items DO 
                    
                    UPDATE empleado SET 
                        nombre_empleado=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].nombre')), '"', '')),
                        apellidos=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].apellidos')), '"', '')),
                        edad=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].edad')), '"', '')),
                        sexo=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].sexo')), '"', '')),
                        nivel_estudios_id=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].nivel_estudios')), '"', '')),
                        status_estudios=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].estatus_estudios')), '"', '')),
                        division_id=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].division')), '"', '')),
                        rol_id=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].puesto')), '"', '')),
                        antiguedad_puesto=STR_TO_DATE((Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].antiguedad_puesto')), '"', '')),'%d-%m-%Y'),
                        fecha_antiguedad=STR_TO_DATE((Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].fecha_antiguedad')), '"', '')),'%d-%m-%Y'),
status='3'
                        
                    WHERE num_empleado=(Select replace(JSON_EXTRACT(jsonEmpleado, CONCAT('$[',_index,'].usuario')), '"', ''));
                    SET COUNT = (select ROW_count());
                        if(COUNT>0)then
                            Set countInsert:=countInsert+1;
                            set msj='Se registraró correctamente el empleado';
                        else set msj='no se actualizo el empleado';
                        end if;
                    SET _index := _index + 1; 
                
                END WHILE; 

            COMMIT;
            Select msj, countInsert, num_empleado
            from empleado;
           End$$

DROP PROCEDURE IF EXISTS `sp_insert_respuestas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_respuestas` (IN `jsonRespuestas` VARCHAR(65000))  BEGIN
    DECLARE flag boolean;
    DECLARE count int  UNSIGNED DEFAULT 0;
    DECLARE msj varchar(50);
    DECLARE countInsert int UNSIGNED DEFAULT 0;
    DECLARE json_items int UNSIGNED   DEFAULT  JSON_LENGTH(jsonRespuestas); 
    DECLARE _index int UNSIGNED DEFAULT 0;

                        WHILE _index < json_items DO 
                
                            Insert into respuesta (num_empleado,pregunta_id, valor_respuesta)
                            VALUES(
                            (Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,'].usuario')), '"', '')),
                                (Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,'].pregunta_id')), '"', '')),
                                (Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,']. resp')), '"', ''))
                            );
                            SET COUNT = (select ROW_count());
                            if(COUNT>0)then
                                Set countInsert:=countInsert+1;
                                set msj='Se registraron correctamente las respuestas';
                            else set msj='no se inserto prro';
                            end if;
                    
                
                            SET _index := _index + 1; 
                
 
                        END WHILE; 

            COMMIT;
            Select respuesta_id, num_empleado, pregunta_id, valor_respuesta,msj, countInsert
            from respuesta;
           End$$

DROP PROCEDURE IF EXISTS `sp_insert_respuestas_guia_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_respuestas_guia_2` (IN `jsonRespuestas` VARCHAR(65000))  BEGIN
    DECLARE flag boolean;
    DECLARE count int  UNSIGNED DEFAULT 0;
    DECLARE msj varchar(50);
    DECLARE resp_valor int UNSIGNED DEFAULT 0;
    DECLARE countInsert int UNSIGNED DEFAULT 0;
    DECLARE json_items int UNSIGNED   DEFAULT  JSON_LENGTH(jsonRespuestas); 
    DECLARE _index int UNSIGNED DEFAULT 0;
    DECLARE respuesta varchar (800);
    DECLARE id_pregunta int UNSIGNED DEFAULT 0;
    

                        WHILE _index < json_items DO 
                            Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,']. resp')), '"', '') 
                            into respuesta;
                            Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,'].pregunta_id')), '"', '') 
                            into id_pregunta;
                            SELECT sp_get_valor_respuesta(id_pregunta,respuesta) into resp_valor;
                            Insert into respuesta (num_empleado,pregunta_id, valor_respuesta,guia_id)
                            VALUES(
                                (Select replace(JSON_EXTRACT(jsonRespuestas, CONCAT('$[',_index,'].usuario')), '"', '')),
                                id_pregunta,
                                resp_valor,
                                2
                                
                            );

                            
                            SET COUNT = (select ROW_count());
                            if(COUNT>0)then
                                Set countInsert:=countInsert+1;
                                set msj='Se registraron correctamente las respuestas';
                            else set msj='no se inserto prro';
                            end if;
                    
                
                            SET _index := _index + 1; 
                
 
                        END WHILE; 

            COMMIT;
            Select respuesta_id, num_empleado, pregunta_id, valor_respuesta,msj, countInsert
            from respuesta;
           End$$

DROP PROCEDURE IF EXISTS `sp_update_num_empleado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_num_empleado` (IN `empleado_num` VARCHAR(50), IN `opcion` VARCHAR(50))  BEGIN
DECLARE flag boolean;
DECLARE count int;
DECLARE msg varchar(500);

    IF(opcion='nuevo')THEN
        SELECT COUNT(*)
        FROM empleado
        WHERE num_empleado=empleado_num into count;
        IF(count>0)THEN
            SET flag=false;
            SET msg="El numero de empleado ya existe.";
            SELECT flag,msg;
        ELSE 
            INSERT INTO empleado (num_empleado,status)
            VALUES(empleado_num,'1');
            SET count = (select ROW_count());
            IF(count>0)then
                SET flag= true;
                SET msg='Registro correcto';
            ELSE 
                SET flag=false;
                SET msg='no se inserto';
            END IF;
            SELECT flag,msg;
        END IF;
    ELSE IF(opcion="eliminar")THEN
        UPDATE empleado SET 
        status="0"
        WHERE num_empleado=empleado_num;
            SET count = (select ROW_count());
            IF(count>0)then
                SET flag= true;
                SET msg='Registro eliminado correctamente';
            ELSE 
                SET flag=false;
                SET msg='no se actualizo';
            END IF;
            SELECT flag,msg;
        ELSE IF(opcion="desbloquear")THEN
            UPDATE empleado SET 
            status="2"
            WHERE num_empleado=empleado_num;
                SET count = (select ROW_count());
                IF(count>0)then
                    SET flag= true;
                    SET msg='Acceso otorgado';
                ELSE 
                    SET flag=false;
                    SET msg='no se actualizo';
                END IF;
                SELECT flag,msg;
            ELSE IF(opcion="bloquear")THEN
                UPDATE empleado SET 
                status="1"
                WHERE num_empleado=empleado_num;
                SET count = (select ROW_count());
                    IF(count>0)then
                        SET flag= true;
                        SET msg='Acceso bloqueado';
                    ELSE 
                        SET flag=false;
                        SET msg='no se actualizo';
                    END IF;
                    SELECT flag,msg;

                END IF; 

            END IF; 

        END IF;
    END IF;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `resultado_guia1`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `resultado_guia1` (`idEmpleado` INT(11)) RETURNS VARCHAR(500) CHARSET utf8 begin 
	DECLARE msj varchar(500);
	DECLARE contador integer(2);
	DECLARE cont_ii integer(2);
	DECLARE cont_iii integer(2);
	DECLARE cont_iv integer(2);

	SELECT valor_respuesta FROM respuesta r 
	INNER JOIN pregunta p ON r.pregunta_id= p.pregunta_id
	WHERE valor_respuesta=0 AND (p.seccion_id=1 and p.guia_id=1) AND num_empleado=idEmpleado into contador;

	SELECT COUNT(valor_respuesta) FROM respuesta r
	INNER JOIN pregunta p ON p.pregunta_id= r.pregunta_id
	WHERE valor_respuesta=1 AND (p.seccion_id=2 and p.guia_id=1) AND num_empleado=idEmpleado into cont_ii;

	SELECT COUNT(valor_respuesta) FROM respuesta r
	INNER JOIN pregunta p ON p.pregunta_id= r.pregunta_id
	WHERE valor_respuesta=1 AND (p.seccion_id=3 and p.guia_id=1) AND num_empleado=idEmpleado into cont_iii;

	SELECT COUNT(valor_respuesta) FROM respuesta r
	INNER JOIN pregunta p ON p.pregunta_id= r.pregunta_id
	WHERE valor_respuesta=1 AND (p.seccion_id=4 and p.guia_id=1) AND num_empleado=idEmpleado into cont_iv;

	IF(contador=0)THEN
		set msj="El Tabajador No Requiere de Valoración Clínica";

    ELSE
    	

		IF(cont_ii>=1 || cont_iii >=3 || cont_iv >=4)THEN
		set msj ="El Trabajador REQUIERE de Valoración Clínica";
		
		END IF;

    END IF;

    


return msj;
end$$

DROP FUNCTION IF EXISTS `sp_calcula_antiguedad`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_calcula_antiguedad` (`fecha` DATE) RETURNS VARCHAR(800) CHARSET latin1 BEGIN
DECLARE antiguedad varchar(800);
DECLARE meses INTEGER;
DECLARE years INTEGER;
DECLARE aux INTEGER;
DECLARE dias INTEGER;
    SET antiguedad=null;
    SELECT TIMESTAMPDIFF(MONTH,fecha, NOW() ) INTO meses;
    IF(meses>=12)THEN
        set years=meses/12;
        IF(meses%12=0)THEN
            IF(years>1)THEN
                set antiguedad=(Select CONCAT(years, ' años '));
            ELSE
                set antiguedad=(Select CONCAT(years, ' año '));
            END IF;
        ELSE
            set years=meses/12;
            set aux= years*12;
            set meses= meses-aux;
            IF(meses>1 AND years>1)THEN
                set antiguedad=(Select CONCAT(years, ' años ',meses,' meses '));
            ELSE IF(meses=1 AND years=1)THEN
                    set antiguedad=(Select CONCAT(years, ' año ',meses,' mes '));
                    ELSE IF(meses>1 and years=1)THEN
                            set antiguedad=(Select CONCAT(years, ' año ',meses,' meses '));
                        ELSE IF(years>1)THEN
                                set antiguedad=(Select CONCAT(years, ' años '));
                            else
                                set antiguedad=(Select CONCAT(years, ' año '));
                            END IF;
                        END IF;
                END IF;
            END IF;
        END IF;

    ELSE IF(meses>=1)THEN
            IF(meses=1)THEN
                set antiguedad=(Select CONCAT(meses, ' mes '));
            ELSE
                set antiguedad=(Select CONCAT(meses, ' meses '));
            END IF;
            
        ELSE
            SELECT TIMESTAMPDIFF(DAY,fecha, NOW() ) INTO dias;
            IF(dias>1 OR dias=0)THEN
                set antiguedad=(Select CONCAT(dias, ' días '));
            ELSE IF(dias=1)THEN
                    set antiguedad=(Select CONCAT(dias, ' día '));
                END IF;
            END IF;
            
        END IF;
    END IF;
    RETURN antiguedad;
    
END$$

DROP FUNCTION IF EXISTS `sp_get_calificacion_categoria`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_get_calificacion_categoria` (`total` INT(11), `id_categoria` INT(11)) RETURNS VARCHAR(500) CHARSET latin1 BEGIN
DECLARE resultado varchar(500);

    CASE id_categoria
    WHEN 1 THEN
        CASE
        WHEN total <3 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=3 and total <5 THEN
            set resultado='Bajo';
        WHEN total>=5 and total<7 THEN
            set resultado='Medio';
        WHEN total >=7 and total<9 THEN
            set resultado='Alto';
        WHEN total >=9 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 2 THEN
        CASE
        WHEN total <10 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=10 and total <20 THEN
            set resultado='Bajo';
        WHEN total>=20 and total<30 THEN
            set resultado='Medio';
        WHEN total >=30 and total<40 THEN
            set resultado='Alto';
        WHEN total >=40 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 3 THEN
        CASE
        WHEN total <4 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=4 and total <6 THEN
            set resultado='Bajo';
        WHEN total>=6 and total<9 THEN
            set resultado='Medio';
        WHEN total >=9 and total<12 THEN
            set resultado='Alto';
        WHEN total >=12 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 4 THEN
        CASE
        WHEN total <10 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=10 and total <18 THEN
            set resultado='Bajo';
        WHEN total>=18 and total<28 THEN
            set resultado='Medio';
        WHEN total >=28 and total<38 THEN
            set resultado='Alto';
        WHEN total >=38 THEN
            set resultado='Muy Alto';
        END CASE;
        
    END CASE;
    RETURN resultado;

END$$

DROP FUNCTION IF EXISTS `sp_get_calificacion_dominio`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_get_calificacion_dominio` (`total` INT(11), `id_dominio` INT(11)) RETURNS VARCHAR(500) CHARSET latin1 BEGIN
DECLARE resultado varchar(500);

    CASE id_dominio
    WHEN 1 THEN
        CASE
        WHEN total <3 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=3 and total <5 THEN
            set resultado='Bajo';
        WHEN total>=5 and total<7 THEN
            set resultado='Medio';
        WHEN total >=7 and total<9 THEN
            set resultado='Alto';
        WHEN total >=9 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 2 THEN
        CASE
        WHEN total <12 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=12 and total <16 THEN
            set resultado='Bajo';
        WHEN total>=16 and total<20 THEN
            set resultado='Medio';
        WHEN total >=20 and total<24 THEN
            set resultado='Alto';
        WHEN total >=24 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 3 THEN
        CASE
        WHEN total <5 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=5 and total <8 THEN
            set resultado='Bajo';
        WHEN total>=8 and total<11 THEN
            set resultado='Medio';
        WHEN total >=11 and total<14 THEN
            set resultado='Alto';
        WHEN total >=14 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 4 THEN
        CASE
        WHEN total <1 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=1 and total <2 THEN
            set resultado='Bajo';
        WHEN total>=2 and total<4 THEN
            set resultado='Medio';
        WHEN total >=4 and total<6 THEN
            set resultado='Alto';
        WHEN total >=6 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 5 THEN
        CASE
        WHEN total <1 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=1 and total <2 THEN
            set resultado='Bajo';
        WHEN total>=2 and total<4 THEN
            set resultado='Medio';
        WHEN total >=4 and total<6 THEN
            set resultado='Alto';
        WHEN total >=6 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 6 THEN
        CASE
        WHEN total <3 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=3 and total <5 THEN
            set resultado='Bajo';
        WHEN total>=5 and total<8 THEN
            set resultado='Medio';
        WHEN total >=8 and total<11 THEN
            set resultado='Alto';
        WHEN total >=11 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 7 THEN
        CASE
        WHEN total <5 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=5 and total <8 THEN
            set resultado='Bajo';
        WHEN total>=8 and total<11 THEN
            set resultado='Medio';
        WHEN total >=11 and total<14 THEN
            set resultado='Alto';
        WHEN total >=14 THEN
            set resultado='Muy Alto';
        END CASE;
    WHEN 8 THEN
        CASE
        WHEN total <7 THEN
            set resultado='Nulo o despreciable';
        WHEN total >=7 and total <10 THEN
            set resultado='Bajo';
        WHEN total>=10 and total<13 THEN
            set resultado='Medio';
        WHEN total >=13 and total<16 THEN
            set resultado='Alto';
        WHEN total >=16 THEN
            set resultado='Muy Alto';
        END CASE;        
        
    END CASE;
    RETURN resultado;

END$$

DROP FUNCTION IF EXISTS `sp_get_calificacion_final`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_get_calificacion_final` (`total` INT(11)) RETURNS VARCHAR(500) CHARSET latin1 BEGIN
DECLARE resultado varchar(500);
    CASE
    WHEN total <20 THEN
        set resultado='Nulo o despreciable';
    WHEN total >=20 and total <45 THEN
        set resultado='Bajo';
    WHEN total>=45 and total<70 THEN
        set resultado='Medio';
    WHEN total >=70 and total<90 THEN
        set resultado='Alto';
    WHEN total >=90 THEN
        set resultado='Muy Alto';
    END CASE;
    
    RETURN resultado;

END$$

DROP FUNCTION IF EXISTS `sp_get_desc_respuesta_guia_2`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_get_desc_respuesta_guia_2` (`id_pregunta` INT(11), `valor` INT(11)) RETURNS VARCHAR(500) CHARSET latin1 BEGIN
 DECLARE respuesta varchar(500);
 DECLARE forma_evaluar int UNSIGNED DEFAULT 0;   
    SELECT vp.forma_evaluar_id
    from valores_opciones vp
    where vp.pregunta_id= id_pregunta into forma_evaluar;

    IF(forma_evaluar=1)THEN
        CASE valor 
            WHEN 4 THEN
                set respuesta='NUNCA';
            WHEN 3 THEN
                set respuesta='CASI NUNCA';
            WHEN 2 THEN
                set respuesta='ALGUNAS VECES';
            WHEN 1 THEN
                set respuesta='CASI SIEMPRE';
            WHEN 0 THEN
                set respuesta='SIEMPRE';
            ELSE
                set respuesta=' - ';
        END CASE;

    ELSE IF(forma_evaluar=2)THEN
        CASE valor 
            WHEN 0 THEN
                set respuesta='NUNCA';
            WHEN 1 THEN
                set respuesta='CASI NUNCA';
            WHEN 2 THEN
                set respuesta='ALGUNAS VECES';
            WHEN 3 THEN
                set respuesta='CASI SIEMPRE';
            WHEN 4 THEN
                set respuesta='SIEMPRE';
            ELSE
             set respuesta=' - ';
        END CASE;
        END IF;
    END IF;
    

    
    RETURN respuesta;

END$$

DROP FUNCTION IF EXISTS `sp_get_valor_respuesta`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `sp_get_valor_respuesta` (`id_pregunta` INT(11), `respuesta` VARCHAR(200)) RETURNS INT(11) BEGIN
DECLARE forma_evaluar int UNSIGNED DEFAULT 0;
DECLARE valor int UNSIGNED DEFAULT 0;
    SELECT vp.forma_evaluar_id
	from valores_opciones vp
	where vp.pregunta_id= id_pregunta into forma_evaluar;

    IF(forma_evaluar=1)THEN
		CASE respuesta 
			WHEN 'NUNCA' THEN
				set valor=4;
			WHEN 'CASI NUNCA' THEN
				set valor=3;
			WHEN 'ALGUNAS VECES' THEN
				set valor=2;
			WHEN 'CASI SIEMPRE' THEN
				set valor=1;
			WHEN 'SIEMPRE' THEN
				set valor=0;
		END CASE;

    ELSE IF(forma_evaluar=2)THEN
    	CASE respuesta 
    		WHEN 'NUNCA' THEN
				set valor=0;
			WHEN 'CASI NUNCA' THEN
				set valor=1;
			WHEN 'ALGUNAS VECES' THEN
				set valor=2;
			WHEN 'CASI SIEMPRE' THEN
				set valor=3;
			WHEN 'SIEMPRE' THEN
				set valor=4;
		END CASE;
    	END IF;
    END IF;
    
    
    RETURN valor;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `categoria_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`categoria_id`,`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `guia_id`, `categoria_desc`) VALUES
(1, 2, 'Ambiente de trabajo'),
(2, 2, 'Factores propios de le actividad'),
(3, 2, 'Organización del tiempo de trabajo'),
(4, 2, 'Liderazgo y relaciones en el trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

DROP TABLE IF EXISTS `clasificacion`;
CREATE TABLE IF NOT EXISTS `clasificacion` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `dominio_id` int(11) NOT NULL,
  `dimension_id` int(11) NOT NULL,
  PRIMARY KEY (`pregunta_id`,`guia_id`),
  KEY `fk_categoria_clasi` (`categoria_id`),
  KEY `fk_dominio_clasi` (`dominio_id`),
  KEY `fk_dimension_clasi` (`dimension_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`pregunta_id`, `guia_id`, `categoria_id`, `dominio_id`, `dimension_id`) VALUES
(1, 2, 1, 1, 2),
(2, 2, 1, 1, 1),
(3, 2, 1, 1, 3),
(4, 2, 2, 2, 4),
(5, 2, 2, 2, 5),
(6, 2, 2, 2, 5),
(7, 2, 2, 2, 6),
(8, 2, 2, 2, 6),
(9, 2, 2, 2, 4),
(10, 2, 2, 2, 8),
(11, 2, 2, 2, 8),
(12, 2, 2, 2, 9),
(13, 2, 2, 2, 9),
(14, 2, 3, 4, 13),
(15, 2, 3, 4, 13),
(16, 2, 3, 5, 14),
(17, 2, 3, 5, 15),
(18, 2, 2, 3, 11),
(19, 2, 2, 3, 11),
(20, 2, 2, 3, 10),
(21, 2, 2, 3, 10),
(22, 2, 2, 3, 10),
(23, 2, 4, 6, 16),
(24, 2, 4, 6, 16),
(25, 2, 4, 6, 16),
(26, 2, 2, 3, 12),
(27, 2, 2, 3, 12),
(28, 2, 4, 6, 17),
(29, 2, 4, 6, 17),
(30, 2, 4, 7, 18),
(31, 2, 4, 7, 18),
(32, 2, 4, 7, 18),
(33, 2, 4, 8, 20),
(34, 2, 4, 8, 20),
(35, 2, 4, 8, 20),
(36, 2, 4, 8, 20),
(37, 2, 4, 8, 20),
(38, 2, 4, 8, 20),
(39, 2, 4, 8, 20),
(40, 2, 4, 8, 20),
(41, 2, 2, 2, 7),
(42, 2, 2, 2, 7),
(43, 2, 2, 2, 7),
(44, 2, 4, 7, 19),
(45, 2, 4, 7, 19),
(46, 2, 4, 7, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

DROP TABLE IF EXISTS `criterio`;
CREATE TABLE IF NOT EXISTS `criterio` (
  `criterio_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `criterio_nombre` varchar(500) NOT NULL,
  `criterio_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`criterio_id`,`guia_id`),
  KEY `guia_id` (`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `criterio`
--

INSERT INTO `criterio` (`criterio_id`, `guia_id`, `criterio_nombre`, `criterio_desc`) VALUES
(1, 2, 'Muy Alto', 'Se requiere realizar el análisis de cada categoría y dominio para establecer las acciones de intervención apropiadas. mediante un programa de intervención que deberá incluir evaluaciones especificas1, y contemplar campañas de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral así como reforzar su aplicación y difusión.'),
(2, 2, 'Alto', 'Se requiere realizar un análisis de cada categoría y dominio, de manera que se puedan determinar las acciones de intervención apropiadas a través de un Programa de intervención, que podrá incluir una evaluación especifica1 y deberá incluir una campaña de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión.'),
(3, 2, 'Medio', 'Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión, mediante un Programa de intervención.'),
(4, 2, 'Bajo', 'Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial. la promoción de un entorno organizacional favorable y la prevención de la violencia laboral. así corno reforzar su aplicación y difusión, mediante un Programa de intervención. Es necesario una mayor difusión de la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral.'),
(5, 2, 'Nulo o despreciable', 'El riesgo resulta despreciable por lo que no se requiere medidas adicionales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimension`
--

DROP TABLE IF EXISTS `dimension`;
CREATE TABLE IF NOT EXISTS `dimension` (
  `dimension_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `dimension_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`dimension_id`,`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dimension`
--

INSERT INTO `dimension` (`dimension_id`, `guia_id`, `dimension_desc`) VALUES
(1, 2, 'Condiciones peligrosas e inseguras '),
(2, 2, 'Condiciones deficientes e insalubres '),
(3, 2, 'Trabajos peligrosos '),
(4, 2, 'Cargas cuantitativas'),
(5, 2, 'Ritmos de trabajo acelerado'),
(6, 2, 'Carga mental'),
(7, 2, 'Cargas psicológicas emocionales'),
(8, 2, 'Cargas de alta responsabilidad'),
(9, 2, '\r\nCargas contradictorias o Inconsistentes'),
(10, 2, 'Falta de control y autonomía sobre el trabajo'),
(11, 2, 'Limitada o nula posibilidad do desarrollo'),
(12, 2, 'Limitada o inexistente capacitación'),
(13, 2, 'Jornadas de trabajo extensas'),
(14, 2, 'Influencia del trabajo fuera del centro laboral'),
(15, 2, 'Influencia de las responsabilidades familiares'),
(16, 2, 'Escasa claridad de funciones'),
(17, 2, 'Características del liderazgo'),
(18, 2, 'Relaciones sociales en el trabajo'),
(19, 2, 'Deficiente relación con los colaboradores que supervisa'),
(20, 2, 'Violencia laboral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE IF NOT EXISTS `division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_division` varchar(255) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `division`
--

INSERT INTO `division` (`division_id`, `nombre_division`) VALUES
(1, 'Administración de empresas'),
(2, 'Informática y computación'),
(3, 'Tecnología ambiental'),
(4, 'Comercialización'),
(5, 'Gestión de la producción'),
(6, 'Telemática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

DROP TABLE IF EXISTS `dominio`;
CREATE TABLE IF NOT EXISTS `dominio` (
  `dominio_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `dominio_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`dominio_id`,`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`dominio_id`, `guia_id`, `dominio_desc`) VALUES
(1, 2, 'Condiciones en el ambiente de trabajo'),
(2, 2, 'Carga de trabajo'),
(3, 2, 'Falta da control sobre el trabajo'),
(4, 2, 'Jornada do trabajo'),
(5, 2, 'Interferencia en la relación trabajo-familia'),
(6, 2, 'Liderazgo'),
(7, 2, 'Relaciones en el trabajo'),
(8, 2, 'Violencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `num_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `nivel_estudios_id` int(11) DEFAULT NULL,
  `status_estudios` varchar(1) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `antiguedad_puesto` date DEFAULT NULL,
  `fecha_antiguedad` date DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`num_empleado`),
  KEY `FK_nivel_estudios` (`nivel_estudios_id`),
  KEY `FK_division` (`division_id`),
  KEY `FK_usuario` (`usuario_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98765433 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`num_empleado`, `nombre_empleado`, `apellidos`, `edad`, `sexo`, `nivel_estudios_id`, `status_estudios`, `division_id`, `usuario_id`, `rol_id`, `antiguedad_puesto`, `fecha_antiguedad`, `status`) VALUES
(123456, 'Luis Manuel', 'Fernandez Hernandez', 55, 'M', 7, '1', 2, 1, 1, '1986-09-01', NULL, '1'),
(654321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(11223344, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2'),
(12345678, 'Gerardo', 'Pluma Bautista', 56, 'M', 6, '1', 2, NULL, 2, '2009-04-02', '2009-04-02', '3'),
(12345679, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(12345688, 'María de los Santos', 'Mexica Rivera', 56, 'F', 7, '1', 2, NULL, 2, '2007-04-05', '2007-04-05', '3'),
(22334455, 'Gilberto', 'Pacheco Gallegos', 43, 'M', 7, '1', 2, NULL, 2, '2003-05-02', '2001-04-01', '3'),
(87654321, 'Enrrique', 'Perez Sulivan', 67, 'M', 2, '1', 1, NULL, 2, '2020-06-03', '2020-06-01', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_evaluacion`
--

DROP TABLE IF EXISTS `forma_evaluacion`;
CREATE TABLE IF NOT EXISTS `forma_evaluacion` (
  `forma_evaluar_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`forma_evaluar_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `forma_evaluacion`
--

INSERT INTO `forma_evaluacion` (`forma_evaluar_id`, `forma_desc`) VALUES
(1, 'La forma de calificar las respuestas es \r\nSiempre=0, casi siempre=1, algunas veces=2, casi nunca= 3, nunca= 4'),
(2, 'La forma de calificar las respuestas es \r\nSiempre=4, casi siempre=3, algunas veces=2, casi nunca=1, nunca= 0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

DROP TABLE IF EXISTS `guia`;
CREATE TABLE IF NOT EXISTS `guia` (
  `guia_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_nombre` varchar(500) NOT NULL,
  `guia_desc` varchar(800) NOT NULL,
  PRIMARY KEY (`guia_id`),
  KEY `index_guia_id` (`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`guia_id`, `guia_nombre`, `guia_desc`) VALUES
(1, 'Guía de Referencia 1', 'CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS'),
(2, 'Guía de Referencia 2', 'CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL EN LOS CENTROS DE TRABAJO'),
(3, 'Guía de Referencia 3', 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACIÓN DEL ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_estudios`
--

DROP TABLE IF EXISTS `nivel_estudios`;
CREATE TABLE IF NOT EXISTS `nivel_estudios` (
  `nivel_estudios_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estudios` varchar(255) NOT NULL,
  PRIMARY KEY (`nivel_estudios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_estudios`
--

INSERT INTO `nivel_estudios` (`nivel_estudios_id`, `nombre_estudios`) VALUES
(1, 'Sin formación'),
(2, 'Primaria'),
(3, 'Secundaria'),
(4, 'Preparatoria o Bachillerato'),
(5, 'Técnico Superior'),
(6, 'Licenciatura'),
(7, 'Maestría'),
(8, 'Doctorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `seccion_id` int(11) DEFAULT NULL,
  `pregunta_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pregunta_id`,`guia_id`) USING BTREE,
  KEY `FK_seccion` (`seccion_id`),
  KEY `guia_id` (`guia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `guia_id`, `seccion_id`, `pregunta_desc`) VALUES
(1, 1, 1, '¿Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimiento como las siguientes:   \r\n¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?                    \r\n¿Asaltos?\r\n¿Actos Violentos que derivaron en lesiones graves? \r\n¿Secuestros?    \r\n¿Amenazas?, o Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?'),
(1, 2, 1, 'Mi trabajo me exige hacer mucho esfuerzo físico.'),
(2, 1, 2, '¿Ha tenido recuedos recurrentes sobre el acontecimiento que le provocan malestares?\r\n'),
(2, 2, 1, 'Me preocupa sufrir un accidente en mi trabajo'),
(3, 1, 2, '¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?'),
(3, 2, 1, 'Considero que las actividades que realizo son peligrosas.'),
(4, 1, 3, '¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?'),
(4, 2, 1, 'Por la cantidad de trabajo que tongo debo quedarme tiempo adicional a mi turno.'),
(5, 1, 3, '¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimientos?'),
(5, 2, 1, 'Por le cantidad de trabajo que tongo debo trabajar sin parar'),
(6, 1, 3, '¿Ha tenido dificultad para recordar alguna parte importante el evento?'),
(6, 2, 1, 'Considero que es necesario mantener un ritmo de trabajo acelerado.'),
(7, 1, 3, '¿Ha disminuido su interés en sus actividades cotidianas?'),
(7, 2, 1, 'Mi trabajo exige que este muy concentrado.'),
(8, 1, 3, '¿Se ha sentido usted alejado o distante de los demás?'),
(8, 2, 1, 'Mi trabajo requiere que memorice mucha información.'),
(9, 1, 3, '¿Ha notado que tiene dificultad para expresar sus sentimientos?'),
(9, 2, 1, 'Mi trabajo exige que atienda varios asuntos al mismo tiempo.'),
(10, 1, 3, '¿Ha tenido la impresión de que su vida se va a acortar, que se va a morir antes que otras personas o que tiene un futuro limitado?'),
(10, 2, 2, 'En mi trabajo soy responsable de cosas de mucho valor.'),
(11, 1, 4, '¿Ha tenido dificultades para dormir?'),
(11, 2, 2, 'Respondo ante mi jefe por los resultados de toda mí área de trabajo. '),
(12, 1, 4, '¿Ha estado particularmente irritable  o le han dado arranques de coraje?'),
(12, 2, 2, 'En mi trabajo me dan Órdenes contradictorias.'),
(13, 1, 4, '¿Ha tenido dificultad para concentrarse?'),
(13, 2, 2, 'Considero que en mi trabajo me piden hacer cosas innecesarias.'),
(14, 1, 4, '¿Ha estado nervioso o constantemente en alerta?'),
(14, 2, 3, 'Trabajo horas extras mas de tres veces a la semana.'),
(15, 1, 4, '¿Se ha sobresaltado fácilmente por cualquier cosa?'),
(15, 2, 3, 'Mi trabajo me exige laborar en días de descanso, festivos y fines de semana.'),
(16, 2, 3, 'Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales.'),
(17, 2, 3, '\r\nPienso en las actividades familiares o personales cuando estoy en el trabajo.'),
(18, 2, 4, 'Mi trabajo permite que desarrolle nuevas habilidades.'),
(19, 2, 4, 'En mi trabajo puedo aspirar a un mejor puesto.'),
(20, 2, 4, 'Durante la jornada de trabajo puedo tomar pausas cuando las necesito.'),
(21, 2, 4, 'Puedo decidir a la velocidad en la que realizo mis actividades en mi trabajo.'),
(22, 2, 4, 'Puedo cambiar el orden de las actividades que realizo en mi trabajo.'),
(23, 2, 5, 'Me informan con claridad cuales son mis funciones.'),
(24, 2, 5, 'Me explican claramente los resultados que debo obtener en mi trabajo.'),
(25, 2, 5, 'Me Informan con quién puedo resolver problemas o asuntos de trabajo.'),
(26, 2, 5, ' Me permiten asistir a capacitaciones relacionadas con mi trabajo.'),
(27, 2, 5, 'Recibo capacitación útil para hacer mi trabajo.'),
(28, 2, 6, 'Mi jefe tiene en cuenta mis puntos de vista y opiniones.'),
(29, 2, 6, 'Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo.'),
(30, 2, 6, 'Puedo confiar en mis compañeros de trabajo.'),
(31, 2, 6, 'Cuando tenemos que realizar trabajo de equipo los compañeros colaboran.'),
(32, 2, 6, 'Mis compañeros de trabajo me ayudan cuando tengo dificultades.'),
(33, 2, 6, 'En mi trabajo puedo expresarme libremente sin interrupciones.'),
(34, 2, 6, 'Recibo criticas constantes a mi persona y/o trabajo.'),
(35, 2, 6, 'Recibo burlas,calumnias, difamaciones,humillaciones o rídiculizaciones.'),
(36, 2, 6, 'Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones.'),
(37, 2, 6, 'Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador. '),
(38, 2, 6, 'Se Ignoran mis éxitos laborales y se atribuyen a otros trabajadores.'),
(39, 2, 6, 'Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo.'),
(40, 2, 6, 'He presenciado actos de violencia en mi centro de trabajo.'),
(41, 2, 7, 'Atiendo clientes o usuarios muy enojados.'),
(42, 2, 7, 'Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas. '),
(43, 2, 7, 'Para hacer mi trabajo debo demostrar sentimientos distintos a los míos. '),
(44, 2, 8, 'Comunican tarde los asuntos de trabajo.'),
(45, 2, 8, 'Dificultan el logro de los resultados del trabajo.'),
(46, 2, 8, 'Ignoran las sugerencias para mejorar su trabajo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE IF NOT EXISTS `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `num_empleado` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `guia_id` int(11) NOT NULL,
  `valor_respuesta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`respuesta_id`),
  KEY `fk_resp` (`num_empleado`),
  KEY `fk_resp_preg` (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`respuesta_id`, `num_empleado`, `pregunta_id`, `guia_id`, `valor_respuesta`) VALUES
(1, 12345678, 1, 1, 1),
(2, 12345678, 2, 1, 0),
(3, 12345678, 3, 1, 1),
(4, 12345678, 4, 1, 0),
(5, 12345678, 5, 1, 0),
(6, 12345678, 6, 1, 0),
(7, 12345678, 7, 1, 0),
(8, 12345678, 8, 1, 1),
(9, 12345678, 9, 1, 0),
(10, 12345678, 10, 1, 0),
(11, 12345678, 11, 1, 0),
(12, 12345678, 12, 1, 1),
(13, 12345678, 13, 1, 0),
(14, 12345678, 14, 1, 0),
(15, 12345678, 15, 1, 0),
(16, 12345688, 1, 1, 0),
(17, 22334455, 1, 1, 1),
(18, 22334455, 2, 1, 1),
(19, 22334455, 3, 1, 0),
(20, 22334455, 4, 1, 0),
(21, 22334455, 5, 1, 0),
(22, 22334455, 6, 1, 0),
(23, 22334455, 7, 1, 0),
(24, 22334455, 8, 1, 0),
(25, 22334455, 9, 1, 1),
(26, 22334455, 10, 1, 0),
(27, 22334455, 11, 1, 0),
(28, 22334455, 12, 1, 0),
(29, 22334455, 13, 1, 0),
(30, 22334455, 14, 1, 0),
(31, 22334455, 15, 1, 0),
(32, 87654321, 1, 0, 0),
(34, 22334455, 1, 2, 1),
(35, 22334455, 2, 2, 1),
(36, 22334455, 3, 2, 0),
(37, 22334455, 4, 2, 3),
(38, 22334455, 5, 2, 2),
(39, 22334455, 6, 2, 4),
(40, 22334455, 7, 2, 4),
(41, 22334455, 8, 2, 2),
(42, 22334455, 9, 2, 2),
(43, 22334455, 10, 2, 1),
(44, 22334455, 11, 2, 3),
(45, 22334455, 12, 2, 2),
(46, 22334455, 13, 2, 0),
(47, 22334455, 14, 2, 2),
(48, 22334455, 15, 2, 2),
(49, 22334455, 16, 2, 2),
(50, 22334455, 17, 2, 2),
(51, 22334455, 18, 2, 2),
(52, 22334455, 19, 2, 0),
(53, 22334455, 20, 2, 1),
(54, 22334455, 21, 2, 1),
(55, 22334455, 22, 2, 1),
(56, 22334455, 23, 2, 1),
(57, 22334455, 24, 2, 0),
(58, 22334455, 25, 2, 0),
(59, 22334455, 26, 2, 1),
(60, 22334455, 27, 2, 1),
(61, 22334455, 28, 2, 2),
(62, 22334455, 29, 2, 1),
(63, 22334455, 30, 2, 2),
(64, 22334455, 31, 2, 0),
(65, 22334455, 32, 2, 1),
(66, 22334455, 33, 2, 1),
(67, 22334455, 34, 2, 1),
(68, 22334455, 35, 2, 0),
(69, 22334455, 36, 2, 0),
(70, 22334455, 37, 2, 0),
(71, 22334455, 38, 2, 0),
(72, 22334455, 39, 2, 0),
(73, 22334455, 40, 2, 0),
(74, 22334455, 44, 2, 2),
(75, 22334455, 45, 2, 1),
(76, 22334455, 46, 2, 0),
(77, 22334455, 41, 2, NULL),
(78, 22334455, 42, 2, NULL),
(79, 22334455, 43, 2, NULL),
(80, 12345688, 1, 2, 1),
(81, 12345688, 2, 2, 1),
(82, 12345688, 3, 2, 1),
(83, 12345688, 4, 2, 3),
(84, 12345688, 5, 2, 3),
(85, 12345688, 6, 2, 3),
(86, 12345688, 7, 2, 3),
(87, 12345688, 8, 2, 2),
(88, 12345688, 9, 2, 2),
(89, 12345688, 10, 2, 1),
(90, 12345688, 11, 2, 1),
(91, 12345688, 12, 2, 0),
(92, 12345688, 13, 2, 0),
(93, 12345688, 14, 2, 3),
(94, 12345688, 15, 2, 3),
(95, 12345688, 16, 2, 3),
(96, 12345688, 17, 2, 3),
(97, 12345688, 18, 2, 1),
(98, 12345688, 19, 2, 3),
(99, 12345688, 20, 2, 4),
(100, 12345688, 21, 2, 3),
(101, 12345688, 22, 2, 3),
(102, 12345688, 23, 2, 1),
(103, 12345688, 24, 2, 1),
(104, 12345688, 25, 2, 1),
(105, 12345688, 26, 2, 4),
(106, 12345688, 27, 2, 2),
(107, 12345688, 28, 2, 3),
(108, 12345688, 29, 2, 2),
(109, 12345688, 30, 2, 2),
(110, 12345688, 31, 2, 1),
(111, 12345688, 32, 2, 1),
(112, 12345688, 33, 2, 2),
(113, 12345688, 34, 2, 1),
(114, 12345688, 35, 2, 1),
(115, 12345688, 36, 2, 2),
(116, 12345688, 37, 2, 1),
(117, 12345688, 38, 2, 2),
(118, 12345688, 39, 2, 2),
(119, 12345688, 40, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `nombre_seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`seccion_id`,`guia_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`seccion_id`, `guia_id`, `nombre_seccion`) VALUES
(1, 1, 'I.- Acontecimiento traumático severo'),
(1, 2, 'Para responder las preguntas siguientes considere las condiciones de su centro de trabajo, asi como la cantidad y ritmo de trabajo.'),
(2, 1, 'II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes:'),
(2, 2, 'Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.'),
(3, 1, 'III.- Esfuerzo por evitar circustancias parecidas o asociadas al acontecimiento (durante el último mes):'),
(3, 2, 'Las preguntas siguientes están relacionadas con el tiempo destinado a su trabajo y sus responsabilidades familiares.'),
(4, 1, 'IV.- Afectación (durante el último mes):'),
(4, 2, 'Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.'),
(5, 2, 'Las preguntas siguientes están relacionadas con la capacitación e información que recibe sobre su trabajo.'),
(6, 2, 'Las preguntas siguientes se refieren a las relaciones con sus compañeros de trabajo y su jefe.'),
(7, 2, 'Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.'),
(8, 2, 'Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `password`, `status`) VALUES
(1, '7c222fb2927d828af22f592134e8932480637c0d', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
CREATE TABLE IF NOT EXISTS `usuario_rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) NOT NULL,
  `rol_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`rol_id`, `nombre_rol`, `rol_desc`) VALUES
(1, 'Administrador', 'Este rol puede ver los resultados de los empleados que realizan la guia de referencia'),
(2, 'Docente', 'Este rol es profesor que labora en la presente institucion y contesta las guias'),
(3, 'Administrativo', 'Rol de los empleados que realizan actividades de gestión por ejemplo Directores, Secretarias o control escolar etc.'),
(4, 'Otro', 'Este rol es un empleado que labora en la institucion pero  no es docente ni administrativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores_opciones`
--

DROP TABLE IF EXISTS `valores_opciones`;
CREATE TABLE IF NOT EXISTS `valores_opciones` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `guia_id` int(11) NOT NULL,
  `forma_evaluar_id` int(11) NOT NULL,
  PRIMARY KEY (`pregunta_id`,`guia_id`),
  KEY `guia_id` (`guia_id`),
  KEY `fk_form_valor` (`forma_evaluar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valores_opciones`
--

INSERT INTO `valores_opciones` (`pregunta_id`, `guia_id`, `forma_evaluar_id`) VALUES
(18, 2, 1),
(19, 2, 1),
(20, 2, 1),
(21, 2, 1),
(22, 2, 1),
(23, 2, 1),
(24, 2, 1),
(25, 2, 1),
(26, 2, 1),
(27, 2, 1),
(28, 2, 1),
(29, 2, 1),
(30, 2, 1),
(31, 2, 1),
(32, 2, 1),
(33, 2, 1),
(1, 2, 2),
(2, 2, 2),
(3, 2, 2),
(4, 2, 2),
(5, 2, 2),
(6, 2, 2),
(7, 2, 2),
(8, 2, 2),
(9, 2, 2),
(10, 2, 2),
(11, 2, 2),
(12, 2, 2),
(13, 2, 2),
(14, 2, 2),
(15, 2, 2),
(16, 2, 2),
(17, 2, 2),
(34, 2, 2),
(35, 2, 2),
(36, 2, 2),
(37, 2, 2),
(38, 2, 2),
(39, 2, 2),
(40, 2, 2),
(41, 2, 2),
(42, 2, 2),
(43, 2, 2),
(44, 2, 2),
(45, 2, 2),
(46, 2, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD CONSTRAINT `fk_categoria_clasi` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `fk_dimension_clasi` FOREIGN KEY (`dimension_id`) REFERENCES `dimension` (`dimension_id`),
  ADD CONSTRAINT `fk_dominio_clasi` FOREIGN KEY (`dominio_id`) REFERENCES `dominio` (`dominio_id`);

--
-- Filtros para la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD CONSTRAINT `criterio_ibfk_1` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`guia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_division` FOREIGN KEY (`division_id`) REFERENCES `division` (`division_id`),
  ADD CONSTRAINT `FK_nivel_estudios` FOREIGN KEY (`nivel_estudios_id`) REFERENCES `nivel_estudios` (`nivel_estudios_id`),
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `usuario_rol` (`rol_id`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `FK_seccion` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`seccion_id`),
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`guia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_resp` FOREIGN KEY (`num_empleado`) REFERENCES `empleado` (`num_empleado`),
  ADD CONSTRAINT `fk_resp_preg` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`pregunta_id`);

--
-- Filtros para la tabla `valores_opciones`
--
ALTER TABLE `valores_opciones`
  ADD CONSTRAINT `fk_form_valor` FOREIGN KEY (`forma_evaluar_id`) REFERENCES `forma_evaluacion` (`forma_evaluar_id`),
  ADD CONSTRAINT `valores_opciones_ibfk_1` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`guia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
