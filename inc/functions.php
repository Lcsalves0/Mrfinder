<!--**********************************************
*********** FUNCAO LISTAR EMPRESAS ADMIN ********
**********************************************/	-->
<?php

function admin_atividade($id){
	$query="SELECT * FROM ramoatividade WHERE id_atividade = ".$id."";
	$mysql=mysqli_query($conn, $query);
	$row=mysqli_fetch_array($mysql);
?>

<div class="col-sm-3"><a href="?pagina=listarEmpresas?id_atividade=<?php echo $row['id_atividade'] ?>" class="recent-work" style="background-image:url(../assets/images/category_images/<?php echo $row['imagem'] ?>)"> <span class="btn btn-o-white"><?php echo $row ['atividade']?></span> </a> </div>
<?php
}
?>

<!--**********************************************
*********** FUNCAO DEVOLVE INFO ATIVIDADE ********
**********************************************/	-->
<?php
function atividade($id){
	$query="SELECT * FROM ramoatividade WHERE id_atividade = ".$id."";
	$mysql=mysqli_query($conn, $query);
	$row=mysqli_fetch_array($mysql);
?>

<div class="col-sm-3"><a href="" class="recent-work" style="background-image:url(assets/images/category_images/<?php echo $row['imagem'] ?>)"> <span class="btn btn-o-white"><?php echo $row ['atividade']?></span> </a> </div>
<?php
}
?>

<!--**********************************************
*********** UPLOAD IMAGENS ***************
**********************************************/	-->
<?php
function upload_image($thumbnail, $username){
	
	/* RECUPERO TODAS AS INFORMAÇÕES POSSÍVEIS DO ARQUIVO */
	$nome      = $_FILES['thumbnail']['name'];
	$tamanho   = $_FILES['thumbnail']['size'];
	$tipo      = $_FILES['thumbnail']['type'];
	$nome_temp = $_FILES['thumbnail']['tmp_name'];	
	
	$erros = array();
	
	/* VERIFICO SE O ARQUIVO ENVIADO É DO TIPO IMAGEM */
	if($tipo == 'image/jpeg' || $tipo == 'image/jpg' || $tipo == 'image/gif' || $tipo == 'image/bmp' || $tipo == 'image/png') {
		/* 
		VERIFICO SE O TAMANHO NÃO ULTRAPASSA 2Mb 
		O CALCULO DEVE SER REALIZADO EM BYTES.
		*/
		if($tamanho <= 2097152) {
			//$pasta = '../autenticacao/thumbnails/'.$username.'/';
			switch($_GET['var']){
				case 'user':
					//$pasta = '../autenticacao/thumbnails/';
					$pasta = '../autenticacao/thumbnails/'.$username.'/';
					/* VERIFICO SE A PASTA NÃO EXISTE, SE ELA NÃO EXISTIR, EU CRIO A PASTA */
					if(!file_exists($pasta)) {
						mkdir($pasta, 0777);
					}
				break;
				case 'empresa':
					$pasta = '../autenticacao/empresas/'.$username.'/';
					/* VERIFICO SE A PASTA NÃO EXISTE, SE ELA NÃO EXISTIR, EU CRIO A PASTA */
					if(!file_exists($pasta)) {
						mkdir($pasta, 0777);
					}
				break;
			}
			/* 
			TENTO ENVIAR O ARQUIVO PARA A PASTA arquivos QUE ESTÁ LOCALIZADA NA RAIZ DO MEU PROJETO 
			*/
			
			if(move_uploaded_file($nome_temp, $pasta.$nome)) {
				
	/**********************************************
	**********************************************/	
				$thumbnail = $username.'/'.$nome;
				return $thumbnail;

			}else{
			
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
				<script type=\"text/javascript\">
				alert(\"Erro!\");
				</script>
				";
			}
		}
		else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
				<script type=\"text/javascript\">
				alert(\"Imagem demasiado grande!\");
				</script>
				";
		}
	}
else{

	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
		<script type=\"text/javascript\">
		alert(\"Formato de imagem invalido!\");
		</script>
		";
}
}
?>


<!--**********************************************
*********** UPLOAD VIDEO ***************
**********************************************/	-->
<?php
function upload_video($video, $nif){
	
	/* RECUPERO TODAS AS INFORMAÇÕES POSSÍVEIS DO ARQUIVO */
	$nome      = $_FILES['video']['name'];
	$tamanho   = $_FILES['video']['size'];
	$tipo      = $_FILES['video']['type'];
	$nome_temp = $_FILES['video']['tmp_name'];	
	
	$erros = array();
	
	/* VERIFICO SE O ARQUIVO ENVIADO É DO TIPO VIDEO */
	if($tipo == 'video/mp4' || $tipo == 'video/mpeg') {
		/* 
		VERIFICO SE O TAMANHO NÃO ULTRAPASSA 200Mb 
		O CALCULO DEVE SER REALIZADO EM BYTES.
		*/
		if($tamanho <= 20097152) {
			$pasta = '../autenticacao/empresas/'.$nif.'/videos/';
			/* VERIFICO SE A PASTA NÃO EXISTE, SE ELA NÃO EXISTIR, EU CRIO A PASTA */
			if(!file_exists($pasta)) {
				mkdir($pasta, 0777);
			}
			/* 
			TENTO ENVIAR O ARQUIVO PARA A PASTA arquivos QUE ESTÁ LOCALIZADA NA RAIZ DO MEU PROJETO 
			*/
			
			if(move_uploaded_file($nome_temp, $pasta.$nome)) {
				
	/**********************************************
	**********************************************/	
				$thumbnail = $pasta.$nome;
				return $thumbnail;

			}else{
			
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
				<script type=\"text/javascript\">
				alert(\"Erro!\");
				</script>
				";
			}
		}
		else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
				<script type=\"text/javascript\">
				alert(\"Video demasiado grande!\");
				</script>
				";
		}
	}
else{

	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../index.php'>
		<script type=\"text/javascript\">
		alert(\"Formato do video invalido!\");
		</script>
		";
}
}
?>

<!--**********************************************
*********** Qts EMPRESAS TEM USER X **************
**********************************************/	-->
<?php
function UserTemEmpresas($id){
		$sql = "SELECT * FROM empresas WHERE id_user = ".$_SESSION['UserID']." AND ativo IN ('sim', 'nao')";
		$result 	= mysql_query ($sql);
		$num_results 	= mysql_num_rows($result);
		
		if(isset($_POST['eliminarEmpresa'])){
			$row = mysql_fetch_array ($result);
			
			$sql2 = mysql_query("UPDATE empresas SET ativo='removido' WHERE id_empresa='".$row['id_empresa']."'");
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php?id_user=".$_SESSION['UserID']."'>
			<script type=\"text/javascript\">
			alert(\"Empresa Excluida!\");
			</script>
			";
		}
		
		if ($num_results!=0){?>
			<div class="alert alert-success" role="alert"><?php echo 'Neste momento tem <strong>' .$num_results. '</strong> empresas registadas'; ?></div>
		<?php 
			while ($row	= mysqli_fetch_array ($result)) {
			?>
                <div class="row">
                  <div class="col-sm-6 col-md-12">
                    <div class="content_search" style="float:left; border-bottom:1px solid #E0E0E0;">
                      <div class="col-sm-6 col-md-4"> <img class="img_small" src="<?php echo '../autenticacao/empresas/'.$row['logo'];?>" > </div>
                      <div class="col-sm-6 col-md-8">
                        <div class="content_info">
                          <div class="content_title"><a href="../autenticacao/detalhe.php?id=<?php echo $row['id_empresa'] ?>"><?php echo $row['nome_empresa']; ?></a></div>
                          <div class="content_description">
	                          <?php if($row['ativo']=='nao'){?>
                              <span class="label label-warning">
                              <?php //if($row['ativo']=='nao')
                                    echo 'pendente'; ?>
                              </span>
                              <?php }?>
                              <?php if($row['ativo']=='sim'){?>
                              <span class="label label-success">
                                    <?php echo 'aceite'; ?>
                              </span>
                              <?php }?>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm6 col-md-4"></div>
                      <div class="col-sm-6 col-md-4">
                        <form action="" method="post">
                        <a href="<?php echo '../autenticacao/editar_empresa.php?id='.$row['id_empresa'].' '; ?>" class="btns btn_edit">Editar</a>
                        <button type="submit" class="btns btn-danger" name="eliminarEmpresa" onClick="confirmDelete();">Eliminar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
<?php
			}
		}
		else {
			?>
            <div class="alert alert-info" role="alert"><?php echo 'Neste momento tem <strong>' .$num_results. '</strong> empresas registadas'; ?></div>
            <?php
		}
}
?>

<!--**********************************************
**** Qts EMPRESAS TEM USER X nos FAVORiTOS ******
**********************************************/	-->
<?php
function UserTemFavoritos($id){
		$sql = "SELECT * FROM favoritos WHERE id_user = ".$_SESSION['UserID']."";
		$result 	= mysql_query ($sql);
		$num_results 	= mysql_num_rows($result);
								
		if ($num_results!=0){?>
			<div class="alert alert-success" role="alert"><?php echo 'Neste momento tem <strong>' .$num_results. '</strong> empresas na sua lista'; ?></div>
		<?php 
			while ($row	= mysql_fetch_array ($result)) {
				$sql2 = "SELECT * FROM empresas WHERE id_empresa = ".$row['id_empresa']." ";
				$result2 = mysql_query ($sql2);
				$row2 = mysql_fetch_array ($result2);
				
				$sql3 = "SELECT distrito FROM distrito WHERE id_distrito = ".$row2['id_distrito']." ";
                $result3 = mysql_query ($sql3);
                $row3 = mysql_fetch_array ($result3) or die (mysql_error());
			?>
                <div class="row">
                  <div class="col-sm-6 col-md-12">
                    <div class="content_search" style="float:left; border-bottom:1px solid #E0E0E0;">
                      <div class="col-sm-6 col-md-4"> <img class="img_small" src="<?php echo '../autenticacao/empresas/'.$row2['logo'];?>" > </div>
                      <div class="col-sm-6 col-md-8">
                        <div class="content_info">
                          <div class="content_title"><a href="../autenticacao/detalhe.php?id=<?php echo $row['id_empresa'] ?>"><?php echo $row2['nome_empresa']; ?></a></div>
                          <div><?php echo $row3['distrito']; ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<?php
			}
		}
		else {
			?>
            <div class="alert alert-info" role="alert">
				<?php echo 'Atualmente não tem <strong>0</strong> empresas guardada.'; ?>
            </div>
            <?php
		}
}
?>

<!--**********************************************
******** VERIFICA SE ESTA NOS FAVORiTOS **********
**********************************************/	-->
<?php
function verificaFavoritos($id_user, $id_empresa){
		$sql = "SELECT * FROM favoritos WHERE id_user = ".$_SESSION['UserID']." AND id_empresa = ".$id_empresa." ";
		$result 	= mysql_query ($sql);
		$num_results 	= mysql_num_rows($result);
		
		return $num_results;
}
?>

<!--**********************************************
******** VERIFICA JA FOI AVALIADA **********
**********************************************/	-->
<?php
function verificaAvaliacao($id_user, $id_empresa){
		$sql = "SELECT * FROM rating_empresa WHERE id_user = ".$_SESSION['UserID']." AND id_empresa = ".$id_empresa." ";
		$result 	= mysql_query ($sql);
		$num_results 	= mysql_num_rows($result);
		
		return $num_results;
}
?>

<!--**********************************************
******** VERIFICA JA FOI AVALIADA **********
**********************************************/	-->
<?php
function verificaEstrelas($id_user, $id_empresa){
		$sql = "SELECT count(*) as count, AVG(rating_score) as score FROM `rating_empresa` WHERE 1 AND id_empresa = ".$id_empresa." ";
		$result = mysql_query ($sql);
		$row = mysql_fetch_array($result);
		//$mensagem = "Avaliado por <strong>" .$row['score'] . "</strong> based on <strong>" . $row['count']. "</strong> users";
		//echo "SELECT count(*) as count, AVG(rating_score) as score FROM `rating_empresa` WHERE 1 AND id_empresa = ".$results['id_empresa']." ";
		return $row['score'];
		
}
?>





<?php
function multi_images($thumbnail, $id_empresa){
	
	$sqlSelect = mysql_query("SELECT * FROM empresas WHERE id_empresa = $id_empresa ");
	$registo = mysql_fetch_array($sqlSelect);
	$j = 0;
	$target_path = "../autenticacao/empresas/".$registo['nif']."/galeria/";

	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	
		$validextensions = array("jpeg", "jpg", "png");
		$ext = explode('.', basename($_FILES['file']['name'][$i]));   
		$file_extension = end($ext); 
		$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
		$j = $j + 1;      
	
		if (($_FILES["file"]["size"][$i] < 300000) && in_array($file_extension, $validextensions)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
				$sqlInser = mysql_query("INSERT INTO galeria (id_galeria, caminho) VALUES (".$row["id_galeria"].", '".$_FILES['file']['name'][$i]."')");
				
			} else {
	
				echo '<div id="error">Image '.$j.'--> <b>Please Try Again!</b></div>';
			}
	
		} else {   
	
			echo '<div id="error">Image '.$j.'--> <b>Check file Size or Type</b></div>';
	
		}  
	}
}
?>