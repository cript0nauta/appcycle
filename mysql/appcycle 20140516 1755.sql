-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.15-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema appcycle
--

CREATE DATABASE IF NOT EXISTS appcycle;
USE appcycle;

--
-- Definition of table `appcycle_categorias`
--

DROP TABLE IF EXISTS `appcycle_categorias`;
CREATE TABLE `appcycle_categorias` (
  `idcategoria` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `baja_logica` tinyint(1) NOT NULL,
  `idusuario` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appcycle_categorias`
--

/*!40000 ALTER TABLE `appcycle_categorias` DISABLE KEYS */;
INSERT INTO `appcycle_categorias` (`idcategoria`,`nombre`,`descripcion`,`fecha_alta`,`baja_logica`,`idusuario`) VALUES 
 (1,'Botellas','Botella Vidrio','2014-05-16 17:46:04',0,1),
 (2,'Latas','Latas','2014-05-16 17:46:06',0,1),
 (3,'Papel','Papel','2014-05-16 17:46:09',0,1),
 (4,'Tapitas','Tapitas Metal','2014-05-16 17:46:10',0,1),
 (5,'Neumaticos','Neumaticos','2014-05-16 17:46:11',0,1);
/*!40000 ALTER TABLE `appcycle_categorias` ENABLE KEYS */;


--
-- Definition of table `appcycle_dblog`
--

DROP TABLE IF EXISTS `appcycle_dblog`;
CREATE TABLE `appcycle_dblog` (
  `llamada` text,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appcycle_dblog`
--

/*!40000 ALTER TABLE `appcycle_dblog` DISABLE KEYS */;
INSERT INTO `appcycle_dblog` (`llamada`,`fecha`) VALUES 
 ('call appcycle_login(\'admin\',\'1a1dc91c907325c69271ddf0c944bc72\');','2014-05-16 13:02:28'),
 ('call appcycle_login(\'admin\',\'1a1dc91c907325c69271ddf0c944bc72\');','2014-05-16 13:02:42');
/*!40000 ALTER TABLE `appcycle_dblog` ENABLE KEYS */;


--
-- Definition of table `appcycle_productos`
--

DROP TABLE IF EXISTS `appcycle_productos`;
CREATE TABLE `appcycle_productos` (
  `idappcycle` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `link` varchar(200) NOT NULL,
  `video` varchar(200) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `baja_logica` tinyint(1) NOT NULL,
  `idusuario` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idappcycle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appcycle_productos`
--

/*!40000 ALTER TABLE `appcycle_productos` DISABLE KEYS */;
INSERT INTO `appcycle_productos` (`idappcycle`,`titulo`,`descripcion`,`link`,`video`,`tags`,`fecha_alta`,`baja_logica`,`idusuario`) VALUES 
 (3,'titulo nuevo','descripcion nueva','link nuevo','video nuevo','tag nuevo','2014-05-16 13:29:13',0,1),
 (4,'titulo de prueba','descripcion de prueba','link de prueba','video de prueba','tag de prueba','2014-05-16 13:31:21',0,1),
 (5,'proucto1','knxln','','','','2014-05-16 16:07:36',0,1);
/*!40000 ALTER TABLE `appcycle_productos` ENABLE KEYS */;


--
-- Definition of table `appcycle_usuarios`
--

DROP TABLE IF EXISTS `appcycle_usuarios`;
CREATE TABLE `appcycle_usuarios` (
  `idusuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baja_logica` tinyint(1) NOT NULL DEFAULT '0',
  `ultimo_ingreso` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ultimo_cambio_pass` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tipodeusuario` varchar(13) NOT NULL DEFAULT '0',
  `encriptado` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='tabla de registro y validacion usuarios';

--
-- Dumping data for table `appcycle_usuarios`
--

/*!40000 ALTER TABLE `appcycle_usuarios` DISABLE KEYS */;
INSERT INTO `appcycle_usuarios` (`idusuario`,`nombre`,`clave`,`fecha_alta`,`baja_logica`,`ultimo_ingreso`,`ultimo_cambio_pass`,`tipodeusuario`,`encriptado`,`username`) VALUES 
 (1,'Administrador','1a1dc91c907325c69271ddf0c944bc72','2014-05-16 12:54:32',0,'2014-05-16 12:54:32','2014-05-16 12:54:32','1','c4ca4238a0b923820dcc509a6f75849b','admin');
/*!40000 ALTER TABLE `appcycle_usuarios` ENABLE KEYS */;


--
-- Definition of procedure `appcycle_delete_productos`
--

DROP PROCEDURE IF EXISTS `appcycle_delete_productos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_delete_productos`(
	in xidappcycle bigint,
    in xidusuario bigint
)
BEGIN

delete from appcycle_productos where idappcycle = xidappcycle;

select true as info,'Registro Eliminado con Exito' as msg;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_get_categorias`
--

DROP PROCEDURE IF EXISTS `appcycle_get_categorias`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_get_categorias`()
BEGIN
  select * from appcycle_categorias;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_get_productos`
--

DROP PROCEDURE IF EXISTS `appcycle_get_productos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_get_productos`(
			IN pagina int,
			IN filtro varchar(100)
		)
BEGIN
		set @query = 'select idappcycle,titulo,descripcion,link,video,tags,fecha_alta,baja_logica,idusuario from appcycle_productos tab
		where tab.baja_logica = 0 ';
		
		if(pagina = 1)
		then
			set pagina = 0;
		else
			if( pagina > 1)
			then
			set pagina = pagina - 1;
			end if;
			set pagina = pagina * 10;
		end if;
		
		if(pagina is not null)
		then
			set @limit = concat(' limit ',pagina,',10;');
		else
			set @limit = ';';
		end if;
		
		set @querycompleto = Concat(@query, @limit);
		
		PREPARE stmt FROM @querycompleto;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		
		END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_get_productos_by_id`
--

DROP PROCEDURE IF EXISTS `appcycle_get_productos_by_id`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_get_productos_by_id`(
			IN xid bigint
		)
BEGIN
		
		select * from appcycle_productos tab where tab.baja_logica = 0 and idappcycle = xid;

		END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_get_usuario_by_id`
--

DROP PROCEDURE IF EXISTS `appcycle_get_usuario_by_id`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_get_usuario_by_id`(
        in xidusuario bigint
	)
BEGIN
	
		select * from appcycle_usuarios where idusuario = xidusuario and baja_logica = 0;
	
	END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_insert_dblog`
--

DROP PROCEDURE IF EXISTS `appcycle_insert_dblog`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_insert_dblog`(
        in texto text
	)
BEGIN
	
		insert into appcycle_dblog (llamada,fecha) values (texto,now());
	
	END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_insert_productos`
--

DROP PROCEDURE IF EXISTS `appcycle_insert_productos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_insert_productos`(
IN xtitulo varchar(200),IN xdescripcion varchar(1000),IN xlink varchar(200),IN xvideo varchar(200),IN xtags varchar(200),IN xidusuario bigint(20) unsigned
)
BEGIN

insert into appcycle_productos(titulo,descripcion,link,video,tags,fecha_alta,baja_logica,idusuario) values (xtitulo,xdescripcion,xlink,xvideo,xtags,now(),0,xidusuario);
select true as info,'Registro Ingresado con Exito' as msg;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_login`
--

DROP PROCEDURE IF EXISTS `appcycle_login`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_login`(
        in xusername varchar(100),
        in xpassword varchar(50)
	)
BEGIN
		set @usuario = (select idusuario from appcycle_usuarios where username = xusername and baja_logica = 0);
		set @login = (select idusuario from appcycle_usuarios where username = xusername and clave = xpassword and baja_logica = 0);
		
		if((@usuario is null) && (@login is null))
		then
		set @info = false;
		set @msg  = 'Usuario no Existe, Verifique el correo ingresado';
		end if;
		
		if((@usuario is not null) && (@login is null))
		then
		set @info = false;
		set @msg  = 'Password Incorrecta, por favor verifique';
		end if;
		
		if( (@usuario is not null) && (@login is not null) )
		then
		set @info = true;
		set @msg  = 'Login Exitoso, Bienvenido...';
		end if;
		
		select @info as info,@msg as msg, @usuario as idusuario;
		
	END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `appcycle_update_productos`
--

DROP PROCEDURE IF EXISTS `appcycle_update_productos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `appcycle_update_productos`(
IN xidappcycle bigint(20) unsigned,IN xtitulo varchar(200),IN xdescripcion varchar(1000),IN xlink varchar(200),IN xvideo varchar(200),IN xtags varchar(200),
IN xidusuario bigint
)
BEGIN

update appcycle_productos set titulo = xtitulo,descripcion = xdescripcion,link = xlink,video = xvideo,tags = xtags where idappcycle = xidappcycle;
select true as info,'Actualizacion Exitosa' as msg;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
