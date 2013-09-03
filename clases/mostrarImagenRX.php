<?php class DXRX{
public function diagnosticosRX($numeroE,$nCuenta,$ruta,$seguro,$numeroPaciente,$keyCAP,$usuario,$hora1,$fecha1,$basedatos){ 

?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.observaciones.value) == false ) {   
                alert("Por Favor, escribe las observaciones del diagnóstico!")   
                return false   
        } else if( vacio(F.receta.value) == false ) {   
                alert("Por Favor, escribe la receta!")   
                return false   
        }         
}   
</script> 





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
.style12 {font-size: 10px}
.style12 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
	<script src="/sima/js/prototype.js" type="text/javascript"></script>
	<script src="/sima/js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="/sima/js/lightboxXL.js" type="text/javascript"></script>
</head>

<body>

  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);" >

    <p align="center">
	<?php 
$devuelvePlaca=new SQL();
$devuelvePlaca->devuelvePlacaRX($numeroE,$nCuenta,$keyCAP,$basedatos);
	?>
   
 </p>
    <p>&nbsp;</p>

  <p>&nbsp;</p>
<?php 
include("/configuracion/clases/diagnosticos.php");
$diagnostico=new diagnostico();
$diagnostico->diagnosticos($ruta,$seguro,$numeroE,$keyCAP,$usuario,$hora1,$fecha1,$basedatos);
?>
  </form>
</body>
</html>
<?php 
}
}
?>