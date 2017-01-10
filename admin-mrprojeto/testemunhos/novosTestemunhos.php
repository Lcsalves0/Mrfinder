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
<!-- Modal -->
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->
</body>
</html>
<?php 
	//include ('../connections/config.php');

	
	//mysql_query("SET NAMES utf8");
	//$resultado = mysql_query($sql);
	
	$sqlEmpresas ="SELECT * FROM testemunhos WHERE ativo='nao'";
	$resultado = mysql_query($sqlEmpresas) or die(mysql_error());
	$registos=mysql_fetch_array($resultado)
	
?>

<table class="table table-hover">
<tr>
    <td class="info"><strong>Id</strong></td>
    <td class="info"><strong>Id User</strong></td>
    <td class="info"><strong>Descricao</strong></td>
    <td class="info"><strong>Data Registo</strong></td>
    
</tr>
	<?php 
	do {
	
		if($registos>=1){?>
        
       <div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="gridSystemModal<?php echo $registos['id_testemunho'] ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Testemunho <?php echo $registos['id_testemunho']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">.col-md-4</div>
          <div class="col-md-4 col-md-offset-4"><h4><?php echo $registos['descricao']; ?></4></div>
        </div>
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-Danger">Rejeitar</button>
        <button type="button" class="btn btn-success">Aceitar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<tr>
    <td class="success"><?php echo $registos['id_testemunho']; ?></td>
    <td class="success"><?php echo $registos['id_user']; ?></td>
    <td class="success"><?php echo $registos['descricao']; ?></td>
    <td class="success"><?php echo $registos['data_registo']; ?></td>
    <?php /*?><!--<td class="danger" align="center"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal<?php echo $registos['id_testemunho'] ?>">
    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
  </button>--><?php */?>
  
  <?php /*?><?php echo '<a href="../autenticacao/detalhe.php?id='.$registos['id_testemunho'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';?><?php */?>
  
  </td>
</tr>
	<?php 
	}elseif($registos<1) {?>
    
    
     </tr>
     </table>
    <div class="alert alert-danger" role="alert"><?php echo "<strong>Não há registos !!!</strong>";?></div>
   
    
   <?php
	
	}
	}while ($registos=mysql_fetch_array($resultado));
	
	?>	</table>
	
	

