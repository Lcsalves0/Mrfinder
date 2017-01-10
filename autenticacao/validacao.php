<?php
	session_start();
?>

<?php
	include ('../connections/config.php');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql_acesso = mysqli_query("SELECT * FROM utilizadores WHERE username = '$username' AND password = '$password'");
	$resultado = mysqli_fetch_array($sql_acesso);
	
	if(mysqli_num_rows($sql_acesso) == 1){


	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UserID'] = $resultado['id_user'];
	$_SESSION['UserNivel'] = $resultado['nivel'];

	// Redireciona o admin
	$nivel_admin = 1;
	// Redireciona o utilizador
	$nivel_user = 2;
	
	
	if (!isset($_SESSION['UserID']) OR ($_SESSION['UserNivel'] == $nivel_admin)) { 
	
		
		$_SESSION['usernameSession'] = $username;
		$_SESSION['passwordSession'] = $password;
		
		header("Location: ../admin-mrprojeto/index.php?id=".$_SESSION['UserID'].""); exit;
		 
    } 
    else if(!isset($_SESSION['UserID']) OR ($_SESSION['UserNivel'] == $nivel_user)){ 
    
		$_SESSION['usernameSession'] = $username;
		$_SESSION['passwordSession'] = $password;
	
    	header("Location: ../inc/editarperfil.php?id=".$_SESSION['UserID'].""); exit; 
    }
       
    else{ $message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";

}
	
	
	}else{
		
		unset($_SESSION['usernameSession']);
		unset($_SESSION['passwordSession']);
		header('Location: ../index.php');
		exit();
		
	}

?>