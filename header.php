<?php
// Iniciar sessão no topo antes de qualquer output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Drift King'; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/modern-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/perfil.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg modern-navbar fixed-top">
        <div class="container-fluid navbar-container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="img/Drift_King-removebg-preview.png" alt="Drift King" width="45" height="45" class="me-2">
                <span class="fw-bold text-light">Drift King</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-light"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light fw-500 <?php echo (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">
                            <i class="fas fa-home me-1"></i>Início
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-500" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-car me-1"></i>Marketplace
                        </a>
                        <ul class="dropdown-menu bg-dark border-secondary">
                            <li><a class="dropdown-item text-light" href="carros.php">
                                <i class="fas fa-car-side me-2"></i>Todos os Carros
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pesquisa.php?categoria=drift">
                                <i class="fas fa-fire me-2"></i>Carros de Drift
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pesquisa.php?categoria=tuning">
                                <i class="fas fa-wrench me-2"></i>Carros Tuning
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pesquisa.php?categoria=classico">
                                <i class="fas fa-gem me-2"></i>Clássicos JDM
                            </a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-500" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-puzzle-piece me-1"></i>Peças
                        </a>
                        <ul class="dropdown-menu bg-dark border-secondary">
                            <li><a class="dropdown-item text-light" href="bodykits.php">
                                <i class="fas fa-paint-brush me-2"></i>Bodykits
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pecas.php?categoria=motor">
                                <i class="fas fa-cog me-2"></i>Peças de Motor
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pecas.php?categoria=suspensao">
                                <i class="fas fa-compress-arrows-alt me-2"></i>Suspensão
                            </a></li>
                            <li><a class="dropdown-item text-light" href="pecas.php?categoria=rodas">
                                <i class="fas fa-circle me-2"></i>Jantes & Pneus
                            </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light fw-500 <?php echo (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) == 'eventos.php') ? 'active' : ''; ?>" href="eventos.php">
                            <i class="fas fa-calendar-alt me-1"></i>Eventos
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-500" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-info-circle me-1"></i>Comunidade
                        </a>
                        <ul class="dropdown-menu bg-dark border-secondary">
                            <li><a class="dropdown-item text-light" href="noticias.php">
                                <i class="fas fa-newspaper me-2"></i>Notícias
                            </a></li>
                            <li><a class="dropdown-item text-light" href="sobre.php">
                                <i class="fas fa-users me-2"></i>Sobre Nós
                            </a></li>
                        </ul>
                    </li>
                </ul>

                <!-- User Actions -->
                <div class="d-flex align-items-center gap-2">
                    <?php
                    if (isset($_SESSION['user_id'])):
                    ?>
                        <!-- Logged In User -->
                        <div class="dropdown">
                            <a class="btn btn-outline-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-plus me-1"></i>Vender
                            </a>
                            <ul class="dropdown-menu bg-dark border-secondary">
                                <li><a class="dropdown-item text-light" href="anunciar-carro.php">
                                    <i class="fas fa-car me-2"></i>Anunciar Carro
                                </a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i><?php echo htmlspecialchars($_SESSION['user_nome']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                                <li><a class="dropdown-item text-light" href="perfil.php">
                                    <i class="fas fa-user me-2"></i>Meu Perfil
                                </a></li>
                                <li><a class="dropdown-item text-light" href="meus-anuncios.php">
                                    <i class="fas fa-list me-2"></i>Meus Anúncios
                                </a></li>
                                <li><a class="dropdown-item text-light" href="favoritos.php">
                                    <i class="fas fa-heart me-2"></i>Favoritos
                                </a></li>
                                <li><a class="dropdown-item text-light" href="mensagens.php">
                                    <i class="fas fa-envelope me-2"></i>Mensagens
                                </a></li>
                                <li><a class="dropdown-item text-light" href="configuracoes.php">
                                    <i class="fas fa-cog me-2"></i>Configurações
                                </a></li>
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i>Sair
                                </a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Guest User -->
                        <a href="login.php" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i>Entrar
                        </a>
                        <a href="register.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus me-1"></i>Registar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <style>
    .modern-navbar {
        background: rgba(15, 15, 15, 0.98) !important;
        backdrop-filter: blur(15px);
        border-bottom: 1px solid #404040;
        z-index: 9999;
    }
    
    .navbar-nav .nav-link:hover {
        color: #ff6b35 !important;
    }
    
    .navbar-nav .nav-link.active {
        color: #ff6b35 !important;
    }
    
    .dropdown-menu {
        background: #1a1a1a !important;
        border: 1px solid #404040 !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
    }
    
    .dropdown-item:hover {
        background: #2d2d2d !important;
        color: #ff6b35 !important;
    }
    
    .btn-primary {
        background: #ff6b35 !important;
        border-color: #ff6b35 !important;
    }
    
    .btn-primary:hover {
        background: #e55a2b !important;
        border-color: #e55a2b !important;
    }
    
    .btn-outline-light:hover {
        background: #ff6b35 !important;
        border-color: #ff6b35 !important;
    }
    </style>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.modern-navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(15, 15, 15, 0.99)';
            } else {
                navbar.style.background = 'rgba(15, 15, 15, 0.98)';
            }
        });
    </script>
</body>
</html>