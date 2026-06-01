<section class="hero">
    <div class="hero-content">
        <h2>Bem-vindo à CarShop</h2>
        <p>Os melhores automóveis premium ao seu alcance</p>
        <a href="index.php?page=cars" class="btn btn-primary">Explorar Catálogo</a>
    </div>
</section>

<section class="featured-cars">
    <h2>Automóveis em Destaque</h2>
    <div class="cars-grid">
        <?php
        $featured_cars = $db->query("SELECT * FROM cars LIMIT 6")->fetchAll();
        foreach($featured_cars as $car):
        ?>
            <div class="car-card">
                <div class="car-image">
                    <img src="<?php echo $car['image_url']; ?>" alt="<?php echo $car['name']; ?>">
                </div>
                <div class="car-info">
                    <h3><?php echo $car['name']; ?></h3>
                    <p class="brand"><?php echo $car['brand']; ?> <?php echo $car['model']; ?> <?php echo $car['year']; ?></p>
                    <p class="price">€<?php echo number_format($car['price'], 2, ',', '.'); ?></p>
                    <a href="index.php?page=car-details&id=<?php echo $car['id']; ?>" class="btn btn-secondary">Ver Detalhes</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
