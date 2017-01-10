<?php 
	include ('../connections/config.php');
	$sql = "UPDATE info_empresas SET ativo='sim' WHERE id='".$_REQUEST['id']."'";
	$resultado = mysql_query($sql);

	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../admin-mrprojeto/index.php.php'>
		<script type=\"text/javascript\">
		alert(\"Empresa Ativa!\");
		</script>
		";
				
?>