<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>EAT BETTER DELIVERY</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="estilo.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'banner.php'; ?>

    <div class="login">
        <div class="login-container">

            <form method="post" action="processamento.php">
            <h1>Login</h1>
                <input type="text" name="username" placeholder="Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="submit" value="Entrar">
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>


