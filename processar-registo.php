<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $foto_perfil = trim($_POST['foto_perfil']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Verificar campos vazios
    if (empty($nome) || empty($email) || empty($pass) || empty($confirm_pass)) {
        header("Location: register.php?erro=campos_vazios");
        exit();
    }

    // Passwords diferentes
    if ($pass !== $confirm_pass) {
        header("Location: register.php?erro=passwords_diferentes");
        exit();
    }

    // Verificar se email já existe
    $check = db_select("SELECT idCliente FROM clientes WHERE email = ?", [$email]);

    if ($check && $check->num_rows > 0) {
        header("Location: register.php?erro=email_existe");
        exit();
    }

    // Criar hash seguro
    $password_encriptada = password_hash($pass, PASSWORD_DEFAULT);

    // Inserir utilizador
    $insert = db_execute(
        "INSERT INTO clientes (nome, email, password, foto_perfil_url) VALUES (?, ?, ?, ?)",
        [$nome, $email, $password_encriptada, $foto_perfil]
    );

    if ($insert) {
        header("Location: login.php?registo=sucesso");
        exit();
    } else {
        header("Location: register.php?erro=erro_bd");
        exit();
    }
}
?>
