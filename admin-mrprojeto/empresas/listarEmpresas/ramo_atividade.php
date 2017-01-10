<?php 
	//include ('../connections/config.php');

	
	//mysql_query("SET NAMES utf8");
	//$resultado = mysql_query($sql);
	
	$sqlEmpresas ="SELECT * FROM empresas";
	$resultado = mysql_query($sqlEmpresas) or die(mysql_error());
	$registos=mysql_fetch_array($resultado)
	
?>

<!--<table class="table table-hover">
<tr>
    <td class="info"><strong>Id</strong></td>
    <td class="info"><strong>Nome Empresa</strong></td>
    <td class="info"><strong>Nome Responsavel</strong></td>
    <td class="info"><strong>Distrito</strong></td>
    <td class="info"><strong>Ver</strong></td>
    <td class="info"><strong>Eliminar</strong></td>
</tr>-->
	<?php 
	do {
	
		if($registos>=1){?>
        
        
        <section class="block-body">
        <div class="row">
          <?php 
	 
			$query="SELECT id_atividade FROM ramoatividade";
			mysql_query("SET NAMES utf8");
			$mysql=mysql_query($query);
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
        
<!--<tr>
    <?php /*?><td class="success"><?php echo $registos['id_empresa']; ?></td>
    <td class="success"><?php echo $registos['nome_empresa']; ?></td>
    <td class="success"><?php echo $registos['nome_responsavel']; ?></td>
    <td class="success"><?php echo $registos['localidade']; ?></td>
    <td class="danger" align="center"><?php echo '<a href="../autenticacao/detalhe.php?id='.$registos['id_empresa'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';?></td>
    <td class="danger" align="center"><?php echo '<a href="../autenticacao/detalhe.php?id='.$registos['id_empresa'].'"><span class="fa fa-times" aria-hidden="true"></span></a>';?></td>
</tr>--><?php */?>
	<?php 
	}elseif($registos<1) {?>
    
    
     </tr>
     </table>
    <div class="alert alert-danger" role="alert"><?php echo "<strong>Não há registos !!!</strong>";?></div>
   
    
   <?php
	
	}
	}while ($registos=mysql_fetch_array($resultado));
	
	?>	</table>
	
	

