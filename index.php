<?php
session_start(); // شروع جلسه در ابتدای فایل

// بررسی وضعیت ورود کاربر
if (!isset($_SESSION['user_id'])) {
    // اگر کاربر لاگین نکرده است، به صفحه لاگین ریدایرکت شود
    header('Location: login_process.php');
    exit();
}

require 'db.php';
require 'Todo.php';
$database = new Database();
$pdo = $database->getConnection();
$todoManager = new Todo($pdo);
 $tasks = $todoManager->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-Do List</h1>

    <ul>
        <?php if (empty($tasks)): ?>
            <li>هیچ وظیفه‌ای وجود ندارد.</li>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <input type="checkbox" <?php if ($task['is_completed']): ?>checked<?php endif; ?> onclick="window.location='complete.php?id=<?php echo $task['id']; ?>'">
                    <span class="<?php if ($task['is_completed']): ?>completed<?php endif; ?>"><?php echo htmlspecialchars($task['task']); ?></span>
                    <div class="actions">
                        <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete">حذف</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <form action="add.php" method="post">
        <input type="text" name="task" placeholder="افزودن وظیفه جدید" required>
        <button type="submit">افزودن</button>
    </form>
</body>
</html>