<?php
// Inicia a sessão
session_start();

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Se desejar, você pode limpar o cookie de sessão também. Isso irá destruir a sessão completamente.
// Nota: Isso destruirá a sessão, e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finaliza a sessão
session_destroy();

// Redireciona para a página de login ou para qualquer outra página desejada após o logout
header("Location: ../index.php");
exit();
?>
