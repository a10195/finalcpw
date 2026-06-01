<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pageTitle = "Mensagens | Drift King";
include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">
                <i class="fas fa-envelope text-info"></i>
                Mensagens
            </h1>
            <p class="text-center text-muted mb-5">Conversas com outros membros da comunidade</p>

            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="search-card">
                    <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                    <h3 class="text-light">Nenhuma mensagem</h3>
                    <p class="text-muted mb-4">
                        Quando contactares vendedores ou outros membros, as conversas aparecerão aqui.
                    </p>
                    <a href="carros.php" class="btn-primary">
                        <i class="fas fa-car"></i>
                        Ver Carros
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>