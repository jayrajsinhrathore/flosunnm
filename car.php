<?php
session_start();

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in

$page_title = "Car Decor";

// Simulated product data (in a real application, this would come from a database)
$products = [
    ['id' => 5, 'name' => 'Wedding Car Garland', 'price' => 7999, 'image' => 'car.jpg'],
    ['id' => 6, 'name' => ' Marry Banner', 'price' => 2499, 'image' => 'marry.jpg'],
    ['id' => 7, 'name' => 'Floral Car Door Magnets', 'price' => 3499, 'image' => 'car0.jpg'],
    ['id' => 8, 'name' => 'Car Hood Arrangement', 'price' => 8999, 'image' => 'car1.jpg'],
];

// Handle Add to Cart action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    $cart_count = array_sum($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowSun - <?php echo $page_title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #006747;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }
        .btn-outline-light:hover {
            background-color: #ffc107;
            color: #006747;
        }
        .footer {
            background-color: #006747;
            color: #ffffff;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-flowsun {
            background-color: #006747;
            border-color: #006747;
            color: #ffffff;
        }
        .btn-flowsun:hover {
            background-color: #005239;
            border-color: #005239;
            color: #ffffff;
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
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="boquet.php">Bouquets</a></li>
                            <li><a class="dropdown-item active" href="car.php">Car Decor</a></li>
                            <li><a class="dropdown-item" href="wedding.php">Wedding Events</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

                <a href="cart.php" class="btn btn-outline-light position-relative me-2 ms-3">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $cart_count; ?>
                    </span>
                </a>

                <div class="ms-3">
                    <a href="form.php">
                        <img src="<?= $is_logged_in ? 'images/custom-profile.jpg' : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' ?>" 
                             alt="User" 
                             style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%;">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h1 class="text-center mb-5">Car Decor</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text flex-grow-1">Beautiful floral decorations for your car</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5 mb-0">₹<?php echo number_format($product['price']); ?></span>
                            <div>
                                <form method="post" action="car_decor.php" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-flowsun btn-sm me-2">Add to Cart</button>
                                </form>
                                <a href="buynow.php?product_id=<?php echo $product['id']; ?>" class="btn btn-flowsun btn-sm">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
