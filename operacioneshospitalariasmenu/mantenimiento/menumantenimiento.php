<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php 
$raiz='OPERACIONES';
$secundario='MANTENIMIENTO';
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

<!------------CATALOGOS----------------------
stm_aix("p0i1","p0i0",[0,"CATALOGOS","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p2","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p2i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p2i1","p1i2",[0," Clasificaciones","","",-1,-1,0,"catClasificaciones.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);

stm_aix("p2i1","p1i2",[0," Equipos","","",-1,-1,0,"catEquipos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);

stm_ep();
//---------------FIN ESTUDIOS------------------>









<!------------INICIO TRANSACCIONES----------------------
stm_aix("p0i9","p0i6",[0,"TRANSACCIONES","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p9","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p9i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p9i1","p1i3",[0," Agregar Equipos BD","","",-1,-1,0,"listaResultados1.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
//stm_aix("p9i2","p1i3",[0," P. Internos","","",-1,-1,0,"#","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);

stm_ep();
//---------------FIN RESULTADOS------------------>








<!------------INICIO SERVICIOS----------------------
//stm_aix("p0i8","p0i7",[0,"MANTENIMIENTO","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
//stm_bpx("p8","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
//stm_aix("p8i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

//stm_aix("p8i1","p1i4",[0," Catálogo de Reportes","","",-1,-1,0,"cargosAmbulatorios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],160,22);
//stm_aix("p8i2","p1i5",[0," Relación Estudio<->Reportes","","",-1,-1,0,"RelArticReportRut.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],160,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);
//stm_ep();

<!------------INICIO SERVICIOS----------------------
//stm_aix("p0i10","p0i7",[0,"SOLICITUDES","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
//stm_bpx("p10","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
//stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

//stm_aix("p10i1","p1i4",[0," Listado de Ordenes","","",-1,-1,0,"listapacientes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],110,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);


//stm_ep();
//---------------FIN SERVICIOS------------------>
<!------------INICIO SALIR----------------------
stm_aix("p0i8","p0i4",[0,"SALIR","","",-1,-1,0,"","_self","","","/sima/imagenes/icon_10a.gif","/sima/imagenes/icon_10b.gif",7,13,0,"/sima/imagenes/0604arroldw.gif","/sima/imagenes/0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p10","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p10i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/OPERACIONESHOSPITALARIAS/index.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

stm_aix("p10i3","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

stm_ep();
//---------------FIN ESTUDIOS------------------>
stm_ep();

stm_em();
//-->
</script>
</center>
</body>
</html>