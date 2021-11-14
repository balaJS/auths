<?php
global $API;
$API = 'rest';

function auth_api() {
    global $API;
    require_once 'db.php';
    require_once 'authentication.php';

    $email = isset($_POST['user_email']) ? filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) : '';
    $password = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING);

    $output = [
        'auth' => FALSE,
        'msg' => 'Double check params'
    ];

    if (!empty($email) && !empty($password)) {
        $output = authentication($email, $password);
    }

    if ($API === 'rest') {
        echo json_encode($output, JSON_PRETTY_PRINT);
        exit;
    }
    return $output;
}

if ($API === 'rest') {
    auth_api();
}
