<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pageTitle = "Favoritos | Drift King";
include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">
                <i class="fas fa-heart text-danger"></i>
                Meus Favoritos
            </h1>
            <p class="text-center text-muted mb-5">Carros que guardaste para ver mais tarde</p>

            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="search-card">
                    <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                    <h3 class="text-light">Ainda não tens favoritos</h3>
                    <p class="text-muted mb-4">
                        Quando encontrares carros que gostas, clica no coração para os guardar aqui.
                    </p>
                    <a href="carros.php" class="btn-primary">
                        <i class="fas fa-search"></i>
                        Explorar Carros
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>