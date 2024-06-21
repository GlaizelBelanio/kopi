<?php
function getUserData() {
    return json_decode(file_get_contents('database.json'), true);
}

function saveUserData($data) {
    file_put_contents('database.json', json_encode($data, JSON_PRETTY_PRINT));
}

function userExists($username, $email) {
    $users = getUserData()['users'];
    foreach ($users as $user) {
        if ($user['username'] === $username || $user['email'] === $email) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    if (userExists($username, $email)) {
        echo "Username or email already exists.";
    } else {
        $newUser = [
            "username" => $username,
            "email" => $email,
            "password" => $password
        ];

        $data = getUserData();
        $data['users'][] = $newUser;
        saveUserData($data);

        header('Location: login.html'); // Redirect to the login page after successful registration
    }
}
?>
