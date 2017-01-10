<?php 
	//Chama a página de configuração e conexão com o banco de dados
	include ('../connections/config.php');
	include ('functions.php');

switch(@$_GET['var']){

	case 'user':
	
		//Criando variáveis e pegando os dados preenchidos no formulário
		$email  = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];
		@$thumbnail = upload_image($_POST['thumbnail'], $_POST['username']);
		//$thumbnail = upload_image($thumbnail);
		
		//echo '</br> INSERT INTO utilizadores (username, email, password, confirmPassword, thumbnail , nivel, ativo) VALUES ('.$username.', '.$email.', '.$password.', '.$confirmPassword.', '.$thumbnail.',2, nao ';
		//SQL que irá verificar se o login digitado é igual ao login do banco de dados
		$sqlBusca      = mysqli_query("SELECT * FROM utilizadores WHERE username = '$username'");
		$verifica = mysqli_num_rows($sqlBusca);
		
		//Condição que irá verificar se o usuário já é registado
		if($verifica == 0){
			$sqlRegisto = mysqli_query("INSERT INTO utilizadores (username, email, password, confirmPassword, thumbnail , nivel, ativo) VALUES ('$username', '$email', '$password', '$confirmPassword', '$thumbnail', '2', 'sim')");
			
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
				<script type=\"text/javascript\">
				alert(\"Utilizador registado com Sucesso!\");
				</script>
				";
		}
	break;
	
	case 'empresa':
		$id_plano = $_POST['plano'];
		
		$nome_empresa  = $_POST['nome_empresa'];
		$id_user = $_POST['id_user'];
		$nome_responsavel  = $_POST['nome_responsavel'];
		$email  = $_POST['email'];
		$nif = $_POST['nif'];
		$telefone  = $_POST['telefone'];
		$telemovel  = $_POST['telemovel'];
		
		$morada = $_POST['morada'];
		$cod_postal  = $_POST['cod_postal'];
		$localidade = $_POST['localidade'];
		$id_distrito = $_POST['id_distrito'];
		
		$id_atividade = $_POST['id_atividade'];
		$url  = $_POST['url'];
		$facebook = $_POST['facebook'];
		$descricao = $_POST['descricao'];

		$logo = upload_image(@$_POST['thumbnail'], $_POST['nif']);
		/*
		$temHorario = $_POST['temHorario'];
		$inicioManha = $_POST['inicioManha'];
		$fimManha = $_POST['fimManha'];
		$inicioTarde = $_POST['inicioTarde'];
		$fimTarde = $_POST['fimTarde'];
		$servico = $_POST['servico'];
		*/
		//$longitude = $_POST['longitude'];
		//$latitude = $_POST['latitude'];
		//$galeria = upload_image($_POST['galeria'], $_POST['nif']);
		//$video = upload_video($_POST['video'], $_POST['nif']);


		$sqlRegisto = mysqli_query("INSERT INTO empresas (nome_empresa, id_user, nome_responsavel, email, nif, telefone, telemovel, morada, localidade, cod_postal, id_distrito, id_atividade, url, facebook, descricao, logo, ativo) VALUES ('$nome_empresa', '$id_user', '$nome_responsavel', '$email', '$nif' ,'$telefone', '$telemovel', '$morada', '$localidade', '$cod_postal', '$id_distrito', '$id_atividade', '$url', '$facebook', '$descricao', '$logo', 'nao')");
		
		$sql = "SELECT id_empresa FROM empresas WHERE nif = '".$nif."' ";
		$result = mysqli_query ($conn, $sql);
		$row	= mysqli_fetch_array ($result);
		$id_empresa = $row['id_empresa'];
		
		//$sqlRegisto2 = mysqli_query("INSERT INTO horario_funcionamento (id_empresa, temHorario, inicioManha, fimManha,inicioTarde, fimTarde, servico) VALUES ( '$id_empresa', '$temHorario', '$inicioManha', '$fimManha', '$inicioTarde', '$fimTarde', '$servico')");
		
		$sqlRegisto3 = mysqli_query("INSERT INTO plano_empresa (id_empresa, id_plano) VALUES ('$id_empresa', '$id_plano') ");
		
		
		
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php'>
			<script type=\"text/javascript\">
			alert(\"Empresa registado com Sucesso!\");
			</script>
			";
		break;
}
?>