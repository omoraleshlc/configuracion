<style type="text/css">
body {
	font-size: 1em;
}

#calendario td, #calendario tr, #calendario th {
	border: #000 1px solid;
}

#calendario th {
	background-color: #E4E9FC;
}

.diaNumero {
	font-size: 0.7em;
}

.hoy {
	background-color: #FFFFD4;
}

</style>	
	
</head>

<body>

<table id="calendario">



<?php
/* 


$sSQL7a1="SELECT *
FROM
reportesFinancieros
WHERE
usuario='".$usuario."'
and
random='".$random."'
and
seguro='".$myrow['seguro']."'
and
clientePrincipal='".$myrow['clientePrincipal']."'
";

$result7a1=mysql_db_query($basedatos,$sSQL7a1);
while(  $myrow7a1 = mysql_fetch_array($result7a1)){


 $f=substr($myrow7a1['fecha'],8,9);


switch ($f) {

   case "01" :
  $dia1[0]=$myrow7a1['cantidad'];
   break;

   case "02" :
  $dia2[0]=$myrow7a1['cantidad'];
   break;

   case "03" :
  $dia3[0]=$myrow7a1['cantidad'];
   break;
   
   case "04" :
  $dia4[0]=$myrow7a1['cantidad'];
   break;   

   case "05" :
  $dia5[0]=$myrow7a1['cantidad'];
   break;

   case "06" :
  $dia6[0]=$myrow7a1['cantidad'];
   break;   
   
   case "07" :
  $dia7[0]=$myrow7a1['cantidad'];
   break; 
   
   case "08" :
  $dia8[0]=$myrow7a1['cantidad'];
   break; 

   case "09" :
  $dia9[0]=$myrow7a1['cantidad'];
   break; 

   case "10" :
  $dia10[0]=$myrow7a1['cantidad'];
   break; 

   case "11" :
  $dia11[0]=$myrow7a1['cantidad'];
   break; 

   case "12" :
  $dia12[0]=$myrow7a1['cantidad'];
   break; 
   
   case "13" :
  $dia13[0]=$myrow7a1['cantidad'];
   break; 

   case "14" :
  $dia14[0]=$myrow7a1['cantidad'];
   break; 


   case "15" :
  $dia15[0]=$myrow7a1['cantidad'];
   break; 

   case "16" :
  $dia16[0]=$myrow7a1['cantidad'];
   break; 

   case "17" :
  $dia17[0]=$myrow7a1['cantidad'];
   break; 


   case "18" :
  $dia18[0]=$myrow7a1['cantidad'];
   break; 
   
   case "19" :
  $dia19[0]=$myrow7a1['cantidad'];
   break; 
   

   case "20" :
  $dia20[0]=$myrow7a1['cantidad'];
   break;
   
   case "21" :
  $dia21[0]=$myrow7a1['cantidad'];
   break;
   
   case "22" :
  $dia22[0]=$myrow7a1['cantidad'];
   break;            
      
   case "23" :
  $dia23[0]=$myrow7a1['cantidad'];
   break; 	  
   
   case "24" :
  $dia24[0]=$myrow7a1['cantidad'];
   break; 
   
   case "25" :
  $dia25[0]=$myrow7a1['cantidad'];
   break;       

   case "26" :
  $dia26[0]=$myrow7a1['cantidad'];
   break; 
   
   
   case "27" :
  $dia27[0]=$myrow7a1['cantidad'];
   break; 
 
    case "28" :
  $dia28[0]=$myrow7a1['cantidad'];
   break; 
   
   case "29" :
  $dia29[0]=$myrow7a1['cantidad'];
   break;    
     
	 
   case "30" :
  $dia30[0]=$myrow7a1['cantidad'];
   break; 


  case "31" :
  $dia31[0]=$myrow7a1['cantidad'];
   break; 
	 
   default :
   echo "Invalido";
   break;

   

	 
} //cierro while


} */
?>	

<tr class="semana1">
	
	<td><span class="diaNumero">1</span><span class="precio2">
	<?php 
$sSQL7a1="SELECT sum(cantidad) as c,fecha
FROM
reportesFinancieros
WHERE
usuario='".$usuario."'
and
random='".$random."'
and
seguro='".$myrow['seguro']."'
and
clientePrincipal='".$myrow['clientePrincipal']."'  ";
$result7a1=mysql_db_query($basedatos,$sSQL7a1);
 $myrow7a1 = mysql_fetch_array($result7a1);

$f=substr($myrow7a1['fecha'],8,9);
if($f=='01'){
	echo '</br>';
	echo $f;
}
?>
	</span></td>
	<td><span class="diaNumero">2</span>
	<span class="precio2">
	<?php 
	if($dia2[0]){
	echo '</br>';
	echo $dia2[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">3</span>
	<span class="precio2">
	<?php 
	if($dia3[0]){
	echo '</br>';
	echo $dia3[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">4</span>
	<span class="precio2">
	<?php 
	if($dia4[0]){
	echo '</br>';
	echo $dia4[0].'';
	}
	?>
	</span>	</td>

	<td><span class="diaNumero">5</span>
	<span class="precio2">
	<?php 
	if($dia5[0]){
	echo '</br>';
	echo $dia5[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">6</span>
		<span class="precio2">
	<?php 
	if($dia6[0]){
	echo '</br>';
	echo $dia6[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">7</span>
		<span class="precio2">
	<?php 
	if($dia7[0]){
	echo '</br>';
	echo $dia7[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">8</span>
		<span class="precio2">
	<?php 
	if($dia8[0]){
	echo '</br>';
	echo $dia8[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">9</span>
		<span class="precio2">
	<?php 
	if($dia9[0]){
	echo '</br>';
	echo $dia9[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">10</span>
		<span class="precio2">
	<?php 
	if($dia10[0]){
	echo '</br>';
	echo $dia10[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">11</span>
		<span class="precio2">
	<?php 
	if($dia11[0]){
	echo '</br>';
	echo $dia11[0].'';
	}
	?>
	</span>	</td>

	<td><span class="diaNumero">12</span>
		<span class="precio2">
	<?php 
	if($dia12[0]){
	echo '</br>';
	echo $dia12[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">13</span>
		<span class="precio2">
	<?php 
	if($dia13[0]){
	echo '</br>';
	echo $dia13[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">14</span>
		<span class="precio2">
	<?php 
	if($dia14[0]){
	echo '</br>';
	echo $dia14[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">15</span>
		<span class="precio2">
	<?php 
	if($dia15[0]){
	echo '</br>';
	echo $dia15[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">16</span>
		<span class="precio2">
	<?php 
	if($dia16[0]){
	echo '</br>';
	echo $dia16[0].'';
	}
	?>
	</span>	</td>
	<td class="hoy"><span class="diaNumero">17</span>
		<span class="precio2">
	<?php 
	if($dia17[0]){
	echo '</br>';
	echo $dia17[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">18</span>
		<span class="precio2">
	<?php 
	if($dia18[0]){
	echo '</br>';
	echo $dia18[0].'';
	}
	?>
	</span>	</td>

	<td><span class="diaNumero">19</span>
		<span class="precio2">
	<?php 
	if($dia19[0]){
	echo '</br>';
	echo $dia19[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">20</span>
		<span class="precio2">
	<?php 
	if($dia20[0]){
	echo '</br>';
	echo $dia20[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">21</span>
		<span class="precio2">
	<?php 
	if($dia21[0]){
	echo '</br>';
	echo $dia21[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">22</span>
		<span class="precio2">
	<?php 
	if($dia22[0]){
	echo '</br>';
	echo $dia22[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">23</span>
		<span class="precio2">
	<?php 
	if($dia23[0]){
	echo '</br>';
	echo $dia23[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">24</span>
		<span class="precio2">
	<?php 
	if($dia24[0]){
	echo '</br>';
	echo $dia24[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">25</span>
		<span class="precio2">
	<?php 
	if($dia25[0]){
	echo '</br>';
	echo $dia25[0].'';
	}
	?>
	</span>	</td>

	<td><span class="diaNumero">26</span>
		<span class="precio2">
	<?php 
	if($dia26[0]){
	echo '</br>';
	echo $dia26[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">27</span>
		<span class="precio2">
	<?php 
	if($dia27[0]){
	echo '</br>';
	echo $dia27[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">28</span>
		<span class="precio2">
	<?php 
	if($dia28[0]){
	echo '</br>';
	echo $dia28[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">29</span>
		<span class="precio2">
	<?php 
	if($dia29[0]){
	echo '</br>';
	echo $dia29[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">30</span>
		<span class="precio2">
	<?php 
	if($dia30[0]){
	echo '</br>';
	echo $dia30[0].'';
	}
	?>
	</span>	</td>
	<td><span class="diaNumero">31</span>
		<span class="precio2">
	<?php 
	if($dia31[0]){
	echo '</br>';
	echo $dia31[0].'';
	}
	?>
	</span>	</td>
	<td></td>
</tr>
</table>

</body>
</html>