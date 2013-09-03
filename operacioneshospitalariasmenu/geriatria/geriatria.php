<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php 
$ALMACEN='HGER';
?>


<?php 
$codModulo='GERIATRIA';
$codSM='IModGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE 
codModulo = '".$codModulo."'
and
codSM='".$codSM."'
and
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();

if(!$resulScripModulo['usuario']){ 
exit();
}?>
<HTML>
<head>
<title></title>
<script type="text/javascript"  src="/sima/js/stmenu.js"></script>
<script type="text/javascript">
<!--
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5">
<center>
<script type="text/javascript">
<!--
stm_bm(["menu0129",810,"","/sima/imagenes/blank.gif",0,"","",0,0,0,0,1000,1,0,0,"","",0,0,1,1,"default","hand","/Menu2"],this);
stm_bp("p0",[0,4,0,0,3,3,7,9,100,"",-2,"",-2,90,0,0,"#000000","#7a8c9e","",0,0,0,"#CCCCCC"]);
<!--------------ADMICIONES-------------------



<!------------CATALOGO ADMICIONES----------------------
<?php 
$codModulo='GERIATRIA';
$codSM='ICatGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p0i1","p0i0",[0,"CATALOGOS","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p2","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p2i0","p1i0",[6,1,"#50647f","",-1,-1,0]);



<?php 
$codModulo='GERIATRIA';
$codSM='CSGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p7i10","p2i2",[0," Servicios","","",-1,-1,0,"modificaP.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);
<?php } ?>

//stm_aix("p7i7","p2i2",[0," Salas","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/salas.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

//stm_aix("p7i8","p2i2",[0," Habitacion","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/habitaciones.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

//stm_aix("p7i9","p2i2",[0," Camas","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/camas.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

//stm_aix("p7i19","p2i2",[0," Niveles","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/niveles1.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

stm_ep();
<?php } ?>
//--------------CATALOGO ADMICIONES------------------>




<!------------INICIO SXS----------------------
<?php 
$codModulo='GERIATRIA';
$codSM='ISxSGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p0i9","p0i6",[0,"SOLICITUDES ","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p9","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p9i0","p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='GERIATRIA';
$codSM='SxSLisGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p7i10","p2i2",[0," Lista","","",-1,-1,0,"listaSolicitudes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);
<?php } ?>
//stm_aix("p7i11","p2i2",[0," Cuartos<->Camas","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/cuartos-camas.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

//stm_aix("p7i19","p2i2",[0," Clientes <-> Niveles","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/admisiones/clientesNiveles.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);

stm_ep();
<?php } ?>
//---------------FIN SXS------------------>




<!------------INICIO CARGOS CCP----------------------
<?php 
$codModulo='GERIATRIA';
$codSM='ICGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p0i10","p0i7",[0,"CARGOS ","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p10","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);
<?php 
$codModulo='GERIATRIA';
$codSM='CPxIGer';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p7i1","p1i2",[0," Pacientes Internos","","",-1,-1,0,"pacientesInternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],138,22);
<?php } ?>



stm_ep();
<?php } ?>
//---------------FIN ------------------>









<!------------INICIO SALIR----------------------
stm_aix("p0i8","p0i4",[0,"SALIR","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p10","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);


stm_aix("p10i2","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

stm_ep();
//---------------FIN ESTUDIOS------------------>
stm_ep();

stm_em();
//-->
</script>
</center>
</body>
</html>