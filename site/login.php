
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'بيانات الدخول غير صحيحة';
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body { text-align: center; margin-top: 50px; }
        .form-group { margin: 15px 0; }
        input { padding: 8px; width: 250px; }
    </style>
</head>
<body>
    <h1>تسجيل الدخول</h1>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <div class="form-group">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="كلمة المرور" required>
        </div>
        <button type="submit">تسجيل الدخول</button>
    </form>
    <p>ليس لديك حساب؟ <a href="register.php">سجل هنا</a></p>
</body>
</html>