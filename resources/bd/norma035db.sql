-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-06-2020 a las 02:48:44
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
        e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol
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
        e.division_id,d.nombre_division,e.usuario_id,e.rol_id,ur.nombre_rol
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
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion from pregunta p, seccion s
	where p.seccion_id= s.seccion_id
    and p.seccion_id= 2;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas3`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas3` ()  BEGIN
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion from pregunta p, seccion s
	where p.seccion_id= s.seccion_id
    and p.seccion_id= 3;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntas4`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntas4` ()  BEGIN
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion from pregunta p, seccion s
	where p.seccion_id= s.seccion_id
    and p.seccion_id= 4;
END$$

DROP PROCEDURE IF EXISTS `sp_get_preguntasI`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_preguntasI` ()  BEGIN
	SELECT p.pregunta_id,p.seccion_id,p.pregunta_desc,s.nombre_seccion from pregunta p, seccion s
	where p.seccion_id= s.seccion_id
    and p.seccion_id= 1;
END$$

DROP PROCEDURE IF EXISTS `sp_get_puestos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_puestos` ()  BEGIN
    SELECT ur.rol_id,ur.nombre_rol,
    ur.rol_desc
    from usuario_rol ur
    where ur.rol_id>1;
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

DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=87654322 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`num_empleado`, `nombre_empleado`, `apellidos`, `edad`, `sexo`, `nivel_estudios_id`, `status_estudios`, `division_id`, `usuario_id`, `rol_id`, `antiguedad_puesto`, `fecha_antiguedad`, `status`) VALUES
(123456, 'Luis Manuel', 'Fernandez Hernandez', 55, 'M', 7, '1', 2, 1, 1, '1986-09-01', NULL, '1'),
(654321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(12345678, 'Gerardo', 'Pluma Bautista', 56, 'M', 6, '1', 2, NULL, 2, '2009-04-02', '2009-04-02', '3'),
(12345679, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(12345688, 'María de los Santos', 'Mexica Rivera', 56, 'F', 7, '1', 2, NULL, 2, '2007-04-05', '2007-04-05', '3'),
(87654321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_bulkload`
--

DROP TABLE IF EXISTS `empleado_bulkload`;
CREATE TABLE IF NOT EXISTS `empleado_bulkload` (
  `lote` int(11) NOT NULL,
  `bulkload_id` int(11) NOT NULL,
  `num_empleado` int(11) DEFAULT NULL,
  `nombre_empleado` varchar(500) DEFAULT NULL,
  `apellidos` varchar(500) DEFAULT NULL,
  `edad` varchar(500) DEFAULT NULL,
  `sexo` varchar(500) DEFAULT NULL,
  `nivel_studios` varchar(500) DEFAULT NULL,
  `division` varchar(500) DEFAULT NULL,
  `rol` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `observaciones` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`lote`,`bulkload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `seccion_id` int(11) DEFAULT NULL,
  `pregunta_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pregunta_id`),
  KEY `FK_seccion` (`seccion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `seccion_id`, `pregunta_desc`) VALUES
(1, 1, '¿Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimiento como las siguientes:   \r\n¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?                    \r\n¿Asaltos?\r\n¿Actos Violentos que derivaron en lesiones graves? \r\n¿Secuestros?    \r\n¿Amenazas?, o Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?'),
(2, 2, '¿Ha tenido recuedos recurrentes sobre el acontecimiento que le provocan malestares?\r\n'),
(3, 2, '¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?'),
(4, 3, '¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?'),
(5, 3, '¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimientos?'),
(6, 3, '¿Ha tenido dificultad para recordar alguna parte importante el evento?'),
(7, 3, '¿Ha disminuido su interés en sus actividades cotidianas?'),
(8, 3, '¿Se ha sentido usted alejado o distante de los demás?'),
(9, 3, '¿Ha notado que tiene dificultad para expresar sus sentimientos?'),
(10, 3, '¿Ha tenido la impresión de que su vida se va a acortar, que se va a morir antes que otras personas o que tiene un futuro limitado?'),
(11, 4, '¿Ha tenido dificultades para dormir?'),
(12, 4, '¿Ha estado particularmente irritable  o le han dado arranques de coraje?'),
(13, 4, '¿Ha tenido dificultad para concentrarse?'),
(14, 4, '¿Ha estado nervioso o constantemente en alerta?'),
(15, 4, '¿Se ha sobresaltado fácilmente por cualquier cosa?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE IF NOT EXISTS `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `num_empleado` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `valor_respuesta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`respuesta_id`, `num_empleado`, `pregunta_id`, `valor_respuesta`) VALUES
(1, 12345678, 1, 1),
(2, 12345678, 2, 0),
(3, 12345678, 3, 1),
(4, 12345678, 4, 0),
(5, 12345678, 5, 0),
(6, 12345678, 6, 0),
(7, 12345678, 7, 0),
(8, 12345678, 8, 1),
(9, 12345678, 9, 0),
(10, 12345678, 10, 0),
(11, 12345678, 11, 0),
(12, 12345678, 12, 1),
(13, 12345678, 13, 0),
(14, 12345678, 14, 0),
(15, 12345678, 15, 0),
(16, 12345688, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`seccion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`seccion_id`, `nombre_seccion`) VALUES
(1, 'I.- Acontecimiento traumático severo'),
(2, 'II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes:'),
(3, 'III.- Esfuerzo por evitar circustancias parecidas o asociadas al acontecimiento (durante el último mes):'),
(4, 'IV.- Afectación (durante el último mes):');

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

--
-- Restricciones para tablas volcadas
--

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
  ADD CONSTRAINT `FK_seccion` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`seccion_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
