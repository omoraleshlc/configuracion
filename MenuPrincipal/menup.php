<script type="text/javascript"  src="/sima/js/new/stmenu.js"></script>


<script type="text/javascript">
<!--
stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.gif",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_03.gif",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_01.gif",37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);
<!------------INICIO INGRESOS----------------------
<?php 
$raiz='INGRESOS';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>

stm_aix("p0i1","p0i0",[0,"INGRESOS","","",-1,-1,0,"INGRESOS HLC/index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

//-stm_aix("p2i1","p1i2",[0," Caja","","",-1,-1,0,"altapacientesambulatorios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
//stm_aix("p2i2","p1i2",[0," Facturacion","","",-1,-1,0,"SEpacientesinternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
//stm_aix("p2i2","p1i2",[0," Convenios","","",-1,-1,0,"SEpacientesinternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);

stm_ep();<?php } ?>
//---------------FIN DE INGRESOS------------------>
<!------------INICIO FINACIEROS HLC----------------------
<?php 
$raiz='OPERACIONES';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"ADMON. HOSPITALARIA","","",-1,-1,0,"ADMINHOSPITALARIAS/index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

//stm_aix("p9i1","p1i3",[0," Pacientes Ambulantorios","","",-1,-1,0,"resultadospacientesambulatorios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
//stm_aix("p9i2","p1i3",[0," Pacientes Internos","","",-1,-1,0,"resultadospacientesinternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);

stm_ep();<?php } ?>
//---------------FIN DE FINANCIEROS HLC------------------>
<!------------INICIO OPERACIONES HOSPITAL----------------------
<?php 
$raiz='OPERACIONES';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"DEPARTAMENTOS","","",-1,-1,0,"OPERACIONESHOSPITALARIAS/index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

//stm_aix("p9i1","p1i3",[0," Listado de Solicitudes","","",-1,-1,0,"listadosolicitudes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);

stm_ep();<?php } ?>
//---------------FIN OPERACIONES HOSPITAL------------------>
<!------------INICIO EXPEDIENTES CLINICOS & MEDICOS----------------------
<?php 
$raiz='EXPCLINICOS';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"EXP CLINICOS","","",-1,-1,0,"EXPEDIENTESCLINICOS/index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

//stm_aix("p10i1","p6i0",[0," Men� principal","","",-1,-1,0,"/sima/menuPrincipal.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);
//stm_aix("p10i2","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

stm_ep();<?php } ?>
//---------------FIN  EXPEDIENTES CLINICOS & MEDICOS------------------>

<!------------INICIO REPORTES----------------------
<?php 
$raiz='ESTADISTICAS';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
//stm_aix("p0i1","p0i0",[0,"ADMIN. HOSPITALARIAS","","",-1,-1,0,"ADMINHOSPITALARIAS/","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

//stm_aix("p10i1","p6i0",[0," Men� principal","","",-1,-1,0,"/sima/menuPrincipal.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);
//stm_aix("p10i2","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","/sima/imagenes/fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

stm_ep();<?PHP } ?>
//---------------FIN REPORTES------------------>

<!------------INICIO SEGURIDAD----------------------
<?php 
$raiz='SEGURIDAD';
$checaModuloScript= "Select usuario From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i1","p0i0",[0,"CONFIGURACIONES","","",-1,-1,0,"SEGURIDADSIMA/index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

stm_ep();<?php } ?>
//---------------FIN  SEGURIDAD SIMA------------------>
<!------------INICIO SALIR----------------------
stm_aix("p0i1","p0i0",[0,"SALIR","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FF0000","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);


stm_aix("p1i0","p0i1",[0,"Cambio de Password","","",-1,-1,0,"/sima/SEGURIDADSIMA/cambioPassword.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_ep();
//---------------FIN ESTUDIOS------------------>
stm_ep();

stm_em();
//-->
</script>
