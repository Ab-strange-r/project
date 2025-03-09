<?php
session_start(); // Start a session if needed

$conn = mysqli_connect("localhost", "root", "", "note_sharing");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $stmt = $conn->prepare("SELECT Password FROM admin WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        // Use password_verify if passwords are hashed
        if (password_verify($password, $hashed_password)) {
            // Successful login, redirect to front page
            header("Location: http://127.0.0.1:5500/front%20page/frontpage.html");
            exit;
        } else {
            echo "<script>alert('Invalid Credentials!'); window.location.href='login.html';</script>";
            exit;
        }
    } else {
        echo "<script>alert('No account found! Please register.'); window.location.href='http://127.0.0.1:5500/registration/registration.html';</script>";
        exit;
    }
}

mysqli_close($conn);
?>
