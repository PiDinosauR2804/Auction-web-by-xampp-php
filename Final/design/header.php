<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
 
    <title>Simple PHP CRUD</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                <?php if(isset($_SESSION['id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="../cart.php">Shopping Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ResForSell.php">Register for Selling</a></li>
                    <li class="nav-item"><a class="nav-link" href="../auction.php">Auction</a></li>
                    <li class="nav-item"><a class="nav-link" href="../profile.php">Profile</a></li>
                    <?php if($_SESSION['id'] == -1): ?>
                        <li class="nav-item"><a class="nav-link" href="Manage.php">Manage Guest Request</a></li>
                    <?php else:?>
                        <li class="nav-item"><a class="nav-link" href="Recharge.php">Request</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="../User/account/logout.inc.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/signup.php">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>