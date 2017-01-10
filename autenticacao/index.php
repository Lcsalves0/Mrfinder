<?php
 include ('../connections/config.php');

	session_start();
	
	if(!isset($_SESSION['usernameSession']) AND !isset($_SESSION['passwordSession'])){
		header("Location: ../index.php");
		exit;
	}
	$id = $_GET['id_user'];

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

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.js"></script>
		<![endif]-->

<!--[if IE 8]>
	    	<script src="assets/js/selectivizr.js"></script>
	    <![endif]-->

</head>

<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content">
          <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
            <li><a href="#registo" data-toggle="tab">Registo</a></li>
            <li><a href="#reset" data-toggle="tab">Esqueceste-te da palavra-passe?</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="login">
              <h2 class="content_h2">Iniciar Sessão no Mr. Finder</h2>
              <p>Já possui conta?</p>
              <form id="loginForm" method="post" action="autenticacao/validacao.php"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="form-group">
                    <input type="text" class="input_style large" name="username" placeholder="Username" required data-bv-notempty-message="Username obrigatório!" />
                </div>
                <div class="form-group">
	                <input type="password" class="input_style large" name="password" placeholder="Password"
                       required data-bv-notempty-message="The password is required and cannot be empty"/>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default pull-left" name="enviar">Entrar</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="registo">
              <h2 class="content_h2">Deseja registar-se no Mr. Finder?</h2>
              <form id="registerForm" method="post" action="autenticacao/insertRegistos.php" enctype="multipart/form-data"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="form-group">
                    <input type="text" class="input_style large" name="username" placeholder="Username" required data-bv-notempty-message="Username obrigatório!" />
                </div>
                <div class="form-group">
                	<input class="input_style large" name="email" type="email" placeholder="Insira o seu email" required data-bv-notempty-message="Email obrigatorio!" />
                </div>
                <div class="form-group">
	                <input type="password" class="input_style large" name="password" placeholder="Password"
                       required data-bv-notempty-message="Password obrigatória!"
                       data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="Confirme Password!"/>
                </div>

                <div class="form-group">
                    <input type="password" class="input_style large" name="confirmPassword" placeholder="Confirme Password"
                           required data-bv-notempty-message="Password obrigatória!"
                           data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="Password diferentes!"/>
                </div>
                <div class="form-group">
	                <input type="file" class="filestyle" data-input="false" id="arquivo" name="arquivo" accept="image/*">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default pull-left" name="enviar">Registar</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="reset">
              <h2 class="content_h2">Esqueces-te da palavra-passe?</h2>
              <p>Vamos-te enviar um mail para a recuperação</p>
              <form id="forgotForm" method="post" action="autenticacao/insertRegistos.php"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="form-group">
                    <input class="input_style large" name="email" type="email" placeholder="Insira o seu email" required data-bv-notempty-message="Email obrigatorio!" />
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default pull-left" name="enviar">Enviar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content">
          <div id="my-tab-content" class="tab-content">
          	<h2 class="content_h2">Registe a sua empresa no Mr. Finder</h2>
            <p>* campos obrigatórios</p>
            <div class="stepwizard ">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">Dados</a>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">Localização</a>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">qwerty</a>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">Aplicações</a>
                  </div>
                  
                </div>
                </div>
            <form role="form" action="insertRegistos.php" method="post">
            <div class="row setup-content" id="step-1">
                <div class="content_form">
                  <div class="form-group">
                    <input class="input_style large" type="text" placeholder="Nome da Empresa" maxlength="100"required="required" name="nome_empresa">
                  </div>
                  <div class="form-group">
                    <input class="input_style large" type="text" placeholder="Nome do Responsável" maxlength="100"required="required" name="nome_responsavel">
                  </div>
                  <div class="form-group">
                    <input class="input_style large" type="text" placeholder="exemplo@email.com" maxlength="100"required="required" name="email">
                  </div>
                  <div class="form-group">
                    <input class="input_style equal" type="text" placeholder="Telefone" maxlength="100"required="required" name="telefone">
                    <input class="input_style equal" type="text" placeholder="Telemóvel" maxlength="100"required="required" name="telemovel">
                  </div>
                  <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                </div>
             </div>
            <div class="row setup-content" id="step-2">
                <div class="content_form">
                  <div class="form-group">
                    <input class="input_style medium" type="text" placeholder="Localidade" maxlength="100"required="required" name="localidade">
                    <input class="input_style small" type="text" placeholder="Código-Postal" maxlength="100"required="required" name="cod_postal">
                  </div>
                  <div class="form-group">
                    <input class="input_style equal" type="text" placeholder="Distrito" maxlength="100"required="required" name="distrito">
                    <input class="input_style equal" type="text" placeholder="País" maxlength="100"required="required" name="pais">
                  </div>
                  <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                </div>
             </div>
            <div class="row setup-content" id="step-3">
                <div class="content_form">
                  <div class="form-group">
                    <select class="input_style large" required name="atividade[]">
                    <?php 
                        $sql="SELECT id_atividade, atividade FROM categorias";
                        $mysql=mysqli_query($conn, $sql);
                        while ($row=mysqli_fetch_array($mysql)) {
                    ?>
                        <option value="<?php echo $row['id_atividade']; ?>"><?php echo $row['atividade']; ?></option>
                    <?php }?>
                    </select>	
                  </div>
                  <div class="form-group">
                    <input class="input_style large" type="text" placeholder="www.enderecoseusite.com" maxlength="100" name="url">
                  </div>
                  <div class="form-group">
                    <textarea class="input_style large" name="descricao" placeholder="Escreve-me uma descrição sobre a sua empresa"></textarea>
                  </div>
                  <button class="btn btn-primary nextBtn btn-lg pull-left" style="margin-left:10px;" type="button" >Next</button>
                </div>
             </div>
            <div class="row setup-content" id="step-4">
                <div class="content_form">
                  <div class="form-group">
                    <input class="input_style equal" type="text" placeholder="Longitude" maxlength="100" name="longitude">                        <input class="input_style equal" type="text" placeholder="Latitude" maxlength="100" name="latitude">
                  </div>
                  <div class="form-group">
                    <input class="input_style large" name="logo" type="file" required>
                  </div>
                  <div class="form-group">
                    <input class="input_style large" type="file">
                  </div>
                  <div class="form-group">
                    <input class="input_style large" type="file">
                  </div>
                  <button class="btn btn-success btn-lg pull-right" type="submit" style="margin-right:30px;">Submit</button>
                </div>
             </div>	
            
            </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- /.modal2 -->
<?php 
	$sql="select * from utilizadores where id_user='".$_SESSION['UserID']."'";
	mysqli_query("SET NAMES utf8");
	$resultado = mysqli_query($conn, $sql);
	$registo = mysqli_fetch_array($resultado);
	$thumbnail = $registo['thumbnail'];
?>

 
<header class="top-header">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-xs-5 col-sm-4 header-logo"> <br>
        <a href="index.php">
        <!-- <img src="assets/images/logo.png">-->
        <h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>
        </a> </div>
      <div class="col-md-8 col-md-offset-1 col-xs-7">
        <nav class="navbar navbar-default">
          <div class="container-fluid nav-bar"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-def" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li> <a href="#wrapper"><i class="fa fa-home"></i> Home</a> </li>
                <li> <a href="#categorias"><i class="glyphicon glyphicon-th"></i> Categorias</a> </li>
                <li> <a href="#sobre"><i class="glyphicon glyphicon-info-sign"></i> Fatos</a> </li>
                <li> <a href="#services"><i class="glyphicon glyphicon-map-marker"></i> Serviços</a> </li>
                <li> <a href="#tutorial"><i class="glyphicon glyphicon-map-marker"></i> Tutorial</a> </li>
                <li> <a href="#testemunhos"><i class="glyphicon glyphicon-map-marker"></i>Testemunhos</a> </li>
                <li> <a class="btn btn-info" href="#"><?php echo '<img src="../autenticacao/'.$thumbnail.'" class="img_perfil"/>';?></a>
                    <ul style="padding:0;">
                        <a href="../inc/editarperfil.php?id=<?php echo $id; ?>"><li><i class="glyphicon glyphicon-edit"></i>Perfil</li></a>
                        <!--<a href="#"><li><i class="glyphicon glyphicon-heart-empty"></i>Favoritos</li></a>-->
                        <div class="border_drop"></div>
                        <a href="../inc/logout.php"><li><i class="glyphicon glyphicon-off"></i>Logout</li></a>
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

<!-- WRAPPER -->
<div id="wrapper">
  <div id="header" class="content-block">
    <section class="center">
      <div class="slogan"> Simples &amp; Consistente </div>
      <div class="secondary-slogan"> Se tu procuras, eu encontro </div>
      <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="content_search">
          <form action="search.php" class="formoid-solid-green" style="font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px;  " method="post">
            <input class="medium" type="text" name="search" placeholder="pesquisa..."/>
            <!--<input type="text" style="border:1px solid #FF0004" class="input_style equal" value="Pesquise empresa..." onblur="if(this.value == '') { this.value='Pesquise empresa...'}" onfocus="if (this.value == 'Pesquise empresa...') {this.value=''}" name="search">-->
            <select class="small " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="">
              <option>Localidade</option>
              <?php 
               $sql="SELECT id_distrito, distrito FROM distrito";
                    $mysql=mysqli_query($conn, $sql);
                    while ($row=mysqli_fetch_array($mysql)) {
                ?>
              <option value="<?php echo $row['id_distrito']; ?>"><?php echo $row['distrito']; ?></option>
              <?php }?>
            </select>
            <button type="button" class="btn-search" aria-label="Left Align"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
          </form>          
          <!-- /col-xs-6 col-md-4 --> 
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <li> <a data-toggle="modal" class="btn btn-info" href="#" data-target="#myModal2"><i class="glyphicon glyphicon-plus-sign"></i></a></li>
        </div>
      </div>
    </section>
  </div>
  <!-- header -->

  <div class="content-block" id="categorias">
    <div class="container portfolio-sec">
      <header class="block-heading cleafix">
        <div class="title-page">
          <p class="main-header">Categorias </p>
          <p class="sub-header">Escolha uma das principais categorias e comece a procurar</p>
        </div>
      </header>
      <section class="block-body">
        <div class="row" >
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/hotel-320x240.jpg)"> <span class="btn btn-o-white">Hotéis</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/education-320x240.jpg)"> <span class="btn btn-o-white">Educação</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/doctor-320x240.jpg)"> <span class="btn btn-o-white">Saúde</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/technology-320x240.jpg)"> <span class="btn btn-o-white">Técnologia</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/recreation-320x240.jpg)"> <span class="btn btn-o-white">Lazer</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/sport-320x240.jpg)"> <span class="btn btn-o-white">Desporto</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/restaurant-320x240.jpg)"> <span class="btn btn-o-white">Restauração</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/category_images/construction-320x240.jpg)"> <span class="btn btn-o-white">Construção</span> </a> </div>
        </div>
        <div id="collapse" class="panel-collapse collapse">
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/flat_icons_thumb.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/wood-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/bike-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/wood-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/bike-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/bike-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/wood-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
          <div class="col-sm-3"> <a href="#" class="recent-work" style="background-image:url(assets/images/bike-320x240.jpg)"> <span class="btn btn-o-white">Lorem Rocks</span> </a> </div>
        </div>
        <a href="#collapse" class="btn btn-o btn-lg pull-right" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">View All</a> </section>
    </div>
  </div>
  <!-- #categorias --> 

  <div class="content-block Sobre" id="sobre">
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-plane"></i>
            <h4 class="aboutus-title"> <span class="counter"><?php echo $results; ?></span>
              <p class="aboutus-desc">Empresas</p>
            </h4>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-usd"></i>
            <h4 class="aboutus-title"> <span class="counter">8000</span>
              <p class="aboutus-desc">Empresas</p>
            </h4>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-cutlery"></i>
            <h4 class="aboutus-title"> <span class="counter">5000</span>
              <p class="aboutus-desc">Empresas</p>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /sobre -->
  
  <div class="content-block parallax" id="services">
    <div class="container services-sec">
      <div class="title-page">
        <p class="main-header">Serviços </p>
        <p class="sub-header">Conheça alguns dos serviços que ofereço</p>
      </div>
      <section class="block-body">
        <div class="row">
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i> --> 
              <img  src="assets/images/service_images/first_icon.png" alt="..." class="img-circle">
              <p class="service-head">Mr. Finder tem
                ao dispor uma ferramenta de personlização que permite a qualquer utilizador registado, personlizar a sua página empresarial e pessoal.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i>--> 
              <img src="assets/images/service_images/second_icon.png" alt="..." class="img-circle" >
              <p class="service-head">Mr. Finder tem
                ao dispor uma galeria de fotos e/ou imagens que poderam ser submetidas a qualquer altura e sem qualquer limite.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"><!-- <i Align="center" class="fa fa-send-o"></i>--> 
              <img src="assets/images/service_images/third_icon.png" alt="..." class="img-circle" >
              <p class="service-head">Mr. Finder tem ao dispor uma ferramenta de personlização que permite a qualquer utilizador registado, personlizar a sua página empresarial e pessoal.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- #services -->
  
  <div class="content-block tutorial" id="tutorial">
    <div class="container">
      <div class="title-page">
        <p class="main-header">Tutorial </p>
        <p class="sub-header">Sabia como registar uma empresa</p>
      </div>
      <div class="row">
        <div class="row_tutorial">
          <div class="col-lg-4" align="center"> <img src="assets/images/01.PNG"/>
            <h2>Registo</h2>
            <p>- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div>
          <!-- /.col-lg-4 -->
          
          <div class="col-lg-4" align="center"> <img src="assets/images/02.PNG"/>
            <h2>Empresa</h2>
            <p>- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</p>
          </div>
          <!-- /.col-lg-4 -->
          
          <div class="col-lg-4" align="center"> <img src="assets/images/03.PNG"/>
            <h2>Finalização</h2>
            <p>- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</p>
          </div>
          <!-- /.col-lg-4 --> 
        </div>
        <!-- /.row --> 
      </div>
      
      <!--
      <div class="row">
        <div class="col-md-4"> <img src="assets/images/01.PNG"/> </div>
          <div class="col-md-8">
            <h4 class="aboutus-desc">- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row_tutorial">
          <div class="col-md-4"> <img src="assets/images/02.PNG"/> </div>
          <div class="col-md-8">
            <h4 class="aboutus-desc">- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row_tutorial">
          <div class="col-md-4"> <img src="assets/images/03.PNG"/> </div>
          <div class="col-md-8">
            <h4 class="aboutus-desc">- Para registar uma empresa o primeiro passo é efetuar o registo através do seu e-mail ou através da sua conta Facebook ou Google +.</h4>
          </div>
        </div>
      </div>--> 
    </div>
  </div>
  <!-- /tutorial -->
  
  <div class="content-block" id="testemunhos">
    <div class="container testimonial-sec">
      <header class="block-heading cleafix">
        <div class="title-page  pull-left">
          <p class="main-header">Testemunhos</p>
          <p class="sub-header">A opinião dos nossos utilizadores</p>
        </div>
      </header>
      <section class="block-body">
        <div class="row">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <div class="col-md-4"> <img class="img-circle circular-img" src="assets/images/01_200x200.png"> </div>
                <div class="col-md-8">
                  <blockquote class="text-left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                  </blockquote>
                </div>
              </div>
              <div class="item">
                <div class="col-md-4"> <img class="img-circle circular-img" src="assets/images/02_200x200.png"> </div>
                <div class="col-md-8">
                  <blockquote class="text-left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                  </blockquote>
                </div>
              </div>
              <div class="item">
                <div class="col-md-4"> <img class="img-circle circular-img" src="assets/images/03_200x200.png"> </div>
                <div class="col-md-8">
                  <blockquote class="text-left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /#testimonials -->
  
  <div class="content-block" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Mr. Finder</h2>
          <p>Mister Finder é um especialista em procura de instituições que faz crescer o seu negócio no mundo online.</p>
          <p>A sua missão é facilitar o processo de comunicação entre cliente e entidade, dispondo de várias opções, que podem oscilar entre a presença online simples à gestão total dos dados da sua empresa. </p>
        </div>
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Conta-me segredos...</h2>
          <form id="contactForm" method="post" 
            data-bv-message="This value is not valid"
            data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
            data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
            data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            <div class="form-group">
              <input type="text" class="input_style full" name="username" placeholder="Username" required data-bv-notempty-message="Username obrigatório!" style="margin-left:0;"/>
            </div>
            <div class="form-group">
              <input type="email" class="input_style full" name="email" placeholder="Diz-me o teu email" required data-bv-notempty-message="Email obrigatório!" style="margin-left:0;">
            </div>
            <div class="form-group">
              <textarea class="input_style full" placeholder="Escreve-me o que entenderes..." name="bio" rows="5" data-bv-stringlength data-bv-stringlength-max="200" data-bv-stringlength-message="Mensagem não pode ultrapassar 200 carateres!" style="margin-left:0px;"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="text-center btn btn-o-white" >Enviar</button>
            </div>
          </form>
        </div>
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Contactos</h2>
          <ul>
            <li class="address-sub"><i class="fa fa-map-marker"></i>Endereço do Escritório:</li>
            <p> Em todo o lado... </p>
            <li class="address-sub"><i class="fa fa-phone"></i>Phone</li>
            <p> Local: 1-800-123-hello<br>
              Mobile: 1-800-123-hello </p>
            <li class="address-sub"><i class="fa fa-envelope-o"></i>Endereço de Email</li>
            <p> <a href="mailto:mrfinder@hotmail.com">mrfinder@hotmail.com</a><br>
              <a href="www.mrfinder.pt">www.mrfinder.pt</a> </p>
          </ul>
          <div class="social"> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-instagram"></i></a> <a href="#"><i class="fa fa-pinterest-p"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-skype"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-block footer-bottom" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-5">&copy; Copyright 2015</div>
      </div>
    </div>
  </div>
  <!-- #footer --> 
  
</div>
<!--/#wrapper-->

<!-- Script Tab --> 
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>
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
		  curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
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
<!---------->


<script type="text/javascript" src="../assets/js/jquery-migrate-1.2.1.min.js"></script> 
<!--<script type="text/javascript" src="assets/js/bootstrap.js"></script><!--******---> 
<script type="text/javascript" src="../assets/js/jquery.actual.min.js"></script> 
<script type="text/javascript" src="../assets/js/jquery.scrollTo.min.js"></script> 
<script type="text/javascript" src="../assets/js/script.js"></script> 
<script type="text/javascript" src="../assets/js/smoothscroll.js"></script> 
<script type="text/javascript" src="../assets/js/jquery.counterup.min.js"></script> 
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 


<!--- Validator -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script>
$('#loginForm').bootstrapValidator();
$('#registerForm').bootstrapValidator();
$('#forgotForm').bootstrapValidator();
$('#addEmpresaForm').bootstrapValidator();
$('#contactForm').bootstrapValidator();
</script>
<!------------>


<!-- Velocidade counter --> 
<script>
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
			
            delay: 10,
            time: 10000
			
        });
    });
</script> 
<!--------> 

<!-- pop up --> 
<script type="text/javascript">
	jQuery(document).ready(function($){

		$(window).scroll(function() {
			
			console.log("asdf");

			if ($(window).scrollTop() > 100 ){
		
			$('.top-header').addClass('shows');
		
			} else {
		
			$('.top-header').removeClass('shows');
		
			};   	
		});

	  });

	jQuery('.scroll').on('click', function(e){		
			e.preventDefault()
		
	  jQuery('html, body').animate({
		  scrollTop : jQuery(this.hash).offset().top
		}, 1500);
	});
</script> 
<!-----------> 


</body>
</html>