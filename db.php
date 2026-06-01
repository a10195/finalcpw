<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "driftking";

// Criar ligação com MySQLi (modo seguro)
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar erros
if ($conn->connect_error) {
    die("Erro na ligação: " . $conn->connect_error);
}

// Definir charset para evitar problemas com acentos
$conn->set_charset("utf8mb4");

/**
 * Função segura para SELECT com prepared statements
 * Exemplo de uso:
 * $result = db_select("SELECT * FROM users WHERE email = ?", [$email]);
 */
function db_select($query, $params = []) {
    global $conn;

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Erro na query: " . $conn->error);
    }

    if (!empty($params)) {
        $types = str_repeat("s", count($params)); // todos como string
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result();
}

/**
 * Função segura para INSERT/UPDATE/DELETE
 * Exemplo:
 * db_execute("INSERT INTO users (email, pass) VALUES (?, ?)", [$email, $hash]);
 */
function db_execute($query, $params = []) {
    global $conn;

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Erro na query: " . $conn->error);
    }

    if (!empty($params)) {
        $types = str_repeat("s", count($params));
        $stmt->bind_param($types, ...$params);
    }

    return $stmt->execute();
}
