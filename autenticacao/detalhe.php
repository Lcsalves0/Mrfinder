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


$sql4="select * from empresas where id_empresa='".$_REQUEST['id']."'";
mysql_query("SET NAMES utf8");
$resultado4 = mysql_query($sql4);
$results = mysql_fetch_array($resultado4);

$sql2 = "SELECT distrito FROM distrito WHERE id_distrito = ".$results['id_distrito']." ";
$result2 = mysql_query ($sql2);
$row2 = mysql_fetch_array ($result2) or die (mysql_error());

$sql3 = "SELECT atividade FROM ramoatividade WHERE id_atividade = ".$results['id_atividade']." ";
$result3 = mysql_query ($sql3);
$row3 = mysql_fetch_array ($result3) or die (mysql_error());


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
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>	
 
      function init_map() {
		var var_location = new google.maps.LatLng(45.430817,12.331516);
 
        var var_mapoptions = {
          center: var_location,
          zoom: 14
        };
 
		var var_marker = new google.maps.Marker({
			position: var_location,
            map: var_map,
			title:"Venice"});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
		var_marker.setMap(var_map);	
 
      }
 
      google.maps.event.addDomListener(window, 'load', init_map);
 
    </script>
<style type="text/css">
<style> #map-outer {
height: 300px;
 padding: 20px;
 border: 2px solid #CCC;
 margin-bottom: 20px;
 background-color:#FFF
}
#map-container {
	margin-top: 10px;
	height: 300px
}

@media all and (max-width: 991px) {
#map-outer {
	height: 300px
}
}
</style>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.js"></script>
		<![endif]-->

<!--[if IE 8]>
	    	<script src="assets/js/selectivizr.js"></script>
	    <![endif]-->
        
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style type="text/css">
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.bs-example{
	margin: 20px;
}
</style>

</head>

<body>
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
              <form id="registerForm" method="post" action="autenticacao/func_registo.php" enctype="multipart/form-data"
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
              <form id="forgotForm" method="post" action="autenticacao/func_registo.php"
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

<header class="shows">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-xs-8 col-sm-4 header-logo"> <br>
        <a href="<?php echo "../inc/editarperfil.php?id=".$_SESSION['UserID']." ";?>">
        <h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>
        </a> </div>
      <div class="col-md-6 col-xs-8">
        <form action="../autenticacao/search.php?var=search" class="formoid-solid-green" style="font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px; " method="POST">
            <input class="medium" type="text" name="searchText" placeholder="pesquisa..."/>
            <select class="small " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="searchDistrito">
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

<?php include('../inc/functions.php');?>

<div id="wrapper">

<div class="margem"></div>
<!-- margem -->

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8">
       
       
       <?php
	  	if ($_SESSION['UserNivel'] =='1'){
			
			if(isset($_POST['aceitar'])){
			$sql = "UPDATE empresas SET ativo='sim' WHERE id_empresa='".$_REQUEST['id']."'";
			$resultado = mysql_query($sql);
		
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../admin-mrprojeto/?pagina=novasEmpresas'>
				<script type=\"text/javascript\">
				alert(\"Empresa Ativa!\");
				</script>
				";
			}
			if(isset($_POST['rejeitar'])){
			$sql = "DELETE FROM info_empresas WHERE id='".$_REQUEST['id']."'";
			$resultado = mysql_query($sql);
		
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../admin-mrprojeto/?pagina=novasEmpresas'>
				<script type=\"text/javascript\">
				alert(\"Empresa Desativa!\");
				</script>
				";
			}
	  ?>
            <form action="" method="post">
            	<div class="title"><span><?php echo $results['nome_empresa']?></span>
            
                <input name="id" type="hidden" value="<?php echo $results['id_empresa']; ?>"/>
                <button style="margin-left:10px;" type="submit" id="myButton" data-loading-text="Loading..." class="btn btn-success" autocomplete="off" name="aceitar">
                Aceitar
                </button>
                <button type="submit" id="myButton" data-loading-text="Loading..." class="btn btn-danger" autocomplete="off" name="rejeitar">
                Rejeitar
                </button>
            </form>
      <?php
		}
	  	else if ($_SESSION['UserNivel'] =='2'){
	  ?>
      	<form action="../inc/insertRegistos.php" method="post">
       		<div class="title"><span><?php echo $results['nome_empresa']?></span>
            <input type="hidden" name="id_empresa" value="<?php echo $results['id_empresa'];?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['UserID'];?>">
            <?php 
			if(verificaFavoritos($_SESSION['UserID'], $results['id_empresa']) != 0){
			?>
	        	<button type="submit" id="myButton" class="btn btn-primary" name="removefavoritos"><i class="glyphicon glyphicon-star" onClick="remove"></i> Favoritos </button>
            <?php 
			}else{
			?>
	        	<button type="submit" id="myButton" class="btn btn-primary" name="addfavoritos"><i class="glyphicon glyphicon-star-empty"></i> Favoritos </button>
            <?php 
			} ?>
       </form>
      <?php 
		}
	  ?>
      </div>
      <ol class="breadcrumb">
        <li><a href="<?php echo '../inc/editarperfil.php?id_user='.$_SESSION['UserID'].'';?>">Home</a></li>
        <li><a href="<?php echo 'search.php?id_distrito='.$results['id_distrito'].'';?>">Search</a></li>
        <li class="active">Detalhes</li>
      </ol>
      <div class="content_search">
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail"> <img src="<?php echo 'empresas/'.$results['logo']; ?>"> </div>
            <?php 
			if(verificaAvaliacao($_SESSION['UserID'], $results['id_empresa']) != 0){
			?>  
				<div class="show_rating">
                <?php if(verificaEstrelas($_SESSION['UserID'], $results['id_empresa']) <= '1'){ ?>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                <?php }elseif (verificaEstrelas($_SESSION['UserID'], $results['id_empresa']) <= '2'){ ?>
					<i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                <?php }elseif (verificaEstrelas($_SESSION['UserID'], $results['id_empresa']) <= '3'){ ?>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                <?php }elseif (verificaEstrelas($_SESSION['UserID'], $results['id_empresa']) <= '4'){ ?>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star-empty" ></i>
                <?php }elseif (verificaEstrelas($_SESSION['UserID'], $results['id_empresa']) <= '5'){ ?>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                    <i class="glyphicon glyphicon-star" ></i>
                <?php } ?>
                </div>
                	<?php
                    $sql = "SELECT count(DISTINCT id_user) FROM rating_empresa";
					$result = mysql_query ($sql);
					$row = mysql_fetch_array($result);
					?>
                    <div class="subtexto">(<?php echo"Avaliado por <strong>" . $row[0]. "</strong> users"; ?>)</div>
                
            <?php 
			}else{
				?>
            	<form action="../inc/insertRegistos.php" method="post">
                    <input type="hidden" name="id_empresa" value="<?php echo $results['id_empresa'];?>">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['UserID'];?>">
                    
                    <div class="star-rating">
                      <fieldset>
                        <input type="radio" id="star5" name="rating_score" value="5" /><label for="star5" title="Outstanding">5 stars</label>
                        <input type="radio" id="star4" name="rating_score" value="4" /><label for="star4" title="Very Good">4 stars</label>
                        <input type="radio" id="star3" name="rating_score" value="3" /><label for="star3" title="Good">3 stars</label>
                        <input type="radio" id="star2" name="rating_score" value="2" /><label for="star2" title="Poor">2 stars</label>
                        <input type="radio" id="star1" name="rating_score" value="1" /><label for="star1" title="Very Poor">1 star</label>
                      <button type="submit" name="enviarRating" class="btn-rating" > <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> </button>
                      </fieldset>

                    </div>
                </form>
			<?php
            } ?>
            
        </div>
        <div class="col-sm-6 col-md-8">
          <div class="content_info">
            <div class="col-sm-8 col-md-12" >
              <div class="content_title">Dados de Contato</div>
              <div class="col-xs-12 col-sm-12 col-md-12" >
                <div class="content_icons">
                  <div class="col-xs-12 col-sm-12 col-md-4" >
                    <p><span class="glyphicon glyphicon-home" aria-hidden="true" style="padding:5px;"></span><?php echo $results['morada']; ?></p>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4" >
                    <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true" style="padding:5px;"></span><?php echo $results['localidade'].' - '.$results['cod_postal']; ?></p>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4" >
                    <p><span class="glyphicon glyphicon-flag" aria-hidden="true" style="padding:5px;"></span><?php echo $row2['distrito']; ?></p>
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
                  <div class="col-xs-12 col-sm-12 col-md-4" >
                    <p><span class="glyphicon glyphicon-user" aria-hidden="true" style="padding:5px;"></span><?php echo $results['nome_responsavel']; ?></p>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4" >
                    <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="padding:5px;"></span><?php echo $row3['atividade']; ?></p>
                  </div>
                  
                </div>
              </div>
            </div>
            <!--<div class="col-md-12">
           
<form>     
    <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >
    <hr>
</form>
           </div>--> 
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-3 col-md-3">
      <div class="panel panel-default"> 
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de Favoritos</div>
        <ul class="list-group">
          <li class="list-group-item">Recente</li>
        </ul>
        <div class="panel-body">
          <p><?php 
				$sql = "SELECT * FROM favoritos WHERE id_user = ".$_SESSION['UserID']."";
				$result 	= mysql_query ($sql);
				$num_results 	= mysql_num_rows($result);	
				if ($num_results!=0){?>
				<?php 
					while ($row	= mysql_fetch_array ($result)) {
						$sql2 = "SELECT * FROM empresas WHERE id_empresa = ".$row['id_empresa']." ";
						$result2 = mysql_query ($sql2);
						$row2 = mysql_fetch_array ($result2);
						
						$sql3 = "SELECT distrito FROM distrito WHERE id_distrito = ".$row2['id_distrito']." ";
						$result3 = mysql_query ($sql3);
						$row3 = mysql_fetch_array ($result3) or die (mysql_error());
					?>
						  <div class="content_title" style="border-bottom:1px solid #ccc">
                          	<div class="col-sm-6 col-md-4">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span><a href="../autenticacao/detalhe.php?id=<?php echo $row['id_empresa'] ?>"><?php echo $row2['nome_empresa']; ?></a></div>
						  </div>
					<?php
					}
				}
				else {
				?>
				<?php echo 'Atualmente não tem <strong>0</strong> empresas guardada.'; ?>
				<?php
				}
		   ?></p>
        </div>
      </div>
      <!--<div class="panel panel-default">
      </div>--> 
    </div>
    <?php if($results['descricao']!=''){ ?>
        <div class="col-xs-7 col-sm-8 col-md-8">
         <div class="content_search">
          <div class="content_title col-md-12" style=" border-bottom: 1px solid #ccc; margin-bottom: 1px;">Descrição detalhada</div>
          <div class="content_description col-md-12" style="padding-top:10px;">
            <div class="content_description"><?php echo $results['descricao']; ?></div>
          </div>
        </div>
        </div>
    <?php } ?>
    
    <?php if($results['url']!='' || $results['facebook']!=''){ ?>  
    <div class="col-xs-7 col-sm-8 col-md-8">
       <div class="content_search">
          <div class="content_title col-md-12" style=" border-bottom: 1px solid #ccc; margin-bottom: 1px;">Redes Sociais</div>
          <div class="col-xs-12 col-sm-12 col-md-4" >
            <p><span class="glyphicon glyphicon-globe" aria-hidden="true" style="padding:5px;"></span><?php echo $results['url']; ?></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4" >
            <p><span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="padding:5px;"></span><?php echo $results['facebook']; ?></p>
          </div>
       </div>
	</div>  
    <?php } ?>
    
	<?php
        $sql = "SELECT * FROM horario_funcionamento WHERE id_empresa = ".$results['id_empresa']." ";
        $resultQuery = mysql_query($sql);
        $num_rows = mysql_num_rows($resultQuery);
        //$regist = mysql_fetch_array($resultQuery);
        
        for($i=1;$i<=4;$i++){
        $campo = "campo".$i;
        $$campo=" ";
        }
        echo $campo1;
        
        while($regist = mysql_fetch_array($resultQuery)){ 
        $campo = $regist['campo'];
        $$campo = " ".$regist['inicioManha']." - ".$regist['fimManha']." : ".$regist['inicioTarde']." - ".$regist['fimTarde']." ";
        }
        mysql_free_result($resultQuery);
        mysql_close();
    ?>
    
    <?php //if($num_rows != '0'){ ?>
    <!--<div class="col-xs-7 col-sm-8 col-md-8">
       <div class="content_search">
          <div class="content_title col-md-12" style=" border-bottom: 1px solid #ccc; margin-bottom: 1px;">Horário Funcional</div>

            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-12">

                  <table>
                      <tr >
                        <td>Segunda-Feira</td>
                        <td><?php echo $campo1; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Terça-Feira</td>
                        <td><?php echo $campo2; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Quarta-Feira</td>
                        <td><?php echo $campo3; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Quinta-Feira</td>
                        <td><?php echo $campo2; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Sexta-Feira</td>
                        <td><?php echo $campo2; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Sábado</td>
                        <td><?php echo $campo2; ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td>Domingo</td>
                        <td><?php echo $campo2; ?></td>
                        </td>
                      </tr>
                      <tr>
                      <td>
                      <?php if($regist['servico'] == 1)
                        	echo 'Serviço 24 Horas'; ?>
                      </td>
                      </tr>
                  </table>
                </div>                      
            </div>
        
       </div>
	</div>-->    
    <?php //} ?>
    
    <div class="col-xs-7 col-sm-8 col-md-8">
     <div class="content_search">
      <div class="content_title col-md-12" style=" border-bottom: 1px solid #ccc; margin-bottom: 1px;">Galeria de Fotos</div>
      <div class="margem"></div>
      
      <div class="bs-example">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>   
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="../autenticacao/empresas/1/home/01.jpg" alt="First Slide">
            </div>
            <div class="item">
                <img src="../autenticacao/empresas/1/home/02.jpg" alt="Second Slide">
            </div>
            <div class="item">
                <img src="../autenticacao/empresas/1/home/03.jpg" alt="Third Slide">
            </div>
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
	 </div>      
    </div>
    
    <div class="col-xs-7 col-sm-8 col-md-8" style="min-height:400px;">
     <div class="content_search">
      <div id="map-outer" class="col-md-12">
        <div class="content_title col-md-12" style="border-bottom: 1px solid #ccc; margin-bottom: 1px;">Localização Google Maps</div>
        <div id="map-container" class="col-md-12  thumbnail"></div>
      </div>
       <!--/map-outer --> 
	 </div>      
    </div>
    <!-- /row --> 
    
    
    <?php //if($results['url']!='' || $results['facebook']!=''){ ?>  
    <!--<div class="col-xs-7 col-sm-8 col-md-8">
       <div class="content_search">
          <div class="content_title col-md-12" style=" border-bottom: 1px solid #ccc; margin-bottom: 1px;">Deixa aqui o seu comentário</div>
          <div class="col-xs-12 col-sm-12 col-md-4" >
            <form action="insertRegistos.php" method="post">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['UserID']; ?>">
                <textarea class="input_style large" name="descricao" placeholder="Escreve-me aqui..." rows="3"></textarea>
                <button type="submit" class="btn btn-default pull-left" name="enviarTestemunho" style="margin: 10px 10px">Submeter</button>
            </form>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4" >
            
          </div>
       </div>
	</div>-->  
    <?php //} ?>
    
    
  </div>
</div>
<?php include ('../inc/footer.php') ?>
<!-- #footer --> 
<!--/#wrapper-->

</body>
</html>

<?php } ?>