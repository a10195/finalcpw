<?php
include('db.php');
$pageTitle = "Eventos | Drift King";

// Query para buscar eventos futuros
$query = "
    SELECT 
        eventos_drift.idEvento,
        eventos_drift.nome,
        eventos_drift.data,
        eventos_drift.descricao,
        eventos_drift.banner_url,
        cidades.nome AS cidade,
        autores_eventos.nome AS autor
    FROM eventos_drift
    LEFT JOIN cidades ON eventos_drift.idCidade = cidades.idCidade
    LEFT JOIN autores_eventos ON eventos_drift.idAutor = autores_eventos.idAutor
    WHERE eventos_drift.data >= NOW()
    ORDER BY eventos_drift.data ASC
";

$resultado = mysqli_query($conn, $query);
$eventos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

include('header.php');
?>

<main class="container my-5 pt-5">
    <h1 class="section-title">Próximos Eventos de Drift</h1>
    
    <?php if (!empty($eventos)): ?>
        <div class="news-grid">
            <?php foreach ($eventos as $evento): ?>
                <article class="news-card">
                    <?php 
                    $banner = !empty($evento['banner_url']) ? htmlspecialchars($evento['banner_url']) : 'img/default-event.jpg';
                    ?>
                    <img src="<?php echo $banner; ?>" alt="<?php echo htmlspecialchars($evento['nome']); ?>">
                    
                    <?php if (!empty($evento['data'])): ?>
                        <span class="badge bg-danger mt-2">
                            <?php echo date('d M', strtotime($evento['data'])); ?>
                        </span>
                    <?php endif; ?>
                    
                    <h2><?php echo htmlspecialchars($evento['nome']); ?></h2>
                    
                    <?php if (!empty($evento['cidade'])): ?>
                        <p class="text-muted mb-1">📍 <?php echo htmlspecialchars($evento['cidade']); ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($evento['descricao'])): ?>
                        <p><?php echo htmlspecialchars(substr($evento['descricao'], 0, 100)) . '...'; ?></p>
                    <?php endif; ?>
                    
                    <a href="#" class="btn-ver-todos" style="padding: 5px 15px; font-size: 0.8rem;">
                        Saber Mais
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center text-white py-5">
            <h3>Não há eventos programados</h3>
            <p>Fica atento às nossas redes sociais para novos eventos!</p>
            
            <!-- Eventos exemplo para demonstração -->
            <div class="news-grid mt-4">
                <article class="news-card">
                    <img src="img/fundo.jpg" alt="Evento Demo">
                    <span class="badge bg-danger mt-2">DEMO</span>
                    <h2>Drift Masters - Braga</h2>
                    <p>A maior competição nacional regressa ao Circuito de Braga.</p>
                    <a href="#" class="btn-ver-todos" style="padding: 5px 15px; font-size: 0.8rem;">
                        Evento Demo
                    </a>
                </article>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include('footer.php'); ?>