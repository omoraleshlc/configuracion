<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php 
$codModulo='LABORATORIOBD';
$codSM='ILabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if(!$resulScripModulo['usuario']){ 
exit();
}
?>

<HTML>
<head>


</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5">
<center>
<script type="text/javascript">
<!--
stm_bm(["menu0129",810,"","/sima/imagenes/blank.gif",0,"","",0,0,0,0,1000,1,0,0,"","",0,0,1,1,"default","hand","/Menu2"],this);
stm_bp("p0",[0,4,0,0,3,3,7,9,100,"",-2,"",-2,90,0,0,"#000000","#7a8c9e","",0,0,0,"#CCCCCC"]);




<!------------CATALOGO----------------------
<?php 
$codModulo='LABORATORIOBD';
$codSM='ICatLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_ai("p0i0",[0," CATALOGOS","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='LABORATORIOBD';
$codSM='CatConLotLABBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i1","p0i0",[0," Controles o Lotes","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/laboratorio/bayday/catcontylot.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php } ?>



stm_ep();
<?php } ?>
//---------------FIN DE CATALOGO------------------>










<!------------EDICION----------------------
<?php 
$codModulo='LABORATORIOBD';
$codSM='IEditLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_ai("p0i0",[0," EDICIONES","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='LABORATORIOBD';
$codSM='EditCyLLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i1","p0i0",[0," Controles o Lotes","","",-1,-1,0,"agcontrolesylotes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php } ?>

<?php 
$codModulo='LABORATORIOBD';
$codSM='EditPLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i1","p0i0",[0," Pruebas","","",-1,-1,0,"agdesgloce.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php } ?>

stm_ep();
<?php } ?>
//---------------FIN DE EDICION------------------>




<!------------REPORTES----------------------
<?php 
$codModulo='LABORATORIOBD';
$codSM='IRepLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_ai("p0i0",[0," REPORTES","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='LABORATORIOBD';
$codSM='RepPLabBD';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i1","p0i0",[0," Pruebas","","",-1,-1,0,"datoscci.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php } ?>



stm_ep();
<?php } ?>
//---------------FIN DE REPORTES------------------>





<!------------INICIO SALIR----------------------
stm_aix("p0i8","p0i4",[0,"SALIR","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p10","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/labortatorio/index.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

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