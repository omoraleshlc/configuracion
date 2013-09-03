<?php


    $q4 = "

    INSERT INTO contadorFacturas(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorFacturas where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT
    contador
    FROM contadorFacturas
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    $keyMOV= $myrow['contador'];
?>