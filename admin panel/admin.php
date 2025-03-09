<?php
$conn = mysqli_connect("localhost", "root", "", "note_sharing");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Remove the early exit
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        if (($password == $hashed_password)) {
            header('location: ../pages/uploadpage.html');
            exit;
        } else {
            echo "Invalid credentials";
            exit;
        }
    } else {
        echo "No data found";
        exit;
    }
}

mysqli_close($conn);
?>
