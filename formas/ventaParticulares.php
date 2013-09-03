<?php require('/configuracion/funciones.php');

if($_POST['cargos']){ //validacion de vigencia de credenciales




//DEBE EXISTIR EN LA BASE DE DATOS POR LO TANTO REQUIERE EXPEDIENTE
$sSQL10= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['seguro']."' ";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
//**************************************************




if($_POST['eFisico']){
$exp='si';
$fechaSol=$fecha1;
}

$sSQL4f= "Select credenciales from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result4f=mysql_db_query($basedatos,$sSQL4f);
$myrow4f = mysql_fetch_array($result4f);

if($myrow4f['credenciales']=='si'){ //checo que el cliente tenga credenciales activado


$sSQL45z= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' and (numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' and status='A')
AND
fechaFinal >= '".$fecha1."'
and
fechaInicial <= '".$fecha1."' 
";
$re=mysql_db_query($basedatos,$sSQL45z);
$si = mysql_fetch_array($re);


if(!$si['usuario']){ 

$sSQL45z1= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' 
and numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' 
";
$re1=mysql_db_query($basedatos,$sSQL45z1);
$si1 = mysql_fetch_array($re1);
?>
<script>
window.alert("La credencial: #<?php echo $si1['keyCredencial'];?> expir?z en: <?php echo cambia_a_normal($si1['fechaFinal']);?>, por lo cual est? bloqueada o cancelada..!");
window.close();
</script>
<?php }
}
}



if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}
?>

<script language=javascript> 
function ventanaSecundaria100 (URL){ 
   window.open(URL,"ventana100","width=600,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librer?a principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librer?a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



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
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=900,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 



<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<?php 

if(!$_POST['nomSeguro']){
$_POST['seguro']='';
}








$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenio=new validaConvenios();
$verificaSaldos=new verificaSeguro();

$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();


if($_POST['keyClientesInternos']!=NULL){
$seguro=$traeSeguro->traeSeguro($_POST['keyClientesInternos'],$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);
}


                $sSQLa2= "Select * From almacenes
                where entidad='".$entidad."' and  almacen='".$_GET['almacen']."'
                
                
                ";
                $resultsa2 = mysql_query($sSQLa2);
                $rowa2 = mysql_fetch_array($resultsa2);

if($rowa2['llenadoEspecial']!=NULL){
    $llenadoEspecial='si';
}













if($_POST['cargos']){
		
		
		
		    $q4 = "

    INSERT INTO contadorCI(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorCI where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT
    contador
    FROM contadorCI
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $numSolicitud= $myrow['contador'];
	
		
		
	

//BENEFICENCIAS

                $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_POST['numeroEx']."'
                and
                fecha='".$fecha1."' and status='standby'
                and
                departamento='".$_GET['almacen']."'
                ";
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                
                
                
                
                if($rowa['numeroE']!=NULL AND $rowa['fecha']==$fecha1 ){
                  $beneficencia=NULL;$statusBeneficencia=NULL;
                    $porcentaje=$rowa['porcentaje'];

                }elseif($_POST['beneficencia']=='si'){
                    $statusBeneficencia='si';
                    $porcentaje=100;

                }else{
                    $beneficencia=NULL;$statusBeneficencia=NULL;

                }




//REVISANDO QUE NO ESTE BLOQUEADA LA CUENTA
$sSQL455= "Select * from pacientesCandados where (entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."')
OR
(entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' )
";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['numeroEx']){ ?>
<script>
window.alert("Oops! Lo sentimos, la cuenta del paciente: <?php echo $myrow455['nombreCompleto'];?> esta bloqueada! por este motivo: <?php echo $myrow455['observaciones'];?>, le sugerimos cargar a otro seguro o arreglar su situacion en admisiones!! Gracias..");
window.close();
</script>


<?php 
}



if($_POST['nomSeguro']){
$sSQL455= "Select nomCliente,clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
if(!$myrow455['clientePrincipal']){
echo '<script>';
echo 'window.alert("Oops! hay un problema con el seguro, revisa bien y vuelve a llenar datos!");';
echo 'window.close();';
echo '</script>';
}
}




if($_POST['nomSeguro'] and $_POST['cortesia']){

echo '<script>';
echo 'window.alert("Oops! Imposible hacer cargos cuando es cortesia y tiene seguro, revisa bien y vuelve a llenar datos!");';
echo 'window.close();';
echo '</script>';

}




$sSQL7m= "Select requiereExpediente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result7m=mysql_db_query($basedatos,$sSQL7m);
$myrow7m = mysql_fetch_array($result7m);




if($myrow7m['requiereExpediente']=='si' and !$_POST['numeroEx']){ //Requiere que se escriba el expediente
?>
<script>
window.alert("Esta aseguradora requiere que se busque al paciente por expediente, gracias!");
close();
</script>
<?php 
}else{
$sSQL7= "Select * from pacientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);








$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$_POST['numeroEx']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroPaciente'];
if($_POST['nuevo']){
$_POST['paciente']="";
}














//$sSQL4= "Select * from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroEx']."' ";
//$result4=mysql_db_query($basedatos,$sSQL4);
//$myrow4 = mysql_fetch_array($result4);
//$nCuenta = $myrow4['nCuenta']+1;


if($_POST['cortesia']=='si'){
$status='cortesia';

}else{
$status='request';

}

//*************genero orden aleatoria*********
//$nOrden=rand(0,100000);
//if($nOrden1){
//$nOrdenT=$nOrden1;
//} else {
//$nOrdenT=$nOrden;
//}
 
 
 




//*****************cierro orden*****************


$sSQL45= "Select * from clientesInternos where keyClientesInternos ='".$_GET['keyClientesInternos']."'";
$result45=mysql_db_query($basedatos,$sSQL45);
$myrow45 = mysql_fetch_array($result45);

//**********SOLO ESTUDIANTES**************
$sSQL7a= "Select numMatricula from pacientes where entidad='".$entidad."'  and  numCliente='".$_POST['numeroEx']."'     ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);


if($myrow7a['numMatricula']){
$sSQL7c= "Select * from ALUMNOSINSCRITOS where ENTIDAD='".$entidad."'  and  MATRICULA='".$myrow7a['numMatricula']."'  and MODALIDAD='Presencial'   ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);

$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$_POST['seguro']."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

if($myrow7ab['seguro'] and $myrow7c['MATRICULA']){
$_POST['credencial']=$myrow7c['MATRICULA'];
$despliegaEC='si';
$estudiante='si';
}else{
$despliegaEC=NULL;
$estudiante=NULL;
}
}
//***************************************






if($myrow45['numeroE']){


if($_POST['edad']=='prepago'){

echo 'El paciente es de prepago';

} else {

$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$q = "UPDATE clientesInternos set 
numSolicitud='".$numSolicitud."',
autoriza='".$usuario."',    
llenadoEspecial='".$llenadoEspecial."',
    tipoBeneficencia='".$_POST['tipoBeneficencia']."',
    activaBeneficencia='".$statusBeneficencia."',
        porcentaje='".$porcentaje."',
statusCortesia='".$_POST['cortesia']."',

seguro='".$_POST['seguro']."',
credencial='".$_POST['credencial']."',
fecha='".$fecha1."',
hora='".$hora1."',
status='".$status."',
tipoPaciente='externo',
dependencia='".$_POST['dependencia']."',
entidad='".$entidad."',
statusExpediente='request',
edad='".$_POST['edad']."',
diagnostico='".$_POST['diagnostico']."',
estudiante='".$estudiante."',

clientePrincipal='".$cP."',
statusPaciente='".$_POST['statusPaciente']."',
empleado='".$_POST['empleado']."',
despliegaEC='".$despliegaEC."',
descuento='".$_POST['descuento']."',
observaciones='".$_POST['observaciones']."',
    beneficencia='".$beneficencia."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
}


?>

<script language="JavaScript" type="text/javascript">
javascript:nueva('/sima/cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>','ventanaSecundaria20','1000','800','yes');

//opener.location.reload(true); aqui?
window.close();

</script>
<?php





} else {
if($_POST['cargos']  AND $_POST['paciente']){
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$d='Ingreso el paciente: '.$_POST['paciente'].', con el numero de expediente: '.$_POST['numeroEx'].', y con el seguro: '.$_POST['seguro'].', '.$_POST['nomSeguro'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$d."','".$ALMACEN."','".$ALMACEN."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,clientePrincipal,statusPaciente,
tipoAccidente,
fechaAccidente,
horaAccidente,
lugarAccidente,
llegoHospital,
ministerio,
motivoConsulta,
alergiaT,
alergiaP,
alergiaR,
alergiaPA,
tiposAlergias,
peso,dx,empleado,expediente,fechaSolicitud,despliegaEC,naturaleza,estudiante,descuento,statusCortesia,activaBeneficencia,porcentaje,
tipoBeneficencia,llenadoEspecial,autoriza,numSolicitud
) values (
'".$_POST['numeroEx']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$status."',
'".$_POST['cita']."',
'".$ALMACEN."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','request','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','',
'".$cP."','".$_POST['statusPaciente']."',
'".$_POST['tipoAccidente']."',
'".$_POST['fechaAccidente']."',
'".$_POST['horaAccidente']."',
'".$_POST['lugarAccidente']."',
'".$_POST['llegoHospital']."',
'".$_POST['ministerio']."',
'".$_POST['motivoConsulta']."',
'".$_POST['alergiaT']."',
'".$_POST['alergiaP']."',
'".$_POST['alergiaR']."',
'".$_POST['alergiaPA']."',
'".$_POST['tiposAlergias']."',
'".$_POST['peso']."',
'".$_POST['dx']."',
'".$_POST['empleado']."','".$exp."','".$fechaSol."','".$despliegaEC." ','D','".$estudiante."','".$_POST['descuento']."','".$_POST['cortesia']."',
    '".$statusBeneficencia."','".$porcentaje."','".$_POST['tipoBeneficencia']."','".$llenadoEspecial."','".$usuario."','".$numSolicitud."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();






$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
numSolicitud='".$numSolicitud."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos'];
$leyenda='SE GENERO LA ORDEN #'.$numSolicitud;




?>




<script>
javascript:nueva('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow1['folioVenta']; ?>&load=activated','ventanaSecundaria20','1000','800','yes');
close();
</script>
<?php 
} else {
//echo "YA DISTE DE ALTA ESA NOTA DE CARGO, ESCOJE EL EXPEDIENTE NUEVO";
}
}
}//cierro actualizar nota de venta

//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************


}
?>


<?php 

if($_POST['quitar']){
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$codigo[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}

}
$nOrden1=$nOrdenT;
?>






<?php	
if($_POST['verCargos']){ 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();
if($myrow33['numeroE'] and !$_POST['nuevo']){
$numeroE1=$myrow33['numeroE'];
 } 
} 
 ?>



<?php 
$sSQL4= "Select * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=700,scrollbars=YES") 
} 
</script> 

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<head>





<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />


</head>













<body>
<?php 




$sSQL39= "SELECT *
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>
    

    
<div>
  <form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <p><span  align="center">Departamento: <?php echo $myrow39['descripcion']; ?></span></p>
    <table width="635" class="table-forma">

      <tr >
        <td width="4" >&nbsp;</td>
        <td width="94" >Paciente</td>
        <td colspan="3"><div align="left">


            <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60" onfocus="if (this.value=='VentaPublico') this.value = ''" onblur="if (this.value=='') this.value = 'VentaPublico'"   />
            <a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a>

            <br />
                   
        </div></td>
        
        
        
      </tr>
     
        
        
        
      
    
      

      

      
      
      
      
    
        
        
        
      
      

    </table>
  
  
  

	  
	  
	  

  
  
  
  
  
  
  
  
  
  


<p>&nbsp;</p>







<table width="427" border="0" align="center">
         <tr>
           <td width="166"><div align="center">
             <input name="cargos" type="submit" src="/sima/imagenes/btns/new_cargos2.png" id="hacerCargos" value="Agregar Nota de Cargo" />
           </div></td>
           <td width="93"><div align="center"></div></td>
       
      </tr>
</table>


</form>

 </div>




    
   
</body>
</html>
