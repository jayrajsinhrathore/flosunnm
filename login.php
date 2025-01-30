<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']); // Make sure this is set correctly
?>




<?php
$cart_count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- jQuery and jQuery Validation Plugin -->
    <script src="jquery-3.7.1.min.js"></script>
    <script src="addtional-method.js"></script>
    <script src="jquery.validate.js"></script>

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

<script>
        $(document).ready(function () {
            // Custom validation rule for password strength
            $.validator.addMethod("passwordCheck", function (value) {
                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
            }, "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.");

            // Initialize jQuery validation
            $("#registrationForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        passwordCheck: true
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        required: "Please enter a username.",
                        minlength: "Username must be at least 2 characters long."
                    },
                    email: {
                        required: "Please enter an email address.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please enter a password.",
                        minlength: "Password must be at least 8 characters long."
                    },
                    confirmPassword: {
                        required: "Please confirm your password.",
                        equalTo: "Passwords do not match."
                    }
                },
                errorClass: "text-danger",
                validClass: "text-success"
            });
        });
    </script>
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
            <div>
                <a href="<?php echo $is_logged_in ? 'profile.php' : 'login.php'; ?>">
                    <img src="<?php echo $is_logged_in ? 'images/pfp.webp' : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png'; ?>" 
                         alt="User" 
                         style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%;">
                </a>
            </div>
        </div>
    </div>
    </nav>
<div class="container">
    <div class="card shadow">
        <div class="card-header text-center">
            <h3>Registration Form</h3>
        </div>
        <div class="card-body">
            <form id="registrationForm" method="post">
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <small class="text-muted">Password must contain uppercase, lowercase, numbers, and special characters.</small>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="insert_data">Register</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- PHP Backend -->
<?php
if (isset($_POST['insert_data'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $passwordd = htmlspecialchars(trim($_POST['password']));

    $con = mysqli_connect("localhost", "root", "", "registration_form");

    if (!$con) {
        echo "<div class='alert alert-danger mt-4'>Error connecting to the database.</div>";
    } else {
        $query = "INSERT INTO students (username, email, passwordd) VALUES ('$username', '$email', '$passwordd')";

        if ($con->query($query) === TRUE) {
            echo "<div class='alert alert-success mt-4'>Data has been inserted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Error inserting data: " . $con->error . "</div>";
        }

        mysqli_close($con);
    }
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

