<?php 
require 'connections/config.php';

$id = $_GET["id"];

$sql="select * from empresas where id_empresa='".$_REQUEST['id']."'";
mysql_query("SET NAMES utf8");
$resultado = mysql_query($sql);
$results = mysql_fetch_array($resultado);

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
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/style.css" media="screen"/>
<link rel="stylesheet" href="assets/css/myStyle.css"/>
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
<style type="text/css">
.rating-loading {
	width: 25px;
	height: 25px;
	font-size: 0px;
	color: #fff;
	background: transparent url('../img/loading.gif') top left no-repeat;
	border: none;
}
/*
 * Stars
 */
.rating-fa {
	font-family: 'FontAwesome';
	padding-left: 1px;
}
.rating-fa .rating-stars:before {
	padding-left: 1px;
}
.rating-gly {
	font-family: 'Glyphicons Halflings';
}
.rating-gly-star {
	font-family: 'Glyphicons Halflings';
	padding-left: 2px;
}
.rating-gly-star .rating-stars:before {
	padding-left: 2px;
}
.rating-lg .rating-gly-star, .rating-lg .rating-gly-star .rating-stars:before {
	padding-left: 4px;
}
.rating-xl .rating-gly-star, .rating-xl .rating-gly-star .rating-stars:before {
	padding-left: 2px;
}
.rating-active {
	cursor: default;
}
.rating-disabled {
	cursor: not-allowed;
}
.rating-uni {
	font-size: 1.2em;
	margin-top: -5px;
}
.rating-container {
	position: relative;
	vertical-align: middle;
	display: inline-block;
	color: #e3e3e3;
	overflow: hidden;
}
.rating-container:before {
	content: attr(data-content);
}
.rating-container .rating-stars {
	position: absolute;
	left: 0;
	top: 0;
	white-space: nowrap;
	overflow: hidden;
	color: #fde16d;
	transition: all 0.25s ease-out;
	-o-transition: all 0.25s ease-out;
	-moz-transition: all 0.25s ease-out;
	-webkit-transition: all 0.25s ease-out;
}
.rating-container .rating-stars:before {
	content: attr(data-content);
	text-shadow: 0 0 1px rgba(0, 0, 0, 0.7);
}
.rating-container-rtl {
	position: relative;
	vertical-align: middle;
	display: inline-block;
	overflow: hidden;
	color: #fde16d;
}
.rating-container-rtl:before {
	content: attr(data-content);
	text-shadow: 0 0 1px rgba(0, 0, 0, 0.7);
}
.rating-container-rtl .rating-stars {
	position: absolute;
	left: 0;
	top: 0;
	white-space: nowrap;
	overflow: hidden;
	color: #e3e3e3;
	transition: all 0.25s ease-out;
	-o-transition: all 0.25s ease-out;
	-moz-transition: all 0.25s ease-out;
	-webkit-transition: all 0.25s ease-out;
}
.rating-container-rtl .rating-stars:before {
	content: attr(data-content);
}
/**
 * Rating sizes
 */
.rating-xl {
	font-size: 4.89em;
}
.rating-lg {
	font-size: 3.91em;
}
.rating-md {
	font-size: 3.13em;
}
.rating-sm {
	font-size: 2.5em;
}
.rating-xs {
	font-size: 2em;
}
/**
 * Clear rating button
 */
.star-rating .clear-rating, .star-rating-rtl .clear-rating {
	color: #aaa;
	cursor: not-allowed;
	display: inline-block;
	vertical-align: middle;
	font-size: 60%;
}
.clear-rating-active {
	cursor: pointer !important;
}
.clear-rating-active:hover {
	color: #843534;
}
.star-rating .clear-rating {
	padding-right: 5px;
}
/**
 * Caption
 */
.star-rating .caption, .star-rating-rtl .caption {
	color: #999;
	display: inline-block;
	vertical-align: middle;
	font-size: 55%;
}
.star-rating .caption {
	padding-left: 5px;
}
.star-rating-rtl .caption {
	padding-right: 5px;
}

/**
 * Print
 */
@media print {
.rating-container, .rating-container:before, .rating-container-rtl .rating-stars, .rating-container-rtl .rating-stars:before {
	color: #f3f3f3!important;
}
.star-rating .clear-rating, .star-rating-rtl .clear-rating {
	display: none;
}
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="assets/js/star-rating.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled:true
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>

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

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />

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
<header class="shows">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-xs-5 col-sm-4 header-logo"> <br>
        <a href="index.php">
        <h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>
        </a> </div>
      <div class="col-md-5 col-xs-6">
        <div class="content_search" style="margin:20px;">
          
        <form id="bootstrapSelectForm" method="post" class="form-horizontal" action="search.php?var=search">
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
      </div>
      <div class="col-md-3 col-md-offset-2 col-xs-4">
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
                <li> <a data-toggle="modal" class="btn btn-info" href="#" data-target="#myModal"><i class="glyphicon glyphicon-user"></i></a> </li>
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

<div class="margem"></div>
<!-- margem -->

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8">
      <div class="title"><span><?php echo $results['nome_empresa']?></span>
      </div>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="<?php echo 'search.php?id_distrito='.$results['id_distrito'].'';?>">Search</a></li>
        <li class="active">Detalhes</li>
      </ol>
      <div class="content_search">
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail"> <img src="<?php echo 'autenticacao/empresas/'.$results['logo']; ?>"> </div>
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
                        
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-3 col-md-3">
      <div class="panel panel-default"> 
        <!-- Default panel contents -->
        <div class="panel-heading">Espaço publicitário</div>
        <div class="panel-body">
          <p></p>
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
                <img src="autenticacao/empresas/1/home/01.jpg" alt="First Slide">
            </div>
            <div class="item">
                <img src="autenticacao/empresas/1/home/02.jpg" alt="Second Slide">
            </div>
            <div class="item">
                <img src="autenticacao/empresas/1/home/03.jpg" alt="Third Slide">
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
    
  </div>
</div>
<?php include ('inc/footer.php') ?>
<!-- #footer --> 
<!--/#wrapper-->
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
</body>
</html>
