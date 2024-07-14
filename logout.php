<?php
session_start();

// Encerra a sessão
session_unset();
session_destroy();

// Redireciona para a página de login ou outra página inicial
header("Location: login.php");
exit;
?>
