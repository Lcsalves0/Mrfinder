<?php 
	//include ('../connections/config.php');

	
	//mysql_query("SET NAMES utf8");
	//$resultado = mysql_query($sql);
	
	$sqlEmpresas ="SELECT * FROM utilizadores WHERE nivel='2'";
	$resultado = mysql_query($sqlEmpresas) or die(mysql_error());
	$registos=mysql_fetch_array($resultado)
	
?>

<table class="table table-hover">
<tr>
    <td class="info"><strong>ID</strong></td>
    <td class="info"><strong>Username</strong></td>
    <td class="info"><strong>Email</strong></td>
    <td class="info"><strong>data_registo</strong></td>
    <td class="info"><strong>Ver</strong></td>
</tr>
	<?php 
	do {
	
		if($registos>=1){?>
<tr>
    <td class="success"><?php echo $registos['id_user']; ?></td>
    <td class="success"><?php echo $registos['username']; ?></td>
    <td class="success"><?php echo $registos['email']; ?></td>
    <td class="success"><?php echo $registos['data_registo']; ?></td>
    <td class="danger" align="center"><?php echo '<a href="../autenticacao/detalhe.php?id='.$registos['id_user'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';?></td>
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
	
	

