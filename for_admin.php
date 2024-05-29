<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'jakesdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'application_form' table
$sql = "SELECT * FROM application_form";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            display: block;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-column {
            text-align: center;
        }

        .edit-link {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .edit-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .logout-link {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            color: #dc3545;
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #dc3545;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link:hover {
            text-decoration: none;
            background-color: #dc3545;
            color: #fff;
        }

        @media (max-width: 768px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>Application Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Region</th>
            <th>Province</th>
            <th>City</th>
            <th>Barangay</th>
            <th>Zip Code/Street</th>
            <th>Position</th>
            <th>Work Type</th>
            <th>Country Code</th>
            <th>Phone Number</th>
            <th>Cover Letter</th>
            <th>Date of Birth</th>
            <th>File Name</th>
            <th>Status</th>
            <th class="action-column">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["lname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["region"] . "</td>";
                echo "<td>" . $row["province"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["brgy"] . "</td>";
                echo "<td>" . $row["zipStreet"] . "</td>";
                echo "<td>" . $row["position"] . "</td>";
                echo "<td>" . $row["workType"] . "</td>";
                echo "<td>" . $row["countryCode"] . "</td>";
                echo "<td>" . $row["phoneNum"] . "</td>";
                echo "<td>" . $row["letter"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["file_name"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td class='action-column'><a class='edit-link' href='for_edit.php?id=" . $row["id"] . "'>Edit</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='18'>No records found</td></tr>";
        }
        ?>
    </table>
    <a href="main.html" class="logout-link">Logout</a>
</body>
</html>

<?php
$conn->close();
?>

