<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');
$pageTitle = "Meus Anúncios | Drift King";

$idUser = $_SESSION['user_id'];

// Processar ações (remover, editar status)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['idCarro'])) {
        $idCarro = (int)$_POST['idCarro'];
        
        if ($_POST['action'] == 'remove') {
            $sql = "DELETE FROM carros WHERE idCarro = $idCarro AND idVendedor = $idUser";
            if (mysqli_query($conn, $sql)) {
                $success = "Anúncio removido com sucesso!";
            }
        } elseif ($_POST['action'] == 'toggle_status') {
            $novoStatus = $_POST['novo_status'];
            $sql = "UPDATE carros SET estado = '$novoStatus' WHERE idCarro = $idCarro AND idVendedor = $idUser";
            if (mysqli_query($conn, $sql)) {
                $success = "Status atualizado com sucesso!";
            }
        }
    }
}

// Buscar anúncios do utilizador
$query = "
    SELECT 
        carros.*,
        marcas.nome AS marca,
        combustivel.tipo AS combustivel
    FROM carros
    LEFT JOIN marcas ON carros.idMarca = marcas.idMarca
    LEFT JOIN combustivel ON carros.idCombustivel = combustivel.idCombustivel
    WHERE carros.idVendedor = $idUser
    ORDER BY carros.data_criacao DESC
";

$resultado = mysqli_query($conn, $query);
$meus_carros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="section-title mb-0">
                    <i class="fas fa-list text-primary"></i>
                    Meus Anúncios
                </h1>
                <a href="anunciar-carro.php" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Novo Anúncio
                </a>
            </div>

            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($meus_carros)): ?>
                <div class="cars-grid">
                    <?php foreach ($meus_carros as $carro): ?>
                        <div class="car-card">
                            <!-- Status Badge -->
                            <div class="car-badge <?php echo $carro['estado'] == 'disponível' ? 'bg-success' : 'bg-warning'; ?>">
                                <?php echo ucfirst($carro['estado']); ?>
                            </div>

                            <!-- Car Image -->
                            <img src="<?php echo htmlspecialchars($carro['foto_carro_url'] ?: 'img/default-car.jpg'); ?>" 
                                 alt="<?php echo htmlspecialchars($carro['matricula']); ?>" 
                                 class="car-image">

                            <!-- Car Content -->
                            <div class="car-content">
                                <div class="car-brand"><?php echo htmlspecialchars($carro['marca']); ?></div>
                                <h3 class="car-title"><?php echo htmlspecialchars($carro['matricula']); ?></h3>
                                <div class="car-specs">
                                    <?php echo $carro['ano']; ?> | 
                                    <?php echo number_format($carro['km'], 0, '', ' '); ?> km | 
                                    <?php echo htmlspecialchars($carro['combustivel']); ?>
                                </div>
                                <div class="car-price"><?php echo number_format($carro['preco'], 2, ',', '.'); ?> €</div>
                                
                                <!-- Stats -->
                                <div class="d-flex justify-content-between text-muted mb-3">
                                    <small>
                                        <i class="fas fa-eye"></i>
                                        <?php echo $carro['visualizacoes']; ?> visualizações
                                    </small>
                                    <small>
                                        <i class="fas fa-calendar"></i>
                                        <?php echo date('d/m/Y', strtotime($carro['data_criacao'])); ?>
                                    </small>
                                </div>

                                <!-- Actions -->
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary flex-fill" 
                                            onclick="editarAnuncio(<?php echo $carro['idCarro']; ?>)">
                                        <i class="fas fa-edit"></i>
                                        Editar
                                    </button>
                                    
                                    <form method="POST" class="d-inline flex-fill">
                                        <input type="hidden" name="idCarro" value="<?php echo $carro['idCarro']; ?>">
                                        <input type="hidden" name="action" value="toggle_status">
                                        <input type="hidden" name="novo_status" 
                                               value="<?php echo $carro['estado'] == 'disponível' ? 'pausado' : 'disponível'; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                                            <i class="fas fa-<?php echo $carro['estado'] == 'disponível' ? 'pause' : 'play'; ?>"></i>
                                            <?php echo $carro['estado'] == 'disponível' ? 'Pausar' : 'Ativar'; ?>
                                        </button>
                                    </form>
                                    
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="removerAnuncio(<?php echo $carro['idCarro']; ?>, '<?php echo htmlspecialchars($carro['matricula']); ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="search-card">
                        <i class="fas fa-car fa-3x text-muted mb-3"></i>
                        <h3 class="text-light">Ainda não tens anúncios</h3>
                        <p class="text-muted mb-4">Começa a vender os teus carros para a comunidade drift!</p>
                        <a href="anunciar-carro.php" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Criar Primeiro Anúncio
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Modal para confirmar remoção -->
<div class="modal fade" id="removeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-light">Confirmar Remoção</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-light">
                <p>Tens a certeza que queres remover o anúncio <strong id="carName"></strong>?</p>
                <p class="text-warning"><i class="fas fa-exclamation-triangle"></i> Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" id="removeForm" class="d-inline">
                    <input type="hidden" name="idCarro" id="removeCarId">
                    <input type="hidden" name="action" value="remove">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Remover
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function removerAnuncio(idCarro, nomeCarr) {
    document.getElementById('removeCarId').value = idCarro;
    document.getElementById('carName').textContent = nomeCarr;
    new bootstrap.Modal(document.getElementById('removeModal')).show();
}

function editarAnuncio(idCarro) {
    // Por implementar - redirecionar para página de edição
    window.location.href = 'editar-anuncio.php?id=' + idCarro;
}
</script>

<?php include('footer.php'); ?>