<?php
session_start();
require_once "../db.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM admins WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

    <h2>Admin Login</h2>

    <p style="color:red;">
        <?php echo htmlspecialchars($error); ?>
    </p>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit" name="login">Login</button>
    </form>

</body>
</html>