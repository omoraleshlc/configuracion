<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php $ALMACEN='HLCCXC'; ?>

<style type="text/css">
<!--
body {
	background-image: url(../../imagenes/imagenesModulos/cxc2.png);
	background-attachment:fixed;
	background-repeat:no-repeat;
	background-position:center top;
}
-->
</style>


<script type="text/javascript"  src="/sima/js/new/stmenu.js"></script>

<script type="text/javascript">
<!--
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
//-->
</script>
<style type="text/css">
<!--
.style2 {
	color: #0000FF;
	font-weight: bold;
	font-size: 9px;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5">
<center>
<a href="http://www.dhtml-menu-builder.com"  style="display:none;visibility:hidden;">Javascript DHTML Drop Down Menu Powered by dhtml-menu-builder.com</a>
<script type="text/javascript">
<!--
stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.gif",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_03.gif",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_01.gif",37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);
stm_ai("p0i0",[0,"Ir Atras","","",-1,-1,0,"javascript:history.go(-1)","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#E6EFF9",1,"","",3,3,0,0,"#E6EFF9","#000000","#FF9900","#FFFFFF","bold 9pt Verdana","bold 9pt Verdana",0,0,"","","","",0,0,0],150,33);






//----------CONFIGURACIONES----------
stm_aix("p0i1","p0i0",[0,"Extras","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);
stm_aix("p1i0","p0i1",[0,"Dividir x Extensiones","","",-1,-1,0,"facturaExtensiones.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Dividir x Grupos","","",-1,-1,0,"facturaExtensionesGrupos.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_ep();
//----------------------------------------------



//----------TRANSACCIONES----------
stm_aix("p0i1","p0i0",[0,"Transacciones","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);
stm_aix("p1i0","p0i1",[0,"Aplicar Pagos Aseguradoras","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/aplicarPago.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Facturacion Aseguradoras","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/ctasTransferidas.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Facturacion Extensiones Grupo","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/extensionesGrupos.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Facturacion Particular","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/fxF.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Saldo Inicial Aseguradoras","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/saldosIniciales.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Refacturacion/Cancelacion","","",-1,-1,0,"cancelacionFactura.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_ep();
//-------------------------------









//----------REPORTES----------
stm_aix("p0i1","p0i0",[0,"Reportes","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);
stm_aix("p1i0","p0i1",[0,"Cuentas Transferidas Particulares","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/reporteCT.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Cuentas Transferidas Otros","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/traspasarCxC.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Listado de RFC","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/listaRFC.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Listado de Clientes","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/clientes.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Reporte Folios Facturados","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/FacturadoReport.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Reporte Folios NO Facturados","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/foliosNoFacturados.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);
stm_aix("p1i0","p0i1",[0,"Diario de Cuentas","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/reporteDiarioCuentas.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);



stm_aix("p1i0","p0i1",[0,"Aseguradoras","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/listaCXCactiva.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_aix("p1i0","p0i1",[0,"Otros","","",-1,-1,0,"/sima/INGRESOS HLC/cxc/Otros.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_aix("p1i0","p0i1",[0,"Re-imprimir facturado","","",-1,-1,0,"reporteFacturado.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);




stm_ep();

stm_aix("p0i1","p0i0",[0,"Salir","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","/sima/imagenes/4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FF0000","#FFFF34","bold 8pt Verdana","bold 8pt Verdana"],100,33);

stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#333333","#333333","",3,1,1,"#000000"]);

stm_aix("p1i0","p0i1",[0,"Menu Ingresos","","",-1,-1,0,"/sima/INGRESOS HLC/index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_aix("p1i0","p0i1",[0,"Menu Principal","","",-1,-1,0,"/sima/MenuIndex.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);

stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#000000",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#6699FF"],165,20);


stm_ep();
stm_em();

//-->
</script>
</center>
</body>
</html>
