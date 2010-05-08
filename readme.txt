

Panel de modificación del perfil
  * show_position_map($w,$h)
      - muestra el el mapa de posición para el usuario actual con los controles de actualización
      - parámetros:
          $w: anchura en pixels del mapa de google maps
          $h: altura en pixels del mapa de google maps


Mapa de ubicación de todos los foreros
  * show_fullusermap($width,$height,$lat_center, $lon_center, $zoom)
      - muestra un mapa con un marcador en la posición de cada forero
      - parámetros
          $width: anchura en pixels del mapa de google maps
          $height: anchura en pixels del mapa de google maps
          $lat_center: latitud inicial del centro del mapa
          $lon_center: longitud inicial del centro del mapa
          $zoom: nivel de zoom inicial (1 = toda la tierra, 14 = máximo acercamiento)

Instalación:
------------
Copiar los ficheros y lanzar la siguiente consulta en la base de datos:

CREATE TABLE  `bbpress`.`rod_userposition` (
  `uid` int(11) NOT NULL,
  `lat` double NOT NULL default '0',
  `long` double NOT NULL default '0',
  `ubicacion` mediumtext,
  `usarmapa` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `rod_userposition_uid_idx` (`uid`),
  KEY `rod_userposition_lat_idx` (`lat`),
  KEY `rod_userposition_long_idx` (`long`),
  KEY `rod_userposition_usarmapa_idx` (`usarmapa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1