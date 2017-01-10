<!--**********************************************
*********** UPLOAD IMAGENS ***************
**********************************************/	-->
<?php
function upload_image($thumbnail, $caminho){
	
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
			$pasta = 'empresas/'.$caminho.'/';
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
				$thumbnail = $caminho.'/'.$nome;
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
