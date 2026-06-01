<?php
include('db.php');
$pageTitle = "Bodykits | Drift King";

// Query para buscar bodykits
$query = "
    SELECT 
        bodykits.idBodykit,
        bodykits.nome,
        bodykits.preco,
        bodykits.descricao,
        bodykits.foto_url,
        marcas.nome AS marca
    FROM bodykits
    LEFT JOIN marcas ON bodykits.idMarca = marcas.idMarca
    ORDER BY bodykits.preco ASC
";

$resultado = mysqli_query($conn, $query);
$kits = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

include('header.php');
?>

<main class="container my-5 pt-5">
    <h1 class="section-title">Bodykits & Estética</h1>
    
    <?php if (!empty($kits)): ?>
        <div class="cards-grid">
            <?php foreach ($kits as $kit): ?>
                <article class="car-card">
                    <div class="card-img">
                        <?php 
                        $foto = !empty($kit['foto_url']) ? htmlspecialchars($kit['foto_url']) : 'img/default-bodykit.jpg';
                        ?>
                        <img src="<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($kit['nome']); ?>">
                    </div>
                    <div class="card-text">
                        <p class="car-brand"><?php echo htmlspecialchars($kit['marca'] ?? 'Universal'); ?></p>
                        <h2 class="car-title"><?php echo htmlspecialchars($kit['nome']); ?></h2>
                        <?php if (!empty($kit['descricao'])): ?>
                            <p class="car-subtitle"><?php echo htmlspecialchars($kit['descricao']); ?></p>
                        <?php endif; ?>
                    </div>
                    <button class="card-btn highlight">
                        <?php echo number_format($kit['preco'], 2, ',', '.'); ?> €
                    </button>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center text-white py-5">
            <h3>Não há bodykits disponíveis neste momento</h3>
            <p>Volta mais tarde para ver novos produtos!</p>
        </div>
    <?php endif; ?>
</main>

<?php include('footer.php'); ?>