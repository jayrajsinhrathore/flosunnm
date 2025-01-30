<?php
session_start();

// Simulated product data (in a real application, this would come from a database)
$products = [
    // Bouquets
    ['id' => 1, 'name' => 'Romantic Red Roses', 'price' => 4999, 'category' => 'bouquet', 'image' => 'bq3.jpg', 'description' => 'A classic bouquet of 12 red roses'],
    ['id' => 2, 'name' => 'Spring Melody', 'price' => 3999, 'category' => 'bouquet', 'image' => 'bq4.jpg', 'description' => 'Colorful mix of spring flowers'],
    ['id' => 3, 'name' => 'Sunflower Surprise', 'price' => 3499, 'category' => 'bouquet', 'image' => '222.jpg', 'description' => 'Bright sunflowers with mixed greens'],
    
    // Car Decor
    ['id' => 4, 'name' => 'Wedding Car Garland', 'price' => 7999, 'category' => 'car_decor', 'image' => 'car2.jpg', 'description' => 'Elegant floral garland for car decoration'],
    ['id' => 5, 'name' => 'Just Married Car Kit', 'price' => 5999, 'category' => 'car_decor', 'image' => 'car3.jpg', 'description' => 'Complete car decoration kit with flowers and banner'],
    ['id' => 6, 'name' => 'Magnetic Car Corsage', 'price' => 2499, 'category' => 'car_decor', 'image' => 'car1.jpg', 'description' => 'Set of 2 magnetic floral corsages for car doors'],
    
    // Wedding Events
    ['id' => 7, 'name' => 'Bridal Bouquet Deluxe', 'price' => 12999, 'category' => 'wedding', 'image' => 'decor3.jpg', 'description' => 'Luxurious bridal bouquet with premium flowers'],
    ['id' => 8, 'name' => 'Centerpiece Collection', 'price' => 19999, 'category' => 'wedding', 'image' => 'decor2.jpg', 'description' => 'Set of 10 elegant table centerpieces'],
    ['id' => 9, 'name' => 'Arch Decoration Kit', 'price' => 24999, 'category' => 'wedding', 'image' => 'decor12.jpg', 'description' => 'Complete floral kit for decorating a wedding arch']
];

// Filter products based on category
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
$filtered_products = $products;
if ($category) {
    $filtered_products = array_filter($products, function($product) use ($category) {
        return $product['category'] === $category;
    });
}

// Sort products
$sort = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : '';
if ($sort === 'price_asc') {
    usort($filtered_products, function($a, $b) { return $a['price'] <=> $b['price']; });
} elseif ($sort === 'price_desc') {
    usort($filtered_products, function($a, $b) { return $b['price'] <=> $a['price']; });
}

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'], $_POST['product_id'])) {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    if ($product_id !== false && $product_id !== null) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
    }
}

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in

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
        .category-title {
            color: #006747;
            border-bottom: 2px solid #006747;
            padding-bottom: 0.5rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
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
                <li class="nav-item"><a class="nav-link active" href="shop.php">Shop</a></li>
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

    <div class="container my-5">
        <h1 class="text-center mb-4">Our Beautiful Flower Collection</h1>
        
        <div class="mb-4">
            <form class="d-flex justify-content-end" action="shop.php" method="GET">
                <select class="form-select w-auto" name="sort" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                </select>
                <?php if ($category): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                <?php endif; ?>
            </form>
        </div>
        
        <?php
        $current_category = '';
        foreach ($filtered_products as $index => $product):
            if ($product['category'] !== $current_category):
                $current_category = $product['category'];
                echo '<h2 class="category-title">' . htmlspecialchars(ucfirst(str_replace('_', ' ', $current_category))) . '</h2>';
            endif;

            if ($index === 0 || $product['category'] !== $filtered_products[$index - 1]['category']):
                echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">';
            endif;
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-wrapper">
                        <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="card-text mt-auto"><strong>₹<?= number_format($product['price'], 2) ?></strong></p>
                        <div class="mt-2">
                            <a href="buynow.php?product_id=<?= $product['id'] ?>" class="btn btn-success w-100 mb-2">Buy Now</a>
                            <form method="post" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-success w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            if ($index === count($filtered_products) - 1 || $product['category'] !== $filtered_products[$index + 1]['category']):
                echo '</div>';
            endif;
        endforeach;
        ?>
    </div>

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
                        <li class="list-inline-item"><a href="#" class="btn btn-outline-light btn-sm fa fa-facebook"></a></li>
                        <li class="list-inline-item"><a href="#" class="btn btn-outline-light btn-sm fa fa-twitter"></a></li>
                        <li class="list-inline-item"><a href="#" class="btn btn-outline-light btn-sm fa fa-instagram"></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase">Shop</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="shop.php">All Products</a></li>
                        <li><a href="shop.php?category=bouquet">Bouquets</a></li>
                        <li><a href="shop.php?category=car_decor">Car Decor</a></li>
                        <li><a href="shop.php?category=wedding">Wedding Events</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
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
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl);
            });
            
            var addToCartButtons = document.querySelectorAll('button[name="add_to_cart"]');
            addToCartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    toastList[0].show();
                });
            });
        });
    </script>
</body>
</html>

