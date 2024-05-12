
<?php
// Check if the form is submitted

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

    
    // Add more variables for other form fields as needed

    

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'applicants');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT INTO application_form (fname, lname,email,region,province,city,brgy,zipStreet,position,countryCode,phoneNum, letter, dob, workType) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssssssssibss", $fname, $lname, $email, $region, $province, $city, $brgy, $zipStreet, $position, $countryCode, $phoneNum ,  $letter, $dob, $workType);
        $stmt->execute();
        echo"registration Success";
        $stmt->close();
        $conn->close();

    }

   

?>