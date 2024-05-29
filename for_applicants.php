<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $brgy = $_POST['barangay'];
    $zipStreet = $_POST['street'];
    $position = $_POST['position'];
    $countryCode = $_POST['countryCode'];
    $phoneNum = $_POST['phonenum'];
    $letter = $_POST['coverletter'];
    $dob = $_POST['dob']; 
    $workType = $_POST['chosentype'];

    // File handling
    $file_name = ''; // Initialize variable to store filename
    if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $file_name = $_FILES['resume']['name']; // Get the filename
        $file_tmp = $_FILES['resume']['tmp_name']; // Get the temporary location
    }

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'jakesdb');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO application_form (fname, lname, email, region, province, city, brgy, zipStreet, position, countryCode, phoneNum, letter, dob, workType, file_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssssssssissss", $fname, $lname, $email, $region, $province, $city, $brgy, $zipStreet, $position, $countryCode, $phoneNum, $letter, $dob, $workType, $file_name);

        // Execute the query
        if ($stmt->execute()) {
            // Move the file to the desired location only if registration is successful
            if (move_uploaded_file($file_tmp, 'uploads/' . $file_name)) {
                echo "<script>alert('Application submitted!'); window.location='form.html';</script></script>";
                ;
            } else {
                echo "Error moving file";
            }
        } else {
            echo "Error registering user";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
