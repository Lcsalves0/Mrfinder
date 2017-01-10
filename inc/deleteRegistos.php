<?php include ('../connections/config.php');

/**********************************************
*********** REMOVE DOS FAVORITOS **************
**********************************************/
if(isset($_POST['removefavoritos'])){
	
	$id_empresa = $_POST['id_empresa'];
	$id_user = $_POST['id_user'];
	$sqlRegisto = mysql_query("DELETE FROM favoritos WHERE id_empresa= ".$id_empresa." ");
	echo "
	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../autenticacao/detalhe.php?id=".$id_empresa."'>
	<script type=\"text/javascript\">
	alert(\"Empresa removida doss seus favoritos!\");
	</script>
	";
}

?>
