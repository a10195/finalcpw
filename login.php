<?php
$pageTitle = "Login | Drift King";
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
        <div class="login-card">
            <div class="login-header">
                <img src="img/Drift_King-removebg-preview.png" alt="Logo">
                <h2>Loga na tua conta</h2>
                <p>Junta-te à comunidade Drift King</p>
            </div>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger">Email ou palavra-passe incorretos.</div>
            <?php endif; ?>
            <?php if (isset($_GET['registo']) && $_GET['registo'] === 'sucesso'): ?>
                <div class="alert alert-success">Conta criada com sucesso! Faz login.</div>
            <?php endif; ?>

            <form action="processar-login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control custom-input" placeholder="exemplo@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Palavra-passe</label>
                    <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Entrar</button>
            </form>

            <div class="login-footer">
                <p>Ainda não tens conta? <a href="register.php">Regista-te aqui</a></p>
                <a href="index.php" class="back-home">← Voltar ao Início</a>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>
