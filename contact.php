<?php
session_start();

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Simulated login check (replace with actual session/authentication logic)
$is_logged_in = false; // Set to true when the user is logged in

$page_title = "Contact Us";

$message = '';
$message_class = '';

// Basic server-side validation and form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $user_message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($user_message)) {
        $message = "Please fill in all fields.";
        $message_class = "alert-danger";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $message_class = "alert-danger";
    } else {
        // Process the form (e.g., send email, save to database)
        // This is a placeholder for actual form processing logic
        $message = "Thank you for your message. We'll get back to you soon!";
        $message_class = "alert-success";
    }
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
        .contact-form {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            background-color: #006747;
            color: #ffffff;
            border-radius: 15px;
        }
        .contact-info i {
            font-size: 24px;
            margin-right: 10px;
        }
        .map-container {
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
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


    <main class="container my-5">
        <h1 class="text-center mb-5">Contact Us</h1>
        <?php if (!empty($message)): ?>
            <div class="alert <?php echo $message_class; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="contact-form p-4">
                    <h2 class="mb-4">Send Us a Message</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Please enter your name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                            <div class="invalid-feedback">
                                Please enter a subject.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                Please enter your message.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-flowsun">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="contact-info p-4 mb-4">
                    <h2 class="mb-4">Get in Touch</h2>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Flower Street, Garden City, Rajkot </p>
                    <p><i class="fas fa-phone"></i> 9173434743</p>
                    <p><i class="fas fa-envelope"></i> info@flowsun.com</p>
                    <p><i class="fas fa-clock"></i> Monday - Friday: 9:00 AM - 6:00 PM</p>
                    <p><i class="fas fa-clock"></i> Saturday: 10:00 AM - 4:00 PM</p>
                    <p><i class="fas fa-clock"></i> Sunday: Closed</p>
                </div>
               
            </div>
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
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
    </script>
</body>
</html>

