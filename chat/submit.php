<?php
//session_start();	
require_once("chat.php");
$submit = new chat();
$query="insert into chat values ('".$usuario."','".$_GET["chat"]."','000000',NOW())";
$submit->connect_easy($query);
?>
