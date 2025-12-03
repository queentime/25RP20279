<?php
session_start();

$host = "db";
$user = "root";
$password = "example_password";
$database = "25rp20279_shareride_db";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, user_firstname, user_password FROM tbl_users WHERE user_email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1){
        $stmt->bind_result($user_id, $user_firstname, $hashed_password);
        $stmt->fetch();

        if(password_verify($password, $hashed_password)){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_firstname'] = $user_firstname;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if(isset($_SESSION['success'])) { echo "<p style='color:green;'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); } ?>
<form method="POST">
<label>Email:</label><br><input type="email" name="email" required><br>
<label>Password:</label><br><input type="password" name="password" required><br><br>
<input type="submit" name="login" value="Login">
</form>
<p>Not registered? <a href="register.php">Register here</a></p>
</body>
</html>
