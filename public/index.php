<?php
session_start(); // Démarrer la session pour gérer l'état de connexion

$isConnected = isset($_SESSION['user']); // Vérifie si l'utilisateur est connecté

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Stubborn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid #ccc;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .products {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .product {
            border: 2px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 200px;
        }
        .product img {
            width: 100%;
            height: 150px;
            background-color: #eee;
            display: block;
        }
        .footer {
            text-align: left;
            padding: 10px;
            border-top: 2px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="img/logo-stubborn.png" alt="Stubborn" style="height: 50px;">
        <div style="font-size: 12px;">Don't compromise on your look</div>
    </div>
    <nav class="nav-links">
        <a href="index.php"><strong>Accueil</strong></a>
        <?php if (!$isConnected): ?>
            <a href="register.php">S'inscrire</a>
            <a href="login.php">Se connecter</a>
        <?php else: ?>
            <a href="profile.php">Mon profil</a>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</header>

<section class="products">
<?php foreach ($products as $product): ?>
    <div class="product">
        <img src="placeholder.jpg" alt="<?php echo htmlspecialchars($product['title']); ?>">
        <h3><?php echo $product['title']; ?></h3>
        <p><?php echo $product['price']; ?></p>
    </div>
<?php endforeach; ?>

</section>

<footer class="footer">
    Informations de la société
</footer>

</body>
</html>
