<?php
include('db.php');
$pageTitle = "Peças & Acessórios | Drift King";

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Dados de exemplo para peças (pode ser expandido com uma tabela própria)
$pecas = [
    [
        'nome' => 'Turbo Garrett GT2860RS',
        'categoria' => 'motor',
        'preco' => 1200.00,
        'descricao' => 'Turbo Garrett para motores 2.0L, perfeito para drift',
        'foto' => 'img/turbo.jpg',
        'vendedor' => 'TuningParts PT'
    ],
    [
        'nome' => 'Coilovers BC Racing BR',
        'categoria' => 'suspensao',
        'preco' => 800.00,
        'descricao' => 'Suspensão coilover ajustável, ideal para drift',
        'foto' => 'img/coilovers.jpg',
        'vendedor' => 'DriftShop'
    ],
    [
        'nome' => 'Jantes Work Emotion CR',
        'categoria' => 'rodas',
        'preco' => 1500.00,
        'descricao' => 'Jantes Work 18x9.5 ET22, clássicas JDM',
        'foto' => 'img/jantes.jpg',
        'vendedor' => 'JDM Parts'
    ],
    [
        'nome' => 'Intercooler Front Mount',
        'categoria' => 'motor',
        'preco' => 450.00,
        'descricao' => 'Intercooler frontal para motores turbo',
        'foto' => 'img/intercooler.jpg',
        'vendedor' => 'Performance Parts'
    ]
];

// Filtrar por categoria se especificada
if (!empty($categoria)) {
    $pecas = array_filter($pecas, function($peca) use ($categoria) {
        return $peca['categoria'] === $categoria;
    });
}

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">
                <i class="fas fa-cog text-warning"></i>
                Peças & Acessórios
                <?php if (!empty($categoria)): ?>
                    - <?php echo ucfirst($categoria); ?>
                <?php endif; ?>
            </h1>

            <!-- Category Filter -->
            <div class="search-card mb-4">
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <a href="pecas.php" class="btn <?php echo empty($categoria) ? 'btn-primary' : 'btn-outline-secondary'; ?>">
                        <i class="fas fa-th"></i>
                        Todas
                    </a>
                    <a href="pecas.php?categoria=motor" class="btn <?php echo $categoria === 'motor' ? 'btn-primary' : 'btn-outline-secondary'; ?>">
                        <i class="fas fa-cog"></i>
                        Motor
                    </a>
                    <a href="pecas.php?categoria=suspensao" class="btn <?php echo $categoria === 'suspensao' ? 'btn-primary' : 'btn-outline-secondary'; ?>">
                        <i class="fas fa-compress-arrows-alt"></i>
                        Suspensão
                    </a>
                    <a href="pecas.php?categoria=rodas" class="btn <?php echo $categoria === 'rodas' ? 'btn-primary' : 'btn-outline-secondary'; ?>">
                        <i class="fas fa-circle"></i>
                        Jantes & Pneus
                    </a>
                </div>
            </div>

            <?php if (!empty($pecas)): ?>
                <div class="cars-grid">
                    <?php foreach ($pecas as $peca): ?>
                        <article class="car-card">
                            <div class="car-badge" style="background: var(--accent-blue);">
                                <?php echo ucfirst($peca['categoria']); ?>
                            </div>
                            
                            <img src="<?php echo htmlspecialchars($peca['foto']); ?>" 
                                 alt="<?php echo htmlspecialchars($peca['nome']); ?>" 
                                 class="car-image">
                            
                            <div class="car-content">
                                <div class="car-brand"><?php echo htmlspecialchars($peca['vendedor']); ?></div>
                                <h3 class="car-title"><?php echo htmlspecialchars($peca['nome']); ?></h3>
                                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                    <?php echo htmlspecialchars($peca['descricao']); ?>
                                </p>
                                <div class="car-price"><?php echo number_format($peca['preco'], 2, ',', '.'); ?> €</div>
                            </div>
                            
                            <button class="card-btn">
                                <i class="fas fa-shopping-cart"></i>
                                Contactar Vendedor
                            </button>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="search-card">
                        <i class="fas fa-cog fa-3x text-muted mb-3"></i>
                        <h3 class="text-light">Nenhuma peça encontrada</h3>
                        <p class="text-muted mb-4">Não há peças disponíveis nesta categoria.</p>
                        <a href="pecas.php" class="btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Ver Todas as Peças
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>