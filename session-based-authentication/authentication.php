<?php

function email_check($conn, $email) {
    $stmt = $conn->prepare("SELECT id, secret FROM users where email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $output = [
        'id' => NULL,
        'secret' => '',
        'status' => FALSE
    ];
    if ($result->num_rows === 1) {
        $output['id'] = $user['id'];
        $output['secret'] = $user['secret'];
        $output['status'] = TRUE;
    }
    // TODO: handle mutiple email case
    return $output;
}

function password_check($conn, $userdata, $password) {
    $match = password_verify($password, $userdata['secret']);
    return $match ? TRUE : FALSE;
}

function fetch_user($conn, $id) {
    $user = NULL;

    $stmt = $conn->prepare("SELECT id,name,email,created FROM users where id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    }

    return $user;
}

function session_handler($user) {
    $_SESSION['xyz_user'] = $user;
    return isset($user['id']) ? TRUE : FALSE;
}

function authentication($email, $password) {
    session_start();
    $conn = dbconn();
    $user = [];

    if (isset($_SESSION['xyz_user'])) {
        unset($_SESSION['xyz_user']);
    }

    $output = [
        'auth' => FALSE,
        'msg' => 'Check the email id'
    ];

    $userdata = email_check($conn, $email);

    if ($userdata['status']) {
        $output['msg'] = 'Check the password';

        if (password_check($conn, $userdata, $password)) {
            $user = fetch_user($conn, $userdata['id']);

            $output['msg'] = 'Auth success';
            $output['auth'] = session_handler($user);
        }
    }

    $conn->close();
    return $output;
}
