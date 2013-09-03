<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php 
$raiz='OPERACIONES';
$secundario='CAPELLANIA';
$checaModuloScript= "Select * From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if(!$resulScripModulo['usuario']){
exit;
}
?>
<HTML>
<head>
<title></title>

</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5">
<center>
<script type="text/javascript">
<!--
stm_bm(["menu0129",810,"","/sima/imagenes/blank.gif",0,"","",0,0,0,0,1000,1,0,0,"","",0,0,1,1,"default","hand","/Menu2"],this);
stm_bp("p0",[0,4,0,0,3,3,7,9,100,"",-2,"",-2,90,0,0,"#000000","#7a8c9e","",0,0,0,"#CCCCCC"]);




<!------------INICIO CONTROL DE PACIENTES----------------------
<?php 
$codModulo='CAPELLANIA';
$codSM='IPCapellan';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_ai("p0i0",[0,"PACIENTES","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='CAPELLANIA';
$codSM='PInterCapellan';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i1","p0i0",[0," Pacientes Internos","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/capellania/listapacientes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php $sec='si';} else { $sec='no';} ?>

<?php 
$codModulo='CAPELLANIA';
$codSM='BusPCapellan';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p1i2","p1i1",[0," Buscar Pacientes","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/capellania/buscaPacientes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<?php $sec='si';} else { $sec='no';} ?>

stm_ep();
<?php $sec='si';} else { $sec='no';} ?>
//---------------FIN DE CONTROL DE PACIENTES------------------>


<!------------INICIO SALIR----------------------
stm_aix("p0i8","p0i4",[0,"SALIR","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p10","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/index.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

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