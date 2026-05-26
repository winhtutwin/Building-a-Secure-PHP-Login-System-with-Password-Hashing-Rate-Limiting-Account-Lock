<?php
    session_start();
    require 'config/connect.php';
    if(isset($_POST['register'])){
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];
        if($first_name === ""){
            $errors['first_name'] = "is required.";
        }
        if($last_name === ""){
            $errors['last_name'] = "is required.";
        }
        if($email === ""){
            $errors['email'] = "is required.";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid email format.";
        }
        if($password === ""){
            $errors['password'] = "is required.";
        }else if(strlen($password) < 6){
            $errors['password'] = "Password must be at least 6 characters.";
        }
        if($confirm === ""){
            $errors['confirm'] = "is required.";
        }else if($password !== $confirm){
            $errors['confirm'] = "Password do not match.";
        }

        if(empty($errors)){
            $checksql = "SELECT id FROM users WHERE email = :email LIMIT 1";
            $stmt = $pdo -> prepare($checksql);
            $stmt -> execute([':email' => $email]);
            if($stmt -> fetch()){
                $errors['email'] = "Email already registered.";
            }else{
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $insert = "INSERT INTO users (first_name,last_name,email,password) VALUES (:first_name,:last_name,:email,:password)";
                $stmt = $pdo -> prepare($insert);
                $stmt -> execute([
                    ":first_name" => $first_name,
                    ":last_name" => $last_name,
                    ":email" => $email,
                    ":password" => $hash
                ]);
                $_SESSION['success_message'] = "Registration Successful. Please Login.";
                header("Location: login.php");
                exit();
            }
        }


    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card register-card w-100 p-4 p-md-5 bg-white">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Register</h2>
                <p class="text-muted">Join Demo Today!</p>
            </div>
            <form action="" method="POST">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-semibold text-secondary">First Name</label>
                        <input type="text" class="form-control <?php echo isset($errors['first_name']) ? 'is-invalid' : ''; ?>" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>">
                        <div class="error-container">
                            <?php
                                if(isset($errors['first_name'])){
                                    echo "<span class='error-msg'>".$errors['first_name']."</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-semibold text-secondary">Last Name</label>
                        <input type="text" class="form-control <?php echo isset($errors['last_name']) ? 'is-invalid' : ''; ?>" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>">
                        <div class="error-container">
                            <?php
                                if(isset($errors['last_name'])){
                                    echo "<span class='error-msg'>".$errors['last_name']."</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <div>
                        <label class="form-label fw-semibold text-secondary">Email Address</label>
                        <input type="text" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        <div class="error-container">
                            <?php
                                if(isset($errors['email'])){
                                    echo "<span class='error-msg'>".$errors['email']."</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <div>
                        <label class="form-label fw-semibold text-secondary">Password</label>
                        <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password" value="<?php echo htmlspecialchars($password ?? ''); ?>">
                        <div class="error-container">
                            <?php
                                if(isset($errors['password'])){
                                    echo "<span class='error-msg'>".$errors['password']."</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <div>
                        <label class="form-label fw-semibold text-secondary">Confirm Password</label>
                        <input type="password" class="form-control <?php echo isset($errors['confirm']) ? 'is-invalid' : ''; ?>" name="confirm_password" value="<?php echo htmlspecialchars($confirm ?? ''); ?>">
                        <div class="error-container">
                            <?php
                                if(isset($errors['confirm'])){
                                    echo "<span class='error-msg'>".$errors['confirm']."</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm" name="register">Register</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-muted">Already have an account ? <a href="login.php" class="text-primary text-decoration-none fw-semibold">Login</a></p>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>