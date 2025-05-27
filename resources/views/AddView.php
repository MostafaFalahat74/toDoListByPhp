<!DOCTYPE html>
<html>
<head>
    <title>افزودن وظیفه</title>
    <link rel="stylesheet" href="/public/Style.css">
</head>
<body>
<div class="add-task-container">
<!--    --><?php //if ($error): ?>
<!--        <p class="error-message">ffffffffffffffffff--><?php //echo $error[0]; ?><!--</p>-->
<!--    --><?php //endif; ?>
    <h1>افزودن وظیفه جدید</h1>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="/add" method="post" class="add-task-form">
        <input type="text" name="task" placeholder="افزودن وظیفه جدید" required>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">افزودن</button>
    </form>
    <a href="/toDoList/" class="back-link">بازگشت به لیست</a>
</div>
</body>
</html>