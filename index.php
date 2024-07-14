<?php
$sucesso = false;
$erro = false;

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $mensagem = $_POST['mensagem'];
    $frequencia = $_POST['frequencia'];

    // Evitar SQL injection usando prepared statements
    $stmt = $conexao->prepare("INSERT INTO mensagens (nome, email, telefone, endereco, mensagem, frequencia) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $endereco, $mensagem, $frequencia);
    $result = $stmt->execute();

    // Verifica se o registro foi inserido com sucesso
    if ($result) {
        $sucesso = true;
    } else {
        $erro = true;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>EAT BETTER DELIVERY</title>
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

    <div class="boxformulario">
        <div class="formulario">
            <h2>Quer receber uma cesta de legumes, verduras e frutas frescas selecionadas?</h2>
            <form action="index.php" method="POST">
                <input type="text" id="nome" name="nome" required placeholder="Seu nome">
                <div class="form-group">
                    <input type="email" id="email" name="email" required placeholder="Seu e-mail">
                    <input type="tel" id="telefone" name="telefone" placeholder="Seu telefone">
                </div>
                <input type="text" id="endereco" name="endereco" placeholder="Seu endereço">
                <textarea id="mensagem" name="mensagem" rows="1" draggable="false" required placeholder="Alimentos que não gostaria de receber"></textarea>
                <p>Tenho interesse em receber cestas com a frequência</p>
                <div class="radio-horizontal">
                    <label>
                        <input type="radio" class="frequencia" id="semanal" name="frequencia" value="semanal">Semanal
                    </label>
                    <label>
                        <input type="radio" class="frequencia" id="quinzenal" name="frequencia" value="quinzenal">Quinzenal
                    </label>
                    <label>
                        <input type="radio" class="frequencia" id="mensal" name="frequencia" value="mensal">Mensal
                    </label>
                </div>
                <input type="submit" name="submit" value="Enviar">
            </form>

            <?php if ($sucesso): ?>
                <p class="success-message">Mensagem enviada com sucesso!</p>
            <?php elseif ($erro): ?>
                <p class="error-message">Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente mais tarde.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="boxreceitas">
        <h2>Receitas</h2>

        <a href="sopadetomate.php" class="receita1">
            <div class="imagemreceita1">
                <img src="imagens/SOPATOMATE.jpg" alt="Imagem de Exemplo" class="receitaimg">
            </div>
            <div class="inforeceita1">
                <h2>Sopa de Tomate</h2>
                <p>A sopa de tomate é um prato delicioso, nutritivo e versátil que agrada paladares de todas as idades. É perfeita para dias frios, como um acompanhamento leve ou até mesmo como uma refeição completa.</p>
            </div>
        </a>

        <a href="ratatouille.php" class="receita2">
            <div class="imagemreceita2">
                <img src="imagens/ratatouille.jpg" alt="Imagem de Exemplo" class="receitaimg">
            </div>
            <div class="inforeceita2">
                <h2>Ratatouille</h2>
                <p>O Ratatouille é um prato francês clássico que combina a beleza vibrante dos legumes mediterrâneos com o sabor rico e aconchegante de um refogado caseiro.</p>
            </div>
        </a>

        <a href="shakshuka.php" class="receita3">
            <div class="imagemreceita3">
                <img src="imagens/SHAKSHUKA.jpg" alt="Imagem de Exemplo" class="receitaimg">
            </div>
            <div class="inforeceita3">
                <h2>Shakshuka</h2>
                <p>A Shakshuka é um prato tradicional do Oriente Médio que combina ovos cozidos em um molho rico e saboroso de tomate, pimentão e especiarias.</p>
            </div>
        </a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
