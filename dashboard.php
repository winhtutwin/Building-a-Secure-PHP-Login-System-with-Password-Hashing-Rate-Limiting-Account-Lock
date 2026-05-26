<?php
    session_start();
    require 'config/connect.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm ms-lg-3 mt-1 px-3" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
                    <?php
                        if(isset($_SESSION['success_login'])){
                            echo $_SESSION['success_login'];
                        }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="card dashboard-card p-4 p-md-5 bg-white text-center">
                    <div class="avatar-circle shadow-sm">
                        <?php
                            $firstLetter = mb_substr($_SESSION['user_name'], 0, 1, "UTF-8");
                            echo htmlspecialchars(strtoupper($firstLetter));
                        ?>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h3>
                    <hr class="text-muted my-4">
                    <div class="text-start bg-light p-3 rounded-3 mb-4">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">User ID: </div>
                            <div class="col-8 text-dark">#<?php echo htmlspecialchars($_SESSION['user_id']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">Email: </div>
                            <div class="col-8 text-dark"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>