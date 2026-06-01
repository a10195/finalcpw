<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Verificar campos vazios
    if (empty($email) || empty($password)) {
        header("Location: login.php?erro=campos_vazios");
        exit();
    }

    // Buscar utilizador com prepared statement
    $result = db_select("SELECT * FROM clientes WHERE email = ?", [$email]);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            // Segurança extra
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['idCliente'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_foto'] = $user['foto_perfil_url'];
            $_SESSION['user_tipo'] = $user['tipo_utilizador'] ?? 'cliente';

            header("Location: perfil.php");
            exit();
        }
    }

    header("Location: login.php?erro=dados_invalidos");
    exit();
}
?>
