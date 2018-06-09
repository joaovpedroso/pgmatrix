<?php

	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			echo $permissao;
		}else{
			include "menufunc.php";
		}

	//verificar se foi post

		//salvar no banco de dados
		$id = trim ( $_POST["id"] );
		$nome = trim ( $_POST["nome"] );
		$descricao = trim ( $_POST["descricao"] );
		$id_marca = trim ( $_POST["id_marca"] );
		$estoque = trim ($_POST["estoque"]);
		$valor = trim($_POST["valor"]);
		//gravar no manco tudo em maiusculo
		$descricao = strtoupper($descricao);
		$nome = strtoupper($nome);
		$valor = formatarvalor($valor);

		if ( empty ( $id ) ) { 
			//inserir
			$sql = "insert into produto (nome, descricao, id_marca, estoque, valor)
			values (?, ?, ?, ?, ?)";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $id_marca );
			$consulta->bindParam( 4, $estoque);
			$consulta->bindParam( 5, $valor);
		} else {
			//atualizar

			$sql = "update produto set nome = ?, descricao = ?, id_marca = ?,estoque = ?, valor = ? where id = ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $id_marca );
			$consulta->bindParam( 4, $estoque);
			$consulta->bindParam( 5, $valor );
			$consulta->bindParam( 6, $id );

		}


		if ( $consulta->execute() ) {
			echo "<script>alert('Registro salvo');location.href='listarProduto.php';</script>";
		} else {
			echo "<script>alert('Erro ao salvar');history.back();</script>";
		}
	




