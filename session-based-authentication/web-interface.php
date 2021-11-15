<?php
if (isset($_POST['user_email']) && isset($_POST['user_pass'])) {
    $API = 'web';
    require_once 'api-interface.php';

    if ($output['auth']) {
        header('Location: profile.php');
        exit;
    }

    echo $output['msg'], ' <a href="'.$_SERVER['HTTP_REFERER'].'">Login again</a>';
    // TODO: handle redirection
    exit;
}
