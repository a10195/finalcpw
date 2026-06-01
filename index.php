<?php
// Versão temporária do index.php que funciona com a BD atual
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('db.php');

// Query para os carros (sem as novas colunas)
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
    WHERE carros.estado = 'disponível'
    ORDER BY carros.preco DESC
    LIMIT 6
";

$resultado = mysqli_query($conn, $query);
$carros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

// Query para marcas (para o formulário)
$marcasQuery = "SELECT DISTINCT nome FROM marcas ORDER BY nome";
$marcasResult = mysqli_query($conn, $marcasQuery);
$marcas = mysqli_fetch_all($marcasResult, MYSQLI_ASSOC);

// Query para combustíveis
$combustiveisQuery = "SELECT DISTINCT tipo FROM combustivel ORDER BY tipo";
$combustiveisResult = mysqli_query($conn, $combustiveisQuery);
$combustiveis = mysqli_fetch_all($combustiveisResult, MYSQLI_ASSOC);

$pageTitle = "Drift King | A Maior Comunidade de Drift";
include('header.php');
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content fade-in-up">
        <h1 class="hero-title">Drift King</h1>
        <p class="hero-subtitle">A maior plataforma de carros de drift em Portugal</p>
        
        <!-- Search Card -->
        <div class="search-card">
            <div class="search-tabs">
                <button type="button" class="tab-btn active" id="tab-carros" onclick="alternarTab('carros')">
                    <i class="fas fa-car"></i>
                    Carros
                </button>
                <button type="button" class="tab-btn" id="tab-pecas" onclick="alternarTab('pecas')">
                    <i class="fas fa-cog"></i>
                    Peças
                </button>
                <button type="button" class="tab-btn" id="tab-eventos" onclick="alternarTab('eventos')">
                    <i class="fas fa-calendar"></i>
                    Eventos
                </button>
            </div>

            <!-- Carros Form -->
            <form action="pesquisa.php" method="GET" id="searchForm">
                <div id="campos-carros" class="tab-content active">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Marca</label>
                            <select name="marca" class="form-control">
                                <option value="">Todas as Marcas</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?php echo htmlspecialchars($marca['nome']); ?>">
                                        <?php echo htmlspecialchars($marca['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Combustível</label>
                            <select name="combustivel" class="form-control">
                                <option value="">Combustível</option>
                                <?php foreach ($combustiveis as $combustivel): ?>
                                    <option value="<?php echo htmlspecialchars($combustivel['tipo']); ?>">
                                        <?php echo htmlspecialchars($combustivel['tipo']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Preço até</label>
                            <select name="preco" class="form-control">
                                <option value="">Preço até</option>
                                <option value="20000">20.000 €</option>
                                <option value="40000">40.000 €</option>
                                <option value="60000">60.000 €</option>
                                <option value="80000">80.000 €</option>
                                <option value="100000">100.000 €</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ano de</label>
                            <select name="ano" class="form-control">
                                <option value="">Ano de</option>
                                <option value="2020">2020</option>
                                <option value="2015">2015</option>
                                <option value="2010">2010</option>
                                <option value="2005">2005</option>
                                <option value="2000">2000</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pesquisar</label>
                            <input type="text" name="q" class="form-control" placeholder="Ex: Silvia, Supra...">
                        </div>
                    </div>
                </div>

                <!-- Peças Form -->
                <div id="campos-pecas" class="tab-content">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select name="categoria" class="form-control">
                                <option value="">Todas as Categorias</option>
                                <option value="motor">Peças de Motor</option>
                                <option value="suspensao">Suspensão</option>
                                <option value="rodas">Jantes & Pneus</option>
                                <option value="bodykit">Bodykits</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Marca Compatível</label>
                            <select name="marca_compativel" class="form-control">
                                <option value="">Todas as Marcas</option>
                                <option value="nissan">Nissan</option>
                                <option value="toyota">Toyota</option>
                                <option value="mazda">Mazda</option>
                                <option value="bmw">BMW</option>
                                <option value="universal">Universal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Preço até</label>
                            <select name="preco_max" class="form-control">
                                <option value="">Preço até</option>
                                <option value="500">500 €</option>
                                <option value="1000">1.000 €</option>
                                <option value="2000">2.000 €</option>
                                <option value="5000">5.000 €</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pesquisar</label>
                            <input type="text" name="q" class="form-control" placeholder="Ex: Turbo, Coilovers...">
                        </div>
                    </div>
                </div>

                <!-- Eventos Form -->
                <div id="campos-eventos" class="tab-content">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Evento</label>
                            <select name="tipo" class="form-control">
                                <option value="">Todos os Tipos</option>
                                <option value="competicao">Competição</option>
                                <option value="treino">Treino Livre</option>
                                <option value="encontro">Encontro</option>
                                <option value="workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cidade</label>
                            <select name="cidade" class="form-control">
                                <option value="">Todas as Cidades</option>
                                <option value="lisboa">Lisboa</option>
                                <option value="porto">Porto</option>
                                <option value="braga">Braga</option>
                                <option value="coimbra">Coimbra</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data de</label>
                            <input type="date" name="data_inicio" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pesquisar</label>
                            <input type="text" name="q" class="form-control" placeholder="Nome do evento...">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn-primary me-3" id="search-btn">
                        <i class="fas fa-search"></i>
                        <span id="search-text">Pesquisar Carros</span>
                    </button>
                    <a href="carros.php" class="btn-outline" id="view-all-btn">
                        <i class="fas fa-list"></i>
                        <span id="view-all-text">Ver Todos</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Featured Cars Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Carros em Destaque</h2>
        
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
                        
                        <button class="card-btn <?php echo $carro['preco'] > 70000 ? 'highlight' : ''; ?>">
                            <i class="fas fa-eye"></i>
                            Ver Detalhes
                        </button>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <p class="text-muted">Não há carros disponíveis neste momento.</p>
            </div>
        <?php endif; ?>

        <div class="text-center mt-5">
            <a href="carros.php" class="btn-primary">
                <i class="fas fa-arrow-right"></i>
                Ver Todos os Carros
            </a>
        </div>
    </div>
</section>

<!-- Quick Stats Section -->
<section class="section" style="background: var(--secondary-dark);">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="fas fa-car fa-3x text-primary mb-3"></i>
                    <h3 class="text-light"><?php echo count($carros); ?>+</h3>
                    <p class="text-muted">Carros Disponíveis</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h3 class="text-light">500+</h3>
                    <p class="text-muted">Membros Ativos</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                    <h3 class="text-light">200+</h3>
                    <p class="text-muted">Vendas Realizadas</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="fas fa-calendar fa-3x text-info mb-3"></i>
                    <h3 class="text-light">50+</h3>
                    <p class="text-muted">Eventos Organizados</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section">
    <div class="container text-center">
        <div class="search-card" style="max-width: 600px; margin: 0 auto;">
            <h2 class="text-light mb-3">Pronto para Vender?</h2>
            <p class="text-muted mb-4">Junta-te à maior comunidade de drift e vende o teu carro hoje mesmo!</p>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="anunciar-carro.php" class="btn-primary me-3">
                    <i class="fas fa-plus"></i>
                    Anunciar Carro
                </a>
                <a href="meus-anuncios.php" class="btn-outline">
                    <i class="fas fa-list"></i>
                    Meus Anúncios
                </a>
            <?php else: ?>
                <a href="register.php" class="btn-primary me-3">
                    <i class="fas fa-user-plus"></i>
                    Criar Conta
                </a>
                <a href="login.php" class="btn-outline">
                    <i class="fas fa-sign-in-alt"></i>
                    Fazer Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
function alternarTab(tipo) {
    // Remove active class from all tabs and content
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    // Add active class to clicked tab
    document.getElementById('tab-' + tipo).classList.add('active');
    document.getElementById('campos-' + tipo).classList.add('active');
    
    // Update form action and button text based on tab
    const form = document.getElementById('searchForm');
    const searchText = document.getElementById('search-text');
    const viewAllBtn = document.getElementById('view-all-btn');
    const viewAllText = document.getElementById('view-all-text');
    
    if (tipo === 'carros') {
        form.action = 'pesquisa.php';
        searchText.textContent = 'Pesquisar Carros';
        viewAllBtn.href = 'carros.php';
        viewAllText.textContent = 'Ver Todos';
    } else if (tipo === 'pecas') {
        form.action = 'pecas.php';
        searchText.textContent = 'Pesquisar Peças';
        viewAllBtn.href = 'pecas.php';
        viewAllText.textContent = 'Ver Todas';
    } else if (tipo === 'eventos') {
        form.action = 'eventos.php';
        searchText.textContent = 'Pesquisar Eventos';
        viewAllBtn.href = 'eventos.php';
        viewAllText.textContent = 'Ver Todos';
    }
}
</script>

<?php include('footer.php'); ?>