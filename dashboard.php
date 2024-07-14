<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include_once('config.php'); // Inclui o arquivo de configuração do banco de dados

// Número de registros por página
$records_per_page = 10;

// Determina a página atual
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Consulta SQL para contar o número total de registros
$total_query = "SELECT COUNT(*) FROM mensagens";
$total_result = mysqli_query($conexao, $total_query);
$total_rows = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_rows / $records_per_page);

// Consulta SQL para selecionar os registros com limite e offset
$query = "SELECT id, nome, email, telefone, endereco, mensagem, frequencia, data_envio FROM mensagens ORDER BY data_envio DESC LIMIT $records_per_page OFFSET $offset";
$resultado = mysqli_query($conexao, $query);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - EAT BETTER DELIVERY</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="estilo.css"/>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'banner.php'; ?>

    <div class="dashboard">
        <h1>Painel de Controle</h1>

        <?php
        // Verifica se há registros retornados pela consulta
        if (mysqli_num_rows($resultado) > 0) {
            echo "<h2>Dados das Mensagens</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Mensagem</th><th>Frequência</th><th>Data de Envio</th></tr>";

            // Loop através dos resultados para exibir cada mensagem
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["endereco"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["mensagem"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["frequencia"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["data_envio"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Botão de exportação para XML
            echo "<form action='exportar_xml.php' method='post'>";
            echo "<input type='submit' value='Exportar para XML'>";
            echo "</form>";

            // Links de Paginação
            echo "<div class='pagination'>";
            for ($page = 1; $page <= $total_pages; $page++) {
                if ($page == $current_page) {
                    echo "<span class='current-page'>$page</span> ";
                } else {
                    echo "<a href='dashboard.php?page=" . $page . "'>$page</a> ";
                }
            }
            echo "</div>";
        } else {
            echo "<p>Nenhuma mensagem encontrada.</p>";
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
