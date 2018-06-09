<?php
	include "menu.php";
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatório Financeiro</h4>
				</div>
				<div class="panel-body">
					<br><br>
					<div class="clearfix"></div>

					<?php 
						//iniciar a variavel
						$palavra = "";
						if ( isset ( $_GET["palavra"] ) ) {
							$palavra = trim ( $_GET["palavra"] ); 
							//trim tira o espaço em branco
						}

						//$select vai ser usado na consulta ( $sql = "select...from...where ")
						$select = "";
						$dt1 = "00/00/000";
                        $dt2 = "00/00/000";
						//$filtro pega do formulario o filtro recebendo se e todos produtos, fora de est e etc.
						$filtro = $_GET["filtro"];

						if ($filtro == "tc") {
							$dt1 = $_GET["dt1"];
							$dt2 = $_GET["dt2"];
						} else if ($filtro == "go") {
							$dt1 = $_GET["dt1"];
							$dt2 = $_GET["dt2"];
						} else if ($filtro == "pa") {
							$dt1 = $_GET["dt1"];
							$dt2 = $_GET["dt2"];
						}
						

						//echo "A partir da data $dt1 até a data ";
						//echo "$dt2";

                        //echo "data formatada pr a data $dt1";
                        //formatando as data de 05/2018 para 2018-05
                        
						$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
                        $dt1 = $dt1->format("Y-m-d");
                        $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
                        $dt2 = $dt2->format("Y-m-d");

						/*verefica como veio do formulario filtro ( tp,em,fe ) para jogar na variavel $select para ser usada no $sql*/
						$dataAtual = date('Y-m-d');

						if ($filtro == "tc") {
							$select = "select *, date_format(data, '%d/%m/%Y') data from conta where data >= '$dt1' AND data <= '$dt2'";
						} else if ($filtro == "go") {
							$select = "select *, date_format(data, '%d/%m/%Y') data from conta where conta = 'Pago' and data >= '$dt1' AND data <= '$dt2'";
						} else if ($filtro == "pa") {
							$select = "select *, date_format(data, '%d/%m/%Y') data from conta where conta = 'Pendente' and data >= '$dt1' AND data <= '$dt2'";
						} else if ($filtro == "ve") {
							$select = "select *, date_format(data, '%d/%m/%Y') data from conta where conta = 'Pendente' and data < '$dataAtual'";
						} else if ($filtro == "ul") {
							$select = "select *, date_format(data, '%d/%m/%Y') data from conta where conta = 'Pendente' and data = '$dataAtual'";
						}

						//fazer o sql
						$sql = "$select";

							$palavra = "%$palavra%";
							$consulta = $pdo->prepare( $sql );
							//passar um parametro
							$consulta->bindParam( 1, $palavra );
							$consulta->bindParam( 2, $dt1 );
                            $consulta->bindParam( 3, $dt2 );
							$consulta->execute();
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td>Descrição</td>
									<td>Valor</td>	
									<td>Data</td>
									<td>Conta</td>		
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$descricao = $dados->descricao;
									$valor = $dados->valor;
									$data = $dados->data;
									$conta = $dados->conta;		

									echo "<tr>
												<td>$id</td>
												<td>$descricao</td>
												<td>R$ $valor</td>
												<td>$data</td>
												<td>$conta</td>
											</tr>";
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//funcao para perguntar se quer deletar


		$(document).ready( function(){
			//aplicar a dataTable na tabel
			$(".table").dataTable({
				"language": {
					"lengthMenu": "Mostrando _MENU_ registros por página",
					"zeroRecords": "Nenhum registro encontrado com os dados informados",
					"info": "Mostrando _PAGE_ de _PAGES_",
					"infoEmpty": "Nenhum dado",
					"infoFiltered": "(filtrado de _MAX_ total)",
					"search": "Busca: ",
					"paginate": {
						"previous": "Anterior",
						"next": "Próxima"
					}
				}
			});
		} ) 
	</script>
</body>
</html>









