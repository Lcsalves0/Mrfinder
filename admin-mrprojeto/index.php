<?php
	session_start();
 	include ('../connections/config.php');
	

	
	if(!isset($_SESSION['usernameSession']) AND !isset($_SESSION['passwordSession'])){
		header("Location: ../index.php");
		exit;
	}
	else{
		
		
	$sqlutilizadores="select * from utilizadores where id_user='".$_SESSION['UserID']."'";
	//mysql_query("SET NAMES utf8");
	$resultado = mysql_query($sqlutilizadores) or die(mysql_error());
	$registo = mysql_fetch_array($resultado);
	//$id = $registo['id'];
	$thumbnail = $registo['thumbnail'];

	$sqlEmpresas ="SELECT * FROM empresas WHERE ativo='nao'";
	$resultado_empresa = mysql_query($sqlEmpresas) or die(mysql_error());
	$registos_empresa = mysql_fetch_array($resultado_empresa);
	
	
	
	//mysql_query("SET NAMES utf8");
	
	//$num_rows = mysql_num_rows($registos_empresa);
	$result = mysql_query("SELECT count(*) from empresas WHERE ativo='nao'");
	$ativo=mysql_result($result, 0);
	
	$result_testemunho = mysql_query("SELECT count(*) from testemunhos WHERE ativo='nao'");
	$testemunho= mysql_result($result_testemunho, 0);
	
	$result_mensagens = mysql_query("SELECT count(*) from contatos");
	$mensagens=mysql_result($result_mensagens, 0);

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
<link href="../inc/inline/css/bootstrap-editable.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="../inc/inline/js/bootstrap-editable.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</head>

<body>
<header class="shows">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-xs-5 col-sm-4 header-logo"> <br>
        <a href="index.php">
        <h1 class="logo">Mr. <span class="logo-head">Find</span>/Admin</h1>
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
                <li> <a href="index.php"><i class="fa fa-home"></i> Home</a> </li>
                <li> <a class="btn btn-info" href="#"><?php echo '<img src="../autenticacao/'.$thumbnail.'" class="img_perfil"/>';?></a>
                  <ul style="padding:0;">
                    <!--<a href="../inc/editarperfil.php?id=<?php echo $_SESSION['UserID']; ?>">
                    <li><i class="glyphicon glyphicon-edit"></i>Perfil</li>
                    </a>--> 
                    <!--<a href="#"><li><i class="glyphicon glyphicon-heart-empty"></i>Favoritos</li></a>--> 
                    <!--<div class="border_drop"></div>--> 
                    <a href="../inc/logout.php">
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
<div id="wrapper">
  <?php include ('../inc/functions.php');?>
  <div class="margem"></div>
  <!-- margem -->
  
  <div class="container">
  
  <div class="row">
      <div class="col-xs-6 col-md-3">
        <div class="panel panel-default"> 
          <!-- Default panel contents -->
           <div class="panel-heading">Paginas</div>
         <ul class="list-group">
          <li class="list-group-item"><a href="index_edit.php">Editar Página Inicial</a></li>
               </ul>
          <div class="panel-heading">Empresas</div>
          <ul class="list-group">
                <a href="./?pagina=novasEmpresas">
                <li class="list-group-item">Novas Empresas <span class="badge" style="background-color:#FF0004"><?php echo $ativo; ?></span></li>
                </a> <a href="./?pagina=ramoAtividade">
                <li class="list-group-item">Listar Empresas</li>
                </a>
              </ul>
        
          <div class="panel-heading">Utilizadores</div>
         <ul class="list-group">
                  <a href=".?pagina=editarUtilizadores">
                  <li class="list-group-item">Editar Utilizadores</li>
                  </a>
                </ul>
                
                <div class="panel-heading">Testemunhos</div>
         <ul class="list-group">
                  <a href=".?pagina=novosTestemunhos">
                  <li class="list-group-item">Novos Testemunhos<span class="badge" style="background-color:#FF0004"><?php echo $testemunho; ?></span></li>
                  </a>
                </ul>
                
                <?php /*?><!-- <div class="panel-heading">Mensagens</div>
        <ul class="list-group">
                  <a href="#">
                  <li class="list-group-item">Listagem <span class="badge" style="background-color:#FF0004"><?php echo $mensagens; ?></span></li>
                  </a>
                </ul>--><?php */?>
         
        </div>
        
        <div class="panel panel-default"> 
          <!-- Default panel contents --> 
          
        </div>
      </div>
      
      
      
        <!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">-->
            <?php /*?><!--<div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Empresas </a> 
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Empresas </a> </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <ul class="list-group">
                <a href="./?pagina=novasEmpresas">
                <li class="list-group-item">Novas Empresas <span class="badge" style="background-color:#FF0004"><?php echo $ativo; ?></span></li>
                </a> <a href="./?pagina=ramoAtividade">
                <li class="list-group-item">Listar Empresas</li>
                </a>
              </ul>
            </div>
          </div>--><?php */?>
          <!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Utilizadores </a> </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <ul class="list-group">
                  <a href=".?pagina=editarUtilizadores">
                  <li class="list-group-item">Editar Utilizadores</li>
                  </a>
                </ul>
              </div>
            </div>
          </div>-->
          <!--<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"> Testemunhos </a> </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <ul class="list-group">
                  <a href=".?pagina=novosTestemunhos">
                  <li class="list-group-item">Novos Testemunhos<span class="badge" style="background-color:#FF0004"><?php /*?><?php echo $testemunho; ?><?php */?></span></li>
                  </a>
                </ul>
              </div>
            </div>-->
         
          
          
          
          
            <!--<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseThree"> Index </a> </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <ul class="list-group">
                  <a href="index_edit.php">
                  <li class="list-group-item">Editar Página Principal</li>
                  </a>
                </ul>
              </div>
            </div>-->
          
          
          
          
         
            <!--<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> Mensagens </a> </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                <ul class="list-group">
                  <a href="#">
                  <li class="list-group-item">Listagem <span class="badge" style="background-color:#FF0004"><?php /*?><?php echo $mensagens; ?><?php */?></span></li>
                  </a>
                </ul>
              </div>
            </div>-->
         
          <!--<div class="panel-heading">Paginas</div>
         <ul class="list-group">
          <li class="list-group-item"><a href="index_edit.php">Editar Página Inicial</a><span class="badge">1</span></li>
               </ul>
          <div class="panel-heading">Empresas</div>
          <ul class="list-group">
          <li class="list-group-item"><a href="./?pagina=novasEmpresas">Novas Empresas</a><span class="badge">14</span></li>
          <li class="list-group-item"><a href="./?pagina=editarEmpresas">Editar Empresas</a><span class="badge">14</span></li>
            <li class="list-group-item"><a href="#">Total Empresas</a><span class="badge">14</span></li>
          </ul>
         <div class="panel-heading">Utilizadores</div>
         <ul class="list-group">
          <li class="list-group-item"><a href="#">Novos Utilizadores</a><span class="badge">14</span></li>
          <li class="list-group-item"><a href="#">Editar Utilizadores</a><span class="badge">14</span></li>
            <li class="list-group-item"><a href="#">Total Utilizadores</a><span class="badge">14</span></li>
          </ul>
         
        </div>--> 
          <!-- <div class="panel panel-default"> 
           Default panel contents
          </div> --> 
        <!--</div>
      </div>-->
      
      
      <div class="col-xs-12 col-sm-6 col-md-8">
        <div class="title"><span>Bem Vindo ao Administrador</span></div>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php">Admin</a></li>
        </ol>
        <?php 
			
				switch(@$_GET['pagina']){
				
				case 'editarUtilizadores':
					include('utilizadores/novosUtilizadores.php');
					break;
				case 'novasEmpresas':
					include('empresas/novasEmpresas/table_novasEmpresas.php');
					break;
				case 'novosTestemunhos':
					include('testemunhos/novosTestemunhos.php');
					break;
				case 'ramoAtividade':
					include('empresas/listarEmpresas/ramo_atividade.php');
					break;
					
				case 'listarEmpresas?id_atividade=1':
					include('empresas/listarEmpresas/listar_empresas.php');
					break;
				default:
				include('../inc/table_novasEmpresas.php');
				}
				//echo 'empresas/listarEmpresas/listar_empresas.php?id_atividade='.$registos_ListaEmpresa['id_atividade'].'';
			//echo $_GET['id_atividade'];
        ?>
      </div>
      <!--/#col--> 
    </div>
  </div>
  <?php include ('../inc/footer.php') ?>
  <!-- #footer --> 
  
</div>
<!--/#wrapper-->

</body>
</html>
<?php } ?>