<footer style="background: var(--secondary-dark); border-top: 1px solid var(--border-color); margin-top: 4rem;">
    <div class="container py-5">
        <div class="row">
            <!-- Brand Section -->
            <div class="col-lg-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="img/Drift_King-removebg-preview.png" alt="Drift King" width="40" class="me-2">
                    <h5 class="text-light mb-0">Drift King</h5>
                </div>
                <p class="text-muted mb-3" style="color: var(--text-muted) !important;">
                    A maior plataforma de carros de drift em Portugal. 
                    Compra, vende e conecta-te com a comunidade drift.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-muted hover-primary" style="color: var(--text-muted) !important;">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-muted hover-primary" style="color: var(--text-muted) !important;">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-muted hover-primary" style="color: var(--text-muted) !important;">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                    <a href="#" class="text-muted hover-primary" style="color: var(--text-muted) !important;">
                        <i class="fab fa-tiktok fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-light mb-3" style="color: var(--text-light) !important;">Marketplace</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="carros.php" class="footer-link">Todos os Carros</a></li>
                    <li class="mb-2"><a href="pesquisa.php?categoria=drift" class="footer-link">Carros de Drift</a></li>
                    <li class="mb-2"><a href="bodykits.php" class="footer-link">Bodykits</a></li>
                    <li class="mb-2"><a href="pecas.php" class="footer-link">Peças</a></li>
                </ul>
            </div>

            <!-- Community -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-light mb-3" style="color: var(--text-light) !important;">Comunidade</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="eventos.php" class="footer-link">Eventos</a></li>
                    <li class="mb-2"><a href="noticias.php" class="footer-link">Notícias</a></li>
                    <li class="mb-2"><a href="sobre.php" class="footer-link">Sobre Nós</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Fórum</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-light mb-3" style="color: var(--text-light) !important;">Suporte</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link">Centro de Ajuda</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Contactos</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Termos de Uso</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Privacidade</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-light mb-3" style="color: var(--text-light) !important;">Newsletter</h6>
                <p class="text-muted small mb-3" style="color: var(--text-muted) !important;">Recebe as últimas novidades</p>
                <form class="d-flex flex-column gap-2">
                    <input type="email" class="form-control form-control-sm footer-input" 
                           placeholder="O teu email">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane"></i>
                        Subscrever
                    </button>
                </form>
            </div>
        </div>

        <hr style="border-color: var(--border-color); margin: 2rem 0;">

        <!-- Bottom Section -->
        <div class="row align-items-center">
            <div class="col-md-4">
                <p class="text-muted mb-0" style="color: var(--text-muted) !important;">
                    © <?php echo date("Y"); ?> Drift King Portugal.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <a href="admin-login.php" class="text-muted" style="font-size: 0.85rem; text-decoration: none;">
                    <i class="fas fa-shield-alt me-1"></i>
                    Área Admin
                </a>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="text-muted mb-0" style="color: var(--text-muted) !important;">
                    Feito com <i class="fas fa-heart text-danger"></i> para a comunidade drift
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Scripts -->
<script src="js/scripts.js"></script>

<style>
.footer-link {
    color: var(--text-muted) !important;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: var(--primary-orange) !important;
}

.footer-input {
    background: var(--tertiary-dark) !important;
    border: 1px solid var(--border-color) !important;
    color: var(--text-light) !important;
}

.footer-input:focus {
    background: var(--tertiary-dark) !important;
    border-color: var(--primary-orange) !important;
    color: var(--text-light) !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25) !important;
}

.footer-input::placeholder {
    color: var(--text-dark-muted) !important;
}

.hover-primary:hover {
    color: var(--primary-orange) !important;
    transition: color 0.3s ease;
}
</style>

</body>
</html>