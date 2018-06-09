<?php
	include "menu.php";
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatorio Cliente</h4>
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
						$cpfcnpj = $_GET["cpfcnpj"];

						//para evitar um erro no sql deixa vazio o complemento  
						$complemento = "";
						if ( $cpfcnpj == "" ) {
							$complemento = "";
						} else {
						    $complemento = "where cpfcnpj = '$cpfcnpj'";
						}

						//$tipo pega do formulario o tipo.
						$tipo = $_GET["tipo"];

						/*verefica como veio do formulario tipo ( todosCliente ou debito ) para jogar na variavel $select para ser usada no $sql*/
						if ($tipo == "todosCliente") {
							$select = "select * from cliente $complemento";
						} else if ($tipo == "debito") {
							//select que vai ser feito para verificar clientes com debito
							$select = "";
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
									<td>Nome</td>
									<td>Nascimento</td>
									<td>RG</td>
									<td>CPF / CNPJ</td>
									<td>Telefone</td>		
									<td>Email</td>		
									<td>Rua</td>		
									<td>Nº</td>		
									<td>Bairro</td>
									<td>Cidade</td>		
									<td>Estado</td>		
									<td>CEP</td>		
									<td>Cadastrado</td>									
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$nome = $dados->nome;
									$nascimento = $dados->nascimento;
									$rg = $dados->rg;
									$cpfcnpj = $dados->cpfcnpj;
									$telefone = $dados->telefone;
									$email = $dados->email;
									$rua = $dados->rua;
									$numero = $dados->numero;
									$bairro = $dados->bairro;
									$cidade = $dados->cidade;
									$estado = $dados->estado;
									$cep = $dados->cep;
									$data_cadastro = $dados->data_cadastro;

									echo "<tr>
												<td>$id</td>
												<td>$nome</td>
												<td>$nascimento</td>
												<td>$rg</td>
												<td>$cpfcnpj</td>
												<td>$telefone</td>
												<td>$email</td>
												<td>$rua</td>
												<td>$numero</td>
												<td>$bairro</td>
												<td>$cidade</td>
												<td>$estado</td>
												<td>$cep</td>
												<td>$data_cadastro</td>
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









