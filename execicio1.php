<!DOCTYPE html>
<html>
<head>
	<title>Exercício 01: Produtos e Preços</title>
</head>
<body>
	<h1>Exercício 01: Produtos e Preços</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<?php for ($i = 0; $i < 5; $i++) { ?>
			<label for="produto-<?php echo $i; ?>">Produto <?php echo $i + 1; ?>:</label>
			<input type="text" id="produto-<?php echo $i; ?>" name="produtos[]" required><br>
			<label for="preco-<?php echo $i; ?>">Preço do Produto <?php echo $i + 1; ?>:</label>
			<input type="number" id="preco-<?php echo $i; ?>" name="precos[]" required><br><br>
		<?php } ?>
		<input type="submit" value="Enviar">
	</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$produtos = $_POST['produtos'];
		$precos = $_POST['precos'];
		
		// Função para contar produtos com preço inferior a R$50,00
		function contarProdutosBaratos($precos) {
			$quantidade = 0;
			foreach ($precos as $preco) {
				if ($preco < 50) {
					$quantidade++;
				}
			}
			return $quantidade;
		}
		
		// Função para encontrar produtos com preço entre R$50,00 e R$100,00
		function encontrarProdutosMedios($produtos, $precos) {
			$produtosMedios = array();
			foreach ($precos as $indice => $preco) {
				if ($preco >= 50 && $preco <= 100) {
					$produtosMedios[] = $produtos[$indice];
				}
			}
			return $produtosMedios;
		}
		
		// Função para calcular a média dos preços dos produtos com preço superior a R$100,00
		function calcularMediaPrecoAlto($precos) {
			$soma = 0;
			$contador = 0;
			foreach ($precos as $preco) {
				if ($preco > 100) {
					$soma += $preco;
					$contador++;
				}
			}
			return $soma / $contador;
		}
		
		// Calcular e exibir os resultados
		echo "<h2>Resultados:</h2>";
		echo "<p>Quantidade de produtos com preço inferior a R$50,00: " . contarProdutosBaratos($precos) . "</p>";
		$produtosMedios = encontrarProdutosMedios($produtos, $precos);
		echo "<p>Produtos com preço entre R$50,00 e R$100,00: " . implode(', ', $produtosMedios) . "</p>";
		echo "<p>Média dos preços dos produtos com preço superior a R$100,00: " . calcularMediaPrecoAlto($precos) . "</p>";
	}
	?>
</body>
</html>