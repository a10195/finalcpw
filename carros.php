<?php
include('db.php');
$pageTitle = "Todos os Carros | Drift King";

// Query para buscar todos os carros disponíveis (sem as novas colunas)
$query = "
    SELECT 
        carros.idCarro,
        carros.matricula,
        carros.km,
        carros.preco,
        carros.ano,
        carros.foto_carro_url,
        carros.estado,
        marcas.nome AS marca,
        combustivel.tipo AS combustivel
    FROM carros
    LEFT JOIN marcas ON carros.idMarca = marcas.idMarca
    LEFT JOIN combustivel ON carros.idCombustivel = combustivel.idCombustivel
    WHERE carros.estado = 'disponível'
    ORDER BY carros.preco DESC
";

$resultado = mysqli_query($conn, $query);
$carros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="text-center mb-5">
        <h1 class="section-title">
            <i class="fas fa-car text-primary"></i>
            Stock Disponível
        </h1>
        <p class="text-muted">Descobre os melhores carros de drift da comunidade</p>
    </div>

    <?php if (!empty($carros)): ?>
        <div class="cars-grid">
            <?php foreach ($carros as $carro): ?>
                <article class="car-card fade-in-up">
                    <?php if ($carro['preco'] > 70000): ?>
                        <span class="car-badge">Premium</span>
                    <?php endif; ?>

                    <img src="<?php echo htmlspecialchars($carro['foto_carro_url'] ?: 'img/default-car.jpg'); ?>"
                        alt="<?php echo htmlspecialchars($carro['marca'] . ' ' . $carro['matricula']); ?>"
                        class="car-image">

                    <div class="car-content">
                        <div class="car-brand"><?php echo htmlspecialchars($carro['marca'] ?? 'Marca'); ?></div>
                        <h3 class="car-title"><?php echo htmlspecialchars($carro['matricula']); ?></h3>
                        <div class="car-specs">
                            <?php echo $carro['ano']; ?> |
                            <?php echo number_format($carro['km'], 0, '', ' '); ?> km |
                            <?php echo htmlspecialchars($carro['combustivel'] ?? 'N/A'); ?>
                        </div>

                        <div class="car-price"><?php echo number_format($carro['preco'], 2, ',', '.'); ?> €</div>
                    </div>

                    <button class="card-btn <?php echo $carro['preco'] > 70000 ? 'highlight' : ''; ?>"
                        onclick="verDetalhes(<?php echo $carro['idCarro']; ?>)">
                        <i class="fas fa-eye"></i>
                        Ver Detalhes
                    </button>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination (placeholder) -->
        <div class="text-center mt-5">
            <nav aria-label="Navegação de páginas">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Próximo</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="search-card">
                <i class="fas fa-car fa-3x text-muted mb-3"></i>
                <h3 class="text-light">Não há carros disponíveis</h3>
                <p class="text-muted mb-4">Volta mais tarde para ver novos anúncios!</p>
                <a href="anunciar-carro.php" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Anunciar o Teu Carro
                </a>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
    function verDetalhes(idCarro) {
        // Por enquanto, redireciona para uma página de detalhes (a criar)
        alert('Funcionalidade de detalhes em desenvolvimento. ID do carro: ' + idCarro);
        // window.location.href = 'detalhes-carro.php?id=' + idCarro;
    }
</script>

<style>
    .pagination .page-link {
        background: var(--tertiary-dark);
        border-color: var(--border-color);
        color: var(--text-light);
    }

    .pagination .page-link:hover {
        background: var(--primary-orange);
        border-color: var(--primary-orange);
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-orange);
        border-color: var(--primary-orange);
    }

    .pagination .page-item.disabled .page-link {
        background: var(--secondary-dark);
        border-color: var(--border-color);
        color: var(--text-dark-muted);
    }
</style>

<?php include('footer.php'); ?>