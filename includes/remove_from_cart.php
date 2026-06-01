<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $cart_id = (int)$_POST['cart_id'];
    
    $db->query(
        "DELETE FROM cart WHERE id = ? AND user_id = ?",
        [$cart_id, $_SESSION['user_id']]
    );
    
    header('Location: ../index.php?page=cart&success=Carro removido do carrinho');
} else {
    header('Location: ../index.php?page=cart');
}
?>
