<?php
// Script para gerar hash de password e testar login

echo "<h2>Gerador de Hash de Password</h2>";

// Gerar hash para Admin@2024
$password = "Admin@2024";
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h3>Password: Admin@2024</h3>";
echo "<p><strong>Hash gerado:</strong><br>";
echo "<textarea style='width:100%; height:60px;'>$hash</textarea></p>";

// Testar verificação
$teste = password_verify("Admin@2024", $hash);
echo "<p><strong>Teste de verificação:</strong> " . ($teste ? "✅ OK" : "❌ FALHOU") . "</p>";

echo "<hr>";

// Verificar se a conta existe na BD
include('db.php');

echo "<h3>Verificar Conta na Base de Dados</h3>";

$result = mysqli_query($conn, "SELECT * FROM funcionarios WHERE email = 'admin@driftking.pt'");

if (mysqli_num_rows($result) > 0) {
    $funcionario = mysqli_fetch_assoc($result);
    echo "<p>✅ <strong>Conta encontrada!</strong></p>";
    echo "<ul>";
    echo "<li><strong>ID:</strong> " . $funcionario['idfuncionario'] . "</li>";
    echo "<li><strong>Nome:</strong> " . $funcionario['nome'] . "</li>";
    echo "<li><strong>Email:</strong> " . $funcionario['email'] . "</li>";
    echo "<li><strong>Hash na BD:</strong><br><textarea style='width:100%; height:60px;'>" . $funcionario['password'] . "</textarea></li>";
    echo "</ul>";
    
    // Testar se a password bate
    $passwordBD = $funcionario['password'];
    $testeLogin = password_verify("Admin@2024", $passwordBD);
    
    echo "<p><strong>Teste de login com password 'Admin@2024':</strong> ";
    echo $testeLogin ? "✅ FUNCIONA" : "❌ NÃO FUNCIONA";
    echo "</p>";
    
    if (!$testeLogin) {
        echo "<div style='background: #ffebee; padding: 15px; border-left: 4px solid #f44336;'>";
        echo "<h4>⚠️ Problema Detectado!</h4>";
        echo "<p>O hash na base de dados não corresponde à password 'Admin@2024'.</p>";
        echo "<p><strong>Solução:</strong> Execute este SQL no phpMyAdmin:</p>";
        echo "<textarea style='width:100%; height:100px;'>";
        echo "UPDATE funcionarios SET password = '$hash' WHERE email = 'admin@driftking.pt';";
        echo "</textarea>";
        echo "</div>";
    }
    
} else {
    echo "<p>❌ <strong>Conta NÃO encontrada!</strong></p>";
    echo "<p>Execute este SQL no phpMyAdmin para criar a conta:</p>";
    echo "<textarea style='width:100%; height:150px;'>";
    echo "INSERT INTO funcionarios (nome, email, password, telefone) VALUES (\n";
    echo "    'Administrador Drift King',\n";
    echo "    'admin@driftking.pt',\n";
    echo "    '$hash',\n";
    echo "    '+351 912 000 000'\n";
    echo ");";
    echo "</textarea>";
}

echo "<hr>";
echo "<h3>Criar Nova Conta</h3>";
echo "<form method='POST'>";
echo "<p><label>Password: <input type='text' name='nova_password' value='MinhaPassword123'></label></p>";
echo "<p><button type='submit' name='gerar'>Gerar Hash</button></p>";
echo "</form>";

if (isset($_POST['gerar'])) {
    $nova_pass = $_POST['nova_password'];
    $novo_hash = password_hash($nova_pass, PASSWORD_DEFAULT);
    echo "<p><strong>Password:</strong> $nova_pass</p>";
    echo "<p><strong>Hash:</strong><br><textarea style='width:100%; height:60px;'>$novo_hash</textarea></p>";
}

echo "<hr>";
echo "<p><a href='admin-login.php'>← Voltar ao Login Admin</a></p>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #f5f5f5;
}
h2, h3 {
    color: #333;
}
textarea {
    font-family: monospace;
    font-size: 12px;
    padding: 10px;
}
</style>