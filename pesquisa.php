<?php
include('db.php');
$pageTitle = "Resultados da Pesquisa | Drift King";

// Receber parâmetros de pesquisa
$termoPesquisado = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
$marcaSelecionada = isset($_GET['marca']) ? mysqli_real_escape_string($conn, $_GET['marca']) : '';
$precoMax = isset($_GET['preco']) ? (int)$_GET['preco'] : 0;
$anoMin = isset($_GET['ano']) ? (int)$_GET['ano'] : 0;
$combustivelSelecionado = isset($_GET['combustivel']) ? mysqli_real_escape_string($conn, $_GET['combustivel']) : '';
$categoriaSelecionada = isset($_GET['categoria']) ? mysqli_real_escape_string($conn, $_GET['categoria']) : '';

// Construir query dinâmica
$where = ["carros.estado = 'disponível'"];

if (!empty($termoPesquisado)) {
    $where[] = "(carros.matricula LIKE '%$termoPesquisado%' OR marcas.nome LIKE '%$termoPesquisado%')";
}

if (!empty($marcaSelecionada)) {
    $where[] = "marcas.nome = '$marcaSelecionada'";
}

if ($precoMax > 0) {
    $where[] = "carros.preco <= $precoMax";
}

if ($anoMin > 0) {
    $where[] = "carros.ano >= $anoMin";
}

if (!empty($combustivelSelecionado)) {
    $where[] = "combustivel.tipo = '$combustivelSelecionado'";
}

// Adicionar filtro de categoria se existir a coluna
if (!empty($categoriaSelecionada)) {
    // Verificar se a coluna categoria existe
    $checkColumn = mysqli_query($conn, "SHOW COLUMNS FROM carros LIKE 'categoria'");
    if (mysqli_num_rows($checkColumn) > 0) {
        $where[] = "carros.categoria = '$categoriaSelecionada'";
    }
}

$whereClause = implode(' AND ', $where);

$query = "
    SELECT 
        carros.idCarro,
        carros.matricula,
        carros.km,
        carros.preco,
        carros.ano,
        carros.foto_carro_url,
        marcas.nome AS marca,
        combustivel.tipo AS combustivel
    FROM carros
    LEFT JOIN marcas ON carros.idMarca = marcas.idMarca
    LEFT JOIN combustivel ON carros.idCombustivel = combustivel.idCombustivel
    WHERE $whereClause
    ORDER BY carros.preco ASC
";

$resultado = mysqli_query($conn, $query);
$carros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="mb-4">
        <h1 class="section-title">
            <?php if (!empty($termoPesquisado)): ?>
                Resultados para: "<?php echo htmlspecialchars($termoPesquisado); ?>"
            <?php elseif (!empty($categoriaSelecionada)): ?>
                <?php echo ucfirst($categoriaSelecionada); ?> Cars
            <?php else: ?>
                Resultados da Pesquisa
            <?php endif; ?>
        </h1>
        <p class="text-muted text-center"><?php echo count($carros); ?> carros encontrados</p>
        
        <div class="text-center mb-4">
            <a href="index.php" class="btn-outline me-2">
                <i class="fas fa-arrow-left"></i>
                Nova Pesquisa
            </a>
            <a href="carros.php" class="btn-outline">
                <i class="fas fa-list"></i>
                Ver Todos os Carros
            </a>
        </div>
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
    <?php else: ?>
        <div class="text-center py-5">
            <div class="search-card">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3 class="text-light">Nenhum carro encontrado</h3>
                <p class="text-muted mb-4">
                    Tenta ajustar os filtros de pesquisa ou procura por outros termos.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="index.php" class="btn-primary">
                        <i class="fas fa-search"></i>
                        Nova Pesquisa
                    </a>
                    <a href="carros.php" class="btn-outline">
                        <i class="fas fa-list"></i>
                        Ver Todos os Carros
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
function verDetalhes(idCarro) {
    alert('Funcionalidade de detalhes em desenvolvimento. ID do carro: ' + idCarro);
}
</script>

<?php include('footer.php'); ?>