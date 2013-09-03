<?php class modificarMedicos{

public function modificaMedico($entidad,$numMedico,$basedatos){
$_GET['numMedico']=$numMedico;
?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Ivan Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Codigo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.numMedico.value) == false ) {   
                alert("Escribe el numero de codigo para el doctor presionando NUEVO, y a HLC agregale su numero!")   
                return false   
        } else if( vacio(F.nombre1.value) == false ) {   
                alert("Escribe el Nombre del Doctor!")   
                return false   
        } else if( vacio(F.apellido1.value) == false ) {   
                alert("Escribe el Apellido Paterno del Doctor!")   
                return false   
        } else if( vacio(F.apellido2.value) == false ) {   
                alert("Escribe el Apellido Materno del Doctor!")   
                return false   
        } 
           
}     
  
</script>  
<script language=javascript> 
function ventanaSecundaria31 (URL){ 
   window.open(URL,"ventanaSecundaria31","width=500,height=500,scrollbars=YES") 
} 
</script> 








<?php


$sSQL= "SELECT *
  FROM
medicos
WHERE 
keyMedico='".$_GET['keyMedico']."' || (entidad='".$entidad."' and numMedico='".$_GET['numMedico']."')
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);









if(!$_GET['keyMedico']){$_GET['keyMedico']=$myrow['keyMedico'];}



if($_POST['actualizar']!=NULL  ){
  $sSQL1= "Select * From medicos WHERE keyMedico='".$_GET['keyMedico']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);








    
    
    if($_POST['nombre1']!=NULL and $_POST['cedula']!=NULL and $_POST['apellido1']!=NULL and $_POST['especialidad']!=NULL){
    
    
    
    


//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
//    echo "Possible file upload attack!\n";
}
//**********************************************************

$nombreCompleto=$_POST['nombre1'].' '.$_POST['apellido1'].' '.$_POST['apellido2'];




if(!$myrow1['keyMedico']){


    $q4 = "

    INSERT INTO contadorMedicos(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(keyCExt)+1 from contadorMedicos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQLm= "SELECT
    contador
    FROM contadorMedicos
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by keyCExt DESC
    ";

    $resultm=mysql_db_query($basedatos,$sSQLm);
    $myrowm = mysql_fetch_array($resultm);
$contador='M'.$myrowm['contador'];
    


    
$agrega = "INSERT INTO medicos (
nombre1,apellido1,apellido2,
numMedico,fechaNacimiento,
pais,telefono,cp,direccion,
ciudad,estado,medicoInterno,cedula,ctaContable,usuario,tipoMedico,status,ruta,entidad,especialidad,nombreCompleto,cedulaE,
medicoGeneral,medicoEspecialista,medicoEspecialidad,
hospitalizacion,urgencias,
fisioterapia,consultaExterna,quirofano,endoscopia,
laboratorio,rayosx,otro,fechaInicial,fechaFinal,modalidad
) values (
'".$_POST['nombre1']."','".$_POST['apellido1']."',
'".$_POST['apellido2']."',
'".$contador."','".$_POST['fechaNacimiento']."',
'".$_POST['pais']."','".$_POST['telefono']."',
'".$_POST['cp']."','".$_POST['direccion']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['medicoInterno']."','".$_POST['cedula']."','".$_POST['ctaContable']."','".$usuario."',
'".$_POST['tipoMedico']."','".$_POST['status']."','".$uploadfile."','".$entidad."','".$_POST['especialidad']."','".$nombreCompleto."',
    '".$_POST['cedulaE']."',    '".$_POST['medicoGeneral']."',
        '".$_POST['medicoEspecialista']."',
'".$_POST['medicoEspecialidad']."','".$_POST['hospitalizacion']."',
    '".$_POST['urgencias']."','".$_POST['fisioterapia']."',
        '".$_POST['consultaExterna']."','".$_POST['quirofano']."','".$_POST['endoscopia']."','".$_POST['laboratorio']."',
            '".$_POST['rayosx']."','".$_POST['otro']."','".$_POST['fechaInicial']."','".$_POST['fechaFinal']."',
                '".$_POST['modalidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script>
window.alert( "SE AGREGO EL MEDICO!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';
exit();




$sSQL= "Select * From medicos WHERE entidad='".$entidad."' AND numMedico = ' ".$myrow333['conta']." ' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
} else {
//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
    //echo "Possible file upload attack!\n";
}
if($uploadfile=='images/'){
$uploadfile=$_POST['rutaImagen'];
}
//**********************************************************



$q = "UPDATE medicos set
medicoGeneral='".$_POST['medicoGeneral']."',
medicoEspecialista    ='".$_POST['medicoEspecialista']."',
medicoEspecialidad='".$_POST['medicoEspecialidad']."',
hospitalizacion='".$_POST['hospitalizacion']."',
urgencias='".$_POST['urgencias']."',
fisioterapia='".$_POST['fisioterapia']."',
consultaExterna='".$_POST['consultaExterna']."',
quirofano='".$_POST['quirofano']."',    
endoscopia='".$_POST['endoscopia']."',
laboratorio='".$_POST['laboratorio']."',
rayosx='".$_POST['rayosx']."',
otro='".$_POST['otro']."',
    modalidad='".$_POST['modalidad']."',
        fechaInicial='".$_POST['fechaInicial']."',
            fechaFinal='".$_POST['fechaFinal']."',
cedulaE='".$_POST['cedulaE']."',
    nombreCompleto='".$nombreCompleto."',
nombre1='".$_POST['nombre1']."', 
apellido1='".$_POST['apellido1']."',
apellido2='".$_POST['apellido2']."',
fechaNacimiento='".$_POST['fechaNacimiento']."',
pais='".$_POST['pais']."',
telefono='".$_POST['telefono']."',
cp='".$_POST['cp']."',
direccion='".$_POST['direccion']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
medicoInterno = '".$_POST['medicoInterno']."',
especialidad = '".$_POST['especialidad']."',
cedula = '".$_POST['cedula']."',
ctaContable = '".$_POST['ctaContable']."',usuario = '".$usuario."',
tipoMedico='".$_POST['tipoMedico']."',
status='".$_POST['status']."',
ruta='".$uploadfile."'
WHERE 
keyMedico='".$_GET['keyMedico']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>
window.alert( "SE ACTUALIZARON DATOS!");
//window.opener.document.forms["form1"].submit();
//window.close();
</script>';
$_POST['opcion']=0;
$sSQL= "Select * From medicos WHERE entidad='".$entidad."' AND numMedico = '".$_POST['numMedico']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);






$pwd='pwd';
$pwd= shell_exec($pwd);
$pwd=trim($pwd);


$ruta='mkdir '.$pwd.'/medDocs/'.$_GET['numMedico'];
$exe= shell_exec($ruta);

}




echo '<script>';
//echo 'window.opener.document.forms["form1"].submit();';
echo '</script>';
}else{
$tipoMensaje='error';
$encabezado='Error';
$texto='FALTAN CAMPOS POR LLENAR, VERIFICA';    
    
}
}//cierra actualizare




















if($_POST['borrar'] AND $_GET['keyMedico']){
$borrame = "DELETE FROM medicos WHERE keyMedico='".$_GET['keyMedico']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script>
window.alert( "SE ELIMINARON DATOS!");
</script>';

}





$sSQL= "SELECT *
  FROM
medicos
WHERE 
keyMedico='".$_GET['keyMedico']."' || (entidad='".$entidad."' and numMedico='".$_GET['numMedico']."')
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>

<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body onLoad="MM_preloadImages('/sima/imagenes/bordestablas/btns/newbtn.png')">

<br />
<h3>Formato alta medico</h3>


<form id="form1"  name="form1" method="POST" enctype="multipart/form-data">

  <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>  



<table width="800" class="table-forma"   >
        
    
    
       <tr >
      <th   colspan="3" >
        <div align="center" >Datos Generales</div>
             </th>
    </tr> 
    
    <tr >
        <td  align="left"  > C&eacute;dula profesional </td>
          
          <td colspan="2" >
     
                    <div align="left">           
                   <input name="cedula" value="<?php 
                      if($myrow['cedula']!=NULL){
                      echo $myrow['cedula'];
                      }else{
                        echo $_POST['cedula'];  
                      }
                      ?>" type="text" class="normal"></input> <font color="red">*</font>
                  
        

                     
                    </div>
          </td>
                      
 
        </tr>
    
    
    

    
    
    
    
    
    <tr>

     <td>
        <div align="left">
            

            C&eacute;dula especialidad
            </div>           
     </td>          
                      
          
          <td colspan="2"> <div align="left">
                      <input name="cedulaE" value="<?php echo $myrow['cedulaE'];?>" type="text" class="normal"></input>
          </div>
        
       
</td>



    </tr>
    
    
    
    
    
    

    
    
    
    <tr >
      <td  ><div align="left" > Tipo de M&eacute;dico </div></td>
      <td   colspan="2"><label>
          <div align="left">
            <?php //*********ANAQUELES
	   $sSQL7= "Select * From tipoMedico where entidad='".$entidad."' ORDER BY descripcionTipoMedico";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
            <select name="tipoMedico"  id="usuario" >
                <option value="" >Escoje</option>
            
              <?php 		 
		   while($myrow7 = mysql_fetch_array($result7)){  ?>
            <option
			 <?php if($myrow['tipoMedico']==$myrow7['tipoMedicos']){ ?>
			 selected="selected"
			 <?php } ?>
			 value="<?php echo $myrow7['tipoMedicos']; ?>"> <?php echo $myrow7['tipoMedicos']; ?></option>
              <?php } 
		
		?>
            </select><font color="red">*</font>
</div>
        </label>
          
      </td>
          
          
   
    </tr>
    
    
    
    
    
    
    
    <tr >
      <td  ><div align="left" >Nombres</div></td>
    <td  colspan="2"><label>
<div align="left">
            <input name="nombre1" type="text"  id="nombre1" value="<?php 
            
            if($myrow['nombre1']!=NULL){
            echo $myrow['nombre1'];
            }else{
            echo $_POST['nombre1'];    
            }
            ?>" size="25" /><font color="red">*</font>
        </div>
    
      </label></td>

    </tr>
    
    
    
    
    
    <tr >
      <td >Primer Apellido </td>
      <td  colspan="2"><input name="apellido1" type="text"  id="apellido1" value="<?php 
      if($myrow['apellido1']!=NULL){
      echo $myrow['apellido1'];
      }else{
          echo $_POST['apellido1'];
      }
      ?>" size="20" /><font color="red">*</font>
      
      </td>
     

    </tr>
    
    
    
    
    <tr >
      <td >Segundo Apellido</td>
      <td colspan="2" ><input name="apellido2" type="text"  id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="20" /></td>

    </tr>
    
    
    
    
    <!--tr >
      <td >Medico Especialista </td>
      <td  ><?php $interno= $myrow['medicoInterno']; ?>
        <label>
        <?php if($interno){ ?>
        <input name="medicoInterno" type="checkbox"  id="medicoInterno" value="yes" checked="checked" />
        <?php }else {?>
        <input name="medicoInterno" type="checkbox"  id="medicoInterno" value="no"/>
        <?php
		 } 
		  ?>
        </label></td>
      
      
            <td >
            <div align="left">


          </div></td>
      
    </tr-->
    
    
    
    
    <tr>
      <td  >Especialidad</td>
      <td  colspan="2">
      	  <?php 
$aCombo= "Select * From especialidades where 
entidad='".$entidad."'  
and
subEspecialidad='no'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>


		 <select name="especialidad" class="<?php echo $estilo;?>" id="especialidad"  />        
     
  <option value="" >Escoje</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		?>
        <option 
		<?php 
if($myrow['especialidad']==$resCombo['codigo']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>  <font color="red">*</font>    </td>

    
    </tr>
    
    
    
    
    
    
    
    
    <tr>
      <td  >Fecha de Nacimiento </td>
      <td  colspan="2"><input name="fechaNacimiento" type="text"  id="fechaNacimiento" 
	  value="<?php echo $myrow['fechaNacimiento']?>" size="12" /> <font color="red">* </font>
      formato: 2009-01-01 </td>

    </tr>
    
    
    
    
    <tr>
      <th  colspan="3"  ><div align="center">Direcci&oacute;n</div></th>
    </tr>
    <tr>
      <td  >Nacionalidad Actual</td>
      <td colspan="2" >
	       <select class="" id="pais" name="pais">
                    <option value=""   >Selecciona una opcion</option>
                    <option
					<?php if($myrow['pais']=='af')echo 'selected=""';?>
					 value="af"   >Afganistan</option>
                    <option
										<?php if($myrow['pais']=='ax')echo 'selected=""';?>
					 value="ax"   >Islas de Aland</option>

                    <option
										<?php if($myrow['pais']=='al')echo 'selected=""';?>
					 value="al"   >Albania</option>
                    <option
										<?php if($myrow['pais']=='dz')echo 'selected=""';?>
					 value="dz"   >Argelia</option>
                    <option
										<?php if($myrow['pais']=='as')echo 'selected=""';?>
					 value="as"   >Samoa Americana</option>
                    <option
										<?php if($myrow['pais']=='ad')echo 'selected=""';?>
					 value="ad"   >Andorra</option>
                    <option
										<?php if($myrow['pais']=='ao')echo 'selected=""';?>
					 value="ao"   >Angola</option>
                    <option
										<?php if($myrow['pais']=='ai')echo 'selected=""';?>
					 value="ai"   >Anguila</option>

                    <option
										<?php if($myrow['pais']=='aq')echo 'selected=""';?>
					 value="aq"   >Antartida</option>
                    <option
										<?php if($myrow['pais']=='ag')echo 'selected=""';?>
					 value="ag"   >Antigua y Barbuda</option>
                    <option
										<?php if($myrow['pais']=='ar')echo 'selected=""';?>
					 value="ar"   >Argentina</option>
                    <option
										<?php if($myrow['pais']=='am')echo 'selected=""';?>
					 value="am"   >Armenia</option>
                    <option
										<?php if($myrow['pais']=='aw')echo 'selected=""';?>
					 value="aw"   >Aruba</option>
                    <option
										<?php if($myrow['pais']=='au')echo 'selected=""';?>
					 value="au"   >Australia</option>

                    <option
										<?php if($myrow['pais']=='at')echo 'selected=""';?>
					 value="at"   >Austria</option>
                    <option
										<?php if($myrow['pais']=='az')echo 'selected=""';?>
					 value="az"   >Azerbayan</option>
                    <option
										<?php if($myrow['pais']=='bs')echo 'selected=""';?>
					 value="bs"   >Bahamas</option>
                    <option
					<?php if($myrow['pais']=='bh')echo 'selected=""';?>
					 value="bh"   >Bahrein</option>
                    <option
					<?php if($myrow['pais']=='bd')echo 'selected=""';?>
					 value="bd"   >Bangladesh</option>
                    <option
					<?php if($myrow['pais']=='bb')echo 'selected=""';?>
					 value="bb"   >Barbados</option>

                    <option
					<?php if($myrow['pais']=='by')echo 'selected=""';?>
					 value="by"   >Bielorrusia</option>
                    <option
					<?php if($myrow['pais']=='be')echo 'selected=""';?>
					 value="be"   >Belgica</option>
                    <option
					<?php if($myrow['pais']=='bz')echo 'selected=""';?>
					 value="bz"   >Belice</option>
                    <option
					<?php if($myrow['pais']=='bj')echo 'selected=""';?>
					 value="bj"   >Benin</option>
                    <option
					<?php if($myrow['pais']=='bm')echo 'selected=""';?>
					 value="bm"   >Bermudas</option>
                    <option
					<?php if($myrow['pais']=='bt')echo 'selected=""';?>
					 value="bt"   >Butan</option>

                    <option
					<?php if($myrow['pais']=='bo')echo 'selected=""';?>
					 value="bo"   >Bolivia</option>
                    <option
					<?php if($myrow['pais']=='ba')echo 'selected=""';?>
					 value="ba"   >Bosnia Herzegovina</option>
                    <option
					<?php if($myrow['pais']=='bw')echo 'selected=""';?>
					 value="bw"   >Botswana</option>
                    <option
					<?php if($myrow['pais']=='bv')echo 'selected=""';?>
					 value="bv"   >Isla Bouvet</option>
                    <option
					<?php if($myrow['pais']=='br')echo 'selected=""';?>					
					 value="br"   >Brasil</option>
                    <option
					<?php if($myrow['pais']=='io')echo 'selected=""';?>
					 value="io"   >Territorio Britanico en el Oceano Indico</option>

                    <option
					<?php if($myrow['pais']=='vg')echo 'selected=""';?>
					 value="vg"   >Islas Virgenes (Reino Unido)</option>
                    <option
					<?php if($myrow['pais']=='bn')echo 'selected=""';?>
					 value="bn"   >Brunei</option>
                    <option
					<?php if($myrow['pais']=='bg')echo 'selected=""';?>
					 value="bg"   >Bulgaria</option>
                    <option
					<?php if($myrow['pais']=='bf')echo 'selected=""';?>
					 value="bf"   >Burkina Faso</option>
                    <option
					<?php if($myrow['pais']=='bi')echo 'selected=""';?>
					 value="bi"   >Burundi</option>
                    <option
					<?php if($myrow['pais']=='kh')echo 'selected=""';?>
					 value="kh"   >Camboya</option>

                    <option
					<?php if($myrow['pais']=='cm')echo 'selected=""';?>
					 value="cm"   >Camerun</option>
                    <option
					<?php if($myrow['pais']=='ca')echo 'selected=""';?>
					 value="ca"   >Canada</option>
                    <option
					<?php if($myrow['pais']=='cv')echo 'selected=""';?>
					 value="cv"   >Cabo Verde</option>
                    <option
					<?php if($myrow['pais']=='ky')echo 'selected=""';?>
					 value="ky"   >Islas Caiman</option>
                    <option
					<?php if($myrow['pais']=='cf')echo 'selected=""';?>
					 value="cf"   >Republica Centroafricana</option>
                    <option 
					<?php if($myrow['pais']=='td')echo 'selected=""';?>
					value="td"   >Chad</option>

                    <option
					<?php if($myrow['pais']=='cl')echo 'selected=""';?>
					 value="cl"   >Chile</option>
                    <option
					<?php if($myrow['pais']=='cn')echo 'selected=""';?>
					 value="cn"   >China</option>
                    <option
					<?php if($myrow['pais']=='cx')echo 'selected=""';?>
					 value="cx"   >Isla de Navidad</option>
                    <option
					<?php if($myrow['pais']=='cc')echo 'selected=""';?>
					 value="cc"   >Islas Cocos (Keeling)</option>
                    <option 
					<?php if($myrow['pais']=='co')echo 'selected=""';?>
					value="co"   >Colombia</option>
                    <option
					<?php if($myrow['pais']=='km')echo 'selected=""';?>
					 value="km"   >Comoros</option>

                    <option
					<?php if($myrow['pais']=='cg')echo 'selected=""';?>
					 value="cg"   >Congo</option>
                    <option 
					<?php if($myrow['pais']=='ck')echo 'selected=""';?>
					value="ck"   >Islas Cook</option>
                    <option
					<?php if($myrow['pais']=='cr')echo 'selected=""';?>
					 value="cr"   >Costa Rica</option>
                    <option
					<?php if($myrow['pais']=='hr')echo 'selected=""';?>
					 value="hr"   >Croacia</option>
                    <option
					<?php if($myrow['pais']=='cu')echo 'selected=""';?>
					 value="cu"   >Cuba</option>
                    <option
					<?php if($myrow['pais']=='cy')echo 'selected=""';?>
					 value="cy"   >Chipre</option>

                    <option
					<?php if($myrow['pais']=='cz')echo 'selected=""';?>
					 value="cz"   >Republica Checa</option>
                    <option
					<?php if($myrow['pais']=='cd')echo 'selected=""';?>
					 value="cd"   >Republica Democratica del Congo</option>
                    <option
					<?php if($myrow['pais']=='dk')echo 'selected=""';?>
					 value="dk"   >Dinamarca</option>
                    <option
					<?php if($myrow['pais']=='xx')echo 'selected=""';?>
					 value="xx"   >Territorio Disputado</option>
                    <option
					<?php if($myrow['pais']=='dj')echo 'selected=""';?>
					 value="dj"   >Djibuti</option>
                    <option
					<?php if($myrow['pais']=='dm')echo 'selected=""';?>
					 value="dm"   >Dominica</option>

                    <option
					<?php if($myrow['pais']=='do')echo 'selected=""';?>
					 value="do"   >Republica Dominicana</option>
                    <option
					<?php if($myrow['pais']=='ti')echo 'selected=""';?>
					 value="tl"   >Timor Occidental</option>
                    <option
					<?php if($myrow['pais']=='ec')echo 'selected=""';?>
					 value="ec"   >Ecuador</option>
                    <option
					<?php if($myrow['pais']=='eg')echo 'selected=""';?>
					 value="eg"   >Egipto</option>
                    <option
					<?php if($myrow['pais']=='sv')echo 'selected=""';?>
					 value="sv"   >El Salvador</option>
                    <option
					<?php if($myrow['pais']=='gq')echo 'selected=""';?>
					 value="gq"   >Guinea Ecuatorial</option>

                    <option
					<?php if($myrow['pais']=='er')echo 'selected=""';?>
					 value="er"   >Eritrea</option>
                    <option
					<?php if($myrow['pais']=='ee')echo 'selected=""';?>
					 value="ee"   >Estonia</option>
                    <option
					<?php if($myrow['pais']=='et')echo 'selected=""';?>
					 value="et"   >Etiopia</option>
                    <option
					<?php if($myrow['pais']=='fk')echo 'selected=""';?>
					 value="fk"   >Islas Malvinas</option>
                    <option
					<?php if($myrow['pais']=='fo')echo 'selected=""';?>
					 value="fo"   >Islas Faroe</option>
                    <option
					<?php if($myrow['pais']=='fm')echo 'selected=""';?>
					 value="fm"   >Estados Federados de Micronesia</option>

                    <option
					<?php if($myrow['pais']=='fj')echo 'selected=""';?>
					 value="fj"   >Fiyi</option>
                    <option
					<?php if($myrow['pais']=='fi')echo 'selected=""';?>
					 value="fi"   >Finlandia</option>
                    <option
					<?php if($myrow['pais']=='fr')echo 'selected=""';?>
					 value="fr"   >Francia</option>
                    <option
					<?php if($myrow['pais']=='gf')echo 'selected=""';?>
					 value="gf"   >Guayana Francesa</option>
                    <option
					<?php if($myrow['pais']=='pf')echo 'selected=""';?>
					 value="pf"   >Polinesia Francesa</option>
                    <option
					<?php if($myrow['pais']=='tf')echo 'selected=""';?>
					 value="tf"   >Territorios Franceses del Sur</option>

                    <option
					<?php if($myrow['pais']=='ga')echo 'selected=""';?>
					 value="ga"   >Gabon</option>
                    <option
					<?php if($myrow['pais']=='gm')echo 'selected=""';?>
					 value="gm"   >Gambia</option>
                    <option
					<?php if($myrow['pais']=='ge')echo 'selected=""';?>
					 value="ge"   >Georgia</option>
                    <option
					<?php if($myrow['pais']=='de')echo 'selected=""';?>
					 value="de"   >Alemania</option>
                    <option
					<?php if($myrow['pais']=='gh')echo 'selected=""';?>
					 value="gh"   >Ghana</option>
                    <option
					<?php if($myrow['pais']=='gi')echo 'selected=""';?>
					 value="gi"   >Gibraltar</option>

                    <option
					<?php if($myrow['pais']=='gr')echo 'selected=""';?>
					 value="gr"   >Grecia</option>
                    <option
					<?php if($myrow['pais']=='gl')echo 'selected=""';?>
					 value="gl"   >Groelandia</option>
                    <option
					<?php if($myrow['pais']=='gd')echo 'selected=""';?>
					 value="gd"   >Grenada</option>
                    <option
					<?php if($myrow['pais']=='gp')echo 'selected=""';?>
					 value="gp"   >Guadalupe</option>
                    <option
					<?php if($myrow['pais']=='gu')echo 'selected=""';?>
					 value="gu"   >Guam</option>
                    <option
					<?php if($myrow['pais']=='gt')echo 'selected=""';?>
					 value="gt"   >Guatemala</option>

                    <option
					<?php if($myrow['pais']=='gn')echo 'selected=""';?>
					 value="gn"   >Guinea</option>
                    <option
					<?php if($myrow['pais']=='gw')echo 'selected=""';?>
					 value="gw"   >Guinea-Bissau</option>
                    <option
					<?php if($myrow['pais']=='gy')echo 'selected=""';?>
					 value="gy"   >Guyana</option>
                    <option
					<?php if($myrow['pais']=='ht')echo 'selected=""';?>
					 value="ht"   >Haiti</option>
                    <option
					<?php if($myrow['pais']=='hm')echo 'selected=""';?>
					 value="hm"   >Islas Heard y Mcdonald</option>
                    <option
					<?php if($myrow['pais']=='hn')echo 'selected=""';?>
					 value="hn"   >Honduras</option>

                    <option
					<?php if($myrow['pais']=='hk')echo 'selected=""';?>
					 value="hk"   >Hong Kong</option>
                    <option
					<?php if($myrow['pais']=='hu')echo 'selected=""';?>
					 value="hu"   >Hungria</option>
                    <option
					<?php if($myrow['pais']=='is')echo 'selected=""';?>
					 value="is"   >Islandia</option>
                    <option
					<?php if($myrow['pais']=='in')echo 'selected=""';?>
					 value="in"   >India</option>
                    <option
					<?php if($myrow['pais']=='id')echo 'selected=""';?>
					 value="id"   >Indonesia</option>
                    <option
					<?php if($myrow['pais']=='ir')echo 'selected=""';?>
					 value="ir"   >Iran</option>

                    <option
					<?php if($myrow['pais']=='iq')echo 'selected=""';?>
					 value="iq"   >Irak</option>
                    <option
					<?php if($myrow['pais']=='xe')echo 'selected=""';?>
					 value="xe"   >Zona Neutral entre Irak y Arabia Saudita</option>
                    <option
					<?php if($myrow['pais']=='ie')echo 'selected=""';?>
					 value="ie"   >Irlanda</option>
                    <option
					<?php if($myrow['pais']=='il')echo 'selected=""';?>
					 value="il"   >Israel</option>
                    <option
					<?php if($myrow['pais']=='it')echo 'selected=""';?>
					 value="it"   >Italia</option>
                    <option
					<?php if($myrow['pais']=='cl')echo 'selected=""';?>
					 value="ci"   >Costa de Marfil</option>

                    <option
					<?php if($myrow['pais']=='jm')echo 'selected=""';?>
					 value="jm"   >Jamaica</option>
                    <option
					<?php if($myrow['pais']=='jp')echo 'selected=""';?>
					 value="jp"   >Japon</option>
                    <option
					<?php if($myrow['pais']=='jo')echo 'selected=""';?>
					 value="jo"   >Jordania</option>
                    <option
					<?php if($myrow['pais']=='kz')echo 'selected=""';?>
					 value="kz"   >Kazajstan</option>
                    <option
					<?php if($myrow['pais']=='ke')echo 'selected=""';?>
					 value="ke"   >Kenia</option>
                    <option
					<?php if($myrow['pais']=='ki')echo 'selected=""';?>
					 value="ki"   >Kiribati</option>

                    <option
					<?php if($myrow['pais']=='kw')echo 'selected=""';?>
					 value="kw"   >Kuwait</option>
                    <option
					<?php if($myrow['pais']=='kg')echo 'selected=""';?>
					 value="kg"   >Kirguistan</option>
                    <option
					<?php if($myrow['pais']=='la')echo 'selected=""';?>
					 value="la"   >Laos</option>
                    <option
					<?php if($myrow['pais']=='lv')echo 'selected=""';?>
					 value="lv"   >Letonia</option>
                    <option
					<?php if($myrow['pais']=='lb')echo 'selected=""';?>
					 value="lb"   >Libano</option>
                    <option 
					<?php if($myrow['pais']=='ls')echo 'selected=""';?>
					value="ls"   >Lesoto</option>

                    <option
					<?php if($myrow['pais']=='lr')echo 'selected=""';?>
					 value="lr"   >Liberia</option>
                    <option 
					<?php if($myrow['pais']=='ly')echo 'selected=""';?>
					value="ly"   >Libia</option>
                    <option
					<?php if($myrow['pais']=='li')echo 'selected=""';?>
					 value="li"   >Liechtenstein</option>
                    <option 
					<?php if($myrow['pais']=='lt')echo 'selected=""';?>
					value="lt"   >Lituania</option>
                    <option
					<?php if($myrow['pais']=='lu')echo 'selected=""';?>
					 value="lu"   >Luxemburgo</option>
                    <option 
					<?php if($myrow['pais']=='mo')echo 'selected=""';?>
					value="mo"   >Macau</option>

                    <option 
					<?php if($myrow['pais']=='mk')echo 'selected=""';?>
					value="mk"   >Macedonia</option>
                    <option 
					<?php if($myrow['pais']=='mg')echo 'selected=""';?>
					value="mg"   >Madagascar</option>
                    <option
					<?php if($myrow['pais']=='mw')echo 'selected=""';?>
					 value="mw"   >Malawi</option>
                    <option
					<?php if($myrow['pais']=='my')echo 'selected=""';?>
					 value="my"   >Malasia</option>
                    <option 
					<?php if($myrow['pais']=='mv')echo 'selected=""';?>
					value="mv"   >Maldivas</option>
                    <option 
					<?php if($myrow['pais']=='ml')echo 'selected=""';?>
					value="ml"   >Mali</option>

                    <option 
					<?php if($myrow['pais']=='mt')echo 'selected=""';?>
					value="mt"   >Malta</option>
                    <option 
					<?php if($myrow['pais']=='mh')echo 'selected=""';?>
					value="mh"   >Islas Marshall</option>
                    <option 
					<?php if($myrow['pais']=='mq')echo 'selected=""';?>
					value="mq"   >Martinica</option>
                    <option 
					<?php if($myrow['pais']=='mr')echo 'selected=""';?>
					value="mr"   >Mauritania</option>
                    <option 
					<?php if($myrow['pais']=='mu')echo 'selected=""';?>
					value="mu"   >Mauricio</option>
                    <option 
					<?php if($myrow['pais']=='yt')echo 'selected=""';?>
					value="yt"   >Mayotte</option>

                    <option 
					<?php if($myrow['pais']=='mx')echo 'selected=""';?>
					value="mx"   SELECTED  >Mexico</option>
                    <option 
					<?php if($myrow['pais']=='md')echo 'selected=""';?>
					value="md"   >Moldova</option>
                    <option 
					<?php if($myrow['pais']=='mc')echo 'selected=""';?>
					value="mc"   >Monaco</option>
                    <option 
					<?php if($myrow['pais']=='mn')echo 'selected=""';?>
					value="mn"   >Mongolia</option>
                    <option
					<?php if($myrow['pais']=='ms')echo 'selected=""';?>
					 value="ms"   >Montserrat</option>
                    <option 
					<?php if($myrow['pais']=='ma')echo 'selected=""';?>
					value="ma"   >Marruecos</option>

                    <option 
					<?php if($myrow['pais']=='mz')echo 'selected=""';?>
					value="mz"   >Mozambique</option>
                    <option 
					<?php if($myrow['pais']=='mm')echo 'selected=""';?>
					value="mm"   >Myanmar</option>
                    <option 
					<?php if($myrow['pais']=='na')echo 'selected=""';?>
					value="na"   >Namibia</option>
                    <option 
					<?php if($myrow['pais']=='nr')echo 'selected=""';?>
					value="nr"   >Nauru</option>
                    <option 
					<?php if($myrow['pais']=='np')echo 'selected=""';?>
					value="np"   >Nepal</option>
                    <option 
					<?php if($myrow['pais']=='nl')echo 'selected=""';?>
					value="nl"   >Paises Bajos</option>

                    <option 
					<?php if($myrow['pais']=='an')echo 'selected=""';?>
					value="an"   >Antillas Holandesas</option>
                    <option 
					<?php if($myrow['pais']=='nc')echo 'selected=""';?>
					value="nc"   >Nueva Caledonia</option>
                    <option
					<?php if($myrow['pais']=='nz')echo 'selected=""';?>
					 value="nz"   >Nueva Zelanda</option>
                    <option
					<?php if($myrow['pais']=='ni')echo 'selected=""';?>
					 value="ni"   >Nicaragua</option>
                    <option 
					<?php if($myrow['pais']=='ne')echo 'selected=""';?>
					value="ne"   >Niger</option>
                    <option 
					<?php if($myrow['pais']=='ng')echo 'selected=""';?>
					value="ng"   >Nigeria</option>

                    <option 
					<?php if($myrow['pais']=='nu')echo 'selected=""';?>
					value="nu"   >Niue</option>
                    <option 
					<?php if($myrow['pais']=='nf')echo 'selected=""';?>
					value="nf"   >Isla Norfolk</option>
                    <option 
					<?php if($myrow['pais']=='kp')echo 'selected=""';?>
					value="kp"   >Corea del Norte</option>
                    <option 
					<?php if($myrow['pais']=='mp')echo 'selected=""';?>
					value="mp"   >Islas Marianas (Norte)</option>
                    <option 
					<?php if($myrow['pais']=='no')echo 'selected=""';?>
					value="no"   >Noruega</option>
                    <option 
					<?php if($myrow['pais']=='om')echo 'selected=""';?>
					value="om"   >Oman</option>

                    <option 
					<?php if($myrow['pais']=='pk')echo 'selected=""';?>
					value="pk"   >Pakistan</option>
                    <option
					<?php if($myrow['pais']=='pw')echo 'selected=""';?>
					 value="pw"   >Palau</option>
                    <option 
					<?php if($myrow['pais']=='ps')echo 'selected=""';?>
					value="ps"   >Territorios Ocupados Palestinos</option>
                    <option 
					<?php if($myrow['pais']=='pa')echo 'selected=""';?>
					value="pa"   >Panama</option>
                    <option 
					<?php if($myrow['pais']=='pg')echo 'selected=""';?>
					value="pg"   >Papua Nueva Guinea</option>
                    <option
					<?php if($myrow['pais']=='py')echo 'selected=""';?>
					 value="py"   >Paraguay</option>

                    <option 
					<?php if($myrow['pais']=='pe')echo 'selected=""';?>
					value="pe"   >Peru</option>
                    <option 
					<?php if($myrow['pais']=='ph')echo 'selected=""';?>
					value="ph"   >Filipinas</option>
                    <option 
					<?php if($myrow['pais']=='pn')echo 'selected=""';?>
					value="pn"   >Islas Pitcairn</option>
                    <option 
					<?php if($myrow['pais']=='pl')echo 'selected=""';?>
					value="pl"   >Polonia</option>
                    <option 
					
					<?php if($myrow['pais']=='pt')echo 'selected=""';?>
					value="pt"   >Portugal</option>
                    <option 
					<?php if($myrow['pais']=='pr')echo 'selected=""';?>
					value="pr"   >Puerto Rico</option>

                    <option 
					<?php if($myrow['pais']=='qa')echo 'selected=""';?>
					value="qa"   >Qatar</option>
                    <option 
					<?php if($myrow['pais']=='re')echo 'selected=""';?>
					value="re"   >Reunion</option>
                    <option 
					<?php if($myrow['pais']=='ro')echo 'selected=""';?>
					value="ro"   >Rumania</option>
                    <option 
					<?php if($myrow['pais']=='ru')echo 'selected=""';?>
					value="ru"   >Rusia</option>
                    <option 
					<?php if($myrow['pais']=='rw')echo 'selected=""';?>
					value="rw"   >Ruanda</option>
                    <option 
					<?php if($myrow['pais']=='sh')echo 'selected=""';?>
					value="sh"   >Santa Helena y Dependencias</option>

                    <option 
					<?php if($myrow['pais']=='kn')echo 'selected=""';?>
					value="kn"   >San Cristobal y Nieves</option>
                    <option
					<?php if($myrow['pais']=='lc')echo 'selected=""';?>
					 value="lc"   >Santa Lucia</option>
                    <option 
					<?php if($myrow['pais']=='pm')echo 'selected=""';?>
					value="pm"   >San Pedro y Miquelon</option>
                    <option 
					<?php if($myrow['pais']=='vc')echo 'selected=""';?>
					value="vc"   >San Vincente y las Granadinas</option>
                    <option
					<?php if($myrow['pais']=='ws')echo 'selected=""';?>
					 value="ws"   >Samoa</option>
                    <option
					<?php if($myrow['pais']=='sm')echo 'selected=""';?>
					 value="sm"   >San Marino</option>

                    <option 
					<?php if($myrow['pais']=='st')echo 'selected=""';?>
					value="st"   >Santo Tome y Principe</option>
                    <option 
					<?php if($myrow['pais']=='sa')echo 'selected=""';?>
					value="sa"   >Arabia Saudita</option>
                    <option 
					<?php if($myrow['pais']=='sn')echo 'selected=""';?>
					value="sn"   >Senegal</option>
                    <option 
					<?php if($myrow['pais']=='sc')echo 'selected=""';?>
					value="sc"   >Seychelles</option>
                    <option 
					<?php if($myrow['pais']=='sl')echo 'selected=""';?>
					value="sl"   >Sierra Leona</option>
                    <option 
					<?php if($myrow['pais']=='sg')echo 'selected=""';?>
					value="sg"   >Singapur</option>

                    <option
					<?php if($myrow['pais']=='sk')echo 'selected=""';?>
					 value="sk"   >Eslovaquia</option>
                    <option 
					<?php if($myrow['pais']=='si')echo 'selected=""';?>
					value="si"   >Eslovenia</option>
                    <option 
					<?php if($myrow['pais']=='sb')echo 'selected=""';?>
					value="sb"   >Islas Salomon</option>
                    <option 
					<?php if($myrow['pais']=='so')echo 'selected=""';?>
					value="so"   >Somalia</option>
                    <option 
					<?php if($myrow['pais']=='za')echo 'selected=""';?>
					value="za"   >Sudafrica</option>
                    <option 
					<?php if($myrow['pais']=='gs')echo 'selected=""';?>
					value="gs"   >Georgia del Sur e Islas Sandwich del Sur</option>

                    <option
					<?php if($myrow['pais']=='kr')echo 'selected=""';?>
					 value="kr"   >Corea del Sur</option>
                    <option
					<?php if($myrow['pais']=='es')echo 'selected=""';?>
					 value="es"   >Espa�a</option>
                    <option
					<?php if($myrow['pais']=='pi')echo 'selected=""';?>
					 value="pi"   >Islas Spratly</option>
                    <option 
					
					<?php if($myrow['pais']=='lk')echo 'selected=""';?>
					value="lk"   >Sri Lanka</option>
                    <option 
					<?php if($myrow['pais']=='sd')echo 'selected=""';?>
					value="sd"   >Sudan</option>
                    <option
					<?php if($myrow['pais']=='sr')echo 'selected=""';?>
					 value="sr"   >Surinam</option>

                    <option 
					<?php if($myrow['pais']=='sj')echo 'selected=""';?>
					value="sj"   >Svalbard y Jan Mayen</option>
                    <option 
					<?php if($myrow['pais']=='sz')echo 'selected=""';?>
					value="sz"   >Swazilandia</option>
                    <option 
					<?php if($myrow['pais']=='se')echo 'selected=""';?>
					value="se"   >Suecia</option>
                    <option
					<?php if($myrow['pais']=='ch')echo 'selected=""';?>
					 value="ch"   >Suiza</option>
                    <option 
					<?php if($myrow['pais']=='sy')echo 'selected=""';?>
					value="sy"   >Siria</option>
                    <option 
					<?php if($myrow['pais']=='tw')echo 'selected=""';?>
					value="tw"   >Taiwan</option>

                    <option 
					<?php if($myrow['pais']=='tj')echo 'selected=""';?>
					value="tj"   >Tayikistan</option>
                    <option
					<?php if($myrow['pais']=='tz')echo 'selected=""';?>
					 value="tz"   >Tanzania</option>
                    <option
					<?php if($myrow['pais']=='th')echo 'selected=""';?>
					 value="th"   >Tailandia</option>
                    <option
					<?php if($myrow['pais']=='tg')echo 'selected=""';?>
					 value="tg"   >Togo</option>
                    <option
					<?php if($myrow['pais']=='tk')echo 'selected=""';?>
					 value="tk"   >Tokelau</option>
                    <option 
					<?php if($myrow['pais']=='to')echo 'selected=""';?>
					value="to"   >Tonga</option>

                    <option 
					<?php if($myrow['pais']=='tt')echo 'selected=""';?>
					value="tt"   >Trinidad y Tobago</option>
                    <option 
					<?php if($myrow['pais']=='tn')echo 'selected=""';?>
					value="tn"   >Tunez</option>
                    <option
					<?php if($myrow['pais']=='tr')echo 'selected=""';?>
					 value="tr"   >Turquia</option>
                    <option
					<?php if($myrow['pais']=='tm')echo 'selected=""';?>
					 value="tm"   >Turkmenistan</option>
                    <option
					<?php if($myrow['pais']=='tc')echo 'selected=""';?>
					 value="tc"   >Islas Turcas y Caicos</option>
                    <option
					<?php if($myrow['pais']=='tv')echo 'selected=""';?>
					 value="tv"   >Tuvalu</option>

                    <option 
					<?php if($myrow['pais']=='ug')echo 'selected=""';?>
					value="ug"   >Uganda</option>
                    <option
					<?php if($myrow['pais']=='ua')echo 'selected=""';?>
					 value="ua"   >Ucrania</option>
                    <option 
					<?php if($myrow['pais']=='ae')echo 'selected=""';?>
					value="ae"   >Emiratos �rabes  Unidos</option>
                    <option 
					<?php if($myrow['pais']=='uk')echo 'selected=""';?>
					value="uk"   >Reino Unido</option>
                    <option
					<?php if($myrow['pais']=='us')echo 'selected=""';?>
					 value="us"   >Estados Unidos de America</option>
                    <option 
					<?php if($myrow['pais']=='um')echo 'selected=""';?>
					value="um"   >United States Minor Outlying Islands</option>

                    <option
					<?php if($myrow['pais']=='uy')echo 'selected=""';?>
					 value="uy"   >Uruguay</option>
                    <option
					<?php if($myrow['pais']=='vi')echo 'selected=""';?>
					 value="vi"   >Islas Virgenes (Estados Unidos de Am�rica)</option>
                    <option 
					<?php if($myrow['pais']=='uz')echo 'selected=""';?>
					value="uz"   >Uzbekistan</option>
                    <option
					<?php if($myrow['pais']=='vu')echo 'selected=""';?>
					 value="vu"   >Vanuatu</option>
                    <option 
					<?php if($myrow['pais']=='va')echo 'selected=""';?>
					value="va"   >Vaticano</option>
                    <option 
					<?php if($myrow['pais']=='ve')echo 'selected=""';?>
					value="ve"   >Venezuela</option>

                    <option 
					<?php if($myrow['pais']=='vn')echo 'selected=""';?>
					value="vn"   >Vietnam</option>
                    <option
					<?php if($myrow['pais']=='wf')echo 'selected=""';?>
					 value="wf"   >Wallis y Futuna</option>
                    <option 
					<?php if($myrow['pais']=='eh')echo 'selected=""';?>
					value="eh"   >Sahara Occidental</option>
                    <option 
					<?php if($myrow['pais']=='ye')echo 'selected=""';?>
					value="ye"   >Yemen</option>
                    <option
					<?php if($myrow['pais']=='zm')echo 'selected=""';?>
					 value="zm"   >Zambia</option>
                    <option
					<?php if($myrow['pais']=='zw')echo 'selected=""';?>
					 value="zw"   >Zimbabwe</option>

                    <option
					<?php if($myrow['pais']=='rs')echo 'selected=""';?>
					 value="rs"   >Serbia</option>
                    <option
					<?php if($myrow['pais']=='me')echo 'selected=""';?>
					 value="me"   >Montenegro</option>
               </select>
	   <font color="red">*</font></td>
      
    </tr>
    <tr>
      <td  >Tel&eacute;fono</td>
      <td  colspan="2"><input name="telefono" type="text"  id="telefono" value="<?php echo $myrow['telefono']; ?>" size="15" /><font color="red">*</font></td>
      
    </tr>
    <tr>
      <td  >Celular</td>
      <td  colspan="2"><input name="telefono" type="text"  id="telefono" value="<?php echo $myrow['celular']; ?>" size="15" /><font color="red">*</font></td>
      
    </tr>
    <tr>
      <td  >Direcci&oacute;n</td>
      <td  colspan="2"><input name="direccion" type="text"  id="direccion" value="<?php echo $myrow['direccion']; ?>" size="40" /><font color="red">*</font></td>

    </tr>
    <tr>
      <td  >Correo electronico</td>
      <td  colspan="2"><input name="direccion" type="text"  id="correoElectronico" value="<?php echo $myrow['correoElectronico']; ?>" size="40" /><font color="red">*</font></td>

    </tr>    
    <tr>
      <td  >C&oacute;digo Postal</td>
      <td  colspan="2"><input name="cp" type="text"  id="cp" value="<?php echo $myrow['cp']; ?>" /><font color="red">*</font></td>
   
    </tr>
    <tr>
      <td  >Ciudad</td>
      <td  colspan="2"><input name="ciudad" type="text"  id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="25" /><font color="red">*</font></td>
     
    </tr>
    <tr>
      <td  >Estado</td>
      <td  colspan="2"><input name="estado" type="text"  id="estado" value="<?php echo $myrow['estado']; ?>" size="15" /><font color="red">*</font></td>
  
    </tr>

    
    
    
     <tr>
         <th  colspan="3"  ><div align="center">Informaci&oacute;n Adicional</div></th>
    </tr>
   
    
  
    <tr>
      <td  >Tipo de Trabajo</td>
      <td colspan="2" ><label>
        <select name="modalidad" onChange="this.form.submit();">

            <?php if($myrow['modalidad']!=NULL){?>
           
           <option
               <?php if($myrow['modalidad']=='T' and $_POST['modalidad']=='T'){echo 'selected=""';}?>
               value="T">Temporal</option>
            

           	<option
                <?php if($myrow['modalidad']=='P'   and $_POST['modalidad']=='P'){echo 'selected=""';}?>
                value="P">Permanente</option> 
            <?php }else{?>
           <option
               <?php if($_POST['modalidad']=='T' ){echo 'selected=""';}?>
               value="T">Temporal</option>
            

           	<option
                <?php if($_POST['modalidad']=='P'   ){echo 'selected=""';}?>
                value="P">Permanente</option> 
            <?php }?>
            
        </select>
      </label></td>
      
    </tr>
    

       <tr>
         <th  colspan="3"  ><div align="center"></div></th>
    </tr>
    
    
</table>
    


<?php if( $_POST['modalidad']!='P' ){?>


    <table width="800" class="table-forma">     
<tr>
        
        <td ><div align="left">Fecha</div></td>
        <td width="300">Fecha inicial 
          
              <div align="left">
            <input name="fechaInicial" type="text" class="normal" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
              </div>
         
        <input name="button" type="button" src="../imagenes/calendario.png" id="lanzador" value="..." /> 
        </td>
        
        
     
        <td  width="300">Fecha final
    
          <input name="fechaFinal" type="text" class="normal" id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
        
        <input name="button1" type="button" src="../imagenes/calendario.png" id="lanzador1" value="..." /></td>
      </tr>
    
        
     </table>
    
    <script type="text/javascript"> 
          
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
     <br>
  <?php }else{ 
    
 
    
    
    ?>
    
        <table width="800" class="table-forma"> 
    <tr>
 
      <td colspan="3" ><b>Solicito se me concedan privilegios clinicos en calidad de:</b></td>
      
    </tr>    
    <tr>
      <td  ><input type="checkbox" name="medicoGeneral" value="si" <?php  if($myrow['medicoGeneral']=='si'){echo 'checked=""';}?>>Medico General </input></td>
      <td colspan="2" ></td>
      
    </tr>
    <tr>
      <td  >
          
          
          <input type="checkbox" name="medicoEspecialista" value="si" <?php  if($myrow['medicoEspecialista']=='si'){echo 'checked=""';}?>>Medico Especialista en </input></td>
      <td colspan="2" >
                
                      
                     
          <input name="medicoEspecialidad" type="text" id="especialista" value="<?php echo $myrow['medicoEspecialidad']; ?>" size="15"/>
      <font color="red">*</font>
          </td>
      
    </tr>
    

    
    <tr>
     
        <td colspan="3" >Para ofrecer mis servicios en las siguientes &aacute;reas clinicas del Hospital La Carlota S.C.:</td>
      
    </tr>    
    <tr>
        <td  ><input type="checkbox" name="hospitalizacion" value="si" 
            <?php  if($myrow['hospitalizacion']=='si'){echo 'checked=""';}?>>Hospitalizaci&oacute;n</input></td>
      <td ><input type="checkbox" name="consultaExterna" value="si" <?php  if($myrow['consultaExterna']=='si'){echo 'checked=""';}?>>Consulta Externa</input></td>
      <td ><input type="checkbox" name="laboratorio" value="si"
<?php  if($myrow['laboratorio']=='si'){echo 'checked=""';}?>                  
                  >Laboratorio clinico</input></td>
    </tr>
    <tr>
        <td  ><input type="checkbox" name="urgencias" value="si"
<?php  if($myrow['urgencias']=='si'){echo 'checked=""';}?>                      
                     >Urgencias</input></td>
        <td ><input type="checkbox" name="quirofano" value="si"
<?php  if($myrow['quirofano']=='si'){echo 'checked=""';}?>                     
                    >Quir&oacute;fanos</input></td>
      <td ><input type="checkbox" name="rayosx" value="si" 
<?php  if($myrow['rayosx']=='si'){echo 'checked=""';}?>                   
                  >Rayos X</input></td>
    </tr>    
    <tr>
        <td  ><input type="checkbox" name="fisioterapia" value="si"
<?php  if($myrow['fisioterapia']=='si'){echo 'checked=""';}?>                      
                     >Fisioterapia</input></td>
        <td ><input type="checkbox" name="endoscopia" value="si"
<?php  if($myrow['endoscopia']=='si'){echo 'checked=""';}?>                     
                    >Sala de Endoscopia</input></td>
      <td >Otro                  
          <input name="otro" type="text" class="normal" id="otro" size="25" maxlength="25"
		  value="<?php echo $myrow['otro'];?>" />
       </td>
    </tr> 
      
    

</table>





         

        <?php } ?>
        


         
  

         <br>
<br>


<div align="center"><input name="actualizar" type="submit" src='/sima/imagenes/bordestablas/btns/refreshbtn.png'  id="actualizar" value="Modificar/Grabar" />
    </div>
    



<input name="opcion" type="hidden" value="<?php echo $_POST['opcion'];?>"></input>


</form>











































    
<meta charset="utf-8">

<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="subir/css/bootstrap.min.css">
<!-- Generic page styles -->
<link rel="stylesheet" href="subir/css/style.css">
<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
<link rel="stylesheet" href="subir/css/bootstrap-responsive.min.css">
<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" href="subir/css/bootstrap-image-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="subir/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="subir/css/jquery.fileupload-ui-noscript.css"></noscript>
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>


    <br>
<table align="center" width="800" class="table-forma" >
    <tr>
        <td>
                <div class="container">
    <div >
        <h3 align="center">Adjuntar Archivos</h3>
    </div>
    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
    <br>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" name="form2" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        
        
        
        
        <div class="row fileupload-buttonbar" align="center">
            <div class="span7" >
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Agregar Archivos</span>
                    
                    <input type="file" name="files[]" multiple>
                </span>
  
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Subir</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancelar</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Eliminar</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    <br>
    
</div>
            
            
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td>{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td>{% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td>
            <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>
            
   
        </td>
    </tr>
</table>
        
        
        
 

<script src="subir/js/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="subir/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="subir/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="subir/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="subir/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="subir/js/bootstrap.min.js"></script>
<script src="subir/js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="subir/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="subir/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="subir/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="subir/js/jquery.fileupload-ui.js"></script>







<!-- The main application script -->
<script >
/*
 * jQuery File Upload Plugin JS Example 7.1.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: 'subir/server/php/index.php?numMedico=<?php echo $_GET['medico'];?>'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.com' ||
            window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            process: [
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1440,
                    maxHeight: 900
                },
                {
                    action: 'save'
                }
            ]
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function (result) {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, null, {result: result});
        });
    }

});

</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    
    
    


















    
    
    
    
    

        <br><br><br>



         <br>
<br>





    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    






</body>
</html>

<?php
}
}
?>

