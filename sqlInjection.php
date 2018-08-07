<?php

/*
 * sqlInjection.php
 * 
 * Função criada para remover palavras que sao restritas ao SQL e MySQL, impedindo que o usuário
 * faça alguma tentativa de Injection via POST. 
 * A função também pode ser utilizada também para outros métodos, como exemplo; GET
 *
 * Autor: Guilherme Ameida
 * Site: http://www.guilhermeal.com.br
 * GitHub: guilhermeal
 */

function sqlInjection($texto){

	// Lista de palavras para procurar
	$check[1] = chr(34); // símbolo "
	$check[2] = chr(39); // símbolo '
	$check[3] = chr(92); // símbolo /
	$check[4] = chr(96); // símbolo  
	$check[5] = "drop table";
	$check[6] = "update";
	$check[7] = "alter table";
	$check[8] = "drop database";	
	$check[9] = "drop";
	$check[10] = "select";
	$check[11] = "delete";
	$check[12] = "insert";
	$check[13] = "alter";
	$check[14] = "destroy";
	$check[15] = "table";
	$check[16] = "database";
	$check[17] = "union";
	$check[18] = "TABLE_NAME";
	$check[19] = "1=1";
	$check[20] = 'or 1';
	$check[21] = 'exec';
	$check[22] = 'INFORMATION_SCHEMA';
	$check[23] = 'like';
	$check[24] = 'COLUMNS';
	$check[25] = 'into';
	$check[26] = 'VALUES';

	// Cria se as variáveis $y e $x para controle no WHILE que fará a busca e substituição
	$y = 1;
	$x = sizeof($check);
	// Faz-se o WHILE, procurando alguma das palavras especificadas acima, caso encontre alguma delas, o script substituirá por um espaço em branco " ".
	while($y <= $x){
		   $target = strpos($texto,$check[$y]);
			if($target !== false){
				$texto = str_replace($check[$y], "", $texto);
			}
		$y++;
	}
	// Retorna a variável limpa sem perigos de SQL Injection
	return comandos($texto);
} 


/*
 * Voce deve utilizar essa função antes de passar para o comando para o banco de dados.
 * Se estar usando POST ou GET você deve chamar a função para retornar a varivável limpa.
 * 
 * Exemplo simples:
 * PHP>_  $novoNome = sqlInjection($_POST['nome']);
 * SQL>_  SELECT * FROM pessoas WHERE nome LIKE '% $novoNome %';
 *
 */
 


?>
