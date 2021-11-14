<?php
session_start();

$output = [
    'user' => NULL,
    'msg' => 'get authentication first.',
    'type' => 'error'
];

if (isset($_SESSION['xyz_user']) && isset($_SESSION['xyz_user']['id'])) {
    $output['user'] = $_SESSION['xyz_user'];
    $output['type'] = 'success';
    $output['msg'] = 'Welcome ' . $output['user']['name'];

    unset($output['user']['id']);
}
echo json_encode($output, JSON_PRETTY_PRINT);
exit;
