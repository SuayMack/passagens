<?php
	session_start();

	include_once('../conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Passagens</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'tblpassagens.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
				
		
		$html .= '<tr>';
		$html .= '<td><b>Passageiro</b></td>';
		$html .= '<td><b>Localizador</b></td>';
		$html .= '<td><b>SEI Compra</b></td>';
		$html .= '<td><b>Origem</b></td>';
		$html .= '<td><b>Destino</b></td>';
		$html .= '<td><b>Ida</b></td>';
		$html .= '<td><b>Retorno</b></td>';
		$html .= '<td><b>Tarifa R$</b></td>';
		$html .= '<td><b>Taxa R$</b></td>';
		$html .= '<td><b>Desc R$</b></td>';
		$html .= '<td><b>Multi</b></td>';
		$html .= '<td><b>Observações</b></td>';
		$html .= '<td><b>Situação</b></td>';
		
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_passagens = 
			"SELECT * FROM tbl_passagem
			LEFT JOIN tbl_pessoa
			ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
			LEFT JOIN tbl_item
			ON tbl_passagem.id_item = tbl_item.id_item
			LEFT JOIN tbl_viagem
			ON tbl_passagem.id_viagem = tbl_viagem.id_viagem
			ORDER BY tbl_pessoa.nome_completo"
		;

		$resultado_msg_passagens = $conn->prepare($result_msg_passagens);
		$resultado_msg_passagens->execute();

		
		while($row_msg_passagens = $resultado_msg_passagens->fetch(PDO::FETCH_ASSOC)){

			$tarifa = $row_msg_passagens['tarifa_voucher'];
			$taxas = $row_msg_passagens['taxas_voucher'];
			$desconto = $row_msg_passagens['desconto_valor'];



			$html .= '<tr>';
			$html .= '<td>'.$row_msg_passagens['nome_completo'].'</td>';
			$html .= '<td>'.$row_msg_passagens['localizador'].'</td>';
			$html .= '<td>'.$row_msg_passagens['protocolo_compra'].'</td>';
			$html .= '<td>'.$row_msg_passagens['origem'].'</td>';
			$html .= '<td>'.$row_msg_passagens['destino'].'</td>';
			$html .= '<td>'.$row_msg_passagens['data_ida'].'</td>';
			$html .= '<td>'.$row_msg_passagens['data_retorno'].'</td>';
			$html .= '<td>R$ '.number_format($tarifa, 2,",",".").'</td>';
			$html .= '<td>R$ '.number_format($taxas, 2,",",".").'</td>';
			$html .= '<td>R$ '.number_format($desconto, 2,",",".").'</td>';
			$html .= '<td>'.$row_msg_passagens['multdestino'].'</td>';
			$html .= '<td>'.$row_msg_passagens['obs_passagem'].'</td>';
			$html .= '<td>'.$row_msg_passagens['status_passagem'].'</td>';
			$html .= '</tr>';
			;
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