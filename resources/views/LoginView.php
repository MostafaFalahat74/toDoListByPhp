<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
    <link rel="stylesheet" href="/toDoList/public/Style.css">
</head>
<body>
<div class="login-container">
    <h1>ورود</h1>
    <?php if (!empty($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="/toDoList/login/">
        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <button type="submit">ورود</button>
    </form>
</div>
</body>
</html>