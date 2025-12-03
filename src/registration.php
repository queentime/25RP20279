<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

    <h2>Registration Page</h2>

    <form action="registration.php" method="POST">

        <label>First Name:</label><br>
        <input type="text" name="firstname" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastname" required><br><br>

        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>

    <br>
    <a href="index.php">Back to Home</a>

</body>
</html>

