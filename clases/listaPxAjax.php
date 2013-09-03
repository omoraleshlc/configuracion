<?php 
class listadoPacientesClass{ 
public function listadoPx($basedatos){ 
?>

<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=800,height=750,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=600,height=750,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<head>
	
		<style type="text/css" media="screen">
			body {
				font: 11px arial;
			}
			.suggest_link {
				background-color: #FFFFFF;
				padding: 2px 6px 2px 6px;
			}
			.suggest_link_over {
				background-color: #3366CC;
				padding: 2px 6px 2px 6px;
			}
			#search_suggest {
	position: absolute;
	background-color: #FFFFFF;
	text-align: left;
	border: 1px solid #000000;
	left: 748px;
	top: 60px;
			}
			.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}		
		</style>
		
		<script language="JavaScript" type="text/javascript" src="/sima/js/ajax_search.js"></script>
	</head>
<body>




     <div align="center">
       <input name="txtSearch" type="text" class="style12" id="txtSearch" onKeyUp="searchSuggest();" 
	   value="<?php echo $_POST['txtSearch'];?>" size="60" alt="Search Criteria" autocomplete="off" 
	   onChange="javascript:this.form.submit();" 
	   /> 
     </div>
     <div align="center">
     <div id="search_suggest"  align="justify" >	 
	   </div>

       <br />
     </div>



</body>
</html>
<?php 
 } 
} ?>