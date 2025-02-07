
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        $stmt->execute([$email, $password]);
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        $error = 'البريد الإلكتروني مستخدم مسبقاً!';
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>التسجيل</title>
    <style>/* نفس ستايل صفحة الدخول */</style>
</head>
<body>
    <h1>إنشاء حساب جديد</h1>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <div class="form-group">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="كلمة المرور" required>
        </div>
        <button type="submit">إنشاء حساب</button>
    </form>
    <p>لديك حساب؟ <a href="login.php">سجل الدخول</a></p>
</body>
</html>