<?php 
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			echo $permissao;
		}else{
			include "menufunc.php";
		}
	
    
    
         if ($permissao == "funcionario"){
            echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
        }
?>

<div id="wrapper">
	<div class="container-fluid">
		<!-- ___________________________________abrir_Painel______________________________________________ -->
		<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
			  		<h4 class="text-center panel-edt3">
			  		<i class="fa fa-pie-chart fa-1x"></i> RELATÓRIO ORDEM DE SERVIÇO</h4>
			  	</div>
			<div class="panel-body panel-edt4">
				<div class="">
					<div class="row">

			  		</div><!-- /.row -->
				</div>
			</div>
		</div>
	</div>
</div>