<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');
$pageTitle = "Configurações | Drift King";

$id = $_SESSION['user_id'];

// Processar atualizações
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $nif = mysqli_real_escape_string($conn, $_POST['nif']);
    $foto_url = mysqli_real_escape_string($conn, $_POST['foto_url']);
    
    $sql = "UPDATE clientes SET nome = '$nome', telefone = '$telefone', nif = '$nif', foto_perfil_url = '$foto_url' WHERE idCliente = $id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['user_nome'] = $nome;
        $success = "Perfil atualizado com sucesso!";
    } else {
        $error = "Erro ao atualizar perfil: " . mysqli_error($conn);
    }
}

// Buscar dados atuais
$sql = "SELECT * FROM clientes WHERE idCliente = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="search-card">
                <div class="text-center mb-4">
                    <h1 class="section-title mb-2">
                        <i class="fas fa-cog text-warning"></i>
                        Configurações do Perfil
                    </h1>
                    <p class="text-muted">Atualiza as tuas informações pessoais</p>
                </div>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="fade-in-up">
                    <!-- Foto de Perfil -->
                    <div class="text-center mb-4">
                        <img src="<?php echo htmlspecialchars($user['foto_perfil_url'] ?: 'https://via.placeholder.com/120x120/333/fff?text=Avatar'); ?>" 
                             alt="Avatar" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover; border: 3px solid var(--primary-orange);">
                        <div>
                            <label class="form-label text-light">URL da Foto de Perfil</label>
                            <input type="url" name="foto_url" class="form-control" 
                                   value="<?php echo htmlspecialchars($user['foto_perfil_url'] ?? ''); ?>"
                                   placeholder="https://exemplo.com/foto.jpg">
                            <small class="text-muted">Deixa em branco para usar avatar padrão</small>
                        </div>
                    </div>

                    <!-- Informações Pessoais -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text" name="nome" class="form-control" 
                                   value="<?php echo htmlspecialchars($user['nome']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" 
                                   value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                            <small class="text-muted">O email não pode ser alterado</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="tel" name="telefone" class="form-control" 
                                   value="<?php echo htmlspecialchars($user['telefone'] ?? ''); ?>"
                                   placeholder="+351 912 345 678">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIF</label>
                            <input type="text" name="nif" class="form-control" 
                                   value="<?php echo htmlspecialchars($user['nif'] ?? ''); ?>"
                                   placeholder="123456789">
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="text-center">
                        <button type="submit" class="btn-primary me-3">
                            <i class="fas fa-save"></i>
                            Guardar Alterações
                        </button>
                        <a href="perfil.php" class="btn-outline">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                    </div>
                </form>

                <hr style="border-color: var(--border-color); margin: 3rem 0;">

                <!-- Alterar Password -->
                <div class="text-center">
                    <h4 class="text-light mb-3">
                        <i class="fas fa-lock text-warning"></i>
                        Segurança
                    </h4>
                    <p class="text-muted mb-3">Alterar palavra-passe ou eliminar conta</p>
                    
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <button class="btn-outline" onclick="alterarPassword()">
                            <i class="fas fa-key"></i>
                            Alterar Password
                        </button>
                        <button class="btn btn-outline-danger" onclick="eliminarConta()">
                            <i class="fas fa-trash"></i>
                            Eliminar Conta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function alterarPassword() {
    alert('Funcionalidade de alterar password em desenvolvimento');
}

function eliminarConta() {
    if (confirm('Tens a certeza que queres eliminar a tua conta? Esta ação não pode ser desfeita.')) {
        alert('Funcionalidade de eliminar conta em desenvolvimento');
    }
}
</script>

<?php include('footer.php'); ?>