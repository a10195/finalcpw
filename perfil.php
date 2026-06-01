<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');
$pageTitle = "O teu Perfil | Drift King";

$id = $_SESSION['user_id'];
$sql = "SELECT c.*, ci.nome AS cidade FROM clientes c LEFT JOIN cidades ci ON c.idCidade = ci.idCidade WHERE c.idCliente = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Incrementar visualizações só se não existir cookie
$cookieName = 'perfil_viewed_' . $id;
if (!isset($_COOKIE[$cookieName])) {
    mysqli_query($conn, "UPDATE clientes SET visualizacoes = visualizacoes + 1 WHERE idCliente = $id");
    setcookie($cookieName, '1', time() + (60 * 60 * 24), "/"); // 1 dia
}

// Buscar visualizações
$visualizacoes = isset($user['visualizacoes']) ? (int)$user['visualizacoes'] : 0;

// Buscar média de avaliações
$sqlAvaliacao = "SELECT AVG(pontuacao) as media FROM avaliacoes_perfil WHERE idPerfilDestino = $id";
$resAvaliacao = mysqli_query($conn, $sqlAvaliacao);
$rowAvaliacao = mysqli_fetch_assoc($resAvaliacao);
$avaliacao_media = $rowAvaliacao['media'] ? number_format($rowAvaliacao['media'], 1) : '—';

// Buscar vendas do cliente
$sqlVendas = "
    SELECT v.dataVenda, v.precoFinal, m.nome AS marca, ca.matricula
    FROM vendas v
    JOIN carros ca ON v.idCarro = ca.idCarro
    JOIN marcas m ON ca.idMarca = m.idMarca
    WHERE v.idCliente = $id
    ORDER BY v.dataVenda DESC
";
$vendas = mysqli_fetch_all(mysqli_query($conn, $sqlVendas), MYSQLI_ASSOC);

// Buscar anúncios ativos do utilizador (verificar se colunas existem)
$sqlAnuncios = "
    SELECT 
        carros.*,
        marcas.nome AS marca,
        combustivel.tipo AS combustivel
    FROM carros
    LEFT JOIN marcas ON carros.idMarca = marcas.idMarca
    LEFT JOIN combustivel ON carros.idCombustivel = combustivel.idCombustivel
    WHERE carros.idVendedor = $id
    ORDER BY carros.idCarro DESC
    LIMIT 3
";
$anunciosResult = mysqli_query($conn, $sqlAnuncios);
$anuncios = $anunciosResult ? mysqli_fetch_all($anunciosResult, MYSQLI_ASSOC) : [];

include('header.php');
?>

<main class="profile-hero">
    <div class="container profile-container">
        <!-- Profile Header -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php
                    $foto = !empty($user['foto_perfil_url']) ? htmlspecialchars($user['foto_perfil_url']) : 'img/default-avatar.png';
                    ?>
                    <img src="<?php echo $foto; ?>" alt="Avatar" class="avatar-img">
                    <div class="avatar-badge">
                        <i class="fas fa-crown"></i>
                    </div>
                </div>
                
                <div class="profile-info flex-grow-1">
                    <h1><?php echo htmlspecialchars($user['nome']); ?></h1>
                    
                    <div class="profile-meta">
                        <div class="meta-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        
                        <?php if (!empty($user['cidade'])): ?>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($user['cidade']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($user['telefone'])): ?>
                        <div class="meta-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($user['telefone']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Membro desde 2024</span>
                        </div>
                    </div>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo count($anuncios); ?></span>
                            <div class="stat-label">Anúncios Ativos</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo count($vendas); ?></span>
                            <div class="stat-label">Vendas</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo $avaliacao_media; ?></span>
                            <div class="stat-label">Avaliação</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo $visualizacoes; ?></span>
                            <div class="stat-label">Visualizações</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="d-flex flex-wrap gap-3">
                <a href="anunciar-carro.php" class="btn-modern">
                    <i class="fas fa-plus"></i>
                    Novo Anúncio
                </a>
                <a href="meus-anuncios.php" class="btn-outline-modern">
                    <i class="fas fa-list"></i>
                    Meus Anúncios
                </a>
                <a href="configuracoes.php" class="btn-outline-modern">
                    <i class="fas fa-cog"></i>
                    Configurações
                </a>
                <a href="logout.php" class="btn-outline-modern">
                    <i class="fas fa-sign-out-alt"></i>
                    Sair
                </a>
            </div>
        </div>

        <!-- Active Listings -->
        <div class="profile-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-car"></i>
                    Meus Anúncios Ativos
                </h2>
                <a href="meus-anuncios.php" class="btn-outline-modern">
                    <i class="fas fa-arrow-right"></i>
                    Ver Todos
                </a>
            </div>
            
            <?php if (!empty($anuncios)): ?>
                <div class="cars-mini-grid">
                    <?php foreach ($anuncios as $anuncio): ?>
                        <div class="mini-car-card">
                            <img src="<?php echo htmlspecialchars($anuncio['foto_carro_url'] ?: 'img/default-car.jpg'); ?>" 
                                 alt="<?php echo htmlspecialchars($anuncio['matricula']); ?>" 
                                 class="mini-car-img">
                            
                            <div class="mini-car-content">
                                <h3 class="mini-car-title"><?php echo htmlspecialchars($anuncio['matricula']); ?></h3>
                                <div class="mini-car-meta">
                                    <?php echo htmlspecialchars($anuncio['marca']); ?> • <?php echo $anuncio['ano']; ?> • 
                                    <?php echo number_format($anuncio['km'], 0, '', ' '); ?> km
                                </div>
                                <div class="mini-car-price"><?php echo number_format($anuncio['preco'], 0, '', '.'); ?> €</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-car"></i>
                    <h3>Ainda não tens anúncios</h3>
                    <p>Começa a vender os teus carros para a comunidade drift!</p>
                    <a href="anunciar-carro.php" class="btn-modern mt-3">
                        <i class="fas fa-plus"></i>
                        Criar Primeiro Anúncio
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Purchase History -->
        <?php if (!empty($vendas)): ?>
        <div class="profile-card">
            <h2 class="section-title">
                <i class="fas fa-shopping-cart"></i>
                Histórico de Compras
            </h2>
            
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-calendar"></i> Data</th>
                            <th><i class="fas fa-car"></i> Carro</th>
                            <th><i class="fas fa-euro-sign"></i> Preço Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $v): ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($v['dataVenda'])); ?></td>
                            <td><?php echo htmlspecialchars($v['marca'] . ' — ' . $v['matricula']); ?></td>
                            <td class="text-success fw-bold"><?php echo number_format($v['precoFinal'], 2, ',', '.'); ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include('footer.php'); ?>