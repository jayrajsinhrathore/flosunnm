<?php
session_start();

// Simulated product data (in a real application, this would come from a database)
$products = [
    ['id' => 1, 'name' => 'Romantic Red Roses', 'price' => 4999, 'category' => 'bouquet', 'image' => 'bq3.jpg' ],
    ['id' => 2, 'name' => 'Spring Melody', 'price' => 3999, 'category' => 'bouquet', 'image' => 'bq4.jpg'],
    ['id' => 3, 'name' => 'Sunflower Surprise', 'price' => 3499, 'category' => 'bouquet', 'image' => '222.jpg' ],
    ['id' => 4, 'name' => 'Wedding Car Garland', 'price' => 7999, 'category' => 'car_decor', 'image' => 'car2.jpg'],
    ['id' => 5, 'name' => 'Just Married Car Kit', 'price' => 5999, 'category' => 'car_decor', 'image' => 'car3.jpg'],
    ['id' => 6, 'name' => 'Magnetic Car Corsage', 'price' => 2499, 'category' => 'car_decor', 'image' => 'car1.jpg' ],
    ['id' => 7, 'name' => 'Bridal Bouquet Deluxe', 'price' => 12999, 'category' => 'wedding', 'image' => 'decor3.jpg'],
    ['id' => 8, 'name' => 'Centerpiece Collection', 'price' => 19999, 'category' => 'wedding', 'image' => 'decor2.jpg'],
    ['id' => 9, 'name' => 'Arch Decoration Kit', 'price' => 24999, 'category' => 'wedding', 'image' => 'decor12.jpg'],
    ['id' => 1, 'name' => 'Romantic Red Roses', 'price' => 4999, 'image' => 'rs.jpg'],
    ['id' => 2, 'name' => 'Spring Melody', 'price' => 3999, 'image' => '77.jpg'],
    ['id' => 3, 'name' => 'Elegant White', 'price' => 5499, 'image' => 'white1.jpg'],
    ['id' => 4, 'name' => 'Sunset Dream', 'price' => 4499, 'image' => 'sun3.jpg'],
    ['id' => 5, 'name' => 'Wedding Car Garland', 'price' => 7999, 'image' => 'car.jpg'],
    ['id' => 6, 'name' => ' Marry Banner', 'price' => 2499, 'image' => 'marry.jpg'],
    ['id' => 7, 'name' => 'Floral Car Door Magnets', 'price' => 3499, 'image' => 'car0.jpg'],
    ['id' => 8, 'name' => 'Car Hood Arrangement', 'price' => 8999, 'image' => 'car1.jpg'],
    ['id' => 9, 'name' => 'Intimate Elegance Package', 'price' => 199999, 'image' => 'decor1.jpg'],
    ['id' => 10, 'name' => 'Grand Celebration Package', 'price' => 399999, 'image' => 'decor.jpg'],
    ['id' => 11, 'name' => 'Rustic Romance Package', 'price' => 249999, 'image' => 'w3.jpg'],
];

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity > 0) {
            $_SESSION['cart'][$id] = $quantity;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * $quantity;
    }
}

// Get cart count
$cart_count = array_sum($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowSun - Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            color: #333;
        }
        .navbar {
            background-color: #006747;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }
        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }
        .footer {
            background-color: #006747;
            color: #fff;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .cart-item-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">FlowSun</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <form class="d-flex me-2" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <a href="cart.php" class="btn btn-outline-light position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                        <?php echo $cart_count; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-center mb-4">Your Shopping Cart</h1>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-info" role="alert">
                Your cart is empty. <a href="shop.php" class="alert-link">Continue shopping</a>.
            </div>
        <?php else: ?>
            <form method="post" action="cart.php">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                            <?php if (isset($products[$id])): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($products[$id]['image']); ?>" alt="<?php echo htmlspecialchars($products[$id]['name']); ?>" class="cart-item-image me-3">
                                        <?php echo htmlspecialchars($products[$id]['name']); ?>
                                    </td>
                                    <td>$<?php echo number_format($products[$id]['price'], 2); ?></td>
                                    <td>
                                        <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $quantity; ?>" min="0" class="form-control" style="width: 80px;">
                                    </td>
                                    <td>$<?php echo number_format($products[$id]['price'] * $quantity, 2); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex justify-content-between">
                    <a href="shop.php" class="btn btn-secondary">Continue Shopping</a>
                    <div>
                        <button type="submit" name="update_cart" class="btn btn-primary me-2">Update Cart</button>
                        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase">FlowSun</h5>
                    <p class="small">Bringing nature's beauty to your doorstep since 2010.</p>
                    <ul class="list-inline">
                        
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase">Shop</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="shop.php">All Products</a></li>
                        <li><a href="boquet.php">Featured Bouquets</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Discounts</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="">Careers</a></li>
                        <li><a href="">FAQ</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase">Newsletter</h6>
                    <p class="small">Sign up to receive flower care tips, special offers, and more!</p>
                    <form action="form.php" method="POST">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="button-addon2" required>
                            <button class="btn btn-outline-light" type="submit" id="button-addon2">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="small mb-0">&copy; 2024 FlowSun. All rights reserved.</p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <ul class="list-inline text-md-end mb-0">
                        <li class="list-inline-item"><a href="#" class="small">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#" class="small">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

