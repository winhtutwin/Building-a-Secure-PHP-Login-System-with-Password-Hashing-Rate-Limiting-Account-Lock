<?php
    session_start();
    require 'config/connect.php';
    if(isset($_POST['login'])){
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        if(empty($email)){
            $errors['email'] = "is required.";
        }
        if(empty($password)){
            $errors['password'] = "is required.";
        }
        if(empty($errors)){
            // database ထဲမှာ email ရှိမရှိ စစ်ဆေးမယ်။
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute ([":email" => $email]);
            $user = $stmt -> fetch();
            if(empty($user)){
                // email မရှိတာကို အတိအကျ မပြောဘဲ email or password မှားနေပါတယ်ဆိုပြီး ပြထားတာဖြစ်တယ်။
                $errors['general'] = "Invalid email or password";
            }else{

                // အကောင့်ပိတ်ခံထားရမှု အခြေအနေကို စစ်ဆေးမယ်။
                if(!empty($user['locked_until']) && strtotime($user['locked_until']) > time()){
                    $remaining = strtotime($user['locked_until']) - time();
                    $minutes = ceil($remaining / 60);
                    $errors['general'] = "Account is locked. Try again in {$minutes} minute(s).";
                }else{
                    if(password_verify($password, $user["password"])){
                        // password မှန်ခဲ့ရင် successful login
                        // password မှားခဲ့ရင် မှားခဲ့ဘူးတဲ့ အကြိမ်အရေအတွက်ကို reset လုပ်မယ်။
                        $reset = "UPDATE users SET failed_attempts = 0, locked_until = NULL WHERE id = :id";
                        $resetstmt = $pdo -> prepare($reset);
                        $resetstmt -> execute([":id" => $user["id"]]);

                        // session data အနေနဲ့ user data ကိုသိမ်းမယ်။
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['first_name']." ".$user['last_name'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['success_login'] = "Login Successful! Welcome to dashboard panel.";
                        header("Location: dashboard.php");
                        exit();
                    }else{
                        // failed login
                        $failedAttempts = $user["failed_attempts"] + 1;
                        if($failedAttempts >= 3){
                            // ၃ကြိမ်နှင့်အထက် မှားပါက ၁မိနစ် Lock ချမယ်။
                            $lockedUntil = date("Y-m-d H:i:s",strtotime("+1 minutes"));
                            $lockedSql = "UPDATE users SET failed_attempts = 0, locked_until = :locked_until WHERE id = :id";
                            $lockedStmt = $pdo -> prepare($lockedSql);
                            $lockedStmt -> execute([
                                ":locked_until" => $lockedUntil,
                                ":id" => $user['id']
                            ]);
                            $errors['general'] = "Too many failed attempts. Account locked for 1 minute.";
                        }else{
                            // ၃ကြိမ်မပြည့်သေးရင် အကြိမ်အရေအတွက် တိုးပေးရမယ်။
                            $updateSql = "UPDATE users SET failed_attempts = :failed_attempts WHERE id = :id";
                            $updateStmt = $pdo -> prepare($updateSql);
                            $updateStmt -> execute([
                                ":failed_attempts" => $failedAttempts,
                                ":id" => $user['id']
                            ]);
                            $remainingAttempts = 3 - $failedAttempts;
                            $errors['general'] = "Invalid email or password. Remaining attempts: {$remainingAttempts}";
                        }
                    }
                }
            }
        }
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

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card register-card w-100 p-4 p-md-5 bg-white">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Login</h2>
                <p class="text-muted">Welcome back to Demo!</p>
            </div>
            <?php
                if(isset($errors['general'])){
                    echo "<div class='alert alert-danger error-box error-msg py-2 px- 3 mb-3' role='alert'>".htmlspecialchars($errors['general'])."</div>";
                }
            ?>
            <?php
                if(isset($_SESSION['success_message'])){
                    echo "<div class='alert alert-success error-box error-msg py-2 px- 3 mb-3' role='alert'>".htmlspecialchars($_SESSION['success_message'])."</div>";
                    unset($_SESSION['success_message']);
                }
            ?>
            <form action="" method="POST">
                <div class="row g-3 mb-3">
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
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>