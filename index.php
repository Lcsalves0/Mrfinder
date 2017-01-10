<?php include 'connections/config.php';



        $result = mysqli_query("SELECT * FROM empresas");
        $result_rows = $conn->query($result);
	

	$result2 = mysqli_query("SELECT * FROM utilizadores");
	$result_rows_users = $conn->query($result2);
	
	$result3 = mysqli_query("SELECT * FROM ramoatividade");
        $result_rows_atividade = $conn->query($result3);
	
	



	
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

<script type="text/javascript" src="assets/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.min.js"> </script>

<!-- Script para editar o .select-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />

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
            curInputs = curStep.find("input[type='text'],input[type='url']"),
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
<!-- /.modal --> 


<header class="top-header">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-xs-5 col-sm-4 header-logo"> <br>
        <a href="index.php"> 
        <img src="assets/images/logo.png">
        <!--<h1 class="logo">Mr. <span class="logo-head">Finder</span></h1>-->
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

<!-- WRAPPER -->
<div id="wrapper">

  <div id="header" class="content-block">
    <section class="center">
      <div class="slogan"> Simples &amp; Consistente </div>
      <div class="secondary-slogan"> Se você procura, eu encontro </div>
      <div class="col-md-6 col-md-offset-3 col-xs-12">
      <div class="margem"></div>  
        <form id="bootstrapSelectForm" method="post" class="form-horizontal" action="search.php?var=search">
        <div class="form-group col-md-8">
        <input type="text" class="form-control" name="searchText" placeholder="Procurar...">
        </div>
        <div class="form-group col-md-4">
        <select name="searchDistrito" class="form-control">
        <option >Distrito</option>
        <?php 
           
            $sql="SELECT id_distrito, distrito FROM distrito";
            mysqli_query("SET NAMES utf8");
            $mysql=mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_array($mysql)) {    

           
        ?>
        <option  value="<?php echo $row["id_distrito"]; ?>"><?php echo $row["distrito"]; ?></option>
        <?php }?>
        </select>
        </div>
        <div class="form-group col-md-1">
        <button type="submit" name="submitSearch" class="btn-search" aria-label="Left Align"><span class="fa fa-search" aria-hidden="true"></span></button>
        </div>
        </form>
          <!-- /col-xs-6 col-md-4 --> 
      </div>
    </section>
  </div>
  <!-- header -->
<?php include ('inc/functions.php');?>
  <div class="content-block" id="categorias">
    <div class="container portfolio-sec">
      <header class="block-heading cleafix">
        <div class="title-page">
          <p class="main-header">Ramos de Atividade </p>
          <p class="sub-header">Escolha uma das principais atividades e comece a procurar</p>
        </div>
      </header>
      <section class="block-body">
        <div class="row">

          <?php 

	 
			$query="SELECT id_atividade FROM ramoatividade";
			mysqli_query("SET NAMES utf8");
			$mysql=mysqli_query($conn, $query);
			$size = mysqli_num_rows($mysql);
			$c=1;
			while ($row=mysqli_fetch_array($mysql)) {
				if ($c <= 8)
					atividade($row['id_atividade']);	
				elseif ($c == 9){
					?>
					<div id="collapse" class="panel-collapse collapse">
                    <?php
					atividade($row['id_atividade']);
				}
				elseif ($c > 9 && $c < $size){
					atividade($row['id_atividade']);
				}
				elseif ($c == $size){
					atividade($row['id_atividade']);
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
        <p class="sub-header">Conheça alguns dos serviços que ofereço</p>
      </div>
      <section class="block-body">
        <div class="row">
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i> --> 
              <img  src="assets/images/service_images/first_icon.png" alt="..." class="img-circle">
              <p class="service-head">Ofereço uma ferramenta de personlização que permite qualquer utilizador registado, personlizar a sua página empresarial e pessoal.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"> <!--<i Align="center" class="fa fa-send-o"></i>--> 
              <img src="assets/images/service_images/second_icon.png" alt="..." class="img-circle" >
              <p class="service-head">Disponho uma galeria de fotos e/ou imagens que poderam ser submetidas a qualquer altura e sem qualquer limite.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service" align="center"><!-- <i Align="center" class="fa fa-send-o"></i>--> 
              <img src="assets/images/service_images/third_icon.png" alt="..." class="img-circle" >
              <p class="service-head">Ofereço a qualquer utilizador registado, destaque na listagem de procura através do plano premium.</p>
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
        <p class="sub-header">Como registar uma empresa</p>
      </div>
      <div class="row">
        <div class="row_tutorial">
          <div class="col-lg-4" align="center"> <img src="assets/images/01.PNG"/>
            <h2>Registo</h2>
            <p>- Para registar uma empresa o primeiro passo é efetuar o registo de utilizador através do seu nome e e-mail.</p>
            <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p-->
          </div>
          <!-- /.col-lg-4 -->
          
          <div class="col-lg-4" align="center"> <img src="assets/images/02.PNG"/>
            <h2>Empresa</h2>
            <p>- O segundo passo consiste no registo da empresa, através dos dados pessoais no separador "adicionar empresa".</p>
          </div>
          <!-- /.col-lg-4 -->
          
          <div class="col-lg-4" align="center"> <img src="assets/images/03.PNG"/>
            <h2>Finalização</h2>
            <p>- Depois do registo da empresa, basta aguardar a aprovação para se juntar à plataforma.  </p>
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
  <?php 
	$sql="select * from testemunhos";
	mysqli_query("SET NAMES utf8");
	$resultado = mysqli_query($conn, $sql);
	$size = mysqli_num_rows($resultado);
	?>  
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
            <?php 
			for($i = 1; $i <= $size; $i++){
				if($i == 1){
				?>
				  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<?php
				}else if($i <= $size){
				?>
				  <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i-1; ?>"></li>
				<?php }
			} ?>
            </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            <?php
			for($i = 1; $i <= $size; $i++){
				$registo = mysqli_fetch_array($resultado);
				
				$sql3="select * from utilizadores WHERE id_user = ".$registo['id_user']."";
				mysql_query("SET NAMES utf8");
				$resultado3 = mysqli_query($conn, $sql3);
				$registo3 = mysqli_fetch_array($resultado3);
			if($i == 1){
				?>
              <div class="item active">
              <?php
				}else if($i <= $size){
				?>
                <div class="item">
                <?php	
				}
				?>
                <div class="col-md-4"> <img class="img-circle circular-img" src="<?php echo 'autenticacao/thumbnails/'.$registo3['thumbnail']; ?>"> </div>
                <div class="col-md-8">
                  <blockquote class="text-left">
                    <p><?php echo $registo['descricao']; ?></p>
                    <footer><cite title="Source Title"><?php echo $registo3['username']; ?></cite></footer>
                  </blockquote>
                </div>
              </div>
              <?php }?>
              
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /#testimonials -->
  
  <?php include ('inc/footer.php') ?>
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

<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script> 
<!--<script type="text/javascript" src="assets/js/bootstrap.js"></script><!--******---> 
<script type="text/javascript" src="assets/js/jquery.actual.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.scrollTo.min.js"></script> 
<script type="text/javascript" src="assets/js/script.js"></script> 
<script type="text/javascript" src="assets/js/smoothscroll.js"></script> 
<script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script> 
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 

<!--- Validator -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script>
$('#loginForm').bootstrapValidator();
$('#registerForm').bootstrapValidator();
$('#forgotForm').bootstrapValidator();
$('#addEmpresaForm').bootstrapValidator();
$('#searchForm').bootstrapValidator();
</script>
<!------------>
<!-- shows bar --> 
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