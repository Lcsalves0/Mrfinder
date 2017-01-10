<?php include ('../connections/config.php');




/**********************************************
*********** ADD TESTEMUNHOS **************
**********************************************/
if(isset($_POST['enviarTestemunho'])){
	
	$id_user = $_POST['id_user'];
	$descricao = $_POST['descricao'];
	
	$sqlRegisto = mysql_query("INSERT INTO testemunhos (id_user, descricao, ativo) VALUES ('$id_user', '$descricao', 'nao')");
	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php'>
		<script type=\"text/javascript\">
		alert(\"Obrigado pelo seu contributo.\");
		</script>
		";
}

/*********************************************
*********** ADD Mensagem ao Mr.Finder **************
**********************************************/
if(isset($_POST['enviarContato'])){
	
	$email = $_POST['email'];
	$assunto = $_POST['assunto'];
	$descricao = $_POST['descricao'];
	
	$sqlRegisto = mysql_query("INSERT INTO contatos (email, assunto, descricao) VALUES ('$email', '$assunto', '$descricao')");
	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
		<script type=\"text/javascript\">
		alert(\"Mensagem enviada.\");
		</script>
		";
}

/**********************************************
*********** ADD AOS FAVORITOS **************
**********************************************/
if(isset($_POST['addfavoritos'])){
	
	$id_empresa = $_POST['id_empresa'];
	$id_user = $_POST['id_user'];
	$sqlRegisto = mysql_query("INSERT INTO favoritos (id_empresa, id_user) VALUES ('$id_empresa', '$id_user')");
	echo "
	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../autenticacao/detalhe.php?id=".$id_empresa."'>
	<script type=\"text/javascript\">
	alert(\"Empresa adicionada aos seus favoritos!\");
	</script>
	";
}
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
	alert(\"Empresa removida dos seus favoritos!\");
	</script>
	";
}
/**********************************************
*********** ADD RATING **************
**********************************************/
if(isset($_POST['enviarRating'])){
	
	$id_empresa = $_POST['id_empresa'];
	$id_user = $_POST['id_user'];
	$rating_score = $_POST['rating_score'];
	
	$sqlRegisto = mysql_query("INSERT INTO rating_empresa (id_empresa, id_user, rating_score) VALUES ('$id_empresa', '$id_user', '$rating_score')");
	echo "
	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../autenticacao/detalhe.php?id=".$id_empresa."'>
	<script type=\"text/javascript\">
	alert(\"Avaliou a empresa em ".$rating_score." estrelas\");
	</script>
	";
}
?>
