<?php 
include ('../connections/config.php');

session_start();

if(!isset($_SESSION['usernameSession']) AND !isset($_SESSION['passwordSession'])){
	header("Location: ../index.php");
	exit;
} else {

$sql="select * from utilizadores where id_user='".$_SESSION['UserID']."'";
mysql_query("SET NAMES utf8");
$resultado = mysqli_query($conn, $sql) or die (mysql_error());
$registo = mysqli_fetch_array($resultado);

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

<!-- meta -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no"/>

<!-- google fonts -->
<link href='http://fonts.googleapis.com/css?family=Raleway:500,300' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold"/>

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<!-- Script para editar o .select-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />


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
              <form id="registerForm" method="post" action="<?php echo 'inc/func_registo.php?var=user';?>" enctype="multipart/form-data"
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
                  <input type="file" class="filestyle" data-input="false" name="thumbnail" accept="image/*">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default pull-left" name="enviar">Registar</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="reset">
              <h2 class="content_h2">Esqueces-te da palavra-passe?</h2>
              <p>Vamos-te enviar um mail para a recuperação</p>
              <form id="forgotForm" method="post" action="autenticacao/func_registo_user.php"
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

<header class="shows">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-xs-8 col-sm-4 header-logo"> <br>
        <a href="<?php echo "../inc/editarperfil.php?id=".$_SESSION['UserID']." ";?>">
        <h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>
        </a> </div>
      <div class="col-md-6 col-xs-8">
        <form action="search.php?var=search" class="formoid-solid-green" style="font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px; " method="POST">
            <input class="medium" type="text" name="searchText" placeholder="pesquisa..."/>
            <select class="small " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="searchDistrito">
              <option>Distrito</option>
              <?php 
               		$sql="SELECT id_distrito, distrito FROM distrito";
					mysqli_query("SET NAMES utf8");
                    $mysql=mysqli_query($conn, $sql);
                    while ($row=mysqli_fetch_array($mysql)) {
                ?>
              <option value="<?php echo $row['id_distrito']; ?>"><?php echo $row['distrito']; ?></option>
              <?php }?>
            </select>
            <button type="submit" name="submitSearch" class="btn-search" aria-label="Left Align"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
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

<?php 
	include ('../inc/functions.php');
    // Recuperamos a ação enviada pelo formulário
    $var = @$_GET['var'];
    $id_distrito = @$_GET['id_distrito'];
	$id_atividade = @$_GET['id_atividade'];

    // Verificamos se a ação é de procura
    if ($var == "search") {
        
        // Pegamos a palavra
        $searchText = trim($_POST['searchText']);
		$searchDistrito = $_POST['searchDistrito'];
        
        // Verificamos na base de dados produtos equivalentes a palavra digitada
       if($searchText != '' && $searchDistrito != 0){
		 $sqlText = mysql_query("SELECT * FROM empresas WHERE id_distrito=$searchDistrito AND nome_empresa LIKE '%".$searchText."%' " );
		$numRegistros = mysql_num_rows($sqlText);  
		}
	   else if($searchText != ''){
	    $sqlText = mysql_query("SELECT * FROM empresas WHERE nome_empresa LIKE '%".$searchText."%' ORDER BY id_empresa" );
		$numRegistros = mysql_num_rows($sqlText);
	   }
	   else if($searchDistrito != 0){
		 $sqlText = mysqli_query("SELECT * FROM empresas WHERE id_distrito=$searchDistrito ORDER BY id_empresa" );
		$numRegistros = mysqli_num_rows($sqlText);  
	   }
		 
		 
	  
		

        //echo "SELECT empresas.*, distrito.distrito FROM empresas INNER JOIN distrito ON empresas.id_distrito = distrito.id_distrito WHERE nome_empresa LIKE '%".$searchText."%' OR nome_responsavel LIKE '%".$searchText."%' OR id_distrito = ".$searchDistrito." ORDER BY id_empresa";
        
        
        // Descobrimos o total de registros encontrados
        
        //$RegistrosText = mysql_fetch_array($sqlText);
    ?>
<div id="wrapper">

    <div class="margem"></div>
    <!-- margem -->
 
    <div class="container">
    <div class="row">
    
    
      <div class="col-xs-6 col-md-3">
        <div class="panel panel-default"> 
          <!-- Default panel contents -->
          <div class="panel-heading">Filtrar</div>
          <ul class="list-group">
            <li class="list-group-item">Classificação</li>
          </ul>
          <div class="panel-body">
            <p><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></p>
          </div>
          <!-- List group -->
          <ul class="list-group">
            <li class="list-group-item">Distrito</li>
          </ul>
          
          <div class="panel-body">
            <?php  
            if($searchText != '' && $searchDistrito != 0){
			 $sql2 = "SELECT distrito.id_distrito, distrito.distrito, COUNT(empresas.id_empresa) AS NumberOfEmpresas FROM empresas LEFT JOIN distrito ON empresas.id_distrito = distrito.id_distrito WHERE nome_empresa like '%".$searchText."%' AND empresas.id_distrito=$searchDistrito GROUP BY distrito ";
			$result2 = mysqli_query ($conn, $sql2);
			$num_row = mysqli_num_rows($result2) or die (mysql_error());
			}
		   else if($searchText != ''){
			$sql2 = "SELECT distrito.id_distrito, distrito.distrito, COUNT(empresas.id_empresa) AS NumberOfEmpresas FROM empresas LEFT JOIN distrito ON empresas.id_distrito = distrito.id_distrito WHERE nome_empresa like '%".$searchText."%' GROUP BY distrito ";
			$result2 = mysqli_query ($conn, $sql2);
			$num_row = mysqli_num_rows($result2) or die (mysql_error());
		   }else if($searchDistrito != 0){
			 $sql2 = "SELECT distrito.id_distrito, distrito.distrito, COUNT(empresas.id_empresa) AS NumberOfEmpresas FROM empresas LEFT JOIN distrito ON empresas.id_distrito = distrito.id_distrito GROUP BY distrito ";
			$result2 = mysqli_query ($conn, $sql2);
			$num_row = mysqli_num_rows($result2) or die (mysql_error());
		   }
                
                
                if(@$num_row != 0){
                while ($row2 = mysqli_fetch_array($result2))
                    
                    echo '<p><a href="search.php?id_distrito='.$row2[0].'">'.$row2[1].' ('.$row2[2].')</a></p>';
                }
				else
                    echo "Nenhuma empresa foi encontrado";
            ?>
          </div>
        </div>
        
      </div>
     
      <div id="container" class="col-xs-12 col-sm-12 col-md-9">
        <div class="title"><span><?php if(@$numRegistros == 0)echo '0'; else echo $numRegistros; ?> Registos encontrados</span><?php echo " - <b>$searchText</b>"; ?></div>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
        </ol>
        <?php  
        // Se houver pelo menos um registro, exibe-o
        if (@$numRegistros != 0) {
            $sqlIdDistrito = mysql_query("SELECT * FROM empresas WHERE id_distrito = ".$row2[0]." ");
            
            // Exibe os produtos e seus respectivos preços
            
            while ($results = mysql_fetch_array($sqlText)) {
                $sql3 = "SELECT distrito FROM distrito WHERE id_distrito = ".$results['id_distrito']." ";
                $result3 = mysqli_query ($conn, $sql3);
                $row = mysql_fetch_array ($result3) or die (mysql_error());
        ?>
            <div class="content_search" style="border-bottom:1px solid #E0E0E0;">
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail"> <img src="<?php echo 'empresas/'.$results['logo']; ?>" alt="..."> </div>
              </div>
              <div class="col-sm-8 col-md-8">
                <div class="content_info">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="content_title"><a href="detalhe.php?id=<?php echo $results['id_empresa'] ?>"><?php echo $results['nome_empresa']; ?></a></div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12" >
                      <?php if($results['descricao']!='') ?>
                            <div class="content_description"><?php echo $results['descricao']; ?></div>
                            <div class="content_icons">
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-home" aria-hidden="true" style="padding:5px;"></span><?php echo $results['morada']; ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-flag" aria-hidden="true" style="padding:5px;"></span><?php echo $results['localidade']; ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-flag" aria-hidden="true" style="padding:5px;"></span><?php echo $row['distrito']; ?></p>
                                </div>
                                <?php if($results['telefone']!=0){ ?>
                                    <div class="col-xs-12 col-sm-12 col-md-4" >
                                    <p><span class="glyphicon glyphicon-phone-alt" aria-hidden="true" style="padding:5px;"></span><?php echo $results['telefone']; ?></p>
                                    </div>
                                <?php }?>
                                <?php if($results['telemovel']!=0){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-phone" aria-hidden="true" style="padding:5px;"></span><?php echo $results['telemovel']; ?></p>
                                </div>
                                <?php } ?>
                                <?php if($results['email']!=''){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-envelope" aria-hidden="true" style="padding:5px;"></span><?php echo $results['email']; ?></p>
                                </div>
                                <?php } ?>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
                
            <?php 
    
            // Se não houver registros
            }
        }
        else{?>
			<div class="alert alert-info" role="alert"><?php echo 'Nenhuma empresa foi encontrado<strong>'.$searchText.'</strong>'; ?></div>
        <?php }?>
     </div>
	</div>
    </div>
	<!--/#container--> 

<?php include ('../inc/footer.php'); ?>
<!-- #footer --> 
  
</div>
<!--/#wrapper-->
<?php
}
	
	else if ($id_distrito == $id_distrito) {
	   if($id_distrito != 0){
		 $sqlText = mysql_query("SELECT * FROM empresas WHERE id_distrito=$id_distrito ORDER BY id_empresa" );
		$numRegistros = mysql_num_rows($sqlText);  
	   }
		 
    ?>
<div id="wrapper">

    <div class="margem"></div>
    <!-- margem -->
 
    <div class="container">
    <div class="row">
    
    
      <div class="col-xs-6 col-md-3">
        <div class="panel panel-default"> 
          <!-- Default panel contents -->
          <div class="panel-heading">Filtrar</div>
          <ul class="list-group">
            <li class="list-group-item">Classificação</li>
          </ul>
          <div class="panel-body">
            <p><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></p>
          </div>
          <!-- List group -->
          <ul class="list-group">
            <li class="list-group-item">Distrito</li>
          </ul>
          
          <div class="panel-body">
            <?php  
			if($id_distrito != 0){
			 $sql2 = "SELECT distrito.id_distrito, distrito.distrito, COUNT(empresas.id_empresa) AS NumberOfEmpresas FROM empresas LEFT JOIN distrito ON empresas.id_distrito = distrito.id_distrito GROUP BY distrito ";
			$result2 = mysqli_query ($conn, $sql2);
			$num_row = mysql_num_rows($result2) or die (mysql_error());
		   }
                
                if(@$num_row != 0){
                while ($row2 = mysql_fetch_array($result2))
                    
                    echo '<p><a href="search.php?id_distrito='.$row2[0].'">'.$row2[1].' ('.$row2[2].')</a></p>';
                }
				else
                    echo "Nenhuma empresa foi encontrado";
            ?>
          </div>
        </div>
        
      </div>
     
      <div id="container" class="col-xs-12 col-sm-12 col-md-9">
        <div class="title"><span><?php if(@$numRegistros == 0)echo '0'; else echo $numRegistros; ?> Registos encontrados</span></div>
        <ol class="breadcrumb">
          <li><a href="<?php echo '../inc/editarperfil.php?id_user='.$_SESSION['UserID'].'';?>">Home</a></li>
        </ol>
        <?php  
        // Se houver pelo menos um registro, exibe-o
        if (@$numRegistros != 0) {
            $sqlIdDistrito = mysql_query("SELECT * FROM empresas WHERE id_distrito = ".$row2[0]." ");
            
            // Exibe os produtos e seus respectivos preços
            
            while ($results = mysql_fetch_array($sqlText)) {
                $sql3 = "SELECT distrito FROM distrito WHERE id_distrito = ".$results['id_distrito']." ";
                $result3 = mysqli_query ($conn, $sql3);
                $row = mysql_fetch_array ($result3) or die (mysql_error());
        ?>
            <div class="content_search" style="border-bottom:1px solid #E0E0E0;">
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail"> <img src="<?php echo 'empresas/'.$results['logo']; ?>" alt="..."> </div>
              </div>
              <div class="col-sm-8 col-md-8">
                <div class="content_info">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="content_title"><a href="detalhe.php?id=<?php echo $results['id_empresa'] ?>"><?php echo $results['nome_empresa']; ?></a></div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12" >
                      <?php if($results['descricao']!='') ?>
                            <div class="content_description"><?php echo $results['descricao']; ?></div>
                            <div class="content_icons">
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-home" aria-hidden="true" style="padding:5px;"></span><?php echo $results['morada']; ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-flag" aria-hidden="true" style="padding:5px;"></span><?php echo $results['localidade']; ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-flag" aria-hidden="true" style="padding:5px;"></span><?php echo $row['distrito']; ?></p>
                                </div>
                                <?php if($results['telefone']!=0){ ?>
                                    <div class="col-xs-12 col-sm-12 col-md-4" >
                                    <p><span class="glyphicon glyphicon-phone-alt" aria-hidden="true" style="padding:5px;"></span><?php echo $results['telefone']; ?></p>
                                    </div>
                                <?php }?>
                                <?php if($results['telemovel']!=0){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-phone" aria-hidden="true" style="padding:5px;"></span><?php echo $results['telemovel']; ?></p>
                                </div>
                                <?php } ?>
                                <?php if($results['email']!=''){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
                                <p><span class="glyphicon glyphicon-envelope" aria-hidden="true" style="padding:5px;"></span><?php echo $results['email']; ?></p>
                                </div>
                                <?php } ?>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
                
            <?php 
    
            // Se não houver registros
            }
        }
        else{?>
			<div class="alert alert-info" role="alert"><?php echo 'Nenhuma empresa foi encontrado<strong>'.$searchText.'</strong>'; ?></div>
        <?php }?>
     </div>
	</div>
    </div>
	<!--/#container--> 

<?php include ('../inc/footer.php'); ?>
<!-- #footer --> 
  
</div>
<!--/#wrapper-->
<?php
}

?>   

 
</body>

</html>

<?php } ?>