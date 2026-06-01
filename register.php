<?php
$pageTitle = "Registo | Drift King";
include('header.php');
?>

<style>
    .login-page {
        min-height: 100vh;
        background: url('img/fundo.jpg') no-repeat center center fixed;
        background-size: cover;
    }
</style>

<main class="login-page">
    <div class="login-overlay">
        <div class="login-card" style="max-width: 500px;">
            <div class="login-header">
                <img src="img/Drift_King-removebg-preview.png" alt="Logo">
                <h2>Cria a tua conta</h2>
                <p>Junta-te à comunidade Drift King</p>
            </div>

            <?php if (isset($_GET['erro'])): ?>
                <?php if ($_GET['erro'] === 'passwords_diferentes'): ?>
                    <div class="alert alert-danger">As palavras-passe não coincidem.</div>
                <?php elseif ($_GET['erro'] === 'email_existe'): ?>
                    <div class="alert alert-danger">Este email já está registado.</div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="processar-registo.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="nome" class="form-control custom-input" placeholder="O teu nome" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control custom-input" placeholder="exemplo@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto de Perfil *</label>
                    <input type="file" name="foto_perfil" class="form-control custom-input" accept="image/*" required>
                    <small class="text-muted">Faz upload da tua foto de perfil (obrigatório)</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Palavra-passe</label>
                        <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirmar Senha</label>
                        <input type="password" name="confirm_password" class="form-control custom-input" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms" style="font-size: 0.85rem; color: #9ca3af;">
                        Aceito os <a href="#" class="forgot-link">Termos e Condições</a>
                    </label>
                </div>

                <button type="submit" class="btn-login">Criar Conta</button>
            </form>

            <div class="login-footer">
                <p>Já tens conta? <a href="login.php">Faz login aqui</a></p>
                <a href="index.php" class="back-home">← Voltar ao Início</a>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>
