<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="/toDoList/public/Style.css">
</head>
<body>
<h1>To-Do List</h1>

<?php if (isset($_GET['success'])): ?>
    <p class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></p>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<ul>
    <?php if (empty($tasks)): ?>
        <li>هیچ وظیفه‌ای وجود ندارد.</li>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <li>
                <form method="post" action="/toDoList/complete/" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <input type="hidden" name="completed" value="<?php echo $task['is_completed'] ? 0 : 1; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?php if ($task['is_completed']): ?>checked<?php endif; ?>>
                </form>

                <span class="<?php if ($task['is_completed']): ?>completed<?php endif; ?>"><?php echo htmlspecialchars($task['task']); ?></span>
                <div class="actions">
                    <a href="/toDoList/delete/?id=<?php echo $task['id']; ?>" class="delete">حذف</a>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<a href="/toDoList/add/" class="go_to_add_page">افزودن</a>
</body>
</html>