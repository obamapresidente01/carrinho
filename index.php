<?php 
    require_once "functions/car.php";
    $pdoConnection = require_once "connection.php";
    $cars = getCars($pdoConnection);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja de Carros</title>
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
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .car-price {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }
        .btn-buy {
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-buy:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php foreach($cars as $car) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="images/<?php echo $car['image']; ?>" alt="<?php echo $car['brand'] . ' ' . $car['model']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $car['brand'] . ' ' . $car['model']; ?></h5>
                            <p class="card-text"><?php echo $car['description']; ?></p>
                            <p class="car-price">Preço: R$<?php echo number_format($car['price'], 2, ',', '.'); ?></p>
                            <a href="cart.php?action=add&id=<?php echo $car['id']; ?>" class="btn btn-buy">Comprar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>