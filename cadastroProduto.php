<?php 
	//incluir o menu
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			echo $permissao;
		}else{
			include "menufunc.php";
		}







$id = $nome = $descricao = $marca = $estoque = $valor = "";

if ( $_GET ) {
	$id = trim( $_GET["id"] );

	$sql = "select p.id,p.nome,p.descricao,p.id_marca,p.estoque,p.valor from produto p inner join marca m on ( m.id = p.id_marca ) where p.id = ? order by p.nome ";
		//"SELECT * FROM produto WHERE id = ? LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);


	$nome = $dados->nome;
	$descricao = $dados->descricao;
	$marca = $dados->id_marca;
	$estoque = $dados->estoque;
	$valor = $dados->valor;

	$valor = number_format( $valor, 2, "," , ".");

}
?>
<div id="wrapper">
	<div class="container-fluid">
		<!-- ___________________________________abrir_Painel______________________________________________ -->
		<div class="panel panel-edt">
			<div class="panel-heading panel-edt2">
				<h4 class="text-center panel-edt3">
					<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE PRODUTO</h4>
				</div>

				<div class="panel-body">
					<a href="listarMarca.php" class="btn btn-warning">
						<i class="glyphicon glyphicon-file"></i> Marcas
					</a>



					<a href="cadastroProduto.php" class="btn btn-default pull-right">
						<i class="fa fa-refresh"></i> Resetar Dados			
					</a>
					<br></br>
					<a href="listarProduto.php" class="btn btn-default pull-right">
						<i class="glyphicon glyphicon-search"></i> Listar Produtos
					</a>



					<div class="clearfix"></div>

					<form name="form1" method="post" action="salvarProduto.php" novalidate>
						<fieldset>
							<div class="col-md-1">
								<div class="control-group">
									<label for="id">ID</label>
									<div class="controls">
										<input type="text" readonly name="id" class="form-control" value="<?=$id;?>"></input>
									</div>
								</div>
							</div>
							<div class="col-md-11">
								<div class="control-group">
									<label for="nome">Nome do Produto: </label>
									<div class="controls">
										<input type="text" name="nome" class="form-control" value="<?=$nome;?>" 
										required data-validation-required-message="Preencha o nome do Produto"></input>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="control-group">
									<label for="descricao">Descrição: </label>
									<div class="controls">
										<input type="text" name="descricao" class="form-control" value="<?=$descricao;?>">
									</input>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="control-group">
								<label for="estoque">Estoque: </label>
								<div class="controls">
									<input type="number" name="estoque" class="form-control" required data-validation-required-message="Preencha a quantidade de estoque" value="<?=$estoque;?>">
								</input>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="control-group">
							<label for="id_marca">Selecione uma Marca: </label>
							<div class="controls">
								<select name="id_marca" id="id_marca" class="form-control" required data-validation-required-message="Selecione uma Marca">
									<option value="">Selecione uma Marca</option>
									<?php
							//selecionar as categorias
									$sql = "select * from marca order by marca";
							//preparar o sql e execultar
									$consulta = $pdo->prepare($sql);
									$consulta->execute();

									while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

										$id = $dados->id;
										$marca2 = $dados->marca;

										echo "<option value='$id'>$marca2</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="control-group">
							<label for="valor">Valor: </label>
							<div class="controls">
								<input type="text" name="valor" class="form-control valor" value="<?=$valor;?>">
								
						</div>
					</div>
				</div>


				<script type="text/javascript">
					$("#id_marca").val(<?=$marca;?>);
				</script>
				<br>
			</fieldset>
			<button type="submit" class="btn center-block btn-success btn-lg">Salvar Dados</button>
		</form>
	</div>
</div>
</div>		


<!-- ___________________________________fecha_Painel______________________________________________ -->



