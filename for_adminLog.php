<?php
session_start();

function getUserData() {
    return json_decode(file_get_contents('database.json'), true);
}

function authenticateAdmin($username, $password) {
    $users = getUserData()['users'];
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            return $user;
        }
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $user = authenticateAdmin($username, $password);

    if ($user && $user['username'] === 'admin') {
        $_SESSION['username'] = $username;
        header('Location: admin_dashboard.html'); // Redirect to the admin dashboard
    } else {
        echo "Invalid admin credentials.";
    }
}
?>
