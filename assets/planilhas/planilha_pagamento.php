<?php
	session_start();
	include_once('../conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Pagamento</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'tblpagamento.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
				
		
		$html .= '<tr>';
		$html .= '<td><b>Protocolo</b></td>';
		$html .= '<td><b>NFE</b></td>';
		$html .= '<td><b>Fatura</b></td>';
		$html .= '<td><b>Localizador</b></td>';
		$html .= '<td><b>Passageiro</b></td>';
		$html .= '<td><b>Valor Requerido</b></td>';
		$html .= '<td><b>Glosa</b></td>';
		$html .= '<td><b>Valor Autorizado</b></td>';
		$html .= '<td><b>Observações</b></td>';
		$html .= '<td><b>Situação</b></td>';
		
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_pagamento = 
		"SELECT * FROM tbl_pagamento 
		LEFT JOIN tbl_passagem
		ON tbl_pagamento.id_passagem = tbl_passagem.id_passagem
		LEFT JOIN tbl_pessoa
		ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
		ORDER BY tbl_pagamento.protocolo_pagamento"
		;

		$resultado_msg_pagamento = $conn->prepare($result_msg_pagamento);
		$resultado_msg_pagamento->execute();

		
		while($row_msg_pagamento = $resultado_msg_pagamento->fetch(PDO::FETCH_ASSOC)){
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_pagamento['protocolo_pagamento'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['nota_fiscal'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['fatura'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['localizador'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['nome_completo'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['total_fatura'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['glosa'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['valor_pago'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['obs_pagamento'].'</td>';
			$html .= '<td>'.$row_msg_pagamento['status_pagamento'].'</td>';
		}
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>