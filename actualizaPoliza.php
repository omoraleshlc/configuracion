<?php 
/*
$connection = pg_connect("host=10.2.1.250 port=5432 dbname=carlota user= postgres password=postgres") 
      or die ("NO SE PUEDE CONECTAR" . pg_last_error($conn)); 



    $result=pg_exec("SELECT * FROM mateo.nom_tblimptotal WHERE fecha>='2012-09-01' "); // Sample of SQL QUERY 
        $fetch = pg_fetch_row($query_st); // Sample of SQL QUERY 

    pg_close($connection); // Close this connection 

$result = pg_query($db, "UPDATE book SET book_id = $_POST[bookid_updated] AND name = '$_POST[book_name_updated]' AND
price = $_POST[price_updated] AND date_of_publication = $_POST[dop_updated]");

*/
?> 






<html>

  <head>

  <body bgcolor="white">

  <?php


  $link = pg_Connect("host=10.2.1.250 dbname=carlota user=postgres password=postgres port=5432");



//AFECTA LA TABLA DE IMPUESTOS 
//nom_tblimptotal

$fecha='26-09-2012';
$numPoliza='00180';
$concepto_id=14;
$idLibro=29;
$id_ejercicio='001-2012';







if($fecha!=NULL and $numFactura>0){



/*
$result = pg_query($link, "select * from mateo.nom_tblimptotal where fecha>='".$fecha."'");
while ($row = pg_fetch_row($result)) {
$a+=1;
  echo '#'.$a.'  Fecha: '.$row['fecha']  E-mail: $row[1]";
  echo "<br />\n";
}

*/
?>



<h1><div align="left">TABLA DE IMPUESTOS</div></h1>

<table width="666" class="table table-striped" >
     <tr >
       <th  >
         <div align="left">#</div>
       </th>
       <th ><div align="left" >
         <div align="left">Fecha </div>
       </th>
	   
	   
       <th ><div align="left">Percepcion</div></th>
     </tr>


<?php
$sSQL= "

SELECT * FROM mateo.nom_tblimptotal where to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')
";
 
 
$result=pg_query($link,$sSQL); 
while($myrow = pg_fetch_array($result)){
$a+=1;
?>
     
     <tr  > 
       <td  ><div align="left">       <?php echo $a;?></div>
        </td>


       <td ><div align="left">
         
         <?php echo $myrow['fecha'];?>	  
       </div></td>
       
	   
	   
	   <td ><div align="left" >
	<?php echo '$'.number_format($myrow['percepciones'],2);?>   
		
       </div>	   </td>
	   
	   
     </tr>
     <?php }?>
   </table>



<br><br>

<div align="left">FACTURAS</div>

<table width="666" class="table table-striped" >
     <tr >
       <th  >
         <div align="left">#</div>
       </th>
       <th ><div align="left" >
         <div align="left">Fecha </div>
       </th>


       <th ><div align="left">Descripcion</div></th>

  <th ><div align="left">Empleado ID</div></th>


     </tr>


<?php
 $sSQL= "

select * from mateo.nom_facturass where 
to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')

and concepto_id='".$concepto_id."'  ";
 
 
$result=pg_query($link,$sSQL); 
while($myrow = pg_fetch_array($result)){
$ai+=1;
?>

<tr  > 
       <td  ><div align="left">       <?php echo $ai;?></div>
        </td>


       <td ><div align="left">

         <?php echo $myrow['fecha'];?>    
       </div></td>



           <td ><div align="left" >
        <?php echo $myrow['descripcion'];?>   

       </div>      </td>


     <td ><div align="left" >
        <?php echo $myrow['empleado_id'];?>   

       </div>      </td>



 </tr>
     <?php }?>
   </table>



<br>
<br>



<br><br>




















<div align="lefft">MOVIMIENTOS</div>

<table width="666" class="table table-striped" >
     <tr >
       <th  >
         <div align="left">#</div>
       </th>
       <th ><div align="left" >
         <div align="left">Descripcion</div>
       </th>


       <th ><div align="left">Fecha</div></th>

  <th ><div align="left">Libro</div></th>


     </tr>





<?php
$sSQL1= "

select * from mateo.cont_movimiento where folio='".$numPoliza."' and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."' 

";
 
 
$result1=pg_query($link,$sSQL1); 
while($myrow1 = pg_fetch_array($result1)){
$aer+=1;
?>

<tr  > 
       <td  ><div align="left">       <?php echo $aer;?></div>
        </td>


<td ><div align="left">

         <?php echo $myrow1['descripcion'];?>    
       </div></td>

           <td ><div align="left" >
        <?php echo $myrow1['fecha'];?>   

       </div>      </td>

<td ><div align="left" >
        <?php echo $myrow1[2];?>   

       </div>      </td>



 </tr>
     <?php }?>
   </table>

































<div align="lefft">POLIZAS</div>

<table width="666" class="table table-striped" >
     <tr >
       <th  >
         <div align="left">#</div>
       </th>
       <th ><div align="left" >
         <div align="left">Descripcion</div>
       </th>


       <th ><div align="left">CCosto</div></th>

  <th ><div align="left">Libro</div></th>


     </tr>



<?php
 $sSQL= "

select * from mateo.cont_poliza where folio='".$numPoliza."' and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."' ";
 
 
$result=pg_query($link,$sSQL); 
while($myrow = pg_fetch_array($result)){
$ar+=1;
?>

<tr  > 
       <td  ><div align="left">       <?php echo $ar;?></div>
        </td>

<td ><div align="left">

         <?php echo $myrow[5];?>    
       </div></td>



           <td ><div align="left" >
        <?php echo $myrow[1];?>   

       </div>      </td>

<td ><div align="left" >
        <?php echo $myrow[2];?>   

       </div>      </td>



 </tr>
     <?php }?>
   </table>








<br>
<br>








<?php

/*
$result = pg_query($db, "UPDATE book SET book_id = $_POST[bookid_updated] AND name = '$_POST[book_name_updated]' AND
price = $_POST[price_updated] AND date_of_publication = $_POST[dop_updated]");

SELECT * FROM mateo.nom_tblimptotal where to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')
select * from mateo.nom_facturass where 
to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')
and concepto_id='".$concepto_id."'  
select * from mateo.cont_movimiento where folio='".$numPoliza."' and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."' 
select * from mateo.cont_poliza where folio='".$numPoliza."' and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."'
*/



$query1 = pg_query($link, "DELETE FROM MATEO.nom_tblimptotal
WHERE
to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')
");


$query2= pg_query($link,"DELETE FROM MATEO.nom_facturass where 
to_date('".$fecha."','dd-mm-yyyy') = to_date(to_char(fecha,'dd-mm-yyyy'),'dd-mm-yyyy')
and concepto_id='".$concepto_id."' ");

$query3=pg_query($link,"DELETE FROM MATEO.cont_movimiento 
where 
folio='".$numPoliza."' and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."' ");


$query4=pg_query($link,"DELETE  FROM MATEO.cont_poliza 
where folio='".$numPoliza."' 
and id_libro='".$idLibro."' and id_ejercicio='".$id_ejercicio."' ");
}

?>



</body>
</head>
</html>
