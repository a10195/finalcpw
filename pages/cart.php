<section class="cart-section">
    <h1>Carrinho de Compras</h1>
    
    <?php
    if(!isset($_SESSION['user_id'])) {
        echo "<p><a href='index.php?page=login'>Faça login</a> para continuar com as compras.</p>";
    } else {
        $cart_items = $db->query(
            "SELECT c.*, ca.name, ca.price, ca.image_url FROM cart c 
            JOIN cars ca ON c.car_id = ca.id WHERE c.user_id = ?",
            [$_SESSION['user_id']]
        )->fetchAll();
        
        if(empty($cart_items)) {
            echo "<p>O seu carrinho está vazio.</p>";
        } else {
            $total = 0;
    ?>
            <div class="cart-items">
                <?php foreach($cart_items as $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>">
                        <div class="item-details">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>€<?php echo number_format($item['price'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="item-quantity">
                            <form method="POST" action="includes/update_cart.php">
                                <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                                <input type="number" name="quantity" min="1" value="<?php echo $item['quantity']; ?>">
                                <button type="submit" class="btn btn-small">Atualizar</button>
                            </form>
                        </div>
                        <div class="item-total">
                            <p>€<?php echo number_format($item_total, 2, ',', '.'); ?></p>
                        </div>
                        <form method="POST" action="includes/remove_from_cart.php">
                            <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <h2>Resumo</h2>
                <p>Total: €<?php echo number_format($total, 2, ',', '.'); ?></p>
                <a href="index.php?page=checkout" class="btn btn-primary">Prosseguir para o Checkout</a>
            </div>
    <?php 
        }
    }
    ?>
</section>
