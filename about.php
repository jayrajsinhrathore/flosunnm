<?php
session_start();

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in

// Get cart count (assuming cart is stored in session)
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FlowSun Flower Shop</title>
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
        .navbar-nav .nav-link {
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
        .about-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            margin-left: -1px;
            background-color: #006747;
        }
        .timeline > li {
            position: relative;
            margin-bottom: 50px;
        }
        .timeline > li:before,
        .timeline > li:after {
            content: " ";
            display: table;
        }
        .timeline > li:after {
            clear: both;
        }
        .timeline > li .timeline-panel {
            float: left;
            position: relative;
            width: 46%;
            padding: 20px;
            border: 1px solid #d4d4d4;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        }
        .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
        }
        .timeline > li .timeline-image {
            position: absolute;
            width: 80px;
            height: 80px;
            left: 50%;
            margin-left: -40px;
            z-index: 100;
            background-color: #006747;
            color: #fff;
            border-radius: 100%;
            border: 7px solid #f1f1f1;
            text-align: center;
        }
        .timeline > li .timeline-image h4 {
            font-size: 14px;
            margin-top: 12px;
            line-height: 14px;
        }
        .timeline > li.timeline-inverted > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }
        .timeline > li.timeline-inverted > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
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
                <li class="nav-item"><a class="nav-link" href="/home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link active" href="/about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/boquet.php">Bouquets</a></li>
                        <li><a class="dropdown-item" href="/car.php">Car Decor</a></li>
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
        <h1 class="text-center mb-5">About FlowSun Flower Shop</h1>
        
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="shop2.jpg" alt="FlowSun Flower Shop Interior" class="about-image">
            </div>
            <div class="col-md-6">
                <h2>Our Story</h2>
                <p>Founded in 2010, FlowSun Flower Shop has been bringing nature's beauty to doorsteps for over a decade. What started as a small family-owned business has blossomed into a beloved local institution, known for our exquisite floral arrangements and commitment to customer satisfaction.</p>
                <p>At FlowSun, we believe that flowers have the power to brighten any day and convey emotions words sometimes can't express. Our passion for floristry drives us to create stunning arrangements that capture the essence of every occasion.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Our Journey</h2>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <h4>2010</h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body">
                                <p>FlowSun opens its doors as a small corner shop with a dream to spread joy through flowers.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>2015</h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Expanding Our Reach</h4>
                            </div>
                            <div class="timeline-body">
                                <p>We launch our online store, bringing our beautiful arrangements to customers beyond our local area.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <h4>2018</h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Award-Winning Designs</h4>
                            </div>
                            <div class="timeline-body">
                                <p>FlowSun wins the local "Best Florist" award, recognizing our commitment to quality and creativity.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>2024</h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Growing Strong</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Today, we continue to grow, innovate, and spread happiness through our floral creations.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Our Values</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-heart fa-3x mb-3 text-primary"></i>
                        <h3>Passion</h3>
                        <p>We pour our heart into every arrangement, ensuring each bloom is perfect.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-leaf fa-3x mb-3 text-success"></i>
                        <h3>Sustainability</h3>
                        <p>We're committed to eco-friendly practices and sourcing from responsible growers.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-smile fa-3x mb-3 text-warning"></i>
                        <h3>Customer Happiness</h3>
                        <p>Your satisfaction is our top priority. We go above and beyond to make you smile.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Meet Our Team</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Jayrajsinh R.</h5>
                                <p class="card-text">Founder </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Taashi K.</h5>
                                <p class="card-text">Lead florist</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Tisha C.</h5>
                                <p class="card-text">Creative Director</p>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

