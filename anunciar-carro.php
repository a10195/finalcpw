<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');
$pageTitle = "Anunciar Carro | Drift King";

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $km = (int)$_POST['km'];
    $preco = (float)$_POST['preco'];
    $idMarca = (int)$_POST['idMarca'];
    $idCombustivel = (int)$_POST['idCombustivel'];
    $ano = (int)$_POST['ano'];
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $idVendedor = $_SESSION['user_id'];

    // Garantir que a pasta uploads existe
    $uploadsDir = __DIR__ . '/uploads';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    // Upload da foto
    $foto_url = '';
    if (isset($_FILES['foto_url']) && $_FILES['foto_url']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['foto_url']['name'], PATHINFO_EXTENSION);
        $nomeFoto = uniqid('carro_') . '.' . $ext;
        $destino = 'uploads/' . $nomeFoto;
        if (move_uploaded_file($_FILES['foto_url']['tmp_name'], $destino)) {
            $foto_url = $destino;
        }
    }

    $sql = "INSERT INTO carros (matricula, km, preco, idMarca, idCombustivel, ano, estado, foto_carro_url, descricao, categoria, idVendedor) 
            VALUES ('$matricula', $km, $preco, $idMarca, $idCombustivel, $ano, 'disponível', '$foto_url', '$descricao', '$categoria', $idVendedor)";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Anúncio criado com sucesso!";
    } else {
        $error = "Erro: " . mysqli_error($conn);
    }
}

// Buscar dados para formulário
$marcas = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM marcas ORDER BY nome"), MYSQLI_ASSOC);
$combustiveis = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM combustivel ORDER BY tipo"), MYSQLI_ASSOC);

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="search-card">
                <div class="text-center mb-4">
                    <h1 class="section-title mb-2">
                        <i class="fas fa-car text-warning"></i>
                        Anunciar o Teu Carro
                    </h1>
                    <p class="text-muted">Vende o teu carro para a comunidade drift</p>
                </div>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                        <a href="meus-anuncios.php" class="btn btn-sm btn-outline-success ms-2">Ver Meus Anúncios</a>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="fade-in-up" enctype="multipart/form-data">
                    <!-- Informações Básicas -->
                    <div class="mb-4">
                        <h4 class="text-light mb-3">
                            <i class="fas fa-info-circle text-primary"></i>
                            Informações Básicas
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Modelo/Matrícula *</label>
                                <input type="text" name="matricula" class="form-control" 
                                       placeholder="Ex: Nissan Silvia S15 Spec-R" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ano *</label>
                                <input type="number" name="ano" class="form-control" 
                                       min="1980" max="2024" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marca *</label>
                                <select name="idMarca" class="form-control" required>
                                    <option value="">Selecionar Marca</option>
                                    <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca['idMarca']; ?>">
                                            <?php echo htmlspecialchars($marca['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Combustível *</label>
                                <select name="idCombustivel" class="form-control" required>
                                    <option value="">Selecionar Combustível</option>
                                    <?php foreach ($combustiveis as $combustivel): ?>
                                        <option value="<?php echo $combustivel['idCombustivel']; ?>">
                                            <?php echo htmlspecialchars($combustivel['tipo']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quilómetros *</label>
                                <input type="number" name="km" class="form-control" 
                                       placeholder="Ex: 120000" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoria</label>
                                <select name="categoria" class="form-control">
                                    <option value="drift">Drift</option>
                                    <option value="tuning">Tuning</option>
                                    <option value="classico">Clássico JDM</option>
                                    <option value="stock">Stock</option>
                                    <option value="projeto">Projeto</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Preço e Fotos -->
                    <div class="mb-4">
                        <h4 class="text-light mb-3">
                            <i class="fas fa-euro-sign text-success"></i>
                            Preço e Imagens
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Preço (€) *</label>
                                <input type="number" step="0.01" name="preco" class="form-control" 
                                       placeholder="Ex: 45000.00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto Principal *</label>
                                <input type="file" name="foto_url" class="form-control" accept="image/*" required onchange="previewFotoCarro(event)">
                                <small class="text-muted">Faz upload da foto principal do carro</small>
                                <div class="mt-2">
                                    <img id="preview-foto-carro" src="#" alt="Pré-visualização" style="display:none; max-width: 100%; max-height: 180px; border-radius: 8px; border: 1px solid #ccc;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-4">
                        <h4 class="text-light mb-3">
                            <i class="fas fa-edit text-info"></i>
                            Descrição Detalhada
                        </h4>
                        
                        <div class="form-group">
                            <label class="form-label">Descrição do Carro</label>
                            <textarea name="descricao" class="form-control" rows="6" 
                                      placeholder="Descreve o teu carro: modificações, estado, histórico, etc."></textarea>
                            <small class="text-muted">
                                Inclui informações sobre modificações, estado geral, histórico de manutenção, etc.
                            </small>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="text-center">
                        <button type="submit" class="btn-primary me-3">
                            <i class="fas fa-plus-circle"></i>
                            Publicar Anúncio
                        </button>
                        <a href="carros.php" class="btn-outline">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
function previewFotoCarro(event) {
    const input = event.target;
    const preview = document.getElementById('preview-foto-carro');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>

<?php include('footer.php'); ?>