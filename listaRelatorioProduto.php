<?php
	include "menu.php";
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatorio Produto</h4>
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

						//buscar a marca para jogar no select
						$id_marca = $_GET["id_marca"];

						//para evitar um erro no sql deixa vazio o complemento  
						$complemento = "";
						if ( $id_marca == "" ) {
							$complemento = "";
						} else {
						    $complemento = "and marca = '$id_marca'";
						}

						//$tipo pega do formulario o tipo recebendo se e todos produtos, fora de est e etc.
						$tipo = $_GET["tipo"];

						/*verefica como veio do formulario tipo ( tp,em,fe ) para jogar na variavel $select para ser usada no $sql*/
						if ($tipo == "tp") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) where p.nome like ? $complemento";
						} else if ($tipo == "em") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) where p.nome like ? and estoque = '1' $complemento";
						} else if ($tipo == "fe") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) where p.nome like ? and estoque = '0' $complemento";
						} else if ($tipo == "mv") {
							$select = "select p.id, p.nome, sum(p.estoque) estoque, p.valor, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) group by nome order by estoque desc";
						}

						//fazer o sql
						$sql = "$select";

							$palavra = "%$palavra%";
							$consulta = $pdo->prepare( $sql );
							$consulta->bindParam( 1, $palavra );
							$consulta->execute();
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td>Nome do Produto</td>
									<td>Estoque</td>
									<td>Marca</td>
									<td>Valor</td>					
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$nome = $dados->nome;
									$marca = $dados->marca;
									$estoque = $dados->estoque;
									$valor = $dados->valor;

									echo "<tr>
												<td>$id</td>
												<td>$nome</td>
												<td>$estoque</td>
												<td>$marca</td>
												<td>R$$valor</td>
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









