<?php
include_once('config.php'); // Inclui o arquivo de configuração do banco de dados

// Consulta SQL para selecionar todas as mensagens
$query = "SELECT id, nome, email, telefone, endereco, mensagem, frequencia FROM mensagens";
$resultado = mysqli_query($conexao, $query);

if (!$resultado) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}

// Cria um objeto SimpleXMLElement para gerar o XML
$xml = new SimpleXMLElement('<mensagens></mensagens>');

// Itera sobre os resultados da consulta para adicionar cada mensagem ao XML
while ($row = mysqli_fetch_assoc($resultado)) {
    $mensagem = $xml->addChild('mensagem');
    $mensagem->addChild('id', $row['id']);
    $mensagem->addChild('nome', htmlspecialchars($row['nome']));
    $mensagem->addChild('email', htmlspecialchars($row['email']));
    $mensagem->addChild('telefone', htmlspecialchars($row['telefone']));
    $mensagem->addChild('endereco', htmlspecialchars($row['endereco']));
    $mensagem->addChild('mensagem', htmlspecialchars($row['mensagem']));
    $mensagem->addChild('frequencia', htmlspecialchars($row['frequencia']));
}

// Define o cabeçalho para indicar que o conteúdo é um XML para download
header('Content-Disposition: attachment; filename="mensagens.xml"');
header('Content-Type: text/xml');
echo $xml->asXML();

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
