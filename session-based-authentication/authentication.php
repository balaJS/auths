<?php

function email_check($conn, $email) {
    $sql = "SELECT created FROM users where email='$email'";
    $result = $conn->query($sql);

    // TODO: handle mutiple email case
    return ($result->num_rows === 1) ? TRUE : FALSE;
}

function password_check($conn, $email, $password) {
    $sql = "SELECT created FROM users where email='$email' and secret='$password'";
    $result = $conn->query($sql);

    return ($result->num_rows === 1) ? TRUE : FALSE;
}

function fetch_user($conn, $email, $password) {
    $user = [];
    // TODO: aviod query duplicates.
    $sql = "SELECT id,name,email,created FROM users where email='$email' and secret='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    }

    return $user;
}

function session_handler($user) {
    session_start();
    unset($_SESSION);

    $_SESSION['xyz_user'] = $user;
    return isset($user['id']) ? TRUE : FALSE;
}

function authentication($email, $password) {
    $conn = dbconn();
    $user = [];

    $output = [
        'auth' => FALSE,
        'msg' => 'Check the email id'
    ];

    $is_existing_user = email_check($conn, $email);

    if ($is_existing_user) {
        $output['msg'] = 'Check the password';

        if (password_check($conn, $email, $password)) {
            $user = fetch_user($conn, $email, $password);

            $output['msg'] = 'Auth success';
            $output['auth'] = session_handler($user);
        }
    }

    $conn->close();

    echo json_encode($output, JSON_PRETTY_PRINT);
    return $output;
}
