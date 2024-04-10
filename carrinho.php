<?php 
    session_start();
    require_once "functions/cart.php";

    $pdoConnection = require_once "connection.php";

    if(isset($_GET['action']) && in_array($_GET['action'], array('add', 'remove', 'update'))) {
        
        if($_GET['action'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
            addToCart($pdoConnection, $_GET['id']);            
        }

        if($_GET['action'] == 'remove' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
            removeFromCart($pdoConnection, $_GET['id']);
        }

        if($_GET['action'] == 'update'){ 
            if(isset($_POST['car']) && is_array($_POST['car'])){ 
                foreach($_POST['car'] as $id => $quantity){
                        updateCart($pdoConnection, $id, $quantity);
                }
            }
        } 
        header('location: cart.php');
    }

    $cartItems = getCartItems($pdoConnection);
    $totalPrice  = getTotalPrice($pdoConnection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: Arial, sans-serif;
            padding-top: 40px;
        }
        .container {
            max-width: 800px;
        }
        .btn-remove {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
        .btn-update {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-update:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="card-title">Carrinho</h4>
                <a href="index.php" class="card-link">Voltar à Loja</a>
            </div>
        </div>

        <?php if($cartItems) : ?>
            <form action="cart.php?action=update" method="post">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Carro</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                            <th>Ação</th>
                        </tr>               
                    </thead>
                    <tbody>
                        <?php foreach($cartItems as $item) : ?>
                            <tr>
                                <td><?php echo $item['brand'] . ' ' . $item['model']; ?></td>
                                <td>
                                    <input type="number" name="car[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" />
                                </td>
                                <td>R$<?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                                <td>R$<?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                                <td>
                                    <a href="cart.php?action=remove&id=<?php echo $item['id']; ?>" class="btn btn-remove">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-right"><b>Total: </b></td>
                            <td>R$<?php echo number_format($totalPrice, 2, ',', '.'); ?></td>
                            <td></td>
                        </tr>
                    </tbody>                
                </table>

                <button class="btn btn-primary" type="submit">Atualizar Carrinho</button>

            </form>
        <?php endif; ?>
    </div>
</body>
</html>