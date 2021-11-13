<?php

function email_check($email) {
    return ($email === 'test@bala.php') ? TRUE : FALSE;
}

function password_check($password) {
    return ($password === md5('pass')) ? TRUE : FALSE;
}

function authentication($email, $password) {
    $output = [
        'auth' => 0,
        'msg' => 'Check the email id'
    ];

    // TODO: use DB connection.
    $is_existing_user = email_check($email);

    if ($is_existing_user) {
        $output['auth'] = password_check($password);
        $output['msg'] = $output['auth'] ? 'Auth success' : 'Check the password';
    }

    echo json_encode($output, JSON_PRETTY_PRINT);
    return $output['auth'];
}

?>
