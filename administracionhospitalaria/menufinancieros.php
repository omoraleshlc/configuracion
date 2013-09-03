<?php require("/configuracion/ventanasEmergentes.php"); ?>


<style type="text/css">
<!--
body {
	background-image: url(/sima/imagenes/imagenesModulos/adminhospitalaria.png);
	background-attachment:fixed;
	background-position:center top;
	background-repeat:no-repeat;
}
-->
</style>
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

<script type="text/javascript">
<!--
stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.gif",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_03.gif",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_01.gif",37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);
stm_ai("p0i0",[0,"Ir Atras","","",-1,-1,0,"javascript:history.go(-1)","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#E6EFF9",1,"","",3,3,0,0,"#E6EFF9","#000000","#FF9900","#FFFFFF","bold 9pt Verdana","bold 9pt Verdana",0,0,"","","","",0,0,0],150,33);


-
//----------INVENTARIO-----------
<?php 
$raiz='OPERACIONES';$raiz1='ADMINISTRACION HOSPITALARIA';
$secundario='INVENTARIOS';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE
(raiz = '".$raiz."' or raiz='".$raiz1."')
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"Inventarios ","","",-1,-1,0,"/sima/ADMINHOSPITALARIAS/inventarios/","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_ep();<?php } ?>







<?php 
$raiz='ADMINISTRACION HOSPITALARIA';
$secundario='SERVICIOS';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE
raiz = '".$raiz."'
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"Catalogo de Servicios","","",-1,-1,0,"/sima/ADMINHOSPITALARIAS/servicios/","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_ep();<?php } ?>

//-**************FIN DE CONVENIOS*********************-



//----------CAJA-----------


<?php 
$raiz='OPERACIONES';
$secundario='RRHH';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"Recursos Humanos","","",-1,-1,0,"/sima/ADMINHOSPITALARIAS/RRhh/","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_ep();<?php } ?>
//----------CIERRA CAJA-----------



//-**************ABRE CXC*********************-


<?php 
$codModulo='CXC';
$codSM='IMODCxC';
$checaModuloScript= "Select usuario From usuariosSubmodulos WHERE 
codModulo = '".$codModulo."'
and
codSM='".$codSM."'
and
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
//stm_aix("p0i1","p0i0",[0,"Cuentas por Cobrar","","",-1,-1,0,"/sima/INGRESOS%20HLC/cxc/","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_ep();<?php } ?>
//----------CIERRA CCXC-----------



//-**************FIN DE CCXC*********************-
//*************************************************SALIR***********************************
stm_aix("p0i1","p0i0",[0,"Salir","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FF0000","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_aix("p1i0","p0i1",[0,"Menu Principal","","",-1,-1,0,"/sima/MenuIndex.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);


stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);




//************************************************************ CErrar SalIr **************************
stm_ep();
stm_em();

//-->
</script>
</center>
</body>
</html>