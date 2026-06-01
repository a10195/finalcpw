<?php
$pageTitle = "Notícias | Drift King";

// Notícias de exemplo
$noticias = [
    [
        'titulo' => 'Novo Recorde no Drift Masters Portugal',
        'resumo' => 'Piloto português estabelece novo recorde na competição nacional de drift.',
        'data' => '2024-04-20',
        'autor' => 'Redação Drift King',
        'imagem' => 'img/news1.jpg',
        'categoria' => 'Competição'
    ],
    [
        'titulo' => 'Toyota Lança Novo GR86 2024',
        'resumo' => 'A Toyota apresenta a nova geração do icónico GR86, perfeito para drift.',
        'data' => '2024-04-18',
        'autor' => 'João Silva',
        'imagem' => 'img/news2.jpg',
        'categoria' => 'Lançamentos'
    ],
    [
        'titulo' => 'Guia: Como Preparar um Carro para Drift',
        'resumo' => 'Tudo o que precisas saber para transformar o teu carro numa máquina de drift.',
        'data' => '2024-04-15',
        'autor' => 'Pedro Santos',
        'imagem' => 'img/news3.jpg',
        'categoria' => 'Tutorial'
    ],
    [
        'titulo' => 'Evento Drift King Summer 2024',
        'resumo' => 'Anunciamos o maior evento de drift do verão. Inscrições abertas!',
        'data' => '2024-04-12',
        'autor' => 'Organização DK',
        'imagem' => 'img/event1.jpg',
        'categoria' => 'Eventos'
    ]
];

include('header.php');
?>

<main class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">
                <i class="fas fa-newspaper text-info"></i>
                Notícias & Blog
            </h1>
            <p class="text-center text-muted mb-5">Mantém-te atualizado com as últimas novidades do mundo drift</p>

            <div class="row">
                <?php foreach ($noticias as $index => $noticia): ?>
                    <div class="col-lg-<?php echo $index === 0 ? '8' : '4'; ?> mb-4">
                        <article class="car-card h-100">
                            <div class="car-badge" style="background: var(--accent-blue);">
                                <?php echo $noticia['categoria']; ?>
                            </div>
                            
                            <img src="<?php echo htmlspecialchars($noticia['imagem']); ?>" 
                                 alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" 
                                 class="car-image" style="height: <?php echo $index === 0 ? '300px' : '200px'; ?>;">
                            
                            <div class="car-content">
                                <div class="car-brand">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('d/m/Y', strtotime($noticia['data'])); ?>
                                    <span class="ms-2">
                                        <i class="fas fa-user"></i>
                                        <?php echo htmlspecialchars($noticia['autor']); ?>
                                    </span>
                                </div>
                                
                                <h3 class="car-title <?php echo $index === 0 ? 'h2' : 'h4'; ?>">
                                    <?php echo htmlspecialchars($noticia['titulo']); ?>
                                </h3>
                                
                                <p class="text-muted">
                                    <?php echo htmlspecialchars($noticia['resumo']); ?>
                                </p>
                            </div>
                            
                            <button class="card-btn">
                                <i class="fas fa-arrow-right"></i>
                                Ler Artigo Completo
                            </button>
                        </article>
                    </div>
                    
                    <?php if ($index === 0): ?>
                        </div>
                        <div class="row">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Newsletter Signup -->
            <div class="search-card mt-5">
                <div class="text-center">
                    <h3 class="text-light mb-3">
                        <i class="fas fa-envelope text-warning"></i>
                        Newsletter Drift King
                    </h3>
                    <p class="text-muted mb-4">Recebe as últimas notícias e eventos diretamente no teu email</p>
                    
                    <form class="row g-3 justify-content-center">
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="O teu email">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Subscrever
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>