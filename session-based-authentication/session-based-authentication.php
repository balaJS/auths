<?php
require_once 'db.php';
require_once 'authentication.php';

$email = isset($_POST['user_email']) ? filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) : '';
$password = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING);

if (empty($email) || empty($password)) {
    // TODO: handle it properly
    echo 'Double check params';
} else {
    return authentication($email, $password);
}
