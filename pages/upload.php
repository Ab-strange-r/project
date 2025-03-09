<?php
$conn = mysqli_connect("localhost", "root", "", "note_sharing");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdf = $_FILES['pdf']['tmp_name'];
        $pdf_name = $_FILES['pdf']['name'];
        $noteCategory = $_POST['noteCategory'];

        
        $uploadDir = 'uploads/';

        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        
        $destination = $uploadDir . basename($pdf_name);
        if (move_uploaded_file($pdf, $destination)) {
            
            $stmt = $conn->prepare("INSERT INTO admin_notes (title, content, admin_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $noteCategory, $destination, 1); // Assuming admin_id is 1 for simplicity

            if ($stmt->execute()) {
                echo "File uploaded and data saved successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}

mysqli_close($conn);
?>
