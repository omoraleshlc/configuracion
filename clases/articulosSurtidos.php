<?php class articulos {
public function surtidos($fecha1,$usuario,$entidad,$ALMACEN,$codigo,$basedatos){
if(!$ALMACEN){echo '<script>window.alert("Favor de asignar almacen en modulos secundarios, gracias!");</script>';}
?>



 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<script language="javascript" type="text/javascript">

function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}


function valida(F) {

        if( vacio(F.almacen.value) == false ) {
                alert("Por Favor, escoje el almacen/departamento!")
                return false
        } else if( vacio(F.descripcion.value) == false ) {
                alert("Por Favor, escribe la descripci�n de este almacen!")
                return false
        } else if( vacio(F.ctaContable.value) == false ) {
                alert("Por Favor, escoje la cuenta mayor!")
                return false
        }
}

</script>


<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria5 (URL){
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria51 (URL){
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria511 (URL){
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA (URL){
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA2 (URL){
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA1 (URL){
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria5111(URL){
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES")
}
</script>






<?php



if($_POST['fv'] and !$_POST['resumen'] ){
 $random=rand(1,900000000);

$q = "insert into contador
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT *
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
?>
<script>
//javascript:ventanaSecundaria511('despliegaxFV.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>');
//window.alert("Se genero el numero de reporte: <?php print $myrow7ab['random'];?>");

</script>
<?php
}
?>













<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
	<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>

 <h1 align="center" >
Ventas Medicos
 </h1>

 <form id="form2" name="form2" method="post" >
   <div align="center"></div>
   <p align="center">
     <label></label>
     Escojer Fechas</p>




   <table width="284" class="table-forma">



       <tr>
       <td scope="col"><div align="left">
         <input name="fechaInicial" type="text"  id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></td>
       <td scope="col"><div align="center">
         <input name="fechaFinal" type="text"  id="campo_fecha2" size="11" maxlength="11" readonly="readonly"
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></td>
     </tr>
     <tr>
       <td><div align="left">
         <input name="button" type="image" src="../imagenes/btns/fecha.png" id="lanzador1" value="..." />
       </div></td>
       <td><div align="center">
         <input name="button1" type="image" src="../imagenes/btns/fecha.png" id="lanzador2" value="..." />
       </div></td>
       
     </tr>
   </table>
   <p>&nbsp;</p>
   <p>
     <input name="buscar" type="submit"  id="buscar" value="buscar" />
   </p>
   <p>&nbsp;</p>
<table width="500" class="table table-striped">
<tr >

              <th  width="14"  scope="col"><div align="left" >
        <div align="left">#</div>
      </div></th>

      <th width="20"  scope="col"><div align="left" >
        <div align="left">nOrden</div>
      </div></th>
      
      
      <th width="20"  scope="col"><div align="left" >
        <div align="left">UsuarioC</div>
      </div></th>


 
      <th width="200"  scope="col"><div align="center" >
        <div align="left">Hora</div>
      </div></th>


<th  scope="col"><div width="20" align="center" >
        <div align="left">Fecha</div>
      </div></th>





              <th width="4" height="0"  scope="col"><div width="20" align="center" >
        <div align="left">-----</div>
      </div></th>


    </tr>
    <tr>
<?php	
$sSQL= "SELECT *
FROM
faltantesSub
WHERE 
entidad='".$entidad."'
and
fecha1>='".$_POST['fechaInicial']."' 
    and
fecha1<='".$_POST['fechaFinal']."'    

group by nOrden
order by nOrden
";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;



?>



 <td width="14" ><span >

	  <?php echo $a  ?>
      </span></td>
        
      
      
 <td width="14" ><span >

	  <?php echo $myrow['nOrden'];  ?>
      </span></td>
      

      <td width="235"  ><span >

	  <?php echo $myrow['usuario'];
	  
	  ?>
      </span></td>



              <td width="200"  ><span >

	  <?php echo $myrow['hora1'];

	  ?>
      </span></td>


              <td width="235"  ><span >

	  <?php echo cambia_a_normal($myrow['fecha1']);

	  ?>
      </span></td>






<td width="70"  >
<div align="left">
<a href="#" onClick="javascript:ventanaSecundaria1('../ADMINHOSPITALARIAS/inventarios/imprimirTraspaso.php?orden=<?php echo $myrow['nOrden']; ?>&usuario=<?php echo $myrow['usuario'];?>&random=<?php echo $myrow['random'];?>')">
Print
</a>
</div>
</td>

        


    </tr>
    <?php  }}?>

</table>   
   
   
   
   
   
   
   
   
 </form>

<p align="center">&nbsp;</p>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha2",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario
});
</script>


</body>
</html>
<?php 
}
}
?>