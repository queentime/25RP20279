<?php
// Start session
session_start();

// Database configuration
$host = "25rp20279_db"; // MySQL container name
$user = "root";
$password = "example_password";
$database = "25rp20279_shareride_db";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form submitted
if(isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $gender    = $_POST['gender'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM tbl_users WHERE user_email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    
    if($result->num_rows > 0){
        $error = "Email already registered!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO tbl_users (user_firstname, user_lastname, user_gender, user_email, user_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $password);
        
        if($stmt->execute()){
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label>First Name:</label><br>
        <input type="text" name="firstname" required><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastname" required><br>

        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>
    <p>Already registered? <a href="login.php">Login here</a></p>
</body>
</html>

