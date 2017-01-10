<?php	session_start();
	
	if(!isset($_SESSION['usernameSession']) AND !isset($_SESSION['passwordSession'])){
		header("Location: ../index.php");
		exit;
	}
	
?>
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from php_interview_questions";
$faq = $db_handle->runQuery($sql);


$result = mysql_query("SELECT * FROM empresas");
$num_rows = @mysql_num_rows($result);

$result2 = mysql_query("SELECT * FROM utilizadores");
$num_rows_users = @mysql_num_rows($result2);

$result3 = mysql_query("SELECT * FROM ramoatividade");
$num_rows_atividade = @mysql_num_rows($result3);

?>

<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lte9 lte8" lang="en-US">	<![endif]-->
<!--[if IE 9]><html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" lang="en-US">
<!--<![endif]-->
<head>
<title>Mr.Finder</title>

<!--Inline Editer-->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#909090");
			$(editableObj).css("color","#fff");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#3EBC25 url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#3EBC25");
				}        
		   });
		}
		</script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="application/javascript">
      $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})  </script>

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

</head><body>

<header class="top-header">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-xs-5 col-sm-4 header-logo"> <br>
        <a href="index.php?id=4"> 
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

if(isset($_POST['enviarAtividade'])){
	include('func_foto.php');
	$atividade = $_POST['atividade'];
	@$thumbnail = $_POST['thumbnail'];
	$uploadImage = @upload_atividade($thumbnail);
	
	$sqlRegisto = mysql_query("INSERT INTO ramoatividade (atividade, imagem) VALUES ('$atividade', '$uploadImage')");
	echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0;'>
		<script type=\"text/javascript\">
		alert(\"Atividade Registada.\");
		</script>
		";
}
?>

<!-- insert category image modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content">
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="login">
              <h2 class="content_h2">Adicionar Ramo de Atividade</h2>
              <form id="loginForm" method="post" action="" enctype="multipart/form-data"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="form-group">
                  <input type="text" class="input_style large" name="atividade" placeholder="Nome Atividade" required data-bv-notempty-message="Atividade obrigatório!" />
                </div>
                <div class="form-group">
                  <input type="file" class="filestyle" data-input="false" name="thumbnail" accept="image/*">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default pull-left" name="enviarAtividade">Registar</button>
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

<?php include ('../inc/functions.php');?>
<!-- WRAPPER -->
<div id="wrapper">

  <div id="header" class="content-block">
    <section class="center">
      <div class="slogan">
        <?php
		  foreach($faq as $k=>$v) {
		  ?>
        <div class="table-row">
          <div style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'head_service','<?php echo $faq[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["head_service"]; ?></div>
        </div>
        <?php
		}
		?>
        
        <!--Simples &amp; Consistente --></div>
      <div class="secondary-slogan"> 
      <?php
		  foreach($faq as $k=>$v) {
		  ?>
        <div class="table-row">
          <div style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'subtitulo','<?php echo $faq[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["subtitulo"]; ?></div>
        </div>
        <?php
		}
		?>
      
       </div>
      <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="content_search"> 
          
          <!-- /col-xs-6 col-md-4 --> 
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
        <div class="row">
        <div class="col-sm-3"> 
          
          <a href="#" class="recent-work" data-toggle="modal" data-target="#myModal" data-whatever="@mdo"  style="background-image:url(../assets/images/category_images/adic_image.jpg)"></a></div>
          <?php 
	 
			$query="SELECT id_atividade FROM ramoatividade";
			mysql_query("SET NAMES utf8");
			$mysql=mysql_query($query) or die(mysql_error());
			$size = mysql_num_rows($mysql);
			$c=1;
			while ($row=mysql_fetch_array($mysql)) {
				if ($c <= 8)
					admin_atividade($row['id_atividade']);	
				elseif ($c == 9){
					?>
          <div id="collapse" class="panel-collapse collapse">
            <?php
					admin_atividade($row['id_atividade']);
				}
				elseif ($c > 9 && $c < $size){
					admin_atividade($row['id_atividade']);
				}
				elseif ($c == $size){
					admin_atividade($row['id_atividade']);
					?>
          </div>
          <?php
				}
				$c++; 
			}
			?>
          </div>
        <a href="#collapse" class="btn btn-o btn-lg pull-right" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">View All</a> </section>
    </div>
  </div>
  <!-- #categorias -->
  
  <div class="content-block Sobre" id="sobre">
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-suitcase"></i>
            <h4 class="aboutus-title"> <span class="counter"><?php echo $num_rows; ?></span>
              <p class="aboutus-desc">Empresas</p>
            </h4>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-users"></i>
            <h4 class="aboutus-title"> <span class="counter"><?php echo $num_rows_users; ?></span>
              <p class="aboutus-desc">Utilizadores</p>
            </h4>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="aboutus-item"> <i class="aboutus-icon fa fa-bookmark "></i>
            <h4 class="aboutus-title"> <span class="counter"><?php echo $num_rows_atividade; ?></span>
              <p class="aboutus-desc">Atividades</p>
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
        <p class="sub-header">Conheça alguns dos serviços que ofereço </p>
      </div>
      <section class="block-body">
        <div class="row">
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i> --> 
              <img  src="../assets/images/service_images/first_icon.png" alt="..." class="img-circle">
              <?php
		  foreach($faq as $k=>$v) {
		  ?>
              <div class="service-head" style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'servico1','<?php echo $faq[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["servico1"]; ?></div>
              <?php
		}
		?>
              
              <!--Mr. Finder tem
                ao dispor uma ferramenta de personlização que permite a qualquer utilizador registado, personlizar a sua página empresarial e pessoal.--> 
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i>--> 
              <img src="../assets/images/service_images/second_icon.png" alt="..." class="img-circle" >
              <p class="service-head">
                <?php
		  foreach($faq as $k=>$v) {
		  ?>
              
              <div class="service-head" style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'servico2','<?php echo $faq[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["servico2"]; ?></div>
              <?php
		}
		?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"><!-- <i Align="center" class="fa fa-send-o"></i>--> 
              <img src="../assets/images/service_images/third_icon.png" alt="..." class="img-circle" >
              <?php
		  foreach($faq as $k=>$v) {
		  ?>
              <div class="service-head" style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'servico3','<?php echo $faq[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["servico3"]; ?></div>
              <?php
		}
		?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- #services -->
  
  
  
  
  <?php include ('../inc/footer.php') ?>
  <!-- #footer --> 
  
</div>
<!--/#wrapper--> 

<!-- Script Tab --> 
<!--<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>--> 

<!----------> 
<script type="text/javascript" src="../assets/js/jquery-2.1.3.min.js"></script> 
<script type="text/javascript" src="../assets/js/bootstrap-filestyle.min.js"> </script> 
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
$('#searchForm').bootstrapValidator();
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



</body>
</html>
