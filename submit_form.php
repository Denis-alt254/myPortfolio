<?php
// Step 1: Connect to the database
$servername = "localhost"; // Host name
$username = "root";        // Database username
$password = "Deno8758@!";            // Database password
$dbname = "portfolio";  // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if the form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 3: Sanitize and validate the input data
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));

    // Simple validation (You can enhance this as needed)
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
    } else {
        // Step 4: Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO contact_form_submissions (name, email, message) 
                VALUES ('$name', '$email', '$message')";

        // Step 5: Execute the query and check for errors
        if ($conn->query($sql) === TRUE) {
            echo "Message submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>
