<?php
session_start();

function getUserData() {
    return json_decode(file_get_contents('database.json'), true);
}

function authenticateUser($username, $password) {
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

    $user = authenticateUser($username, $password);

    if ($user) {
        $_SESSION['username'] = $username;
        header('Location: main.html'); // Redirect to the main page after successful login
    } else {
        echo "Invalid username or password.";
    }
}
?>
