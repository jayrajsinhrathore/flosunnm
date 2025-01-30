<?php
session_start();

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in
?>

<?php
// Simulated product data for demonstration purposes
$products = [
    ['id' => 1, 'name' => 'Red Roses', 'price' => 2000, 'image' => 'rose.jpg'],
    ['id' => 2, 'name' => 'Tulip Bouquet', 'price' => 2500, 'image' => 'tulip2.jpg'],
    ['id' => 3, 'name' => 'Sunflowers', 'price' => 1500, 'image' => '444.jpg'],
    ['id' => 4, 'name' => 'Lily Bouquet', 'price' => 3000, 'image' => 'lily.jpg'],
    ['id' => 5, 'name' => 'Orchid Arrangement', 'price' => 3500, 'image' => '4.jpg'],
    ['id' => 6, 'name' => 'Tulip Bouquet', 'price' => 2500, 'image' => 'tulip3.jpg']
];

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in

// Search functionality
$search_results = [];
if (isset($_GET['search'])) {
    $search_term = strtolower($_GET['search']);
    $search_results = array_filter($products, function($product) use ($search_term) {
        return strpos(strtolower($product['name']), $search_term) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowSun - Flower Shop</title>
    <!-- Bootstrap -->
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
        .dropdown-menu {
            background-color: #006747;
        }
        .dropdown-item {
            color: #fff;
        }
        .dropdown-item:hover {
            background-color: #ffc107;
            color: #006747;
        }
        .card-img-wrapper {
            height: 200px;
            overflow: hidden;
        }
        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card:hover .card-img-top {
            transform: scale(1.05);
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
        .round-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #006747;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #006747;
            border-radius: 6px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #004d34;
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
                <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="boquet.php">Bouquets</a></li>
                        <li><a class="dropdown-item" href="car_decor.php">Car Decor</a></li>
                        <li><a class="dropdown-item" href="wedding.php">Wedding Events</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-2" role="search" action="shop.php" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <a href="cart.php" class="btn btn-outline-light me-2">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge bg-danger"><?php echo $cart_count; ?></span>
            </a>
            <div>
                <a href="<?php echo $is_logged_in ? 'profile.php' : 'login.php'; ?>">
                    <img src="<?php echo $is_logged_in ? 'images/custom-profile.jpg' : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png'; ?>" 
                         alt="User" 
                         style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%;">
                </a>
            </div>
        </div>
    </div>
</nav>

    <!-- Carousel for Discounts/Offers -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="bg.png" class="d-block w-100" alt="Discount Offer 1" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Exclusive 30% Off on Flowers</h5>
                    <p>Grab your favorite flowers now at a discounted price!</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="11.jpg" class="d-block w-100" alt="Discount Offer 2" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Buy 1 Get 1 Free</h5>
                    <p>Perfect for gifting someone special.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Round Images Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-3 mb-4">
                    <img src="22.jpg" alt="Fresh Flowers" class="round-image mb-3">
                    <h5>Fresh Flowers</h5>
                </div>
                <div class="col-md-3 mb-4">
                    <img src="bq6.jpg" alt="Custom Bouquets" class="round-image mb-3">
                    <h5>Custom Bouquets</h5>
                </div>
                <div class="col-md-3 mb-4">
                    <img src="66.jpg" alt="Same Day Delivery" class="round-image mb-3">
                    <h5>Same Day Delivery</h5>
                </div>
                <div class="col-md-3 mb-4">
                    <img src="333.jpg" alt="Eco-Friendly" class="round-image mb-3">
                    <h5>Eco-Friendly</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-flowers py-5" id="shop">
        <div class="container">
            <h2 class="text-center mb-4">Our Featured Flowers</h2>
            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrapper">
                            <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text">Price: ₹<?= number_format($product['price'], 2) ?></p>
                            <div class="mt-auto">
                                <a href="buynow.php?product_id=<?= $product['id'] ?>" class="btn btn-success mb-2 w-100">Buy Now</a>
                                <a href="cart.php?product_id=<?= $product['id'] ?>" class="btn btn-success w-100" onclick="showToast()">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Toast Notification -->
    <div class="toast position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="images/flower-icon.jpg" class="rounded me-2" alt="Flower Icon" style="width: 20px; height: 20px;">
            <strong class="me-auto">Added to Cart</strong>
            <small>Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Your item has been added to the cart successfully.
        </div>
    </div>

    <!-- Footer -->
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
    <script>
        // Toast display on "Add to Cart" click
        function showToast() {
            var toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    </script>
</body>
</html>

