<?php
require_once 'db.php';
require_once 'authentication.php';

$email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
$password = isset($_POST['user_pass']) ? $_POST['user_pass'] : '';

if (empty($email) || empty($password)) {
    // TODO: handle it properly
    echo 'Double check params';
} else {
    // TODO: input sanitization and validation

    return authentication($email, $password);
}

?>
