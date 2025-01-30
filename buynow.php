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

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$product = isset($products[$product_id]) ? $products[$product_id] : null;

if (!$product) {
    header('Location: shop.php');
    exit;
}

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Process form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['name', 'email', 'phone', 'address', 'city', 'country', 'zip', 'payment_method'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    // Validate email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate phone (simple check for digits only)
    if (!preg_match('/^[0-9]+$/', $_POST['phone'])) {
        $errors[] = 'Phone number should contain only digits.';
    }

    // Validate zip code (simple check for alphanumeric characters)
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['zip'])) {
        $errors[] = 'Invalid ZIP code format.';
    }

    if (empty($errors)) {
        // In a real application, you would process the payment and save the order here
        $_SESSION['order_confirmation'] = [
            'product' => $product['name'],
            'price' => $product['price'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'zip' => $_POST['zip'],
            'payment_method' => $_POST['payment_method'],
        ];
        header('Location: order_confirmation.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowSun - Buy Now</title>
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
        .card-img-top {
            height: 200px;
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
                    <li class="nav-item"><a class="nav-link" href="car_decor.php">Car Decor</a></li>
                    <li class="nav-item"><a class="nav-link" href="wedding.php">Wedding</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a href="cart.php" class="btn btn-outline-light position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $cart_count; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-center mb-4">Buy Now</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text">Price: ₹<?php echo number_format($product['price'], 2); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form method="post" action="buynow.php?product_id=<?php echo $product_id; ?>" class="needs-validation" novalidate>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter your full name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]+" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter a valid phone number (digits only).
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter your country.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" required pattern="[a-zA-Z0-9]+" value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : ''; ?>">
                        <div class="invalid-feedback">
                            Please enter a valid ZIP code.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="">Select a payment method</option>
                            <option value="credit_card" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 'credit_card') ? 'selected' : ''; ?>>Credit Card</option>
                            <option value="paypal" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 'paypal') ? 'selected' : ''; ?>>PayPal</option>
                            <option value="bank_transfer" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 'bank_transfer') ? 'selected' : ''; ?>>Bank Transfer</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a payment method.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>
        </div>
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