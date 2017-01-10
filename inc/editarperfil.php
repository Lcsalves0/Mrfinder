<?php

include ('../connections/config.php');

session_start();

if(!isset($_SESSION['usernameSession']) AND !isset($_SESSION['passwordSession'])){
	header("Location: ../index.php");
	exit;
} else {

$sql="select * from utilizadores where id_user='".$_SESSION['UserID']."'";
mysql_query("SET NAMES utf8");
$resultado = mysql_query($sql) or die (mysql_error());
$registo = mysql_fetch_array($resultado);

$username = $registo['username'];
$thumbnail = $registo['thumbnail'];
?>

<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lte9 lte8" lang="en-US">	<![endif]-->
<!--[if IE 9]><html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" lang="en-US">
<!--<![endif]-->
<head>
<title>Smart Find</title>

<script type="text/javascript" src="../assets/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap-filestyle.min.js"> </script>

<!--   SCRIPT IMAGE PREVIEW -->
<script type="text/javascript" src="../assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
				$()
				/*$image = $_POST["image"][$key];
        	    $sql = mysql_query("UPDATE utilizadores SET thumbnail='../autenticacao/thumbnails/nelson/$image' WHERE id_user=12 )");*/
            }
        }
    });
});


</script>
<!----------------------->


<!-- meta -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no"/>

<!-- google fonts -->
<link href='http://fonts.googleapis.com/css?family=Raleway:500,300' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold"/>

<!-- css -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/style.css" media="screen"/>
<link rel="stylesheet" href="../assets/css/myStyle.css"/>

<!-- Script para editar o .select-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.js"></script>
		<![endif]-->

<!--[if IE 8]>
	    	<script src="assets/js/selectivizr.js"></script>
	    <![endif]-->
        
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='checkbox'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
  </script>
<script type="text/JavaScript">
 
	function confirmDelete(){
		var agree = confirm("Tem a certeza que pretende eliminar?");
		if(agree)
			return true;
		else
			return false;
	}
</script>

</head>

<body>
<header class="shows">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-xs-8 col-sm-4 header-logo"> <br>
        <a href="<?php echo "editarperfil.php?id=".$_SESSION['UserID']." ";?>">
        <h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>
        </a> </div>
      <div class="col-md-6 col-xs-8">
      <div class="margem"></div>  
        <form id="bootstrapSelectForm" method="post" class="form-horizontal" action="../autenticacao/search.php?var=search">
        <div class="form-group col-md-8">
        <input type="text" class="form-control" name="searchText" placeholder="Procurar...">
        </div>
        <div class="form-group col-md-4">
        <select name="searchDistrito" class="form-control">
        <option >Distrito</option>
        <?php 
            $sql="SELECT id_distrito, distrito FROM distrito";
            mysql_query("SET NAMES utf8");
            $mysql=mysql_query($sql);
            while ($row=mysql_fetch_array($mysql)) {
        ?>
        <option  value="<?php echo $row['id_distrito']; ?>"><?php echo $row['distrito']; ?></option>
        <?php }?>
        </select>
        </div>
        <div class="form-group col-md-1">
        <button type="submit" name="submitSearch" class="btn-search" aria-label="Left Align"><span class="fa fa-search" aria-hidden="true"></span></button>
        </div>
        </form>
      </div>
      <div class="col-md-3 col-xs-8">
        <nav class="navbar navbar-default">
          <div class="container-fluid nav-bar"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-def" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li> <a href="index.php"><i class="fa fa-home"></i> Home</a> </li>
                <li> <a class="btn btn-info" href="#"><?php echo '<img src="../autenticacao/thumbnails/'.$thumbnail.'" class="img_perfil"/>';?></a>
                  <ul style="padding:0;">
                    <a href="logout.php">
                    <li><i class="glyphicon glyphicon-off"></i>Logout</li>
                    </a>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- /navbar-collapse --> 
          </div>
          <!-- / .container-fluid --> 
        </nav>
      </div>
    </div>
  </div>
</header>

<?php include ('functions.php'); ?>

<div id="wrapper">
  <div class="margem"></div>
  <!-- margem -->
  
	<?php			
    if(isset($_POST['editar'])){
        @$thumbnail2 = upload_image($_POST['thumbnail'], $username);
        $sql = mysql_query("UPDATE utilizadores SET thumbnail='".$thumbnail2."' WHERE id_user='".$_SESSION['UserID']."'");
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php?id_user=".$registo['id_user']."'>
            <script type=\"text/javascript\">
            alert(\"Foto atualizada!\");
            </script>
            ";
		if($thumbnail != 'default.jpg')
			@unlink('../autenticacao/thumbnails/'.$thumbnail);
    }
    else if(isset($_POST['eliminar'])){
        $sql = mysql_query("DELETE FROM utilizadores WHERE id_user=".$_SESSION['UserID']." AND thumbnail = ".$thumbnail." ");
		if($thumbnail != 'default.jpg'){
			@unlink('../autenticacao/thumbnails/'.$thumbnail);
			$thumbnail = 'default.jpg';
			$sql2 = mysql_query("UPDATE utilizadores SET thumbnail='".$thumbnail."' WHERE id_user='".$_SESSION['UserID']."'");
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php?id_user=".$registo['id_user']."'>
				<script type=\"text/javascript\">
				alert(\"Foto Eliminada!\");
				</script>
				";
		}else
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php'>
				<script type=\"text/javascript\">
				alert(\"Não pode eliminar a foto default!\");
				</script>
				";

    }
	else if(isset($_POST['atuPassword'])){
		$sql = mysql_query("UPDATE utilizadores SET password='".$_POST['password']."', confirmPassword = '".$_POST['confirmPassword']."' WHERE id_user='".$_SESSION['UserID']."'");
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarperfil.php'>
			<script type=\"text/javascript\">
			alert(\"Password atualizada!\");
			</script>
			";

    }
    ?>
  
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-md-3">
        <div class="panel panel-default"> 
          <!-- Default panel contents -->
          <div class="panel-heading">Foto de perfil</div>
          <form action="<?php echo '?var=user';?>" method="post" enctype="multipart/form-data">
	          <div class="content_image">

				<div id="imagePreview" style="background-image: url(<?php echo '../autenticacao/thumbnails/'.$thumbnail;?>); ">

	                <button type="submit" id="myButton" class="btn" name="editar" style="margin-left:136px;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                </div>
               
			</div>
          
          <div class="row">
			<div class="col-xs-8 col-md-9">
              <input type="file" id="uploadFile" class="custom-file-input-warning" name="thumbnail" >
              <button type="submit" id="myButton" class="btns btn-danger" name="eliminar" onClick="confirmDelete();">Eliminar</button>
              
            </form>
            
			</div>
          </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-md-8">
        <div class="content">
          <ul id="tabs" class="nav nav-tabs-perfil" data-tabs="tabs">
            <li class="active"><a href="#editarperfil" data-toggle="tab">Dados Pessoais</a></li>
            <li><a href="#favoritos" data-toggle="tab">Favoritos</a></li>
            <li><a href="#empreReg" data-toggle="tab">Empresas Registadas</a></li>
            <li style="float:right;"><a href="#avaliar" data-toggle="tab">Avaliar</a></li>
            <li><a href="#addEmpresa" data-toggle="tab" style="background-color:#036;">Adicionar Empresa</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="editarperfil">
              <form id="editarForm" method="post" enctype="multipart/form-data" action="" class="form-horizontal"
            data-bv-message="This value is not valid"
            data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
            data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
            data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="col-xs-6 col-md-12">
                <div class="alert alert-info" role="alert">
					<?php echo 'Edite os seus <strong>dados pessoais</strong>.'; ?>
                </div>
                  <div class="form-group">
                    <div class="col-xs-12 col-md-12">
                    <label>Username:</label>
                      <input type="text" class="input_style large" placeholder="<?php echo $registo['username']; ?>" disabled/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-xs-12 col-md-12">
                    <label>Email:</label>
                      <input type="email" class="input_style large" placeholder="<?php echo $registo['email']; ?>" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="col-xs-12 col-md-12">
                      <label>Nova Password:</label>
                      <input type="password" class="input_style large" name="password" placeholder="Password"
                           required data-bv-notempty-message="Password obrigatória!"
                           data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="Confirme Password!"/>
                    </div>
                </div>
                <div class="form-group">
                <div class="col-xs-12 col-md-12">
                  <label>Confirme Password:</label>
                      <input type="password" class="input_style large" name="confirmPassword" placeholder="Confirme Password"
                               required data-bv-notempty-message="Password obrigatória!"
                               data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="Password diferentes!"/>
                    </div>
                </div>
                  <div class="modal-footer">
                  <div class="col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-warning pull-rigth" name="atuPassword">Editar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="favoritos">
            <?php 
				UserTemFavoritos($_SESSION['UserID']);
			?>
            </div>
            <div class="tab-pane" id="empreReg">
            <?php
				UserTemEmpresas($_SESSION['UserID']);
			?>
            </div>
            
            <div class="tab-pane" id="addEmpresa">
                 <div class="row">
                     <div class="col-xs-12 col-md-10">
                        <div class="tab-content">
                            <div class="alert alert-info" role="alert">
								<?php echo 'Registe a sua empresa no <strong>Mr. Finder</strong>'; ?>
			                </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="stepwizard ">
                                  <div class="stepwizard-row setup-panel">
                                  	<div class="stepwizard-step"> <a href="#step-0" type="button" class="btn btn-primary btn-circle">Plano</a> </div>
                                    <div class="stepwizard-step"> <a href="#step-1" type="button" class="btn btn-default btn-circle" disabled="disabled">Dados</a> </div>
                                    <div class="stepwizard-step"> <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">Localização</a> </div>
                                    <div class="stepwizard-step"> <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">Detalhe</a> </div>
                                    <div class="stepwizard-step"> <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">Informação</a> </div>                                   
                                    <div class="stepwizard-step"> <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">Aplicações</a> </div>
                                  </div>
                                </div>
                            </div>
                            <form role="form" name="empresa" action="<?php echo 'func_registo.php?var=empresa';?>" method="post" enctype="multipart/form-data">
                              <div class="row setup-content" id="step-0">
                                <div class="content_form">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                          <div class="form-group">
                                            <label>Plano Grátis: </label><br>
                                            <div>
                                            	- Dados Pessoais;<br>
                                                - 2 Fotos na Galeria;<br>
                                                - Formulários de contato.
                                            </div>
                                            <input type="radio" name="plano" id="gratis"  />
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                          <div class="form-group">
                                            <label>Plano Premium: </label><br>
                                            <div>
                                            	- Dados Pessoais;<br>
                                                - 10 Fotos na Galeria;<br>
                                                - Google Maps;<br>
                                                - Video Promocional;<br>
                                                - Opçaõ de Comentários;<br>
                                                - Formulários de contatos.
                                            </div>
                                            <input type="radio" name="plano" id="premium" />
                                          </div>
                                    </div>
                                </div>
                                
                                    <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                                </div>
                              </div>
                                                            
                              <div class="row setup-content" id="step-1">
                              <input type="hidden" name="id_user" value="<?php echo $_SESSION['UserID']; ?>">
                              	<div class="content_form">
                                
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Nome da Empresa: </label>
                                            <input class="input_style large" type="text" placeholder="Nome da Empresa" maxlength="100"required="required" name="nome_empresa">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Nome do Responsável: </label>
                                            <input class="input_style large" type="text" placeholder="Nome do Responsável" maxlength="100"required="required" name="nome_responsavel">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Email: </label>
                                            <input class="input_style large" type="text" placeholder="exemplo@email.com" maxlength="100"required="required" name="email">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>NIF: </label>
                                            <input class="input_style large" type="text" placeholder="nº fiscal" maxlength="100"required="required" name="nif">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                          <div class="form-group">
                                            <label>Telefone: </label>
                                            <input class="input_style large" type="text" placeholder="Telefone" maxlength="100" name="telefone">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                        <div class="form-group">
                                                <label>Telemóvel: </label>
                                                <input class="input_style large" type="text" placeholder="Telemóvel" maxlength="100" name="telemovel">
                                              </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                                </div>
                              </div>                              
                              <div class="row setup-content" id="step-2">
                                <div class="content_form">
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Morada: </label>
                                            <input class="input_style large" type="text" placeholder="Morada" maxlength="100"required="required" name="morada">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                          <div class="form-group">
                                            <label>Código Postal: </label>
                                            <input class="input_style large" type="text" placeholder="Código-Postal" maxlength="100"required="required" name="cod_postal">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                          <div class="form-group">
                                            <label>Localidade: </label>
                                            <input class="input_style large" type="text" placeholder="Localidade" maxlength="100"required="required" name="localidade">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Distrito: </label>
                                            <select class="input_style large" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_distrito" required>
                                                <option>Distrito</option>
                                                <?php 
                                                $sql="SELECT id_distrito, distrito FROM distrito";
                                                mysql_query("SET NAMES utf8");
                                                $mysql=mysql_query($sql);
                                                while ($row=mysql_fetch_array($mysql)) {
                                                ?>
                                                <option value="<?php echo $row['id_distrito']; ?>"><?php echo $row['distrito']; ?></option>
                                                <?php }?>
                                            </select>
                                          </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                              	</div>
                              </div>
                              <div class="row setup-content" id="step-3">
                                <div class="content_form">
                                	<div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Ramo de Atividade: </label>
                                            <select name="id_atividade" class="input_style large" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="atividade">
                                            <option>Escolha</option>
											<?php 
                                            $sql="SELECT id_atividade, atividade FROM ramoatividade";
                                            $mysql=mysql_query($sql);
                                            while ($row=mysql_fetch_array($mysql)) {
                                            ?>
                                            <option value="<?php echo $row['id_atividade']; ?>"><?php echo $row['atividade']; ?></option>
                                            <?php }?>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Url: </label>
                                            <input class="input_style large" type="text" placeholder="www.enderecoseusite.com" maxlength="100" name="url">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Facebook: </label>
                                            <input class="input_style large" type="text" placeholder="url do facebook" maxlength="100" name="facebook">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Descrição: </label>
                                            <textarea class="input_style large" name="descricao" placeholder="Escreve-me uma descrição sobre a sua empresa" rows="5"></textarea>
                                          </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                                </div>
                              </div>
                              <div class="row setup-content" id="step-4">
                                <div class="content_form">
                                	<div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Logotipo da empresa: </label>
                                            <input type="file" class="filestyle" name="thumbnail" accept="image/*" data-buttonName="btn-primary">
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                          <div class="form-group">
                                            <label>Horário funcional: </label><br>
                                            <input type="radio" name="temHorario" value="0" checked />
                                            Prefiro não indicar o horário de funcionamento<br>
                                            <input type="radio" name="temHorario" value="1" />
                                             O horário de funcionamento é o seguinte:
                                          </div>
                                    </div>
                                    <div id="novoHorario">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-12">
                                              <table>
                                                  <tr>
                                                    <input class="input_horario" type="checkbox" name="check_to" disabled/>
                                                    Introduzir horário de almoço
                                                  </tr>
                                                  <tr>
                                                    <td>Segunda-Feira</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo1">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Terça-Feira</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo2">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Quarta-Feira</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo3">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Quinta-Feira</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo4">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Sexta-Feira</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo5">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Sábado</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo6">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Domingo</td>
                                                    <td>
                                                    <input type="hidden" name="campo" value="campo7">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00"  selected="selected" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimManha" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" selected="selected"  >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="oculto">
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="inicioTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" selected="selected"  >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                                            <div class="form-group">
                                                              <select class="input_horario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="fimTarde" disabled>
                                                                <option value=""="0:30" >0:30</option>
                                                                <option value="1:00" >1:00</option>
                                                                <option value="1:30" >1:30</option>
                                                                <option value="2:00" >2:00</option>
                                                                <option value="2:30" >2:30</option>
                                                                <option value="3:00" >3:00</option>
                                                                <option value="3:30" >3:30</option>
                                                                <option value="4:00" >4:00</option>
                                                                <option value="4:30" >4:30</option>
                                                                <option value="5:00" >5:00</option>
                                                                <option value="5:30" >5:30</option>
                                                                <option value="6:00" >6:00</option>
                                                                <option value="6:30" >6:30</option>
                                                                <option value="7:00" >7:00</option>
                                                                <option value="7:30" >7:30</option>
                                                                <option value="8:00" >8:00</option>
                                                                <option value="8:30" >8:30</option>
                                                                <option value="9:00" >9:00</option>
                                                                <option value="9:30" >9:30</option>
                                                                <option value="10:00" >10:00</option>
                                                                <option value="10:30" >10:30</option>
                                                                <option value="11:00" >11:00</option>
                                                                <option value="11:30" >11:30</option>
                                                                <option value="12:00" >12:00</option>
                                                                <option value="12:30" >12:30</option>
                                                                <option value="13:00" >13:00</option>
                                                                <option value="13:30" >13:30</option>
                                                                <option value="14:00" >14:00</option>
                                                                <option value="14:30" >14:30</option>
                                                                <option value="15:00" >15:00</option>
                                                                <option value="15:30" >15:30</option>
                                                                <option value="16:00" >16:00</option>
                                                                <option value="16:30" >16:30</option>
                                                                <option value="17:00" >17:00</option>
                                                                <option value="17:30" >17:30</option>
                                                                <option value="18:00" selected="selected" >18:00</option>
                                                                <option value="18:30" >18:30</option>
                                                                <option value="19:00" >19:00</option>
                                                                <option value="19:30" >19:30</option>
                                                                <option value="20:00" >20:00</option>
                                                                <option value="20:30" >20:30</option>
                                                                <option value="21:00" >21:00</option>
                                                                <option value="21:30" >21:30</option>
                                                                <option value="22:00" >22:00</option>
                                                                <option value="22:30" >22:30</option>
                                                                <option value="23:00" >23:00</option>
                                                                <option value="23:30" >23:30</option>
                                                                <option value="24:00" >24:00</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                  <td>
                                                    <input type="checkbox" name="servico" name="1" disabled />
                                                    Serviço 24 Horas?
                                                  </td>
                                                  </tr>
                                              </table>
                                            </div>                      
                                        </div>
                                    </div>
                                     <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                                     <!--<button class="btn btn-success btn-lg pull-right" type="submit" style="margin-right:30px;" name="enviarRegisto">Registar</button>-->
                               </div>
                               </div>
                              
                             <div class="row setup-content" id="step-5">
                                  <div class="content_form">
                                  
                                  
                                  <div class="oculto1" id="oculto1">
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                        <div class="form-group">
                                        <label>Galeria de Fotos: (max 2 fotos)</label><br>
                                        <fieldset style="border:0">
                                            <input type="file" multiple class="multi" accept="gif|jpg|png" name="file[]" maxlength="2"/>
                                        </fieldset>
                                        </div>
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="oculto2" id="oculto2">
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                    <div class="form-group">
                                    <label>Longitude: </label><br>
                                    <input class="input_style large" type="text" placeholder="Longitude" maxlength="100" name="longitude">
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6">
                                    <div class="form-group">
                                    <label>Latitude: </label><br>
                                    <input class="input_style large" type="text" placeholder="Latitude" maxlength="100" name="latitude">
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                        <div class="form-group">
                                        <label>Galeria de Fotos: (max 10 fotos)</label><br>
                                        <fieldset style="border:0">
                                            <input type="file" multiple class="multi" accept="gif|jpg|png" name="file[]" maxlength="10"/>
                                        </fieldset>
                                        </div>
                                    </div>  
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                    <div class="form-group">
                                    <label>Video Promocional: (max MB) </label>
                                    <input type="file" class="filestyle" name="video" accept="video/*" data-buttonName="btn-primary">
                                    </div>
                                    </div>
                                  </div>
                                  
                                  
                                <button class="btn btn-success btn-lg pull-right" type="submit" style="margin-right:30px;" name="enviarRegisto">Registar</button>
                                </div>
                                </div>
                              
                            </form>
                          </div>
                     </div>
                 </div>

            </div>
            
            <div class="tab-pane" id="avaliar">
            <div class="col-xs-12 col-sm-8 col-md-12">
            	<div class="alert alert-info" role="alert"><?php echo 'Deixe aqui o sua opinão sobre o <strong>Mr. Finder</strong>'; ?>
                </div>
                <form action="insertRegistos.php" method="post">
                	<input type="hidden" name="id_user" value="<?php echo $_SESSION['UserID']; ?>">
                	<textarea class="input_style large" name="descricao" placeholder="Escreve-me aqui..." rows="5"></textarea>
                    <button type="submit" class="btn btn-default pull-left" name="enviarTestemunho" style="margin: 10px 10px">Submeter</button>
                </form>
            </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php'); ?>
  <!-- #footer --> 
  
</div>
<!--/#wrapper-->

</body>
</html>

<!-- Script Tab -->
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>
<!--- Validator -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script>
$('#editarForm').bootstrapValidator();
</script>
<!-- multimages -->
<script src='../assets/js/jquery.MultiFile.js' type="text/javascript" language="javascript"></script> 
<!---- OCULTAR HORARIO ALMOCO ----->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!------------>



<script>
// ENABLE FORM
    $('input[name="temHorario"]').on('change', function() {
        var bootstrapValidator = $('#checkoutForm').data('bootstrapValidator'),
            shipnovoHorario     = ($(this).val() == '1');

        shipnovoHorario ? $('#novoHorario').find('.input_horario').removeAttr('disabled')
                       : $('#novoHorario').find('.input_horario').attr('disabled', 'disabled');
					  
        shipnovoHorario ? $('#novoHorario').find('input[type="checkbox"]').removeAttr('disabled')
                       : $('#novoHorario').find('input[type="checkbox"]').attr('disabled', 'disabled');
    });
	
/**** OCULTAR CKECKBOX ******/
$(document).ready(function(){
	$('input[name="check_to"]').click(function(){
		$('div[class="oculto"]').toggle();
	});
});


/**** OCULTAR APLICACOES - RADIO ******/
$(document).ready(function(){
	$('input[id="gratis"]').click(function(){
			$('div[id="oculto1"]').toggle();
		   $("#oculto2").css("display", "none");
	});
});

$(document).ready(function(){
	$('input[id="premium"]').click(function(){
			$('div[id="oculto2"]').toggle();
			$("#oculto1").css("display", "none");
	});
});

</script>

<script>
$(document).ready(function() {
    $('#bootstrapSelectForm')
        .find('[name="colors"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the color when it is changed
                $('#bootstrapSelectForm').formValidation('revalidateField', 'colors');
            })
            .end()
        .find('[name="searchDistrito"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#bootstrapSelectForm').formValidation('revalidateField', 'searchDistrito');
            })
            .end()
        .formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                colors: {
                    validators: {
                        callback: {
                            message: 'Please choose 2-4 colors you like most',
                            callback: function(value, validator, $field) {
                                // Get the selected options
                                var options = validator.getFieldElements('colors').val();
                                return (options != null && options.length >= 2 && options.length <= 4);
                            }
                        }
                    }
                },
                searchDistrito: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your native language.'
                        }
                    }
                }
            }
        });
});
</script>


<?php 
} 
?>
