<?php
if (isset($_POST['user_email']) && isset($_POST['user_pass'])) {
    require_once 'api-interface.php';

    $API = 'web';
    $output = auth_api();

    if ($output['auth']) {
        header('Location: profile.php');
        exit;
    }

    echo $output['msg'], ' <a href="'.$_SERVER['HTTP_REFERER'].'">Login again</a>';
    // TODO: handle redirection
    exit;
}
